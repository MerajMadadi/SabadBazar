<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct_AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'stock' => ['required', 'integer', 'min:0'],
            'unit' => ['required', 'string', 'max:50'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'], // 2MB
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام محصول الزامی است.',
            'price.required' => 'قیمت محصول الزامی است.',
            'price.numeric' => 'قیمت باید عددی باشد.',
            'discount.numeric' => 'تخفیف باید عددی باشد.',
            'discount.max' => 'حداکثر تخفیف ۱۰۰٪ می‌باشد.',
            'stock.required' => 'موجودی الزامی است.',
            'stock.integer' => 'موجودی باید عدد صحیح باشد.',
            'unit.required' => 'واحد محصول الزامی است.',
            'category_id.required' => 'دسته‌بندی الزامی است.',
            'category_id.exists' => 'دسته‌بندی انتخاب شده معتبر نیست.',
            'image.image' => 'فایل باید یک تصویر باشد.',
            'image.max' => 'حجم تصویر نباید بیش از ۲ مگابایت باشد.',
        ];
    }
}
