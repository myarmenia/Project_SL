<a class="closeButton" id="closeBibl"></a>
<div class="inContent">
    <form id="user_edit" method="POST">
        <div class="forForm">
            <label for="user_name"><?php echo $Lang->user_name; ?></label>
            <input type="text" name="user_name" id="biblFromAgencyName" class="oneInputSaveEnter"  value="<?php echo $data['username']?>"/>
        </div>
        <div class="forForm">
            <label for="password"><?php echo $Lang->password; ?></label>
            <input type="password" name="password" id="password" class="oneInputSaveEnter" style="width: 500px;" />
        </div>
        <div class="forForm">
            <label for="repeat_password"><?php echo $Lang->repeat_password; ?></label>
            <input type="password" name="repeat_password" id="repeat_password" class="oneInputSaveEnter" style="width: 500px;" />
        </div>
        <div class="forForm">
            <label for="first_name"><?php echo $Lang->first_name; ?></label>
            <input type="text" name="first_name" id="first_name" class="oneInputSaveEnter" value="<?php echo $data['first_name']?>" />
        </div>
        <div class="forForm">
            <label for="last_name"><?php echo $Lang->last_name; ?></label>
            <input type="text" name="last_name" id="last_name" class="oneInputSaveEnter" value="<?php echo $data['last_name']?>"/>
        </div>
        <div class="forForm">
            <?php
                if($data['user_type'] == 1){
                    $admin = 'checked';
                }elseif($data['user_type'] == 2){
                    $editor = 'checked';
                }else{
                    $viewer = 'checked';
                }

            ?>
            <label for="last_name"><?php echo $Lang->type; ?></label>
            <input type="radio" name="user_type" value="1" <?php if(isset($admin)){ echo $admin;} ?> > <?php echo $Lang->type_admin; ?>
            <input type="radio" name="user_type" value="2" <?php if(isset($editor)){ echo $editor;}?> > <?php echo $Lang->type_editor; ?>
            <input type="radio" name="user_type" value="3" <?php if(isset($viewer)){ echo $viewer;} ?> > <?php echo $Lang->type_viewer; ?>
        </div>
        <div class="buttons">
           <input type="submit" class="k-button" value="<?php echo $Lang->save;?>" id="userSave"/>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#userSave').click(function(e){
            e.preventDefault();
            var check = true;
            $('#user_edit :input').map(function(){
                if( !$(this).val() ){
                    check = false;
                }
            });
            if(!check){
                alert('<?php echo $Lang->fill_field;?> ');
            }else{
                var pass = $('#password').val();
                var rep_pass = $('#repeat_password').val();
                if(pass != rep_pass){
                    check = false;
                }
                if(!check){
                    alert('<?php echo $Lang->invalid_password;?>');
                }else{
                    var data = $('#user_edit').serializeArray();
                        $.ajax({
                            url:'<?php echo ROOT; ?>admin/add/<?php echo $data['id']; ?>',
                            type : 'post',
                            data : data,
                            success:function(data){
                                removeItem();
                                location.reload(true);
                            }
                        });
                }
            }

        });
    });
</script>

