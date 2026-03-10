<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'CLFMS Dashboard')</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

:root {
  --sidebar-width: 270px;
  --sidebar-collapsed: 80px;
  --primary: #0ea5e9;
  --primary-dark: #0284c7;
  --primary-light: #38bdf8;
  --secondary: #10b981;
  --success: #10b981;
  --warning: #f59e0b;
  --danger: #ef4444;
  --info: #3b82f6;
  --dark: #1f2937;
  --light-bg: #f3f4f6;
  --card-bg: #ffffff;
  --text-muted: #9ca3af;
  --border-color: #e5e7eb;
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  background-color: var(--light-bg);
  overflow-x: hidden;
  color: var(--dark);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* Modern Navbar */
.navbar {
  background: rgba(255, 255, 255, 0.95) !important;
  backdrop-filter: blur(20px);
  box-shadow: var(--shadow-sm);
  padding: 12px 0;
  border-bottom: 1px solid var(--border-color);
}

.navbar-brand {
  font-size: 1.5rem;
  font-weight: 800;
  background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: -0.5px;
}

.navbar-actions {
  display: flex;
  align-items: center;
  gap: 15px;
}

.notification-btn {
  position: relative;
  width: 40px;
  height: 40px;
  border-radius: 10px;
  background: var(--light-bg);
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  color: var(--dark);
}

.notification-btn:hover {
  background: var(--primary);
  color: white;
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}

.notification-badge {
  position: absolute;
  top: -5px;
  right: -5px;
  background: var(--danger);
  color: white;
  border-radius: 50%;
  font-size: 10px;
  font-weight: 600;
  min-width: 18px;
  height: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}

.user-menu {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 6px 12px 6px 6px;
  border-radius: 50px;
  background: var(--light-bg);
  cursor: pointer;
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.user-menu:hover {
  border-color: var(--primary);
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}

.user-avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 600;
  font-size: 14px;
}

.user-name {
  font-weight: 500;
  font-size: 14px;
  color: var(--dark);
}

.user-role {
  font-size: 11px;
  color: var(--text-muted);
  text-transform: capitalize;
}

/* Modern Sidebar */
.sidebar {
  position: fixed;
  top: 60px;
  left: 0;
  height: calc(100vh - 60px);
  width: var(--sidebar-width);
  background: linear-gradient(180deg, #1e1e2d 0%, #1a1a2e 100%);
  color: #fff;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  overflow-y: auto;
  overflow-x: hidden;
  z-index: 1000;
  box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
}

.sidebar::-webkit-scrollbar {
  width: 4px;
}

.sidebar::-webkit-scrollbar-track {
  background: transparent;
}

.sidebar::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.2);
  border-radius: 4px;
}

.sidebar.collapsed {
  width: var(--sidebar-collapsed);
}

.sidebar-header {
  padding: 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.sidebar-header h4 {
  font-size: 14px;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.7);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.toggle-btn {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  background: rgba(255, 255, 255, 0.1);
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  transition: all 0.3s ease;
}

.toggle-btn:hover {
  background: var(--primary);
  transform: rotate(180deg);
}

.sidebar-menu {
  padding: 15px 10px;
}

.menu-section {
  margin-bottom: 20px;
}

.menu-section-title {
  font-size: 11px;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.4);
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 0 15px;
  margin-bottom: 10px;
}

.sidebar.collapsed .menu-section-title {
  display: none;
}

.menu-item {
  display: flex;
  align-items: center;
  padding: 12px 15px;
  border-radius: 12px;
  text-decoration: none;
  color: rgba(255, 255, 255, 0.7);
  transition: all 0.3s ease;
  margin-bottom: 5px;
  position: relative;
  overflow: hidden;
}

.menu-item::before {
  content: '';
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 0;
  height: 0;
  background: var(--primary);
  border-radius: 0 4px 4px 0;
  transition: all 0.3s ease;
  height: 0;
}

.menu-item:hover {
  background: rgba(255, 255, 255, 0.1);
  color: white;
  transform: translateX(5px);
}

.menu-item:hover::before {
  height: 100%;
  width: 4px;
}

.menu-item.active {
  background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
  color: white;
  box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
  transform: translateX(5px);
}

.menu-item.active::before {
  display: none;
}

.menu-icon {
  width: 24px;
  height: 24px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  min-width: 24px;
}

