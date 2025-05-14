<!doctype html>
<html>
<head>
    <title>@yield('title','پنل مدیریت')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/default.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<header class="header">
    <div class="main rt-relative">
        <div class="entery rt rt-absolute rt-10px rt-bg">
            <div class="main">
                <a href="/"><img src="{{asset('img/logo.png')}}" class="logo right"></a>
                <ul class="menu rt-align rt-15 right">
                    <li><a href="{{route('admin.dashboard')}}">داشبورد</a></li>
                    <li><a href="/panel/users">کاربران</a></li>
                    <li><a href="{{route('admin.products')}}">محصولات</a></li>
                    <li><a href="{{route('admin.orders')}}">سفارشات</a></li>
                    <li><a href="/panel/tickets">تیکت‌ها</a></li>
                    <li><a href="{{route('admin.delivery.centers')}}">مراکز تحویل</a></li>
                    <li class="profile-dropdown-parent">
                        <a href="" class="profile-link">
                            {{ auth()->user()->name }}
                            <i class="fa fa-user"></i>
                        </a>
                        <ul class="profile-dropdown">
                            <li class="role">نقش: {{ auth()->user()->roles()->first()?->name ?? 'ندارد' }}</li>
                            <li><a href="/profile" style="color: #00bfa5" class="dropdown-item"> مشاهده<b>
                                        پروفایل </b> </a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}"
                                      onsubmit="this.querySelector('button').disabled = true;">
                                    @csrf
                                    <button type="submit" class="btn-logout">خروج</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</header>

<div style="margin-top: 80px;" class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">@yield('title')</h3>
        </div>
        <div class="panel-body">
            @yield('content')
        </div>
    </div>
</div>

<footer class="footer">
    <div class="main">
        <a href="/"><img src="{{asset('img/logo.png')}}" class="logo right" alt="لوگو سایت"></a>
        <div class="about right">
            <span class="titr rt rt-bold rt-rang rt-18">سبد بازار</span>
            <span class="desc rt rt-13 rt-666">پنل مدیریت سایت</span>
        </div>
    </div>
</footer>

<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('js/java.js')}}"></script>
</body>
</html>
