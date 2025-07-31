@php
    $layout = auth()->check() && auth()->user()->roles()->first()->name=='مدیر' ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layout)

@section('title', 'خطای سرور')

@section('content')
    <div class="container" style="margin-top: 50px; text-align: center;">
        <h1 style="font-size: 4rem; color: #d9534f;">۵۰۰</h1>
        <h2>خطای سرور داخلی</h2>
        <p>متاسفیم، مشکلی در سرور به وجود آمده است. لطفا بعدا دوباره تلاش کنید.</p>
        @all
        <a href="{{ url('/') }}" class="btn btn-primary">بازگشت به صفحه اصلی</a>
        @endall
    </div>
@endsection
