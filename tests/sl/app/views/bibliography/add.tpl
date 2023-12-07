<a class="closeButton" id="<?php echo $_SESSION['counter']; ?>closeBibl"></a>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>bibliographyForm">
        <?php
            $dt = explode(' ',$dateTime);
            $dateChange = explode('-',$dt[0]);
        ?>
        <div class="forForm">
            <label>1) <?php echo $Lang->date_and_time_date; ?></label>
            <span><?php echo $dateChange[2].'-'.$dateChange[1].'-'.$dateChange[0]; ?></span>
        </div>
        <div class="forForm">
            <label>2) <?php echo $Lang->date_and_time_time; ?></label>
            <span><?php echo $dt[1]; ?></span>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblFromAgencyName">3) <?php echo $Lang->organ; ?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>biblFromAgencyName" dataId="<?php echo $_SESSION['counter']; ?>biblFromAgencyId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus" />
            <input type="text" name="from_agency_name" id="<?php echo $_SESSION['counter']; ?>biblFromAgencyName" class="oneInputSaveEnter" firstItem="1" dataInputId="<?php echo $_SESSION['counter']; ?>biblFromAgencyId" dataTableName="agency"<?php if(isset($bibliography)){ if(!empty($bibliography['from_agency'])){ echo "value='".$bibliography['from_agency']."'"; } }?>/>
            <input type="hidden" name="from_agency_id" id="<?php echo $_SESSION['counter']; ?>biblFromAgencyId" <?php if(isset($bibliography)){ if(!empty($bibliography['from_agency_id'])){ echo "value='".$bibliography['from_agency_id']."'"; } }?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblDocCatTitle">4) <?php echo $Lang->document_category; ?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>biblDocCatTitle" dataId="<?php echo $_SESSION['counter']; ?>biblDocCatId" dataTableName="fancy/doc_category" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"  />
            <input type="text" name="category_title" id="<?php echo $_SESSION['counter']; ?>biblDocCatTitle" class="oneInputSaveEnter" dataInputId="<?php echo $_SESSION['counter']; ?>biblDocCatId" dataTableName="doc_category" <?php if(isset($bibliography)){ if(!empty($bibliography['doc_category'])){ echo "value='".$bibliography['doc_category']."'"; } }?> />
            <input type="hidden" name="category_id" id="<?php echo $_SESSION['counter']; ?>biblDocCatId" <?php if(isset($bibliography)){ if(!empty($bibliography['category_id'])){ echo "value='".$bibliography['category_id']."'"; } }?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblAccessLevelName">5) <?php echo $Lang->access_level; ?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>biblAccessLevelName" dataId="<?php echo $_SESSION['counter']; ?>biblAccessLevelId" dataTableName="fancy/access_level" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"  />
            <input type="text" name="access_level_name" id="<?php echo $_SESSION['counter']; ?>biblAccessLevelName" class="oneInputSaveEnter" dataInputId="<?php echo $_SESSION['counter']; ?>biblAccessLevelId" dataTableName="access_level" <?php if(isset($bibliography)){ if(!empty($bibliography['access_level'])){ echo "value='".$bibliography['access_level']."'"; } }?>/>
            <input type="hidden" name="access_level_id" id="<?php echo $_SESSION['counter']; ?>biblAccessLevelId" <?php if(isset($bibliography)){ if(!empty($bibliography['access_level_id'])){ echo "value='".$bibliography['access_level_id']."'"; } }?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblUserName">6) <?php echo $Lang->created_user; ?></label>
            <input type="text" readonly="readonly" id="<?php echo $_SESSION['counter']; ?>biblUserName" class="oneInputSaveEnter" value="<?php echo $user['first_name'].' '.$user['last_name'];?>"/>
            <input type="hidden" name="user_id" id="<?php echo $_SESSION['counter']; ?>biblUserId" value="<?php echo $user['id']?>"/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblSource">7) <?php echo $Lang->reg_document; ?></label>
            <input type="text" id="<?php echo $_SESSION['counter']; ?>biblRegNumber" name="reg_number" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($bibliography)){ if(!empty($bibliography['reg_number'])){ echo "value='".$bibliography['reg_number']."'"; } }?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblSource">8) <?php echo $Lang->date_reg; ?></label>
            <input type="text" id="<?php echo $_SESSION['counter']; ?>biblRegDate" name="reg_date" style="width: 505px;" onkeydown="validateNumber(event ,'<?php echo $_SESSION['counter']; ?>biblRegDate',12)" class="oneInputSaveDate oneInputSaveEnter dotsToDash" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblWorkerName">9) <?php echo $Lang->worker_take_doc; ?></label>
          <!--  <input type="button" dataName="<?php echo $_SESSION['counter']; ?>biblWorkerName" dataId="<?php echo $_SESSION['counter']; ?>biblWorkerId" dataTableName="fancyWorker" class="addMore k-icon k-i-plus"  />
            <input type="hidden" name="worker_id" id="<?php echo $_SESSION['counter']; ?>biblWorkerId" />
            <div id="<?php echo $_SESSION['counter']; ?>addedWorker" class="workerMulti"></div> -->
            <input type="text" name="worker_name" id="<?php echo $_SESSION['counter']; ?>biblWorkerName" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($bibliography)){ if(!empty($bibliography['worker_name'])){ echo "value='".$bibliography['worker_name']."'"; } }?> />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblSourceAgencyName">10) <?php echo $Lang->source_agency; ?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>biblSourceAgencyName" dataId="<?php echo $_SESSION['counter']; ?>biblSourceAgencyId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"  />
            <input type="text" name="source_agency_name" id="<?php echo $_SESSION['counter']; ?>biblSourceAgencyName" class="oneInputSaveEnter" dataInputId="<?php echo $_SESSION['counter']; ?>biblSourceAgencyId" dataTableName="agency" <?php if(isset($bibliography)){ if(!empty($bibliography['source_agency'])){ echo "value='".$bibliography['source_agency']."'"; } }?>/>
            <input type="hidden" name="source_agency_id" id="<?php echo $_SESSION['counter']; ?>biblSourceAgencyId" <?php if(isset($bibliography)){ if(!empty($bibliography['source_agency_id'])){ echo "value='".$bibliography['source_agency_id']."'"; } }?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblSourceAddress">11) <?php echo $Lang->source_address; ?></label>
            <input type="text" name="source_address" id="<?php echo $_SESSION['counter']; ?>biblSourceAddress" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($bibliography)){ if(!empty($bibliography['source_address'])){ echo "value='".$bibliography['source_address']."'"; } }?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblShortDesc">12) <?php echo $Lang->short_desc; ?></label>
            <input type="text" id="<?php echo $_SESSION['counter']; ?>biblShortDesc" name="short_desc" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($bibliography)){ if(!empty($bibliography['short_desc'])){ echo "value='".$bibliography['short_desc']."'"; } }?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblRelatedYear">13) <?php echo $Lang->related_year; ?></label>
            <input type="text" id="<?php echo $_SESSION['counter']; ?>biblRelatedYear" name="related_year" onkeydown="validateNumber(event ,'<?php echo $_SESSION['counter']; ?>biblRelatedYear',5)" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($bibliography)){ if(!empty($bibliography['related_year'])){ echo "value='".$bibliography['related_year']."'"; } }?>/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblSource">14) <?php echo $Lang->source_inf; ?></label>
            <input type="text" id="<?php echo $_SESSION['counter']; ?>biblSource" name="source" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($bibliography)){ if(!empty($bibliography['source'])){ echo "value='".$bibliography['source']."'"; } }?>/>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>biblCountryFilter" style="border: none;" >
                <?php if(isset($bibliography_has_country)) {
                        if(!empty($bibliography_has_country)) {
                            foreach($bibliography_has_country as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>listItembiblCountry<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , 'biblCountry' , 'delete_bibliography_has_country', '<?php echo $bId;?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                       }?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblCountry">15) <?php echo $Lang->information_country; ?></label>
            <!--input type="text" id="<?php echo $_SESSION['counter']; ?>biblCountryId" name="country_id" class="oneInputSave oneInputSaveEnter" /-->
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>biblCountry" dataId="<?php echo $_SESSION['counter']; ?>biblCountryId" dataTableName="fancy/country" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"  />
            <input type="text" name="country" id="<?php echo $_SESSION['counter']; ?>biblCountry" class="oneInputSaveEnter" dataInputId="<?php echo $_SESSION['counter']; ?>biblCountryId" dataTableName="country"/>
            <input type="hidden" name="country_id" id="<?php echo $_SESSION['counter']; ?>biblCountryId" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblSource">16) <?php echo $Lang->name_subject; ?></label>
            <input type="text" id="<?php echo $_SESSION['counter']; ?>biblTheme" name="theme" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($bibliography)){ if(!empty($bibliography['theme'])){ echo "value='".$bibliography['theme']."'"; } }?> />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>biblSource">17) <?php echo $Lang->title_document; ?></label>
            <input type="text" id="<?php echo $_SESSION['counter']; ?>biblTitle" name="title" class="oneInputSave<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" lastItem="1" <?php if(isset($bibliography)){ if(!empty($bibliography['title'])){ echo "value='".$bibliography['title']."'"; } }?>/>
        </div>
        <div class="forForm">
            <label>18) <?php echo $Lang->contents_document; ?></label>
            <div id="<?php echo $_SESSION['counter']; ?>file-uploader-bible"></div>
            <ul id="<?php echo $_SESSION['counter']; ?>uploadedFiles" class="uploader">
                <?php if(isset($bibliography_has_file)) {
                        if(!empty($bibliography_has_file)) {
                            foreach($bibliography_has_file as $val) { ?>
                             <li><span class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> добавлен</span> | <a class="deleteFile" data-id="<?php echo $val['id']; ?>">X</a></li>
                <?php       }
                        }
                      }?>
            </ul>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>video">19) <?php echo $Lang->video; ?></label>
            <div style="width: 500px;float: right;">
                <input type="checkbox" id="<?php echo $_SESSION['counter']; ?>video" style="float: left;" <?php if(isset($bibliography)){ if($bibliography['video']){ echo "checked"; } }?>/>
            </div>
        </div>
        <div class="forForm">
            <label style="text-transform: uppercase;font-weight: bold;"><?php echo $Lang->face.' ('.$Lang->count.')'; ?> : <?php echo $man_count; ?></label>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>havTables">20) <?php echo $Lang->inf_cont; ?></label>
            <select id="<?php echo $_SESSION['counter']; ?>addTable">
                <option value="0">.....</option>
                <option value="man"><?php echo $Lang->face; ?></option>
                <option value="organization"><?php echo $Lang->organization; ?></option>
                <option id="<?php echo $_SESSION['counter']; ?>eventOption" value="event"><?php echo $Lang->event; ?></option>
                <option id="<?php echo $_SESSION['counter']; ?>signalOption" value="signal"><?php echo $Lang->signal; ?></option>
                <option id="<?php echo $_SESSION['counter']; ?>criminal_caseOption" value="criminal_case"><?php echo $Lang->criminal; ?></option>
                <option id="<?php echo $_SESSION['counter']; ?>actionOption" value="action"><?php echo $Lang->action; ?></option>
                <option id="<?php echo $_SESSION['counter']; ?>controlOption" value="control"><?php echo $Lang->control; ?></option>
                <option id="<?php echo $_SESSION['counter']; ?>mia_summaryOption" value="mia_summary"><?php echo $Lang->mia_summary; ?></option>
            </select>
            <div class="multiselect">
<?php $i = 0; $m_c = 0;?>

                <?php if(isset($bibliography_has)) {
                        if(!empty($bibliography_has)) {
                            foreach($bibliography_has as $val) { $i++; ?>
                                <?php
                                $f_echo = '';
                                $f_hide= '';
                                if($val['tb_name'] == 'man'){
                                    if($m_c < 9 ){
                                        $m_c++;
                                    }else{
                                        $f_echo = 'style="display: none;"';
                                        $f_hide= 'hideAllMan'.$_SESSION['counter'];
                                        $m_c++;
                                    }
                                }
                                ?>
                <div <?php echo $f_echo; ?> class="showAllMan<?php echo $_SESSION['counter'];?> <?php echo $f_hide; ?>">
                    <span class="newTable storedItem" dataName="<?php echo $val['tb_name']; ?>/<?php echo $bId; ?>" dataId="<?php echo $val['id']; ?>" >
                        <?php
                                switch($val['tb_name']){
                                case 'man': echo $Lang ->face;break;
                                case 'action': echo $Lang->action;break;
                                case 'event': echo $Lang->event;break;
                                case 'organization': echo $Lang->organization;break;
                                case 'signal': echo $Lang->signal;break;
                                case 'criminal_case': echo $Lang->criminal;break;
                                case 'mia_summary': echo $Lang->mia_summary;break;
                                case 'control': echo $Lang->control;break;
                            }
                        ?>
                        : id = <?php echo $val['id']; ?></span>
                        <span class="deleteMulti" old_counter="<?php echo $_SESSION['counter']; ?>" dataName="<?php echo $_SESSION['counter']; ?><?php echo $val['tb_name']; ?>">
                        x
                        <span></span>
                        </span>
                </div>
                <?php       }
                        }
                      } ?>
            </div>
            <?php if($m_c > 9){ ?>
                <div><span class="see_more_man k-button" counter="<?php echo $_SESSION['counter'];?>" act="+"><?php echo $Lang->show; ?></span></div>
            <?php } ?>
        </div>
        <div class="buttons">
           <!-- <input type="button" value="Сохранить" id="<?php echo $_SESSION['counter']; ?>biblSave"/> -->
            <!-- <input type="button" value="Отменить" id="<?php echo $_SESSION['counter']; ?>biblCancel"/> -->
        </div>
    </form>
</div>

<script>
    var currentInputNameBibl;
    var currentInputIdBibl;
    <?php if(isset($bibliography)) { ?>
        var checkBibl = false ;
    <?php }else{ ?>
        var checkBibl = true ;
    <?php } ?>
    var bId = '<?php echo $bId;?>';
    $(document).ready(function(){

        $('#<?php echo $_SESSION['counter']; ?>biblRegDate').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>biblFromAgencyName').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>biblFromAgencyId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>biblDocCatTitle').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/doc_category/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>biblDocCatId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>biblAccessLevelName').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/access_level/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>biblAccessLevelId').val(dataItem.id);
            }
        });

