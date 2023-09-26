<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '') }}</title>
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script> 

    {{-- ================================== --}}
    <!-- Vendor CSS Files -->
    {{-- <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet" /> --}}

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/main/index.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    @yield('style')
    @yield('head-scripts')


</head>

<body class="toggle-sidebar">
    {{-- <div id="app"> --}}
    {{-- <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home', ['locale' => app()->getLocale()]) }}">
                        Logo
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto"></ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @else
                                <li><a class="nav-link"
                                        href="{{ route('users.index', ['locale' => app()->getLocale()]) }}">Manage Users</a>
                                </li>
                                <li><a class="nav-link"
                                        href="{{ route('roles.index', ['locale' => app()->getLocale()]) }}">Manage Role</a>
                                </li>
                                <li><a class="nav-link"
                                        href="{{ route('show.files', ['locale' => app()->getLocale()]) }}">Manage Files</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->username }} <span class="caret"></span>
                                    </a>


                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                    @auth
                        <div class="nav-item dropdown">
                            <a id="languageDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('messages.langName') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="languageDropdown">
                                <a class="dropdown-item"
                                    href="{{ route(Route::currentRouteName(),array_merge(request()->route()->parameters(),['locale' => 'am'])) }}">հայերեն</a>
                                <a class="dropdown-item"
                                    href="{{ route(Route::currentRouteName(),array_merge(request()->route()->parameters(),['locale' => 'ru'])) }}">русский</a>
                            </div>
                        </div>
                    @endauth
                </div>
            </nav> --}}

    <!-- ======= Sidebar ======= -->
    @include('layouts.sidebar')
    <!-- End Sidebar-->
    @include('layouts.nav')

    <!-- end nav-top -->


    <main id="main" class="main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <!-- Vendor JS Files -->
    {{-- <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script> --}}

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main/main.js') }}"></script>
    @yield('js-scripts')

</body>

</html>
