<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comment' => ['nullable', 'string','max:1000', function ($attribute, $value, $fail) {
                if ($this->containsBadWords($value)) {
                    $fail('لطفاً از به‌کار بردن کلمات ناپسند خودداری کنید.');
                }
            },
                'rating' => ['nullable','between:0,5'],
            ],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $content = $this->input('comment');
            $rate = $this->input('rating');

            if (empty($content) && empty($rate)) {
                $validator->errors()->add('comment', 'نوشتن متن یا انتخاب امتیاز حداقل یکی الزامی است.');
            }
        });
    }

    protected function containsBadWords($text): bool
    {
        $badWords = [
            'کیر', 'کص', 'کس', 'کونی', 'جنده', 'بی‌ناموس', 'لعنتی', 'کسخل',
            'احمق', 'حرومزاده', 'pussy', 'dick', 'fuck', 'shit'
        ];

        $normalized = $this->normalizeText($text);

        foreach ($badWords as $word) {
            $pattern = '/\b' . preg_quote($this->normalizeText($word), '/') . '\b/u';
            if (preg_match($pattern, $normalized)) {
                return true;
            }
        }

        return false;
    }

    protected function normalizeText($text): string
    {
        $text = preg_replace('/[^\p{L}\p{N}]+/u', '', $text); // حذف فاصله‌ها و علائم
        $text = str_replace(['ي', 'ى'], 'ی', $text);
        $text = str_replace('ك', 'ک', $text);
        return mb_strtolower($text);
    }
    public function messages(): array
    {
        return [
            'comment.required' => 'لطفاً متن نظر را وارد کنید.',
            'comment.string' => 'نظر باید متن باشد.',
            'comment.max' => 'متن نظر نباید بیشتر از ۱۰۰۰ کاراکتر باشد.',
        ];
    }
}
