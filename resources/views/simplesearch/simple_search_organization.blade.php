@extends('layouts.include-app')

@section('include-css')
    <link href="{{ asset('assets/css/main/open-modal.css') }}" rel="stylesheet" />
@endsection

@section('content-include')

<a class="closeButton" ></a>
<div class="inContent">
    <form id="organizationForm" action="/{{ app()->getLocale() }}/simplesearch/result_organization" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="organization_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="organization_or" />
            <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /> <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['name_organization'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganNameOrganizationFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['name_organization'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganNameOrganization">
                    <div class="item">
                        <span><?php echo $search_params['name_organization'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="name_organization[]" value="<?php echo $search_params['name_organization'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="name_organization_type" id="searchOrganNameOrganizationType" value="<?php echo $search_params['name_organization_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm" >
            <label for="searchOrganNameOrganization">{{ __('content.name_organization') }}</label>
            <input type="text" name="name_organization[]" id="searchOrganNameOrganization" class="oneInputSaveEnter" />

            <x-select-distance name="name_organization_distance" class="distance distance_searchOrganNameOrganization"/>

            @if (isset($search_params['name_organization_type']) && $search_params['name_organization_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNameOrganizationOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['name_organization_type']) && $search_params['name_organization_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNameOrganizationOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['name_organization_type']) && $search_params['name_organization_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNameOrganizationOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['country_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganNationFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['country_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganNation">
                    <div class="item">
                        <span><?php echo $search_params['country_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="country_id[]" value="<?php echo $search_params['country_id'][$i] ?>">
                    <input type="hidden" name="country_idName[]" value="<?php echo $search_params['country_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="country_id_type" id="searchOrganNationType" value="<?php echo $search_params['country_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganNation">{{ __('content.nation') }}</label>
            <input  type="button"
                    dataName="searchOrganNation"
                    dataId="searchOrganNationId"
                    dataTableName="fancy/country"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="country"
                    />
            <input  type="text"
                    name="nation"
                    id="searchOrganNation"
                    dataTableName="country"
                    dataInputId="searchOrganNationId"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="country"
                    />
            @if (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNationOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNationOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNationOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="country_id[]" id="searchOrganNationId" />
            <datalist id="country" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <div class="forForm">
            <label for="searchOrganDateFormation">{{ __('content.date_formation') }}</label>
            <input type="text" name="reg_date" id="searchOrganDateFormation" style="width: 505px;" onkeydown="validateNumber(event,'searchOrganDateFormation',12)" class="oneInputSaveEnter oneInputSaveDateOrganization"/>
        </div>

        <?php if (isset($search_params) && isset($search_params['country_ate_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganRegionActivityFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['country_ate_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganRegionActivity">
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
            <input type="hidden" name="country_ate_id_type" id="searchOrganRegionActivityType" value="<?php echo $search_params['country_ate_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganRegionActivity">{{ __('content.region_activity') }}</label>
            <input  type="button"
                    dataName="searchOrganRegionActivity"
                    dataId="searchOrganRegionActivityId"
                    dataTableName="fancy/country_ate"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="country_ate"
                    />
            <input  type="text"
                    name="region_activity"
                    id="searchOrganRegionActivity"
                    dataTableName="country_ate"
                    dataInputId="searchOrganRegionActivityId"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="country_ate"
                    />
            @if (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganRegionActivityOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganRegionActivityOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganRegionActivityOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="country_ate_id[]" id="searchOrganRegionActivityId" />
            <datalist id="country_ate" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['category_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganCategoryOrganizationFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['category_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganCategoryOrganization">
                    <div class="item">
                        <span><?php echo $search_params['category_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="category_id[]" value="<?php echo $search_params['category_id'][$i] ?>">
                    <input type="hidden" name="category_idName[]" value="<?php echo $search_params['category_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="category_id_type" id="searchOrganCategoryOrganizationType" value="<?php echo $search_params['category_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganCategoryOrganization">{{ __('content.category_organization') }}</label>
            <input  type="button"
                    dataName="searchOrganCategoryOrganization"
                    dataId="searchOrganCategoryOrganizationId"
                    dataTableName="fancy/organization_category"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="organization_category"
                    />
            <input  type="text"
                    name="category_organization"
                    id="searchOrganCategoryOrganization"
                    dataTableName="organization_category"
                    dataInputId="searchOrganCategoryOrganizationId"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="organization_category"
                    />
            @if (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganCategoryOrganizationOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganCategoryOrganizationOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganCategoryOrganizationOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="category_id[]" id="searchOrganCategoryOrganizationId" />
            <datalist id="organization_category" class="input_datalists" style="width: 500px;"></datalist>
        </div>


        <?php if (isset($search_params) && isset($search_params['agency_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganSecurityOrganizationFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['agency_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganSecurityOrganization">
                    <div class="item">
                        <span><?php echo $search_params['agency_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="agency_id[]" value="<?php echo $search_params['agency_id'][$i] ?>">
                    <input type="hidden" name="agency_idName[]" value="<?php echo $search_params['agency_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="agency_id_type" id="searchOrganSecurityOrganizationType" value="<?php echo $search_params['agency_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganSecurityOrganization">{{ __('content.security_organization') }}</label>
            <input  type="button"
                    dataName="searchOrganSecurityOrganization"
                    dataId="searchOrganSecurityOrganizationId"
                    dataTableName="fancy/agency"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="agency"
                    />
            <input  type="text"
                    name="security_organization"
                    id="searchOrganSecurityOrganization"
                    dataTableName="agency"
                    dataInputId="searchOrganSecurityOrganizationId"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="agency"
                    />
            @if (isset($search_params['agency_id_type']) && $search_params['agency_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganSecurityOrganizationOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['agency_id_type']) && $search_params['agency_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganSecurityOrganizationOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['agency_id_type']) && $search_params['agency_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganSecurityOrganizationOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="agency_id[]" id="searchOrganSecurityOrganizationId" />
            <datalist id="agency" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['employers_count'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganNumberWorkerFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['employers_count'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganNumberWorker">
                    <div class="item">
                        <span><?php echo $search_params['employers_count'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="employers_count[]" value="<?php echo $search_params['employers_count'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="employers_count_type" id="searchOrganNumberWorkerType" value="<?php echo $search_params['employers_count_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganNumberWorker">{{ __('content.number_worker') }}</label>
            <input type="text" name="employers_count[]" id="searchOrganNumberWorker" class="oneInputSaveEnter" />
            @if (isset($search_params['employers_count_type']) && $search_params['employers_count_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNumberWorkerOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['employers_count_type']) && $search_params['employers_count_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNumberWorkerOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['employers_count_type']) && $search_params['employers_count_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNumberWorkerOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['attension'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganAttentionFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['attension'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganAttention">
                    <div class="item">
                        <span><?php echo $search_params['attension'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="attension[]" value="<?php echo $search_params['attension'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="attension_type" id="searchOrganAttentionType" value="<?php echo $search_params['attension_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganAttention">{{ __('content.attention') }}</label>
            <input type="text" name="attension[]" id="searchOrganAttention" class="oneInputSaveEnter" />

            <x-select-distance name="attention_distance" class="distance distance_searchOrganAttention"/>

            @if (isset($search_params['attension_type']) && $search_params['attension_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganAttentionOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['attension_type']) && $search_params['attension_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganAttentionOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['attension_type']) && $search_params['attension_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganAttentionOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['opened_dou'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganOrganizationDowFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['opened_dou'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganOrganizationDow">
                    <div class="item">
                        <span><?php echo $search_params['opened_dou'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="opened_dou[]" value="<?php echo $search_params['opened_dou'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="opened_dou_type" id="searchOrganOrganizationDowType" value="<?php echo $search_params['opened_dou_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganOrganizationDow">{{ __('content.organization_dow') }}</label>
            <input type="text" name="opened_dou[]" id="searchOrganOrganizationDow" class="oneInputSaveEnter" />

            <x-select-distance name="organization_dow_distance" class="distance distance_searchOrganOrganizationDow"/>

            @if (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganOrganizationDowOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganOrganizationDowOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganOrganizationDowOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <div class="forForm">
            <label for="fileSearch">{{ __('content.file_search') }}</label>
            <input type="text" name="content" id="fileSearch"/>
            <x-select-distance name="content_distance" class="distance distance_fileSearch"/>
        </div>

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
    var currentInputNameOrgan;
    var currentInputIdOrgan;
    var searchInput;

    $(document).ready(function(){
        var lang = `{{ app()->getLocale() }}`
        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        showHideDistance('fileSearch','distance_fileSearch');
        showHideDistance('searchOrganNameOrganization','distance_searchOrganNameOrganization');
        showHideDistance('searchOrganAttention','distance_searchOrganAttention');
        showHideDistance('searchOrganOrganizationDow','distance_searchOrganOrganizationDow');

        searchMultiSelectMaker( 'searchOrganNameOrganization' , 'name_organization' );
        searchMultiSelectMaker( 'searchOrganNumberWorker' , 'employers_count' );
        searchMultiSelectMaker( 'searchOrganAttention' , 'attension' );
        searchMultiSelectMaker( 'searchOrganOrganizationDow' , 'opened_dou' );

        searchMultiSelectMakerAutoComplete( 'searchOrganNation' , 'country_id' );
        searchMultiSelectMakerAutoComplete( 'searchOrganRegionActivity' , 'country_ate_id' );
        searchMultiSelectMakerAutoComplete( 'searchOrganCategoryOrganization' , 'category_id' );
        searchMultiSelectMakerAutoComplete( 'searchOrganSecurityOrganization' , 'agency_id' );

        $('.oneInputSaveDateOrganization').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateOrganization').focusout(function(e){
            var val = $(this).val();
            var field = $(this).attr('name');
            var reg = date_preg;
            var c = $(window.lastElementClicked).attr('id');
            if( (typeof $(this).attr('type') != 'undefined')&&(val.length != 0) ){
                if( (val.length == 6)||(val.length == 8) ){
                    var day = val.slice(0,2);
                    var month = val.slice(2,4);
                    var year = val.slice(4,8);
                    if(year.length == 2){
                        year = '20'+year;
                    }
                    val = day+'-'+month+'-'+year;
                    if(reg.test(val)){
                        $(this).val(val);
                    }else{
                        $(this).val('');
                        if( c!= 'resetButton'){
                            alert(`{{ __('content.enter_number') }}`);
                        }
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        if( c!= 'resetButton'){
                            alert(`{{ __('content.enter_number') }}`);
                        }
                    }else{
                    }
                }
            }
        });

        // $('#searchOrganNation').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/country/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchOrganNationId').val(dataItem.id);
        //     }
        // });


        // $('#searchOrganRegionActivity').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/country_ate/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchOrganRegionActivityId').val(dataItem.id);
        //     }
        // });


        // $('#searchOrganCategoryOrganization').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/organization_category/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchOrganCategoryOrganizationId').val(dataItem.id);
        //     }
        // });


        // $('#searchOrganSecurityOrganization').kendoAutoComplete({
        //     dataTextField: "name",
        //     filter: "contains",
        //     minLength: 3,
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/agency/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchOrganSecurityOrganizationId').val(dataItem.id);
        //     }
        // });

        // $('.addMore').click(function(e){
        //     e.preventDefault();
        //     var url = $(this).attr('dataTableName');
        //     currentInputNameOrgan = $(this).attr('dataName');
        //     currentInputIdOrgan = $(this).attr('dataId');
        //     $.fancybox({
        //         'type'  : 'iframe',
        //         'autoSize': false,
        //         'width'             : 800,
        //         'height'            : 600,
        //         'href'              : '/' + lang + '/autocomplete/' + url + '&type=organization'
        //     });
        // });

        $('#closeOrganization').click(function(e){
            e.preventDefault();
            var dataId = $('.activeTable').attr('dataId');
            $('.activeTable').addClass('storedItem');
            if(typeof  dataId == 'undefined'){
                $('.activeTable').append(' : id = '+organization_id);
                $('.activeTable').attr('dataId',organization_id);
            }
            $('.activeTable').removeClass('activeTable');
        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#organization_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#organization_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchOrganNameOrganization').val(`{{ html_entity_decode($search_params['name_organization'][sizeof($search_params['name_organization'])-1]) }}`);
            $('#searchOrganNationId').val(`{{ $search_params['country_id'][sizeof($search_params['country_id'])-1] }}`);
            $('#searchOrganNation').val(`{{ html_entity_decode($search_params['nation']) }}`);
            $('#searchOrganDateFormation').val(`{{ $search_params['reg_date'] }}`);
            $('#searchOrganRegionActivityId').val(`{{ $search_params['country_ate_id'][sizeof($search_params['country_ate_id'])-1] }}`);
            $('#searchOrganRegionActivity').val(`{{ html_entity_decode($search_params['region_activity']) }}`);
            $('#searchOrganCategoryOrganizationId').val(`{{ $search_params['category_id'][sizeof($search_params['category_id'])-1] }}`);
            $('#searchOrganCategoryOrganization').val(`{{ html_entity_decode($search_params['category_organization']) }}`);
            $('#searchOrganSecurityOrganizationId').val(`{{ $search_params['agency_id'][sizeof($search_params['agency_id'])-1] }}`);
            $('#searchOrganSecurityOrganization').val(`{{ html_entity_decode($search_params['security_organization']) }}`);
            $('#searchOrganNumberWorker').val(`{{ html_entity_decode($search_params['employers_count'][sizeof($search_params['employers_count'])-1]) }}`);
            $('#searchOrganAttention').val(`{{ html_entity_decode($search_params['attension'][sizeof($search_params['attension'])-1]) }}`);
            $('#searchOrganOrganizationDow').val(`{{ html_entity_decode($search_params['opened_dou'][sizeof($search_params['opened_dou'])-1]) }}`);
            $('#fileSearch').val(`{{ html_entity_decode($search_params['content']) }}`);
        <?php } ?>
    });

    function closeOrganization(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameOrgan).val(name);
        $('#'+currentInputIdOrgan).val(id);
        var field = $('#'+currentInputIdOrgan).attr('name');

        $.fancybox.close();
        $('#'+currentInputNameOrgan).focus();
    }


</script>

@endsection
@endsection
