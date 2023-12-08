<div style="width: 100%;text-align: center;position: fixed;top: 0px;background: #F9F9F9;">
    <div class="forForm" style="width: 80%" id="filter">
        <label for="autoComplete" /><?php echo $Lang->filtr;?></label>
        <input type="text" id="autoComplete"/>
        <input type="button" id="open" value="&darr; <?php echo $Lang->createNew;?> &darr;" style="margin-top: 10px"/>
    </div>
    <div id="newRecord" class="forForm" style="width: 80%;display: none;height: 100%">
        <form id="newRecordForm">
        <div class="forForm">
            <label for="newRecordName" /><?php echo $Lang->name;?></label>
            <input type="text" name="name" id="newRecordName" />
        </div>
        <div class="forForm">
            <label for="newRecordLastName" /><?php echo $Lang->old_name;?></label>
            <input type="text" name="old_name" id="newRecordLastName" />
        </div>

        <div class="buttons">
            <input type="button" value="<?php echo $Lang->save;?>" id="save"/>
            <input type="button" value="<?php echo $Lang->cancel;?>" id="cancel"/>
        </div>
        </form>
    </div>

</div>
<div style="width:100%;margin-top: 80px;">
    <table class="fancyTable">
        <tr>
            <td> Id </td>
            <td> <?php echo $Lang->name;?> </td>
            <td> <?php echo $Lang->old_name;?> </td>

            <td> </td>
        </tr>
        <?php foreach($data as $val) { ?>
            <tr class="allTr" id="tr<?php echo $val['id']; ?>">
                <td> <?php echo $val['id']; ?> </td>
                <td> <?php echo $val['name']; ?> </td>
                <td> <?php echo $val['old_name']; ?> </td>
                <td> <input class="add" type="button" dataId="<?php echo $val['id'];?>" name="<?php echo $val['name'].' ,'.$val['old_name'];?>" value="<?php echo $Lang->add;?>" /> </td>
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
            minLength: 1,
            dataTextField: "name",
            filter: 'contains',
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/street/read"
                    }
                }
            },
            dataBound : function(e){
                $('.k-animation-container').hide();
                var data = e.sender.dataSource._view;
                $('.allTr').hide();
                if( data.length != 0){
//                    $('.fancyTable').html('<tr><td> Id </td><td> Название </td><td> </td></tr>');
                    $.each(data,function(key,val){
                        $('#tr'+val.id).show();
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
                parent.closeFBibl<?php if(isset($old_counter)){ echo $old_counter; } ?>(name,id);
            <?php }elseif($type == 'control') { ?>
                parent.closeFControl<?php if(isset($old_counter)){ echo $old_counter; } ?>(name,id);
            <?php }elseif($type == 'man' ){ ?>
                parent.closeFMan<?php if(isset($old_counter)){ echo $old_counter; } ?>(name,id);
            <?php }elseif($type == 'address' ) { ?>
                parent.closeFancyAddress<?php if(isset($old_counter)){ echo $old_counter; } ?>(name,id);
            <?php }?>
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

        $('tr').live('dblclick',function(e){
            e.preventDefault();
            var btn = $(this).children().last().find('input');
            btn.trigger('click');
        });

        $('#save').click(function(e){
            var first_name = $('#newRecordName').val();
            var last_name = $('#newRecordLastName').val();
            var post_id = $('#newRecordPostId').val();
            var post_name = $('#newRecordPost').val();
            var name = $('#newRecordName').val();
            if(first_name.length == 0){
                alert('<?php echo $Lang->enter_name;?>');
                return false;
            }
//            if(last_name.length == 0){
//                alert('<?php echo $Lang->old_name;?>');
//                return false;
//            }

            var data = $('#newRecordForm').serializeArray();
            $.ajax({
                url: '<?php echo ROOT?>autocomplete/fancyStreet/',
                type: 'POST',
                data:data,
                dataType:'json',
                success: function(data){
//                    alert(data.id);
                    <?php if($type == 'bibl') { ?>
                        parent.closeFBibl<?php if(isset($old_counter)){ echo $old_counter; } ?>(name,data.id);
                    <?php }elseif($type == 'control') { ?>
                        parent.closeFControl<?php if(isset($old_counter)){ echo $old_counter; } ?>(name,data.id);
                    <?php }elseif($type == 'man' ){ ?>
                        parent.closeFMan<?php if(isset($old_counter)){ echo $old_counter; } ?>(name,data.id);
                    <?php }elseif($type == 'address' ) { ?>
                        parent.closeFancyAddress<?php if(isset($old_counter)){ echo $old_counter; } ?>(name,data.id);
                    <?php }?>
                },
                faild: function(data){
                    alert('error ');
                }
            });
        });

    });
</script>