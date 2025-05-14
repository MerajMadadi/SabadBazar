<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
public function authorize()
{
return true; // اجازه همه کاربران برای ارسال فرم
}

public function rules()
{
return [
'name' => 'required|string|max:255',
'description' => 'nullable|string',
'price' => 'required|numeric|min:0',
'stock' => 'required|integer|min:1',
'unit' => 'required|string|max:50',
'category_id' => 'required|exists:categories,id',
'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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
'image.required' => 'تصویر محصول الزامی است.',
'image.image' => 'فایل انتخاب شده باید یک تصویر باشد.',
'image.mimes' => 'فرمت تصویر باید jpeg، png، jpg، gif یا webp باشد.',
'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
];
}
}
