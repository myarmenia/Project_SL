<a class="closeButton"></a>
<div class="inContent">
    <form id="keepSignalForm" action="<?php echo ROOT;?>simplesearch/result_keep_signal" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="<?php echo $Lang->and; ?>" id="keep_and" />
            <input type="button" class="k-button" value="<?php echo $Lang->or; ?>" id="keep_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
            <input type="submit" class="k-button" name="submit" value="<?php echo $Lang->search;?>" /> <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['agency_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchKeepManagementSignalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['agency_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchKeepManagementSignal">
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
            <input type="hidden" name="agency_id_type" id="searchKeepManagementSignalType" value="<?php echo $search_params['agency_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchKeepManagementSignal"><?php echo $Lang->management_signal;?></label>
            <input type="button" dataName="searchKeepManagementSignal" dataId="searchKeepManagementSignalId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="management_signal" id="searchKeepManagementSignal" dataTableName="agency" dataInputId="searchKeepManagementSignalId"  class="oneInputSaveEnter"/>
            <?php if (isset($search_params['agency_id_type']) && $search_params['agency_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchKeepManagementSignalOp">ИЛИ</span>
            <?php } else if (isset($search_params['agency_id_type']) && $search_params['agency_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchKeepManagementSignalOp">И</span>
            <?php } ?>
            <input type="hidden" name="agency_id[]" id="searchKeepManagementSignalId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchKeepDepartmentCheckingSignalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchKeepDepartmentCheckingSignal">
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
            <input type="hidden" name="unit_id_type" id="searchKeepDepartmentCheckingSignalType" value="<?php echo $search_params['unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchKeepDepartmentCheckingSignal"><?php echo $Lang->department_checking_signal;?></label>
            <input type="button" dataName="searchKeepDepartmentCheckingSignal" dataId="searchKeepDepartmentCheckingSignalId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="department_checking_signal" id="searchKeepDepartmentCheckingSignal" dataTableName="agency" dataInputId="searchKeepDepartmentCheckingSignalId"  class="oneInputSaveEnter"/>
            <?php if (isset($search_params['unit_id_type']) && $search_params['unit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchKeepDepartmentCheckingSignalOp">ИЛИ</span>
            <?php } else if (isset($search_params['unit_id_type']) && $search_params['unit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchKeepDepartmentCheckingSignalOp">И</span>
            <?php } ?>
            <input type="hidden" name="unit_id[]" id="searchKeepDepartmentCheckingSignalId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['sub_unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchKeepUnitSignalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['sub_unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchKeepUnitSignal">
                    <div class="item">
                        <span><?php echo $search_params['sub_unit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="sub_unit_id[]" value="<?php echo $search_params['sub_unit_id'][$i] ?>">
                    <input type="hidden" name="sub_unit_idName[]" value="<?php echo $search_params['sub_unit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="sub_unit_id_type" id="searchKeepUnitSignalType" value="<?php echo $search_params['sub_unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchKeepUnitSignal"><?php echo $Lang->unit_signal;?></label>
            <input type="button" dataName="searchKeepUnitSignal" dataId="searchKeepUnitSignalId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="unit_signal" id="searchKeepUnitSignal" dataTableName="agency" dataInputId="searchKeepUnitSignalId"  class="oneInputSaveEnter"/>
            <?php if (isset($search_params['sub_unit_id_type']) && $search_params['sub_unit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchKeepUnitSignalOp">ИЛИ</span>
            <?php } else if (isset($search_params['sub_unit_id_type']) && $search_params['sub_unit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchKeepUnitSignalOp">И</span>
            <?php } ?>
            <input type="hidden" name="sub_unit_id[]" id="searchKeepUnitSignalId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['worker'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchKeepNameOperativesFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['worker'])-1 ; $i++ ) { ?>
                <li id="listItemsearchKeepNameOperatives">
                    <div class="item">
                        <span><?php echo $search_params['worker'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="worker[]" value="<?php echo $search_params['worker'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="worker_type" id="searchKeepNameOperativesType" value="<?php echo $search_params['worker_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchKeepNameOperatives"><?php echo $Lang->name_operatives?></label>
            <input type="text" name="worker[]" id="searchKeepNameOperatives" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['worker_type']) && $search_params['worker_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchKeepNameOperativesOp">ИЛИ</span>
            <?php } else if (isset($search_params['worker_type']) && $search_params['worker_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchKeepNameOperativesOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['worker_post_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="keepWorkerPostFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['worker_post_id'])-1 ; $i++ ) { ?>
                <li id="listItemkeepWorkerPost">
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
            <input type="hidden" name="worker_post_id_type" id="keepWorkerPostType" value="<?php echo $search_params['worker_post_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="keepWorkerPost"><?php echo $Lang->worker_post;?></label>
            <input type="button" dataName="keepWorkerPost" dataId="keepWorkerPostId" dataTableName="fancy/worker_post" class="addMore k-icon k-i-plus"   />
            <input type="text" name="worker_post" id="keepWorkerPost" dataTableName="worker_post" dataInputId="keepWorkerPostId"  class="oneInputSaveEnter"/>
            <?php if (isset($search_params['worker_post_id_type']) && $search_params['worker_post_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="keepWorkerPostOp">ИЛИ</span>
            <?php } else if (isset($search_params['worker_post_id_type']) && $search_params['worker_post_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="keepWorkerPostOp">И</span>
            <?php } ?>
            <input type="hidden" name="worker_post_id[]" id="keepWorkerPostId" />
        </div>

        <div class="forForm">
            <label for="searchKeepStartCheckingSignal"><?php echo $Lang->start_checking_signal;?></label>
            <input type="text" name="start_date" id="searchKeepStartCheckingSignal" style="width: 505px;" onkeydown="validateNumber(event,'searchKeepStartCheckingSignal',12)" class="oneInputSaveEnter oneInputSaveDateKeepSignal"/>
        </div>

        <div class="forForm">
            <label for="searchKeepEndCheckingSignal"><?php echo $Lang->end_checking_signal;?></label>
            <input type="text" name="end_date" id="searchKeepEndCheckingSignal" style="width: 505px;" onkeydown="validateNumber(event,'searchKeepEndCheckingSignal',12)" class="oneInputSaveEnter oneInputSaveDateKeepSignal"/>
        </div>

        <div class="forForm">
            <label for="searchKeepDateTransferUnit"><?php echo $Lang->date_transfer_unit;?></label>
            <input type="text" name="pass_date" id="searchKeepDateTransferUnit" style="width: 505px;" onkeydown="validateNumber(event,'searchKeepDateTransferUnit',12)" class="oneInputSaveEnter oneInputSaveDateKeepSignal"/>
        </div>

        <?php if (isset($search_params) && isset($search_params['pased_sub_unit'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="keepUnitSignalTransmittedFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['pased_sub_unit'])-1 ; $i++ ) { ?>
                <li id="listItemkeepUnitSignalTransmitted">
                    <div class="item">
                        <span><?php echo $search_params['pased_sub_unitName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="pased_sub_unit[]" value="<?php echo $search_params['pased_sub_unit'][$i] ?>">
                    <input type="hidden" name="pased_sub_unitName[]" value="<?php echo $search_params['pased_sub_unitName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="pased_sub_unit_type" id="keepUnitSignalTransmittedType" value="<?php echo $search_params['pased_sub_unit_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchKeepUnitSignalTransmitted"><?php echo $Lang->unit_signal_transmitted;?></label>
            <input type="button" dataName="keepUnitSignalTransmitted" dataId="keepUnitSignalTransmittedId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="pased_sub_unit_name" id="keepUnitSignalTransmitted" dataTableName="agency" dataInputId="keepUnitSignalTransmittedId"  class="oneInputSaveEnter" />
            <?php if (isset($search_params['pased_sub_unit_type']) && $search_params['pased_sub_unit_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="keepUnitSignalTransmittedOp">ИЛИ</span>
            <?php } else if (isset($search_params['pased_sub_unit_type']) && $search_params['pased_sub_unit_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="keepUnitSignalTransmittedOp">И</span>
            <?php } ?>
            <input type="hidden" name="pased_sub_unit[]" id="keepUnitSignalTransmittedId" />
        </div>

        <div class="buttons">

        </div>

    </form>
</div>

<script>
var currentInputNameKeepSignal;
var currentInputIdKeepSignal;
var searchInput;

$(document).ready(function(){

    $('input').map(function(){
        if($(this).hasClass('oneInputSaveEnter')){
            $(this).val('');
        }
    });

    searchMultiSelectMaker( 'searchKeepNameOperatives' , 'worker' );

    searchMultiSelectMakerAutoComplete( 'searchKeepManagementSignal' , 'agency_id' );
    searchMultiSelectMakerAutoComplete( 'searchKeepDepartmentCheckingSignal' , 'unit_id' );
    searchMultiSelectMakerAutoComplete( 'searchKeepUnitSignal' , 'sub_unit_id' );
    searchMultiSelectMakerAutoComplete( 'keepUnitSignalTransmitted' , 'pased_sub_unit' );
    searchMultiSelectMakerAutoComplete( 'keepWorkerPost' , 'worker_post_id' );

    $('.keepSignalAddWorker').click(function(e){
        e.preventDefault();
        currentInputNameKeepSignal = $(this).attr('dataName');
        currentInputIdKeepSignal = $(this).attr('dataId');
        $.fancybox({
            'type'  : 'iframe',
            'autoSize': false,
            'width'             : 800,
            'height'            : 600,
            'href'              : "<?php echo ROOT;?>autocomplete/fancyWorker/keep_signal"
        });
    });

    $('.oneInputSaveDateKeepSignal').kendoDatePicker({
        format: "dd-MM-yyyy",
        change:function(e){
            $('.selectedDiv').removeClass('selectedDiv');
        }
    });

    $('.oneInputSaveDateKeepSignal').focusout(function(e){
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

    $('#keepWorkerPost').kendoAutoComplete({
        dataTextField: "name",
        filter: "contains",
        dataSource: {
            transport: {
                read:{
                    dataType: "json",
                    url: "<?php echo ROOT;?>dictionary/worker_post/read"
                }
            }
        },
        select:function(e){
            var dataItem = this.dataItem(e.item.index());
            $('#keepWorkerPostId').val(dataItem.id);
        }
    });

    $('#searchKeepManagementSignal').kendoAutoComplete({
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
            $('#searchKeepManagementSignalId').val(dataItem.id);
        }
    });

    $('#keepUnitSignalTransmitted').kendoAutoComplete({
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
            $('#keepUnitSignalTransmittedId').val(dataItem.id);
        }
    });


    $('#searchKeepDepartmentCheckingSignal').kendoAutoComplete({
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
            $('#searchKeepDepartmentCheckingSignalId').val(dataItem.id);
        }
    });

    $('#searchKeepUnitSignal').kendoAutoComplete({
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
            $('#searchKeepUnitSignalId').val(dataItem.id);
        }
    });

    $('.addMore').click(function(e){
        e.preventDefault();
        var url = $(this).attr('dataTableName');
        currentInputNameKeepSignal = $(this).attr('dataName');
        currentInputIdKeepSignal = $(this).attr('dataId');
        $.fancybox({
            'type'  : 'iframe',
            'autoSize': false,
            'width'             : 800,
            'height'            : 600,
            'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=keep_signal"
        });
    });

    $('.oneInputSaveEnter').focusout(function(e){
        e.preventDefault();
        var test = $(this).attr('id');
        if(typeof test != 'undefined'){
            searchInput = test;
        }
    });

    $('#keep_and').click(function(e){
        var ff = $.Event("keypress");
        ff.charCode = 38;
        $("#"+searchInput).trigger(ff);
        $('#'+searchInput).focus();
    });

    $('#keep_or').click(function(e){
        var ee = $.Event("keypress");
        ee.charCode = 124;
        $("#"+searchInput).trigger(ee);
        $('#'+searchInput).focus();
    });


    $('.oneInputSaveKeepSignal').focusout(function(e){
        e.preventDefault();
        var value = $(this).val();
        var field = $(this).attr('name');
        if(value.length != 0){

        }
    });

    <?php if (isset($search_params)) { ?>
        $('#searchKeepManagementSignalId').val("<?php echo $search_params['agency_id'][sizeof($search_params['agency_id'])-1] ?>");
        $('#searchKeepManagementSignal').val("<?php echo html_entity_decode($search_params['management_signal']) ?>");
        $('#searchKeepDepartmentCheckingSignalId').val("<?php echo $search_params['unit_id'][sizeof($search_params['unit_id'])-1] ?>");
        $('#searchKeepDepartmentCheckingSignal').val("<?php echo html_entity_decode($search_params['department_checking_signal']) ?>");
        $('#searchKeepUnitSignalId').val("<?php echo $search_params['sub_unit_id'][sizeof($search_params['sub_unit_id'])-1] ?>");
        $('#searchKeepUnitSignal').val("<?php echo html_entity_decode($search_params['unit_signal']) ?>");
        $('#searchKeepNameOperatives').val("<?php echo html_entity_decode($search_params['worker'][sizeof($search_params['worker'])-1]) ?>");
        $('#keepWorkerPostId').val("<?php echo $search_params['worker_post_id'][sizeof($search_params['worker_post_id'])-1] ?>");
        $('#keepWorkerPost').val("<?php echo html_entity_decode($search_params['worker_post']) ?>");
        $('#searchKeepStartCheckingSignal').val("<?php echo $search_params['start_date'] ?>");
        $('#searchKeepEndCheckingSignal').val("<?php echo $search_params['end_date'] ?>");
        $('#searchKeepDateTransferUnit').val("<?php echo $search_params['pass_date'] ?>");
        $('#keepUnitSignalTransmittedId').val("<?php echo $search_params['pased_sub_unit'][sizeof($search_params['pased_sub_unit'])-1] ?>");
        $('#keepUnitSignalTransmitted').val("<?php echo html_entity_decode($search_params['pased_sub_unit_name']) ?>");
    <?php } ?>

});
function closeKeepSignal(name,id){
    $('#'+currentInputNameKeepSignal).val(name);
    $('#'+currentInputIdKeepSignal).val(id);
    var field = $('#'+currentInputIdKeepSignal).attr('name');

    $.fancybox.close();
}
</script>

