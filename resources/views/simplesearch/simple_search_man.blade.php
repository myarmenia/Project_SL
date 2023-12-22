@extends('layouts.include-app')
@section('include-css')
    <link href="{{ asset('assets/css/main/open-modal.css') }}" rel="stylesheet" />
@endsection

@section('content-include')
    <a class="closeButton"></a>
    <div class="inContent">
        <form id="manForm" action="/{{ app()->getLocale() }}/simplesearch/result_man" method="post">
            @if (!empty($checkUrl) && $checkUrl !== 'advancedsearch')
                <x-back-previous-url />
            @endif
            <div class="buttons">
                <input type="checkbox" @if (isset($search_params['soundArmenianInput']) && $search_params['soundArmenianInput'] == 1) checked @endif class="search-input"
                    name="soundArmenianInput" value="1">
                <label for="">Հնչյուն․</label>

                <input type="button" class="k-button" value="{{ __('content.and') }}" id="man_and" />
                <input type="button" class="k-button" value="{{ __('content.or') }}" id="man_or" />
                <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
                @if (!isset($type))
                    <a href="{{ route('simple_search_man',['n'=> 't']) }}" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
                    <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" />
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['last_name'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManLastNameFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['last_name'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManLastName">
                        <div class="item">
                            <span><?php echo $search_params['last_name'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="last_name[]" value="<?php echo $search_params['last_name'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="last_name_type" id="searchManLastNameType" value="<?php echo $search_params['last_name_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManLastName">{{ __('content.last_name') }}</label>
                <input type="text" name="last_name[]" id="searchManLastName" class="getName oneInputSaveEnter" />

                <x-select-distance
                    :search-data="$search_params['last_name_distance'] ?? ''"
                    name="last_name_distance"
                    class="distance distance_searchManLastName" />

                @if (isset($search_params['last_name_type']) && $search_params['last_name_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManLastNameOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['last_name_type']) && $search_params['last_name_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManLastNameOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['last_name_type']) && $search_params['last_name_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManLastNameOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['first_name'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManFirstNameFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['first_name'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManFirstName">
                        <div class="item">
                            <span><?php echo $search_params['first_name'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="first_name[]" value="<?php echo $search_params['first_name'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="first_name_type" id="searchManFirstNameType" value="<?php echo $search_params['first_name_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManFirstName">{{ __('content.first_name') }}</label>
                <input type="text" name="first_name[]" id="searchManFirstName" class="getName oneInputSaveEnter" />

                <x-select-distance 
                    :search-data="$search_params['first_name_distance'] ?? '' " 
                    name="first_name_distance" 
                    class="distance distance_searchManFirstName" />

                @if (isset($search_params['first_name_type']) && $search_params['first_name_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManFirstNameOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['first_name_type']) && $search_params['first_name_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManFirstNameOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['first_name_type']) && $search_params['first_name_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManFirstNameOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['middle_name'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManMiddleNameFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['middle_name'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManMiddleName">
                        <div class="item">
                            <span><?php echo $search_params['middle_name'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="middle_name[]" value="<?php echo $search_params['middle_name'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="middle_name_type" id="searchManMiddleNameType" value="<?php echo $search_params['middle_name_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManMiddleName">{{ __('content.middle_name') }}</label>
                <input type="text" name="middle_name[]" id="searchManMiddleName" class="getName oneInputSaveEnter" />

                <x-select-distance 
                    :search-data="$search_params['middle_name_distance'] ?? '' " 
                    name="middle_name_distance" 
                    class="distance distance_searchManMiddleName" />

                @if (isset($search_params['middle_name_type']) && $search_params['middle_name_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManMiddleNameOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['middle_name_type']) && $search_params['middle_name_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManMiddleNameOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['middle_name_type']) && $search_params['middle_name_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManMiddleNameOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['auto_name'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="manLFMNameFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['auto_name'])-1 ; $i++ ) { ?>
                    <li id="listItemmanLFMName">
                        <div class="item">
                            <span><?php echo $search_params['auto_name'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="auto_name[]" value="<?php echo $search_params['auto_name'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="auto_name_type" id="manLFMNameType" value="<?php echo $search_params['auto_name_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="manLFMName">{{ __('content.last_name') }} {{ __('content.first_name') }}
                    {{ __('content.middle_name') }}</label>
                <input type="text" name="auto_name[]" id="manLFMName" class="oneInputSaveEnter" />
                @if (isset($search_params['auto_name_type']) && $search_params['auto_name_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="manLFMNameOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['auto_name_type']) && $search_params['auto_name_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="manLFMNameOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['auto_name_type']) && $search_params['auto_name_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="manLFMNameOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <div class="forForm">
                <label for="searchManDateOfBirth">{{ __('content.date_of_birth') }}</label>
                <input type="text" name="birthday" id="searchManDateOfBirth" style="width: 505px;"
                    onkeydown="validateNumber(event,'searchManDateOfBirth',12)"
                    class="oneInputSaveDateMan oneInputSaveEnter" />
                    <x-date-filter-search
                        :search-data="$search_params['date_search_birthday'] ?? '' "
                        name="date_search_birthday"
                        inpName="end_birthday" />
            </div>

            <?php if (isset($search_params) && isset($search_params['approximate_year'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManApproximateYearFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['approximate_year'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManApproximateYear">
                        <div class="item">
                            <span><?php echo $search_params['approximate_year'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="approximate_year[]" value="<?php echo $search_params['approximate_year'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="approximate_year_type" id="searchManApproximateYearType"
                    value="<?php echo $search_params['approximate_year_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManApproximateYear">{{ __('content.approximate_year') }}</label>
                <input type="text" name="approximate_year[]" id="searchManApproximateYear"
                    class="oneInputSaveMan oneInputSaveEnter" />
                @if (isset($search_params['approximate_year_type']) && $search_params['approximate_year_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManApproximateYearOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['approximate_year_type']) && $search_params['approximate_year_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManApproximateYearOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['approximate_year_type']) && $search_params['approximate_year_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManApproximateYearOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['passport'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManPassportNumberFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['passport'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManPassportNumber">
                        <div class="item">
                            <span><?php echo $search_params['passport'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="passport[]" value="<?php echo $search_params['passport'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="passport_type" id="searchManPassportNumberType"
                    value="<?php echo $search_params['passport_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManPassportNumber">{{ __('content.passport_number') }}</label>
                <input type="text" name="passport[]" id="searchManPassportNumber" class="oneInputSaveEnter" />

                <x-select-distance 
                    :search-data="$search_params['password_distance'] ?? '' " 
                    name="password_distance" 
                    class="distance distance_searchManPassportNumber" />

                @if (isset($search_params['passport_type']) && $search_params['passport_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPassportNumberOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['passport_type']) && $search_params['passport_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPassportNumberOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['passport_type']) && $search_params['passport_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPassportNumberOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['gender_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManGenderFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['gender_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManGender">
                        <div class="item">
                            <span><?php echo $search_params['gender_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="gender_id[]" value="><?php echo $search_params['gender_id'][$i]; ?>">
                        <input type="hidden" name="gender_idName[]" value="><?php echo $search_params['gender_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="gender_id_type" id="searchManGenderType" value="<?php echo $search_params['gender_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManGender">{{ __('content.gender') }}</label>
                <input type="button" dataName="searchManGender" dataId="searchManGenderId" dataTableName="fancy/gender"
                    class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name" data-table-name="gender" />
                <input type="text" name="gender_name" id="searchManGender" dataTableName="gender"
                    dataInputId="searchManGenderId" class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="gender" />
                @if (isset($search_params['gender_id_type']) && $search_params['gender_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManGenderOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['gender_id_type']) && $search_params['gender_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManGenderOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['gender_id_type']) && $search_params['gender_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManGenderOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="gender_id[]" id="searchManGenderId" />
                <datalist id="gender" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['nation_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManNationalityFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['nation_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManNationality">
                        <div class="item">
                            <span><?php echo $search_params['nation_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div><input type="hidden" name="nation_id[]" value="<?php echo $search_params['nation_id'][$i]; ?>">
                        <input type="hidden" name="nation_idName[]" value="<?php echo $search_params['nation_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="nation_id_type" id="searchManNationalityType" value="<?php echo $search_params['nation_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManNationality">{{ __('content.nationality') }}</label>
                <input type="button" dataName="searchManNationality" dataId="searchManNationalityId"
                    dataTableName="fancy/nation" class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name" data-table-name="nation" />
                <input type="text" name="nation_name" id="searchManNationality" dataTableName="nation"
                    dataInputId="searchManNationalityId" class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="nation" />
                @if (isset($search_params['nation_id_type']) && $search_params['nation_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManNationalityOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['nation_id_type']) && $search_params['nation_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManNationalityOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['nation_id_type']) && $search_params['nation_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManNationalityOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="nation_id[]" id="searchManNationalityId" />
                <datalist id="nation" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['citizenship_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManCitizenshipFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['citizenship_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManCitizenship">
                        <div class="item">
                            <span><?php echo $search_params['citizenship_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="citizenship_id[]" value="<?php echo $search_params['citizenship_id'][$i]; ?>">
                        <input type="hidden" name="citizenship_idName[]" value="<?php echo $search_params['citizenship_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="citizenship_id_type" id="searchManCitizenshipType"
                    value="<?php echo $search_params['citizenship_id_type'] ?? ''; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManCitizenship">{{ __('content.citizenship') }}</label>
                <input type="button" dataName="searchManCitizenship" dataId="searchManCitizenshipId"
                    dataTableName="fancy/country" class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name" data-table-name="country" />
                <input type="text" name="citizenship_name" id="searchManCitizenship" dataTableName="country"
                    dataInputId="searchManCitizenshipId" class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="country" />
                @if (isset($search_params['citizenship_id_type']) && $search_params['citizenship_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManCitizenshipOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['citizenship_id_type']) && $search_params['citizenship_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManCitizenshipOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['citizenship_id_type']) && $search_params['citizenship_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManCitizenshipOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="citizenship_id[]" id="searchManCitizenshipId" />
                <datalist id="country" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['country_ate_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManPlaceOfBirthFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['country_ate_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManPlaceOfBirth">
                        <div class="item">
                            <span><?php echo $search_params['country_ate_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="country_ate_id[]" value="<?php echo $search_params['country_ate_id'][$i]; ?>">
                        <input type="hidden" name="country_ate_idName[]" value="<?php echo $search_params['country_ate_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="country_ate_id_type" id="searchManPlaceOfBirthType"
                    value="<?php echo $search_params['citizenship_id_type'] ?? ''; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManPlaceOfBirth">{{ __('content.place_of_birth') }}</label>
                <input type="button" dataName="searchManPlaceOfBirth" dataId="searchManPlaceOfBirthId"
                    dataTableName="fancy/country_ate" class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal" data-bs-target="#fullscreenModal" data-fieldname="name"
                    data-table-name="country_ate" />
                <input type="text" name="place_of_birth" id="searchManPlaceOfBirth" dataTableName="country_ate"
                    dataInputId="searchManPlaceOfBirthId" class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="country_ate" />
                @if (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="country_ate_id[]" id="searchManPlaceOfBirthId" />
                <datalist id="country_ate" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['region_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManPlaceOfBirthAreaLocalFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['region_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManPlaceOfBirthAreaLocal">
                        <div class="item">
                            <span><?php echo $search_params['region_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="region_id[]" value="<?php echo $search_params['region_id'][$i]; ?>">
                        <input type="hidden" name="region_idName[]" value="<?php echo $search_params['region_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="region_id_type" id="searchManPlaceOfBirthAreaLocalType"
                    value="<?php echo $search_params['region_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManPlaceOfBirthAreaLocal">{{ __('content.place_of_birth_area_local') }}</label>
                <input type="button" dataName="searchManPlaceOfBirthAreaLocal" dataId="searchManPlaceOfBirthAreaLocalId"
                    dataTableName="fancy/region" class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name" data-table-name="region" />
                <input type="text" name="place_of_birth_area_local" id="searchManPlaceOfBirthAreaLocal"
                    dataTableName="region" dataInputId="searchManPlaceOfBirthAreaLocalId"
                    class="oneInputSaveEnter fetch_input_title get_datalist" list="region" />
                @if (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthAreaLocalOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthAreaLocalOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthAreaLocalOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="region_id[]" id="searchManPlaceOfBirthAreaLocalId" />
                <datalist id="region" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['locality_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManPlaceOfBirthSettlementLocalFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['locality_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManPlaceOfBirthSettlementLocal">
                        <div class="item">
                            <span><?php echo $search_params['locality_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="locality_id[]" value="<?php echo $search_params['locality_id'][$i]; ?>">
                        <input type="hidden" name="locality_idName[]" value="<?php echo $search_params['locality_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="locality_id_type" id="searchManPlaceOfBirthSettlementLocalType"
                    value="<?php echo $search_params['locality_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label
                    for="searchManPlaceOfBirthSettlementLocal">{{ __('content.place_of_birth_settlement_local') }}</label>
                <input type="button" dataName="searchManPlaceOfBirthSettlementLocal"
                    dataId="searchManPlaceOfBirthSettlementLocalId" dataTableName="fancy/locality"
                    class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name" data-table-name="locality" />
                <input type="text" name="place_of_birth_settlement_local" id="searchManPlaceOfBirthSettlementLocal"
                    dataTableName="locality" dataInputId="searchManPlaceOfBirthSettlementLocalId"
                    class="oneInputSaveEnter fetch_input_title get_datalist" list="locality" />
                @if (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthSettlementLocalOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthSettlementLocalOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthSettlementLocalOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="locality_id[]" id="searchManPlaceOfBirthSettlementLocalId" />
                <datalist id="locality" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['region'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManPlaceOfBirthAreaFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['region'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManPlaceOfBirthArea">
                        <div class="item">
                            <span><?php echo $search_params['region'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="region[]" value="<?php echo $search_params['region'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="region_type" id="searchManPlaceOfBirthAreaType"
                    value="<?php echo $search_params['region_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManPlaceOfBirthArea">{{ __('content.place_of_birth_area') }}</label>
                <input type="text" name="region[]" id="searchManPlaceOfBirthArea" class="oneInputSaveEnter" />

                <x-select-distance
                    :search-data="$search_params['region_name_distance'] ?? '' "
                    name="region_name_distance"
                    class="distance distance_searchManPlaceOfBirthArea" />

                @if (isset($search_params['region_type']) && $search_params['region_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthAreaOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['region_type']) && $search_params['region_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthAreaOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['region_type']) && $search_params['region_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthAreaOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['locality'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManPlaceOfBirthSettlementFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['locality'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManPlaceOfBirthSettlement">
                        <div class="item">
                            <span><?php echo $search_params['locality'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="locality[]" value="<?php echo $search_params['locality'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="locality_type" id="searchManPlaceOfBirthSettlementType"
                    value="<?php echo $search_params['locality_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManPlaceOfBirthSettlement">{{ __('content.place_of_birth_settlement') }}</label>
                <input type="text" name="locality[]" id="searchManPlaceOfBirthSettlement"
                    class="oneInputSaveEnter" />

                <x-select-distance
                    :search-data="$search_params['locality_name_distance'] ?? '' "
                    name="locality_name_distance"
                    class="distance distance_searchManPlaceOfBirthSettlement" />

                @if (isset($search_params['locality_type']) && $search_params['locality_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthSettlementOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['locality_type']) && $search_params['locality_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthSettlementOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['locality_type']) && $search_params['locality_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPlaceOfBirthSettlementOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['language_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManKnowledgeOfLanguagesFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['language_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManKnowledgeOfLanguages">
                        <div class="item">
                            <span><?php echo $search_params['language_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="language_id[]" value="<?php echo $search_params['language_id'][$i]; ?>">
                        <input type="hidden" name="language_idName[]" value="<?php echo $search_params['language_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="language_id_type" id="searchManKnowledgeOfLanguagesType"
                    value="<?php echo $search_params['language_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManKnowledgeOfLanguages">{{ __('content.knowledge_of_languages') }}</label>
                <input type="button" dataName="searchManKnowledgeOfLanguages" dataId="searchManKnowledgeOfLanguagesId"
                    dataTableName="fancy/language" class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name" data-table-name="language" />
                <input type="text" name="language" id="searchManKnowledgeOfLanguages" dataTableName="language"
                    dataInputId="searchManKnowledgeOfLanguagesId" class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="language" />
                @if (isset($search_params['language_id_type']) && $search_params['language_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManKnowledgeOfLanguagesOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['language_id_type']) && $search_params['language_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManKnowledgeOfLanguagesOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['language_id_type']) && $search_params['language_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManKnowledgeOfLanguagesOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="language_id[]" id="searchManKnowledgeOfLanguagesId" />
                <datalist id="language" class="input_datalists" style="width: 500px;"></datalist>

            </div>


            <?php if (isset($search_params) && isset($search_params['attention'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManAttentionFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['attention'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManAttention">
                        <div class="item">
                            <span><?php echo $search_params['attention'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="attention[]" value="<?php echo $search_params['attention'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="attention_type" id="searchManAttentionType" value="<?php echo $search_params['attention_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManAttention">{{ __('content.attention') }}</label>
                <input type="text" name="attention[]" id="searchManAttention"
                    class="oneInputSaveMan oneInputSaveEnter" />

                <x-select-distance
                    :search-data="$search_params['attention_distance'] ?? '' "
                    name="attention_distance"
                    class="distance distance_searchManAttention" />

                @if (isset($search_params['attention_type']) && $search_params['attention_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManAttentionOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['attention_type']) && $search_params['attention_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManAttentionOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['attention_type']) && $search_params['attention_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManAttentionOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['more_data'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManAdditionalInformationPersonFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['more_data'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManAdditionalInformationPerson">
                        <div class="item">
                            <span><?php echo $search_params['more_data'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="more_data[]" value="<?php echo $search_params['more_data'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="more_data_type" id="searchManAdditionalInformationPersonType"
                    value="<?php echo $search_params['more_data_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label
                    for="searchManAdditionalInformationPerson">{{ __('content.additional_information_person') }}</label>
                <input type="text" name="more_data[]" id="searchManAdditionalInformationPerson"
                    class="oneInputSaveEnter" />

                <x-select-distance
                    :search-data="$search_params['more_data_distance'] ?? '' "
                    name="more_data_distance"
                    class="distance distance_searchManAdditionalInformationPerson" />

                @if (isset($search_params['more_data_type']) && $search_params['more_data_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManAdditionalInformationPersonOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['more_data_type']) && $search_params['more_data_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManAdditionalInformationPersonOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['more_data_type']) && $search_params['more_data_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManAdditionalInformationPersonOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['religion_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManWorshipFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['religion_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManWorship">
                        <div class="item">
                            <span><?php echo $search_params['religion_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="religion_id[]" value="<?php echo $search_params['religion_id'][$i]; ?>">
                        <input type="hidden" name="religion_idName[]" value="<?php echo $search_params['religion_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="religion_id_type" id="searchManWorshipType" value="<?php echo $search_params['religion_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManWorship">{{ __('content.worship') }}</label>
                <input type="button" dataName="searchManWorship" dataId="searchManWorshipId"
                    dataTableName="fancy/religion" class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name" data-table-name="religion" />
                <input type="text" name="religion" id="searchManWorship" dataTableName="religion"
                    dataInputId="searchManWorshipId" class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="religion" />
                @if (isset($search_params['religion_id_type']) && $search_params['religion_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManWorshipOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['religion_id_type']) && $search_params['religion_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManWorshipOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['religion_id_type']) && $search_params['religion_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManWorshipOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="religion_id[]" id="searchManWorshipId" />
                <datalist id="religion" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['occupation'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManOccupationFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['occupation'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManOccupation">
                        <div class="item">
                            <span><?php echo $search_params['occupation'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="occupation[]" value="<?php echo $search_params['occupation'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="occupation_type" id="searchManOccupationType" value="<?php echo $search_params['occupation_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManOccupation">{{ __('content.occupation') }}</label>
                <input type="text" name="occupation[]" id="searchManOccupation"
                    class="oneInputSaveMan oneInputSaveEnter" />

                <x-select-distance
                    :search-data="$search_params['occupation_distance'] ?? '' "
                    name="occupation_distance"
                    class="distance distance_searchManOccupation" />

                @if (isset($search_params['occupation_type']) && $search_params['occupation_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManOccupationOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['occupation_type']) && $search_params['occupation_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManOccupationOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['occupation_type']) && $search_params['occupation_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManOccupationOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['operation_category_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManOperationCategoryFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['operation_category_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManOperationCategory">
                        <div class="item">
                            <span><?php echo $search_params['operation_category_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="operation_category_id[]" value="<?php echo $search_params['operation_category_id'][$i]; ?>">
                        <input type="hidden" name="operation_category_idName[]" value="<?php echo $search_params['operation_category_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="operation_category_id_type" id="searchManOperationCategoryType"
                    value="<?php echo $search_params['operation_category_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManOperationCategory">{{ __('content.operational_category_person') }}</label>
                {{-- <input type="button" dataName="searchManOperationCategory" dataId="searchManOperationCategoryId" dataTableName="fancySearch/operation_category"
                class="addMoreSearch k-icon k-i-search"   /> --}}
                <input type="button" dataName="searchManOperationCategory" dataId="searchManOperationCategoryId"
                    dataTableName="fancy/operation_category" class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal" data-bs-target="#fullscreenModal" data-fieldname="name"
                    data-table-name="operation_category" />
                <input type="text" name="operation_category" id="searchManOperationCategory"
                    dataTableName="operation_category" dataInputId="searchManOperationCategoryId"
                    class="oneInputSaveEnter fetch_input_title get_datalist" list="operation_category" />
                @if (isset($search_params['operation_category_id_type']) && $search_params['operation_category_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManOperationCategoryOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['operation_category_id_type']) && $search_params['operation_category_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManOperationCategoryOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['operation_category_id_type']) && $search_params['operation_category_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManOperationCategoryOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="operation_category_id[]" id="searchManOperationCategoryId" />
                <datalist id="operation_category" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['country_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManCountryCarryingOutSearchFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['country_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManCountryCarryingOutSearch">
                        <div class="item">
                            <span><?php echo $search_params['country_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="country_id[]" value="<?php echo $search_params['country_id'][$i]; ?>">
                        <input type="hidden" name="country_idName[]" value="<?php echo $search_params['country_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="country_id_type" id="searchManCountryCarryingOutSearchType"
                    value="<?php echo $search_params['country_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManCountryCarryingOutSearch">{{ __('content.country_carrying_out_search') }}</label>
                <input type="button" dataName="searchManCountryCarryingOutSearch"
                    dataId="searchManCountryCarryingOutSearchId" dataTableName="fancy/country"
                    class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name" data-table-name="country" />
                <input type="text" name="country" id="searchManCountryCarryingOutSearch" dataTableName="country"
                    dataInputId="searchManCountryCarryingOutSearchId"
                    class="oneInputSaveEnter fetch_input_title get_datalist" list="countryList" />
                @if (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManCountryCarryingOutSearchOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManCountryCarryingOutSearchOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManCountryCarryingOutSearchOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="country_id[]" id="searchManCountryCarryingOutSearchId" />
                <datalist id="countryList" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <div class="forForm">
                <label for="searchManDeclaredWantedListWith">{{ __('content.declared_wanted_list_with') }}</label>
                <input type="text" name="start_wanted" id="searchManDeclaredWantedListWith" style="width: 505px;"
                    onkeydown="validateNumber(event,'searchManDeclaredWantedListWith',12)"
                    class="oneInputSaveEnter oneInputSaveDateMan" />
                    <x-date-filter-search
                        :search-data="$search_params['date_start_wanted'] ?? '' "
                        name="date_start_wanted"
                        inpName="end_start_wanted" />
            </div>

            <div class="forForm">
                <label for="searchManHomeMonitoringStart">{{ __('content.home_monitoring_start') }}</label>
                <input type="text" name="entry_date" id="searchManHomeMonitoringStart" style="width: 505px;"
                    onkeydown="validateNumber(event,'searchManHomeMonitoringStart',12)"
                    class="oneInputSaveEnter oneInputSaveDateMan" />
                    <x-date-filter-search
                        :search-data="$search_params['date_entry_date'] ?? '' "
                        name="date_entry_date"
                        inpName="end_entry_date" />
            </div>

            <div class="forForm">
                <label for="searchManEndMonitoringStart">{{ __('content.end_monitoring_start') }}</label>
                <input type="text" name="exit_date" id="searchManEndMonitoringStart" style="width: 505px;"
                    onkeydown="validateNumber(event,'searchManEndMonitoringStart',12)"
                    class="oneInputSaveEnter oneInputSaveDateMan" />
                    <x-date-filter-search
                        :search-data="$search_params['date_exit_date'] ?? '' "
                        name="date_exit_date"
                        inpName="end_exit_date" />
            </div>

            <?php if (isset($search_params) && isset($search_params['education_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManEducationFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['education_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManEducation">
                        <div class="item">
                            <span><?php echo $search_params['education_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="education_id[]" value="<?php echo $search_params['education_id'][$i]; ?>">
                        <input type="hidden" name="education_idName[]" value="<?php echo $search_params['education_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="education_id_type" id="searchManEducationType"
                    value="<?php echo $search_params['education_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManEducation">{{ __('content.education') }}</label>
                <input type="button" dataName="searchManEducation" dataId="searchManEducationId"
                    dataTableName="fancy/education" class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name" data-table-name="education" />
                <input type="text" name="education" id="searchManEducation" dataTableName="education"
                    dataInputId="searchManEducationId" class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="education" />
                @if (isset($search_params['education_id_type']) && $search_params['education_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManEducationOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['education_id_type']) && $search_params['education_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManEducationOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['education_id_type']) && $search_params['education_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManEducationOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="education_id[]" id="searchManEducationId" />
                <datalist id="education" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['party_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManPartyFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['party_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManParty">
                        <div class="item">
                            <span><?php echo $search_params['party_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="party_id[]" value="<?php echo $search_params['party_id'][$i]; ?>">
                        <input type="hidden" name="party_idName[]" value="<?php echo $search_params['party_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="party_id_type" id="searchManPartyType" value="<?php echo $search_params['party_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManParty">{{ __('content.party') }}</label>
                <input type="button" dataName="searchManParty" dataId="searchManPartyId" dataTableName="fancy/party"
                    class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name" data-table-name="party" />
                <input type="text" name="party" id="searchManParty" dataTableName="party"
                    dataInputId="searchManPartyId" class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="party" />
                @if (isset($search_params['party_id_type']) && $search_params['party_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPartyOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['party_id_type']) && $search_params['party_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPartyOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['party_id_type']) && $search_params['party_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManPartyOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="party_id[]" id="searchManPartyId" />
                <datalist id="party" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['nickname'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManAliasFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['nickname'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManAlias">
                        <div class="item">
                            <span><?php echo $search_params['nickname'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="nickname[]" value="<?php echo $search_params['nickname'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="nickname_type" id="searchManAliasType" value="<?php echo $search_params['nickname_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManAlias">{{ __('content.alias') }}</label>
                <input type="text" name="nickname[]" id="searchManAlias" class="oneInputSaveEnter" />

                <x-select-distance
                    :search-data="$search_params['nickname_distance'] ?? '' "
                    name="nickname_distance"
                    class="distance distance_searchManAlias" />

                @if (isset($search_params['nickname_type']) && $search_params['nickname_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManAliasOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['nickname_type']) && $search_params['nickname_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManAliasOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['nickname_type']) && $search_params['nickname_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManAliasOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['opened_dou'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManFaceOpenedFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['opened_dou'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManFaceOpened">
                        <div class="item">
                            <span><?php echo $search_params['opened_dou'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="opened_dou[]" value="<?php echo $search_params['opened_dou'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="opened_dou_type" id="searchManFaceOpenedType"
                    value="<?php echo $search_params['opened_dou_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManFaceOpened">{{ __('content.face_opened') }}</label>
                <input type="text" name="opened_dou[]" id="searchManFaceOpened"
                    class="oneInputSaveMan oneInputSaveEnter" />

                <x-select-distance
                    :search-data="$search_params['opened_dou_distance'] ?? '' "
                    name="opened_dou_distance"
                    class="distance distance_searchManFaceOpened" />

                @if (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManFaceOpenedOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManFaceOpenedOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManFaceOpenedOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['resource_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchManSourceInformationFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['resource_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchManSourceInformation">
                        <div class="item">
                            <span><?php echo $search_params['resource_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="resource_id[]" value="<?php echo $search_params['resource_id'][$i]; ?>">
                        <input type="hidden" name="resource_idName[]" value="<?php echo $search_params['resource_idName'][$i]; ?>">
                    </li>
                    <?php  } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="resource_id_type" id="searchManSourceInformationType"
                    value="<?php echo $search_params['resource_id_type']; ?>">
            </div>
            <?php  } ?>
            <div class="forForm">
                <label for="searchManSourceInformation">{{ __('content.source_information') }}</label>
                <input type="button" dataName="searchManSourceInformation" dataId="searchManSourceInformationId"
                    dataTableName="fancy/resource" class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal" data-bs-target="#fullscreenModal" data-fieldname="name"
                    data-table-name="resource" />
                <input type="text" name="resource" id="searchManSourceInformation" dataTableName="resource"
                    dataInputId="searchManSourceInformationId" class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="resource" />
                @if (isset($search_params['resource_id_type']) && $search_params['resource_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManSourceInformationOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['resource_id_type']) && $search_params['resource_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManSourceInformationOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['resource_id_type']) && $search_params['resource_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchManSourceInformationOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="resource_id[]" id="searchManSourceInformationId" />
                <datalist id="resource" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            {{-- <div class="forForm">
                <label for="fileSearch">{{ __('content.file_search') }}</label>
                <input type="text" name="content" id="fileSearch" />
                <x-select-distance
                    :search-data="$search_params['opened_dou_distance'] ?? '' "
                    name="content_distance"
                    class="distance distance_fileSearch" />

            </div> --}}
            {{-- <div class="forForm">
                <x-search-count />
            </div> --}}

            <div class="buttons">

            </div>

        </form>
    </div>
    {{-- ================= modal =========================== --}}
    @if (!empty($checkUrl) && $checkUrl !== 'advancedsearch')
        <x-fullscreen-modal />
    @endif

@section('js-include')

    <script src="{{ asset('assets-include/js/script.js') }}"></script>

    <script>
        var currentInputNameMan;
        var currentInputIdMan;
        var searchInput;

        $(document).ready(function() {
            // =============================================
            // interval jquery
            // =============================================
            @if (!isset($search_params['end_birthday']))
                 $("input[name='end_birthday']").hide();
            @endif
            @if (!isset($search_params['end_start_wanted']))
                 $("input[name='end_start_wanted']").hide();
            @endif
            @if (!isset($search_params['end_entry_date']))
                 $("input[name='end_entry_date']").hide();
            @endif
            @if (!isset($search_params['end_exit_date']))
                 $("input[name='end_exit_date']").hide();
            @endif

            $('.date-search-select').on('change', function() {
                var el = $(this);
                var simpelsearch_date_input = el.closest('.date-search-block').find('.date-search-input');
                if (el.val() === '<=>') {
                    simpelsearch_date_input.show();
                } else {
                    simpelsearch_date_input.hide();
                }
            });
            // =============================================
            // interval jquery
            // =============================================

            $('input').map(function() {
                if ($(this).hasClass('oneInputSaveEnter')) {
                    $(this).val('');
                }
            });

            showHideDistance('fileSearch', 'distance_fileSearch');

            showHideDistance('searchManLastName', 'distance_searchManLastName');
            showHideDistance('searchManFirstName', 'distance_searchManFirstName');
            showHideDistance('searchManMiddleName', 'distance_searchManMiddleName');
            showHideDistance('searchManPassportNumber', 'distance_searchManPassportNumber');
            showHideDistance('searchManPlaceOfBirthArea', 'distance_searchManPlaceOfBirthArea');
            showHideDistance('searchManPlaceOfBirthSettlement', 'distance_searchManPlaceOfBirthSettlement');
            showHideDistance('searchManAttention', 'distance_searchManAttention');
            showHideDistance('searchManAdditionalInformationPerson',
                'distance_searchManAdditionalInformationPerson');
            showHideDistance('searchManOccupation', 'distance_searchManOccupation');
            showHideDistance('searchManAlias', 'distance_searchManAlias');
            showHideDistance('searchManFaceOpened', 'distance_searchManFaceOpened');

            searchMultiSelectMaker('searchManLastName', 'last_name');
            searchMultiSelectMaker('searchManFirstName', 'first_name');
            searchMultiSelectMaker('searchManMiddleName', 'middle_name');
            searchMultiSelectMaker('searchManApproximateYear', 'approximate_year');
            searchMultiSelectMaker('searchManPassportNumber', 'passport');
            searchMultiSelectMaker('searchManPlaceOfBirthArea', 'region');
            searchMultiSelectMaker('searchManPlaceOfBirthSettlement', 'locality');
            searchMultiSelectMaker('searchManAttention', 'attention');
            searchMultiSelectMaker('searchManAdditionalInformationPerson', 'more_data');
            searchMultiSelectMaker('searchManOccupation', 'occupation');
            searchMultiSelectMaker('searchManAlias', 'nickname');
            searchMultiSelectMaker('searchManFaceOpened', 'opened_dou');
            searchMultiSelectMaker('searchManAnswer', 'answer');
            searchMultiSelectMaker('manLFMName', 'auto_name');

            searchMultiSelectMakerAutoComplete('searchManGender', 'gender_id');
            searchMultiSelectMakerAutoComplete('searchManNationality', 'nation_id');
            searchMultiSelectMakerAutoComplete('searchManCitizenship', 'citizenship_id');
            searchMultiSelectMakerAutoComplete('searchManPlaceOfBirth', 'country_ate_id');
            searchMultiSelectMakerAutoComplete('searchManPlaceOfBirthAreaLocal', 'region_id');
            searchMultiSelectMakerAutoComplete('searchManPlaceOfBirthSettlementLocal', 'locality_id');
            searchMultiSelectMakerAutoComplete('searchManKnowledgeOfLanguages', 'language_id');
            searchMultiSelectMakerAutoComplete('searchManWorship', 'religion_id');
            searchMultiSelectMakerAutoComplete('searchManOperationCategory', 'operation_category_id');
            searchMultiSelectMakerAutoComplete('searchManCountryCarryingOutSearch', 'country_id');
            searchMultiSelectMakerAutoComplete('searchManEducation', 'education_id');
            searchMultiSelectMakerAutoComplete('searchManParty', 'party_id');
            searchMultiSelectMakerAutoComplete('searchManSourceInformation', 'resource_id');

            // $('#searchManOperationCategory').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/operation_category/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManOperationCategoryId').val(dataItem.id);
            //     }
            // });

            // $('#searchManEducation').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/education/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManEducationId').val(dataItem.id);
            //     }
            // });

            // $('#searchManParty').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/party/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManPartyId').val(dataItem.id);
            //     }
            // });

            // $('#searchManCountryCarryingOutSearch').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/country/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManCountryCarryingOutSearchId').val(dataItem.id);
            //     }
            // });

            // $('#searchManGender').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/gender/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManGenderId').val(dataItem.id);
            //     }
            // });



            // $('#searchManSourceInformation').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/resource/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManSourceInformationId').val(dataItem.id);
            //     }
            // });


            // $('#searchManNationality').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/nation/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManNationalityId').val(dataItem.id);
            //     }
            // });



            // $('#searchManCitizenship').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/country/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManCitizenshipId').val(dataItem.id);
            //     }
            // });

            // $('#searchManKnowledgeOfLanguages').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/language/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManKnowledgeOfLanguagesId').val(dataItem.id);
            //     }
            // });

            // $('#searchManWorship').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/religion/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManWorshipId').val(dataItem.id);
            //     }
            // });


            /////////////////////////   man born address //////////////////////
            // $('#searchManPlaceOfBirth').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/country_ate/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManPlaceOfBirthId').val(dataItem.id);
            //     }
            // });



            // $('#searchManPlaceOfBirthAreaLocal').kendoAutoComplete({
            //     dataTextField: "name",
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/region/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManPlaceOfBirthAreaLocalId').val(dataItem.id);
            //     }
            // });


            // $('#searchManPlaceOfBirthSettlementLocal').kendoAutoComplete({
            //     dataTextField: "name",
            //     filter: "contains",
            //     minLength: 3,
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/locality/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchManPlaceOfBirthSettlementLocalId').val(dataItem.id);
            //     }
            // });



            ////////////////////////////   end man born address ///////////////////
            // $('.addMore').click(function(e){
            //     e.preventDefault();
            //     var url = $(this).attr('dataTableName');
            //     currentInputNameMan = $(this).attr('dataName');
            //     currentInputIdMan = $(this).attr('dataId');
            //     $.fancybox({
            //         'type'  : 'iframe',
            //         'autoSize': false,
            //         'width'             : 800,
            //         'height'            : 600,
            //         'href'              : "/{{ app()->getLocale() }}/autocomplete/"+url+"&type=man"
            //     });
            // });

            // $('.addMoreSearch').click(function(e){
            //     e.preventDefault();
            //     var url = $(this).attr('dataTableName');
            //     currentInputNameMan = $(this).attr('dataName');
            //     currentInputIdMan = $(this).attr('dataId');
            //     $.fancybox({
            //         'type'  : 'iframe',
            //         'autoSize': false,
            //         'width'             : 800,
            //         'height'            : 600,
            //         'href'              : "/{{ app()->getLocale() }}/autocomplete/"+url+"&type=man&value="+$('#'+currentInputNameMan).val()
            //     });
            // });


            $('.oneInputSaveDateMan').kendoDatePicker({
                format: "dd-MM-yyyy",
                change: function(e) {
                    $('.selectedDiv').removeClass('selectedDiv');
                }
            });

            $('.oneInputSaveDateMan').focusout(function(e) {
                var val = $(this).val();
                var field = $(this).attr('name');
                var reg = date_preg;
                var c = $(window.lastElementClicked).attr('id');
                if ((typeof $(this).attr('type') != 'undefined') && (val.length != 0)) {
                    if ((val.length == 6) || (val.length == 8)) {
                        var day = val.slice(0, 2);
                        var month = val.slice(2, 4);
                        var year = val.slice(4, 8);
                        if (year.length == 2) {
                            year = '20' + year;
                        }
                        val = day + '-' + month + '-' + year;
                        if (reg.test(val)) {
                            $(this).val(val);
                        } else {
                            $(this).val('');
                            if (c != 'resetButton') {
                                alert('{{ __('content.enter_number') }}');
                            }
                        }
                    } else {
                        if (val.length != 10) {
                            $(this).val('');
                            if (c != 'resetButton') {
                                alert('{{ __('content.enter_number') }}');
                            }
                        } else {}
                    }
                }
            });

            $('.oneInputSaveEnter').focusout(function(e) {
                e.preventDefault();
                var test = $(this).attr('id');
                if (typeof test != 'undefined') {
                    searchInput = test;
                }
            });

            $('#man_and').click(function(e) {
                var ff = $.Event("keypress");
                ff.charCode = 38;
                $("#" + searchInput).trigger(ff);
                $('#' + searchInput).focus();
            });

            $('#man_or').click(function(e) {
                var ee = $.Event("keypress");
                ee.charCode = 124;
                $("#" + searchInput).trigger(ee);
                $('#' + searchInput).focus();
            });

            <?php if (isset($search_params)) { ?>

            $("input[name='end_birthday']").val(@json($search_params['end_birthday']));
            $("input[name='end_start_wanted']").val(@json($search_params['end_start_wanted']));
            $("input[name='end_entry_date']").val(@json($search_params['end_entry_date']));
            $("input[name='end_exit_date']").val(@json($search_params['end_exit_date']));

            $('#searchManLastName').val("<?php echo html_entity_decode($search_params['last_name'][sizeof($search_params['last_name']) - 1]); ?>");
            $('#searchManFirstName').val("<?php echo html_entity_decode($search_params['first_name'][sizeof($search_params['first_name']) - 1]); ?>");
            $('#searchManMiddleName').val("<?php echo html_entity_decode($search_params['middle_name'][sizeof($search_params['middle_name']) - 1]); ?>");
            $('#manLFMName').val("<?php echo html_entity_decode($search_params['auto_name'][sizeof($search_params['auto_name']) - 1]); ?>");
            $('#searchManDateOfBirth').val("<?php echo $search_params['birthday']; ?>");
            $('#searchManApproximateYear').val("<?php echo $search_params['approximate_year'][sizeof($search_params['approximate_year']) - 1]; ?>");
            $('#searchManPassportNumber').val("<?php echo html_entity_decode($search_params['passport'][sizeof($search_params['passport']) - 1]); ?>");
            $('#searchManGenderId').val("<?php echo $search_params['gender_id'][sizeof($search_params['gender_id']) - 1]; ?>");
            $('#searchManGender').val("<?php echo html_entity_decode($search_params['gender_name']); ?>");
            $('#searchManNationality').val("<?php echo html_entity_decode($search_params['nation_name']); ?>");
            $('#searchManNationalityId').val("<?php echo $search_params['nation_id'][sizeof($search_params['nation_id']) - 1]; ?>");
            $('#searchManCitizenship').val("<?php echo html_entity_decode($search_params['citizenship_name']); ?>");
            $('#searchManCitizenshipId').val("<?php echo $search_params['citizenship_id'][sizeof($search_params['citizenship_id']) - 1]; ?>");
            $('#searchManPlaceOfBirth').val("<?php echo html_entity_decode($search_params['place_of_birth']); ?>");
            $('#searchManPlaceOfBirthId').val("<?php echo $search_params['country_ate_id'][sizeof($search_params['country_ate_id']) - 1]; ?>");
            $('#searchManPlaceOfBirthAreaLocal').val("<?php echo html_entity_decode($search_params['place_of_birth_area_local']); ?>");
            $('#searchManPlaceOfBirthAreaLocalId').val("<?php echo $search_params['region_id'][sizeof($search_params['region_id']) - 1]; ?>");
            $('#searchManPlaceOfBirthSettlementLocal').val("<?php echo html_entity_decode($search_params['place_of_birth_settlement_local']); ?>");
            $('#searchManPlaceOfBirthSettlementLocalId').val("<?php echo $search_params['locality_id'][sizeof($search_params['locality_id']) - 1]; ?>");
            $('#searchManPlaceOfBirthArea').val("<?php echo html_entity_decode($search_params['region'][sizeof($search_params['region']) - 1]); ?>");
            $('#searchManPlaceOfBirthSettlement').val("<?php echo html_entity_decode($search_params['locality'][sizeof($search_params['locality']) - 1]); ?>");
            $('#searchManKnowledgeOfLanguages').val("<?php echo html_entity_decode($search_params['language']); ?>");
            $('#searchManKnowledgeOfLanguagesId').val("<?php echo $search_params['language_id'][sizeof($search_params['language_id']) - 1]; ?>");
            $('#searchManAttention').val("<?php echo html_entity_decode($search_params['attention'][sizeof($search_params['attention']) - 1]); ?>");
            $('#searchManAdditionalInformationPerson').val("<?php echo html_entity_decode($search_params['more_data'][sizeof($search_params['more_data']) - 1]); ?>");
            $('#searchManWorship').val("<?php echo html_entity_decode($search_params['religion']); ?>");
            $('#searchManWorshipId').val("<?php echo $search_params['religion_id'][sizeof($search_params['religion_id']) - 1]; ?>");
            $('#searchManOccupation').val("<?php echo html_entity_decode($search_params['occupation'][sizeof($search_params['occupation']) - 1]); ?>");
            $('#searchManOperationCategory').val("<?php echo $search_params['operation_category']; ?>");
            $('#searchManOperationCategoryId').val("<?php echo $search_params['operation_category_id'][sizeof($search_params['operation_category_id']) - 1]; ?>");
            $('#searchManCountryCarryingOutSearch').val("<?php echo html_entity_decode($search_params['country']); ?>");
            $('#searchManCountryCarryingOutSearchId').val("<?php echo $search_params['country_id'][sizeof($search_params['country_id']) - 1]; ?>");
            $('#searchManDeclaredWantedListWith').val("<?php echo html_entity_decode($search_params['start_wanted']); ?>");
            $('#searchManHomeMonitoringStart').val("<?php echo $search_params['entry_date']; ?>");
            $('#searchManEndMonitoringStart').val("<?php echo $search_params['exit_date']; ?>");
            $('#searchManEducation').val("<?php echo html_entity_decode($search_params['education']); ?>");
            $('#searchManEducationId').val("<?php echo $search_params['education_id'][sizeof($search_params['education_id']) - 1]; ?>");
            $('#searchManParty').val("<?php echo html_entity_decode($search_params['party']); ?>");
            $('#searchManPartyId').val("<?php echo $search_params['party_id'][sizeof($search_params['party_id']) - 1]; ?>");
            $('#searchManAlias').val("<?php echo html_entity_decode($search_params['nickname'][sizeof($search_params['nickname']) - 1]); ?>");
            $('#searchManFaceOpened').val("<?php echo html_entity_decode($search_params['opened_dou'][sizeof($search_params['opened_dou']) - 1]); ?>");
            $('#searchManSourceInformation').val("<?php echo html_entity_decode($search_params['resource']); ?>");
            $('#searchManSourceInformationId').val("<?php echo $search_params['resource_id'][sizeof($search_params['resource_id']) - 1]; ?>");
            <?php } ?>

        });



        function closeFMan(name, id) {
            //        alert('name = '+name+' id = '+id);
            $('#' + currentInputNameMan).val(name);
            $('#' + currentInputIdMan).val(id);
            var field = $('#' + currentInputIdMan).attr('name');
            $.fancybox.close();
            // $('#' + currentInputNameMan).focus();
        }
    </script>
@endsection
@endsection
