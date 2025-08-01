@extends('layouts.app')

@section('title', 'ورود')

@section('content')
    <div class="auth-container center rt-20 rt-mt-50">
        <h2 class="rt-24 rt-rang">ورود به حساب کاربری</h2>
        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                @foreach($errors->all() as $error)
                    <li style="color: red;font-size: 16px" class="my-2"><b>_</b> {{ $error }}.</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('login') }}" class="rt-form rt-mt-20">
            @csrf
            <input type="email" name="email" value="{{ old('email') }}" placeholder="ایمیل"
                   class="rt-input rt-13 rt-rtl" required>
            <input type="password" name="password" placeholder="رمز عبور (بالای 8 رقم)" class="rt-input rt-13 rt-rtl" required>
            <button type="submit" class="rt-btn rt-color rt-16 rt-pointer">ورود</button>
            <p class="rt-13 rt-mt-10">حساب ندارید؟ <a href="/register/">ثبت‌نام کنید</a></p>
        </form>
    </div>
@endsection
