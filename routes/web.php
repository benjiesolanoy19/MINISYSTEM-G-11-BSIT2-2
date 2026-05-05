<?php
/**
 * CLFMS Routes
 * Laravel-style routing
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;

// Public Routes
Route::get('/', [AuthController::class, 'welcome'])->name('welcome');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


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
    
// Borrowings
    Route::get('/borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');
    Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    Route::get('/borrowings/list', [BorrowingController::class, 'index'])->name('borrowings.list');
    Route::get('/borrowings/manage', [BorrowingController::class, 'manage'])->name('borrowings.manage');
    Route::post('/borrowings/{borrowing}/approve', [BorrowingController::class, 'approve'])->name('borrowings.approve');
    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'return'])->name('borrowings.return');
    Route::post('/borrowings/{borrowing}/damaged', [BorrowingController::class, 'markDamaged'])->name('borrowings.damaged');
    Route::post('/borrowings/{borrowing}/lost', [BorrowingController::class, 'markLost'])->name('borrowings.lost');
    
    // Equipment
    Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
    Route::get('/equipment/create', [EquipmentController::class, 'create'])->name('equipment.create');
    Route::post('/equipment', [EquipmentController::class, 'store'])->name('equipment.store');
    Route::get('/equipment/{id}/edit', [EquipmentController::class, 'edit'])->name('equipment.edit');
    Route::put('/equipment/{id}', [EquipmentController::class, 'update'])->name('equipment.update');
    Route::delete('/equipment/{id}', [EquipmentController::class, 'destroy'])->name('equipment.destroy');
    
    // Incidents
    Route::get('/incidents/report', [IncidentController::class, 'report'])->name('incidents.report');
    Route::post('/incidents', [IncidentController::class, 'store'])->name('incidents.store');
    Route::get('/incidents', [IncidentController::class, 'index'])->name('incidents.index');
    Route::get('/incidents/list', [IncidentController::class, 'index'])->name('incidents.list');
    
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    
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

    
    // Admin Routes (Admin only)
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/reports/usage', [AdminController::class, 'usage'])->name('reports.usage');
        Route::get('/reports/inventory', [AdminController::class, 'inventory'])->name('reports.inventory');
        Route::get('/reports/transactions', [AdminController::class, 'transactions'])->name('reports.transactions');
    });
});
