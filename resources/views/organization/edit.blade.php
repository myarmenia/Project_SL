@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/company/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Ընկերություն</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    <li class="breadcrumb-item active model-id" data-model-id='{{$organization->id}}'><b>
                            ID: {{$organization->id}}</b>
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
                <div class="form">
                    <div class="inputs row g-3">

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control save_input_data"
                                    id="name"
                                    placeholder=""
                                    value="{{$organization->name}}"
                                    name="name"
                                    tabindex="1"
                                    data-type="update_field"
                                />
                                <label for="name" class="form-label"
                                >1) Կազմակերպության անվանումը</label
                                >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="country"
                                    placeholder=""
                                    name="country_id"
                                    value="{{$organization->country?->name}}"
                                    tabindex="2"
                                    data-type="update_field"
                                    data-modelid=""
                                    data-table="country"
                                    data-model="country"
                                    data-fieldname='name'
                                    data-pivot-table='country'
                                    list="country-list"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/3"
                                    data-table-name='country'
                                    data-fieldname='name'
                                ></i>
                                <label for="country_id" class="form-label"
                                >2) Երկիր</label
                                >
                            </div>
                            <datalist id="country-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input
                                    type="date"
                                    placeholder=""
                                    value="{{$organization->reg_date}}"
                                    id="reg_date"
                                    tabindex="4"
                                    data-type="update_field"
                                    class="form-control save_input_data"
                                    name="reg_date"
                                />
                                <label for="reg_date" class="form-label">
                                    3) Հիմնադրման ամսաթիվ գրանցում
                                </label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">
                                4) Կազմակերպության, շտաբի գրասենյակի գտնվելու վայրը  (հասցե)
                            </label>
                            <a href="{{ route('page_redirect', ['table_route' => 'address', 'relation' => 'address']) }}">{{__('content.addTo')}}</a>
                            <x-tegs :data="$organization" relation="address" name="id" delete  label="ՀՍՑ : "/>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="country_ate"
                                    placeholder=""
                                    data-id=""
                                    name="country_ate_id"
                                    value="{{$organization->country_ate?->name}}"
                                    tabindex="10"
                                    data-table="country_ate"
                                    data-model="countryAte"
                                    list="country_ate-list"
                                    data-type="update_field"
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
                                >5) Գործունեության տարածաշրջան</label
                                >
                            </div>
                            <datalist id="country_ate-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>


                        <div class="btn-div">
                            <label class="form-label">6) Հայտնի է նաև որպես</label>
                            <a href="{{ route('page_redirect', ['table_route' => 'organization', 'relation' => 'organization_to_organization']) }}">{{__('content.addTo')}}</a>
                            <x-tegs :data="$organization" relation="organization_to_organization" name="id" delete/>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="country_id"
                                    placeholder=""
                                    data-id=""
                                    name="category_id"
                                    value="{{$organization->category?->name}}"
                                    tabindex="10"
                                    data-table="category"
                                    data-model="category"
                                    list="category-list"
                                    data-type="update_field"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='organization_category'
                                    data-fieldname='name'
                                ></i>
                                <label for="country_id" class="form-label"
                                >7) Կազմակերպության կատեգորիա</label>
                            </div>
                            <datalist id="category-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">8) Հեռախոսահամար</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" id="company-phone"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">9) Էլեկտրոնային հասցե (e-mail)</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" id="company-email"></div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control fetch_input_title save_input_data get_datalist"
                                    id="agency"
                                    placeholder=""
                                    data-id=""
                                    name="agency_id"
                                    value="{{$organization->agency?->name }}"
                                    tabindex="10"
                                    data-table="agency"
                                    data-model="countryAte"
                                    list="agency-list"
                                    data-type="update_field"
                                />
                                <i
                                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                                    data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal"
                                    data-url="url/4"
                                    data-table-name='agency'
                                    data-fieldname='name'
                                ></i>
                                <label for="agency" class="form-label"
                                >10) Ստորաբաժանում, որն աշխատել է կազմակերպությամբ</label>
                            </div>
                            <datalist id="agency-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>


                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input
                                    type="number"
                                    placeholder=""
                                    value="{{$organization->employers_count}}"
                                    id="employers_count"
                                    tabindex="4"
                                    data-type="update_field"
                                    class="form-control save_input_data"
                                    name="employers_count"
                                />
                                <label for="employers_count" class="form-label"
                                >11) Աշխատողների կամ անդամների քանակ</label
                                >
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">12) Իրադարձություն</label>
                            <a href="{{ route('page_redirect', ['table_route' => 'event', 'relation' => 'event']) }}">{{__('content.addTo')}}</a>
                            <x-tegs :data="$organization" relation="event" name="id" delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">13) Կապն այլ կազմակերպությունների հետ</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" id="company-liaison"></div>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input
                                    type="text"
                                    placeholder=""
                                    value="{{$organization->attension}}"
                                    id="attension"
                                    tabindex="4"
                                    data-type="update_field"
                                    class="form-control save_input_data"
                                    name="attension"
                                />
                                <label for="attension" class="form-label"
                                >14) Ուշադրություն!</label>
                            </div>
                        </div>


                        <div class="btn-div">
                            <label class="form-label">15) Կեղծ հասցե</label>
                            <a href="{{ route('page_redirect', ['table_route' => 'address', 'relation' => 'dummy_address']) }}">{{__('content.addTo')}}</a>
                            <x-teg :item="$organization" inputName="dummy_address" name="name" label="ՀՍՑ " delete/>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input
                                    type="text"
                                    placeholder=""
                                    value="{{$organization->opened_dou}}"
                                    id="attension"
                                    tabindex="14"
                                    data-type="update_field"
                                    class="form-control save_input_data"
                                    name="opened_dou"
                                />
                                <label for="opened_dou" class="form-label"
                                >16) Կազմակերպության նկատմամբ բացվել է ՕՀԳ</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) Անցնում է քրեական գործով</label>
                            <a href="{{ route('page_redirect', ['table_route' => 'criminal_case', 'relation' => 'criminal_case']) }}">{{__('content.addTo')}}</a>
                            <x-tegs :data="$organization" relation="criminal_case" name="id"  label="ՔՐԳ " delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">18) Գործողության օբյեկտ</label>
                            <a href="{{ route('page_redirect', ['table_route' => 'action', 'relation' => 'action']) }}">{{__('content.addTo')}}</a>
                            <x-tegs :data="$organization" relation="action" name="id"  delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">19) Անձի աշխատավայր</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" id="company-personsWorkplace"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">20) Ստուգվում է ահազանգով</label>
                            <a href="{{ route('page_redirect', ['table_route' => 'signal', 'relation' => 'passed']) }}">{{__('content.addTo')}}</a>
                            <x-tegs :data="$organization" relation="passed" name="id"  delete/>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">21) Անցնում է ահազանգով</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" id="company-PassesAlarm"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">22) Ավտոմեքենայի առկայություն</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" id="company-car"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">23) Զենքի առկայություն</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" id="company-gun"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">24) Անցում ոստիկանության ամփոփագրով</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" id="company-police"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">25) Իրադարձության վայրը (հասցե)</label>
                            <a href="#">Ավելացնել</a>
                            <div class="tegs-div" id="company-police"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">26) Փաստաթղթի բովանդակութըունը</label>
                            <div class="file-upload-content tegs-div">
                                <div class="Myteg">
                                    <span><a href="">dddd</a></span>
                                </div>
                                <div class="Myteg">
                                    <span><a href="">ffff</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">27) Կապեր</label>
                            <div class="tegs-div" id="company-police"></div>
                        </div>

                    </div>

                </div>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>


    @section('js-scripts')
        <script>
            let updated_route = "{{route('organization.update',$organization->id)}}"
            let delete_item = "{{route('delete_tag')}}"
        </script>
        <script src='{{ asset('assets/js/script.js') }}'></script>
        <script src="{{ asset('assets/js/tag.js') }}"></script>
        <script src="{{ asset('assets/js/error_modal.js') }}"></script>
        <script src='{{ asset('assets/js/company/script.js') }}'></script>
    @endsection
@endsection
