@extends('layouts.auth-app')
@section('style')
    <link href="{{ asset('assets/css/bibliography/summary_automatic.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <x-breadcrumbs :title="__('content.mia_summary_avto')" :crumbs="[['name' => __('pagetitle.data-entry-through-files'),'route' => 'bibliography.summery_automatic', 'route_param' => 'bibliography_id='.$_GET['bibliography_id']]]"/>

    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <x-back-previous-url />
                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <form class="row g-3 needs-validation myclass" novalidate
                        action="{{ route('upload.submit', ['locale' => app()->getLocale()]) }}" method="POST"
                        enctype="multipart/form-data">

                        <input type="hidden" name="bibliography_id" value="{{ request()->get('bibliography_id') }}">
                        <input type="hidden" name="table_name" value="{{ request()->get('table') }}">
                        <input type="hidden" name="colum_name_id" value="{{ request()->get('colum_name_id') }}">
                        <input type="hidden" name="colum_name" value="{{ request()->get('colum_name') }}">
                        <div class="upload_fille_father">
                            <div class="upload_fille_child">
                                <h4>  {{ __('content.action_summary') }}</h4>
                                <div class="file-upload-container my-upload-btn">
                                    <input id="file_id_action" type="file" name="file" data-href-type=""
                                        class="file-upload" data-render-type="none" hidden accept=".doc,.docx" />
                                    <label for="file_id_action"
                                        class="file-upload-btn btn btn-secondary h-fit w-fit upload_btn">
                                        {{ __('content.upload') }}
                                    </label>
                                </div>
                                <div class="file-upload_action"></div>
                                <div class="col-12 my-btn-class">
                                    <button class="btn btn-primary" id='loader-id' type="submit" data-bs-toggle="modal"
                                        href="#exampleModalToggle">
                                        {{ __('content.forward') }}
                                    </button>
                                </div>

                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModalToggle" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered aaa">
            <div id="loader" class="mr-10">
                {{-- fa fa-spinner fa-1x fa-spin --}}
                <i class="bi bi-arrow-repeat iii" id="loaderIcon"></i>
            </div>
            <div class="modal-content">
                {{-- <div class="loader-container">

                  </div> --}}
            </div>
        </div>
    </div>

@section('js-scripts')
    <script src="{{ asset('assets/js/bibliography/summary_automatic.js') }}"></script>
@endsection

@endsection
