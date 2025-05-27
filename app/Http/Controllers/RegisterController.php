<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // เข้ารหัสรหัสผ่านด้วย Hash
        $hashedPassword = Hash::make($request->tb_password);
        $user = User::create([
            'tb_email' => $request->tb_email,
            'tb_password' => $hashedPassword,
            'tb_firstname' => $request->tb_firstname,
            'tb_lastname' => $request->tb_lastname,
            'tb_national_id' => $request->tb_national_id,
            'tb_bank_account_number' => $request->tb_bank_account_number,
            'tb_bank_name' => $request->tb_bank_name,
            'tb_job_group' => $request->tb_job_group,
            'tb_department' => $request->tb_department,
            'tb_division' => $request->tb_division,
            'tb_position' => $request->tb_position,
            'tb_level' => $request->tb_level,
            'tb_personnel_type' => $request->tb_personnel_type,
            'tb_status' => '1',  // ใช้ string '1' เพราะเป็น enum
            'tb_user_role' => '1'  // ใช้ string '1' เพราะเป็น enum
        ]);

        try {
            $token = JWTAuth::fromUser($user);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'ไม่สามารถสร้าง token ได้',
                'message' => $e->getMessage()
            ], 500);
        }
        return response()->json([
            'message' => 'สมัครสมาชิกสำเร็จ',
            'user' => [
                'tb_email' => $user->tb_email,
                'tb_firstname' => $user->tb_firstname,
                'tb_lastname' => $user->tb_lastname,
                'tb_national_id' => $user->tb_national_id,
                'tb_status' => $user->tb_status,  // จะเป็น 1 เสมอ
                'tb_user_role' => $user->tb_user_role,  // จะเป็น 1 เสมอ
            ],
            'token' => $token
        ], 201);
    }
}
