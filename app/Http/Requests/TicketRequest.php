<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'subject' => 'required|string|min:5|max:255',
            'message' => 'required|string|min:10|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'لطفاً موضوع تیکت را وارد کنید.',
            'subject.min' => 'موضوع تیکت باید حداقل 5 کاراکتر باشد.',
            'subject.max' => 'موضوع تیکت نباید بیشتر از 255 کاراکتر باشد.',
            'message.required' => 'لطفاً متن پیام را وارد کنید.',
            'message.min' => 'متن پیام باید حداقل 10 کاراکتر باشد.',
            'message.max' => 'متن پیام باید حداکثر 1000 کاراکتر باشد.',
        ];
    }
}
