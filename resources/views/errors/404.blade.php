@php
    $layout = auth()->check() && auth()->user()->roles()->first()->name=='مدیر' ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layout)

@section('title', 'صفحه پیدا نشد')

@section('content')
    <div class="container text-center" style="margin-top: 100px; margin-bottom: 100px;">
        <h1 style="font-size: 120px; font-weight: bold; color: #c82333;">404</h1>
        <h2 style="font-weight: bold; font-size: 32px; margin-top: 20px;">صفحه مورد نظر پیدا نشد</h2>
        <p style="font-size: 18px; color: #555; margin-top: 10px;">
            ممکن است آدرس را اشتباه وارد کرده باشید یا صفحه حذف شده باشد.
        </p>
        @all
        <a href="/" class="btn btn-lg" style="background: #69982D; color: white; margin-top: 30px;">
            بازگشت به صفحه اصلی
        </a>
        @endall
        @admin
        <a href="/panel" class="btn btn-lg" style="background: #69982D; color: white; margin-top: 30px;">
            بازگشت به صفحه اصلی
        </a>
        @endadmin
    </div>
@endsection
