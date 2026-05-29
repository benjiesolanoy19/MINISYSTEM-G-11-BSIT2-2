<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowRequestController;

// Student / common routes
Route::middleware(['auth'])->prefix('borrowings')->group(function () {
    Route::get('/equipment', [BorrowRequestController::class, 'indexEquipment'])->name('borrowings.equipment.index');
    Route::post('/borrow', [BorrowRequestController::class, 'createBorrow'])->name('borrow.create');
    Route::get('/return-equipment', [BorrowRequestController::class, 'showReturnEquipment'])->name('borrowings.return-equipment');
    Route::post('/submit-return', [BorrowRequestController::class, 'submitReturn'])->name('borrowings.submit-return');
    Route::post('/return-request/{request_id}', [BorrowRequestController::class, 'studentRequestReturn'])->name('borrowings.request-return');

    // Staff/Admin processing routes
    Route::get('/staff/pending-requests', [BorrowRequestController::class, 'staffPendingRequests'])->name('staff.pending-requests');
    Route::get('/staff/return-management', [BorrowRequestController::class, 'showReturnManagement'])->name('staff.return-management');
    Route::post('/staff/approve/{request_id}', [BorrowRequestController::class, 'staffApprove'])->name('staff.approve');
    Route::post('/staff/reject/{request_id}', [BorrowRequestController::class, 'staffReject'])->name('staff.reject');
    Route::post('/staff/ready-to-claim/{request_id}', [BorrowRequestController::class, 'staffReadyToClaim'])->name('staff.ready-to-claim');
    Route::post('/staff/mark-claimed/{request_id}', [BorrowRequestController::class, 'staffMarkClaimed'])->name('staff.mark-claimed');
    Route::post('/staff/approve-return/{request_id}', [BorrowRequestController::class, 'staffApproveReturn'])->name('staff.approve-return');
    Route::post('/staff/reject-return/{request_id}', [BorrowRequestController::class, 'staffRejectReturn'])->name('staff.reject-return');
    Route::post('/staff/mark-returned/{request_id}', [BorrowRequestController::class, 'staffMarkReturned'])->name('staff.mark-returned');

    Route::get('/borrows', [BorrowRequestController::class, 'allBorrows'])->name('borrows.index');

    Route::get('/admin/users', [BorrowRequestController::class, 'adminUsers'])->name('admin.users.index');
    Route::get('/admin/equipment', [BorrowRequestController::class, 'adminEquipment'])->name('admin.equipment.index');
});

