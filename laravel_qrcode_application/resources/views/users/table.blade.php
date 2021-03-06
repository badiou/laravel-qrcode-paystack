<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>Nom de l'utilisateur</th>
                <th>Role</th>
                <th>Email</th>
                @if(Auth::user()->role_id <3)

                     <th>Action</th> 
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><a href="{!! route('users.show', [$user->id]) !!}">{!! $user->name !!}</a></td>
                <td>{!! $user->role['name']!!}</td>
                <td>{!! $user->email !!}</td>
                @if(Auth::user()->role_id <3)
                    <td>
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Êtes-vous sûr?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
