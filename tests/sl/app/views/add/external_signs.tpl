<a id="<?php echo $_SESSION['counter']; ?>closeExternalSignSign" class="customClose"></a>
<span class="idNumber"><?php if(isset($sign)){ echo 'ID : '.$sign['id']; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>externalSignForm">
        <input type="hidden" name="man_id" value="<?php echo $man_id?>" />
        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signPhoto"><?php echo $Lang->photo;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signPhoto" dataId="<?php echo $_SESSION['counter']; ?>signPhotoId" class="addMore addMore<?php echo $_SESSION['counter']; ?>Multiple" value=" .. " />
            <input type="text" name="photo" id="<?php echo $_SESSION['counter']; ?>signPhoto"/>
        </div-->

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signTimeFixation">1) <?php echo $Lang->time_fixation; ?></label>
            <input type="text" name="fixed_date" id="<?php echo $_SESSION['counter']; ?>signTimeFixation" style="width: 505px" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>signTimeFixation',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateExternalSign<?php echo $_SESSION['counter']; ?>" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signSign">2) <?php echo $Lang->signs;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signSign" dataId="<?php echo $_SESSION['counter']; ?>signSignId" dataTableName="fancy/sign" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="signs" id="<?php echo $_SESSION['counter']; ?>signSign" dataTableName="sign" dataInputId="<?php echo $_SESSION['counter']; ?>signSignId" class="oneInputSaveEnter" <?php if(isset($sign)){ if(!empty($sign['sign'])){ echo "value='".$sign['sign']."'"; } }?>/>
            <input type="hidden" name="sign_id" id="<?php echo $_SESSION['counter']; ?>signSignId" <?php if(isset($sign)){ if(!empty($sign['sign_id'])){ echo "value='".$sign['sign_id']."'"; } }?>/>
        </div>

        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signManSign"><?php echo $Lang->man_sign;?></label>
            <input type="text" name="man_sign" id="<?php echo $_SESSION['counter']; ?>signManSign"/>
        </div-->

        <div class="forForm">
            <label>3) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($sign)) {
                        if(!empty($sign['man_id'])) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $sign['man_id']; ?>" data-tb="man" ><?php echo $Lang->short_man; ?> : <?php echo $sign['man_id']; ?></span>
                        <span class="editAll"></span><a> </a>
                    </div>
                </li>
                <?php
                        }
                      } ?>
                &nbsp
            </ul>
        </div>


        <div class="buttons"></div>

    </form>
</div>

<script>
    var currentInputNameSign<?php echo $_SESSION['counter']; ?>;
    var currentInputIdSign<?php echo $_SESSION['counter']; ?>;
    $(document).ready(function(){

        $('#<?php echo $_SESSION['counter']; ?>signSign').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>signSignId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>signSign').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>signSign').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>signSignId').val();
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    alert('<?php echo $Lang->enter_sign;?>');
                    $('#<?php echo $_SESSION['counter']; ?>signSign').val('');
                    $('#<?php echo $_SESSION['counter']; ?>signSignId').val('');
                }
            }
        });

        $('.oneInputSaveDateExternalSign<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateExternalSign<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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
                    }else{
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }
            }
        });

        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameSign<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdSign<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=external_sign&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>closeExternalSignSign').click(function(e){
            e.preventDefault();
            var sign_id = $('#<?php echo $_SESSION['counter']; ?>signSignId').val();
            var sign_name = $('#<?php echo $_SESSION['counter']; ?>signSign').val();
            if( (sign_id.length == 0)||(sign_name.length == 0) ){
                var checkingConfirm = confirm('<?php echo $Lang->sign_quit;?>');
                if(checkingConfirm){
                    removeItem();
                }
            }else{
                var externalData = $('#<?php echo $_SESSION['counter']; ?>externalSignForm').serializeArray();
                <?php if(isset($sign)) { ?>
                    $.ajax({
                        url: '<?php echo ROOT?>add/edit_external_sign/<?php echo $sign['id']; ?>',
                        type: 'POST',
                        data:externalData,
                        success: function(data){
                            removeItem();
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                <?php }else{ ?>
                    man_external_sign_has_sign<?php if(isset($old_counter)){ echo $old_counter; }?>(externalData);
                <?php }?>
            }
        });

        <?php if(isset($sign)) {
                if(!empty($sign['fixed_date'])) { ?>
                    $('#<?php echo $_SESSION['counter']; ?>signTimeFixation').val('<?php echo $sign['fixed_date'];?>');
        <?php   }
              } ?>


    });

    function closeExternalSign<?php echo $_SESSION['counter']; ?>(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameSign<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdSign<?php echo $_SESSION['counter']; ?>).val(id);
        $.fancybox.close();
        $('#'+currentInputNameSign<?php echo $_SESSION['counter']; ?>).focus();
    }



</script>

