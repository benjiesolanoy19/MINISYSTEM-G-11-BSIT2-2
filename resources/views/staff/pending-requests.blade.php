<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pending Borrow Requests</title>
</head>
<body>
<h1>Pending Borrow Requests</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
@if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
    <tr>
        <th>Student</th>
        <th>Equipment</th>
        <th>Quantity</th>
        <th>Requested At</th>
        <th>Available</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requests as $r)
        <tr>
            <td>{{ $r->student->name }}</td>
            <td>{{ $r->equipment->name }}</td>
            <td>{{ $r->quantity }}</td>
            <td>{{ $r->request_date }}</td>
            <td>{{ $r->equipment->available_quantity }}</td>
            <td>
                <form method="POST" action="{{ route('staff.approve', ['request_id' => $r->id]) }}" style="display:inline-block;">
                    @csrf
                    <button type="submit">Approve</button>
                </form>
                <form method="POST" action="{{ route('staff.reject', ['request_id' => $r->id]) }}" style="display:inline-block; margin-left:8px;">
                    @csrf
                    <button type="submit">Reject</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

