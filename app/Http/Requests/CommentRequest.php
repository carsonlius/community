<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'body' => 'required|min:15',
            'discussion_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'body.required' => '请填写评论',
            'body.min' => '评论至少要有15个字符',
            'discussion_id.required' => '请传递discussion_id'
        ];
    }
}
