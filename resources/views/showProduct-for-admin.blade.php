@extends('layouts.admin')
@section('title', $product->name)

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            {{-- بخش تصویر محصول --}}
            <div class="col-md-6 text-center">
                <img src="{{ asset($product->image_url) }}" alt="بدون عکس"
                     style="margin-bottom: 20px;max-width: 100%; max-height: 400px; object-fit: contain; border: 1px solid #ddd; padding: 10px; background: #fff;">
            </div>
            {{-- بخش اطلاعات محصول --}}
            <div class="col-md-6">
                <h1 style="font-weight: bold;color: #4b8106; font-size: 2.9rem; margin-bottom: 20px;">{{ $product->category->name }}</h1>
                <hr>
                <h1 style="font-weight: bold; font-size: 2.9rem; margin-bottom: 20px;">{{ $product->name }}</h1>

                <p style="font-size: 1.9rem; line-height: 1.6; color: #555;">
                    {{ $product->description }}
                </p>
                <div style="height: 50%;font-size: 14px" class="alert alert-info"><b>مشخصات :</b>{{$product->unit}}
                </div>

                @if($product->discount > 0)
                    @php
                        $finalPrice = $product->discount > 0
                         ? $product->price - ($product->price * $product->discount / 100)
                          : $product->price; @endphp
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

                <span class="custom-comment-rate" style="font-size: 16px">
                    ★{{ round($averageRating, 1) }}
                </span><br>
                @if(!empty($product->deleted_at))
                <a href="{{ route('admin.product.restore',$product->id) }}" class="btn btn-primary">بازگردانی</a><br>
                @endif
                <div style="height: 50%;font-size: 14px;margin-top: 10px" class="alert alert-info">
                    <lable><b>اطلاعات فروشنده این محصول :</b></lable><br><br>
                    نام :
                    {{$product->user->name}}<br>
                    ایمیل :
                    {{$product->user->email}}<br>
                    شماره مجوز :
                    {{$product->user->license_number}}<br>
                    نام فروشگاه :
                    {{$product->user->store_name}}<br>
                    شماره تماس فروشگاه :
                    {{$product->user->store_phone}}<br>
                    آدرس فروشگاه :
                    {{$product->user->store_address}}
                </div>

                <hr>

                {{-- بخش نظرات کاربران --}}
                <div style="margin-bottom: 2cm" class="custom-comments-section">
                    @if($product->comments && $product->comments->count())
                        <h3 class="custom-comments-title">نظرات کاربران</h3>
                        <h5>{{ $product->comments->count() }} نظر</h5>

                        <div class="custom-comments-list">
                            @foreach($product->comments->take(3) as $comment)
                                <div class="custom-comment-card"
                                     style="position: relative; padding-bottom: 30px;"> {{-- جا برای دکمه حذف --}}
                                    <div class="custom-comment-header">
                                        <span
                                            class="custom-comment-user">{{ $comment->user->name ?? 'کاربر مهمان' }}</span>
                                        <span class="custom-comment-rate">
                                                @for($i = 1; $i <= 5; $i++)
                                                {{ $i <= $comment->rate ? '★' : '☆' }}
                                            @endfor
                                        </span>
                                    </div>

                                    <div class="custom-comment-content">{{ $comment->content }}</div>
                                    <div class="custom-comment-date">{{ $comment->created_at_jalali }}</div>


                                    <form action="{{ route('admin.comment.delete', $comment->id) }}" method="POST"
                                          style="position: absolute; bottom: 5px; left: 5px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="حذف"
                                                onclick="return confirm('آیا از حذف این دیدگاه مطمئن هستید؟')"
                                                style="background: none; border: none; color: #d9534f;
                                       font-size: 18px; cursor: pointer;">
                                            🗑
                                        </button>
                                    </form>

                                </div>
                            @endforeach
                        </div>


                        {{-- دکمه مشاهده بیشتر --}}
                        @if($product->comments->count() > 3)
                            <div class="custom-comments-more" style="margin-bottom: 30px;">
                                <button style="margin-top: 20px"
                                        onclick="document.getElementById('more-comments').style.display='block'; this.style.display='none';"
                                        class="custom-comments-more-btn">
                                    مشاهده بیشتر
                                </button>

                                <div id="more-comments" style="display: none;">
                                    @foreach($product->comments->skip(3) as $comment)
                                        <div class="custom-comment-card">
                                            <div class="custom-comment-header">
                                                <span
                                                    class="custom-comment-user">{{ $comment->user->name ?? 'کاربر مهمان' }}</span>
                                                <span class="custom-comment-rate">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        {{ $i <= $comment->rate ? '★' : '☆' }}
                                                    @endfor
                                                </span>
                                            </div>
                                            <div class="custom-comment-content">{{ $comment->content }}</div>
                                            <div class="custom-comment-date">{{ $comment->created_at_jalali }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div> {{-- پایان col-md-6 اطلاعات --}}
        </div> {{-- پایان row --}}
    </div> {{-- پایان container --}}
@endsection
