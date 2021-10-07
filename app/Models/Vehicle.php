<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'model_id',
        'version_id',
        'transmission_id',
        'color_id',
        'fuel_id',
        'body_id',
        'thumbnail',
        'license_plate',
        'state',
        'year',
        'doors',
        'negotiation',
        'km',
        'price',
        'featured',
        'offer',
        'description',
    ];



    public function options()
    {
        return $this->belongsToMany(Option::class, 'vehicle_options');
    }
    
    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }
    

}