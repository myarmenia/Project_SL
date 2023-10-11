<div class="inContent">
    <form id="addressForm" method="post" action="<?php echo ROOT.'fusion/fusion_address/'?>">

        <?php  //var_dump($data);die; ?>

        <div class="forForm">
            <label><?php echo $Lang->address.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->address.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- region -->
        <?php if( !empty($data[0]['region_id']) OR !empty($data[1]['region_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->region; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['region_id'])) { ?>
                <input type="radio" name="region_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="region_id" value="<?php echo $data[0]['region_id']?>" checked ><?php echo $data[0]['region']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['region_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="region_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['region']?><input type="radio" name="region_id" value="<?php echo $data[1]['region_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="region_id" value=""  />
        <?php } ?>

        <!-- locality -->
        <?php if( !empty($data[0]['locality_id']) OR !empty($data[1]['locality_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->locality; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['locality_id'])) { ?>
                <input type="radio" name="locality_id" value="NULL" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="locality_id" value="<?php echo $data[0]['locality_id']?>" checked ><?php echo $data[0]['locality']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['locality_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="locality_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['locality']?><input type="radio" name="locality_id" value="<?php echo $data[1]['locality_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="locality_id" value=""  />
        <?php } ?>

        <!-- street -->
        <?php if( !empty($data[0]['street_id']) OR !empty($data[1]['street_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->street; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['street_id'])) { ?>
                <input type="radio" name="street_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="street_id" value="<?php echo $data[0]['street_id']?>" checked ><?php echo $data[0]['street']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['street_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="street_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['street']?><input type="radio" name="street_id" value="<?php echo $data[1]['street_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="street_id" value=""  />
        <?php } ?>

        <!-- track -->
        <?php if( !empty($data[0]['track']) OR !empty($data[1]['track'])) { ?>
        <div style="text-align: center"><?php echo $Lang->track; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['track'])) { ?>
                <input type="radio" name="track" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="track" value="<?php echo $data[0]['track']?>" checked ><?php echo $data[0]['track']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['track'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="track" value="" />
                <?php } else { ?>
                <?php echo $data[1]['track']?><input type="radio" name="track" value="<?php echo $data[1]['track']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="track" value=""  />
        <?php } ?>



        <!-- home_num -->
        <?php if( !empty($data[0]['home_num']) OR !empty($data[1]['home_num'])) { ?>
        <div style="text-align: center"><?php echo $Lang->home_num; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['home_num'])) { ?>
                <input type="radio" name="home_num" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="home_num" value="<?php echo $data[0]['home_num']?>" checked ><?php echo $data[0]['home_num']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['home_num'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="home_num" value="" />
                <?php } else { ?>
                <?php echo $data[1]['home_num']?><input type="radio" name="home_num" value="<?php echo $data[1]['home_num']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="home_num" value=""  />
        <?php } ?>



        <!-- housing_num -->
        <?php if( !empty($data[0]['housing_num']) OR !empty($data[1]['housing_num'])) { ?>
        <div style="text-align: center"><?php echo $Lang->housing_num; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['housing_num'])) { ?>
                <input type="radio" name="housing_num" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="housing_num" value="<?php echo $data[0]['housing_num']?>" checked ><?php echo $data[0]['housing_num']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['housing_num'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="housing_num" value="" />
                <?php } else { ?>
                <?php echo $data[1]['housing_num']?><input type="radio" name="housing_num" value="<?php echo $data[1]['housing_num']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="housing_num" value=""  />
        <?php } ?>

        <!-- apt_num -->
        <?php if( !empty($data[0]['apt_num']) OR !empty($data[1]['apt_num'])) { ?>
        <div style="text-align: center"><?php echo $Lang->apt_num; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['apt_num'])) { ?>
                <input type="radio" name="apt_num" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="apt_num" value="<?php echo $data[0]['apt_num']?>" checked ><?php echo $data[0]['apt_num']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['apt_num'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="apt_num" value="" />
                <?php } else { ?>
                <?php echo $data[1]['apt_num']?><input type="radio" name="apt_num" value="<?php echo $data[1]['apt_num']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="apt_num" value=""  />
        <?php } ?>

        <!-- country -->
        <?php if( !empty($data[0]['country_ate_id']) OR !empty($data[1]['country_ate_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->country; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['country_ate_id'])) { ?>
                <input type="radio" name="country_ate_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="country_ate_id" value="<?php echo $data[0]['country_ate_id']?>" checked ><?php echo $data[0]['country_ate']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['country_ate_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="country_ate_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['country_ate']?><input type="radio" name="country_ate_id" value="<?php echo $data[1]['country_ate_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="country_ate_id" value=""  />
        <?php } ?>



        <!-- place_held_action -->
        <?php if( !empty($data_chek['getAddressHasAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->place_held_action ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getAddressHasAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getAddressHasAction[]" value="<?php echo $value['id'] ?>" checked /><?php echo ' ID : '.$value['id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- place_held_event -->
        <?php if( !empty($data_chek['getAddressHasEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->place_held_event ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getAddressHasEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getAddressHasEvent[]" value="<?php echo $value['id'] ?>" checked /><?php echo ' ID : '.$value['id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- place_person  -->
        <?php if( !empty($data_chek['getAddressHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->place_person  ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getAddressHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getAddressHasMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- address_organization -->
        <?php if( !empty($data_chek['getAddressHasOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->address_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getAddressHasOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getAddressHasOrganization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo ' ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- seat_car -->
        <?php if( !empty($data_chek['getAddressHasCar'])) { ?>
        <div style="text-align: center"><?php echo $Lang->seat_car ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getAddressHasCar'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getAddressHasCar[]" value="<?php echo $value['car_id'] ?>" checked /><?php echo ' ID : '.$value['car_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- dummy_address_organization -->
        <?php if( !empty($data_chek['getAddressOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->dummy_address_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getAddressOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getAddressOrganization[]" value="<?php echo $value['id'] ?>" checked /><?php echo ' ID : '.$value['id']; //var_dump($value) ;?>
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

