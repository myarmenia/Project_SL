<a id="<?php echo $_SESSION['counter']; ?>closeemail" class="customClose"></a>
<span class="idNumber"><?php if(isset($email)){ echo 'ID : '.$email['id']; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>emailForm">

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>emailEmail">1) <?php echo $Lang->mail_address;?></label>
            <input type="text" name="email_number" id="<?php echo $_SESSION['counter']; ?>emailEmail" class="oneInputSaveEnter" <?php if(isset($email)){ if(!empty($email['address'])){ echo "value='".$email['address']."'"; } }?>/>
        </div>

        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>emailNatureCharacter"><?php// echo $Lang->nature_character;?></label>
            <input type="button" dataName="emailNatureCharacter" dataId="emailNatureCharacterId" dataTableName="fancy/`character`" class="addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="nature_character" id="<?php echo $_SESSION['counter']; ?>emailNatureCharacter" dataTableName="`character`" dataInputId="emailNatureCharacterId" class="oneInputSaveEnter"/>
            <input type="hidden" name="nature_character_id" id="<?php echo $_SESSION['counter']; ?>emailNatureCharacterId" />
        </div>

        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>emailAdditionalData"><?php// echo $Lang->additional_data;?></label>
            <input type="text" name="additional_data" id="<?php echo $_SESSION['counter']; ?>emailAdditionalData" class="oneInputSaveEnter"/>
        </div-->

        <div class="forForm">
            <label>2) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($email_has)) {
                        if(!empty($email_has)) {
                            foreach($email_has as $val) {
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
    var currentInputNameEmail<?php echo $_SESSION['counter']; ?>;
    var currentInputIdEmail<?php echo $_SESSION['counter']; ?>;
    $(document).ready(function(){

        $('#<?php echo $_SESSION['counter']; ?>emailNatureCharacter').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>emailNatureCharacterId').val(dataItem.id);
            }
        });



        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameEmail<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdEmail<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=email&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>closeemail').click(function(e){
            e.preventDefault();
            var email_number = $('#<?php echo $_SESSION['counter']; ?>emailEmail').val();
//            var character = $('#<?php echo $_SESSION['counter']; ?>emailNatureCharacterId').val();
//            var more_data = $('#<?php echo $_SESSION['counter']; ?>emailAdditionalData').val();
            if(email_number.length == 0 ){
                var confirmemail = confirm('<?php echo $Lang->email_quit;?>');
                if(confirmemail){
                    removeItem();
                }
            }else{
                var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(reg.test(email_number)){
                    var data = { 'email_address': email_number };
                    <?php if($other_tb_name == 'organization') { ?>
                        organization_has_email<?php if(isset($old_counter)){ echo $old_counter; }?>(data);
                    <?php }elseif($other_tb_name == 'man') { ?>
                        man_has_email<?php if(isset($old_counter)){ echo $old_counter; }?>(data);
                    <?php }elseif($other_tb_name == 'edit') { ?>
                        $.ajax({
                            url: '<?php echo ROOT?>add/edit_email/<?php echo $email['id']; ?>',
                            type: 'POST',
                            data:data,
                            success: function(data){
                                removeItem();
                            },
                            faild: function(data){
                                alert('<?php echo $Lang->err;?> ');
                            }
                        });
                    <?php } ?>
                }else{
                    alert('<?php echo $Lang->enter_email;?>');
                }
            }

        });

    });

    function closeEmail<?php echo $_SESSION['counter']; ?>(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameEmail<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdEmail<?php echo $_SESSION['counter']; ?>).val(id);
        $.fancybox.close();
    }



</script>

