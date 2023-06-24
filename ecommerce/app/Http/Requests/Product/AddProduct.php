<?php

namespace App\Http\Requests\Product;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddProduct extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'brand_id' => [
                'bail',
                'required',
                'exists:brands,id'
            ],
            'category_id' => [
                'bail',
                'required',
                'exists:categories,id'
            ],
            'subcategory_id' => [
                'bail',
                'required',
                'exists:subcategories,id'
            ],

            'product_name' => [
                'bail',
                'required',
                'string',
            ],
            
            'product_code' => [
                'bail',
                'required',
                'string',
            ],

            'product_tags' => [
                'bail',
                'nullable',
            ],
            
            'price' => [
                'bail',
                'required',
                'numeric',
            ],

            'product_color' => [
                'bail',
                'nullable',
                'string',
            ],

            'product_quantity' => [
                'bail',
                'required',
                'integer',
            ],

            'product_size' => [
                'bail',
                'nullable',
                'regex:/^[A-Za-z0-9 ]+$/'
            ],

            'discount' => [
                'bail',
                'nullable',
                'numeric',
            ],

            'short_description' => [
                'bail',
                'required',
                'string',
            ],

            'product_thumbnail' => [
                'bail',
                'required',
                'image',
            ],
            
            'hot_deals' => [
                'bail',
                'nullable',
                Rule::in([0,1]),
            ],

            'special_offer' => [
                'bail',
                'nullable',
                Rule::in([0,1]),
            ],

            'product_featured' => [
                'bail',
                'nullable',
                Rule::in([0,1]),
            ],

            'multipe_img.*' => [
                'image',
            ],
        ];
    }
}
