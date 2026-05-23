<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ICTFE Home')</title>
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
            --sidebar-width: 220px;
            --sidebar-collapsed: 70px;
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
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
            transition: box-shadow 0.3s ease;
        }

        .app-shell {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            transition: grid-template-columns 0.3s ease;
            min-height: calc(100vh - var(--topbar-height));
            margin-top: var(--topbar-height);
        }

        body.sidebar-collapsed .app-shell {
            grid-template-columns: var(--sidebar-collapsed) 1fr;
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

        .search-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f8fafc;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 14px;
            padding: 0.45rem 0.9rem;
        }

        .search-input {
            border: none;
            background: transparent;
            outline: none;
            width: 280px;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .topbar-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(15, 23, 42, 0.04);
            color: var(--text-dark);
            position: relative;
            transition: background 0.2s ease;
        }

        .topbar-icon:hover {
            background: rgba(14, 165, 233, 0.12);
            color: var(--primary-dark);
        }

        .notification-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--secondary);
            color: white;
            font-size: 0.68rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .notification-badge.pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .dropdown-menu.notifications {
            min-width: 340px;
            max-width: 420px;
            border-radius: 22px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .notification-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(226, 232, 240, 0.9);
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        }

        .notification-list {
            background: #ffffff;
        }

        .notification-item {
            padding: 1rem 1.5rem;
            border-radius: 0;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .notification-item:hover {
            background: rgba(14, 165, 233, 0.06);
            border-left-color: var(--primary);
        }

        .notification-item.unread {
            background: rgba(14, 165, 233, 0.08);
            border-left-color: var(--primary);
        }

        .notification-item.unread:hover {
            background: rgba(14, 165, 233, 0.12);
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .notification-icon i {
            color: white;
        }

        .notification-title {
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .notification-message {
            font-size: 0.8rem;
            line-height: 1.4;
            margin-bottom: 0.5rem !important;
        }

        .notification-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(226, 232, 240, 0.9);
            background: #f8fafc;
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .sidebar.sidebar-collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        .sidebar.sidebar-collapsed .sidebar-header h4,
        .sidebar.sidebar-collapsed .sidebar-subtitle,
        .sidebar.sidebar-collapsed .sidebar-menu-title,
        .sidebar.sidebar-collapsed .sidebar-divider {
            opacity: 0;
            visibility: hidden;
            width: 0;
            margin: 0;
            padding: 0;
        }

        .sidebar.sidebar-collapsed .sidebar-menu li a {
            justify-content: center;
            padding: 14px 0;
        }

        .sidebar.sidebar-collapsed .sidebar-menu li a i {
            margin-right: 0;
        }

        .sidebar.sidebar-collapsed .sidebar-menu li a span {
            display: none;
        }

        .sidebar.sidebar-collapsed .sidebar-header {
            padding: 20px 0;
        }

        .sidebar.sidebar-collapsed .sidebar-menu {
            padding: 10px 0;
        }

        .search-wrapper .form-control:focus {
            box-shadow: none;
            border-color: transparent;
        }

        /* Sidebar */
.sidebar {
            position: sticky;
            top: var(--topbar-height);
            height: calc(100vh - var(--topbar-height));
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-dark), var(--primary));
            color: white;
            z-index: 1001;
            transition: width 0.3s ease, transform 0.3s ease;

            /* Sidebar scroll is handled by .sidebar-scroll */
            overflow: hidden;
        }

        
        .sidebar.sidebar-collapsed {
            width: var(--sidebar-collapsed);
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
            z-index: 1001;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .sidebar {
            transform: translateX(0);
        }

        body.sidebar-open .sidebar {
            transform: translateX(0);
        }

        .topbar-mobile-toggle {
            display: none;
        }

        @media (max-width: 991.98px) {
            .app-shell {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: fixed;
                width: var(--sidebar-width);
                transform: translateX(-110%);
                top: 0;
                height: 100vh;
                box-shadow: 0 24px 60px rgba(0, 0, 0, 0.14);
                z-index: 1002;
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
            }

            .sidebar-overlay {
                z-index: 1000;
            }

            .topbar-mobile-toggle {
                display: inline-flex;
            }

            .search-wrapper {
                display: none !important;
            }
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
        
/* Floating sidebar toggle button (robust positioning; no clipping)
   Note: base positioning is defined in sidebar.blade.php. */
        .sidebar-toggle {
            width: 38px;
            height: 38px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 8px 26px rgba(0, 0, 0, 0.18);
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


        body.sidebar-collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        /* Prevent reflow jitter during sidebar transitions */
        .sidebar, .app-shell, .main-content {
            backface-visibility: hidden;
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
            padding: 28px 30px 40px;
            min-height: calc(100vh - var(--topbar-height));
            transition: padding 0.3s ease, width 0.3s ease;
            background: linear-gradient(180deg, rgba(248,250,252,0.95), rgba(224,242,254,0.75));
            width: 100%;
            box-sizing: border-box;
        }

        .main-content > .container-fluid,
        .main-content > .container {
            max-width: 1360px;
            margin: 0 auto;
        }

        /* Modern cards */
        .card-modern {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 24px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.08);
        }

        .card-modern .card-body {
            padding: 1.8rem;
        }

        .hero-banner {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.92), rgba(16, 185, 129, 0.92));
            color: white;
            border-radius: 24px;
            box-shadow: 0 30px 80px rgba(14, 165, 233, 0.2);
            overflow: hidden;
        }

        .hero-banner h1,
        .hero-banner p {
            color: white;
        }

        .metric-card {
            background: rgba(255,255,255,0.98);
            border: 1px solid rgba(226,232,240,0.85);
            border-radius: 20px;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 22px 55px rgba(15, 23, 42, 0.12);
        }

        .metric-card .card-body {
            padding: 1.5rem;
        }

        .metric-label {
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.78rem;
            color: #64748b;
            margin-bottom: 0.75rem;
        }

        .metric-value {
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .quick-actions .btn {
            min-height: 52px;
            border-radius: 16px;
            font-weight: 600;
        }

        .btn-primary,
        .btn-success,
        .btn-info,
        .btn-secondary {
            border-radius: 16px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            box-shadow: 0 14px 35px rgba(14, 165, 233, 0.18);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0c8ac1, #0da76e);
        }

        .btn-info {
            background: linear-gradient(135deg, #0ea5e9, #22d3ee);
            color: white;
            border: none;
            box-shadow: 0 12px 30px rgba(14, 165, 233, 0.16);
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #0c87c2, #14b8a6);
        }

        .btn-warning {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.16);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #0f766e, #0b5f54);
        }

        .btn-secondary {
            background: #f8fafc;
            color: var(--text-dark);
            border: 1px solid rgba(226,232,240,0.9);
        }

        .btn-secondary:hover {
            background: white;
        }

        .lab-card {
            background: rgba(255,255,255,0.95);
            border-radius: 24px;
            border: 1px solid rgba(226,232,240,0.95);
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.06);
        }

        .lab-card .card-body {
            padding: 1.75rem;
        }

        .lab-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.8rem;
            margin-right: 6px;
            margin-bottom: 8px;
        }

        .badge-building { background: rgba(14, 165, 233, 0.12); color: #0369a1; }
        .badge-floor { background: rgba(16, 185, 129, 0.12); color: #047857; }
        .badge-capacity { background: rgba(249, 115, 22, 0.12); color: #c2410c; }

        .btn-reserve {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 16px;
            padding: 0.95rem 1.25rem;
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-reserve:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 40px rgba(14, 165, 233, 0.18);
        }

        .form-control {
            border-radius: 14px;
            border: 1px solid rgba(226,232,240,0.95);
            background: #ffffff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.15rem rgba(14, 165, 233, 0.12);
        }

        .modal-content {
            border-radius: 24px;
            overflow: hidden;
            border: none;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.12);
        }

        .modal-header {
            border-bottom: 1px solid rgba(226,232,240,0.95);
        }

        .modal-footer {
            border-top: 1px solid rgba(226,232,240,0.95);
        }

        .empty-state {
            border: 1px dashed rgba(148,163,184,0.6);
            border-radius: 24px;
            padding: 3rem;
            text-align: center;
            background: rgba(255,255,255,0.95);
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.06);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
    /* Preloader styles */
        .ictfe-preloader {
            position: fixed;
            inset: 0;
            z-index: 100000;
            display: grid;
            place-items: center;
            background: radial-gradient(1200px circle at 50% 20%, rgba(14,165,233,0.18), rgba(16,185,129,0.10) 35%, rgba(248,250,252,0.98) 70%);
            transition: opacity 220ms ease, visibility 220ms ease;
        }

        .ictfe-preloader[aria-hidden="true"] {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .ictfe-preloader__content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            padding: 28px 24px;
            border-radius: 26px;
            background: rgba(255,255,255,0.7);
            border: 1px solid rgba(226,232,240,0.85);
            box-shadow: 0 24px 80px rgba(15,23,42,0.12);
            backdrop-filter: blur(10px);
        }

        .ictfe-preloader__logo {
            position: relative;
            width: 130px;
            height: 60px;
            display: grid;
            place-items: center;
        }

        .ictfe-preloader__logo-mark {
            font-weight: 900;
            letter-spacing: 0.12em;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-size: 1.1rem;
            text-align: center;
            animation: ictfeLogoFloat 1.6s ease-in-out infinite;
        }

        @keyframes ictfeLogoFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .ictfe-preloader__spinner {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 4px solid rgba(2,132,199,0.18);
            border-top-color: var(--primary);
            border-right-color: var(--secondary);
            animation: ictfeSpin 0.95s cubic-bezier(0.2, 0.8, 0.2, 1) infinite;
            will-change: transform;
        }

        @keyframes ictfeSpin {
            to { transform: rotate(360deg); }
        }

        .ictfe-preloader__hint {
            font-size: 0.92rem;
            color: rgba(30,41,59,0.75);
            font-weight: 600;
        }

        /* Reduce motion */
        @media (prefers-reduced-motion: reduce) {
            .ictfe-preloader__logo-mark, .ictfe-preloader__spinner {
                animation: none !important;
            }
        }

    </style>
    @yield('styles')
</head>
<body>

<div class="app-shell">
    @include('layouts.sidebar')
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Global preloader (ICTFE) -->
<div id="ictfePreloader" class="ictfe-preloader" aria-live="polite" aria-busy="true">
    <div class="ictfe-preloader__bg"></div>
    <div class="ictfe-preloader__content">
        <div class="ictfe-preloader__logo">
            <span class="ictfe-preloader__logo-mark">ICTFE</span>
        </div>
        <div class="ictfe-preloader__spinner" role="status" aria-label="Loading"></div>
        <div class="ictfe-preloader__hint">Loading system…</div>
    </div>
</div>

@php

    $globalNotifications = \App\Models\Notification::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
    $globalUnreadCount = \App\Models\Notification::where('user_id', Auth::id())
        ->where('is_read', false)
        ->count();
@endphp

<!-- Top Navigation -->
<nav class="top-navbar navbar navbar-expand" id="topNavbar">
    <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3 w-100">
            <button class="topbar-icon d-lg-none topbar-mobile-toggle" type="button" id="mobileSidebarOpen" aria-label="Open sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand-custom" href="{{ route('dashboard') }}">
                <i class="fas fa-laptop-code me-2"></i>ICTFE
            </a>

            <div class="search-wrapper d-none d-lg-flex">
                <i class="fas fa-search text-muted"></i>
                <input type="search" class="form-control form-control-sm search-input" placeholder="Search labs, reservations, incidents...">
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <div class="dropdown">
                <button class="topbar-icon btn btn-sm p-0 dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    @if($globalUnreadCount > 0)
                        <span class="notification-badge pulse">{{ $globalUnreadCount }}</span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end notifications shadow-lg border-0 mt-3" aria-labelledby="notificationDropdown" style="width: 380px; max-height: 500px;">
                    <div class="notification-header d-flex align-items-center justify-content-between p-3 border-bottom">
                        <div>
                            <h6 class="mb-1 fw-bold text-dark">
                                <i class="fas fa-bell text-primary me-2"></i>Notifications
                            </h6>
                            <p class="text-muted small mb-0">
                                @if($globalUnreadCount > 0)
                                    {{ $globalUnreadCount }} unread {{ $globalUnreadCount === 1 ? 'notification' : 'notifications' }}
                                @else
                                    All caught up!
                                @endif
                            </p>
                        </div>
                        @if($globalUnreadCount > 0)
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="markAllAsRead()">
                                <i class="fas fa-check-double me-1"></i>Mark all read
                            </button>
                        @endif
                    </div>

                    <div class="notification-list" style="max-height: 350px; overflow-y: auto;">
                        @forelse($globalNotifications as $notification)
                            <div class="notification-item {{ $notification->is_read ? '' : 'unread' }} p-3 border-bottom hover-lift" onclick="markAsRead({{ $notification->id }})" style="cursor: pointer;">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="notification-icon">
                                        @if(str_contains($notification->message, 'approved'))
                                            <i class="fas fa-check-circle text-success"></i>
                                        @elseif(str_contains($notification->message, 'returned'))
                                            <i class="fas fa-undo text-info"></i>
                                        @elseif(str_contains($notification->message, 'incident'))
                                            <i class="fas fa-exclamation-triangle text-warning"></i>
                                        @else
                                            <i class="fas fa-info-circle text-primary"></i>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <h6 class="notification-title mb-0 fw-semibold text-dark">
                                                {{ \Illuminate\Support\Str::limit($notification->title ?? 'Notification', 35) }}
                                            </h6>
                                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="notification-message text-muted small mb-2">
                                            {{ \Illuminate\Support\Str::limit($notification->message ?? 'No details available.', 85) }}
                                        </p>
                                        @if(!$notification->is_read)
                                            <span class="badge bg-primary bg-opacity-15 text-primary small px-2 py-1 rounded-pill">
                                                <i class="fas fa-circle me-1" style="font-size: 6px;"></i>New
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted mb-2">No notifications yet</h6>
                                <p class="text-muted small">We'll notify you when there's something new</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="notification-footer p-3 border-top bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('notifications.index') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                <i class="fas fa-eye me-1"></i>View All
                            </a>
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>{{ now()->format('g:i A') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <div class="user-avatar me-3">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="d-none d-md-block text-end">
                        <div class="fw-semibold">{{ Auth::user()->name }}</div>
                        <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-3">
                    <li><a class="dropdown-item py-2" href="{{ route('profile.index') }}">
                        <i class="fas fa-user me-2"></i>My Profile
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('login') }}">
                            <i class="fas fa-right-to-bracket me-2"></i>Login
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-2"></i>Sign Up
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
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

    const body = document.body;
    const sidebar = document.getElementById('sidebar');
    const topNavbar = document.getElementById('topNavbar');
    const mainContent = document.getElementById('mainContent');
    const toggleBtn = document.getElementById('sidebarToggle');
    const mobileToggle = document.getElementById('mobileSidebarOpen');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const mobileBreakpoint = 992;

    // Preloader: single instance across pages
    const preloader = document.getElementById('ictfePreloader');
    let preloaderDone = false;

    const hidePreloader = () => {
        if (!preloader || preloaderDone) return;
        preloaderDone = true;
        // Fade out
        preloader.setAttribute('aria-hidden', 'true');
        // Remove from DOM after transition
        setTimeout(() => {
            preloader.remove();
        }, 260);
    };

    // Defer hide until page is fully loaded; also allows later integration
    window.addEventListener('load', () => {
        // Small buffer to ensure dashboard data render has started
        setTimeout(hidePreloader, 180);
    });

    // Pages can optionally dispatch a custom event when dashboard data is ready.
    document.addEventListener('ictfe:data:ready', hidePreloader);


    const isMobile = () => window.innerWidth < mobileBreakpoint;

    const openMobileSidebar = () => {
        body.classList.add('sidebar-open');
        sidebar.classList.add('sidebar-open');
        sidebarOverlay?.classList.add('active');
    };

    const closeMobileSidebar = () => {
        body.classList.remove('sidebar-open');
        sidebar.classList.remove('sidebar-open');
        sidebarOverlay?.classList.remove('active');
    };

    if (toggleBtn) {
        const toggleIcon = toggleBtn.querySelector('i');
        toggleBtn.addEventListener('click', () => {
            if (isMobile()) {
                if (body.classList.contains('sidebar-open')) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
                return;
            }

            const collapsed = body.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('sidebar-collapsed');
            // Keep toggle accessible & in sync
            if (toggleBtn) {
                toggleBtn.setAttribute('aria-expanded', (!collapsed).toString());
            }

            if (collapsed) {
                toggleIcon.classList.remove('fa-chevron-left');
                toggleIcon.classList.add('fa-chevron-right');
            } else {
                toggleIcon.classList.remove('fa-chevron-right');
                toggleIcon.classList.add('fa-chevron-left');
            }

        });
    }

    if (mobileToggle) {
        mobileToggle.addEventListener('click', openMobileSidebar);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
    }

    window.addEventListener('resize', () => {
        if (!isMobile()) {
            closeMobileSidebar();
        }
    });

    // Notification functions
    function markAsRead(notificationId) {
        fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI
                const notificationItem = document.querySelector(`[onclick="markAsRead(${notificationId})"]`);
                if (notificationItem) {
                    notificationItem.classList.remove('unread');
                    const badge = notificationItem.querySelector('.badge');
                    if (badge) badge.remove();

                    // Update notification count
                    const badgeElement = document.querySelector('.notification-badge');
                    if (badgeElement) {
                        const currentCount = parseInt(badgeElement.textContent) - 1;
                        if (currentCount > 0) {
                            badgeElement.textContent = currentCount;
                        } else {
                            badgeElement.remove();
                        }
                    }
                }
            }
        })
        .catch(error => console.error('Error marking notification as read:', error));
    }

    function markAllAsRead() {
        fetch('/notifications/read-all', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI
                document.querySelectorAll('.notification-item.unread').forEach(item => {
                    item.classList.remove('unread');
                    const badge = item.querySelector('.badge');
                    if (badge) badge.remove();
                });

                // Remove notification badge
                const badgeElement = document.querySelector('.notification-badge');
                if (badgeElement) badgeElement.remove();

                // Close dropdown
                const dropdown = bootstrap.Dropdown.getInstance(document.getElementById('notificationDropdown'));
                if (dropdown) dropdown.hide();
            }
        })
        .catch(error => console.error('Error marking all notifications as read:', error));
    }
</script>

</body>
</html>
