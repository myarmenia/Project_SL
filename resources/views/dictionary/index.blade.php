@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dictionary/dictionary.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection


@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.' . $page) }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('sidebar.dictionaries') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('sidebar.' . $page) }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- List of users -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="search_create-block">
                        <div class="input-block" >
                            <input type="text" class="search-dictionary form-control " placeholder="{{ __('content.search') }}">
                        </div>
                        <div style="display: flex; justify-content:flex-end">
                            <button type="button" class="btn btn-primary my-opModal" id="auto-open-modal"
                                data-bs-toggle="modal" data-bs-target="#exampleModalLg">{{ __('content.createNew') }}</button>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <!-- Button trigger modal -->


                    <div class="table_div">
                        <table class="person_table table" data-delete-url="/table-delete/{{ $page }}/"
                            data-edit-url="/{{ $app->getLocale() }}/dictionary/{{ $page }}/update/"
                            data-create-url="{{ route('dictionary.store', $page) }}" data-table-name='{{ $page }}'
                            data-section-name="dictionary">
                            <thead>
                                <tr>
                                    <th class="filter-th" data-sort="null" data-type="filter-id" style="width: 30px">
                                        Id <i class="fa fa-filter" data-field-name="id" data-table-name='xxx'
                                            aria-hidden="true"></i>
                                    </th>

                                    <th class="filter-th" data-sort="null" data-type="standart" >
                                        {{ __('content.name') }} <i class="fa fa-filter" data-field-name="name"
                                            data-table-name='xxx' aria-hidden="true"></i>
                                    </th>
                                    <th style="width: 30px"></th>
                                </tr>
                            </thead>
                            <tbody class="table_tbody">
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="trId">{{ $item->id }}</td>

                                        <td class="tdTxt">
                                            <span class="started_value">{{ $item->name }}</span>
                                            <input type="text" class="form-control edit_input" required placeholder="" />
                                            <div class="error-text">

                                            </div>
                                        </td>

                                        <td>
                                            <a class="my-edit" style="cursor: pointer"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <button class="btn_close_modal my-delete-item" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $item->id }}"><i
                                                    class="bi bi-trash3"></i>
                                            </button>
                                            <button class="btn btn-primary my-btn-class my-sub">Թարմացնել</button>
                                            <button class="btn btn-secondary my-btn-class my-close">Չեղարկել</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- modal block -->
    @include('components.delete-modal')

    <!-- modal range -->

    <div class="modal fade" id="exampleModalLg" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalLgLabel">{{ __('content.createNew') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class='my-form-class' action="" method="Post">
                        @csrf
                        <div>
                            <div class="form-floating">
                                <input type="text" name="name"
                                    class="form-control @error('name') error-border @enderror" placeholder="" />
                                <label class="form-label">{{ __('content.name') }}</label>
                            </div>
                            @error('name')
                                <div class="error-text">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button class='btn btn-primary my-class-sub'>{{ __('content.addTo') }}</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@section('js-scripts')
    <script>
        window.addEventListener("load", function(event) {
            @error('name')
                document.getElementById('auto-open-modal').click()
            @enderror
        });
    </script>

    <script src='{{ asset('assets/js/dictionary/dictionary.js') }}'></script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
@endsection
@endsection
