<div class="inContent">
    <form id="miaSummaryForm" method="post" action="<?php echo ROOT.'fusion/fusion_mia_summary/'?>">

        <?php  //var_dump($data);die; ?>

        <div class="forForm">
            <label><?php echo $Lang->mia_summary.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->mia_summary.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- date_registration_reports -->
        <?php if( !empty($data[0]['date']) OR !empty($data[1]['date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->date_registration_reports; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['date'])) { ?>
                <input type="radio" name="date" value="" checked /><?php echo $Lang->empty; ?>
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

        <!-- content_inf -->
        <?php if( !empty($data[0]['content']) OR !empty($data[1]['content'])) { ?>
        <div style="text-align: center"><?php echo $Lang->content_inf; ?></div>
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

        <!-- summary_man  -->
        <?php if( !empty($data_chek['getMiaSummaryHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->summary_man; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getMiaSummaryHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getMiaSummaryHasMan[]" value="<?php echo $value['man_id'] ?>" checked /><?php echo ' ID : '.$value['man_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- summary_organizations -->
        <?php if( !empty($data_chek['getMiaSummaryHasOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->summary_organizations; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getMiaSummaryHasOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getMiaSummaryHasOrganization[]" value="<?php echo $value['organization_id'] ?>" checked /><?php echo ' ID : '.$value['organization_id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <div class="forForm">
            <label style="width:500px;float:left">
                <input type="submit"  class="k-button" value="<?php echo $Lang->fusion?>">
            </label>
        </div>



    </form>
</div>