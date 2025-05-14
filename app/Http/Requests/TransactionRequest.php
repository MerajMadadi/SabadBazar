<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'card_number' => 'required|digits:16',
            'cvv2' => 'required|digits_between:3,4',
            'expiry' => 'required',
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'card_number' => preg_replace('/\D/', '', $this->card_number),
        ]);
    }
    public function messages()
    {
        return [
            'card_number.required' => 'وارد کردن شماره کارت الزامی است.',
            'card_number.digits' => 'شماره کارت باید دقیقا ۱۶ رقم باشد.',
            'cvv2.required' => 'کد CVV2 را وارد کنید.',
            'cvv2.digits_between' => 'کد CVV2 باید ۳ یا ۴ رقم باشد.',
            'expiry.required' => 'تاریخ انقضا را وارد کنید.',
        ];
    }
}
