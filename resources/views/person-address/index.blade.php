@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/man/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/person-address/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Անձի բնակության վայրը</h1>
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
                <x-form-error/>
                <form class="form" method="POST"  action="{{route('address.store', ['model' => $modelData->name,'id'=>$modelData->id ])}}">
                @csrf
                    <x-back-previous-url submit=""/>
                    <div class="inputs row g-3">
                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="country_ate"
                                    placeholder=""
                                    data-id=""
                                    name="country_ate_id"
                                    value="{{$modelData->bornAddress->countryAte->name ?? null }}"
                                    tabindex="10"
                                    data-table="country_ate"
                                    data-model="countryAte"
                                    list="country_ate-list"
                                    data-type="location"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='country_ate'
                                    data-fieldname='name'
                                ></i>
                                <label for="country_ate" class="form-label"
                                >1) Երկիր, ՎՏՄ, տարածաշրջան</label>
                            </div>
                            <datalist id="country_ate-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActive_address"
                                    id="item2"
                                    placeholder=""
                                    data-id="2"
                                    name="inp2"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class  not_active"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/2"
                                ></i>
                                <label for="item2" class="form-label"
                                >2) Մարզ (տեղական)</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActive_address"
                                    id="item3"
                                    placeholder=""
                                    data-id="3"
                                    name="inp3"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class not_active "
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/3"
                                ></i>
                                <label for="item3" class="form-label"
                                >3) Բնակավայր (տեղական)</label
                                >
                            </div>
                        </div>

                        <div class="col">

                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActive_address"
                                    id="item4"
                                    placeholder=""
                                    data-id="4"
                                    name="inp4"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class  not_active"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                ></i>
                                <label for="item4" class="form-label"
                                >4) Փողոց (տեղական)</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="region"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >5) Շրջան</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="locallity"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >6) Բնակավայր</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    name="street"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >7) Փողոց</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="track_id"
                                    placeholder=""
                                    name="track"
                                />
                                <label for="track_id" class="form-label">8) Աշխարհագրական տեղանք</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="home_num_id"
                                    placeholder=""
                                    name="home_num"
                                />
                                <label for="home_num_id" class="form-label">9) Տան համարը</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="housting_num_id"
                                    placeholder=""
                                    name="housting_num"
                                />
                                <label for="housting_num_id" class="form-label">10) Շենքի համարը</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="apt_num_id"
                                    placeholder=""
                                    name="apt_num"
                                />
                                <label for="apt_num_id" class="form-label">11) Բնակարանի համարը</label>
                            </div>
                        </div>
                        <!-- Date Inputs -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder="" class="form-control" name="inp12"/>
                                <label class="form-label"
                                >12) Բնակվելու սկիզբ (օր, ամիս, տարի)</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder="" class="form-control" name="inp13"/>
                                <label class="form-label">13) Բնակվելու ավարտ (օր, ամիս, տարի)</label>
                            </div>
                        </div>
                        <!-- Selects -->

                        <div class="btn-div">
                            <label class="form-label">14) Կապեր</label>
                            <div class="tegs-div" name="tegsDiv14 ">
                                <div class="Myteg">
                                    <span>kkkk</span>
                                    <span>X</span>
                                </div>
                            </div>
                        </div>
                    </div>
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
            let parent_id = "{{$modelData->id}}"
        </script>
        <script src='{{ asset('assets/js/script.js') }}'></script>
{{--        <script src='{{ asset('assets/js/person-address/index.js') }}'></script>--}}
    @endsection
@endsection
