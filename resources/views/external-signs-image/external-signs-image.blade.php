@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/external-signs-image/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/calendar.css') }}">

@endsection


@section('content')

    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">


                <!-- Vertical Form -->
                <form class="form" method="POST" action="{{route('manExternalSignHasSignPhoto.store', $manId)}}">
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
                                        data-check="date"
                                />
                                <label for="inputDate1" class="form-label"
                                >1) Արձանագրման օր, ամիս, տարի</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>
                        <!-- ######################################################## -->
                        <input value="1" name="photo_id" hidden>
                        <button type="submit">submit</button>
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
        <script src="{{ asset('assets/js/external-signs-image/script.js') }}"></script>
        <script src='{{ asset('assets/js/main/date.js') }}'></script>

    @endsection
@endsection
