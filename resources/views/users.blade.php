@extends('layouts.admin')

@section('title', 'مدیریت کاربران')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" style="margin-top: 10px;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-info" style="margin-top: 10px;">
            {{ session('message') }}
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>ایمیل</th>
                    <th>نقش</th>
                    <th>تاریخ عضویت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ toPersianNumber($user->id) }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->roles()->first()?->name ?? '---' }}
                        </td>
                        @php

                        @endphp
                        <td>{{ $user->created_at_jalali }}</td>
                        <td>
                            <a href="{{ route('user.admin.show', $user->id) }}" class="btn btn-xs btn-info">مشاهده</a>
                            @if (!empty($user->deleted_at)){{
                            'حذف شده'
                            }}
                            @else
                            <a href="{{route('user.admin.edit',$user)}}" class="btn btn-xs btn-warning">ویرایش</a>
                            <form action="{{ route('user.admin.delete', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('آیا مطمئن هستید؟')" class="btn btn-xs btn-danger">حذف
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">هیچ کاربری یافت نشد.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="text-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
