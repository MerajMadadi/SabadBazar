@extends('layouts.admin')

@section('title', 'مشاهده پروفایل کاربر')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>نام</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>ایمیل</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>تلفن</th>
                    <td>{{ $user->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <th>آدرس</th>
                    <td>{{ $user->address ?? '-'}}</td>
                </tr>
                @if($user->roles()->first()->name == 'فروشنده')
                    <tr>
                        <th>نام فروشگاه</th>
                        <td>{{ $user->store_name }}</td>
                    </tr>
                    <tr>
                        <th>تلفن فروشگاه</th>
                        <td>{{ $user->store_phone }}</td>
                    </tr>
                    <tr>
                        <th>شماره مجوز</th>
                        <td>{{ $user->license_number }}</td>
                    </tr>
                    <tr>
                        <th>آدرس فروشگاه</th>
                        <td>{{ $user->store_address }}</td>
                    </tr>
                @endif
                <tr>
                    <th>نقش</th>
                    <td>
                        @if($user->roles()->exists())
                            {{ $user->roles()->first()->name }}
                        @else
                            <span class="text-muted">بدون نقش</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>تاریخ عضویت</th>
                    <td>{{ $user->created_at_jalali }}</td>
                </tr>
                <tr>
                    <th>آخرین بروزرسانی</th>
                    <td>{{ $user->updated_at_jalali }}</td>
                </tr>
                @if($user->deleted_at)
                <tr>
                    <th>حذف شده در تاریخ</th>
                    <td>{{ $user->deleted_at_jalali }}</td>
                </tr>
                @endif
            </table>
            @if($user->deleted_at)
                <a href="{{ route('user.restore', $user->id) }}" class="btn btn-primary">بازگردانی</a>
            @else
            <a href="{{ route('user.admin.edit', $user->id) }}" class="btn btn-primary">ویرایش کاربر</a>
            @endif
            <a href="/panel/users" class="btn btn-default">بازگشت به لیست کاربران</a>
        </div>
    </div>
@endsection
