<a class="closeButton"></a>
<div class="inContent">
    <form id="weaponForm" action="<?php echo ROOT;?>simplesearch/result_weapon" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="<?php echo $Lang->and; ?>" id="weapon_and" />
            <input type="button" class="k-button" value="<?php echo $Lang->or; ?>" id="weapon_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
            <input type="submit" class="k-button" name="submit" value="<?php echo $Lang->search;?>" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['category'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchWeaponCategoryFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['category'])-1 ; $i++ ) { ?>
                <li id="listItemsearchWeaponCategory">
                    <div class="item">
                        <span><?php echo $search_params['category'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="category[]" value="<?php echo $search_params['category'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="category_type" id="searchWeaponCategoryType" value="<?php echo $search_params['category_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchWeaponCategory"><?php echo $Lang->weapon_cat;?></label>
            <input type="text" name="category[]" id="searchWeaponCategory" class="oneInputSaveEnter" />
            <?php if (isset($search_params['category_type']) && $search_params['category_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponCategoryOp">ИЛИ</span>
            <?php } else if (isset($search_params['category_type']) && $search_params['category_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponCategoryOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['view'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchWeaponViewFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['view'])-1 ; $i++ ) { ?>
                <li id="listItemsearchWeaponView">
                    <div class="item">
                        <span><?php echo $search_params['view'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="view[]" value="<?php echo $search_params['view'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="view_type" id="searchWeaponViewType" value="<?php echo $search_params['view_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchWeaponView"><?php echo $Lang->view;?></label>
            <input type="text" name="view[]" id="searchWeaponView" class="oneInputSaveEnter" />
            <?php if (isset($search_params['view_type']) && $search_params['view_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponViewOp">ИЛИ</span>
            <?php } else if (isset($search_params['view_type']) && $search_params['view_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponViewOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['type'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchWeaponTypeFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['type'])-1 ; $i++ ) { ?>
                <li id="listItemsearchWeaponType">
                    <div class="item">
                        <span><?php echo $search_params['type'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="type[]" value="<?php echo $search_params['type'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="type_type" id="searchWeaponTypeType" value="<?php echo $search_params['type_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchWeaponType"><?php echo $Lang->type;?></label>
            <input type="text" name="type[]" id="searchWeaponType" class="oneInputSaveEnter" />
            <?php if (isset($search_params['type_type']) && $search_params['type_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponTypeOp">ИЛИ</span>
            <?php } else if (isset($search_params['type_type']) && $search_params['type_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponTypeOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['model'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchWeaponMarkFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['model'])-1 ; $i++ ) { ?>
                <li id="listItemsearchWeaponMark">
                    <div class="item">
                        <span><?php echo $search_params['model'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="model[]" value="<?php echo $search_params['model'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="model_type" id="searchWeaponMarkType" value="<?php echo $search_params['model_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchWeaponMark"><?php echo  $Lang->mark;?></label>
            <input type="text" name="model[]"  id="searchWeaponMark" class="oneInputSaveEnter" />
            <?php if (isset($search_params['model_type']) && $search_params['model_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponMarkOp">ИЛИ</span>
            <?php } else if (isset($search_params['model_type']) && $search_params['model_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponMarkOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['reg_num'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchWeaponAccountNumberFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['reg_num'])-1 ; $i++ ) { ?>
                <li id="listItemsearchWeaponAccountNumber">
                    <div class="item">
                        <span><?php echo $search_params['reg_num'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="reg_num[]" value="<?php echo $search_params['reg_num'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="reg_num_type" id="searchWeaponAccountNumberType" value="<?php echo $search_params['reg_num_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchWeaponAccountNumber"><?php echo $Lang->account_number;?></label>
            <input type="text" name="reg_num[]" id="searchWeaponAccountNumber" class="oneInputSaveEnter" />
            <?php if (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponAccountNumberOp">ИЛИ</span>
            <?php } else if (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponAccountNumberOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['count'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchWeaponCountFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['count'])-1 ; $i++ ) { ?>
                <li id="listItemsearchWeaponCount">
                    <div class="item">
                        <span><?php echo $search_params['count'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="count[]" value="<?php echo $search_params['count'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="count_type" id="searchWeaponCountType" value="<?php echo $search_params['count_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchWeaponCount"><?php echo $Lang->count;?></label>
            <input type="text" name="count[]" id="searchWeaponCount" onkeydown="validateNumber(event,'searchWeaponCount',12)" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['count_type']) && $search_params['count_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponCountOp">ИЛИ</span>
            <?php } else if (isset($search_params['count_type']) && $search_params['count_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponCountOp">И</span>
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
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMaker( 'searchWeaponCategory' , 'category' );
        searchMultiSelectMaker( 'searchWeaponView' , 'view' );
        searchMultiSelectMaker( 'searchWeaponType' , 'type' );
        searchMultiSelectMaker( 'searchWeaponMark' , 'model' );
        searchMultiSelectMaker( 'searchWeaponAccountNumber' , 'reg_num' );
        searchMultiSelectMaker( 'searchWeaponCount' , 'count' );

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#weapon_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#weapon_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });


        <?php if (isset($search_params)) { ?>
            $('#searchWeaponCategory').val("<?php echo html_entity_decode($search_params['category'][sizeof($search_params['category'])-1]) ?>");
            $('#searchWeaponView').val("<?php echo html_entity_decode($search_params['view'][sizeof($search_params['view'])-1]) ?>");
            $('#searchWeaponType').val("<?php echo html_entity_decode($search_params['type'][sizeof($search_params['type'])-1]) ?>");
            $('#searchWeaponMark').val("<?php echo html_entity_decode($search_params['model'][sizeof($search_params['model'])-1]) ?>");
            $('#searchWeaponAccountNumber').val("<?php echo html_entity_decode($search_params['reg_num'][sizeof($search_params['reg_num'])-1]) ?>");
            $('#searchWeaponCount').val("<?php echo html_entity_decode($search_params['count'][sizeof($search_params['count'])-1]) ?>");
            $('#fileSearch').val("<?php echo html_entity_decode($search_params['content']) ?>");
        <?php } ?>
    });

</script>
