@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dictionary/dictionary.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/translate/index.css') }}">
@endsection


@section('content')

    <x-breadcrumbs :title="__('sidebar.' . $page)" />

    <!-- End Page Title -->

    <!-- List of users -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    {{-- <div style="display: flex; justify-content:flex-end">
                        <button type="button" class="btn btn-primary my-opModal" id="auto-open-modal"
                            data-bs-toggle="modal" data-bs-target="#exampleModalLg">Ավելացնել նոր գրառում</button>
                    </div> --}}
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <!-- Button trigger modal -->

                    <div class="add_type_block">

                        <select class="form-select  translate-select">
                            <option value =''>{{ __('content.all_type') }}</option>
                            @foreach ($chapters as $chapter)
                                <option value="{{ $chapter->id }}">{{ $chapter->content }}</option>
                            @endforeach
                        </select>

                        <button class="btn btn-primary"><a
                                href="{{ route('translate.create') }}">{{ __('content.addTo') }}</a></button>

                    </div>


                    <div class="table_div">
                        <table id="resizeMe" class="person_table table" {{-- data-delete-url="/table-delete/{{ $page }}/"
                            data-edit-url="/{{ $app->getLocale() }}/dictionary/{{ $page }}/update/"
                            data-create-url="{{ route('dictionary.store', $page) }}" --}}
                            data-table-name='{{ $page }}' data-section-name="translate">
                            <thead>
                                <tr>
                                    <th data-sort="null" data-type="filter-id">
                                        Id {{--  <i class="fa fa-filter" data-field-name="id" data-table-name='xxx'
                                            data-section-name="translate" aria-hidden="true"></i> --}}
                                    </th>

                                    <th data-sort="null" data-type="standart-complex">
                                        {{ __('content.lang_am') }} {{-- <i class="fa fa-filter" data-field-name="armenian" data-table-name='xxx'
                                            data-section-name="translate" aria-hidden="true"></i>  --}}
                                    </th>
                                    <th data-sort="null" data-type="standart-complex">
                                        {{ __('content.lang_ru') }}{{--  <i class="fa fa-filter" data-field-name="russian" data-table-name='xxx'
                                            data-section-name="translate" aria-hidden="true"></i> --}}
                                    </th>
                                    <th data-sort="null" data-type="standart-complex">
                                        {{ __('content.lang_eng') }}{{-- <i class="fa fa-filter" data-field-name="english" data-table-name='xxx'
                                            data-section-name="translate" aria-hidden="true"></i> --}}
                                    </th>
                                    <th>
                                        {{ __('content.type') }}
                                    </th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody class="table_tbody">
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="trId">{{ $item->id }}</td>
                                        <td class="tdTxt">{{ $item->armenian }}</td>
                                        <td class="tdTxt">{{ $item->russian }}</td>
                                        <td class="tdTxt">{{ $item->english }}</td>
                                        <td class="tdTxt">{{ $item->chapter->content }}</td>
                                        {{-- <td>
                                            <a href="{{ route('translate.edit', $item->id) }}">
                                                <i class="bi bi-pencil-square etid-icon" title="խմբագրել"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModazl"
                                                    data-bs-whatever="@mdo"></i>
                                            </a>
                                        </td> --}}
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>

@section('js-scripts')
    <script>
        window.addEventListener("load", function(event) {
            @error('name')
                document.getElementById('auto-open-modal').click()
            @enderror
        });
    </script>

    <script src='{{ asset('assets/js/translate/translate.js') }}'></script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
@endsection
@endsection
