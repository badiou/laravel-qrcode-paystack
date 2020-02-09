@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Rôle # {{$role->id}}
        </h1>
    </section>
    <section class="content-header">
        <a href="{!! route('roles.edit', [$role->id]) !!}" class='btn btn-primary pull-right'>Modifier un rôle</a>
    </section>
   <br/>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('roles.show_fields')
                    
                </div>
            </div>
        </div>
    </div>
@endsection
