@extends('layouts.dashboard')

@section('title', 'Notifications')

@section('styles')
<style>
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
  padding: 30px;
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(16, 185, 129, 0.2);
}

.page-title {
  font-size: 32px;
  font-weight: 700;
  color: white;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 15px;
}

.page-title i {
  font-size: 36px;
  opacity: 0.95;
}

.btn-mark-all-read {
  background: rgba(255, 255, 255, 0.2);
  border: 2px solid white;
  color: white;
  padding: 10px 24px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-mark-all-read:hover {
  background: white;
  color: #10b981;
}

.card {
  border: none;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  border-top: 4px solid #10b981;
}

.notification-item {
  padding: 20px;
  border-bottom: 1px solid #f1f5f9;
  transition: all 0.3s ease;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.notification-item:hover {
  background: #f0fdf4;
}

.notification-item:last-child {
  border-bottom: none;
}

.notification-item.unread {
  background: #f0fdf4;
  border-left: 4px solid #10b981;
  padding-left: 16px;
}

.notification-content {
  flex: 1;
}

.notification-badge-new {
  display: inline-block;
  padding: 6px 12px;
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
  margin-bottom: 8px;
}

.notification-message {
  margin: 0;
  font-size: 15px;
  color: #1e293b;
  line-height: 1.6;
  font-weight: 500;
}

.notification-time {
  font-size: 13px;
  color: #64748b;
  margin-top: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.notification-time i {
  opacity: 0.7;
}

.btn-mark-read {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  border: none;
  color: white;
  padding: 8px 16px;
  border-radius: 8px;
  font-weight: 700;
  font-size: 12px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  white-space: nowrap;
}

.btn-mark-read:hover {
  background: linear-gradient(135deg, #059669 0%, #047857 100%);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
  color: white;
}

.empty-state {
  text-align: center;
  padding: 80px 20px;
  color: #64748b;
}

.empty-state i {
  font-size: 64px;
  color: #d1fae5;
  margin-bottom: 20px;
  opacity: 0.6;
}

.empty-state h4 {
  font-size: 24px;
  font-weight: 700;
  color: #1e293b;
  margin: 20px 0 10px 0;
}

.empty-state p {
  margin-bottom: 10px;
  font-size: 15px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="page-header" data-aos="fade-down" data-aos-duration="600">
    <h1 class="page-title"><i class="fas fa-bell"></i>Notifications</h1>
    @if($notifications->where('is_read', false)->count() > 0)
    <form method="POST" action="{{ route('notifications.readAll') }}">
      @csrf
      <button type="submit" class="btn-mark-all-read"><i class="fas fa-check-double"></i>Mark All as Read</button>
    </form>
    @endif
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <div class="card" data-aos="fade-up" data-aos-duration="700">
    @if($notifications->count() > 0)
        @foreach($notifications as $notification)
        <div class="notification-item {{ $notification->is_read ? '' : 'unread' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
          <div class="notification-content">
            @if(!$notification->is_read)
              <span class="notification-badge-new"><i class="fas fa-star me-1"></i>New</span>
            @endif
            <p class="notification-message">{{ $notification->message }}</p>
            <p class="notification-time">
              <i class="fas fa-clock"></i>
              {{ \Carbon\Carbon::parse($notification->created_at)->format('M d, Y - h:i A') }}
            </p>
          </div>
          @if(!$notification->is_read)
          <form method="POST" action="{{ route('notifications.read', $notification->id) }}" style="margin-left: 20px;">
            @csrf
            <button type="submit" class="btn-mark-read"><i class="fas fa-check"></i>Mark Read</button>
          </form>
          @endif
        </div>
        @endforeach
    @else
        <div class="empty-state">
          <i class="fas fa-inbox"></i>
          <h4>No Notifications</h4>
          <p>You're all caught up! No new notifications at this time.</p>
        </div>
    @endif
  </div>
</div>
@endsection
</parameter>
</create_file>
