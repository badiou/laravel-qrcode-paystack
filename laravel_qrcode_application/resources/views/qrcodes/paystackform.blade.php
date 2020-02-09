@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Terminé votre achat
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                   
<form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
    <div class="row" style="margin-bottom:40px;">
      <div class="col-md-8">
        <p>
            <div>
                <h4>
                    {!! $qrcode->product_name !!}
                   </h4>
                        @if(isset($qrcode->company_name))
                      <p>  <i> par </i><small>{!! $qrcode->company_name !!}</small></p>
                            
                        @endif
            </div>
        </p>
        <input type="hidden" name="email" value="ourobadiou@gmail.com"> {{-- required --}}
        <input type="hidden" name="orderID" value="{{$transaction->id}}">
        <input type="hidden" name="amount" value="{{$qrcode->amount*100}}"> {{-- required in kobo --}}
        <input type="hidden" name="quantity" value="1">
        
        @if(!Auth::guest())
            <input type="hidden" name="metadata" value="{{ json_encode($array = [
              //ici ce sont les données que je passe au metadata qui est le json qu'il renvoie depuis $paymentDetails = Paystack::getPaymentData(); dans le controller
              //PaystackController
              'buyer_user_id' =>$user->id,
              'buyer_user_email'=>$user->email,
              'qrcode_id'=>$qrcode->id,
              'transaction_id'=>$transaction->id,
              ]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
        @endif
        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
        <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
        {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

         <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


        <p>
          <button class="btn btn-success" type="submit" value="Pay Now!">
          <i class="fa fa-plus-circle fa-lg"></i> Payer avec paystack
          </button>
        </p>
      </div>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
@endsection
