<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusSalary extends Model
{
    protected $table = 'status_salary';
    protected $fillable = [
        'job_salary', // ชื่อของตำแหน่งงา
    ];
}
