@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/man/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/person-address/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
@endsection

@section('content')
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!-- Vertical Form -->
                <x-form-error/>
                <form class="form" method="POST"
                    @if(Route::currentRouteName() !== 'address.edit')
                      action="{{route('address.store',  request()->query())}}">
                    @else
                       action="{{route('address.update',[$modelData->model->id]+request()->query())}}">
                       @method('PUT')
                    @endif
                    @csrf
                    <x-back-previous-url submit/>
                    <div class="inputs row g-3">
                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    class="main_value fetch_input_title"
                                    type="text"
                                    hidden
                                    name="country_ate_id"
                                    value="{{$modelData->model->countryAte?->id}}">
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value fetch_input_title"
                                    id="country_ate"
                                    placeholder=""
                                    data-id=""
                                    value="{{$modelData->model->countryAte?->name ?? null }}"
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
                                >1) {{ __('content.country') }}</label>
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
                                    value="{{$modelData->model->region?->id}}">
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value fetch_input_title"
                                    id="region"
                                    placeholder=""
                                    data-id=""
                                    value="{{$modelData->model->region?->name}}"
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
                                >2) {{ __('content.region_local') }}</label
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
                                    value="{{$modelData->model->locality?->id}}">
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value fetch_input_title"
                                    id="location"
                                    placeholder=""
                                    data-id=""
                                    value="{{$modelData->model->locality?->name}}"
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
                                >3) {{ __('content.locality_local') }}</label
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
                                    value="{{$modelData->model->street?->id}}">
                                <input
                                    type="text"
                                    class="form-control get_datalist set_value fetch_input_title"
                                    id="street"
                                    placeholder=""
                                    data-id=""
                                    value="{{$modelData->model->street?->name}}"
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
                                <label for="street" class="form-label">
                                    4) {{ __('content.street_local') }}
                                </label>
                            </div>
                            <datalist id="street-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>


                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district fetch_input_title"
                                    id="region2"
                                    value="{{$modelData->model->region?->name}}"
                                    data-disabled="region"
                                    placeholder=""
                                    name="region"
                                />
                                <label for="region2" class="form-label">
                                    5) {{ __('content.region') }}
                                </label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district fetch_input_title"
                                    id="location2"
                                    value="{{$modelData->model->locality?->name}}"
                                    placeholder=""
                                    data-disabled="location"
                                    name="locality"
                                />
                                <label for="location2" class="form-label"
                                >6) {{ __('content.locality') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control notActiv_district fetch_input_title"
                                    id="street2"
                                    value="{{$modelData->model->street?->name}}"
                                    placeholder=""
                                    name="street"
                                    data-disabled="street"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >7) {{ __('content.country') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="track_id"
                                    value="{{$modelData->model->track}}"
                                    placeholder=""
                                    name="track"
                                />
                                <label for="track_id" class="form-label">8) {{ __('content.track') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="home_num_id"
                                    value="{{$modelData->model->home_num}}"
                                    placeholder=""
                                    name="home_num"
                                />
                                <label for="home_num_id" class="form-label">9) {{ __('content.home_num') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="housting_num_id"
                                    value="{{$modelData->model->housing_num}}"
                                    placeholder=""
                                    name="housing_num"
                                />
                                <label for="housting_num_id" class="form-label">10) {{ __('content.housing_num') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="apt_num_id"
                                    value="{{$modelData->model->apt_num}}"
                                    placeholder=""
                                    name="apt_num"
                                />
                                <label for="apt_num_id" class="form-label">11) {{ __('content.apt_num') }}</label>
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

                        @if(Route::currentRouteName() !== 'address.create')
                            <div class="col flex justify-content-between">
                                <label for="inputDate2" class="form-label">
                                    14) {{__('content.ties')}}
                                </label>
                                   <x-tegs-relations :model="$modelData->model"/>
                            </div>
                        @endif
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
           
            let parent_table_name = "{{ __('content.man') }}"
            let parent_id = "{{$modelData->id}}"
        </script>
        <script src='{{ asset('assets/js/script.js') }}'></script>
    @endsection
@endsection
