@extends('layouts.include-app')

@section('content-include')

<a class="closeButton" ></a>
<div class="inContent">
    <form id="miaSummaryForm" action="/{{ app()->getLocale() }}/simplesearch/result_mia_summary" method="post">
        @if(!empty($checkUrl) && $checkUrl !== 'advancedsearch')
            <x-back-previous-url />
        @endif
        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="mia_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="mia_or" />
            <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /><?php } ?>
        </div>

        <div class="forForm ">
            <label for="seachMiaDateRegistrationReports">{{ __('content.date_registration_reports') }}</label>
            <input type="text" name="date" id="seachMiaDateRegistrationReports" style="width: 505px;" onkeydown="validateNumber(event,'seachMiaDateRegistrationReports',12)"  class="oneInputSaveEnter oneInputSaveDateMia"/>
        </div>

        <?php if (isset($search_params) && isset($search_params['content'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="miaContentInfFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['content'])-1 ; $i++ ) { ?>
                <li id="listItemmiaContentInf">
                    <div class="item">
                        <span><?php echo $search_params['content'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="content[]" value="<?php echo $search_params['content'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="content_type" id="miaContentInfType" value="<?php echo $search_params['content_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="miaContentInf">{{ __('content.content_inf') }}</label>
            <input type="text" name="content[]" id="miaContentInf" class="oneInputSaveEnter" />

            <x-select-distance name="content_distance" class="distance distance_miaContentInf"/>

            @if (isset($search_params['content_type']) && $search_params['content_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="miaContentInfOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['content_type']) && $search_params['content_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="miaContentInfOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['content_type']) && $search_params['content_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="miaContentInfOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        {{-- <div class="forForm">
            <label for="fileSearch">{{ __('content.file_search') }}</label>
            <input type="text" name="file_content" id="fileSearch"/>
            <x-select-distance name="content_distance" class="distance distance_fileSearch"/>
        </div> --}}

        <div class="buttons">

        </div>

    </form>
</div>

@section('js-include')
<script>
    var currentInputNameMia;
    var currentInputIdMia;
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });
        showHideDistance('fileSearch','distance_fileSearch');
        showHideDistance('miaContentInf','distance_miaContentInf');

        searchMultiSelectMaker( 'miaContentInf' , 'content' );

        $('.oneInputSaveDateMia').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('.oneInputSaveDateMia').focusout(function(e){
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

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#mia_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#mia_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#miaContentInf').val(`{{ html_entity_decode($search_params['content'][sizeof($search_params['content'])-1]) }}`);
            $('#seachMiaDateRegistrationReports').val(`{{ $search_params['date'] }}`);
        <?php } ?>
    });

</script>

@endsection
@endsection

