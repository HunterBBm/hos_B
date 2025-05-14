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
    //  'tb_email' => 'test@example3.com',
    //     'password' => '123456as'
                
];
// return response()->json([
//                     'message' => $credentials
//                        ]);
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
}
