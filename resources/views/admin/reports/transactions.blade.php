@extends('layouts.dashboard')

@section('title', 'Transactions Report')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <h1 class="page-title">Transactions Report</h1>
  </div>

  <div class="card">
    <div class="card-header">
      <i class="fas fa-exchange-alt me-2"></i>Borrowing Transactions
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>User</th>
              <th>Equipment</th>
              <th>Borrow Date</th>
              <th>Return Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactions as $transaction)
            <tr>
              <td>{{ $transaction->user->name ?? 'N/A' }}</td>
              <td>{{ $transaction->equipment->name ?? 'N/A' }}</td>
              <td>{{ $transaction->borrow_date ? \Carbon\Carbon::parse($transaction->borrow_date)->format('M d, Y') : 'N/A' }}</td>
              <td>{{ $transaction->return_date ? \Carbon\Carbon::parse($transaction->return_date)->format('M d, Y') : 'N/A' }}</td>
              <td>
                @switch($transaction->status)
                  @case('pending')
                    <span class="badge bg-warning">Pending</span>
                    @break
                  @case('approved')
                    <span class="badge bg-success">Approved</span>
                    @break
                  @case('returned')
                    <span class="badge bg-info">Returned</span>
                    @break
                  @default
                    <span class="badge bg-secondary">{{ ucfirst($transaction->status) }}</span>
                @endswitch
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

