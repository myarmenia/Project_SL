@extends('layouts.include-app')

@section('content-include')

<a class="closeButton"></a>
<div class="inContent">
    <form id="workActivityForm" action="/{{ app()->getLocale() }}/simplesearch/result_work_activity" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="work_activity_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="work_activity_or" />
            <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['title'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchWorkPositionFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['title'])-1 ; $i++ ) { ?>
                <li id="listItemsearchWorkPosition">
                    <div class="item">
                        <span><?php echo $search_params['title'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="title[]" value="<?php echo $search_params['title'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="title_type" id="searchWorkPositionType" value="<?php echo $search_params['title_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchWorkPosition">{{ __('content.position') }}</label>
            <input type="text" name="title[]" id="searchWorkPosition" class="oneInputSaveEnter"/>
            @if (isset($search_params['title_type']) && $search_params['title_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWorkPositionOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['title_type']) && $search_params['title_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWorkPositionOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['title_type']) && $search_params['title_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWorkPositionOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['period'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchWorkDataReferPeriodFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['period'])-1 ; $i++ ) { ?>
                <li id="listItemsearchWorkDataReferPeriod">
                    <div class="item">
                        <span><?php echo $search_params['period'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="period[]" value="<?php echo $search_params['period'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="period_type" id="searchWorkDataReferPeriodType" value="<?php echo $search_params['period_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchWorkDataReferPeriod">{{ __('content.data_refer_period') }}</label>
            <input type="text" name="period[]" id="searchWorkDataReferPeriod" class="oneInputSaveEnter"/>
            @if (isset($search_params['period_type']) && $search_params['period_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWorkDataReferPeriodOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['period_type']) && $search_params['period_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWorkDataReferPeriodOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['period_type']) && $search_params['period_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWorkDataReferPeriodOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <div class="forForm">
            <label for="searchWorkStartEmployment">{{ __('content.start_employment') }}</label>
            <input type="text" name="start_date" id="searchWorkStartEmployment" style="width: 505px;" onkeydown="validateNumber(event,'searchWorkStartEmployment',12)" class="datePicker oneInputSaveEnter oneInputSaveDateWorkActivity"/>
            <input type="hidden" id="workStart_date"/>
        </div>

        <div class="forForm">
            <label for="searchWorkEndEmployment">{{ __('content.end_employment') }}</label>
            <input type="text" name="end_date" id="searchWorkEndEmployment" style="width: 505px;" onkeydown="validateNumber(event,'searchWorkEndEmployment',12)" class="datePicker oneInputSaveEnter oneInputSaveDateWorkActivity"/>
            <input type="hidden" id="workEnd_date"/>
        </div>

        <div class="forForm">
            <label for="fileSearch">{{ __('content.file_search') }}</label>
            <input type="text" name="content" id="fileSearch"/>
        </div>

        <div class="buttons">

        </div>

    </form>
</div>

@section('js-include')

<script>

    var currentInputNameWorkActivity;
    var currentInputIdWorkActivity;
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMaker( 'searchWorkPosition' , 'title' );
        searchMultiSelectMaker( 'searchWorkDataReferPeriod' , 'period' );

        $('.oneInputSaveDateWorkActivity').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateWorkActivity').focusout(function(e){
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
                        $('#'+field).val(val);
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
                        $('#'+field).val(val);
                    }
                }
            }
        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#work_activity_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#work_activity_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchWorkPosition').val(`{{ html_entity_decode($search_params['title'][sizeof($search_params['title'])-1]) }}`);
            $('#searchWorkDataReferPeriod').val(`{{ html_entity_decode($search_params['period'][sizeof($search_params['period'])-1]) }}`);
            $('#searchWorkStartEmployment').val(`{{ $search_params['start_date'] }}`);
            $('#searchWorkEndEmployment').val(`{{ $search_params['end_date'] }}`);
            $('#fileSearch').val(`{{ html_entity_decode($search_params['content']) }}`);
        <?php } ?>

    });


</script>

@endsection
@endsection
