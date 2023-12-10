<div class="inContent">
    <form id="workActivityForm" method="post" action="<?php echo ROOT.'fusion/fusion_work_activity/'?>">

        <?php  //var_dump($data);die; ?>

        <div class="forForm">
            <label><?php echo $Lang->work_activity.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->work_activity.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- data_employment_persons -->
        <?php if( !empty($data[0]['man_id']) OR !empty($data[1]['man_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->data_employment_persons; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['man_id'])) { ?>
                <input type="radio" name="man_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="man_id" value="<?php echo $data[0]['man_id']?>" checked ><?php echo $data[0]['man_id']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['man_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="man_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['man_id']?><input type="radio" name="man_id" value="<?php echo $data[1]['man_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="man_id" value=""  />
        <?php } ?>

        <!-- jobs_organization -->
        <?php if( !empty($data[0]['organization_id']) OR !empty($data[1]['organization_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->jobs_organization; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['organization_id'])) { ?>
                <input type="radio" name="organization_id" value="NULL" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="organization_id" value="<?php echo $data[0]['organization_id']?>" checked ><?php echo $data[0]['organization_id']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['organization_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="organization_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['organization_id']?><input type="radio" name="organization_id" value="<?php echo $data[1]['organization_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="organization_id" value=""  />
        <?php } ?>

        <!-- position -->
        <?php if( !empty($data[0]['title']) OR !empty($data[1]['title'])) { ?>
        <div style="text-align: center"><?php echo $Lang->position; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['title'])) { ?>
                <input type="radio" name="title" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="title" value="<?php echo $data[0]['title']?>" checked ><?php echo $data[0]['title']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['title'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="title" value="" />
                <?php } else { ?>
                <?php echo $data[1]['title']?><input type="radio" name="title" value="<?php echo $data[1]['title']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="title" value=""  />
        <?php } ?>

        <!-- start_employment -->
        <?php if( !empty($data[0]['start_date']) OR !empty($data[1]['start_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->start_employment; ?></div>
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
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="start_date" value=""  />
        <?php } ?>

        <!-- end_employment -->
        <?php if( !empty($data[0]['end_date']) OR !empty($data[1]['end_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->end_employment; ?></div>
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
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="end_date" value=""  />
        <?php } ?>

        <!-- data_refer_period -->
        <?php if( !empty($data[0]['period']) OR !empty($data[1]['period'])) { ?>
        <div style="text-align: center"><?php echo $Lang->data_refer_period; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['period'])) { ?>
                <input type="radio" name="period" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="period" value="<?php echo $data[0]['period']?>" checked ><?php echo $data[0]['period']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['period'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="period" value="" />
                <?php } else { ?>
                <?php echo $data[1]['period']?><input type="radio" name="period" value="<?php echo $data[1]['period']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="period" value=""  />
        <?php } ?>

        <div class="forForm">
            <label style="width:500px;float:left">
                <input type="submit" class="k-button" value="<?php echo $Lang->fusion?>">
            </label>
        </div>



    </form>
</div>