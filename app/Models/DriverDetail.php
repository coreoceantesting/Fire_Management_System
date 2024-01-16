<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverDetail extends BaseModel
{
    use HasFactory;
    protected $primaryKey = 'driver_id';
    protected $fillable = ['driver_name', 'driver_mob_no', 'driver_gender', 'driver_job_status', 'vehicle_id', 'is_deleted'];
}
