@php
    $layout = auth()->check() && auth()->user()->roles()->first()->name=='مدیر' ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layout)

@section('title', 'درخواست‌های زیاد')

@section('content')
    <div class="container" style="margin-top: 50px; text-align: center;">
        <h1 style="font-size: 4rem; color: #f0ad4e;">۴۲۹</h1>
        <h2>درخواست‌های شما بیش از حد مجاز است</h2>
        <p>لطفا چند لحظه صبر کنید و دوباره تلاش کنید.</p>
        @all
        <a href="/" class="btn btn-warning">بازگشت به صفحه اصلی</a>
        @endall
    </div>
@endsection
