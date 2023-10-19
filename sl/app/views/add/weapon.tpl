<a class="closeButton" id="<?php echo $_SESSION['counter']; ?>closeWeapon"></a>
<span class="idNumber"><?php if(isset($weapon_id)){ echo 'ID : '.$weapon_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>weaponForm">




        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>weaponCategory">1) <?php echo $Lang->weapon_cat;?></label>
            <input type="text" name="category" id="<?php echo $_SESSION['counter']; ?>weaponCategory" class="oneInputSaveWeapon<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($weapon)){ if(!empty($weapon['category'])){ echo "value='".$weapon['category']."'"; } }?> />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>weaponView">2) <?php echo $Lang->view;?></label>
            <input type="text" name="view" id="<?php echo $_SESSION['counter']; ?>weaponView" class="oneInputSaveWeapon<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($weapon)){ if(!empty($weapon['view'])){ echo "value='".$weapon['view']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>weaponType">3) <?php echo $Lang->type;?></label>
            <input type="text" name="type" id="<?php echo $_SESSION['counter']; ?>weaponType" class="oneInputSaveWeapon<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($weapon)){ if(!empty($weapon['type'])){ echo "value='".$weapon['type']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>weaponMark">4) <?php echo " $Lang->mark";?></label>
            <input type="text" name="model"  id="<?php echo $_SESSION['counter']; ?>weaponMark" class="oneInputSaveWeapon<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($weapon)){ if(!empty($weapon['model'])){ echo "value='".$weapon['model']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>weaponAccountNumber">5) <?php echo $Lang->account_number;?></label>
            <input type="text" name="reg_num" id="<?php echo $_SESSION['counter']; ?>weaponAccountNumber" class="oneInputSaveWeapon<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($weapon)){ if(!empty($weapon['reg_num'])){ echo "value='".$weapon['reg_num']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>weaponCount">6) <?php echo $Lang->count;?></label>
            <input type="text" name="count" id="<?php echo $_SESSION['counter']; ?>weaponCount" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>weaponCount',12)" class="oneInputSaveWeapon<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($weapon)){ if(!empty($weapon['count'])){ echo "value='".$weapon['count']."'"; } }?>/>
        </div>

        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>weaponPersonOrganization"><?php// echo $Lang->person_organization;?></label>
            <input type="text" name="person_organization" id="<?php echo $_SESSION['counter']; ?>weaponPersonOrganization" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>weaponActionsEvents"><?php// echo $Lang->actions_events;?></label>
            <input type="text" name="actions_events" id="<?php echo $_SESSION['counter']; ?>weaponActionsEvents" class="oneInputSaveEnter"/>
        </div-->

        <div class="forForm">
            <label>7) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($weapon_has)) {
                        if(!empty($weapon_has)) {
                            foreach($weapon_has as $val) {
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
    var weapon_id<?php echo $_SESSION['counter']; ?> = '<?php echo $weapon_id?>';
    <?php if(isset($weapon)) { ?>
        var checkWeapon<?php echo $_SESSION['counter']; ?> = false;
    <?php }else{ ?>
        var checkWeapon<?php echo $_SESSION['counter']; ?> = true;
    <?php } ?>


    $(document).ready(function(){

        $('.oneInputSaveWeapon<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                saveWeapon<?php echo $_SESSION['counter']; ?>(value,field);
            }else{
                saveWeapon<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>closeWeapon').click(function(e){
            e.preventDefault();
            if(checkWeapon<?php echo $_SESSION['counter']; ?>){
                var confWeapon = confirm('<?php echo $Lang->enter_anything;?>\n <?php echo $Lang->delete_entry;?>');
                if(confWeapon){
                    $.ajax({
                        url: '<?php echo ROOT?>add/weapon_delete/'+weapon_id<?php echo $_SESSION['counter']; ?>,
                        success: function(data){
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    <?php if (isset($other_tb_name)) { ?>
                        <?php if($other_tb_name == 'man') { ?>
                            man_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(weapon_id<?php echo $_SESSION['counter']; ?> , 'ok');
                        <?php }elseif($other_tb_name == 'organization') { ?>
                            organization_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(weapon_id<?php echo $_SESSION['counter']; ?> , 'ok');
                        <?php }elseif($other_tb_name == 'event') { ?>
                            event_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(weapon_id<?php echo $_SESSION['counter']; ?>,'ok');
                        <?php }elseif($other_tb_name == 'action') { ?>
                            action_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(weapon_id<?php echo $_SESSION['counter']; ?> , 'ok');
                        <?php } ?>
                    <?php } ?>
                }
            }else{
                <?php if (isset($other_tb_name)) { ?>
                    <?php if($other_tb_name == 'man') { ?>
                        man_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(weapon_id<?php echo $_SESSION['counter']; ?> , 'ok');
                    <?php }elseif($other_tb_name == 'organization') { ?>
                        organization_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(weapon_id<?php echo $_SESSION['counter']; ?> , 'ok');
                    <?php }elseif($other_tb_name == 'event') { ?>
                        event_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(weapon_id<?php echo $_SESSION['counter']; ?>,'ok');
                    <?php }elseif($other_tb_name == 'action') { ?>
                        action_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(weapon_id<?php echo $_SESSION['counter']; ?> , 'ok');
                    <?php } ?>
                <?php } ?>
            }
        });

    });

    function saveWeapon<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value,'field':field};
        $.ajax({
            url: '<?php echo ROOT?>add/weapon_save/'+weapon_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            success: function(data){
                checkWeapon<?php echo $_SESSION['counter']; ?> = false;
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
</script>
