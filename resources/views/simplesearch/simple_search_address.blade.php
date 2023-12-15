@extends('layouts.include-app')
@section('include-css')
    <link href="{{ asset('assets/css/main/open-modal.css') }}" rel="stylesheet" />

@endsection

@section('content-include')
    <a class="closeButton"></a>
    <div class="inContent">
        <form id="addressForm" action="/{{ app()->getLocale() }}/simplesearch/result_address" method="post">
            @if(!empty($checkUrl) && $checkUrl !== 'advancedsearch')
                <x-back-previous-url />
            @endif
            <div class="buttons">
                <input type="button" class="k-button" value="{{ __('content.and') }}" id="address_and" />
                <input type="button" class="k-button" value="{{ __('content.or') }}" id="address_or" />
                <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
                <?php if(!isset($type)) { ?>
                <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
                <input type="submit" class="k-button" name="submit"
                    value="{{ __('content.search') }}" /><?php } ?>
            </div>

            <?php if (isset($search_params) && isset($search_params['country_ate_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressCountryFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['country_ate_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressCountry">
                        <div class="item">
                            <span><?php echo $search_params['country_ate_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="country_ate_id[]" value="<?php echo $search_params['country_ate_id'][$i]; ?>">
                        <input type="hidden" name="country_ate_idName[]" value="<?php echo $search_params['country_ate_idName'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="country_ate_id_type" id="searchAddressCountryType" value="<?php echo $search_params['country_ate_id_type']; ?>">
            </div>
            <?php } ?>

            <div class="forForm">
                <label for="searchAddressCountry">{{ __('content.country') }}</label>
                <input type="button"  dataName="searchAddressCountry" dataId="searchAddressCountryId" dataTableName="fancy/country_ate"
                    class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name"
                    data-table-name="country_ate" />
                <input type="text" name="country_ate" id="searchAddressCountry" dataInputId="searchAddressCountryId"
                    dataTableName="country_ate" class="oneInputSaveEnter fetch_input_title get_datalist" list="country_ate" />
                @if (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressCountryOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressCountryOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressCountryOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="country_ate_id[]" id="searchAddressCountryId" />
                <datalist id="country_ate" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['region_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressRegionLocalFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['region_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressRegionLocal">
                        <div class="item">
                            <span><?php echo $search_params['region_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="region_id[]" value="<?php echo $search_params['region_id'][$i]; ?>">
                        <input type="hidden" name="region_idName[]" value="<?php echo $search_params['region_idName'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="region_id_type" id="searchAddressRegionLocalType" value="<?php echo $search_params['region_id_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="searchAddressRegionLocal">{{ __('content.region_local') }}</label>
                <input type="button" dataName="searchAddressRegionLocal" dataId="searchAddressRegionLocalId"
                    dataTableName="fancy/region" class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name"
                    data-table-name="region" />
                <input type="text" name="region_local" id="searchAddressRegionLocal"
                    dataInputId="searchAddressRegionLocalId" dataTableName="region" class="oneInputSaveEnter fetch_input_title get_datalist" list="region"  />
                @if (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                    id="searchAddressRegionLocalOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                    id="searchAddressRegionLocalOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchAddressRegionLocalOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="region_id[]" id="searchAddressRegionLocalId" />
                <datalist id="region" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['locality_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressLocalityLocalFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['locality_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressLocalityLocal">
                        <div class="item">
                            <span><?php echo $search_params['locality_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="locality_id[]" value="<?php echo $search_params['locality_id'][$i]; ?>">
                        <input type="hidden" name="locality_idName[]" value="<?php echo $search_params['locality_idName'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="locality_id_type" id="searchAddressLocalityLocalType"
                    value="<?php echo $search_params['locality_id_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="searchAddressLocalityLocal">{{ __('content.locality_local') }}</label>
                <input type="button" dataName="searchAddressLocalityLocal" dataId="searchAddressLocalityLocalId"
                    dataTableName="fancy/locality" class="addMore k-icon k-i-plus my-plus-class" data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name"
                    data-table-name="locality"/>
                <input type="text" name="locality_local" id="searchAddressLocalityLocal"
                    dataInputId="searchAddressLocalityLocalId" dataTableName="locality" class="oneInputSaveEnter fetch_input_title get_datalist" list="locality"/>
                @if (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                    id="searchAddressLocalityLocalOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;"
                    id="searchAddressLocalityLocalOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchAddressLocalityLocalOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="locality_id[]" id="searchAddressLocalityLocalId" />
                <datalist id="locality" class="input_datalists" style="width: 500px;"></datalist>

            </div>


            <?php if (isset($search_params) && isset($search_params['street_id'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressStreetLocalFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['street_id'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressStreetLocal">
                        <div class="item">
                            <span><?php echo $search_params['street_idName'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="street_id[]" value="<?php echo $search_params['street_id'][$i]; ?>">
                        <input type="hidden" name="street_idName[]" value="<?php echo $search_params['street_idName'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="street_id_type" id="searchAddressStreetLocalType"
                    value="<?php echo $search_params['street_id_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="searchAddressStreetLocal">{{ __('content.street_local') }}</label>
                <input type="button" dataName="searchAddressStreetLocal" dataId="searchAddressStreetLocalId"
                    dataTableName="fancyStreet" class="addMore k-icon k-i-plus my-plus-class"  data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal" data-fieldname="name"
                    data-table-name="street"/>
                <input type="text" name="street_local" id="searchAddressStreetLocal"
                    dataInputId="searchAddressStreetLocalId" dataTableName="street"
                    class="oneInputSaveEnter fetch_input_title get_datalist" list="street" />
                @if (isset($search_params['street_id_type']) && $search_params['street_id_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                    id="searchAddressStreetLocalOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['street_id_type']) && $search_params['street_id_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                    id="searchAddressStreetLocalOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['street_id_type']) && $search_params['street_id_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;"
                        id="searchAddressStreetLocalOp">{{ __('content.not_equal') }}</span>
                @endif
                <input type="hidden" name="street_id[]" id="searchAddressStreetLocalId" />
                <datalist id="street" class="input_datalists" style="width: 500px;"></datalist>

            </div>

            <?php if (isset($search_params) && isset($search_params['region'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressRegionFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['region'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressRegion">
                        <div class="item">
                            <span><?php echo $search_params['region'][$i]; ?>,</span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="region[]" value="<?php echo $search_params['region'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="region_type" id="searchAddressRegionType" value="<?php echo $search_params['region_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="searchAddressRegion">{{ __('content.region') }}</label>
                <input type="text" name="region[]" id="searchAddressRegion" class="oneInputSaveEnter" />

                <x-select-distance name="region_name_distance" class="distance distance_searchAddressRegion"/>

                @if (isset($search_params['region_type']) && $search_params['region_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressRegionOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['region_type']) && $search_params['region_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressRegionOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['region_type']) && $search_params['region_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressRegionOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['locality'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressLocalityFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['locality'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressLocality">
                        <div class="item">
                            <span><?php echo $search_params['locality'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="locality[]" value="<?php echo $search_params['locality'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="locality_type" id="searchAddressLocalityType" value="<?php echo $search_params['locality_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="addressLocality">{{ __('content.locality') }}</label>
                <input type="text" name="locality[]" id="searchAddressLocality" class="oneInputSaveEnter" />

                <x-select-distance name="locality_name_distance" class="distance distance_searchAddressLocality"/>

                @if (isset($search_params['locality_type']) && $search_params['locality_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressLocalityOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['locality_type']) && $search_params['locality_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressLocalityOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['locality_type']) && $search_params['locality_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressLocalityOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['street'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressStreetFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['street'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressStreet">
                        <div class="item">
                            <span><?php echo $search_params['street'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="street[]" value="<?php echo $search_params['street'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="street_type" id="searchAddressStreetType" value="<?php echo $search_params['street_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="addressStreet">{{ __('content.street') }}</label>
                <input type="text" name="street[]" id="searchAddressStreet" class="oneInputSaveEnter" />

                <x-select-distance name="street_distance" class="distance distance_searchAddressStreet"/>

                @if (isset($search_params['street_type']) && $search_params['street_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressStreetOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['street_type']) && $search_params['street_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressStreetOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['street_type']) && $search_params['street_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressStreetOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['track'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressTrackFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['track'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressTrack">
                        <div class="item">
                            <span><?php echo $search_params['track'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="track[]" value="<?php echo $search_params['track'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="track_type" id="searchAddressTrackType" value="<?php echo $search_params['track_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="searchAddressTrack">{{ __('content.track') }}</label>
                <input type="text" name="track[]" id="searchAddressTrack" class="oneInputSaveEnter" />

                <x-select-distance name="track_distance" class="distance distance_searchAddressTrack"/>

                @if (isset($search_params['track_type']) && $search_params['track_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressTrackOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['track_type']) && $search_params['track_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressTrackOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['track_type']) && $search_params['track_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressTrackOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['home_num'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressHomeNumFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['home_num'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressHomeNum">
                        <div class="item">
                            <span><?php echo $search_params['home_num'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="home_num[]" value="<?php echo $search_params['home_num'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="home_num_type" id="searchAddressHomeNumType" value="<?php echo $search_params['home_num_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="searchAddressHomeNum">{{ __('content.home_num') }}</label>
                <input type="text" name="home_num[]" id="searchAddressHomeNum" class="oneInputSaveEnter" />

                <x-select-distance name="home_num_distance" class="distance distance_searchAddressHomeNum"/>

                @if (isset($search_params['home_num_type']) && $search_params['home_num_type'] == 'OR')
                    <span style="width: 30px;position: absolute;margin-left: -570px;" id="searchAddressHomeNumOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['home_num_type']) && $search_params['home_num_type'] == 'AND')
                    <span style="width: 30px;position: absolute;margin-left: -570px;" id="searchAddressHomeNumOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['home_num_type']) && $search_params['home_num_type'] == 'NOT')
                    <span style="width: 30px;position: absolute;margin-left: -570px;" id="searchAddressHomeNumOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['housing_num'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressHousingNumFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['housing_num'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressHousingNum">
                        <div class="item">
                            <span><?php echo $search_params['housing_num'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="housing_num[]" value="<?php echo $search_params['housing_num'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="housing_num_type" id="searchAddressHousingNumType"
                    value="<?php echo $search_params['housing_num_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="searchAddressHousingNum">{{ __('content.housing_num') }}</label>
                <input type="text" name="housing_num[]" id="searchAddressHousingNum" class="oneInputSaveEnter" />

                <x-select-distance name="housing_num_distance" class="distance distance_searchAddressHousingNum"/>

                @if (isset($search_params['housing_num_type']) && $search_params['housing_num_type'] == 'OR')
                    <span style="width: 30px;position: absolute;margin-left: -570px;"
                    id="searchAddressHousingNumOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['housing_num_type']) && $search_params['housing_num_type'] == 'AND')
                    <span style="width: 30px;position: absolute;margin-left: -570px;" id="searchAddressHousingNumOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['housing_num_type']) && $search_params['housing_num_type'] == 'NOT')
                    <span style="width: 30px;position: absolute;margin-left: -570px;" id="searchAddressHousingNumOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            <?php if (isset($search_params) && isset($search_params['apt_num'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchAddressAptNumFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['apt_num'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchAddressAptNum">
                        <div class="item">
                            <span><?php echo $search_params['apt_num'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="apt_num[]" value="<?php echo $search_params['apt_num'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="apt_num_type" id="searchAddressAptNumType" value="<?php echo $search_params['apt_num_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="searchAddressAptNum">{{ __('content.apt_num') }}</label>
                <input type="text" name="apt_num[]" id="searchAddressAptNum" class="oneInputSaveEnter" />

                <x-select-distance name="apt_num_distance" class="distance distance_searchAddressAptNum"/>

                @if (isset($search_params['apt_num_type']) && $search_params['apt_num_type'] == 'OR')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressAptNumOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['apt_num_type']) && $search_params['apt_num_type'] == 'AND')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressAptNumOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['apt_num_type']) && $search_params['apt_num_type'] == 'NOT')
                    <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressAptNumOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            {{-- <div class="forForm">
                <label for="fileSearch">{{ __('content.file_search') }}</label>
                <input type="text" name="content" id="fileSearch" />
                <x-select-distance name="content_distance" class="distance distance_fileSearch"/>
            </div> --}}

            <div class="buttons">

            </div>

        </form>
    </div>

    {{-- ================= modal =========================== --}}
    <x-fullscreen-modal/>

@section('js-include')
    <script>
        let open_modal_url = `{{ route('open.modal') }}`
        let get_filter_in_modal = `{{ route('get-model-filter') }}`
    </script>
    <script src="{{ asset('assets-include/js/script.js') }}"></script>

    <script>
        var currentInputNameAddress;
        var currentInputIdAddress;
        var searchInput;

        $(document).ready(function() {

            $('input').map(function() {
                if ($(this).hasClass('oneInputSaveEnter')) {
                    $(this).val('');
                }
            });

            showHideDistance('fileSearch','distance_fileSearch');

            showHideDistance('searchAddressRegion','distance_searchAddressRegion');
            showHideDistance('searchAddressLocality','distance_searchAddressLocality');
            showHideDistance('searchAddressStreet','distance_searchAddressStreet');
            showHideDistance('searchAddressTrack','distance_searchAddressTrack');
            showHideDistance('searchAddressHomeNum','distance_searchAddressHomeNum');
            showHideDistance('searchAddressHousingNum','distance_searchAddressHousingNum');
            showHideDistance('searchAddressAptNum','distance_searchAddressAptNum');

            searchMultiSelectMaker('searchAddressRegion', 'region');
            searchMultiSelectMaker('searchAddressLocality', 'locality');
            searchMultiSelectMaker('searchAddressStreet', 'street');
            searchMultiSelectMaker('searchAddressTrack', 'track');
            searchMultiSelectMaker('searchAddressHomeNum', 'home_num');
            searchMultiSelectMaker('searchAddressHousingNum', 'housing_num');
            searchMultiSelectMaker('searchAddressAptNum', 'apt_num');

            searchMultiSelectMakerAutoComplete('searchAddressCountry', 'country_ate_id');
            searchMultiSelectMakerAutoComplete('searchAddressRegionLocal', 'region_id');
            searchMultiSelectMakerAutoComplete('searchAddressLocalityLocal', 'locality_id');
            searchMultiSelectMakerAutoComplete('searchAddressStreetLocal', 'street_id');

            // $('#searchAddressCountry').kendoAutoComplete({
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
            //         $('#searchAddressCountryId').val(dataItem.id);
            //     }
            // });

            //  $('#searchAddressRegionLocal').kendoAutoComplete({
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
            //         $('#searchAddressRegionLocalId').val(dataItem.id);
            //     }
            // });



            // $('#searchAddressLocalityLocal').kendoAutoComplete({
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
            //         $('#searchAddressLocalityLocalId').val(dataItem.id);
            //     }
            // });



            // $('#searchAddressStreetLocal').kendoAutoComplete({
            //     dataTextField: "name",
            //     filter: "contains",
            //     minLength: 3,
            //     dataSource: {
            //         transport: {
            //             read:{
            //                 dataType: "json",
            //                 url: "/{{ app()->getLocale() }}/dictionary/street/read"
            //             }
            //         }
            //     },
            //     select:function(e){
            //         var dataItem = this.dataItem(e.item.index());
            //         $('#searchAddressStreetLocalId').val(dataItem.id);
            //     }
            // });

            $('.oneInputSaveEnter').focusout(function(e) {
                e.preventDefault();
                var test = $(this).attr('id');
                if (typeof test != 'undefined') {
                    searchInput = test;
                }
            });
            $('#address_and').click(function(e) {
                var ff = $.Event("keypress");
                ff.charCode = 38;
                $("#" + searchInput).trigger(ff);
                $('#' + searchInput).focus();
            });

            $('#address_or').click(function(e) {
                var ee = $.Event("keypress");
                ee.charCode = 124;
                $("#" + searchInput).trigger(ee);
                $('#' + searchInput).focus();
            });



            <?php if (isset($search_params)) { ?>
            $('#searchAddressCountryId').val("<?php echo $search_params['country_ate_id'][sizeof($search_params['country_ate_id']) - 1]; ?>");
            $('#searchAddressCountry').val("<?php echo html_entity_decode($search_params['country_ate']); ?>");
            $('#searchAddressRegionLocalId').val("<?php echo isset($search_params['region_id']) ? $search_params['region_id'][sizeof($search_params['region_id']) - 1] : ''; ?>");
            $('#searchAddressRegionLocal').val("<?php echo html_entity_decode($search_params['region_local']); ?>");
            $('#searchAddressLocalityLocalId').val("<?php echo $search_params['locality_id'][sizeof($search_params['locality_id']) - 1]; ?>");
            $('#searchAddressLocalityLocal').val("<?php echo html_entity_decode($search_params['locality_local']); ?>");
            $('#searchAddressStreetLocalId').val("<?php echo $search_params['street_id'][sizeof($search_params['street_id']) - 1]; ?>");
            $('#searchAddressStreetLocal').val("<?php echo html_entity_decode($search_params['street_local']); ?>");
            $('#searchAddressRegion').val("<?php echo html_entity_decode($search_params['region'][sizeof($search_params['region']) - 1]); ?>");
            $('#searchAddressLocality').val("<?php echo html_entity_decode($search_params['locality'][sizeof($search_params['locality']) - 1]); ?>");
            $('#searchAddressStreet').val("<?php echo html_entity_decode($search_params['street'][sizeof($search_params['street']) - 1]); ?>");
            $('#searchAddressTrack').val("<?php echo html_entity_decode($search_params['track'][sizeof($search_params['track']) - 1]); ?>");
            $('#searchAddressHomeNum').val("<?php echo html_entity_decode($search_params['home_num'][sizeof($search_params['home_num']) - 1]); ?>");
            $('#searchAddressHousingNum').val("<?php echo html_entity_decode($search_params['housing_num'][sizeof($search_params['housing_num']) - 1]); ?>");
            $('#searchAddressAptNum').val("<?php echo html_entity_decode($search_params['apt_num'][sizeof($search_params['apt_num']) - 1]); ?>");
            
            <?php } ?>


        });

        function closeFancyAddress(name, id) {
            //        alert('name = '+name+' id = '+id);
            $('#' + currentInputNameAddress).val(name);
            $('#' + currentInputIdAddress).val(id);
            var field = $('#' + currentInputIdAddress).attr('name');

            $.fancybox.close();
            $('#' + currentInputNameAddress).focus();
        }
    </script>
@endsection
@endsection
