<a class="closeButton"></a>
<div class="inContent">
    <form id="controlForm" action="<?php echo ROOT;?>simplesearch/result_control" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="<?php echo $Lang->and; ?>" id="control_and" />
            <input type="button" class="k-button" value="<?php echo $Lang->or; ?>" id="control_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
            <input type="submit" class="k-button" name="submit" value="<?php echo $Lang->search;?>" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlUnitFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlUnit">
                    <div class="item">
                        <span><?php echo $search_params['unit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="unit_id[]" value="<?php echo $search_params['unit_id'][$i] ?>">
                    <input type="hidden" name="unit_idName[]" value="<?php echo $search_params['unit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="unit_id_type" id="searchControlUnitType" value="<?php echo $search_params['unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlUnit"><?php echo $Lang->unit;?></label>
            <input type="button" dataName="searchControlUnit" dataId="searchControlUnitId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" firstItem="1" name="unit_name" id="searchControlUnit" class="oneInputSaveEnter" dataTableName="agency" dataInputId="searchControlUnitId" />
            <?php if (isset($search_params['unit_id_type']) && $search_params['unit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlUnitOp">ИЛИ</span>
            <?php } else if (isset($search_params['unit_id_type']) && $search_params['unit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlUnitOp">И</span>
            <?php } ?>
            <input type="hidden" name="unit_id[]" id="searchControlUnitId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['doc_category_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlDocCategoryFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['doc_category_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlDocCategory">
                    <div class="item">
                        <span><?php echo $search_params['doc_category_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="doc_category_id[]" value="<?php echo $search_params['doc_category_id'][$i] ?>">
                    <input type="hidden" name="doc_category_idName[]" value="<?php echo $search_params['doc_category_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="doc_category_id_type" id="searchControlDocCategoryType" value="<?php echo $search_params['doc_category_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlDocCategory"><?php echo $Lang->document_category;?></label>
            <input type="button" dataName="searchControlDocCategory" dataId="searchControlDocCategoryId" dataTableName="fancy/doc_category" class="addMore k-icon k-i-plus"   />
            <input type="text" name="category_title" id="searchControlDocCategory" class="oneInputSaveEnter" dataTableName="doc_category" dataInputId="searchControlDocCategoryId" />
            <?php if (isset($search_params['doc_category_id_type']) && $search_params['doc_category_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlDocCategoryOp">ИЛИ</span>
            <?php } else if (isset($search_params['doc_category_id_type']) && $search_params['doc_category_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlDocCategoryOp">И</span>
            <?php } ?>
            <input type="hidden" name="doc_category_id[]" id="searchControlDocCategoryId" />
        </div>

        <div class="forForm">
            <label for="searchControlCreationDate"><?php echo $Lang->document_date;?></label>
            <input type="text" name="creation_date" onkeydown="validateNumber(event ,'searchControlCreationDate',12)" id="searchControlCreationDate" style="width: 505px;" class="datePicker oneInputSaveEnter"/>
        </div>

        <?php if (isset($search_params) && isset($search_params['reg_num'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlRegNumFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['reg_num'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlRegNum">
                    <div class="item">
                        <span><?php echo $search_params['reg_num'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="reg_num[]" value="<?php echo $search_params['reg_num'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="reg_num_type" id="searchControlRegNumType" value="<?php echo $search_params['reg_num_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlRegNum"><?php echo $Lang->reg_document;?></label>
            <input type="text" name="reg_num[]" id="searchControlRegNum" class="oneInputSave oneInputSaveEnter"  />
            <?php if (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlRegNumOp">ИЛИ</span>
            <?php } else if (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlRegNumOp">И</span>
            <?php } ?>
        </div>

        <div class="forForm">
            <label for="searchControlRegDate"><?php echo $Lang->date_reg;?></label>
            <input type="text" name="reg_date" id="searchControlRegDate" onkeydown="validateNumber(event ,'searchControlRegDate',12)" style="width: 505px;" class="datePicker oneInputSaveEnter" />
        </div>

        <?php if (isset($search_params) && isset($search_params['snb_director'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlSnbDirectorFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['snb_director'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlSnbDirector">
                    <div class="item">
                        <span><?php echo $search_params['snb_director'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="snb_director[]" value="<?php echo $search_params['snb_director'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="snb_director_type" id="searchControlSnbDirectorType" value="<?php echo $search_params['snb_director_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlSnbDirector"><?php echo $Lang->director;?></label>
            <input type="text" name="snb_director[]" id="searchControlSnbDirector" class="oneInputSave oneInputSaveEnter" />
            <?php if (isset($search_params['snb_director_type']) && $search_params['snb_director_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSnbDirectorOp">ИЛИ</span>
            <?php } else if (isset($search_params['snb_director_type']) && $search_params['snb_director_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSnbDirectorOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['snb_subdirector'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlSnbSubDirectorFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['snb_subdirector'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlSnbSubDirector">
                    <div class="item">
                        <span><?php echo $search_params['snb_subdirector'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="snb_subdirector[]" value="<?php echo $search_params['snb_subdirector'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="snb_subdirector_type" id="searchControlSnbSubDirectorType" value="<?php echo $search_params['snb_subdirector_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlSnbSubDirector"><?php echo $Lang->deputy_director;?></label>
            <input type="text" name="snb_subdirector[]" id="searchControlSnbSubDirector" class="oneInputSave oneInputSaveEnter" />
            <?php if (isset($search_params['snb_subdirector_type']) && $search_params['snb_subdirector_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSnbSubDirectorOp">ИЛИ</span>
            <?php } else if (isset($search_params['snb_subdirector_type']) && $search_params['snb_subdirector_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSnbSubDirectorOp">И</span>
            <?php } ?>
        </div>

        <div class="forForm">
            <label for="searchControlResolutionDate"><?php echo $Lang->date_resolution;?></label>
            <input type="text" name="resolution_date" id="searchControlResolutionDate" onkeydown="validateNumber(event ,'searchControlResolutionDate',12)" style="width: 505px;" class="datePicker oneInputSaveEnter" />
        </div>

        <?php if (isset($search_params) && isset($search_params['resolution'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlResolutionFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['resolution'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlResolution">
                    <div class="item">
                        <span><?php echo $search_params['resolution'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="resolution[]" value="<?php echo $search_params['resolution'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="resolution_type" id="searchControlResolutionType" value="<?php echo $search_params['resolution_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlResolution"><?php echo $Lang->resolution;?></label>
            <input type="text" name="resolution[]" id="searchControlResolution" class="oneInputSaveEnter" >
            <?php if (isset($search_params['resolution_type']) && $search_params['resolution_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlResolutionOp">ИЛИ</span>
            <?php } else if (isset($search_params['resolution_type']) && $search_params['resolution_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlResolutionOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['act_unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlActUnitFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['act_unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlActUnit">
                    <div class="item">
                        <span><?php echo $search_params['act_unit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="act_unit_id[]" value="<?php echo $search_params['act_unit_id'][$i] ?>">
                    <input type="hidden" name="act_unit_idName[]" value="<?php echo $search_params['act_unit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="act_unit_id_type" id="searchControlActUnitType" value="<?php echo $search_params['act_unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlActUnit"><?php echo $Lang->department_performer;?></label>
            <input type="button" dataName="searchControlActUnit" dataId="searchControlActUnitId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="act_unit_name" id="searchControlActUnit" class="oneInputSaveEnter" dataTableName="agency" dataInputId="searchControlActUnitId" />
            <?php if (isset($search_params['act_unit_id_type']) && $search_params['act_unit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlActUnitOp">ИЛИ</span>
            <?php } else if (isset($search_params['act_unit_id_type']) && $search_params['act_unit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlActUnitOp">И</span>
            <?php } ?>
            <input type="hidden" name="act_unit_id[]" id="searchControlActUnitId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['actor_name'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlActorNameFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['actor_name'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlActorName">
                    <div class="item">
                        <span><?php echo $search_params['actor_name'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="actor_name[]" value="<?php echo $search_params['actor_name'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="actor_name_type" id="searchControlActorNameType" value="<?php echo $search_params['actor_name_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlActorName"><?php echo $Lang->actor_name;?></label>
            <input type="text"  name="actor_name[]" id="searchControlActorName" class="oneInputSave oneInputSaveEnter" />
            <?php if (isset($search_params['actor_name_type']) && $search_params['actor_name_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlActorNameOp">ИЛИ</span>
            <?php } else if (isset($search_params['actor_name_type']) && $search_params['actor_name_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlActorNameOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['sub_act_unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlSubActUnitFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['sub_act_unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlSubActUnit">
                    <div class="item">
                        <span><?php echo $search_params['sub_act_unit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="sub_act_unit_id[]" value="<?php echo $search_params['sub_act_unit_id'][$i] ?>">
                    <input type="hidden" name="sub_act_unit_idName[]" value="<?php echo $search_params['sub_act_unit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="sub_act_unit_id_type" id="searchControlSubActUnitType" value="<?php echo $search_params['sub_act_unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlSubActUnit"><?php echo $Lang->department_coauthors;?></label>
            <input type="button" dataName="searchControlSubActUnit" dataId="searchControlSubActUnitId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="sub_act_unit_name" id="searchControlSubActUnit" class="oneInputSaveEnter" dataTableName="agency" dataInputId="searchControlSubActUnitId" />
            <?php if (isset($search_params['sub_act_unit_id_type']) && $search_params['sub_act_unit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSubActUnitOp">ИЛИ</span>
            <?php } else if (isset($search_params['sub_act_unit_id_type']) && $search_params['sub_act_unit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSubActUnitOp">И</span>
            <?php } ?>
            <input type="hidden" name="sub_act_unit_id[]" id="searchControlSubActUnitId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['sub_actor_name'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="controlSubActorNameFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['sub_actor_name'])-1 ; $i++ ) { ?>
                <li id="listItemcontrolSubActorName">
                    <div class="item">
                        <span><?php echo $search_params['sub_actor_name'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="sub_actor_name[]" value="<?php echo $search_params['sub_actor_name'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="sub_actor_name_type" id="controlSubActorNameType" value="<?php echo $search_params['sub_actor_name_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="controlSubActorName"><?php echo $Lang->actor_name;?></label>
            <input type="text"  name="sub_actor_name[]" id="controlSubActorName" class="oneInputSaveEnter" />
            <?php if (isset($search_params['sub_actor_name_type']) && $search_params['sub_actor_name_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="controlSubActorNameOp">ИЛИ</span>
            <?php } else if (isset($search_params['sub_actor_name_type']) && $search_params['sub_actor_name_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="controlSubActorNameOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['result_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlResultFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['result_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlResult">
                    <div class="item">
                        <span><?php echo $search_params['result_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="result_id[]" value="<?php echo $search_params['result_id'][$i] ?>">
                    <input type="hidden" name="result_idName[]" value="<?php echo $search_params['result_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="result_id_type" id="searchControlResultType" value="<?php echo $search_params['result_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlResult"><?php echo $Lang->result_execution;?></label>
            <input type="button" dataName="searchControlResult" dataId="searchControlResultId" dataTableName="fancy/control_result" class="addMore k-icon k-i-plus"    />
            <input type="text" name="result_name" id="searchControlResult" class="oneInputSaveEnter" dataTableName="control_result" dataInputId="searchControlResultId"   lastItem="1" />
            <?php if (isset($search_params['result_id_type']) && $search_params['result_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlResultOp">ИЛИ</span>
            <?php } else if (isset($search_params['result_id_type']) && $search_params['result_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlResultOp">И</span>
            <?php } ?>
            <input type="hidden" name="result_id[]" id="searchControlResultId" />
        </div>

        <div class="forForm">
            <label for="fileSearch"><?php echo $Lang->file_search; ?></label>
            <input type="text" name="content" id="fileSearch"/>
        </div>

        <div class="buttons">

        </div>
    </form>

</div>

<script>
    var currentInputNameControl;
    var currentInputIdControl;
    var searchInput;


    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMaker( 'searchControlRegNum' , 'reg_num' );
        searchMultiSelectMaker( 'searchControlSnbDirector' , 'snb_director' );
        searchMultiSelectMaker( 'searchControlSnbSubDirector' , 'snb_subdirector' );
        searchMultiSelectMaker( 'searchControlResolution' , 'resolution' );
        searchMultiSelectMaker( 'searchControlActorName' , 'actor_name' );
        searchMultiSelectMaker( 'controlSubActorName' , 'sub_actor_name' );

        searchMultiSelectMakerAutoComplete( 'searchControlUnit' , 'unit_id' );
        searchMultiSelectMakerAutoComplete( 'searchControlDocCategory' , 'doc_category_id' );
        searchMultiSelectMakerAutoComplete( 'searchControlActUnit' , 'act_unit_id' );
        searchMultiSelectMakerAutoComplete( 'searchControlSubActUnit' , 'sub_act_unit_id' );
        searchMultiSelectMakerAutoComplete( 'searchControlResult' , 'result_id' );

        $('.datePicker').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('#searchControlUnit').kendoAutoComplete({
            dataTextField: "name",
            filter: "contains",
            minLength: 3,
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/agency/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchControlUnitId').val(dataItem.id);
            }
        });

        $('#searchControlActUnit').kendoAutoComplete({
            dataTextField: "name",
            filter: "contains",
            minLength: 3,
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/agency/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchControlActUnitId').val(dataItem.id);
            }
        });

        $('#searchControlSubActUnit').kendoAutoComplete({
            dataTextField: "name",
            filter: "contains",
            minLength: 3,
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/agency/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchControlSubActUnitId').val(dataItem.id);
            }
        });


        $('#searchControlDocCategory').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/doc_category/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchControlDocCategoryId').val(dataItem.id);
            }
        });

        $('#searchControlResult').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/control_result/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchControlResultId').val(dataItem.id);
            }
        });

        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameControl = $(this).attr('dataName');
            currentInputIdControl = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=control"
            });
        });

        $('.eventTrigger').focusin(function(e){
            $('#searchControlResolution').focus();
        });

        $('.datePicker').focusout(function(e){
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
                            alert('<?php echo $Lang->enter_number;?>');
                        }
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        if( c!= 'resetButton'){
                            alert('<?php echo $Lang->enter_number;?>');
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

        $('#control_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#control_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchControlUnitId').val("<?php echo $search_params['unit_id'][sizeof($search_params['unit_id'])-1] ?>");
            $('#searchControlUnit').val("<?php echo html_entity_decode($search_params['unit_name']) ?>");
            $('#searchControlDocCategoryId').val("<?php echo $search_params['doc_category_id'][sizeof($search_params['doc_category_id'])-1] ?>");
            $('#searchControlDocCategory').val("<?php echo html_entity_decode($search_params['category_title']) ?>");
            $('#searchControlCreationDate').val("<?php echo $search_params['creation_date'] ?>");
            $('#searchControlRegNum').val("<?php echo html_entity_decode($search_params['reg_num'][sizeof($search_params['reg_num'])-1]) ?>");
            $('#searchControlRegDate').val("<?php echo $search_params['reg_date'] ?>");
            $('#searchControlSnbDirector').val("<?php echo html_entity_decode($search_params['snb_director'][sizeof($search_params['snb_director'])-1]) ?>");
            $('#searchControlSnbSubDirector').val("<?php echo $search_params['snb_subdirector'][sizeof($search_params['snb_subdirector'])-1] ?>");
            $('#searchControlResolutionDate').val("<?php echo $search_params['resolution_date'] ?>");
            $('#searchControlResolution').val("<?php echo html_entity_decode($search_params['resolution'][sizeof($search_params['resolution'])-1]) ?>");
            $('#searchControlActUnitId').val("<?php echo $search_params['act_unit_id'][sizeof($search_params['act_unit_id'])-1] ?>");
            $('#searchControlActUnit').val("<?php echo html_entity_decode($search_params['act_unit_name']) ?>");
            $('#searchControlActorName').val("<?php echo html_entity_decode($search_params['actor_name'][sizeof($search_params['actor_name'])-1]) ?>");
            $('#searchControlSubActUnitId').val("<?php echo $search_params['sub_act_unit_id'][sizeof($search_params['sub_act_unit_id'])-1] ?>");
            $('#searchControlSubActUnit').val("<?php echo html_entity_decode($search_params['sub_act_unit_name']) ?>");
            $('#controlSubActorName').val("<?php echo html_entity_decode($search_params['sub_actor_name'][sizeof($search_params['sub_actor_name'])-1]) ?>");
            $('#searchControlResultId').val("<?php echo $search_params['result_id'][sizeof($search_params['result_id'])-1] ?>");
            $('#searchControlResult').val("<?php echo html_entity_decode($search_params['result_name']) ?>");
            $('#fileSearch').val("<?php echo html_entity_decode($search_params['content']) ?>");
        <?php } ?>

    });

    function closeFControl(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameControl).val(name);
        $('#'+currentInputIdControl).val(id);
        var field = $('#'+currentInputIdControl).attr('name');
        $.fancybox.close();
    }

    function getText(){
        return  $('#'+currentInputIdControl).val();
    }

    function closeFancyText(text){
        $('#'+currentInputIdControl).val(text);
        $.fancybox.close();
    }

</script>