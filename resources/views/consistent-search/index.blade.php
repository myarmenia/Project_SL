@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/consistent-search/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/tag.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/error-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/table.css') }}">
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{__('content.consistent_search')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('consistent_search')}}">{{__('content.consistent_search')}}</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <!-- Vertical Form -->
                <form class="form consistent-form" method="POST" action="{{route('consistent_store')}}">
                    @csrf
                    <div class="inputs row g-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control pb-0 pt-0" id="search-text"
                                           name="search_text" tabindex="1"/>
                                <label for="search-text" class="form-label">{{ __('search.search_text') }}</label>
                            </div>
                        </div>
                        @error('search_text')
                        <small class="text-danger text-end error-msg">{{$message}}</small>
                        @enderror
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-control" id="library" name="library[]" multiple="multiple">
                                    @if($libraries)
                                        @foreach($libraries as $library)
                                            <option value="{{ $library->id }}">{{ __('search.'.$library->field) }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label class="form-label" for="library">{{ __('search.library_field') }}</label>
                            </div>
                        </div>
                        @error('library')
                        <small class="text-danger text-end error-msg">{{$message}}</small>
                        @enderror
                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select form-control select_class" id="following" name="following[]" multiple="multiple">
                                    @if($users)
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name .' '. $user->last_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label class="form-label" for="following">{{ __('search.follower') }}</label>
                            </div>
                        </div>
                        @error('following')
                        <small class="text-danger text-end error-msg">{{$message}}</small>
                        @enderror
                        <div class="col">
                                <div class="form-floating input-date-wrapper">
                                    <input type="date" id="deadline" class="form-control pb-0 pt-0" name="deadline"
                                           min="{{ Carbon\Carbon::today()->format("Y-m-d") }}"/>
                                    <label for="deadline" class="form-label">{{ __('search.control_deadline') }}</label>
                                </div>
                        </div>
                        @error('deadline')
                        <small class="text-danger text-end error-msg">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="submit-btn consistent-searche-submit">{{ __('search.add') }}</button>
                </form>
                <!-- Vertical Form -->
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <div class="table_div table-div-consistent">
                        <table id="resizeMe" class="person_table table" data-delete-url="aaa/delete/"
                            data-status-url="users/change-status/" data-table-name="user" data-section-name="open">
                            <thead>
                                <tr>
                                    <th class="filter-th" data-sort="null" data-type="filter-id" style = 'width:30px' >
                                        Id
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        {{ __('search.library_field') }}
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        {{ __('search.search_text') }}
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        {{ __('search.follower') }}
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart">
                                        {{ __('search.control_deadline') }}
                                    </th>
                                    <th class="filter-th" data-sort="null" data-type="standart" style = 'width:30px'  >
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            @if( $consistentSearch)
                                @foreach( $consistentSearch as $item)
                                    <tr class="current-id" data-id="">
                                        <td>{{$item->id}}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                @if($item->consistentLibraries)
                                                    @foreach($item->consistentLibraries as $consistentLibrary)
                                                        <p>
                                                            {{ __('search.'.$consistentLibrary->library->field ) }}
                                                        </p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{$item->search_text}}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                @if($item->consistentFollowers)
                                                    @foreach($item->consistentFollowers as $consistentFollower)
                                                        <p>
                                                            {{$consistentFollower->user->first_name .' '. $consistentFollower->user->last_name}}
                                                        </p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            {{ $item->deadline ? Carbon\Carbon::parse($item->deadline)->format('d-m-Y') : null}}

                                        </td>
                                        <td title="{{ __('search.termination_of_control') }}">
                                            <button class="btn_close_modal my-delete-item" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal" data-id="{{ $item->id }}"><i
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
                    <form action="{{ route('consistent_destroy') }}" id="delete_form" method="POST">
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
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/consistent-search/script.js') }}"></script>
    @endsection
@endsection

