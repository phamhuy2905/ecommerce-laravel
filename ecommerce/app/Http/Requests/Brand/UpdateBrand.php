<?php

namespace App\Http\Requests\Brand;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule ;
class UpdateBrand extends FormRequest
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
                Rule::unique('brands')->ignore($this->request->get('id')),
            ],
            'brand_image' => [
                'bail',
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
