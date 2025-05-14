@extends('layouts.admin')

@section('title', 'ویرایش کاربر')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @if ($errors->any())
                <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                    @foreach($errors->all() as $error)
                        <li style="color: red;font-size: 16px" class="my-2"><b>_</b> {{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form method="POST" action="{{ route('user.admin.update', $user->id) }}"
                  onsubmit="this.querySelector('button').disabled = true;">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>نام</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>ایمیل</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>تلفن</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>آدرس</label>
                    <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control">
                </div>

                <label for="password">رمز عبور:</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="text" id="password" name="password" class="form-control" placeholder="رمز عبور"
                           style="flex: 1;"/>
                    <button type="button" class="btn btn-default" onclick="fetchRandomPassword()">رمز تصادفی</button>
                </div>
                <script>
                    function fetchRandomPassword() {
                        fetch('{{ route('generate.password') }}')
                            .then(res => res.json())
                            .then(data => {
                                document.getElementById('password').value = data.password;
                            })
                            .catch(err => alert("خطا در تولید رمز"));
                    }
                </script>

                @if($user->roles()->first()->name=='فروشنده')
                <div class="form-group">
                    <label>نام فروشگاه</label>
                    <input type="text" name="store_name" value="{{ $user->store_name}}"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label>تلفن فروشگاه</label>
                    <input type="text" name="store_phone" value="{{ $user->store_phone}}"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label>شماره مجوز</label>
                    <input type="text" name="license_number" value="{{ $user->license_number}}"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label>آدرس فروشگاه</label>
                    <input type="text" name="store_address" value="{{ $user->store_address }}"
                           class="form-control">
                </div>
                @endif
                <div class="form-group">
                    <label>نقش</label>
                    <select name="role" class="form-control">
                        @foreach($roles as $role)
                            <option
                                value="{{ $role->id }}" {{ ($user->roles()->first()?->id == $role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
                <a href="{{--{{ route('user.admin.update',$user->id) }}--}}" class="btn btn-default">انصراف</a>
            </form>
        </div>
    </div>
@endsection
