<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'title',
        'is_read',
        'read_at',
        'type',
        'action_url',
        'reference_id',
        'reference_type',
        'icon',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['icon_class', 'color_class'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => Carbon::now(),
            ]);
        }
        return $this;
    }

    /**
     * Get the reference model (BorrowRequest, Incident, etc)
     */
    public function getReference()
    {
        if ($this->reference_type && $this->reference_id) {
            $modelClass = 'App\\Models\\' . $this->reference_type;
            if (class_exists($modelClass)) {
                return $modelClass::find($this->reference_id);
            }
        }
        return null;
    }

    /**
     * Get notification icon based on type
     */
    public function getIconClassAttribute()
    {
        $icons = [
            'borrow_request' => 'fa-box-open',
            'borrow_approved' => 'fa-check-circle',
            'borrow_rejected' => 'fa-times-circle',
            'reservation' => 'fa-calendar',
            'incident' => 'fa-exclamation-triangle',
            'equipment_returned' => 'fa-undo',
            'bug_report' => 'fa-bug',
            'message' => 'fa-comment',
        ];

        return $icons[$this->type] ?? 'fa-info-circle';
    }

    /**
     * Get notification color based on type
     */
    public function getColorClassAttribute()
    {
        $colors = [
            'borrow_request' => 'primary',
            'borrow_approved' => 'success',
            'borrow_rejected' => 'danger',
            'reservation' => 'info',
            'incident' => 'warning',
            'equipment_returned' => 'success',
            'bug_report' => 'danger',
            'message' => 'secondary',
        ];

        return $colors[$this->type] ?? 'primary';
    }

    /**
     * Scope for unread notifications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for read notifications
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Scope for getting recent notifications
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }
}
