<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'categroy_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'required',
                'string',
                'max:200'
            ],
            'slug' => [
                'required',
                'string',
                'max:255'
            ],
            'brand' => [
                'required',
                'string',
                'max:255'
            ],
            'small_description' => [
                'required',
                'string'
            ],
            'description' => [
                'required',
                'string'
            ],
            'original_price' => [
                'required',
                'integer',
            ],
            'selling_price' => [
                'required',
                'integer',
            ],
            'quantity' => [
                'required',
                'integer',
            ],
            'trending' => [
                'nullable'
            ],
            'status' => [
                'nullable'
            ],
            'meta_title' => [
                'required',
                'string',
                'max:255'
            ],
            'meta_description' => [
                'required',
                'string',
            ],
            'meta_keyword' => [
                'required',
                'string',
            ],
            'image' => [
                'nullable',
                // 'image:jpeg,jpg,png,jfif'
            ]
        ];
        // return $rules;
    }
}
