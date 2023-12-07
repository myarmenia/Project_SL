<a id="<?php echo $_SESSION['counter']; ?>closeExternalSignPhoto" class="customClose"></a>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>externalSignPhotoForm">
        <input type="hidden" name="man_id" value="<?php echo $man_id?>" />
        <!--div class="forForm">
            <label for="signPhoto"><?php echo $Lang->photo;?></label>
            <input type="button" dataName="signPhoto" dataId="signPhotoId" class="addMoreMultiple" value=" .. " />
            <input type="text" name="photo" id="<?php echo $_SESSION['counter']; ?>signPhoto"/>
        </div-->

        <!--div class="forForm">
            <label for="signSign"><?php echo $Lang->signs;?></label>
            <input type="button" dataName="signSign" dataId="signSignId" dataTableName="fancy/sign" class="addMore k-icon k-i-plus"   />
            <input type="text" name="signs" id="<?php echo $_SESSION['counter']; ?>signSign" dataTableName="sign" dataInputId="signSignId" class="oneInputSaveEnter"/>
            <input type="hidden" name="sign_id" id="<?php echo $_SESSION['counter']; ?>signSignId" />
        </div-->

        <div class="forForm">
            <label for="signTimeFixation">1) <?php echo $Lang->time_fixation?></label>
            <input type="text" name="fixed_date" id="<?php echo $_SESSION['counter']; ?>signPhotoTimeFixation" style="width: 505px" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>signPhotoTimeFixation',11)" class="oneInputSaveEnter dotsToDash oneInputSaveDateExternalPhoto<?php echo $_SESSION['counter']; ?>" />
        </div>

        <div class="forForm">
            <div id="<?php echo $_SESSION['counter']; ?>file-uploader">Photo</div>
            <div id="<?php echo $_SESSION['counter']; ?>cont"></div>
        </div>



        <!--div class="forForm">
            <label for="signManSign"><?php echo $Lang->man_sign;?></label>
            <input type="text" name="man_sign" id="<?php echo $_SESSION['counter']; ?>signManSign"/>
        </div-->


        <div class="buttons"></div>

    </form>
</div>

