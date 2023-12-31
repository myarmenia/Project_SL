@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/police/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/calendar.css') }}">


@endsection
{{-- @php
    $previous_url_name = app('router')
        ->getRoutes()
        ->match(app('request')->create(URL::previous()))
        ->getName();
@endphp --}}

@section('content')

    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">


                <!-- Vertical Form -->
                <x-back-previous-url />
                <div class="form">
                    <div class="inputs row g-3">
                        <div class="col">
                            <div class="form-floating input-date-wrapper calendar-container">

                                <input type="text" data-check="date" id="inputDate1" class="form-control save_input_data calendarInput" name="date"
                                    value="{{ $miaSummary->date ?? null }}" data-type="update_field" 
                                    autocomplete="off" onblur="handleBlur(this)"/>
                                    <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>

                                <input type="date" id="inputDate1" class="form-control save_input_data" name="date"
                                    value="{{ $miaSummary->date ?? null }}" data-type="update_field" />
                                <label for="inputDate1" class="form-label">1) {{ __('content.date_registration_reports') }}</label>
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="btn-div col">
                            <label class="form-label">2) {{ __('content.content_inf') }}</label>
                            <button class="btn btn-primary  model-id" data-model-id='{{ $miaSummary->id }}'
                                data-type='update_field' data-fieldName='content' style="font-size: 13px"
                                data-bs-toggle="modal"data-bs-target="#additional_information">{{ __('content.addTo') }}</button>
                                <x-one-teg :item="$miaSummary" :inputValue="$miaSummary->content" />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">3) {{ __('content.summary_man') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'man', 'main_route' => 'mia_summary.edit', 'model_id' => $miaSummary->id, 'relation' => 'man']) }}">{{ __('content.addTo') }}</a>
                            <x-tegs :name="'id'" :data="$miaSummary" :relation="'man'" :label="__('content.short_man')" tableName="man"
                                related :edit="[
                                    'page' => 'man.edit',
                                    'main_route' => 'mia_summary.edit',
                                    'id' => $miaSummary->id,
                                    'model' => 'miaSummary',
                                ]" delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">4) {{ __('content.summary_organizations') }}</label>
                            <a
                                href="{{ route('open.page', ['page' => 'organization', 'main_route' => 'mia_summary.edit', 'model_id' => $miaSummary->id, 'relation' => 'organization']) }}">{{ __('content.addTo') }}</a>

                            <x-tegs :name="'id'" :data="$miaSummary" :relation="'organization'" :label="__('content.short_organ')"
                                tableName="organization" related :edit="[
                                    'page' => 'organization.edit',
                                    'main_route' => 'mia_summary.edit',
                                    'id' => $miaSummary->id,
                                    'model' => 'miaSummary',
                                ]" delete />
                        </div>

                        <div class="btn-div">
                            <label class="form-label">5) {{ __('content.document_content') }}</label>
                            <div class="file-upload-content tegs-div">
                                <x-tegs :name="'id'" :data="$miaSummary->bibliography" :relation="'files'" :label="__('content.file') . ': '" />
                            </div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">6) {{ __('content.summary_auto') }}</label>
                            <a href="{{ route('bibliography.summery_automatic', ['bibliography_id' => $miaSummary->bibliography->id, 'table' => 'man_passes_mia_summary', 'colum_name' => 'mia_summary_id', 'colum_name_id' => $miaSummary->id]) }}"
                                value="1">Ավելացնել</a>
                            <div class="tegs-div" name="tegsDiv1" id="btn7"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">7) {{ __('content.ties') }}</label>
                            <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police">
                                <x-teg :name="'id'" :item="$miaSummary" relation="bibliography"
                                    inputValue="$miaSummary->bibliography_id" :label="__('content.short_bibl')" tableName="bibliography"
                                    related />
                            </div>
                        </div>
                    </div>
                    <x-men :parentModel="$miaSummary" relation="man" />
                    <!-- Vertical Form -->
                </div>
            </div>
    </section>

    <x-scroll-up />
    <x-fullscreen-modal />
    <x-errorModal />
    <x-file-modal />

@section('js-scripts')
    <script>
        let updated_route = `{{ route('mia_summary.update', $miaSummary->id) }}`
        let delete_item = "{{ route('delete_tag') }}"
        let parent_id = "{{ $miaSummary->id }}"
    </script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/tag.js') }}"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>

    <script src='{{ asset('assets/js/append_doc_content.js') }}'></script>
    <script src='{{ asset('assets/js/main/date.js') }}'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>
@endsection
@endsection
