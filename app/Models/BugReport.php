<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BugReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_id',
        'assigned_to',
        'title',
        'description',
        'screenshot',
        'affected_page',
        'priority',
        'status',
        'reply',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'bug_report_id');
    }
}
