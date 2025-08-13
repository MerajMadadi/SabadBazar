@extends('layouts.admin')

@section('title', 'ثبت مرکز تحویل')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('center.store') }}" method="POST" enctype="multipart/form-data"
                  onsubmit="this.querySelector('button').disabled = true;">
                @csrf

                <div class="form-group">
                    <label for="name">نام مرکز</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="address">آدرس</label>
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="phone">تلفن</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>

                <div class="form-group">
                    <label for="image">تصویر مرکز (اختیاری)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">ثبت مرکز</button>
                <a href="{{ route('admin.delivery.centers') }}" class="btn btn-default">بازگشت</a>
            </form>
        </div>
    </div>
@endsection
