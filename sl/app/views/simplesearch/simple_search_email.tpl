<a class="closeButton"></a>
<div class="inContent">
    <form id="emailForm" action="<?php echo ROOT;?>simplesearch/result_email" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="<?php echo $Lang->and; ?>" id="email_and" />
            <input type="button" class="k-button" value="<?php echo $Lang->or; ?>" id="email_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
            <input type="submit" class="k-button" name="submit" value="<?php echo $Lang->search;?>" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['address'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchEmailEmailFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['address'])-1 ; $i++ ) { ?>
                <li id="listItemsearchEmailEmail">
                    <div class="item">
                        <span><?php echo $search_params['address'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="address[]" value="<?php echo $search_params['address'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="address_type" id="searchEmailEmailType" value="<?php echo $search_params['address_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm" >
            <label for="searchEmailEmail"><?php echo $Lang->address;?></label>
            <input type="text" name="address[]" id="searchEmailEmail" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['address_type']) && $search_params['address_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEmailEmailOp">ИЛИ</span>
            <?php } else if (isset($search_params['address_type']) && $search_params['address_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchEmailEmailOp">И</span>
            <?php } ?>
        </div>

        <div class="forForm">
            <label for="fileSearch"><?php echo $Lang->file_search; ?></label>
            <input type="text" name="content" id="fileSearch"/>
        </div>

        <div class="buttons">

        </div>

    </form>
</div>

<script>
    var currentInputNameEmail;
    var currentInputIdEmail;
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMaker( 'searchEmailEmail' , 'address' );
//
//        $('#emailNatureCharacter').kendoAutoComplete({
//            dataTextField: "name",
//            dataSource: {
//                transport: {
//                    read:{
//                        dataType: "json",
//                        url: "<?php echo ROOT;?>dictionary/character/read"
//                    }
//                }
//            },
//            select:function(e){
//                var dataItem = this.dataItem(e.item.index());
//                $('#emailNatureCharacterId').val(dataItem.id);
//            }
//        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#email_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#email_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });


        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameEmail = $(this).attr('dataName');
            currentInputIdEmail = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=email"
            });
        });


        <?php if (isset($search_params)) { ?>
            $('#searchEmailEmail').val("<?php echo html_entity_decode($search_params['address'][sizeof($search_params['address'])-1]) ?>");
            $('#fileSearch').val("<?php echo html_entity_decode($search_params['content']) ?>");
        <?php } ?>
    });




</script>

