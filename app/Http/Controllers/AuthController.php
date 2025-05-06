<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => app('hash')->make($request->password),
        ]);

        try {
            $token = JWTAuth::fromUser($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'ไม่สามารถสร้าง token ได้', 'message' => $e->getMessage()], 500);
        }

        return response()->json([
            'message' => 'สมัครสมาชิกสำเร็จ',
            'user' => $user,
            'token' => $token
        ], 201);
    }
}
