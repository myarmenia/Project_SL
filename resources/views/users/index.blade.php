@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/users/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1> {{ __('content.user_list') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('content.type_admin') }}</a></li>
                    <li class="breadcrumb-item active">
                        {{ __('content.user_list') }}
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
                    <div style="display: flex; justify-content:flex-end">
                        <a href="{{ route('users.create') }}" class="btn btn-primary ">{{ __('content.createNew') }}</a>
                    </div>
                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <div class="table_div">

                        <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
                            data-status-url="users/change-status/" data-table-name="user" data-section-name="open">
                            <thead>
                                <tr>
                                    <th class="filter-th" data-sort="null" data-type="filter-id">
                                        Id
                                        <i class="fa fa-filter" data-field-name="id" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        {{ __('content.user_name') }}
                                        <i class="fa fa-filter" data-field-name="username" aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        {{ __('content.first_name') }} <i class="fa fa-filter" data-field-name="first_name"
                                            aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        {{ __('content.last_name') }}<i class="fa fa-filter" data-field-name="last_name"
                                            aria-hidden="true"></i>
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        {{ __('content.type') }}<i class="fa fa-filter" data-field-name="roles"
                                            aria-hidden="true"></i>
                                    </th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="current-id" data-id="{{ $user->id }}">
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->username ?? '' }}</td>
                                        <td>{{ $user->first_name ?? '' }}</td>
                                        <td>{{ $user->last_name ?? '' }}</td>
                                        <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                        <td>
                                            <button class="btn_close_modal" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="1">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <input type="range" value="1" min="0" max="1"
                                                class="rangeInput" data-bs-toggle="modal" data-bs-target="#avtiveModal" />
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
    <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close close_modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_button" data-bs-dismiss="modal">
                        Չեղարկել
                    </button>
                    <form action="" id="delete_form">
                        <button class="btn btn-primary" id="delete_button" data-bs-dismiss="modal">
                            Հաստատել
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal range -->

    <div class="modal" id="avtiveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close close_modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancel_btn" data-bs-dismiss="modal">
                        Չեղարկել
                    </button>
                    <form action="" method="Post" id="status_form">
                        @csrf
                        <button class="btn btn-primary" id="isActive_button" data-bs-dismiss="modal">
                            Հաստատել
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@section('js-scripts')
    <script src='{{ asset('assets/js/users/index.js') }}'></script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
@endsection

@endsection
