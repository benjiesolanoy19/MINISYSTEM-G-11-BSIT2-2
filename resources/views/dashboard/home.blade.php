@extends('layouts.dashboard')

@section('title', 'CLFMS Dashboard')

@section('styles')
<style>
.feed-header { text-align: center; margin-bottom: 40px; }
.feed-header h2 { font-weight: 700; color: #1e293b; font-size: 32px; }
.feed-header p { color: #64748b; font-size: 16px; margin-top: 8px; }
.stat-card { border-radius: 20px; border: none; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; overflow: hidden; position: relative; }
.stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); }
.stat-card:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12); }
.stat-card .card-body { padding: 25px; }
.stat-card .stat-icon { width: 60px; height: 60px; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; font-size: 24px; }
.stat-card .stat-value { font-size: 36px; font-weight: 700; color: #1e293b; line-height: 1; }
.stat-card .stat-label { font-size: 14px; color: #64748b; font-weight: 500; margin-top: 5px; }
.card { border: none; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); overflow: hidden; }
.card-header { background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); color: #fff; font-weight: 600; border-radius: 20px 20px 0 0 !important; padding: 18px 20px; border: none; }
.card-body { padding: 0; }
.table { margin-bottom: 0; }
.table thead th { background: #f8fafc; padding: 15px; font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; border: none; border-bottom: 1px solid #e2e8f0; }
.table tbody td { padding: 15px; border: none; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
.table tbody tr:hover { background: #f8fafc; }
.table tbody tr:last-child td { border-bottom: none; }
.badge { padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 12px; }
.btn-timein { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; border-radius: 50px; padding: 20px 40px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); }
.btn-timein:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4); color: white; }
.btn-timeout { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 50px; padding: 20px 40px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); }
.btn-timeout:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4); color: white; }
.empty-state { text-align: center; padding: 40px 20px; color: #64748b; }
.empty-state a { color: #0ea5e9; font-weight: 600; }
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="feed-header">
    <h2>Welcome, {{ auth()->user()->name }}!</h2>
    <p>Here's your activity overview</p>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="row mb-4">
    <div class="col-md-3">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon" style="background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
            <i class="fas fa-calendar-check"></i>
          </div>
          <div class="stat-value">{{ $reservations->count() }}</div>
          <div class="stat-label">Reservations</div>
      </div>
    <div class="col-md-3">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
            <i class="fas fa-laptop"></i>
          </div>
          <div class="stat-value">{{ $borrowings->count() }}</div>
          <div class="stat-label">Borrowings</div>
      </div>
    <div class="col-md-3">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
            <i class="fas fa-clock"></i>
          </div>
          <div class="stat-value">{{ $logs->count() }}</div>
          <div class="stat-label">Time Logs</div>
      </div>
    <div class="col-md-3">
      <div class="card stat-card text-center">
        <div class="card-body">
          <div class="stat-icon" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <div class="stat-value">{{ $incidents->count() }}</div>
          <div class="stat-label">Incidents</div>
      </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-calendar-check me-2"></i> My Reservations
        </div>
        <div class="card-body">
          @if($reservations->count() > 0)
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Lab</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($reservations as $res)
                  <tr>
                    <td>{{ \Carbon\Carbon::parse($res->date)->format('M d, Y') }}</td>
                    <td>{{ $res->time_in }}</td>
                    <td>{{ $res->time_out }}</td>
                    <td>{{ $res->laboratory->name ?? 'N/A' }}</td>
                    <td>
                      @if($res->status === 'approved')
                        <span class="badge bg-success">Approved</span>
                      @elseif($res->status === 'pending')
                        <span class="badge bg-warning">Pending</span>
                      @elseif($res->status === 'completed')
                        <span class="badge bg-info">Completed</span>
                      @else
                        <span class="badge bg-danger">Rejected</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state">
              <p>No reservations yet.</p>
              <a href="{{ route('reservations.create') }}">Make a reservation</a>
            </div>
          @endif
        </div>
    </div>

    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-laptop me-2"></i> My Borrowings
        </div>
        <div class="card-body">
          @if($borrowings->count() > 0)
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Equipment</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($borrowings as $bor)
                  <tr>
                    <td>{{ $bor->equipment->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($bor->borrow_date)->format('M d, Y') }}</td>
                    <td>{{ $bor->return_date ? \Carbon\Carbon::parse($bor->return_date)->format('M d, Y') : '—' }}</td>
                    <td>
                      @if($bor->status === 'returned')
                        <span class="badge bg-success">Returned</span>
                      @elseif($bor->status === 'pending')
                        <span class="badge bg-warning">Pending</span>
                      @elseif($bor->status === 'damaged')
                        <span class="badge bg-danger">Damaged</span>
                      @elseif($bor->status === 'lost')
                        <span class="badge bg-danger">Lost</span>
                      @else
                        <span class="badge bg-primary">Approved</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state">
              <p>No borrowings yet.</p>
              <a href="{{ route('borrowings.create') }}">Borrow equipment</a>
            </div>
          @endif
        </div>
    </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <i class="fas fa-clock me-2"></i> Time In / Time Out
        </div>
        <div class="card-body" style="padding: 30px;">
          <div class="row">
            <div class="col-md-6 text-center">
              <form method="POST" action="{{ route('logs.timein') }}">
                @csrf
                <button type="submit" class="btn btn-timein">
                  <i class="fas fa-sign-in-alt fa-2x d-block mb-2"></i>
                  Time In
                </button>
              </form>
            </div>
            <div class="col-md-6 text-center">
              <form method="POST" action="{{ route('logs.timeout') }}">
                @csrf
                <button type="submit" class="btn btn-timeout">
                  <i class="fas fa-sign-out-alt fa-2x d-block mb-2"></i>
                  Time Out
                </button>
              </form>
            </div>
          @if($logs->count() > 0)
            <div class="table-responsive mt-4">
              <table class="table">
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>Time</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($logs->take(5) as $log)
                  <tr>
                    <td>
                      @if($log->type === 'time_in')
                        <span class="badge bg-success"><i class="fas fa-sign-in-alt me-1"></i> Time In</span>
                      @else
                        <span class="badge bg-danger"><i class="fas fa-sign-out-alt me-1"></i> Time Out</span>
                      @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($log->timestamp)->format('M d, Y - h:i A') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
    </div>
</div>
@endsection
</parameter>
</create_file>
