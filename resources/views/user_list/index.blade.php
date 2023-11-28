@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/user_list/index.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <x-breadcrumbs :title="__('sidebar.search')" />

    <section class="section">
        <div class="col">
            <div class="card">

                <div class="card-body">
                    <x-back-previous-url />
                    <div class="buttons">
                        <button class="btn btn-primary">{{ __('content.absentees') }}</button>
                        <button class="btn btn-primary">{{ __('content.Some') }}</button>
                        <button class="btn btn-primary">{{ __('content.Present') }}</button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>

                                </th>

                                <th scope="col">
                                    {{ __('content.status') }}
                                </th>

                                <th scope="col">
                                    %
                                </th>

                                <th scope="col">
                                    {{ __('content.first_name') }}
                                </th>

                                <th>
                                    {{ __('content.last_name') }}
                                </th>

                                <th>
                                    {{ __('content.middle_name') }}
                                </th>

                                <th>
                                    {{ __('content.date_of_birth_') }}
                                </th>

                                <th>
                                    {{ __('content.ties') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($check_user_list as $item )
                           {{-- {{dd($item)}} --}}
                           <tr>
                            <td class="checkboxTd">
                                <div>
                                    <div>
                                        <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}" value="absentees">
                                        <span>{{ __('content.absentees') }}</span>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}"  value="some">
                                        <span>{{ __('content.some') }}</span>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}"  value="present">
                                        <span>{{ __('content.present') }}</span>
                                    </div>
                                </div>
                            </td>

                            <td>{{$item->status}}</td>
                            <td></td>
                            {{-- {{dd($item->man)}} --}}
                            <td>{{$item->name}}</td>
                            <td>{{$item->surname}}</td>
                            <td>{{$item->patronymic}}</td>
                            <td>{{$item->birthday_str}}</td>

                            <td></td>
                        </tr>

                           @endforeach

                        </tbody>
                    </table>
                    <!-- End Bordered Table -->
                </div>
            </div>

            {{-- @yield('permissions-content') --}}

        </div>
    </section>

@section('js-scripts')
    <script src="{{ asset('assets/js/user_list/index.js') }}"></script>
@endsection
@endsection
