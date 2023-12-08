@extends('layouts.auth-app')
@section('style')
    <link href="{{ asset('assets/css/roles/style.css') }}" rel="stylesheet" />
@endsection
@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{__('sidebar.main')}}</h1>
            {{-- <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">{{__('pagetitle.main')}}</a></li>
                    <li class="breadcrumb-item active">{{__('pagetitle.roles')}}</li>
                </ol>
            </nav> --}}
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body p-0">
                  <h2 class="p-3">{{__('title.welcome')}} - {{Auth()->user()->username}}</h2>
                </div>
            </div>

            @yield('permissions-content')

        </div>
    </section>

@section('js-scripts')
    <script src="{{ asset('assets/js/roles/script.js') }}"></script>
    <script>
        const searchParams = new URLSearchParams(window.location.search);
        // console.log(searchParams.get('addres'));  true

    </script>
@endsection
@endsection

