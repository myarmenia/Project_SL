<a id="<?php echo $_SESSION['counter']; ?>closeManBeanCountry" class="customClose"></a>
<span class="idNumber"><?php if(isset($mbc['id'])){ echo 'ID : '.$mbc['id']; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>manBeanCountryForm">
        <input type="hidden" name="man_id" value="<?php echo $man_id?>" />
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>mbcPurposeVisit">1) <?php echo $Lang->purpose_visit;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>mbcPurposeVisit" dataId="<?php echo $_SESSION['counter']; ?>mbcPurposeVisitId"dataTableName="fancy/goal" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus" />
            <input type="text" name="goal" id="<?php echo $_SESSION['counter']; ?>mbcPurposeVisit"dataTableName="goal" dataInputId="<?php echo $_SESSION['counter']; ?>mbcPurposeVisitId" class="oneInputSaveEnter" <?php if(isset($mbc)){ if(!empty($mbc['goal'])){ echo "value='".$mbc['goal']."'"; } }?>/>
            <input type="hidden" name="goal_id" id="<?php echo $_SESSION['counter']; ?>mbcPurposeVisitId" <?php if(isset($mbc)){ if(!empty($mbc['goal_id'])){ echo "value='".$mbc['goal_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>mbcCountryAte">2) <?php echo $Lang->country_ate;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>mbcCountryAte" dataId="<?php echo $_SESSION['counter']; ?>mbcCountryAteId"dataTableName="fancy/country_ate" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus" />
            <input type="text" name="country_ate" id="<?php echo $_SESSION['counter']; ?>mbcCountryAte"dataTableName="country_ate" dataInputId="<?php echo $_SESSION['counter']; ?>mbcCountryAteId" class="oneInputSaveEnter" <?php if(isset($mbc)){ if(!empty($mbc['country_ate'])){ echo "value='".$mbc['country_ate']."'"; } }?>/>
            <input type="hidden" name="country_ate_id" id="<?php echo $_SESSION['counter']; ?>mbcCountryAteId" <?php if(isset($mbc)){ if(!empty($mbc['country_ate_id'])){ echo "value='".$mbc['country_ate_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>mbcEntryDate">3) <?php echo $Lang->entry_date;?></label>
            <input type="text" name="entry_date" id="<?php echo $_SESSION['counter']; ?>mbcEntryDate" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>mbcEntryDate',12)"  class="oneInputSaveEnter dotsToDash oneInputSaveDateManBeanCountry<?php echo $_SESSION['counter']; ?>" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>mbcExitDate">4) <?php echo $Lang->exit_date;?></label>
            <input type="text" name="exit_date" id="<?php echo $_SESSION['counter']; ?>mbcExitDate" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>mbcExitDate',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateManBeanCountry<?php echo $_SESSION['counter']; ?>" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>mbcRegionLocal">5) <?php echo $Lang->region_local;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>mbcRegionLocal" dataId="<?php echo $_SESSION['counter']; ?>mbcRegionLocalId"dataTableName="fancy/region" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus" />
            <input type="text" name="region_name" id="<?php echo $_SESSION['counter']; ?>mbcRegionLocal"dataTableName="region" dataInputId="<?php echo $_SESSION['counter']; ?>mbcRegionLocalId" class="oneInputSaveEnter" <?php if(isset($mbc)){ if((!empty($mbc['region']))&&(!empty($mbc['checkRegion'])) ){ echo "value='".$mbc['region']."'"; } }?>/>
            <input type="hidden" name="region_id" id="<?php echo $_SESSION['counter']; ?>mbcRegionLocalId" <?php if(isset($mbc)){ if((!empty($mbc['region_id']))&&(!empty($mbc['checkRegion'])) ){ echo "value='".$mbc['region_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>mbcLocalityLocal">6) <?php echo $Lang->locality_local;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>mbcLocalityLocal" dataId="<?php echo $_SESSION['counter']; ?>mbcLocalityLocalId"dataTableName="fancy/locality" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus" />
            <input type="text" name="locality_local" id="<?php echo $_SESSION['counter']; ?>mbcLocalityLocal"dataTableName="locality" dataInputId="<?php echo $_SESSION['counter']; ?>mbcLocalityLocalId" class="oneInputSaveEnter" <?php if(isset($mbc)){ if((!empty($mbc['locality']))&&(!empty($mbc['checkLocality'])) ){ echo "value='".$mbc['locality']."'"; } }?>/>
            <input type="hidden" name="locality_id" id="<?php echo $_SESSION['counter']; ?>mbcLocalityLocalId" <?php if(isset($mbc)){ if((!empty($mbc['locality_id']))&&(!empty($mbc['checkLocality'])) ){ echo "value='".$mbc['locality_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>mbcRegion">7) <?php echo $Lang->region;?></label>
            <input type="text" name="region" id="<?php echo $_SESSION['counter']; ?>mbcRegion" class="oneInputSaveEnter" <?php if(isset($mbc)){ if((!empty($mbc['region']))&&(empty($mbc['checkRegion'])) ){ echo "value='".$mbc['region']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>mbcLocality">8) <?php echo $Lang->locality;?></label>

            <input type="text" name="locality" id="<?php echo $_SESSION['counter']; ?>mbcLocality" class="oneInputSaveEnter" <?php if(isset($mbc)){ if((!empty($mbc['locality']))&&(empty($mbc['checkLocality'])) ){ echo "value='".$mbc['locality']."'"; } }?>/>

        </div>

        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>mbcInformationPresence"><?php echo $Lang->information_presence;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>mbcInformationPresence" dataId="<?php echo $_SESSION['counter']; ?>mbcInformationPresenceId"dataTableName="fancy/3" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus" />
            <input type="text" name="information_presence" id="<?php echo $_SESSION['counter']; ?>mbcInformationPresence"/>
            <input type="hidden" name="information_presence_id" id="<?php echo $_SESSION['counter']; ?>mbcInformationPresenceId" />
        </div-->

        <div class="forForm">
            <label>9) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($mbc)) {
                        if(!empty($mbc['man_id'])) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $mbc['man_id']; ?>" data-tb="man" ><?php echo $Lang->short_man; ?> : <?php echo $mbc['man_id']; ?></span>
                        <span class="editAll"></span><a> </a>
                    </div>
                </li>
                <?php
                        }
                      } ?>
                &nbsp
            </ul>
        </div>

        <div class="buttons"></div>

    </form>
</div>




<script>
    var currentInputNameMbc<?php echo $_SESSION['counter']; ?>;
    var currentInputIdMbc<?php echo $_SESSION['counter']; ?>;

    $(document).ready(function(){

        $('.oneInputSaveDateManBeanCountry<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('.oneInputSaveDateManBeanCountry<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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
                    }else{
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>mbcPurposeVisit').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/goal/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>mbcPurposeVisitId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>mbcPurposeVisit').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>mbcPurposeVisit').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>mbcPurposeVisitId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>mbcPurposeVisitId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    alert('<?php echo $Lang->enter_correct;?>');
                    $('#<?php echo $_SESSION['counter']; ?>mbcPurposeVisit').val('');
                    $('#<?php echo $_SESSION['counter']; ?>mbcPurposeVisitId').val('');
                }
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>mbcCountryAte').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/country_ate/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>mbcCountryAteId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>mbcCountryAte').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>mbcCountryAte').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>mbcCountryAteId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>mbcCountryAteId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    alert('<?php echo $Lang->enter_correct;?>');
                    $('#<?php echo $_SESSION['counter']; ?>mbcCountryAte').val('');
                    $('#<?php echo $_SESSION['counter']; ?>mbcCountryAteId').val('');
                }
            }
        });

         $('#<?php echo $_SESSION['counter']; ?>mbcRegionLocal').kendoAutoComplete({
                    dataTextField: "name",
                    dataSource: {
                        transport: {
                            read:{
                                dataType: "json",
                                url: "<?php echo ROOT;?>dictionary/region/read"
                            }
                        }
                    },
                    select:function(e){
                        var dataItem = this.dataItem(e.item.index());
                        $('#<?php echo $_SESSION['counter']; ?>mbcRegionLocalId').val(dataItem.id);
                    }
          });

        $('#<?php echo $_SESSION['counter']; ?>mbcRegionLocal').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>mbcRegionLocal').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>mbcRegionLocalId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>mbcRegionLocalId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    alert('<?php echo $Lang->enter_correct;?>');
                    $('#<?php echo $_SESSION['counter']; ?>mbcRegionLocal').val('');
                    $('#<?php echo $_SESSION['counter']; ?>mbcRegionLocalId').val('');
                }
            }
        });

         $('#<?php echo $_SESSION['counter']; ?>mbcLocalityLocal').kendoAutoComplete({
                    dataTextField: "name",
                    filter: "contains",
                    minLength: 3,
                    dataSource: {
                        transport: {
                            read:{
                                dataType: "json",
                                url: "<?php echo ROOT;?>dictionary/locality/read"
                            }
                        }
                    },
                    select:function(e){
                        var dataItem = this.dataItem(e.item.index());
                        $('#<?php echo $_SESSION['counter']; ?>mbcLocalityLocalId').val(dataItem.id);
                    }
        });

        $('#<?php echo $_SESSION['counter']; ?>mbcLocalityLocal').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>mbcLocalityLocal').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>mbcLocalityLocalId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>mbcLocalityLocalId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    alert('<?php echo $Lang->enter_correct;?>');
                    $('#<?php echo $_SESSION['counter']; ?>mbcLocalityLocal').val('');
                    $('#<?php echo $_SESSION['counter']; ?>mbcLocalityLocalId').val('');
                }
            }
        });



        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameMbc<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdMbc<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=man_bean_country&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>closeManBeanCountry').click(function(e){
            e.preventDefault();
            var country_ate_id = $('#<?php echo $_SESSION['counter']; ?>mbcCountryAteId').val();
            if(country_ate_id.length == 0){
                var checkConfirm = confirm('<?php echo $Lang->country_quit;?>');
                if(checkConfirm){
                    removeItem();
                }
            }else{
                var data = $('#<?php echo $_SESSION['counter']; ?>manBeanCountryForm').serializeArray();
                <?php if(isset($mbc)) { ?>
                    $.ajax({
                        url: '<?php echo ROOT?>add/edit_man_bean_country/<?php echo $mbc['id']; ?>',
                        type: 'POST',
                        data:data,
                        success: function(data){
                            removeItem();
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                <?php }else{ ?>
                    man_bean_country<?php if(isset($old_counter)){ echo $old_counter; }?>(data);
                <?php } ?>
            }
        });

        <?php if(isset($mbc)) { ?>
            <?php if(!empty($mbc['entry_date'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>mbcEntryDate').val('<?php echo $mbc['entry_date']; ?>');
            <?php } ?>
            <?php if(!empty($mbc['exit_date'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>mbcExitDate').val('<?php echo $mbc['exit_date']; ?>');
            <?php } ?>
        <?php } ?>

    });
    function closeManBeanCountry<?php echo $_SESSION['counter']; ?>(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameMbc<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdMbc<?php echo $_SESSION['counter']; ?>).val(id);
        var field = $('#'+currentInputIdMbc<?php echo $_SESSION['counter']; ?>).attr('name');
//        saveManBeanCountry(id,field);
        $.fancybox.close();
        $('#'+currentInputNameMbc<?php echo $_SESSION['counter']; ?>).focus();
    }

//    function saveManBeanCountry(value,field){
//        var data = { 'value':value, 'field':field };
//        $.ajax({
//            url: '<?php echo ROOT?>add/save_man_bean_country/'+mbc_id,
//            type: 'POST',
//            data:data,
//            success: function(data){
//                checkMan = false;
//            },
//            faild: function(data){
//                alert('error ');
//            }
//        });
//    }


</script>


