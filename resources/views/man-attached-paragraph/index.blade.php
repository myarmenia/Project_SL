@extends('layouts.auth-app')
@section('style')
    <link href="{{ asset('assets/css/search-file/index.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
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
{{-- {{dd($man_file)}} --}}
                                    @foreach ($man_file as $items)
                                    {{-- {{dd($item->tmp_man)}} --}}
                                        @foreach ($items->tmp_man as $item )
                                        {{-- {{dd($item)}} --}}
                                            <tr>
                                                <td class="checked-input-td" style="text-align:center; vertical-align: middle;">
                                                    <input type="checkbox" class="checked-input" data-id= ''>
                                                </td>
                                                 {{-- {{dd(Storage::url($item->file_path))}} --}}
                                                <td> <a style="text-decoration: underline; color:blue;" href = "{{ Storage::url($item->file_path) }}"
                                                        class="file_info" download>{{ $item->real_file_name }}</a></td>
                                                <td style="display: block; overflow: auto ;height:70px; padding:10px">
                                                    <div style="white-space: initial;" class="file-generate-div">{!!$item->paragraph!!}</div>
                                                </td>
                                            </tr>

                                        @endforeach
                                        @if (count($items->paragraph_files)>0)
                                            @foreach ($items->paragraph_files as $itm )

                                                <tr>
                                                    <td class="checked-input-td" style="text-align:center; vertical-align: middle;">
                                                        <input type="checkbox" class="checked-input" data-id= ''>
                                                    </td>
                                                    {{-- {{dd(Storage::url($itm->path))}} --}}
                                                    <td> <a style="text-decoration: underline; color:blue;" href = "{{Storage::url($itm->path)}}"
                                                            class="file_info" download>{{ $itm->file_name }}</a></td>
                                                    <td style="display: block; overflow: auto ;height:70px; padding:10px">
                                                        <div style="white-space: initial;" class="file-generate-div">{!!$itm->content!!}</div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        @endif
                                    @endforeach


                                </tbody>

                            </table>

                        </div>

                    </section>

                </div>
            </div>
            <div id="downloaded_file" style="display:none"></div>


    </section>
    <x-errorModal />


@section('js-scripts')

    <script>

        let create_response = "{{ __('content.create_response') }}"
        let association = "{{ __('content.association') }}"
        let keyword = "{{ __('content.keyword') }}"
        let fileName = "{{ __('content.fileName') }}"
        let contactPerson = "{{ __('content.contactPerson') }}"
        let man_attached_paragraph = "{{ route('man-attached-file.store')}}"
        //  for show message in search-file.js
        let answer_message = "{{ __('messages.file_has_been_gererated') }}"
        let response_file_not_generated = "{{ __('messages.response_file_not_generated') }}"
        let man_id="{{request()->segment(count(request()->segments()))}}"


    </script>
    <script src="{{ asset('assets/js/man-attached-paragraph/index.js') }}"></script>
    <script src="{{ asset('assets/js/error_modal.js') }}"></script>
@endsection
@endsection
