<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Role Id Field -->
@if(Auth::user()->role_id<3)
    <div class="dropdown form-group col-sm-6">
           <label for="sel1">Rôle utilisateur</label>
           <select class="form-control" id="role_id" name="role_id">
                <option value="{{$user->role_id}}">{{$user->role['name']}}</option>
            @foreach ($roles as $role)
                <option value="{{$role['id']}}">{{$role['name']}}</option>
            @endforeach
           </select>
    </div>
@endif
<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Annuler</a>
</div>
