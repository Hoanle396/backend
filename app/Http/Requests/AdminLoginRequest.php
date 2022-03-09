<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required|min:6'
        ];
    }
    public function messages()
    {
        return [
            'required'   => 'Vui lòng không để trống trường này',
            'email'   => 'Vui Lòng Nhập Đúng Định Dạng Email',
            'min' => 'Mật khẩu phải từ 6 kí tự trở lên'
        ];
    }
}
