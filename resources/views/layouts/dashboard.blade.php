<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Computer Laboratory Facilities Management System (CLFMS)')</title>
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
            --card-bg: #ffffff;
            --card-border: #e2e8f0;
            --surface: #ffffff;
            --surface-soft: rgba(248,250,252,0.95);
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 6px 24px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.18);
            --sidebar-width: 270px;
            --sidebar-collapsed: 78px;
            --topbar-height: 70px;
        }

        [data-theme="dark"] {
            --primary: #60a5fa;
            --primary-dark: #3b82f6;
            --secondary: #34d399;
            --text-dark: #e2eef8;
            --text-muted: #a5b4fc;
            --light-bg: #0b1220;
            --card-bg: #111827;
            --card-border: rgba(255,255,255,0.08);
            --surface: #111827;
            --surface-soft: rgba(15, 23, 42, 0.88);
            --border-color: rgba(255,255,255,0.08);
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.45);
            --shadow-md: 0 6px 24px rgba(0, 0, 0, 0.55);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.65);
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
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.12);
            color: var(--secondary);
            border-left-color: var(--secondary);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.12);
            color: #ef4444;
            border-left-color: #ef4444;
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
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            overflow-x: hidden;
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
            background: linear-gradient(90deg, var(--primary), var(--secondary));
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

        [data-theme="dark"] .card-modern,
        [data-theme="dark"] .metric-card,
        [data-theme="dark"] .lab-card,
        [data-theme="dark"] .empty-state,
        [data-theme="dark"] .notification-header,
        [data-theme="dark"] .notification-list,
        [data-theme="dark"] .notification-footer,
        [data-theme="dark"] .dropdown-menu,
        [data-theme="dark"] .modal-content,
        [data-theme="dark"] .top-navbar,
        [data-theme="dark"] .search-wrapper,
        [data-theme="dark"] .main-content {
            background: var(--surface);
            border-color: var(--card-border);
            box-shadow: 0 18px 60px rgba(0,0,0,0.38);
        }

        [data-theme="dark"] .topbar-icon {
            background: rgba(255,255,255,0.08);
            color: var(--text-dark);
        }

        [data-theme="dark"] .topbar-icon:hover {
            background: rgba(255,255,255,0.12);
        }

        [data-theme="dark"] .metric-label,
        [data-theme="dark"] .notification-time,
        [data-theme="dark"] .notification-message,
        [data-theme="dark"] .profile-menu-title,
        [data-theme="dark"] .notification-footer,
        [data-theme="dark"] .dropdown-item {
            color: var(--text-muted);
        }

        .top-navbar {
            background: var(--surface) !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            height: var(--topbar_height);
            height: var(--topbar-height);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
            transition: box-shadow 0.3s ease, background 0.3s ease, color 0.3s ease;
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

        .user-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid rgba(14, 165, 233, 0.18);
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(16, 185, 129, 0.12));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .user-avatar:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 26px rgba(14, 165, 233, 0.18);
        }

        .user-status-dot {
            position: absolute;
            right: 2px;
            bottom: 2px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #22c55e;
            border: 2px solid #ffffff;
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.16);
        }

        .profile-dropdown-menu {
            min-width: 220px;
            border-radius: 18px;
            overflow: hidden;
            transition: opacity 0.22s ease, transform 0.22s ease;
            transform-origin: top right;
            opacity: 0;
            transform: translateY(-8px);
        }

        .dropdown-menu.show.profile-dropdown-menu {
            opacity: 1;
            transform: translateY(0);
        }

        .profile-dropdown-menu .dropdown-item {
            padding: 0.9rem 1.25rem;
        }

        .profile-dropdown-line {
            border-top: 1px solid rgba(226, 232, 240, 0.9);
        }

        .profile-menu-title {
            font-size: 0.85rem;
            color: #475569;
            padding: 0.85rem 1.25rem 0.4rem;
            font-weight: 600;
        }

        .profile-dropdown-menu .dropdown-item:hover {
            background: rgba(14, 165, 233, 0.08);
        }

        .dropdown-menu.notifications {
            transition: opacity 0.22s ease, transform 0.22s ease;
            transform-origin: top right;
            opacity: 0;
            transform: translateY(-8px);
        }

        .dropdown-menu.show.notifications {
            opacity: 1;
            transform: translateY(0);
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
            min-width: 320px;
            max-width: 420px;
            width: min(94vw, 420px);
            border-radius: 22px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 22px 48px rgba(0, 0, 0, 0.16);
            background: transparent;
        }

        .notification-header {
            padding: 1.2rem 1.35rem;
            border-bottom: 1px solid rgba(226, 232, 240, 0.95);
            background: var(--card-bg);
        }

        .notification-header h6 {
            font-size: 0.95rem;
            letter-spacing: -0.02em;
        }

        .notification-header p {
            margin-bottom: 0;
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .notification-list {
            background: var(--card-bg);
            max-height: 360px;
            overflow-y: auto;
        }

        .notification-list::-webkit-scrollbar {
            width: 8px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.45);
            border-radius: 999px;
        }

        .notification-list::-webkit-scrollbar-thumb:hover {
            background: rgba(148, 163, 184, 0.7);
        }

        .notification-item {
            padding: 1rem 1.35rem;
            border-bottom: 1px solid rgba(226, 232, 240, 0.9);
            transition: background 0.22s ease, transform 0.22s ease;
            cursor: pointer;
            background: transparent;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item:hover {
            background: rgba(14, 165, 233, 0.06);
            transform: translateY(-1px);
        }

        .notification-item.unread {
            background: rgba(14, 165, 233, 0.1);
        }

        .notification-item.unread:hover {
            background: rgba(14, 165, 233, 0.14);
        }

        .notification-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
            background: rgba(14, 165, 233, 0.12);
        }

        .notification-icon i {
            color: currentColor;
        }

        .notification-content {
            min-width: 0;
        }

        .notification-title {
            font-size: 0.95rem;
            line-height: 1.4;
            margin-bottom: 0.35rem;
        }

        .notification-time {
            font-size: 0.78rem;
            color: #64748b;
            white-space: nowrap;
        }

        .notification-message {
            font-size: 0.82rem;
            line-height: 1.55;
            margin-bottom: 0.55rem;
            color: #525252;
            overflow-wrap: anywhere;
        }

        .notification-status {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.72rem;
            letter-spacing: 0.01em;
        }

        .notification-footer {
            padding: 1rem 1.35rem;
            border-top: 1px solid rgba(226, 232, 240, 0.95);
            background: #f8fafc;
        }

        .notification-footer .btn {
            min-height: 40px;
        }

        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        @media (max-width: 575px) {
            .dropdown-menu.notifications {
                width: min(100vw - 32px, 100%);
                min-width: auto;
                max-width: 100%;
                margin: 0 12px;
            }

            .notification-header,
            .notification-footer,
            .notification-item {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .notification-header {
                flex-direction: column;
                align-items: stretch;
            }

            .notification-header > div,
            .notification-footer {
                width: 100%;
            }

            .notification-footer .d-flex {
                flex-direction: column;
                align-items: stretch;
                gap: 0.75rem;
            }
        }

        .hover-lift:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            color: var(--text-dark);
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
            background: var(--card-bg);
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.12);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color);
        }

        .modal-footer {
            border-top: 1px solid var(--border-color);
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
    <div class="theme-toast" id="themeToast" role="status" aria-live="polite"></div>

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

    // Messages table may not exist in fresh/partial setups.
    // Avoid crashing dashboard if messages table/model isn't present.
    $globalMessageUnreadCount = 0;
    try {
        if (class_exists('App\\Models\\Message')) {
            $globalMessageUnreadCount = \App\Models\Message::where('receiver_id', Auth::id())
                ->where('is_read', false)
                ->count();
        }
    } catch (\Throwable $e) {
        $globalMessageUnreadCount = 0;
    }
@endphp

<!-- Top Navigation -->
<nav class="top-navbar navbar navbar-expand" id="topNavbar">
    <div class="container-fluid px-4 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3 w-100">
            <button class="topbar-icon d-lg-none topbar-mobile-toggle" type="button" id="mobileSidebarOpen" aria-label="Open sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand-custom" href="{{ route('dashboard') }}">
<i class="fas fa-laptop-code me-2"></i>Computer Laboratory Facilities Management System (CLFMS)
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
                <div class="dropdown-menu dropdown-menu-end notifications shadow-lg border-0 mt-3" aria-labelledby="notificationDropdown">
                    <div class="notification-header d-flex align-items-center justify-content-between gap-3">
                        <div>
                            <h6 class="fw-bold text-dark mb-0">
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
                            <button class="btn btn-sm btn-outline-primary rounded-pill px-3 py-2" onclick="markAllAsRead()">
                                <i class="fas fa-check-double me-1"></i>Mark all read
                            </button>
                        @endif
                    </div>

                    <div class="notification-list">
                        @forelse($globalNotifications as $notification)
                            <div class="notification-item {{ $notification->is_read ? '' : 'unread' }} hover-lift" onclick="markAsRead({{ $notification->id }}, '{{ $notification->action_url ?? '' }}')" style="cursor: pointer;" data-notification-id="{{ $notification->id }}">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="notification-icon">
                                        <i class="fas {{ $notification->icon_class ?? 'fa-info-circle' }} text-{{ $notification->color_class ?? 'primary' }}"></i>
                                    </div>
                                    <div class="notification-content w-100">
                                        <div class="d-flex justify-content-between align-items-start gap-2 mb-2 flex-wrap">
                                            <h6 class="notification-title mb-0 fw-semibold text-dark">
                                                {{ \Illuminate\Support\Str::limit($notification->title ?? 'Notification', 45) }}
                                            </h6>
                                            <small class="notification-time text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="notification-message text-muted mb-2">
                                            {{ \Illuminate\Support\Str::limit($notification->message ?? 'No details available.', 100) }}
                                        </p>
                                        @if(!$notification->is_read)
                                            <span class="badge notification-status bg-primary bg-opacity-15 text-primary small px-2 py-1 rounded-pill">
                                                <i class="fas fa-circle me-1" style="font-size: 6px;"></i>New
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 px-3">
                                <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted mb-2">No notifications yet</h6>
                                <p class="text-muted small mb-0">We'll notify you when there's something new</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="notification-footer p-3 border-top bg-light">
                        <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                            <a href="{{ route('notifications.index') }}" class="btn btn-primary btn-sm rounded-pill px-3 py-2">
                                <i class="fas fa-eye me-1"></i>View All
                            </a>
                            <small class="text-muted d-flex align-items-center gap-1 mb-0">
                                <i class="fas fa-clock"></i>{{ now()->format('g:i A') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            @if(! (Auth::user() && method_exists(Auth::user(), 'isAdmin') && Auth::user()->isAdmin()))
            <a href="{{ route('bug-reports.create') }}" class="topbar-icon btn btn-sm p-0" title="Report Bug" aria-label="Report Bug">
                <i class="fas fa-bug"></i>
            </a>
            @endif

            <a href="{{ route('messages.index') }}" class="topbar-icon btn btn-sm p-0" title="Messages" aria-label="Messages">
                <i class="fas fa-comments"></i>
                @if($globalMessageUnreadCount > 0)
                    <span class="notification-badge pulse">{{ $globalMessageUnreadCount }}</span>
                @endif
            </a>

            <div class="theme-toggle d-none d-lg-flex" role="group" aria-label="Theme mode">
                <button type="button" id="theme-system" title="System theme" aria-label="System theme">🖥️</button>
                <button type="button" id="theme-light" title="Light mode" aria-label="Light mode">☀️</button>
                <button type="button" id="theme-dark" title="Dark mode" aria-label="Dark mode">🌙</button>
            </div>

            <div class="dropdown">
                <button class="btn btn-sm p-0 d-flex align-items-center dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar me-2">
                        @if(Auth::user()->profile_picture_url)
                            <img src="{{ Auth::user()->profile_picture_url }}" alt="{{ Auth::user()->name }}" />
                        @else
                            <span class="text-primary fw-bold" style="font-size:1rem;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        @endif
                        <span class="user-status-dot"></span>
                    </div>
                    <div class="d-none d-md-flex flex-column text-start">
                        <span class="fw-semibold" style="font-size:0.95rem;">{{ Auth::user()->name }}</span>
                        <small class="text-muted" style="font-size:0.79rem;">{{ ucfirst(Auth::user()->role) }}</small>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 profile-dropdown-menu mt-3">
                    <li><div class="profile-menu-title">Account</div></li>
                    <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fas fa-user me-2"></i>View Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fas fa-edit me-2"></i>Edit Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider profile-dropdown-line"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
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

    // Search functionality
    (() => {
        const searchInput = document.querySelector('.search-input');
        const searchWrapper = document.querySelector('.search-wrapper');
        if (!searchInput) return;

        let debounceTimer;
        let selectedIndex = -1;
        let searchResults = [];

        // Create dropdown container
        const dropdown = document.createElement('div');
        dropdown.className = 'search-dropdown';
        dropdown.innerHTML = '<div class="search-loading">Searching...</div>';
        dropdown.style.display = 'none';
        dropdown.style.position = 'absolute';
        dropdown.style.top = '100%';
        dropdown.style.left = '0';
        dropdown.style.right = '0';
        dropdown.style.backgroundColor = 'var(--bs-body-bg)';
        dropdown.style.border = '1px solid var(--bs-border-color)';
        dropdown.style.borderRadius = '0.375rem';
        dropdown.style.marginTop = '0.5rem';
        dropdown.style.maxHeight = '400px';
        dropdown.style.overflowY = 'auto';
        dropdown.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
        dropdown.style.zIndex = '1050';

        searchWrapper.style.position = 'relative';
        searchWrapper.appendChild(dropdown);

        function renderResults(data) {
            if (!data || (data.equipment?.length === 0 && data.laboratories?.length === 0 && 
                         data.users?.length === 0 && data.borrowings?.length === 0)) {
                dropdown.innerHTML = '<div class="search-no-results" style="padding:12px 16px;color:var(--bs-text-muted);text-align:center;">No results found</div>';
                dropdown.style.display = 'block';
                return;
            }

            let html = '';
            const categories = [
                { key: 'equipment', title: '📦 Equipment', icon: 'fas fa-box' },
                { key: 'laboratories', title: '🔬 Laboratories', icon: 'fas fa-flask' },
                { key: 'users', title: '👤 Users', icon: 'fas fa-user' },
                { key: 'borrowings', title: '📋 Borrowings', icon: 'fas fa-clipboard' }
            ];

            categories.forEach(cat => {
                const items = data[cat.key] || [];
                if (items.length > 0) {
                    html += `<div class="search-category" style="border-bottom:1px solid var(--bs-border-color);">
                        <div style="padding:8px 16px;background:var(--bs-gray-100);color:var(--bs-text-muted);font-size:0.85rem;font-weight:600;">${cat.title}</div>`;
                    
                    items.forEach((item, idx) => {
                        html += `<a href="${item.url}" class="search-result-item" data-index="${idx}" 
                            style="display:flex;align-items:center;padding:10px 16px;text-decoration:none;color:var(--bs-body-color);border-bottom:1px solid var(--bs-border-color-translucent);cursor:pointer;transition:background-color 0.2s;">
                            <i style="margin-right:10px;color:var(--bs-text-muted);" class="${item.icon || 'fas fa-circle'}"></i>
                            <div>
                                <div style="font-weight:500;font-size:0.95rem;">${item.title}</div>
                                <div style="font-size:0.85rem;color:var(--bs-text-muted);">${item.subtitle || ''}</div>
                            </div>
                        </a>`;
                    });
                    
                    html += '</div>';
                }
            });

            dropdown.innerHTML = html;
            dropdown.style.display = 'block';

            // Add hover effects
            document.querySelectorAll('.search-result-item').forEach(item => {
                item.addEventListener('mouseenter', () => {
                    item.style.backgroundColor = 'var(--bs-gray-100)';
                });
                item.addEventListener('mouseleave', () => {
                    item.style.backgroundColor = 'transparent';
                });
            });
        }

        function performSearch(query) {
            if (query.trim().length < 2) {
                dropdown.style.display = 'none';
                return;
            }

            dropdown.innerHTML = '<div class="search-loading" style="padding:16px;text-align:center;color:var(--bs-text-muted);">Searching...</div>';
            dropdown.style.display = 'block';

            fetch(`/search?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    searchResults = data;
                    selectedIndex = -1;
                    renderResults(data);
                })
                .catch(err => {
                    console.error('Search error:', err);
                    dropdown.innerHTML = '<div style="padding:16px;text-align:center;color:var(--bs-danger);">Error searching</div>';
                });
        }

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();
            
            debounceTimer = setTimeout(() => {
                performSearch(query);
            }, 250);
        });

        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                dropdown.style.display = 'none';
                this.blur();
            }
            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault();
                const items = document.querySelectorAll('.search-result-item');
                if (items.length === 0) return;

                if (e.key === 'ArrowDown') {
                    selectedIndex = Math.min(selectedIndex + 1, items.length - 1);
                } else {
                    selectedIndex = Math.max(selectedIndex - 1, -1);
                }

                items.forEach((item, idx) => {
                    if (idx === selectedIndex) {
                        item.style.backgroundColor = 'var(--bs-gray-100)';
                        item.scrollIntoView({ block: 'nearest' });
                    } else {
                        item.style.backgroundColor = 'transparent';
                    }
                });
            }
            if (e.key === 'Enter') {
                e.preventDefault();
                const selectedItem = document.querySelector(`.search-result-item[data-index="${selectedIndex}"]`);
                if (selectedItem) {
                    window.location.href = selectedItem.href;
                }
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchWrapper.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });
    })();

    // =====================================
    // NOTIFICATION SYSTEM - Real-time updates
    // =====================================

    let notificationCheckInterval;

    function updateNotificationBadge() {
        fetch('{{ route("api.notifications.unreadCount") }}')
            .then(res => res.json())
            .then(data => {
                const badge = document.querySelector('.notification-badge');
                if (badge) {
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.style.display = 'inline-block';
                    } else {
                        badge.style.display = 'none';
                    }
                }
            })
            .catch(err => console.error('Error fetching unread count:', err));
    }

    function markAsRead(notificationId, actionUrl = null) {
        fetch('{{ route("api.notifications.unreadCount") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ notification_id: notificationId })
        })
        .catch(err => console.error('Error marking notification as read:', err));

        // Update badge
        setTimeout(() => updateNotificationBadge(), 100);

        // If there's an action URL, redirect
        if (actionUrl) {
            window.location.href = actionUrl;
        }
    }

    function markAllAsRead() {
        fetch('{{ route("notifications.readAll") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        })
        .then(() => {
            updateNotificationBadge();
            // Reload dropdown or page
            location.reload();
        })
        .catch(err => console.error('Error marking all as read:', err));
    }

    // Make functions globally available
    window.markAsRead = markAsRead;
    window.markAllAsRead = markAllAsRead;
    window.updateNotificationBadge = updateNotificationBadge;

    // Start polling for updates every 15 seconds
    document.addEventListener('DOMContentLoaded', () => {
        updateNotificationBadge(); // Initial load
        
        if (notificationCheckInterval) clearInterval(notificationCheckInterval);
        notificationCheckInterval = setInterval(() => {
            updateNotificationBadge();
        }, 15000); // Poll every 15 seconds
    });

    // Clean up on page leave
    window.addEventListener('beforeunload', () => {
        if (notificationCheckInterval) clearInterval(notificationCheckInterval);
    });
</script>

</body>
</html>
