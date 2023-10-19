<div class="inContent">
    <form id="controlForm" method="post" action="<?php echo ROOT.'fusion/fusion_control/'?>">

        <?php // var_dump($data);die; ?>

        <!-- document_category -->
        <div class="forForm">
            <label><?php echo $Lang->control.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->control.' '.$data[1]['id']?></label>
            <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
            <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />
        </div>

        <?php if( !empty($data[0]['doc_category_id']) OR !empty($data[1]['doc_category_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->document_category; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['doc_category_id'])) { ?>
                <input type="radio" name="doc_category" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="doc_category" value="<?php echo $data[0]['doc_category_id']?>" checked ><?php echo $data[0]['doc_category']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['doc_category_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="doc_category" value="" />
                <?php } else { ?>
                <?php echo $data[1]['doc_category']?><input type="radio" name="doc_category" value="<?php echo $data[1]['doc_category_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="doc_category" value=""  />
        <?php }?>


        <!-- document_date -->
        <?php if( !empty($data[0]['creation_date']) OR !empty($data[1]['creation_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->document_date ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['creation_date'])) { ?>
                <input type="radio" name="document_data" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="document_data" value="<?php echo $data[0]['creation_date']?>" checked ><?php echo $data[0]['creation_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['creation_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="document_data" value="" />
                <?php } else { ?>
                <?php echo $data[1]['creation_date']?><input type="radio" name="document_data" value="<?php echo $data[1]['creation_date']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="document_data" value=""  />
        <?php }?>

        <!-- reg_document -->
        <?php if( !empty($data[0]['reg_num']) OR !empty($data[1]['reg_num'])) { ?>
        <div style="text-align: center"><?php echo $Lang->reg_document ?></div>
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
        <?php }else{ ?>
        <input type="hidden" name="reg_num" value=""  />
        <?php }?>

        <!-- date_reg -->
        <?php if( !empty($data[0]['reg_date']) OR !empty($data[1]['reg_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->date_reg ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['reg_date'])) { ?>
                <input type="radio" name="reg_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="reg_date" value="<?php echo $data[0]['reg_date']?>" checked ><?php echo $data[0]['reg_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['reg_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="reg_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['reg_date']?><input type="radio" name="reg_date" value="<?php echo $data[1]['reg_date']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="reg_date" value=""  />
        <?php }?>

        <!-- director -->
        <?php if( !empty($data[0]['snb_director']) OR !empty($data[1]['snb_director'])) { ?>
        <div style="text-align: center"><?php echo $Lang->director ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['snb_director'])) { ?>
                <input type="radio" name="snb_director" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="snb_director" value="<?php echo $data[0]['snb_director']?>" checked ><?php echo $data[0]['snb_director']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['snb_director'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="snb_director" value="" />
                <?php } else { ?>
                <?php echo $data[1]['snb_director']?><input type="radio" name="snb_director" value="<?php echo $data[1]['snb_director']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="snb_director" value=""  />
        <?php }?>

        <!-- deputy_director -->
        <?php if( !empty($data[0]['snb_subdirector']) OR !empty($data[1]['snb_subdirector'])) { ?>
        <div style="text-align: center"><?php echo $Lang->deputy_director ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['snb_subdirector'])) { ?>
                <input type="radio" name="snb_subdirector" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="snb_subdirector" value="<?php echo $data[0]['snb_subdirector']?>" checked ><?php echo $data[0]['snb_subdirector']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['snb_subdirector'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="snb_subdirector" value="" />
                <?php } else { ?>
                <?php echo $data[1]['snb_subdirector']?><input type="radio" name="snb_subdirector" value="<?php echo $data[1]['snb_subdirector']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="snb_subdirector" value=""  />
        <?php }?>

        <!-- date_resolution -->
        <?php if( !empty($data[0]['resolution_date']) OR !empty($data[1]['resolution_date'])) { ?>
        <div style="text-align: center"><?php echo $Lang->date_resolution ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['resolution_date'])) { ?>
                <input type="radio" name="resolution_date" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="resolution_date" value="<?php echo $data[0]['resolution_date']?>" checked ><?php echo $data[0]['resolution_date']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['resolution_date'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="resolution_date" value="" />
                <?php } else { ?>
                <?php echo $data[1]['resolution_date']?><input type="radio" name="resolution_date" value="<?php echo $data[1]['resolution_date']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="resolution_date" value=""  />
        <?php }?>

        <!-- resolution -->
        <?php if( !empty($data[0]['resolution']) OR !empty($data[1]['resolution'])) { ?>
        <div style="text-align: center"><?php echo $Lang->resolution ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['resolution'])) { ?>
                <input type="radio" name="resolution" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="resolution" value="<?php echo $data[0]['resolution']?>" checked ><?php echo $data[0]['resolution']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['resolution'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="resolution" value="" />
                <?php } else { ?>
                <?php echo $data[1]['resolution']?><input type="radio" name="resolution" value="<?php echo $data[1]['resolution']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="resolution" value=""  />
        <?php }?>

        <!-- actor_name -->
        <?php if( !empty($data[0]['actor_name']) OR !empty($data[1]['actor_name'])) { ?>
        <div style="text-align: center"><?php echo $Lang->actor_name ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['actor_name'])) { ?>
                <input type="radio" name="actor_name" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="actor_name" value="<?php echo $data[0]['actor_name']?>" checked ><?php echo $data[0]['actor_name']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['actor_name'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="actor_name" value="" />
                <?php } else { ?>
                <?php echo $data[1]['actor_name']?><input type="radio" name="actor_name" value="<?php echo $data[1]['actor_name']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="actor_name" value=""  />
        <?php }?>

        <!-- sub_actor_name -->
        <?php if( !empty($data[0]['sub_actor_name']) OR !empty($data[1]['sub_actor_name'])) { ?>
        <div style="text-align: center"><?php echo $Lang->sub_actor_name ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['sub_actor_name'])) { ?>
                <input type="radio" name="sub_actor_name" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="sub_actor_name" value="<?php echo $data[0]['sub_actor_name']?>" checked ><?php echo $data[0]['sub_actor_name']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['sub_actor_name'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="sub_actor_name" value="" />
                <?php } else { ?>
                <?php echo $data[1]['sub_actor_name']?><input type="radio" name="sub_actor_name" value="<?php echo $data[1]['sub_actor_name']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="sub_actor_name" value=""  />
        <?php }?>

        <!-- result_execution -->
        <?php if( !empty($data[0]['result_id']) OR !empty($data[1]['result_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->result_execution ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['result_id'])) { ?>
                <input type="radio" name="result" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="result" value="<?php echo $data[0]['result_id']?>" checked ><?php echo $data[0]['result']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['result_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="result" value="" />
                <?php } else { ?>
                <?php echo $data[1]['result']?><input type="radio" name="result" value="<?php echo $data[1]['result_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="result" value=""  />
        <?php }?>

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
        <?php }else{ ?>
        <input type="hidden" name="bibliography_id" value=""  />
        <?php }?>

        <!-- unit -->
        <?php if( !empty($data[0]['unit_id']) OR !empty($data[1]['unit_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->unit ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['unit_id'])) { ?>
                <input type="radio" name="unit" value="" checked ><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="unit" value="<?php echo $data[0]['unit_id']?>" checked ><?php echo $data[0]['unit']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['unit_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="unit" value=""  >
                <?php } else { ?>
                <?php echo $data[1]['unit']?><input type="radio" name="unit" value="<?php echo $data[1]['unit_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="unit" value=""  />
        <?php }?>

        <!-- department_performer -->
        <?php if( !empty($data[0]['act_unit_id']) OR !empty($data[1]['act_unit_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->department_performer ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['act_unit_id'])) { ?>
                <input type="radio" name="department_performer" value="" checked ><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="department_performer" value="<?php echo $data[0]['act_unit_id']?>" checked ><?php echo $data[0]['act_unit']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['act_unit_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="department_performer" value="" />
                <?php } else { ?>
                <?php echo $data[1]['act_unit']?><input type="radio" name="department_performer" value="<?php echo $data[1]['act_unit_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="department_performer" value=""  />
        <?php }?>

        <!-- department_coauthors -->
        <?php if( !empty($data[0]['sub_act_unit']) OR !empty($data[1]['sub_act_unit'])) { ?>
        <div style="text-align: center"><?php echo $Lang->department_coauthors ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['sub_act_unit'])) { ?>
                <input type="radio" name="department_coauthors" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="department_coauthors" value="<?php echo $data[0]['sub_act_unit_id']?>" checked ><?php echo $data[0]['sub_act_unit']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['sub_act_unit'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="department_coauthors" value="" />
                <?php } else { ?>
                <?php echo $data[1]['sub_act_unit']?><input type="radio" name="department_coauthors" value="<?php echo $data[1]['sub_act_unit_id']?>" />
                <?php } ?>
            </label>
        </div>
        <?php }else{ ?>
        <input type="hidden" name="department_coauthors" value=""  />
        <?php } ?>

        <div class="forForm">
            <label style="width:500px;float:left">
                <input type="submit"  class="k-button" value="<?php echo $Lang->fusion?>">
            </label>
        </div>
    </form>
</div>