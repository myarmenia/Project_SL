@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/external-signs-image/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection


@section('content')
    <x-breadcrumbs :title="__('content.external_signs_photo')" />

    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>

                <!-- Vertical Form -->
                <form class="form" method="POST" action="{{route('sign-image.store', $man->id)}}"  enctype="multipart/form-data">
                    @csrf

                    <button type="submit" class="submit-btn"><i class="bi bi-arrow-left"></i></button>

                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating input-date-wrapper">
                                <input
                                    type="date"
                                    placeholder=""
                                    id="inputDate1"
                                    class="form-control"
                                    name="fixed_date"
                                />
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
                                <div class="file-upload-content"></div>
                            </div>
                            {{--                            <x-tegs :data="$man" :relation="'file1'" :name="'name'" :modelName="'has_file'"--}}
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
    @endsection
@endsection
