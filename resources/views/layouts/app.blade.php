<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    @if(session('success'))
        <div class="alert alert-success fw-bold text-center mb-0">
            {{ session('success') }}
        </div>
    @endif

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                     Cửa Hàng Đồ Nhựa
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="/"> Trang Chủ</a>
                        </li>

                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link text-primary fw-bold" href="/admin/products"> Quản Lý Kho Đồ Nhựa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-primary fw-bold" href="/admin/orders"> Quản Lý Đơn Hàng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-primary fw-bold" href="/admin/users"> Quản Lý Tài Khoản</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-primary fw-bold" href="/admin/categories">Quản Lý Danh Mục</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-success fw-bold" href="/cart"> Giỏ Hàng <span class="badge bg-danger rounded-pill">{{ session('cart') ? count(session('cart')) : 0 }}</span></a>
                            </li>
                        @endif
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item fw-bold text-primary" href="/profile">
                                         Thông tin của tôi
                                    </a>
                                    
                                    <hr class="dropdown-divider">

                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                         {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>