<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRequest extends Model
{
    use HasFactory;

    protected $table = 'borrow_requests';

    protected $fillable = [
        'student_id',
        'equipment_id',
        'quantity',
        'status',
        'request_date',
        'borrow_date',
        'return_date',
        'purpose',
        'notes',
        'approval_date',
        'approved_by',
        'claimed_at',
        'return_requested_at',
        'returned_at',
        'return_condition',
        'remarks',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'request_date' => 'datetime',
        'borrow_date' => 'date',
        'return_date' => 'date',
        'approval_date' => 'datetime',
        'claimed_at' => 'datetime',
        'return_requested_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}

