@extends('layouts.auth-app')

@section('style')
    <link href="{{ asset('assets/css/checked_file_data/index.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/contact/contact.css') }}">
    <link href="{{ asset('assets/css/main/table.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="pagetitle-wrapper">
        <div class="pagetitle">
            <h1>{{ __('sidebar.bibliography') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('pagetitle.main') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('pagetitle.data-comparison') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->
    {{-- @section('loader')
    <div id="loader" class="loader"></div>
    <div id="loader">
      fa fa-spinner fa-1x fa-spin
      <i class="bi bi-arrow-repeat" id="loaderIcon"></i>
  </div>
@endsection --}}


    <section class="section">
        <input type="hidden" id="file-name" data-file-name={{ $fileName }}>
        <div class="col">
            <div class="card">
                <div class="px-3 flex justify-between items-center">
                    <h5 class="card-title">{{ $count }}</h5>
                    {{-- <button data-bs-toggle="modal" data-bs-target="#fullscreenModal"
                    class="btn btn-secondary h-fit w-fit">
                    add new
                </button> --}}
                    <a target="blank"
                        href="{{ route('file.show-file', ['locale' => app()->getLocale(), 'filename' => $fileName]) }}">
                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                        <span>{{ __('search.View_the_file') }}</span>
                    </a>

                </div>
                <div class="card-body">
                  {{-- @yield('loader') --}}
                    <!-- Bordered Table -->
                    <table id="file-data-table" class="table table-bordered resizeMe person_table" data-section-name="open"
                        data-table-name="man">
                        <thead>
                            <tr>
                                <th scope="col" class="filter-th" data-sort="null" data-type="standart-complex">
                                    {{ __('search.confirmed') }}<i data-field-name="find_man_id"></i>
                                </th>

                                <th scope="col">
                                    {{ __('search.id') }}
                                </th>

                                <th scope="col">
                                    {{ __('search.status') }}
                                </th>

                                <th scope="col">
                                    {{ __('search.procent') }}
                                </th>

                                <th scope="col" class="filter-th" data-sort="null" data-type="standart-complex">
                                    {{ __('search.name') }}
                                    <i class="fa fa-filter" aria-hidden="true" data-field-name="name"></i>
                                </th>

                                <th scope="col" class="filter-th" data-sort="null" data-type="standart-complex">
                                    {{ __('search.last_name') }}
                                    <i class="fa fa-filter" aria-hidden="true"data-field-name="surname"></i>
                                </th>

                                <th scope="col" class="filter-th" data-sort="null" data-type="standart-complex">
                                    {{ __('search.patronymic') }}
                                    <i class="fa fa-filter" aria-hidden="true" data-field-name="patronymic"></i>
                                </th>

                                <th scope="col" class="filter-th" data-sort="null" data-type="standart-complex">
                                    {{ __('search.birthday') }}
                                    <i class="fa fa-filter" aria-hidden="true" data-field-name="birthday"></i>
                                </th>

                                <th scope="col">
                                    {{ __('search.address') }}
                                </th>

                                <th scope="col">
                                    {{ __('search.desc') }}
                                </th>

                                {{-- <th scope="col" class="td-xs">
                                    {{ __('search.file') }}
                                </th> --}}
                                <th scope="col">{{ __('button.relations') }}</th>


                            </tr>

                        </thead>
                        <tbody class="tbody_elements">

                            @foreach ($diffList as $men)
                                <tr id='{{ $men->id }}' class="start" dataFirst-item-id="{{ $men->id }}"
                                    @if (!$men->editable) style="background-color: rgb(195, 194, 194)" @endif>

                                    <td scope="row" class="td-icon">
                                        <div class="td_div_icons">
                                            <i class="bi icon icon-y icon-base bi-check check_btn" id="check_btn"
                                                @if (!$men->editable) style="color: green; pointer-events: none" @endif
                                                dataFirst-i-id="{{ $men->id }}"></i>
                                            @if ($men->selectedStatus == 'like')
                                                <i class="bi bi-arrow-counterclockwise backIcon"
                                                    dataBackIcon-parent-id="{{ $men->generalParentId }}"
                                                    dataBackIcon-child-id="{{ $men->id }}" id="backIcon"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td scope="row">
                                        @if (!$men->editable)
                                            {{ $men->id }}
                                        @endif
                                    </td>
                                    <td scope="row">{{ $men['status'] }}</td>
                                    <td scope="row" class="td-icon">
                                        {{ $men->procent ? $men->procent . '%' : null }}
                                        <!-- <i class="bi icon icon-sm bi-trash"></i> -->
                                    </td>

                                    <td contenteditable={{ $men->editable }} spellcheck="false"
                                        data-item-id="{{ $men->id }}" data-column="name"
                                        @if ($men->editable) onclick="makeEditable(this)" @endif>
                                        {{ $men['name'] }}
                                    </td>
                                    <td contenteditable={{ $men->editable }} spellcheck="false"
                                        data-item-id="{{ $men->id }}" data-column="surname"
                                        @if ($men->editable) onclick="makeEditable(this)" @endif>
                                        {{ $men['surname'] }}
                                    </td>
                                    <td contenteditable={{ $men->editable }} spellcheck="false"
                                        data-item-id="{{ $men->id }}" data-column="patronymic"
                                        @if ($men->editable) onclick="makeEditable(this)" @endif>
                                        {{ $men['patronymic'] }}
                                    </td>
                                    <td contenteditable={{ $men->editable }} spellcheck="false"
                                        data-item-id="{{ $men->id }}" data-column="birthday"
                                        @if ($men->editable) onclick="makeEditable(this)" @endif>
                                        {{ $men['birthday'] }}
                                    </td>
                                    <td spellcheck="false" data-item-id="{{ $men->id }}" data-column="address" class="td_par_address">
                                        @if (gettype($men['address']) != 'object')
                                        <div style="text-wrap:balance;overflow-y:auto;max-height:130px;line-height:20px">{{ $men['address'] }}</div>
                                        @endif
                                    </td>
                                    <td class="td-lg td-scroll-wrapper">
                                        <div class="td-scroll">
                                            {!! $men['paragraph'] !!}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="file-box-title">
                                            {{-- <a target="blank" href="#">
                                                <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                                <span>file name</span>
                                            </a> --}}
                                            @if (!$men->editable)
                                                <a target="blank">
                                                    <i class="bi bi-eye open-eye" data-id="{{ $men->id }}"></i>
                                                    <span></span>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @foreach ($men['child'] ?? [] as $child)
                                    {{-- @if ($child['man']['id'] == 16)
                                    @dd($child['man']);
                                @endif --}}
                                    {{-- @dd($child['man']['errorMessage']) --}}
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
                                        <td scope="row">
                                            @if ($child['man']['errorMessage'] === 'Սխալ ծննդյան ֆորմատ')
                                                <p style="color:red; overflow-y: clip; text-overflow: ellipsis">Սխալ
                                                    ծննդյան ֆորմատ</p>
                                            @endif
                                        </td>

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
                                        <td spellcheck="false"
                                            style="background-color: {{ $child['man']['errorMessage'] === 'Սխալ ծննդյան ֆորմատ' ? 'red' : 'white' }}">
                                            @if ($child['man']['birthday_str'] !== null)
                                                {{ $child['man']['birthday'] ?? $child['man']['birthday_str'] }}
                                            @endif
                                        </td>
                                        <td spellcheck="false" class="address22--"></td>
                                        <td class="td-lg td-scroll-wrapper">
                                            <div class="td-scroll">

                                            </div>
                                        </td>

                                        <td>
                                            <div class="file-box-title">
                                                {{-- <a target="blank" href="#">
                                                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
                                                    <span>file name</span>
                                                </a> --}}
                                                <a target="blank">
                                                    <i class="bi bi-eye open-eye" data-id="{{ $child['man']->id }}"></i>
                                                    <span></span>
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
    <script>
        let lang = "{{ app()->getLocale() }}"
        let ties = "{{ __('content.ties') }}"
        let parent_table_name = "{{ __('content.man') }}"
    </script>
    <script src="{{ asset('assets/js/bibliography/checked_file_data/checkedFileData.js') }}"></script>
    <script src="{{ asset('assets/js/contact/contact.js') }}"></script>
@endsection
@endsection
