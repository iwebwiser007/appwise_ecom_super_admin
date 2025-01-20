<table>
    <thead>
        <tr>
            <th>Order Id</th>
            <th>Order Date</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Order Amount</th>
            <th>Order Status</th>
            <th>Payment Method</th>
        </tr>
    </thead>
    <tbody>
        @foreach($salesData as $sale)
        <tr>
            <td>{{ $sale->id }}</td>
            <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('d-m-Y') }}</td>
            <td>{{ $sale->name }}</td>
            <td>{{ $sale->email }}</td>
            <td>{{ $sale->grand_total }}</td>
            <td>{{ $sale->order_status }}</td>
            <td>{{ $sale->payment_method }}</td>
        </tr>
        @endforeach
    </tbody>
</table>