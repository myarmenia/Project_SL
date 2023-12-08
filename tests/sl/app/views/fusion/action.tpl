<div class="inContent">
    <form id="actionForm" method="post" action="<?php echo ROOT.'fusion/fusion_action/'?>">

        <?php  //var_dump($data);die; ?>


        <div class="forForm">
            <label><?php echo $Lang->action.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->action.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- start_action_date -->
        <?php if( !empty($data[0]['start_date']) OR !empty($data[1]['start_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->start_action_date; ?></div>
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

        <!-- end_action_date -->
        <?php if( !empty($data[0]['end_date']) OR !empty($data[1]['end_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->end_action_date ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['end_date'])) { ?>
                <input type="radio" name="end_date" value="NULL" checked /><?php echo $Lang->empty; ?>
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

        <!-- place_event_address -->
        <?php if( !empty($data[0]['duration_id']) OR !empty($data[1]['duration_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->place_event_address ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['duration_id'])) { ?>
                <input type="radio" name="duration_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="duration_id" value="<?php echo $data[0]['duration_id']?>" checked ><?php echo $data[0]['duration']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['duration_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="duration_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['duration']?><input type="radio" name="duration_id" value="<?php echo $data[1]['duration_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="duration_id" value=""  />
        <?php } ?>

        <!-- duration_action -->
        <?php if( !empty($data[0]['organization_id']) OR !empty($data[1]['organization_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->duration_action ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['organization_id'])) { ?>
                <input type="radio" name="organization_id" value="" checked /><?php echo $Lang->empty; ?>
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



        <!-- purpose_motive_reason -->
        <?php if( !empty($data[0]['goal_id']) OR !empty($data[1]['goal_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->purpose_motive_reason ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['goal_id'])) { ?>
                <input type="radio" name="goal_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="goal_id" value="<?php echo $data[0]['goal_id']?>" checked ><?php echo $data[0]['action_goal']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['goal_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="goal_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['action_goal']?><input type="radio" name="goal_id" value="<?php echo $data[1]['goal_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="goal_id" value=""  />
        <?php } ?>



        <!-- terms_actions -->
        <?php if( !empty($data[0]['terms_id']) OR !empty($data[1]['terms_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->terms_actions ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['terms_id'])) { ?>
                <input type="radio" name="terms_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="terms_id" value="<?php echo $data[0]['terms_id']?>" checked ><?php echo $data[0]['terms']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['terms_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="terms_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['terms']?><input type="radio" name="terms_id" value="<?php echo $data[1]['terms_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="terms_id" value=""  />
        <?php } ?>

        <!-- ensuing_effects -->
        <?php if( !empty($data[0]['aftermath_id']) OR !empty($data[1]['aftermath_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->ensuing_effects ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['aftermath_id'])) { ?>
                <input type="radio" name="aftermath_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="aftermath_id" value="<?php echo $data[0]['aftermath_id']?>" checked ><?php echo $data[0]['aftermath']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['aftermath_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="aftermath_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['resource']?><input type="radio" name="aftermath_id" value="<?php echo $data[1]['aftermath_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="aftermath_id" value=""  />
        <?php } ?>

        <!-- bibliography -->
        <?php if( !empty($data[0]['bibliography_id']) OR !empty($data[1]['bibliography_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->bibliography ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['bibliography_id'])) { ?>
                <input type="radio" name="bibliography_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="bibliography_id" value="<?php echo $data[0]['bibliography_id']?>" checked ><?php echo $data[0]['bibliography_id']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['bibliography_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="bibliography_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['bibliography_id']?><input type="radio" name="bibliography_id" value="<?php echo $data[1]['bibliography_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="bibliography_id" value=""  />
        <?php } ?>

        <!-- source_information_actions -->
        <?php if( !empty($data[0]['source']) OR !empty($data[1]['source'])) { ?>
        <div style="text-align: center"><?php echo $Lang->source_information_actions ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['source'])) { ?>
                <input type="radio" name="source" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="source" value="<?php echo $data[0]['source']?>" checked ><?php echo $data[0]['source']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['source'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="source" value="" />
                <?php } else { ?>
                <?php echo $data[1]['source']?><input type="radio" name="source" value="<?php echo $data[1]['source']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="source" value=""  />
        <?php } ?>

        <!-- place_action -->
        <?php if( !empty($data[0]['address_id']) OR !empty($data[1]['address_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->place_action ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['address_id'])) { ?>
                <input type="radio" name="address_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="address_id" value="<?php echo $data[0]['address_id']?>" checked ><?php echo $data[0]['address_id']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['address_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="address_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['address_id']?><input type="radio" name="address_id" value="<?php echo $data[1]['address_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="address_id" value=""  />
        <?php } ?>

        <!-- action_related_event_action -->
        <?php if( !empty($data_chek['getActionToAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->action_related_event_action ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionToAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionToAction[]" value="<?php echo $value['action_id'] ?>" checked /><?php echo ' ID : '.$value['action_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- criminal_case -->
        <?php if( !empty($data_chek['getActionHasCriminalCase'])) { ?>
        <div style="text-align: center"><?php echo $Lang->criminal_case ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionHasCriminalCase'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionHasCriminalCase[]" value="<?php echo $value['criminal_case_id'] ?>" checked /><?php echo ' ID : '.$value['criminal_case_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- opened_dou -->
        <?php if( !empty($data[0]['opened_dou']) OR !empty($data[1]['opened_dou'])) { ?>
        <div style="text-align: center"><?php echo $Lang->opened_dou ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['opened_dou'])) { ?>
                <input type="radio" name="opened_dou" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="opened_dou" value="<?php echo $data[0]['opened_dou']?>" checked ><?php echo $data[0]['opened_dou']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['opened_dou'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="opened_dou" value="" />
                <?php } else { ?>
                <?php echo $data[1]['opened_dou']?><input type="radio" name="opened_dou" value="<?php echo $data[1]['opened_dou']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="opened_dou" value=""  />
        <?php } ?>

        <!-- qualification_fact -->
        <?php if( !empty($data_chek['getActionHasQualification'])) { ?>
        <div style="text-align: center"><?php echo $Lang->qualification_fact ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionHasQualification'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionHasQualification[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>



        <!-- action_related_event_event -->
        <?php if( !empty($data_chek['getActionHasEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->action_related_event_event ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionHasEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionHasEvent[]" value="<?php echo $value['event_id'] ?>" checked /><?php echo ' ID : '.$value['event_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- object_action_event -->
        <?php if( !empty($data_chek['getActionEventHasAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->object_action_event ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionEventHasAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionEventHasAction[]" value="<?php echo $value['event_id'] ?>" checked /><?php echo ' ID : '.$value['event_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has man -->
        <?php if( !empty($data_chek['getActionHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->object_action_man ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionHasMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has organization -->
        <?php if( !empty($data_chek['getActionHasOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->object_action_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionHasOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionHasOrganization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo ' ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has phone -->
        <?php if( !empty($data_chek['getActionHasPhone'])) { ?>
        <div style="text-align: center"><?php echo $Lang->object_action_phone ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionHasPhone'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionHasPhone[]" value="<?php echo $value['phone_id'] ?>" checked /><?php echo ' ID : '.$value['phone_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has weapon -->
        <?php if( !empty($data_chek['getActionHasWeapon'])) { ?>
        <div style="text-align: center"><?php echo $Lang->object_action_weapon ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionHasWeapon'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionHasWeapon[]" value="<?php echo $value['weapon_id'] ?>" checked /><?php echo ' ID : '.$value['weapon_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has car -->
        <?php if( !empty($data_chek['getActionHasCar'])) { ?>
        <div style="text-align: center"><?php echo $Lang->object_action_car ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionHasCar'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionHasCar[]" value="<?php echo $value['car_id'] ?>" checked /><?php echo ' ID : '.$value['car_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action passes signal -->
        <?php if( !empty($data_chek['getActionPassesSignal'])) { ?>
        <div style="text-align: center"><?php echo $Lang->checking_signal ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionPassesSignal'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getActionPassesSignal[]" value="<?php echo $value['signal_id'] ?>" checked /><?php echo ' ID : '.$value['signal_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has material content -->
        <?php if( !empty($data_chek['getActionHasMaterialContent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->content_materials_actions ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getActionHasMaterialContent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="material_content[]" value="<?php echo $value['id'] ?>" checked /><?php echo ' ID : '.$value['content']; //var_dump($value) ;?>
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