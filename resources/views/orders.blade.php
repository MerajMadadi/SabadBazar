@extends('layouts.app')

@section('title', 'سفارشات من')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> سفارشات من </h3>
        </div>
        <div class="panel-body">
            @if($orders->count())
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>کد تراکنش</th>
                        <th>مبلغ</th>
                        <th>شماره کارت</th>
                        <th>تاریخ پرداخت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ toPersianNumber($order->id) }}</td>
                            <td>{{ $order->transaction_code }}</td>
                            <td>{{ toPersianNumber(number_format($order->amount)) }} تومان</td>
                            <td>{{ toPersianNumber($order->card_number) }}</td>
                            <td>{{ $order->created_at_jalali }}</td>
                            <td>
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-xs">
                                    مشاهده جزئیات
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    هیچ سفارشی برای این مشتری ثبت نشده است.
                </div>
            @endif
        </div>
    </div>
@endsection
