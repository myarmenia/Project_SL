@extends('layouts.auth-app')
@section('style')
    <link href="{{ asset('assets/css/main/table.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/search-file/index.css') }}" rel="stylesheet" />
    {{-- <style>
        #modal_save:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
    </style> --}}
@endsection

@section('content')

    <x-breadcrumbs :title="__('sidebar.search-file')"/>

    <!-- End Page Title -->
    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <!-- Bordered Table -->

                    <form action="{{ route('search_file_result') }}" method="post">
                        <div id="search_text">
                            <div class="input-check-input-block">
                                <input type="checkbox" class="search-input">
                                <label for="">Հոմանիշներով</label>
                            </div>
                            <select name="content_distance" class="distance distance_fileSearch form-select"
                                style="max-width: 250px" aria-label="Default select example">
                                <option value="">{{ __('content.choose_the_size') }}</option>
                                <option value="1" @if (isset($distance) && $distance == 1) selected @endif>100%
                                    {{ __('content.match') }}</option>
                                <option value="2" @if (isset($distance) && $distance == 2) selected @endif>90%-100%
                                    {{ __('content.match') }}</option>
                                <option value="3" @if (isset($distance) && $distance == 3) selected @endif>70%-100%
                                    {{ __('content.match') }}</option>
                                <option value="4" @if (isset($distance) && $distance == 4) selected @endif>50%-100%
                                    {{ __('content.match') }}</option>
                            </select>

                            <input name="search_input" type="text" class="form-control" id="search_input"
                                value="{{ $search_input ?? '' }}" oninput="checkInput()" style="width: 35%" />
                            <button class="btn btn-primary search-file-btn"
                                id="serach_button">{{ __('content.search') }}</button>
                        </div>

                    </form>
                    <p class="search-word">{{ $search_input ?? '' }}</p>
                    <!-- End Bordered Table -->
                    <div class="save-files">
                        <button class="btn btn-primary save-file-btn">
                            {{ __('button.save') }}
                        </button>
                    </div>
                    <section>
                        @isset($datas)
                            <div class="table_div">

                                <table id="resizeMe" class="table  person_table">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align: middle;"><input type="checkbox"
                                                    class="all-checked-input"></th>
                                            <th>Id</th>
                                            <th>Տեղեկատվությունը տրամադրող մարմին</th>
                                            <th>Փաստաթղթի կատեգորիա</th>
                                            <th>Փաստաթուղթը մուտքագրող օ/ա</th>
                                            <th>Փաստաթղթի գրանցման համարը</th>
                                            <th>Գրանցման ամսաթիվ</th>
                                            <th>Փաստաթղթի Անվանում</th>
                                            <th style="width: 400px">Փաստաթղթի Պարունակություն</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($datas as $data)
                                            @dd($data['bibliography'])
                                            <tr>
                                                <td>
                                                    <p>Ֆայլի Անուն /</p>
                                                    <a href="{{ Storage::url($data['file_path'] ?? '') }}"
                                                        style="color: blue">{{ $data['file_info'] }}</a>
                                                </td>
                                                <td>
                                                    <p>Փնտրվող բառեր /</p>
                                                    <p style="color: red">{{ $search_input }}</p>
                                                </td>
                                                <td colspan="3">
                                                    <p>Տեքստ / </p>
                                                    <p>{{ $data['file_text'] }}</p>
                                                </td>
                                            </tr>
                                        @endforeach --}}

                                        @foreach ($datas as $data)

                                            @if ($data['bibliography']->isNotEmpty())
                                                @foreach ($data['bibliography'] as $bibliography)
                                                    <tr>
                                                        <td class="checked-input"
                                                            style="text-align:center; vertical-align: middle;"><input
                                                                type="checkbox" class="checked-input"></td>

                                                        <td scope="row">{{ $bibliography->id }}</td>
                                                        <td>{{ $bibliography->agency->name ?? '' }}</td>
                                                        <td>{{ $bibliography->doc_category->name ?? '' }}</td>
                                                        <td>{{ $bibliography->users->username ?? '' }} </td>
                                                        <td>{{ $bibliography->reg_number ?? '' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($bibliography->reg_date)->format('d-m-y') }}
                                                        </td>
                                                        @foreach ($datas as $data)
                                                            <td>
                                                                <p class="file_info">{{ $data['file_info'] }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="find_word">{!! $data['find_word'] !!}</p>
                                                            </td>
                                                            <td style="text-align:center; vertical-align: middle;"><i
                                                                    style="font-size: 30px ; cursor: pointer;"
                                                                    class="bi bi-file-earmark-font show-file-text"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModalScrollable">
                                                                    <p class="file-text-block" style="display: none">
                                                                        {!! $data['file_text'] !!}</p>
                                                                </i></td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach


                                </tbody>
                            </table>
                        </div>
                    @endisset
                </section>
            </div>
        </div>


        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content show-file-modal">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
                        <button type="button" class="btn-close clear-text" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>



        <!-- Bordered Table -->


        @yield('permissions-content')

        @if (session()->has('not_find_message'))
            <div class="alert alert-danger" role="alert" style="margin-top: 0.5rem;">
                {{ session()->get('not_find_message') }}
            </div>
        @endif
</section>


@section('js-scripts')
    <script src="{{ asset('assets/js/main/table.js') }}"></script>
    <script>
        let create_response = "{{ __('content.create_response') }}"
        let association = "{{ __('content.association') }}"
        let keyword = "{{ __('content.keyword') }}"
        let fileName = "{{ __('content.fileName') }}"
        let contactPerson = "{{ __('content.contactPerson') }}"
    </script>
    <script src="{{ asset('assets/js/search-file/search-file.js') }}"></script>
@endsection
@endsection
