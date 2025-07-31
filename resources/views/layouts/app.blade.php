<!doctype html>
<html>
<head>
    <title>@yield('title','Bazaar')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/default.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
    <!--شروع هدر-->
<header class="header">
    <div class="main rt-relative">
        <div class="top rt">
            <span class="notic right rt-fff rt-13 rt-relative"><div class="icon rt-50px rt-relative right">
                </div> تمامی وضعیت موجودی ها و قیمت ها بروز هستند</span>
            <span class="tamas rt-fff rt-13 left"><i class="fa fa-clock left rt-15"></i> زمان تحویل امروز از ساعت ۱۵:۰۰</span>
        </div>
        <div class="entery rt rt-absolute rt-10px rt-bg">
            <div class="main">
                <div class="menu-btn close-bg rt"></div>
                <span class="menu-btn right rt-pointer rt-18 rt-444"><i class="fa fa-bars right"></i></span>
                <a href="/"><img src="{{asset('img/logo.png')}}" class="logo right"></a>
                <ul class="menu rt-align rt-15 right">
                    <li><a href="/">صفحه نخست</a></li>
                    @seller
                    <li><a href="/my-products">محصولات من</a></li>
                    <li><a href="/product-create">ثبت محصول</a></li>
                    @endseller
                    @user
                    <li>
                        <a href="">دسته بندی ها<i class="fa fa-angle-down"></i></a>
                        <i class="fa fa-angle-down left rt-18"></i>
                        <ul class="rt-absolute rt-bg rt-shadow rt-14 rt-10px">
                            @php
                                $categories = App\Models\Category::take(3)->get();
                            @endphp
                            @foreach($categories as $category)
                                <li class="rt"><a
                                        href="{{ route('category.index', 'id') }}#category-{{ $category->id }}"
                                        class="rt rt-444">{{ $category->name }}</a></li>
                            @endforeach
                                <li class="rt"><a
                                        href="{{ route('products.index') }}"
                                        class="rt rt-444"><i style='font-size:14px' class='fas'>&#xf245;</i>
                                        <b>مشاهده بیشتر</b></a></li>
                        </ul>
                    </li>
                    @enduser
                    @customer
                    <li><a href=""><i class="fa fa-angle-down"></i>پشتیبانی</a>
                        <i class="fa fa-angle-down left rt-18"></i>
                        <ul class="rt-absolute rt-bg rt-shadow rt-14 rt-10px">
                            <li class="rt"><a
                                    href="/ticket"
                                    class="rt rt-444">ثبت تیکت</a></li>
                            <li class="rt"><a
                                    href="/my-tickets"
                                    class="rt rt-444">تیکت های من</a></li>

                        </ul>
                    </li>
                    <li style="margin-right: 6px;">
                        <a href="/cart" class="cart-link">
                            سبد خرید
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </li>
                    @endcustomer
                    @auth
                        <li class="profile-dropdown-parent">
                            <a href="" class="profile-link">
                                {{ auth()->user()->name }}
                                <i class="fa fa-user"></i>
                            </a>
                            <ul class="profile-dropdown">
                                <li class="role">نقش: {{ auth()->user()->roles()->first()?->name ?? 'ندارد' }}</li>
                                <li><a href="{{route('show.profile')}}" style="color: #00bfa5" class="dropdown-item"> مشاهده<b>
                                            پروفایل </b> </a></li>
                                <li><a href="{{route('customer.orders')}}" style="color: #00bfa5" class="dropdown-item">لیست
                                        <b>سفارشات</b> </a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}"
                                          onsubmit="this.querySelector('button').disabled = true;">
                                        @csrf
                                        <button type="submit" class="btn-logout">خروج</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li><a href="/login" class="btn-login">ورود / ثبت نام</a></li>
                    @endguest
                </ul>
                <form method="GET" action="{{route('search')}}" class="search rt-8px rt-overflow left">
                    <input type="text" name="search" placeholder="نام محصول مورد نظر رو وارد کنید" class="right input rt-444 rt-13">
                    <button class="sub left rt-pointer rt-16 rt-color rt-666 rt-center"><i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
<!--پایان هدر-->
<div style="margin-top: 50px" class="container">
    @yield('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
</div>
{{--footer--}}
<!--شروع فوتر-->
<footer class="footer">
    <div class="main">
        <a href="/"><img src="{{asset('img/logo.png')}}" class="logo right"></a>
        <div class="about right">
            <span class="titr rt rt-bold rt-rang rt-18">سبد بازار</span>
            <span class="desc rt rt-13 rt-666">ثبت نام کالاهای اساسی تنظیم بازار</span>
            <a href="#" class="soc rt-bg rt-50px rt-center rt-18 rt-666 rt-shadow"><i
                    class="fa fa-instagram rt-400"></i></a>
            <a href="#" class="soc rt-bg rt-50px rt-center rt-18 rt-666 rt-shadow"><i class="fa fa-twitter rt-400"></i></a>
            <a href="#" class="soc rt-bg rt-50px rt-center rt-18 rt-666 rt-shadow"><i
                    class="fa fa-facebook-f rt-400"></i></a>
            <a href="#" class="soc rt-bg rt-50px rt-center rt-18 rt-666 rt-shadow"><i
                    class="fa fa-google rt-400"></i></a>
        </div>
        <ul class="menu right rt-13">
            <li class="right"><a href="/" class="rt-333 rt">صفحه نخست</a></li>
            <li class="right"><a href="/#" class="rt-333 rt">ثبت سفارش</a></li>
            <li class="right"><a href="/#" class="rt-333 rt">سوالات متداول</a></li>
            <li class="right"><a href="#" class="rt-333 rt">نمونه برگه</a></li>
            <li class="right"><a href="/about-us" class="rt-333 rt">درباره ما</a></li>
            <li class="right"><a href="/ticket" class="rt-333 rt">پشتیبانی</a></li>
        </ul>
        <div class="namads left">
            <a href="/"><img src="{{asset('img/n1.png')}}"></a>
            <a href="/"><img src="{{asset('img/n2.png')}}"></a>
        </div>
    </div>
</footer>
<!--پایان فوتر-->

<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('js/java.js')}}"></script>


{{--<!-- Mirrored from bwp.ir/sabadbazar/order by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Aug 2023 07:23:30 GMT -->--}}
</body>
</html>
