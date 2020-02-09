<div class="table-responsive">
    <table class="table" id="transactions-table">
        <thead>
            <tr>
                <th>Nom du produit</th>
                <th>Nom de l'acheteur</th>
                <th>Méthode de paiement</th>
                <th>Montant</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td><a href="/qrcodes/{!! $transaction->qrcode['id'] !!}" class="text-info h5">{!! $transaction->qrcode['product_name'] !!} par {!!$transaction->user['name']!!}</a></td>
                <td><a href="/users/{!!$transaction->user['id']!!}">{!! $transaction->user['name']!!}
                </a>|
                <small>{{$transaction->created_at->format('d/m/Y h:m:s')}}</small>
            </td>
                <td>{!! $transaction->payment_method !!}</td>
                <td>{!! number_format($transaction->amount) !!} (XOF)</td>
                <td>{!! $transaction->status !!}<br/>
                    <small>{{$transaction->updated_at->format('d/m/Y h:m:s')}}</small>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
