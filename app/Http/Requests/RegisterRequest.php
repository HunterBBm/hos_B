<?php

namespace App\Http\Requests;

//use Anik\Form\FormRequest;
use Urameshibr\Requests\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'tb_username' => 'required|string|max:255',
            'tb_email' => 'required|email|unique:tb_users,tb_email',
            'tb_password' => 'required|string|min:6',
            'tb_firstname' => 'required|string',
            'tb_lastname' => 'required|string',
            'tb_national_id' => 'required|digits:13|unique:tb_users,tb_national_id',
            'tb_bank_account_number' => 'required|string',
            'tb_bank_name' => 'required|string',  
            'tb_job_group' => 'required|string',
            'tb_department' => 'required|string',
            'tb_division' => 'required|string',
            'tb_position' => 'required|string',
            'tb_level' => 'required|string',
            'tb_personnel_type' => 'required|string',
            'tb_status' => 'required|in:0,1',
            'tb_user_role' => 'nullable|in:1,2,3',
        ];
    }

    public function messages()
    {
        return [
            'tb_username.required' => 'กรุณากรอกชื่อ',
            'tb_email.required' => 'กรุณากรอกอีเมล',
            'tb_email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'tb_email.unique' => 'อีเมลนี้ถูกใช้ไปแล้ว',
            'tb_password.required' => 'กรุณากรอกรหัสผ่าน',
            'tb_password.min' => 'รหัสผ่านต้องอย่างน้อย 6 ตัว',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
