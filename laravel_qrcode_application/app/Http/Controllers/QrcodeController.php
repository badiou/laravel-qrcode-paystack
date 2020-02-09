<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQrcodeRequest;
use App\Http\Requests\UpdateQrcodeRequest;
use App\Repositories\QrcodeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Qrcode as QrcodeModel;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LaravelQRCode\Facades\QRCode;
use  App\Http\Resources\Qrcode as QrcodeResource;
use  App\Http\Resources\QrcodeCollection as QrcodeResourceCollection;

class QrcodeController extends AppBaseController
{
    /** @var  QrcodeRepository */
    private $qrcodeRepository;

    public function __construct(QrcodeRepository $qrcodeRepo)
    {
        $this->qrcodeRepository = $qrcodeRepo;
    }

    /**
     * Display a listing of the Qrcode.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //les admins peuvent voir tous les QRcodes
        if(Auth::user()->role_id <3){
            // ici on a liste des Qrcodes quelques soit 
            $this->qrcodeRepository->pushCriteria(new RequestCriteria($request));
            $qrcodes = $this->qrcodeRepository->all();
        }
        else
        {
            //chaque utilisateur ne voit que ses propres Qrcodes
            $qrcodes=QrcodeModel::where('user_id',Auth::user()->id)->get();
        }
       //ici la donnée qui est renvoyée est de type Json puisque la Resource est faite de manière à renvoyer des données Json
        //return new QrcodeResourceCollection($qrcodes);
        return view ('qrcodes.index')
        ->with('qrcodes',$qrcodes);
       
    }

    public function show_payment_page(request $request){
        /*recevoir l'email de l'acheteur
         recuprérer user_id et initialiser la transaction
         rediriger vers  la page de paiement de paystack*/

         $input=$request->all();
         $user=User::where('email',$input['email'])->first();
         if(empty($user))
        {//ça veut dire si l'utilisateur n'existe pas
            
            $user=User::create([
                'name' => $input['email'],
                'email' => $input['email'],
                'password' => Hash::make($input['email']),
            ]);
         
        }   
       //ici on recherche le qrcode qu'on a mit dans un champ hidden depuis qrcodes.show_fields
        $qrcode=QrcodeModel::where('id',$input['qrcode_id'])->first();

        // ici on doit initier la transaction

        $transaction=Transaction::create([
            'user_id' => $user->id,
            'qrcode_id' => $qrcode->id,
            'status' => 'initialisation',
            'qrcode_owner_id'=>$qrcode->user_id,
            'payment_method'=>'paystack/card',
            'amount'=>$qrcode->amount,
        ]);
        return view('qrcodes.paystackform',['qrcode'=>$qrcode,'user'=>$user,'transaction'=>$transaction]);
    }

    /**
     * Show the form for creating a new Qrcode.
     *
     * @return Response
     */
    public function create()
    {
        return view('qrcodes.create');
    }

    /**
     * Store a newly created Qrcode in storage.
     *
     * @param CreateQrcodeRequest $request
     *
     * @return Response
     */
    public function store(CreateQrcodeRequest $request)
    {
        $input = $request->all();
        
       $qrcode = $this->qrcodeRepository->create($input);

       $file='les_qrcodes/'. $qrcode->id.'.png'; // créer le nom du fichier à sauvegarder

        $newQrcode=QRCode::text("message")  
            ->setSize(7)
            ->setMargin(2)
            ->setOutfile($file)
            ->png();
       
        $input['qrcode_path']=$file;  

            $newQrcode=QrcodeModel::where('id',$qrcode->id)
            ->update(['qrcode_path'=>$file]);
        
         if($newQrcode)
        {
            Flash::success('Le Qrcode a été créé avec succès.');   
        }
        else  
        {
            Flash::error('Erreur de création de Qrcode.');
        }
        return redirect(route('qrcodes.show',['qrcode'=>$qrcode]));
    }

    /**
     * Display the specified Qrcode.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $qrcode = $this->qrcodeRepository->findWithoutFail($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }
        $transactions=$qrcode->transactions;

        return view('qrcodes.show')
        ->with('qrcode', $qrcode)
        ->with('transactions', $transactions);
    }

    /**
     * Show the form for editing the specified Qrcode.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $qrcode = $this->qrcodeRepository->findWithoutFail($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        return view('qrcodes.edit')->with('qrcode', $qrcode);
    }

    /**
     * Update the specified Qrcode in storage.
     *
     * @param  int              $id
     * @param UpdateQrcodeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQrcodeRequest $request)
    {
        $qrcode = $this->qrcodeRepository->findWithoutFail($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        $qrcode = $this->qrcodeRepository->update($request->all(), $id);

        Flash::success('Qrcode updated successfully.');

        return redirect(route('qrcodes.show', ['qrcode'=>$qrcode]));
    }

    /**
     * Remove the specified Qrcode from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $qrcode = $this->qrcodeRepository->findWithoutFail($id);

        if (empty($qrcode)) {
            Flash::error('Qrcode not found');

            return redirect(route('qrcodes.index'));
        }

        $this->qrcodeRepository->delete($id);

        Flash::success('Qrcode deleted successfully.');

        return redirect(route('qrcodes.index'));
    }
}
