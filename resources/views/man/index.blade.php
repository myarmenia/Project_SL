@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/man/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')
    <x-breadcrumbs :title="__('sidebar.man_face')" :crumbs="[['name' => __('sidebar.man'), 'route' => 'open.page', 'route_param' => 'man']]" :id="$man->id" />


    {{--    <x-breadcrumbs :title="__('sidebar.man')" :crumbs="[['name' => __('sidebar.open'),'route' => 'open.page'],['name' => __('sidebar.man'),'route' => 'open.page', 'route_param' => 'man', 'id' => $man->id]]" :id="$man->id"/> --}}


    <!-- End Page Title -->
    <section class="section">
        <div class="card">
            <div class="card-body">
                <!-- Vertical Form -->
                <x-back-previous-url/>
                <div class="form">
                    <div class="inputs row g-3">
                        <div class="col">
                            <x-tegs :data="$man" relation="lastName1" name="last_name" delete />
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control my-form-control-class my-teg-class save_input_data"
                                    id="inputLastNanme4" placeholder="" name="last_name" tabindex="1"
                                    data-type="create_relation" data-fieldname='last_name' data-model="last_name"
                                    data-table="lastName1" data-pivot-table='last_name' />

                                <label for="inputLastNanme4" class="form-label">1) {{ __('content.last_name') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <x-tegs :data="$man" relation="firstName1" name="first_name" delete />
                            <div class="form-floating ">
                                <input type="text"
                                    class="form-control my-form-control-class my-teg-class save_input_data" id="inputNanme4"
                                    placeholder="" name="first_name" tabindex="2" data-type="create_relation"
                                    data-fieldname='first_name' data-model="firstName1" data-table="has_first_name"
                                    data-pivot-table='first_name' />
                                <label for="inputNanme4" class="form-label">2) {{ __('content.first_name') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <x-tegs :data="$man" relation="middleName1" name="middle_name" delete />
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control my-form-control-class my-teg-class save_input_data"
                                    id="inputMiddleName" placeholder="" name="middle_name" tabindex="3"
                                    data-type="create_relation" data-fieldname='middle_name' data-model="middleName1"
                                    data-table="has_middle_name" data-pivot-table='middle_name' />
                                <label for="inputMiddleName" class="form-label">3) {{ __('content.middle_name') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title" id="fullName" value="{{ $man->full_name }}"
                                    placeholder="" readonly="" tabindex="-1" name="inp4" />
                                <label for="fullName" class="form-label">4)
                                    {{ __('content.last_name') . ' ' . __('content.first_name') . ' ' . __('content.middle_name') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">5) {{ __('content.also_known_as') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'man', 'main_route' => 'man.edit', 'model_id' => $man->id, 'relation' => 'man_to_man']) }}" >{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="man_to_man" :label="__('content.short_man') . ': '" name="id" tableName="man" related delete />
                        </div>
                        <!-- To open modal """fullscreenModal""" -->

                        <!-- Date Input -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">

                                <input
                                    type="date"
                                    placeholder=""
                                    value="{{$man->birthday ?? null }}"
                                    id="inputDate1"
                                    tabindex="4"
                                    data-type="birthday"
                                    class="form-control save_input_data"
                                    name="birthday"
                                />

                                <label for="inputDate1" class="form-label">6)
                                    {{ __('content.date_of_birth') }}
                                </label>
                                <!-- </div> -->
                            </div>
                        </div>
                        <!-- Inputs -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="inputDate2"
                                    tabindex="5" data-type="update_field" placeholder=""
                                    value="{{ $man->start_year ?? null }}" name="start_year" />
                                <label for="inputDate2" class="form-label">7)
                                    {{ __('content.approximate_year') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <x-tegs :data="$man" relation="passport" name="number" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control my-form-control-class save_input_data"
                                    id="passport" placeholder="" name="number" tabindex="6"
                                    data-type="create_relation" data-fieldname='number' data-table="passport"
                                    data-model="passport" data-pivot-table='passport' />
                                <label for="passport" class="form-label">8) {{ __('content.passport_number') }}</label>
                            </div>
                        </div>
                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="gender" placeholder="" value="{{ $man->gender?->name }}"
                                    data-modelid="{{ $man->gender?->id }}" name="gender_id" tabindex="7"
                                    data-type="update_field" list="gender-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/1" data-table-name='gender'
                                    data-fieldname='name'></i>
                                <label for="gender" class="form-label">9) {{ __('content.gender') }}</label>
                            </div>
                            <datalist id="gender-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="nation" placeholder="" value="{{ $man->nation->name ?? null }}"
                                    tabindex="8" data-type="update_field" name="nation_id" list="nation-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/2" data-table-name='nation'
                                    data-fieldname='name'></i>
                                <label for="nation" class="form-label">10) {{ __('content.nationality') }}</label>
                            </div>
                            <datalist id="nation-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <x-tegs :data="$man" relation="country" name="name" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="country" placeholder="" name="name" list="citizen-country-list"
                                    tabindex="9" data-type="attach_relation" data-modelid="" data-table="country"
                                    data-model="country" data-fieldname='name' data-pivot-table='country' />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/3" data-table-name='country'
                                    data-fieldname='name'></i>
                                <label for="country" class="form-label">11) {{ __('content.citizenship') }}</label>
                            </div>
                            <datalist id="citizen-country-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="country_ate" placeholder="" data-id="" name="name"
                                    value="{{ $man->bornAddress->countryAte->name ?? null }}" tabindex="10"
                                    data-table="country_ate" data-model="countryAte" list="country_ate-list"
                                    data-type="location" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4" data-table-name='country_ate'
                                    data-fieldname='name'></i>
                                <label for="country_ate" class="form-label">12)
                                    {{ __('content.place_of_birth') }}</label>
                            </div>
                            <datalist id="country_ate-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="beanCountryRegion"
                                    placeholder=""
                                    data-id=""
                                    name="name"
                                    value="{{ $man->bornAddress->region->name ?? null }}"
                                    tabindex="11"
                                    data-table="region"
                                    data-model="beanCountry"
                                    data-disabled="beanCountryRegion2"
                                    list="region-list"
                                    data-type="location" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4" data-table-name='region'
                                    data-fieldname='name'></i>
                                <label for="beanCountryRegion" class="form-label">13)
                                    {{ __('content.place_of_birth_area_local') }}</label>
                            </div>
                            <datalist id="region-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="beanCountryLocality" placeholder="" data-id="" name="name"
                                    value="{{ $man->bornAddress->locality->name ?? null }}" tabindex="12"
                                    data-table="locality" data-model="beanCountryLocality" data-type="location"
                                    list="locality-list" data-disabled="beanCountryLocality2" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4" data-table-name='locality'
                                    data-fieldname='name'></i>
                                <label for="beanCountryLocality" class="form-label">14)
                                    {{ __('content.place_of_birth_settlement_local') }}</label>
                            </div>
                            <datalist id="locality-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <!-- Inputs -->
                        <div class="col">
                            <div class="form-floating">

                                <input
                                    type="text"
                                    class="form-control save_input_data"
                                    id="beanCountryRegion2"
                                    placeholder=""
                                    value="{{$man->bornAddress->region->name ?? null }}"
                                    name="name"
                                    tabindex="13"
                                    data-relation="region"
                                    data-table="region_id"
                                    data-model="region"
                                    data-disabled="beanCountryRegion"
                                    data-type="location"
                                />
                                <label for="beanCountryRegion2" class="form-label"
                                >15) {{__('content.place_of_birth_area')}}</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="beanCountryLocality2"
                                    placeholder="" value="{{ $man->bornAddress->locality->name ?? null }}"
                                    name="name" tabindex="14" data-relation="locality" data-table="locality_id"
                                    data-model="locality" data-disabled="beanCountryLocality" data-type="location" />
                                <label for="inputPassportNumber1" class="form-label">16)
                                    {{ __('content.place_of_birth_settlement') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <x-tegs :data="$man" relation="knows_languages" name="name" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="language" placeholder="" name="language_id" list="language-list"
                                    tabindex="15" data-type="attach_relation" data-table="knows_languages"
                                    data-model="language" data-fieldname='name' data-pivot-table='knows_languages' />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/3" data-table-name='language'
                                    data-fieldname='name'></i>
                                <label for="language" class="form-label">17)
                                    {{ __('content.knowledge_of_languages') }}</label>
                            </div>
                            <datalist id="language-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <div class="btn-div">

                            <label class="form-label">18) {{__('content.place_of_residence_person')}}</label>
                            <a href="{{ route('open.page', ['page' =>'address', 'main_route' => 'man.edit', 'model_id' => $man->id, 'model_name' => 'man', 'relation' => 'address']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="address" :label="__('content.short_address') . ': '" name="id" tableName="address" related delete :edit="['page' =>'address.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man']"/>

                        </div>
                        <div class="btn-div">
                            <label class="form-label">19) {{ __('content.telephone_number') }}</label>
                            <a  href="{{ route('phone.create', ['model' => 'man', 'id' => $man->id]) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="phone" :label="__('content.short_phone') . ': '" name="number" label="ՀԵՌ" tableName="phone"
                                related delete :edit="['page' =>'phone.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man']"/>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">20) {{ __('content.mail_address') }}</label>
                            <a href="{{ route('email.create', ['model' => 'man', 'id' => $man->id]) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="email" name="address" label="ԷԼՀ" tableName="email"
                             related delete :edit="['page' =>'email.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man']" />
                        </div>
                        <!-- Inputs -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="attention" placeholder=""
                                    value="{{ $man->attention ?? null }}" name="attention" tabindex="16"
                                    data-type="update_field" />
                                <label for="attention" class="form-label">21) {{ __('content.attention') }}</label>
                            </div>
                        </div>

                        <div class="btn-div col more_data" id="attach_file" data-type="create_relation"
                            data-model="more_data" data-fieldname="text">
                            <label class="form-label">22) {{ __('content.additional_information_person') }}</label>
                            <button class="btn btn-primary" style="font-size: 13px" data-bs-toggle="modal"
                                data-bs-target="#additional_information">{{ __('content.addTo') }}
                            </button>
                            <x-tegs :data="$man" relation="more_data" name="id" relationtype="has_many"
                                delete />
                        </div>

                        <!-- Select -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="religion" placeholder="" value="{{ $man->religion->name ?? null }}"
                                    name="religion_id" data-type="update_field" list="religion-list" tabindex="17"
                                    data-model="religion" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/1" data-table-name='religion'
                                    data-fieldname='name'></i>
                                <label for="religion" class="form-label">23) {{ __('content.worship') }}</label>
                            </div>
                            <datalist id="religion-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <!-- Input -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" placeholder=""
                                    id="occupation" value="{{ $man->occupation ?? null }}" tabindex="18"
                                    data-type="update_field" name="occupation" />
                                <label for="occupation" class="form-label">24) {{ __('content.occupation') }}</label>
                            </div>
                        </div>
                        <!-- Selects -->
                        <div class="col">
                            <x-tegs :data="$man" relation="operationCategory" name="name" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="operation_category" placeholder="" name="name" data-type="attach_relation"
                                    data-fieldname="name" list="operation_category-list" tabindex="19"
                                    data-table="operationCategory" data-model="operationCategory"
                                    data-pivot-table='operationCategory' />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/3"
                                    data-table-name='operation_category' data-fieldname='name'></i>
                                <label for="operation_category" class="form-label">25)
                                    {{ __('content.operational_category_person') }}</label>
                            </div>
                            <datalist id="operation_category-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <div class="col">
                            <x-tegs :data="$man" relation="countrySearch" name="name" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="country_search_man" placeholder="" name="name" data-type="attach_relation"
                                    data-fieldname="name" list="search-country-list" tabindex="20"
                                    data-table="countrySearch" data-model="country" data-pivot-table='countrySearch' />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/3" data-table-name='country'
                                    data-fieldname='name'></i>
                                <label for="country_search_man" class="form-label">26)
                                    {{ __('content.country_carrying_out_search') }}</label>
                            </div>
                            <datalist id="search-country-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <!-- Date Inputs -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <label role="value"></label>
                                                                        <input type="text" hidden role="store"/> -->
                                <input type="date" placeholder="" id="start_date"
                                    value="{{ $man->start_wanted ?? null }}" class="form-control save_input_data"
                                    name="start_wanted" tabindex="21" data-type="update_field" />
                                <label for="start_date" class="form-label">27)
                                    {{ __('content.declared_wanted_list_with') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder="" id="entry_date"
                                    class="form-control save_input_data" name="entry_date" tabindex="22"
                                    value="{{ $man->entry_date ?? null }}" data-type="update_field" />
                                <label for="entry_date" class="form-label">28) {{ __('content.home_monitoring_start') }}
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder="" id="exit_date" class="form-control save_input_data"
                                    name="exit_date" value="{{ $man->exit_date ?? null }}" tabindex="23"
                                    data-type="update_field" />
                                <label for="exit_date" class="form-label">29)
                                    {{ __('content.end_monitoring_start') }}</label>
                            </div>
                        </div>
                        <!-- Selects -->
                        <div class="col">
                            <x-tegs :data="$man" relation="education" name="name" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="education" placeholder="" name="name" data-type="attach_relation"
                                    data-fieldname="name" list="education-list" data-table="education"
                                    data-model="education" tabindex="24" data-pivot-table='education' />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/3" data-table-name='education'
                                    data-fieldname='name'></i>
                                <label for="education" class="form-label">30) {{ __('content.education') }}</label>
                            </div>
                            <datalist id="education-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <div class="col">
                            <x-tegs :data="$man" relation="party" name="name" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="party" placeholder="" name="name" data-type="attach_relation"
                                    data-fieldname="name" list="party-list" tabindex="25" data-table="party"
                                    data-model="party" data-pivot-table='party' />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/3" data-table-name='party'
                                    data-fieldname='name'></i>
                                <label for="party" class="form-label">31) {{ __('content.party') }}</label>
                            </div>
                            <datalist id="party-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">32) {{__('content.work_experience_person')}}</label>
                             <a href="{{route('work.create', ['model' => 'man', 'id' => $man->id,'redirect' => 'man'])}}">{{__('content.addTo')}}</a>
                             <x-tegs :data="$man" relation="organization_has_man" name="organization_id"
                                :label="__('content.short_work_activity')"  relationtype="has_many" tableName="organization_has_man" related delete :edit="['page' =>'work.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man']"/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">33) {{ __('content.stay_abroad') }}</label>
                            <a href="{{ route('manBeanCountry.create', ['model' => 'man', 'id' => $man->id]) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="beanCountry" name="id" :label="__('content.short_bean_country')"
                                relationtype="has_many" tableName="beanCountry" related delete :edit="['page' =>'manBeanCountry.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man']"/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">34) {{__('content.external_signs')}}</label>
                            <a href="{{route('man.sign.create',['model' => 'man','id'=>$man->id ])}}">{{__('content.addTo')}}</a>
                             <x-tegs :data="$man" relation="man_external_sign_has_sign" name="id"
                             :label="__('content.short_external_sign')" relationtype="has_many" tableName="man_external_sign_has_sign" related
                                delete :edit="['page' =>'sign.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man']" />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">35) {{__('content.external_signs_photo')}}</label>
                            <a href="{{route('manExternalSignHasSignPhoto.create', ['model' => 'man','id'=>$man->id])}}">{{__('content.addTo')}}</a>
                            <x-tegs :data="$man" relation="externalSignHasSignPhoto" name="id"

                            :label="__('content.short_external_sign')" relationtype="has_many" tableName="externalSignHasSignPhoto" related
                                delete :edit="['page' =>'manExternalSignHasSignPhoto.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man']"/>

                        </div>
                        <!-- Input -->
                        <div class="col">
                            <x-tegs :data="$man" relation="nickName" name="name" delete />
                            <div class="form-floating">
                                <input type="text" class="form-control my-form-control-class save_input_data"
                                    placeholder="" id="nickName" name="name" tabindex="26"
                                    value="{{ $man->has_nickname ?? null }}" data-type="create_relation"
                                    data-fieldname="name" data-model="nickname" data-table="has_nickname"
                                    data-pivot-table='nickname' />
                                <label class="form-label" for="nickName">36) {{ __('content.alias') }}</label>
                            </div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">37) {{ __('content.oper_ties_man') }}</label>
                            <a href="{{ route('objectsRelation.create', ['model' => 'man', 'id' => $man->id, 'redirect' => 'man']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="man_relation" name="second_object_id"  :label="__('content.short_object')"
                                relationtype="has_many" tableName="man_relation" related delete :edit="['page' =>'objectsRelation.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man', 'relation' => 'objects_relation']"/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">38) {{ __('content.oper_ties_organization') }}</label>
                            <a href="{{ route('objectsRelation.create', ['model' => 'organization', 'id' => $man->id, 'redirect' => 'man']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="organization_relation" name="second_object_id" :label="__('content.short_object')"
                                relationtype="has_many" tableName="organization_relation" related delete :edit="['page' =>'objectsRelation.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'organization', 'relation' => 'objects_relation']" />
                        </div>

                        <!-- Input -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" id="opened_dou" class="form-control save_input_data"
                                    placeholder="" value="{{ $man->opened_dou ?? null }}" name="opened_dou"
                                    tabindex="27" data-type="update_field" />
                                <label for="opened_dou" class="form-label">39) {{ __('content.face_opened') }}</label>
                            </div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">40) {{ __('content.member_actions') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'action', 'main_route' => 'man.edit', 'model_id' => $man->id, 'relation' => 'action']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="action" name="id" tableName="action"
                            :label="__('content.short_action')"
                             related
                                delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">41) {{ __('content.to_event') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'event', 'main_route' => 'man.edit', 'model_id' => $man->id, 'relation' => 'event']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="event" name="id" tableName="event"
                            :label="__('content.short_event')"
                            related
                                delete />
                        </div>

                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control get_datalist fetch_input_title save_input_data get_datalist"
                                    id="resource" placeholder="" value="{{ $man->resource->name ?? null }}"
                                    name="resource_id" list="resource-list" tabindex="28" data-model="resource"
                                    data-type="update_field" data-fieldname="name" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/1" data-table-name='resource'
                                    data-fieldname='name'></i>

                                <label for="resource" class="form-label">42)
                                    {{ __('content.source_information') }}</label>
                            </div>
                            <datalist id="resource-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">43) {{ __('content.test_signal') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'signal', 'main_route' => 'man.edit', 'model_id' => $man->id, 'relation' => 'signal_has_man']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="signal_has_man" name="id" tableName="signal"
                                :label="__('content.short_signal')"
                                related delete />
                        </div>

                        <div class="btn-div">

                            <label class="form-label">44){{ __('content.passes_signal') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'signal', 'main_route' => 'man.edit', 'model_id' => $man->id, 'relation' => 'man_passed_by_signal']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="man_passed_by_signal" name="id" tableName="signal" :label="__('content.short_signal')"

                                related delete  :edit="['page' =>'signal.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man','relation' => 'car']"/>


                        </div>

                        <div class="btn-div">
                            <label class="form-label">45) {{ __('content.criminal_case') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'criminal_case', 'main_route' => 'man.edit', 'model_id' => $man->id, 'relation' => 'criminal_case']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="criminal_case" name="id" tableName="criminal_case"
                            :label="__('content.short_criminal')"
                                related delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">46) {{ __('content.passes_summary') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'mia_summary', 'main_route' => 'man.edit', 'model_id' => $man->id, 'relation' => 'mia_summary']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="mia_summary" name="id" tableName="mia_summary"
                            :label="__('content.short_mia')"
                                related delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">47) {{ __('content.presence_machine') }}</label>
                            <a

                                href="{{ route('open.page', ['page' => 'car', 'main_route' => 'man.edit','model' => 'man', 'model_id' => $man->id, 'relation' => 'car']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man" relation="car" name="id" :label="__('content.short_car')" tableName="car" related delete :edit="['page' =>'car.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man','relation' => 'car']"/>

                        </div>

                        <div class="btn-div">
                            <label class="form-label">48) {{ __('content.presence_weapons') }}</label>

                            <a href="{{ route('open.page', ['page' => 'weapon', 'main_route' => 'man.edit','model' => 'man', 'model_id' => $man->id, 'relation' => 'weapon']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man"  :label="__('content.short_weapon')" relation="weapon" name="id" tableName="weapon" related  delete :edit="['page' =>'weapon.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man','relation' => 'car']"/>

                        </div>

                        <div class="btn-div">
                            <label class="form-label">49) {{ __('content.uses_machine') }}</label>

                            <a href="{{ route('open.page', ['page' => 'car', 'main_route' => 'man.edit','model' => 'man', 'model_id' => $man->id, 'relation' => 'use_car']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$man"  :label="__('content.short_car')" relation="use_car" name="id" tableName="car" related delete :edit="['page' =>'car.edit', 'main_route' => 'man.edit', 'id' => $man->id, 'model' => 'man','relation' => 'use_car']"/>

                        </div>

                        <!-- File input -->
                        <div class="col d-flex flex-wrap gap-3 modal-toggle-box">
                            <span class="form-label">50) {{ __('content.answer') }}</span>
                            <div class="file-upload-container">
                                <input type="file" class="file-upload" id="answer" data-type="file"
                                    data-model="resource" data-fieldname="name" data-modelName="'has_file'"
                                    data-pivot-table="file1" data-name="{{ route('man.update', $man->id) }}" hidden />
                                <label for="answer" class="file-upload-btn btn btn-secondary h-fit w-fit">
                                    {{ __('content.upload') }}
                                </label>
                                <div class="file-upload-content"></div>
                            </div>
                            <x-tegs :data="$man" relation="file1" name="name" delete />
                        </div>
                        <!-- File input -->
                        <div class="col d-flex flex-wrap gap-3 modal-toggle-box">
                            <span class="form-label">51) {{ __('content.contents_document') }}</span>
                            <div class="file-upload-container">
                                <input type="file" class="file-upload save_input_data" hidden="" multiple=""
                                    id="eRaXbff" />
                                <div class="file-upload-content"></div>
                            </div>
                            @foreach($man->bibliography as $bibliography)
                                <x-tegs :data="$bibliography" relation="files" name="name" scope="miaSummary" scopeParam="0"  delete/>
                            @endforeach
                        </div>

                        <div class="btn-div">
                            <label class="form-label">52) {{ __('content.ties') }}</label>
                            <x-tegs :data="$man" relation="man_has_bibliography" name="title" name="id" :label="__('content.short_bibl')"
                                tableName="bibliography" related delete relationtype="has_many" />
                        </div>
                    </div>

                    <!-- ######################################################## -->
                    <!-- Submit button -->
                    <!-- ######################################################## -->
                </div>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <x-fullscreen-modal />
    <x-file-modal />
    <x-scroll-up />
    <x-large-modal :dataId="$man->id" />
    <x-errorModal />

@section('js-scripts')
    <script>
        let parent_id = "{{ $man->id }}"
        let updated_route = "{{ route('man.update', $man->id) }}"
        let file_updated_route = "{{ route('updateFile', $man->id) }}"
        let delete_item = "{{ route('delete_tag') }}"

        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.man') }}"
    </script>
    <script src='{{ asset('assets/js/man/script.js') }}'></script>
    <script src='{{ asset('assets/js/more_info_popup.js') }}'></script>
    <script src='{{ asset('assets/js/script.js') }}'></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src='{{ asset('assets/js/contact/contact.js') }}'></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
@endsection
@endsection
