@extends('layouts.dashboard')

@section('title', 'Make Reservation')

@section('styles')
<style>
.page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; }
.page-title { font-size: 28px; font-weight: 700; color: #1e293b; margin: 0; }
.lab-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); transition: all 0.3s ease; height: 100%; }
.lab-card:hover { transform: translateY(-5px); box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12); }
.lab-card img { width: 100%; height: 180px; object-fit: cover; }
.lab-card .card-body { padding: 20px; }
.lab-card h5 { font-size: 18px; font-weight: 600; color: #1e293b; margin-bottom: 10px; }
.lab-badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; margin-right: 5px; margin-bottom: 5px; }
.badge-building { background: #e0f2fe; color: #0284c7; }
.badge-floor { background: #f0fdf4; color: #16a34a; }
.badge-capacity { background: #fef3c7; color: #d97706; }
.lab-card p { color: #64748b; font-size: 14px; line-height: 1.5; margin-bottom: 15px; }
.btn-reserve { background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; color: white; transition: all 0.3s ease; width: 100%; }
.btn-reserve:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3); color: white; }
.modal-header { background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); color: white; border-radius: 0; }
.modal-header .btn-close { filter: invert(1); }
.modal-title { font-weight: 600; }
.form-label { font-weight: 600; color: #374151; margin-bottom: 8px; }
.form-control { border: 2px solid #e5e7eb; border-radius: 10px; padding: 12px 16px; }
.form-control:focus { border-color: #0ea5e9; box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1); }
.empty-state { text-align: center; padding: 60px 20px; color: #64748b; }
.empty-state i { font-size: 48px; margin-bottom: 15px; color: #cbd5e1; }
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <h1 class="page-title">Make a Reservation</h1>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      @foreach($errors->all() as $error)
        {{ $error }}
      @endforeach
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if($laboratories->isEmpty())
    <div class="empty-state">
      <i class="fas fa-door-closed"></i>
      <h4>No Laboratories Available</h4>
      <p>There are no laboratories available for reservation at the moment.</p>
    </div>
  @else
    <div class="row">
      @foreach($laboratories as $lab)
      <div class="col-md-6 mb-4">
        <div class="lab-card">
          <img src="https://images.unsplash.com/photo-1517502884422-41eaead166d4?w=600&h=250&fit=crop" class="card-img-top" alt="{{ $lab->name }}">
          <div class="card-body">
            <h5>{{ $lab->name }}</h5>
            <div class="mb-2">
              <span class="lab-badge badge-building"><i class="fas fa-building me-1"></i>{{ $lab->building }}</span>
              <span class="lab-badge badge-floor"><i class="fas fa-layer-group me-1"></i>Floor {{ $lab->floor }}</span>
              <span class="lab-badge badge-capacity"><i class="fas fa-users me-1"></i>{{ $lab->capacity }} seats</span>
            </div>
            <p>{{ $lab->description ?? 'Laboratory room for computer and research activities.' }}</p>
            <button type="button" class="btn-reserve" data-bs-toggle="modal" data-bs-target="#reservationModal{{ $lab->id }}">
              <i class="fas fa-calendar-plus me-2"></i>Reserve This Room
            </button>
          </div>
      </div>

      <div class="modal fade" id="reservationModal{{ $lab->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Reserve {{ $lab->name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('reservations.store') }}">
              @csrf
              <div class="modal-body">
                <input type="hidden" name="laboratory_id" value="{{ $lab->id }}">
                <div class="mb-3">
                  <label class="form-label">Laboratory</label>
                  <input type="text" class="form-control" value="{{ $lab->name }} ({{ $lab->building }}, Floor {{ $lab->floor }})" readonly>
                </div>
                <div class="mb-3">
                  <label class="form-label">Date</label>
                  <input type="date" name="date" class="form-control" required min="{{ date('Y-m-d') }}">
                </div>
                <div class="row">
                  <div class="col-6 mb-3">
                    <label class="form-label">Time In</label>
                    <input type="time" name="time_in" class="form-control" required>
                  </div>
                  <div class="col-6 mb-3">
                    <label class="form-label">Time Out</label>
                    <input type="time" name="time_out" class="form-control" required>
                  </div>
                <div class="mb-3">
                  <label class="form-label">Purpose</label>
                  <textarea name="purpose" class="form-control" rows="2" placeholder="Enter purpose of reservation"></textarea>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit Reservation</button>
              </div>
            </form>
          </div>
      </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
</parameter>
</create_file>
