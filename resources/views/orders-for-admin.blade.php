@extends('layouts.admin')
@section('title','لیست سفارشات')
@section('content')
    <div class="panel-body">
        @if($orders->count())
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>کاربر</th>
                    <th>مبلغ</th>
                    <th>تاریخ</th>
                    <th>جزئیات سفارش</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ toPersianNumber($loop->iteration) }}</td>
                        <td>{{ $order->user->email }}</td>
                        <td>{{ toPersianNumber(number_format($order->amount)) }} تومان</td>
                        <td>{{ $order->created_at_jalali }}</td>
                        <td>
                            <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-primary btn-xs">
                                مشاهده جزئیات
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>سفارشی وجود ندارد.</p>
        @endif
    </div>
@endsection
