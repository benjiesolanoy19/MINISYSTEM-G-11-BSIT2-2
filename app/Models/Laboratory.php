<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'building',
        'floor',
        'capacity',
        'description',
        'status',
    ];

    protected $casts = [
        'capacity' => 'integer',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
