@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/show-file/show-file.css') }}" rel="stylesheet" />
    <style>
        #modal_save:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
    </style>
@endsection

@section('content')

    <x-breadcrumbs :title="__('pagetitle.roles')" />

    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <x-back-previous-url />
                    <div class="modal_click_div">
                        {{-- <input type="button" id="back_click" value="back" class="btn btn-primary"> --}}
                        <input type="button" id="modal_click" value="{{ __('search.add') }}" class="btn btn-primary" />
                    </div>
                    <div id="modalTop">
                        <div class="close_button" id="close_button">&#10005;</div>
                        <table id="file-data-table" class="table table-bordered" style="border: 1px solid black">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('search.name') }}*</th>
                                    <th scope="col">{{ __('search.last_name') }}*</th>
                                    <th scope="col">{{ __('search.patronymic') }}</th>
                                    <th scope="col">{{ __('search.birthday') }}</th>
                                    {{-- <th scope="col">{{__('search.address')}}</th> --}}
                                    <th scope="col">{{ __('search.find_text') }}*</th>
                                    <th scope="col">{{ __('search.paragraph') }}*</th>
                                </tr>
                            </thead>
                            <tbody class="tbody_elements">
                                <tr class="tbody_elements_tr">
                                    <td class="custom-add-name myTd" placeholder="Enter data" htmlangerouselement
                                        name="name" contenteditable="true" onpaste="clearFormatting(event)">

                                    </td>
                                    <td class="custom-add-name myTd" htmlangerouselement name="surname"
                                        contenteditable="true" onpaste="clearFormatting(event)">

                                    </td>
                                    <td class="custom-add-name myTd" htmlangerouselement name="patronymic"
                                        contenteditable="true" onpaste="clearFormatting(event)">

                                    </td>
                                    <td class="custom-add-name myTd" htmlangerouselement name="birthday"
                                        contenteditable="true" onpaste="clearFormatting(event)">

                                    </td>
                                    {{-- <td class="custom-add-name myTd" htmlangerouselement name="address" contenteditable="true">

                                    </td> --}}
                                    <td class="custom-add-name myTd" htmlangerouselement name="findText"
                                        contenteditable="true" onpaste="clearFormatting(event)">

                                    </td>
                                    <td class="custom-add-name myTd" htmlangerouselement name="paragraph"
                                        contenteditable="true"
                                        style="overflow-y: auto;display: block;overflow: auto;max-height: 300px;" onpaste="clearFormatting(event)">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="inmodal_button">
                            <input type="button" id="inmodal_button" value="{{ __('content.send') }}" class="btn btn-primary" />
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
                        <div id="select_text"></div>
                        <div id="div_modal">
                            <textarea id="text_modal" oninput="checkInput()"></textarea>
                        </div>
                        <div id="button_modal">
                            <button class="btn btn-primary" id="modal_save" disabled>{{ __('content.save') }}</button>
                        </div>
                        {{-- <div class="modal_select" data-name="name">name:</div>
                        <div class="modal_select" data-name="ammunition">ammunition:</div>
                        <div class="modal_select" data-name="address">address:</div> --}}
                    </div>

                </div>

            </div>
            @yield('permissions-content')

        </div>
    </section>

@section('js-scripts')
    <script src="{{ asset('assets/js/show-file/show-file.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function checkInput() {
            var textValue = $('#text_modal').val();
            var saveButton = $('#modal_save');

            if (textValue.trim() !== '') {
                saveButton.prop('disabled', false);
            } else {
                saveButton.prop('disabled', true);
            }
        }
    </script>
@endsection
@endsection
