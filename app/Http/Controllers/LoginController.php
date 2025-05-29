<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'tb_email' => $request->input('email'),  // ตรงนี้สำคัญ
            'password' => $request->input('password')

        ];
        try {

            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'], 401);
            }

            $user = JWTAuth::user();

            return response()->json([
                'message' => 'เข้าสู่ระบบสำเร็จ',
                'email' => $user->tb_email,
                'user' => $user,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'เกิดข้อผิดพลาดในระบบ',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'ออกจากระบบสำเร็จ']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'ไม่สามารถออกจากระบบได้'], 500);
        }
    }
    public function show(Request $request)
    {
        try {
            // ดึงข้อมูล users ทั้งหมดพร้อม select ทุก column
            $users = User::select(
                'id',
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
                'created_at',
                'updated_at'
            )->get();

            return response()->json([
                'status' => 'success',
                'total_users' => $users->count(),
                'users' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            // Update user data
            $user->tb_email = $request->input('email', $user->tb_email);
            $user->tb_firstname = $request->input('firstname', $user->tb_firstname);
            $user->tb_lastname = $request->input('lastname', $user->tb_lastname);
            $user->tb_national_id = $request->input('national_id', $user->tb_national_id);
            $user->tb_bank_account_number = $request->input('bank_account_number', $user->tb_bank_account_number);
            $user->tb_bank_name = $request->input('bank_name', $user->tb_bank_name);
            $user->tb_job_group = $request->input('job_group', $user->tb_job_group);
            $user->tb_department = $request->input('department', $user->tb_department);
            $user->tb_division = $request->input('division', $user->tb_division);
            $user->tb_position = $request->input('position', $user->tb_position);
            $user->tb_level = $request->input('level', $user->tb_level);
            $user->tb_personnel_type = $request->input('personnel_type', $user->tb_personnel_type);
            $user->tb_status = $request->input('status', $user->tb_status);
            $user->tb_user_role = $request->input('user_role', $user->tb_user_role);            // Update password if provided
            if ($request->filled('password')) {
                $user->tb_password = Hash::make($request->input('password'));
            }

            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'อัพเดทข้อมูลสำเร็จ',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'เกิดข้อผิดพลาดในระบบ',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function delete(Request $request, $id) //// ลบข้อมูลผู้ใช้ 
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();    // เดี๋ยวแก้ใหม่ให้ ย้ายข้อมูลไปเก็บที่อื่นก่อนลบ

            return response()->json([
                'status' => 'success',
                'message' => 'ลบข้อมูลผู้ใช้สำเร็จ'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'เกิดข้อผิดพลาดในการลบข้อมูล',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
