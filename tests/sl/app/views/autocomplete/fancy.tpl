<div style="width: 100%;text-align: center;position: fixed;top: 0px;background: #F9F9F9;">
    <div class="forForm" style="width: 80%" id="filter">
        <label for="autoComplete" /><?php echo $Lang->filtr;?></label>
        <input type="text" id="autoComplete"/>
        <input type="button"  class="k-button" id="open" value="<?php echo $Lang->createNew;?>" style="margin-top: 10px"/>
    </div>
    <div id="newRecord" class="forForm" style="width: 80%;display: none;height: 100%">
        <label for="autoComplete" /><?php echo $Lang->name;?></label>
        <input type="text" id="newRecordName" />
        <input type="button"  class="k-button" value="<?php echo $Lang->save;?>" id="save"/>
        <input type="button"  class="k-button" value="<?php echo $Lang->cancel;?>" id="cancel"/>
    </div>
</div>
<div style="width:100%;margin-top: 80px;">
    <table class="fancyTable">
        <tr>
            <td> Id </td>
            <td> <?php echo $Lang->name;?> </td>
            <td> </td>
        </tr>
        <?php foreach($data as $val) { ?>
            <tr>
                <td> <?php echo $val['id']; ?> </td>
                <td> <?php echo $val['name']; ?> </td>
                <td> <input class="add" type="button" dataId="<?php echo $val['id'];?>" name="<?php echo $val['name'];?>" value="<?php echo $Lang->add;?>" /> </td>
            </tr>
        <?php }?>
    </table>
</div>

<script>
    $(document).ready(function(){

        $(this).keyup(function(e){
            e.preventDefault();
            if(e.keyCode == 27){
               parent.closeAllFancy();
            }
        });

        $("#autoComplete").kendoAutoComplete({
            dataTextField: "name",
            filter: 'contains',
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/<?php echo $tableName?>/read"
                    }
                }
            },
            dataBound : function(e){
                $('.k-animation-container').hide();
                var data = e.sender.dataSource._view;
                $('.fancyTable').html('<tr><td> Id </td><td> <?php echo $Lang->name;?> </td><td> </td></tr>');
                if( data.length != 0){
                    $.each(data,function(key,val){
                        $('.fancyTable').append(' <tr><td>'+ val.id+' </td> <td> '+ val.name +' </td> <td> <input class="add" type="button" dataId="'+val.id+'" name=" '+val.name+'" value="<?php echo $Lang->add;?>"> </td></tr>');
                    });
                }
            },
            width: 500,
            height: 370
        });
        $('.add').live('click',function(e){
            e.preventDefault();
            var name = $(this).attr('name');
            var id = $(this).attr('dataId');
            <?php if($type == 'bibl') { ?>
                parent.closeFBibl<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'control') { ?>
                parent.closeFControl<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'man' ){ ?>
                parent.closeFMan<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'address' ) { ?>
                parent.closeFancyAddress<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'car') { ?>
                parent.closeFCar<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'action') { ?>
                parent.closeFancyAction<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'criminal') { ?>
                parent.closeCriminalCase<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'event') { ?>
                parent.closeEvent<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'signal') { ?>
                parent.closeSignal<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'organization') { ?>
                parent.closeOrganization<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'phone') { ?>
                parent.closePhone<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'email') { ?>
                parent.cloaseEmail<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'objects_relation') { ?>
                parent.closeObjectsRelation<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'keep_signal') { ?>
                parent.closeKeepSignal<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'man_bean_country') { ?>
                parent.closeManBeanCountry<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'external_sign') { ?>
                parent.closeExternalSign<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php } ?>
        });

        $('tr').live('dblclick',function(e){
            e.preventDefault();
            var btn = $(this).children().last().find('input');
            btn.trigger('click');
        });

        $('#open').click(function(e){
            e.preventDefault();
            $('#newRecord').show();
            $('#filter').hide();
        });

        $('#cancel').click(function(e){
            e.preventDefault();
            $('#newRecord').hide();
            $('#filter').show();
        });

        $('#save').click(function(e){
            e.preventDefault;
            var name = $('#newRecordName').val();
            if(name.length == 0){
                alert('<?php echo $Lang->enter_name;?>');
                return false;
            }
            $.ajax({
                url: '<?php echo ROOT?>autocomplete/fancySave/<?php echo $tableName?>',
                type: 'POST',
                data: { 'name' : name },
                dataType:'json',
                success: function(data){
                    if(data.status){
                        <?php if($type == 'bibl') { ?>
                            parent.closeFBibl<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'control') { ?>
                            parent.closeFControl<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'man' ){ ?>
                            parent.closeFMan<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'address' ) { ?>
                            parent.closeFancyAddress<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'car') { ?>
                            parent.closeFCar<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'action') { ?>
                            parent.closeFancyAction<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'criminal') { ?>
                            parent.closeCriminalCase<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'event') { ?>
                            parent.closeEvent<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'signal') { ?>
                            parent.closeSignal<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'organization') { ?>
                            parent.closeOrganization<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'phone') { ?>
                            parent.closePhone<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'email') { ?>
                            parent.cloaseEmail<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'objects_relation') { ?>
                            parent.closeObjectsRelation<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'keep_signal') { ?>
                            parent.closeKeepSignal<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'man_bean_country') { ?>
                            parent.closeManBeanCountry<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php }elseif($type == 'external_sign') { ?>
                            parent.closeExternalSign<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.record);
                        <?php } ?>
                    }else{
                        alert(data.message);
                    };
                },
                faild: function(data){
                    alert('error');
                }
            });
        });
    });
</script>