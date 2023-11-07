@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/event/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Կապն օբյեկտների միջև</h1>
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
                <form class="form">
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="item1"
                                    placeholder=""
                                    data-id="1"
                                    value=""
                                    name="inp1"
                                    list="brow1"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/1"
                                ></i>
                                <label for="item1" class="form-label"
                                >1) Կապի բնույթը</label
                                >
                            </div>

                            <datalist id="brow1" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>
                        <x-teg :item="$manTeg" inputName="man_id" name="id"/>
                        <div class="btn-div">
                            <label class="form-label">2) Կոնկրետ կապ</label>
                            <a href="{{ route('open.page', 'man') }}">
                                <span>{{ __('table.add') }}</span>
                            </a>
                        </div>
                    </div>
                    <!-- ######################################################## -->
                    <!-- Submit button -->
                    <!-- ######################################################## -->
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>


    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <!-- <script src="{{ asset('assets/js/event/script.js') }}"></script> -->
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('assets/js/tag.js') }}"></script>
    @endsection
@endsection
