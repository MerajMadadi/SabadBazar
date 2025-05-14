<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'دسته بندی نمیتواند خالی باشد',
            'name.min' => 'حداقل برای دسته بندی باید 3 کاراکتر وارد کنید',
            'name.max' => 'برای دسته بندی حداکثر 255 کاراکتر میتوانید اضافه کنید',
        ];
    }
}
