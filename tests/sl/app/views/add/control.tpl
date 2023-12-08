<a class="closeButton" id='<?php echo $_SESSION['counter']; ?>closeControl'></a>
<span class="idNumber"><?php if(isset($control_id)){ echo 'ID : '.$control_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>controlForm">
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlUnit">1) <?php echo $Lang->unit;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>controlUnit" dataId="<?php echo $_SESSION['counter']; ?>controlUnitId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" firstItem="1" name="unit_name" id="<?php echo $_SESSION['counter']; ?>controlUnit" class="oneInputSaveEnter" dataTableName="agency" dataInputId="<?php echo $_SESSION['counter']; ?>controlUnitId" <?php if(isset($control)){ if(!empty($control['unit_name'])){ echo "value='".$control['unit_name']."'"; } } ?> />
            <input type="hidden" name="unit_id" id="<?php echo $_SESSION['counter']; ?>controlUnitId" <?php if(isset($control)){ if(!empty($control['unit_id'])){ echo "value='".$control['unit_id']."'"; } } ?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlDocCategory">2) <?php echo $Lang->document_category;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>controlDocCategory" dataId="<?php echo $_SESSION['counter']; ?>controlDocCategoryId" dataTableName="fancy/doc_category" class="addMore k-icon k-i-plus"   />
            <input type="text" name="category_title" id="<?php echo $_SESSION['counter']; ?>controlDocCategory" class="oneInputSaveEnter" dataTableName="doc_category" dataInputId="<?php echo $_SESSION['counter']; ?>controlDocCategoryId" <?php if(isset($control)){ if(!empty($control['doc_name'])){ echo "value='".$control['doc_name']."'"; } } ?>/>
            <input type="hidden" name="doc_category_id" id="<?php echo $_SESSION['counter']; ?>controlDocCategoryId" <?php if(isset($control)){ if(!empty($control['doc_category_id'])){ echo "value='".$control['doc_category_id']."'"; } } ?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlCreationDate">3) <?php echo $Lang->document_date;?></label>
            <input type="text" name="creation_date" onkeydown="validateNumber(event ,'<?php echo $_SESSION['counter']; ?>controlCreationDate',12)" id="<?php echo $_SESSION['counter']; ?>controlCreationDate" style="width: 505px;" class="datePicker dotsToDash oneInputSaveDateControl<?php echo $_SESSION['counter']; ?> oneInputSaveEnter"/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlRegNum">4) <?php echo $Lang->reg_document;?></label>
            <input type="text" name="reg_num" id="<?php echo $_SESSION['counter']; ?>controlRegNum" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($control)){ if(!empty($control['reg_num'])){ echo "value='".$control['reg_num']."'"; } } ?> />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlRegDate">5) <?php echo $Lang->date_reg;?></label>
            <input type="text" name="reg_date" id="<?php echo $_SESSION['counter']; ?>controlRegDate" onkeydown="validateNumber(event ,'<?php echo $_SESSION['counter']; ?>controlRegDate',12)" style="width: 505px;" class="datePicker dotsToDash oneInputSaveDateControl<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlSnbDirector">6) <?php echo $Lang->director;?></label>
            <input type="text" name="snb_director" id="<?php echo $_SESSION['counter']; ?>controlSnbDirector" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($control)){ if(!empty($control['snb_director'])){ echo "value='".$control['snb_director']."'"; } } ?> />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlSnbSubDirector">7) <?php echo $Lang->deputy_director;?></label>
            <input type="text" name="snb_subdirector" id="<?php echo $_SESSION['counter']; ?>controlSnbSubDirector" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($control)){ if(!empty($control['snb_subdirector'])){ echo "value='".$control['snb_subdirector']."'"; } } ?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlResolutionDate">8) <?php echo $Lang->date_resolution;?></label>
            <input type="text" name="resolution_date" id="<?php echo $_SESSION['counter']; ?>controlResolutionDate" onkeydown="validateNumber(event ,'<?php echo $_SESSION['counter']; ?>controlResolutionDate',12)" style="width: 505px;" class="datePicker dotsToDash oneInputSaveDateControl<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlResolution">9) <?php echo $Lang->resolution;?></label>
            <input type="hidden" class="oneInputSaveEnter eventTrigger">
            <textarea type="aaaa" name="resolution" id="<?php echo $_SESSION['counter']; ?>controlResolution" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" ><?php if(isset($control)){ if(!empty($control['resolution'])){ echo $control['resolution']; } } ?></textarea>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlActUnit">10) <?php echo $Lang->department_performer;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>controlActUnit" dataId="<?php echo $_SESSION['counter']; ?>controlActUnitId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="act_unit_name" id="<?php echo $_SESSION['counter']; ?>controlActUnit" class="oneInputSaveEnter" dataTableName="agency" dataInputId="<?php echo $_SESSION['counter']; ?>controlActUnitId" <?php if(isset($control)){ if(!empty($control['act_unit_name'])){ echo "value='".$control['act_unit_name']."'"; } } ?>/>
            <input type="hidden" name="act_unit_id" id="<?php echo $_SESSION['counter']; ?>controlActUnitId" <?php if(isset($control)){ if(!empty($control['act_unit_id'])){ echo "value='".$control['act_unit_id']."'"; } } ?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlActorName">11) <?php echo $Lang->actor_name;?></label>
            <input type="text"  name="actor_name" id="<?php echo $_SESSION['counter']; ?>controlActorName" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($control)){ if(!empty($control['actor_name'])){ echo "value='".$control['actor_name']."'"; } } ?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlSubActUnit">12) <?php echo $Lang->department_coauthors;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>controlSubActUnit" dataId="<?php echo $_SESSION['counter']; ?>controlSubActUnitId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="sub_act_unit_name" id="<?php echo $_SESSION['counter']; ?>controlSubActUnit" class="oneInputSaveEnter" dataTableName="agency" dataInputId="<?php echo $_SESSION['counter']; ?>controlSubActUnitId"  <?php if(isset($control)){ if(!empty($control['sub_act_unit_name'])){ echo "value='".$control['sub_act_unit_name']."'"; } } ?>/>
            <input type="hidden" name="sub_act_unit_id" id="<?php echo $_SESSION['counter']; ?>controlSubActUnitId" <?php if(isset($control)){ if(!empty($control['sub_act_unit_id'])){ echo "value='".$control['sub_act_unit_id']."'"; } } ?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlSubActorName">13) <?php echo $Lang->actor_name;?></label>
            <input type="text"  name="sub_actor_name" id="<?php echo $_SESSION['counter']; ?>controlSubActorName" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($control)){ if(!empty($control['sub_actor_name'])){ echo "value='".$control['sub_actor_name']."'"; } } ?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>controlResult">14) <?php echo $Lang->result_execution;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>controlResult" dataId="<?php echo $_SESSION['counter']; ?>controlResultId" dataTableName="fancy/control_result" class="addMore k-icon k-i-plus"    />
            <input type="text" name="result_name" id="<?php echo $_SESSION['counter']; ?>controlResult" class="oneInputSaveEnter" dataTableName="control_result" dataInputId="<?php echo $_SESSION['counter']; ?>controlResultId"   lastItem="1" <?php if(isset($control)){ if(!empty($control['result_name'])){ echo "value='".$control['result_name']."'"; } } ?>/>
            <input type="hidden" name="result_id" id="<?php echo $_SESSION['counter']; ?>controlResultId" <?php if(isset($control)){ if(!empty($control['result_id'])){ echo "value='".$control['result_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label>15) <?php echo $Lang->contents_document;?></label>
            <ul class="uploader">
                <?php if(isset($control_has_file)) {
                        if(!empty($control_has_file)) {
                            foreach($control_has_file as $val) { ?>
                <li class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> </li>
                <?php       }
                        }
                      } ?>
            </ul>
        </div>

        <div class="forForm">
            <label>16) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($control)) {
                        if(!empty($control['bibliography_id'])) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $control['bibliography_id']; ?>" data-tb="bibliography" ><?php echo $Lang->short_bibl; ?> : <?php echo $control['bibliography_id']; ?></span>
                        <span class="editAll"></span><a> </a>
                    </div>
                </li>
                <?php
                        }
                      } ?>
                &nbsp
            </ul>
        </div>

        <div class="buttons">
            <!-- <input type="button" value="Сохранить" id="<?php echo $_SESSION['counter']; ?>biblSave"/> -->
            <!-- <input type="button" value="Отменить" id="<?php echo $_SESSION['counter']; ?>biblCancel"/> -->
        </div>
    </form>
