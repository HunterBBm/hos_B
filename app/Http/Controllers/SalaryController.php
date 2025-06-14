<?php

namespace App\Http\Controllers;


use App\Models\StatusSalary;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class JobController extends Controller
{
    public function createSalary(Request $request)
    {
        // ตรวจสอบว่าผู้ใช้ login อยู่
        $user = JWTAuth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ใช้ Validator facade สำหรับ validation (Lumen ไม่มี $request->validate())
        $validator = app('validator')->make($request->all(), [
            'job_salary' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        // เช็คว่ามี job_salary นี้อยู่แล้วหรือยัง
        $exists = StatusSalary::where('job_salary', $request->input('job_salary'))->exists();
        if ($exists) {
            return response()->json([
                'error' => 'ไม่สามารถเพิ่มข้อมูลซ้ำได้',
                'message' => 'มีข้อมูลเงินเดือนนี้อยู่แล้ว'
            ], 409);
        }

        // เพิ่ม salary record ใหม่
        $salary = StatusSalary::create([
            'job_salary' => $request->input('job_salary'),
        ]);

        return response()->json([
            'message' => 'Salary added successfully',
            'salary' => $salary
        ], 201);
    }
    public function showSalary(Request $request)
    {
        $user = JWTAuth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ดึง salary ทั้งหมดของ user
        $salaries = StatusSalary::select(
            'id',
            'job_salary',
        )->get();

        return response()->json([
            'salaries' => $salaries
        ]);
    }
}
