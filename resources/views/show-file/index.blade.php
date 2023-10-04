@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/show-file/show-file.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.roles') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    ----
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('pagetitle.roles') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                  <div id="app" class="p-4">
                    {!! $implodeArray!!}
                  </div>

                  <div id="modal">
                    <div class="modal_select" data-name="name">name:</div>
                    <div class="modal_select" data-name="ammunition">ammunition:</div>
                    <div class="modal_select" data-name="address">address:</div>
                  </div>
              
                </div>
            </div>

            @yield('permissions-content')

        </div>
    </section>

@section('js-scripts')
    <script src="{{ asset('assets/js/show-file/show-file.js') }}"></script>
@endsection
@endsection

