<div style="width: 100%;text-align: center;position: fixed;top: 0px;background: #F9F9F9;">
    <div class="forForm" style="width: 80%" id="filter">
        <label for="autoComplete" /><?php echo $Lang->filtr;?></label>
        <input type="text" id="autoComplete"/>
        <input type="button"  class="k-button" id="open" value="&darr; <?php echo $Lang->createNew;?> &darr;" style="margin-top: 10px"/>
    </div>
    <div id="newRecord" class="forForm" style="width: 80%;display: none;height: 100%">
        <form id="newRecordForm">
        <div class="forForm">
            <label for="newRecordName" /><?php echo $Lang->first_name;?></label>
            <input type="text" name="first_name" id="newRecordName" />
        </div>
        <div class="forForm">
            <label for="newRecordLastName" /><?php echo $Lang->last_name;?></label>
            <input type="text" name="last_name" id="newRecordLastName" />
        </div>
        <div class="forForm">
            <label for="newRecordPost" /><?php echo $Lang->position;?></label>
            <input type="text" name="post_name" id="newRecordPost" />
            <input type="hidden" name="post_id" id="newRecordPostId" />
        </div>
        <div class="buttons">
            <input type="button"  class="k-button" value="<?php echo $Lang->save;?>" id="save"/>
            <input type="button"  class="k-button" value="<?php echo $Lang->cancel;?>" id="cancel"/>
        </div>
        </form>
    </div>

</div>
<div style="width:100%;margin-top: 80px;">
    <table class="fancyTable">
        <tr>
            <td> Id </td>
            <td> <?php echo $Lang->first_name;?> </td>
            <td> <?php echo $Lang->last_name;?> </td>
            <td> <?php echo $Lang->position;?> </td>
            <td> </td>
        </tr>
        <?php foreach($data as $val) { ?>
            <tr class="allTr" id="tr<?php echo $val['id']; ?>">
                <td> <?php echo $val['id']; ?> </td>
                <td> <?php echo $val['first_name']; ?> </td>
                <td> <?php echo $val['last_name']; ?> </td>
                <td> <?php echo $val['post']; ?> </td>
                <td> <input class="add" type="button" dataId="<?php echo $val['id'];?>" name="<?php echo $val['first_name'].' ,'.$val['last_name'].' ,'.$val['post'];?>" value="<?php echo $Lang->add;?>" /> </td>
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
                        url: "<?php echo ROOT;?>autocomplete/worker"
                    }
                }
            },
            dataBound : function(e){
                $('.k-animation-container').hide();
                var data = e.sender.dataSource._view;
                if( data.length != 0){
//                    $('.fancyTable').html('<tr><td> Id </td><td> Название </td><td> </td></tr>');
                    $('.allTr').hide();
                    $.each(data,function(key,val){
                        $('#tr'+val.id).show();
                    });
                }
            },
            width: 500,
            height: 370
        });


        $('#newRecordPost').kendoAutoComplete({
            dataTextField: "name",
            filter: 'contains',
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/worker_post/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#newRecordPostId').val(dataItem.id);
            }
        });

        $('.add').live('click',function(e){
            e.preventDefault();
            var name = $(this).attr('name');
            var id = $(this).attr('dataId');
            <?php if($type == 'criminal') { ?>
                parent.closeCriminalCase<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'signal') { ?>
                parent.closeSignal<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'keep_signal') { ?>
                parent.closeKeepSignal<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
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
            var first_name = $('#newRecordName').val();
            var last_name = $('#newRecordLastName').val();
            var post_id = $('#newRecordPostId').val();
            var post_name = $('#newRecordPost').val();
            var name = first_name+' '+last_name+' '+post_name;
            if(first_name.length == 0){
                alert('<?php echo $Lang->enter_the_name;?> ');
                return false;
            }
            if(last_name.length == 0){
                alert('<?php echo $Lang->enter_the_last_name;?>');
                return false;
            }
            if(post_id.length == 0){
                alert('<?php echo $Lang->enter_post;?>');
                return false;
            }
            var data = $('#newRecordForm').serializeArray();
            $.ajax({
                url: '<?php echo ROOT?>autocomplete/fancyWorker/',
                type: 'POST',
                data:data,
                dataType:'json',
                success: function(data){
//                    alert(data.id);
                    <?php if($type == 'criminal') { ?>
                        parent.closeCriminalCase<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.id);
                    <?php }elseif($type == 'signal') { ?>
                        parent.closeSignal<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.id);
                    <?php }elseif($type == 'keep_signal') { ?>
                        parent.closeKeepSignal<?php if(isset($old_counter)){ echo $old_counter; }?>(name,data.id);
                    <?php } ?>
                },
                faild: function(data){
                    alert('error ');
                }
            });
        });

    });
</script>