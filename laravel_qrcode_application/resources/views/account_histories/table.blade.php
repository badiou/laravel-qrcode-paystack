<div class="table-responsive">
    <table class="table" id="accountHistories-table">
        <thead>
            <tr>
                <th>N°Compte</th>
                <th>Nom utilisateur</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accountHistories as $accountHistories)
            <tr>
            <td>{!! $accountHistories->account_id !!}</td>
            <td>{!! $accountHistories->user['name']!!}</td>
            <td>{!! $accountHistories->user['email']!!}</td>
            <td>{!! $accountHistories->message !!}</td>
            <td>{!! $accountHistories->created_at->format('d/m/Y h:i:s') !!}</td>

                
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
