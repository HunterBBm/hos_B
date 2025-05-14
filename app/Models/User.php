<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'tb_users';

    protected $fillable = [
        'tb_username',
        'tb_email',
        'tb_password',
        'tb_firstname',
        'tb_lastname',
        'tb_national_id',
        'tb_bank_account_number',
        'tb_bank_name',
        'tb_job_group',
        'tb_department',
        'tb_division',
        'tb_position',
        'tb_level',
        'tb_personnel_type',
        'tb_status',
        'tb_user_role',
    ];

    protected $hidden = ['tb_password'];

    // ให้ JWT ใช้งาน
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Hash password ตอนบันทึก
    public function setTbPasswordAttribute($value)
    {
        $this->attributes['tb_password'] = Hash::make($value);
    }

    // บอกว่า password อยู่ในฟิลด์นี้
    public function getAuthPassword()
    {
        return $this->tb_password;
    }

    // บอก JWT ว่าใช้ tb_email ในการยืนยันตัวตน
    public function getAuthIdentifierName()
    {
        return 'tb_email';
    }

    // เพิ่ม accessor ให้ JWT ใช้ 'email'
    public function getEmailAttribute()
    {
        return $this->attributes['tb_email'];
    }

    // เพิ่ม accessor ให้ JWT ใช้ 'password'
    public function getPasswordAttribute()
    {
        return $this->attributes['tb_password'];
    }
       // เพิ่มฟังก์ชันให้ JWT ใช้ tb_email แทน email
    public function username()
    {
        return 'tb_email';  // บอกให้ JWT ใช้ tb_email แทน email
    }
}
