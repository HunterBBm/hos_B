<?php

namespace App\Http\Requests;

//use Anik\Form\FormRequest;
use Urameshibr\Requests\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            // 'tb_username' => 'required|string|max:255',
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
            'tb_status' => 'nullable',  // ไม่ต้องส่งค่ามา จะ set เป็น 1 เสมอ
            'tb_user_role' => 'nullable',  // ไม่ต้องส่งค่ามา จะ set เป็น 1 เสมอ
        ];
    }
    public function messages()
    {
        return [
            // 'tb_username.required' => 'กรุณากรอกชื่อผู้ใช้',
            // 'tb_username.string' => 'ชื่อผู้ใช้ต้องเป็นตัวอักษร',
            // 'tb_username.max' => 'ชื่อผู้ใช้ต้องไม่เกิน 255 ตัวอักษร',

            'tb_email.required' => 'กรุณากรอกอีเมล',
            'tb_email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'tb_email.unique' => 'อีเมลนี้ถูกใช้ไปแล้ว',

            'tb_password.required' => 'กรุณากรอกรหัสผ่าน',
            'tb_password.min' => 'รหัสผ่านต้องอย่างน้อย 6 ตัวอักษร',

            'tb_firstname.required' => 'กรุณากรอกชื่อจริง',
            'tb_firstname.string' => 'ชื่อจริงต้องเป็นตัวอักษร',

            'tb_lastname.required' => 'กรุณากรอกนามสกุล',
            'tb_lastname.string' => 'นามสกุลต้องเป็นตัวอักษร',

            'tb_national_id.required' => 'กรุณากรอกเลขบัตรประชาชน',
            'tb_national_id.digits' => 'เลขบัตรประชาชนต้องเป็นตัวเลข 13 หลัก',
            'tb_national_id.unique' => 'เลขบัตรประชาชนนี้ถูกใช้ไปแล้ว',

            'tb_bank_account_number.required' => 'กรุณากรอกเลขบัญชีธนาคาร',
            'tb_bank_account_number.string' => 'เลขบัญชีธนาคารต้องเป็นตัวอักษร',

            'tb_bank_name.required' => 'กรุณากรอกชื่อธนาคาร',
            'tb_bank_name.string' => 'ชื่อธนาคารต้องเป็นตัวอักษร',

            'tb_job_group.required' => 'กรุณากรอกกลุ่มงาน',
            'tb_job_group.string' => 'กลุ่มงานต้องเป็นตัวอักษร',

            'tb_department.required' => 'กรุณากรอกแผนก',
            'tb_department.string' => 'แผนกต้องเป็นตัวอักษร',

            'tb_division.required' => 'กรุณากรอกฝ่าย',
            'tb_division.string' => 'ฝ่ายต้องเป็นตัวอักษร',

            'tb_position.required' => 'กรุณากรอกตำแหน่ง',
            'tb_position.string' => 'ตำแหน่งต้องเป็นตัวอักษร',

            'tb_level.required' => 'กรุณากรอกระดับ',
            'tb_level.string' => 'ระดับต้องเป็นตัวอักษร',

            'tb_personnel_type.required' => 'กรุณากรอกประเภทบุคลากร',
            'tb_personnel_type.string' => 'ประเภทบุคลากรต้องเป็นตัวอักษร',

        ];
    }

    public function authorize()
    {
        return true;
    }
}