.menu-text {
  font-size: 14px;
  font-weight: 500;
  margin-left: 12px;
  white-space: nowrap;
  opacity: 1;
  transition: opacity 0.3s ease;
}

.sidebar.collapsed .menu-text {
  opacity: 0;
  width: 0;
}

.menu-badge {
  margin-left: auto;
  background: var(--danger);
  color: white;
  font-size: 10px;
  font-weight: 600;
  padding: 2px 8px;
  border-radius: 20px;
  min-width: 20px;
  text-align: center;
}

.sidebar.collapsed .menu-badge {
  display: none;
}

.menu-divider {
  height: 1px;
  background: rgba(255, 255, 255, 0.1);
  margin: 15px 0;
}

/* Main Content */
.main-content {
  margin-left: var(--sidebar-width);
  padding: 30px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  min-height: calc(100vh - 60px);
  background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
}

.main-content.expanded {
  margin-left: var(--sidebar-collapsed);
}

/* Modern Cards */
.dashboard-card {
  background: var(--card-bg);
  border-radius: 20px;
  border: 1px solid var(--border-color);
  box-shadow: var(--shadow-sm);
  transition: all 0.4s ease;
  overflow: hidden;
  position: relative;
}

.dashboard-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
  transform: scaleX(0);
  transition: transform 0.4s ease;
}

.dashboard-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-xl);
}

.dashboard-card:hover::before {
  transform: scaleX(1);
}

.dashboard-card .card-body {
  padding: 25px;
}

/* Stats Cards */
.stat-card {
  position: relative;
  overflow: hidden;
}

.stat-card .stat-icon {
  width: 60px;
  height: 60px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  margin-bottom: 15px;
}

.stat-card .stat-value {
  font-size: 32px;
  font-weight: 700;
  color: var(--dark);
  line-height: 1;
  margin-bottom: 5px;
}

.stat-card .stat-label {
  font-size: 14px;
  color: var(--text-muted);
  font-weight: 500;
}

.stat-card .stat-change {
  position: absolute;
  top: 20px;
  right: 20px;
  font-size: 12px;
  font-weight: 600;
  padding: 4px 10px;
  border-radius: 20px;
}

.stat-card .stat-change.positive {
  background: rgba(16, 185, 129, 0.1);
  color: var(--success);
}

.stat-card .stat-change.negative {
  background: rgba(239, 68, 68, 0.1);
  color: var(--danger);
}

/* Modern Buttons */
.btn-modern {
  padding: 12px 24px;
  border-radius: 12px;
  font-weight: 600;
  font-size: 14px;
  transition: all 0.3s ease;
  border: none;
  position: relative;
  overflow: hidden;
}

.btn-modern::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  transition: left 0.5s ease;
}

.btn-modern:hover::before {
  left: 100%;
}

.btn-modern-primary {
  background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
  color: white;
  box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-modern-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
  color: white;
}

.btn-modern-outline {
  background: transparent;
  border: 2px solid var(--primary);
  color: var(--primary);
}

.btn-modern-outline:hover {
  background: var(--primary);
  color: white;
  transform: translateY(-2px);
}

/* Modern Tables */
.table-modern {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
}

.table-modern thead th {
  background: var(--light-bg);
  padding: 15px;
  font-weight: 600;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: var(--text-muted);
  border: none;
  position: sticky;
  top: 0;
}

.table-modern tbody tr {
  transition: all 0.3s ease;
}

.table-modern tbody tr:hover {
  background: rgba(102, 126, 234, 0.05);
}

.table-modern tbody td {
  padding: 15px;
  border: none;
  border-bottom: 1px solid var(--border-color);
  vertical-align: middle;
}

.table-modern tbody tr:last-child td {
  border-bottom: none;
}

/* Modern Badges */
.badge-modern {
  padding: 6px 14px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  text-transform: capitalize;
}

