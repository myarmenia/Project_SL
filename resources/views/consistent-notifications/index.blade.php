@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/consistent-notifications/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
@endsection

@section('content')
    
    <!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">
                <x-form-error/>
                <div class="d-flex justify-content-between align-items-center my-3"></div>
                <div class="table_div table-div-consistent">
    <table id="resizeMe" class="person_table table notifications-table" data-delete-url="aaa/delete/"
        data-status-url="users/change-status/" data-section-name="open" data-table-name="">
        <thead>
            <tr>
                <th></th>
                <th></th>
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
                            <td style="text-align:center; align-items: center;">
                                @if($notification['data']['data']['type'] == 'incoming')
                                    @if($notification['data']['data']['field'] == 'man')
                                        <a href="{{ route('man.edit', $notification['data']['data']['id']) }}">
                                            <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                        </a>
                                    @elseif($notification['data']['data']['field'] == 'organization')
                                        <a href="{{ route('organization.edit', $notification['data']['data']['id']) }}">
                                            <i class="bi bi-pencil-square open-edit" title="խմբագրել"></i>
                                        </a>
                                    @endif
                                @endif
                            </td>
                            <td style="text-align: center">
                                @if($notification['data']['data']['type'] == 'incoming')
                                    @if($notification['data']['data']['field'] == 'man')
                                        <i class="bi bi-eye open-eye" title="Դիտել" data-table-name="man" data-id="{{ $notification['data']['data']['id'] }}"> </i>
                                    @elseif($notification['data']['data']['field'] == 'organization')
                                        <i class="bi bi-eye open-eye" title="Դիտել" data-table-name="organization" data-id="{{ $notification['data']['data']['id'] }}"> </i>
                                    @endif
                                @endif
                            </td>
                            <td>{{ $notification['data']['data']['name'] }}</td>
                            <td>{{ $notification['data']['data']['search_text'] }}</td>
                            <td>
                                @if(isset($notification['data']['data']['document_url']) and isset($notification['data']['data']['document_name']))
                                    <a href="{{ route('consistent_notifications.download_file',['path' => $notification['data']['data']['document_url']]) }}" >{{ $notification['data']['data']['document_name'] }}</a>
                                @endif
                            </td>
                            <td>{{ __('content.'.$notification['data']['data']['type']) }}</td>
                            <td>{{ Carbon\Carbon::parse($notification['created_at'])->format('d.m.Y') }}</td>
                            <td title="Ծանուցման ձև"><a href="{{ asset('assets/file/Document.docx') }}" download> <i class="bi bi-box-arrow-in-down"></i></a></td>
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
        <script>
                    @if (request()->routeIs('optimization.*'))
            let all_filter_icons = document.querySelectorAll('.filter-th i')

            all_filter_icons.forEach(element => {
                element.style.display = 'none'
            });

            document.querySelector('#clear_button').style.display = 'none'
                    @endif

            let allow_change = '';
            let allow_delete = '';
            let dinamic_field_name = "{{ __('content.field_name') }}";
            let dinamic_content = "{{ __('content.content') }}";
            let ties = "{{ __('content.ties') }}";
            let parent_table_name = "{{ __('content.man') }}";
            let parent_table_man = "{{ __('content.man') }}";
            let parent_table_organization = "{{ __('content.organization') }}";
            let fieldName = 'man_id';
            let fieldNameMan = 'man_id';
            let fieldNameOrganization = 'organization_id';
            let relation = "{{ request()->relation }}";
            let main_route = "{{ request()->main_route }}";
            let model_id = "{{ request()->model_id }}";
            // filter translate //
            let equal = "{{ __('content.equal') }}";
            let not_equal = "{{ __('content.not_equal') }}";
            let more = "{{ __('content.more') }}";
            let more_equal = "{{ __('content.more_equal') }}" ;
            let less_equal = "{{ __('content.less_equal') }}";
            let contains = "{{ __('content.contains') }}";
            let start = "{{ __('content.start') }}";
            let search_as = "{{ __('content.search_as') }}";
            let seek = "{{ __('content.seek') }}";
            let clean = "{{ __('content.clean') }}";
            let and_search = "{{ __('content.and') }}";
            let or_search = "{{ __('content.or') }}" ;
            // filter translate //
        </script>

        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('assets/js/consistent-notifications/script.js') }}"></script>
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
    @endsection
@endsection

