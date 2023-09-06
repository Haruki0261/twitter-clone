<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostReplyRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:' . config('validation.TWEET_CONTENT.MAX')]
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'content.required' => '必ず入力してね',
            'content.string' => '必ず文字列で入力しようね',
            'content.max' => config('validation.TWEET_CONTENT.MAX') . "文字以下にせんかい",
        ];
    }
}
