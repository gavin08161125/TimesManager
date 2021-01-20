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
    <style>
        @font-face {
            font-family: 'HunInn';
            src: url("https://cdn.jsdelivr.net/gh/marsnow/open-huninn-font@1.1/font/jf-openhuninn.eot"); /* IE9 Compat Modes */
            src: url("https://cdn.jsdelivr.net/gh/marsnow/open-huninn-font@1.1/font/jf-openhuninn.eot?#iefix") format("embedded-opentype"), /* IE6-IE8 */
            url("https://cdn.jsdelivr.net/gh/marsnow/open-huninn-font@1.1/font/jf-openhuninn.woff") format("woff"), /* Modern Browsers */
            url("https://cdn.jsdelivr.net/gh/marsnow/open-huninn-font@1.1/font/jf-openhuninn.ttf") format("truetype"), /* Safari, Android, iOS */
            url("https://cdn.jsdelivr.net/gh/marsnow/open-huninn-font@1.1/font/jf-openhuninn.svg#SealmemoryHeader") format("svg"); /* Legacy iOS */
        }
        * {
            padding: 0;
            margin: 0;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;


        }



        @media (min-width: 1600px) {

            .container-xl,
            .container-lg,
            .container-md,
            .container-sm,
            .container {
                max-width: 1400px;
            }
        }


        .d-flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .m-a {
            margin: auto;
        }

        body {
            width: 100%;
            height: 100%;
            background-color: #F0E09C;
            font-family: 'HunInn';
        }

        nav {
            width: 388px;
            min-height: 100vh;
            background-color: #F4F2F2;
        }

        .sideNav {
            position: relative;
        }

        .sideNav .logo {
            margin-left: 60px;
        }

        .sideNav .main-btn {
            width: 291px;
            height: 66px;
            background-color: #E5CFBA;
            border-radius: 10px;
            font-size: 36px;
            text-align: center;
            line-height: 66px;
            font-size: 24px;
            letter-spacing: 4px;
        }

        .sideNav .main-btn:hover {
            -webkit-box-shadow: 0 0 0 5px #E48E64;
            box-shadow: 0 0 0 5px #E48E64;
            cursor: pointer;
        }
        .sideNav .btn-group {
            width: 291px;
            margin-top: 10px;
        }

        .sideNav .btn-group .btnb {
            width: 140px;
            height: 140px;
            background-color: #E5CFBA;
            border-radius: 20px;
            font-size: 36px;
            text-align: center;
            line-height: 45px;
            padding-top: 25px;
        }

        .sideNav .btn-group .btnb:nth-child(2n-1) {
            margin-right: 10px;
        }

        .sideNav .btn-group .btnb:hover {
            -webkit-box-shadow: 0 0 0 5px #E48E64;
            box-shadow: 0 0 0 5px #E48E64;
        }

        .down-btn{
            margin-top: 10px;
            
        }

        .sideNav .notice-window {
            position: fixed;
            bottom:20px;
        }

        .sideNav .notice-window .notice-part {
            position: absolute;
            bottom: 60px;
        }

        .sideNav .notice-window .notice-part .notice {
            width: 200px;
            height: 100px;
            padding: 8px 10px ;
            position: relative;
            background: #ffffff;
            border-radius: .4em;

        }

        .sideNav .notice-window .notice-part .notice:after {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 0;
            height: 0;
            border: 35px solid transparent;
            border-right-color: #ffffff;
            border-left: 0;
            border-bottom: 0;
            margin-top: -17.5px;
            margin-left: -25px;
            z-index: -1;
        }

        .sideNav .logout-btn {
            width: 291px;
            height: 66px;
            background-color: #E5CFBA;
            border-radius: 10px;
            font-size: 36px;
            text-align: center;
            line-height: 66px;
            text-align: center;
            line-height: 66px;
            position: absolute;
            bottom: 5%;
            left: 50px;
            height: 40px;
            line-height: 40px;
            font-size: 24px;

            background-color: #354D6D;
            color: white;
            cursor: pointer;
        }

        main {
            width: calc(100% - 388px);
            height: 100vh;
            background-color: #F0E09C;
            padding-top: 50px;
            overflow: scroll;
        }

        table {
            background-color: #E4B959;
        }

        table.dataTable thead th,
        table.dataTable thead td {
            padding: 10px 20px;
            border: 2px solid #ffffff;
        }

        table.dataTable tbody th,
        table.dataTable tbody td {
            padding: 10px 18px 6px 18px;
            border: 2px solid #fdfdfd;
        }

        table.dataTable tbody tr {
            background-color: #E4B959;
        }
    </style>
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
            <div class="main-btn m-a" style="text-decoration: none;color:black">TimeEmpire</div>
            <div class="btn-group d-flex m-a">
                <a class="btnb" href="/admin/profile" style="text-decoration: none;color:black">個人<br>頁面</a>
                <a class="btnb" href="/admin/project" style="text-decoration: none;color:black">專案<br>管理</a>
            </div>
            <div class="btn-group d-flex m-a">
                <a class="btnb" href="/admin/pointLog/{{auth()->user()->id}}"
                    style="text-decoration: none;color:black">點數<br>歷程</a>
                <a class="btnb" style="text-decoration: none;color:black">工作<br>日誌</a>
            </div>

            @if(App\User::find(auth()->user()->id)->authority == 1)
            <div class="main-btn m-a down-btn" style="text-decoration: none;color:black"> <a href="/admin/user/">人員管理</a>
            </div>


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
                    <a class="dropdown-item" href="{{ route('logout') }}"
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

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>

</html>
