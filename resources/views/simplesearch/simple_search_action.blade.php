@extends('layouts.include-app')

@section('include-css')
    <link href="{{ asset('assets/css/main/open-modal.css') }}" rel="stylesheet" />
@endsection


@section('content-include')

<a class="closeButton"></a>
<div class="inContent">
    <form id="actionForm" action="/{{ app()->getLocale() }}/simplesearch/result_action" method="post">


        @if(!empty($checkUrl) && $checkUrl !== 'advancedsearch')
            <x-back-previous-url />
        @endif


        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="action_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="action_or" />
            <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton"  class="k-button" >{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /> <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['material_content'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchActionContentMaterialsActionsFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['material_content'])-1 ; $i++ ) { ?>
                <li id="listItemsearchActionContentMaterialsActions">
                    <div class="item">
                        <span><?php echo $search_params['material_content'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="material_content[]" value="<?php echo $search_params['material_content'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="material_content_type" id="searchActionContentMaterialsActionsType" value="<?php echo $search_params['material_content_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchActionContentMaterialsActions">{{ __('content.content_materials_actions') }}</label>
            <input type="text" name="material_content[]" id="searchActionContentMaterialsActions" class="oneInputSaveEnter"/>

            <x-select-distance name="material_content_distance" class="distance distance_searchActionContentMaterialsActions"/>

            @if (isset($search_params['material_content_type']) && $search_params['material_content_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionContentMaterialsActionsOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['material_content_type']) && $search_params['material_content_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionContentMaterialsActionsOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['material_content_type']) && $search_params['material_content_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionContentMaterialsActionsOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['action_qualification_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchActionQualificationFactFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['action_qualification_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchActionQualificationFact">
                    <div class="item">
                        <span><?php echo $search_params['action_qualification_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="action_qualification_id[]" value="<?php echo $search_params['action_qualification_id'][$i] ?>">
                    <input type="hidden" name="action_qualification_idName[]" value="<?php echo $search_params['action_qualification_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="action_qualification_id_type" id="searchActionQualificationFactType" value="<?php echo $search_params['action_qualification_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchActionQualificationFact">{{ __('content.qualification_fact') }}</label>
            {{-- <input  type="button" dataName="searchActionQualificationFact" dataId="searchActionQualificationFactId" dataTableName="fancySearch/action_qualification" class="addMoreSearch k-icon k-i-search"   /> --}}
            <input  type="button"
                    dataName="searchActionQualificationFact"
                    dataId="searchActionQualificationFactId"
                    dataTableName="fancy/action_qualification"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="action_qualification"
                    />
            <input  type="text"
                    name="action_qualification"
                    dataInputId="searchActionQualificationFactId"
                    dataTableName="action_qualification"
                    id="searchActionQualificationFact"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="action_qualification"
                    />
            @if (isset($search_params['action_qualification_id_type']) && $search_params['action_qualification_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionQualificationFactOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['action_qualification_id_type']) && $search_params['action_qualification_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionQualificationFactOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['action_qualification_id_type']) && $search_params['action_qualification_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionQualificationFactOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="action_qualification_id[]" id="searchActionQualificationFactId" />
            <datalist id="action_qualification" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <div class="forForm">
            <label for="searchActionStartActionDate">{{ __('content.start_action_date') }}</label>
            <input type="text" name="start_date" id="searchActionStartActionDate" style="width: 505px;" class="oneInputSaveEnter oneInputSaveDateAction"/>
        </div>


        <div class="forForm">
            <label for="searchActionEndActionDate">{{ __('content.end_action_date') }}</label>
            <input type="text" name="end_date" id="searchActionEndActionDate" style="width: 505px;" class="oneInputSaveEnter oneInputSaveDateAction"/>
        </div>

        <?php if (isset($search_params) && isset($search_params['duration_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchActionDurationDActionFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['duration_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchActionDurationDAction">
                    <div class="item">
                        <span><?php echo $search_params['duration_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="duration_id[]" value="<?php echo $search_params['duration_id'][$i] ?>">
                    <input type="hidden" name="duration_idName[]" value="<?php echo $search_params['duration_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="duration_id_type" id="searchActionDurationDActionType" value="<?php echo $search_params['duration_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchActionDurationDAction">{{ __('content.duration_action') }}</label>
            <input  type="button"
                    dataName="searchActionDurationDAction"
                    dataId="searchActionDurationDActionId"
                    dataTableName="fancy/duration"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="duration"
                    />
            <input  type="text"
                    name="duration_name"
                    id="searchActionDurationDAction"
                    dataInputId="searchActionDurationDActionId"
                    dataTableName="duration"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="duration"
                    />
            @if (isset($search_params['duration_id_type']) && $search_params['duration_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionDurationDActionOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['duration_id_type']) && $search_params['duration_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionDurationDActionOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['duration_id_type']) && $search_params['duration_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionDurationDActionOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="duration_id[]" id="searchActionDurationDActionId" />
            <datalist id="duration" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['goal_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchActionPurposeMotiveReasonFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['goal_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchActionPurposeMotiveReason">
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
            <input type="hidden" name="goal_id_type" id="searchActionPurposeMotiveReasonType" value="<?php echo $search_params['goal_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchActionPurposeMotiveReason">{{ __('content.purpose_motive_reason') }}</label>
            <input  type="button"
                    dataName="searchActionPurposeMotiveReason"
                    dataId="searchActionPurposeMotiveReasonId"
                    dataTableName="fancy/action_goal"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="action_goal"
                    />
            <input  type="text"
                    name="goal_name"
                    id="searchActionPurposeMotiveReason"
                    dataInputId="searchActionPurposeMotiveReasonId"
                    dataTableName="action_goal"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="action_goal"
                    />
            @if (isset($search_params['goal_id_type']) && $search_params['goal_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionPurposeMotiveReasonOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['goal_id_type']) && $search_params['goal_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionPurposeMotiveReasonOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['goal_id_type']) && $search_params['goal_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionPurposeMotiveReasonOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="goal_id[]" id="searchActionPurposeMotiveReasonId" />
            <datalist id="action_goal" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['terms_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchActionTermsActionsFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['terms_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchActionTermsActions">
                    <div class="item">
                        <span><?php echo $search_params['terms_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="terms_id[]" value="<?php echo $search_params['terms_id'][$i] ?>">
                    <input type="hidden" name="terms_idName[]" value="<?php echo $search_params['terms_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="terms_id_type" id="searchActionTermsActionsType" value="<?php echo $search_params['terms_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchActionTermsActions">{{ __('content.terms_actions') }}</label>
            <input  type="button"
                    dataName="searchActionTermsActions"
                    dataId="searchActionTermsActionsId"
                    dataTableName="fancy/terms"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="terms"
                    />
            <input  type="text"
                    name="terms_name"
                    id="searchActionTermsActions"
                    dataInputId="searchActionTermsActionsId"
                    dataTableName="terms"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="terms"
                    />
            @if (isset($search_params['terms_id_type']) && $search_params['terms_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionTermsActionsOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['terms_id_type']) && $search_params['terms_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionTermsActionsOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['terms_id_type']) && $search_params['terms_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionTermsActionsOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="terms_id[]" id="searchActionTermsActionsId" />
            <datalist id="terms" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['aftermath_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchActionEnsuingEffectsFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['aftermath_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchActionEnsuingEffects">
                    <div class="item">
                        <span><?php echo $search_params['aftermath_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="aftermath_id[]" value="<?php echo $search_params['aftermath_id'][$i] ?>">
                    <input type="hidden" name="aftermath_idName[]" value="<?php echo $search_params['aftermath_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="aftermath_id_type" id="searchActionEnsuingEffectsType" value="<?php echo $search_params['aftermath_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchActionEnsuingEffects">{{ __('content.ensuing_effects') }}</label>
            <input  type="button"
                    dataName="searchActionEnsuingEffects"
                    dataId="searchActionEnsuingEffectsId"
                    dataTableName="fancy/aftermath"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="aftermath"
                    />
            <input  type="text"
                    name="aftermath_name"
                    id="searchActionEnsuingEffects"
                    dataInputId="searchActionEnsuingEffectsId"
                    dataTableName="aftermath"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    list="aftermath"
                    />
            @if (isset($search_params['aftermath_id_type']) && $search_params['aftermath_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionEnsuingEffectsOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['aftermath_id_type']) && $search_params['aftermath_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionEnsuingEffectsOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['aftermath_id_type']) && $search_params['aftermath_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionEnsuingEffectsOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="aftermath_id[]" id="searchActionEnsuingEffectsId" />
            <datalist id="aftermath" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['source'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchActionSourceInformationActionsFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['source'])-1 ; $i++ ) { ?>
                <li id="listItemsearchActionSourceInformationActions">
                    <div class="item">
                        <span><?php echo $search_params['source'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="source[]" value="<?php echo $search_params['source'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="source_type" id="searchActionSourceInformationActionsType" value="<?php echo $search_params['source_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchActionSourceInformationActions">{{ __('content.source_information_actions') }}</label>
            <input type="text" name="source[]" id="searchActionSourceInformationActions" class="oneInputSaveEnter oneInputSaveAction" />

            <x-select-distance name="source_distance" class="distance distance_searchActionSourceInformationActions"/>

            @if (isset($search_params['source_type']) && $search_params['source_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionSourceInformationActionsOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['source_type']) && $search_params['source_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionSourceInformationActionsOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['source_type']) && $search_params['source_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionSourceInformationActionsOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['opened_dou'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchActionOpenedDowFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['opened_dou'])-1 ; $i++ ) { ?>
                <li id="listItemsearchActionOpenedDow">
                    <div class="item">
                        <span><?php echo $search_params['opened_dou'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="opened_dou[]" value="<?php echo $search_params['opened_dou'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="opened_dou_type" id="searchActionOpenedDowType" value="<?php echo $search_params['opened_dou_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchActionOpenedDow">{{ __('content.opened_dou') }}</label>
            <input type="text" name="opened_dou[]" id="searchActionOpenedDow" class="oneInputSaveEnter oneInputSaveAction" />

            <x-select-distance name="opened_dou_distance" class="distance distance_searchActionOpenedDow"/>

            @if (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionOpenedDowOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionOpenedDowOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchActionOpenedDowOp">{{ __('content.not_equal') }}</span>
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
    var currentInputNameAction;
    var currentInputIdAction;

    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        showHideDistance('fileSearch','distance_fileSearch');

        showHideDistance('searchActionContentMaterialsActions','distance_searchActionContentMaterialsActions');
        showHideDistance('searchActionSourceInformationActions','distance_searchActionSourceInformationActions');
        showHideDistance('searchActionOpenedDow','distance_searchActionOpenedDow');

        searchMultiSelectMaker( 'searchActionContentMaterialsActions' , 'material_content' );
        searchMultiSelectMaker( 'searchActionOpenedDow' , 'opened_dou' );
        searchMultiSelectMaker( 'searchActionSourceInformationActions' , 'source' );

        searchMultiSelectMakerAutoComplete( 'searchActionQualificationFact' , 'action_qualification_id' );
        searchMultiSelectMakerAutoComplete( 'searchActionDurationDAction' , 'duration_id' );
        searchMultiSelectMakerAutoComplete( 'searchActionPurposeMotiveReason' , 'goal_id' );
        searchMultiSelectMakerAutoComplete( 'searchActionTermsActions' , 'terms_id' );
        searchMultiSelectMakerAutoComplete( 'searchActionEnsuingEffects' , 'aftermath_id' );


        $('.oneInputSaveDateAction').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateAction').focusout(function(e){
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

        // $('#searchActionQualificationFact').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/action_qualification/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchActionQualificationFactId').val(dataItem.id);
        //     }
        // });


        // $('#searchActionDurationDAction').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/duration/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchActionDurationDActionId').val(dataItem.id);
        //     }
        // });

        // $('#searchActionPurposeMotiveReason').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/action_goal/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchActionPurposeMotiveReasonId').val(dataItem.id);
        //     }
        // });


        // $('#searchActionTermsActions').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/terms/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchActionTermsActionsId').val(dataItem.id);
        //     }
        // });


        // $('#searchActionEnsuingEffects').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/aftermath/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchActionEnsuingEffectsId').val(dataItem.id);
        //     }
        // });


        // $('.addMore').click(function(e){
        //     e.preventDefault();
        //     var url = $(this).attr('dataTableName');
        //     currentInputNameAction = $(this).attr('dataName');
        //     currentInputIdAction = $(this).attr('dataId');
        //     $.fancybox({
        //         'type'  : 'iframe',
        //         'autoSize': false,
        //         'width'             : 800,
        //         'height'            : 600,
        //         'href'              : `/${lang}/autocomplete/`+url+"&type=action"
        //     });
        // });

        // $('.addMoreSearch').click(function(e){
        //     e.preventDefault();
        //     var url = $(this).attr('dataTableName');
        //     currentInputNameAction = $(this).attr('dataName');
        //     currentInputIdAction = $(this).attr('dataId');
        //     $.fancybox({
        //         'type'  : 'iframe',
        //         'autoSize': false,
        //         'width'             : 800,
        //         'height'            : 600,
        //         'href'              : `/${lang}/autocomplete/`+url+"&type=action&value="+$('#'+currentInputNameAction).val()
        //     });
        // });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#action_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#action_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchActionContentMaterialsActions').val(`{{  html_entity_decode($search_params['material_content'][sizeof($search_params['material_content'])-1]) }}`);
            $('#searchActionQualificationFactId').val(`{{  $search_params['action_qualification_id'][sizeof($search_params['action_qualification_id'])-1] }}`);
            $('#searchActionQualificationFact').val(`{{  html_entity_decode($search_params['action_qualification']) }}`);
            $('#searchActionDurationDActionId').val(`{{  $search_params['duration_id'][sizeof($search_params['duration_id'])-1] }}`);
            $('#searchActionDurationDAction').val(`{{  html_entity_decode($search_params['duration_name']) }}`);
            $('#searchActionPurposeMotiveReasonId').val(`{{  $search_params['goal_id'][sizeof($search_params['goal_id'])-1] }}`);
            $('#searchActionPurposeMotiveReason').val(`{{  html_entity_decode($search_params['goal_name']) }}`);
            $('#searchActionTermsActionsId').val(`{{  $search_params['terms_id'][sizeof($search_params['terms_id'])-1] }}`);
            $('#searchActionTermsActions').val(`{{  html_entity_decode($search_params['terms_name']) }}`);
            $('#searchActionEnsuingEffectsId').val(`{{  $search_params['aftermath_id'][sizeof($search_params['aftermath_id'])-1] }}`);
            $('#searchActionEnsuingEffects').val(`{{  html_entity_decode($search_params['aftermath_name']) }}`);
            $('#searchActionSourceInformationActions').val(`{{  $search_params['source'][sizeof($search_params['source'])-1] }}`);
            $('#searchActionOpenedDow').val(`{{  html_entity_decode($search_params['opened_dou'][sizeof($search_params['opened_dou'])-1]) }}`);
            $('#searchActionEndActionDate').val(`{{  $search_params['end_date'] }}`);
            $('#searchActionStartActionDate').val(`{{  $search_params['start_date'] }}`);
            $('#fileSearch').val(`{{  html_entity_decode($search_params['content']) }}`);
        <?php } ?>

    });

    function closeFancyAction(name,id){
        //        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameAction).val(name);
        $('#'+currentInputIdAction).val(id);
        var field = $('#'+currentInputIdAction).attr('name');

        $.fancybox.close();
    }

</script>

@endsection
@endsection

