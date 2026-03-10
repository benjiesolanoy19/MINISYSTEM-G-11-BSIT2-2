@extends('layouts.dashboard')

@section('title', 'Add Equipment')

@section('content')
<div class="container-fluid">
  <h2 class="mb-4">Add Equipment</h2>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card" style="border-radius: 15px; box-shadow: 0 6px 20px rgba(0,0,0,0.08);">
    <div class="card-body">
      <form method="POST" action="{{ route('equipment.store') }}">
        @csrf
        
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Equipment Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
          
          <div class="col-md-6 mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-select" required>
              <option value="">Select Category</option>
              <option value="Computer">Computer</option>
              <option value="Projector">Projector</option>
              <option value="Keyboard">Keyboard</option>
              <option value="Mouse">Mouse</option>
              <option value="Headset">Headset</option>
              <option value="Other">Other</option>
            </select>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
          </div>
          
          <div class="col-md-6 mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
              <option value="available">Available</option>
              <option value="borrowed">Borrowed</option>
              <option value="maintenance">Maintenance</option>
            </select>
          </div>
        </div>
        
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" id="description" class="form-control" rows="3" placeholder="Equipment description"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Add Equipment</button>
        <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
</div>
@endsection
