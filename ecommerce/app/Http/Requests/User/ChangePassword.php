<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password' => [
                'bail',
                'required',
                'string',
            ],
            'new_password' => [
                'bail',
                'required',
                'string',
                'min:8',
            ],
            'new_password_confirmation' => [
                'bail',
                'required',
                'confirmed',
                'min:8',
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập trường này!',
            'string' => ':attribute có kí tự không hợp lệ!',
            'min' => 'Trường này quá ngắn, vui lòng nhập đầy đủ!',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Password',
            'new_password' => 'New password',
            'new_password_confirmation' => 'Password confirmation',
        ];
    }
}
