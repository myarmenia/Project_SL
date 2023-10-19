<div class="inContent">
    <form id="OrganizationForm" method="post" action="<?php echo ROOT.'fusion/fusion_organization/'?>">
        <?php  //var_dump($data);die; ?>
        <div class="forForm">
            <label><?php echo $Lang->organization.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->organization.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- country_id -->
        <?php if( !empty($data[0]['country_id']) OR !empty($data[1]['country_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->nation; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['country_id'])) { ?>
                <input type="radio" name="country_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="country_id" value="<?php echo $data[0]['country_id']?>" checked ><?php echo $data[0]['country']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['country_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="country_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['country']?><input type="radio" name="country_id" value="<?php echo $data[1]['country_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="country_id" value=""  />
        <?php } ?>

        <!-- name -->
        <?php if( !empty($data[0]['name']) OR !empty($data[1]['name'])) { ?>
        <div style="text-align: center"><?php echo $Lang->name_organization ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['name'])) { ?>
                <input type="radio" name="name" value="NULL" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="name" value="<?php echo $data[0]['name']?>" checked ><?php echo $data[0]['name']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['name'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="name" value="" />
                <?php } else { ?>
                <?php echo $data[1]['name']?><input type="radio" name="name" value="<?php echo $data[1]['name']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="name" value=""  />
        <?php } ?>

        <!-- reg_date -->
        <?php if( !empty($data[0]['reg_date']) OR !empty($data[1]['reg_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->date_formation ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['reg_date'])) { ?>
                <input type="radio" name="reg_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="reg_date" value="<?php echo $data[0]['reg_date']?>" checked ><?php echo $data[0]['reg_date'];?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['reg_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="reg_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['reg_date'];?><input type="radio" name="reg_date" value="<?php echo $data[1]['reg_date']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="reg_date" value=""  />
        <?php } ?>

        <!-- address_id -->
        <?php if( !empty($data[0]['address_id']) OR !empty($data[1]['address_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->short_address ?></div>
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

        <!-- known_as_organization_id -->
        <?php if( !empty($data_chek['getOrganizationToOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->also_known_as; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationToOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getOrganizationToOrganization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo 'ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>



        <!-- criminal_case -->
        <?php if( !empty($data[0]['category_id']) OR !empty($data[1]['category_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->category_organization ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['category_id'])) { ?>
                <input type="radio" name="category_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="category_id" value="<?php echo $data[0]['category_id']?>" checked ><?php echo $data[0]['organization_category']; ?>
                <input type="hidden" name="category_id" value="<?php echo $data[1]['category_id']?>" />
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['category_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="category_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['organization_category'];?><input type="radio" name="category_id" value="<?php echo $data[1]['category_id']?>" />
                <input type="hidden" name="category_id" value="<?php echo $data[1]['category_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="category_id" value=""  />
        <?php } ?>

        <!-- employers_count -->
        <?php if( !empty($data[0]['employers_count']) OR !empty($data[1]['employers_count'])) { ?>
        <div style="text-align: center"><?php echo $Lang->number_worker ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['attention'])) { ?>
                <input type="radio" name="employers_count" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="employers_count" value="<?php echo $data[0]['employers_count']?>" checked ><?php echo $data[0]['employers_count']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['employers_count'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="employers_count" value="" />
                <?php } else { ?>
                <?php echo $data[1]['employers_count']?><input type="radio" name="employers_count" value="<?php echo $data[1]['employers_count']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="employers_count" value=""  />
        <?php } ?>

        <!-- attension -->
        <?php if( !empty($data[0]['attension']) OR !empty($data[1]['attension'])) { ?>
        <div style="text-align: center"><?php echo $Lang->attention ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['attension'])) { ?>
                <input type="radio" name="attension" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="attension" value="<?php echo $data[0]['attension']?>" checked ><?php echo $data[0]['attension']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['attension'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="attension" value="" />
                <?php } else { ?>
                <?php echo $data[1]['attension']?><input type="radio" name="attension" value="<?php echo $data[1]['attension']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="attension" value=""  />
        <?php } ?>

        <!-- opened_dou -->
        <?php if( !empty($data[0]['opened_dou']) OR !empty($data[1]['opened_dou'])) { ?>
        <div style="text-align: center"><?php echo $Lang->organization_dow ?></div>
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

        <!-- country_ate_id -->
        <?php if( !empty($data[0]['country_ate_id']) OR !empty($data[1]['country_ate_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->region_activity ?></div>
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

        <!-- agency_id -->
        <?php if( !empty($data[0]['agency_id']) OR !empty($data[1]['agency_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->declared_wanted_list_with ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['agency_id'])) { ?>
                <input type="radio" name="agency_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="agency_id" value="<?php echo $data[0]['agency_id']?>" checked ><?php echo $data[0]['agency']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['agency_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="agency_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['agency']?><input type="radio" name="agency_id" value="<?php echo $data[1]['agency_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="agency_id" value=""  />
        <?php } ?>



        <!-- getOrganizationHasAddress -->
        <?php if( !empty($data_chek['getOrganizationHasAddress'])) { ?>
        <div style="text-align: center"><?php echo $Lang->dislocation_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationHasAddress'] as $key=>$value){ ?>
            <label style="text-align: center">
                <input id="organization_has_address_<?php echo $key; ?>" type="checkbox" name="getOrganizationHasAddress[<?php echo $key; ?>][]" value="<?php echo $value['address_id'] ?>" checked /><?php echo $value['address_id'] ; //var_dump($value) ;?>
                <input id="organization_has_address_start_<?php echo $key; ?>" type="hidden" name="getOrganizationHasAddress[<?php echo $key; ?>][]" value="<?php echo $value['start_date'] ?>" checked />
                <input id="organization_has_address_end_<?php echo $key; ?>" type="hidden" name="getOrganizationHasAddress[<?php echo $key; ?>][]" value="<?php echo $value['end_date'] ?>" checked />
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationHasPhone -->
        <?php if( !empty($data_chek['getOrganizationHasPhone'])) { ?>
        <div style="text-align: center"><?php echo $Lang->phone_number ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationHasPhone'] as $key=>$value){ ?>
            <label style="text-align: center">
                <input id="organization_has_man_<?php echo $key; ?>" type="checkbox" name="getOrganizationHasPhone[<?php echo $key; ?>][]" value="<?php echo $value['phone_id'] ?>" checked /><?php echo $value['number']; //var_dump($value) ;?>
                <input id="organization_has_man_charecter_id_<?php echo $key; ?>" type="hidden" name="getOrganizationHasPhone[<?php echo $key; ?>][]" value="<?php echo $value['character_id'] ?>" checked />
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationHasEmail -->
        <?php if( !empty($data_chek['getOrganizationHasEmail'])) { ?>
        <div style="text-align: center"><?php echo $Lang->email ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationHasEmail'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getOrganizationHasEmail[]" value="<?php echo $value['email_id'] ?>" checked /><?php echo $value['address']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationHasEvent -->
        <?php if( !empty($data_chek['getOrganizationHasEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->involved_the_events ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationHasEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getOrganizationHasEvent[]" value="<?php echo $value['event_id'] ?>" checked /><?php echo $value['event_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationObjectsRelation -->
        <?php if( !empty($data_chek['getOrganizationObjectsRelation'])) { ?>
        <div style="text-align: center"><?php echo $Lang->relation_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationObjectsRelation'] as $key=>$value){ ?>
            <label style="text-align: center">
                <input id="organization_object_relation_<?php echo $key?>" type="checkbox" name="getOrganizationObjectsRelation[<?php echo $key?>][]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
                <input id="organization_object_relation_relation_type_id_<?php echo $key?>" type="hidden" name="getOrganizationObjectsRelation[<?php echo $key?>][]" value="<?php echo $value['relation_type_id'] ?>" checked />
                <?php if(($value['first_object_id'] != $data[0]['id'] )&&($value['first_object_id'] != $data[1]['id'] )) { ?>
                <input id="organization_object_relation_first_object_id_<?php echo $key?>" type="hidden" name="getOrganizationObjectsRelation[<?php echo $key?>][]" value="<?php echo $value['first_object_id'] ?>" checked />
                <?php }else{ ?>
                <input id="organization_object_relation_second_object_id_<?php echo $key?>" type="hidden" name="getOrganizationObjectsRelation[<?php echo $key?>][]" value="<?php echo $value['second_object_id'] ?>" checked />
                <?php }?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationHasCriminalCase -->
        <?php if( !empty($data_chek['getOrganizationHasCriminalCase'])) { ?>
        <div style="text-align: center"><?php echo $Lang->passes_criminal_case ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationHasCriminalCase'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getOrganizationHasCriminalCase[]" value="<?php echo $value['criminal_case_id'] ?>" checked /><?php echo $value['criminal_case_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationHasAction -->
        <?php if( !empty($data_chek['getOrganizationHasAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->object_actions ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationHasAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getOrganizationHasAction[]" value="<?php echo $value['action_id'] ?>" checked /><?php echo $value['action_id'] ; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationHasMan -->
        <?php if( !empty($data_chek['getOrganizationHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->work_activity ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationHasMan'] as $key=>$value){ ?>
            <label style="text-align: center">
                <input id="organization_has_man_<?php echo $key; ?>" type="checkbox" name="getOrganizationHasMan[<?php echo $key; ?>][]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id'] ; //var_dump($value) ;?>
                <input id="organization_has_man_man_id_<?php echo $key; ?>" type="hidden" name="getOrganizationHasMan[<?php echo $key; ?>][]" value="<?php echo $value['man_id'] ?>" checked />
                <input id="organization_has_man_title_<?php echo $key; ?>" type="hidden" name="getOrganizationHasMan[<?php echo $key; ?>][]" value="<?php echo $value['title'] ?>" checked />
                <input id="organization_has_man_start_<?php echo $key; ?>" type="hidden" name="getOrganizationHasMan[<?php echo $key; ?>][]" value="<?php echo $value['start_date'] ?>" checked />
                <input id="organization_has_man_end_<?php echo $key; ?>" type="hidden" name="getOrganizationHasMan[<?php echo $key; ?>][]" value="<?php echo $value['end_date'] ?>" checked />
                <input id="organization_has_man_period_<?php echo $key; ?>" type="hidden" name="getOrganizationHasMan[<?php echo $key; ?>][]" value="<?php echo $value['period'] ?>" checked />
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationCheckedBySignal -->
        <?php if( !empty($data_chek['getOrganizationCheckedBySignal'])) { ?>
        <div style="text-align: center"><?php echo $Lang->checked_signal ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationCheckedBySignal'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getOrganizationCheckedBySignal[]" value="<?php echo $value['signal_id'] ?>" checked /><?php echo $value['signal_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationPassesBySignal -->
        <?php if( !empty($data_chek['getOrganizationPassesBySignal'])) { ?>
        <div style="text-align: center"><?php echo $Lang->passes_signal ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationPassesBySignal'] as $value){ ?>
            <label style="text-align: center">
                <input id="getMoreDateMan_id" type="checkbox" name="getOrganizationPassesBySignal[]" value="<?php echo $value['signal_id'] ?>" checked /><?php echo $value['signal_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationHasCar -->
        <?php if( !empty($data_chek['getOrganizationHasCar'])) { ?>
        <div style="text-align: center"><?php echo $Lang->availability_car ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationHasCar'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getOrganizationHasCar[]" value="<?php echo $value['car_id'] ?>" checked /><?php echo $value['car_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationHasWeapon -->
        <?php if( !empty($data_chek['getOrganizationHasWeapon'])) { ?>
        <div style="text-align: center"><?php echo $Lang->availability_weapons ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationHasWeapon'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getOrganizationHasWeapon[]" value="<?php echo $value['weapon_id'] ?>" checked /><?php echo $value['weapon_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationHasMiaSummary -->
        <?php if( !empty($data_chek['getOrganizationHasMiaSummary'])) { ?>
        <div style="text-align: center"><?php echo $Lang->passes_summary ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationHasMiaSummary'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getOrganizationHasMiaSummary[]" value="<?php echo $value['mia_summary_id'] ?>" checked /><?php echo $value['mia_summary_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getOrganizationEvent -->
        <?php if( !empty($data_chek['getOrganizationEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->involved_the_events ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getOrganizationEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getOrganizationEvent[]" value="<?php echo $value['id']; ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <?php foreach($data_chek['getBibliography'] as $val ){ ?>
            <input type="hidden" value="<?php echo $val['id']; ?>" name="getBibliography[]"/>
        <?php } ?>

        <div class="forForm">
            <label style="width:500px;float:left">
                <input id="save" type="submit"  class="k-button" value="<?php echo $Lang->fusion?>">
            </label>
        </div>



    </form>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        $('#save').on('click',function(e){
            e.preventDefault();
            <?php if(isset($data_chek['getOrganizationHasMan'])){ foreach($data_chek['getOrganizationHasMan'] as $key=>$val){ ?>
                if($('#organization_has_man_'+<?php echo $key;?>).is(':checked')){
                    $('#organization_has_man_man_id_'+<?php echo $key;?>).attr('name','getOrganizationHasMan[<?php echo $key?>][]');
                    $('#organization_has_man_title_'+<?php echo $key;?>).attr('name','getOrganizationHasMan[<?php echo $key?>][]');
                    $('#organization_has_man_start_'+<?php echo $key;?>).attr('name','getOrganizationHasMan[<?php echo $key?>][]');
                    $('#organization_has_man_end_'+<?php echo $key;?>).attr('name','getOrganizationHasMan[<?php echo $key?>][]');
                    $('#organization_has_man_period_'+<?php echo $key;?>).attr('name','getOrganizationHasMan[<?php echo $key?>][]');
                }else{
                    $('#organization_has_man_man_id_'+<?php echo $key;?>).attr('name','');
                    $('#organization_has_man_title_'+<?php echo $key;?>).attr('name','');
                    $('#organization_has_man_start_'+<?php echo $key;?>).attr('name','');
                    $('#organization_has_man_end_'+<?php echo $key;?>).attr('name','');
                    $('#organization_has_man_period_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>
            <?php if(isset($data_chek['getOrganizationHasAddress'])){ foreach($data_chek['getOrganizationHasAddress'] as $key=>$val){ ?>
                if($('#organization_has_address_'+<?php echo $key;?>).is(':checked')){
                    $('#organization_has_address_start_'+<?php echo $key;?>).attr('name','getOrganizationHasAddress[<?php echo $key?>][]');
                    $('#organization_has_address_end_'+<?php echo $key;?>).attr('name','getOrganizationHasAddress[<?php echo $key?>][]');
                }else{
                    $('#organization_has_address_start_'+<?php echo $key;?>).attr('name','');
                    $('#organization_has_address_end_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>
            <?php if(isset($data_chek['getOrganizationHasPhone'])){ foreach($data_chek['getOrganizationHasPhone'] as $key=>$val){ ?>
                if($('#organization_has_man_'+<?php echo $key;?>).is(':checked')){
                    $('#organization_has_man_charecter_id_'+<?php echo $key;?>).attr('name','getOrganizationHasPhone[<?php echo $key?>][]');
                }else{
                    $('#organization_has_man_charecter_id_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>
            <?php if(isset($data_chek['getOrganizationObjectsRelation'])){ foreach($data_chek['getOrganizationObjectsRelation'] as $key=>$val){ ?>
                if($('#organization_object_relation_'+<?php echo $key;?>).is(':checked')){
                    $('#organization_object_relation_relation_type_id_'+<?php echo $key;?>).attr('name','getOrganizationObjectsRelation[<?php echo $key?>][]');
                    $('#organization_object_relation_first_object_id_'+<?php echo $key;?>).attr('name','getOrganizationObjectsRelation[<?php echo $key?>][]');
                    $('#organization_object_relation_second_object_id_'+<?php echo $key;?>).attr('name','getOrganizationObjectsRelation[<?php echo $key?>][]');
                }else{
                    $('#organization_object_relation_relation_type_id_'+<?php echo $key;?>).attr('name','');
                    $('#organization_object_relation_first_object_id_'+<?php echo $key;?>).attr('name','');
                    $('#organization_object_relation_second_object_id_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>

            $('#OrganizationForm').submit();
        });
//
    });
</script>