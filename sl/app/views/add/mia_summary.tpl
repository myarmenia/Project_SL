<a class="closeButton" id="<?php echo $_SESSION['counter']; ?>closeMiaSummary"></a>
<span class="idNumber"><?php if(isset($mia_id)){ echo 'ID : '.$mia_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>miaSummaryForm">


        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>miaDateRegistrationReports">1) <?php echo $Lang->date_registration_reports;?></label>
            <input type="text" name="date" id="<?php echo $_SESSION['counter']; ?>miaDateRegistrationReports" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>miaDateRegistrationReports',12)"  class="oneInputSaveEnter dotsToDash oneInputSaveDateMia<?php echo $_SESSION['counter']; ?>"/>
        </div>

<!--        <div class="forForm">-->
<!--            <label for="<?php echo $_SESSION['counter']; ?>miaContentInf">--><?php //echo $Lang->content_inf;?><!--</label>-->
<!--            <input type="text" name="content" id="<?php echo $_SESSION['counter']; ?>miaContentInf" class="oneInputSaveEnter oneInputSaveMiaSummary<?php echo $_SESSION['counter']; ?>" --><?php //if(isset($mia_summary)){ if(!empty($mia_summary['content'])) { echo "value='".$mia_summary['content']."'"; } } ?><!--/>-->
<!--        </div>-->


        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>miaInf">2) <?php echo $Lang->content_inf;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>miaInfFilter" style="border: none;" >
                <?php if(isset($mia_summary)) {
                    if(!empty($mia_summary['content'])) { ?>
                        <li id="<?php echo $_SESSION['counter']; ?>miaInfItemInf">
                            <div class="item miaInf">
                                <span mia_id="<?php echo $mia_id; ?>" session_counter="<?php echo $_SESSION['counter']; ?>"><?php echo $mia_summary['content']; ?>...</span>
                                <a href="javascript:removeMiaInf<?php echo $_SESSION['counter']; ?>(<?php echo $mia_summary['id']; ?>);">x</a>
                            </div>
                        </li>
                    <?php
                    }
                } ?>
                &nbsp
            </ul>
            <input type="button" name="content" id="<?php echo $_SESSION['counter']; ?>miaInf" value="Добавить" class="oneInputSaveEnter"/>
        </div>


        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>miaSummaryMan">3) <?php echo $Lang->summary_man;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>miaSummaryManFilter" style="border: none;" >
                <?php if(isset($mia_summary_has_man)) {
                        if(!empty($mia_summary_has_man)) {
                            foreach($mia_summary_has_man as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>miaSummaryHasManItem<?php echo $val['man_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['man_id']; ?>" data-tb="man" data-title="<?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?>"><?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeMiaSummaryHasMan<?php echo $_SESSION['counter']; ?>(<?php echo $val['man_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>miaSummaryMan" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="summary_man_organizations" id="<?php echo $_SESSION['counter']; ?>miaSummaryManOrganizations" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>miaSummaryOrganizations">4) <?php echo $Lang->summary_organizations;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>miaSummaryOrganizationsFilter" style="border: none;" >
                <?php if(isset($mia_summary_has_organization)) {
                        if(!empty($mia_summary_has_organization)) {
                            foreach($mia_summary_has_organization as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>miaSummaryHasOrganizationItem<?php echo $val['organization_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['organization_id']; ?>" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : <?php echo $val['organization_id']; ?>"><?php echo $Lang->short_organ; ?> : <?php echo $val['organization_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeMiaSummaryHasOrganization<?php echo $_SESSION['counter']; ?>(<?php echo $val['organization_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>miaSummaryOrganizations" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="summary_man_organizations" id="<?php echo $_SESSION['counter']; ?>miaSummaryOrganizations" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label>5) <?php echo $Lang->contents_document;?></label>
            <ul class="uploader">
                <?php if(isset($mia_has_file)) {
                        if(!empty($mia_has_file)) {
                            foreach($mia_has_file as $val) { ?>
                <li class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> </li>
                <?php       }
                        }
                      } ?>
            </ul>
        </div>

        <div class="forForm">
            <label>6) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($mia_summary)) {
                        if(!empty($mia_summary['bibliography_id'])) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $mia_summary['bibliography_id']; ?>" data-tb="bibliography" ><?php echo $Lang->short_bibl; ?> : <?php echo $mia_summary['bibliography_id']; ?></span>
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
    var currentInputNameMia<?php echo $_SESSION['counter']; ?>;
    var currentInputIdMia<?php echo $_SESSION['counter']; ?>;
    var mia_id<?php echo $_SESSION['counter']; ?> = '<?php echo $mia_id; ?>';
    <?php if(isset($mia_summary)) { ?>
        var checkMia<?php echo $_SESSION['counter']; ?> = false;
    <?php }else{ ?>
        var checkMia<?php echo $_SESSION['counter']; ?> = true;
    <?php } ?>
    $(document).ready(function(){

        $('#<?php echo $_SESSION['counter']; ?>miaSummaryOrganizations').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/organization/mia_summary/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->organization;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>miaSummaryMan').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/man/mia_summary/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->face;?>');
                }
            });
        })

        $('.oneInputSaveDateMia<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('.oneInputSaveDateMia<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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
                        saveMia<?php echo $_SESSION['counter']; ?>(val,field);
                    }else{
                        saveMia<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        saveMia<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }else{
                        saveMia<?php echo $_SESSION['counter']; ?>(val,field);
                    }
                }
            }else{
                if( (typeof $(this).attr('type') != 'undefined')&&(val.length == 0) ){
                    saveMia<?php echo $_SESSION['counter']; ?>('null',field);
                }
            }
        });

        <?php if(isset($mia_summary)) {
            if(!empty($mia_summary['date'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>miaDateRegistrationReports').val('<?php echo $mia_summary['date']; ?>');
            <?php }
        }?>

        $('.oneInputSaveMiaSummary<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                saveMia<?php echo $_SESSION['counter']; ?>(value,field);
            }else{
                saveMia<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>closeMiaSummary').click(function(e){
            e.preventDefault();
            var dataId = $('.activeTable:last').attr('dataId');
            if(checkMia<?php echo $_SESSION['counter']; ?>){
                var confirmMia = confirm('<?php echo $Lang->enter_anything;?>\n <?php echo $Lang->delete_entry;?>');
                if(confirmMia){
                    $.ajax({
                        url: '<?php echo ROOT?>add/delete_mia_summary/'+mia_id<?php echo $_SESSION['counter']; ?>,
                        success: function(data){
                            $('.activeTable').removeClass('activeTable');
                        },
                        faild: function(data){
                            alert('error ');
                        }
                    });
                }else{
                    $('.activeTable').addClass('storedItem');
                    if(typeof  dataId == 'undefined'){
                        $('.activeTable').append(' : id = '+mia_id<?php echo $_SESSION['counter']; ?>);
                        $('.activeTable').attr('dataId',mia_id<?php echo $_SESSION['counter']; ?>);
                    }
                    $('.activeTable').removeClass('activeTable');
                }
            }else{
                $('.activeTable').addClass('storedItem');
                if(typeof  dataId == 'undefined'){
                    $('.activeTable').append(' : id = '+mia_id<?php echo $_SESSION['counter']; ?>);
                    $('.activeTable').attr('dataId',mia_id<?php echo $_SESSION['counter']; ?>);
                }
                $('.activeTable').removeClass('activeTable');
            }
        });


        $('#<?php echo $_SESSION['counter']; ?>miaInf').click(function(e){
            e.preventDefault();
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/text/miaInf&old_counter=<?php echo $_SESSION['counter']; ?>",
                beforeClose: function () {
                    var textVal = $('iframe');
                    var iframe_id = textVal.attr('name');
                    var iframe = document.getElementById(iframe_id);
                    var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                    var test = innerDoc.getElementById('text');
                    var val = test.value;
                    var confirmF = confirm('<?php echo $Lang->save;?> ?');
                    if(confirmF){
                        closeFancyMiaInf<?php echo $_SESSION['counter']; ?>(val);
                    }
                }
            });
        });

    });


    function closeFancyMiaInf<?php echo $_SESSION['counter']; ?>(data , id ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/mia_inf/'+mia_id<?php echo $_SESSION['counter']; ?>+'/'+id,
            type:'POST',
            data:{ 'data':data },
            dataType:'json',
            success:function(data){

                $('#<?php echo $_SESSION['counter']; ?>miaInfItemInf').remove();

                $('#<?php echo $_SESSION['counter']; ?>miaInfFilter').append('<li id="<?php echo $_SESSION['counter']; ?>miaInfItemInf">'
                    +'<div class="item miaInf" data_id="'+mia_id<?php echo $_SESSION['counter']; ?>+'">'
                    +'<span session_counter="<?php echo $_SESSION['counter']; ?>" mia_id="'+mia_id<?php echo $_SESSION['counter']; ?>+'" >'+data.text+'</span>'
                    +'<a href="javascript:removeMiaInf<?php echo $_SESSION['counter']; ?>('+mia_id<?php echo $_SESSION['counter']; ?>+');">x</a>'
                    +'</div>'
                    +'</li>');
            }
        });
