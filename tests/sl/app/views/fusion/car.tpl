<div class="inContent">
    <form id="carForm" method="post" action="<?php echo ROOT.'fusion/fusion_car/'?>">

        <?php  //var_dump($data);die; ?>

        <div class="forForm">
            <label><?php echo $Lang->car.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->car.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- car_number -->
        <?php if( !empty($data[0]['number']) OR !empty($data[1]['number'])) { ?>
        <div style="text-align: center"><?php echo $Lang->car_number; ?></div>
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

        <!-- note -->
        <?php if( !empty($data[0]['note']) OR !empty($data[1]['note'])) { ?>
        <div style="text-align: center"><?php echo $Lang->additional_data; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['note'])) { ?>
                <input type="radio" name="note" value="NULL" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="note" value="<?php echo $data[0]['note']?>" checked ><?php echo $data[0]['note']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['note'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="note" value="" />
                <?php } else { ?>
                <?php echo $data[1]['note']?><input type="radio" name="note" value="<?php echo $data[1]['note']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="note" value=""  />
        <?php } ?>

        <!-- category -->
        <?php if( !empty($data[0]['category_id']) OR !empty($data[1]['category_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->car_cat; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['category_id'])) { ?>
                <input type="radio" name="category_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="category_id" value="<?php echo $data[0]['category_id']?>" checked ><?php echo $data[0]['category']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['category_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="category_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['category']?><input type="radio" name="category_id" value="<?php echo $data[1]['category_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="category_id" value=""  />
        <?php } ?>

        <!-- mark -->
        <?php if( !empty($data[0]['mark_id']) OR !empty($data[1]['mark_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->mark; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['mark_id'])) { ?>
                <input type="radio" name="mark_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="mark_id" value="<?php echo $data[0]['mark_id']?>" checked ><?php echo $data[0]['mark']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['mark_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="mark_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['mark']?><input type="radio" name="mark_id" value="<?php echo $data[1]['mark_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="mark_id" value=""  />
        <?php } ?>



        <!-- color -->
        <?php if( !empty($data[0]['color_id']) OR !empty($data[1]['color_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->color; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['color_id'])) { ?>
                <input type="radio" name="color_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="color_id" value="<?php echo $data[0]['color_id']?>" checked ><?php echo $data[0]['color']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['color_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="color_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['color']?><input type="radio" name="color_id" value="<?php echo $data[1]['color_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="color_id" value=""  />
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
        <?php if( !empty($data_chek['getCarHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->person_organization_man ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCarHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCarHasMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- person_organization_organization -->
        <?php if( !empty($data_chek['getCarHasOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->person_organization_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCarHasOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCarHasOrganization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo ' ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- person_address_man -->
        <?php if( !empty($data_chek['getCarUseMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->person_address_man ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCarUseMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCarUseMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has organization -->
        <?php if( !empty($data_chek['getCarHasAddress'])) { ?>
        <div style="text-align: center"><?php echo $Lang->object_action_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCarHasAddress'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCarHasAddress[]" value="<?php echo $value['address_id'] ?>" checked /><?php echo ' ID : '.$value['address_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- actions_events_action  -->
        <?php if( !empty($data_chek['getCarHasAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->actions_events_action  ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCarHasAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCarHasAction[]" value="<?php echo $value['action_id'] ?>" checked /><?php echo ' ID : '.$value['action_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- actions_events_event -->
        <?php if( !empty($data_chek['getCarHasEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->actions_events_event ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCarHasEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCarHasEvent[]" value="<?php echo $value['event_id'] ?>" checked /><?php echo ' ID : '.$value['event_id']; //var_dump($value) ;?>
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