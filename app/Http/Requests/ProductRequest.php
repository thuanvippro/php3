<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $formRules = [
            "name" => [
                "required",
                Rule::unique('products')->ignore($this->id),
            ],
            "cate_id" => [
                "required",
            ],
            "image" => [
                "required",
                'mimes:jpg,bmp,png,jpeg',
            ],
            // "product_image" => [
            //     "required",
            //     'mimes:jpg,bmp,png,jpeg',
            // ],
            "price" => [
                "required",
                "numeric",
                "min: 1",
            ],
            "quantity" => [
                "required",
                "numeric",
                "min: 1"
            ],
            "weight" => [
                "required",
                "numeric",
                "min: 1"
            ],
        ];
        // if($this->id == null){
        //     $formRules['product_image'] = 'required|mimes:jpg,png,jpeg';
        // }else{
        //     $formRules['product_image'] = 'mimes:jpg,png,jpeg';
        // }
        return $formRules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Hãy nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'price.required' => 'Hãy nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm không đúng định dạng',
            'price.size' => 'Giá sản phẩm thấp nhất phải bằng 1',
            'quantity.required' => 'Hãy nhập số lượng sản phẩm',
            'quantity.numeric' => 'Số lượng sản phẩm không đúng định dạng',
            'quantity.size' => 'Số lượng sản phẩm thấp nhất phải bằng 1',
            'weight.required' => 'Hãy nhập cân nặng sản phẩm',
            'weight.numeric' => 'Cân nặng sản phẩm không đúng định dạng',
            'weight.size' => 'Cân nặng sản phẩm thấp nhất phải bằng 1',
            'image.required' => 'Hãy chọn ảnh sản phẩm',
            'image.mimes' => 'File ảnh sản phẩm không đúng định dạng (jpg, png, jpeg)',
            // 'product_image.required' => 'Hãy chọn ảnh mô tả sản phẩm',
            // 'product_image.mimes' => 'File ảnh sản phẩm không đúng định dạng (jpg, png, jpeg)',
        ];
    }
}
