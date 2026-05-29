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
            <a href="{{ route('dashboard') }}" title="Home" class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </li>

        @php($role = Auth::user()->role ?? null)

        @if($role === 'student')
            <li class="sidebar-item">
                <a href="{{ route('logs.index') }}" title="Time In / Out" class="sidebar-link {{ Request::is('logs') ? 'active' : '' }}">
                    <i class="fas fa-clock"></i>
                    <span>Time In / Out</span>
                </a>
            </li>



            <li class="sidebar-item">
                <a href="{{ route('borrowings.create') }}" title="Borrow Equipment" class="sidebar-link {{ Request::is('borrowings/create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle"></i>
                    <span>Borrow Equipment</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('borrowings.index') }}" title="My Requests" class="sidebar-link {{ Request::is('borrowings') ? 'active' : '' }}">
                    <i class="fas fa-inbox"></i>
                    <span>My Requests</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('borrowings.return-equipment') }}" title="Return Equipment" class="sidebar-link {{ Request::is('borrowings/return-equipment') ? 'active' : '' }}">
                    <i class="fas fa-undo"></i>
                    <span>Return Equipment</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('incidents.report') }}" title="Report Incident" class="sidebar-link {{ Request::is('incidents/report') ? 'active' : '' }}">
                    <i class="fas fa-triangle-exclamation"></i>
                    <span>Report Incident</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('incidents.index') }}" title="My Reports" class="sidebar-link {{ Request::is('incidents*') ? 'active' : '' }}">
                    <i class="fas fa-file-text"></i>
                    <span>My Reports</span>
                </a>
            </li>
        @endif

        <li class="sidebar-item">
            <a href="{{ route('notifications.index') }}" title="Notifications" class="sidebar-link {{ Request::is('notifications*') ? 'active' : '' }}">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>

        <div class="sidebar-divider"></div>

        <!-- Staff/Admin Only -->
        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
            <div class="sidebar-divider"></div>
            <div class="sidebar-menu-title">Staff & Admin</div>

            <li class="sidebar-item">
                <a href="{{ route('staff.pending-requests') }}" title="Borrow Requests" class="sidebar-link {{ Request::is('borrowings/staff/pending-requests') ? 'active' : '' }}">
                    <i class="fas fa-check-circle"></i>
                    <span>Borrow Requests</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('staff.return-management') }}" title="Return Management" class="sidebar-link {{ Request::is('borrowings/staff/return-management') ? 'active' : '' }}">
                    <i class="fas fa-undo-alt"></i>
                    <span>Return Management</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="{{ route('equipment.index') }}" title="Equipment Inventory" class="sidebar-link {{ Request::is('equipment*') ? 'active' : '' }}">
                    <i class="fas fa-computer"></i>
                    <span>Equipment Inventory</span>
                </a>
            </li>

            
            <li class="sidebar-item">
                <a href="{{ route('equipment.create') }}" title="Add Equipment" class="sidebar-link {{ Request::is('equipment/create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Equipment</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="{{ route('logs.index') }}" title="Time Logs" class="sidebar-link {{ Request::is('logs') ? 'active' : '' }}">
                    <i class="fas fa-history"></i>
                    <span>Time Logs</span>
                </a>
            </li>

            <li class="sidebar-item">


                <a href="{{ route('reports.usage') }}" title="Reports" class="sidebar-link {{ Request::is('reports*') ? 'active' : '' }}">
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
                <a href="{{ route('admin.index') }}" title="Admin Panel" class="sidebar-link {{ Request::is('admin*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Admin Panel</span>
                </a>
            </li>
        @endif
        
        <div class="sidebar-divider"></div>
        
        </ul>
    </div>

    <div class="sidebar-footer">
        <ul class="sidebar-menu footer-menu mb-0">
            <li class="sidebar-item">
                <a href="{{ route('profile.index') }}" title="My Profile" class="sidebar-link {{ Request::is('profile*') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                    <span>My Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <form method="POST" action="{{ route('logout') }}" class="w-100 mb-0">
                    @csrf
                    <button type="submit" title="Logout" class="sidebar-link w-100 text-start logout-btn">
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
        color: rgba(255, 255, 255, 0.76);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        line-height: 1.5;
    }

    .sidebar-item {
        margin-bottom: 4px;
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
        right: -18px;
        transform: translateY(-50%);
        z-index: 1003;
        overflow: visible;
    }

    .sidebar {
        position: sticky;
        top: var(--topbar-height);
        height: calc(100vh - var(--topbar-height));
        min-height: calc(100vh - var(--topbar-height));
        width: var(--sidebar-width);
        min-width: var(--sidebar-width);
        max-width: var(--sidebar-width);
        display: flex;
        flex-direction: column;
        background: linear-gradient(180deg, rgba(7, 96, 161, 0.94), rgba(14, 165, 233, 0.96));
        color: white;
        z-index: 1001;
        transition: width 0.28s ease, min-width 0.28s ease, max-width 0.28s ease, transform 0.28s ease;
        overflow-x: hidden;
        box-sizing: border-box;
    }

    .sidebar.sidebar-collapsed {
        width: var(--sidebar-collapsed);
        min-width: var(--sidebar-collapsed);
        max-width: var(--sidebar-collapsed);
    }

    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.25s ease, visibility 0.25s ease;
        z-index: 1000;
    }

    .sidebar-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .sidebar-scroll {
        flex: 1 1 auto;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 12px 0 8px;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }

    .sidebar-scroll::-webkit-scrollbar {
        width: 10px;
    }
    .sidebar-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.26);
        border-radius: 999px;
        border: 2px solid rgba(0,0,0,0);
        background-clip: padding-box;
    }
    .sidebar-scroll::-webkit-scrollbar-thumb:hover {
        background: rgba(255,255,255,0.42);
    }

    .sidebar-header {
        padding: 22px 18px 18px;
        text-align: left;
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    .sidebar-header h4 {
        font-weight: 800;
        margin: 0 0 6px;
        line-height: 1.1;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .sidebar-menu {
        list-style: none;
        padding: 12px 10px 4px;
        margin: 0;
        min-width: 0;
    }

    .sidebar-menu li {
        margin-bottom: 8px;
    }

    .sidebar-menu li a,
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 0.95rem;
        padding: 14px 18px;
        color: rgba(255, 255, 255, 0.92);
        text-decoration: none;
        border-radius: 14px;
        transition: transform 0.28s ease, background 0.28s ease, color 0.28s ease, box-shadow 0.28s ease;
        position: relative;
        font-weight: 500;
        font-size: 0.96rem;
        min-height: 52px;
        white-space: normal;
        overflow: visible;
    }

    .sidebar-menu li a:hover,
    .sidebar-link:hover {
        transform: translateX(2px);
        background: rgba(255, 255, 255, 0.14);
        color: #ffffff;
        box-shadow: 0 14px 28px rgba(255, 255, 255, 0.1);
    }

    .sidebar-link.active,
    .sidebar-menu li a.active {
        background: rgba(255, 255, 255, 0.26);
        color: #ffffff;
        box-shadow: inset 4px 0 0 rgba(255, 255, 255, 0.75);
    }

    .sidebar-link:hover i,
    .sidebar-link.active i,
    .sidebar-menu li a.active i {
        color: #ffffff;
    }

    .sidebar-link span,
    .sidebar-menu li a span {
        flex: 1 1 auto;
        min-width: 0;
        overflow-wrap: anywhere;
        white-space: normal;
        transition: opacity 0.28s ease, transform 0.28s ease;
        line-height: 1.45;
    }

    .sidebar-link i,
    .sidebar-menu li a i {
        width: 28px;
        min-width: 28px;
        text-align: center;
        color: rgba(255, 255, 255, 0.92);
        font-size: 1.05rem;
        transition: color 0.28s ease, transform 0.28s ease;
    }

    .sidebar-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.14);
        margin: 16px 0;
    }

    .sidebar-menu-title {
        padding: 10px 18px 6px;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        color: rgba(255, 255, 255, 0.66);
        margin-top: 16px;
        margin-bottom: 8px;
    }

    .logout-btn {
        color: rgba(255, 255, 255, 0.78);
        border: none;
        background: none;
        cursor: pointer;
        font-family: inherit;
        width: 100%;
        text-align: left;
        padding: 14px 18px;
    }

    .logout-btn:hover {
        color: #ff8787;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 14px;
    }

    .sidebar-footer {
        flex: 0 0 auto;
        padding: 10px 0 14px;
        background: rgba(255, 255, 255, 0.04);
        border-top: 1px solid rgba(255, 255, 255, 0.12);
    }

    .sidebar-footer .sidebar-menu {
        padding: 0 10px;
    }

    .sidebar-footer .sidebar-link {
        padding: 12px 18px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.04);
    }

    .sidebar-footer .sidebar-link:hover {
        transform: translateX(2px);
        background: rgba(255, 255, 255, 0.16);
    }

    .sidebar-submenu {
        list-style: none;
        padding-left: 32px;
        margin: 0;
    }

    .sidebar-submenu li {
        margin-bottom: 6px;
    }

    .sidebar-submenu a {
        padding-left: 18px;
        padding-right: 18px;
        font-size: 0.92rem;
    }

    .sidebar.sidebar-collapsed .sidebar-menu li a,
    .sidebar.sidebar-collapsed .sidebar-link {
        justify-content: center;
        padding: 14px 0;
        gap: 0;
    }

    .sidebar.sidebar-collapsed .sidebar-menu li a span,
    .sidebar.sidebar-collapsed .sidebar-link span {
        opacity: 0;
        visibility: hidden;
        transform: translateX(-6px);
        width: 0;
    }

    .sidebar.sidebar-collapsed .sidebar-menu li a i,
    .sidebar.sidebar-collapsed .sidebar-link i {
        margin-right: 0;
        width: auto;
    }

    .sidebar.sidebar-collapsed .sidebar-header,
    .sidebar.sidebar-collapsed .sidebar-subtitle,
    .sidebar.sidebar-collapsed .sidebar-menu-title,
    .sidebar.sidebar-collapsed .sidebar-divider {
        opacity: 0;
        visibility: hidden;
        height: 0;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }

    .sidebar-toggle {
        width: 38px;
        height: 38px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 8px 28px rgba(0, 0, 0, 0.16);
        color: var(--primary);
        border: none;
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.25s ease, background 0.25s ease;
        font-size: 1rem;
        outline: none;
        padding: 0;
        will-change: transform;
    }

    .sidebar-toggle:hover {
        box-shadow: 0 14px 40px rgba(0, 0, 0, 0.22);
        transform: translateY(-50%) scale(1.08);
        background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        color: white;
    }

    .sidebar-toggle:active {
        transform: translateY(-50%) scale(0.96);
    }

    .sidebar-toggle i {
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        will-change: transform;
    }


    .sidebar,
    .app-shell,
    .main-content {
        backface-visibility: hidden;
    }

    .sidebar-item.open > .sidebar-submenu {
        max-height: 420px;
        opacity: 1;
        transform: translateY(0);
    }

    .sidebar-submenu {
        list-style: none;
        padding-left: 12px;
        margin: 0;
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        transform: translateY(-5px);
        transition: max-height 0.28s ease, opacity 0.28s ease, transform 0.28s ease;
    }

    @media (max-width: 980px) {
        .sidebar {
            width: 100%;
            min-width: auto;
        }

        .sidebar-menu,
        .sidebar-footer .sidebar-menu {
            padding-left: 6px;
            padding-right: 6px;
        }

        .sidebar-menu li a,
        .sidebar-link {
            padding: 12px 14px;
        }
    }
</style>
