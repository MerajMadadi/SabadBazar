@php
    $layout = auth()->check() && auth()->user()->roles()->first()?->name == 'مدیر' ? 'layouts.admin' : 'layouts.app';
@endphp

@extends($layout)

@section('title', 'پروفایل شما')

@section('content')
    <div style="margin-top: 50px" class="auth-container center rt-20 rt-mt-50" style="max-width: 600px; margin: auto;">
        @if(auth()->user()->roles()->first()->name !== 'مدیر')
        <h2 class="rt-24 rt-rang">پروفایل شما</h2>
        @endif
        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                @foreach($errors->all() as $error)
                    <li style="color: red;font-size: 16px" class="my-2"><b>_</b> {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('user.update') }}" class="rt-form rt-mt-20">
            @csrf
            @method('PUT')

            <input type="text" name="name" placeholder="نام کامل" class="rt-input rt-13 rt-rtl" required
                   value="{{ old('name',auth()->user()->name) }}">
            <input type="email" name="email" placeholder="ایمیل" class="rt-input rt-13 rt-rtl" required
                   value="{{ old('email',auth()->user()->email) }}">
            <input type="password" name="new_password"
                   placeholder="رمز عبور جدید"
                   class="rt-input rt-13 rt-rtl">
            <input type="text" name="phone" value="{{ old('phone',auth()->user()->phone) }}"
                   placeholder="تلفن همراه (اختیاری)"
                   class="rt-input rt-13 rt-rtl">
            <input type="text" name="address" value="{{ old('address',auth()->user()->address) }}"
                   placeholder="آدرس (اختیاری)"
                   class="rt-input rt-13 rt-rtl">
            {{-- اگر فروشنده هست --}}
            @seller
            <input type="text" id="store_name" placeholder="نام فروشگاه" name="store_name"
                   value="{{ old('store_name', auth()->user()->store_name) }}"
                   class="rt-input rt-13 rt-rtl" required>

            <input type="text" id="license_number" placeholder="شماره مجوز" name="license_number"
                   value="{{ old('license_number', auth()->user()->license_number) }}"
                   class="rt-input rt-13 rt-rtl" required>
            @endseller

            <button type="submit" class="rt-btn rt-color rt-16 rt-pointer rt-mt-20">به‌روزرسانی پروفایل</button>
            <br>
        </form>
        <br>
        @if(auth()->user()->roles()->first()->name !== 'مدیر')
            <form action="{{ route('user.delete', auth()->user()->id) }}" method="POST"
                  onsubmit="return confirm('آیا مطمئنید می‌خواهید حذف کنید؟')">
                @csrf
                @method('DELETE')
                <button class="btn btn-delete">
                    <span class="mdi mdi-delete mdi-24px"></span>
                    <span class="mdi mdi-delete-empty mdi-24px"></span>
                    <span style="color: red">حذف حساب کاربری</span>
                </button>
            </form>
        @endif
    </div>
@endsection
