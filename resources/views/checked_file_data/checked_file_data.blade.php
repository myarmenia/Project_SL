@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/checked_file_data/index.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.roles') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    ----
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('pagetitle.roles') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="flex justify-between items-center">
                        <h5 class="card-title">Table 1</h5>
                        <h5>{{$count}}</h5>
                        {{-- <button data-bs-toggle="modal" data-bs-target="#fullscreenModal"
                            class="btn btn-secondary h-fit w-fit">
                            add new
                        </button> --}}
                        <a target="blank"
                            href="{{ route('file.show-file', ['locale' => app()->getLocale(), 'filename' => $fileName]) }}">
                            <i class="bi bi-file-earmark-arrow-down-fill"></i>
                            <span>Տեսնել ֆայլը</span>
                        </a>
                    </div>
                    <!-- Bordered Table -->
                    <table id="file-data-table" class="table table-bordered">
                        <thead>
                            <tr>

                                <th scope="col">confirmed</th>
                                <th scope="col">id</th>
                                <th scope="col">status</th>
                                <th scope="col">procent</th>
                                <th scope="col">name</th>
                                <th scope="col">surname</th>
                                <th scope="col">patronymic</th>
                                <th scope="col">birthday</th>
                                <th scope="col">address</th>
                                <th scope="col">desc</th>
                                <th scope="col" class="td-xs">File</th>
                            </tr>

                        </thead>
                        <tbody class="tbody_elements">

                            @foreach ($diffList as $men)
                                <tr id='{{ $men->id }}' class="start" dataFirst-item-id="{{ $men->id }}">

                                    <td scope="row" class="td-icon">
                                        <i class="bi icon icon-y icon-base bi-check check_btn" id="check_btn"
                                            dataFirst-i-id="{{ $men->id }}"></i>
                                    </td>
                                    <td scope="row"></td>
                                    <td scope="row">{{ $men['status'] }}</td>
                                    <td scope="row" class="td-icon">
                                        %
                                        <!-- <i class="bi icon icon-sm bi-trash"></i> -->
                                    </td>
                                    <td contenteditable="true" spellcheck="false" data-item-id="{{ $men->id }}"
                                        data-column="name" onclick="makeEditable(this)">
                                        {{ $men['name'] }}
                                    </td>
                                    <td contenteditable="true" spellcheck="false" data-item-id="{{ $men->id }}"
                                        data-column="surname" onclick="makeEditable(this)">
                                        {{ $men['surname'] }}
                                    </td>
                                    <td contenteditable="true" spellcheck="false" data-item-id="{{ $men->id }}"
                                        data-column="patronymic" onclick="makeEditable(this)">
                                        {{ $men['patronymic'] }}
                                    </td>
                                    <td contenteditable="true" spellcheck="false" data-item-id="{{ $men->id }}"
                                        data-column="birthday" onclick="makeEditable(this)">
                                        {{ $men['birthday'] }}
                                    </td>
                                    <td contenteditable="true" spellcheck="false" data-item-id="{{ $men->id }}"
                                        data-column="address" onclick="makeEditable(this)">
                                        {{ $men['address'] }}
                                    </td>
                                    <td class="td-lg td-scroll-wrapper">
                                        <div class="td-scroll">
                                            {!! $men['paragraph'] !!}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="file-box-title">
                                            <a target="blank" href="#">
                                                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                                <span>file name</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @foreach ($men['child'] ?? [] as $child)
                                    <tr class="child_items-{{ $men->id }}">
                                        <td scope="row" class="td-icon">
                                            <div class="form-check icon icon-sm">
                                                <input class="form-check-input" type="checkbox"
                                                    id="checkbox{{ $child['man']->id }}"
                                                    data-item-id="{{ $child['man']->id }}"
                                                    data-parent-id='{{ $men->id }}' />
                                            </div>
                                        </td>
                                        <td scope="row">{{ $child['man']['id'] }}</td>
                                        <td scope="row"></td>

                                        <td scope="row" class="td-icon">{{ substr($child['procent'], 0, 5) }}</td>
                                        <td spellcheck="false">
                                            {{ $child['man']['firstName']['first_name'] }}</td>
                                        <td spellcheck="false">
                                            {{ $child['man']['lastName']['last_name'] }}</td>
                                        <td spellcheck="false">
                                            @if ($child['man']['middleName'] !== null)
                                                {{ $child['man']['middleName']['middle_name'] }}
                                            @endif
                                        </td>
                                        <td spellcheck="false">
                                            @if ($child['man']['birthday_str'] !== null)
                                                {{ $child['man']['birthday_str'] }}
                                            @endif
                                        </td>
                                        <td spellcheck="false">--address--</td>
                                        <td class="td-lg td-scroll-wrapper">
                                            <div class="td-scroll">

                                            </div>
                                        </td>

                                        <td>
                                            <div class="file-box-title">
                                                <a target="blank" href="#">
                                                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                                    <span>file name</span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach



                        </tbody>
                    </table>
                    <!-- End Bordered Table -->

                </div>
            </div>

            @yield('permissions-content')

        </div>
    </section>

@section('js-scripts')
    <script src="{{ asset('assets/js/checked_file_data/checkedFileData.js') }}"></script>
    <script></script>
@endsection
@endsection
