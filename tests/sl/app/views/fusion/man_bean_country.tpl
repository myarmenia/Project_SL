<div class="inContent">
    <form id="controlForm" method="post" action="<?php echo ROOT.'fusion/fusion_man_bean_country/'?>">

        <?php // var_dump($data);die; ?>


        <div class="forForm">
            <label><?php echo $Lang->man_bean_country.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->man_bean_country.' '.$data[1]['id']?></label>
        </div>

        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- information_presence -->
        <?php if( !empty($data[0]['man_id']) OR !empty($data[1]['man_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->information_presence; ?></div>
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
        <?php }else{ ?>
                <input type="hidden" name="man_id" value=""  />
                <?php } ?>

        <!-- country_ate -->
        <?php if( !empty($data[0]['country_ate_id']) OR !empty($data[1]['country_ate_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->country_ate; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['country_ate_id'])) { ?>
                <input type="radio" name="country_ate" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="country_ate" value="<?php echo $data[0]['country_ate_id']?>" checked ><?php echo $data[0]['country_ate']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['country_ate_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="country_ate" value="" />
                <?php } else { ?>
                <?php echo $data[1]['country_ate']?><input type="radio" name="country_ate" value="<?php echo $data[1]['country_ate_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
                <input type="hidden" name="country_ate" value=""  />
                <?php } ?>

        <!-- purpose_visit -->
        <?php if( !empty($data[0]['goal_id']) OR !empty($data[1]['goal_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->purpose_visit; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['goal_id'])) { ?>
                <input type="radio" name="goal" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="goal" value="<?php echo $data[0]['goal_id']?>" checked ><?php echo $data[0]['goal']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['goal_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="goal" value="" />
                <?php } else { ?>
                <?php echo $data[1]['goal']?><input type="radio" name="goal" value="<?php echo $data[1]['goal_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
                <input type="hidden" name="goal" value=""  />
                <?php } ?>

        <!-- entry_date -->
        <?php if( !empty($data[0]['entry_date']) OR !empty($data[1]['entry_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->entry_date; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['entry_date'])) { ?>
                <input type="radio" name="entry_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="entry_date" value="<?php echo $data[0]['entry_date']?>" checked ><?php echo $data[0]['entry_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['entry_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="entry_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['entry_date']?><input type="radio" name="entry_date" value="<?php echo $data[1]['entry_date']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
                <input type="hidden" name="entry_date" value=""  />
                <?php } ?>

        <!-- exit_date -->
        <?php if( !empty($data[0]['exit_date']) OR !empty($data[1]['exit_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->exit_date; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['exit_date'])) { ?>
                <input type="radio" name="exit_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="exit_date" value="<?php echo $data[0]['exit_date']?>" checked ><?php echo $data[0]['exit_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['exit_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="exit_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['exit_date']?><input type="radio" name="exit_date" value="<?php echo $data[1]['exit_date']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
                <input type="hidden" name="exit_date" value=""  />
                <?php } ?>

        <!-- region_local -->
        <?php if( !empty($data[0]['region_id']) OR !empty($data[1]['region_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->region_local; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['region_id'])) { ?>
                <input type="radio" name="region" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="region" value="<?php echo $data[0]['region_id']?>" checked ><?php echo $data[0]['region']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['region_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="region" value="" />
                <?php } else { ?>
                <?php echo $data[1]['region']?><input type="radio" name="region" value="<?php echo $data[1]['region_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
                <input type="hidden" name="region" value=""  />
                <?php } ?>

        <!-- locality_local -->
        <?php if( !empty($data[0]['locality_id']) OR !empty($data[1]['locality_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->locality_local; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['locality_id'])) { ?>
                <input type="radio" name="locality" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="locality" value="<?php echo $data[0]['locality_id']?>" checked ><?php echo $data[0]['locality']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['locality_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="locality" value="" />
                <?php } else { ?>
                <?php echo $data[1]['locality']?><input type="radio" name="locality" value="<?php echo $data[1]['locality_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
                <input type="hidden" name="locality" value=""  />
                <?php } ?>

        <div class="forForm">
            <label style="width:500px;float:left">
                <input type="submit"  class="k-button" value="<?php echo $Lang->fusion?>">
            </label>
        </div>


    </form>
</div>