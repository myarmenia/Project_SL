@extends('layouts.include-app')

@section('content-include')

<a class="closeButton"></a>
<div class="inContent">

    <form id="eventForm" action="/{{ app()->getLocale() }}/simplesearch/result_event" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="event_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="event_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['qualification_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchEventQualificationEventFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['qualification_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchEventQualificationEvent">
                    <div class="item">
                        <span><?php echo $search_params['qualification_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="qualification_id[]" value="<?php echo $search_params['qualification_id'][$i] ?>">
                    <input type="hidden" name="qualification_idName[]" value="<?php echo $search_params['qualification_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="qualification_id_type" id="searchEventQualificationEventType" value="<?php echo $search_params['qualification_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm" >
            <label for="searchEventQualificationEvent">{{ __('content.qualification_event') }}</label>
            <input type="button" dataName="searchEventQualificationEvent" dataId="searchEventQualificationEventId" dataTableName="fancySearch/event_qualification" class="addMoreSearch k-icon k-i-search"   />
            <input type="button" dataName="searchEventQualificationEvent" dataId="searchEventQualificationEventId" dataTableName="fancy/event_qualification" class="addMore k-icon k-i-plus"   />
            <input type="text" name="qualification_name" id="searchEventQualificationEvent" dataInputId="searchEventQualificationEventId" dataTableName="event_qualification" class="oneInputSaveEnter" />
            <?php if (isset($search_params['qualification_id_type']) && $search_params['qualification_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEventQualificationEventOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['qualification_id_type']) && $search_params['qualification_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEventQualificationEventOp">{{ __('content.and') }}</span>
            <?php } ?>
            <input type="hidden" name="qualification_id[]" id="searchEventQualificationEventId" />
        </div>

        <div class="forForm">
            <label for="searchEventDateSecurityDate">{{ __('content.date_security_date') }}</label>
            <input type="text" name="date" id="searchEventDateSecurityDate" style="width: 505px;" class="oneInputSaveEnter oneInputSaveDateEvent" />
        </div>

        <?php if (isset($search_params) && isset($search_params['aftermath_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchEventEnsuingEffectsFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['aftermath_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchEventEnsuingEffects">
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
            <input type="hidden" name="aftermath_id_type" id="searchEventEnsuingEffectsType" value="<?php echo $search_params['aftermath_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchEventEnsuingEffects">{{ __('content.ensuing_effects') }}</label>
            <input type="button" dataName="searchEventEnsuingEffects" dataId="searchEventEnsuingEffectsId" dataTableName="fancySearch/aftermath" class="addMoreSearch k-icon k-i-search"   />
            <input type="button" dataName="searchEventEnsuingEffects" dataId="searchEventEnsuingEffectsId" dataTableName="fancy/aftermath" class="addMore k-icon k-i-plus"   />
            <input type="text" name="aftermath_name" id="searchEventEnsuingEffects" dataInputId="searchEventEnsuingEffectsId" dataTableName="aftermath" class="oneInputSaveEnter"  />
            <?php if (isset($search_params['aftermath_id_type']) && $search_params['aftermath_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEventEnsuingEffectsOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['aftermath_id_type']) && $search_params['aftermath_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEventEnsuingEffectsOp">{{ __('content.and') }}</span>
            <?php } ?>
            <input type="hidden" name="aftermath_id[]" id="searchEventEnsuingEffectsId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['agency_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchEventInvestigationRequestedFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['agency_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchEventInvestigationRequested">
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
            <input type="hidden" name="agency_id_type" id="searchEventInvestigationRequestedType" value="<?php echo $search_params['agency_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchEventInvestigationRequested">{{ __('content.investigation_requested') }}</label>
            <input type="button" dataName="searchEventInvestigationRequested" dataId="searchEventInvestigationRequestedId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="agency" id="searchEventInvestigationRequested" dataInputId="searchEventInvestigationRequestedId" dataTableName="agency" class="oneInputSaveEnter" />
            <?php if (isset($search_params['agency_id_type']) && $search_params['agency_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEventInvestigationRequestedOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['agency_id_type']) && $search_params['agency_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEventInvestigationRequestedOp">{{ __('content.and') }}</span>
            <?php } ?>
            <input type="hidden" name="agency_id[]" id="searchEventInvestigationRequestedId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['result'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchEventResultsEventFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['result'])-1 ; $i++ ) { ?>
                <li id="listItemsearchEventResultsEvent">
                    <div class="item">
                        <span><?php echo $search_params['result'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="result[]" value="<?php echo $search_params['result'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="result_type" id="searchEventResultsEventType" value="<?php echo $search_params['result_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchEventResultsEvent">{{ __('content.results_event') }}</label>
            <input type="text" name="result[]" id="searchEventResultsEvent" class="oneInputSaveEnter" />
            <?php if (isset($search_params['result_type']) && $search_params['result_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEventResultsEventOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['result_type']) && $search_params['result_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEventResultsEventOp">{{ __('content.and') }}</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['resource_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchEventSourceEventFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['resource_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchEventSourceEvent">
                    <div class="item">
                        <span><?php echo $search_params['resource_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="resource_id[]" value="<?php echo $search_params['resource_id'][$i] ?>">
                    <input type="hidden" name="resource_idName[]" value="<?php echo $search_params['resource_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="resource_id_type" id="searchEventSourceEventType" value="<?php echo $search_params['resource_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchEventSourceEvent">{{ __('content.source_event') }}</label>
            <input type="button" dataName="searchEventSourceEvent" dataId="searchEventSourceEventId" dataTableName="fancy/resource" class="addMore k-icon k-i-plus"   />
            <input type="text" name="resource_name" id="searchEventSourceEvent" dataInputId="searchEventSourceEventId" dataTableName="resource" class="oneInputSaveEnter" />
            <?php if (isset($search_params['resource_id_type']) && $search_params['resource_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEventSourceEventOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['resource_id_type']) && $search_params['resource_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEventSourceEventOp">{{ __('content.and') }}</span>
            <?php } ?>
            <input type="hidden" name="resource_id[]" id="searchEventSourceEventId" />
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
    var currentInputNameEvent;
    var currentInputIdEvent;
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMaker( 'searchEventResultsEvent' , 'result' );

        searchMultiSelectMakerAutoComplete( 'searchEventQualificationEvent' , 'qualification_id' );
        searchMultiSelectMakerAutoComplete( 'searchEventEnsuingEffects' , 'aftermath_id' );
        searchMultiSelectMakerAutoComplete( 'searchEventInvestigationRequested' , 'agency_id' );
        searchMultiSelectMakerAutoComplete( 'searchEventSourceEvent' , 'resource_id' );

        $('#searchEventQualificationEvent').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: `/${lang}/dictionary/event_qualification/read`
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchEventQualificationEventId').val(dataItem.id);
            }
        });


        $('#searchEventEnsuingEffects').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: `/${lang}/dictionary/aftermath/read`
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchEventEnsuingEffectsId').val(dataItem.id);
            }
        });


        $('#searchEventInvestigationRequested').kendoAutoComplete({
            dataTextField: "name",
            filter: "contains",
            minLength: 3,
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: `/${lang}/dictionary/agency/read`
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchEventInvestigationRequestedId').val(dataItem.id);
            }
        });


        $('#searchEventSourceEvent').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: `/${lang}/dictionary/resource/read`
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchEventSourceEventId').val(dataItem.id);
            }
        });


        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameEvent = $(this).attr('dataName');
            currentInputIdEvent = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : `/${lang}/autocomplete/`+url+"&type=event"
            });
        });

        $('.addMoreSearch').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameEvent = $(this).attr('dataName');
            currentInputIdEvent = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : `/${lang}/autocomplete/`+url+"&type=event&value="+$('#'+currentInputNameEvent).val()
            });
        });

        $('.oneInputSaveDateEvent').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateEvent').focusout(function(e){
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

        $('#event_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#event_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });


        <?php if (isset($search_params)) { ?>
            $('#searchEventQualificationEventId').val("<?php echo $search_params['qualification_id'][sizeof($search_params['qualification_id'])-1] ?>");
            $('#searchEventQualificationEvent').val("<?php echo html_entity_decode($search_params['qualification_name']) ?>");
            $('#searchEventSourceEventId').val("<?php echo $search_params['resource_id'][sizeof($search_params['resource_id'])-1] ?>");
            $('#searchEventSourceEvent').val("<?php echo html_entity_decode($search_params['resource_name']) ?>");
            $('#searchEventResultsEvent').val("<?php echo html_entity_decode($search_params['result'][sizeof($search_params['result'])-1]) ?>");
            $('#searchEventInvestigationRequestedId').val("<?php echo $search_params['agency_id'][sizeof($search_params['agency_id'])-1] ?>");
            $('#searchEventInvestigationRequested').val("<?php echo html_entity_decode($search_params['agency']) ?>");
            $('#searchEventEnsuingEffectsId').val("<?php echo $search_params['aftermath_id'][sizeof($search_params['aftermath_id'])-1] ?>");
            $('#searchEventEnsuingEffects').val("<?php echo html_entity_decode($search_params['aftermath_name']) ?>");
            $('#searchEventDateSecurityDate').val("<?php echo $search_params['date'] ?>");
            $('#fileSearch').val("<?php echo html_entity_decode($search_params['content']) ?>");
        <?php } ?>

    });
    function closeEvent(name,id){
        $('#'+currentInputNameEvent).val(name);
        $('#'+currentInputIdEvent).val(id);
        var field = $('#'+currentInputIdEvent).attr('name');

        $.fancybox.close();
    }

</script>

@endsection
@endsection

