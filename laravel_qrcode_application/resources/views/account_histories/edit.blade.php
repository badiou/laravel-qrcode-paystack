@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Account Histories
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($accountHistories, ['route' => ['accountHistories.update', $accountHistories->id], 'method' => 'patch']) !!}

                        @include('account_histories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection