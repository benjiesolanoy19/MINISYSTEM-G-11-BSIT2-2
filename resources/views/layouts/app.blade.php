<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Computer Laboratory Facilities Management System (CLFMS)')</title>
    
    <!-- Material UI CSS from CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* ===== LIGHT MODE COLOR SYSTEM ===== */
        :root {
            /* Brand Colors */
            --mdc-primary: #0ea5e9;
            --mdc-primary-dark: #0284c7;
            --mdc-primary-light: #38bdf8;
            --mdc-secondary: #10b981;
            --mdc-secondary-dark: #059669;
            --mdc-secondary-light: #6ee7b7;
            --mdc-error: #ef4444;
            --mdc-error-light: #f87171;
            --mdc-warning: #f59e0b;
            --mdc-warning-light: #fbbf24;
            --mdc-info: #3b82f6;
            --mdc-success: #10b981;
            
            /* Text Colors */
            --text-dark: #1e293b;
            --text-secondary: #334155;
            --text-muted: #64748b;
            --text-light: #94a3b8;
            
            /* Background & Surfaces (Light Mode) */
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --surface-1: #ffffff;
            --surface-2: #f8fafc;
            --surface-3: #f1f5f9;
            --surface-4: #e2e8f0;
            
            /* Borders & Dividers */
            --border-color: #e2e8f0;
            --border-light: #cbd5e1;
            --border-lightest: #e0e7ff;
            
            /* Shadows */
            --shadow-xs: 0 0px 1px rgba(0, 0, 0, 0.04);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 20px 60px rgba(0, 0, 0, 0.15);
            
            /* Overlay */
            --overlay-light: rgba(0, 0, 0, 0.04);
            --overlay-medium: rgba(0, 0, 0, 0.08);
            --overlay-dark: rgba(0, 0, 0, 0.12);
        }

        /* ===== DARK MODE COLOR SYSTEM ===== */
        [data-theme="dark"] {
            /* Brand Colors (lighter for dark mode) */
            --mdc-primary: #38bdf8;
            --mdc-primary-dark: #0ea5e9;
            --mdc-primary-light: #60a5fa;
            --mdc-secondary: #10b981;
            --mdc-secondary-dark: #059669;
            --mdc-secondary-light: #6ee7b7;
            --mdc-error: #f87171;
            --mdc-error-light: #fca5a5;
            --mdc-warning: #fbbf24;
            --mdc-warning-light: #fcd34d;
            --mdc-info: #60a5fa;
            --mdc-success: #10b981;
            
            /* Text Colors (inverted for dark mode) */
            --text-dark: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --text-light: #64748b;
            
            /* Background & Surfaces (Dark Mode - Layered) */
            --light-bg: #0f172a;
            --card-bg: #1e293b;
            --surface-1: #0f172a;
            --surface-2: #1e293b;
            --surface-3: #334155;
            --surface-4: #475569;
            
            /* Borders & Dividers */
            --border-color: rgba(148, 163, 184, 0.12);
            --border-light: rgba(203, 213, 225, 0.08);
            --border-lightest: rgba(226, 232, 240, 0.06);
            
            /* Shadows (stronger in dark mode for contrast) */
            --shadow-xs: 0 0px 1px rgba(0, 0, 0, 0.3);
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.4);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.5);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, 0.6);
            --shadow-xl: 0 20px 60px rgba(0, 0, 0, 0.7);
            
            /* Overlay */
            --overlay-light: rgba(255, 255, 255, 0.04);
            --overlay-medium: rgba(255, 255, 255, 0.08);
            --overlay-dark: rgba(255, 255, 255, 0.12);
        }

        /* ===== SMOOTH THEME TRANSITIONS ===== */
        :root, body, .card, .navbar, .btn, .form-control, .form-select, .dropdown-menu, .modal-content, .table, .search-wrapper, .top-navbar, .badge, .sidebar, .sidebar-item, .nav-link, .alert, input, textarea, select {
            transition: background-color 240ms cubic-bezier(0.4, 0, 0.2, 1), color 240ms cubic-bezier(0.4, 0, 0.2, 1), border-color 240ms cubic-bezier(0.4, 0, 0.2, 1), box-shadow 240ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== GLOBAL LIGHT MODE STYLES ===== */
        body, html {
            background: var(--light-bg);
            color: var(--text-dark);
        }

        /* ===== COMPONENT DARK MODE FIXES ===== */

        /* Sidebar Dark Mode */
        [data-theme="dark"] .sidebar {
            background: var(--surface-2);
            border-right-color: var(--border-color);
        }

        [data-theme="dark"] .sidebar-link {
            color: var(--text-secondary);
        }

        [data-theme="dark"] .sidebar-link:hover {
            background: var(--surface-3);
            color: var(--mdc-primary);
        }

        [data-theme="dark"] .sidebar-link.active {
            background: linear-gradient(90deg, var(--mdc-primary), var(--mdc-secondary));
            color: white;
        }

        [data-theme="dark"] .sidebar-header {
            border-bottom-color: var(--border-color);
        }

        [data-theme="dark"] .sidebar-subtitle {
            color: var(--text-muted);
        }

        /* Navbar Dark Mode */
        [data-theme="dark"] .navbar {
            background: var(--surface-2) !important;
            border-bottom-color: var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        }

        [data-theme="dark"] .nav-link {
            color: var(--text-secondary) !important;
        }

        [data-theme="dark"] .nav-link:hover {
            color: var(--mdc-primary) !important;
            background: var(--overlay-medium) !important;
        }

        [data-theme="dark"] .dropdown-menu {
            background: var(--surface-2);
            border-color: var(--border-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        [data-theme="dark"] .dropdown-item {
            color: var(--text-secondary);
        }

        [data-theme="dark"] .dropdown-item:hover,
        [data-theme="dark"] .dropdown-item.active {
            background: var(--surface-3);
            color: var(--mdc-primary);
        }

        /* Card Dark Mode */
        [data-theme="dark"] .card {
            background: var(--surface-2);
            border-color: var(--border-color);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
        }

        [data-theme="dark"] .card-header {
            background: linear-gradient(135deg, var(--mdc-primary), var(--mdc-secondary));
            border-color: var(--border-color);
        }

        [data-theme="dark"] .card-body {
            background: var(--surface-2);
            color: var(--text-dark);
        }

        /* Form Elements Dark Mode */
        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select,
        [data-theme="dark"] input,
        [data-theme="dark"] textarea,
        [data-theme="dark"] select {
            background: var(--surface-3);
            color: var(--text-dark);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .form-control::placeholder,
        [data-theme="dark"] textarea::placeholder {
            color: var(--text-muted);
            opacity: 1;
        }

        [data-theme="dark"] .form-control:focus,
        [data-theme="dark"] .form-select:focus,
        [data-theme="dark"] input:focus,
        [data-theme="dark"] textarea:focus {
            background: var(--surface-3);
            border-color: var(--mdc-primary);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1);
        }

        [data-theme="dark"] .form-label {
            color: var(--text-dark);
        }

        /* Table Dark Mode */
        [data-theme="dark"] .table {
            color: var(--text-dark);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .table thead th {
            background: var(--surface-3);
            border-color: var(--border-color);
            color: var(--text-dark);
            font-weight: 600;
        }

        [data-theme="dark"] .table tbody td {
            background: var(--surface-2);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        [data-theme="dark"] .table tbody tr:hover td {
            background: var(--surface-3);
        }

        /* Modal Dark Mode */
        [data-theme="dark"] .modal-content {
            background: var(--surface-2);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .modal-header {
            background: var(--surface-3);
            border-color: var(--border-color);
            color: var(--text-dark);
        }

        [data-theme="dark"] .modal-body {
            color: var(--text-secondary);
        }

        [data-theme="dark"] .modal-footer {
            border-color: var(--border-color);
        }

        [data-theme="dark"] .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.6);
        }

        /* Alert Dark Mode */
        [data-theme="dark"] .alert {
            background: var(--overlay-medium);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        [data-theme="dark"] .alert-primary {
            background: rgba(56, 189, 248, 0.1);
            border-color: rgba(56, 189, 248, 0.3);
            color: var(--mdc-primary);
        }

        [data-theme="dark"] .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
            color: var(--mdc-secondary);
        }

        [data-theme="dark"] .alert-danger {
            background: rgba(248, 113, 113, 0.1);
            border-color: rgba(248, 113, 113, 0.3);
            color: var(--mdc-error);
        }

        [data-theme="dark"] .alert-warning {
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.3);
            color: var(--mdc-warning);
        }

        /* Button Dark Mode */
        [data-theme="dark"] .btn-primary {
            background: var(--mdc-primary);
            border-color: var(--mdc-primary);
            color: white;
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.2);
        }

        [data-theme="dark"] .btn-primary:hover {
            background: var(--mdc-primary-light);
            border-color: var(--mdc-primary-light);
            box-shadow: 0 6px 16px rgba(56, 189, 248, 0.3);
        }

        [data-theme="dark"] .btn-secondary {
            background: var(--surface-3);
            border-color: var(--border-color);
            color: var(--text-dark);
        }

        [data-theme="dark"] .btn-secondary:hover {
            background: var(--surface-4);
            border-color: var(--border-light);
        }

        [data-theme="dark"] .btn-outline-primary {
            color: var(--mdc-primary);
            border-color: var(--mdc-primary);
        }

        [data-theme="dark"] .btn-outline-primary:hover {
            background: var(--mdc-primary);
            color: white;
        }

        /* Badge Dark Mode */
        [data-theme="dark"] .badge {
            background: var(--mdc-primary);
            color: white;
        }

        [data-theme="dark"] .badge-primary {
            background: var(--mdc-primary);
        }

        [data-theme="dark"] .badge-success {
            background: var(--mdc-secondary);
        }

        [data-theme="dark"] .badge-danger {
            background: var(--mdc-error);
        }

        /* Popover & Tooltip Dark Mode */
        [data-theme="dark"] .popover {
            background: var(--surface-2);
            border-color: var(--border-color);
        }

        [data-theme="dark"] .popover-header {
            background: var(--surface-3);
            border-color: var(--border-color);
            color: var(--text-dark);
        }

        [data-theme="dark"] .popover-body {
            color: var(--text-secondary);
        }

        [data-theme="dark"] .tooltip-inner {
            background: var(--surface-3);
            color: var(--text-dark);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        /* Pagination Dark Mode */
        [data-theme="dark"] .pagination .page-link {
            background: var(--surface-3);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        [data-theme="dark"] .pagination .page-link:hover {
            background: var(--surface-4);
            border-color: var(--mdc-primary);
            color: var(--mdc-primary);
        }

        [data-theme="dark"] .pagination .page-item.active .page-link {
            background: var(--mdc-primary);
            border-color: var(--mdc-primary);
            color: white;
        }

        /* Input Group Dark Mode */
        [data-theme="dark"] .input-group-text {
            background: var(--surface-3);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        /* List Group Dark Mode */
        [data-theme="dark"] .list-group-item {
            background: var(--surface-3);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }

        [data-theme="dark"] .list-group-item:hover {
            background: var(--surface-4);
        }

        [data-theme="dark"] .list-group-item.active {
            background: var(--mdc-primary);
            border-color: var(--mdc-primary);
        }

        /* Spinner Dark Mode */
        [data-theme="dark"] .spinner-border {
            border-color: var(--overlay-medium);
            border-right-color: var(--mdc-primary);
        }

        /* Progress Bar Dark Mode */
        [data-theme="dark"] .progress {
            background: var(--surface-3);
        }

        [data-theme="dark"] .progress-bar {
            background: linear-gradient(90deg, var(--mdc-primary), var(--mdc-secondary));
        }

        /* Breadcrumb Dark Mode */
        [data-theme="dark"] .breadcrumb {
            background: transparent;
        }

        [data-theme="dark"] .breadcrumb-item {
            color: var(--text-secondary);
        }

        [data-theme="dark"] .breadcrumb-item.active {
            color: var(--text-muted);
        }

        [data-theme="dark"] .breadcrumb-item a {
            color: var(--mdc-primary);
        }

        /* Well/Code Block Dark Mode */
        [data-theme="dark"] .well,
        [data-theme="dark"] pre,
        [data-theme="dark"] code {
            background: var(--surface-3);
            color: var(--text-secondary);
            border-color: var(--border-color);
        }

        /* Accent utilities */
        [data-theme="dark"] .bg-light {
            background: var(--surface-3) !important;
        }

        [data-theme="dark"] .text-muted {
            color: var(--text-muted) !important;
        }

        [data-theme="dark"] .text-secondary {
            color: var(--text-secondary) !important;
        }

        /* Link colors */
        [data-theme="dark"] a {
            color: var(--mdc-primary);
        }

        [data-theme="dark"] a:hover {
            color: var(--mdc-primary-light);
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
            transition: background-color 220ms ease, color 220ms ease, border-color 220ms ease, box-shadow 220ms ease;
        }

        /* Theme toggle button */
        .theme-toggle {
            position: fixed;
            right: 18px;
            top: 18px;
            z-index: 1100;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.9);
            border-radius: 999px;
            padding: 6px;
            box-shadow: var(--shadow-md);
            backdrop-filter: blur(6px);
        }

        [data-theme="dark"] .theme-toggle {
            background: rgba(10,14,20,0.6);
            border: 1px solid rgba(255,255,255,0.04);
        }

        .theme-toggle button {
            border: none;
            background: transparent;
            padding: 8px 10px;
            border-radius: 999px;
            cursor: pointer;
            font-size: 16px;
        }

        .theme-toggle button.active {
            background: linear-gradient(90deg, var(--mdc-primary), var(--mdc-secondary));
            color: white;
            box-shadow: 0 6px 18px rgba(2,132,199,0.18);
        }

        .theme-toast {
            position: fixed;
            right: 22px;
            top: 74px;
            background: rgba(0,0,0,0.7);
            color: #fff;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            opacity: 0;
            transform: translateY(-6px);
            transition: opacity 240ms ease, transform 240ms ease;
            z-index: 1110;
            pointer-events: none;
        }

        .theme-toast.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
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
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Material Design Elevation/Shadow Styles */
        .mdc-elevation-1 {
            box-shadow: var(--shadow-sm);
        }
        
        .mdc-elevation-2 {
            box-shadow: var(--shadow-md);
        }
        
        .mdc-elevation-3 {
            box-shadow: var(--shadow-lg);
        }
        
        /* Navbar Enhancement */
        .navbar {
            background: var(--surface) !important;
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-sm);
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .navbar:hover {
            box-shadow: var(--shadow-md);
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            padding: 10px 20px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            margin: 0 5px;
            border-radius: 8px;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--mdc-primary), var(--mdc-secondary));
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 1px;
        }
        
        .nav-link:hover {
            color: var(--mdc-primary) !important;
            background: rgba(14, 165, 233, 0.1);
            transform: translateY(-2px);
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Material Design Buttons */
        .btn {
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .btn-primary {
            background-color: var(--mdc-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
        }
        
        .btn-primary:hover {
            background-color: var(--mdc-primary-dark);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
            transform: translateY(-3px);
        }
        
        .btn-success {
            background-color: var(--mdc-secondary);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        
        .btn-success:hover {
            background-color: #059669;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
            transform: translateY(-3px);
        }
        
        .btn-outline-primary {
            color: var(--mdc-primary);
            border: 2px solid var(--mdc-primary);
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background: var(--mdc-primary);
            color: white;
            transform: translateY(-3px);
        }
        
        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            background: var(--card-bg);
            position: relative;
        }
        
        .card::before {
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
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }
        
        .card:hover::before {
            transform: scaleX(1);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%);
            color: white;
            border: none;
            padding: 20px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .card-body {
            padding: 20px;
        }
        
        /* Form Controls */
        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
        }
        
        .form-control:focus {
            border-color: var(--mdc-primary);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
            outline: none;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-size: 0.95rem;
        }
        
        /* Material Design Chips */
        .chip {
            display: inline-block;
            padding: 6px 12px;
            background: rgba(14, 165, 233, 0.1);
            color: var(--mdc-primary);
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid var(--mdc-primary);
        }
        
        .chip:hover {
            background: var(--mdc-primary);
            color: white;
            transform: scale(1.05);
        }
        
        /* Badge Styling */
        .badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
        }
        
        .badge-primary {
            background: linear-gradient(135deg, var(--mdc-primary), var(--mdc-primary-dark));
            color: white;
        }
        
        .badge-success {
            background: linear-gradient(135deg, var(--mdc-secondary), #059669);
            color: white;
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--text-dark) 0%, #0f172a 100%);
            color: #fff;
            padding: 40px 0 20px;
            margin-top: 60px;
            position: relative;
        }
        
        footer a {
            color: var(--mdc-primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        footer a:hover {
            color: var(--mdc-secondary);
        }
        
        /* Animations for scroll and entrance */
        [data-scroll] {
            opacity: 0;
            transform: translateY(20px);
        }
        
        /* Loading Spinner */
        .spinner-gradient {
            background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%);
        }
        
        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 10px;
            border-left: 4px solid;
            padding: 15px 20px;
            animation: slideInDown 0.4s ease;
        }
        
        .alert-primary {
            background: rgba(14, 165, 233, 0.1);
            border-left-color: var(--mdc-primary);
            color: var(--mdc-primary);
        }
        
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-left-color: var(--mdc-secondary);
            color: var(--mdc-secondary);
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-left-color: var(--mdc-error);
            color: var(--mdc-error);
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
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        /* Utility Classes */
        .gradient-text {
            background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--mdc-primary) 0%, var(--mdc-secondary) 100%);
        }
        
        .ripple-effect {
            position: relative;
            overflow: hidden;
        }
        
        .ripple-effect::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1);
            transform-origin: 50% 50%;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(20);
                opacity: 0;
            }
        }
        
        .ripple-effect:active::after {
            animation: ripple 0.6s ease-out;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    @yield('content')
    
    <!-- Theme toggle button - Only show on authenticated pages -->
    @if(auth()->check() && !request()->is('login') && !request()->is('register') && !request()->is('password/*'))
    <div class="theme-toggle" id="themeToggle" aria-hidden="false">
        <button id="theme-system" title="Follow system" aria-label="System theme">🖥️</button>
        <button id="theme-light" title="Light mode" aria-label="Light mode">☀️</button>
        <button id="theme-dark" title="Dark mode" aria-label="Dark mode">🌙</button>
    </div>
    @endif

    <div class="theme-toast" id="themeToast" role="status" aria-live="polite"></div>
    
    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.0/ScrollTrigger.min.js"></script>
    
    <!-- Initialize AOS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-in-out-quart',
                once: true,
                offset: 100,
                delay: 0
            });

            // Register GSAP ScrollTrigger
            gsap.registerPlugin(ScrollTrigger);
        });
    </script>
    <script>
        (function(){
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

            function showToast(msg){
                if(!toast) return;
                toast.textContent = msg;
                toast.classList.add('show');
                clearTimeout(toast._t);
                toast._t = setTimeout(()=> toast.classList.remove('show'), 1600);
            }

            function setActive(mode){
                [btnSystem, btnLight, btnDark].forEach(b=> b && b.classList.remove('active'));
                if(mode === 'system' && btnSystem) btnSystem.classList.add('active');
                if(mode === 'light' && btnLight) btnLight.classList.add('active');
                if(mode === 'dark' && btnDark) btnDark.classList.add('active');
            }

            function setTheme(mode, save=true){
                if(save) localStorage.setItem(THEME_KEY, mode);
                if(mode === 'system'){
                    applyDark(mq.matches);
                    // listen for system changes
                    if(!systemListener){
                        systemListener = (e)=> applyDark(e.matches);
                        try{ mq.addEventListener('change', systemListener); }catch(e){ mq.addListener(systemListener); }
                    }
                } else {
                    applyDark(mode === 'dark');
                    if(systemListener){ try{ mq.removeEventListener('change', systemListener);}catch(e){ mq.removeListener(systemListener);} systemListener = null; }
                }
                setActive(mode);
                showToast('Theme: ' + (mode === 'system' ? 'System' : (mode === 'dark' ? 'Dark' : 'Light')) );
            }

            document.addEventListener('DOMContentLoaded', ()=>{
                const saved = localStorage.getItem(THEME_KEY) || 'system';
                setTheme(saved, false);
            });

            if(btnSystem) btnSystem.addEventListener('click', ()=> setTheme('system'));
            if(btnLight) btnLight.addEventListener('click', ()=> setTheme('light'));
            if(btnDark) btnDark.addEventListener('click', ()=> setTheme('dark'));
        })();
    </script>
    
    @yield('scripts')
    
    {{-- Import Vite assets (requires npm run dev/build) --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</body>
</html>
</parameter>
</create_file>
