<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Equipment</title>
</head>
<body>
<h1>Admin - Equipment (read-only placeholder)</h1>
<p>This UI is a placeholder. Full CRUD should be implemented as part of the next step.</p>

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Total</th>
        <th>Available</th>
    </tr>
    </thead>
    <tbody>
    @foreach($equipment as $e)
        <tr>
            <td>{{ $e->id }}</td>
            <td>{{ $e->name }}</td>
            <td>{{ $e->description }}</td>
            <td>{{ $e->total_quantity ?? $e->quantity ?? '-' }}</td>
            <td>{{ $e->available_quantity }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

