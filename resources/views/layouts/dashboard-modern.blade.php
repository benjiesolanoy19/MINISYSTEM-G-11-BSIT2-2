<!DOCTYPE html>
<html lang="en" x-cloak>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ICTFE Dashboard')</title>
    
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
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.12);
            --sidebar-width: 270px;
            --topbar-height: 70px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
        .top-navbar {
            background: white !important;
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
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-laptop-code me-2"></i>ICTFE</h4>
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
    </script>
    
    @yield('scripts')
</body>
</html>
