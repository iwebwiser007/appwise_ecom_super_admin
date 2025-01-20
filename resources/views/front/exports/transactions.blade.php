<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Transaction Id</th>
            <th>Package Name</th>
            <th>Amount</th>
            <th>Payment Method</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{$transaction->id}}</td>
            <td>{{$transaction->transaction_id}}</td>
            <td>{{ $transaction->package_name }}</td>
            <td>{{$transaction->amount}}</td>
            <td>{{$transaction->payment_method}}</td>
        </tr>
        @endforeach
    </tbody>
</table>