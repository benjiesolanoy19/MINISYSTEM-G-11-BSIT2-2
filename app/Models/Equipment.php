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
    ];

    protected $casts = [
        'quantity' => 'integer',
        'available_quantity' => 'integer',
    ];



    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }
}
