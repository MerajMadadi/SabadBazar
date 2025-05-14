@extends('layouts.admin')

@section('title', 'داشبورد مدیریت')

@section('content')
    <div class="row">
        <!-- باکس تعداد محصولات -->
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">تعداد محصولات</h3>
                </div>
                <div class="panel-body text-center">
                    <h2><strong>{{ toPersianNumber($productsCount) }}</strong></h2>
                    <a href="{{ route('admin.products') }}" class="btn btn-xs btn-default">مدیریت محصولات</a>
                </div>
            </div>
        </div>

        <!-- باکس تعداد دسته‌بندی‌ها -->
        <div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">تعداد دسته‌بندی‌ها</h3>
                </div>
                <div class="panel-body text-center">
                    <h2><strong>{{ toPersianNumber($categoriesCount) }}</strong></h2>
                    <a href="{{ route('admin.products') }}#categories" class="btn btn-xs btn-default">مدیریت
                        دسته‌بندی‌ها</a>
                </div>
            </div>
        </div>

        <!-- باکس تعداد کاربران -->
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">تعداد کاربران</h3>
                </div>
                <div class="panel-body text-center">
                    <h2><strong>{{ toPersianNumber($usersCount) }}</strong></h2>
                    <a href="/panel/users" class="btn btn-xs btn-default">مشاهده کاربران</a>
                </div>
            </div>
        </div>

        <!-- باکس فروش‌ها -->
        <div class="col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">کل فروش</h3>
                </div>
                <div class="panel-body text-center">
                    <h2><strong>{{ toPersianNumber(number_format($totalSales)) }}</strong> تومان</h2>
                    <a href="{{ route('admin.orders') }}" class="btn btn-xs btn-default">مدیریت
                        سفارشات</a>
                </div>
            </div>
        </div>
    </div>

    <!-- بخش گزارش یا آخرین سفارشات -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">آخرین سفارشات ثبت شده</h3>
        </div>
        <div class="panel-body">
            @if($latestOrders->count())
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>کاربر</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($latestOrders as $order)
                        <tr>
                            <td>{{ toPersianNumber($loop->iteration) }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ toPersianNumber(number_format($order->amount)) }} تومان</td>
                            <td>{{ $order->created_at_jalali }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>سفارشی وجود ندارد.</p>
            @endif
        </div>
    </div>
@endsection
