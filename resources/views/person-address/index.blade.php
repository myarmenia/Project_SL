@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/man/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/person-address/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('content.place_person')" :crumbs="[
        [
            'name' => __('sidebar.action'),
            'route' => 'open.page',
            'route_param' => 'action',
            'parent' => [
                'name' => __('content.man'),
                'route' => 'man.edit',
                'id' => $_GET['id'],
            ],
        ],
    ]"  />
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!-- Vertical Form -->
                <x-form-error/>
                <form class="form" method="POST"  action="{{route('address.store', ['model' => $modelData->name,'id'=>$modelData->id ])}}">
                @csrf
                    <x-back-previous-url submit/>
                    <div class="inputs row g-3">
                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="country_ate_id"
                                    value="">
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value"
                                    id="country_ate"
                                    placeholder=""
                                    data-id=""
                                    value="{{$modelData->bornAddress->countryAte->name ?? null }}"
                                    tabindex="1"
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
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="region_id"
                                    value="">
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value fetch_input_title"
                                    id="region"
                                    placeholder=""
                                    data-id=""
                                    value="{{$modelData->bornAddress->region->name ?? null }}"
                                    tabindex="11"
                                    data-table="region"
                                    data-model="beanCountry"
                                    data-disabled="region2"
                                    list="region-list"
                                    data-type="location"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='region'
                                    data-fieldname='name'
                                ></i>
                                <label for="region" class="form-label"
                                >2) Մարզ (տեղական)</label
                                >
                            </div>
                            <datalist id="region-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="locality_id"
                                    value="">
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value fetch_input_title"
                                    id="location"
                                    placeholder=""
                                    data-id=""
                                    value="{{$modelData->bornAddress->locality->name ?? null }}"
                                    tabindex="12"
                                    data-table="locality"
                                    data-model="beanCountryLocality"
                                    data-type="location"
                                    list="locality-list"
                                    data-disabled="location2"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='locality'
                                    data-fieldname='name'
                                ></i>
                                <label for="location" class="form-label"
                                >3) Բնակավայր (տեղական)</label
                                >
                            </div>
                            <datalist id="locality-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value"
                                    type="text"
                                    hidden
                                    name="street_id"
                                    value="">
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value fetch_input_title"
                                    id="street"
                                    placeholder=""
                                    data-id=""
                                    value="{{$modelData->bornAddress->locality->name ?? null }}"
                                    tabindex="12"
                                    data-table="street"
                                    data-model="beanCountryLocality"
                                    data-type="location"
                                    list="street-list"
                                    data-disabled="street2"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='street'
                                    data-fieldname='name'
                                ></i>
                                <label for="street" class="form-label"
                                >4) Փողոց (տեղական)</label
                                >
                            </div>
                            <datalist id="street-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>


                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district"
                                    id="region2"
                                    data-disabled="region"
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
                                    id="location2"
                                    placeholder=""
                                    data-disabled="location"
                                    name="locallity"
                                />
                                <label for="location2" class="form-label"
                                >6) Բնակավայր</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district"
                                    id="street2"
                                    placeholder=""
                                    name="street"
                                    data-disabled="street"
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
                                    name="housing_num"
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
{{--                        <div class="col">--}}
{{--                            <div class="form-floating input-date-wrapper">--}}
{{--                                <input type="date" placeholder="" class="form-control" name="inp12"/>--}}
{{--                                <label class="form-label"--}}
{{--                                >12) Բնակվելու սկիզբ (օր, ամիս, տարի)</label--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="form-floating input-date-wrapper">--}}
{{--                                <input type="date" placeholder="" class="form-control" name="inp13"/>--}}
{{--                                <label class="form-label">13) Բնակվելու ավարտ (օր, ամիս, տարի)</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
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
    @endsection
@endsection
