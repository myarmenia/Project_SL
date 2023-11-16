@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/police/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Անցնում է ոստիկանության ամփոփագրով</h1>
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
                <p> id: 555</p>

                <!-- Vertical Form -->
                <div class="form">
                    <div class="inputs row g-3">
                    <div class="col">
                            <div class="form-floating input-date-wrapper">

                                <input
                                        type="date"

                                        id="inputDate1"

                                        class="form-control save_input_data"
                                        name="date"
                                        value="{{$miaSummary->date ?? null }}"

                                        data-type="update_field"
                                />
                                <label for="inputDate1" class="form-label"
                                >1)  ամԱմփոփագրի գրանցման ասաթիվ</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>

                        <div class="btn-div col">
                            <label class="form-label">2) Տեղեկատվության բովանդակաություն</label>
                            <button class="btn btn-primary  model-id" data-model-id='{{$miaSummary->id}}' data-type='update_field' data-fieldName='content'  style="font-size: 13px" data-bs-toggle="modal"data-bs-target="#additional_information">{{__('content.addTo')}}</button>
                           @if ($miaSummary->content!==null)
                             <x-one-teg :item="$miaSummary" :inputValue="$miaSummary->content" />
                           @endif


                                <div class ="tegs-div">
                                    <div class="more_data"></div>
                                </div>
                        </div>
                        </div>


                        {{-- <x-tegs :name="'id'" :data="$signal" :relation="'man'" :label="__('content.short_man') . ': '" edit delete /> --}}
                        <div class="btn-div">
                            <label class="form-label">3) Ամփոփագրով անցնող անձինք</label>
                            <a
                            href="{{ route('open.page', ['page' =>'man', 'main_route' => 'mia_summary.edit', 'model_id' => $miaSummary->id, 'relation' => 'man']) }}">{{ __('content.addTo') }}</a>


                            <div class="tegs-div" name="tegsDiv2" id="//btn4"></div>
                        </div>


                        <x-tegs :name="'id'" :data="$miaSummary" :relation="'organization'" :label="__('content.short_organ') . ': '" edit delete />

                        <div class="btn-div">
                            <label class="form-label">4) Ամփոփագրով անցնող կազմակերպություններ</label>
                            <a
                            href="{{ route('open.page', ['page' =>'organization', 'main_route' => 'mia-summary.edit', 'model_id' => $miaSummary->id, 'relation' => 'organization']) }}">{{ __('content.addTo') }}</a>

                            <div class="tegs-div" name="tegsDiv2" id="//btn5"></div>
                        </div>

                        <div class="btn-div">
                            <label class="form-label">5) Փաստաթղթի բովանդակութըունը</label>
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
                    <label class="form-label">6) Կապեր</label>
                    <div class="file-upload-content tegs-div" name="tegsDiv1" id="company-police">
                        <x-teg :name="'id'" :item="$miaSummary->bibliography" inputName="bibliography"  inputValue="$miaSummary->bibliography_id" :label="__('content.short_bibl')"/>
                    </div>
                </div>
                <!-- Vertical Form -->
            </div>
        </div>
    </section>

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>
    <x-file-modal/>

        @section('js-scripts')
            <script>

                let updated_route = `{{ route('mia_summary.update', $miaSummary->id) }}`
                let delete_item = "{{route('delete_tag')}}"
                let parent_id = "{{ $miaSummary->id }}"
            </script>
            <script src="{{ asset('assets/js/script.js') }}"></script>
            <script src="{{ asset('assets/js/tag.js') }}"></script>
            <script src="{{ asset('assets/js/error_modal.js') }}"></script>

            <script src='{{ asset('assets/js/append_doc_content.js') }}'></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.0.1/mammoth.browser.min.js"></script>

        @endsection
    @endsection


