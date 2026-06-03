@extends('layouts.app')

@section('title', 'Admin Dashboard - ICTFE')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .admin-header {
            background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            color: white;
            padding: 40px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.2);
        }

        .admin-header h1 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-header-icon {
            font-size: 40px;
            background: rgba(255, 255, 255, 0.2);
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-admin-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-radius: 8px;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-admin-logout:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.6);
        }

        .admin-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #0ea5e9;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .stat-card-icon {
            font-size: 32px;
            color: #0ea5e9;
            margin-bottom: 15px;
        }

        .stat-card-label {
            color: #64748b;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .stat-card-value {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
        }

        .admin-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .admin-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .admin-card h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-card h3 i {
            color: #0ea5e9;
            font-size: 22px;
        }

        .btn-admin-nav {
            background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-admin-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        .log-item {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .log-item:last-child {
            border-bottom: none;
        }

        .log-timestamp {
            color: #94a3b8;
            font-weight: 600;
            margin-right: 10px;
        }

        .log-action {
            color: #1e293b;
        }

        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .admin-header h1 {
                flex-direction: column;
            }

            .admin-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-5">
        <div class="admin-header">
            <h1>
                <div class="admin-header-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <span>Admin Control Panel</span>
            </h1>
            <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-admin-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </div>

        <!-- Statistics Cards -->
        <div class="admin-stats">
            <div class="stat-card">
                <div class="stat-card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-card-label">Total Users</div>
                <div class="stat-card-value">{{ $totalUsers }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-card-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-card-label">Students</div>
                <div class="stat-card-value">{{ $studentCount }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-card-icon">
                    <i class="fas fa-chalkboard-user"></i>
                </div>
                <div class="stat-card-label">Staff Members</div>
                <div class="stat-card-value">{{ $staffCount }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-card-icon">
                    <i class="fas fa-microchip"></i>
                </div>
                <div class="stat-card-label">Equipment</div>
                <div class="stat-card-value">{{ $totalEquipment }}</div>
            </div>
        </div>

        <!-- Admin Content -->
        <div class="admin-content">
            <!-- Management Cards -->
            <div class="admin-card">
                <h3>
                    <i class="fas fa-users-cog"></i>
                    User Management
                </h3>
                <p style="color: #64748b; margin-bottom: 20px; font-size: 14px;">
                    View, manage, and administer all system users including students, faculty, and staff.
                </p>
                <a href="{{ route('admin.users') }}" class="btn-admin-nav">
                    <i class="fas fa-list"></i>
                    View All Users
                </a>
            </div>

            <div class="admin-card">
                <h3>
                    <i class="fas fa-computer"></i>
                    Equipment Management
                </h3>
                <p style="color: #64748b; margin-bottom: 20px; font-size: 14px;">
                    Manage all ICT facilities, equipment inventory, and their availability status.
                </p>
                <a href="{{ route('admin.equipment') }}" class="btn-admin-nav">
                    <i class="fas fa-cogs"></i>
                    Manage Equipment
                </a>
            </div>

            <!-- Recent Activity -->
            <div class="admin-card">
                <h3>
                    <i class="fas fa-history"></i>
                    System Logs
                </h3>
                <p style="color: #64748b; margin-bottom: 20px; font-size: 14px;">
                    Monitor system activities and user actions for security and audit purposes.
                </p>
                <a href="{{ route('admin.logs') }}" class="btn-admin-nav">
                    <i class="fas fa-file-alt"></i>
                    View System Logs
                </a>
            </div>

            <!-- Recent Activities -->
            <div class="admin-card">
                <h3>
                    <i class="fas fa-chart-line"></i>
                    Quick Stats
                </h3>
                <div style="font-size: 14px; color: #64748b; line-height: 1.8;">
                    <div><strong>System Status:</strong> <span style="color: #10b981;">✓ Operational</span></div>
                    <div><strong>Last Login:</strong> Just now</div>
                    <div><strong>Logged In As:</strong> Administrator</div>
                    <div><strong>Session Duration:</strong> Active</div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Log -->
        @if($recentLogs->count() > 0)
            <div class="admin-card" style="margin-top: 20px;">
                <h3>
                    <i class="fas fa-clipboard-list"></i>
                    Recent Activity
                </h3>
                <div>
                    @foreach($recentLogs as $log)
                        <div class="log-item">
                            <span class="log-timestamp">{{ $log->created_at->format('M d, H:i') }}</span>
                            <span class="log-action">{{ $log->action ?? 'System Activity' }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
