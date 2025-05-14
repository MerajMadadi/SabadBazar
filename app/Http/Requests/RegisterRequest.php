<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'regex:/^09\d{9}$/'],
            'address' => ['nullable', 'string', 'max:500'],
            'is_seller' => ['required', 'boolean'],
        ];

        if ($this->boolean('is_seller')) {
            $rules = array_merge($rules, [
                'store_name' => ['required', 'string', 'max:255'],
                'store_phone' => ['required', 'string', 'regex:/^0\d{10}$/'],
                'store_address' => ['required', 'string', 'max:500'],
                'license_number' => ['required', 'string', 'max:100'],
            ]);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است.',
            'email.required' => 'ایمیل الزامی است.',
            'email.email' => 'فرمت ایمیل معتبر نیست.',
            'password.required' => 'رمز عبور الزامی است.',
            'password.min' => 'رمز عبور باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'تأیید رمز عبور با رمز اصلی هم‌خوانی ندارد.',
            'phone.regex' => 'شماره موبایل معتبر نیست.',
            'is_seller.boolean' => 'مقدار فروشنده باید صحیح باشد.',

            'store_name.required' => 'نام فروشگاه الزامی است.',
            'store_phone.required' => 'تلفن فروشگاه الزامی است.',
            'store_phone.regex' => 'فرمت تلفن فروشگاه معتبر نیست.',
            'store_address.required' => 'آدرس فروشگاه الزامی است.',
            'license_number.required' => 'شماره مجوز الزامی است.',
        ];
    }
}
