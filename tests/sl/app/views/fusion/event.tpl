<div class="inContent">
    <form id="controlForm" method="post" action="<?php echo ROOT.'fusion/fusion_event/'?>">

        <?php // var_dump($data);die; ?>


        <div class="forForm">
            <label><?php echo $Lang->event.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->event.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- bibliography -->
        <?php if( !empty($data[0]['bibliography_id']) OR !empty($data[1]['bibliography_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->bibliography; ?></div>
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

        <!-- date_security_date -->
        <?php if( !empty($data[0]['date']) OR !empty($data[1]['date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->date_security_date ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['date'])) { ?>
                <input type="radio" name="date" value="NULL" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="date" value="<?php echo $data[0]['date']?>" checked ><?php echo $data[0]['date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['date']?><input type="radio" name="date" value="<?php echo $data[1]['date']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="date" value=""  />
        <?php } ?>

        <!-- place_event_address -->
        <?php if( !empty($data[0]['address_id']) OR !empty($data[1]['address_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->place_event_address ?></div>
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

        <!-- place_event_organization -->
        <?php if( !empty($data[0]['organization_id']) OR !empty($data[1]['organization_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->place_event_organization ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['organization_id'])) { ?>
                <input type="radio" name="organization_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="organization_id" value="<?php echo $data[0]['organization_id']?>" checked ><?php echo $data[0]['organization_id']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['v'])) { ?>
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

        <!-- ensuing_effects -->
        <?php if( !empty($data[0]['aftermath_id']) OR !empty($data[1]['aftermath_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->ensuing_effects ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['aftermath_id'])) { ?>
                <input type="radio" name="aftermath" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="aftermath" value="<?php echo $data[0]['aftermath_id']?>" checked ><?php echo $data[0]['aftermath']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['aftermath_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="aftermath" value="" />
                <?php } else { ?>
                <?php echo $data[1]['aftermath']?><input type="radio" name="aftermath" value="<?php echo $data[1]['aftermath_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="aftermath" value=""  />
        <?php } ?>

        <!-- criminal_case -->
        <?php if( !empty($data_chek['getEventHasCriminalCase'])) { ?>
        <div style="text-align: center"><?php echo $Lang->criminal_case ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getEventHasCriminalCase'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getEventHasCriminalCase[]" value="<?php echo $value['criminal_case_id'] ?>" checked /><?php echo ' ID : '.$value['criminal_case_id'] ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>


        <!-- source_event -->
        <?php if( !empty($data[0]['resource_id']) OR !empty($data[1]['resource_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->source_event ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['resource_id'])) { ?>
                <input type="radio" name="resource" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="resource" value="<?php echo $data[0]['resource_id']?>" checked ><?php echo $data[0]['resource']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['resource_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="resource" value="" />
                <?php } else { ?>
                <?php echo $data[1]['resource']?><input type="radio" name="resource" value="<?php echo $data[1]['resource_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="resource" value=""  />
        <?php } ?>

        <!-- investigation_requested -->
        <?php if( !empty($data[0]['agency_id']) OR !empty($data[1]['agency_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->investigation_requested ?></div>
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
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="agency" value=""  />
        <?php } ?>

        <!-- results_event -->
        <?php if( !empty($data[0]['result']) OR !empty($data[1]['result'])) { ?>
        <div style="text-align: center"><?php echo $Lang->results_event ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['result'])) { ?>
                <input type="radio" name="result" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="result" value="<?php echo $data[0]['result']?>" checked ><?php echo $data[0]['result']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['result'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="result" value="" />
                <?php } else { ?>
                <?php echo $data[1]['result']?><input type="radio" name="result" value="<?php echo $data[1]['result']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="result" value=""  />
        <?php } ?>

        <!-- event qualification -->

        <?php if( !empty($data_chek['getEventHasQualification'])) { ?>
        <div style="text-align: center"><?php echo $Lang->qualification_event ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getEventHasQualification'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="event_qualification[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name'] ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- event action -->
        <?php if( !empty($data_chek['getEventHasAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->involved_events_action ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getEventHasAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getEventHasAction[]" value="<?php echo $value['action_id'] ?>" checked /><?php echo ' ID : '.$value['action_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- event has signal -->
        <?php if( !empty($data_chek['getEventHasSignal'])) { ?>
        <div style="text-align: center"><?php echo $Lang->checking_signal ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getEventHasSignal'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getEventHasSignal[]" value="<?php echo $value['signal_id'] ?>" checked /><?php echo ' ID : '.$value['signal_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has event -->
        <?php if( !empty($data_chek['getEvenActionHasEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->event_associated_action ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getEvenActionHasEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getEvenActionHasEvent[]" value="<?php echo $value['action_id'] ?>" checked /><?php echo ' ID : '.$value['action_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has event -->
        <?php if( !empty($data_chek['getEventHasCar'])) { ?>
        <div style="text-align: center"><?php echo $Lang->involved_events_car ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getEventHasCar'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getEventHasCar[]" value="<?php echo $value['car_id'] ?>" checked /><?php echo ' ID : '.$value['car_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has weaphon -->
        <?php if( !empty($data_chek['getEventHasWeapon'])) { ?>
        <div style="text-align: center"><?php echo $Lang->involved_events_weapon ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getEventHasWeapon'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getEventHasWeapon[]" value="<?php echo $value['weapon_id'] ?>" checked /><?php echo ' ID : '.$value['weapon_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>


        <!-- action has organization -->
        <?php if( !empty($data_chek['getEventHasOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->place_event_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getEventHasOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getEventHasOrganization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo ' ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has organization -->
        <?php if( !empty($data_chek['getEventHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->involved_events_man ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getEventHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getEventHasMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
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