<a class="closeButton" id="<?php echo $_SESSION['counter']; ?>closeCriminalCase"></a>
<span class="idNumber"><?php if(isset($criminal_id)){ echo 'ID : '.$criminal_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>criminalCaseForm">

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalNumberCase">1) <?php echo $Lang->number_case;?></label>
            <input type="text" name="number" id="<?php echo $_SESSION['counter']; ?>criminalNumberCase" onkeydown="validateNumber(event ,'<?php echo $_SESSION['counter']; ?>criminalNumberCase',20)" class="oneInputSaveEnter oneInputSaveCriminalCase<?php echo $_SESSION['counter']; ?>" <?php if(isset($criminal_case)){ if(!empty($criminal_case['number'])){ echo "value='".$criminal_case['number']."'"; } }?> />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalCasePerson">2) <?php echo $Lang->case_person;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>criminalCasePersonFilter" style="border: none;" >
                <?php if(isset($criminal_case_has_man)) {
                        if(!empty($criminal_case_has_man)) {
                            foreach($criminal_case_has_man as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>criminalCaseHasManItem<?php echo $val['man_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['man_id']; ?>" data-tb="man" data-title="<?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?>"><?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeCriminalCaseHasMan<?php echo $_SESSION['counter']; ?>(<?php echo $val['man_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="mia_summary_man" id="<?php echo $_SESSION['counter']; ?>criminalCasePerson" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="case_person" id="<?php echo $_SESSION['counter']; ?>criminalCasePerson" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalCaseOrganization">3) <?php echo $Lang->case_organization;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>criminalCaseOrganizationFilter" style="border: none;" >
                <?php if(isset($criminal_case_has_organization)) {
                        if(!empty($criminal_case_has_organization)) {
                            foreach($criminal_case_has_organization as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>criminalCaseHasOrganization<?php echo $val['organization_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['organization_id']; ?>" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : <?php echo $val['organization_id']; ?>"><?php echo $Lang->short_organ; ?> : <?php echo $val['organization_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeCriminalCaseHasOrganization<?php echo $_SESSION['counter']; ?>(<?php echo $val['organization_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="mia_summary_man" id="<?php echo $_SESSION['counter']; ?>criminalCaseOrganization" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="case_person" id="<?php echo $_SESSION['counter']; ?>criminalCaseOrganization" class="oneInputSaveEnter"/-->
        </div>

        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalEssenceMaterial"><?php echo $Lang->essence_material;?></label>
            <input type="text" name="essence_material" id="<?php echo $_SESSION['counter']; ?>criminalEssenceMaterial" class="oneInputSaveEnter"/>
        </div-->

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalCriminalProceedingsDate">4) <?php echo $Lang->criminal_proceedings_date;?></label>
            <input type="text" name="opened_date" id="<?php echo $_SESSION['counter']; ?>criminalCriminalProceedingsDate" style="width: 505px;" onkeydown="validateNumber(event ,'<?php echo $_SESSION['counter']; ?>criminalCriminalProceedingsDate',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateCriminalCase<?php echo $_SESSION['counter']; ?>" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalCriminalCode">5) <?php echo $Lang->criminal_code;?></label>
            <input type="text" name="artical" id="<?php echo $_SESSION['counter']; ?>criminalCriminalCode" class="oneInputSaveEnter oneInputSaveCriminalCase<?php echo $_SESSION['counter']; ?>" <?php if(isset($criminal_case)){ if(!empty($criminal_case['artical'])){ echo "value='".$criminal_case['artical']."'"; } }?> />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalMaterialsManagement">6) <?php echo $Lang->head_department;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>criminalMaterialsManagement" dataId="<?php echo $_SESSION['counter']; ?>criminalMaterialsManagementId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?>  k-icon k-i-plus"   />
            <input type="text" name="opened_unit" id="<?php echo $_SESSION['counter']; ?>criminalMaterialsManagement" dataInputId="<?php echo $_SESSION['counter']; ?>criminalMaterialsManagementId" dataTableName="agency" class="oneInputSaveEnter" <?php if(isset($criminal_case)){ if(!empty($criminal_case['opened_unit'])){ echo "value='".$criminal_case['opened_unit']."'"; } }?>/>
            <input type="hidden" name="opened_unit_id" id="<?php echo $_SESSION['counter']; ?>criminalMaterialsManagementId" <?php if(isset($criminal_case)){ if(!empty($criminal_case['opened_unit_id'])){ echo "value='".$criminal_case['opened_unit_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalHeadDepartment">7) <?php echo $Lang->materials_management;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>criminalHeadDepartment" dataId="<?php echo $_SESSION['counter']; ?>criminalHeadDepartmentId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?>  k-icon k-i-plus"   />
            <input type="text" name="opened_agency" id="<?php echo $_SESSION['counter']; ?>criminalHeadDepartment" dataInputId="<?php echo $_SESSION['counter']; ?>criminalHeadDepartmentId" dataTableName="agency" class="oneInputSaveEnter" <?php if(isset($criminal_case)){ if(!empty($criminal_case['opened_agency'])){ echo "value='".$criminal_case['opened_agency']."'"; } }?>/>
            <input type="hidden" name="opened_agency_id" id="<?php echo $_SESSION['counter']; ?>criminalHeadDepartmentId" <?php if(isset($criminal_case)){ if(!empty($criminal_case['opened_agency_id'])){ echo "value='".$criminal_case['opened_agency_id']."'"; } }?> />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalInstitutedUnits">8) <?php echo $Lang->instituted_units;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>criminalInstitutedUnits" dataId="<?php echo $_SESSION['counter']; ?>criminalInstitutedUnitsId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?>  k-icon k-i-plus"   />
            <input type="text" name="subunit" id="<?php echo $_SESSION['counter']; ?>criminalInstitutedUnits" dataInputId="<?php echo $_SESSION['counter']; ?>criminalInstitutedUnitsId" dataTableName="agency" class="oneInputSaveEnter" <?php if(isset($criminal_case)){ if(!empty($criminal_case['subunit'])){ echo "value='".$criminal_case['subunit']."'"; } }?> />
            <input type="hidden" name="subunit_id" id="<?php echo $_SESSION['counter']; ?>criminalInstitutedUnitsId" <?php if(isset($criminal_case)){ if(!empty($criminal_case['subunit_id'])){ echo "value='".$criminal_case['subunit_id']."'"; } }?> />
        </div>

        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalWorker"><?php echo $Lang->name_operatives;?></label>
            <input type="button" id="<?php echo $_SESSION['counter']; ?>criminalCaseWorker" dataName="<?php echo $_SESSION['counter']; ?>criminalWorker" dataId="<?php echo $_SESSION['counter']; ?>criminalWorkerId"  class="addMore addMore<?php echo $_SESSION['counter']; ?> Custom k-icon k-i-plus"   />
            <input type="text" readonly="readonly" name="name_operatives" id="<?php echo $_SESSION['counter']; ?>criminalWorker" <?php if(isset($criminal_case)){ if(!empty($criminal_case['worker'])){ echo "value='".$criminal_case['worker']."'"; } }?> class="oneInputSaveEnter"/>
            <input type="hidden" name="worker_id" id="<?php echo $_SESSION['counter']; ?>criminalWorkerId" <?php if(isset($criminal_case)){ if(!empty($criminal_case['worker_id'])){ echo "value='".$criminal_case['worker_id']."'"; } }?> />
        </div-->

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalWorker">9) <?php echo $Lang->name_operatives;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>criminalWorkerFilter">
                <?php if(isset($criminal_case_worker)) {
                        if(!empty($criminal_case_worker)) {
                            foreach($criminal_case_worker as $val ) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>criminalWorker<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['worker']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']?>' , '<?php echo $_SESSION['counter']; ?>criminalWorker' , 'criminal_case_worker_delete', '<?php echo $criminal_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                <input type="text" name="criminal_worker" id="<?php echo $_SESSION['counter']; ?>criminalWorker" class="getName oneInputSaveEnter"/>
            </ul>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>criminalWorkerPostFilter" style="border: none;" >
                <?php if(isset($criminal_case_worker_post)) {
                        if(!empty($criminal_case_worker_post)) {
                            foreach($criminal_case_worker_post as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>criminalWorkerPost<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>criminalWorkerPost' , 'delete_criminal_worker_post', '<?php echo $criminal_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                       } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalWorkerPost">10) <?php echo $Lang->worker_post;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>criminalWorkerPost" dataId="<?php echo $_SESSION['counter']; ?>criminalWorkerPostId" dataTableName="fancy/worker_post" class="addMore addMore<?php echo $_SESSION['counter']; ?>  k-icon k-i-plus"   />
            <input type="text" name="worker_post" id="<?php echo $_SESSION['counter']; ?>criminalWorkerPost" dataInputId="<?php echo $_SESSION['counter']; ?>criminalWorkerPostId" dataTableName="worker_post" class="oneInputSaveEnter"/>
            <input type="hidden" name="worker_id" id="<?php echo $_SESSION['counter']; ?>criminalWorkerPostId" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalNatureMaterialsPaint">11) <?php echo $Lang->nature_materials_paint;?></label>
            <input type="text" name="character" id="<?php echo $_SESSION['counter']; ?>criminalNatureMaterialsPaint" class="oneInputSaveEnter oneInputSaveCriminalCase<?php echo $_SESSION['counter']; ?>" <?php if(isset($criminal_case)){ if(!empty($criminal_case['character'])){ echo "value='".$criminal_case['character']."'"; } }?> />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalInstitutedFactAction">12) <?php echo $Lang->instituted_fact_action;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>criminalInstitutedFactActionFilter" style="border: none;" >
                <?php if(isset($criminal_case_has_action)) {
                        if(!empty($criminal_case_has_action)) {
                            foreach($criminal_case_has_action as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>criminalCaseActionItem<?php echo $val['action_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['action_id']; ?>" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?>"><?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeCriminalCaseAction<?php echo $_SESSION['counter']; ?>(<?php echo $val['action_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="mia_summary_man" id="<?php echo $_SESSION['counter']; ?>criminalInstitutedFactAction" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="instituted_fact" id="<?php echo $_SESSION['counter']; ?>criminalInstitutedFactAction" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalInstitutedFactEvent">13) <?php echo $Lang->instituted_fact_event;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>criminalInstitutedFactEventFilter" style="border: none;" >
                <?php if(isset($criminal_case_has_event)) {
                        if(!empty($criminal_case_has_event)) {
                            foreach($criminal_case_has_event as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>criminalCaseEventItem<?php echo $val['event_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['event_id']; ?>" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : <?php echo $val['event_id']; ?>"><?php echo $Lang->short_event; ?> : <?php echo $val['event_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeCriminalCaseEvent<?php echo $_SESSION['counter']; ?>(<?php echo $val['event_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="mia_summary_man" id="<?php echo $_SESSION['counter']; ?>criminalInstitutedFactEvent" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="instituted_fact" id="<?php echo $_SESSION['counter']; ?>criminalInstitutedFactEvent" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalResultsInspectionSignal">14) <?php echo $Lang->results_inspection_signal;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>criminalResultsInspectionSignalFilter" style="border: none;" >
                <?php if(isset($criminal_case_has_signal)) {
                        if(!empty($criminal_case_has_signal)) {
                            foreach($criminal_case_has_signal as $val) { ?>
                            <li id="<?php echo $_SESSION['counter']; ?>criminalCaseHasSignalItem<?php echo $val['signal_id']; ?>">
                                <div class="item">
                                    <span class="openData" data-id="<?php echo $val['signal_id']; ?>" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?>"><?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?></span>
                                    <span class="editAll"></span>
                                    <a href="javascript:removeCriminalCaseHAsSignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['signal_id']; ?>);">x</a>
                                </div>
                            </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="mia_summary_man" id="<?php echo $_SESSION['counter']; ?>criminalResultsInspectionSignal" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="results_inspection_signal" id="<?php echo $_SESSION['counter']; ?>criminalResultsInspectionSignal" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalInitiatedDow">15) <?php echo $Lang->initiated_dow;?></label>
            <input type="text" name="opened_dou" id="<?php echo $_SESSION['counter']; ?>criminalInitiatedDow" class="oneInputSaveEnter oneInputSaveCriminalCase<?php echo $_SESSION['counter']; ?>" <?php if(isset($criminal_case)){ if(!empty($criminal_case['opened_dou'])){ echo "value='".$criminal_case['opened_dou']."'"; } }?> />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalConnectedCriminalCases">16) <?php echo $Lang->connected_criminal_cases;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>criminalConnectedCriminalCasesFilter" style="border: none;" >
                <?php if(isset($splited_criminal_case)) {
                        if(!empty($splited_criminal_case)) {
                            foreach($splited_criminal_case as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>criminalCaseSplitedCriminalCaseItem<?php echo $val['criminal_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['criminal_id']; ?>" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_id']; ?>"><?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeCriminalCaseSplitedCriminalCase<?php echo $_SESSION['counter']; ?>(<?php echo $val['criminal_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="mia_summary_man" id="<?php echo $_SESSION['counter']; ?>criminalConnectedCriminalCases" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="connected_criminal_cases" id="<?php echo $_SESSION['counter']; ?>criminalConnectedCriminalCases" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>criminalSeparatedCriminalCases">17) <?php echo $Lang->separated_criminal_cases;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>criminalSeparatedCriminalCasesFilter" style="border: none;" >
                <?php if(isset($extracted_criminal_case)) {
                        if(!empty($extracted_criminal_case)) {
                            foreach($extracted_criminal_case as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>criminalCaseExtractedCriminalCaseItem<?php echo $val['criminal_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['criminal_id']; ?>" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_id']; ?>"><?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeCriminalCaseExtractedCriminalCase<?php echo $_SESSION['counter']; ?>(<?php echo $val['criminal_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="mia_summary_man" id="<?php echo $_SESSION['counter']; ?>criminalSeparatedCriminalCases" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="separated_criminal_cases" id="<?php echo $_SESSION['counter']; ?>criminalSeparatedCriminalCases" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label>18) <?php echo $Lang->contents_document;?></label>
            <ul class="uploader">
                <?php if(isset($criminal_case_has_file)) {
                        if(!empty($criminal_case_has_file)) {
                            foreach($criminal_case_has_file as $val) { ?>
                <li class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> </li>
                <?php       }
                        }
                      } ?>
            </ul>
        </div>

        <div class="forForm">
            <label>19) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($criminal_case)) {
                        if(!empty($criminal_case['bibliography_id'])) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $criminal_case['bibliography_id']; ?>" data-tb="bibliography" ><?php echo $Lang->short_bibl; ?> : <?php echo $criminal_case['bibliography_id']; ?></span>
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
    var currentInputNameCriminal<?php echo $_SESSION['counter']; ?>;
    var currentInputIdCriminal<?php echo $_SESSION['counter']; ?>;
    var criminal_id<?php echo $_SESSION['counter']; ?> = '<?php echo $criminal_id; ?>';
    <?php if(isset($criminal_case)) { ?>
        var checkCriminal<?php echo $_SESSION['counter']; ?> = false;
    <?php }else{ ?>
        var checkCriminal<?php echo $_SESSION['counter']; ?> = true;
    <?php } ?>
    $(document).ready(function(){

        $('#<?php echo $_SESSION['counter']; ?>criminalSeparatedCriminalCases').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/criminal_case/criminal_case_extracted/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->criminal_case;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>criminalConnectedCriminalCases').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/criminal_case/criminal_case_splited/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->criminal_case;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>criminalResultsInspectionSignal').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/signal/criminal_case/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->signal;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedFactEvent').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/event/criminal_case/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->event;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedFactAction').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/action/criminal_case/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->action;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>criminalCaseOrganization').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/organization/criminal_case/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->organization;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>criminalCasePerson').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/man/criminal_case/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->face;?>');
                }
            });
        });

        $('.oneInputSaveDateCriminalCase<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        <?php if(isset($criminal_case)){ if(!empty($criminal_case['opened_date'])) { ?>
            $('#<?php echo $_SESSION['counter']; ?>criminalCriminalProceedingsDate').val('<?php echo $criminal_case["opened_date"]; ?>');
        <?php }
        }?>


        $('.oneInputSaveDateCriminalCase<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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
                        saveCriminalCase<?php echo $_SESSION['counter']; ?>(val,field);
                    }else{
                        saveCriminalCase<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        saveCriminalCase<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }else{
                        saveCriminalCase<?php echo $_SESSION['counter']; ?>(val,field);
                    }
                }
            }else{
                if( (typeof $(this).attr('type') != 'undefined')&&(val.length == 0) ){
                    saveCriminalCase<?php echo $_SESSION['counter']; ?>('null',field);
                }
            }
        });

        $('.oneInputSaveCriminalCase<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                saveCriminalCase<?php echo $_SESSION['counter']; ?>(value,field);
            }else{
                saveCriminalCase<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>criminalMaterialsManagement').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>criminalMaterialsManagementId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>criminalMaterialsManagement').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>criminalMaterialsManagement').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>criminalMaterialsManagementId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>criminalMaterialsManagementId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveCriminalCase<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_agency;?>');
                    $('#<?php echo $_SESSION['counter']; ?>criminalMaterialsManagement').val('');
                    $('#<?php echo $_SESSION['counter']; ?>criminalMaterialsManagementId').val('');
                }else{
                    saveCriminalCase<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveCriminalCase<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>criminalHeadDepartment').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>criminalHeadDepartmentId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>criminalHeadDepartment').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>criminalHeadDepartment').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>criminalHeadDepartmentId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>criminalHeadDepartmentId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveCriminalCase<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_agency;?>');
                    $('#<?php echo $_SESSION['counter']; ?>criminalHeadDepartment').val('');
                    $('#<?php echo $_SESSION['counter']; ?>criminalHeadDepartmentId').val('');
                }else{
                    saveCriminalCase<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveCriminalCase<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedUnits').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedUnitsId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedUnits').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedUnits').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedUnitsId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedUnitsId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveCriminalCase<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_agency;?>');
                    $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedUnits').val('');
                    $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedUnitsId').val('');
                }else{
                    saveCriminalCase<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveCriminalCase<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>criminalWorkerPost').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/worker_post/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>criminalWorkerPostId').val(dataItem.id);
            }
        });

        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameCriminal<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdCriminal<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=criminal&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>closeCriminalCase').click(function(e){
            e.preventDefault();
            var dataId = $('.activeTable:last').attr('dataId');
            if(checkCriminal<?php echo $_SESSION['counter']; ?>){
                var confirmcheckCriminal<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->enter_anything;?>\n <?php echo $Lang->delete_entry;?>');
                if(confirmcheckCriminal<?php echo $_SESSION['counter']; ?>){
                    $.ajax({
                        url: '<?php echo ROOT?>add/delete_criminal_case/'+criminal_id<?php echo $_SESSION['counter']; ?>,
                        success: function(data){
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    $('.activeTable').addClass('storedItem');
                    if(typeof  dataId == 'undefined'){
                        $('.activeTable').append(' : id = '+criminal_id<?php echo $_SESSION['counter']; ?>);
                        $('.activeTable').attr('dataId',criminal_id<?php echo $_SESSION['counter']; ?>);
                    }
                    $('.activeTable').removeClass('activeTable');
                }
            }else{
                $('.activeTable').addClass('storedItem');
                if(typeof  dataId == 'undefined'){
                    $('.activeTable').append(' : id = '+criminal_id<?php echo $_SESSION['counter']; ?>);
                    $('.activeTable').attr('dataId',criminal_id<?php echo $_SESSION['counter']; ?>);
                }
                $('.activeTable').removeClass('activeTable');
            }
        });

    multiSelectMaker('<?php echo $_SESSION['counter']; ?>criminalWorker','criminal_case_worker','criminal_case_worker_delete',criminal_id<?php echo $_SESSION['counter']; ?>);
    multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>criminalWorkerPost','criminal_worker_post','delete_criminal_worker_post',criminal_id<?php echo $_SESSION['counter']; ?>);

    });

    function saveCriminalCase<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value,'field':field };
        $.ajax({
            url: '<?php echo ROOT?>add/criminal_case_save/'+criminal_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            success: function(data){
                checkCriminal<?php echo $_SESSION['counter']; ?> = false;
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function closeCriminalCase<?php echo $_SESSION['counter']; ?>(name,id){
        $('#'+currentInputNameCriminal<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdCriminal<?php echo $_SESSION['counter']; ?>).val(id);
        var field = $('#'+currentInputIdCriminal<?php echo $_SESSION['counter']; ?>).attr('name');
        saveCriminalCase<?php echo $_SESSION['counter']; ?>(id,field);
        $.fancybox.close();
    }

    function criminal_case_extracted_criminal_case<?php echo $_SESSION['counter']; ?>(criminal_case_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/criminal_case_extracted_criminal_case/'+criminal_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>criminalSeparatedCriminalCasesFilter').append('<li id="<?php echo $_SESSION['counter']; ?>criminalCaseExtractedCriminalCaseItem'+criminal_case_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+criminal_case_id+'" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'" ><?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeCriminalCaseExtractedCriminalCase<?php echo $_SESSION['counter']; ?>('+criminal_case_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>criminalSeparatedCriminalCases').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeCriminalCaseExtractedCriminalCase<?php echo $_SESSION['counter']; ?>(criminal_case_id){
        var removeManHasCar = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasCar){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_criminal_case_extracted_criminal_case/'+criminal_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>criminalCaseExtractedCriminalCaseItem'+criminal_case_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>criminalSeparatedCriminalCases').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function criminal_case_splited_criminal_case<?php echo $_SESSION['counter']; ?>(criminal_case_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/criminal_case_splited_criminal_case/'+criminal_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>criminalConnectedCriminalCasesFilter').append('<li id="<?php echo $_SESSION['counter']; ?>criminalCaseSplitedCriminalCaseItem'+criminal_case_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+criminal_case_id+'" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'"><?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeCriminalCaseSplitedCriminalCase<?php echo $_SESSION['counter']; ?>('+criminal_case_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>criminalConnectedCriminalCases').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeCriminalCaseSplitedCriminalCase<?php echo $_SESSION['counter']; ?>(criminal_case_id){
        var removeManHasCar = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasCar){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_criminal_case_splited_criminal_case/'+criminal_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>criminalCaseSplitedCriminalCaseItem'+criminal_case_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>criminalConnectedCriminalCases').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function criminal_case_signal<?php echo $_SESSION['counter']; ?>(signal_id , check  , data  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/criminal_case_has_signal/'+criminal_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>criminalResultsInspectionSignalFilter').append('<li id="<?php echo $_SESSION['counter']; ?>criminalCaseHasSignalItem'+signal_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+signal_id+'" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : '+signal_id+'"><?php echo $Lang->short_signal; ?> : '+signal_id+'</span>'
                    +'<span class="editAll"></span><a href="javascript:removeCriminalCaseHAsSignal<?php echo $_SESSION['counter']; ?>('+signal_id+');">x</a>'
                            +'</div>'
                    +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>criminalResultsInspectionSignal').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeCriminalCaseHAsSignal<?php echo $_SESSION['counter']; ?>(signal_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_criminal_case_has_signal/'+criminal_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>criminalCaseHasSignalItem'+signal_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>criminalResultsInspectionSignal').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function criminal_case_event<?php echo $_SESSION['counter']; ?>(event_id , check  ){
        $.ajax({
            url: '<?php echo ROOT; ?>add/event_has_criminal_case/'+event_id+'/'+criminal_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            dataType : 'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedFactEventFilter').append('<li id="<?php echo $_SESSION['counter']; ?>criminalCaseEventItem'+event_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+event_id+'" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : '+event_id+'"><?php echo $Lang->short_event; ?> : '+event_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeCriminalCaseEvent<?php echo $_SESSION['counter']; ?>('+event_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedFactEvent').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });

    }
    function removeCriminalCaseEvent<?php echo $_SESSION['counter']; ?>(event_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_event_has_criminal_case/'+event_id+'/'+criminal_id<?php echo $_SESSION['counter']; ?>,
                type:'POST',
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>criminalCaseEventItem'+event_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedFactEvent').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function criminal_case_action<?php echo $_SESSION['counter']; ?>(action_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_has_criminal_case/'+action_id+'/'+criminal_id<?php echo $_SESSION['counter']; ?>,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedFactActionFilter').append('<li id="<?php echo $_SESSION['counter']; ?>criminalCaseActionItem'+action_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+action_id+'" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : '+action_id+'"><?php echo $Lang->short_action; ?> : '+action_id+'</span>'
                    +'<span class="editAll"></span><a href="javascript:removeCriminalCaseAction<?php echo $_SESSION['counter']; ?>('+action_id+');">x</a>'
                            +'</div>'
                    +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedFactAction').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeCriminalCaseAction<?php echo $_SESSION['counter']; ?>(action_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_has_criminal_case/'+action_id+'/'+criminal_id<?php echo $_SESSION['counter']; ?>,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>criminalCaseActionItem'+action_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>criminalInstitutedFactAction').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function criminal_case_has_organization<?php echo $_SESSION['counter']; ?>(organization_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/criminal_case_has_organization/'+criminal_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>criminalCaseOrganizationFilter').append('<li id="<?php echo $_SESSION['counter']; ?>criminalCaseHasOrganization'+organization_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+organization_id+'" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : '+organization_id+'"><?php echo $Lang->short_organ; ?> : '+organization_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeCriminalCaseHasOrganization<?php echo $_SESSION['counter']; ?>('+organization_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>criminalCaseOrganization').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeCriminalCaseHasOrganization<?php echo $_SESSION['counter']; ?>(organization_id){
        var removeManHasCar = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasCar){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_criminal_case_has_organization/'+criminal_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>criminalCaseHasOrganization'+organization_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>criminalCaseOrganization').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function criminal_case_has_man<?php echo $_SESSION['counter']; ?>(man_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/criminal_case_has_man/'+criminal_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>criminalCasePersonFilter').append('<li id="<?php echo $_SESSION['counter']; ?>criminalCaseHasManItem'+man_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+man_id+'" data-tb="man" data-title="<?php echo $Lang->short_man; ?> : '+man_id+'"><?php echo $Lang->short_man; ?> : '+man_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeCriminalCaseHasMan<?php echo $_SESSION['counter']; ?>('+man_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>criminalCasePerson').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeCriminalCaseHasMan<?php echo $_SESSION['counter']; ?>(man_id){
        var removeManHasCar = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasCar){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_criminal_case_has_man/'+criminal_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>criminalCaseHasManItem'+man_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>criminalCasePerson').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }


</script>

