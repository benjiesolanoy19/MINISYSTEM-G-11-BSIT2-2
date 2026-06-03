<!DOCTYPE html>
<html lang="en" x-cloak>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Computer Laboratory Facilities Management System (CLFMS)')</title>
    
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --mdc-primary: #0ea5e9;
            --mdc-primary-dark: #0284c7;
            --mdc-secondary: #10b981;
            --mdc-error: #ef4444;
            --mdc-warning: #f59e0b;
            --mdc-info: #3b82f6;
            --mdc-success: #10b981;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --surface: #ffffff;
            --surface-soft: rgba(248,250,252,0.95);
            --card-border: #e2e8f0;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.12);
            --sidebar-width: 280px;
            --topbar-height: 70px;
        }

        [data-theme="dark"] {
            --mdc-primary: #60a5fa;
            --mdc-primary-dark: #3b82f6;
            --mdc-secondary: #34d399;
            --mdc-error: #f87171;
            --mdc-warning: #fbbf24;
            --mdc-info: #60a5fa;
            --mdc-success: #34d399;
            --text-dark: #e6eef8;
            --text-muted: #cbd5e1;
            --light-bg: #0b1220;
            --card-bg: #111827;
            --surface: #111827;
            --surface-soft: rgba(15, 23, 42, 0.88);
            --card-border: rgba(255,255,255,0.08);
            --border-color: rgba(255,255,255,0.08);
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.35);
            --shadow-md: 0 4px 24px rgba(0,0,0,0.5);
            --shadow-lg: 0 12px 40px rgba(0,0,0,0.65);
        }
        
        /* Smooth transition for theme changes */
        :root, body, .card, .navbar, .btn, .form-control, .form-select, .dropdown-menu, .modal-content, .table, .search-wrapper, .top-navbar, .badge {
            transition: background-color 240ms ease, color 240ms ease, border-color 240ms ease, box-shadow 240ms ease, transform 240ms ease;
        }

        body, .main-content, .page-section, .content-area, .dashboard-content {
            background: var(--light-bg);
            color: var(--text-dark);
        }

        .card, .card-body, .card-header, .modal-content, .dropdown-menu, .form-control, .form-select, .search-wrapper, .table, .table th, .table td, .alert, .badge, .page-section, .content-area, .dashboard-content {
            background: var(--card-bg);
            color: var(--text-dark);
            border-color: var(--border-color);
        }

        .card {
            box-shadow: var(--shadow-md);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: transparent;
            color: var(--text-dark);
        }

        .table th,
        .table td {
            border: 1px solid var(--border-color);
            padding: 0.95rem 1rem;
            background: var(--card-bg);
            color: var(--text-dark);
        }

        .table th {
            background: rgba(14, 165, 233, 0.08);
        }

        [data-theme="dark"] .table th {
            background: rgba(255,255,255,0.08);
        }

        [data-theme="dark"] .table td {
            background: rgba(255,255,255,0.03);
        }

        input,
        textarea,
        select,
        .form-control,
        .form-select,
        .form-check-input,
        .form-check-label {
            background: var(--card-bg);
            color: var(--text-dark);
            border: 1px solid var(--border-color);
        }

        input::placeholder,
        textarea::placeholder {
            color: var(--text-muted);
            opacity: 1;
        }

        .btn:disabled,
        .btn[disabled],
        .form-control:disabled,
        .form-control[disabled] {
            opacity: 0.65;
            cursor: not-allowed;
        }

        .bg-white {
            background-color: var(--card-bg) !important;
        }

        .bg-light {
            background-color: rgba(255,255,255,0.12) !important;
        }

        .text-dark {
            color: var(--text-dark) !important;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        .dropdown-menu,
        .modal-content,
        .popover,
        .tooltip-inner {
            background: var(--card-bg);
            color: var(--text-dark);
            border-color: var(--border-color);
        }

        .modal-backdrop.show {
            background-color: rgba(0,0,0,0.4);
        }

        .alert-primary {
            background: rgba(14, 165, 233, 0.12);
            color: var(--mdc-primary);
            border-left-color: var(--mdc-primary);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.12);
            color: var(--mdc-secondary);
            border-left-color: var(--mdc-secondary);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.12);
            color: var(--mdc-error);
            border-left-color: var(--mdc-error);
        }

        [data-theme="dark"] .top-navbar,
        [data-theme="dark"] .page-section,
        [data-theme="dark"] .content-area,
        [data-theme="dark"] .dashboard-content {
            background: var(--surface);
        }

        [data-theme="dark"] input,
        [data-theme="dark"] textarea,
        [data-theme="dark"] select,
        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select {
            background: rgba(255,255,255,0.04);
            border-color: rgba(255,255,255,0.12);
        }
        
        html, body {
            height: 100%;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--mdc-primary-dark) 0%, var(--mdc-primary) 100%);
            color: white;
            z-index: 1001;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            box-shadow: var(--shadow-md);
            padding-top: var(--topbar-height);
        }
        
        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            margin-top: 20px;
        }
        
        .sidebar-header h4 {
            font-weight: 700;
            margin: 0;
            font-size: 1.25rem;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 15px 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            margin: 0;
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            margin: 5px 10px;
            border-radius: 8px;
        }
        
        .sidebar-menu li a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: white;
            border-radius: 0 4px 4px 0;
            transform: scaleY(0);
            transform-origin: top;
            transition: transform 0.3s ease;
        }
        
        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }
        
        .sidebar-menu li a.active::before {
            transform: scaleY(1);
        }
        
        .sidebar-menu li a i {
            width: 20px;
            text-align: center;
        }
        
        .sidebar-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.15);
            margin: 15px 0;
        }
        
        /* Top Navigation */
        .theme-toggle {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(226, 232, 240, 0.95);
            box-shadow: var(--shadow-sm);
            transition: all 0.25s ease;
        }

        [data-theme="dark"] .theme-toggle {
            background: rgba(15, 23, 42, 0.85);
            border-color: rgba(255,255,255,0.08);
        }

        .theme-toggle button {
            border: none;
            background: transparent;
            color: var(--text-dark);
            border-radius: 999px;
            padding: 8px 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 16px;
        }

        .theme-toggle button.active {
            background: linear-gradient(90deg, var(--mdc-primary), var(--mdc-secondary));
            color: white;
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.18);
        }

        .theme-toast {
            position: fixed;
            right: 18px;
            top: 90px;
            z-index: 1102;
            background: rgba(0, 0, 0, 0.72);
            color: white;
            padding: 10px 14px;
            border-radius: 12px;
            opacity: 0;
            transform: translateY(-8px);
            transition: opacity 220ms ease, transform 220ms ease;
            pointer-events: none;
            font-size: 0.92rem;
        }

        .theme-toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: var(--card-bg);
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .topbar h1 {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--mdc-primary), var(--mdc-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
        }
        
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--mdc-primary), var(--mdc-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.4);
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 30px;
            min-height: calc(100vh - var(--topbar-height));
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        /* Widget/Card */
        .widget {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .widget::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--mdc-primary), var(--mdc-secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .widget:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }
        
        .widget:hover::before {
            transform: scaleX(1);
        }
        
        .widget-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        
        .widget-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .widget-icon {
            font-size: 2rem;
            background: linear-gradient(135deg, var(--mdc-primary), var(--mdc-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .widget-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin: 10px 0;
        }
        
        .widget-footer {
            font-size: 0.85rem;
            color: var(--text-muted);
            padding-top: 10px;
            border-top: 1px solid var(--border-color);
        }
        
        /* Table Enhancement */
        .data-table {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }
        
        .table {
            margin: 0;
        }
        
        .table thead th {
            background: linear-gradient(135deg, var(--mdc-primary), var(--mdc-secondary));
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--border-color);
        }
        
        .table tbody tr:hover {
            background-color: rgba(14, 165, 233, 0.05);
            transform: translateX(4px);
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-badge.active {
            background: rgba(16, 185, 129, 0.15);
            color: var(--mdc-success);
        }
        
        .status-badge.inactive {
            background: rgba(229, 231, 235, 0.5);
            color: var(--text-muted);
        }
        
        .status-badge.pending {
            background: rgba(245, 158, 11, 0.15);
            color: var(--mdc-warning);
        }
        
        /* Form */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.95rem;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--mdc-primary);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        }
        
        /* Modal */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--mdc-primary), var(--mdc-secondary));
            color: white;
            border: none;
            padding: 20px;
        }
        
        /* Animations */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .animate-slide-in-left {
            animation: slideInLeft 0.4s ease;
        }
        
        .animate-slide-in-down {
            animation: slideInDown 0.4s ease;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.4s ease;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 0;
            }
            
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .topbar {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @yield('styles')
</head>
<body x-data="dashboardApp()">
    <div class="theme-toast" id="themeToast" role="status" aria-live="polite"></div>
    <!-- Sidebar -->
    <aside class="sidebar animate-slide-in-left" :class="sidebarOpen ? 'active' : ''">
        <div class="sidebar-header">
<h4><i class="fas fa-laptop-code me-2"></i>Computer Laboratory Facilities Management System (CLFMS)</h4>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}" class="active"><i class="fas fa-chart-line"></i> Dashboard</a></li>
            
            <div class="sidebar-divider"></div>
            <li style="padding: 10px 20px 5px; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.5);">Management</li>
            
            <li><a href="#"><i class="fas fa-server"></i> Equipment</a></li>
            <li><a href="#"><i class="fas fa-calendar-check"></i> Reservations</a></li>
            <li><a href="#"><i class="fas fa-exchange-alt"></i> Borrowings</a></li>
            <li><a href="#"><i class="fas fa-flask"></i> Laboratories</a></li>
            
            <div class="sidebar-divider"></div>
            <li style="padding: 10px 20px 5px; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.5);">Monitoring</li>
            
            <li><a href="#"><i class="fas fa-exclamation-triangle"></i> Incidents</a></li>
            <li><a href="#"><i class="fas fa-file-alt"></i> Logs</a></li>
            <li><a href="#"><i class="fas fa-bell"></i> Notifications</a></li>
            
            <div class="sidebar-divider"></div>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
    </aside>
    
    <!-- Top Navigation -->
    <header class="topbar animate-slide-in-down">
        <h1>@yield('page-title', 'Dashboard')</h1>
        
        <div class="topbar-actions">
            <div class="theme-toggle">
                <button type="button" id="theme-system" title="System theme" aria-label="System theme">🖥️</button>
                <button type="button" id="theme-light" title="Light mode" aria-label="Light mode">☀️</button>
                <button type="button" id="theme-dark" title="Dark mode" aria-label="Dark mode">🌙</button>
            </div>

            <button class="btn btn-sm btn-outlined" @click="showNotifications = ! showNotifications">
                <i class="fas fa-bell"></i>
            </button>
            
            <div class="dropdown" x-data="{ open: false }">
                <div class="user-menu" @click="open = !open">
                    <div class="user-avatar">
                        @if(Auth::user()->profile_picture_url)
                            <img src="{{ Auth::user()->profile_picture_url }}" alt="{{ Auth::user()->name }}">
                        @else
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <div style="font-weight: 500;">{{ Auth::user()->name }}</div>
                        <small style="color: var(--text-muted);">{{ ucfirst(Auth::user()->role) }}</small>
                    </div>
                </div>
                
                <div class="dropdown-menu" :class="open ? 'show' : ''" style="position: absolute; top: 60px; right: 0; min-width: 200px;">
                    <a href="{{ route('profile.index') }}" class="dropdown-item">
                        <i class="fas fa-user me-2"></i>My Profile
                    </a>
                    <hr class="dropdown-divider">
                    <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>
    
    @yield('scripts')
    
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dashboardApp', () => ({
                sidebarOpen: window.innerWidth > 768,
                showNotifications: false,
                init() {
                    // Handle window resize
                    window.addEventListener('resize', () => {
                        if (window.innerWidth > 768) {
                            this.sidebarOpen = true;
                        }
                    });
                }
            }));
        });

        (function() {
            const THEME_KEY = 'ictfe_theme';
            const btnSystem = document.getElementById('theme-system');
            const btnLight = document.getElementById('theme-light');
            const btnDark = document.getElementById('theme-dark');
            const toast = document.getElementById('themeToast');
            const mq = window.matchMedia('(prefers-color-scheme: dark)');
            let systemListener = null;

            function applyDark(isDark) {
                if (isDark) document.documentElement.setAttribute('data-theme', 'dark');
                else document.documentElement.removeAttribute('data-theme');
            }

            function showToast(msg) {
                if (!toast) return;
                toast.textContent = msg;
                toast.classList.add('show');
                clearTimeout(toast._t);
                toast._t = setTimeout(() => toast.classList.remove('show'), 1600);
            }

            function setActive(mode) {
                [btnSystem, btnLight, btnDark].forEach(b => b && b.classList.remove('active'));
                if (mode === 'system' && btnSystem) btnSystem.classList.add('active');
                if (mode === 'light' && btnLight) btnLight.classList.add('active');
                if (mode === 'dark' && btnDark) btnDark.classList.add('active');
            }

            function setTheme(mode, save = true) {
                if (save) localStorage.setItem(THEME_KEY, mode);
                if (mode === 'system') {
                    applyDark(mq.matches);
                    if (!systemListener) {
                        systemListener = (e) => applyDark(e.matches);
                        try { mq.addEventListener('change', systemListener); } catch (e) { mq.addListener(systemListener); }
                    }
                } else {
                    applyDark(mode === 'dark');
                    if (systemListener) {
                        try { mq.removeEventListener('change', systemListener); } catch (e) { mq.removeListener(systemListener); }
                        systemListener = null;
                    }
                }
                setActive(mode);
                showToast('Theme: ' + (mode === 'system' ? 'System' : (mode === 'dark' ? 'Dark' : 'Light')));
            }

            document.addEventListener('DOMContentLoaded', () => {
                const saved = localStorage.getItem(THEME_KEY) || 'system';
                setTheme(saved, false);
            });

            if (btnSystem) btnSystem.addEventListener('click', () => setTheme('system'));
            if (btnLight) btnLight.addEventListener('click', () => setTheme('light'));
            if (btnDark) btnDark.addEventListener('click', () => setTheme('dark'));
        })();
    </script>
</body>
</html>
