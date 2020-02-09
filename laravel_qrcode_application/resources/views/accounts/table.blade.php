<div class="table-responsive">
    <table class="table" id="accounts-table">
        <thead>
            <tr>
            <th>Utilisateur</th>
            <th>Balance (XOF)</th>
            <th>Total Crédit (XOF)</th>
            <th>Total Débit (XOF)</th>
            <th>Status</th>
            <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
            <td><a href="{!! route('accounts.show', [$account->id]) !!}" class='text-info'><b>{!! $account->user['name'] !!} | {!! $account->user['email'] !!}</b> </a></td>
            <td>{!! number_format($account->balance) !!} (XOF)</td>
            <td>{!! number_format($account->total_credit) !!} (XOF)</td>
            <td>{!! number_format($account->total_debit) !!} (XOF)</td>
            <td>
                @if($account->applied_for_payout==1)
                    Paiement en attente
                    @elseif ($account->paid==1)
                        Paiement effectuée
                @endif
            </td>
                <td>
                    {!! Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('accounts.edit', [$account->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
