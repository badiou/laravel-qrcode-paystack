



<div class="class row">
    <div class="col-md-6">
        
<!-- Qrcode Id Field -->
<div class="form-group">
        {!! Form::label('qrcode_id', 'Nom du produit:') !!}
    <p><a href="/qrcodes/{{$transaction->qrcode['id']}}" class="text-info">{!! $transaction->qrcode['product_name']  !!} | {!! $transaction->user['name'] !!}</a></p>
    </div>
    
    <!-- Amount Field -->
    <div class="form-group">
        {!! Form::label('amount', 'Montant (XOF):') !!}
        <p><b class="text-danger">{!!number_format($transaction->amount) !!} (XOF)</b></p>
    </div>
    @if($transaction->qrcode['product_url'])
    
        <div class="form-group">
              
                <p><a href="{!!$transaction->qrcode['product_url'] !!}" class="btn btn-success btn-lg">Revenir au site marchant</a></p>
        </div>
    @endif
    <!--Si la transaction existe-->
    
    <div class="form-group">
        {!! Form::label('user_id', 'Nom de l\'acheteur:') !!}
    <p>
        <a href="/users/{{$transaction->user['id']}}">
            {!! $transaction->user['name']!!} | {!! $transaction->user['email']  !!}
        </a>
        </p>
    </div>
    <!-- Qrcode Owner Id Field -->
    <div class="form-group">
        {!! Form::label('qrcode_owner_id', 'Proprietaire produit:') !!}
        <p>
            <a href="/users/{!! $transaction->qrcode_owner['id'] !!}">
                {!! $transaction->qrcode_owner['name'] !!}
            </a>
        </p>
    </div>
    
    <!-- Payment Method Field -->
    <div class="form-group">
        {!! Form::label('payment_method', 'Méthode de paiement:') !!}
        <p>{!! $transaction->payment_method !!}</p>
    </div>
    
    </div>
    <div class="col-md-6">
        
<!-- Message Field -->
<div class="form-group">
        {!! Form::label('message', 'Message:') !!}
        <p>{!! $transaction->message !!}</p>
    </div>
    
    <!-- Status Field -->
    <div class="form-group">
        {!! Form::label('status', 'Status:') !!}
        <p>{!! $transaction->status !!}</p>
    </div>
    
    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Date de création:') !!}
        <p>{!! $transaction->created_at->format('d/m/Y h:i:s') !!}</p>
    </div>
    
    <!-- Updated At Field -->
    <div class="form-group">
        {!! Form::label('updated_at', 'Date de mise à jour:') !!}
        <p>{!! $transaction->updated_at !!}</p>
    </div>
    </div>
</div>

