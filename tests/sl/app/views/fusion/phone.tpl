<div class="inContent">
    <form id="phoneForm" method="post" action="<?php echo ROOT.'fusion/fusion_phone/'?>">

        <?php  //var_dump($data);die; ?>


        <div class="forForm">
            <label><?php echo $Lang->telephone.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->telephone.' '.$data[1]['id']?></label>
        </div>

        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- phone number -->
        <?php if( !empty($data[0]['number']) OR !empty($data[1]['number'])) { ?>
        <div style="text-align: center"><?php echo $Lang->phone_number; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['number'])) { ?>
                <input type="radio" name="number" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="number" value="<?php echo $data[0]['number']?>" checked ><?php echo $data[0]['number']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['number'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="number" value="" />
                <?php } else { ?>
                <?php echo $data[1]['number']?><input type="radio" name="number" value="<?php echo $data[1]['number']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="number" value=""  />
        <?php } ?>



        <!-- phone has man -->
        <?php if( !empty($data_chek['getPhoneHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->phone_owner_man ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getPhoneHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="phone_man[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- phone has organization -->
        <?php if( !empty($data_chek['getPhoneHasOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->phone_owner_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getPhoneHasOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="phone_organization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo ' ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- phone has action -->
        <?php if( !empty($data_chek['getActionHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->real_action ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="action_man[]" value="<?php echo $value['action_id'] ?>" checked /><?php echo ' ID : '.$value['action_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <?php }?>


        <div class="forForm">
            <label style="width:500px;float:left">
                <input type="submit" class="k-button" value="<?php echo $Lang->fusion?>">
            </label>
        </div>



    </form>
</div>