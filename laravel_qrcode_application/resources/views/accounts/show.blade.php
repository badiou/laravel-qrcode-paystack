@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            Compte N° #{{$account->id}}
            <small>    
                @if($account->applied_for_payout==1)
                    En attente de paiement
                @endif
            </small>
        </h1>
        {{--ici c'est quand l'utilisateur connecté est bien le meme qui utilise le compte et si vous n'avez jamais demandé le paiement--}}
        @if(Auth::user()->id==$account->user_id && $account->applied_for_payout!=1)
            <h1 class="pull-right">
            {!! Form::open(['route' => ['accounts.apply_for_payout'], 'method' => 'post']) !!}
            <input type="hidden" value="{{$account->id}}" name="apply_for_payout">
                {!! Form::button('<i class="fa fa-credit-card"></i> Demande de paiement', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('voulez-vous passer au paiement ?')"]) !!}
            {!! Form::close() !!}
            </h1>
        @endif
        {{--ici c'est quand vous etes admin ou mederateur et il n'y a jamais eu de validation de paiement--}}
        @if(Auth::user()->role_id <3 && $account->paid !=1)
            <h1 class="pull-right">
                {!! Form::open(['route' => ['accounts.mark_as_paid'], 'method' => 'post']) !!}
                    <input type="hidden" value="{{$account->id}}" name="mark_as_paid">
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i> Procéder au paiement', ['type' => 'submit', 'class' => 'btn btn-warning btn-xs', 'onclick' => "return confirm('Confirmez-vous ce paiement ?')"]) !!}
                {!! Form::close() !!}
            </h1>
        @endif
        <br/>
    </section>
    <div class="content">
        <div class="clearfix">
        
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('accounts.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
