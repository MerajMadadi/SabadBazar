@extends('layouts.app')

@section('title', 'بروزرسانی محصول')

@section('content')
    <div class="auth-container center rt-20 rt-mt-50">
        <h2 class="rt-24 rt-rang">بروزرسانی محصول</h2>

        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                @foreach($errors->all() as $error)
                    <li style="color: red;font-size: 16px" class="my-2"><b>_</b> {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('product.update',$product->id) }}" class="rt-form rt-mt-20"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" name="name" placeholder="نام محصول" class="rt-input rt-13 rt-rtl" required
                   value="{{$product->name}}">
            <input type="text" name="description" placeholder="توضیحات" class="rt-input rt-13 rt-rtl" required
                   value="{{$product->description}}">
            <div class="form-group">
                <img src="{{asset($product->image_url)}}" alt="{{$product->name}}"
                     style="height: 150px; width: 100%; object-fit: contain">
                <label class="input-label" for="image">تصویر محصول</label>
                <input type="file" id="image" name="image" class="input-file"
                       accept="image/*">
            </div>
            @php
                $price = str_replace('.00','',$product->price)
            @endphp
                <!-- قیمت -->
            <div class="form-group">
                <label class="input-label" for="price">قیمت (تومان)</label>
                <div class="input-wrapper">
                    <input type="number" id="price" name="price"
                           class="input-number input-price"
                           value="{{$price}}" min="1" step="1" required><br>
                </div>
            </div>
            {{--   //اعمال تخفیف--}}
            <div class="form-group">
                <label class="input-label" for="price">تخفیف (درصد)</label>
                <div style="height: 50%;font-size: 15px" class="alert alert-info">
                    از طریق این فیلد میتوانید به مقدار دلخواه برای محصولتان تخفیف اعمال کنید ، تا در دسته بندی فروش ویژه
                    توسط مشتری مشاهده شوند. <b>لطفا به درصد وارد کنید.</b>
                </div>

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
