<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireStation extends BaseModel
{
    use HasFactory;
    protected $primaryKey = 'fire_station_id';
    protected $fillable = ['name', 'initial','fire_station_is_active','is_deleted'];
}
