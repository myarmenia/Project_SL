@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/email/email.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
@endsection


@section('content')

    <x-breadcrumbs :title="__('content.mail_address')" />

    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <!-- Vertical Form -->
                <form class="form" method="POST"  action="{{route('email.store', ['model' => $modelData->name,'id'=>$modelData->id ])}}">
                    @csrf
                    <x-back-previous-url submit/>
                    <div class="inputs row g-3">
                        <!-- To open modal """fullscreenModal""" -->
                        <div class="col">
                            <div class="form-floating">
                                <input
                                        type="email"
                                        class="form-control"
                                        id="inputDate2"
                                        placeholder=""
                                        name="address"
                                        tabindex="1"
                                />
                                <label for="inputDate2" class="form-label"
                                >1) {{__('content.mail_address')}}</label
                                >
                            </div>
                        </div>


                        <div class="col">
                            <label for="inputDate2" class="form-label"
                            >2) {{__('content.ties')}}</label
                            >
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
        <script src="{{ asset('assets/js/email/script.js') }}"></script>
    @endsection
@endsection

