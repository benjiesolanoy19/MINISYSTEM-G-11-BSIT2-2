<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Borrow Requests</title>
</head>
<body>
<h1>All Borrow Requests</h1>

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
        <th>Qty</th>
        <th>Status</th>
        <th>Requested</th>
        <th>Approved At</th>
        <th>Approved By</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requests as $r)
        <tr>
            <td>{{ $r->student->name }}</td>
            <td>{{ $r->equipment->name }}</td>
            <td>{{ $r->quantity }}</td>
            <td>{{ $r->status }}</td>
            <td>{{ $r->request_date }}</td>
            <td>{{ $r->approval_date }}</td>
            <td>{{ optional($r->approvedBy)->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

