@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/simple_search_test.css') }}" rel="stylesheet" />
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{__('sidebar.roles')}}</h1>
            <nav>
                <ol class="breadcrumb">
                  ----***
                    <li class="breadcrumb-item"><a href="index.html">{{__('pagetitle.main')}}</a></li>
                    <li class="breadcrumb-item active">{{__('pagetitle.roles')}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">




                    <div class="all">
                          <div class="btns">
                            <button id="I">И</button>
                            <button id="ILI">ИЛИ</button>
                            <button id="reset">Сброс</button>
                            <button id="search">Поиск</button>
                          </div>

                        <div class="bottom_side">
                            <div class="address">
                                <p>Адрес</p>
                                <input type="text" id="input1">
                            </div>
                            <div class="file">
                                <p>Поиск по файлам</p>
                                <input type="text" id="input2">
                            </div>
                        </div>
                          


                    </div>











                </div>
          </div>

            @yield('permissions-content')

     </div>
    </section>
    

@section('js-scripts')
<script src="{{ asset('assets/js/simple_search_test.js') }}"></script>
    <script>
        
    </script>
@endsection
@endsection