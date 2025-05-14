<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryCenterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => ['required', 'regex:/^(0(9\d{9}|2\d{9}|3\d{9}|4\d{9}|5\d{9}|6\d{9}|7\d{9}|8\d{9}))$/'],
            'address' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام مرکز الزامی است.',
            'image.image' => 'فایل باید یک تصویر معتبر باشد.',
            'image.mimes' => 'فرمت تصویر باید jpeg, png, jpg یا gif باشد.',
            'image.max' => 'حجم تصویر نباید بیش از ۲ مگابایت باشد.',
            'phone.required' => 'شماره تماس الزامی است.',
            'phone.regex' => 'شماره وارد شده معتبر نیست. لطفا یک شماره تلفن همراه یا ثابت صحیح وارد کنید.',
            'address.required' => 'آدرس مرکز الزامی است.',
        ];
    }
}
