@extends('layouts.app')

@section('content')
    <section class="content-header">
    </section>
    <div class="clearfix"></div>

        @include('flash::message')

    <div class="clearfix"></div>
    <br/>
    <section class="content-header">
        @if(!Auth::guest() && (Auth::user()->id==$qrcode->user_id || Auth::user()->role_id < 3))
{{--Ici ce if eprmet de dire que seuls l'utilsateur qui a cré le QRCODE peut l'éditer --}}
        <a href="{!! route('qrcodes.edit', [$qrcode->id]) !!}" class='btn btn-primary pull-right'>Modifier un produit</a>
        @endif
    </section>
   <br/>
   
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('qrcodes.show_fields')
                  
                </div>
            </div>
        </div>
    </div>
@endsection
