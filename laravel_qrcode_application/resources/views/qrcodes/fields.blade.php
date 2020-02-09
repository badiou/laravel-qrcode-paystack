<!-- User Id Field -->
<!--Ici on utilise une variable de session qui recupère l'ID de l'utilisateur connecté-->
    {!! Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control','required']) !!}


<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Nol du site Web:') !!}
    {!! Form::text('website', null, ['class' => 'form-control', 'placeholder'=>'https://','required']) !!}
</div>

<!-- Company Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_name', 'Nom entreprise:') !!}
    {!! Form::text('company_name', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Product Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_name', 'Nom du produit:') !!}
    {!! Form::text('product_name', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Product Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_url', 'Url du produit:') !!}
    {!! Form::text('product_url', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Callback Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('callback_url', 'Url Callback:') !!}
    {!! Form::text('callback_url', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Qrcode Path Field -->

{{--<div class="form-group col-sm-6">
    {!! Form::label('qrcode_path', 'Qrcode Path:') !!}
    {!! Form::text('qrcode_path', null, ['class' => 'form-control']) !!}
</div>--}}

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Montant (XOF):') !!}
    {!! Form::text('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', '1') !!} Disponible
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
   {{-- <a href="{!! route('qrcodes.index') !!}" class="btn btn-default">Cancel</a>--}}
</div>
