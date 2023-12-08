<a class="closeButton"></a>
<div class="inContent">
    <form id="objectForm" action="<?php echo ROOT;?>simplesearch/result_objects_relation" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="<?php echo $Lang->and; ?>" id="object_and" />
            <input type="button" class="k-button" value="<?php echo $Lang->or; ?>" id="object_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
            <input type="submit" class="k-button" name="submit" value="<?php echo $Lang->search;?>" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['relation_type_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOBcharFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['relation_type_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOBchar">
                    <div class="item">
                        <span><?php echo $search_params['relation_type_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="relation_type_id[]" value="<?php echo $search_params['relation_type_id'][$i] ?>">
                    <input type="hidden" name="relation_type_idName[]" value="<?php echo $search_params['relation_type_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="relation_type_id_type" id="searchOBcharType" value="<?php echo $search_params['relation_type_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOBchar"><?php echo $Lang->character_link;?></label>
            <input type="button" dataName="searchOBchar" dataId="searchOBcharId" dataTableName="fancy/relation_type" class="addMore k-icon k-i-plus"   />
            <input type="text" name="character_link" id="searchOBchar" dataTableName="relation_type" dataInputId="searchOBcharId" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['relation_type_id_type']) && $search_params['relation_type_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOBcharOp">ИЛИ</span>
            <?php } else if (isset($search_params['relation_type_id_type']) && $search_params['relation_type_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOBcharOp">И</span>
            <?php } ?>
            <input type="hidden" name="relation_type_id[]" id="searchOBcharId" />
        </div>


        <div class="buttons">

        </div>

    </form>
</div>


<script>
    var currentInputNameObject;
    var currentInputIdObject;
    var searchInput;
    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMakerAutoComplete( 'searchOBchar' , 'relation_type_id' );

        $('#searchOBchar').kendoAutoComplete({
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
                $('#searchOBcharId').val(dataItem.id);
            }
        });




        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameObject = $(this).attr('dataName');
            currentInputIdObject = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=objects_relation"
            });
        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#object_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#object_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchOBcharId').val("<?php echo $search_params['relation_type_id'][sizeof($search_params['relation_type_id'])-1] ?>");
            $('#searchOBchar').val("<?php echo html_entity_decode($search_params['character_link']) ?>");
        <?php } ?>

    });

    function closeObjectsRelation(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameObject).val(name);
        $('#'+currentInputIdObject).val(id);
        $.fancybox.close();
        $('#'+currentInputNameObject).focus();
    }




</script>


