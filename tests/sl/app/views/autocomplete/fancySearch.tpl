<div style="width: 100%;text-align: center;position: fixed;top: 0px;background: #F9F9F9;">
    <div class="forForm" style="width: 80%" id="filter">
        <form method="post">
            <input type="text" name="value" id="autoComplete" <?php if(!empty($value)){ echo 'value="'.$value.'"'; } ?>/>
            <input type="submit"  class="k-button" id="search" value="<?php echo $Lang->search;?>" style="margin-top: 10px"/>
        </form>
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
            <?php }elseif($type == 'action') { ?>
                parent.closeFancyAction<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php }elseif($type == 'event') { ?>
                parent.closeEvent<?php if(isset($old_counter)){ echo $old_counter; }?>(name,id);
            <?php } ?>
        });

        $('tr').live('dblclick',function(e){
            e.preventDefault();
            var btn = $(this).children().last().find('input');
            btn.trigger('click');
        });
    });
</script>