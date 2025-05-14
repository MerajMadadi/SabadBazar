<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'message' => 'required|string|min:5|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'متن پاسخ الزامی است.',
            'message.string' => ' پاسخ باید به صورت متنی باشد.',
            'message.min' => 'متن پاسخ باید حداقل ۵ کاراکتر باشد.',
            'message.max' => 'متن پاسخ نمی‌تواند بیشتر از ۱۰۰۰ کاراکتر باشد.',
        ];
    }
}
