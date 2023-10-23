@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/show-file/show-file.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.roles') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    ----
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('pagetitle.roles') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="modal_click_div">
                        <input type="button" id="modal_click" value="Click" class="btn btn-primary" />
                    </div>
                    <div id="modalTop" >
                        <table id="file-data-table" class="table table-bordered" style="border: 1px solid black">
                            <thead>
                                <tr>
                                    <th scope="col">name</th>
                                    <th scope="col">surname</th>
                                    <th scope="col">patronymic</th>
                                    <th scope="col">birthday</th>
                                    <th scope="col">address</th>
                                    <th scope="col">find text</th>
                                    <th scope="col">paragraph</th>
                                </tr>
                            </thead>
                            <tbody class="tbody_elements">
                                <tr class="tbody_elements_tr">
                                    <td class="custom-add-name" htmlangerouselement name="name" contenteditable="true">

                                    </td>
                                    <td class="custom-add-name" htmlangerouselement name="surname" contenteditable="true">

                                    </td>
                                    <td class="custom-add-name" htmlangerouselement name="patronymic"
                                        contenteditable="true">

                                    </td>
                                    <td class="custom-add-name" htmlangerouselement name="birthday" contenteditable="true">

                                    </td>
                                    <td class="custom-add-name" htmlangerouselement name="address" contenteditable="true">

                                    </td>
                                    <td class="custom-add-name" htmlangerouselement name="findText" contenteditable="true">

                                    </td>
                                    <td class="custom-add-name" htmlangerouselement name="paragraph" contenteditable="true" style="overflow-y: auto;display: block;overflow: auto;max-height: 300px;">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="inmodal_button">
                            <input type="button" id="inmodal_button" value="send" class="btn btn-primary" />
                        </div>
                    </div>
                    <input id="file-name" type='hidden' file-name={{ $fileName }} />

                    <div id="app" class="p-4">
                      {{-- @dd($implodeArray) --}}
                      @foreach ($implodeArray as $par)
                        <p class="m-4">&nbsp;&nbsp;&nbsp;{!! $par !!}</p>
                      @endforeach
                    </div>

                    <div id="modal">
                        <div class="modal_select" data-name="name">name:</div>
                        <div class="modal_select" data-name="ammunition">ammunition:</div>
                        <div class="modal_select" data-name="address">address:</div>
                    </div>

                </div>

            </div>
            @yield('permissions-content')

        </div>
    </section>

@section('js-scripts')
    <script src="{{ asset('assets/js/show-file/show-file.js') }}"></script>
@endsection
@endsection
