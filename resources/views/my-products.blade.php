@extends('layouts.app')
@section('title', 'my products')
@section('content')
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <!-- نوار کناری دسته‌بندی‌ها -->
            <div class="col-md-3">
                <div class="sidebar">
                    <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">دسته‌بندی‌ها</h4>
                    @if ($errors->any())
                        <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                            @foreach($errors->all() as $error)
                                <li style="color: red;font-size: 16px" class="my-2"><b>_</b> {{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @foreach($categories as $category)
                        <a class="category-link" href="#category-{{ $category->id }}">{{ $category->name }}  </a>
                            @seller
                                <div style="display: flex; align-items: center;">
                                    <form action="{{ route('category.delete', $category->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-delete" style="color: red">حذف</button>
                                    </form>

                                    <button class="btn btn-edit" style="color: #007bff"
                                            id="showCategoryEditForm-{{ $category->id }}">ویرایش
                                    </button>

                                    <form action="{{ route('category.update', $category->id) }}" method="POST"
                                          id="EditCategory-{{ $category->id }}" onsubmit="this.querySelector('button').disabled = true;"
                                          style="display: none; margin-top: 10px;">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">نام دسته‌بندی:</label>
                                            <input type="text" name="name" class="form-control input-sm"
                                                   value="{{ $category->name }}">
                                        </div>
                                        <button type="submit" class="btn btn-success btn-sm">ثبت</button>
                                    </form>

                                    <script>
                                        $(document).ready(function () {
                                            $('#showCategoryEditForm-{{ $category->id }}').click(function () {
                                                $('#EditCategory-{{ $category->id }}').slideToggle();
                                            });
                                        });
                                    </script>
                                </div>
                                <hr>
                            @endseller
                    @endforeach
                    @seller
                            <div class="mt-2">
                                <button class="btn btn-primary btn-sm" id="showCategoryForm">افزودن دسته‌بندی
                                    <b><b>+</b></b></button>

                                <form action="{{ route('category.store') }}" method="POST" id="categoryForm"
                                      style="display: none; margin-top: 10px;" onsubmit="this.querySelector('button').disabled = true;">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">نام دسته‌بندی:</label>
                                        <input type="text" name="name" class="form-control input-sm" required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">ثبت</button>
                                </form>
                            </div><br>
                    @endseller
                </div>
                <br>
            </div>
            <script>
                function showForm(id) {
                    document.getElementById('category-display-' + id).style.display = 'none';
                    document.getElementById('category-form-' + id).style.display = 'flex';
                }

                $(document).ready(function () {
                    $('#showCategoryForm').click(function () {
                        $('#categoryForm').slideToggle();
                    });
                });
            </script>
            <div class="custom-product-wrapper">
                <div class="custom-product-grid">
                    @foreach($products as $product)
                        <div class="custom-product-card">
                            @if($product->discount > 0)
                                <div class="custom-discount-badge">{{ $product->discount }}٪ تخفیف</div>
                            @endif

                            <figure class="custom-product-image">
                                <a href="{{ route('product.show', $product->id) }}">
                                    <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                                </a>
                            </figure>

                            <div class="custom-product-body">
                                <div class="custom-product-title">{{ Str::limit($product->name, 20) }}</div>
                                <div class="custom-product-desc">{{ Str::limit($product->description, 25) }}</div>

                                @if($product->discount > 0)
                                    <div class="custom-product-old-price">{{ toPersianNumber(number_format($product->price)) }} تومان</div>
                                    <div class="custom-product-price">{{ toPersianNumber(number_format($product->price - ($product->price * $product->discount / 100))) }} تومان</div>
                                @else
                                    <div class="custom-product-price">{{ toPersianNumber(number_format($product->price)) }} تومان</div>
                                @endif

                                <div class="custom-product-category">
                                    <u>{{ $product->category->name }}</u>
                                </div>
                                <div class="custom-product-date">{{ $product->created_at_jalali }}</div>

                                <div class="custom-product-buttons">
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-block">ویرایش</a>

                                    <form action="{{ route('product.delete', $product->id) }}" method="post" style="margin-top: 5px;"
                                          onsubmit="this.querySelector('button').disabled = true;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-block">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
