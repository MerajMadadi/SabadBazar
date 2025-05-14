@extends('layouts.app')

@section('title', 'سبد خرید شما')

@section('content')
    <div style="margin-top: 60px" class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">سبد خرید شما</h3>
        </div><br>
        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100 text-red-600 rounded" style="margin-right: 5px">
                @foreach($errors->all() as $error)
                    <li style="color: red;font-size: 16px" class="my-2">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="panel-body">
            @if(count($cart_items) > 0)
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>نام محصول</th>
                        <th>تعداد</th>
                        <th>قیمت واحد</th>
                        <th>مجموع</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart_items as $item)
                        <tr>
                            <td><a href="{{route('product.show', $item->product->id)}}"><img src="{{ asset($item->product->image_url) }}" alt="بدون تصویر" width="50"></a></td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ toPersianNumber($item->quantity) }}
                                <form action="{{route('cart.add',$item->product->id)}}" method="post"
                                      onsubmit="this.querySelector('button').disabled = true;">
                                    @csrf
                                    <button class="btn btn-default btn-block">+
                                    </button>
                                </form>
                            </td>
                                @php
                                    $finalPrice = $item->product->price - ($item->product->price * $item->product->discount / 100);
                                @endphp
                                <td>{{ toPersianNumber(number_format($finalPrice)) }} تومان</td>
                                <td>{{ toPersianNumber(number_format($finalPrice * $item->quantity)) }} تومان</td>
                            <td>
                                <form action="{{ route('cart.delete', $item->id) }}" method="POST"
                                      onsubmit="this.querySelector('button').disabled = true;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @php
                        $total = 0;
                        foreach($cart_items as $item) {
                            $unitPrice = $item->product->price - ($item->product->price * $item->product->discount / 100);
                            $total += $unitPrice * $item->quantity;
                        }
                    @endphp

                    <tr>
                        <td colspan="4" class="text-right"><strong>مبلغ کل:</strong></td>
                        <td colspan="2"><strong>{{ toPersianNumber(number_format($total)) }} تومان</strong></td>
                    </tr>
                    </tbody>
                </table>
                <a href="{{ route('payment.form') }}" class="btn btn-success">ادامه فرآیند خرید</a>
            @else
                <p class="text-center">سبد خرید شما خالی است.</p>
            @endif
        </div>
    </div>
@endsection