<script>
    var currentInputNameSign;
    var currentInputIdSign;
    $(document).ready(function(){

//        $('#<?php echo $_SESSION['counter']; ?>signSign').kendoAutoComplete({
//            dataTextField: "name",
//            dataSource: {
//                transport: {
//                    read:{
//                        dataType: "json",
//
//                    }
//                }
//            },
//            select:function(e){
//                var dataItem = this.dataItem(e.item.index());
//                $('#<?php echo $_SESSION['counter']; ?>signSignId').val(dataItem.id);
//            }
//        });

        $('#<?php echo $_SESSION['counter']; ?>signSign').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>signSign').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>signSignId').val();
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    alert('<?php echo $Lang->enter_sign;?>');
                }
            }
        });

        $('.oneInputSaveDateExternalPhoto<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateExternalPhoto<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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

        $('#<?php echo $_SESSION['counter']; ?>closeExternalSignPhoto').click(function(e){
            e.preventDefault();
            var picName = $('#<?php echo $_SESSION['counter']; ?>pictureName').val();
            var reg = date_preg;
            if(typeof picName == 'undefined'){
                var checkingConfirm = confirm('<?php echo $Lang->sign_quit;?>');
                if(checkingConfirm){
                    removeItem();
                }
            }else{
                var date = $('#<?php echo $_SESSION['counter']; ?>signPhotoTimeFixation').val();
                if(date.length !=0 ){
                    if(reg.test(date)){
                        var data = $('#<?php echo $_SESSION['counter']; ?>externalSignPhotoForm').serializeArray();
                        man_external_sign_has_photo<?php if(isset($old_counter)){ echo $old_counter; }?>(data);
                    }else{
                        alert('<?php echo $Lang->enter_number;?>');
                        $('#<?php echo $_SESSION['counter']; ?>signPhotoTimeFixation').focus();
                    }
                }else{
                    var data = $('#<?php echo $_SESSION['counter']; ?>externalSignPhotoForm').serializeArray();
                    man_external_sign_has_photo<?php if(isset($old_counter)){ echo $old_counter; }?>(data);
                }

            }
        });
//
//        $('.addMore').click(function(e){
//            e.preventDefault();
//            var url = $(this).attr('dataTableName');
//            currentInputNameSign = $(this).attr('dataName');
//            currentInputIdSign = $(this).attr('dataId');
//            $.fancybox({
//                'type'  : 'iframe',
//                'autoSize': false,
//                'width'             : 800,
//                'height'            : 600,
//
//            });
//        });

//        $('#<?php echo $_SESSION['counter']; ?>closeExternalSignSign').click(function(e){
//            e.preventDefault();
//            var sign_id = $('#<?php echo $_SESSION['counter']; ?>signSignId').val();
//            var sign_name = $('#<?php echo $_SESSION['counter']; ?>signSign').val();
//            if( (sign_id.length == 0)||(sign_name.length == 0) ){
//                var checkingConfirm = confirm('Вы не ввели примету , хотите выйти ?');
//                if(checkingConfirm){
//                    removeItem();
//                }
//            }else{
//                var externalData = $('#<?php echo $_SESSION['counter']; ?>externalSignForm').serializeArray();
//                man_external_sign_has_sign(externalData);
//            }
//        });

        var count = 0;
        var img;
        var alt;
        var check;
        var uploader = new qq.FileUploader({
            element: document.getElementById('<?php echo $_SESSION['counter']; ?>file-uploader'),
            'action': '<?php echo ROOT; ?>add/uploader',
            'debug': false,
            multiple: false,
            //sizeLimit: 0, // max size
            // minSizeLimit: 0, // min size
            onSubmit: function(id, fileName){
                //$('#<?php echo $_SESSION['counter']; ?>load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>')
            },
            onProgress: function(id, fileName, loaded, total){
//                    alert(loaded+' OF '+total);
            },
            onComplete: function(id, fileName, responseJSON){
                count = count + 1;
                if(responseJSON.success ==true){

                    var picName = $('#<?php echo $_SESSION['counter']; ?>pictureName').val();

                    if(typeof picName != 'undefined'){
                        $.ajax({
                            url: '<?php echo ROOT; ?>add/removePhoto/'+picName,
                            success:function(data){  },
                            faild: function(data){
                                alert('<?php echo $Lang->err;?> ');
                            }
                        });
                    }


                    $('#<?php echo $_SESSION['counter']; ?>cont').append('<div id="<?php echo $_SESSION['counter']; ?>img"></div>');
                    //$('#<?php echo $_SESSION['counter']; ?>load').html('<img src="/img/correct.png" style="margin-left:109px;margin-top:-32px;position:absolute;"/>');
                    //$('#<?php echo $_SESSION['counter']; ?>img'+count).html(' <div id="<?php echo $_SESSION['counter']; ?>crop_container'+count+'"></div><div id="<?php echo $_SESSION['counter']; ?>crop'+count+'" class="cropSave">Crop And Save</div><input type="hidden" name="pic[picture'+count+']" value="'+responseJSON.fileName+'" />');
                    $('#<?php echo $_SESSION['counter']; ?>img').html('<img src="<?php echo ROOT;?>tmp/'+responseJSON.fileName+'" width="'+responseJSON.width+'px" height="'+responseJSON.height+'" /><input type="hidden" name="name" value="'+responseJSON.name+'"><input type="hidden" id="<?php echo $_SESSION['counter']; ?>pictureName" name="real_name" value="'+responseJSON.fileName+'" />');
                    // $('.hiddenCount').val(count);
                    check = 0;

//                    $('#<?php echo $_SESSION['counter']; ?>blah'+count).attr('src', '/system/userPic/'+responseJSON.fileName);
                    $('#<?php echo $_SESSION['counter']; ?>ManualEntryManualFile').val(responseJSON.fileName);
                    $('.qq-upload-list li').remove();
                    if($('#<?php echo $_SESSION['counter']; ?>2').length !== 0 && $('#<?php echo $_SESSION['counter']; ?>3').length !== 0){
                        $('#<?php echo $_SESSION['counter']; ?>file-uploader3').removeClass('hid');
                    }
                }else{
                    alert('<?php echo $Lang->image_upload;?>');
                    $('#load').empty();
                }
            },
            onCancel: function(id, fileName){$('.qq-upload-button').removeClass('.qq-upload-button-visited')},
            messages: {
                // error messages, see qq.FileUploaderBasic for content
            },
            showMessage: function(message){alert(message);}
        });


    });

//    function closeExternalSign(name,id){
////        alert('name = '+name+' id = '+id);
//        $('#<?php echo $_SESSION['counter']; ?>'+currentInputNameSign).val(name);
//        $('#<?php echo $_SESSION['counter']; ?>'+currentInputIdSign).val(id);
//        $.fancybox.close();
//        $('#<?php echo $_SESSION['counter']; ?>'+currentInputNameSign).focus();
//    }



</script>

