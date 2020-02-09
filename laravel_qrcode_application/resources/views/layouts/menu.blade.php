
{{--Tous les utilisateurs--}}
    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{!! route('users.show',['id'=>Auth::user()->id]) !!}"><i class="fa fa-edit"></i><span>Mon profil</span></a>
    </li>

    <li class="{{ Request::is('accounts*') ? 'active' : '' }}">
        <a href="{!! route('accounts.show')!!}"><i class="fa fa-edit"></i><span>Mon compte</span></a>
    </li>
    
    <li class="{{ Request::is('transactions*') ? 'active' : '' }}">
        <a href="{!! route('transactions.index') !!}"><i class="fa fa-edit"></i><span>Transactions</span></a>
    </li>
    
        
{{--Webmaster--}}
@if(Auth::user()->role_id<4)
    <li class="{{ Request::is('qrcodes*') ? 'active' : '' }}">
        <a href="{!! route('qrcodes.index') !!}"><i class="fa fa-edit"></i><span>Produits</span></a>
    </li>
@endif
{{--Moderateurs--}}
@if(Auth::user()->role_id<3)
    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Utilisateurs</span></a>
    </li>
    <li class="{{ Request::is('accounts*') ? 'active' : '' }}">
        <a href="{!! route('accounts.index') !!}"><i class="fa fa-edit"></i><span>Comptes</span></a>
</li>
    
<li class="{{ Request::is('accountHistories*') ? 'active' : '' }}">
    <a href="{!! route('accountHistories.index') !!}"><i class="fa fa-edit"></i><span>Historiques de comptes</span></a>
</li>
@endif
{{--Admin--}}

@if(Auth::user()->role_id==1)
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Rôles</span></a>
</li>    
@endif

