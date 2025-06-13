<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusJob extends Model
{
    protected $table = 'job_position'; // ชื่อ table ในฐานข้อมูล
    protected $fillable = [
        'job_position', // ชื่อตำแหน่งงาน
        'status_position', // สถานะของตำแหน่งงาน เช่น 1 = รายวัน, 2 = ราชการ, 3 = กระทรวง
    ];
}
