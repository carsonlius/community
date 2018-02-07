<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User extends FormRequest
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
            'name' => 'required|min:2|max:10|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:12|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请填写用户名',
            'name.min' => '昵称不可以低于最小的长度2',
            'name.max' => '昵称不可以高于最长长度10',
            'name.unique' => '昵称已经被占用，请重新填写',
            'email.required' => '请填写邮箱',
            'email.email' => '邮箱的格式不对',
            'email.unique' => '邮箱已经被占用，请重新填写',
            'password.required' => '请填写密码',
            'password.min' => '密码最少8位',
            'password.max' => '密码最高12位',
            'password.confirmed' => '密码和确认密码不一致',
        ];
    }
}
