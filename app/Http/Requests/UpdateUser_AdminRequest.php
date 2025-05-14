<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser_AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('id');

        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,{$userId}"],
            'phone' => ['nullable', 'regex:/^0[0-9]{10}$/'],
            'address' => ['nullable', 'string', 'min:10', 'max:500'],
            'password' => ['nullable', 'min:6', 'max:255'],
            'store_name' => ['nullable', 'string', 'min:3', 'max:50'],
            'store_phone' => ['nullable', 'regex:/^0[0-9]{10}$/'],
            'store_address' => ['nullable', 'string', 'min:10', 'max:500'],
            'license_number' => ['nullable', 'string', 'min:5', 'max:30'],
            'role' => ['nullable', 'exists:roles,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام الزامی است.',
            'name.max' => 'نام باید حداکثر 255 کاراکتر باشد.',
            'name.min' => 'نام باید حداقل 3 کاراکتر باشد.',
            'email.required' => 'ایمیل الزامی است.',
            'email.email' => 'ایمیل وارد شده معتبر نیست.',
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',
            'address.min' => 'آدرس باید حداقل 10 کاراکتر باشد.',
            'address.max' => 'آدرس باید حداقل 500 کاراکتر باشد.',
            'phone.regex' => 'شماره تلفن معتبر نیست. مثال: 09123456789 یا 02112345678',
            'store_phone.regex' => 'تلفن فروشگاه معتبر نیست.',
            'store_name.min' => 'نام فروشگاه باید حداقل 3 کاراکتر باشد.',
            'store_name.max' => 'نام فروشگاه باید حداکثر 50 کاراکتر باشد.',
            'license_number.min' => 'شماره مجوز باید حداقل 5 کاراکتر باشد.',
            'license_number.max' => 'شماره مجوز باید حداکثر 30 کاراکتر باشد.',
            'password.min' => 'رمز عبور باید حداقل 6 کاراکتر باشد.',
            'password.max' => 'رمز عبور باید حداکثر 50 کاراکتر باشد.',
            'role.exists' => 'نقش انتخاب شده معتبر نیست.',
        ];
    }
}
