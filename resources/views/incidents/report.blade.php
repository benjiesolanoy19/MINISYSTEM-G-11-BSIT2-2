@extends('layouts.dashboard')

@section('title', 'Report Incident')

@section('content')
<div class="container-fluid">
  <h2 class="mb-4">Report an Incident</h2>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card" style="border-radius: 15px; box-shadow: 0 6px 20px rgba(0,0,0,0.08);">
    <div class="card-body">
      <form method="POST" action="{{ route('incidents.store') }}">
        @csrf
        
        <div class="mb-3">
          <label for="equipment_id" class="form-label">Related Equipment (Optional)</label>
          <select name="equipment_id" id="equipment_id" class="form-select">
            <option value="">Select Equipment</option>
            @foreach($equipment as $item)
              <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->category }})</option>
            @endforeach
          </select>
        </div>
        
        <div class="mb-3">
          <label for="description" class="form-label">Incident Description</label>
          <textarea name="description" id="description" class="form-control" rows="5" placeholder="Describe the incident in detail" required></textarea>
        </div>
        
        <div class="mb-3">
          <label for="severity" class="form-label">Severity</label>
          <select name="severity" id="severity" class="form-select" required>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
            <option value="critical">Critical</option>
          </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit Report</button>
        <a href="{{ route('dashboard.home') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</div>
@endsection
