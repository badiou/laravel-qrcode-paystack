<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\AccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use App\Models\Account;
use App\Models\AccountHistories;


class AccountController extends AppBaseController
{
    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->accountRepository->pushCriteria(new RequestCriteria($request));
        $accounts = $this->accountRepository->all();
        return view('accounts.index')
            ->with('accounts', $accounts);
            
    }
    public function apply_for_payout(Request $request)
    {
        //recevoir l'ID du compte

        //vérifier si l'utilsateur connecté est bien le proprietaire du compte

        //mettre à jour le champ payout dans la table account
        //rediriger et affichier le message Flash

       $account = $this->accountRepository->findWithoutFail($request->input('apply_for_payout'));
      
        if (empty($account)) {
            Flash::error('Le compte client est introuvable');
            return redirect()->back();
        }
         
       if(Auth::user()->id!=$account->user_id){
            Flash::error('Désolé, vous ne pouvez pas modifier un compte qui n\'est pas le votre');
            return redirect()->back();
       }
       else
       {
            //ici je fais la mise à jour la demande à 1 et le paiement à 0
       Account::where('id',$account->id)->update([
        'applied_for_payout'=>1,
        'paid'=>0,
        'last_date_applied'=>Carbon\Carbon::now()
       ]);
      
       AccountHistories::create([
            'user_id'=>$account->user_id,
           'account_id'=>$account->id,
           'message'=>'Demande de paiement effectué par le proprietaire du compte '. Auth::user()->name
       ]);
       Flash::success('Demande de paiement effectué avec succès');
       return redirect()->back();

       }
       
    }
    public function mark_as_paid(Request $request)
    {
       //recevoir l'ID du compte

        //vérifier si l'utilsateur connecté est bien le proprietaire un administrateur ou moderateur

        //mettre à jour le champ paid  dans la table account = 1 et applied_for_payout à 0
        //Mettre à jour accountHistories
        //rediriger et affichier le message Flash

        $account = $this->accountRepository->findWithoutFail($request->input('mark_as_paid'));
      
        if (empty($account)) {
            Flash::error('Le compte client est introuvable');
            return redirect()->back();
        }
         
       if(Auth::user()->role_id>2){
            Flash::error('Désolé, vous n\'etes pas autorisé à effectuer cette action');
            return redirect()->back();
       }
       else
       {
            //ici je fais la mise à jour la demande à 1 et le paiement à 0
       Account::where('id',$account->id)->update([
        'applied_for_payout'=>0,
        'paid'=>1,
        'last_date_paid'=> Carbon\Carbon::now()
       ]);
      
       AccountHistories::create([
           'user_id'=>$account->user_id,
           'account_id'=>$account->id,
           'message'=>'Demande de confirmation de paiement effectué par:  '. Auth::user()->name
       ]);
       Flash::success('Paiement effectué avec succès');
       return redirect()->back();

       }
       
    }
    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $account = $this->accountRepository->create($input);

        Flash::success('Account saved successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified Account.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id = null)
    {
        if(!isset($id)){
            //si vous accéder à cette action dans un id de account, on le fabrique pour vous en vous retournant
            //vers le votre account/id de account
            $account=Account::where('user_id',Auth::user()->id)->first();
            $id=$account->id;
        }
        else{
       
            $account = $this->accountRepository->findWithoutFail($id);
        }
       
        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }
        $accountHistories=$account->account_histories;
        return view('accounts.show')
        ->with('account', $account)
        ->with('accountHistories',$accountHistories);
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.edit')->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param  int              $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Compte non retrouvé');

            return redirect(route('accounts.index'));
        }

        $account = $this->accountRepository->update($request->all(), $id);

        Flash::success('Le compte est mis à jour avec succès.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Compte non retrouvé');

            return redirect(route('accounts.index'));
        }

        $this->accountRepository->delete($id);

        Flash::success('Compte supprimé avec succès.');

        return redirect(route('accounts.index'));
    }
}
