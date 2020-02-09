<div class="row">
    <div class="col-md-6">
        
<!-- User Id Field -->
<div class="form-group">
        {!! Form::label('user_id', 'Utilisateur:') !!}
        <p><a href="/users/{{$account->user['id']}}">{!! $account->user['name'] !!} | {!! $account->user['email'] !!}</a></p>
    </div>
    
    <!-- Balance Field -->
    <div class="form-group">
        {!! Form::label('balance', 'Balance:') !!}
        <p>{!!number_format($account->balance )!!}</p>
    </div>
    
    <!-- Total Credit Field -->
    <div class="form-group">
        {!! Form::label('total_credit', 'Total Credit:') !!}
        <p>{!!number_format( $account->total_credit) !!}</p>
    </div>
    
    <!-- Total Debit Field -->
    <div class="form-group">
        {!! Form::label('total_debit', 'Total Debit:') !!}
        <p>{!! number_format( $account->total_debit) !!}</p>
    </div>
    
    <!-- Withdrawl Method Field -->
    <div class="form-group">
        {!! Form::label('withdrawl_method', 'Withdrawl Method:') !!}
        <p>{!! $account->withdrawl_method !!}</p>
    </div>
    
    <!-- Payement Email Field -->
    <div class="form-group">
        {!! Form::label('payement_email', 'Payement Email:') !!}
        <p>{!! $account->payement_email !!}</p>
    </div>
    
    <!-- Bank Name Field -->
    <div class="form-group">
        {!! Form::label('bank_name', 'Bank Name:') !!}
        <p>{!! $account->bank_name !!}</p>
    </div>
    
    <!-- Bank Branch Field -->
    <div class="form-group">
        {!! Form::label('bank_branch', 'Bank Branch:') !!}
        <p>{!! $account->bank_branch !!}</p>
    </div>
    
    
    
    </div>
    <div class="col-md-6">
      <!-- Bank Account Field -->
    <div class="form-group">
        {!! Form::label('bank_account', 'Bank Account:') !!}
        <p>{!! $account->bank_account !!}</p>
    </div>  
<!-- Applied For Payout Field -->
<div class="form-group">
        {!! Form::label('applied_for_payout', 'Applied For Payout:') !!}
        <p>
    
        </p>
    </div>

    <!-- Last Date Applied Field -->
    <div class="form-group">
        {!! Form::label('last_date_applied', 'Last Date Applied:') !!}
        <p>{!! $account->last_date_applied !!}</p>
    </div>
    
    <!-- Last Date Paid Field -->
    <div class="form-group">
        {!! Form::label('last_date_paid', 'Last Date Paid:') !!}
        <p>{!! $account->last_date_paid !!}</p>
    </div>
    
    <!-- Country Field -->
    <div class="form-group">
        {!! Form::label('country', 'Country:') !!}
        <p>{!! $account->country !!}</p>
    </div>
    
    <!-- Other Details Field -->
    <div class="form-group">
        {!! Form::label('other_details', 'Other Details:') !!}
        <p>{!! $account->other_details !!}</p>
    </div>    
    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $account->created_at->format('d/m/Y h:i:s') !!}</p>
    </div>
    
    <!-- Updated At Field -->
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $account->updated_at->format('d/m/Y h:i:s') !!}</p>
    </div>
    
    
    </div>
</div>
<div class="col-md-12">
    <h5>Liste des historiques sur le compte N°: # <i> {{$account->id}}</i></h5>
    @include('account_histories.table')
</div>