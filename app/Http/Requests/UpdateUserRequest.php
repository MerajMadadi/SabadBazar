<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:100',
//            'email' => 'required|email|unique:users,email',
            'new_password' => 'nullable|string|min:8|max:64',
            'phone' => 'nullable|digits_between:10,15',
            'address' => 'nullable|string|max:255',
        ];
    }
    public function messages(): array{
        return [
            'name.required' => 'نام الزامی است.',
            'name.min' => 'نام باید حداقل ۳ کاراکتر باشد.',
            'name.max' => 'نام نمی‌تواند بیش از ۱۰۰ کاراکتر باشد.',

            'email.required' => 'ایمیل الزامی است.',
            'email.email' => 'فرمت ایمیل معتبر نیست.',
//            'phone.unique' => 'این شماره موبایل قبلاً استفاده شده است.',
            'phone.digits_between' => 'شماره موبایل باید بین ۱۰ تا ۱۵ رقم باشد.',
            'address.max' => 'آدرس نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

        ];
    }
}
