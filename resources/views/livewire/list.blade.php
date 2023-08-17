<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Full Name</th>
            <th>Order ID</th>
            <th>Amount</th>
            <th>Create</th>
        </tr>
    </thead>
    <tbody>
        @foreach($wallets as $key => $wallet)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $wallet->full_name }}</td>
            <td>{{ $wallet->order_id }}</td>
            <td>{{ $wallet->amount }}</td>
            <td>{{ $wallet->timestamp }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
