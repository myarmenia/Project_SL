@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/users/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('content.log_list')" />
    <!-- End Page Title -->

    <!-- List of users -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center my-3"></div>

                    <div class="table_div">

                        <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
                            data-status-url="bbb/status/" data-table-name="users-table" data-section-name="dictionary">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Ip</th>
                                    <th>Գործածողի անուն</th>
                                    <th>Անուն</th>
                                    <th>Ազգանուն</th>
                                    <th>Դեր</th>
                                    <th>Գործողություն</th>
                                    <th>Աղյուսակի անվանում</th>
                                    <th>Մուտքագրման ամսաթիվ</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                {{-- {{dd($log->user->roles())}} --}}
                                    <tr class="current-id" data-id="1">

                                        <td><a href="{{route('get.loging',['log_id' => $log->id])}}"
                                            {{-- href="{{ route('open.page.restore', [$page, $action->id]) }}" --}}

                                            title="վերականգնել"><i
                                                class="bi bi-arrow-down-up open-regenerate"></i></a></td>
                                        <td>{{$log->id}}</td>
                                        <td>{{$log->user_ip}}</td>
                                        <td>{{$log->user->username ?? ''}}</td>
                                        <td>{{$log->user->first_name ?? ''}}</td>
                                        <td>{{$log->user->last_name ?? ''}}</td>
                                        <td>{{$log->user ? implode(', ', $log->user->roles->pluck('name')->toArray()) : '' }}</td>
                                        <td>{{$log->type ? __("table.$log->type") : ''}}</td>
                                        <td>{{$log->tb_name ? __("table.$log->tb_name") : ''}}</td>
                                        <td>{{date('d-m-Y', strtotime($log->created_at))}}</td>
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
