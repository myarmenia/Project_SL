@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/external-signs/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
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
                <form class="form" method="POST" action="{{route('sign.store', $man->id)}}">
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
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
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="sign_id"
                                    value=""
                                >
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value"
                                    id="sign"
                                    placeholder=""
                                    data-id=""
                                    tabindex="12"
                                    data-table="sign"
                                    data-model="sign"
                                    list="sign-list"/>
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='sign'
                                    data-fieldname='name'
                                ></i>
                                <label for="sign" class="form-label"
                                >2) Արտաքին նշաններ</label
                                >
                            </div>

                            <datalist id="sign-list" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">

                            <label for="inputDate2" class="form-label"
                            >3) Կապեր</label
                            >
                        </div>
                        <!-- ######################################################## -->
                        <!-- Submit button -->
                        <!-- ######################################################## -->
                    </div>
                    <button type="submit" class="submit-btn">submit</button>

                    <!-- Vertical Form -->
                </form>
            </div>
        </div>
    </section>

        <x-scroll-up/>
        <x-fullscreen-modal/>
        <x-errorModal/>



    @section('js-scripts')
        <script>
            let parent_id = "{{$man->id}}"
            let open_modal_url = "{{route('open.modal')}}"
        </script>

        {{--        <script src="{{ asset('assets/js/external-signs/script.js') }}"></script>--}}
        <script src="{{ asset('assets/js/script.js') }}"></script>
    @endsection
@endsection

