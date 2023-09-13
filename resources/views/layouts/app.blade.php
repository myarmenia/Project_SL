<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->

    <link rel="stylesheet" href="{{ asset('vendor/fonts/fonts.googleapis.css') }}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset('css/main/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/input-date.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/upload-file.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/select.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main/input.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">

        <div class="toggle-sidebar-btn-wrapper">
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <!-- <li class="nav-item">
          <a class="nav-link collapsed" href="index.html">
            <i class="bi bi-grid"></i>
            <span>Users</span>
          </a>
        </li> -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Կարգավորումներ</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('users.index', ['locale' => app()->getLocale()]) }}">
                                <i class="bi bi-circle"></i><span>Օգտատերեր</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('roles.index', ['locale' => app()->getLocale()]) }}">
                                <i class="bi bi-circle"></i><span>Դերեր</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Տվյալներրի մուտք</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav1" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="components-alerts.html">
                                <i class="bi bi-circle"></i><span>Անձեր</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('show.files', ['locale' => app()->getLocale()]) }}">
                                <i class="bi bi-circle"></i><span>FIler</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Components Nav -->

                <li class="nav-heading">Pages</li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="users-profile.html">
                        <i class="bi bi-person"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <!-- End Profile Page Nav -->
            </ul>
        </aside>
        <!-- End Sidebar-->

        <main id="main" class="main">
            <div class="pagetitle-wrapper">
                <div class="pagetitle">
                    <h1>Անձեր</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>


            <section class="section">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>


<!-- ################################################ -->
{{-- <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home', ['locale' => app()->getLocale()]) }}">
            Logo
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <li><a class="nav-link" href="{{ route('users.index', ['locale' => app()->getLocale()]) }}">Manage
                            Users</a></li>
                    <li><a class="nav-link" href="{{ route('roles.index', ['locale' => app()->getLocale()]) }}">Manage
                            Role</a></li>
                    <li><a class="nav-link" href="{{ route('show.files', ['locale' => app()->getLocale()]) }}">Manage
                            Files</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
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


{{-- <main class="py-4">
    <div class="container">
        @yield('content')
    </div>
</main> --}}

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
</div>


</body>


<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

{{-- Main JS files --}}
<script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

<script src="{{ asset('js/main/helper.js') }}"></script>
<script src="{{ asset('js/main/main.js') }}"></script>
<script src="{{ asset('js/main/input-date.js') }}"></script>
<script src="{{ asset('js/main/select.js') }}"></script>
<script src="{{ asset('js/main/input.js') }}"></script>
<script src="{{ asset('js/main/upload-file.js') }}"></script>

</html>
