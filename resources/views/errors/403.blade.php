@php
    $layout = auth()->check() && auth()->user()->roles()->first()->name=='مدیر' ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layout)

@section('title', 'دسترسی غیرمجاز')

@section('content')
    <div class="container" style="margin-top: 50px; text-align: center;">
        <h1 style="font-size: 4rem; color: #d9534f;">۴۰۳</h1>
        <h2>دسترسی غیرمجاز</h2>
        <p>شما اجازه دسترسی به این صفحه را ندارید.</p>
        @all
        <a href="/" class="btn btn-primary">بازگشت به صفحه اصلی</a>
        @endall
        @admin
        <a href="/panel" class="btn btn-primary">بازگشت به صفحه اصلی</a>
        @endadmin
    </div>
@endsection