//        $.fancybox.close();
        $('#<?php echo $_SESSION['counter']; ?>miaInf').focus();
    }

    function removeMiaInf<?php echo $_SESSION['counter']; ?>(id){
        var removeManHasWeapon = confirm('<?php echo $Lang->are_you_sure;?>');
        if(removeManHasWeapon){
            $.ajax({
                url:'<?php echo ROOT; ?>add/delete_inf/'+id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>miaInfItemInf').remove();
                    $('#<?php echo $_SESSION['counter']; ?>miaInf').focus();
                }
            });
        }
    }



    function saveMia<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value, 'field':field };
        $.ajax({
            url: '<?php echo ROOT?>add/save_mia_summary/'+mia_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            success: function(data){
                checkMia<?php echo $_SESSION['counter']; ?> = false;
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function mia_summary_has_organization<?php echo $_SESSION['counter']; ?>(organization_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/mia_summary_has_organization/'+mia_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>miaSummaryOrganizationsFilter').append('<li id="<?php echo $_SESSION['counter']; ?>miaSummaryHasOrganizationItem'+organization_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+organization_id+'" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : '+organization_id+'"><?php echo $Lang->short_organ; ?> : '+organization_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeMiaSummaryHasOrganization<?php echo $_SESSION['counter']; ?>('+organization_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>miaSummaryOrganizations').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeMiaSummaryHasOrganization<?php echo $_SESSION['counter']; ?>(organization_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_mia_summary_has_organization/'+mia_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>miaSummaryHasOrganizationItem'+organization_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>miaSummaryOrganizations').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function mia_summary_has_man<?php echo $_SESSION['counter']; ?>(man_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/mia_summary_has_man/'+mia_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>miaSummaryManFilter').append('<li id="<?php echo $_SESSION['counter']; ?>miaSummaryHasManItem'+man_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+man_id+'" data-tb="man" data-title="<?php echo $Lang->short_man; ?> : '+man_id+'"  ><?php echo $Lang->short_man; ?> : '+man_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeMiaSummaryHasMan<?php echo $_SESSION['counter']; ?>('+man_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>miaSummaryMan').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeMiaSummaryHasMan<?php echo $_SESSION['counter']; ?>(man_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_mia_summary_has_man/'+mia_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>miaSummaryHasManItem'+man_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>miaSummaryMan').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }



</script>

