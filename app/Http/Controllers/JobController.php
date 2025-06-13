<?php

namespace App\Http\Controllers;

use App\Models\StatusJob;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JobController extends Controller
{
    public function createJob(Request $request)
    {
        // ตรวจสอบว่าผู้ใช้ login อยู่
        $user = JWTAuth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ใช้ Validator facade สำหรับ validation (Lumen ไม่มี $request->validate())
        $validator = app('validator')->make($request->all(), [
            'job_position' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        // เช็คว่ามี job_position นี้อยู่แล้วหรือยัง
        $exists = StatusJob::where('job_position', $request->input('job_position'))->exists();
        if ($exists) {
            return response()->json([
                'error' => 'ไม่สามารถเพิ่มข้อมูลซ้ำได้',
                'message' => 'มีข้อมูลเงินเดือนนี้อยู่แล้ว'
            ], 409);
        }

        // เพิ่ม job record ใหม่ (ไม่ทับของเดิม)
        $job = StatusJob::create([
            'job_position' => $request->input('job_position'),
            'status_position' => $request->input('status_position'),
            // เพิ่ม field อื่นๆ ตามที่ต้องการ
        ]);

        return response()->json([
            'message' => 'Job created successfully',
            'job' => $job
        ], 200);
    }

    public function showJobs(Request $request)
    {
        $user = JWTAuth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ดึง job ทั้งหมดของ user
        $jobs = StatusJob::all();

        return response()->json([
            'jobs' => $jobs
        ]);
    }
}
