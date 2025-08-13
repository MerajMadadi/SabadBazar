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

<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- لوگو و دکمه موبایل -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar">
                    <span class="sr-only">نمایش منو</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img src="{{asset('img/logo.png')}}" style="max-height: 30px;margin-top: -5px" alt="لوگو">
                </a>
            </div>

            <!-- لینک‌های منو -->
            <div class="collapse navbar-collapse" id="main-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('admin.dashboard')}}">داشبورد</a></li>
                    <li><a href="/panel/users">کاربران</a></li>
                    <li><a href="{{route('admin.products')}}">محصولات</a></li>
                    <li><a href="{{route('admin.orders')}}">سفارشات</a></li>
                    <li>
                        <a href="/panel/tickets">
                            تیکت‌ها
                            @if(!empty($openTicketsCount) && $openTicketsCount > 0)
                                <span class="badge" style="background-color: red; color: white; font-size: 11px">
                {{ $openTicketsCount }}
              </span>
                            @endif
                        </a>
                    </li>
                    <li><a href="{{route('admin.delivery.centers')}}">مراکز تحویل</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ auth()->user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="role">نقش: {{ auth()->user()->roles()->first()?->name ?? 'ندارد' }}</li>
                            <li><a href="/profile" style="color: #00bfa5">مشاهده پروفایل</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link" style="color:red">خروج</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div id="org-admin-container" class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">@yield('title')</h3>
        </div>
        <div class="panel-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
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
