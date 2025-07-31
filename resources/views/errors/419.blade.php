@php
    $layout = auth()->check() && auth()->user()->roles()->first()->name=='مدیر' ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layout)

@section('title', 'خطای امنیتی')

@section('content')
    <div class="container" style="margin-top: 50px; text-align: center;">
        <h1 style="font-size: 4rem; color: #f0ad4e;">۴۱۹</h1>
        <h2>صفحه منقضی شده است</h2>
        <p>زمان جلسه شما به پایان رسیده یا توکن امنیتی نامعتبر است. لطفا صفحه را دوباره بارگذاری کنید.</p>
    </div>
@endsection
