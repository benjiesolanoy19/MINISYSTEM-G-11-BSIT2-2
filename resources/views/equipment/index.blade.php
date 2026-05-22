<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Available Equipment</title>
</head>
<body>
<h1>Available Equipment</h1>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
@if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Available</th>
            <th>Request</th>
        </tr>
    </thead>
    <tbody>
    @foreach($equipment as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->available_quantity }}</td>
            <td>
                <form method="POST" action="{{ route('borrow.create') }}">
                    @csrf
                    <input type="hidden" name="equipment_id" value="{{ $item->id }}">
                    <label>Qty</label>
                    <input type="number" name="quantity" min="1" max="{{ $item->available_quantity }}" value="1" required>
                    <button type="submit">Borrow</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

