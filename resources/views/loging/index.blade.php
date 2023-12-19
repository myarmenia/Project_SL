@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/users/index.css') }}">
@endsection

@section('content')

    @php
        $actions_array = ['login', 'edit', 'delete', 'view', 'print', 'print_joins', 'backup', 'restore', 'search_template', 'smp_search', 'adv_search', 'file_search', 'add', 'report', 'logout', 'fusion', 'optimization'];
    @endphp



    <!-- End Page Title -->

    <!-- List of users -->
    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <form action="{{ route('loging.index') }}" method="get">
                        <div class="loging-search-block">
                            <input type="text" class="form-control loging-search-input" placeholder="{{ __('table.user_name') }}" name="username"
                            value="{{ request()->input('username') }}">
                        <input type="text" class="form-control loging-search-input"  placeholder="{{ __('table.name') }}" name="first_name"
                            value="{{ request()->input('first_name') }}">
                        <input type="text" class="form-control loging-search-input"  placeholder="{{ __('table.last_name') }}" name="last_name"
                            value="{{ request()->input('last_name') }}">
                        <select name="type" class="form-select loging-search-select">
                            <option value="" hidden>{{ __('table.action') }}</option>
                            @foreach ($actions_array as $action)
                                <option value="{{ $action }}"
                                    {{ $action == request()->input('type') ? 'selected' : '' }}>
                                    {{ __('table.' . $action) }}
                                </option>
                            @endforeach
                        </select>
                        <input type="date" data-check="date" class="form-control loging-search-input"  name="date_from" value="{{ request()->input('date_from') }}">
                        <input type="date"  data-check="date" class="form-control loging-search-input"  name="date_to" value="{{ request()->input('date_to') }}">
                        <button class="btn btn-primary loging-search-btn">Որոնել</button>
                        </div>

                    </form>

                    <div class="table_div">

                        <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
                            data-status-url="bbb/status/" data-table-name="users-table" data-section-name="dictionary">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Ip</th>
                                    <th>{{ __('table.user_name') }}</th>
                                    <th>{{ __('table.name') }}</th>
                                    <th>{{ __('table.last_name') }}</th>
                                    <th>{{ __('table.role') }}</th>
                                    <th>{{ __('table.action') }}</th>
                                    <th>{{ __('table.table_name') }}</th>
                                    <th>{{ __('table.date_and_time_date') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    {{-- {{dd($log->user->roles())}} --}}
                                    <tr class="current-id" data-id="1">

                                        <td><a href="{{ route('get.loging', ['log_id' => $log->id]) }}"
                                                {{-- href="{{ route('open.page.restore', [$page, $action->id]) }}" --}} title="վերականգնել"><i
                                                    class="bi bi-arrow-down-up open-regenerate"></i></a>
                                        </td>
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->user_ip }}</td>
                                        <td>{{ $log->user->username ?? '' }}</td>
                                        <td>{{ $log->user->first_name ?? '' }}</td>
                                        <td>{{ $log->user->last_name ?? '' }}</td>
                                        <td>{{ $log->user ? implode(', ', $log->user->roles->pluck('name')->toArray()) : '' }}
                                        </td>
                                        <td>{{ $log->type ? __("table.$log->type") : '' }}</td>
                                        <td>{{ $log->tb_name ? __("table.$log->tb_name") : '' }}</td>
                                        <td>{{ date('d-m-Y', strtotime($log->created_at)) }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>
                    {{ $logs->links() }}
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



@section('js-scripts')
    <script>
        let dinamic_field_name = "{{ __('content.field_name') }}"
        let dinamic_content = "{{ __('content.content') }}"
    </script>
    <script src='{{ asset('assets/js/users/index.js') }}'></script>
    <script src='{{ asset('assets/js/main/table.js') }}'></script>
    <script src='{{ asset('assets/js/open/dinamicTable.js') }}'></script>
@endsection

@endsection
