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

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
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

    // /**
    //  * The attributes excluded from the model's JSON form.
    //  *
    //  * @var string[]
    //  */
    // protected $hidden = [
    //     'password',
    // ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function setTbPasswordAttribute($value)
    {
        $this->attributes['tb_password'] = Hash::make($value); // ใช้ Hash::make แทน bcrypt()
    }
}