.badge-pending { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
.badge-approved { background: rgba(16, 185, 129, 0.1); color: var(--success); }
.badge-rejected { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
.badge-completed { background: rgba(59, 130, 246, 0.1); color: var(--info); }
.badge-active { background: rgba(16, 185, 129, 0.1); color: var(--success); }

/* Page Header */
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 30px;
}

.page-title {
  font-size: 28px;
  font-weight: 700;
  color: var(--dark);
  margin: 0;
}

.page-subtitle {
  font-size: 14px;
  color: var(--text-muted);
  margin-top: 5px;
}

/* Animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeInLeft {
  from {
    opacity: 0;
    transform: translateX(-20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.5s ease forwards;
}

.animate-fade-in-left {
  animation: fadeInLeft 0.5s ease forwards;
}

.animate-delay-1 { animation-delay: 0.1s; }
.animate-delay-2 { animation-delay: 0.2s; }
.animate-delay-3 { animation-delay: 0.3s; }
.animate-delay-4 { animation-delay: 0.4s; }

/* Dropdown Menu */
.dropdown-menu-modern {
  border: none;
  border-radius: 16px;
  box-shadow: var(--shadow-xl);
  padding: 10px;
  min-width: 200px;
}

.dropdown-menu-modern .dropdown-item {
  border-radius: 10px;
  padding: 10px 15px;
  font-weight: 500;
  transition: all 0.3s ease;
}

.dropdown-menu-modern .dropdown-item:hover {
  background: rgba(102, 126, 234, 0.1);
  color: var(--primary);
}

.dropdown-menu-modern .dropdown-divider {
  margin: 5px 0;
  border-color: var(--border-color);
}

/* Footer */
.dashboard-footer {
  text-align: center;
  padding: 20px;
  color: var(--text-muted);
  font-size: 13px;
  border-top: 1px solid var(--border-color);
  margin-top: 40px;
  background: var(--card-bg);
  border-radius: 20px;
  margin-left: 0;
  margin-right: 0;
}

/* Responsive */
@media (max-width: 992px) {
  .sidebar {
    transform: translateX(-100%);
  }
  
  .sidebar.show {
    transform: translateX(0);
  }
  
  .main-content {
    margin-left: 0;
  }
  
  .page-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
  }
}
</style>

@yield('styles')
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid px-4">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <i class="fas fa-layer-group me-2"></i>CLFMS
    </a>
    
    <button class="navbar-toggler border-0" type="button" id="mobileToggle">
      <i class="fas fa-bars"></i>
    </button>
    
    <div class="navbar-actions">
      <button class="notification-btn" onclick="window.location.href='{{ route('notifications.list') }}'">
        <i class="fas fa-bell"></i>
        @php
          $unreadCount = \App\Models\Notification::where('user_id', auth()->id())->where('is_read', false)->count();
        @endphp
        @if($unreadCount > 0)
          <span class="notification-badge">{{ $unreadCount }}</span>
        @endif
      </button>
      
      <div class="dropdown">
        <div class="user-menu" data-bs-toggle="dropdown">
          <div class="user-avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
          </div>
          <div class="d-none d-md-block">
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-role">{{ auth()->user()->role }}</div>
          </div>
          <i class="fas fa-chevron-down ms-2" style="font-size: 10px; color: var(--text-muted);"></i>
        </div>
        <ul class="dropdown-menu dropdown-menu-modern dropdown-menu-end">
