<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        return 
            $cam = [
                "name" => [
                    "required",
                ],
                "email" => [
                    "required",
                    "email",
                    "unique:users",
                    Rule::unique('users')->ignore($this->id),
                ],
                "password" => [
                    "required",
                    Password::min(8),
                ]
            ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Hãy nhập tên của bạn',
            'email.required' => 'Hãy nhập email của bạn',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Hãy nhập mật khẩu của bạn',
            'password.min' => 'Mật khẩu phải trên 8 kí tự',
        ];
    }
}
