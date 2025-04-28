<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use Illuminate\Http\Request; // เพิ่มการใช้ Request

class TestController extends Controller
{
    public function handle(TestRequest $request)
    {
        return response()->json([
            'message' => 'Validation passed!',
            'data' => $request->all()
        ]);
    }
}