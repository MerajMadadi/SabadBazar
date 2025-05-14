@extends('layouts.app')

@section('title', 'افزودن محصول')

@section('content')
    <div class="auth-container center rt-20 rt-mt-50">
        <h2 class="rt-24 rt-rang">ثبت محصول</h2>

        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                @foreach($errors->all() as $error)
                    <li style="color: red;font-size: 16px" class="my-2"><b>_</b> {{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('product.store') }}" class="rt-form rt-mt-20"
              enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="نام محصول" class="rt-input rt-13 rt-rtl" required
                   value="{{ old('name') }}">
            <input type="text" name="description" placeholder="توضیحات" class="rt-input rt-13 rt-rtl" required
                   value="{{ old('description') }}">
            <div class="form-group">
                <label class="input-label" for="image">تصویر محصول</label>
                <input type="file" id="image" name="image" class="input-file" accept="image/*" required>
            </div>

            <!-- قیمت -->
            <div class="form-group">
                <label class="input-label" for="price">قیمت (تومان)</label>
                <div class="input-wrapper">
                    <input type="number" value="{{old('price')}}" id="price" name="price"
                           class="input-number input-price"
                           placeholder="مثلاً 100000" min="1" step="1" required>
                </div>
            </div>

            <!-- تعداد موجودی -->
            <div class="form-group">
                <label class="input-label" for="stock">تعداد موجودی</label>
                <input type="number" value="{{old('stock')}}" id="stock" name="stock" class="input-number"
                       placeholder="مثلاً 20" min="0"
                       step="1" required>
            </div>
            <div class="form-group">
                <label class="input-label" for="unit">واحد شمارش</label>
                <div style="height: 50%;font-size: 14px" class="alert alert-info">واحد های وزنی را به گرم بنویسید.<br>وحد های قابل شمارش هم تعداد بنویسید.(مانند نان)</div>
                <input type="text" value="{{old('unit')}}" id="unit" name="unit" class="rt-input rt-13 rt-rtl"
                       placeholder="مثلاً هر بسته 600 گرم" required>
            </div>

            <label>دسته‌بندی محصول:</label>
            <select style="margin-bottom: 20px" name="category_id" class="form-control" required>
                <option value="">انتخاب کنید</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="submit-btn">ثبت محصول</button>
        </form>
    </div>
@endsection
