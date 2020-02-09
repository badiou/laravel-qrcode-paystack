
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Rôle utilisateur:') !!}
    <p>{!! $role->name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Date de création :') !!}
    <p>{!! $role->created_at->format('d-m-Y h:i:s') !!}</p>
</div>
<hr/>
<h5 class="text-center">Liste des utilisateurs avec le profil <i>{{$role['name']}}</i></h5>
@include('users.table')
