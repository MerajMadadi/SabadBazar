<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:1',
            'unit' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'discount' => 'nullable|numeric|between:0,100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام محصول الزامی است.',
            'name.string' => 'نام محصول باید متن باشد.',
            'price.required' => 'قیمت محصول الزامی است.',
            'price.numeric' => 'قیمت باید به صورت عددی وارد شود.',
            'price.min' => 'قیمت نمی‌تواند منفی باشد.',
            'stock.required' => 'موجودی محصول الزامی است.',
            'stock.integer' => 'موجودی باید عدد صحیح باشد.',
            'stock.min' => 'موجودی باید حداقل ۱ باشد.',
            'unit.required' => 'واحد محصول الزامی است.',
            'category_id.required' => 'دسته‌بندی الزامی است.',
            'category_id.exists' => 'دسته‌بندی انتخاب شده معتبر نیست.',
            'image.image' => 'فایل انتخاب شده باید یک تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید jpeg، png، jpg، gif یا webp باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'discount.numeric' => 'فرمت درصد تخفیف معتبر نیست.',
            'discount.between' => 'درصد تخفیف باید بین ۰ تا ۱۰۰ باشد.',
        ];
    }
}
