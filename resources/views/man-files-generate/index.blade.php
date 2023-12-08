@extends('layouts.auth-app')
@section('style')
    <link href="{{ asset('assets/css/main/table.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/search-file/index.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- End Page Title -->
    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <!-- Bordered Table -->
                    <div class="save-files">
                        <button class="btn btn-primary save-file-btn">
                            {{ __('content.create_response_file') }}
                        </button>
                    </div>

                    <section>
                        <div class="table_div" style="height: 350px">
                            <table class="table  person_table">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; vertical-align: middle; width:50px"><input
                                                type="checkbox" class="all-checked-input"></th>
                                        <th style="width:200px">{{ __('content.document_name') }}</th>
                                        <th style="width: 350px">{{ __('content.short_desc') }}</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td class="checked-input-td" style="text-align:center; vertical-align: middle;">
                                            <input type="checkbox" class="checked-input" data-id= ''>
                                        </td>
                                        <td> <a style="text-decoration: underline; color:blue;" href = ""
                                                class="file_info" download>sd</a></td>
                                        <td style="display: block; overflow: auto ;height:70px; padding:10px">
                                            <div style="white-space: initial;" class="file-generate-div">Lorem ipsum dolor
                                                sit amet consectetur adipisicing elit. Quod nihil omnis at ratione natus
                                                cumque magni consectetur ipsa ducimus, ad placeat facere suscipit
                                                perspiciatis ab ipsum voluptatum odio rerum porro.</div>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </section>

                </div>
            </div>

    </section>
@section('js-scripts')
    {{-- <script src="{{ asset('assets/js/main/table.js') }}"></script> --}}
    <script>
        let create_response = "{{ __('content.create_response') }}"
        let association = "{{ __('content.association') }}"
        let keyword = "{{ __('content.keyword') }}"
        let fileName = "{{ __('content.fileName') }}"
        let contactPerson = "{{ __('content.contactPerson') }}"

        let generate_file = "{{ route('generate_file_from_search_result') }}"

        //  for show message in search-file.js
        let answer_message = "{{ __('messages.file_has_been_gererated') }}"
        let response_file_not_generated = "{{ __('messages.response_file_not_generated') }}"
    </script>
    <script src="{{ asset('assets/js/man-files-generate/index.js') }}"></script>
@endsection
@endsection
