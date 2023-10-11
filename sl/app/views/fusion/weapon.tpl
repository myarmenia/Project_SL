<div class="inContent">
    <form id="weaponForm" method="post" action="<?php echo ROOT.'fusion/fusion_weapon/'?>">

        <?php  //var_dump($data);die; ?>

        <div class="forForm">
            <label><?php echo $Lang->weapon.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->weapon.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- category -->
        <?php if( !empty($data[0]['category']) OR !empty($data[1]['category'])) { ?>
        <div style="text-align: center"><?php echo $Lang->weapon_cat; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['category'])) { ?>
                <input type="radio" name="category" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="category" value="<?php echo $data[0]['category']?>" checked ><?php echo $data[0]['category']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['category'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="category" value="" />
                <?php } else { ?>
                <?php echo $data[1]['category']?><input type="radio" name="category" value="<?php echo $data[1]['category']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="category" value=""  />
        <?php } ?>

        <!-- view -->
        <?php if( !empty($data[0]['view']) OR !empty($data[1]['view'])) { ?>
        <div style="text-align: center"><?php echo $Lang->view; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['view'])) { ?>
                <input type="radio" name="view" value="NULL" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="view" value="<?php echo $data[0]['view']?>" checked ><?php echo $data[0]['view']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['view'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="view" value="" />
                <?php } else { ?>
                <?php echo $data[1]['view']?><input type="radio" name="view" value="<?php echo $data[1]['view']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="view" value=""  />
        <?php } ?>

        <!-- type -->
        <?php if( !empty($data[0]['type']) OR !empty($data[1]['type'])) { ?>
        <div style="text-align: center"><?php echo $Lang->type; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['type'])) { ?>
                <input type="radio" name="type" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="type" value="<?php echo $data[0]['type']?>" checked ><?php echo $data[0]['type']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['type'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="type" value="" />
                <?php } else { ?>
                <?php echo $data[1]['type']?><input type="radio" name="type" value="<?php echo $data[1]['type']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="type" value=""  />
        <?php } ?>

        <!-- mark -->
        <?php if( !empty($data[0]['model']) OR !empty($data[1]['model'])) { ?>
        <div style="text-align: center"><?php echo $Lang->mark; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['model'])) { ?>
                <input type="radio" name="model" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="model" value="<?php echo $data[0]['model']?>" checked ><?php echo $data[0]['model']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['model'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="model" value="" />
                <?php } else { ?>
                <?php echo $data[1]['model']?><input type="radio" name="model" value="<?php echo $data[1]['model']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="model" value=""  />
        <?php } ?>



        <!-- account_number -->
        <?php if( !empty($data[0]['reg_num']) OR !empty($data[1]['reg_num'])) { ?>
        <div style="text-align: center"><?php echo $Lang->account_number; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['reg_num'])) { ?>
                <input type="radio" name="reg_num" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="reg_num" value="<?php echo $data[0]['reg_num']?>" checked ><?php echo $data[0]['reg_num']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['reg_num'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="reg_num" value="" />
                <?php } else { ?>
                <?php echo $data[1]['reg_num']?><input type="radio" name="reg_num" value="<?php echo $data[1]['reg_num']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="reg_num" value=""  />
        <?php } ?>



        <!-- count -->
        <?php if( !empty($data[0]['count']) OR !empty($data[1]['count'])) { ?>
        <div style="text-align: center"><?php echo $Lang->count; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['count'])) { ?>
                <input type="radio" name="count" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="count" value="<?php echo $data[0]['count']?>" checked ><?php echo $data[0]['count']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['count'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="count" value="" />
                <?php } else { ?>
                <?php echo $data[1]['count']?><input type="radio" name="count" value="<?php echo $data[1]['count']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="count" value=""  />
        <?php } ?>



        <!-- person_organization_man -->
        <?php if( !empty($data_chek['getWeaponHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->person_organization_man ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getWeaponHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getWeaponHasMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- person_organization_organization -->
        <?php if( !empty($data_chek['getWeaponHasOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->person_organization_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getWeaponHasOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getWeaponHasOrganization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo ' ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- real_action  -->
        <?php if( !empty($data_chek['getWeaponHasAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->real_action  ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getWeaponHasAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getWeaponHasAction[]" value="<?php echo $value['action_id'] ?>" checked /><?php echo ' ID : '.$value['action_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- real_event -->
        <?php if( !empty($data_chek['getWeaponHasEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->real_event ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getWeaponHasEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getWeaponHasEvent[]" value="<?php echo $value['event_id'] ?>" checked /><?php echo ' ID : '.$value['event_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <?php }?>


        <div class="forForm">
            <label style="width:500px;float:left">
                <input type="submit"  class="k-button" value="<?php echo $Lang->fusion?>">
            </label>
        </div>



    </form>
</div>