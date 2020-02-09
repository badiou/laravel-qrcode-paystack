<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use Flash;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\User;
use App\Models\AccountHistories;
use App\Models\Qrcode as QrcodeModel;
use Auth;


class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

       //dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want



        // ici on va venir lire de contenu de $paymentDetails et voir s'il y a eu success
        if($paymentDetails['data']['status']!='success')
        {
            Flash::error('Désolé, le paiement a échoué');
            return redirect(route('qrcodes.show',['id'=>$paymentDetails['data']['metadata']['qrcode_id']]));

        }
        //ici il faut vérifier si le montant du produit est exactement celui qui est passé dans le metadata. Cela evite que l'utilisateur puisse injecter 
        //du code en inspectant la page pour modifier le montant....
        
        // ça veut dire qu'on recherche encore le qrcode dans la base de données pour vérifier son montant avant de procéder au paiement 
        $qrcode=QrcodeModel::find($paymentDetails['data']['metadata']['qrcode_id']);

        if($qrcode->amount != ($paymentDetails['data']['amount']/100)){   
            // la division par 100 provient du fait qu'un Naira=100 kobos. Or le paiement se fait en Kobo
           
            Flash::error("Une erreur est survenue. Merci de contacter l\'administrateur");
        }

        $transaction=Transaction::find($paymentDetails['data']['metadata']['transaction_id']);

        //ici on doit venir mettre à jour la transaction en recupérant la transaction dont l'ID est sauvegardé dans le metadata
            Transaction::where('id',$paymentDetails['data']['metadata']['transaction_id'])
            ->update([
                'status'=>'Transaction réussie',
            ]);
    /*..............................................Pour le proprietaire du compte............................................................. */
        //on met a jour le qrcode owner //on met à jour les account histories
        $qrCodeOwenerAccount=Account::where('user_id',$qrcode->user_id)->first();
        Account::where('user_id',$qrcode->user_id)->update([
            'total_credit'=>($qrCodeOwenerAccount->total_credit+$qrcode->amount),
            'balance'=>($qrCodeOwenerAccount->balance + $qrcode->amount),
           
        ]);

        $buyer=User::find($paymentDetails['data']['metadata']['buyer_user_id']);
           
        AccountHistories::create([
            'user_id'=>$qrcode->user_id,
            'account_id'=>$qrCodeOwenerAccount->id,
            'message'=>'Paiement de '.$qrcode->amount.  ' provenenant de '.$buyer->name.' (Email)'.$buyer->email. ' pour le produit '.$qrcode->product_name,
        ]);
/*......................................Fin proprio..................................................................... */
           

/*........................................Pour l'acheteur................................................................... */

        $buyerAccount=Account::where('user_id',$paymentDetails['data']['metadata']['buyer_user_id'])->first();
        Account::where('user_id',$qrcode->user_id)->update([
            'total_debit'=>($qrCodeOwenerAccount->total_credit+$qrcode->amount)
        ]);

        $buyer=User::find($paymentDetails['data']['metadata']['buyer_user_id']);

        AccountHistories::create([
            'user_id'=>$paymentDetails['data']['metadata']['buyer_user_id'],
            'account_id'=>$buyerAccount->id,
            'message'=>'Paiement '.$qrcode->amount. ' pour le produit '.$qrcode->product_name,
        ]);

        Flash::success("Paiement reussi");
        return redirect(route('transactions.show',['id'=>$transaction->id]));
        
        //Pour envoyer des emails
        //L'email du proprio est $qrcode->user['email]
        //L'email de l'acheteur est $paymentDetails['data']['metadata']['buyer_user_email']


        //on envoie les SMS

    }
}