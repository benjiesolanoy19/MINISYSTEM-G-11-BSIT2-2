<!DOCTYPE html>
<html lang="en" x-cloak>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Computer Laboratory Facilities Management System (CLFMS)')</title>
    
    <!-- Vite Entry Points for Material Design & Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
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
            --card-border: #e2e8f0;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.12);
            --sidebar-width: 270px;
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
            --card-border: rgba(255,255,255,0.08);
            --border-color: rgba(255,255,255,0.08);
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.35);
            --shadow-md: 0 4px 24px rgba(0,0,0,0.55);
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

        .top-navbar {
            background: var(--surface) !important;
            box-shadow: var(--shadow-sm);
            height: var(--topbar-height);
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0 30px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .navbar-brand-custom {
            font-size: 1.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--mdc-primary), var(--mdc-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
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
            transition: width 0.3s ease;
            overflow-y: auto;
            box-shadow: var(--shadow-md);
            padding-top: 20px;
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header h4 {
            font-weight: 700;
            margin: 0;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 15px 10px;
            margin: 0;
        }
        
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
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
            margin-right: 12px;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 30px;
            min-height: calc(100vh - var(--topbar-height));
            transition: margin-left 0.3s ease;
        }

        /* User Avatar */
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
            transition: all 0.3s ease;
        }
        
        .user-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.4);
        }
        
        .dropdown-menu {
            border: none;
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
        }
        
        .dropdown-item {
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background-color: var(--light-bg);
            color: var(--mdc-primary);
        }
        
        [x-cloak] {
            display: none !important;
        }
        
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 0;
            }
            
            .sidebar {
                transform: translateX(-100%);
                width: 250px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .top-navbar {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <div class="theme-toast" id="themeToast" role="status" aria-live="polite"></div>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
<h4><i class="fas fa-laptop-code me-2"></i>Computer Laboratory Facilities Management System (CLFMS)</h4>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}" class="active"><i class="fas fa-chart-line"></i> Dashboard</a></li>
            
            <li style="padding: 10px 15px 5px; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.5); margin-top: 15px;">Management</li>
            
            <li><a href="#"><i class="fas fa-server"></i> Equipment</a></li>
            <li><a href="#"><i class="fas fa-calendar-check"></i> Reservations</a></li>
            <li><a href="#"><i class="fas fa-exchange-alt"></i> Borrowings</a></li>
            <li><a href="#"><i class="fas fa-flask"></i> Laboratories</a></li>
            
            <li style="padding: 10px 15px 5px; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.5); margin-top: 15px;">Monitoring</li>
            
            <li><a href="#"><i class="fas fa-exclamation-triangle"></i> Incidents</a></li>
            <li><a href="#"><i class="fas fa-file-alt"></i> Logs</a></li>
            <li><a href="#"><i class="fas fa-bell"></i> Notifications</a></li>
            
            <li style="padding: 10px 15px 5px; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255,255,255,0.5); margin-top: 15px;">Settings</li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
    </aside>

    <!-- Top Navigation -->
    <nav class="top-navbar navbar navbar-expand" id="topNavbar">
        <a class="navbar-brand-custom d-lg-none" href="#">
            <i class="fas fa-laptop-code me-2"></i>ICTFE
        </a>
        
        <div class="collapse navbar-collapse justify-content-end w-100">
            <div class="d-flex align-items-center gap-3">
                <div class="theme-toggle d-none d-lg-flex">
                    <button type="button" id="theme-system" title="System theme" aria-label="System theme">🖥️</button>
                    <button type="button" id="theme-light" title="Light mode" aria-label="Light mode">☀️</button>
                    <button type="button" id="theme-dark" title="Dark mode" aria-label="Dark mode">🌙</button>
                </div>

                <button class="btn btn-sm btn-outlined" style="color: var(--mdc-primary); border: 2px solid var(--mdc-primary);">
                    <i class="fas fa-bell"></i>
                </button>
                
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none gap-2 cursor-pointer" style="cursor: pointer;" role="button" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            @if(Auth::user()->profile_picture_url)
                                <img src="{{ Auth::user()->profile_picture_url }}" alt="{{ Auth::user()->name }}">
                            @else
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="d-none d-md-block">
                            <div style="font-weight: 500; font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                            <small style="color: var(--text-muted); font-size: 0.8rem;">{{ ucfirst(Auth::user()->role) }}</small>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item py-2" href="{{ route('profile.index') }}">
                            <i class="fas fa-user me-2"></i>My Profile
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        // Initialize GSAP
        gsap.registerPlugin(ScrollTrigger);
        window.gsap = gsap;

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
    
    @yield('scripts')
</body>
</html>
