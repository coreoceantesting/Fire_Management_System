<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends BaseModel
{
    use HasFactory;
    protected $primaryKey = 'designation_id';
    protected $fillable = ['worker_name', 'designation_name', 'designation_initial', 'is_deleted'];
}
