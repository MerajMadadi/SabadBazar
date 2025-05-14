@extends('layouts.app')

@section('title', 'ثبت‌نام')

@section('content')
    <div class="auth-container center rt-20 rt-mt-50">
        <h2 class="rt-24 rt-rang">ایجاد حساب کاربری</h2>

        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                @foreach($errors->all() as $error)
                    <li style="color: red;font-size: 16px" class="my-2"><b>_</b> {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('register.user') }}" class="rt-form rt-mt-20">
            @csrf
            <input type="text" name="name" placeholder="نام کامل" class="rt-input rt-13 rt-rtl" required
                   value="{{ old('name') }}">
            <input type="email" name="email" placeholder="ایمیل" class="rt-input rt-13 rt-rtl" required
                   value="{{ old('email') }}">
            <input type="password" name="password" value="{{ old('password') }}" placeholder="رمز عبور (بالای 8 رقم)"
                   class="rt-input rt-13 rt-rtl" required>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                   placeholder="تکرار رمز عبور"
                   class="rt-input rt-13 rt-rtl" required>
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="تلفن همراه (اختیاری)"
                   class="rt-input rt-13 rt-rtl">
            <input type="text" name="address" value="{{ old('address') }}" placeholder="آدرس (اختیاری)"
                   class="rt-input rt-13 rt-rtl">

            <label for="is_seller">
                <input type="hidden" name="is_seller" value="0">
                <input type="checkbox" id="is_seller" name="is_seller" value="1">
                <h5 style="display: inline;">فروشنده هستم</h5>
            </label>


            <div id="seller_fields" style="display: none; margin-top: 10px;">
                <input type="text" name="store_name" value="{{ old('store_name')}}" placeholder="نام فروشگاه"
                       class="rt-input rt-13 rt-rtl">
                <input type="text" name="store_phone" value="{{ old('store_phone')}}" placeholder="تلفن فروشگاه"
                       class="rt-input rt-13 rt-rtl">
                <input type="text" name="store_address" value="{{ old('store_address') }}" placeholder="آدرس کامل فروشگاه شما"
                       class="rt-input rt-13 rt-rtl">
                <input type="text" name="license_number" value="{{ old('license_number')}}" placeholder="شماره مجوز"
                       class="rt-input rt-13 rt-rtl">
            </div>

            <!-- جاوااسکریپت برای نمایش/مخفی کردن -->
            <script>
                document.getElementById('is_seller').addEventListener('change', function () {
                    const sellerFields = document.getElementById('seller_fields');
                    sellerFields.style.display = this.checked ? 'block' : 'none';
                });
            </script>


            <button type="submit" class="rt-btn rt-color rt-16 rt-pointer">ثبت‌نام</button>
            <p class="rt-13 rt-mt-10">حساب دارید؟ <a href="/login">وارد شوید</a></p>
        </form>
    </div>
@endsection
