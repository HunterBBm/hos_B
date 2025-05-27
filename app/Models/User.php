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

    // กำหนดค่า default สำหรับ user ใหม่
    protected $attributes = [
        'tb_status' => '1',
        'tb_user_role' => '1'
    ];

    protected $fillable = [
        //'tb_username',
        'tb_password',
        'tb_email',
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
        return [
            'email' => $this->tb_email,
            'user_role' => $this->tb_user_role
        ];
    }

    /**
     * Get the name of the unique identifier for the user.
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->tb_password;
    }    // For JWT auth
    public function username()
    {
        return 'tb_email';
    }

    /**
     * Find user by email for authentication
     */
    public function findForPassport($username)
    {
        return $this->where('tb_email', $username)->first();
    }
}
