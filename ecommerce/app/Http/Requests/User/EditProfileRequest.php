<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class EditProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'username' => [
                'bail',
                'string',
                'nullable',
                ValidationRule::unique(User::class)->ignore($this->user()->username,'username'),
            ],
            'name' => [
                'bail',
                'required',
                'string',
                'min:3',
            ],
            
            'phone' => [
                'bail',
                'string',
                'min:9',
                'nullable',
                ValidationRule::unique(User::class)->ignore($this->user()->phone,'phone'),
            ],

            'address' => [
                'bail',
                'nullable',
                'string',
            ],

            'photo' => [
                'bail',
                'nullable',
                'image',
            ],

        ];
    }

    public function messages()
    {
        return [
            'required' => 'Vui lòng nhập trường này!',
            'unique' => ':attribute đã được sử dụng!',
            'string' => ':attribute có kí tự không hợp lệ!',
            'min' => 'Trường này quá ngắn, vui lòng nhập đầy đủ!',
            'image' => ':attribute(jpg, jpeg, png, bmp, gif, svg, or webp).'
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Username',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'photo' => 'Image',
        ];
    }
}
