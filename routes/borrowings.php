<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowRequestController;

// Student / common routes
Route::middleware(['auth'])->group(function () {
    Route::get('/equipment', [BorrowRequestController::class, 'indexEquipment'])->name('equipment.index');
    Route::post('/borrow', [BorrowRequestController::class, 'createBorrow'])->name('borrow.create');

    Route::middleware(['auth'])->group(function () {
        // Staff routes
        Route::get('/staff/pending-requests', [BorrowRequestController::class, 'staffPendingRequests'])->name('staff.pending-requests');
        Route::post('/staff/approve/{request_id}', [BorrowRequestController::class, 'staffApprove'])->name('staff.approve');
        Route::post('/staff/reject/{request_id}', [BorrowRequestController::class, 'staffReject'])->name('staff.reject');

        // Staff/Admin full list
        Route::get('/borrows', [BorrowRequestController::class, 'allBorrows'])->name('borrows.index');
    });

    // Admin routes (delegated to controller methods - minimal views to implement)
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/users', [BorrowRequestController::class, 'adminUsers'])->name('admin.users.index');
        Route::get('/admin/equipment', [BorrowRequestController::class, 'adminEquipment'])->name('admin.equipment.index');
    });
});

