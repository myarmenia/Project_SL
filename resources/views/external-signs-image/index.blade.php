@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/external-signs-image/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/calendar.css') }}">

@endsection


@section('content')
    

    <!-- End Page Title -->
    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <!-- Vertical Form -->
                <form class="form" method="POST"
                     action="{{route('manExternalSignHasSignPhoto.store', ['model' => $modelData->name,'id'=>$modelData->id])}}"  enctype="multipart/form-data">
                    @csrf

                    <x-back-previous-url submit/>

                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper calendar-container">
                                <input
                                    type="text"
                                    placeholder=""
                                    id="inputDate1"
                                    class="form-control calendarInput"
                                    name="fixed_date"
                                    value="{{$modelData->model->fixed_date}}"
                                    data-check="date"
                                    autocomplete="off" onblur="handleBlur(this)"
                                />
                                <span class="calendar-icon" onclick="openCalendar(this)"><i class="bi bi-calendar"></i></span>

                                <label for="inputDate1" class="form-label"
                                >1) {{__('content.time_fixation')}}</label
                                >
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="col d-flex flex-wrap gap-3 modal-toggle-box  flex-row-reverse">
                            <div class="file-upload-container d-flex flex-row-reverse gap-2">
                               <div>
                                   <input
                                       type="file"
                                       class="file-upload"
                                       id="file"
                                       name="image"
                                       hidden
                                   />
                                   <label for="file" class="file-upload-btn btn btn-secondary h-fit w-fit">
                                       {{__('content.upload')}}
                                   </label>
                               </div>
                                <div class="file-upload-content">

                                </div>
                            </div>
{{--                            <x-tegs :data="$modelData->model" :relation="'file1'" :name="'name'" :modelName="'has_file'"--}}
{{--                                    :dataDivId="'file'"/>--}}
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
            document.querySelector('.file-upload').addEventListener('change', function(){
                document.querySelector('.file-upload-content').innerText = this.files[0].name
            });
        </script>
        <script src="{{ asset('assets/js/external-signs-image/script.js') }}"></script>
        <script src='{{ asset('assets/js/main/date.js') }}'></script>

    @endsection
@endsection
