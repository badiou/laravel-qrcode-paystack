<div class="col-md-6">
        <!-- Product Name Field -->
        <div class="form-group">
           <h4>
            {!! $qrcode->product_name !!}
           </h4>
                @if(isset($qrcode->company_name))
              <p>  <i> par </i><small>{!! $qrcode->company_name !!}</small></p>
                    
                @endif
        </div>
        <div class="form-group">
            {!! Form::label('product_url', 'Product Url:') !!}
            <p>
                <a href="{!! $qrcode->product_url !!}" target="_blank">
                    {!! $qrcode->product_url !!}
                </a>
            </p>
        </div>
     <!-- Amount Field -->
     <div class="form-group">
            <p class="h3">  Montant: {!! $qrcode->amount !!} (XOF)</p>
        </div>
    
    <!-- User Id Field -->
    <div class="form-group">
        {!! Form::label('user_id', 'Nom d\'utilisateur:') !!}
        <p>{!! $qrcode->user['name'] !!}</p>
    </div>

    <!-- Website Field -->
    <div class="form-group">
        {!! Form::label('website', 'Site web:') !!}
        <p>
            <a href="{!! $qrcode->website !!}" target="_blank">
                {!! $qrcode->website !!}
            </a>
        </p>
    </div>

    <!-- Product Url Field -->
   
    <hr/>
@if(!Auth::guest() && (Auth::user()->id==$qrcode->user_id || Auth::user()->role_id < 3))
{{--Ici on vérifie si cette personne est le créateur du QRCODE ou s'il est soit Admin, Moderateur, WebMaster.....--}}
        <div class="form-group">
            {!! Form::label('callback_url', 'Callback Url:') !!}
            <p>
                <a href="{!!$qrcode->callback_url!!}" target="_blank">
                {!! $qrcode->callback_url !!}
                </a>
            </p>
        </div>
        <!-- Status Field -->
        <div class="form-group">
            {!! Form::label('status', 'Status:') !!}
            @if($qrcode->status==1)
            Disponible
            @else
            Indisponible
            @endif
            <p></p>
        </div>

        <!-- Created At Field -->
        <div class="form-group">
            {!! Form::label('created_at', 'Date de création') !!}
            <p>{!! $qrcode->created_at->format('d/m/Y h:i:s') !!}</p>
        </div>

        <!-- Updated At Field -->
        <div class="form-group">
            {!! Form::label('updated_at', 'Date de mise à jour:') !!}
            <p>{!! $qrcode->updated_at->format('d/m/Y h:i:s') !!}</p>
        </div>
@endif
    <!-- Callback Url Field -->
</div>



<div class="col-md-6">
    <!-- Qrcode Path Field -->
    <div class="form-group col-md-12">
        <div class="col-md-12">
                {!! Form::label('qrcode_path', 'Scannez le Qrcode et payer avec notre application:') !!}
        </div>
        <div class="col-md-12">
                <img src="{!!asset($qrcode->qrcode_path) !!}" with="100px">

        </div>
    </div>

    <form method="post" class="form-horizontal" class="col-md-6" action="{{route('qrcodes.show_payment_page')}}">
       
            <div class="form-group ">
                    @if(Auth::guest())
                        <label for="email">Saisir votre email et passer </label>
                        <input class="form-control " type="email" name="email" class="col-md-3" placeholder="ourobadiou@gmail.com" required>
                    @else
                    <input type="hidden" name="email" value="{{Auth::user()->email}}">
                    @endif
                    {{ csrf_field() }}
            <input class="form-control " type="hidden" name="qrcode_id" value="{{$qrcode->id}}">
            <div>
                <br/>
            <div>
                    <button class="btn btn-success btn-lg" type="submit" value="Pay Now!">
                    <i class="fa fa-plus-circle fa-lg"></i> Passer à la caisse
                    </button>
            </div>
    </form>
   
</div>
    
    
        @if(!Auth::guest() && (Auth::user()->id==$qrcode->user_id || Auth::user()->role_id < 3))
            <div class="col-md-12">
            <h5 class="text-center">Liste des transactions par rapport au produit <i> {{$qrcode['product_name']}}</i></h5>
                @include('transactions.table')
            </div>
        @endif

