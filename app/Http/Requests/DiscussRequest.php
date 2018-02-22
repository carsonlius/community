<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscussRequest extends FormRequest
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
            'title' => 'required|min:2|unique:discusses,title',
            'body' => 'required|min:15'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '请填写标题',
            'title.min' => '标题不可以低于2个字符',
            'title.unique' => '标题已经被占用,请重新填写',
            'body.required' => '请填写内容',
            'body.min' => '内容不可以低于15个字符'
        ];
    }
}
