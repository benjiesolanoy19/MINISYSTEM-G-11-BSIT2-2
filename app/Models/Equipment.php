<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'serial_number',
        'description',
        'quantity',
        'available_quantity',
        'status',
        'image',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'available_quantity' => 'integer',
    ];

    public function getImageUrl(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        // Fallback default image
        return 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=900&q=80';
    }





    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }
}
