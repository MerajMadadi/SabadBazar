@extends('layouts.app')
@section('title', $product->name)

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            {{-- بخش تصویر محصول --}}
            <div class="col-md-6 text-center">
                <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}"
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
                <div style="height: 50%;font-size: 14px" class="alert alert-info"><b>مشخصات :</b> {{$product->unit}}
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

                <hr>

                {{-- فرم افزودن به سبد خرید (فقط برای کاربران وارد شده) --}}
                @user
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST"
                          style="width: 40%"
                          onsubmit="this.querySelector('button').disabled = true;">
                        @csrf
                        <button style="background: #69982D; color: white" class="btn btn-lg btn-block">
                            افزودن به سبد
                        </button>
                    </form>
                @else
                    <button style="background: #c82333; color: white" class="btn btn-lg btn-block">
                        عدم موجودی
                    </button>
                @endif
                {{-- فرم ثبت نظر --}}
                <script>
                    function toggleCommentForm() {
                        document.querySelector('.comment-form').style.display = 'block';
                    }
                </script>
                <div class="comment-section" style="margin-top: 20px;">
                    @if ($errors->any())
                        <ul class="px-4 py-2 bg-red-100 text-red-600 rounded">
                            @foreach($errors->all() as $error)
                                <li style="color: red;font-size: 16px" class="my-2"><b>_</b> {{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <button
                        style="padding: 15px 0; font-size: 1.55rem; color: white; background: darkorange; width: 25%; border: none"
                        onclick="toggleCommentForm()" class="btn btn-lg btn-block">
                        <i class="fa fa-comment"></i> ثبت نظر
                    </button>

                    <form action="{{ route('comment.store', $product->id) }}" method="POST" class="comment-form"
                          style="display: none;" onsubmit="this.querySelector('button').disabled = true;">
                        @csrf
                        <textarea name="comment" placeholder="نظر خود را وارد کنید..." required></textarea>

                        <button style="background: #69982D" type="submit">ارسال نظر</button>

                        <div class="rating">
                            @for($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}">
                                <label for="star{{ $i }}">★</label>
                            @endfor
                        </div>
                    </form>
                </div>
                @enduser

                {{-- بخش نظرات کاربران --}}
                <div style="margin-bottom: 2cm" class="custom-comments-section">
                    @if($product->comments && $product->comments->count())
                        <h3 class="custom-comments-title">نظرات کاربران</h3>
                        <h5>{{ $product->comments->count() }} نظر</h5>

                        <div class="custom-comments-list">
                            @foreach($product->comments->take(3) as $comment)
                                <div id="comments" class="custom-comment-card">
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
