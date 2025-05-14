<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|max:64',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'وارد کردن ایمیل ضروری است',
            'email.email' => 'فرمت ایمیل اشتباه است',
            'password.required' => ' وارد کردن رمز ضروری است',
            'password.min' => 'رمز وارد شده باید بیشتر از 8 کاراکتر باشد',
            'password.max' => ' طول رمز وارد شده بیش از حد مجاز است'
        ];
    }
}
