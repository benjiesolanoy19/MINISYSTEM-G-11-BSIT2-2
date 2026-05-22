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
        'approval_date',
        'approved_by',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'request_date' => 'datetime',
        'approval_date' => 'datetime',
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

