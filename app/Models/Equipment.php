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
        'image_path',
        'asset_tag',
        'brand',
        'model',
        'location',
        'assigned_to',
        'purchase_date',
        'warranty_expiration',
        'condition',
        'status_label',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'available_quantity' => 'integer',
        'purchase_date' => 'date',
        'warranty_expiration' => 'date',
    ];

    public function getImageUrl(): string
    {
        // Prefer explicit public image path (e.g. 'images/equipment/xxx.svg')
        if (!empty($this->image_path)) {
            return asset($this->image_path);
        }

        // If a stored image path exists (legacy), return storage URL
        if (!empty($this->image)) {
            return asset('storage/' . $this->image);
        }

        // Default placeholder
        return asset('images/equipment/placeholder.svg');
    }





    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }
}
