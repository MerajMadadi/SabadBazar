@extends('layouts.app')

@section('title', 'رسید پرداخت')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    body { background: #f0f0f0; }
    .receipt-box {
        background: #fff;
        padding: 30px;
        margin: 50px auto;
        max-width: 500px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 8px;
    }
</style>
@section('content')
<div class="receipt-box">
    <div class="bg-success">پرداخت با موفقیت انجام شد</div>
    <p><strong>کد تراکنش:</strong> {{ $transaction->transaction_code }}</p>
    <p><strong>مبلغ:</strong> {{ number_format($transaction->amount) }} تومان</p>
    <p><strong>شماره کارت:</strong>{{ toPersianNumber($transaction->card_number) }}</p>
    <p><strong>تاریخ پرداخت:</strong> {{$transaction->created_at_jalali }}</p>
    <a href="/" class="btn btn-primary">بازگشت به صفحه اصلی</a>
</div>
@endsection
