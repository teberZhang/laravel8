<?php

namespace App\Http\Requests;

class UserLoginRequest extends CommonRequest
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
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '邮箱地址必填',
            'email.email' => '请输入正确的邮箱地址',
            'password.required' => '密码必填',
            'name.required' => '用户名必填',
        ];
    }
}
