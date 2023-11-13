@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/email/email.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection


@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Էլեկտրոնային հասցե (e-mail)</h1>
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
                <x-form-error/>

                <!-- Vertical Form -->
                <form class="form" method="POST"
                      action="{{route('email.store', $man->id)}}">
                    @csrf
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="email"
                                        class="form-control"
                                        id="inputDate2"
                                        placeholder=""
                                        name="address"
                                        tabindex="1"
                                />
                                <label for="inputDate2" class="form-label"
                                >1) Էլեկտրոնային հասցե (e-mail)</label
                                >
                            </div>
                        </div>


                        <div class="col">
                            <label for="inputDate2" class="form-label"
                            >2) Կապեր</label
                            >
                        </div>
                    </div>

                    <!-- ######################################################## -->
                    <!-- Submit button -->
                    <input value="1" name="character_id" hidden>
                    <button type="submit" class="submit-btn"><i class="bi bi-arrow-left"></i></button>
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
        <script src="{{ asset('assets/js/email/script.js') }}"></script>
    @endsection
@endsection

