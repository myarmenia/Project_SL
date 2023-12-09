<div style="width: 99%;height: 99%;text-align: center;">
    <form enctype="multipart/form-data" method="post" >
        <input type="file"  name="text" />
        <input type="submit"  value="<?php echo $Lang->upload;?>" id="test"/>
    </form>
    <input type="button"  class="k-button" id="add" value="<?php echo $Lang->save;?>" style="margin: 5px;" />
    <textarea id="text" class="textSaveFancy" style="width: 90%;height: 500px;"><?php if(isset($data)){ echo $data; } ?></textarea>
</div>
<script>
    $(document).ready(function(){
        <?php if(isset($error)) { ?>
            alert('<?php echo $Lang->only_txt;?>');
        <?php } ?>
        $('#add').click(function(e){
            e.preventDefault();
            parent.closeAllFancy();
//            if( $.trim( $('#text').val()).length == 0 ){
//                alert('<?php echo $Lang->enter_anything?>');
//            }else{
//                <?php if($type == 'man' ) { ?>
//                    <?php if(isset($id)) { ?>
//                        parent.closeFancyTextMan<?php echo $old_counter; ?>( $('#text').val() , '<?php echo $id?>' );
//                    <?php }else{ ?>
//                        parent.closeFancyTextMan<?php echo $old_counter; ?>( $('#text').val() );
//                    <?php } ?>
//                <?php }elseif($type == 'manAnswer') { ?>
//                    <?php if(isset($id)) { ?>
//                        parent.closeFancyManAnswer<?php echo $old_counter; ?>( $('#text').val() , '<?php echo $id?>' );
//                    <?php }else{ ?>
//                        parent.closeFancyManAnswer<?php echo $old_counter; ?>( $('#text').val() );
//                    <?php } ?>
//                <?php }elseif($type == 'action') { ?>
//                    <?php if(isset($id)) { ?>
//                        parent.closeFancyTextAction<?php echo $old_counter; ?>( $('#text').val() , '<?php echo $id?>' );
//                    <?php }else{ ?>
//                        parent.closeFancyTextAction<?php echo $old_counter; ?>( $('#text').val() );
//                    <?php } ?>
//                <?php } elseif($type == 'signalContent') { ?>
//                    <?php if(isset($id)) { ?>
//                        parent.closeFancySignalContent<?php echo $old_counter; ?>( $('#text').val() , '<?php echo $id?>' );
//                    <?php }else{ ?>
//                        parent.closeFancySignalContent<?php echo $old_counter; ?>( $('#text').val() );
//                    <?php } ?>
//                <?php } elseif($type == 'signalStatus') { ?>
//                    <?php if(isset($id)) { ?>
//                        parent.closeFancySignalStatus<?php echo $old_counter; ?>( $('#text').val() , '<?php echo $id?>' );
//                    <?php }else { ?>
//                        parent.closeFancySignalStatus<?php echo $old_counter; ?>( $('#text').val() );
//                    <?php } ?>
//                <?php } elseif($type == 'miaInf') { ?>
//                    <?php if(isset($id)) { ?>
//                        parent.closeFancyMiaInf<?php echo $old_counter; ?>( $('#text').val() , '<?php echo $id?>' );
//                    <?php }else { ?>
//                        parent.closeFancyMiaInf<?php echo $old_counter; ?>( $('#text').val() );
//                    <?php } ?>
//                <?php } ?>
//            }
        });
    });
</script>



