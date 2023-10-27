@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/phone/style.css') }}">
@endsection


@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Հեռախոսահամար</h1>
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
                <form class="form" method="POST" action="{{route('phone.store', $man->id)}}">
                    @csrf
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputDate2"
                                    placeholder=""
                                    name="number"
                                    tabindex="1"
                                />
                                <label for="inputDate2" class="form-label"
                                >1) Հեռախոսահամար</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="character_id"
                                    value="">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="character"
                                    placeholder=""
                                    data-id=""
                                    tabindex="2"
                                    data-table="character"
                                    data-model="character"
                                    list="character-list"/>
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='character'
                                    data-fieldname='name'
                                ></i>
                                <label for="character" class="form-label"
                                >2) Սեփականության բնույթ</label
                                >
                            </div>

                            <datalist id="character-list" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                    <textarea
                        type="text"
                        class="form-control"
                        id="inputDate2"
                        placeholder=""
                        name="more_data"
                        tabindex="3"
                    >
                    </textarea>
                                <label for="inputDate2" class="form-label"
                                >3) Լրացուցիչ տվյալներ</label
                                >
                            </div>
                        </div>
                        @if(Route::currentRouteName() === 'edit.show')
                            <div class="col">
                                <label for="inputDate2" class="form-label"
                                >4) Կապեր</label
                                >
                            </div>
                        @endif
                    </div>


                    <!-- ######################################################## -->
                    <button type="submit" class="submit-btn">submit</button>

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
        <script>
            let parent_id = "{{$man->id}}"
            let open_modal_url = "{{route('open.modal')}}"
        </script>

        {{--        <script src="{{ asset('assets/js/phone/script.js') }}"></script>--}}

        <script src="{{ asset('assets/js/script.js') }}"></script>
    @endsection
@endsection

