@extends('layouts.app')
@section('content')
    <!--شروع محصولات-->
    @user
    {{--    قابلیت مشاهده برای همه جز فروشنده و مدیر--}}
    <section class="products rt-relative rt-overflow rt" style="margin-top: 10px;border-radius: 20px">
        <div class="main">
            <h3 id="index-title" class="title-assign rt rt-bold rt-333 rt-relative rt-23 rt-align">فروش
                ویژه</h3>
            <div class="flexbox">
                <div class="entry rt">
                    <div class="product-grid">
                        @foreach($products as $product)
                            <div id="index-box-discount" class="product-card">
                                @if($product->discount > 0)
                                    <div class="discount-badge">{{ toPersianNumber($product->discount) }}٪ تخفیف</div>
                                @endif
                                @if($product->stock <= 0)
                                    <div class="out-of-stock">اتمام موجودی</div>
                                @endif
                                <figure>
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <img src="{{ asset($product->image_url) }}" alt="بدون عکس">
                                    </a>
                                </figure>

                                <div class="card-body">
                                    <div>
                                        <div class="title">{{Str::limit($product->name,26) }}</div>

                                        @if($product->discount > 0)
                                            <div class="old-price">{{ toPersianNumber(number_format($product->price)) }}
                                                تومان
                                            </div>
                                            <div class="price" style="color:#d9534f">
                                                {{ toPersianNumber(number_format($product->price - $product->price*$product->discount/100)) }}
                                                تومان
                                            </div>
                                        @else
                                            <div class="price">
                                                قیمت: {{ toPersianNumber(number_format($product->price)) }} تومان
                                            </div>
                                        @endif
                                        <div class="payment-method">
                                            <i class="fa fa-shopping-bag"></i> پرداخت در فروشگاه
                                        </div>
                                        <div class="rating">★
                                            {{ toPersianNumber(round($product->comments()->avg('rate') ?? 0,1)) }}</div>
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
            </div>
        </div>
    </section>
    @enduser
    @seller
        <section class="seller-dashboard rt-rt-relative rt-rt-overflow"
                 style="margin: 20px 0; border-radius: 20px; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); box-shadow: 0 8px 20px rgba(0,0,0,0.15); padding: 25px 20px; transition: box-shadow 0.3s ease;">
            <div class="seller-dashboard__container main rt-flex rt-flex-wrap rt-justify-between">
                <div class="seller-dashboard__item rt-flex-1 rt-min-w-200px rt-mb-15px">
                    <h4 class="seller-dashboard__title rt-rt-bold rt-333">فروش کل</h4>
                    <p class="seller-dashboard__value rt-rt-26 rt-rt-bold rt-color-primary">{{ toPersianNumber(number_format($total ?? 0)) }}
                        تومان</p>
                </div>
                <div style="margin-top: 10px" class="seller-dashboard__item rt-flex-1 rt-min-w-200px rt-mb-15px">
                    <h4 class="seller-dashboard__title rt-rt-bold rt-333">تعداد محصولات فعال</h4>
                    <p class="seller-dashboard__value rt-rt-26 rt-rt-bold rt-color-primary">{{ toPersianNumber($products_count ?? 0) }}</p>
                </div>
            </div>
        </section>

        <style>
            /* استایل زیبا برای پنل فروشنده */
            .seller-dashboard {
                border: 1px solid #d1d9e6;
                border-radius: 20px;
            }

            .seller-dashboard:hover {
                box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
            }

            .seller-dashboard__container > div {
                background: #fff;
                border-radius: 16px;
                padding: 20px 25px;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
                text-align: center;
                cursor: default;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .seller-dashboard__container > div:hover {
                transform: translateY(-5px);
                box-shadow: 0 14px 24px rgba(33, 150, 243, 0.3);
                background: #e3f2fd;
            }

            .seller-dashboard__title {
                margin-bottom: 10px;
                font-size: 1.1rem;
                color: #333;
            }

            .seller-dashboard__value {
                font-size: 1.8rem;
                color: #1976d2;
                font-weight: 700;
                user-select: text;
            }

            /* ریسپانسیو */
            @media (max-width: 768px) {
                .seller-dashboard__container {
                    flex-direction: column;
                }

                .seller-dashboard__item {
                    min-width: 100% !important;
                    margin-bottom: 15px;
                }
            }
        </style>
    @endseller



    <!--پایان محصولات-->
    {{--    نمایش مراکز تحویل --}}
    <section class="sellers rt rt-relative rt-overflow">
        <div class="main">
            <h3 class="title-assign rt rt-bold rt-333 rt-relative rt-23 rt-align">مراکز تحویل کالاها</h3>
            <div class="entry rt">
                @foreach($centers as $center)
                    <article class="mini-s right rt-10px rt-shadow rt-relative rt-overflow">
                        <img data-src="{{asset($center->image_url)}}" alt="بدون عکس" src="{{asset('img/lazy.gif')}}"
                             class="pic rt owl-lazy">
                        <div class="inside rt-fff rt rt-10px rt-absolute">
                            <h2 class="name rt rt-15 rt-medium">{{toPersianNumber($center->name)}}</h2>
                            <span class="info rt rt-13 rt-op"><i class="fa fa-phone"></i>{{toPersianNumber($center->phone)}}</span>
                            <span class="info rt rt-13 rt-op"><i
                                    class="fa fa-map"></i>{{toPersianNumber($center->address)}}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
