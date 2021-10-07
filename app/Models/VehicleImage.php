<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'thumbnail', 'order', 'cover', 'vehicle_id'
    ];

    public $timestamps = false;

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }
    
}
