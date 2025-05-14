@extends('layouts.admin')

@section('title', 'بروزرسانی محصول')

@section('content')
    <div class="auth-container center rt-20 rt-mt-50" style="margin-top: 0">
        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                @foreach($errors->all() as $error)
                    <li style="color: red;font-size: 16px" class="my-2"><b>_</b> {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('admin.product.update',$product->id) }}" class="rt-form rt-mt-20"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" name="name" placeholder="نام محصول" class="rt-input rt-13 rt-rtl" required
                   value="{{$product->name}}">
            <input type="text" name="description" placeholder="توضیحات" class="rt-input rt-13 rt-rtl" required
                   value="{{$product->description}}">
            <div class="form-group">
                <img src="{{asset($product->image_url)}}" alt="no image"
                     style="height: 150px; width: 100%; object-fit: contain">
                <label class="input-label" for="image">تصویر محصول</label>
                <input type="file" id="image" name="image" class="input-file"
                       accept="image/*">
            </div>

            <!-- قیمت -->
            <div class="form-group">
                <label class="input-label" for="price">قیمت (تومان)</label>
                <div class="input-wrapper">
                    <input type="number" id="price" name="price"
                           class="input-number input-price" value="{{$product->price}}"
                           min="1" step="1" required><br>
                </div>
            </div>
            <div class="form-group">
                <label class="input-label" for="price">تخفیف (درصد)</label>
                <div class="input-wrapper">
                    <input type="number" id="discount" name="discount"
                           class="input-number input-discount" value="{{$product->discount}}"
                           placeholder="برای مثال 20%"><br>
                </div>
            </div>
            <!-- تعداد موجودی -->
            <div class="form-group">
                <label class="input-label" for="stock">تعداد موجودی</label>
                <input type="number" id="stock" name="stock" value="{{$product->stock}}" class="input-number"
                       placeholder="مثلاً 20" min="0"
                       step="1" required>
            </div>
            <div class="form-group">
                <label class="input-label" for="unit">واحد شمارش</label>
                <input type="text" value="{{$product->unit}}" id="unit" name="unit" class="rt-input rt-13 rt-rtl"
                       placeholder="مثلاً هر بسته 600 گرم" required>
            </div>

            <label>دسته‌بندی محصول:</label>
            <select style="margin-bottom: 20px" name="category_id" class="form-control" required>
                <option value="">انتخاب کنید</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="submit-btn">ثبت محصول</button>
        </form>
    </div>
@endsection
