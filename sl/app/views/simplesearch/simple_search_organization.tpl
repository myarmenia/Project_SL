<a class="closeButton" ></a>
<div class="inContent">
    <form id="organizationForm" action="<?php echo ROOT;?>simplesearch/result_organization" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="<?php echo $Lang->and; ?>" id="organization_and" />
            <input type="button" class="k-button" value="<?php echo $Lang->or; ?>" id="organization_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
            <input type="submit" class="k-button" name="submit" value="<?php echo $Lang->search;?>" /> <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['name_organization'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganNameOrganizationFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['name_organization'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganNameOrganization">
                    <div class="item">
                        <span><?php echo $search_params['name_organization'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="name_organization[]" value="<?php echo $search_params['name_organization'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="name_organization_type" id="searchOrganNameOrganizationType" value="<?php echo $search_params['name_organization_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm" >
            <label for="searchOrganNameOrganization"><?php echo $Lang->name_organization;?></label>
            <input type="text" name="name_organization[]" id="searchOrganNameOrganization" class="oneInputSaveEnter" />
            <?php if (isset($search_params['name_organization_type']) && $search_params['name_organization_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNameOrganizationOp">ИЛИ</span>
            <?php } else if (isset($search_params['name_organization_type']) && $search_params['name_organization_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNameOrganizationOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['country_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganNationFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['country_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganNation">
                    <div class="item">
                        <span><?php echo $search_params['country_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="country_id[]" value="<?php echo $search_params['country_id'][$i] ?>">
                    <input type="hidden" name="country_idName[]" value="<?php echo $search_params['country_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="country_id_type" id="searchOrganNationType" value="<?php echo $search_params['country_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganNation"><?php echo $Lang->nation;?></label>
            <input type="button" dataName="searchOrganNation" dataId="searchOrganNationId" dataTableName="fancy/country" class="addMore k-icon k-i-plus"   />
            <input type="text" name="nation" id="searchOrganNation" dataTableName="country" dataInputId="searchOrganNationId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNationOp">ИЛИ</span>
            <?php } else if (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNationOp">И</span>
            <?php } ?>
            <input type="hidden" name="country_id[]" id="searchOrganNationId" />
        </div>

        <div class="forForm">
            <label for="searchOrganDateFormation"><?php echo $Lang->date_formation;?></label>
            <input type="text" name="reg_date" id="searchOrganDateFormation" style="width: 505px;" onkeydown="validateNumber(event,'searchOrganDateFormation',12)" class="oneInputSaveEnter oneInputSaveDateOrganization"/>
        </div>

        <?php if (isset($search_params) && isset($search_params['country_ate_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganRegionActivityFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['country_ate_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganRegionActivity">
                    <div class="item">
                        <span><?php echo $search_params['country_ate_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="country_ate_id[]" value="<?php echo $search_params['country_ate_id'][$i] ?>">
                    <input type="hidden" name="country_ate_idName[]" value="<?php echo $search_params['country_ate_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="country_ate_id_type" id="searchOrganRegionActivityType" value="<?php echo $search_params['country_ate_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganRegionActivity"><?php echo $Lang->region_activity;?></label>
            <input type="button" dataName="searchOrganRegionActivity" dataId="searchOrganRegionActivityId" dataTableName="fancy/country_ate" class="addMore k-icon k-i-plus"   />
            <input type="text" name="region_activity" id="searchOrganRegionActivity" dataTableName="country_ate" dataInputId="searchOrganRegionActivityId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganRegionActivityOp">ИЛИ</span>
            <?php } else if (isset($search_params['country_ate_id_type']) && $search_params['country_ate_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganRegionActivityOp">И</span>
            <?php } ?>
            <input type="hidden" name="country_ate_id[]" id="searchOrganRegionActivityId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['category_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganCategoryOrganizationFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['category_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganCategoryOrganization">
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
            <input type="hidden" name="category_id_type" id="searchOrganCategoryOrganizationType" value="<?php echo $search_params['category_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganCategoryOrganization"><?php echo $Lang->category_organization;?></label>
            <input type="button" dataName="searchOrganCategoryOrganization" dataId="searchOrganCategoryOrganizationId" dataTableName="fancy/organization_category" class="addMore k-icon k-i-plus"   />
            <input type="text" name="category_organization" id="searchOrganCategoryOrganization" dataTableName="organization_category" dataInputId="searchOrganCategoryOrganizationId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganCategoryOrganizationOp">ИЛИ</span>
            <?php } else if (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganCategoryOrganizationOp">И</span>
            <?php } ?>
            <input type="hidden" name="category_id[]" id="searchOrganCategoryOrganizationId" />
        </div>


        <?php if (isset($search_params) && isset($search_params['agency_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganSecurityOrganizationFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['agency_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganSecurityOrganization">
                    <div class="item">
                        <span><?php echo $search_params['agency_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="agency_id[]" value="<?php echo $search_params['agency_id'][$i] ?>">
                    <input type="hidden" name="agency_idName[]" value="<?php echo $search_params['agency_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="agency_id_type" id="searchOrganSecurityOrganizationType" value="<?php echo $search_params['agency_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganSecurityOrganization"><?php echo $Lang->security_organization;?></label>
            <input type="button" dataName="searchOrganSecurityOrganization" dataId="searchOrganSecurityOrganizationId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="security_organization" id="searchOrganSecurityOrganization" dataTableName="agency" dataInputId="searchOrganSecurityOrganizationId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['agency_id_type']) && $search_params['agency_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganSecurityOrganizationOp">ИЛИ</span>
            <?php } else if (isset($search_params['agency_id_type']) && $search_params['agency_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganSecurityOrganizationOp">И</span>
            <?php } ?>
            <input type="hidden" name="agency_id[]" id="searchOrganSecurityOrganizationId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['employers_count'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganNumberWorkerFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['employers_count'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganNumberWorker">
                    <div class="item">
                        <span><?php echo $search_params['employers_count'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="employers_count[]" value="<?php echo $search_params['employers_count'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="employers_count_type" id="searchOrganNumberWorkerType" value="<?php echo $search_params['employers_count_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganNumberWorker"><?php echo $Lang->number_worker;?></label>
            <input type="text" name="employers_count[]" id="searchOrganNumberWorker" class="oneInputSaveEnter" />
            <?php if (isset($search_params['employers_count_type']) && $search_params['employers_count_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNumberWorkerOp">ИЛИ</span>
            <?php } else if (isset($search_params['employers_count_type']) && $search_params['employers_count_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganNumberWorkerOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['attension'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganAttentionFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['attension'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganAttention">
                    <div class="item">
                        <span><?php echo $search_params['attension'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="attension[]" value="<?php echo $search_params['attension'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="attension_type" id="searchOrganAttentionType" value="<?php echo $search_params['attension_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganAttention"><?php echo $Lang->attention;?></label>
            <input type="text" name="attension[]" id="searchOrganAttention" class="oneInputSaveEnter" />
            <?php if (isset($search_params['attension_type']) && $search_params['attension_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganAttentionOp">ИЛИ</span>
            <?php } else if (isset($search_params['attension_type']) && $search_params['attension_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganAttentionOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['opened_dou'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchOrganOrganizationDowFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['opened_dou'])-1 ; $i++ ) { ?>
                <li id="listItemsearchOrganOrganizationDow">
                    <div class="item">
                        <span><?php echo $search_params['opened_dou'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="opened_dou[]" value="<?php echo $search_params['opened_dou'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="opened_dou_type" id="searchOrganOrganizationDowType" value="<?php echo $search_params['opened_dou_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchOrganOrganizationDow"><?php echo $Lang->organization_dow;?></label>
            <input type="text" name="opened_dou[]" id="searchOrganOrganizationDow" class="oneInputSaveEnter" />
            <?php if (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganOrganizationDowOp">ИЛИ</span>
            <?php } else if (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchOrganOrganizationDowOp">И</span>
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
    var currentInputNameOrgan;
    var currentInputIdOrgan;
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMaker( 'searchOrganNameOrganization' , 'name_organization' );
        searchMultiSelectMaker( 'searchOrganNumberWorker' , 'employers_count' );
        searchMultiSelectMaker( 'searchOrganAttention' , 'attension' );
        searchMultiSelectMaker( 'searchOrganOrganizationDow' , 'opened_dou' );

        searchMultiSelectMakerAutoComplete( 'searchOrganNation' , 'country_id' );
        searchMultiSelectMakerAutoComplete( 'searchOrganRegionActivity' , 'country_ate_id' );
        searchMultiSelectMakerAutoComplete( 'searchOrganCategoryOrganization' , 'category_id' );
        searchMultiSelectMakerAutoComplete( 'searchOrganSecurityOrganization' , 'agency_id' );

        $('.oneInputSaveDateOrganization').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateOrganization').focusout(function(e){
            var val = $(this).val();
            var field = $(this).attr('name');
            var reg = date_preg;
            var c = $(window.lastElementClicked).attr('id');
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
                        if( c!= 'resetButton'){
                            alert('<?php echo $Lang->enter_number;?>');
                        }
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        if( c!= 'resetButton'){
                            alert('<?php echo $Lang->enter_number;?>');
                        }
                    }else{
                    }
                }
            }
        });

        $('#searchOrganNation').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/country/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchOrganNationId').val(dataItem.id);
            }
        });


        $('#searchOrganRegionActivity').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/country_ate/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchOrganRegionActivityId').val(dataItem.id);
            }
        });


        $('#searchOrganCategoryOrganization').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/organization_category/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchOrganCategoryOrganizationId').val(dataItem.id);
            }
        });


        $('#searchOrganSecurityOrganization').kendoAutoComplete({
            dataTextField: "name",
            filter: "contains",
            minLength: 3,
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/agency/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchOrganSecurityOrganizationId').val(dataItem.id);
            }
        });

        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameOrgan = $(this).attr('dataName');
            currentInputIdOrgan = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=organization"
            });
        });

        $('#closeOrganization').click(function(e){
            e.preventDefault();
            var dataId = $('.activeTable').attr('dataId');
            $('.activeTable').addClass('storedItem');
            if(typeof  dataId == 'undefined'){
                $('.activeTable').append(' : id = '+organization_id);
                $('.activeTable').attr('dataId',organization_id);
            }
            $('.activeTable').removeClass('activeTable');
        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#organization_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#organization_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchOrganNameOrganization').val("<?php echo html_entity_decode($search_params['name_organization'][sizeof($search_params['name_organization'])-1]) ?>");
            $('#searchOrganNationId').val("<?php echo $search_params['country_id'][sizeof($search_params['country_id'])-1] ?>");
            $('#searchOrganNation').val("<?php echo html_entity_decode($search_params['nation']) ?>");
            $('#searchOrganDateFormation').val("<?php echo $search_params['reg_date'] ?>");
            $('#searchOrganRegionActivityId').val("<?php echo $search_params['country_ate_id'][sizeof($search_params['country_ate_id'])-1] ?>");
            $('#searchOrganRegionActivity').val("<?php echo html_entity_decode($search_params['region_activity']) ?>");
            $('#searchOrganCategoryOrganizationId').val("<?php echo $search_params['category_id'][sizeof($search_params['category_id'])-1] ?>");
            $('#searchOrganCategoryOrganization').val("<?php echo html_entity_decode($search_params['category_organization']) ?>");
            $('#searchOrganSecurityOrganizationId').val("<?php echo $search_params['agency_id'][sizeof($search_params['agency_id'])-1] ?>");
            $('#searchOrganSecurityOrganization').val("<?php echo html_entity_decode($search_params['security_organization']) ?>");
            $('#searchOrganNumberWorker').val("<?php echo html_entity_decode($search_params['employers_count'][sizeof($search_params['employers_count'])-1]) ?>");
            $('#searchOrganAttention').val("<?php echo html_entity_decode($search_params['attension'][sizeof($search_params['attension'])-1]) ?>");
            $('#searchOrganOrganizationDow').val("<?php echo html_entity_decode($search_params['opened_dou'][sizeof($search_params['opened_dou'])-1]) ?>");
            $('#fileSearch').val("<?php echo html_entity_decode($search_params['content']) ?>");
        <?php } ?>
    });

    function closeOrganization(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameOrgan).val(name);
        $('#'+currentInputIdOrgan).val(id);
        var field = $('#'+currentInputIdOrgan).attr('name');

        $.fancybox.close();
        $('#'+currentInputNameOrgan).focus();
    }


</script>