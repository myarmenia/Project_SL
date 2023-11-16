<a class="closeButton" id="<?php echo $_SESSION['counter']; ?>closeCar"></a>
<span class="idNumber"><?php if(isset($car_id)){ echo 'ID : '.$car_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>carForm">




        <div class="forForm">
            <label for="carCategory">1) <?php echo $Lang->car_cat;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>carCategory"  dataId="<?php echo $_SESSION['counter']; ?>carCategoryId" dataTableName="fancy/car_category" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="category" id="<?php echo $_SESSION['counter']; ?>carCategory" dataInputId="<?php echo $_SESSION['counter']; ?>carCategoryId" dataTableName="car_category" class="oneInputSaveEnter" <?php if(isset($car)){ if(!empty($car['car_category'])){ echo "value='".$car['car_category']."'"; } }?> />
            <input type="hidden" name="category_id" id="<?php echo $_SESSION['counter']; ?>carCategoryId" <?php if(isset($car)){ if(!empty($car['category_id'])){ echo "value='".$car['category_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="carView">2) <?php echo $Lang->mark;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>carView"  dataId="<?php echo $_SESSION['counter']; ?>carViewId" dataTableName="fancy/car_mark" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="mark" id="<?php echo $_SESSION['counter']; ?>carView" dataInputId="<?php echo $_SESSION['counter']; ?>carViewId" dataTableName="car_mark" class="oneInputSaveEnter" <?php if(isset($car)){ if(!empty($car['car_mark'])){ echo "value='".$car['car_mark']."'"; } }?>/>
            <input type="hidden" name="mark_id" id="<?php echo $_SESSION['counter']; ?>carViewId" <?php if(isset($car)){ if(!empty($car['mark_id'])){ echo "value='".$car['mark_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="carColor">3) <?php echo $Lang->color;?></label>
            <input  type="text" name="color_id" id="<?php echo $_SESSION['counter']; ?>carColor" class="oneInputSaveCar<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($car)){ if(!empty($car['color'])){ echo "value='".$car['color']."'"; } }?> />
        </div>

        <div class="forForm">
            <label for="carCarNumber">4) <?php echo $Lang->car_number;?></label>
            <input class="oneInputSaveCar<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" type="text" name="number" id="<?php echo $_SESSION['counter']; ?>carCarNumber" <?php if(isset($car)){ if(!empty($car['number'])){ echo "value='".$car['number']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="carCount">5) <?php echo $Lang->count;?></label>
            <input class="oneInputSaveCar<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>carCount',20)" type="text" name="count" id="<?php echo $_SESSION['counter']; ?>carCount" <?php if(isset($car)){ if(!empty($car['count'])){ echo "value='".$car['count']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="carAdditionalData">6) <?php echo $Lang->additional_data;?></label>
            <input class="oneInputSaveCar<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" type="text" name="note" id="<?php echo $_SESSION['counter']; ?>carAdditionalData" <?php if(isset($car)){ if(!empty($car['note'])){ echo "value='".$car['note']."'"; } }?> />
        </div>

        <!--div class="forForm">
            <label for="carPersonOrganization"><?php echo $Lang->person_organization;?></label>
            <input  type="text" name="person_organization" id="<?php echo $_SESSION['counter']; ?>carPersonOrganization" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="carPersonAddress"><?php echo $Lang->person_address;?></label>
            <input type="text" name="person_address" id="<?php echo $_SESSION['counter']; ?>carPersonAddress" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="carActionsEvents"><?php echo $Lang->actions_events;?></label>
            <input type="text" name="actions_events" id="<?php echo $_SESSION['counter']; ?>carActionsEvents" class="oneInputSaveEnter"/>
        </div-->

        <div class="forForm">
            <label>7) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($car_has)) {
                        if(!empty($car_has)) {
                            foreach($car_has as $val) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['id']; ?>" data-tb="<?php echo $val['tb']; ?>" ><?php echo $Lang->$val['short']; ?> : <?php echo $val['id']; ?></span>
                        <span class="editAll"></span><a> </a>
                    </div>
                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
        </div>

        <div class="buttons"></div>

    </form>
</div>


<script>
    var currentInputNameCar<?php echo $_SESSION['counter']; ?>;
    var currentInputIdCar<?php echo $_SESSION['counter']; ?>;
    var car_id<?php echo $_SESSION['counter']; ?> = 0;
    var car_id<?php echo $_SESSION['counter']; ?> = '<?php echo $car_id; ?>';
    <?php if(!isset($car)) { ?>
        var checkCar<?php echo $_SESSION['counter']; ?> = true;
    <?php }else{ ?>
        var checkCar<?php echo $_SESSION['counter']; ?> = false;
    <?php } ?>

    $(document).ready(function(){

       $('#<?php echo $_SESSION['counter']; ?>carColor').focusout(function(e){
           e.preventDefault();
          var text = $('#<?php echo $_SESSION['counter']; ?>carColor').val();
           if(text.length != 0){
               $.ajax({
                   url: '<?php echo ROOT?>add/car_color/'+car_id<?php echo $_SESSION['counter']; ?>,
                   type: 'POST',
                   data:{ 'color':text },
                   success: function(data){
                        checkCar<?php echo $_SESSION['counter']; ?> = false;
                   },
                   faild: function(data){
                        alert('<?php echo $Lang->err;?> ');
                   }
                });
            }
        });




        $('#<?php echo $_SESSION['counter']; ?>carCategory').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/car_category/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>carCategoryId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>carCategory').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>carCategory').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>carCategoryId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>carCategoryId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveCar<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_category;?>');
                    $('#<?php echo $_SESSION['counter']; ?>carCategory').val('');
                    $('#<?php echo $_SESSION['counter']; ?>carCategoryId').val('');
                }else{
                    saveCar<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveCar<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>carView').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/car_mark/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>carViewId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>carView').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>carView').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>carViewId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>carViewId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveCar<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_mark;?>');
                    $('#<?php echo $_SESSION['counter']; ?>carView').val('');
                    $('#<?php echo $_SESSION['counter']; ?>carViewId').val('');
                }else{
                    saveCar<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveCar<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });


        $('.oneInputSaveCar<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                saveCar<?php echo $_SESSION['counter']; ?>(value,field);
            }else{
                saveCar<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });



        $('#<?php echo $_SESSION['counter']; ?>closeCar').click(function(e){
            e.preventDefault();
            if(checkCar<?php echo $_SESSION['counter']; ?>){
                var confCar = confirm('<?php echo $Lang->enter_anything;?>\n <?php echo $Lang->delete_entry;?>');
                if(confCar){
                    $.ajax({
                        url: '<?php echo ROOT?>add/car_delete/'+car_id<?php echo $_SESSION['counter']; ?>,
                        success: function(data){
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    <?php if (isset($other_tb_name)) { ?>
                        <?php if($other_tb_name == 'man_use') { ?>
                            man_use_car<?php if(isset($old_counter)){ echo $old_counter; }?>(car_id<?php echo $_SESSION['counter']; ?> , 'ok');
                        <?php }elseif($other_tb_name == 'man') { ?>
                            man_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(car_id<?php echo $_SESSION['counter']; ?>,'ok');
                        <?php }elseif($other_tb_name == 'organization') { ?>
                            organization_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(car_id<?php echo $_SESSION['counter']; ?> , 'ok');
                        <?php }elseif($other_tb_name == 'event') { ?>
                            event_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(car_id<?php echo $_SESSION['counter']; ?>,'ok');
                        <?php }elseif($other_tb_name == 'action') { ?>
                            action_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(car_id<?php echo $_SESSION['counter']; ?>, 'ok');
                        <?php } ?>
                    <?php } ?>
                }
            }else{
                <?php if (isset($other_tb_name)) { ?>
                    <?php if($other_tb_name == 'man_use') { ?>
                        man_use_car<?php if(isset($old_counter)){ echo $old_counter; }?>(car_id<?php echo $_SESSION['counter']; ?> , 'ok');
                    <?php }elseif($other_tb_name == 'man') { ?>
                        man_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(car_id<?php echo $_SESSION['counter']; ?>,'ok');
                    <?php }elseif($other_tb_name == 'organization') { ?>
                        organization_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(car_id<?php echo $_SESSION['counter']; ?> , 'ok');
                    <?php }elseif($other_tb_name == 'event') { ?>
                        event_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(car_id<?php echo $_SESSION['counter']; ?>,'ok');
                    <?php }elseif($other_tb_name == 'action') { ?>
                        action_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(car_id<?php echo $_SESSION['counter']; ?>, 'ok');
                    <?php } ?>
                <?php } ?>
            }
        });



        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameCar<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdCar<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=car&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

    });

    function closeFCar<?php echo $_SESSION['counter']; ?>(name,id){
    //        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameCar<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdCar<?php echo $_SESSION['counter']; ?>).val(id);
        var field = $('#'+currentInputIdCar<?php echo $_SESSION['counter']; ?>).attr('name');
        saveCar<?php echo $_SESSION['counter']; ?>(id,field);
        $.fancybox.close();
    }

    function saveCar<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value,'field':field };
        $.ajax({
            url: '<?php echo ROOT?>add/car_save/'+car_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            success: function(data){
                checkCar<?php echo $_SESSION['counter']; ?> = false;
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

</script>


