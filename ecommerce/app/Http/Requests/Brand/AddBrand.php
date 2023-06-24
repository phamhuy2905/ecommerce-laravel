<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class AddBrand extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'brand_name' => [
                'bail',
                'required',
                'string',
                'min:3',
                'unique:App\Models\Brand,brand_name',
            ],
            'brand_image' => [
                'bail',
                'required',
                'image',
            ],
        ];
    }


    public function messages()
    {
        return [
            'required' => 'Không để để trống :attribute',
            'unique' => ':attribute đã có người sử dụng',
            'min' => ':attribute tối thiểu 3 kí tự',
            'string' => ':attribute bắt buộc phải là chuỗi',
            'image' => 'File ảnh không hợp lệ',
        ];
    }

    public function attributes()
    {
        return [
            'brand_name' => 'Name',
            'image' => 'Brand image',
        ];
    }
}