<li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user me-2"></i>My Profile</a></li>
          <li><a class="dropdown-item" href="{{ route('notifications.list') }}"><i class="fas fa-bell me-2"></i>Notifications</a></li>
          @if(auth()->user()->role === 'admin')
          <li><a class="dropdown-item" href="{{ route('admin.index') }}"><i class="fas fa-cog me-2"></i>Admin Panel</a></li>
          @endif
          <li><hr class="dropdown-divider"></li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <h4>Menu</h4>
    <button class="toggle-btn" id="sidebarToggle">
      <i class="fas fa-chevron-left"></i>
    </button>
  </div>
  
  <div class="sidebar-menu">
    <div class="menu-section">
      <div class="menu-section-title">Main</div>
      
      <a href="{{ route('dashboard.home') }}" class="menu-item {{ request()->routeIs('dashboard.home') ? 'active' : '' }}">
        <i class="menu-icon fas fa-home"></i>
        <span class="menu-text">Dashboard</span>
      </a>
      
      <a href="{{ route('reservations.create') }}" class="menu-item {{ request()->routeIs('reservations.create') ? 'active' : '' }}">
        <i class="menu-icon fas fa-calendar-plus"></i>
        <span class="menu-text">New Reservation</span>
      </a>
      
      <a href="{{ route('reservations.list') }}" class="menu-item {{ request()->routeIs('reservations.list') ? 'active' : '' }}">
        <i class="menu-icon fas fa-calendar-check"></i>
        <span class="menu-text">My Reservations</span>
      </a>
      
      <a href="{{ route('borrowings.create') }}" class="menu-item {{ request()->routeIs('borrowings.create') ? 'active' : '' }}">
        <i class="menu-icon fas fa-laptop"></i>
        <span class="menu-text">Borrow Equipment</span>
      </a>
      
      <a href="{{ route('borrowings.list') }}" class="menu-item {{ request()->routeIs('borrowings.list') ? 'active' : '' }}">
        <i class="menu-icon fas fa-clipboard-list"></i>
        <span class="menu-text">My Borrowings</span>
      </a>
      
      <a href="{{ route('logs.list') }}" class="menu-item {{ request()->routeIs('logs.list') ? 'active' : '' }}">
        <i class="menu-icon fas fa-clock"></i>
        <span class="menu-text">Time Logs</span>
      </a>
    </div>
    
    <div class="menu-section">
      <div class="menu-section-title">Support</div>
      
      <a href="{{ route('incidents.report') }}" class="menu-item {{ request()->routeIs('incidents.report') ? 'active' : '' }}">
        <i class="menu-icon fas fa-exclamation-triangle"></i>
        <span class="menu-text">Report Issue</span>
      </a>
      
      <a href="{{ route('incidents.list') }}" class="menu-item {{ request()->routeIs('incidents.list') ? 'active' : '' }}">
        <i class="menu-icon fas fa-list"></i>
        <span class="menu-text">My Reports</span>
      </a>
    </div>

    <!-- Staff/Admin -->
    @if(auth()->user()->role === 'staff' || auth()->user()->role === 'admin')
      <div class="menu-divider"></div>
      
      <div class="menu-section">
        <div class="menu-section-title">Management</div>
        
        <a href="{{ route('equipment.index') }}" class="menu-item {{ request()->routeIs('equipment.*') ? 'active' : '' }}">
          <i class="menu-icon fas fa-boxes-stacked"></i>
          <span class="menu-text">Equipment</span>
        </a>

        <a href="{{ route('borrowings.manage') }}" class="menu-item {{ request()->routeIs('borrowings.manage') ? 'active' : '' }}">
          <i class="menu-icon fas fa-clipboard-check"></i>
          <span class="menu-text">Borrow Requests</span>
        </a>

        <a href="{{ route('reservations.manage') }}" class="menu-item {{ request()->routeIs('reservations.manage') ? 'active' : '' }}">
          <i class="menu-icon fas fa-calendar"></i>
          <span class="menu-text">Reservation Requests</span>
        </a>

        <a href="{{ route('incidents.manage') }}" class="menu-item {{ request()->routeIs('incidents.manage') ? 'active' : '' }}">
          <i class="menu-icon fas fa-file-circle-exclamation"></i>
          <span class="menu-text">Incident Reports</span>
        </a>
      </div>
    @endif

    <!-- Admin Only -->
    @if(auth()->user()->role === 'admin')
      <div class="menu-divider"></div>
      
      <div class="menu-section">
        <div class="menu-section-title">Administration</div>

        <a href="{{ route('admin.users') }}" class="menu-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
          <i class="menu-icon fas fa-users"></i>
          <span class="menu-text">User Management</span>
        </a>

        <a href="{{ route('admin.index') }}" class="menu-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
          <i class="menu-icon fas fa-cogs"></i>
          <span class="menu-text">Settings</span>
        </a>
      </div>
    @endif
  </div>
</div>

<!-- Main Content -->
<div class="main-content" id="mainContent">
  @yield('content')
  
  <footer class="dashboard-footer">
    © 2026 CLFMS | Computer Laboratory Facilities Management System
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const toggleBtn = document.getElementById('sidebarToggle');
const mobileToggle = document.getElementById('mobileToggle');

if (toggleBtn) {
  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
    const icon = toggleBtn.querySelector('i');
    if (sidebar.classList.contains('collapsed')) {
      icon.classList.remove('fa-chevron-left');
      icon.classList.add('fa-chevron-right');
    } else {
      icon.classList.remove('fa-chevron-right');
      icon.classList.add('fa-chevron-left');
    }
  });
}

if (mobileToggle) {
  mobileToggle.addEventListener('click', () => {
    sidebar.classList.toggle('show');
  });
}

// Add animation classes on load
document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.dashboard-card');
  cards.forEach((card, index) => {
    card.classList.add('animate-fade-in-up');
    card.style.animationDelay = `${index * 0.1}s`;
  });
});
</script>

@yield('scripts')

</body>
</html>
