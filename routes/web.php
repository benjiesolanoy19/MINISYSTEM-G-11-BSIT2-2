<?php
/**
 * CLFMS Routes
 * Laravel-style routing
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\BugReportController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\BorrowRequestController;
use App\Http\Controllers\SearchController;

require_once __DIR__ . '/borrowings.php';

// Backward-compatible route names for dashboard UI
// Map legacy route names to new borrowing system endpoints
Route::get('/borrowings', [\App\Http\Controllers\BorrowRequestController::class, 'index'])->name('borrowings.index');
Route::get('/borrowings/create', [\App\Http\Controllers\BorrowRequestController::class, 'indexEquipment'])->name('borrowings.create');


// NOTE: Legacy /borrowings/* routes were removed; new borrow flow is implemented in routes/borrowings.php.

// Public Routes
Route::get('/', [AuthController::class, 'welcome'])->name('welcome');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Authentication Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/authenticate', [AdminAuthController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Test route to check auth
Route::get('/test-auth', function() {
    return response()->json([
        'authenticated' => auth()->check(),
        'user' => auth()->user(),
        'timestamp' => now()
    ]);
});

// Quick health check
Route::get('/health', function() {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'memory' => memory_get_usage(true) / 1024 / 1024 . ' MB'
    ]);
});

// Debug login - test user lookup
Route::get('/debug/user/{login}', function($login) {
    $user = \App\Models\User::where('email', $login)
        ->orWhere('username', $login)
        ->first(['id', 'name', 'email', 'username']);
    
    return response()->json([
        'found' => $user !== null,
        'user' => $user
    ]);
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
// Equipment (legacy UI for equipment management)
    Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
    Route::get('/equipment/create', [EquipmentController::class, 'create'])->name('equipment.create');
    Route::post('/equipment', [EquipmentController::class, 'store'])->name('equipment.store');
    Route::get('/equipment/{id}', [EquipmentController::class, 'show'])->name('equipment.show');
    Route::get('/equipment/{id}/edit', [EquipmentController::class, 'edit'])->name('equipment.edit');
    Route::put('/equipment/{id}', [EquipmentController::class, 'update'])->name('equipment.update');
    Route::delete('/equipment/{id}', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
    Route::post('/equipment/{id}/borrow', [BorrowRequestController::class, 'store'])->name('equipment.borrow');
    
    // Incidents
    Route::get('/incidents/report', [IncidentController::class, 'report'])->name('incidents.report');
    Route::post('/incidents', [IncidentController::class, 'store'])->name('incidents.store');
    Route::get('/incidents', [IncidentController::class, 'index'])->name('incidents.index');
    Route::get('/incidents/list', [IncidentController::class, 'index'])->name('incidents.list');
    
    // Bug Reports
    Route::get('/bug-reports/create', [BugReportController::class, 'create'])->name('bug-reports.create');
    Route::post('/bug-reports', [BugReportController::class, 'store'])->name('bug-reports.store');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    // Bug report tickets
    Route::get('/bug-reports/{bug_report}', [BugReportController::class, 'show'])->name('bug-reports.show');
    Route::post('/bug-reports/{bug_report}/comment', [BugReportController::class, 'comment'])->name('bug-reports.comment');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications/read/all', [NotificationController::class, 'destroyRead'])->name('notifications.destroyRead');
    Route::get('/api/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('api.notifications.unreadCount');
    Route::get('/api/notifications/recent/{limit?}', [NotificationController::class, 'getRecent'])->name('api.notifications.recent');
    
    // Logs
    Route::get('/logs/timein', [LogController::class, 'timein'])->name('logs.timein');
    Route::post('/logs/timein', [LogController::class, 'storeTimein']);
    Route::get('/logs/timeout', [LogController::class, 'timeout'])->name('logs.timeout');
    Route::post('/logs/timeout', [LogController::class, 'storeTimeout']);
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Search Routes
    Route::get('/search', [\App\Http\Controllers\SearchController::class, 'global'])->name('search.global');
    Route::get('/search/equipment', [\App\Http\Controllers\SearchController::class, 'equipment'])->name('search.equipment');

    
    // Admin Routes (Admin only)
Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/reports/usage', [AdminController::class, 'usage'])->name('reports.usage');
        Route::get('/reports/inventory', [AdminController::class, 'inventory'])->name('reports.inventory');
        Route::get('/reports/transactions', [AdminController::class, 'transactions'])->name('reports.transactions');
        Route::get('/bug-reports', [BugReportController::class, 'index'])->name('bug-reports.index');
        Route::put('/bug-reports/{bug_report}', [BugReportController::class, 'update'])->name('bug-reports.update');
        Route::put('/bug-reports/{bug_report}/assign', [BugReportController::class, 'assign'])->name('bug-reports.assign');
    });
});
