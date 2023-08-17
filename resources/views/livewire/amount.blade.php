<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Full Name</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($amounts as $key => $wallet)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $wallet->full_name }}</td>
            <td>{{ $wallet->total_amount }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
