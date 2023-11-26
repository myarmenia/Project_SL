@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/user_list/index.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.search') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>---
                    <li class="breadcrumb-item active">{{ __('sidebar.search-file') }}</li>---
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="buttons">
                        <button class="btn btn-primary">{{ __('content.absentees') }}</button>
                        <button class="btn btn-primary">{{ __('content.some') }}</button>
                        <button class="btn btn-primary">{{ __('content.present') }}</button>
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
                            {{-- {{ dd($item)}} --}}
                            {{-- @if ($item->man()->exists())
                            {{ dd(11)}} --}}
                                @if ($item->man()->exists())
                                    {{-- {{ dd($item->man)}} --}}
                                {{-- {{dd($item->man)}} --}}
                                    <div class="parent_" >
                                        <tr class="parent_like" style="border:red !important">
                                            <td class="checkboxTd">
                                                <div>
                                                    <div>
                                                        <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}"  value="present">
                                                        <span>{{ __('content.present') }}</span>
                                                    </div>

                                                </div>
                                            </td>
                                            <td>{{$item->status}}</td>
                                            <td></td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->surname}}</td>
                                            <td>{{$item->patronymic}}</td>
                                            <td>{{$item->birthday_str}}</td>

                                            <td></td>
                                        </tr>
                                        {{-- {{ dd($item->man)}} --}}
                                        @foreach ($item->man as $data)
                                        {{-- {{dd($item->findManName($data->id))}} --}}
                                        {{-- {{dd($data)}} --}}
                                        {{-- {{dd($data->FirstName->first_name,$data->lastName->last_name)}} --}}
                                            <tr class="parent_like_child">
                                                <td class="checkboxTd">
                                                    <div>
                                                        <div>
                                                            <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}"  value="some">
                                                            <span>{{ __('content.some') }}</span>
                                                        </div>

                                                    </div>
                                                </td>
                                                {{-- {{dd($data->FirstName->first_name)}} --}}
                                                {{-- <td>{{$item->status}}</td> --}}
                                                <td></td>
                                                <td>{{$data->pivot->procent}}</td>
                                                <td>{{$data->FirstName->first_name}}</td>
                                                <td>{{$data->lastName->last_name}}</td>
                                                <td>{{$data->MiddleName ? $data->MiddleName->middle_name : null}}</td>


                                                <td>{{$data->birthday_str}}</td>
                                                <td></td>


                                            </tr>

                                        @endforeach



                                    </div>
                                @else
                                    {{--  --}}
                                    <div class="parent_">
                                        <tr class="new">
                                            <td class="checkboxTd">
                                                <div>

                                                    <div>
                                                        <input class="form-check-input" type="radio" name="list_{{$item->id}}" data-id="{{$item->id}}" value="absentees">
                                                        <span>{{ __('content.absentees') }}</span>
                                                    </div>
                                                   
                                                </div>
                                            </td>

                                            <td>{{$item->status}}</td>
                                            <td></td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->surname}}</td>
                                            <td>{{$item->patronymic}}</td>
                                            <td>{{$item->birthday_str}}</td>

                                            <td></td>
                                        </tr>
                                    </div>

                                    {{--  --}}
                                @endif


                                {{-- <tr>
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
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->surname}}</td>
                                    <td>{{$item->patronymic}}</td>
                                    <td>{{$item->birthday_str}}</td>

                                    <td></td>
                                </tr> --}}
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
