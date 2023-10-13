@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/external-signs/style.css') }}">
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Արտաքին նշաններ</h1>
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
                <form class="form" method="POST" action="{{route('sign.store', $manId)}}">
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <div class="input-date-wrapper"> -->
                                <!-- <label for="inputDate1" role="value"></label>
                                <input type="text" hidden role="store" /> -->
                                <input
                                        type="date"
                                        placeholder=""
                                        id="inputDate1"
                                        class="form-control"
                                        name="fixed_date"
                                />
                                <label for="inputDate1" class="form-label"
                                >1) Արձանագրման օր, ամիս, տարի</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control fetch_input_title"
                                        id="item1"
                                        placeholder=""
                                        data-id="1"
                                        value="1"
                                        name="sign_id"
                                        list="brow1"
                                />
                                <i
                                        class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fullscreenModal"

                                        data-url='{{route('get-model-filter',['path'=>'character'])}}'
                                        data-fieldname="name"
                                        data-section='{{route('open.modal')}}'
                                        data-id='sign'
                                ></i>
                                <label for="item1" class="form-label"
                                >2) Արտաքին նշաններ</label
                                >
                            </div>

                            <datalist id="brow1" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">

                            <label for="inputDate2" class="form-label"
                            >3) Կապեր</label
                            >
                        </div>
                        <!-- ######################################################## -->
                        <button type="submit">submit</button>
                        <!-- Submit button -->
                        <!-- ######################################################## -->
                    </div>
                    <!-- Vertical Form -->
                </form>
            </div>
    </section>

        <x-scroll-up/>
        <x-fullscreen-modal/>
        <x-errorModal/>



    @section('js-scripts')
        {{--        <script src="{{ asset('assets/js/external-signs/script.js') }}"></script>--}}
        <script src="{{ asset('assets/js/script.js') }}"></script>
    @endsection
@endsection

