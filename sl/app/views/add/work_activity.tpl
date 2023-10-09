<a id="<?php echo $_SESSION['counter']; ?>closeWorkActivity" class="customClose"></a>
<span class="idNumber"><?php if(isset($work_activity)){ echo 'ID : '.$work_activity['id']; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>workActivityForm">

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>workPosition">1) <?php echo $Lang->position;?></label>
            <input type="text" name="position" id="<?php echo $_SESSION['counter']; ?>workPosition" class="oneInputSaveEnter" <?php if(isset($work_activity)){ if(!empty($work_activity['title'])){ echo "value='".$work_activity['title']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>workDataReferPeriod">2) <?php echo $Lang->data_refer_period;?></label>
            <input type="text" name="workPeriod" id="<?php echo $_SESSION['counter']; ?>workPeriod" class="oneInputSaveEnter" <?php if(isset($work_activity)){ if(!empty($work_activity['period'])){ echo "value='".$work_activity['period']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>workStartEmployment">3) <?php echo $Lang->start_employment;?></label>
            <input type="text" name="workStart_date" id="<?php echo $_SESSION['counter']; ?>workStartEmployment" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>workStartEmployment',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateWorkActivity<?php echo $_SESSION['counter']; ?>"/>
            <input type="hidden" id="<?php echo $_SESSION['counter']; ?>workStart_date" <?php if(isset($work_activity)){ if(!empty($work_activity['start_date'])){ echo "value='".$work_activity['start_date']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>workEndEmployment">4) <?php echo $Lang->end_employment;?></label>
            <input type="text" name="workEnd_date" id="<?php echo $_SESSION['counter']; ?>workEndEmployment" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>workEndEmployment',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateWorkActivity<?php echo $_SESSION['counter']; ?>"/>
            <input type="hidden" id="<?php echo $_SESSION['counter']; ?>workEnd_date" <?php if(isset($work_activity)){ if(!empty($work_activity['end_date'])){ echo "value='".$work_activity['end_date']."'"; } }?>/>
        </div>

        <?php if($other_tb_name == 'edit') { ?>
            <div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>workDataEmploymentPersons">5) <?php echo $Lang->data_employment_persons;?></label>
                <ul class="filterlist" style="border: none;" ><li  class="openData" data-id="<?php echo $work_activity['man_id']; ?>" data-tb="man">
                        <?php echo $Lang->short_man.' '.$work_activity['man_id']; ?></li><span class="editAll" style="position: fixed;"></span></ul>
            </div>
            <div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>workJobsOrganization">6) <?php echo $Lang->jobs_organization;?></label>
                <ul class="filterlist" style="border: none;" ><li class="openData" data-id="<?php echo $work_activity['organization_id']; ?>" data-tb="organization">
                        <?php echo $Lang->short_organ.' '.$work_activity['organization_id']; ?></li><span class="editAll" style="position: fixed;"></span></ul>
            </div>
        <?php } ?>

        <?php if($other_tb_name == 'organization') { ?>
            <div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>workDataEmploymentPersons">7) <?php echo $Lang->data_employment_persons;?></label>
                <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>workDataEmploymentPersonsFilter" style="border: none;" >&nbsp</ul>
                <input type="button" name="organ" id="<?php echo $_SESSION['counter']; ?>workDataEmploymentPersons" value="Добавить" class="oneInputSaveEnter"/>
                <!--input type="text" name="data_employment_persons" id="<?php echo $_SESSION['counter']; ?>workDataEmploymentPersons" class="oneInputSaveEnter"/-->
            </div>
        <?php } ?>

        <?php if($other_tb_name == 'man' ) { ?>
            <div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>workJobsOrganization">8) <?php echo $Lang->jobs_organization;?></label>
                <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>workJobsOrganizationFilter" style="border: none;" >&nbsp</ul>
                <input type="button" name="organ" id="<?php echo $_SESSION['counter']; ?>workJobsOrganization" value="Добавить" class="oneInputSaveEnter"/>
                <!--input type="text" name="jobs_organization" id="<?php echo $_SESSION['counter']; ?>workJobsOrganization" class="oneInputSaveEnter"/-->
            </div>
        <?php } ?>


        <div class="buttons"></div>

    </form>
</div>
<script>
    var currentInputNameWorkActivity;
    var currentInputIdWorkActivity;
    $(document).ready(function(){

        $('.oneInputSaveDateWorkActivity<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateWorkActivity<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            var val = $(this).val();
            var field = $(this).attr('name');
            var reg = date_preg;
            if( (typeof $(this).attr('type') != 'undefined')&&(val.length != 0) ){
                if( (val.length == 6)||(val.length == 8) ){
                    var day = val.slice(0,2);
                    var month = val.slice(2,4);
                    var year = val.slice(4,8);
                    if(year.length == 2){
                        year = '20'+year;
                    }
                    val = day+'-'+month+'-'+year;
                    if(reg.test(val)){
                        $(this).val(val);
                        $('#<?php echo $_SESSION['counter']; ?>'+field).val(val);
                    }else{
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }else{
                        $('#<?php echo $_SESSION['counter']; ?>'+field).val(val);
                    }
                }
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>workDataEmploymentPersons').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/man/work_activity/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->face;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>workJobsOrganization').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/organization/work_activity/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->organization;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>closeWorkActivity').click(function(e){
            e.preventDefault();
            <?php if($other_tb_name == 'organization') { ?>
                var man_id = $('#<?php echo $_SESSION['counter']; ?>valWorkActivityMan').val();
                if( (typeof man_id != 'undefined')&&(man_id.length != 0) ){
                    var data = {
                        'man_id'    : man_id,
                        'title'     : $('#<?php echo $_SESSION['counter']; ?>workPosition').val(),
                        'period'    : $('#<?php echo $_SESSION['counter']; ?>workPeriod').val(),
                        'start_date': $('#<?php echo $_SESSION['counter']; ?>workStart_date').val(),
                        'end_date'  : $('#<?php echo $_SESSION['counter']; ?>workEnd_date').val()
                    };
                    organization_has_work_activity<?php if(isset($old_counter)){ echo $old_counter; }?>(data);
                }else{
                    var removeManHasAddress = confirm('<?php echo $Lang->face_quit;?>');
                    if(removeManHasAddress){
                        removeItem();
                    }
                }
            <?php }elseif($other_tb_name == 'man') { ?>
                var org_id = $('#<?php echo $_SESSION['counter']; ?>valWorkActivityOrganization').val();
                if( (typeof org_id != 'undefined')&&(org_id.length != 0) ){
                    var data = {
                        'organization_id'    : org_id,
                        'title'     : $('#<?php echo $_SESSION['counter']; ?>workPosition').val(),
                        'period'    : $('#<?php echo $_SESSION['counter']; ?>workPeriod').val(),
                        'start_date': $('#<?php echo $_SESSION['counter']; ?>workStart_date').val(),
                        'end_date'  : $('#<?php echo $_SESSION['counter']; ?>workEnd_date').val()
                    };
                    man_has_work_activity<?php if(isset($old_counter)){ echo $old_counter; }?>(data);
                }else{
                    var removeManHasAddress = confirm('<?php echo $Lang->organization_quit;?>');
                    if(removeManHasAddress){
                        removeItem();
                    }
                }
            <?php }elseif($other_tb_name == 'edit') { ?>
                var data = {
                    'title'     : $('#<?php echo $_SESSION['counter']; ?>workPosition').val(),
                    'period'    : $('#<?php echo $_SESSION['counter']; ?>workPeriod').val(),
                    'start_date': $('#<?php echo $_SESSION['counter']; ?>workStart_date').val(),
                    'end_date'  : $('#<?php echo $_SESSION['counter']; ?>workEnd_date').val()
                };
                $.ajax({
                    url: '<?php echo ROOT?>add/edit_work_activity/<?php echo $work_activity['id']; ?>',
                    type: 'POST',
                    data:data,
                    success: function(data){
                        removeItem();
                    },
                    faild: function(data){
                        alert('<?php echo $Lang->err;?> ');
                    }
                });
            <?php } ?>
        });

        <?php if(isset($work_activity)) { ?>
            <?php if(!empty($work_activity['start_date'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>workStartEmployment').val('<?php echo $work_activity['start_date']; ?>');
            <?php } ?>
            <?php if(!empty($work_activity['start_date'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>workEndEmployment').val('<?php echo $work_activity['end_date']; ?>');
            <?php } ?>
        <?php } ?>

    });

    function work_activity_man<?php echo $_SESSION['counter']; ?>(man_id , check = null , data = null ){
        removeItem();
        $('#<?php echo $_SESSION['counter']; ?>workDataEmploymentPersonsFilter').html('<li id="<?php echo $_SESSION['counter']; ?>workActivityMan"><input type="hidden" id="<?php echo $_SESSION['counter']; ?>valWorkActivityMan" value="'+man_id+'"/>'
                +'<div class="item">'
                +'<span class="openData" data-id="'+man_id+'" data-tb="man"> <?php echo $Lang->short_man; ?> : '+man_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeWorkActivityMan<?php echo $_SESSION['counter']; ?>('+man_id+');">x</a>'
                +'</div>'
                +'</li>');
        $('#<?php echo $_SESSION['counter']; ?>workDataEmploymentPersons').focus();

    }
    function removeWorkActivityMan<?php echo $_SESSION['counter']; ?>(man_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $('#<?php echo $_SESSION['counter']; ?>workDataEmploymentPersonsFilter').html('&nbsp;');
            $('#<?php echo $_SESSION['counter']; ?>workDataEmploymentPersons').focus();
        }
    }

    function work_activity_organization<?php echo $_SESSION['counter']; ?>(organization_id , check = null , data = null ){
        removeItem();
        $('#<?php echo $_SESSION['counter']; ?>workJobsOrganizationFilter').html('<li id="<?php echo $_SESSION['counter']; ?>workActivityOrganization"><input type="hidden" id="<?php echo $_SESSION['counter']; ?>valWorkActivityOrganization" value="'+organization_id+'"/>'
                +'<div class="item">'
                +'<span class="openData" data-id="'+organization_id+'" data-tb="organization" ><?php echo $Lang->short_organ; ?> : '+organization_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeWorkActivityOrganization<?php echo $_SESSION['counter']; ?>('+organization_id+');">x</a>'
                +'</div>'
                +'</li>');
        $('#<?php echo $_SESSION['counter']; ?>workJobsOrganization').focus();

    }
    function removeWorkActivityOrganization<?php echo $_SESSION['counter']; ?>(organization_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $('#<?php echo $_SESSION['counter']; ?>workJobsOrganizationFilter').html('&nbsp;');
            $('#<?php echo $_SESSION['counter']; ?>workJobsOrganization').focus();
        }
    }
</script>

