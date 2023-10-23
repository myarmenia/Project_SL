@extends('layouts.auth-app')
@section('style')
    <link href="{{ asset('assets/css/reference/reference.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>Անձ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">--Home</a></li>
                    <li class="breadcrumb-item active">---Տվյալների մուտքագրում ֆայլերի միջոցով</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <form class="row g-3 needs-validation myclass" novalidate
                        action="{{ route('upload.submit', ['locale' => app()->getLocale()]) }}" method="POST"
                        enctype="multipart/form-data">

                        <div class="upload_fille_father">
                            <div class="upload_fille_child">
                                <h4 class="text-center">Ներբեռնեք տեղեկանքը</h4>
                                <div class="file-upload-container my-upload-btn">
                                    <input id="file_id_action" type="file" name="file" data-href-type=""
                                        class="file-upload" data-render-type="none" hidden accept=".doc,.docx" />
                                    <label for="file_id_action"
                                        class="file-upload-btn btn btn-secondary h-fit w-fit upload_btn">
                                        Բեռնել
                                    </label>

                                </div>

                                <div class="col-12 my-btn-class">
                                    <button class="btn btn-primary" type="submit">
                                        Առաջ
                                    </button>
                                </div>
                                <div class="file-upload_action"></div>
                            </div>
                    </form>
                </div>

            </div>
        </div>
        </div>
    </section>

@section('js-scripts')
    <script src="{{ asset('assets/js/reference/reference.js') }}"></script>
@endsection

@endsection
