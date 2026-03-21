@extends('layouts.dashboard')

@section('title', 'Inventory Report')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <h1 class="page-title">Inventory Report</h1>
  </div>

  <div class="card">
    <div class="card-header">
      <i class="fas fa-boxes me-2"></i>Equipment Inventory
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Total Quantity</th>
            <th>Available</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($equipment as $item)
          <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->quantity ?? 0 }}</td>
            <td>{{ $item->available_quantity ?? 0 }}</td>
            <td>
              @if(($item->available_quantity ?? 0) > 0)
                <span class="badge bg-success">Available</span>
              @else
                <span class="badge bg-danger">Out of Stock</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

