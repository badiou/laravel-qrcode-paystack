
@if(Auth::user()->role_id==1)
    
<!-- Balance Field -->
<div class="form-group col-sm-6">
        {!! Form::label('balance', 'Balance:') !!}
        {!! Form::number('balance', null, ['class' => 'form-control']) !!}
    </div> 
    <!-- Total Credit Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('total_credit', 'Total Credit:') !!}
        {!! Form::number('total_credit', null, ['class' => 'form-control']) !!}
    </div>  
    <!-- Total Debit Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('total_debit', 'Total Debit:') !!}
        {!! Form::number('total_debit', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Paid Field -->
    <div class="form-group col-sm-6">
            {!! Form::label('paid', 'Paid:') !!}
            {!! Form::number('paid', 0, ['class' => 'form-control']) !!}
    </div>
@endif
<!-- Withdrawl Method Field -->
<div class="form-group col-sm-6">
    {!! Form::label('withdrawl_method', 'Withdrawl Method:') !!}
    {!! Form::text('withdrawl_method', null, ['class' => 'form-control']) !!}
</div>

<!-- Payement Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payement_email', 'Payement Email:') !!}
    {!! Form::text('payement_email', null, ['class' => 'form-control']) !!}
</div>

<!-- Bank Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_name', 'Bank Name:') !!}
    {!! Form::text('bank_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Bank Branch Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_branch', 'Bank Branch:') !!}
    {!! Form::text('bank_branch', null, ['class' => 'form-control']) !!}
</div>

<!-- Bank Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_account', 'Bank Account:') !!}
    {!! Form::text('bank_account', null, ['class' => 'form-control']) !!}
</div>
@section('scripts')
    <script type="text/javascript">
        $('#last_date_applied').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#last_date_paid').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country', 'Country:') !!}
    {!! Form::text('country', null, ['class' => 'form-control']) !!}
</div>

<!-- Other Details Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('other_details', 'Other Details:') !!}
    {!! Form::textarea('other_details', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
</div>
