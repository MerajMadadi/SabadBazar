@extends('layouts.app')
@section('title', 'products')
@section('content')
    <!doctype html>
<html>
<head>
    <title>محصولات دسته بندی ها</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="container" style="margin-top: 50px;">
    <div class="visible-xs">
        <button class="btn btn-default btn-block" id="toggle-categories">نمایش دسته‌بندی‌ها</button>
        <div id="mobile-categories" style="display: none; margin-top: 10px">
            @foreach($categories as $category)
                <a class="btn btn-sm btn-primary btn-block" href="#category-{{ $category->id }}" style="margin-bottom: 5px;background: #4B8106">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#toggle-categories').click(function () {
                $('#mobile-categories').slideToggle();
            });
        });
    </script>

    <div class="row">
        <!-- نوار کناری دسته‌بندی‌ها -->
        <div class="col-md-3">
            <div class="sidebar">
                <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">دسته‌بندی‌ها</h4>

                @foreach($categories as $category)
                    <a class="category-link" href="#category-{{ $category->id }}">{{ $category->name }}  </a>
                    @auth
                        @if(auth()->user()->roles()->first()->name !== 'کاربر عادی')
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
                                      id="EditCategory-{{ $category->id }}"
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
                        @endif
                    @endauth
                @endforeach
                @seller
                <div class="mt-2">
                    <button class="btn btn-primary btn-sm" id="showCategoryForm">افزودن دسته‌بندی
                        <b><b>+</b></b></button>

                    <form action="{{ route('category.store') }}" method="POST" id="categoryForm"
                          style="display: none; margin-top: 10px;">
                        @csrf
                        <div class="form-group">
                            <label for="name">نام دسته‌بندی:</label>
                            <input type="text" name="name" class="form-control input-sm" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">ثبت</button>
                    </form>
                </div>
                <br>
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

        <!-- محتوای دسته‌ها -->
        <div class="col-md-9">
            @foreach($categories as $category)
                <div style="margin-bottom: 40px;">
                    <h3 id="category-{{ $category->id }}"
                        style="border-bottom: 2px solid #ccc; padding-bottom: 5px; margin-bottom: 20px;">
                        {{ $category->name }}
                    </h3>

                    <div class="product-grid">
                        @foreach($category->products as $product)
                            <div id="product-card-products" class="product-card" style="margin: 20px">
                                @if($product->discount > 0)
                                    <div class="discount-badge">{{ toPersianNumber($product->discount) }}٪ تخفیف</div>
                                @endif
                                @if($product->stock <= 0)
                                    <div class="out-of-stock">اتمام موجودی</div>
                                @endif
                                <figure>
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <img src="{{ asset($product->image_url) }}"
                                             alt="بدون عکس">
                                    </a>
                                </figure>
                                <div class="card-body">
                                    <div>
                                        <div
                                            class="title">{{ Str::limit($product->name, 25) }}</div>
                                        @if($product->discount > 0)
                                            <div class="old-price">{{ toPersianNumber(number_format($product->price)) }}
                                                تومان
                                            </div>
                                            <div class="price" style="color:#d9534f">
                                                {{ toPersianNumber(number_format($product->price -
                                                       $product->price * $product->discount/100)) }}
                                                تومان
                                            </div>
                                        @else
                                            <div class="price">{{ toPersianNumber(number_format($product->price)) }}
                                                تومان
                                            </div>
                                        @endif

                                        <div class="payment-method">
                                            <i class="fa fa-shopping-bag"></i> پرداخت در فروشگاه
                                        </div>
                                        <div class="rating">
                                            ★ {{ toPersianNumber(round($product->comments->avg('rate') ?? 0, 1)) }}</div>
                                    </div>
                                    @user
                                    @if($product->stock > 0)
                                        <form action="{{ route('cart.add', $product->id) }}" method="post"
                                              onsubmit="this.querySelector('button').disabled = true;">
                                            @csrf
                                            <button type="submit" class="add-to-cart">افزودن به سبد</button>
                                        </form>
                                    @endif
                                    @enduser
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
</body>
</html>
