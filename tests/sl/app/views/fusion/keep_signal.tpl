<div class="inContent">
    <form id="controlForm" method="post" action="<?php echo ROOT.'fusion/fusion_keep_signal/'?>">

        <?php // var_dump($data);die; ?>


        <div class="forForm">
            <label><?php echo $Lang->keep_signal.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->keep_signal.' '.$data[1]['id']?></label>
        </div>

        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- refers_signal -->
        <?php if( !empty($data[0]['signal_id']) OR !empty($data[1]['signal_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->refers_signal; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['signal_id'])) { ?>
                <input type="radio" name="signal_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="signal_id" value="<?php echo $data[0]['signal_id']?>" checked ><?php echo $data[0]['signal_id']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['signal_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="signal_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['signal_id']?><input type="radio" name="signal_id" value="<?php echo $data[1]['signal_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="signal_id" value=""  />
        <?php } ?>

        <!-- start_checking_signal -->
        <?php if( !empty($data[0]['start_date']) OR !empty($data[1]['start_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->start_checking_signal ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['start_date'])) { ?>
                <input type="radio" name="start_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="start_date" value="<?php echo $data[0]['start_date']?>" checked ><?php echo $data[0]['start_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['start_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="start_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['start_date']?><input type="radio" name="start_date" value="<?php echo $data[1]['start_date']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="start_date" value=""  />
        <?php } ?>

        <!-- end_checking_signal -->
        <?php if( !empty($data[0]['end_date']) OR !empty($data[1]['end_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->end_checking_signal ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['end_date'])) { ?>
                <input type="radio" name="end_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="end_date" value="<?php echo $data[0]['end_date']?>" checked ><?php echo $data[0]['end_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['end_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="end_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['end_date']?><input type="radio" name="end_date" value="<?php echo $data[1]['end_date']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="end_date" value=""  />
        <?php } ?>

        <!-- date_transfer_unit -->
        <?php if( !empty($data[0]['pass_date']) OR !empty($data[1]['pass_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->date_transfer_unit ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['pass_date'])) { ?>
                <input type="radio" name="pass_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="pass_date" value="<?php echo $data[0]['pass_date']?>" checked ><?php echo $data[0]['pass_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['pass_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="pass_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['pass_date']?><input type="radio" name="pass_date" value="<?php echo $data[1]['pass_date']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="pass_date" value=""  />
        <?php } ?>

        <!-- unit_signal_transmitted -->
        <?php if( !empty($data[0]['pased_sub_unit']) OR !empty($data[1]['pased_sub_unit'])) { ?>
        <div style="text-align: center"><?php echo $Lang->unit_signal_transmitted ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['pased_sub_unit'])) { ?>
                <input type="radio" name="pased_sub_unit" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="pased_sub_unit" value="<?php echo $data[0]['pased_sub_unit']?>" checked ><?php echo $data[0]['pased_sub_unit_name']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['pased_sub_unit'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="pased_sub_unit" value="" />
                <?php } else { ?>
                <?php echo $data[1]['pased_sub_unit']?><input type="radio" name="pased_sub_unit" value="<?php echo $data[1]['pased_sub_unit_name']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="pased_sub_unit" value=""  />
        <?php } ?>

        <!-- management_signal -->
        <?php if( !empty($data[0]['agency_id']) OR !empty($data[1]['agency_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->management_signal ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['agency_id'])) { ?>
                <input type="radio" name="agency" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="agency" value="<?php echo $data[0]['agency_id']?>" checked ><?php echo $data[0]['agency']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['agency_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="agency" value="" />
                <?php } else { ?>
                <?php echo $data[1]['agency']?><input type="radio" name="agency" value="<?php echo $data[1]['agency_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="agency" value=""  />
        <?php } ?>

        <!-- department_checking_signal -->
        <?php if( !empty($data[0]['unit_id']) OR !empty($data[1]['unit_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->department_checking_signal ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['unit_id'])) { ?>
                <input type="radio" name="unit" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="unit" value="<?php echo $data[0]['unit_id']?>" checked ><?php echo $data[0]['unit']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['unit_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="unit" value="" />
                <?php } else { ?>
                <?php echo $data[1]['unit']?><input type="radio" name="unit" value="<?php echo $data[1]['unit_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="unit" value=""  />
        <?php } ?>

        <!-- unit_signal -->
        <?php if( !empty($data[0]['sub_unit_id']) OR !empty($data[1]['sub_unit_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->unit_signal ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['sub_unit_id'])) { ?>
                <input type="radio" name="sub_unit" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="sub_unit" value="<?php echo $data[0]['sub_unit_id']?>" checked ><?php echo $data[0]['sub_unit']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['sub_unit_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="sub_unit" value="" />
                <?php } else { ?>
                <?php echo $data[1]['sub_unit']?><input type="radio" name="sub_unit" value="<?php echo $data[1]['sub_unit_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="sub_unit" value=""  />
        <?php } ?>


        <?php if( !empty($keep_signal_worker)) { ?>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <div style="text-align: center"><?php echo $Lang->name_operatives ?></div>
        <div class="forForm">
            <?php foreach($keep_signal_worker as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="worker[]" value="<?php echo $value['worker'] ?>" checked /><?php echo $value['worker']?>
            </label>
            <?php }?>
        </div>
        <?php }?>

        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php if( !empty($keep_signal_worker_post)) { ?>
        <div style="text-align: center"><?php echo $Lang->worker_post ?></div>
        <div class="forForm">
            <?php foreach($keep_signal_worker_post as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="worker_post[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']?>
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