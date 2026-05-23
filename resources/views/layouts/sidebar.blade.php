<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-toggle-wrap" aria-hidden="false">
        <button type="button" class="sidebar-toggle" id="sidebarToggle" title="Toggle sidebar" aria-label="Toggle sidebar" aria-controls="mainContent" aria-expanded="false">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>

    <div class="sidebar-header">
        <h4><i class="fas fa-laptop-code me-2"></i>ICTFE</h4>
        <p class="sidebar-subtitle">ICT Facilities Management</p>
    </div>

    <div class="sidebar-scroll" aria-label="Sidebar navigation">
        <ul class="sidebar-menu">

        <!-- Common Menu Items -->
<li class="sidebar-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="{{ route('logs.index') }}" class="sidebar-link {{ Request::is('logs') ? 'active' : '' }}">
                <i class="fas fa-clock"></i>
                <span>Time In / Out</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="{{ route('borrowings.create') }}" class="sidebar-link {{ Request::is('borrowings/create') ? 'active' : '' }}">
                <i class="fas fa-dolly"></i>
                <span>Borrow Equipment</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="{{ route('borrowings.index') }}" class="sidebar-link {{ Request::is('borrowings*') ? 'active' : '' }}">
                <i class="fas fa-inbox"></i>
                <span>My Borrowings</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="{{ route('incidents.report') }}" class="sidebar-link {{ Request::is('incidents/report') ? 'active' : '' }}">
                <i class="fas fa-triangle-exclamation"></i>
                <span>Report Incident</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="{{ route('incidents.index') }}" class="sidebar-link {{ Request::is('incidents*') ? 'active' : '' }}">
                <i class="fas fa-file-text"></i>
                <span>My Reports</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="{{ route('notifications.index') }}" class="sidebar-link {{ Request::is('notifications*') ? 'active' : '' }}">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
        
        <div class="sidebar-divider"></div>
        
        <!-- Staff/Admin Only -->
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
            <div class="sidebar-menu-title">Staff & Admin</div>
            
            <li class="sidebar-item">
                <a href="{{ route('equipment.index') }}" class="sidebar-link {{ Request::is('equipment*') ? 'active' : '' }}">
                    <i class="fas fa-computer"></i>
                    <span>Equipment Inventory</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="{{ route('equipment.create') }}" class="sidebar-link {{ Request::is('equipment/create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Equipment</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="{{ route('logs.index') }}" class="sidebar-link {{ Request::is('logs') ? 'active' : '' }}">
                    <i class="fas fa-history"></i>
                    <span>Time Logs</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="{{ route('reports.usage') }}" class="sidebar-link {{ Request::is('reports*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Reports</span>
                </a>
            </li>
        @endif
        
        <!-- Admin Only -->
        @if(Auth::user()->role === 'admin')
            <div class="sidebar-divider"></div>
            <div class="sidebar-menu-title">Administrator</div>
            
            <li class="sidebar-item">
                <a href="{{ route('admin.index') }}" class="sidebar-link {{ Request::is('admin*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Admin Panel</span>
                </a>
            </li>
        @endif
        
        <div class="sidebar-divider"></div>
        
        <li class="sidebar-item">
            <a href="{{ route('profile.index') }}" class="sidebar-link {{ Request::is('profile*') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>My Profile</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class="sidebar-link w-100 text-start logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
        </ul>
    </div>
</nav>


<style>
.sidebar-subtitle {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.6);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .sidebar-item {
        margin-bottom: 3px;
    }

    /* Sidebar toggle (fixed/floating, never clipped)
       The actual toggle button is rendered inside the sidebar markup.
       We keep it in a dedicated non-clipping layer. */
    .sidebar-toggle-wrap {
        position: absolute;
        top: 0;
        right: 0;
        height: 100%;
        pointer-events: none;
        overflow: visible;
    }

    .sidebar-toggle {
        pointer-events: auto;
        position: absolute;
        top: 50%;
        right: -19px;
        transform: translateY(-50%);
        z-index: 1003;
        overflow: visible;
    }

    /* Ensure sidebar content never hides the floating toggle */
    .sidebar {
        overflow: visible !important;
    }

    /* Internal scroll container for full viewport height */
    .sidebar-scroll {
        height: calc(100vh - var(--topbar-height, 70px));
        overflow-y: auto;
        overflow-x: hidden;
        padding-bottom: 24px; /* prevent footer overlap / cutoff */
        scroll-behavior: smooth;

        /* Prevent scrollbar jitter across browsers */
        -webkit-overflow-scrolling: touch;
    }

    /* Modern scrollbar styling */
    .sidebar-scroll::-webkit-scrollbar {
        width: 10px;
    }
    .sidebar-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.25);
        border-radius: 999px;
        border: 2px solid rgba(0,0,0,0);
        background-clip: padding-box;
    }
    .sidebar-scroll::-webkit-scrollbar-thumb:hover {
        background: rgba(255,255,255,0.35);
        border: 2px solid rgba(0,0,0,0);
        background-clip: padding-box;
    }



    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 14px 18px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        padding-left: 22px;
    }

    .sidebar-link.active {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .sidebar-link i {
        width: 24px;
        text-align: center;
        margin-right: 14px;
        font-size: 1.05rem;
    }

    .logout-btn {
        color: rgba(255, 255, 255, 0.7);
        border: none;
        background: none;
        cursor: pointer;
        font-family: inherit;
    }

    .logout-btn:hover {
        color: #ff6b6b;
    }
</style>
