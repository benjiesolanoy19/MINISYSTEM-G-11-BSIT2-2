<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-chevron-left"></i>
    </div>
    
    <div class="sidebar-header">
        <h4><i class="fas fa-laptop-code me-2"></i>CLFMS</h4>
    </div>
    
    <ul class="sidebar-menu">
        <!-- Common Menu Items -->
        <li>
            <a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard Home</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('reservations.create') }}">
                <i class="fas fa-calendar-plus"></i>
                <span>Reserve Laboratory</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('reservations.index') }}">
                <i class="fas fa-list-alt"></i>
                <span>My Reservations</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('logs.timein') }}">
                <i class="fas fa-clock"></i>
                <span>Time In / Out</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('borrowings.create') }}">
                <i class="fas fa-laptop"></i>
                <span>Borrow Equipment</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('borrowings.index') }}">
                <i class="fas fa-clipboard-list"></i>
                <span>My Borrowings</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('incidents.report') }}">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Report Incident</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('incidents.index') }}">
                <i class="fas fa-history"></i>
                <span>My Reports</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('notifications.index') }}">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
        
        <div class="sidebar-divider"></div>
        
        <!-- Staff/Admin Only -->
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
            <div class="sidebar-menu-title">Staff & Admin</div>
            
            <li>
                <a href="{{ route('equipment.index') }}">
                    <i class="fas fa-desktop"></i>
                    <span>Equipment Inventory</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('equipment.create') }}">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Equipment</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('logs.index') }}">
                    <i class="fas fa-clock"></i>
                    <span>Time Logs</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('reports.usage') }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                </a>
            </li>
        @endif
        
        <!-- Admin Only -->
        @if(Auth::user()->role === 'admin')
            <div class="sidebar-divider"></div>
            <div class="sidebar-menu-title">Administrator</div>
            
            <li>
                <a href="{{ route('admin.index') }}">
                    <i class="fas fa-cogs"></i>
                    <span>Admin Panel</span>
                </a>
            </li>
        @endif
        
        <div class="sidebar-divider"></div>
        
        <li>
            <a href="{{ route('profile.index') }}">
                <i class="fas fa-user-cog"></i>
                <span>My Profile</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>
