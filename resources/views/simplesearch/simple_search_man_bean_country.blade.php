@extends('layouts.include-app')

@section('include-css')
    <link href="{{ asset('assets/css/main/open-modal.css') }}" rel="stylesheet" />
@endsection

@section('content-include')

<a class="closeButton"></a>
<div class="inContent">
    <form id="manBeanCountryForm" action="/{{ app()->getLocale() }}/simplesearch/result_man_bean_country" method="post">
        @if(!empty($checkUrl) && $checkUrl !== 'advancedsearch')
            <x-back-previous-url />
        @endif
        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="mnb_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="mnb_or" />
            <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['goal_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchMbcPurposeVisitFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['goal_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchMbcPurposeVisit">
                    <div class="item">
                        <span><?php echo $search_params['goal_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="goal_id[]" value="<?php echo $search_params['goal_id'][$i] ?>">
                    <input type="hidden" name="goal_idName[]" value="<?php echo $search_params['goal_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="goal_id_type" id="searchMbcPurposeVisitType" value="<?php echo $search_params['goal_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchMbcPurposeVisit">{{ __('content.purpose_visit') }}</label>
            <input  type="button"
                    dataName="searchMbcPurposeVisit"
                    dataId="searchMbcPurposeVisitId"
                    dataTableName="fancy/goal"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="goal"
                    />
            <input  type="text"
                    name="goal"
                    id="searchMbcPurposeVisit"
                    dataTableName="goal"
                    dataInputId="searchMbcPurposeVisitId"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="goal"
                    />
            @if (isset($search_params['goal_id_type']) && $search_params['goal_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcPurposeVisitOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['goal_id_type']) && $search_params['goal_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcPurposeVisitOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['goal_id_type']) && $search_params['goal_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcPurposeVisitOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="goal_id[]" id="searchMbcPurposeVisitId" />
            <datalist id="goal" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['country_ate_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchMbcCountryAteFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['country_ate_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchMbcCountryAte">
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
            <input type="hidden" name="country_ate_id_type" id="searchMbcCountryAteType" value="<?php echo $search_params['country_ate_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchMbcCountryAte">{{ __('content.country_ate') }}</label>
            <input  type="button"
                    dataName="searchMbcCountryAte"
                    dataId="searchMbcCountryAteId"
                    dataTableName="fancy/country_ate"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="country_ate"
                    />
            <input  type="text"
                    name="country_ate"
                    id="searchMbcCountryAte"
                    dataTableName="country_ate"
                    dataInputId="searchMbcCountryAteId"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="country_ate"
                    />
            @if (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcCountryAteOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcCountryAteOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcCountryAteOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="country_ate_id[]" id="searchMbcCountryAteId" />
            <datalist id="country_ate" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <div class="forForm">
            <label for="searchMbcEntryDate">{{ __('content.entry_date') }}</label>
            <input type="text" name="entry_date" id="searchMbcEntryDate" style="width: 505px;" onkeydown="validateNumber(event,'searchMbcEntryDate',12)"  class="oneInputSaveEnter oneInputSaveDateManBeanCountry" />
        </div>

        <div class="forForm">
            <label for="searchMbcExitDate">{{ __('content.exit_date') }}</label>
            <input type="text" name="exit_date" id="searchMbcExitDate" style="width: 505px;" onkeydown="validateNumber(event,'searchMbcExitDate',12)" class="oneInputSaveEnter oneInputSaveDateManBeanCountry" />
        </div>

        <?php if (isset($search_params) && isset($search_params['region_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchMbcRegionLocalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['region_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchMbcRegionLocal">
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
            <input type="hidden" name="region_id_type" id="searchMbcRegionLocalType" value="<?php echo $search_params['region_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchMbcRegionLocal">{{ __('content.region_local') }}</label>
            <input  type="button"
                    dataName="searchMbcRegionLocal"
                    dataId="searchMbcRegionLocalId"
                    dataTableName="fancy/region"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="region"
                    />
            <input  type="text"
                    name="region_name"
                    id="searchMbcRegionLocal"
                    dataTableName="region"
                    dataInputId="searchMbcRegionLocalId"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="region"
                    />
            @if (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcRegionLocalOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcRegionLocalOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['region_id_type']) && $search_params['region_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcRegionLocalOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="region_id[]" id="searchMbcRegionLocalId" />
            <datalist id="region" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['locality_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchMbcLocalityLocalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['locality_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchMbcLocalityLocal">
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
            <input type="hidden" name="locality_id_type" id="searchMbcLocalityLocalType" value="<?php echo $search_params['locality_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchMbcLocalityLocal">{{ __('content.locality_local') }}</label>
            <input  type="button"
                    dataName="searchMbcLocalityLocal"
                    dataId="searchMbcLocalityLocalId"
                    dataTableName="fancy/locality"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="locality"
                    />
            <input  type="text"
                    name="locality_local"
                    id="searchMbcLocalityLocal"
                    dataTableName="locality"
                    dataInputId="searchMbcLocalityLocalId"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="locality"
                    />
            @if (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcLocalityLocalOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcLocalityLocalOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['locality_id_type']) && $search_params['locality_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcLocalityLocalOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="locality_id[]" id="searchMbcLocalityLocalId" />
            <datalist id="locality" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['region'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchMbcRegionFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['region'])-1 ; $i++ ) { ?>
                <li id="listItemsearchMbcRegion">
                    <div class="item">
                        <span><?php echo $search_params['region'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="region[]" value="<?php echo $search_params['region'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="region_type" id="searchMbcRegionType" value="<?php echo $search_params['region_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchMbcRegion">{{ __('content.region') }}</label>
            <input type="text" name="region[]" id="searchMbcRegion" class="oneInputSaveEnter" />

            <x-select-distance name="region_name_distance" class="distance distance_searchMbcRegion"/>

            @if (isset($search_params['region_type']) && $search_params['region_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcRegionOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['region_type']) && $search_params['region_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcRegionOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['region_type']) && $search_params['region_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcRegionOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['locality'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchMbcLocalityFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['locality'])-1 ; $i++ ) { ?>
                <li id="listItemsearchMbcLocality">
                    <div class="item">
                        <span><?php echo $search_params['locality'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="locality[]" value="<?php echo $search_params['locality'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="locality_type" id="searchMbcLocalityType" value="<?php echo $search_params['locality_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchMbcLocality">{{ __('content.locality') }}</label>
            <input type="text" name="locality[]" id="searchMbcLocality" class="oneInputSaveEnter" />

            <x-select-distance name="locality_name_distance" class="distance distance_searchMbcLocality"/>

            @if (isset($search_params['locality_type']) && $search_params['locality_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcLocalityOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['locality_type']) && $search_params['locality_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcLocalityOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['locality_type']) && $search_params['locality_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchMbcLocalityOp">{{ __('content.not_equal') }}</span>
            @endif
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
    var currentInputNameMbc;
    var currentInputIdMbc;
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        showHideDistance('searchMbcRegion','distance_searchMbcRegion');

        searchMultiSelectMaker( 'searchMbcRegion' , 'region' );
        searchMultiSelectMaker( 'searchMbcLocality' , 'locality' );

        searchMultiSelectMakerAutoComplete( 'searchMbcPurposeVisit' , 'goal_id' );
        searchMultiSelectMakerAutoComplete( 'searchMbcCountryAte' , 'country_ate_id' );
        searchMultiSelectMakerAutoComplete( 'searchMbcRegionLocal' , 'region_id' );
        searchMultiSelectMakerAutoComplete( 'searchMbcLocalityLocal' , 'locality_id' );

        $('.oneInputSaveDateManBeanCountry').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('.oneInputSaveDateManBeanCountry').focusout(function(e){
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
                    }
                }
            }
        });

        // $('#searchMbcPurposeVisit').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/goal/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchMbcPurposeVisitId').val(dataItem.id);
        //     }
        // });

        // $('#searchMbcCountryAte').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/country_ate/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchMbcCountryAteId').val(dataItem.id);
        //     }
        // });

        // $('#searchMbcRegionLocal').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/region/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchMbcRegionLocalId').val(dataItem.id);
        //     }
        // });

        // $('#searchMbcLocalityLocal').kendoAutoComplete({
        //     dataTextField: "name",
        //     filter: "contains",
        //     minLength: 3,
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/locality/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchMbcLocalityLocalId').val(dataItem.id);
        //     }
        // });



        // $('.addMore').click(function(e){
        //     e.preventDefault();
        //     var url = $(this).attr('dataTableName');
        //     currentInputNameMbc = $(this).attr('dataName');
        //     currentInputIdMbc = $(this).attr('dataId');
        //     $.fancybox({
        //         'type'  : 'iframe',
        //         'autoSize': false,
        //         'width'             : 800,
        //         'height'            : 600,
        //         'href'              : `/${lang}/autocomplete/`+url+"&type=man_bean_country"
        //     });
        // });

        $('#closeManBeanCountry').click(function(e){
            e.preventDefault();
            var country_ate_id = $('#mbcCountryAteId').val();
            if(country_ate_id.length == 0){
                var checkConfirm = confirm(`{{ __('content.country_quit') }}`);
                if(checkConfirm){
                    removeItem();
                }
            }else{
                var data = $('#manBeanCountryForm').serializeArray();
                man_bean_country(data);
            }
        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#mnb_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#mnb_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchMbcLocality').val(`{{  html_entity_decode($search_params['locality'][sizeof($search_params['locality'])-1]) }}`);
            $('#searchMbcRegion').val(`{{  html_entity_decode($search_params['region'][sizeof($search_params['region'])-1]) }}`);
            $('#searchMbcLocalityLocalId').val(`{{  $search_params['locality_id'][sizeof($search_params['locality_id'])-1] }}`);
            $('#searchMbcLocalityLocal').val(`{{  html_entity_decode($search_params['locality_local']) }}`);
            $('#searchMbcRegionLocalId').val(`{{  $search_params['region_id'][sizeof($search_params['region_id'])-1] }}`);
            $('#searchMbcRegionLocal').val(`{{  html_entity_decode($search_params['region_name']) }}`);
            $('#searchMbcExitDate').val(`{{  $search_params['exit_date'] }}`);
            $('#searchMbcEntryDate').val(`{{  $search_params['entry_date'] }}`);
            $('#searchMbcCountryAteId').val(`{{  $search_params['country_ate_id'][sizeof($search_params['country_ate_id'])-1] }}`);
            $('#searchMbcCountryAte').val(`{{  html_entity_decode($search_params['country_ate']) }}`);
            $('#searchMbcPurposeVisitId').val(`{{  $search_params['goal_id'][sizeof($search_params['goal_id'])-1] }}`);
            $('#searchMbcPurposeVisit').val(`{{  html_entity_decode($search_params['goal']) }}`);
        <?php } ?>

    });
    function closeManBeanCountry(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameMbc).val(name);
        $('#'+currentInputIdMbc).val(id);
        var field = $('#'+currentInputIdMbc).attr('name');

        $.fancybox.close();
        $('#'+currentInputNameMbc).focus();
    }

    //    function saveManBeanCountry(value,field){
    //        var data = { 'value':value, 'field':field };
    //        $.ajax({
    //            url: `/${lang}/add/save_man_bean_country/`+mbc_id,
    //            type: 'POST',
    //            data:data,
    //            success: function(data){
    //                checkMan = false;
    //            },
    //            faild: function(data){
    //                alert('error ');
    //            }
    //        });
    //    }


</script>

@endsection
@endsection

