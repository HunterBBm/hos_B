<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataHistory;
use App\Http\Requests\AddDataRequest;
use App\Models\User;

class DataController extends Controller
{
    public function AddData(Request $request)
    {
        $data = $request->validated();

        // ไม่ควร update id ของ user เพราะจะทำให้ JWT token ใช้ไม่ได้

        $dataHistory = DataHistory::create($data);
        return response()->json(['success' => true, 'data' => $dataHistory], 201);
    }
}
