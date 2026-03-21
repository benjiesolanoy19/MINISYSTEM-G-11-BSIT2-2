@extends('layouts.dashboard')

@section('title', 'Usage Report')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <h1 class="page-title">Usage Report</h1>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-calendar-check me-2"></i>Reservations by Lab
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>Laboratory</th>
                <th>Reservations</th>
              </tr>
            </thead>
            <tbody>
@foreach($reservations_by_lab as $labId => $count)
              <tr>
                <td>Lab {{ $labId }}</td>
                <td>{{ $count }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-laptop me-2"></i>Borrowings by Equipment
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>Equipment</th>
                <th>Borrowings</th>
              </tr>
            </thead>
            <tbody>
@foreach($borrowings_by_equipment as $equipId => $count)
              <tr>
                <td>Equipment {{ $equipId }}</td>
                <td>{{ $count }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-chart-line me-2"></i>User Activity
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>User</th>
                <th>Log Entries</th>
              </tr>
            </thead>
            <tbody>
@foreach($user_activity as $activity)
              <tr>
                <td>{{ $activity->user->name ?? 'User ' . $activity->user_id }}</td>
                <td>{{ $activity->logs_count }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

