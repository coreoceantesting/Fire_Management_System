<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDetail extends BaseModel
{
    use HasFactory;
    protected $primaryKey = 'vehicle_id';
    protected $fillable = ['vehicle_number', 'vehicle_type', 'is_deleted','fire_station_id'];
}
