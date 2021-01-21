<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    @yield('css')
</head>

<body class="d-flex">
    <?php use App\User; ?>
    <?php use Illuminate\Support\Str; ?>
    <nav>
        <div class="sideNav">
            <div class="logo m-a">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </div>
            <a href="/admin/talk/index" style="text-decoration: none;color:black">
                <div class="main-btn m-a down-btn">TimeEmpire</div>
            </a>
            {{-- <div class="main-btn m-a" style="text-decoration: none;color:black">TimeEmpire</div> --}}
            <div class="btn-group d-flex m-a">
                <a class="btnb" href="/admin/profile" style="text-decoration: none;color:black">個人<br>頁面</a>
                <a class="btnb" href="/admin/project" style="text-decoration: none;color:black">專案<br>管理</a>
            </div>
            <div class="btn-group d-flex m-a">
                <a class="btnb" href="/admin/pointLog/{{auth()->user()->id}}"
                    style="text-decoration: none;color:black">點數<br>歷程</a>
                <a class="btnb" href="/admin/to_do_list/{{auth()->user()->id}}"
                    style="text-decoration: none;color:black">工作<br>日誌</a>
            </div>

            @if(App\User::find(auth()->user()->id)->authority == 1)
            <a href="/admin/user/" style="text-decoration: none;color:black">
                <div class="main-btn m-a down-btn"> 人員管理
                </div>
            </a>


            @endif
            <div class="notice-window m-a d-flex">
                <div class="notice-part d-flex">
                    <img src="{{ asset('img/head.png') }}" width="140px">


                    @auth
                    <div class="notice">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/project">
                                    {{-- 老闆小人 --}}
                                    @if(User::find(auth()->user()->id)->authority == 1)
                                    {{User::find(auth()->user()->id)->name}}，你好<br>
                                    祝你有美好的一天
                                    {{-- 主管小人 --}}
                                    @elseif(User::find(auth()->user()->id)->authority == 2)
                                    {{User::find(auth()->user()->id)->name}}，你好<br>
                                    <?php $point = User::find(auth()->user()->id)->point ?>
                                    您目前有 {{$point}} 點任務點數
                                    {{-- 員工小人 --}}
                                    @elseif(User::find(auth()->user()->id)->authority == 3)
                                    <?php $point = User::find(auth()->user()->id)->point ?>
                                    {{User::find(auth()->user()->id)->name}}，你好<br>
                                    您目前有 {{$point}} 點任務點數
                                    @else
                                    請登入
                                    @endif
                                </a>
                            </li>
                        </ul>

                    </div>
                    @endauth
                </div>
                <div class="logout-btn m-a">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('登出') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </div>


        </div>
    </nav>


    <main class="py-4">
        <div class="container ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else

                    <li class="nav-item dropdown">





                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
        @yield('content')
        @yield('main')
    </main>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>

</html>
