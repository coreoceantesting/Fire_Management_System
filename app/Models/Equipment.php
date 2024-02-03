<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $primaryKey = 'equipment_id';
    protected $fillable = ['equipment_name', 'initial', 'equipment_is_active', 'is_deleted','created_by', 'created_at','updated_by','updated_at'];
}
