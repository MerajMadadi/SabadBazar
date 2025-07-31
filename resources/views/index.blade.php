@extends('layouts.app')
@section('content')
    <!--شروع محصولات-->
    @user
    {{--    قابلیت مشاهده برای همه جز فروشنده و مدیر--}}
    <section class="products rt-relative rt-overflow rt" style="margin-top: 10px;border-radius: 20px">
        <div class="main">
            @if ($errors->any())
                <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                    @foreach($errors->all() as $error)
                        <li style="text-align: center;margin-bottom: 40px;color: red;font-size: 16px" class="my-2">
                            <b><b>_</b> {{ $error }}</b></li>
                    @endforeach
                </ul>
            @endif
            <h3 style="margin-top: -25px" class="title-assign rt rt-bold rt-333 rt-relative rt-23 rt-align">فروش
                ویژه</h3>
            <div class="flexbox">
                <div class="entry rt">
                    <div class="product-grid">
                        @foreach($products as $product)
                            <div class="product-card" style="margin:15px">
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
    <!--پایان محصولات-->
    @seller
    {{--    یه باکس جهت مطالعه فروشندگان--}}
    <section style="height: 20cm;margin-top: 40px">
        <div class="main">
            <div style="margin-top: -40px" class="inside right rt-absolute">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default rt-shadow">
                            <div class="panel-heading rt-bg rt-fff rt-bold rt-18">
                                قوانین و توصیه‌های مهم برای فروشندگان
                            </div>
                            <div class="panel-body rt-14 rt-444" style="line-height: 2;">
                                <p>فروشندگان گرامی، لطفاً جهت حفظ نظم، اعتماد مشتریان و ارتقاء کیفیت خدمات، نکات زیر را
                                    با
                                    دقت مطالعه و رعایت فرمایید:</p>

                                <div id="rulesPreview" class="rules-collapse rt-13 rt-666"
                                     style="max-height: 180px; overflow: hidden; position: relative;">
                                    <ul style="list-style: square; padding-right: 20px;">
                                        <li><strong>شفافیت در قیمت‌گذاری و موجودی:</strong> قیمت کالاها باید واقعی، دقیق
                                            و
                                            به‌روز باشند.
                                        </li>
                                        <li><strong>توضیحات کامل:</strong> مشخصات فنی، ویژگی‌ها، ابعاد و کارکرد محصولات
                                            را
                                            شفاف بنویسید.
                                        </li>
                                        <li><strong>استفاده از تصاویر باکیفیت:</strong> از عکس‌های واضح و غیر
                                            گمراه‌کننده
                                            برای محصولات استفاده نمایید.
                                        </li>
                                        <li><strong>پاسخگویی مؤثر:</strong> به سوالات و پیام‌های کاربران با احترام و در
                                            کوتاه‌ترین زمان پاسخ دهید.
                                        </li>
                                        <li><strong>ارسال سریع و منظم:</strong> کالاها باید در زمان مشخص‌شده ارسال شده و
                                            کد
                                            رهگیری برای مشتری ارسال شود.
                                        </li>
                                        <li><strong>پشتیبانی پس از فروش:</strong> در صورت بروز مشکل، مسئولانه و محترمانه
                                            پاسخگو باشید.
                                        </li>
                                        <li><strong>پرهیز از کالاهای ممنوعه:</strong> از فروش محصولات غیرمجاز یا مغایر
                                            با
                                            قوانین کشور خودداری نمایید.
                                        </li>
                                        <li><strong>رضایت مشتری را در اولویت قرار دهید:</strong> مشتری راضی، سرمایه
                                            پایدار
                                            شماست.
                                        </li>
                                    </ul>

                                    <p class="rt-14 rt-666" style="margin-top: 20px;">
                                        هدف ما ایجاد بستری امن، منظم و سودمند برای تمامی کاربران است. با رعایت این اصول،
                                        تجربه‌ای حرفه‌ای برای خریداران و فروشندگان رقم خواهیم زد.
                                    </p>

                                    <blockquote class="rt-13 rt-italic rt-444"
                                                style="border-right: 3px solid #337ab7; padding-right: 15px; margin-top: 30px;">
                                        «با رعایت اصول حرفه‌ای، خرید و فروش آنلاین را به تجربه‌ای لذت‌بخش و قابل‌اعتماد
                                        تبدیل کنیم.»
                                    </blockquote>

                                    <div class="fade-gradient"
                                         style="position: absolute; bottom: 0; right: 0; left: 0; height: 50px; background: linear-gradient(to top, white, transparent);"></div>
                                </div>

                                <div class="text-center mt-3">
                                    <button id="toggleRules"
                                            class="btn btn-default rt-all rt-color rt-bold rt-15 rt-8px">
                                        مشاهده بیشتر
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const toggleBtn = document.getElementById('toggleRules');
                        const rulesBox = document.getElementById('rulesPreview');
                        let expanded = false;

                        toggleBtn.addEventListener('click', function () {
                            expanded = !expanded;
                            if (expanded) {
                                rulesBox.style.maxHeight = 'none';
                                rulesBox.querySelector('.fade-gradient').style.display = 'none';
                                toggleBtn.textContent = 'بستن';
                            } else {
                                rulesBox.style.maxHeight = '180px';
                                rulesBox.querySelector('.fade-gradient').style.display = 'block';
                                toggleBtn.textContent = 'مشاهده بیشتر';
                            }
                        });
                    });
                </script>
                <br><br>

            </div>
        </div>
    </section>
    @endseller
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
