@extends('layouts.app')

@section('title', 'User Management - Admin - ICTFE')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .admin-header {
            background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-radius: 8px;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.6);
        }

        .users-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .users-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th {
            background: #f8fafc;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #1e293b;
            border-bottom: 2px solid #e2e8f0;
        }

        .users-table td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
        }

        .users-table tr:hover {
            background: #f8fafc;
        }

        .role-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .role-student {
            background: #dbeafe;
            color: #1e40af;
        }

        .role-staff {
            background: #dcfce7;
            color: #166534;
        }

        .role-admin {
            background: #fed7aa;
            color: #92400e;
        }

        .pagination-container {
            padding: 20px;
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .pagination-link {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            text-decoration: none;
            color: #0ea5e9;
            transition: all 0.2s ease;
        }

        .pagination-link:hover {
            background: #0ea5e9;
            color: white;
        }

        .pagination-link.active {
            background: #0ea5e9;
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid py-5">
        <div class="admin-header">
            <h1><i class="fas fa-users" style="margin-right: 10px;"></i>User Management</h1>
            <a href="{{ route('admin.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>

        <div class="users-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>#{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="role-badge role-{{ $user->role }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px;">
                                <i class="fas fa-inbox" style="font-size: 24px; color: #cbd5e1; margin-bottom: 10px;"></i>
                                <p style="color: #94a3b8;">No users found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($users->hasPages())
                <div class="pagination-container">
                    {{ $users->links('pagination::simple-bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
@endsection