//        var workerAutocomplete = $('#<?php echo $_SESSION['counter']; ?>biblWorkerName').kendoAutoComplete({
//            dataTextField: "name",
//            filter:'contains',
//            dataSource: {
//                transport: {
//                    read:{
//                        dataType: "json",
//                        url: "<?php echo ROOT;?>autocomplete/worker"
//                    }
//                }
//            },
//            select:function(e){
//                var dataItem = this.dataItem(e.item.index());
//                $('#<?php echo $_SESSION['counter']; ?>biblWorkerId').val(dataItem.id);
//                closeWorker(dataItem.name,dataItem.id);
//            },
//            close:function(e){
//                $('#<?php echo $_SESSION['counter']; ?>biblWorkerName').val('');
//            }
//        });

        $('#<?php echo $_SESSION['counter']; ?>biblSourceAgencyName').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>biblSourceAgencyId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>biblCountry').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>biblCountryId').val(dataItem.id);
            }
        });

        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameBibl = $(this).attr('dataName');
            currentInputIdBibl = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=bibl&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>addTable').change(function(e){
            e.preventDefault();
            var text = fText = $("#<?php echo $_SESSION['counter']; ?>addTable :selected").text();
            var val = fVal =  $("#<?php echo $_SESSION['counter']; ?>addTable").val();
            $("#<?php echo $_SESSION['counter']; ?>addTable").val(0);
            $('.multiselect').append('<div><span class="newTable activeTable" dataName="'+val+'/'+bId+'">'+text+'</span><span dataName="'+val+'" old_counter="<?php echo $_SESSION['counter']; ?>" class="deleteMulti">x<span>');

            if(val == 'man'){

                $.ajax({
                    url: '<?php echo ROOT?>open/'+val+'/'+'bibliography'+'/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                    dataType: 'html',
                    success: function(data){
                        addItem(data,text);
                    },
                    faild: function(data){
                        alert('error ');
                    }
                });

            }else{
                if(val == 'organization'){
                    $.ajax({
                        url: '<?php echo ROOT?>open/'+val+'/'+'bibliography'+'/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                        dataType: 'html',
                        success: function(data){
                            addItem(data,text);
                        },
                        faild: function(data){
                            alert('error ');
                        }
                    });
                }else{
                    $.ajax({
                        url: '<?php echo ROOT?>add/'+val+'/'+bId,
                        dataType: 'html',
                        success: function(data){
                            addItem(data,text);
                        },
                        faild: function(data){
                            alert('error ');
                        }
                    });
                }
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>biblFromAgencyName').focusout(function(e){
            e.preventDefault();
            var text = $(this).val();
            var id = $('#<?php echo $_SESSION['counter']; ?>biblFromAgencyId').val();
            var field = 'from_agency_id';
            if(text.length != 0){
                if(id.length == 0){
                    saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
                    $('#<?php echo $_SESSION['counter']; ?>biblFromAgencyName').val('');
                    $('#<?php echo $_SESSION['counter']; ?>biblFromAgencyId').val('');
                    alert('<?php echo $Lang->enter_organ;?>');
                }else{
                    saveBibl<?php echo $_SESSION['counter']; ?>(id,field);
                }
            }else{
                saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

//        $('#<?php echo $_SESSION['counter']; ?>biblCountry').focusout(function(e){
//            e.preventDefault();
//            var text = $(this).val();
//            var id = $('#<?php echo $_SESSION['counter']; ?>biblCountryId').val();
//            var field = 'country_id';
//            if(text.length != 0){
//                if(id.length == 0){
//                    saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
//                    $('#<?php echo $_SESSION['counter']; ?>biblCountry').val('');
//                    $('#<?php echo $_SESSION['counter']; ?>biblCountryId').val('');
//                    alert('<?php echo $Lang->enter_country;?>');
//                }else{
//                    saveBibl<?php echo $_SESSION['counter']; ?>(id,field);
//                }
//            }else{
//                saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
//            }
//        });

        $('#<?php echo $_SESSION['counter']; ?>biblSourceAgencyName').focusout(function(e){
            e.preventDefault();
            var text = $(this).val();
            var id = $('#<?php echo $_SESSION['counter']; ?>biblSourceAgencyId').val();
            var field = 'source_agency_id';
            if(text.length != 0){
                if(id.length == 0){
                    saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_organ;?>');
                    $('#<?php echo $_SESSION['counter']; ?>biblSourceAgencyName').val('');
                    $('#<?php echo $_SESSION['counter']; ?>biblSourceAgencyId').val('');
                }else{
                    saveBibl<?php echo $_SESSION['counter']; ?>(id,field);
                }
            }else{
                saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>biblDocCatTitle').focusout(function(e){
            e.preventDefault();
            var text = $(this).val();
            var id = $('#<?php echo $_SESSION['counter']; ?>biblDocCatId').val();
            var field = 'category_id';
            if(text.length != 0){
                if(id.length == 0){
                    saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_category;?>');
                    $('#<?php echo $_SESSION['counter']; ?>biblDocCatTitle').val('');
                    $('#<?php echo $_SESSION['counter']; ?>biblDocCatId').val('');
                }else{
                    saveBibl<?php echo $_SESSION['counter']; ?>(id,field);
                }
            }else{
                saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>biblAccessLevelName').focusout(function(e){
            e.preventDefault();
            var text = $(this).val();
            var id = $('#<?php echo $_SESSION['counter']; ?>biblAccessLevelId').val();
            var field = 'access_level_id';
            if(text.length != 0){
                if(id.length == 0){
                    saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_level;?>');
                    $('#<?php echo $_SESSION['counter']; ?>biblAccessLevelName').val('');
                    $('#<?php echo $_SESSION['counter']; ?>biblAccessLevelId').val('');
                }else{
                    saveBibl<?php echo $_SESSION['counter']; ?>(id,field);
                }
            }else{
                saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('.oneInputSave<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                saveBibl<?php echo $_SESSION['counter']; ?>(value,field);
            }else{
                saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>closeBibl').click(function(e){
            e.preventDefault();
            if(checkBibl){
                var confDel = confirm('<?php echo $Lang->enter_anything;?>\n <?php echo $Lang->delete_entry;?>');
                if(confDel){
                    $.ajax({
                        url: '<?php echo ROOT?>bibliography/delete/'+bId,
                        success: function(data){
                        },
                        faild: function(data){
                            alert('error ');
                        }
                    });
                }
            }
        });

        $('.oneInputSaveDate').focusout(function(e){
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
                        saveBibl<?php echo $_SESSION['counter']; ?>(val,field);
                    }else{
                        saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        saveBibl<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }else{
                        saveBibl<?php echo $_SESSION['counter']; ?>(val,field);
                    }
                }
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>video').live('click',function(e){
            var v = 0;
            if($(this).is(':checked')){
                v = 1;
            }
            saveBibl<?php echo $_SESSION['counter']; ?>(v,'video');
        });

        var uploader = new qq.FileUploader({
            element: document.getElementById('<?php echo $_SESSION["counter"]; ?>file-uploader-bible'),
            'action': '<?php echo ROOT; ?>bibliography/uploader/'+bId,
            'debug': false,
            multiple: false,
            //sizeLimit: 0, // max size
            // minSizeLimit: 0, // min size
            onSubmit: function(id, fileName){
                $('#preloader').show();
            },
            onProgress: function(id, fileName, loaded, total){
//                    alert(loaded+' OF '+total);
            },
            onComplete: function(id, fileName, responseJSON){
                $('#preloader').hide();
//                count = count + 1;
                if(responseJSON.responseHeader.status == 0){
                    $('#<?php echo $_SESSION['counter']; ?>uploadedFiles').append('<li><span class="downloadFile" data-id="'+responseJSON.file_id+'">Файл '+fileName+' добавлен</span> | <a class="deleteFile" data-id="'+responseJSON.file_id+'">X</a></li>');
                    $('.qq-upload-list li').remove();
                    if($('#<?php echo $_SESSION['counter']; ?>2').length !== 0 && $('#<?php echo $_SESSION['counter']; ?>3').length !== 0){
                        $('#<?php echo $_SESSION['counter']; ?>file-uploader3').removeClass('hid');
                    }
                }else{
                    alert('<?php echo $Lang->error;?>');
                    $('#<?php echo $_SESSION['counter']; ?>load').empty();
                }
            },
            onCancel: function(id, fileName){ $('.qq-upload-button').removeClass('.qq-upload-button-visited');$('#preloader').hide(); },
            messages: {
                // error messages, see qq.FileUploaderBasic for content

            },
            showMessage: function(message){ alert(message); $('#preloader').hide(); }
        });


        <?php if(isset($bibliography)) {
                if(!empty($bibliography['reg_date'])) { ?>
                    $('#<?php echo $_SESSION['counter']; ?>biblRegDate').val('<?php echo $bibliography['reg_date']; ?>');
        <?php } } ?>


        multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>biblCountry','bibliography_has_country','delete_bibliography_has_country',bId);

    });

    function bibliographyHasMan<?php echo $_SESSION["counter"]; ?>(man_id){
        $.ajax({
            url: '<?php echo ROOT?>add/man/'+bId+'/'+man_id,
            dataType: 'html',
            success: function(data){
                removeItem();
                addItem(data,'<?php echo $Lang->face; ?>');
            },
            faild: function(data){
                alert('error ');
            }
        });
    }

    function bibliographyHasOrganization<?php echo $_SESSION["counter"]; ?>(org_id){
        $.ajax({
            url: '<?php echo ROOT?>add/organization/'+bId+'/'+org_id,
            dataType: 'html',
            success: function(data){
                removeItem();
                addItem(data,'<?php echo $Lang->organization; ?>');
            },
            faild: function(data){
                alert('error ');
            }
        });
    }

    function saveBibl<?php echo $_SESSION['counter']; ?>(id,field){
        var data = { 'id':id, 'field':field };
        $.ajax({
            url: '<?php echo ROOT?>bibliography/save/'+bId,
            type: 'POST',
            data:data,
            success: function(data){
                checkBibl = false;
            },
            faild: function(data){
                alert('error ');
            }
        });
    }

    function closeFBibl<?php echo $_SESSION["counter"]; ?>(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameBibl).val(name);
        $('#'+currentInputIdBibl).val(id);
        var field = $('#'+currentInputIdBibl).attr('name');
        saveBibl<?php echo $_SESSION['counter']; ?>(id,field);
        $('#'+currentInputNameBibl).focus();
        $.fancybox.close();
    }

//    function closeWorker(name,id){
//        alert('name = '+name+' id = '+id);
//        $('#<?php echo $_SESSION['counter']; ?>'+currentInputNameBibl).val(name);
//        $('#<?php echo $_SESSION['counter']; ?>'+currentInputIdBibl).val(id);
//       var data = { 'id':id };
//        $.ajax({
//            url: '<?php echo ROOT?>bibliography/saveWorker/'+bId,
//            type: 'POST',
//            data:data,
//            success: function(data){
//                $('#<?php echo $_SESSION['counter']; ?>addedWorker').append('<div><span class="addedWorker">'+name+'</span><span dataBid="'+bId+'" dataWorkerId="'+id+'" class="deleteWorker deleteBibleWorker">X</span></div>');
//                checkBibl = false;
//            },
//            faild: function(data){
//                alert('error ');
//            }
//        });
//        $.fancybox.close();
//    }

</script>
