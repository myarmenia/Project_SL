<a id="<?php echo $_SESSION['counter']; ?>closeObject" class="customClose"></a>
<span class="idNumber"><?php if(isset($object)){ echo 'ID : '.$object['id']; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>objectForm">

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>objectCharacterLink">1) <?php echo $Lang->character_link;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>objectCharacterLink" dataId="<?php echo $_SESSION['counter']; ?>objectCharacterLinkId" dataTableName="fancy/relation_type" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="character_link" id="<?php echo $_SESSION['counter']; ?>objectCharacterLink" dataTableName="relation_type" dataInputId="<?php echo $_SESSION['counter']; ?>objectCharacterLinkId" class="oneInputSaveEnter" <?php if(isset($object)){ if(!empty($object['relation_type'])){ echo "value='".$object['relation_type']."'"; } } ?>/>
            <input type="hidden" name="character_id" id="<?php echo $_SESSION['counter']; ?>objectCharacterLinkId" <?php if(isset($object)){ if(!empty($object['relation_type_id'])){ echo "value='".$object['relation_type_id']."'"; } } ?>/>
        </div>

        <?php if(isset($object)) { ?>
            <div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>objectOrgan">2) <?php echo $Lang->specific_link;?></label>
                <ul class="filterlist" style="border: none;" >
                    <li class="openData" data-id="<?php echo $object['first_object_id'];?>" data-tb="<?php echo $object['first_object_type']; ?>" >
                        <?php if($object['first_object_type'] == 'man' ){
                                   echo $Lang->face;
                              }else{
                                   echo $Lang->organization;
                              }
                              echo ' : '.$object['first_object_id'];
                        ?>
                    </li>
                    <span class="editAll" style="position: fixed;"></span>
                </ul>
            </div>
            <div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>objectOrgan">3) <?php echo $Lang->specific_link;?></label>
                <ul class="filterlist"  style="border: none;" >
                    <li class="openData" data-id="<?php echo $object['second_object_id'];?>" data-tb="<?php echo $object['second_obejct_type']; ?>" >
                        <?php if($object['second_obejct_type'] == 'man' ){
                                       echo $Lang->face;
                        }else{
                        echo $Lang->organization;
                        }
                        echo ' : '.$object['second_object_id'];
                        ?>
                    </li>
                    <span class="editAll" style="position: fixed;"></span>
                </ul>
            </div>
        <?php } ?>

        <?php if( ($other_tb_name == 'organization')||($other_tb_name == 'man_for_organization') ){ ?>
            <div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>objectOrgan">4) <?php echo $Lang->specific_link;?></label>
                <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>objectOrganFilter" style="border: none;" >&nbsp</ul>
                <input type="button" name="organ" id="<?php echo $_SESSION['counter']; ?>objectOrgan" value="Добавить" class="oneInputSaveEnter"/>
                <!--input type="text" name="also_known_as" id="<?php echo $_SESSION['counter']; ?>organAlsoKnownAs" class="oneInputSaveEnter"/-->
            </div>
        <?php } ?>

        <?php if( ($other_tb_name == 'man_for_man') ) { ?>
            <div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>objectMan">5) <?php echo $Lang->specific_link;?></label>
                <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>objectManFilter" style="border: none;" >&nbsp</ul>
                <input type="button" name="organ" id="<?php echo $_SESSION['counter']; ?>objectMan" value="Добавить" class="oneInputSaveEnter"/>
                <!--input type="text" name="also_known_as" id="<?php echo $_SESSION['counter']; ?>organAlsoKnownAs" class="oneInputSaveEnter"/-->
            </div>
        <?php } ?>

        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>objectSpecificLink"><?php// echo $Lang->specific_link;?></label>
            <input type="text" name="specific_link" id="<?php echo $_SESSION['counter']; ?>objectSpecificLink" class="oneInputSaveEnter" />
        </div-->

        <div class="buttons"></div>

    </form>
</div>


<script>
    var currentInputNameObject<?php echo $_SESSION['counter']; ?>;
    var currentInputIdObject<?php echo $_SESSION['counter']; ?>;
    $(document).ready(function(){

        $('#<?php echo $_SESSION['counter']; ?>objectCharacterLink').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/relation_type/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>objectCharacterLinkId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>objectOrgan').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/organization/objects_relation_org/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->organization;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>objectMan').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/man/objects_relation_man/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->face;?>');
                }
            });
        });


        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameObject<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdObject<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=objects_relation&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>closeObject').click(function(e){
            e.preventDefault();
            <?php if($other_tb_name == 'organization') { ?>
                var relation_type = $('#<?php echo $_SESSION['counter']; ?>objectCharacterLinkId').val();
                var org_id = $('#<?php echo $_SESSION['counter']; ?>valObjectOrgToOrg').val();
                if( (typeof  org_id != 'undefined' ) && ( org_id.length != 0 )  ){
                    organization_objects_relation<?php if(isset($old_counter)){ echo $old_counter; }?>(org_id,relation_type);
                }else{
                    if( typeof  org_id == 'undefined'  ){
                        removeItem();
                    }else{
                        alert('<?php echo $Lang->must_fill_field;?>');
                    }
                }
            <?php }elseif($other_tb_name == 'man_for_organization') { ?>
                var relation_type = $('#<?php echo $_SESSION['counter']; ?>objectCharacterLinkId').val();
                var org_id = $('#<?php echo $_SESSION['counter']; ?>valObjectOrgToOrg').val();
                if( (typeof  org_id != 'undefined' ) && ( org_id.length != 0 ) ){
                    man_objects_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(org_id,relation_type);
                }else{
                    if( (typeof  org_id == 'undefined' ) ){
                        removeItem();
                    }else{
                        alert('<?php echo $Lang->must_fill_field;?>');
                    }
                }
            <?php }elseif($other_tb_name == 'man_for_man') { ?>
                var relation_type = $('#<?php echo $_SESSION['counter']; ?>objectCharacterLinkId').val();
                var manTOman_id = $('#<?php echo $_SESSION['counter']; ?>valObjectManToMan').val();
                if( (typeof  manTOman_id != 'undefined' ) && ( manTOman_id.length != 0 ) ){
                    man_objects_man<?php if(isset($old_counter)){ echo $old_counter; }?>(manTOman_id,relation_type);
                }else{
                    if( typeof  manTOman_id == 'undefined'  ){
                        removeItem();
                    }else{
                        alert('<?php echo $Lang->must_fill_field;?>');
                    }
                }
            <?php }elseif($other_tb_name == 'edit') { ?>
                var relation_type = $('#<?php echo $_SESSION['counter']; ?>objectCharacterLinkId').val();

                    $.ajax({
                        url: '<?php echo ROOT?>add/edit_object/<?php echo $object['id']; ?>',
                        type: 'POST',
                        data: { 'relation_type_id' : relation_type },
                        success: function(data){
                            removeItem();
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });

            <?php } ?>
        });

    });

    function closeObjectsRelation<?php echo $_SESSION['counter']; ?>(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameObject<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdObject<?php echo $_SESSION['counter']; ?>).val(id);
        $.fancybox.close();
        $('#'+currentInputNameObject<?php echo $_SESSION['counter']; ?>).focus();
    }

    function objects_relation_organization_to_organization<?php echo $_SESSION['counter']; ?>(org_id , check , data ){
        removeItem();
        $('#<?php echo $_SESSION['counter']; ?>objectOrganFilter').html('<li id="<?php echo $_SESSION['counter']; ?>objectOrgToOrg"><input type="hidden" id="<?php echo $_SESSION['counter']; ?>valObjectOrgToOrg" value="'+org_id+'"/>'
                +'<div class="item">'
                +'<span class="openData" data-id="'+org_id+'" data-tb="organization" ><?php echo $Lang->short_organ; ?> : '+org_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeObjectOrganizationToOrganization<?php echo $_SESSION['counter']; ?>('+org_id+');">x</a>'
                +'</div>'
                +'</li>');
        $('#<?php echo $_SESSION['counter']; ?>objectOrgan').focus();

    }
    function removeObjectOrganizationToOrganization<?php echo $_SESSION['counter']; ?>(org_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $('#<?php echo $_SESSION['counter']; ?>objectOrganFilter').html('&nbsp;');
            $('#<?php echo $_SESSION['counter']; ?>objectOrgan').focus();
        }
    }

    function objects_relation_man_to_man<?php echo $_SESSION['counter']; ?>(man_id , check , data ){
        removeItem();
        $('#<?php echo $_SESSION['counter']; ?>objectManFilter').html('<li id="<?php echo $_SESSION['counter']; ?>objectManToMan"><input type="hidden" id="<?php echo $_SESSION['counter']; ?>valObjectManToMan" value="'+man_id+'"/>'
                +'<div class="item">'
                +'<span class="openData" data-id="'+man_id+'" data-tb="man" ><?php echo $Lang->short_man; ?> : '+man_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeObjectManToMan<?php echo $_SESSION['counter']; ?>('+man_id+');">x</a>'
                +'</div>'
                +'</li>');
        $('#<?php echo $_SESSION['counter']; ?>objectMan').focus();

    }
    function removeObjectManToMan<?php echo $_SESSION['counter']; ?>(man_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $('#<?php echo $_SESSION['counter']; ?>objectManFilter').html('&nbsp;');
            $('#<?php echo $_SESSION['counter']; ?>objectMan').focus();
        }
    }



</script>


