<a class="closeButton"></a>
<div class="inContent">
    <form id="externalSignForm" action="<?php echo ROOT;?>simplesearch/result_external_signs" method="post">
        <!--input type="hidden" name="man_id" value="<?php echo $man_id?>" /-->

        <div class="buttons">
            <input type="button" class="k-button" value="<?php echo $Lang->and; ?>" id="ext_and" />
            <input type="button" class="k-button" value="<?php echo $Lang->or; ?>" id="ext_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
            <input type="submit" class="k-button" name="submit" value="<?php echo $Lang->search;?>" /><?php } ?>
        </div>

        <div class="forForm">
            <label for="searchSignTimeFixation"><?php echo $Lang->time_fixation?></label>
            <input type="text" name="fixed_date" id="searchSignTimeFixation" style="width: 505px" onkeydown="validateNumber(event,'searchSignTimeFixation',12)" class="oneInputSaveEnter oneInputSaveDateExternalSign" />
        </div>

        <?php if (isset($search_params) && isset($search_params['sign_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignSignFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['sign_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignSign">
                    <div class="item">
                        <span><?php echo $search_params['sign_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div><input type="hidden" name="sign_id[]" value="<?php echo $search_params['sign_id'][$i] ?>">
                    <input type="hidden" name="sign_idName[]" value="<?php echo $search_params['sign_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="sign_id_type" id="searchSignSignType" value="<?php echo $search_params['sign_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignSign"><?php echo $Lang->signs;?></label>
            <input type="button" dataName="searchSignSign" dataId="searchSignSignId" dataTableName="fancy/sign" class="addMore k-icon k-i-plus"   />
            <input type="text" name="signs" id="searchSignSign" dataTableName="sign" dataInputId="searchSignSignId" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['sign_id_type']) && $search_params['sign_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignSignOp">ИЛИ</span>
            <?php } else if (isset($search_params['sign_id_type']) && $search_params['sign_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignSignOp">И</span>
            <?php } ?>
            <input type="hidden" name="sign_id[]" id="searchSignSignId" />
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
    var currentInputNameSign;
    var currentInputIdSign;
    var searchInput;
    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMakerAutoComplete( 'searchSignSign' , 'sign_id' );

        $('#searchSignSign').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/sign/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchSignSignId').val(dataItem.id);
            }
        });

        $('.oneInputSaveDateExternalSign').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateExternalSign').focusout(function(e){
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
                    }
                }
            }
        });

        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameSign = $(this).attr('dataName');
            currentInputIdSign = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=external_sign"
            });
        });

        $('#closeExternalSignSign').click(function(e){
            e.preventDefault();
            var sign_id = $('#signSignId').val();
            var sign_name = $('#signSign').val();
            if( (sign_id.length == 0)||(sign_name.length == 0) ){
                var checkingConfirm = confirm('<?php echo $Lang->sign_quit;?>');
                if(checkingConfirm){
                    removeItem();
                }
            }else{
                var externalData = $('#externalSignForm').serializeArray();
                man_external_sign_has_sign(externalData);
            }
        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#ext_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#ext_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchSignTimeFixation').val("<?php echo $search_params['fixed_date'] ?>");
            $('#searchSignSign').val("<?php echo html_entity_decode($search_params['signs']) ?>");
            $('#searchSignSignId').val("<?php echo $search_params['sign_id'][sizeof($search_params['sign_id'])-1] ?>");
            $('#fileSearch').val("<?php echo html_entity_decode($search_params['content']) ?>");
        <?php } ?>

    });

    function closeExternalSign(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameSign).val(name);
        $('#'+currentInputIdSign).val(id);
        $.fancybox.close();
        $('#'+currentInputNameSign).focus();
    }



</script>

