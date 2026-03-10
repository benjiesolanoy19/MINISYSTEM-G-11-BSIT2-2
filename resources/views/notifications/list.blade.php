@extends('layouts.dashboard')

@section('title', 'Notifications')

@section('styles')
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
}

.page-title {
  font-size: 28px;
  font-weight: 700;
  color: #1e293b;
  margin: 0;
}

.btn-outline-primary {
  border: 2px solid #0ea5e9;
  color: #0ea5e9;
  padding: 8px 16px;
  border-radius: 10px;
  font-weight: 600;
  background: transparent;
  transition: all 0.3s ease;
}

.btn-outline-primary:hover {
  background: #0ea5e9;
  color: white;
}

.card {
  border: none;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
}

.notification-item {
  padding: 20px;
  border-bottom: 1px solid #f1f5f9;
  transition: all 0.3s ease;
}

.notification-item:hover {
  background: #f8fafc;
}

.notification-item:last-child {
  border-bottom: none;
}

.notification-item.unread {
  background: #f0f9ff;
}

.notification-badge-new {
  display: inline-block;
  padding: 4px 10px;
  background: #0ea5e9;
  color: white;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 600;
  margin-right: 8px;
}

.notification-message {
  margin: 0;
  font-size: 14px;
  color: #374151;
  line-height: 1.5;
}

.notification-time {
  font-size: 12px;
  color: #9ca3af;
  margin-top: 8px;
}

.btn-mark-read {
  border: 2px solid #10b981;
  color: #10b981;
  padding: 6px 14px;
  border-radius: 8px;
  font-weight: 600;
  background: transparent;
  transition: all 0.3s ease;
  font-size: 12px;
}

.btn-mark-read:hover {
  background: #10b981;
  color: white;
}

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: #64748b;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <h1 class="page-title">Notifications</h1>
    @if($notifications->where('is_read', false)->count() > 0)
    <form method="POST" action="{{ route('notifications.readAll') }}">
      @csrf
      <button type="submit" class="btn btn-outline-primary">Mark All as Read</button>
    </form>
    @endif
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card">
    <div class="card-body" style="padding: 0;">
      @if($notifications->count() > 0)
        @foreach($notifications as $notification)
        <div class="notification-item {{ $notification->is_read ? '' : 'unread' }}">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              @if(!$notification->is_read)
                <span class="notification-badge-new">New</span>
              @endif
              <p class="notification-message">{{ $notification->message }}</p>
              <p class="notification-time">{{ \Carbon\Carbon::parse($notification->created_at)->format('M d, Y - h:i A') }}</p>
            </div>
            @if(!$notification->is_read)
            <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
              @csrf
              <button type="submit" class="btn-mark-read">Mark as Read</button>
            </form>
            @endif
          </div>
        @endforeach
      @else
        <div class="empty-state">
          <p>No notifications.</p>
        </div>
      @endif
    </div>
</div>
@endsection
</parameter>
</create_file>
