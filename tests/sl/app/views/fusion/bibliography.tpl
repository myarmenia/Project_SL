<div class="inContent">
    <form id="BibliographyForm" method="post" action="<?php echo ROOT.'fusion/fusion_bibliography/'?>">
        <?php  //var_dump($data);die; ?>
        <div class="forForm">
            <label><?php echo $Lang->bibliography.' '.$data[0]['id']?></label>
            <label style="float: right !important;"><?php echo $Lang->bibliography.' '.$data[1]['id']?></label>
        </div>
        <input type="hidden" name="id" value="<?php echo $data[0]['id']?>"  />
        <input type="hidden" name="deleted_id" value="<?php echo $data[1]['id']?>"  />

        <!-- user -->
        <?php if( !empty($data[0]['user_id']) OR !empty($data[1]['user_id'])) { ?>
            <div style="text-align: center"><?php echo $Lang->created_user; ?></div>
            <div class="forForm">
                <label>
                    <?php if(empty($data[0]['user_id'])) { ?>
                        <input type="radio" name="user_id" value="" checked /><?php echo $Lang->empty; ?>
                    <?php } else { ?>
                        <input type="radio" name="user_id" value="<?php echo $data[0]['user_id']?>" checked ><?php echo $data[0]['user_name']?>
                    <?php } ?>
                </label>
                <label style="float: right !important;">
                    <?php if(empty($data[1]['user_id'])) { ?>
                        <?php echo $Lang->empty; ?><input type="radio" name="user_id" value="" />
                    <?php } else { ?>
                        <?php echo $data[1]['user_name']?><input type="radio" name="user_id" value="<?php echo $data[1]['user_id']?>" />
                    <?php } ?>
                </label>
            </div>
            <div class="forForm">
                <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
            </div>
        <?php }else{ ?>
            <input type="hidden" name="user_id" value=""  />
        <?php } ?>

        <!-- title -->
        <?php if( !empty($data[0]['title']) OR !empty($data[1]['title'])) { ?>
        <div style="text-align: center"><?php echo $Lang->title_document; ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['title'])) { ?>
                <input type="radio" name="title" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="title" value="<?php echo $data[0]['title']?>" checked ><?php echo $data[0]['title']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['title'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="title" value="" />
                <?php } else { ?>
                <?php echo $data[1]['title']?><input type="radio" name="title" value="<?php echo $data[1]['title']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="title" value=""  />
        <?php } ?>

        <!-- category_id -->
        <?php if( !empty($data[0]['category_id']) OR !empty($data[1]['category_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->document_category ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['category_id'])) { ?>
                <input type="radio" name="category_id" value="NULL" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="category_id" value="<?php echo $data[0]['category_id']?>" checked ><?php echo $data[0]['doc_category']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['category_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="category_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['doc_category']?><input type="radio" name="category_id" value="<?php echo $data[1]['category_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="category_id" value=""  />
        <?php } ?>

        <!-- access_level_id -->
        <?php if( !empty($data[0]['access_level_id']) OR !empty($data[1]['access_level_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->access_level ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['access_level_id'])) { ?>
                <input type="radio" name="access_level_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="access_level_id" value="<?php echo $data[0]['access_level_id']?>" checked ><?php echo $data[0]['access_level'];?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['access_level_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="access_level_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['access_level'];?><input type="radio" name="access_level_id" value="<?php echo $data[1]['access_level_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="access_level_id" value=""  />
        <?php } ?>

        <!-- source_agency_id -->
        <?php if( !empty($data[0]['source_agency_id']) OR !empty($data[1]['source_agency_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->source_agency ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['source_agency_id'])) { ?>
                <input type="radio" name="source_agency_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="source_agency_id" value="<?php echo $data[0]['source_agency_id']?>" checked ><?php echo $data[0]['source_agency']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['source_agency_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="source_agency_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['source_agency']?><input type="radio" name="source_agency_id" value="<?php echo $data[1]['source_agency_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="source_agency_id" value=""  />
        <?php } ?>

        <!-- from_agency_id -->
        <?php if( !empty($data[0]['from_agency_id']) OR !empty($data[1]['from_agency_id'])) { ?>
        <div style="text-align: center"><?php echo $Lang->organ ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['from_agency_id'])) { ?>
                <input type="radio" name="from_agency_id" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="from_agency_id" value="<?php echo $data[0]['from_agency_id']?>" checked ><?php echo $data[0]['from_agency']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['from_agency_id'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="from_agency_id" value="" />
                <?php } else { ?>
                <?php echo $data[1]['from_agency']?><input type="radio" name="from_agency_id" value="<?php echo $data[1]['from_agency_id']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="from_agency_id" value=""  />
        <?php } ?>

        <!-- source -->
        <?php if( !empty($data[0]['source']) OR !empty($data[1]['source'])) { ?>
        <div style="text-align: center"><?php echo $Lang->source_agency ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['source'])) { ?>
                <input type="radio" name="source" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="source" value="<?php echo $data[0]['source']?>" checked ><?php echo $data[0]['source']; ?>
                <input type="hidden" name="source" value="<?php echo $data[1]['source']?>" />
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['source'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="source" value="" />
                <?php } else { ?>
                <?php echo $data[1]['source'];?><input type="radio" name="source" value="<?php echo $data[1]['source']?>" />
                <input type="hidden" name="source" value="<?php echo $data[1]['source']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="source" value=""  />
        <?php } ?>

        <!-- short_desc -->
        <?php if( !empty($data[0]['short_desc']) OR !empty($data[1]['short_desc'])) { ?>
        <div style="text-align: center"><?php echo $Lang->short_desc ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['short_desc'])) { ?>
                <input type="radio" name="short_desc" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="short_desc" value="<?php echo $data[0]['short_desc']?>" checked ><?php echo $data[0]['short_desc']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['short_desc'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="short_desc" value="" />
                <?php } else { ?>
                <?php echo $data[1]['short_desc']?><input type="radio" name="short_desc" value="<?php echo $data[1]['short_desc']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="short_desc" value=""  />
        <?php } ?>

        <!-- related_year -->
        <?php if( !empty($data[0]['related_year']) OR !empty($data[1]['related_year'])) { ?>
        <div style="text-align: center"><?php echo $Lang->related_year ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['related_year'])) { ?>
                <input type="radio" name="related_year" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="related_year" value="<?php echo $data[0]['related_year']?>" checked ><?php echo $data[0]['related_year']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['related_year'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="related_year" value="" />
                <?php } else { ?>
                <?php echo $data[1]['related_year']?><input type="radio" name="related_year" value="<?php echo $data[1]['related_year']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="related_year" value=""  />
        <?php } ?>

        <!-- country_id -->
        <?php if( !empty($data_chek['getBibliographyHasCountry'])) { ?>
        <div style="text-align: center"><?php echo $Lang->information_country; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getBibliographyHasCountry'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getBibliographyHasCountry[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name'] ; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>


        <!-- theme -->
        <?php if( !empty($data[0]['theme']) OR !empty($data[1]['theme'])) { ?>
        <div style="text-align: center"><?php echo $Lang->name_subject ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['theme'])) { ?>
                <input type="radio" name="theme" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="theme" value="<?php echo $data[0]['theme']?>" checked ><?php echo $data[0]['theme']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['theme'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="theme" value="" />
                <?php } else { ?>
                <?php echo $data[1]['theme']?><input type="radio" name="theme" value="<?php echo $data[1]['theme']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="theme" value=""  />
        <?php } ?>

        <!-- source_address -->
        <?php if( !empty($data[0]['source_address']) OR !empty($data[1]['source_address'])) { ?>
        <div style="text-align: center"><?php echo $Lang->source_address ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['source_address'])) { ?>
                <input type="radio" name="source_address" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="source_address" value="<?php echo $data[0]['source_address']?>" checked ><?php echo $data[0]['source_address']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['source_address'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="source_address" value="" />
                <?php } else { ?>
                <?php echo $data[1]['source_address']?><input type="radio" name="source_address" value="<?php echo $data[1]['source_address']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="source_address" value=""  />
        <?php } ?>

        <!-- worker_name -->
        <?php if( !empty($data[0]['worker_name']) OR !empty($data[1]['worker_name'])) { ?>
        <div style="text-align: center"><?php echo $Lang->worker_take_doc ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['worker_name'])) { ?>
                <input type="radio" name="worker_name" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="worker_name" value="<?php echo $data[0]['worker_name']?>" checked ><?php echo $data[0]['worker_name']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['worker_name'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="worker_name" value="" />
                <?php } else { ?>
                <?php echo $data[1]['worker_name']?><input type="radio" name="worker_name" value="<?php echo $data[1]['worker_name']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="worker_name" value=""  />
        <?php } ?>

        <!-- reg_number -->
        <?php if( !empty($data[0]['reg_number']) OR !empty($data[1]['reg_number'])) { ?>
        <div style="text-align: center"><?php echo $Lang->reg_document ?></div>
        <div class="forForm">
            <label>
                <?php if(empty($data[0]['reg_number'])) { ?>
                <input type="radio" name="reg_number" value="" checked /><?php echo $Lang->empty; ?>
                <?php } else { ?>
                <input type="radio" name="reg_number" value="<?php echo $data[0]['reg_number']?>" checked ><?php echo $data[0]['reg_number']?>
                <?php } ?>
            </label>
            <label style="float: right !important;">
                <?php if(empty($data[1]['reg_number'])) { ?>
                <?php echo $Lang->empty; ?><input type="radio" name="reg_number" value="" />
                <?php } else { ?>
                <?php echo $data[1]['reg_number']?><input type="radio" name="reg_number" value="<?php echo $data[1]['reg_number']?>" />
                <?php } ?>
            </label>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="reg_number" value=""  />
        <?php } ?>

        <!-- reg_date -->
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
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }else{ ?>
        <input type="hidden" name="reg_date" value=""  />
        <?php } ?>



        <!-- getBibliographyHasMan -->
        <?php if( !empty($data_chek['getBibliographyHasMan'])) { ?>
        <div style="text-align: center"><?php echo $Lang->face ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getBibliographyHasMan'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getBibliographyHasMan[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id'] ; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getBibliographyHasOrganization -->
        <?php if( !empty($data_chek['getBibliographyHasOrganization'])) { ?>
        <div style="text-align: center"><?php echo $Lang->organization ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getBibliographyHasOrganization'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getBibliographyHasOrganization[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getBibliographyHasEvent -->
        <?php if( !empty($data_chek['getBibliographyHasEvent'])) { ?>
        <div style="text-align: center"><?php echo $Lang->event ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getBibliographyHasEvent'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getBibliographyHasEvent[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getBibliographyHasSignal -->
        <?php if( !empty($data_chek['getBibliographyHasSignal'])) { ?>
        <div style="text-align: center"><?php echo $Lang->signal ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getBibliographyHasSignal'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getBibliographyHasSignal[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getBibliographyHasCriminalCase -->
        <?php if( !empty($data_chek['getBibliographyHasCriminalCase'])) { ?>
        <div style="text-align: center"><?php echo $Lang->criminal_case ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getBibliographyHasCriminalCase'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getBibliographyHasCriminalCase[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getBibliographyHasAction -->
        <?php if( !empty($data_chek['getBibliographyHasAction'])) { ?>
        <div style="text-align: center"><?php echo $Lang->action ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getBibliographyHasAction'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getBibliographyHasAction[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getBibliographyHasControl -->
        <?php if( !empty($data_chek['getBibliographyHasControl'])) { ?>
        <div style="text-align: center"><?php echo $Lang->control ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getBibliographyHasControl'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getBibliographyHasControl[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getBibliographyHasMiaSummary -->
        <?php if( !empty($data_chek['getBibliographyHasMiaSummary'])) { ?>
        <div style="text-align: center"><?php echo $Lang->mia_summary ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getBibliographyHasMiaSummary'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getBibliographyHasMiaSummary[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['id']; //var_dump($value) ;?>
            </label>
            <?php }?>
        </div>
        <div class="forForm">
            <hr style="border:dashed #00CCFF; border-width:1px 0 0 0; height:0;line-height:0px;font-size:0;margin:0;padding:0;">
        </div>
        <?php }?>

        <!-- getBibliographyHasFile -->
        <?php if( !empty($data_chek['getBibliographyHasFile'])) { ?>
        <div style="text-align: center"><?php echo $Lang->contents_document; ?></div>
        <div class="forForm">
            <?php foreach($data_chek['getBibliographyHasFile'] as $value){ ?>
            <label style="text-align: center">
                <input type="checkbox" name="getBibliographyHasFile[]" value="<?php echo $value['id'] ?>" checked /><?php echo $value['name']; //var_dump($value) ;?>
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
