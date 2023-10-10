@extends('layouts.include-app')

@section('content-include')
<a class="closeButton"></a>
<div class="inContent">
    <form id="addressForm" action="/{{ app()->getLocale() }}/simplesearch/result_address" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="address_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="address_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton"  class="k-button" >{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['country_ate_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressCountryFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['country_ate_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressCountry">
                    <div class="item">
                        <span><?php echo $search_params['country_ate_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="country_ate_id[]" value="<?php echo $search_params['country_ate_id'][$i] ?>">
                    <input type="hidden" name="country_ate_idName[]" value="<?php echo $search_params['country_ate_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="country_ate_id_type" id="searchAddressCountryType" value="<?php echo $search_params['country_ate_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchAddressCountry">{{ __('content.country') }}</label>
            <input type="button" dataName="searchAddressCountry" dataId="searchAddressCountryId" dataTableName="fancy/country_ate"
            class="addMore k-icon k-i-plus my-plus-class"
            data-bs-toggle="modal" data-bs-target="#fullscreenModal"
            data-url = '{{route('get-model-filter',['path'=>'country_ate'])}}'
            data-section = '{{route('open.modal')}}'
            data-id="doc_category"   />




            <input type="text" name="country_ate" id="searchAddressCountry" dataInputId="searchAddressCountryId" dataTableName="country_ate" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressCountryOp">ИЛИ</span>
            <?php } else if (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressCountryOp">И</span>
            <?php } ?>
            <input type="hidden" name="country_ate_id[]" id="searchAddressCountryId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['region_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressRegionLocalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['region_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressRegionLocal">
                    <div class="item">
                        <span><?php echo $search_params['region_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="region_id[]" value="<?php echo $search_params['region_id'][$i] ?>">
                    <input type="hidden" name="region_idName[]" value="<?php echo $search_params['region_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="region_id_type" id="searchAddressRegionLocalType" value="<?php echo $search_params['region_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchAddressRegionLocal">{{ __('content.region_local') }}</label>
            <input type="button" dataName="searchAddressRegionLocal" dataId="searchAddressRegionLocalId" dataTableName="fancy/region" class="addMore k-icon k-i-plus"   />
            <input type="text" name="region_local" id="searchAddressRegionLocal" dataInputId="searchAddressRegionLocalId" dataTableName="region" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressRegionLocalOp">ИЛИ</span>
            <?php } else if (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressRegionLocalOp">И</span>
            <?php } ?>
            <input type="hidden" name="region_id[]" id="searchAddressRegionLocalId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['locality_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressLocalityLocalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['locality_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressLocalityLocal">
                    <div class="item">
                        <span><?php echo $search_params['locality_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="locality_id[]" value="<?php echo $search_params['locality_id'][$i] ?>">
                    <input type="hidden" name="locality_idName[]" value="<?php echo $search_params['locality_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="locality_id_type" id="searchAddressLocalityLocalType" value="<?php echo $search_params['locality_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchAddressLocalityLocal">{{ __('content.locality_local') }}</label>
            <input type="button" dataName="searchAddressLocalityLocal" dataId="searchAddressLocalityLocalId" dataTableName="fancy/locality" class="addMore k-icon k-i-plus"   />
            <input type="text" name="locality_local" id="searchAddressLocalityLocal" dataInputId="searchAddressLocalityLocalId" dataTableName="locality" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressLocalityLocalOp">ИЛИ</span>
            <?php } else if (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressLocalityLocalOp">И</span>
            <?php } ?>
            <input type="hidden" name="locality_id[]" id="searchAddressLocalityLocalId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['street_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressStreetLocalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['street_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressStreetLocal">
                    <div class="item">
                        <span><?php echo $search_params['street_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="street_id[]" value="<?php echo $search_params['street_id'][$i] ?>">
                    <input type="hidden" name="street_idName[]" value="<?php echo $search_params['street_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="street_id_type" id="searchAddressStreetLocalType" value="<?php echo $search_params['street_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchAddressStreetLocal">{{ __('content.street_local') }}</label>
            <input type="button" dataName="searchAddressStreetLocal" dataId="searchAddressStreetLocalId" dataTableName="fancyStreet" class="addMore k-icon k-i-plus"   />
            <input type="text" name="street_local" id="searchAddressStreetLocal" dataInputId="searchAddressStreetLocalId" dataTableName="street" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['street_id_type']) && $search_params['street_id_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressStreetLocalOp">ИЛИ</span>
            <?php } else if (isset($search_params['street_id_type']) && $search_params['street_id_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressStreetLocalOp">И</span>
            <?php } ?>
            <input type="hidden" name="street_id[]" id="searchAddressStreetLocalId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['region'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressRegionFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['region'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressRegion">
                    <div class="item">
                        <span><?php echo $search_params['region'][$i] ?>,</span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="region[]" value="<?php echo $search_params['region'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="region_type" id="searchAddressRegionType" value="<?php echo $search_params['region_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchAddressRegion">{{ __('content.region') }}</label>
            <input type="text" name="region[]" id="searchAddressRegion" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['region_type']) && $search_params['region_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressRegionOp">ИЛИ</span>
            <?php } else if (isset($search_params['region_type']) && $search_params['region_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressRegionOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['locality'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressLocalityFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['locality'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressLocality">
                    <div class="item">
                        <span><?php echo $search_params['locality'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="locality[]" value="<?php echo $search_params['locality'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="locality_type" id="searchAddressLocalityType" value="<?php echo $search_params['locality_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="addressLocality">{{ __('content.locality') }}</label>
            <input type="text" name="locality[]" id="searchAddressLocality" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['locality_type']) && $search_params['locality_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressLocalityOp">ИЛИ</span>
            <?php } else if (isset($search_params['locality_type']) && $search_params['locality_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressLocalityOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['street'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressStreetFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['street'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressStreet">
                    <div class="item">
                        <span><?php echo $search_params['street'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="street[]" value="<?php echo $search_params['street'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="street_type" id="searchAddressStreetType" value="<?php echo $search_params['street_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="addressStreet">{{ __('content.street') }}</label>
            <input type="text" name="street[]" id="searchAddressStreet" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['street_type']) && $search_params['street_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressStreetOp">ИЛИ</span>
            <?php } else if (isset($search_params['street_type']) && $search_params['street_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressStreetOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['track'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressTrackFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['track'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressTrack">
                    <div class="item">
                        <span><?php echo $search_params['track'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="track[]" value="<?php echo $search_params['track'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="track_type" id="searchAddressTrackType" value="<?php echo $search_params['track_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchAddressTrack">{{ __('content.track') }}</label>
            <input type="text" name="track[]" id="searchAddressTrack" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['track_type']) && $search_params['track_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressTrackOp">ИЛИ</span>
            <?php } else if (isset($search_params['track_type']) && $search_params['track_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressTrackOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['home_num'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressHomeNumFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['home_num'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressHomeNum">
                    <div class="item">
                        <span><?php echo $search_params['home_num'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="home_num[]" value="<?php echo $search_params['home_num'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="home_num_type" id="searchAddressHomeNumType" value="<?php echo $search_params['home_num_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchAddressHomeNum">{{ __('content.home_num') }}</label>
            <input type="text" name="home_num[]" id="searchAddressHomeNum" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['home_num_type']) && $search_params['home_num_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressHomeNumOp">ИЛИ</span>
            <?php } else if (isset($search_params['home_num_type']) && $search_params['home_num_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressHomeNumOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['housing_num'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressHousingNumFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['housing_num'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressHousingNum">
                    <div class="item">
                        <span><?php echo $search_params['housing_num'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="housing_num[]" value="<?php echo $search_params['housing_num'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="housing_num_type" id="searchAddressHousingNumType" value="<?php echo $search_params['housing_num_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchAddressHousingNum">{{ __('content.housing_num') }}</label>
            <input type="text" name="housing_num[]" id="searchAddressHousingNum" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['housing_num_type']) && $search_params['housing_num_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressHousingNumOp">ИЛИ</span>
            <?php } else if (isset($search_params['housing_num_type']) && $search_params['housing_num_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressHousingNumOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['apt_num'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchAddressAptNumFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['apt_num'])-1 ; $i++ ) { ?>
                <li id="listItemsearchAddressAptNum">
                    <div class="item">
                        <span><?php echo $search_params['apt_num'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="apt_num[]" value="<?php echo $search_params['apt_num'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="apt_num_type" id="searchAddressAptNumType" value="<?php echo $search_params['apt_num_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchAddressAptNum">{{ __('content.apt_num') }}</label>
            <input type="text" name="apt_num[]" id="searchAddressAptNum" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['apt_num_type']) && $search_params['apt_num_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressAptNumOp">ИЛИ</span>
            <?php } else if (isset($search_params['apt_num_type']) && $search_params['apt_num_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchAddressAptNumOp">И</span>
            <?php } ?>
        </div>

        <div class="forForm">
            <label for="fileSearch">{{ __('content.file_search') }}</label>
            <input type="text" name="content" id="fileSearch"/>
        </div>

        <div class="buttons">

        </div>

    </form>
</div>
{{-- ================= modal =========================== --}}
<div
      class="modal fade my-modal"
      id="fullscreenModal"
      tabindex="-1"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">
                <form id="addNewInfoBtn">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="addNewInfoInp"
                            name="name"
                            placeholder=""
                        />
                        <label for="item21" class="form-label"
                        >Ֆիլտրացիա</label
                        >
                    </div>
                    <table id="filter_content">

                    </table>

                    <button type="submit" class="btn btn-primary">Ավելացնել նոր գրանցում</button>
                </form>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th class="numbering" scope="col">#</th>
                        <th scope="col">Անվանում</th>
                        <th scope="col" class="td-xs"></th>
                        </tr>
                    </thead>
                    <tbody id="table_id">
                            {{-- @foreach ($agency as $item )
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td class="inputName">{{$item->name}}</td>
                                    <td>
                                    <button type="button" class="addInputTxt btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Ավելացնել</button>
                                    </td>
                                </tr>

                            @endforeach --}}
                    </tbody>
                </table>
            </div>
            </div>
      </div>
    </div>

    <div id="errModal" class="error-modal">
      <div class="error-modal-info">
          <p>soryyyyyy</p>
          <button type="button" class="addInputTxt_error btn btn-primary my-close-error">Լավ</button>
      </div>
    </div>
{{-- =================================================== --}}
@section('js-include')
<script src="{{ asset('assets/js/script.js') }}"></script>

<script>

var currentInputNameAddress;
var currentInputIdAddress;
var searchInput;

$(document).ready(function(){

    $('input').map(function(){
        if($(this).hasClass('oneInputSaveEnter')){
            $(this).val('');
        }
    });

    searchMultiSelectMaker( 'searchAddressRegion' , 'region' );
    searchMultiSelectMaker( 'searchAddressLocality' , 'locality' );
    searchMultiSelectMaker( 'searchAddressStreet' , 'street' );
    searchMultiSelectMaker( 'searchAddressTrack' , 'track' );
    searchMultiSelectMaker( 'searchAddressHomeNum' , 'home_num' );
    searchMultiSelectMaker( 'searchAddressHousingNum' , 'housing_num' );
    searchMultiSelectMaker( 'searchAddressAptNum' , 'apt_num' );

    searchMultiSelectMakerAutoComplete( 'searchAddressCountry' , 'country_ate_id' );
    searchMultiSelectMakerAutoComplete( 'searchAddressRegionLocal' , 'region_id' );
    searchMultiSelectMakerAutoComplete( 'searchAddressLocalityLocal' , 'locality_id' );
    searchMultiSelectMakerAutoComplete( 'searchAddressStreetLocal' , 'street_id' );

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

    $('.oneInputSaveEnter').focusout(function(e){
        e.preventDefault();
        var test = $(this).attr('id');
        if(typeof test != 'undefined'){
            searchInput = test;
        }
    });
    $('#address_and').click(function(e){
        var ff = $.Event("keypress");
        ff.charCode = 38;
        $("#"+searchInput).trigger(ff);
        $('#'+searchInput).focus();
    });

    $('#address_or').click(function(e){
        var ee = $.Event("keypress");
        ee.charCode = 124;
        $("#"+searchInput).trigger(ee);
        $('#'+searchInput).focus();
    });


    // $('.addMore').click(function(e){
    //     e.preventDefault();
    //     var url = $(this).attr('dataTableName');
    //     currentInputNameAddress = $(this).attr('dataName');
    //     currentInputIdAddress = $(this).attr('dataId');
    //     $.fancybox({
    //         'type'  : 'iframe',
    //         'autoSize': false,
    //         'width'             : 800,
    //         'height'            : 600,
    //         'href'              : "/{{ app()->getLocale() }}/autocomplete/"+url+"&type=address"
    //     });
    // });


    <?php if (isset($search_params)) { ?>
        $('#searchAddressCountryId').val("<?php echo $search_params['country_ate_id'][sizeof($search_params['country_ate_id'])-1] ?>");
        $('#searchAddressCountry').val("<?php echo html_entity_decode($search_params['country_ate']) ?>");
        $('#searchAddressRegionLocalId').val("<?php echo $search_params['region_id'][sizeof($search_params['region_id'])-1] ?>");
        $('#searchAddressRegionLocal').val("<?php echo html_entity_decode($search_params['region_local']) ?>");
        $('#searchAddressLocalityLocalId').val("<?php echo $search_params['locality_id'][sizeof($search_params['locality_id'])-1] ?>");
        $('#searchAddressLocalityLocal').val("<?php echo html_entity_decode($search_params['locality_local']) ?>");
        $('#searchAddressStreetLocalId').val("<?php echo $search_params['street_id'][sizeof($search_params['street_id'])-1] ?>");
        $('#searchAddressStreetLocal').val("<?php echo html_entity_decode($search_params['street_local']) ?>");
        $('#searchAddressRegion').val("<?php echo html_entity_decode($search_params['region'][sizeof($search_params['region'])-1]) ?>");
        $('#searchAddressLocality').val("<?php echo html_entity_decode($search_params['locality'][sizeof($search_params['locality'])-1]) ?>");
        $('#searchAddressStreet').val("<?php echo html_entity_decode($search_params['street'][sizeof($search_params['street'])-1]) ?>");
        $('#searchAddressTrack').val("<?php echo html_entity_decode($search_params['track'][sizeof($search_params['track'])-1]) ?>");
        $('#searchAddressHomeNum').val("<?php echo html_entity_decode($search_params['home_num'][sizeof($search_params['home_num'])-1]) ?>");
        $('#searchAddressHousingNum').val("<?php echo html_entity_decode($search_params['housing_num'][sizeof($search_params['housing_num'])-1]) ?>");
        $('#searchAddressAptNum').val("<?php echo html_entity_decode($search_params['apt_num'][sizeof($search_params['apt_num'])-1]) ?>");
        $('#fileSearch').val("<?php echo html_entity_decode($search_params['content']) ?>");
    <?php } ?>


});

function closeFancyAddress(name,id){
//        alert('name = '+name+' id = '+id);
    $('#'+currentInputNameAddress).val(name);
    $('#'+currentInputIdAddress).val(id);
    var field = $('#'+currentInputIdAddress).attr('name');

    $.fancybox.close();
    $('#'+currentInputNameAddress).focus();
}


</script>
@endsection
@endsection
