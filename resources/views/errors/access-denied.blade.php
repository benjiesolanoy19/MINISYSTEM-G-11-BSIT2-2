@extends('layouts.app')

@section('title', 'Access Denied')

@section('styles')
<style>
    .access-denied-wrap{min-height:60vh;display:flex;align-items:center;justify-content:center;padding:24px;}
    .panel{max-width:720px;width:100%;background:#fff;border-radius:24px;box-shadow:0 24px 70px rgba(15,23,42,.10);border:1px solid rgba(226,232,240,.9);padding:28px;}
    .badge{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:999px;font-weight:800;background:rgba(239,68,68,.10);color:#991b1b;border:1px solid rgba(239,68,68,.20)}
    .btn-primary{border-radius:16px;padding:12px 18px;font-weight:900}
</style>
@endsection

@section('content')
<div class="access-denied-wrap">
    <div class="panel">
        <div class="mb-3">
            <span class="badge"><i class="fas fa-lock"></i> Access Denied</span>
        </div>
        <h2 class="mb-2 fw-bold">You don’t have permission to access this page.</h2>
        <p class="text-muted mb-4">Role: <strong>{{ Auth::user()->role ?? 'unknown' }}</strong></p>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
            </a>
            <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                <i class="fas fa-user me-2"></i>My Profile
            </a>
        </div>
    </div>
</div>
@endsection

