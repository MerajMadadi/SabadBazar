@extends('layouts.app')

@section('content')
    <div class="container py-4" style="margin-top: 30px">
        {{-- بررسی وجود نتایج --}}
        <div class="card-body">
            @if($products->count() > 0)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                    @foreach($products as $product)
                        @if($product->stock <= 0)
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <div class="thumbnail" style="border:1px solid #ddd; padding:10px;">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}"
                                             style="height: 150px; width: 100%; object-fit: contain;">
                                    </a>
                                    <div class="caption" style="text-align: right;">
                                        <h4>{{ \Illuminate\Support\Str::limit($product->name,13) }}</h4>

                                        @php
                                            $comments = \App\Models\Comment::where('product_id', $product->id)->get();
                                            $averageRating = $comments->avg('rate') ?? 0;
                                        @endphp

                                        <span class="custom-comment-rate" style="font-size: 15px;">
                                      ★{{ round($averageRating,1) }}
                                        </span><br>

                                        <span style="color: #374151;">
                                        {{ $product->user->store_name ?? "" }}
                                        </span>
                                        <hr>

                                        <p style="color:#d9534f; font-weight:bold;">
                                            {{ number_format($product->price) }} تومان
                                        </p>

                                        @user
                                        @if($product->stock > 0)
                                            <form action="{{ route('cart.add', $product->id) }}" method="post"
                                                  onsubmit="this.querySelector('button').disabled = true;">
                                                @csrf
                                                <button style="background: #69982D" class="btn btn-logout btn-block">
                                                    افزودن به سبد
                                                </button>
                                            </form>
                                        @else
                                            <div style="color: #d9534f; font-weight: bold; text-align: center;">
                                                ناموجود
                                            </div>
                                        @endif
                                        @enduser
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <div class="thumbnail" style="border:1px solid #ddd; padding:10px; position: relative;">
                                    @if($product->discount > 0)
                                        <div style="
                                      position: absolute;
                                      top: 10px;
                                      right: 10px;
                                      background: #d9534f;
                                      color: white;
                                      padding: 5px 8px;
                                      font-size: 12px;
                                      border-radius: 3px;
                                      z-index: 2;">
                                            {{ $product->discount }}٪ تخفیف
                                        </div>
                                    @endif
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}"
                                             style="height: 150px; width: 100%; object-fit: contain;">
                                    </a>
                                    <div class="caption" style="text-align: right;">
                                        <h4>{{\Illuminate\Support\Str::limit($product->name,13) }}</h4>
                                        @php
                                            $comments = \App\Models\Comment::where('product_id', $product->id)->get();
                                            $averageRating = $comments->avg('rate') ?? 0;

                                            $finalPrice = $product->discount > 0
                                                ? $product->price - ($product->price * $product->discount / 100)
                                                : $product->price;
                                        @endphp
                                        <span class="custom-comment-rate" style="font-size: 15px">
                                          ★{{ round($averageRating,1) }}
                                        </span><br>
                                        <span style="color: #374151">{{ $product->user->store_name }}</span>
                                        <hr>
                                        @if($product->discount > 0)
                                            <p style="margin:0; font-size:14px;">
                                                <del style="color: #999;">{{ number_format($product->price) }}تومان
                                                </del>
                                            </p>
                                            <p style="color:#d9534f; font-weight:bold;">
                                                {{ number_format($finalPrice) }} تومان
                                            </p>
                                        @else
                                            <p style="color:#d9534f; font-weight:bold;">
                                                {{ number_format($product->price) }} تومان
                                            </p>
                                        @endif

                                        @user
                                        <form action="{{ route('cart.add', $product->id) }}" method="post"
                                              onsubmit="this.querySelector('button').disabled = true;">
                                            @csrf
                                            <button style="background: #69982D" class="btn btn-logout btn-block">
                                                افزودن به سبد
                                            </button>
                                        </form>
                                        @enduser
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
                {{-- صفحه‌بندی --}}
        </div>
    </div>

    {{-- صفحه‌بندی با حفظ جستجو --}}
    <div class="mt-4">
        {{ $products->appends(['search' => request('search')])->links() }}
    </div>

    @else
        <div class="alert alert-warning">
            هیچ محصولی با این مشخصات یافت نشد.
        </div>
    @endif
@endsection
