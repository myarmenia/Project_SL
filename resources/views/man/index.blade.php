@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/man/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Անձ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active model-id" data-model-id='{{$man->id}}'><b> ID: {{$man->id}}</b></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!-- Vertical Form -->
                <div class="form">
                    <div class="inputs row g-3">
                        <div class="col">
                            <x-tegs :data="$man" :relation="'lastName1'" :name="'last_name'" :modelName="'man_has_last_name'" :dataDivId="'inputLastNanme4'" />
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control my-form-control-class intermediate my-teg-class"
                                    id="inputLastNanme4"
                                    placeholder=""
                                    name="last_name"
                                    data-type="create_relation"
                                    data-fieldname='last_name'
                                    data-model="last_name"
                                    data-table="lastName1"
                                    data-parent-model-name='last_name'
                                    data-pivot-table='last_name'
                                    data-parent-model-id ="<?php echo e($man->id); ?>"
                                />

                                <label for="inputLastNanme4" class="form-label"
                                >1) Ազգանուն</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <x-tegs :data="$man" :relation="'firstName1'" :name="'first_name'" :modelName="'man_has_first_name'" :dataDivId="'inputNanme4'"/>
                            <div class="form-floating ">
                                <input
                                    type="text"
                                    class="form-control my-form-control-class intermediate my-teg-class"
                                    id="inputNanme4"
                                    placeholder=""
                                    name="first_name"
                                    data-type="create_relation"
                                    data-fieldname='first_name'
                                    data-model="firstName1"
                                    data-table="has_first_name"
                                    data-parent-model-name='first_name'
                                    data-pivot-table='first_name'
                                    data-parent-model-id ="<?php echo e($man->id); ?>"
                                />
                                <label for="inputNanme4" class="form-label">2) Անուն</label>
                            </div>
                        </div>
                        <div class="col">
                            <x-tegs :data="$man" :relation="'middleName1'" :name="'middle_name'" :modelName="'man_has_middle_name'" :dataDivId="'middle_name'"/>
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control my-form-control-class intermediate my-teg-class"
                                    id="inputMiddleName"
                                    placeholder=""
                                    name="middle_name"
                                    data-type="create_relation"
                                    data-fieldname='middle_name'
                                    data-model="middleName1"
                                    data-table="has_middle_name"
                                    data-parent-model-name='middle_name'
                                    data-pivot-table='middle_name'
                                    data-parent-model-id ="<?php echo e($man->id); ?>"
                                />
                                <label for="inputMiddleName" class="form-label"
                                >3) Հայրանուն</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="fullName"
                                    placeholder=""
                                    readonly=""
                                    tabindex="-1"
                                    name="inp4"
                                />
                                <label for="fullName" class="form-label"
                                >4) Ազգանուն Անուն Հայրանուն</label
                                >
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">5) Հայտնի է որպես անուն</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv1" id="users">дерфтгыху</div>
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
                                    data-type="update_field"
                                    class="form-control"
                                    name="birthday"
                                />
                                <label for="inputDate1" class="form-label"
                                >6) Ծննդյան տարեթիվ (օր, ամիս, տարի)</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>
                        <!-- Inputs -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="inputDate2"
                                    data-type="update_field"
                                    placeholder=""
                                    value="{{$man->birthday_str ?? null }}"
                                    name="birthday_str"
                                />
                                <label for="inputDate2" class="form-label"
                                >7) Ծննդյան մոտավոր տարեթիվ</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <x-tegs :data="$man" :relation="'passport'" :name="'number'" :modelName="'man_has_passport'" :dataDivId="'last_name'"/>
                            <div class="form-floating">
                               <input
                                    type="text"
                                    class="form-control my-form-control-class intermediate"
                                    id="passport"
                                    placeholder=""
                                    name="number"
                                    data-type="create_relation"
                                    data-fieldname='number'
                                    data-table="passport"
                                    data-model="passport"
                                    data-parent-model-name='passport'
                                    data-pivot-table='passport'
                                    data-parent-model-id ="<?php echo e($man->id); ?>"
                                />
                                <label for="passport" class="form-label"
                                >8) Անձնագրի համարը</label
                                >
                            </div>
                        </div>
                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title" id="item1"
                                    placeholder=""
                                    value="{{$man->gender->name ?? null }}"
                                    name="gender_id"
                                    data-type="update_field"
                                    list="gender"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/1"
                                    data-table-name='gender'
                                    data-fieldname ='name'
                                ></i>
                                <label for="item1" class="form-label"
                                >9) Սեռ</label
                                >
                            </div>
                            <datalist id="gender" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title "
                                    id="nation"
                                    placeholder=""
                                    value="{{$man->nation->name ?? null }}"
                                    data-type="update_field"
                                    name="nation_id"
                                    list="nation"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/2"
                                    data-table-name='nation'
                                    data-fieldname ='name'
                                ></i>
                                <label for="nation" class="form-label"
                                >10) Ազգություն</label
                                >
                            </div>

                        </div>

                        <div class="col">

                            <x-tegs :data="$man" :relation="'country'" :name="'name'" :modelName="'country'"/>

                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title intermediate"
                                    id="country"
                                    placeholder=""
                                    name="name"
                                    list="country"
                                    data-type="attach_relation"
                                    data-table="country"
                                    data-model="country"
                                    data-fieldname='name'
                                    data-parent-model-name='country'
                                    data-pivot-table='country'
                                    data-parent-model-id ="<?php echo e($man->id); ?>"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/3"
                                    data-table-name='country'
                                    data-fieldname ='name'
                                ></i>
                                <label for="country" class="form-label"
                                >11) Քաղաքացիություն</label
                                >
                            </div>
                            <datalist id="country" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title intermediate"
                                    id="country_ate"
                                    placeholder=""
                                    data-id=""
                                    name="name"
                                    value="{{$man->bornAddress->countryAte->name ?? null }}"
                                    data-type="location"
                                    data-table="country_ate_id"
                                    data-model="countryAte"
                                    list="country_ate"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='country_ate'
                                    data-fieldname ='name'
                                ></i>
                                <label for="country_ate" class="form-label"
                                >12) Ծննդավայր (երկիր, ՎՏՄ)</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title intermediate"
                                    id="beanCountryRegion"
                                    placeholder=""
                                    data-id=""
                                    name="name"
                                    value="{{$man->beanCountry->region->name ?? null }}"
                                    data-table="region"
                                    data-model="beanCountry"
                                    list="beanCountryRegion"
                                    data-type="local"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='region'
                                    data-fieldname ='name'
                                ></i>
                                <label for="beanCountryRegion" class="form-label"
                                >13) Ծննդավայր (մարզ, տեղական)</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title intermediate"
                                    id="beanCountryLocality"
                                    placeholder=""
                                    data-id=""
                                    name="name"
                                    value="{{$man->beanCountry->locality->name ?? null }}"
                                    data-table="locality"
                                    data-model="beanCountryLocality"
                                    data-type="local"
                                    list="beanCountryLocality"/>
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='locality'
                                    data-fieldname ='name'
                                ></i>
                                <label for="beanCountryLocality" class="form-label"
                                >14) Ծննդավայր (բնակավայր, տեղական)</label
                                >
                            </div>
                        </div>

                        <!-- Inputs -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control intermediate"
                                    id="inputDate2"
                                    placeholder=""
                                    value="{{$man->bornAddress->region->name ?? null }}"
                                    name="name"
                                    data-relation="region"
                                    data-table="region_id"
                                    data-model="region"
                                    data-location="1"
                                />
                                <label for="inputDate2" class="form-label"
                                >15) Ծննդավայր (շրջան)</label
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control intermediate"
                                    id="inputPassportNumber1"
                                    placeholder=""
                                    value="{{$man->bornAddress->locality->name ?? null }}"
                                    name="name"
                                    data-relation="locality"
                                    data-table="locality_id"
                                    data-model="locality"
                                    data-location="1"
                                />
                                <label for="inputPassportNumber1" class="form-label"
                                >16) Ծննդավայր (բնակավայր)</label
                                >
                            </div>
                        </div>

                        <div class="col">

                            <x-tegs :data="$man" :relation="'knows_languages'" :name="'name'" :modelName="'language'"/>

                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control fetch_input_title intermediate"
                                        id="language"
                                        placeholder=""
                                        name="language_id"
                                        list="language"
                                        data-type="attach_relation"
                                        data-table="knows_languages"
                                        data-model="language"
                                        data-fieldname='name'
                                        data-parent-model-name = 'Man'
                                        data-pivot-table = 'knows_languages'
                                        data-parent-model-id ="<?php echo e($man->id); ?>"
                                />
                                <i
                                        class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fullscreenModal"
                                        data-url="url/3"
                                        data-table-name='language'
                                        data-fieldname ='name'
                                ></i>
                                <label for="language" class="form-label"
                                >17) Լեզուների Իմացություն</label>
                            </div>
                            <datalist id="language" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">18) Անձի բնակության վայրը</label>
                            <a href="{{route('person-address.create',$man->id)}}">Ավելացնել</a>
                            <div class="tegs-div" id="address"></div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">19) Հեռախոսահամար</label>
                            <a href="{{route('phone.create',$man->id)}}">Ավելացնել</a>
                            <div class="tegs-div"  id="phoneNumber"></div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">20) Էլեկտրոնային հասցե (e-mail)</label>
                            <a href="{{route('email.create',$man->id)}}">Ավելացնել</a>
                            <div class="tegs-div" id="email"></div>
                        </div>

                        <!-- Inputs -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control"
                                        id="attention"
                                        placeholder=""
                                        value="{{$man->attention ?? null }}"
                                        name="attention"
                                        data-type="update_field"
                                />
                                <label class="form-label">21) Ուշադրություն</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">22) Լրացուցիչ տեղեկություններ անձի վերաբերյալ</label>
                            <button class="btn btn-primary" style="font-size: 13px" data-bs-toggle="modal"
                                    data-bs-target="#additional_information">Ավելացնել
                            </button>
                            <div class="tegs-div"></div>
                        </div>

                        <!-- Select -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="religion"
                                    placeholder=""
                                    value="{{$man->religion->name ?? null }}"
                                    name="religion_id"
                                    data-type="update_field"
                                    list="religion"
                                    data-model="religion"
                                />
                                <i
                                        class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                        data-bs-toggle="modal"
                                        data-bs-target="#fullscreenModal"
                                        data-url="url/1"
                                        data-table-name='religion'
                                        data-fieldname ='name'
                                ></i>

                                <label for="religion" class="form-label"
                                >23) Կրոն</label
                                >
                            </div>
                            <datalist id="religion" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <!-- Input -->
                        <div class="col">
                            <div class="form-floating">
                                <input type="text"
                                       class="form-control"
                                       placeholder=""
                                       id="occupation"
                                       value="{{$man->occupation ?? null }}"
                                       data-type="update_field"
                                       name="occupation"
                                />
                                <label class="form-label">24) Զբաղմունք</label>
                            </div>
                        </div>
                        <!-- Selects -->
                        <div class="col">

                            <x-tegs :data="$man" :relation="'operationCategory'" :name="'name'" :modelName="'operationCategory'"/>

                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title intermediate"
                                    id="operation_category"
                                    placeholder=""
                                    name="name"
                                    data-type="attach_relation"
                                    data-fieldname="name"
                                    list="operation_category"
                                    data-table="operationCategory"
                                    data-model="operationCategory"
                                    data-parent-model-name = 'Man'
                                    data-pivot-table = 'operationCategory'
                                    data-parent-model-id ="<?php echo e($man->id); ?>"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/3"
                                    data-table-name='operation_category'
                                    data-fieldname ='name'
                                ></i>
                                <label for="operation_category" class="form-label"
                                >25) Անձի Օպերատիվ կատեգորիա</label
                                >
                            </div>
                            <datalist id="operation_category" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <div class="col">

                            <x-tegs :data="$man" :relation="'countrySearch'" :name="'name'" :modelName="'countrySearch'"/>

                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title intermediate"
                                    id="country_search_man"
                                    placeholder=""
                                    name="name"
                                    data-type="attach_relation"
                                    data-fieldname="name"
                                    list="country"
                                    data-table="countrySearch"
                                    data-model="country"
                                    data-parent-model-name='Man'
                                    data-pivot-table='countrySearch'
                                    data-parent-model-id ="<?php echo e($man->id); ?>"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/3"
                                    data-table-name='country'
                                    data-fieldname ='name'

                                ></i>
                                <label for="country_search_man" class="form-label"
                                >26) Հետախուզում իրականացնող երկիրը</label
                                >
                            </div>
                            <datalist id="country_search_man" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <!-- Date Inputs -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <!-- <label role="value"></label>
                                <input type="text" hidden role="store"/> -->
                                <input type="date" placeholder=""
                                       value="{{$man->start_wanted ?? null }}"
                                       class="form-control"
                                       name="start_wanted"
                                       data-type="update_field"
                                />
                                <label class="form-label"
                                >27) Հետազոտումը հայտարարվել է</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder=""
                                       class="form-control"
                                       name="entry_date"
                                       value="{{$man->entry_date ?? null }}"
                                       data-type="update_field"
                                />
                                <label class="form-label"
                                >28) ՀՀ տարածք մուտք գործելու վերահսկման սկիզբ
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date"
                                       placeholder=""
                                       class="form-control"
                                       name="exit_date"
                                       value="{{$man->exit_date ?? null }}"
                                       data-type="update_field"
                                />
                                <label class="form-label">29) ՀՀ տարածք մուտք գործելու վերահսկման ավարտ</label>
                            </div>
                        </div>
                        <!-- Selects -->
                        <div class="col">
                            <x-tegs :data="$man" :relation="'education'" :name="'name'" :modelName="'man_has_education'" :dataDivId="'last_name'"/>
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title intermediate"
                                    id="education"
                                    placeholder=""
                                    name="name"
                                    data-type="attach_relation"
                                    data-fieldname="name"
                                    list="education"
                                    data-table="education"
                                    data-model="education"
                                    data-parent-model-name='Man'
                                    data-pivot-table='education'
                                    data-parent-model-id ="<?php echo e($man->id); ?>"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/3"
                                    data-table-name='education'
                                    data-fieldname ='name'
                                ></i>
                                <label for="education" class="form-label"
                                >30) Կրթություն։ Գիտական աստիճան, կոչում</label
                                >
                            </div>
                            <datalist id="language" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <div class="col">
                            <x-tegs :data="$man" :relation="'party'" :name="'name'" :modelName="'has_party'" :dataDivId="'last_name'"/>
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title intermediate"
                                    id="party"
                                    placeholder=""
                                    name="name"
                                    data-type="attach_relation"
                                    data-fieldname="name"
                                    list="party"
                                    data-table="party"
                                    data-model="party"
                                    data-parent-model-name='Man'
                                    data-pivot-table='party'
                                    data-parent-model-id ="<?php echo e($man->id); ?>"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/3"
                                    data-table-name='party'
                                    data-fieldname ='name'
                                ></i>
                                <label for="party" class="form-label"
                                >31) Կուսակցական պատկանելություն</label
                                >
                            </div>
                            <datalist id="language" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">32) Անձի աշխատանքային գործունեություն</label>
                            <a href="{{route('organization.create', $man->id)}}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv5"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">33) Արտասահմանում Գտնվելը</label>
                            <a href="{{route('organization.create',$man->id)}}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv6"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">34) Արտաքին նշաններ</label>
                            <a href="{{route('sign.create', $man->id)}}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv7"></div>
                        </div>

                        <!-- To open modal """fullscreenModal""" with File input-->
                        <div class="btn-div">
                            <label class="form-label">35) Արտաքին նշաններ (լուսանկար)</label>
                            <a href="{{route('sign-image.create', $man->id)}}">Ավելացնել</a>
                            <div class="tegs-div"></div>
                        </div>
                        <!-- Input -->
                        <div class="col">
                            <x-tegs :data="$man" :relation="'nickName'" :name="'name'" :modelName="'has_nickname'" :dataDivId="'last_name'"/>
                            <div class="form-floating">
                                <input type="text" class="form-control my-form-control-class  intermediate"
                                       placeholder=""
                                       id="nickName"
                                       name="name"
                                       data-type="create_relation"
                                       data-fieldname="name"
                                       data-model="nickname"
                                       data-table="has_nickname"
                                       data-parent-model-name='nickname'
                                       data-pivot-table='nickname'
                                       data-parent-model-id ="<?php echo e($man->id); ?>"
                                />
                                <label class="form-label" for="nickName">36) Ծածկանուն</label>
                            </div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">37) Օպերատիվ հետաքրքրություն ներկայացնող կապեր (անձ)</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv9"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">38) Օպերատիվ հետաքրքրություն ներկայացնող կապեր
                                (Կազմակերպություն)</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv10"></div>
                        </div>

                        <!-- Input -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="text"
                                        class="form-control"
                                        placeholder=""
                                        id="opened_dou"
                                        value="{{$man->opened_dou ?? null }}"
                                        name="opened_dou"
                                        data-type="update_field"
                                />
                                <label class="form-label">39) Անձի նկատմամբ բացվել է ՕՀԳ</label>
                            </div>
                        </div>
                        <div class="btn-div">
                            <label class="form-label">40) Գործողության մասնակից</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">41) Առնչվում է իրադարձությանը</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div"></div>
                        </div>

                        <!-- Selects -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title"
                                    id="resource"
                                    placeholder=""
                                    value="{{$man->resource->name ?? null }}"
                                    name="resource_id"
                                    list="resource"
                                    data-model="resource"
                                    data-type="update_field"
                                    data-fieldname="name"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/1"
                                    data-table-name='resource'
                                    data-fieldname ='name'
                                ></i>

                                <label for="resource" class="form-label"
                                >42) Տեղեկատվության աղբյուր</label>
                            </div>
                            <datalist id="religion" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">43) Հանդիսանում է ահազանգի ստուգման օբյեկտ</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv13"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">44) Անցնում է ահազանգով</label>
                            <a href="{{route('signal.create',$man->id)}}">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv14"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">45) Հարուցվել է քրեական գործ</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv15"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">46) Անցնում է ոստիկանության ամփոփագրով</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv16"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">47) Ավտոմեքենայի առկայություն</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv17"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">48) Զենքի առկայություն</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv18"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">49) Օգտագործվող ավտոմեքենա</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv19"></div>
                        </div>


                        <!-- File input -->
                        <div class="col d-flex flex-wrap gap-3 modal-toggle-box">
                            <span class="form-label">50) Պատասխան</span>
                            <div class="file-upload-container">
                                <input
                                    type="file"
                                    class="file-upload"
                                    hidden
                                    multiple
                                    placaholder=""
                                />
                                <label
                                    class="file-upload-btn btn btn-secondary h-fit w-fit"
                                >
                                    Բեռնել
                                </label>
                                <div class="file-upload-content"></div>
                            </div>
                        </div>
                        <!-- File input -->
                        <div class="col d-flex flex-wrap gap-3 modal-toggle-box">
                            <span class="form-label">51) Փաստաթղթի բովանդակութըունը</span>
                            <div class="file-upload-container">
                                <input
                                    type="file"
                                    class="file-upload"
                                    hidden=""
                                    multiple=""
                                    id="eRaXbff"
                                    placaholder="a"
                                />
                                <label
                                    class="file-upload-btn btn btn-secondary h-fit w-fit"
                                    for="eRaXbff"
                                >
                                    Բեռնել
                                </label>
                                <div class="file-upload-content"></div>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">52) Կապեր</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv20">
                                <div class="Myteg">
                                    <span>kkkk</span>
                                    <span>X</span>
                                </div>
                            </div>
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
    
    <x-fullscreen-modal/>
    <x-file-modal/>
    <x-scroll-up/>
    <x-large-modal :dataId="$man->id"/>
    <x-errorModal/>
    @section('js-scripts')
        <script>
            let lang="{{app()->getLocale()}}"
            let open_modal_url="{{route('open.modal')}}"
            let get_filter_in_modal = "{{route('get-model-filter')}}"
            let updated_route ="{{route('man.update',$man->id)}}"
            let file_updated_route ="{{ route('updateFile',$man->id)}}"
            let delete_item="{{route('del-model-item')}}"

        </script>
        <script src='{{ asset('assets/js/man/script.js') }}'></script>
        <script src='{{ asset('assets/js/script.js') }}'></script>
        <script src="{{ asset('assets/js/tag.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
        <script src="{{ asset('assets/js/error_modal.js') }}"></script>


    @endsection
@endsection
