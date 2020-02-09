
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Role Id Field -->
<div class="form-group">
    {!! Form::label('role_id', 'Rôle utilisateur:') !!}
    <p>{!! $user->role['name'] !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Membre depuis:') !!}
    <p>{!! $user->created_at->format( 'd m Y h:i:s') !!}</p>
</div>
<hr/>
<div>
    <h5 class="text-center">Liste des transactions</i></h5>
    @include('transactions.table')
</div>
<div>
        <h5 class="text-center">Liste des produits</i></h5>
        @include('qrcodes.table')
    </div>
    
