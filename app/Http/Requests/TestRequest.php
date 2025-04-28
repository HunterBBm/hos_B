<?php

namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;

class TestRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'password'=>'required|min:8',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'email.required' => 'กรุณากรอกอีเมล',
            'email.email'    => 'รูปแบบอีเมลไม่ถูกต้อง',
            'password.required'  => 'กรุณากรอกรหัสผ่าน',
            'password.min'  => 'กรุณากรอกรหัสผ่านอย่างน้อย 8 ตัว',
            'name.string'    => 'ชื่อควรเป็นตัวอักษรเท่านั้น',
        ];
    }


}
