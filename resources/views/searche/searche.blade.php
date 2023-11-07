@extends('layouts.auth-app')
@section('style')
    <link href="{{ asset('assets/css/roles/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/searche/searche.css') }}" rel="stylesheet" />
@endsection
@section('content')

<div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Որոնում</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!-- Vertical Form -->
                <form class="form" method="POST" action="">
                    <div class="inputs row g-3">
                        <div class="serche-form">
                        <div class="col">
                            <div class="form-floating form-floating-search">
                                <input
                                type="text"
                                class="form-control form-control-search"
                                id="name"
                                placeholder=""
                                name="name"
                                />
                                <label for="name" class="form-label form-label-search"
                                > Անուն</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating form-floating-search">
                                <input
                                type="text"
                                class="form-control form-control-search"
                                id="lastName"
                                placeholder=""
                                name="lastName"
                                />
                                <label for="lastName" class="form-label form-label-search"
                                > Ազգանուն</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating form-floating-search">
                                <input
                                type="text"
                                class="form-control form-control-search"
                                id="middleName"
                                placeholder=""
                                name="middleName"
                                />
                                <label for="middleName" class="form-label form-label-search"
                                > Հայրանուն</label
                                >
                            </div>
                        </div>

                    </div>

                    <div class="col">
                            <div class="form-floating form-floating-search">
                                <input
                                type="text"
                                class="form-control form-control-search"
                                id="fullName"
                                placeholder=""
                                name="fullName"
                                />
                                <label for="fullName" class="form-label form-label-search"
                                > Անուն Ազգանուն Հայրանուն </label
                                >
                            </div>
                        </div>
                        </div>

                        <button type="submit" class="submit-btn submit-btn-search">Որոնել</i></button>
                </form>

                <h3 class="searche_result">
                    Այո
                </h3>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

@section('js-scripts')
    <script>
        

    </script>
@endsection
@endsection
