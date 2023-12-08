<div class="inContent">
    <form id="signalForm" method="post" action="<?php echo ROOT.'fusion/fusion_signal/'?>">

        <?php  //var_dump($data);die; ?>


        <div class="forForm">
            <label><?php echo $Lang->signal.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->signal.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- reg_number_signal -->
        <?php if( !empty($data[0]['number']) OR !empty($data[1]['number'])) { ?>
        <div style="text-align: center"><?php echo $Lang->reg_number_signal; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['reg_num'])) { ?>
                <input type="radio" name="reg_num" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="reg_num" value="<?php echo $data[0]['reg_num']?>" checked ><?php echo $data[0]['reg_num']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['reg_num'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="reg_num" value="" />
                <?php } else { ?>
                <?php echo $data[1]['reg_num']?><input type="radio" name="reg_num" value="<?php echo $data[1]['reg_num']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="reg_num" value=""  />
        <?php } ?>

        <!-- contents_information_signal -->
        <?php if( !empty($data[0]['content']) OR !empty($data[1]['content'])) { ?>
        <div style="text-align: center"><?php echo $Lang->contents_information_signal; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['content'])) { ?>
                <input type="radio" name="content" value="NULL" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="content" value="<?php echo $data[0]['content']?>" checked ><?php echo $data[0]['content']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['content'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="content" value="" />
                <?php } else { ?>
                <?php echo $data[1]['content']?><input type="radio" name="content" value="<?php echo $data[1]['content']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="content" value=""  />
        <?php } ?>

        <!-- line_which_verified -->
        <?php if( !empty($data[0]['check_line']) OR !empty($data[1]['check_line'])) { ?>
        <div style="text-align: center"><?php echo $Lang->line_which_verified; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['check_line'])) { ?>
                <input type="radio" name="check_line" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="check_line" value="<?php echo $data[0]['check_line']?>" checked ><?php echo $data[0]['check_line']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['check_line'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="check_line" value="" />
                <?php } else { ?>
                <?php echo $data[1]['check_line']?><input type="radio" name="check_line" value="<?php echo $data[1]['check_line']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="check_line" value=""  />
        <?php } ?>

        <!-- check_status_charter -->
        <?php if( !empty($data[0]['check_status']) OR !empty($data[1]['check_status'])) { ?>
        <div style="text-align: center"><?php echo $Lang->check_status_charter; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['check_status'])) { ?>
                <input type="radio" name="check_status" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="check_status" value="<?php echo $data[0]['check_status']?>" checked ><?php echo $data[0]['check_status']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['check_status'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="check_status" value="" />
                <?php } else { ?>
                <?php echo $data[1]['check_status']?><input type="radio" name="check_status" value="<?php echo $data[1]['check_status']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="check_status" value=""  />
        <?php } ?>

        <!-- qualifications_signaling -->
        <?php if( !empty($data[0]['signal_qualification_id']) OR !empty($data[1]['signal_qualification_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->qualifications_signaling; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['signal_qualification_id'])) { ?>
                <input type="radio" name="signal_qualification_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="signal_qualification_id" value="<?php echo $data[0]['signal_qualification_id']?>" checked ><?php echo $data[0]['signal_qualification']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['signal_qualification_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="signal_qualification_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['signal_qualification']?><input type="radio" name="signal_qualification_id" value="<?php echo $data[1]['signal_qualification_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="signal_qualification_id" value=""  />
        <?php } ?>



        <!-- checks_signal -->
        <?php if( !empty($data[0]['check_agency_id']) OR !empty($data[1]['check_agency_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->department_checking; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['check_agency_id'])) { ?>
                <input type="radio" name="check_agency_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="check_agency_id" value="<?php echo $data[0]['check_agency_id']?>" checked ><?php echo $data[0]['check_agency']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['check_agency_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="check_agency_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['check_agency']?><input type="radio" name="check_agency_id" value="<?php echo $data[1]['check_agency_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="check_agency_id" value=""  />
        <?php } ?>



        <!-- department_checking -->
        <?php if( !empty($data[0]['check_unit_id']) OR !empty($data[1]['check_unit_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->checks_signal; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['check_unit_id'])) { ?>
                <input type="radio" name="check_unit_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="check_unit_id" value="<?php echo $data[0]['check_unit_id']?>" checked ><?php echo $data[0]['check_unit']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['check_unit_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="check_unit_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['check_unit']?><input type="radio" name="check_unit_id" value="<?php echo $data[1]['check_unit_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="check_unit_id" value=""  />
        <?php } ?>

        <!-- unit_testing -->
        <?php if( !empty($data[0]['check_subunit_id']) OR !empty($data[1]['check_subunit_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->unit_testing; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['check_subunit_id'])) { ?>
                <input type="radio" name="check_subunit_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="check_subunit_id" value="<?php echo $data[0]['check_subunit_id']?>" checked ><?php echo $data[0]['check_subunit']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['check_subunit_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="check_subunit_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['check_subunit']?><input type="radio" name="check_subunit_id" value="<?php echo $data[1]['check_subunit_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="check_subunit_id" value=""  />
        <?php } ?>

        <!-- date_registration_division -->
        <?php if( !empty($data[0]['subunit_date']) OR !empty($data[1]['subunit_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->date_registration_division; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['subunit_date'])) { ?>
                <input type="radio" name="subunit_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="subunit_date" value="<?php echo $data[0]['subunit_date']?>" checked ><?php echo $data[0]['subunit_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['subunit_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="subunit_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['subunit_date']?><input type="radio" name="subunit_date" value="<?php echo $data[1]['subunit_date']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="subunit_date" value=""  />
        <?php } ?>

        <!-- check_date -->
        <?php if( !empty($data[0]['check_date']) OR !empty($data[1]['check_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->check_date; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['check_date'])) { ?>
                <input type="radio" name="check_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="check_date" value="<?php echo $data[0]['check_date']?>" checked ><?php echo $data[0]['check_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['check_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="check_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['check_date']?><input type="radio" name="check_date" value="<?php echo $data[1]['check_date']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="check_date" value=""  />
        <?php } ?>

        <!-- date_actual -->
        <?php if( !empty($data[0]['end_date']) OR !empty($data[1]['end_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->date_actual; ?></div>
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

        <!-- according_result_dow -->
        <?php if( !empty($data[0]['opened_dou']) OR !empty($data[1]['opened_dou'])) { ?>
        <div style="text-align: center"><?php echo $Lang->according_result_dow; ?></div>
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

        <!-- brought_signal -->
        <?php if( !empty($data[0]['opened_agency_id']) OR !empty($data[1]['opened_agency_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->brought_signal; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['opened_agency_id'])) { ?>
                <input type="radio" name="opened_agency_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="opened_agency_id" value="<?php echo $data[0]['opened_agency_id']?>" checked ><?php echo $data[0]['opened_agency']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['opened_agency_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="opened_agency_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['opened_agency']?><input type="radio" name="opened_agency_id" value="<?php echo $data[1]['opened_agency_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="opened_agency_id" value=""  />
        <?php } ?>

        <!-- department_brought -->
        <?php if( !empty($data[0]['opened_unit_id']) OR !empty($data[1]['opened_unit_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->department_brought; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['opened_unit_id'])) { ?>
                <input type="radio" name="opened_unit_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="opened_unit_id" value="<?php echo $data[0]['opened_unit_id']?>" checked ><?php echo $data[0]['opened_unit']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['opened_unit_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="opened_unit_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['opened_unit']?><input type="radio" name="opened_unit_id" value="<?php echo $data[1]['opened_unit_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="opened_unit_id" value=""  />
        <?php } ?>

        <!-- unit_brought -->
        <?php if( !empty($data[0]['opened_subunit_id']) OR !empty($data[1]['opened_subunit_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->unit_brought; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['opened_subunit_id'])) { ?>
                <input type="radio" name="opened_subunit_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="opened_subunit_id" value="<?php echo $data[0]['opened_subunit_id']?>" checked ><?php echo $data[0]['opened_subunit']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['opened_subunit_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="opened_subunit_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['opened_subunit']?><input type="radio" name="opened_subunit_id" value="<?php echo $data[1]['opened_subunit_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="opened_subunit_id" value=""  />
        <?php } ?>

        <!-- name_operatives -->
        <?php if( !empty($data_chek['getSignalWorker'])) { ?>
        <div style="text-align: center"><?php echo $Lang->name_operatives; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalWorker'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="worker[]" value="<?php echo $value['worker'] ?>" checked /><?php echo $value['worker']; ?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- worker post -->
        <?php if( !empty($data_chek['getSignalWorkerPost'])) { ?>
        <div style="text-align: center"><?php echo $Lang->worker_post; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalWorkerPost'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="worker_post[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; ?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- source_category -->
        <?php if( !empty($data[0]['source_resource_id']) OR !empty($data[1]['source_resource_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->source_category; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['source_resource_id'])) { ?>
                <input type="radio" name="source_resource_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="source_resource_id" value="<?php echo $data[0]['source_resource_id']?>" checked ><?php echo $data[0]['resource']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['source_resource_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="source_resource_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['resource']?><input type="radio" name="source_resource_id" value="<?php echo $data[1]['source_resource_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="source_resource_id" value=""  />
        <?php } ?>

        <!-- signal_results -->
        <?php if( !empty($data[0]['signal_result_id']) OR !empty($data[1]['signal_result_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->signal_results; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['signal_result_id'])) { ?>
                <input type="radio" name="signal_result_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="signal_result_id" value="<?php echo $data[0]['signal_result_id']?>" checked ><?php echo $data[0]['signal_result']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['signal_result_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="signal_result_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['signal_result']?><input type="radio" name="signal_result_id" value="<?php echo $data[1]['signal_result_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="signal_result_id" value=""  />
        <?php } ?>

        <!-- according_test_result -->
        <?php if( !empty($data_chek['getSignalCriminalCase'])) { ?>
        <div style="text-align: center"><?php echo $Lang->according_test_result; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalCriminalCase'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getSignalCriminalCase[]" value="<?php echo $value['criminal_case_id'] ?>" checked /><?php echo ' ID : '.$value['criminal_case_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!--  signal check worker  -->
        <?php if( !empty($data_chek['getSignalCheckingWorker'])) { ?>
            <div style="text-align: center"><?php echo $Lang->name_checking_signal; ?></div>
            <div class="forForm">
                <?php foreach($data_chek['getSignalCheckingWorker'] as $value){ ?>
                    <label style="text-align: center">
                        <input type="checkbox" name="checking_worker[]" value="<?php echo $value['worker'] ?>" checked /><?php echo $value['worker']; ?>
                    </label>
                <?php }?>
            </div>
            <div class="forForm">
                <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
            </div>
        <?php }?>

        <!--  signal check worker  post-->
        <?php if( !empty($data_chek['getSignalCheckingWorkerPost'])) { ?>
        <div style="text-align: center"><?php echo $Lang->worker_post; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalCheckingWorkerPost'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="checking_worker_post[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; ?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>




        <!-- objects_check_signal_man -->
        <?php if( !empty($data_chek['getSignalHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->objects_check_signal_man; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getSignalHasMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- passes_signal_man -->
        <?php if( !empty($data_chek['getSignalPassedByMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->passes_signal_man; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalPassedByMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getSignalPassedByMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- objects_check_signal_organization -->
        <?php if( !empty($data_chek['getSignalCheckedByOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->objects_check_signal_organization; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalCheckedByOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getSignalCheckedByOrganization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo ' ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- passes_signal_organization -->
        <?php if( !empty($data_chek['getSignalPassesByOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->passes_signal_organization; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalPassesByOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getSignalPassesByOrganization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo ' ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- objects_check_signal_action -->
        <?php if( !empty($data_chek['getSignalPassesAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->objects_check_signal_action; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalPassesAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getSignalPassesAction[]" value="<?php echo $value['action_id'] ?>" checked /><?php echo ' ID : '.$value['action_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- objects_check_signal_event -->
        <?php if( !empty($data_chek['getSignalPassesEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->objects_check_signal_event; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalPassesEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getSignalPassesEvent[]" value="<?php echo $value['event_id'] ?>" checked /><?php echo ' ID : '.$value['event_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- keep_signal -->
        <?php if( !empty($data_chek['getSignalKeepSignal'])) { ?>
        <div style="text-align: center"><?php echo $Lang->keep_signal; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getSignalKeepSignal'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getSignalKeepSignal[]" value="<?php echo $value['id'] ?>" checked /><?php echo ' ID : '.$value['id']; //var_dump($value) ;?>
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