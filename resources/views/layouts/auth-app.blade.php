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
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}"
        rel="stylesheet">
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
    <link href="{{ asset('assets/css/font-awesome/all.min.css') }}" rel="stylesheet" />
    @yield('style')
    @yield('head-scripts')


</head>

<body class="toggle-sidebar">
    <!-- ======= Sidebar ======= -->
    @role('forsearch')
        @include('layouts.nav')
    @else
        @include('layouts.sidebar')
        <!-- End Sidebar-->
        @if (!isset($type))
            @include('layouts.nav')
        @endif
    @endrole

    <!-- end nav-top -->


    <main id="main" class="main">
        <div class="container">
            {{-- =============== --}}
            {{-- {{dd(request()->segment(2))}} --}}
            @if (!request()->routeIs('home') )
            {{-- @if (!request()->routeIs('home') && (!request()->segment(2) == 'advancedsearch' || !request()->segment(2) == 'simplesearch'
            )) --}}


            <div class="pagetitle-wrapper">
                <div class="pagetitle">
                    @php
                        $arr = Session::get('crumbs_url');

                    @endphp

                    <h1>{{ __('pagetitle.' . end($arr)['title']) }}</h1>

                    <nav>

                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('pagetitle.main') }}</a>
                            </li>
                            @foreach ($arr as $key => $crumb)
                                <li
                                    class="breadcrumb-item {{ $crumb['name'] === end($arr)['name'] && $key == array_key_last($arr) ? 'active' : '' }}">
                                    @if ($crumb['name'] === end($arr)['name'] && $key == array_key_last($arr))
                                        {{ __('sidebar.' . $crumb['name']) }}
                                        @if (isset($crumb['id']))
                                            ID: {{ $crumb['id'] }}
                                        @endif
                                    @else
                                        <a href="/{{ app()->getLocale() }}{{ $crumb['url'] }}">{{ __('sidebar.' . $crumb['name']) }}
                                            @if (isset($crumb['id']))
                                                ID: {{ $crumb['id'] }}
                                            @endif
                                        </a>
                                    @endif

                                </li>
                            @endforeach
                        </ol>
                    </nav>
                </div>
            </div>
            @endif

            {{-- ==================== --}}
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
    <script>
        let result_search_dont_matched = `{{ __('validation.result_search_dont_matched') }}`
        let lang = "{{ app()->getLocale() }}"
        let open_modal_url = "{{ route('open.modal') }}"
        let get_filter_in_modal = "{{ route('get-model-filter') }}"
    </script>
    <script src="{{ asset('assets/js/main/main.js') }}"></script>
    <script>
        // sessionStorage.setItem('reload', 'yes');
    </script>
    @yield('js-scripts')

</body>

</html>
