<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
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
        $userId = $this->route('user')->id; // 获取当前要修改的用户ID
        $sensitiveWords = ['admin', 'root', 'test']; // 敏感词列表
        return [
            'name'=>['required','between:2,100','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9\-\_]+$/u',
                Rule::unique('users')->ignore($userId),
                function ($attribute, $value, $fail) use ($sensitiveWords) {
                    foreach ($sensitiveWords as $word) {
                        if (str_contains(strtolower($value), $word)) {
                            $fail("{$attribute}用户名不能包含敏感词：{$word}");
                        }
                    }
                }],
            'email'=>['required','email'],
            'introduction' => ['nullable', 'between:1,300'], // 加了 nullable
            'avatar' => ['image', 'mimes:jpeg,jpg,png,gif', 'dimensions:min_width=300,min_height=300'],

        ];
    }
    public function messages()
    {
        return [
            'avatar.dimensions' => '图片尺寸太小，至少是300*300',
        ];
    }
//
//    public function attributes()
//    {
//        return [
//          'name'=>  '用户名',
//        ];
//    }
}
