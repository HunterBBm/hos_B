<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


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
        // ดึง user ทั้งหมด
        $users = User::all();
        return response()->json(['users' => $users]);
    }
    public function edit(Request $request)
    {

        //แก้ไขข้อมูลผู้ใช้
        $token = JWTAuth::getToken();
        $user = JWTAuth::user();
        if (!$user) {
            return response()->json([
                'error' => 'ไม่พบผู้ใช้',
                'token' => $token,
                'token_user' => JWTAuth::toUser($token)
            ], 404);
        }
        $user->update($request->all());
        return response()->json(['message' => 'แก้ไขข้อมูลสำเร็จ', 'user' => $user]);
    }
    public function delete(Request $request, $id)
    {
        //ลบข้อมูลผู้ใช้
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'ไม่พบผู้ใช้'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'ลบข้อมูลสำเร็จ']);
    }
}
