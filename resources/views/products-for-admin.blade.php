@extends('layouts.admin')

@section('title', 'مدیریت محصولات و دسته‌بندی‌ها')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><b>محصولات</b></h3>
        </div>
        <div class="panel-body">
            @if($products->count())
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        {{--                        <th>تصویر</th>--}}
                        <th>نام محصول</th>
                        <th>دسته‌بندی</th>
                        <th>قیمت</th>
                        <th>تخفیف</th>
                        <th>موجودی</th>
                        <th>فروشنده</th>
                        <th>تاریخ ثبت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr id="product-{{$product->id}}">
                            {{--                            <td><img src="{{ asset($product->image_url) }}" width="60" alt="{{$product->name}}"></td>--}}
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>
                                {{ toPersianNumber(number_format($product->price - ($product->price * $product->discount/100))) }}
                                تومان
                            </td>
                            <td>
                                @if($product->discount)
                                    <span class="label label-danger" style="font-size: 10px; margin-right: 5px;">
                                           {{ toPersianNumber($product->discount) }}٪ تخفیف
                                </span>
                                @endif
                            </td>
                            <td>{{toPersianNumber($product->stock)}}</td>
                            <td>{{Str::limit($product->user->email,23)}}</td>
                            <td>{{ $product->created_at_jalali }}</td>
                            <td>
                                <a href="{{ route('admin.product.show', $product->id) }}"
                                   class="btn btn-xs btn-info">مشاهده</a>
                                @if (!empty($product->deleted_at))
                                    {{'حذف شده'}}
                                @else
                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                       class="btn btn-xs btn-primary">ویرایش</a>
                                    <form action="{{ route('admin.product.delete', $product->id) }}" method="POST"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('حذف شود؟')" class="btn btn-xs btn-danger">حذف
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $products->links() }}
                </div>
            @else
                <p>محصولی وجود ندارد.</p>
            @endif
        </div>
    </div>

    <div class="panel panel-default" style="margin-top: 30px;" id="categories">
        <div class="panel-heading">
            <h3 class="panel-title"><b>دسته‌بندی‌ها</b></h3>
        </div>
        <div class="panel-body">
            @if($categories->count())
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li id="id-{{$category->id}}" class="list-group-item">
                            <strong>{{ $category->name }}</strong>
                            <div class="pull-left">
                                <!-- دکمه ویرایش -->
                                <button class="btn btn-xs btn-info" data-toggle="collapse"
                                        data-target="#edit-category-{{ $category->id }}">
                                    ویرایش
                                </button>
                                <!-- دکمه حذف -->
                                <form action="{{ route('admin.category.delete', $category->id) }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('حذف شود؟')" class="btn btn-xs btn-danger">حذف
                                    </button>
                                </form>
                            </div>

                            <!-- فرم ویرایش (Collapse) -->
                            <div id="edit-category-{{ $category->id }}" class="collapse" style="margin-top: 10px;">
                                <form action="{{ route('admin.category.update', $category->id) }}" method="POST"
                                      class="form-inline">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input type="text" name="name" value="{{ $category->name }}"
                                               class="form-control input-sm" placeholder="نام دسته‌بندی">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">ذخیره</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>دسته‌بندی‌ای وجود ندارد.</p>
            @endif

            <!-- دکمه افزودن دسته‌بندی جدید -->
            <button class="btn btn-success" style="margin-top: 15px;" data-toggle="collapse"
                    data-target="#add-category">
                افزودن دسته‌بندی جدید
            </button>

            <!-- فرم افزودن جدید (Collapse) -->
            <div id="add-category" class="collapse" style="margin-top: 10px;">
                <form action="{{ route('admin.category.store') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control input-sm" placeholder="نام دسته‌بندی">
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">ثبت</button>
                </form>
            </div>
        </div>
    </div>
@endsection
