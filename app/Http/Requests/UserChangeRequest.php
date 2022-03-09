<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangeRequest extends FormRequest
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
            'address'=>'required',
            'created_at'=>'required',
            'email'=>'required',
            'email_verified_at'=>'nullable',
            'id'=>'required',
            'name'=>'required',
            'phonenumber'=>'required',
            'status'=>'required',
            'updated_at'=>'required',
        ];
    }
}
