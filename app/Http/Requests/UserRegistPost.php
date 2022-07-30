<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistPost extends FormRequest
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

    public function messages(){
        return [
            'name.required'        => '名前は必須です。',
            'name.string'          => '名前は文字で入力してください。',
            'name.max:20'          => '名前は20文字以内で入力してください。',
            'email.required'       => 'メールアドレスは必須です。',
            'email.email'          => 'メールアドレスが正しくありません。',
            'email.max:255'        => 'メールアドレスが長すぎます。',
            'email.unique:users'   => 'このメールアドレスは既に使用されています。',
            'age.required'         => '年齢は必須です。',
            'age.integer'          => '名前は数字で入力してください。',
            'password.required'    => 'パスワードは必須です。',
            'password.string'      => 'パスワードは文字で入力してください。',
            'password.confirmed'   => '確認用パスワードと一致しません。',
            'password.min'         => 'パスワードは8文字以上で入力してください。',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                'name'     => ['required','string','max:20'],
                'email'    => ['required','email','max:255','unique:users'],
                'age'      => ['required','integer'],
                'password' => ['required','string','confirmed','min:8'],
        ];
    }
}
