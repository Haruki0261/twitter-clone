<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:50',
            'email' =>'required|email:filter,dns,spoof|max:50',
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => '必ず名前は入力してね',
            'email.required' => '必ずemailは入力してね',
            'email.email' => 'ダメだよん。有効なemailを入力してね'
        ];
    }
}
