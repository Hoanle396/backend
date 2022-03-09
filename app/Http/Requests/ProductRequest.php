<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'product_name'=>'required|unique:products|max:255',
            'product_description'=>'required',
            'product_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'product_price'=>'required|integer',
            'product_origin'=>'required',
            'product_manufacturer'=>'required',
            'product_discount'=>'required|integer'
        ];
    }
    public function messages()
    {
        return [
            'required'   => 'Vui lòng không để trống trường này',
            'interger'   => 'Vui Lòng Nhập Đúng Chữ Số',
            'unique' => 'Sản Phẩm Này Đã Tồn Tại',
            'max' => 'Đã đạt số kí tự tối đa',
            'image'=> 'Vui lòng chọn hình ảnh',
        ];
    }
}
