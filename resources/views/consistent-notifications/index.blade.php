@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/consistent-notifications/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')

    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('content.notices') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item active"> {{ __('content.notices') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <div class="d-flex justify-content-between align-items-center my-3"></div>
                <div class="table_div table-div-consistent">
    <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
        data-status-url="users/change-status/" data-table-name="user" data-section-name="open">
        <thead>
            <tr>
                <th class="filter-th" data-sort="null" data-type="filter-id"  >
                {{ __('content.user_name') }}
                </th>

                <th class="filter-th" data-sort="null" data-type="filter-id"  >
                    {{ __('search.search_text') }}
                </th>
                <th class="filter-th" data-sort="null" data-type="standart">
                    {{ __('content.document') }}
                </th>
                <th class="filter-th" data-sort="null" data-type="standart">
                    {{ __('content.type') }}
                </th>
                <th class="filter-th" data-sort="null" data-type="standart">
                    {{ __('content.date_and_time_date') }}
                </th>
                
                <th class="filter-th" data-sort="null" data-type="standart" style = 'width:30px'  >

                </th>

                <th class="filter-th" data-sort="null" data-type="standart" style = 'width:30px'  >

                </th>
                
                
            </tr>
        </thead>
        <tbody class="tbody">
                @if(count( $notifications) > 0)
                    @foreach($notifications as $notification)
                        <tr class="current-id" data-id="">
                            <td>{{ $notification['data']['data']['name'] }}</td>
                            <td>{{ $notification['data']['data']['search_text'] }}</td>
                            <td>
                                <a href="#">{{ $notification['data']['data']['document_url'] }}</a>
                            </td>
                            <td>{{ __('content.'.$notification['data']['data']['type']) }}</td>
                            <td>{{ Carbon\Carbon::parse($notification['created_at'])->format('d.m.Y') }}</td>
                            <td title="Ծանուցման ձև"><a href="#"> <i class="bi bi-box-arrow-in-down"></i></a></td>
                            <td>
                                <button class="btn_close_modal my-delete-item border-0 bg-light" data-bs-toggle="modal"
                                          data-bs-target="#deleteModal" data-id="{{ $notification['id'] }}"><i
                                            class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
        </tbody>
    </table>
</div>
            </div>
        </div>
    </section>

    <!-- modal block -->
    <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('search.deleting_an_entry') }}</h5>
                    <button type="button" class="close close_modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('content.modal_text') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_button" data-bs-dismiss="modal">
                        {{ __('search.cancel') }}
                    </button>
                    <form action="{{ route('consistent_notification_read') }}" id="delete_form" method="POST">
                        @csrf
                        <input type="hidden" id="row-id" name="id">
                        <button class="btn btn-primary" id="delete_button" data-bs-dismiss="modal">
                            {{ __('search.confirm') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-scroll-up/>
    <x-fullscreen-modal/>
    <x-errorModal/>

    @section('js-scripts')
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('assets/js/consistent-notifications/script.js') }}"></script>
    @endsection
@endsection

