<div class="inContent">
    <form id="criminalCaseForm" method="post" action="<?php echo ROOT.'fusion/fusion_criminal_case/'?>">

        <?php  //var_dump($data);die; ?>


        <div class="forForm">
            <label><?php echo $Lang->criminal.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->criminal.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- number_case -->
        <?php if( !empty($data[0]['number']) OR !empty($data[1]['number'])) { ?>
        <div style="text-align: center"><?php echo $Lang->number_case; ?></div>
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

        <!-- bibliography -->
        <?php if( !empty($data[0]['bibliography_id']) OR !empty($data[1]['bibliography_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->bibliography; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['bibliography_id'])) { ?>
                <input type="radio" name="bibliography_id" value="NULL" checked /><?php echo $Lang->empty; ?>
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

        <!-- criminal_proceedings_date -->
        <?php if( !empty($data[0]['opened_date']) OR !empty($data[1]['opened_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->criminal_proceedings_date; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['opened_date'])) { ?>
                <input type="radio" name="opened_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="opened_date" value="<?php echo $data[0]['opened_date']?>" checked ><?php echo $data[0]['opened_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['opened_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="opened_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['opened_date']?><input type="radio" name="opened_date" value="<?php echo $data[1]['opened_date']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="opened_date" value=""  />
        <?php } ?>

        <!-- criminal_code -->
        <?php if( !empty($data[0]['artical']) OR !empty($data[1]['artical'])) { ?>
        <div style="text-align: center"><?php echo $Lang->criminal_code; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['artical'])) { ?>
                <input type="radio" name="artical" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="artical" value="<?php echo $data[0]['artical']?>" checked ><?php echo $data[0]['artical']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['artical'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="artical" value="" />
                <?php } else { ?>
                <?php echo $data[1]['artical']?><input type="radio" name="artical" value="<?php echo $data[1]['artical']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="artical" value=""  />
        <?php } ?>

        <!-- materials_management -->
        <?php if( !empty($data[0]['opened_agency_id']) OR !empty($data[1]['opened_agency_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->materials_management; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['opened_agency_id'])) { ?>
                <input type="radio" name="opened_agency_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="opened_agency_id" value="<?php echo $data[0]['opened_agency_id']?>" checked ><?php echo $data[0]['opened_agency']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['organization_id'])) { ?>
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



        <!-- head_department -->
        <?php if( !empty($data[0]['opened_unit_id']) OR !empty($data[1]['opened_unit_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->head_department; ?></div>
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



        <!-- instituted_units -->
        <?php if( !empty($data[0]['subunit_id']) OR !empty($data[1]['subunit_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->instituted_units; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['subunit_id'])) { ?>
                <input type="radio" name="subunit_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="subunit_id" value="<?php echo $data[0]['subunit_id']?>" checked ><?php echo $data[0]['subunit']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['subunit_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="subunit_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['subunit']?><input type="radio" name="subunit_id" value="<?php echo $data[1]['subunit_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="subunit_id" value=""  />
        <?php } ?>

        <!-- nature_materials_paint -->
        <?php if( !empty($data[0]['character']) OR !empty($data[1]['character'])) { ?>
        <div style="text-align: center"><?php echo $Lang->nature_materials_paint; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['character'])) { ?>
                <input type="radio" name="character" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="character" value="<?php echo $data[0]['character']?>" checked ><?php echo $data[0]['character']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['character'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="character" value="" />
                <?php } else { ?>
                <?php echo $data[1]['character']?><input type="radio" name="character" value="<?php echo $data[1]['character']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="character" value=""  />
        <?php } ?>

        <!-- signal -->
        <?php if( !empty($data_chek['getCriminalCaseHasSignal'])) { ?>
        <div style="text-align: center"><?php echo $Lang->signal; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCriminalCaseHasSignal'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCriminalCaseHasSignal[]" value="<?php echo $value['signal_id'] ?>" checked /><?php echo ' ID : '.$value['signal_id']; ?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>


        <!-- initiated_dow -->
        <?php if( !empty($data[0]['opened_dou']) OR !empty($data[1]['opened_dou'])) { ?>
        <div style="text-align: center"><?php echo $Lang->initiated_dow; ?></div>
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

        <!-- worker -->
        <?php if( !empty($data_chek['getCriminalCaseWorker'])) { ?>
        <div style="text-align: center"><?php echo $Lang->name_operatives; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCriminalCaseWorker'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCriminalCaseWorker[]" value="<?php echo $value['worker'] ?>" checked /><?php echo $value['worker']; ?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>


        <!-- worker post -->
        <?php if( !empty($data_chek['getCriminalCaseWorkerPost'])) { ?>
        <div style="text-align: center"><?php echo $Lang->worker_post; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCriminalCaseWorkerPost'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCriminalCaseWorkerPost[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; ?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>



        <!-- case_person -->
        <?php if( !empty($data_chek['getCriminalCaseHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->case_person; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCriminalCaseHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCriminalCaseHasMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- case_organization -->
        <?php if( !empty($data_chek['getCriminalCaseHasOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->case_organization; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCriminalCaseHasOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCriminalCaseHasOrganization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo ' ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- action has instituted_fact_action -->
        <?php if( !empty($data_chek['getCriminalCaseHasAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->instituted_fact_action; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCriminalCaseHasAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCriminalCaseHasAction[]" value="<?php echo $value['action_id'] ?>" checked /><?php echo ' ID : '.$value['action_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- instituted_fact_event -->
        <?php if( !empty($data_chek['getCriminalCaseHasEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->instituted_fact_event; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCriminalCaseHasEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCriminalCaseHasEvent[]" value="<?php echo $value['event_id'] ?>" checked /><?php echo ' ID : '.$value['event_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- connected_criminal_cases -->
        <?php if( !empty($data_chek['getCriminalCaseExtracted'])) { ?>
        <div style="text-align: center"><?php echo $Lang->connected_criminal_cases; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCriminalCaseExtracted'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCriminalCaseExtracted[]" value="<?php echo $value['criminal_case_id1'] ?>" checked /><?php echo ' ID : '.$value['criminal_case_id1']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- separated_criminal_cases -->
        <?php if( !empty($data_chek['getCriminalCaseSplited'])) { ?>
        <div style="text-align: center"><?php echo $Lang->separated_criminal_cases; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getCriminalCaseSplited'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getCriminalCaseSplited[]" value="<?php echo $value['criminal_case_id1'] ?>" checked /><?php echo ' ID : '.$value['criminal_case_id1']; //var_dump($value) ;?>
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