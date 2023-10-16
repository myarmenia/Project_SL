@extends('layouts.include-app')

@section('content-include')

<a class="closeButton" ></a>
<div class="inContent">
    <form id="criminalCaseForm" action="/{{ app()->getLocale() }}/simplesearch/result_criminal_case" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="criminal_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="criminal_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['number'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCriminalNumberCaseFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['number'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCriminalNumberCase">
                    <div class="item">
                        <span><?php echo $search_params['number'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="number[]" value="<?php echo $search_params['number'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="number_type" id="searchCriminalNumberCaseType" value="<?php echo $search_params['number_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCriminalNumberCase">{{ __('content.number_case') }}</label>
            <input type="text" name="number[]" id="searchCriminalNumberCase" onkeydown="validateNumber(event ,'searchCriminalNumberCase',20)" class="oneInputSaveEnter oneInputSaveCriminalCase"  />
            <?php if (isset($search_params['number_type']) && $search_params['number_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalNumberCaseOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['number_type']) && $search_params['number_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalNumberCaseOp">{{ __('content.and') }}</span>
            <?php } ?>
        </div>

        <div class="forForm">
            <label for="searchCriminalCriminalProceedingsDate">{{ __('content.criminal_proceedings_date') }}</label>
            <input type="text" name="opened_date" id="searchCriminalCriminalProceedingsDate" style="width: 505px;" onkeydown="validateNumber(event ,'searchCriminalCriminalProceedingsDate',12)" class="oneInputSaveEnter oneInputSaveDateCriminalCase" />
        </div>

        <?php if (isset($search_params) && isset($search_params['artical'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCriminalCriminalCodeFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['artical'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCriminalCriminalCode">
                    <div class="item">
                        <span><?php echo $search_params['artical'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="artical[]" value="<?php echo $search_params['artical'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="artical_type" id="searchCriminalCriminalCodeType" value="<?php echo $search_params['artical_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCriminalCriminalCode">{{ __('content.criminal_code') }}</label>
            <input type="text" name="artical[]" id="searchCriminalCriminalCode" class="oneInputSaveEnter oneInputSaveCriminalCase"  />
            <?php if (isset($search_params['artical_type']) && $search_params['artical_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalCriminalCodeOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['artical_type']) && $search_params['artical_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalCriminalCodeOp">{{ __('content.and') }}</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['opened_unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCriminalMaterialsManagementFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['opened_unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCriminalMaterialsManagement">
                    <div class="item">
                        <span><?php echo $search_params['opened_unit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="opened_unit_id[]" value="<?php echo $search_params['opened_unit_id'][$i] ?>">
                    <input type="hidden" name="opened_unit_idName[]" value="<?php echo $search_params['opened_unit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="opened_unit_id_type" id="searchCriminalMaterialsManagementType" value="<?php echo $search_params['opened_unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCriminalMaterialsManagement">{{ __('content.head_department') }}</label>
            <input type="button" dataName="searchCriminalMaterialsManagement" dataId="searchCriminalMaterialsManagementId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="opened_unit" id="searchCriminalMaterialsManagement" dataInputId="searchCriminalMaterialsManagementId" dataTableName="agency" class="oneInputSaveEnter" />
            <?php if (isset($search_params['opened_unit_id_type']) && $search_params['opened_unit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalMaterialsManagementOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['opened_unit_id_type']) && $search_params['opened_unit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalMaterialsManagementOp">{{ __('content.and') }}</span>
            <?php } ?>
            <input type="hidden" name="opened_unit_id[]" id="searchCriminalMaterialsManagementId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['opened_agency_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCriminalHeadDepartmentFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['opened_agency_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCriminalHeadDepartment">
                    <div class="item">
                        <span><?php echo $search_params['opened_agency_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="opened_agency_id[]" value="<?php echo $search_params['opened_agency_id'][$i] ?>">
                    <input type="hidden" name="opened_agency_idName[]" value="<?php echo $search_params['opened_agency_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="opened_agency_id_type" id="searchCriminalHeadDepartmentType" value="<?php echo $search_params['opened_agency_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCriminalHeadDepartment">{{ __('content.materials_management') }}</label>
            <input type="button" dataName="searchCriminalHeadDepartment" dataId="searchCriminalHeadDepartmentId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="opened_agency" id="searchCriminalHeadDepartment" dataInputId="searchCriminalHeadDepartmentId" dataTableName="agency" class="oneInputSaveEnter" />
            <?php if (isset($search_params['opened_agency_id_type']) && $search_params['opened_agency_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalHeadDepartmentOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['opened_agency_id_type']) && $search_params['opened_agency_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalHeadDepartmentOp">{{ __('content.and') }}</span>
            <?php } ?>
            <input type="hidden" name="opened_agency_id[]" id="searchCriminalHeadDepartmentId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['subunit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCriminalInstitutedUnitsFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['subunit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCriminalInstitutedUnits">
                    <div class="item">
                        <span><?php echo $search_params['subunit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="subunit_id[]" value="<?php echo $search_params['subunit_id'][$i] ?>">
                    <input type="hidden" name="subunit_idName[]" value="<?php echo $search_params['subunit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="subunit_id_type" id="searchCriminalInstitutedUnitsType" value="<?php echo $search_params['subunit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCriminalInstitutedUnits">{{ __('content.instituted_units') }}</label>
            <input type="button" dataName="searchCriminalInstitutedUnits" dataId="searchCriminalInstitutedUnitsId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="subunit" id="searchCriminalInstitutedUnits" dataInputId="searchCriminalInstitutedUnitsId" dataTableName="agency" class="oneInputSaveEnter"  />
            <?php if (isset($search_params['subunit_id_type']) && $search_params['subunit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalInstitutedUnitsOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['subunit_id_type']) && $search_params['subunit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalInstitutedUnitsOp">{{ __('content.and') }}</span>
            <?php } ?>
            <input type="hidden" name="subunit_id[]" id="searchCriminalInstitutedUnitsId"  />
        </div>

        <?php if (isset($search_params) && isset($search_params['worker'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCriminalWorkerFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['worker'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCriminalWorker">
                    <div class="item">
                        <span><?php echo $search_params['worker'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="worker[]" value="<?php echo $search_params['worker'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="worker_type" id="searchCriminalWorkerType" value="<?php echo $search_params['worker_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCriminalWorker">{{ __('content.name_operatives') }}</label>
            <input type="text" name="worker[]" id="searchCriminalWorker"  class="oneInputSaveEnter oneInputSaveCriminalCase"/>
            <?php if (isset($search_params['worker_type']) && $search_params['worker_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalWorkerOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['worker_type']) && $search_params['worker_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalWorkerOp">{{ __('content.and') }}</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['worker_post_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="criminalWorkerPostFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['worker_post_id'])-1 ; $i++ ) { ?>
                <li id="listItemcriminalWorkerPost">
                    <div class="item">
                        <span><?php echo $search_params['worker_post_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="worker_post_id[]" value="<?php echo $search_params['worker_post_id'][$i] ?>">
                    <input type="hidden" name="worker_post_idName[]" value="<?php echo $search_params['worker_post_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="worker_post_id_type" id="criminalWorkerPostType" value="<?php echo $search_params['worker_post_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for=" criminalWorkerPost">{{ __('content.worker_post') }}</label>
            <input type="button" dataName="criminalWorkerPost" dataId="criminalWorkerPostId" dataTableName="fancy/worker_post" class="addMore k-icon k-i-plus"   />
            <input type="text" name="worker_post" id="criminalWorkerPost" dataInputId="criminalWorkerPostId" dataTableName="worker_post" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['worker_post_id_type']) && $search_params['worker_post_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="criminalWorkerPostOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['worker_post_id_type']) && $search_params['worker_post_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="criminalWorkerPostOp">{{ __('content.and') }}</span>
            <?php } ?>
            <input type="hidden" name="worker_post_id[]" id="criminalWorkerPostId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['character'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCriminalNatureMaterialsPaintFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['character'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCriminalNatureMaterialsPaint">
                    <div class="item">
                        <span><?php echo $search_params['character'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="character[]" value="<?php echo $search_params['character'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="character_type" id="searchCriminalNatureMaterialsPaintType" value="<?php echo $search_params['character_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCriminalNatureMaterialsPaint">{{ __('content.nature_materials_paint') }}</label>
            <input type="text" name="character[]" id="searchCriminalNatureMaterialsPaint" class="oneInputSaveEnter oneInputSaveCriminalCase"  />
            <?php if (isset($search_params['character_type']) && $search_params['character_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalNatureMaterialsPaintOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['character_type']) && $search_params['character_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalNatureMaterialsPaintOp">{{ __('content.and') }}</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['opened_dou'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCriminalInitiatedDowFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['opened_dou'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCriminalInitiatedDow">
                    <div class="item">
                        <span><?php echo $search_params['opened_dou'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="opened_dou[]" value="<?php echo $search_params['opened_dou'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="opened_dou_type" id="searchCriminalInitiatedDowType" value="<?php echo $search_params['opened_dou_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCriminalInitiatedDow">{{ __('content.initiated_dow') }}</label>
            <input type="text" name="opened_dou[]" id="searchCriminalInitiatedDow" class="oneInputSaveEnter oneInputSaveCriminalCase" />
            <?php if (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalInitiatedDowOp">{{ __('content.or') }}</span>
            <?php } else if (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCriminalInitiatedDowOp">{{ __('content.and') }}</span>
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
    var currentInputNameCriminal;
    var currentInputIdCriminal;
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMaker( 'searchCriminalNumberCase' , 'number' );
        searchMultiSelectMaker( 'searchCriminalCriminalCode' , 'artical' );
        searchMultiSelectMaker( 'searchCriminalNatureMaterialsPaint' , 'character' );
        searchMultiSelectMaker( 'searchCriminalInitiatedDow' , 'opened_dou' );
        searchMultiSelectMaker( 'searchCriminalWorker' , 'worker' );

        searchMultiSelectMakerAutoComplete( 'searchCriminalMaterialsManagement' , 'opened_unit_id' );
        searchMultiSelectMakerAutoComplete( 'searchCriminalHeadDepartment' , 'opened_agency_id' );
        searchMultiSelectMakerAutoComplete( 'searchCriminalInstitutedUnits' , 'subunit_id' );
        searchMultiSelectMakerAutoComplete( 'criminalWorkerPost' , 'worker_post_id' );

        $('.oneInputSaveDateCriminalCase').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });


        $('.oneInputSaveDateCriminalCase').focusout(function(e){
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
                            alert('{{ __('content.enter_number') }}');
                        }
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        if( c!= 'resetButton'){
                            alert('{{ __('content.enter_number') }}');
                        }
                    }else{
                    }
                }
            }
        });

        $('.oneInputSaveCriminalCase').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
            }
        });

        $('#criminalWorkerPost').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: `/${lang}/dictionary/worker_post/read`
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#criminalWorkerPostId').val(dataItem.id);
            }
        });

        $('#searchCriminalMaterialsManagement').kendoAutoComplete({
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
                $('#searchCriminalMaterialsManagementId').val(dataItem.id);
            }
        });
        $('#searchCriminalMaterialsManagement').focusout(function(e){
            e.preventDefault();
            var text = $('#searchCriminalMaterialsManagement').val();
            var value = $('#searchCriminalMaterialsManagementId').val();
            var field = $('#searchCriminalMaterialsManagementId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    alert(`{{ __('content.enter_agency') }}`);
                }else{
                }
            }
        });

        $('#searchCriminalHeadDepartment').kendoAutoComplete({
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
                $('#searchCriminalHeadDepartmentId').val(dataItem.id);
            }
        });
        $('#searchCriminalHeadDepartment').focusout(function(e){
            e.preventDefault();
            var text = $('#searchCriminalHeadDepartment').val();
            var value = $('#searchCriminalHeadDepartmentId').val();
            var field = $('#searchCriminalHeadDepartmentId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    alert(`{{ __('content.enter_agency') }}`);
                }else{
                }
            }
        });

        $('#searchCriminalInstitutedUnits').kendoAutoComplete({
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
                $('#searchCriminalInstitutedUnitsId').val(dataItem.id);
            }
        });
        $('#searchCriminalInstitutedUnits').focusout(function(e){
            e.preventDefault();
            var text = $('#searchCriminalInstitutedUnits').val();
            var value = $('#searchCriminalInstitutedUnitsId').val();
            var field = $('#searchCriminalInstitutedUnitsId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    alert(`{{ __('content.enter_agency') }}`);
                }else{
                }
            }
        });

        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameCriminal = $(this).attr('dataName');
            currentInputIdCriminal = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : `/${lang}/autocomplete/`+url+"&type=criminal"
            });
        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#criminal_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#criminal_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchCriminalNumberCase').val(`{{ html_entity_decode($search_params['number'][sizeof($search_params['number'])-1]) }}`);
            $('#searchCriminalCriminalProceedingsDate').val(`{{ $search_params['opened_date'] }}`);
            $('#searchCriminalCriminalCode').val(`{{ html_entity_decode($search_params['artical'][sizeof($search_params['artical'])-1]) }}`);
            $('#searchCriminalMaterialsManagementId').val(`{{ $search_params['opened_unit_id'][sizeof($search_params['opened_unit_id'])-1] }}`);
            $('#searchCriminalMaterialsManagement').val(`{{ html_entity_decode($search_params['opened_unit']) }}`);
            $('#searchCriminalHeadDepartmentId').val(`{{ $search_params['opened_agency_id'][sizeof($search_params['opened_agency_id'])-1] }}`);
            $('#searchCriminalHeadDepartment').val(`{{ html_entity_decode($search_params['opened_agency']) }}`);
            $('#searchCriminalInstitutedUnitsId').val(`{{ $search_params['subunit_id'][sizeof($search_params['subunit_id'])-1] }}`);
            $('#searchCriminalInstitutedUnits').val(`{{ html_entity_decode($search_params['subunit']) }}`);
            $('#searchCriminalWorker').val(`{{ html_entity_decode($search_params['worker'][sizeof($search_params['worker'])-1]) }}`);
            $('#criminalWorkerPostId').val(`{{ $search_params['worker_post_id'][sizeof($search_params['worker_post_id'])-1] }}`);
            $('#criminalWorkerPost').val(`{{ html_entity_decode($search_params['worker_post']) }}`);
            $('#searchCriminalNatureMaterialsPaint').val(`{{ html_entity_decode($search_params['character'][sizeof($search_params['character'])-1]) }}`);
            $('#searchCriminalInitiatedDow').val(`{{ html_entity_decode($search_params['opened_dou'][sizeof($search_params['opened_dou'])-1]) }}`);
            $('#fileSearch').val(`{{ html_entity_decode($search_params['content']) }}`);
        <?php } ?>
    });


    function closeCriminalCase(name,id){
        $('#'+currentInputNameCriminal).val(name);
        $('#'+currentInputIdCriminal).val(id);
        var field = $('#'+currentInputIdCriminal).attr('name');

        $.fancybox.close();
    }

</script>

@endsection
@endsection

