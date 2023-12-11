@extends('layouts.auth-app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/alarm-handling/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/open-modal.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
@endsection
@inject('carbon', 'Carbon\Carbon')
@php
    $previous_url_name =  app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();
@endphp

@section('content')

<div class="pagetitle-wrapper">
        <div class="pagetitle">
          <h1>{{__('content.keep_signal')}}</h1>
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">{{ __('pagetitle.main') }}</a></li>
                <li class="breadcrumb-item">
                    @if ($previous_url_name == 'signal.edit')
                        <a href="{{route('keepSignal.edit', $keepSignal->signal_id)}}">{{__('content.signal')  ." ID: $keepSignal->signal_id"}}</a>
                    @else
                        <a href="{{route('open.page', 'signal')}}"> {{__('content.signal')}}</a>
                    @endif
                <li class="breadcrumb-item active">{{__('content.keep_signal') ." ID: $keepSignal->id "}}</li>

            </ol>
        </nav>
        </div>
</div>
      <!-- End Page Title -->

      <section class="section">
        <div class="card">
          <div class="card-body">
            <!-- Vertical Form -->
              <x-back-previous-url />
            <form class="form">
              <div class="inputs row g-3">

              <div class="col">
                  <div class="form-floating">
                    <input type="text"
                      class="form-control fetch_input_title save_input_data get_datalist"
                        value="{{ $keepSignal->agency->name ?? null }}"
                        name="agency_id"
                        data-type="update_field"
                        data-modelid="{{ $keepsignal->agency_id  ?? null }}"
                        tabindex=1
                        list="brow1"
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-table-name="agency"
                    data-fieldname='name'
                  ></i>
                    <label for="item1" class="form-label"
                      >1) {{ __('content.management_signal') }}</label
                    >
                  </div>
                  <datalist id="brow1" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input type="text"
                        class="form-control fetch_input_title save_input_data get_datalist"
                        value="{{ $keepSignal->unit_agency->name ?? null }}"
                        name="unit_id"
                        data-type="update_field"
                        data-modelid="{{ $keepsignal->unit_id   ?? null }}"
                        list="brow2"
                        tabindex=2
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"

                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-table-name="agency"
                    data-fieldname='name'
                  ></i>
                    <label for="item2" class="form-label"
                      >2) {{ __('content.department_checking_signal') }}</label
                    >
                  </div>
                  <datalist id="brow2" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input type="text"
                      class="form-control fetch_input_title save_input_data get_datalist"
                      id="item3"
                      value="{{ $keepSignal->subunit_agency->name ?? null }}"
                      name="sub_unit_id"
                      data-type="update_field"
                      data-modelid="{{ $keepsignal->sub_unit_id    ?? null }}"
                      list="brow3"
                      tabindex=3


                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-table-name="agency"
                    data-fieldname='name'
                  ></i>
                    <label for="item3" class="form-label"
                      >3) {{ __('content.unit_signal') }}</label
                    >
                  </div>
                  <datalist id="brow3" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                    <x-tegs :data="$keepSignal" :relation="'worker'" :name="'worker'"/>

                  <div class="tegs-div"></div>
                  <div class="form-floating">
                    <input type="text"
                      class="form-control fetch_input_title save_input_data get_datalist"
                      data-type="create_relation"
                      data-model="worker"
                      name="worker"
                      data-fieldname='worker'
                      tabindex=4
                    />
                    <label for="item4" class="form-label"
                      >4) {{ __('content.name_operatives') }}</label
                    >
                  </div>
                </div>

                <div class="col">
                    <x-tegs :data="$keepSignal" :relation="'worker_post'" :name="'name'" delete/>
                  <div class="form-floating">
                    <input
                      type="text"
                      class="form-control fetch_input_title save_input_data get_datalist"
                      id="item5"
                      data-type="attach_relation"
                      data-model="WorkerPost"
                      data-table="worker_post"
                      data-pivot-table="worker_post"
                      data-fieldname ='name'
                      list="brow4"
                      tabindex=5
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-table-name="worker_post"
                    data-fieldname='name'
                  ></i>
                    <label for="item5" class="form-label"
                      >5) {{ __('content.worker_post') }}</label
                    >
                  </div>
                  <datalist id="brow4" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="col">
                  <div class="form-floating input-date-wrapper">
                    <!-- <div class="input-date-wrapper"> -->
                    <!-- <label for="inputDate1" role="value"></label>
                    <input type="text" hidden role="store" /> -->
                    <input  type="date"
                      class="form-control fetch_input_title save_input_data get_datalist"
                        name="start_date"
                        data-type="update_field"
                        value="{{ $keepSignal->start_date ?? null }}"
                        id="item6"
                        tabindex=6
                    />
                    <label for="item6" class="form-label"
                      >6) {{ __('content.start_checking_signal') }}</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating input-date-wrapper">
                    <!-- <div class="input-date-wrapper"> -->
                    <!-- <label for="inputDate1" role="value"></label>
                    <input type="text" hidden role="store" /> -->
                    <input type="date"
                        class="form-control fetch_input_title save_input_data get_datalist"
                        name="end_date"
                        data-type="update_field"
                        value="{{ $keepSignal->end_date ?? null }}"
                        tabindex=7
                        id="item7"


                    />
                    <label for="item7" class="form-label"
                      >7) {{ __('content.end_checking_signal') }}</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating input-date-wrapper">
                    <!-- <div class="input-date-wrapper"> -->
                    <!-- <label for="inputDate1" role="value"></label>
                    <input type="text" hidden role="store" /> -->
                    <input
                      type="date"
                        class="form-control fetch_input_title save_input_data get_datalist"
                        name="pass_date"
                        data-type="update_field"
                        value="{{ $keepSignal->pass_date ?? null }}"
                        id="item8"
                        tabindex=8
                    />
                    <label for="item8" class="form-label"
                      >8) {{ __('content.date_transfer_unit') }}</label
                    >
                  </div>
                </div>

                <div class="col">
                  <div class="form-floating">
                    <input type="text"
                      class="form-control fetch_input_title save_input_data get_datalist"
                      id="item9"
                      value="{{ $keepSignal->passed_subunit_agency->name ?? null }}"
                      name="pased_sub_unit"
                      data-type="update_field"
                      list="brow5"
                      tabindex=9
                    />
                    <i
                    class="bi bi-plus-square-fill icon icon-base my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-table-name="agency"
                    data-fieldname='name'
                  ></i>
                    <label for="item9" class="form-label"
                      >9) {{ __('content.unit_signal_transmitted') }}</label
                    >
                  </div>
                  <datalist id="brow5" class="input_datalists" style="width: 500px;">

                  </datalist>
                </div>

                <div class="btn-div">
                    <label class="form-label">10) {{ __('content.ties') }}</label>
                    <div class="file-upload-content tegs-div" id="company-police">
                        <x-teg :name="'id'" :item="$keepSignal" inputName="signal"  inputValue="$keepSignal->signal_id" :label="__('content.short_signal')"/>
                    </div>
                </div>

              </div>
            </form>

            <!-- Vertical Form -->
          </div>
        </div>
        </section>

    <input type="hidden"  id="file_updated_route" value="">
    <input type="hidden"  id="deleted_route" value=""  data-pivot-table = "file">

    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script>

            let updated_route = `{{ route('keepSignal.update', $keepSignal->id) }}`
            let parent_id = "{{ $keepSignal->id }}"
            let delete_item = "{{route('delete_tag')}}"
        </script>

            <script src="{{ asset('assets/js/script.js') }}"></script>
            <script src="{{ asset('assets/js/tag.js') }}"></script>
            <script src="{{ asset('assets/js/error_modal.js') }}"></script>



    @endsection
@endsection


