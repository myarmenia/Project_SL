@extends('layouts.include-app')

@section('include-css')
    <link href="{{ asset('assets/css/main/open-modal.css') }}" rel="stylesheet" />
@endsection

@section('content-include')

<a class = "closeButton"></a>
<div class="inContent">
    <form id="phoneForm" action="/{{ app()->getLocale() }}/simplesearch/result_phone" method="post">
        @if(!empty($checkUrl) && $checkUrl !== 'advancedsearch')

            <x-back-previous-url />
        @endif

        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="phone_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="phone_or" />
            <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['number'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchPhonePhoneNumberFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['number'])-1 ; $i++ ) { ?>
                <li id="listItemsearchPhonePhoneNumber">
                    <div class="item">
                        <span><?php echo $search_params['number'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="number[]" value="<?php echo $search_params['number'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="number_type" id="searchPhonePhoneNumberType" value="<?php echo $search_params['number_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchPhonePhoneNumber">{{ __('content.phone_number') }}</label>
            <input type="text" name="number[]" id="searchPhonePhoneNumber" onkeydown="validateNumber(event,'searchPhonePhoneNumber',20)" class="oneInputSaveEnter"/>

            <x-select-distance name="number_distance" class="distance distance_searchPhonePhoneNumber"/>

            @if (isset($search_params['number_type']) && $search_params['number_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhonePhoneNumberOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['number_type']) && $search_params['number_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhonePhoneNumberOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['number_type']) && $search_params['number_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhonePhoneNumberOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['character_man_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchPhoneManNatureCharacterFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['character_man_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchPhoneManNatureCharacter">
                    <div class="item">
                        <span><?php echo $search_params['character_man_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="character_man_id[]" value="<?php echo $search_params['character_man_id'][$i] ?>">
                    <input type="hidden" name="character_man_idName[]" value="<?php echo $search_params['character_man_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="character_man_id_type" id="searchPhoneManNatureCharacterType" value="<?php echo $search_params['character_man_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchPhoneManNatureCharacter">{{ __('content.nature_character_man') }}</label>
            <input  type="button"
                    dataName="searchPhoneManNatureCharacter"
                    dataId="searchPhoneManNatureCharacterId"
                    dataTableName="fancy/`character`"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="character"
                    />
            <input  type="text"
                    name="nature_character"
                    id="searchPhoneManNatureCharacter"
                    dataTableName="character"
                    dataInputId="searchPhoneManNatureCharacterId"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="character"
                    />
            @if (isset($search_params['character_man_id_type']) && $search_params['character_man_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneManNatureCharacterOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['character_man_id_type']) && $search_params['character_man_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneManNatureCharacterOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['character_man_id_type']) && $search_params['character_man_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneManNatureCharacterOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="character_man_id[]" id="searchPhoneManNatureCharacterId" />
            <datalist id="character" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['character_organization_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchPhoneOrgNatureCharacterFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['character_organization_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchPhoneOrgNatureCharacter">
                    <div class="item">
                        <span><?php echo $search_params['character_organization_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="character_organization_id[]" value="<?php echo $search_params['character_organization_id'][$i] ?>">
                    <input type="hidden" name="character_organization_idName[]" value="<?php echo $search_params['character_organization_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="character_organization_id_type" id="searchPhoneOrgNatureCharacterType" value="<?php echo $search_params['character_organization_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchPhoneOrgNatureCharacter">{{ __('content.nature_character_organization') }}</label>
            <input  type="button"
                    dataName="searchPhoneOrgNatureCharacter"
                    dataId="searchPhoneOrgNatureCharacterId"
                    dataTableName="fancy/`character`"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="character"
                    />
            <input  type="text"
                    name="character_organization"
                    id="searchPhoneOrgNatureCharacter"
                    dataTableName="character"
                    dataInputId="searchPhoneOrgNatureCharacterId"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="character_one"
                    />
            @if (isset($search_params['character_organization_id_type']) && $search_params['character_organization_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneOrgNatureCharacterOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['character_organization_id_type']) && $search_params['character_organization_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneOrgNatureCharacterOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['character_organization_id_type']) && $search_params['character_organization_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneOrgNatureCharacterOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="character_organization_id[]" id="searchPhoneOrgNatureCharacterId" />
            <datalist id="character_one" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['more_data'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchPhoneAdditionalDataFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['more_data'])-1 ; $i++ ) { ?>
                <li id="listItemsearchPhoneAdditionalData">
                    <div class="item">
                        <span><?php echo $search_params['more_data'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="more_data[]" value="<?php echo $search_params['more_data'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="more_data_type" id="searchPhoneAdditionalDataType" value="<?php echo $search_params['more_data_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchPhoneAdditionalData">{{ __('content.additional_data') }}</label>
            <input type="text" name="more_data[]" id="searchPhoneAdditionalData" class="oneInputSaveEnter"/>

            <x-select-distance name="more_data_distance" class="distance distance_searchPhoneAdditionalData"/>

            @if (isset($search_params['more_data_type']) && $search_params['more_data_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneAdditionalDataOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['more_data_type']) && $search_params['more_data_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneAdditionalDataOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['more_data_type']) && $search_params['more_data_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneAdditionalDataOp">{{ __('content.not_equal') }}</span>
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
<<<<<<< HEAD
{{-- @if(!empty($checkUrl) && $checkUrl !== 'advancedsearch')
    <x-fullscreen-modal/>
@endif --}}

=======
  {{-- <x-fullscreen-modal/> --}}
>>>>>>> 6fbd172069dc1d9c4d531c41f5674e745b4d0cef

@section('js-include')

<script>
    let open_modal_url = `{{ route('open.modal') }}`
    let get_filter_in_modal = `{{ route('get-model-filter') }}`


</script>

{{-- <script src="{{ asset('assets-include/js/script.js') }}" class="aa"></script> --}}
<script>
    var currentInputNamePhone;
    var currentInputIdPhone;
    var searchInput;
    $(document).ready(function(){

        let inputPhone = document.getElementById('searchPhonePhoneNumber')

        inputPhone.addEventListener('input', (e) =>{

        let arr = inputPhone.value.split('')

        for (let i = 0; i < arr.length; i++) {
        if (arr[i] != +arr[i] && arr[i] !== '(' && arr[i] !== ')'){
        arr[i] = ''
        }

        inputPhone.value = arr.join('').replaceAll(' ', '')
        }
        })

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });
        showHideDistance('fileSearch','distance_fileSearch');
        showHideDistance('searchPhonePhoneNumber','distance_searchPhonePhoneNumber');
        showHideDistance('searchPhoneAdditionalData','distance_searchPhoneAdditionalData');

        searchMultiSelectMaker( 'searchPhonePhoneNumber' , 'number' );
        searchMultiSelectMaker( 'searchPhoneAdditionalData' , 'more_data' );

        searchMultiSelectMakerAutoComplete( 'searchPhoneManNatureCharacter' , 'character_man_id' );
        searchMultiSelectMakerAutoComplete( 'searchPhoneOrgNatureCharacter' , 'character_organization_id' );

        // $('#searchPhoneManNatureCharacter').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/character/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchPhoneManNatureCharacterId').val(dataItem.id);
        //     }
        // });

        // $('#searchPhoneOrgNatureCharacter').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/character/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchPhoneOrgNatureCharacterId').val(dataItem.id);
        //     }
        // });



        // $('.addMore').click(function(e){
        //     e.preventDefault();
        //     var url = $(this).attr('dataTableName');
        //     currentInputNamePhone = $(this).attr('dataName');
        //     currentInputIdPhone = $(this).attr('dataId');
        //     $.fancybox({
        //         'type'  : 'iframe',
        //         'autoSize': false,
        //         'width'             : 800,
        //         'height'            : 600,
        //         'href'              : '/' + lang + '/autocomplete/'+url+"&type=phone"
        //     });
        // });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#phone_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#phone_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchPhonePhoneNumber').val(`{{ html_entity_decode($search_params['number'][sizeof($search_params['number'])-1]) }}`);
            $('#searchPhoneManNatureCharacterId').val(`{{ $search_params['character_man_id'][sizeof($search_params['character_man_id'])-1] }}`);
            $('#searchPhoneManNatureCharacter').val(`{{ html_entity_decode($search_params['nature_character']) }}`);
            $('#searchPhoneOrgNatureCharacterId').val(`{{ $search_params['character_organization_id'][sizeof($search_params['character_organization_id'])-1] }}`);
            $('#searchPhoneOrgNatureCharacter').val(`{{ html_entity_decode($search_params['character_organization']) }}`);
            $('#searchPhoneAdditionalData').val(`{{ html_entity_decode($search_params['more_data'][sizeof($search_params['more_data'])-1]) }}`);
            $('#fileSearch').val(`{{ html_entity_decode($search_params['content']) }}`);
        <?php } ?>

    });

    function closePhone(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNamePhone).val(name);
        $('#'+currentInputIdPhone).val(id);
        $.fancybox.close();
    }



</script>

@endsection
@endsection

