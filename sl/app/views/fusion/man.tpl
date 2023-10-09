<div class="inContent">
    <form id="controlForm" method="post" action="<?php echo ROOT.'fusion/fusion_man/'?>">
        <?php // var_dump($data);die; ?>
        <div class="forForm">
            <label><?php echo $Lang->face.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->face.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- bibliography -->
        <?php if( !empty($data[0]['gender_id']) OR !empty($data[1]['gender_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->gender; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['gender_id'])) { ?>
                <input type="radio" name="gender_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="gender_id" value="<?php echo $data[0]['gender_id']?>" checked ><?php echo $data[0]['gender']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['gender_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="gender_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['gender']?><input type="radio" name="gender_id" value="<?php echo $data[1]['gender_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="gender_id" value=""  />
        <?php } ?>

        <!--bibliography id-->
        <?php if( !empty($data_chek['getManHasBibliography'])) { ?>
            <div style="display: none;">
            <div style="text-align: center"><?php echo $Lang->also_known_as; ?></div>
            <div class="forForm">
                <?php foreach($data_chek['getManHasBibliography'] as $value){ ?>
                    <label style="text-align: center">
                        <input type="checkbox" name="getManHasBibliography[]" value="<?php echo $value['bibliography_id'] ?>" checked /><?php echo 'ID : '.$value['bibliography_id']; //var_dump($value) ;?>
                    </label>
                <?php }?>
            </div>
            <div class="forForm">
                <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
            </div>
            </div>
        <?php }?>

        <!-- date_security_date -->
        <?php if( !empty($data[0]['nation_id']) OR !empty($data[1]['nation_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->nationality; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['nation_id'])) { ?>
                <input type="radio" name="nation_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="nation_id" value="<?php echo $data[0]['nation_id']?>" checked ><?php echo $data[0]['nation']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['nation_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="nation_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['nation']?><input type="radio" name="nation_id" value="<?php echo $data[1]['nation_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="nation_id" value=""  />
        <?php } ?>

        <!-- address -->
        <?php if( !empty($data[0]['born_address_id']) OR !empty($data[1]['born_address_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->place_man ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['born_address_id'])) { ?>
                <input type="radio" name="born_address_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="born_address_id" value="<?php echo $data[0]['born_address_id']?>" checked ><?php echo $data[0]['address_country_ate_name'].' , '.$data[0]['address_region_name'] .' , '.$data[0]['address_locality_name'];?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['born_address_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="born_address_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['address_country_ate_name'].' , '.$data[1]['address_region_name'] .' , '.$data[1]['address_locality_name'];?><input type="radio" name="born_address_id" value="<?php echo $data[1]['born_address_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="born_address_id" value=""  />
        <?php } ?>

        <!-- place_event_organization -->
        <?php if( !empty($data_chek['getManToMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->also_known_as; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManToMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManToMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo 'ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>


        <!-- ensuing_effects -->
        <?php if( !empty($data[0]['birthday']) OR !empty($data[1]['birthday'])) { ?>
        <div style="text-align: center"><?php echo $Lang->date_of_birth ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['birthday'])) { ?>
                <input type="radio" name="birthday" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="birthday" value="<?php echo $data[0]['birthday']?>" checked ><?php echo $data[0]['birthday']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['birthday'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="birthday" value="" />
                <?php } else { ?>
                <?php echo $data[1]['birthday']?><input type="radio" name="birthday" value="<?php echo $data[1]['birthday']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="birthday" value=""  />
        <?php } ?>

        <!-- criminal_case -->
        <?php if( !empty($data[0]['start_year']) OR !empty($data[1]['start_year'])) { ?>
        <div style="text-align: center"><?php echo $Lang->approximate_year ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['start_year'])) { ?>
                <input type="radio" name="start_year" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="start_year" value="<?php echo $data[0]['start_year']?>" checked ><?php echo $data[0]['start_year'].'--'.$data[0]['end_year']; ?>
                <input type="hidden" name="end_year" value="<?php echo $data[1]['end_year']?>" />
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['start_year'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="start_year" value="" />
                <?php } else { ?>
                <?php echo $data[1]['start_year'].'--'.$data[1]['end_year'];?><input type="radio" name="start_year" value="<?php echo $data[1]['start_year']?>" />
                <input type="hidden" name="end_year" value="<?php echo $data[1]['end_year']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="start_year" value=""  />
        <input type="hidden" name="end_year" value=""  />
        <?php } ?>

        <!-- attention -->
        <?php if( !empty($data[0]['attention']) OR !empty($data[1]['attention'])) { ?>
        <div style="text-align: center"><?php echo $Lang->attention ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['attention'])) { ?>
                <input type="radio" name="attention" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="attention" value="<?php echo $data[0]['attention']?>" checked ><?php echo $data[0]['attention']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['attention'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="attention" value="" />
                <?php } else { ?>
                <?php echo $data[1]['attention']?><input type="radio" name="attention" value="<?php echo $data[1]['attention']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="attention" value=""  />
        <?php } ?>

        <!-- religion_id -->
        <?php if( !empty($data[0]['religion_id']) OR !empty($data[1]['religion_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->worship ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['religion_id'])) { ?>
                <input type="radio" name="religion_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="religion_id" value="<?php echo $data[0]['religion_id']?>" checked ><?php echo $data[0]['religion']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['religion_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="religion_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['religion']?><input type="radio" name="religion_id" value="<?php echo $data[1]['religion_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="religion_id" value=""  />
        <?php } ?>

        <!-- occupation -->
        <?php if( !empty($data[0]['occupation']) OR !empty($data[1]['occupation'])) { ?>
        <div style="text-align: center"><?php echo $Lang->occupation ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['occupation'])) { ?>
                <input type="radio" name="occupation" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="occupation" value="<?php echo $data[0]['occupation']?>" checked ><?php echo $data[0]['occupation']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['occupation'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="occupation" value="" />
                <?php } else { ?>
                <?php echo $data[1]['occupation']?><input type="radio" name="occupation" value="<?php echo $data[1]['occupation']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="occupation" value=""  />
        <?php } ?>

        <!-- opened_dou -->
        <?php if( !empty($data[0]['opened_dou']) OR !empty($data[1]['opened_dou'])) { ?>
        <div style="text-align: center"><?php echo $Lang->face_opened ?></div>
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

        <!-- start_wanted -->
        <?php if( !empty($data[0]['start_wanted']) OR !empty($data[1]['start_wanted'])) { ?>
        <div style="text-align: center"><?php echo $Lang->declared_wanted_list_with ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['start_wanted'])) { ?>
                <input type="radio" name="start_wanted" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="start_wanted" value="<?php echo $data[0]['start_wanted']?>" checked ><?php echo $data[0]['start_wanted']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['start_wanted'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="start_wanted" value="" />
                <?php } else { ?>
                <?php echo $data[1]['start_wanted']?><input type="radio" name="start_wanted" value="<?php echo $data[1]['start_wanted']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="start_wanted" value=""  />
        <?php } ?>

        <!-- entry_date -->
        <?php if( !empty($data[0]['entry_date']) OR !empty($data[1]['entry_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->home_monitoring_start ?></div>
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
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="entry_date" value=""  />
        <?php } ?>

        <!-- exit_date -->
        <?php if( !empty($data[0]['exit_date']) OR !empty($data[1]['exit_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->end_monitoring_start ?></div>
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
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="exit_date" value=""  />
        <?php } ?>

        <!-- fixing_moment -->
        <?php if( !empty($data[0]['fixing_moment']) OR !empty($data[1]['fixing_moment'])) { ?>
        <div style="text-align: center"><?php echo $Lang->time_fixation ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['fixing_moment'])) { ?>
                <input type="radio" name="fixing_moment" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="fixing_moment" value="<?php echo $data[0]['fixing_moment']?>" checked ><?php echo $data[0]['fixing_moment']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['fixing_moment'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="fixing_moment" value="" />
                <?php } else { ?>
                <?php echo $data[1]['fixing_moment']?><input type="radio" name="fixing_moment" value="<?php echo $data[1]['fixing_moment']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="fixing_moment" value=""  />
        <?php } ?>

        <!-- resource_id -->
        <?php if( !empty($data[0]['resource_id']) OR !empty($data[1]['resource_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->source_information ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['resource_id'])) { ?>
                <input type="radio" name="resource_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="resource_id" value="<?php echo $data[0]['resource_id']?>" checked ><?php echo $data[0]['resource']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['resource_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="resource_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['resource']?><input type="radio" name="resource_id" value="<?php echo $data[1]['resource_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="resource_id" value=""  />
        <?php } ?>

        <!-- getManHasFirstName -->
        <?php if( !empty($data_chek['getManHasFirstName'])) { ?>
        <div style="text-align: center"><?php echo $Lang->first_name ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasFirstName'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasFirstName[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['first_name'] ; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasLastName -->
        <?php if( !empty($data_chek['getManHasLastName'])) { ?>
        <div style="text-align: center"><?php echo $Lang->last_name ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasLastName'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasLastName[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['last_name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasMiddleName -->
        <?php if( !empty($data_chek['getManHasMiddleName'])) { ?>
        <div style="text-align: center"><?php echo $Lang->middle_name ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasMiddleName'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasMiddleName[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['middle_name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasPassport -->
        <?php if( !empty($data_chek['getManHasPassport'])) { ?>
        <div style="text-align: center"><?php echo $Lang->passport_number ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasPassport'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasPassport[]" value="<?php echo $value['id'] ?>" checked /><?php echo ' N : '.$value['number']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManBelongsCountry -->
        <?php if( !empty($data_chek['getManBelongsCountry'])) { ?>
        <div style="text-align: center"><?php echo $Lang->citizenship ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManBelongsCountry'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManBelongsCountry[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManKnowsLanguage -->
        <?php if( !empty($data_chek['getManKnowsLanguage'])) { ?>
        <div style="text-align: center"><?php echo $Lang->knowledge_of_languages ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManKnowsLanguage'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManKnowsLanguage[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasAddress -->
        <?php if( !empty($data_chek['getManHasAddress'])) { ?>
        <div style="text-align: center"><?php echo $Lang->place_of_residence_person ?></div>
        <div class="forForm">
            <?php $man_has_addres=0;?>
            <?php foreach($data_chek['getManHasAddress'] as $key=>$value){ ?>
            <label style="text-align: center">
                <input id="man_has_address_<?php echo $man_has_addres;?>" type="checkbox" name="getManHasAddress[<?php echo $man_has_addres;?>][]" value="<?php echo $value['address_id'] ?>" checked /><?php echo $value['address_id']; //var_dump($value) ;?>
                <input id="man_has_address_start_<?php echo $man_has_addres;?>" type="hidden" name="getManHasAddress[<?php echo $man_has_addres;?>][]" value="<?php echo $value['start_date'] ?>" checked />
                <input id="man_has_address_end_<?php echo $man_has_addres;?>" type="hidden" name="getManHasAddress[<?php echo $man_has_addres;?>][]" value="<?php echo $value['end_date'] ?>" checked />
            </label>
            <?php $man_has_addres++; ?>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasPhone -->
        <?php if( !empty($data_chek['getManHasPhone'])) { ?>
        <div style="text-align: center"><?php echo $Lang->telephone_number ?></div>
        <div class="forForm">
            <?php $i=0;?>
            <?php foreach($data_chek['getManHasPhone'] as $value){ ?>
            <label style="text-align: center">
                <input id="man_has_phone_<?php echo $i;?>" type="checkbox" name="getManHasPhone[<?php echo $i;?>][]" value="<?php echo $value['phone_id'] ?>" checked /><?php echo ' N : '.$value['number'].' ( '.$value['name'].' ) '; //var_dump($value) ;?>
                <input id="man_has_phone_hidden_<?php echo $i;?>" type="hidden" name="getManHasPhone[<?php echo $i;?>][]" value="<?php echo $value['character_id'] ?>" checked />
            </label>
            <?php $i++; ?>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasEmail -->
        <?php if( !empty($data_chek['getManHasEmail'])) { ?>
        <div style="text-align: center"><?php echo $Lang->email ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasEmail'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasEmail[]" value="<?php echo $value['email_id'] ?>" checked /><?php echo $value['address']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getMoreDataMan -->
        <?php if( !empty($data_chek['getMoreDataMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->additional_information_person ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getMoreDataMan'] as $value){ ?>
            <label style="text-align: center">
                <input id="getMoreDateMan_id" type="checkbox" name="getMoreDataMan[]" value="<?php echo $value['text'] ?>" checked />
                <?php $str = substr($value['text'],0,10); echo $str; //var_dump($value) ;?>
                    <input id="<?php echo $value['id'] ?>" type="button" value="<?php echo $Lang->read_more ?>" class="read_more">
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasOperationCategory -->
        <?php if( !empty($data_chek['getManHasOperationCategory'])) { ?>
        <div style="text-align: center"><?php echo $Lang->operational_category_person ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasOperationCategory'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasOperationCategory[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getCountrySearchMan -->
        <?php if( !empty($data_chek['getCountrySearchMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->country_carrying_out_search ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCountrySearchMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCountrySearchMan[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasEducation -->
        <?php if( !empty($data_chek['getManHasEducation'])) { ?>
        <div style="text-align: center"><?php echo $Lang->education ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasEducation'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasEducation[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasParty -->
        <?php if( !empty($data_chek['getManHasParty'])) { ?>
        <div style="text-align: center"><?php echo $Lang->party ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasParty'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasParty[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasWorkActivity -->
        <?php if( !empty($data_chek['getManHasWorkActivity'])) { ?>
        <div style="text-align: center"><?php echo $Lang->work_experience_person ?></div>
        <div class="forForm">
            <?php $i=0;?>
            <?php foreach($data_chek['getManHasWorkActivity'] as $value){ ?>
            <label style="text-align: center">
                <input id="man_has_work_activity_<?php echo $i;?>" type="checkbox" name="getManHasWorkActivity[<?php echo $i; ?>][]" value="<?php echo $value['work_activity_id'] ?>" checked /><?php echo $value['work_activity_id']; //var_dump($value) ;?>
                <input id="man_has_work_activity_org_<?php echo $i;?>" type="hidden" name="getManHasWorkActivity[<?php echo $i; ?>][]" value="<?php echo $value['organization_id'] ?>"  />
                <input id="man_has_work_activity_title_<?php echo $i;?>" type="hidden" name="getManHasWorkActivity[<?php echo $i; ?>][]" value="<?php echo $value['title'] ?>"  />
                <input id="man_has_work_activity_start_<?php echo $i;?>" type="hidden" name="getManHasWorkActivity[<?php echo $i; ?>][]" value="<?php echo $value['start_date'] ?>"  />
                <input id="man_has_work_activity_end_<?php echo $i;?>" type="hidden" name="getManHasWorkActivity[<?php echo $i; ?>][]" value="<?php echo $value['end_date'] ?>"  />
                <input id="man_has_work_activity_period_<?php echo $i;?>" type="hidden" name="getManHasWorkActivity[<?php echo $i; ?>][]" value="<?php echo $value['period'] ?>"  />
            </label>
            <?php $i++; ?>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManBeanCountry -->
        <?php if( !empty($data_chek['getManBeanCountry'])) { ?>
        <div style="text-align: center"><?php echo $Lang->man_bean_country ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManBeanCountry'] as $key=>$value){ ?>
            <label style="text-align: center">
                <input id="man_been_country_<?php echo $key?>" type="checkbox" name="getManBeanCountry[<?php echo $key?>][]" value="<?php echo $value['man_bean_country_id'] ?>" checked /><?php echo $value['man_bean_country_id']; //var_dump($value) ;?>
                <input id="man_been_country_ate_<?php echo $key?>" type="hidden" name="getManBeanCountry[<?php echo $key?>][]" value="<?php echo $value['country_ate_id'] ?>" checked />
                <input id="man_been_country_country_ate_<?php echo $key?>" type="hidden" name="getManBeanCountry[<?php echo $key?>][]" value="<?php echo $value['goal_id'] ?>" checked />
                <input id="man_been_country_goal_id_<?php echo $key?>" type="hidden" name="getManBeanCountry[<?php echo $key?>][]" value="<?php echo $value['entry_date'] ?>" checked />
                <input id="man_been_country_entry_date_<?php echo $key?>" type="hidden" name="getManBeanCountry[<?php echo $key?>][]" value="<?php echo $value['exit_date'] ?>" checked />
                <input id="man_been_country_region_id_<?php echo $key?>" type="hidden" name="getManBeanCountry[<?php echo $key?>][]" value="<?php echo $value['region_id'] ?>" checked />
                <input id="man_been_country_locality_id_<?php echo $key?>" type="hidden" name="getManBeanCountry[<?php echo $key?>][]" value="<?php echo $value['locality_id'] ?>" checked />
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManExternalSignHasSign -->
        <?php if( !empty($data_chek['getManExternalSignHasSign'])) { ?>
        <div style="text-align: center"><?php echo $Lang->external_signs ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManExternalSignHasSign'] as $key=>$value){ ?>
            <label style="text-align: center">
                <input id="man_external_sign_has_sign_<?php echo $key?>" type="checkbox" name="getManExternalSignHasSign[<?php echo $key?>][]" value="<?php echo $value['sign_id'] ?>" checked />
                <?php echo $value['name']; //var_dump($value) ;?>
                <input id="man_external_sign_has_sign_fixed_date_<?php echo $key?>" type="hidden" name="getManExternalSignHasSign[<?php echo $key?>][]" value="<?php echo $value['fixed_date'] ?>" checked />
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManExternalSignHasPhoto -->
        <?php if( !empty($data_chek['getManExternalSignHasPhoto'])) { ?>
        <div style="text-align: center"><?php echo $Lang->photo ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManExternalSignHasPhoto'] as $key=>$value){ ?>
            <label style="text-align: center">
                <input id="man_external_sign_photo_<?php echo $key; ?>" type="checkbox" name="getManExternalSignHasPhoto[<?php echo $key; ?>][]" value="<?php echo $value['photo_id'] ?>" checked /> <?php //var_dump($value);?>
                <input id="man_external_sign_photo_fixed_date_<?php echo $key; ?>" type="hidden" name="getManExternalSignHasPhoto[<?php echo $key?>][]" value="<?php echo $value['fixed_date'] ?>" checked />
                <img src="data:image/png;base64,<?php echo $value['image']; ?>"  style="height: 100px;width: 100px;" />
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasNickname -->
        <?php if( !empty($data_chek['getManHasNickname'])) { ?>
        <div style="text-align: center"><?php echo $Lang->alias ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasNickname'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasNickname[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasObjectsOrganization -->
        <?php if( !empty($data_chek['getManHasObjectsOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->relationship_objects_organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasObjectsOrganization'] as $key=>$value){ ?>
            <label style="text-align: center">
                <input id="man_has_objects__organization_<?php echo $key?>" type="checkbox" name="getManHasObjectsOrganization[<?php echo $key?>][]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
                <input id="man_has_objects__organization_relation_type_id_<?php echo $key?>" type="hidden" name="getManHasObjectsOrganization[<?php echo $key?>][]" value="<?php echo $value['relation_type_id'] ?>" checked />
                <?php if($value['first_object_type'] == 'organization') { ?>
                <input id="man_has_objects__organization_first_object_id_<?php echo $key?>" type="hidden" name="getManHasObjectsOrganization[<?php echo $key?>][]" value="<?php echo $value['first_object_id'] ?>" checked />
                <?php }else{ ?>
                <input id="man_has_objects__organization_second_object_id_<?php echo $key?>" type="hidden" name="getManHasObjectsOrganization[<?php echo $key?>][]" value="<?php echo $value['second_object_id'] ?>" checked />
                <?php }?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasObjectsMan -->
        <?php if( !empty($data_chek['getManHasObjectsMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->relationship_objects_man ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasObjectsMan'] as $value){ ?>
            <label style="text-align: center">
                <input id="man_has_object_man_<?php echo $key?>" type="checkbox" name="getManHasObjectsMan[<?php echo $key?>][]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
                <input id="man_has_object_man_relation_type_id_<?php echo $key?>" type="hidden" name="getManHasObjectsMan[<?php echo $key?>][]" value="<?php echo $value['relation_type_id'] ?>" checked />
                <?php if(($value['first_object_id'] != $data[0]['id'] )&&($value['first_object_id'] != $data[1]['id'] )) { ?>
                <input id="man_has_object_man_first_object_id_<?php echo $key?>" type="hidden" name="getManHasObjectsMan[<?php echo $key?>][]" value="<?php echo $value['first_object_id'] ?>" checked />
                <?php }else{ ?>
                <input id="man_has_object_man_second_object_id_<?php echo $key?>" type="hidden" name="getManHasObjectsMan[<?php echo $key?>][]" value="<?php echo $value['second_object_id'] ?>" checked />
                <?php }?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasAction -->
        <?php if( !empty($data_chek['getManHasAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->member_actions ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasAction[]" value="<?php echo $value['action_id'] ?>" checked /><?php echo $value['action_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasEvent -->
        <?php if( !empty($data_chek['getManHasEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->to_event ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasEvent[]" value="<?php echo $value['event_id'] ?>" checked /><?php echo ' ID : '.$value['event_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManPassedBySignal -->
        <?php if( !empty($data_chek['getManPassedBySignal'])) { ?>
        <div style="text-align: center"><?php echo $Lang->passes_signal ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManPassedBySignal'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManPassedBySignal[]" value="<?php echo $value['signal_id'] ?>" checked /><?php echo ' ID : '.$value['signal_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManCheckedBySignal -->
        <?php if( !empty($data_chek['getManCheckedBySignal'])) { ?>
        <div style="text-align: center"><?php echo $Lang->test_signal ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManCheckedBySignal'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManCheckedBySignal[]" value="<?php echo $value['signal_id'] ?>" checked /><?php echo ' ID : '.$value['signal_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasCriminalCase -->
        <?php if( !empty($data_chek['getManHasCriminalCase'])) { ?>
        <div style="text-align: center"><?php echo $Lang->criminal_case ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasCriminalCase'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasCriminalCase[]" value="<?php echo $value['criminal_case_id'] ?>" checked /><?php echo ' ID : '.$value['criminal_case_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManPassesMiaSummary -->
        <?php if( !empty($data_chek['getManPassesMiaSummary'])) { ?>
        <div style="text-align: center"><?php echo $Lang->passes_summary ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManPassesMiaSummary'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManPassesMiaSummary[]" value="<?php echo $value['mia_summary_id'] ?>" checked /><?php echo ' ID : '.$value['mia_summary_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasCar -->
        <?php if( !empty($data_chek['getManHasCar'])) { ?>
        <div style="text-align: center"><?php echo $Lang->presence_machine ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasCar'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasCar[]" value="<?php echo $value['car_id'] ?>" checked /><?php echo ' ID : '.$value['car_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManHasWeapon -->
        <?php if( !empty($data_chek['getManHasWeapon'])) { ?>
        <div style="text-align: center"><?php echo $Lang->presence_weapons ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasWeapon'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasWeapon[]" value="<?php echo $value['weapon_id'] ?>" checked /><?php echo ' ID : '.$value['weapon_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManUseCar -->
        <?php if( !empty($data_chek['getManUseCar'])) { ?>
        <div style="text-align: center"><?php echo $Lang->uses_machine ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManUseCar'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManUseCar[]" value="<?php echo $value['car_id'] ?>" checked /><?php echo ' ID : '.$value['car_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getManUseCar -->
        <?php if( !empty($data_chek['getManHasFile'])) { ?>
        <div style="text-align: center"><?php echo $Lang->answer ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getManHasFile'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getManHasFile[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>



        <div class="forForm">
            <label style="width:500px;float:left">
                <input id="save" type="submit"  class="k-button" value="<?php echo $Lang->fusion?>">
            </label>
        </div>



    </form>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.read_more').click(function(e){
            var id = $(this).attr('id');
            e.preventDefault();
            window.open('<?php echo ROOT?>fusion/getMoreDateMan_full/'+id,"popup", "scrollbars=1,width=500, height=900");

        });
        $('.read_more_getManHasAnswer').click(function(e){
            var id = $(this).attr('id');
            e.preventDefault();
            window.open('<?php echo ROOT?>fusion/getManHasAnswer_full/'+id,"popup", "scrollbars=1,width=500, height=900");

        });
        $('#save').on('click',function(e){
            e.preventDefault();
            <?php if(isset($data_chek['getManHasAddress'])){ foreach($data_chek['getManHasAddress'] as $key=>$val){ ?>
            if($('#man_has_address_'+<?php echo $key;?>).is(':checked')){
                $('#man_has_address_'+<?php echo $key;?>).attr('name','getManHasAddress[<?php echo $key; ?>][]');
                $('#man_has_address_start_'+<?php echo $key;?>).attr('name','getManHasAddress[<?php echo $key; ?>][]');
                $('#man_has_address_end_'+<?php echo $key;?>).attr('name','getManHasAddress[<?php echo $key; ?>][]');
            }else{
                $('#man_has_address_'+<?php echo $key;?>).attr('name','');
                $('#man_has_address_start_'+<?php echo $key;?>).attr('name','');
                $('#man_has_address_end_'+<?php echo $key;?>).attr('name','');
        }
                <?php } } ?>
            <?php if(isset($data_chek['getManHasPhone'])){ foreach($data_chek['getManHasPhone'] as $key=>$val){ ?>
                if($('#man_has_phone_'+<?php echo $key;?>).is(':checked')){
                    $('#man_has_phone_'+<?php echo $key;?>).attr('name','getManHasPhone[<?php echo $key; ?>][]');
                    $('#man_has_phone_hidden_'+<?php echo $key;?>).attr('name','getManHasPhone[<?php echo $key; ?>][]');
                }else{
                    $('#man_has_phone_'+<?php echo $key;?>).attr('name','');
                    $('#man_has_phone_hidden_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>
            <?php if(isset($data_chek['getManHasWorkActivity'])){ foreach($data_chek['getManHasWorkActivity'] as $key=>$val){ ?>
                if($('#man_has_work_activity_'+<?php echo $key;?>).is(':checked')){
                    $('#man_has_work_activity_org_'+<?php echo $key;?>).attr('name','getManHasWorkActivity[<?php echo $key; ?>][]');
                    $('#man_has_work_activity_title_'+<?php echo $key;?>).attr('name','getManHasWorkActivity[<?php echo $key; ?>][]');
                    $('#man_has_work_activity_start_'+<?php echo $key;?>).attr('name','getManHasWorkActivity[<?php echo $key; ?>][]');
                    $('#man_has_work_activity_end_'+<?php echo $key;?>).attr('name','getManHasWorkActivity[<?php echo $key; ?>][]');
                    $('#man_has_work_activity_period_'+<?php echo $key;?>).attr('name','getManHasWorkActivity[<?php echo $key; ?>][]');
                }else{
                    $('#man_has_work_activity_org_'+<?php echo $key;?>).attr('name','');
                    $('#man_has_work_activity_title_'+<?php echo $key;?>).attr('name','');
                    $('#man_has_work_activity_start_'+<?php echo $key;?>).attr('name','');
                    $('#man_has_work_activity_end_'+<?php echo $key;?>).attr('name','');
                    $('#man_has_work_activity_period_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>
            <?php if(isset($data_chek['getManBeanCountry'])){ foreach($data_chek['getManBeanCountry'] as $key=>$val){ ?>
                if($('#man_been_country_'+<?php echo $key;?>).is(':checked')){
                    $('#man_been_country_ate_'+<?php echo $key;?>).attr('name','getManBeanCountry[<?php echo $key; ?>][]');
                    $('#man_been_country_country_ate_'+<?php echo $key;?>).attr('name','getManBeanCountry[<?php echo $key; ?>][]');
                    $('#man_been_country_goal_id_'+<?php echo $key;?>).attr('name','getManBeanCountry[<?php echo $key; ?>][]');
                    $('#man_been_country_entry_date_'+<?php echo $key;?>).attr('name','getManBeanCountry[<?php echo $key; ?>][]');
                    $('#man_been_country_region_id_'+<?php echo $key;?>).attr('name','getManBeanCountry[<?php echo $key; ?>][]');
                    $('#man_been_country_locality_id_'+<?php echo $key;?>).attr('name','getManBeanCountry[<?php echo $key; ?>][]');
                }else{
                    $('#man_been_country_ate_'+<?php echo $key;?>).attr('name','');
                    $('#man_been_country_country_ate_'+<?php echo $key;?>).attr('name','');
                    $('#man_been_country_goal_id_'+<?php echo $key;?>).attr('name','');
                    $('#man_been_country_entry_date_'+<?php echo $key;?>).attr('name','');
                    $('#man_been_country_region_id_'+<?php echo $key;?>).attr('name','');
                    $('#man_been_country_locality_id_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>
            <?php if(isset($data_chek['getManExternalSignHasSign'])){ foreach($data_chek['getManExternalSignHasSign'] as $key=>$val){ ?>
                if($('#man_external_sign_has_sign_'+<?php echo $key;?>).is(':checked')){
                    $('#man_external_sign_has_sign_fixed_date_'+<?php echo $key;?>).attr('name','getManExternalSignHasSign[<?php echo $key; ?>][]');
                }else{
                    $('#man_external_sign_has_sign_fixed_date_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>
            <?php if(isset($data_chek['getManExternalSignHasPhoto'])){ foreach($data_chek['getManExternalSignHasPhoto'] as $key=>$val){ ?>
                if($('#man_external_sign_photo_'+<?php echo $key;?>).is(':checked')){
                    $('#man_external_sign_photo_fixed_date_'+<?php echo $key;?>).attr('name','getManExternalSignHasPhoto[<?php echo $key; ?>][]');
                }else{
                    $('#man_external_sign_photo_fixed_date_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>
            <?php if(isset($data_chek['getManHasObjectsOrganization'])){ foreach($data_chek['getManHasObjectsOrganization'] as $key=>$val){ ?>
                if($('#man_has_objects__organization_'+<?php echo $key;?>).is(':checked')){
                    $('#man_has_objects__organization_relation_type_id_'+<?php echo $key;?>).attr('name','getManHasObjectsOrganization[<?php echo $key; ?>][]');
                    $('#man_has_objects__organization_first_object_id_'+<?php echo $key;?>).attr('name','getManHasObjectsOrganization[<?php echo $key; ?>][]');
                    $('#man_has_objects__organization_second_object_id_'+<?php echo $key;?>).attr('name','getManHasObjectsOrganization[<?php echo $key; ?>][]');
                }else{
                    $('#man_has_objects__organization_relation_type_id_'+<?php echo $key;?>).attr('name','');
                    $('#man_has_objects__organization_first_object_id_'+<?php echo $key;?>).attr('name','');
                    $('#man_has_objects__organization_second_object_id_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>
            <?php if(isset($data_chek['getManHasObjectsMan'])){ foreach($data_chek['getManHasObjectsMan'] as $key=>$val){ ?>
                if($('#man_has_object_man_'+<?php echo $key;?>).is(':checked')){
                    $('#man_has_object_man_relation_type_id_'+<?php echo $key;?>).attr('name','getManHasObjectsMan[<?php echo $key; ?>][]');
                    $('#man_has_objects__organization_first_object_id_'+<?php echo $key;?>).attr('name','getManHasObjectsMan[<?php echo $key; ?>][]');
                    $('#man_has_object_man_second_object_id_'+<?php echo $key;?>).attr('name','getManHasObjectsMan[<?php echo $key; ?>][]');
                }else{
                    $('#man_has_object_man_relation_type_id_'+<?php echo $key;?>).attr('name','');
                    $('#man_has_objects__organization_first_object_id_'+<?php echo $key;?>).attr('name','');
                    $('#man_has_object_man_second_object_id_'+<?php echo $key;?>).attr('name','');
                }
            <?php } } ?>
            $('#controlForm').submit();
        });
//
    });
</script>