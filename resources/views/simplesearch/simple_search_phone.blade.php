@extends('layouts.include-app')

@section('content-include')

<a class = "closeButton"></a>
<div class="inContent">
    <form id="phoneForm" action="/{{ app()->getLocale() }}/simplesearch/result_phone" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="phone_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="phone_or" />
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
            <?php if (isset($search_params['number_type']) && $search_params['number_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhonePhoneNumberOp">ИЛИ</span>
            <?php } else if (isset($search_params['number_type']) && $search_params['number_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhonePhoneNumberOp">И</span>
            <?php } ?>
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
            <input type="button" dataName="searchPhoneManNatureCharacter" dataId="searchPhoneManNatureCharacterId" dataTableName="fancy/`character`" class="addMore k-icon k-i-plus"   />
            <input type="text" name="nature_character" id="searchPhoneManNatureCharacter" dataTableName="character" dataInputId="searchPhoneManNatureCharacterId" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['character_man_id_type']) && $search_params['character_man_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneManNatureCharacterOp">ИЛИ</span>
            <?php } else if (isset($search_params['character_man_id_type']) && $search_params['character_man_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneManNatureCharacterOp">И</span>
            <?php } ?>
            <input type="hidden" name="character_man_id[]" id="searchPhoneManNatureCharacterId" />
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
            <input type="button" dataName="searchPhoneOrgNatureCharacter" dataId="searchPhoneOrgNatureCharacterId" dataTableName="fancy/`character`" class="addMore k-icon k-i-plus"   />
            <input type="text" name="character_organization" id="searchPhoneOrgNatureCharacter" dataTableName="character" dataInputId="searchPhoneOrgNatureCharacterId" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['character_organization_id_type']) && $search_params['character_organization_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneOrgNatureCharacterOp">ИЛИ</span>
            <?php } else if (isset($search_params['character_organization_id_type']) && $search_params['character_organization_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneOrgNatureCharacterOp">И</span>
            <?php } ?>
            <input type="hidden" name="character_organization_id[]" id="searchPhoneOrgNatureCharacterId" />
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
            <?php if (isset($search_params['more_data_type']) && $search_params['more_data_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneAdditionalDataOp">ИЛИ</span>
            <?php } else if (isset($search_params['more_data_type']) && $search_params['more_data_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchPhoneAdditionalDataOp">И</span>
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
@section('js-include')
<script>
    var currentInputNamePhone;
    var currentInputIdPhone;
    var searchInput;
    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMaker( 'searchPhonePhoneNumber' , 'number' );
        searchMultiSelectMaker( 'searchPhoneAdditionalData' , 'more_data' );

        searchMultiSelectMakerAutoComplete( 'searchPhoneManNatureCharacter' , 'character_man_id' );
        searchMultiSelectMakerAutoComplete( 'searchPhoneOrgNatureCharacter' , 'character_organization_id' );

        $('#searchPhoneManNatureCharacter').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: '/' + lang + '/dictionary/character/read'
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchPhoneManNatureCharacterId').val(dataItem.id);
            }
        });

        $('#searchPhoneOrgNatureCharacter').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: '/' + lang + '/dictionary/character/read'
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchPhoneOrgNatureCharacterId').val(dataItem.id);
            }
        });



        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNamePhone = $(this).attr('dataName');
            currentInputIdPhone = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : '/' + lang + '/autocomplete/'+url+"&type=phone"
            });
        });

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

