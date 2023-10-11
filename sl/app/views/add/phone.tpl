<a id="<?php echo $_SESSION['counter']; ?>closePhone" class="customClose"></a>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>phoneForm">

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>phonePhoneNumber">1) <?php echo $Lang->phone_number;?></label>
            <input type="text" name="phone_number" id="<?php echo $_SESSION['counter']; ?>phonePhoneNumber" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>phonePhoneNumber',20)" class="oneInputSaveEnter" <?php if(isset($edit)){ if(!empty($edit['number'])){ echo "value='".$edit['number']."'"; } }?>/>
        </div>

        <?php if($other_tb_name != 'action' && $other_tb_name !='edit' ) { ?>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>phoneNatureCharacter">2) <?php echo $Lang->nature_character;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>phoneNatureCharacter" dataId="<?php echo $_SESSION['counter']; ?>phoneNatureCharacterId" dataTableName="fancy/`character`" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="nature_character" id="<?php echo $_SESSION['counter']; ?>phoneNatureCharacter" dataInputId="<?php echo $_SESSION['counter']; ?>phoneNatureCharacterId" dataTableName="character" class="oneInputSaveEnter" <?php if(isset($edit)){ if(!empty($edit['character_name'])){ echo "value='".$edit['character_name']."'"; } }?>/>
            <input type="hidden" name="nature_character_id" id="<?php echo $_SESSION['counter']; ?>phoneNatureCharacterId" <?php if(isset($edit)){ if(!empty($edit['character_id'])){ echo "value='".$edit['character_id']."'"; } }?>/>
        </div>
        <?php } ?>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>phoneAdditionalData">3) <?php echo $Lang->additional_data;?></label>
            <!--input type="text" name="additional_data" id="<?php echo $_SESSION['counter']; ?>phoneAdditionalData" class="oneInputSaveEnter"/-->
            <textarea name="additional_data" id="<?php echo $_SESSION['counter']; ?>phoneAdditionalData" class="oneInputSaveEnter" ><?php if(isset($edit)){ if(!empty($edit['more_data'])){ echo $edit['more_data']; } }?></textarea>
        </div>

        <div class="forForm">
            <label>4) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($phone_has)) {
                        if(!empty($phone_has)) {
                            foreach($phone_has as $val) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['id']; ?>" data-tb="<?php echo $val['tb']; ?>" ><?php echo $Lang->$val['short']; ?> : <?php echo $val['id']; ?></span>
                        <span class="editAll"></span><a> </a>
                    </div>
                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
        </div>


        <div class="buttons"></div>

    </form>
</div>

<script>
    var currentInputNamePhone<?php echo $_SESSION['counter']; ?>;
    var currentInputIdPhone<?php echo $_SESSION['counter']; ?>;
    $(document).ready(function(){

        $('input[name="phone_number"]').on('focusout',function() {
            $(this).val($(this).val().replace(/[A-Za-z$+-]/g, ""));
            $(this).val($(this).val().replace(/ /g,''));
        });

        $('#<?php echo $_SESSION['counter']; ?>phoneNatureCharacter').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/character/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>phoneNatureCharacterId').val(dataItem.id);
            }
        });



        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNamePhone<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdPhone<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=phone&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>closePhone').click(function(e){
            e.preventDefault();
            var phone_number = $('#<?php echo $_SESSION['counter']; ?>phonePhoneNumber').val();
            var character = $('#<?php echo $_SESSION['counter']; ?>phoneNatureCharacterId').val();
            if(typeof character == 'undefined'){
                character = '';
            }
            var more_data = $('#<?php echo $_SESSION['counter']; ?>phoneAdditionalData').val();
            if(phone_number.length == 0 ){
                var confirmPhone = confirm('<?php echo $Lang->phone_quit;?>');
                if(confirmPhone){
                    removeItem();
                }
            }else{
                if(character.length == 0){
                    character = 0;
                }
                var data = { 'phone_number': phone_number , 'character' : character , 'more_data' : more_data };
            <?php if($other_tb_name == 'organization') { ?>
                    organization_has_phone<?php if(isset($old_counter)){ echo $old_counter; }?>(data);
                <?php }elseif($other_tb_name == 'action') { ?>
                    action_has_phone<?php if(isset($old_counter)){ echo $old_counter; }?>(data);
                <?php }elseif($other_tb_name == 'man') { ?>
                    man_has_phone<?php if(isset($old_counter)){ echo $old_counter; }?>(data);
                <?php }elseif($other_tb_name == 'man_edit') { ?>
                    $.ajax({
                        url : '<?php echo ROOT; ?>add/updateManHasPhone/<?php echo $edit['phone_id'].'/'.$edit['man_id']; ?>',
                        type: 'POST',
                        data : data ,
                        success: function(data){
                            removeItem();
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                <?php }elseif($other_tb_name == 'organization_edit') { ?>
                    $.ajax({
                        url : '<?php echo ROOT; ?>add/updateOrganizationHasPhone/<?php echo $edit['phone_id'].'/'.$edit['organization_id']; ?>',
                        type: 'POST',
                        data : data ,
                        success: function(data){
                            removeItem();
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                <?php }elseif($other_tb_name == 'edit') { ?>
                    $.ajax({
                        url : '<?php echo ROOT; ?>add/updatePhone/<?php echo $edit['id']; ?>',
                        type: 'POST',
                        data : data ,
                        success: function(data){
                            removeItem();
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                <?php } ?>
            }

        });

    });

    function closePhone<?php echo $_SESSION['counter']; ?>(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNamePhone<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdPhone<?php echo $_SESSION['counter']; ?>).val(id);
        $.fancybox.close();
    }



</script>

