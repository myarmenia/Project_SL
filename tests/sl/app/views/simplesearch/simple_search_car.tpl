<a class="closeButton"></a>
<div class="inContent">
    <form id="carForm" action="<?php echo ROOT;?>simplesearch/result_car" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="<?php echo $Lang->and; ?>" id="car_and" />
            <input type="button" class="k-button" value="<?php echo $Lang->or; ?>" id="car_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton"  class="k-button" ><?php echo $Lang->reset; ?></a>
            <input type="submit" class="k-button" name="submit" value="<?php echo $Lang->search;?>" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['category_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCarCategoryFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['category_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCarCategory">
                    <div class="item">
                        <span><?php echo $search_params['category_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="category_id[]" value="<?php echo $search_params['category_id'][$i] ?>">
                    <input type="hidden" name="category_idName[]" value="<?php echo $search_params['category_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="category_id_type" id="searchCarCategoryType" value="<?php echo $search_params['category_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCarCategory"><?php echo $Lang->car_cat;?></label>
            <input type="button" dataName="searchCarCategory" dataId="searchCarCategoryId" dataTableName="fancy/car_category" class="addMore k-icon k-i-plus"   />
            <input type="text" name="category" id="searchCarCategory" dataInputId="searchCarCategoryId" dataTableName="car_category" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCategoryOp">ИЛИ</span>
            <?php } else if (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCategoryOp">И</span>
            <?php } ?>
            <input type="hidden" name="category_id[]" id="searchCarCategoryId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['mark_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCarViewFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['mark_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCarView">
                    <div class="item">
                        <span><?php echo $search_params['mark_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="mark_id[]" value="<?php echo $search_params['mark_id'][$i] ?>">
                    <input type="hidden" name="mark_idName[]" value="<?php echo $search_params['mark_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="mark_id_type" id="searchCarViewType" value="<?php echo $search_params['category_idName'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCarView"><?php echo $Lang->mark;?></label>
            <input type="button" dataName="searchCarView" dataId="searchCarViewId" dataTableName="fancy/car_mark" class="addMore k-icon k-i-plus"   />
            <input type="text" name="mark" id="searchCarView" dataInputId="searchCarViewId" dataTableName="car_mark" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['mark_id_type']) && $search_params['mark_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarViewOp">ИЛИ</span>
            <?php } else if (isset($search_params['mark_id_type']) && $search_params['mark_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarViewOp">И</span>
            <?php } ?>
            <input type="hidden" name="mark_id[]" id="searchCarViewId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['color'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCarColorFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['color'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCarColor">
                    <div class="item">
                        <span><?php echo $search_params['color'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="color[]" value="<?php echo $search_params['color'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="color_type" id="searchCarColorType" value="<?php echo $search_params['color_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCarColor"><?php echo $Lang->color;?></label>
            <input  type="text" name="color[]" id="searchCarColor" class="oneInputSaveEnter" />
            <?php if (isset($search_params['color_type']) && $search_params['color_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarColorOp">ИЛИ</span>
            <?php } else if (isset($search_params['color_type']) && $search_params['color_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarColorOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['number'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCarCarNumberFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['number'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCarCarNumber">
                    <div class="item">
                        <span><?php echo $search_params['number'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="number[]" value="<?php echo $search_params['number'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="number_type" id="searchCarCarNumberType" value="<?php echo $search_params['number_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCarCarNumber"><?php echo $Lang->car_number;?></label>
            <input class="oneInputSaveEnter" type="text" name="number[]" id="searchCarCarNumber"/>
            <?php if (isset($search_params['number_type']) && $search_params['number_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCarNumberOp">ИЛИ</span>
            <?php } else if (isset($search_params['number_type']) && $search_params['number_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCarNumberOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['count'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCarCountFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['count'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCarCount">
                    <div class="item">
                        <span><?php echo $search_params['count'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="count[]" value="<?php echo $search_params['count'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="count_type" id="searchCarCountType" value="<?php echo $search_params['count_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCarCount"><?php echo $Lang->count;?></label>
            <input class="oneInputSaveEnter" onkeydown="validateNumber(event,'searchCarCount',20)" type="text" name="count[]" id="searchCarCount"/>
            <?php if (isset($search_params['count_type']) && $search_params['count_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCountOp">ИЛИ</span>
            <?php } else if (isset($search_params['count_type']) && $search_params['count_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCountOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['note'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCarAdditionalDataFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['note'])-1 ; $i++ ) { ?>
                <li id="listItemsearchCarAdditionalData">
                    <div class="item">
                        <span><?php echo $search_params['note'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="note[]" value="<?php echo $search_params['note'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="note_type" id="searchCarAdditionalDataType" value="<?php echo $search_params['note_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchCarAdditionalData"><?php echo $Lang->additional_data;?></label>
            <input class="oneInputSaveEnter" type="text" name="note[]" id="searchCarAdditionalData" />
            <?php if (isset($search_params['note_type']) && $search_params['note_type'] == 'OR') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarAdditionalDataOp">ИЛИ</span>
            <?php } else if (isset($search_params['note_type']) && $search_params['note_type'] == 'AND') { ?>
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarAdditionalDataOp">И</span>
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
    var currentInputNameCar;
    var currentInputIdCar;
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMaker( 'searchCarColor' , 'color' );
        searchMultiSelectMaker( 'searchCarCarNumber' , 'number' );
        searchMultiSelectMaker( 'searchCarCount' , 'count' );
        searchMultiSelectMaker( 'searchCarAdditionalData' , 'note' );

        searchMultiSelectMakerAutoComplete( 'searchCarCategory' , 'category_id' );
        searchMultiSelectMakerAutoComplete( 'searchCarView' , 'mark_id' );


        $('#searchCarCategory').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/car_category/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchCarCategoryId').val(dataItem.id);
            }
        });



        $('#searchCarView').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/car_mark/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchCarViewId').val(dataItem.id);
            }
        });




        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameCar = $(this).attr('dataName');
            currentInputIdCar = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=car"
            });
        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#car_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#car_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchCarCategory').val("<?php echo html_entity_decode($search_params['category']) ?>");
            $('#searchCarCategoryId').val("<?php echo $search_params['category_id'][sizeof($search_params['category_id'])-1] ?>");
            $('#searchCarViewId').val("<?php echo $search_params['mark_id'][sizeof($search_params['mark_id'])-1] ?>");
            $('#searchCarView').val("<?php echo html_entity_decode($search_params['mark']) ?>");
            $('#searchCarColor').val("<?php echo html_entity_decode($search_params['color'][sizeof($search_params['color'])-1]) ?>");
            $('#searchCarCarNumber').val("<?php echo html_entity_decode($search_params['number'][sizeof($search_params['number'])-1]) ?>");
            $('#searchCarCount').val("<?php echo html_entity_decode($search_params['count'][sizeof($search_params['count'])-1]) ?>");
            $('#searchCarAdditionalData').val("<?php echo $search_params['note'][sizeof($search_params['note'])-1] ?>");
            $('#fileSearch').val("<?php echo html_entity_decode($search_params['content']) ?>");
        <?php } ?>

    });

    function closeFCar(name,id){
        //        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameCar).val(name);
        $('#'+currentInputIdCar).val(id);
        var field = $('#'+currentInputIdCar).attr('name');

        $.fancybox.close();
    }


</script>


