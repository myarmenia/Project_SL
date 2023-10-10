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


                <!-- Vertical Form -->
                <form class="form" method="POST" action="{{route('phone.store', $manId)}}">
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
                                />
                                <label for="inputDate2" class="form-label"
                                >1) Հեռախոսահամար</label
                                >
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
                                        value="2"
                                        name="character_id"
                                        list="brow1"

                                />
                                <i

                                        class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fullscreenModal"

                                        data-url='{{route('get-model-filter',['path'=>'character'])}}'
                                        data-fieldname="name"
                                        data-section='{{route('open.modal')}}'
                                        {{-- data-id='1' --}}
                                        data-id='character'

                                ></i>
                                <label for="item1" class="form-label"
                                >2) Սեփականության բնույթ</label
                                >
                            </div>

                            <datalist id="brow1" class="input_datalists" style="width: 500px;">

                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                    <textarea
                            type="text"
                            class="form-control"
                            id="inputDate2"
                            placeholder=""
                            name="more_data">

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
                    <button type="submit">submit</button>
                    <!-- Submit button -->
                    <!-- ######################################################## -->
                </form>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>


    <!-- fullscreenModal -->
    <div
            class="modal fade my-modal"
            id="fullscreenModal"
            tabindex="-1"
            aria-hidden="true"
    >
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <form id="addNewInfoBtn"> --}}
                        <div class="form-floating">
                            <input
                                    type="text"
                                    class="form-control"
                                    id="addNewInfoInp"
                                    placeholder=""
                            />
                            <label for="item21" class="form-label"
                            >Ֆիլտրացիա</label
                            >
                        </div>

                        <button type="submit" class="btn btn-primary">Ավելացնել նոր գրանցում</button>


                    {{-- </form> --}}
                </div>
                <div class="modal-body">
                    <table>
                        <thead>
                        <tr>
                            <th class="numbering" scope="col">#</th>
                            <th scope="col">Անվանում</th>
                            <th scope="col" class="td-xs"></th>
                        </tr>
                        </thead>
                        <tbody id="table_id">



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    @section('js-scripts')

        {{--        <script src="{{ asset('assets/js/phone/script.js') }}"></script>--}}

        <script src="{{ asset('assets/js/script.js') }}"></script>
    @endsection
@endsection

