<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditReplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return Bool
     */
    public function authorize(): Bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return Array<string, mixed>
     */
    public function rules(): Array
    {
        return [
            'content' => ['required', 'string', 'max:' . config('validation.TWEET_CONTENT.MAX')]
        ];
    }
    /**
     * エラーメッセージ
     *
     * @return Array
     */
    public function messages(): Array
    {
        return [
            'content.required' => '必ず入力してね',
            'content.string' => '必ず文字列で入力しようね',
            'content.max' => config('validation.TWEET_CONTENT.MAX') . "文字以下にせんかい",
        ];
    }
}
