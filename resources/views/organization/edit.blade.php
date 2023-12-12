@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/company/style.css') }}">
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
                <x-form-error />
                <x-back-previous-url />
                <div class="form">
                    <div class="inputs row g-3">

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control save_input_data" id="name" placeholder=""
                                    value="{{ $organization->name }}" name="name" tabindex="1"
                                    data-type="update_field" />
                                <label for="name" class="form-label">1) {{ __('content.name_organization') }}</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="country" placeholder="" name="country_id"
                                    value="{{ $organization->country?->name }}" tabindex="2" data-type="update_field"
                                    data-table="country" data-model="country" data-fieldname='name' list="country-list" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/3" data-table-name='country'
                                    data-fieldname='name'></i>
                                <label for="country_id" class="form-label">2) {{ __('content.nation') }}</label>
                            </div>
                            <datalist id="country-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="date" placeholder="" value="{{ $organization->reg_date }}" id="reg_date"
                                    tabindex="4" data-type="update_field" class="form-control save_input_data"
                                    name="reg_date" />
                                <label for="reg_date" class="form-label">
                                    3) {{ __('content.date_formation') }}
                                </label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">
                                4) {{ __('content.dislocation_organization') }}
                            </label>
                            <a href="{{ route('open.page', ['page' => 'address', 'main_route' => 'organization.edit','model' => 'organization', 'model_id' => $organization->id, 'relation' => 'address']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$organization" relation="address" name="id" tableName="address" related delete
                                :label="__('content.short_address')" :edit="[
                                    'page' => 'address.edit',
                                    'main_route' => 'organization.edit',
                                    'id' => $organization->id,
                                    'model' => 'organization',
                                ]" />
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="country_ate" placeholder="" name="country_ate_id"
                                    value="{{ $organization->country_ate?->name }}" tabindex="10" data-table="country_ate"
                                    data-model="countryAte" list="country_ate-list" data-type="update_field" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4" data-table-name='country_ate'
                                    data-fieldname='name'></i>
                                <label for="country_ate" class="form-label">5) {{ __('content.region_activity') }}</label>
                            </div>
                            <datalist id="country_ate-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>


                        <div class="btn-div">
                            <label class="form-label">6) {{ __('content.also_known_as') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'organization', 'main_route' => 'organization.edit', 'model_id' => $organization->id, 'relation' => 'organization_to_organization']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_organization')" :data="$organization" relation="organization_to_organization" tableName="organization"
                                related name="id" delete />
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="country_id" placeholder="" data-id="" name="category_id"
                                    value="{{ $organization->category?->name }}" tabindex="10" data-table="category"
                                    data-model="category" list="category-list" data-type="update_field" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4"
                                    data-table-name='organization_category' data-fieldname='name'></i>
                                <label for="country_id" class="form-label">7)
                                    {{ __('content.category_organization') }}</label>
                            </div>
                            <datalist id="category-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">8) {{ __('content.telephone_number') }}</label>
                            <a
                                href="{{ route('phone.create', ['model' => 'organization', 'id' => $organization->id]) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$organization" relation="phone" name="number" tableName="phone" related
                            :label="__('content.short_phone')":label="__('content.short_address')" :edit="['page' =>'phone.edit', 'main_route' => 'organization.edit', 'id' => $organization->id, 'model' => 'organization']" delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">9) {{ __('content.mail_address') }}</label>
                            <a href="{{ route('email.create', ['model' => 'organization', 'id' => $organization->id]) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_email')" :data="$organization" relation="email" name="address" tableName="email" related delete/>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control fetch_input_title save_input_data get_datalist"
                                    id="agency" placeholder="" data-id="" name="agency_id"
                                    value="{{ $organization->agency?->name }}" tabindex="10" data-table="agency"
                                    data-model="countryAte" list="agency-list" data-type="update_field" />
                                <i class="bi bi-plus-square-fill icon icon-base my-plus-class" data-bs-toggle="modal"
                                    data-bs-target="#fullscreenModal" data-url="url/4" data-table-name='agency'
                                    data-fieldname='name'></i>
                                <label for="agency" class="form-label">10)
                                    {{ __('content.security_organization') }}</label>
                            </div>
                            <datalist id="agency-list" class="input_datalists" style="width: 500px;">
                                <option></option>
                            </datalist>
                        </div>


                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="number" placeholder="" value="{{ $organization->employers_count }}"
                                    id="employers_count" tabindex="4" data-type="update_field"
                                    class="form-control save_input_data" name="employers_count" />
                                <label for="employers_count" class="form-label">11)
                                    {{ __('content.number_worker') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">12) {{ __('content.event') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'event', 'main_route' => 'organization.edit', 'model_id' => $organization->id, 'relation' => 'event']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_event')" :data="$organization" relation="event" name="id" tableName="event" related delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">13) {{ __('content.relation_organization') }}</label>
                            <a
                                href="{{ route('objectsRelation.create', ['model' => 'organization', 'id' => $organization->id, 'redirect' => 'organization']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$organization" relation="objects_relation_to_first_object" name="second_object_id"
                                tableName="objects_relation_to_first_object" related relationtype="has_many" delete />
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="text" placeholder="" value="{{ $organization->attension }}"
                                    id="attension" tabindex="4" data-type="update_field"
                                    class="form-control save_input_data" name="attension" />
                                <label for="attension" class="form-label">14) {{ __('content.attention') }}</label>
                            </div>
                        </div>


                        <div class="btn-div">
                            <label class="form-label">15) {{ __('content.dummy_address') }}</label>
                            <a href="{{ route('open.page', ['page' => 'address', 'main_route' => 'organization.edit','model' => 'organization', 'model_id' => $organization->id, 'relation' => 'dummy_address']) }}">{{ __('content.addTo') }}</a>
                            <x-teg :item="$organization" inputName="dummy_address" name="id" tableName="dummy_address" related
                                :label="__('content.short_address')" delete :edit="['page' =>'address.edit', 'main_route' => 'organization.edit', 'id' => $organization->id, 'model' => 'organization']"  />
                        </div>

                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input type="text" placeholder="" value="{{ $organization->opened_dou }}"
                                    id="attension" tabindex="14" data-type="update_field"
                                    class="form-control save_input_data" name="opened_dou" />
                                <label for="opened_dou" class="form-label">16)
                                    {{ __('content.organization_dow') }}</label>
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">17) {{ __('content.passes_criminal_case') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'criminal_case', 'main_route' => 'organization.edit', 'model_id' => $organization->id, 'relation' => 'criminal_case']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :data="$organization" relation="criminal_case" name="id" tableName="criminal_case"
                                related :label="__('content.short_criminal')" delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">18) {{ __('content.object_actions') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'action', 'main_route' => 'organization.edit', 'model_id' => $organization->id, 'relation' => 'action']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_action')" :data="$organization" relation="action" name="id" tableName="action" related
                                delete />
                        </div>

                        <div class="btn-div">

                            <label class="form-label">19) {{__('content.place_work_persons')}}</label>
                            <a href="{{route('work.create',['model' => 'organization','id'=>$organization->id,'redirect' => 'organization' ])}}">{{__('content.addTo')}}</a>
                             <x-tegs :label="__('content.short_work_activity')" :data="$organization" relation="organization_has_man" tableName="organization_has_man"
                                related name="man_id" delete :edit="['page' =>'work.edit', 'main_route' => 'organization.edit', 'id' => $organization->id, 'model' => 'organization']"/>

                        </div>

                        <div class="btn-div">
                            <label class="form-label">20) {{ __('content.checked_signal') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'signal', 'main_route' => 'organization.edit', 'model_id' => $organization->id, 'relation' => 'signal']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_signal')" :data="$organization" relation="signal" name="id" tableName="signal" related
                                delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">21) {{ __('content.passes_signal') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'signal', 'main_route' => 'organization.edit', 'model_id' => $organization->id, 'relation' => 'passed']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_signal')" :data="$organization" relation="passed" name="id" tableName="signal" related
                                delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">22) {{ __('content.presence_machine') }}</label>
                            <a  href="{{ route('open.page', ['page' => 'car', 'main_route' => 'organization.edit', 'model' => 'organization','model_id' => $organization->id, 'relation' => 'car']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_car')" :data="$organization" relation="car" name="id" tableName="car" related delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">23) {{ __('content.presence_weapons') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'weapon', 'main_route' => 'organization.edit', 'model_id' => $organization->id, 'relation' => 'weapon']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_weapon')" :data="$organization" relation="weapon" name="id" tableName="weapon" related
                                delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">24) {{ __('content.pol') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'mia_summary', 'main_route' => 'organization.edit', 'model_id' => $organization->id, 'relation' => 'mia_summary']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_mia')" :data="$organization" relation="mia_summary" name="id" tableName="mia_summery"
                                related delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">25) {{ __('content.place_event_is') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'event', 'main_route' => 'organization.edit', 'model_id' => $organization->id, 'relation' => 'event']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :label="__('content.short_event')" :data="$organization" relation="event" name="id" tableName="event" related
                                delete />
                        </div>

                        <div class="btn-div">

                            <label class="form-label">26) {{ __('content.contents_document') }}</label>
                            @foreach($organization->bibliography as $bibliography)
                                <x-tegs  :data="$bibliography" relation="files" name="name" scope="miaSummary" scopeParam="0"  delete/>
                            @endforeach

                        </div>
                        <div class="btn-div">
                            <label class="form-label">27) {{ __('content.ties') }}</label>
                            <div class="tegs-div" id="company-police"></div>
                            <x-tegs :data="$organization" relation="bibliography" name="id" :label="__('content.short_bibl')"
                                    tableName="bibliography" related delete relationtype="has_many" />

                        </div>
                    </div>
                </div>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />

@section('js-scripts')
    <script>
        let parent_id = "{{ $organization->id }}"
        let updated_route = "{{ route('organization.update', $organization->id) }}"
        let delete_item = "{{ route('delete_tag') }}"


        let parent_table_name = "{{ __('content.organization') }}"
    </script>
    <script src='{{ asset('assets/js/script.js') }}'></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
    <script src='{{ asset('assets/js/company/script.js') }}'></script>
@endsection
@endsection
