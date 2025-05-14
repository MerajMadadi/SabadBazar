@extends('layouts.app')

@section('title', 'پرداخت آنلاین')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    body {
        background: #f9f9f9;
    }

    .payment-box {
        background: #fff;
        padding: 30px;
        margin: 50px auto;
        max-width: 500px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .payment-box h2 {
        margin-bottom: 20px;
    }
</style>
@section('content')
    <div class="payment-box">
        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                @foreach($errors->all() as $error)
                    <li style="text-align: center;margin-bottom: 40px;color: red;font-size: 16px" class="my-2">
                        <b><b>_</b> {{ $error }}</b></li>
                @endforeach
            </ul>
        @endif
        {{--    <h2>درگاه پرداخت شبیه‌سازی شده</h2>--}}
        <form method="POST" action="{{ route('payment.process') }}">
            @csrf
            <div class="form-group">
                <label>شماره کارت</label>
                <input type="text" name="card_number" class="form-control" placeholder="16 رقم"
                       maxlength="16">
            </div>
            <div class="form-group">
                <label>CVV2</label>
                <input type="text" name="cvv2" class="form-control fa-num" maxlength="4">
            </div>
            <div class="form-group">
                <label>تاریخ انقضا</label>
                <input type="text" name="expiry" class="form-control fa-num" placeholder="ماه/سال (مثال: ۱۲/۰۵)">
            </div>
            <div class="form-group">
                <label>مبلغ (تومان)</label>
                <div class="bg-success">{{toPersianNumber(number_format($total))}}</div>
            </div>
            <button type="submit" class="btn btn-success btn-block">پرداخت</button>
        </form>
    </div>
@endsection
