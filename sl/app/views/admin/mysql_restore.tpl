<a class="closeButton" ></a>
<div class="inContent">
    <form method="post" enctype="multipart/form-data" >
        <div class="buttons">
            <input type="file"  id="mysql_restor_file"   name="file[]" />
            <input type="button" class="k-button" value="<?php echo $Lang->mysql_import;?>" id="mysql_restor" onclick="mysql_restore();"  />
        </div>
    </form>
    <?php if (isset($status) ){
         if ($status == 1){ ?>
    <div id="form_ok">
        OK
    </div>
    <?php }else{ ?>
    <div id="form_error">
        <?php echo $Lang->err;?>
    </div>
    <?php } } ?>
</div>


<script>
    function mysql_restore() {

        var val = $('#mysql_restor_file').val();
        if(val){
            $('#preloader').show();
            $('#mysql_restor').get(0).type = 'submit';
        }else{
            return false;
        }

    }
</script>
