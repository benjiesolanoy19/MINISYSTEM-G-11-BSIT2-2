<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CLFMS Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --secondary: #10b981;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --light-bg: #f8fafc;
            --border-color: #e2e8f0;
            --sidebar-width: 270px;
            --sidebar-collapsed: 80px;
            --topbar-height: 70px;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Top Navigation */
        .top-navbar {
            background: white !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            height: var(--topbar-height);
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            z-index: 1000;
            transition: left 0.3s ease;
        }
        
        .top-navbar.sidebar-collapsed {
            left: var(--sidebar-collapsed);
        }
        
        .navbar-brand-custom {
            font-size: 1.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
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
            background: linear-gradient(180deg, var(--primary-dark), var(--primary));
            color: white;
            z-index: 1001;
            transition: width 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar.sidebar-collapsed {
            width: var(--sidebar-collapsed);
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
        
        .sidebar-toggle {
            position: absolute;
            top: 20px;
            right: -15px;
            width: 30px;
            height: 30px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            color: var(--primary);
            z-index: 1002;
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
        }
        
        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        .sidebar-menu li a i {
            width: 20px;
            text-align: center;
            margin-right: 12px;
        }
        
        .sidebar-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.15);
            margin: 15px 0;
        }
        
        .sidebar-menu-title {
            padding: 10px 15px 5px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 30px;
            min-height: calc(100vh - var(--topbar-height));
            transition: margin-left 0.3s ease;
        }
        
        .main-content.sidebar-collapsed {
            margin-left: var(--sidebar-collapsed);
        }

        /* User Avatar */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
    </style>
    @yield('styles')
</head>
<body>

@include('layouts.sidebar')

<!-- Top Navigation -->
<nav class="top-navbar navbar navbar-expand" id="topNavbar">
    <div class="container-fluid px-4">
        <a class="navbar-brand-custom d-lg-none" href="#">
            <i class="fas fa-laptop-code me-2"></i>CLFMS
        </a>
        
        <div class="collapse navbar-collapse justify-content-end">
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none" href="#" role="button" data-bs-toggle="dropdown">
                        <div class="user-avatar me-3">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="d-none d-md-block">
                            <div class="fw-semibold">{{ Auth::user()->name }}</div>
                            <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                        </div>
                        <i class="fas fa-chevron-down ms-2 text-muted"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-3">
                        <li><a class="dropdown-item py-2" href="{{ route('profile.index') }}">
                            <i class="fas fa-user me-2"></i>My Profile
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a></li>
                    </ul>
                </div>
        </div>
</nav>

<!-- Main Content -->
<main class="main-content" id="mainContent">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/ScrollTrigger.min.js"></script>

@yield('scripts')

<script>
    // Initialize AOS (Animate On Scroll)
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out-quart',
            once: true,
            offset: 100,
            delay: 0
        });

        // Register GSAP ScrollTrigger
        if (typeof gsap !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }
    });

    const sidebar = document.getElementById('sidebar');
    const topNavbar = document.getElementById('topNavbar');
    const mainContent = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('sidebarToggle');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            topNavbar.classList.toggle('sidebar-collapsed');
            mainContent.classList.toggle('sidebar-collapsed');
        });
    }
</script>

</body>
</html>
