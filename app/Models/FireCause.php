<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireCause extends Model
{
    use HasFactory;
    protected $primaryKey = 'fire_cause_id';
    protected $fillable = ['name', 'initial', 'is_deleted','created_by', 'updated_by'];
}