</div>
<script>
    var currentInputNameControl;
    var currentInputIdControl;
    var  control_bid<?php echo $_SESSION['counter']; ?> = '<?php echo $b_id; ?>';
    var checkControl<?php echo $_SESSION['counter']; ?> = '<?php if(isset($control)){ echo 'false'; }else{ echo 'true'; } ?>';
    var control_id<?php echo $_SESSION['counter']; ?> = '<?php echo $control_id;?>';

    $(document).ready(function(){

        $('.datePicker').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
//        $(".datePicker").closest("span.k-dropdown").width(505);
        <?php if(isset($control)){ if(!empty($control['creation_date'])){ ?>
            $('#<?php echo $_SESSION['counter']; ?>controlCreationDate').val('<?php echo $control["creation_date"];  ?>');
        <?php }
        } ?>

        <?php if(isset($control)){ if(!empty($control['reg_date'])){ ?>
            $('#<?php echo $_SESSION['counter']; ?>controlRegDate').val('<?php echo $control["reg_date"]; ?>');
        <?php }
        } ?>

        <?php if(isset($control)){ if(!empty($control['resolution_date'])){ ?>
            $('#<?php echo $_SESSION['counter']; ?>controlResolutionDate').val('<?php echo $control["resolution_date"]; ?>');
        <?php }
        } ?>


        $('#<?php echo $_SESSION['counter']; ?>controlUnit').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>controlUnitId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>controlUnit').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>controlUnit').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>controlUnitId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>controlUnitId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveControl<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_department;?>');
                    $('#<?php echo $_SESSION['counter']; ?>controlUnit').val('');
                    $('#<?php echo $_SESSION['counter']; ?>controlUnitId').val('');
                }else{
                    saveControl<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveControl<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>controlActUnit').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>controlActUnitId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>controlActUnit').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>controlActUnit').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>controlActUnitId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>controlActUnitId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveControl<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_department;?>');
                    $('#<?php echo $_SESSION['counter']; ?>controlActUnit').val('');
                     $('#<?php echo $_SESSION['counter']; ?>controlActUnitId').val('');
                }else{
                    saveControl<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveControl<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>controlSubActUnit').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>controlSubActUnitId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>controlSubActUnit').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>controlSubActUnit').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>controlSubActUnitId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>controlSubActUnitId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveControl<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_department;?>');
                    $('#<?php echo $_SESSION['counter']; ?>controlSubActUnit').val('');
                    $('#<?php echo $_SESSION['counter']; ?>controlSubActUnitId').val('');
                }else{
                    saveControl<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveControl<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>controlDocCategory').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>controlDocCategoryId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>controlDocCategory').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>controlDocCategory').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>controlDocCategoryId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>controlDocCategoryId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveControl<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_category;?>');
                    $('#<?php echo $_SESSION['counter']; ?>controlDocCategory').val('');
                    $('#<?php echo $_SESSION['counter']; ?>controlDocCategoryId').val('');
                }else{
                    saveControl<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveControl<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>controlResult').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>controlResultId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>controlResult').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>controlResult').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>controlResultId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>controlResultId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveControl<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_result;?>');
                    $('#<?php echo $_SESSION['counter']; ?>controlResult').val('');
                    $('#<?php echo $_SESSION['counter']; ?>controlResultId').val('');
                }else{
                    saveControl<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveControl<?php echo $_SESSION['counter']; ?>('null',field);
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
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=control&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('.oneInputSave<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            e.preventDefault();
            var field = $(this).attr('name');
            var value = $(this).val();
            if(value.length != 0){
                saveControl<?php echo $_SESSION['counter']; ?>(value , field);
            }else{
                saveControl<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('.eventTrigger').focusin(function(e){
            $('#<?php echo $_SESSION['counter']; ?>controlResolution').focus();
        });

        $('#<?php echo $_SESSION['counter']; ?>closeControl').click(function(e){
            e.preventDefault();
            var dataId = $('.activeTable:last').attr('dataId');
            if(checkControl<?php echo $_SESSION['counter']; ?>){
                var confControl = confirm('<?php echo $Lang->enter_anything;?>\n <?php echo $Lang->delete_entry;?>');
                if(confControl){
                    $.ajax({
                        url: '<?php echo ROOT?>add/delete_control/'+control_id<?php echo $_SESSION['counter']; ?>,
                        success: function(data){
                            $('.activeTable').removeClass('activeTable');
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    $('.activeTable').addClass('storedItem');
                    if(typeof  dataId == 'undefined'){
                        $('.activeTable').append(' : id = '+control_id<?php echo $_SESSION['counter']; ?>);
                        $('.activeTable').attr('dataId',control_id<?php echo $_SESSION['counter']; ?>);
                    }
                    $('.activeTable').removeClass('activeTable');
                }
            }else{
                $('.activeTable').addClass('storedItem');
                if(typeof  dataId == 'undefined'){
                    $('.activeTable').append(' : id = '+control_id<?php echo $_SESSION['counter']; ?>);
                    $('.activeTable').attr('dataId',control_id<?php echo $_SESSION['counter']; ?>);
                }
                $('.activeTable').removeClass('activeTable');
            }
        });

//        $('#<?php echo $_SESSION['counter']; ?>controlResolution').focusin(function(){
//            currentInputIdControl = 'controlResolution';
//            $.fancybox({
//                'type'  : 'iframe',
//                'autoSize': false,
//                'width'             : 800,
//                'height'            : 600,
//                'href'              : "<?php echo ROOT;?>autocomplete/text"
//            });
//        });

        $('.oneInputSaveDateControl<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            var val = $(this).val();
            var field = $(this).attr('name');
            var reg = date_preg;
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
                        saveControl<?php echo $_SESSION['counter']; ?>(val,field);
                    }else{
                        $(this).val('');
                        saveControl<?php echo $_SESSION['counter']; ?>('null',field);
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        saveControl<?php echo $_SESSION['counter']; ?>('null',field);
                        alert('<?php echo $Lang->enter_number;?>');
                    }else{
                        saveControl<?php echo $_SESSION['counter']; ?>(val,field);
                    }
                }
            }else{
                if( (typeof $(this).attr('type') != 'undefined')&&(val.length == 0) ){
                    saveControl<?php echo $_SESSION['counter']; ?>('null',field);
                }
            }
        });

    });

    function saveControl<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value, 'field':field };
        $.ajax({
            url: '<?php echo ROOT?>add/save_control/'+control_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            success: function(data){
                checkControl<?php echo $_SESSION['counter']; ?> = false;
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function closeFControl<?php echo $_SESSION['counter']; ?>(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameControl).val(name);
        $('#'+currentInputIdControl).val(id);
        var field = $('#'+currentInputIdControl).attr('name');
        saveControl<?php echo $_SESSION['counter']; ?>(id,field);
        $.fancybox.close();
    }

    function getText(){
        return  $('#'+currentInputIdControl).val();
    }

    function closeFancyText<?php echo $_SESSION['counter']; ?>(text){
        $('#'+currentInputIdControl).val(text);
        saveControl<?php echo $_SESSION['counter']; ?>(text, $('#'+currentInputIdControl).attr('name'));
        $.fancybox.close();
    }

</script>