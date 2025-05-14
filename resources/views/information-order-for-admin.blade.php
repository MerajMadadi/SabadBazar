@extends('layouts.admin')

@section('title', 'جزئیات سفارش')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <p><strong>تاریخ پرداخت:</strong> {{ $transaction->created_at_jalali }}</p>
            <p><strong>مبلغ کل:</strong> {{ toPersianNumber(number_format($transaction->amount)) }} تومان</p>
            <p><strong>شماره کارت:</strong> {{ toPersianNumber($transaction->card_number) }}</p>
            @php
                $cart = \App\Models\Cart::withTrashed()->where('id',$transaction->cart_id)->first();
            $cart_items = \App\Models\Cart_Item::withTrashed()->where('cart_id', $cart->id)->get();
            @endphp
            @if($cart && $cart_items->count())
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>محصول</th>
                        <th>قیمت واحد</th>
                        <th>تعداد</th>
                        <th>جمع</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart_items as $item)
                        <tr>
                            <td>
                                @if($item->product)
                                    <img src="{{ asset($item->product->image_url) }}" width="50"
                                         alt="{{Str::limit($item->product->name,26)}}">
                                @else
                                    <span class="text-muted">حذف شده</span>
                                @endif
                            </td>
                            <td>
                                @if($item->product)
                                    {{ $item->product->name }}
                                @else
                                    <em class="text-muted">محصول حذف شده</em>
                                @endif
                            </td>
                            @php
                                $price = $item->product ? ($item->product->price - ($item->product->price * $item->product->discount / 100)) : $item->price;
                            @endphp
                            <td>{{ toPersianNumber(number_format($price)) }} تومان</td>
                            <td>{{ toPersianNumber($item->quantity) }}</td>
                            <td>{{ toPersianNumber(number_format($price * $item->quantity)) }} تومان</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-danger">اطلاعات اقلام این سفارش موجود نیست.</p>
            @endif

            <a href="{{ route('admin.orders') }}" class="btn btn-default">بازگشت به لیست سفارش‌ها</a>
        </div>
    </div>
@endsection
