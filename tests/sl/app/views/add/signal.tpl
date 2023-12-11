<a id="<?php echo $_SESSION['counter']; ?>closeSignal" class="customClose"></a>
<span class="idNumber"><?php if(isset($signal_id)){ echo 'ID : '.$signal_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>signalForm">


        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalRegNumberSignal">1) <?php echo $Lang->reg_number_signal;?></label>
            <input type="text" name="reg_num" id="<?php echo $_SESSION['counter']; ?>signalRegNumberSignal" class="oneInputSaveEnter oneInputSaveSignal<?php echo $_SESSION['counter']; ?>" <?php if(isset($signal)){ if(!empty($signal['reg_num'])){ echo "value='".$signal['reg_num']."'"; } }?>/>
        </div>

        <!--        <div class="forForm">-->
        <!--            <label for="<?php echo $_SESSION['counter']; ?>signalContentsInformationSignal">--><?php //echo $Lang->contents_information_signal;?><!--</label>-->
        <!--            <input type="text" name="content" id="<?php echo $_SESSION['counter']; ?>signalContentsInformationSignal" class="oneInputSaveEnter oneInputSaveSignal<?php echo $_SESSION['counter']; ?>" --><?php //if(isset($signal)){ if(!empty($signal['content'])){ echo "value='".$signal['content']."'"; } }?><!--/>-->
        <!--        </div>-->


        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalContent">2) <?php echo $Lang->contents_information_signal;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalContentFilter" style="border: none;" >
                <?php if(isset($signal)) {
                    if(!empty($signal['content'])) { ?>
                <li id="<?php echo $_SESSION['counter']; ?>signalContentItemContent">
                    <div class="item signalContent">
                        <span signal_id="<?php echo $signal_id; ?>" session_counter="<?php echo $_SESSION['counter']; ?>"><?php echo $signal['content']; ?>...</span>
                        <a href="javascript:removeSignalContent(<?php echo $signal['id']; ?>);">x</a>
                    </div>
                </li>
                <?php
                    }
                } ?>
                &nbsp
            </ul>
            <input type="button" name="content" id="<?php echo $_SESSION['counter']; ?>signalContent" value="Добавить" class="oneInputSaveEnter"/>
        </div>


        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalLineWhichVerified">3) <?php echo $Lang->line_which_verified;?></label>
            <input type="text" name="check_line" id="<?php echo $_SESSION['counter']; ?>signalLineWhichVerified" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>signalLineWhichVerified',30)" class="oneInputSaveEnter dotsToDash oneInputSaveSignal<?php echo $_SESSION['counter']; ?>" <?php if(isset($signal)){ if(!empty($signal['check_line'])){ echo "value='".$signal['check_line']."'"; } }?>/>
        </div>

        <!--        <div class="forForm">-->
        <!--            <label for="<?php echo $_SESSION['counter']; ?>signalCheckStatusCharter">--><?php //echo $Lang->check_status_charter;?><!--</label>-->
        <!--            <input type="text" name="check_status" id="<?php echo $_SESSION['counter']; ?>signalCheckStatusCharter" class="oneInputSaveEnter oneInputSaveSignal<?php echo $_SESSION['counter']; ?>" --><?php //if(isset($signal)){ if(!empty($signal['check_status'])){ echo "value='".$signal['check_status']."'"; } }?><!--/>-->
        <!--        </div>-->


        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalStatus">4) <?php echo $Lang->check_status_charter;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalStatusFilter" style="border: none;" >
                <?php if(isset($signal)) {
                    if(!empty($signal['check_status'])) { ?>
                <li id="<?php echo $_SESSION['counter']; ?>signalStatusItemStatus">
                    <div class="item signalStatus">
                        <span signal_id="<?php echo $signal_id; ?>" session_counter="<?php echo $_SESSION['counter']; ?>"><?php echo $signal['check_status']; ?>...</span>
                        <a href="javascript:removeSignalStatus(<?php echo $signal['id']; ?>);">x</a>
                    </div>
                </li>
                <?php
                    }
                } ?>
                &nbsp
            </ul>
            <input type="button" name="content" id="<?php echo $_SESSION['counter']; ?>signalStatus" value="Добавить" class="oneInputSaveEnter"/>
        </div>



        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalQualificationsSignaling">5) <?php echo $Lang->qualifications_signaling;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalQualificationsSignaling" dataId="<?php echo $_SESSION['counter']; ?>signalQualificationsSignalingId" dataTableName="fancy/signal_qualification" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="signal_qualification" id="<?php echo $_SESSION['counter']; ?>signalQualificationsSignaling" dataTableName="signal_qualification" dataInputId="<?php echo $_SESSION['counter']; ?>signalQualificationsSignalingId" class="oneInputSaveEnter" <?php if(isset($signal)){ if(!empty($signal['signal_qualification'])){ echo "value='".$signal['signal_qualification']."'"; } }?>/>
            <input type="hidden" name="signal_qualification_id" id="<?php echo $_SESSION['counter']; ?>signalQualificationsSignalingId" <?php if(isset($signal)){ if(!empty($signal['signal_qualification_id'])){ echo "value='".$signal['signal_qualification_id']."'"; } }?>/>
        </div>

        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalSourceCategory">6) <?php echo $Lang->source_category;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalSourceCategory" dataId="<?php echo $_SESSION['counter']; ?>signalSourceCategoryId" dataTableName="fancy/resource" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="source_resource" id="<?php echo $_SESSION['counter']; ?>signalSourceCategory" dataTableName="resource" dataInputId="<?php echo $_SESSION['counter']; ?>signalSourceCategoryId" class="oneInputSaveEnter" <?php if(isset($signal)){ if(!empty($signal['resource'])){ echo "value='".$signal['resource']."'"; } }?>/>
            <input type="hidden" name="source_resource_id" id="<?php echo $_SESSION['counter']; ?>signalSourceCategoryId" <?php if(isset($signal)){ if(!empty($signal['source_resource_id'])){ echo "value='".$signal['source_resource_id']."'"; } }?>/>
        </div>

        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalChecksSignal">7) <?php echo $Lang->checks_signal;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalChecksSignal" dataId="<?php echo $_SESSION['counter']; ?>signalChecksSignalId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="check_unit" id="<?php echo $_SESSION['counter']; ?>signalChecksSignal" dataTableName="agency" dataInputId="<?php echo $_SESSION['counter']; ?>signalChecksSignalId" class="oneInputSaveEnter" <?php if(isset($signal)){ if(!empty($signal['check_unit'])){ echo "value='".$signal['check_unit']."'"; } }?>/>
            <input type="hidden" name="check_unit_id" id="<?php echo $_SESSION['counter']; ?>signalChecksSignalId" <?php if(isset($signal)){ if(!empty($signal['check_unit_id'])){ echo "value='".$signal['check_unit_id']."'"; } }?>/>
        </div>

        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalDepartmentChecking">8) <?php echo $Lang->department_checking;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalDepartmentChecking" dataId="<?php echo $_SESSION['counter']; ?>signalDepartmentCheckingId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="check_agency" id="<?php echo $_SESSION['counter']; ?>signalDepartmentChecking" dataTableName="agency" dataInputId="<?php echo $_SESSION['counter']; ?>signalDepartmentCheckingId" class="oneInputSaveEnter" <?php if(isset($signal)){ if(!empty($signal['check_agency'])){ echo "value='".$signal['check_agency']."'"; } }?>/>
            <input type="hidden" name="check_agency_id" id="<?php echo $_SESSION['counter']; ?>signalDepartmentCheckingId" <?php if(isset($signal)){ if(!empty($signal['check_agency_id'])){ echo "value='".$signal['check_agency_id']."'"; } }?>/>
        </div>

        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalUnitTesting">9) <?php echo $Lang->unit_testing;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalUnitTesting" dataId="<?php echo $_SESSION['counter']; ?>signalUnitTestingId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="check_subunit" id="<?php echo $_SESSION['counter']; ?>signalUnitTesting" dataTableName="agency" dataInputId="<?php echo $_SESSION['counter']; ?>signalUnitTestingId" class="oneInputSaveEnter" <?php if(isset($signal)){ if(!empty($signal['check_subunit'])){ echo "value='".$signal['check_subunit']."'"; } }?>/>
            <input type="hidden" name="check_subunit_id" id="<?php echo $_SESSION['counter']; ?>signalUnitTestingId" <?php if(isset($signal)){ if(!empty($signal['check_subunit_id'])){ echo "value='".$signal['check_subunit_id']."'"; } }?>/>
        </div>

        <!--div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalNameCheckingSignalFilter" style="border: none;" >
                <?php if(isset($signal_check_worker)) {
                        if(!empty($signal_check_worker)) {
                            foreach($signal_check_worker as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>signalNameCheckingSignal<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['worker']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>signalNameCheckingSignal' , 'delete_signal_check_worker', '<?php echo $signal_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                    } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div-->
        <div class="forForm" >
            <label for="<?php echo $_SESSION['counter']; ?>signalNameCheckingSignal">10) <?php echo $Lang->name_checking_signal;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalNameCheckingSignalFilter">
                <?php if(isset($signal_checking_worker)) {
                        if(!empty($signal_checking_worker)) {
                            foreach($signal_checking_worker as $val) { ?>
                <li id="listItem<?php echo $_SESSION['counter']; ?>signalNameCheckingSignal<?php echo $val['id']; ?>">
                    <div class="item">
                        <span><?php echo $val['worker']; ?></span>
                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>signalNameCheckingSignal' , 'signal_checking_worker_delete', '<?php echo $signal_id; ?>');">x</a>
                    </div>
                </li>
                <?php       }
                        }
                       } ?>
                <input type="text" name="worker_id" id="<?php echo $_SESSION['counter']; ?>signalNameCheckingSignal" class="oneInputSaveEnter" />
            </ul>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalWorkerPostFilter" style="border: none;" >
                <?php if(isset($signal_checking_worker_post)) {
                        if(!empty($signal_checking_worker_post)) {
                            foreach($signal_checking_worker_post as $val) { ?>
                <li id="listItem<?php echo $_SESSION['counter']; ?>signalWorkerPost<?php echo $val['id']; ?>">
                    <div class="item">
                        <span><?php echo $val['name']; ?></span>
                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>signalWorkerPost' , 'delete_signal_checking_worker_post', '<?php echo $signal_id; ?>');">x</a>
                    </div>
                </li>
                <?php       }
                        }
                       }?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalWorkerPost">11) <?php echo $Lang->worker_post;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalWorkerPost" dataId="<?php echo $_SESSION['counter']; ?>signalWorkerPostId" dataTableName="fancy/worker_post" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="worker_post" id="<?php echo $_SESSION['counter']; ?>signalWorkerPost" dataTableName="worker_post" dataInputId="<?php echo $_SESSION['counter']; ?>signalWorkerPostId" class="oneInputSaveEnter"/>
            <input type="hidden" name="worker_id" id="<?php echo $_SESSION['counter']; ?>signalWorkerPostId" />
        </div>

        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalDateRegistrationDivision">12) <?php echo $Lang->date_registration_division;?></label>
            <input type="text" name="subunit_date" id="<?php echo $_SESSION['counter']; ?>signalDateRegistrationDivision" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>signalDateRegistrationDivision',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateSignal<?php echo $_SESSION['counter']; ?>"/>
        </div>

        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalCheckDate">13) <?php echo $Lang->check_date;?></label>
            <input type="text" name="check_date" id="<?php echo $_SESSION['counter']; ?>signalCheckDate" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>signalCheckDate',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateSignal<?php echo $_SESSION['counter']; ?>"/>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalCheckPreviouslyFilter" style="border: none;" >
                <?php if(isset($signal_has_check_date)) {
                        if(!empty($signal_has_check_date)) {
                            foreach($signal_has_check_date as $val) { ?>
                <li id="listItem<?php echo $_SESSION['counter']; ?>signalCheckPreviously<?php echo $val['id']; ?>">
                    <div class="item">
                        <span><?php echo $val['date']; ?></span>
                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>signalCheckPreviously' , 'delete_signal_has_check_date', '<?php echo $signal_id; ?>');">x</a>
                    </div>
                </li>
                <?php       }
                        }
                    } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalCheckPreviously">14) <?php echo $Lang->check_previously;?></label>
            <input type="text" name="check_previously" id="<?php echo $_SESSION['counter']; ?>signalCheckPreviously" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>signalCheckPreviously',12)"  class="oneInputSaveEnter dotsToDash"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalDateActual">15) <?php echo $Lang->date_actual;?></label>
            <input type="text" name="end_date" id="<?php echo $_SESSION['counter']; ?>signalDateActual" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>signalDateActual',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateSignal<?php echo $_SESSION['counter']; ?>"/>
        </div>

        <div class="forForm">
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalAmountOverdue">16) <?php echo $Lang->amount_overdue;?></label>
            <input type="text" name="asd" readonly="readonly" id="<?php echo $_SESSION['counter']; ?>signalAmountOverdue" class="oneInputSaveEnter" <?php if(isset($late_days)){ echo "value='".$late_days."'"; }?>/>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalUsefulCapabilitiesFilter" style="border: none;" >
                <?php if(isset($signal_used_resource)) {
                        if(!empty($signal_used_resource)) {
                            foreach($signal_used_resource as $val) { ?>
                <li id="listItem<?php echo $_SESSION['counter']; ?>signalUsefulCapabilities<?php echo $val['id']; ?>">
                    <div class="item">
                        <span><?php echo $val['name']; ?></span>
                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>signalUsefulCapabilities' , 'delete_signal_has_resource', '<?php echo $signal_id; ?>');">x</a>
                    </div>
                </li>
                <?php       }
                        }
                    } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalUsefulCapabilities">17) <?php echo $Lang->useful_capabilities;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalUsefulCapabilities" dataId="<?php echo $_SESSION['counter']; ?>signalUsefulCapabilitiesId" dataTableName="fancy/resource" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="resource" id="<?php echo $_SESSION['counter']; ?>signalUsefulCapabilities" dataTableName="resource" dataInputId="<?php echo $_SESSION['counter']; ?>signalUsefulCapabilitiesId" class="oneInputSaveEnter"/>
            <input type="hidden" name="resource_id" id="<?php echo $_SESSION['counter']; ?>signalUsefulCapabilitiesId" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalSignalResults">18) <?php echo $Lang->signal_results;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalSignalResults" dataId="<?php echo $_SESSION['counter']; ?>signalSignalResultsId" dataTableName="fancy/signal_result" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="signal_result" id="<?php echo $_SESSION['counter']; ?>signalSignalResults" dataTableName="signal_result" dataInputId="<?php echo $_SESSION['counter']; ?>signalSignalResultsId" class="oneInputSaveEnter" <?php if(isset($signal)){ if(!empty($signal['signal_result'])){ echo "value='".$signal['signal_result']."'"; } }?>/>
            <input type="hidden" name="signal_result_id" id="<?php echo $_SESSION['counter']; ?>signalSignalResultsId" <?php if(isset($signal)){ if(!empty($signal['signal_result_id'])){ echo "value='".$signal['signal_result_id']."'"; } }?>/>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalMeasuresTakenFilter" style="border: none;" >
                <?php if(isset($signal_has_taken_measure)) {
                        if(!empty($signal_has_taken_measure)) {
                            foreach($signal_has_taken_measure as $val) { ?>
                <li id="listItem<?php echo $_SESSION['counter']; ?>signalMeasuresTaken<?php echo $val['id']; ?>">
                    <div class="item">
                        <span><?php echo $val['name']; ?></span>
                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>signalMeasuresTaken' , 'delete_signal_has_taken_measure', '<?php echo $signal_id;?>');">x</a>
                    </div>
                </li>
                <?php       }
                        }
                     } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalMeasuresTaken">19) <?php echo $Lang->measures_taken;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalMeasuresTaken" dataId="<?php echo $_SESSION['counter']; ?>signalMeasuresTakenId" dataTableName="fancy/taken_measure" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="taken_measures" id="<?php echo $_SESSION['counter']; ?>signalMeasuresTaken" dataTableName="taken_measure" dataInputId="<?php echo $_SESSION['counter']; ?>signalMeasuresTakenId" class="oneInputSaveEnter"/>
            <input type="hidden" name="taken_measures_id" id="<?php echo $_SESSION['counter']; ?>signalMeasuresTakenId" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalAccordingResultDow">20) <?php echo $Lang->according_result_dow;?></label>
            <input type="text" name="opened_dou" id="<?php echo $_SESSION['counter']; ?>signalAccordingResultDow" class="oneInputSaveEnter oneInputSaveSignal<?php echo $_SESSION['counter']; ?>" <?php if(isset($signal)){ if(!empty($signal['opened_dou'])){ echo "value='".$signal['opened_dou']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalAccordingTestResult">21) <?php echo $Lang->according_test_result;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalAccordingTestResultFilter" style="border: none;" >
                <?php if(isset($signal_has_criminal_case)) {
                        if(!empty($signal_has_criminal_case)) {
                            foreach($signal_has_criminal_case as $val) { ?>
                <li id="<?php echo $_SESSION['counter']; ?>signalCriminalCaseItem<?php echo $val['criminal_case_id']; ?>">
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['criminal_case_id']; ?>" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_case_id']; ?>"><?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_case_id']; ?></span>
                        <span class="editAll"></span><a href="javascript:removeSignalCriminalCase<?php echo $_SESSION['counter']; ?>(<?php echo $val['criminal_case_id']; ?>);">x</a>
                    </div>
                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>signalAccordingTestResult" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="according_test_result" id="<?php echo $_SESSION['counter']; ?>signalAccordingTestResult" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Man">22) <?php echo $Lang->objects_check_signal_man;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>ManFilter" style="border: none;" >
                <?php if(isset($signal_check_man)) {
                        if(!empty($signal_check_man)) {
                            foreach($signal_check_man as $val) { ?>
                <li id="<?php echo $_SESSION['counter']; ?>signalSignalHasMan<?php echo $val['man_id']; ?>">
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['man_id']; ?>" data-tb="man" ><?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?></span>
                        <span class="editAll"></span><a href="javascript:removeSignalHasMan<?php echo $_SESSION['counter']; ?>(<?php echo $val['man_id']; ?>);">x</a>
                    </div>
                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Man" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="objects_check_signal" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Man" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Organization">23) <?php echo $Lang->objects_check_signal_organization;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>OrganizationFilter" style="border: none;" >
                <?php if(isset($signal_check_organization)) {
                        if(!empty($signal_check_organization)) {
                            foreach($signal_check_organization as $val) { ?>
                <li id="<?php echo $_SESSION['counter']; ?>signalOrganizationCheckedBySignalItem<?php echo $val['organization_id']; ?>">
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['organization_id']; ?>" data-tb="organization"><?php echo $Lang->short_organ; ?> : <?php echo $val['organization_id']; ?></span>
                        <span class="editAll"></span><a href="javascript:removeSignalOrganizationCheckedBySignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['organization_id']; ?>);">x</a>
                    </div>
                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Organization" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="objects_check_signal" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Organization" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Action">24) <?php echo $Lang->objects_check_signal_action;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>ActionFilter" style="border: none;" >
                <?php if(isset($signal_has_action)) {
                        if(!empty($signal_has_action)) {
                            foreach($signal_has_action as $val) { ?>
                <li id="<?php echo $_SESSION['counter']; ?>signalActionPassedBySignalItem<?php echo $val['action_id']; ?>">
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['action_id']; ?>" data-tb="action"><?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?></span>
                        <span class="editAll"></span><a href="javascript:removeSignalActionPassedBySignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['action_id']; ?>);">x</a>
                    </div>
                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Action" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="objects_check_signal" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Action" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Event">25) <?php echo $Lang->objects_check_signal_event;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>EventFilter" style="border: none;" >
                <?php if(isset($signal_has_event)) {
                        if(!empty($signal_has_event)) {
                            foreach($signal_has_event as $val) { ?>
                <li id="<?php echo $_SESSION['counter']; ?>signalEventPassedBySignalItem<?php echo $val['event_id']; ?>">
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['event_id']; ?>" data-tb="event"><?php echo $Lang->short_event; ?> : <?php echo $val['event_id']; ?></span>
                        <span class="editAll"></span><a href="javascript:removeSignalEventPassedBySignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['event_id']; ?>);">x</a>
                    </div>
                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Event" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="objects_check_signal" id="<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Event" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalPassesSignalMan">26) <?php echo $Lang->passes_signal_man;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalPassesSignalManFilter" style="border: none;" >
                <?php if(isset($signal_passed_man)) {
                        if(!empty($signal_passed_man)) {
                            foreach($signal_passed_man as $val) { ?>
                <li id="<?php echo $_SESSION['counter']; ?>signalManPassedBySignalItem<?php echo $val['man_id']; ?>">
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['man_id']; ?>" data-tb="man"><?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?></span>
                        <span class="editAll"></span><a href="javascript:removeSignalManPassedBySignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['man_id']; ?>);">x</a>
                    </div>
                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>signalPassesSignalMan" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="passes_signal" id="<?php echo $_SESSION['counter']; ?>signalPassesSignalMan" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalPassesSignalOrganization">27) <?php echo $Lang->passes_signal_organization;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalPassesSignalOrganizationFilter" style="border: none;" >
                <?php if(isset($signal_passed_organization)) {
                        if(!empty($signal_passed_organization)) {
                            foreach($signal_passed_organization as $val) { ?>
                <li id="<?php echo $_SESSION['counter']; ?>signalOrganizationPassesBySignalItem<?php echo $val['organization_id']; ?>">
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['organization_id']; ?>" data-tb="organization" ><?php echo $Lang->short_organ; ?> : <?php echo $val['organization_id']; ?></span>
                        <span class="editAll"></span><a href="javascript:removeSignalOrganizationPassesBySignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['organization_id']; ?>);">x</a>
                    </div>
                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>signalPassesSignalOrganization" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="passes_signal" id="<?php echo $_SESSION['counter']; ?>signalPassesSignalOrganization" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalBroughtSignal">28) <?php echo $Lang->brought_signal;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalBroughtSignal" dataId="<?php echo $_SESSION['counter']; ?>signalBroughtSignalId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="check_unit" id="<?php echo $_SESSION['counter']; ?>signalBroughtSignal" dataTableName="agency" dataInputId="<?php echo $_SESSION['counter']; ?>signalBroughtSignalId" class="oneInputSaveEnter" <?php if(isset($signal)){ if(!empty($signal['opened_agency'])){ echo "value='".$signal['opened_agency']."'"; } }?>/>
            <input type="hidden" name="opened_agency_id" id="<?php echo $_SESSION['counter']; ?>signalBroughtSignalId" <?php if(isset($signal)){ if(!empty($signal['opened_agency_id'])){ echo "value='".$signal['opened_agency_id']."'"; } }?>/>
        </div>

        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalDepartmentBrought">29) <?php echo $Lang->department_brought;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalDepartmentBrought" dataId="<?php echo $_SESSION['counter']; ?>signalDepartmentBroughtId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="check_agency" id="<?php echo $_SESSION['counter']; ?>signalDepartmentBrought" dataTableName="agency" dataInputId="<?php echo $_SESSION['counter']; ?>signalDepartmentBroughtId"  class="oneInputSaveEnter" <?php if(isset($signal)){ if(!empty($signal['opened_unit'])){ echo "value='".$signal['opened_unit']."'"; } }?>/>
            <input type="hidden" name="opened_unit_id" id="<?php echo $_SESSION['counter']; ?>signalDepartmentBroughtId" <?php if(isset($signal)){ if(!empty($signal['opened_unit_id'])){ echo "value='".$signal['opened_unit_id']."'"; } }?>/>
        </div>

        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>signalUnitBrought">30) <?php echo $Lang->unit_brought;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalUnitBrought" dataId="<?php echo $_SESSION['counter']; ?>signalUnitBroughtId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="check_subunit" id="<?php echo $_SESSION['counter']; ?>signalUnitBrought" dataTableName="agency" dataInputId="<?php echo $_SESSION['counter']; ?>signalUnitBroughtId" class="oneInputSaveEnter" <?php if(isset($signal)){ if(!empty($signal['opened_subunit'])){ echo "value='".$signal['opened_subunit']."'"; } }?>/>
            <input type="hidden" name="opened_subunit_id" id="<?php echo $_SESSION['counter']; ?>signalUnitBroughtId" <?php if(isset($signal)){ if(!empty($signal['opened_subunit_id'])){ echo "value='".$signal['opened_subunit_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalNameOperatives">31) <?php echo $Lang->name_operatives;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalNameOperativesFilter">
                <?php if(isset($signal_worker)) {
                        if(!empty($signal_worker)) {
                            foreach($signal_worker as $val) { ?>
                <li id="listItem<?php echo $_SESSION['counter']; ?>signalNameOperatives<?php echo $val['id']; ?>">
                    <div class="item">
                        <span><?php echo $val['worker']; ?></span>
                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>signalNameOperatives' , 'signal_worker_delete', '<?php echo $signal_id; ?>');">x</a>
                    </div>
                </li>
                <?php       }
                        }
                       } ?>
                <input type="text" name="name_operatives" id="<?php echo $_SESSION['counter']; ?>signalNameOperatives" class="oneInputSaveEnter" />
            </ul>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalPostFilter" style="border: none;" >
                <?php if(isset($signal_worker_post)) {
                        if(!empty($signal_worker_post)) {
                            foreach($signal_worker_post as $val) { ?>
                <li id="listItem<?php echo $_SESSION['counter']; ?>signalPost<?php echo $val['id']; ?>">
                    <div class="item">
                        <span><?php echo $val['name']; ?></span>
                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>signalPost' , 'delete_signal_worker_post', '<?php echo $signal_id; ?>');">x</a>
                    </div>
                </li>
                <?php       }
                        }
                       } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalPost">32) <?php echo $Lang->worker_post;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>signalPost" dataId="<?php echo $_SESSION['counter']; ?>signalPostId" dataTableName="fancy/worker_post" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="worker_post" id="<?php echo $_SESSION['counter']; ?>signalPost" dataTableName="worker_post" dataInputId="<?php echo $_SESSION['counter']; ?>signalPostId" class="oneInputSaveEnter"/>
            <input type="hidden" name="worker_id" id="<?php echo $_SESSION['counter']; ?>signalPostId" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>signalKeepSignal">33) <?php echo $Lang->keep_signal;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>signalKeepSignalFilter" style="border: none;" >
                <?php if(isset($signal_has_keep_signal)) {
                        if(!empty($signal_has_keep_signal)) {
                            foreach($signal_has_keep_signal as $val) { ?>
                <li id="<?php echo $_SESSION['counter']; ?>signalKeepSignalItem<?php echo $val['keep_signal_id']; ?>">
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['keep_signal_id']; ?>" data-tb="keep_signal"><?php echo $Lang->short_keep_signal; ?> : <?php echo $val['keep_signal_id']; ?></span>
                        <span class="kedit" data-id="<?php echo $val['keep_signal_id']; ?>" ></span>
                        <a href="javascript:removeSignalKeepSignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['keep_signal_id']; ?>);">x</a>
                    </div>
                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>signalKeepSignal" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="involved_events" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsOrganization" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label>34) <?php echo $Lang->contents_document;?></label>
            <ul class="uploader">
                <?php if(isset($signal_has_file)) {
                        if(!empty($signal_has_file)) {
                            foreach($signal_has_file as $val) { ?>
                <li class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> </li>
                <?php       }
                        }
                      } ?>
            </ul>
        </div>

        <div class="forForm">
            <label>35) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($signal)) {
                        if(!empty($signal['bibliography_id'])) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $signal['bibliography_id']; ?>" data-tb="bibliography" ><?php echo $Lang->short_bibl; ?> : <?php echo $signal['bibliography_id']; ?></span>
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
    var currentInputNameSignal<?php echo $_SESSION['counter']; ?>;
    var currentInputIdSignal<?php echo $_SESSION['counter']; ?>;
    var signal_id<?php echo $_SESSION['counter']; ?> = '<?php echo $signal_id?>';
    <?php if(isset($signal)) { ?>
        var checkSignal<?php echo $_SESSION['counter']; ?> = false;
    <?php }else{ ?>
        var checkSignal<?php echo $_SESSION['counter']; ?> = true;
    <?php } ?>

    $(document).ready(function(){

        $('#<?php echo $_SESSION['counter']; ?>signalKeepSignal').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/keep_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                    dataType:'html',
                    success:function(data){
                addItem(data,'<?php echo $Lang->keep_signal;?>');
            }
        });
    });

    $('#<?php echo $_SESSION['counter']; ?>signalPassesSignalOrganization').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo ROOT; ?>open/organization/signal_passes/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
            dataType:'html',
            success:function(data){
                addItem(data,'<?php echo $Lang->organization;?>');
            }
        });
    });

    $('#<?php echo $_SESSION['counter']; ?>signalPassesSignalMan').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo ROOT; ?>open/man/signal_passes/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
            dataType:'html',
            success:function(data){
                addItem(data,'<?php echo $Lang->face;?>');
            }
        });
    });

    $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Event').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo ROOT; ?>open/event/signal_check/<?php echo $_SESSION['counter']; ?>',
            dataType:'html',
            success:function(data){
                addItem(data,'<?php echo $Lang->event;?>');
            }
        });
    });

    $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Action').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo ROOT; ?>open/action/signal_check/<?php echo $_SESSION['counter']; ?>',
            dataType:'html',
            success:function(data){
                addItem(data,'<?php echo $Lang->action;?>');
            }
        });
    });

    $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Organization').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo ROOT; ?>open/organization/signal_check/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
            dataType:'html',
            success:function(data){
                addItem(data,'<?php echo $Lang->organization;?>');
            }
        });
    });

    $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Man').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo ROOT; ?>open/man/signal_check/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
            dataType:'html',
            success:function(data){
                addItem(data,'<?php echo $Lang->face;?>');
            }
        });
    });

    $('#<?php echo $_SESSION['counter']; ?>signalAccordingTestResult').click(function(e){
        e.preventDefault();
        $.ajax({
            url: '<?php echo ROOT; ?>open/criminal_case/signal/<?php echo $_SESSION['counter']; ?>',
            dataType:'html',
            success:function(data){
                addItem(data,'<?php echo $Lang->face;?>');
            }
        });
    });

    $('.oneInputSaveDateSignal<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
        format: "dd-MM-yyyy",
        change:function(e){
            $('.selectedDiv').removeClass('selectedDiv');
        }
    });

    $('#<?php echo $_SESSION['counter']; ?>signalCheckPreviously').kendoDatePicker({
        format: "dd-MM-yyyy",
        change:function(e){
            $('.selectedDiv').removeClass('selectedDiv');
        }
    });
    multiSelectMakerDate('<?php echo $_SESSION['counter']; ?>signalCheckPreviously','signal_has_check_date','delete_signal_has_check_date',signal_id<?php echo $_SESSION['counter']; ?>);

    $('.oneInputSaveDateSignal<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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
                    saveSignal<?php echo $_SESSION['counter']; ?>(val,field);
                }else{
                    saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                    $(this).val('');
                    alert('<?php echo $Lang->enter_number;?>');
                }
            }else{
                if(val.length != 10){
                    saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                    $(this).val('');
                    alert('<?php echo $Lang->enter_number;?>');
                }else{
                    saveSignal<?php echo $_SESSION['counter']; ?>(val,field);
                }
            }
        }else{
            if( typeof $(this).attr('type') != 'undefined' && val.length == 0){
                saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
            }
        }
    });

    <?php if(isset($signal)) { ?>
    <?php if(!empty($signal['subunit_date'])) { ?>
            $('#<?php echo $_SESSION['counter']; ?>signalDateRegistrationDivision').val('<?php echo $signal['subunit_date']?>');
        <?php } ?>
    <?php if(!empty($signal['check_date'])) { ?>
            $('#<?php echo $_SESSION['counter']; ?>signalCheckDate').val('<?php echo $signal['check_date']?>');
        <?php } ?>
    <?php if(!empty($signal['end_date'])) { ?>
            $('#<?php echo $_SESSION['counter']; ?>signalDateActual').val('<?php echo $signal['end_date']?>');
        <?php } ?>
    <?php } ?>

    $('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignaling').kendoAutoComplete({
        dataTextField: "name",
        dataSource: {
            transport: {
                read:{
                    dataType: "json",
                    url: "<?php echo ROOT;?>dictionary/signal_qualification/read"
                }
            }
        },

        select:function(e){
            var dataItem = this.dataItem(e.item.index());
            $('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignalingId').val(dataItem.id);
        }
    });
    $('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignaling').focusout(function(e){
        e.preventDefault();
        var text = $('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignaling').val();
        var value = $('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignalingId').val();
        var field = $('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignalingId').attr('name');
        if(text.length != 0){
            if((text.length != 0)&&(value.length == 0)){
                saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                alert('<?php echo $Lang->enter_qualification;?>');
                $('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignaling').val('');
                $('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignalingId').val('');
            }else{
                saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
            }
        }else{
            saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
        }
    });

    $('#<?php echo $_SESSION['counter']; ?>signalSourceCategory').kendoAutoComplete({
        dataTextField: "name",
        dataSource: {
            transport: {
                read:{
                    dataType: "json",
                    url: "<?php echo ROOT;?>dictionary/resource/read"
                }
            }
        },

        select:function(e){
            var dataItem = this.dataItem(e.item.index());
            $('#<?php echo $_SESSION['counter']; ?>signalSourceCategoryId').val(dataItem.id);
        }
    });
    $('#<?php echo $_SESSION['counter']; ?>signalSourceCategory').focusout(function(e){
        e.preventDefault();
        var text = $('#<?php echo $_SESSION['counter']; ?>signalSourceCategory').val();
        var value = $('#<?php echo $_SESSION['counter']; ?>signalSourceCategoryId').val();
        var field = $('#<?php echo $_SESSION['counter']; ?>signalSourceCategoryId').attr('name');
        if(text.length != 0){
            if((text.length != 0)&&(value.length == 0)){
                saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                alert('<?php echo $Lang->enter_category;?>');
                $('#<?php echo $_SESSION['counter']; ?>signalSourceCategory').val('');
                $('#<?php echo $_SESSION['counter']; ?>signalSourceCategoryId').val('');
            }else{
                saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
            }
        }else{
            saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
        }
    });

    $('#<?php echo $_SESSION['counter']; ?>signalChecksSignal').kendoAutoComplete({
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
            $('#<?php echo $_SESSION['counter']; ?>signalChecksSignalId').val(dataItem.id);
        }
    });
    $('#<?php echo $_SESSION['counter']; ?>signalChecksSignal').focusout(function(e){
        e.preventDefault();
        var text = $('#<?php echo $_SESSION['counter']; ?>signalChecksSignal').val();
        var value = $('#<?php echo $_SESSION['counter']; ?>signalChecksSignalId').val();
        var field = $('#<?php echo $_SESSION['counter']; ?>signalChecksSignalId').attr('name');
        if(text.length != 0){
            if((text.length != 0)&&(value.length == 0)){
                saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                alert('<?php echo $Lang->enter_agency;?>');
                $('#<?php echo $_SESSION['counter']; ?>signalChecksSignal').val('');
                $('#<?php echo $_SESSION['counter']; ?>signalChecksSignalId').val('');
            }else{
                saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
            }
        }else{
            saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
        }
    });

    $('#<?php echo $_SESSION['counter']; ?>signalDepartmentChecking').kendoAutoComplete({
        dataTextField: "name",
        minLength: 3,
        filter: "contains",
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
            $('#<?php echo $_SESSION['counter']; ?>signalDepartmentCheckingId').val(dataItem.id);
        }
    });
    $('#<?php echo $_SESSION['counter']; ?>signalDepartmentChecking').focusout(function(e){
        e.preventDefault();
        var text = $('#<?php echo $_SESSION['counter']; ?>signalDepartmentChecking').val();
        var value = $('#<?php echo $_SESSION['counter']; ?>signalDepartmentCheckingId').val();
        var field = $('#<?php echo $_SESSION['counter']; ?>signalDepartmentCheckingId').attr('name');
        if(text.length != 0){
            if((text.length != 0)&&(value.length == 0)){
                saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                alert('<?php echo $Lang->enter_agency;?>');
                $('#<?php echo $_SESSION['counter']; ?>signalDepartmentChecking').val('');
                $('#<?php echo $_SESSION['counter']; ?>signalDepartmentCheckingId').val('');
            }else{
                saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
            }
        }else{
            saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
        }
    });

    $('#<?php echo $_SESSION['counter']; ?>signalUnitTesting').kendoAutoComplete({
        dataTextField: "name",
        minLength: 3,
        filter: "contains",
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
            $('#<?php echo $_SESSION['counter']; ?>signalUnitTestingId').val(dataItem.id);
        }
    });
    $('#<?php echo $_SESSION['counter']; ?>signalUnitTesting').focusout(function(e){
        e.preventDefault();
        var text = $('#<?php echo $_SESSION['counter']; ?>signalUnitTesting').val();
        var value = $('#<?php echo $_SESSION['counter']; ?>signalUnitTestingId').val();
        var field = $('#<?php echo $_SESSION['counter']; ?>signalUnitTestingId').attr('name');
        if(text.length != 0){
            if((text.length != 0)&&(value.length == 0)){
                saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                alert('<?php echo $Lang->enter_agency;?>');
                $('#<?php echo $_SESSION['counter']; ?>signalUnitTesting').val('');
                $('#<?php echo $_SESSION['counter']; ?>signalUnitTestingId').val('');
            }else{
                saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
            }
        }else{
            saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
        }
    });

    $('#<?php echo $_SESSION['counter']; ?>signalWorkerPost').kendoAutoComplete({
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
            $('#<?php echo $_SESSION['counter']; ?>signalWorkerPostId').val(dataItem.id);
        }
    });

    $('#<?php echo $_SESSION['counter']; ?>signalPost').kendoAutoComplete({
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
            $('#<?php echo $_SESSION['counter']; ?>signalPostId').val(dataItem.id);
        }
    });

    $('#<?php echo $_SESSION['counter']; ?>signalUsefulCapabilities').kendoAutoComplete({
        dataTextField: "name",
        dataSource: {
            transport: {
                read:{
                    dataType: "json",
                    url: "<?php echo ROOT;?>dictionary/resource/read"
                }
            }
        },

        select:function(e){
            var dataItem = this.dataItem(e.item.index());
            $('#<?php echo $_SESSION['counter']; ?>signalUsefulCapabilitiesId').val(dataItem.id);
        }
    });
    //        $('#<?php echo $_SESSION['counter']; ?>signalUsefulCapabilities').focusout(function(e){
    //            e.preventDefault();
    //            var text = $('#<?php echo $_SESSION['counter']; ?>signalUsefulCapabilities').val();
    //            var value = $('#<?php echo $_SESSION['counter']; ?>signalUsefulCapabilitiesId').val();
    //            var field = $('#<?php echo $_SESSION['counter']; ?>signalUsefulCapabilitiesId').attr('name');
    //            if(text.length != 0){
    //                if((text.length != 0)&&(value.length == 0)){
    //                    alert('Введите правильный ресурс');
    //                }else{
    //                    saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
    //                }
    //            }
    //        });

    multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>signalUsefulCapabilities','signal_has_resource','delete_signal_has_resource',signal_id<?php echo $_SESSION['counter']; ?>);

    $('#<?php echo $_SESSION['counter']; ?>signalSignalResults').kendoAutoComplete({
        dataTextField: "name",
        dataSource: {
            transport: {
                read:{
                    dataType: "json",
                    url: "<?php echo ROOT;?>dictionary/signal_result/read"
                }
            }
        },

        select:function(e){
            var dataItem = this.dataItem(e.item.index());
            $('#<?php echo $_SESSION['counter']; ?>signalSignalResultsId').val(dataItem.id);
        }
    });
    $('#<?php echo $_SESSION['counter']; ?>signalSignalResults').focusout(function(e){
        e.preventDefault();
        var text = $('#<?php echo $_SESSION['counter']; ?>signalSignalResults').val();
        var value = $('#<?php echo $_SESSION['counter']; ?>signalSignalResultsId').val();
        var field = $('#<?php echo $_SESSION['counter']; ?>signalSignalResultsId').attr('name');
        if(text.length != 0){
            if((text.length != 0)&&(value.length == 0)){
                saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                alert('<?php echo $Lang->enter_result;?>');
                $('#<?php echo $_SESSION['counter']; ?>signalSignalResults').val('');
                $('#<?php echo $_SESSION['counter']; ?>signalSignalResultsId').val('');
            }else{
                saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
            }
        }else{
            saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
        }
    });

    $('#<?php echo $_SESSION['counter']; ?>signalMeasuresTaken').kendoAutoComplete({
        dataTextField: "name",
        dataSource: {
            transport: {
                read:{
                    dataType: "json",
                    url: "<?php echo ROOT;?>dictionary/taken_measure/read"
                }
            }
        },

        select:function(e){
            var dataItem = this.dataItem(e.item.index());
            $('#<?php echo $_SESSION['counter']; ?>signalMeasuresTakenId').val(dataItem.id);
        }
    });
    //        $('#<?php echo $_SESSION['counter']; ?>signalMeasuresTaken').focusout(function(e){
    //            e.preventDefault();
    //            var text = $('#<?php echo $_SESSION['counter']; ?>signalMeasuresTaken').val();
    //            var value = $('#<?php echo $_SESSION['counter']; ?>signalMeasuresTakenId').val();
    //            var field = $('#<?php echo $_SESSION['counter']; ?>signalMeasuresTakenId').attr('name');
    //            if(text.length != 0){
    //                if((text.length != 0)&&(value.length == 0)){
    //                    alert('Введите правильное последствие');
    //                }else{
    //                    saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
    //                }
    //            }
    //        });signalNameCheckingSignal signalNameOperatives

    multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>signalMeasuresTaken','signal_has_taken_measure','delete_signal_has_taken_measure',signal_id<?php echo $_SESSION['counter']; ?>);

    //        $('#<?php echo $_SESSION['counter']; ?>signalNameCheckingSignal').kendoAutoComplete({
    //            dataTextField: "name",
    //            filter: "contains",
    //            dataSource: {
    //                transport: {
    //                    read:{
    //                        dataType: "json",
    //                        url: "<?php echo ROOT;?>autocomplete/worker"
    //                    }
    //                }
    //            },
    //            dataBound : function(e){
    //                $('#<?php echo $_SESSION['counter']; ?>signalNameCheckingSignalId').val('');
    //            },
    //            select:function(e){
    //                var dataItem = this.dataItem(e.item.index());
    //                $('#<?php echo $_SESSION['counter']; ?>signalNameCheckingSignalId').val(dataItem.id);
    //            }
    //        });
    //
    //        multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>signalNameCheckingSignal','signal_check_worker','delete_signal_check_worker',signal_id<?php echo $_SESSION['counter']; ?>);


    $('#<?php echo $_SESSION['counter']; ?>signalBroughtSignal').kendoAutoComplete({
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
            $('#<?php echo $_SESSION['counter']; ?>signalBroughtSignalId').val(dataItem.id);
        }
    });
    $('#<?php echo $_SESSION['counter']; ?>signalBroughtSignal').focusout(function(e){
        e.preventDefault();
        var text = $('#<?php echo $_SESSION['counter']; ?>signalBroughtSignal').val();
        var value = $('#<?php echo $_SESSION['counter']; ?>signalBroughtSignalId').val();
        var field = $('#<?php echo $_SESSION['counter']; ?>signalBroughtSignalId').attr('name');
        if(text.length != 0){
            if((text.length != 0)&&(value.length == 0)){
                saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                alert('<?php echo $Lang->enter_agency;?>');
                $('#<?php echo $_SESSION['counter']; ?>signalBroughtSignal').val('');
                $('#<?php echo $_SESSION['counter']; ?>signalBroughtSignalId').val('');
            }else{
                saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
            }
        }else{
            saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
        }
    });


    $('#<?php echo $_SESSION['counter']; ?>signalDepartmentBrought').kendoAutoComplete({
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
            $('#<?php echo $_SESSION['counter']; ?>signalDepartmentBroughtId').val(dataItem.id);
        }
    });
    $('#<?php echo $_SESSION['counter']; ?>signalDepartmentBrought').focusout(function(e){
        e.preventDefault();
        var text = $('#<?php echo $_SESSION['counter']; ?>signalDepartmentBrought').val();
        var value = $('#<?php echo $_SESSION['counter']; ?>signalDepartmentBroughtId').val();
        var field = $('#<?php echo $_SESSION['counter']; ?>signalDepartmentBroughtId').attr('name');
        if(text.length != 0){
            if((text.length != 0)&&(value.length == 0)){
                saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                alert('<?php echo $Lang->enter_agency;?>');
                $('#<?php echo $_SESSION['counter']; ?>signalDepartmentBrought').val('');
                $('#<?php echo $_SESSION['counter']; ?>signalDepartmentBroughtId').val('');
            }else{
                saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
            }
        }else{
            saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
        }
    });


    $('#<?php echo $_SESSION['counter']; ?>signalUnitBrought').kendoAutoComplete({
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
            $('#<?php echo $_SESSION['counter']; ?>signalUnitBroughtId').val(dataItem.id);
        }
    });
    $('#<?php echo $_SESSION['counter']; ?>signalUnitBrought').focusout(function(e){
        e.preventDefault();
        var text = $('#<?php echo $_SESSION['counter']; ?>signalUnitBrought').val();
        var value = $('#<?php echo $_SESSION['counter']; ?>signalUnitBroughtId').val();
        var field = $('#<?php echo $_SESSION['counter']; ?>signalUnitBroughtId').attr('name');
        if(text.length != 0){
            if((text.length != 0)&&(value.length == 0)){
                saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
                alert('<?php echo $Lang->enter_agency;?>');
                $('#<?php echo $_SESSION['counter']; ?>signalUnitBrought').val('');
                $('#<?php echo $_SESSION['counter']; ?>signalUnitBroughtId').val('');
            }else{
                saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
            }
        }else{
            saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
        }
    });



    $('.oneInputSaveSignal<?php echo $_SESSION['counter']; ?>').focusout(function(e){
        e.preventDefault();
        var value = $(this).val();
        var field = $(this).attr('name');
        if(value.length != 0){
            saveSignal<?php echo $_SESSION['counter']; ?>(value,field);
        }else{
            saveSignal<?php echo $_SESSION['counter']; ?>('null',field);
        }
    });

    $('#<?php echo $_SESSION['counter']; ?>closeSignal').click(function(e){
        e.preventDefault();
        var dataId = $('.activeTable:last').attr('dataId');
        if(checkSignal<?php echo $_SESSION['counter']; ?>){
            var confSignal = confirm('<?php echo $Lang->enter_anything;?>\n <?php echo $Lang->delete_entry;?>');
            if(confSignal){
                $.ajax({
                    url: '<?php echo ROOT?>add/signal_delete/'+signal_id<?php echo $_SESSION['counter']; ?>,
                success: function(data){
                    removeItem();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }else{
            var required = true;

            if($.trim($('#<?php echo $_SESSION['counter']; ?>signalRegNumberSignal').val()).length == 0){
                required = false;
            }

            if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignalingId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignaling').val()).length == 0) ){
                required = false;
            }

            if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalSourceCategoryId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalSourceCategory').val()).length == 0) ){
                required = false;
            }

            if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalChecksSignal').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalChecksSignalId').val()).length == 0) ){
                required = false;
            }

            if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalDepartmentCheckingId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalDepartmentChecking').val()).length == 0) ){
                required = false;
            }

            if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalUnitTestingId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalUnitTesting').val()).length == 0) ){
                required = false;
            }

            if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalBroughtSignalId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalBroughtSignal').val()).length == 0) ){
                required = false;
            }

            if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalDepartmentBroughtId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalDepartmentBrought').val()).length == 0) ){
                required = false;
            }

            if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalUnitBroughtId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalUnitBrought').val()).length == 0) ){
                required = false;
            }

            if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalDateRegistrationDivision').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalDateRegistrationDivision').val()).length == 0) ){
                required = false;
            }

            if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalCheckDate').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalCheckDate').val()).length == 0) ){
                required = false;
            }

            if(required){
                $('.activeTable').addClass('storedItem');
                if(typeof  dataId == 'undefined'){
                    $('.activeTable').append(' : id = '+signal_id<?php echo $_SESSION['counter']; ?>);
                    $('.activeTable').attr('dataId',signal_id<?php echo $_SESSION['counter']; ?>);
                }
                $('.activeTable').removeClass('activeTable');
                removeItem();
            }else{
                alert('<?php echo $Lang->enter_field;?>');
            }
        }
    }else{
        var required = true;

        if($.trim($('#<?php echo $_SESSION['counter']; ?>signalRegNumberSignal').val()).length == 0){
            required = false;
        }

        if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignalingId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalQualificationsSignaling').val()).length == 0) ){
            required = false;
        }

        if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalSourceCategoryId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalSourceCategory').val()).length == 0) ){
            required = false;
        }

        if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalChecksSignal').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalChecksSignalId').val()).length == 0) ){
            required = false;
        }

        if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalDepartmentCheckingId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalDepartmentChecking').val()).length == 0) ){
            required = false;
        }

        if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalUnitTestingId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalUnitTesting').val()).length == 0) ){
            required = false;
        }

        if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalBroughtSignalId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalBroughtSignal').val()).length == 0) ){
            required = false;
        }

        if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalDepartmentBroughtId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalDepartmentBrought').val()).length == 0) ){
            required = false;
        }

        if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalUnitBroughtId').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalUnitBrought').val()).length == 0) ){
            required = false;
        }

        if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalDateRegistrationDivision').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalDateRegistrationDivision').val()).length == 0) ){
            required = false;
        }

        if( ($.trim($('#<?php echo $_SESSION['counter']; ?>signalCheckDate').val()).length == 0)||($.trim($('#<?php echo $_SESSION['counter']; ?>signalCheckDate').val()).length == 0) ){
            required = false;
        }

        if(required){
            $('.activeTable').addClass('storedItem');
            if(typeof  dataId == 'undefined'){
                $('.activeTable').append(' : id = '+signal_id<?php echo $_SESSION['counter']; ?>);
                $('.activeTable').attr('dataId',signal_id<?php echo $_SESSION['counter']; ?>);
            }
            $('.activeTable').removeClass('activeTable');
            removeItem();
        }else{
            alert('<?php echo $Lang->enter_field;?>');
        }
    }
    });

    $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
        e.preventDefault();
        var url = $(this).attr('dataTableName');
        currentInputNameSignal<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
        currentInputIdSignal<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
        $.fancybox({
            'type'  : 'iframe',
            'autoSize': false,
            'width'             : 800,
            'height'            : 600,
            'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=signal&old_counter=<?php echo $_SESSION['counter']; ?>"
        });
    });

    $('.signalAddWorker').click(function(e){
        e.preventDefault();
        currentInputNameSignal<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
        currentInputIdSignal<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
        $.fancybox({
            'type'  : 'iframe',
            'autoSize': false,
            'width'             : 800,
            'height'            : 600,
            'href'              : "<?php echo ROOT;?>autocomplete/fancyWorker/signal&old_counter=<?php echo $_SESSION['counter']; ?>"
        });
    });

    $('#<?php echo $_SESSION['counter']; ?>signalContent').click(function(e){
        e.preventDefault();
        $.fancybox({
            'type'  : 'iframe',
            'autoSize': false,
            'width'             : 800,
            'height'            : 600,
            'href'              : "<?php echo ROOT;?>autocomplete/text/signalContent&old_counter=<?php echo $_SESSION['counter']; ?>",
            beforeClose: function () {
                var textVal = $('iframe');
                var iframe_id = textVal.attr('name');
                var iframe = document.getElementById(iframe_id);
                var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                var test = innerDoc.getElementById('text');
                var val = test.value;
                var confirmF = confirm('<?php echo $Lang->save;?> ?');
                if(confirmF){
                    closeFancySignalContent<?php echo $_SESSION['counter']; ?>(val);
                }
            }
        });
    });

    $('#<?php echo $_SESSION['counter']; ?>signalStatus').click(function(e){
        e.preventDefault();
        $.fancybox({
            'type'  : 'iframe',
            'autoSize': false,
            'width'             : 800,
            'height'            : 600,
            'href'              : "<?php echo ROOT;?>autocomplete/text/signalStatus&old_counter=<?php echo $_SESSION['counter']; ?>",
            beforeClose: function () {
                var textVal = $('iframe');
                var iframe_id = textVal.attr('name');
                var iframe = document.getElementById(iframe_id);
                var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                var test = innerDoc.getElementById('text');
                var val = test.value;
                var confirmF = confirm('<?php echo $Lang->save;?> ?');
                if(confirmF){
                    closeFancySignalStatus<?php echo $_SESSION['counter']; ?>(val);
                }
            }
        });
    });

    multiSelectMaker('<?php echo $_SESSION['counter']; ?>signalNameCheckingSignal','signal_checking_worker','signal_checking_worker_delete',signal_id<?php echo $_SESSION['counter']; ?>);
    multiSelectMaker('<?php echo $_SESSION['counter']; ?>signalNameOperatives','signal_worker','signal_worker_delete',signal_id<?php echo $_SESSION['counter']; ?>);

    multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>signalWorkerPost','signal_checking_worker_post','delete_signal_checking_worker_post',signal_id<?php echo $_SESSION['counter']; ?>);
    multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>signalPost','signal_worker_post','delete_signal_worker_post',signal_id<?php echo $_SESSION['counter']; ?>);

    });


    function closeFancySignalContent<?php echo $_SESSION['counter']; ?>(data , id ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/signal_content/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+id,
                type:'POST',
                data:{ 'data':data },
        dataType:'json',
                success:function(data){

            $('#<?php echo $_SESSION['counter']; ?>signalContentItemContent').remove();

            $('#<?php echo $_SESSION['counter']; ?>signalContentFilter').append('<li id="<?php echo $_SESSION['counter']; ?>signalContentItemContent">'
            +'<div class="item signalContent" data_id="'+signal_id<?php echo $_SESSION['counter']; ?>+'">'
            +'<span signal_id="'+signal_id<?php echo $_SESSION['counter']; ?>+'" session_counter="<?php echo $_SESSION['counter']; ?>" >'+data.text+'</span>'
            +'<a href="javascript:removeSignalContent('+signal_id<?php echo $_SESSION['counter']; ?>+');">x</a>'
            +'</div>'
            +'</li>');
        }
    });
    //        $.fancybox.close();
    $('#<?php echo $_SESSION['counter']; ?>signalContent').focus();
    }

    function removeSignalContent(id){
        var removeManHasWeapon = confirm('<?php echo $Lang->are_you_sure;?>');
        if(removeManHasWeapon){
            $.ajax({
                url:'<?php echo ROOT; ?>add/delete_content/'+id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>signalContentItemContent').remove();
                    $('#<?php echo $_SESSION['counter']; ?>signalContent').focus();
                }
            });
        }
    }

    function closeFancySignalStatus<?php echo $_SESSION['counter']; ?>(data , id ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/signal_status/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+id,
                type:'POST',
                data:{ 'data':data },
        dataType:'json',
                success:function(data){

            $('#<?php echo $_SESSION['counter']; ?>signalStatusItemStatus').remove();

            $('#<?php echo $_SESSION['counter']; ?>signalStatusFilter').append('<li id="<?php echo $_SESSION['counter']; ?>signalStatusItemStatus">'
            +'<div class="item signalStatus" data_id="'+signal_id<?php echo $_SESSION['counter']; ?>+'">'
            +'<span session_counter="<?php echo $_SESSION['counter']; ?>" signal_id="'+signal_id<?php echo $_SESSION['counter']; ?>+'" >'+data.text+'</span>'
            +'<a href="javascript:removeSignalStatus('+signal_id<?php echo $_SESSION['counter']; ?>+');">x</a>'
            +'</div>'
            +'</li>');
        }
    });
    //        $.fancybox.close();
    $('#<?php echo $_SESSION['counter']; ?>signalStatus').focus();
    }

    function removeSignalStatus(id){
        var removeManHasWeapon = confirm('<?php echo $Lang->are_you_sure;?>');
        if(removeManHasWeapon){
            $.ajax({
                url:'<?php echo ROOT; ?>add/delete_status/'+id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>signalStatusItemStatus').remove();
                    $('#<?php echo $_SESSION['counter']; ?>signalStatus').focus();
                }
            });
        }
    }



    function closeSignal<?php echo $_SESSION['counter']; ?>(name,id){
        //        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameSignal<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdSignal<?php echo $_SESSION['counter']; ?>).val(id);
        var field = $('#'+currentInputIdSignal<?php echo $_SESSION['counter']; ?>).attr('name');
        saveSignal<?php echo $_SESSION['counter']; ?>(id,field);
        $('#'+currentInputNameSignal<?php echo $_SESSION['counter']; ?>).focus();
        $.fancybox.close();
    }

    function saveSignal<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value,'field':field };
        $.ajax({
            url: '<?php echo ROOT?>add/signal_save/'+signal_id<?php echo $_SESSION['counter']; ?>,
        type: 'POST',
                data:data,
                success: function(data){
            checkSignal<?php echo $_SESSION['counter']; ?> = false;
        },
        faild: function(data){
            alert('error ');
        }
    });
    }

    function signal_keep_signal<?php echo $_SESSION['counter']; ?>(keep_signal_id , check , data  ){
        if( check != 'ok'){
            removeItem();
        }
        $('#<?php echo $_SESSION['counter']; ?>signalKeepSignalFilter').append('<li id="<?php echo $_SESSION['counter']; ?>signalKeepSignalItem'+keep_signal_id+'">'
        +'<div class="item">'
        +'<span class="openData" data-id="'+keep_signal_id+'" data-tb="keep_signal"><?php echo $Lang->short_keep_signal; ?> : '+keep_signal_id+'</span>'
        +'<span class="kedit" data-id="'+keep_signal_id+'" ></span>'
        +'<a href="javascript:removeSignalKeepSignal<?php echo $_SESSION['counter']; ?>('+keep_signal_id+');">x</a>'
        +'</div>'
        +'</li>');
        $('#<?php echo $_SESSION['counter']; ?>signalKeepSignal').focus();
    }
    function removeSignalKeepSignal<?php echo $_SESSION['counter']; ?>(keep_signal_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT?>add/delete_keep_signal/'+keep_signal_id,
                success: function(data){
                    $('#<?php echo $_SESSION['counter']; ?>signalKeepSignalItem'+keep_signal_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>signalKeepSignal').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function signal_organization_passes_by_signal<?php echo $_SESSION['counter']; ?>(organization_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/signal_organization_passes_by_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
                dataType:'json',
                success:function(data){
            if(data.status){
                if( check != 'ok'){
                    removeItem();
                }
                $('#<?php echo $_SESSION['counter']; ?>signalPassesSignalOrganizationFilter').append('<li id="<?php echo $_SESSION['counter']; ?>signalOrganizationPassesBySignalItem'+organization_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+organization_id+'" data-tb="organization"><?php echo $Lang->short_organ; ?> : '+organization_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeSignalOrganizationPassesBySignal<?php echo $_SESSION['counter']; ?>('+organization_id+');">x</a>'
                +'</div>'
                +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>signalPassesSignalOrganization').focus();
            }else{
                alert('<?php echo $Lang->relationship_exists;?>');
            }
        },
        faild: function(data){
            alert('<?php echo $Lang->err;?> ');
        }
    });
    }
    function removeSignalOrganizationPassesBySignal<?php echo $_SESSION['counter']; ?>(organization_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_signal_organization_passes_by_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
                    success:function(data){
                $('#<?php echo $_SESSION['counter']; ?>signalOrganizationPassesBySignalItem'+organization_id).remove();
                $('#<?php echo $_SESSION['counter']; ?>signalPassesSignalOrganization').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    }

    function signal_man_passed_by_signal<?php echo $_SESSION['counter']; ?>(man_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/signal_man_passed_by_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
                dataType:'json',
                success:function(data){
            if(data.status){
                if( check != 'ok'){
                    removeItem();
                }
                $('#<?php echo $_SESSION['counter']; ?>signalPassesSignalManFilter').append('<li id="<?php echo $_SESSION['counter']; ?>signalManPassedBySignalItem'+man_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+man_id+'" data-tb="man"><?php echo $Lang->short_man; ?> : '+man_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeSignalManPassedBySignal<?php echo $_SESSION['counter']; ?>('+man_id+');">x</a>'
                +'</div>'
                +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>signalPassesSignalMan').focus();
            }else{
                alert('<?php echo $Lang->relationship_exists;?>');
            }
        },
        faild: function(data){
            alert('<?php echo $Lang->err;?> ');
        }
    });
    }
    function removeSignalManPassedBySignal<?php echo $_SESSION['counter']; ?>(man_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_signal_man_passed_by_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
                    success:function(data){
                $('#<?php echo $_SESSION['counter']; ?>signalManPassedBySignalItem'+man_id).remove();
                $('#<?php echo $_SESSION['counter']; ?>signalPassesSignalMan').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    }

    function signal_event_passes_by_signal<?php echo $_SESSION['counter']; ?>(event_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/signal_event_passes_by_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+event_id,
                dataType:'json',
                success:function(data){
            if(data.status){
                if( check != 'ok'){
                    removeItem();
                }
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>EventFilter').append('<li id="<?php echo $_SESSION['counter']; ?>signalEventPassedBySignalItem'+event_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+event_id+'" data-tb="event"><?php echo $Lang->short_event; ?> : '+event_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeSignalEventPassedBySignal<?php echo $_SESSION['counter']; ?>('+event_id+');">x</a>'
                +'</div>'
                +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Event').focus();
            }else{
                alert('<?php echo $Lang->relationship_exists;?>');
            }
        },
        faild: function(data){
            alert('<?php echo $Lang->err;?> ');
        }
    });
    }
    function removeSignalEventPassedBySignal<?php echo $_SESSION['counter']; ?>(event_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_signal_event_passes_by_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+event_id,
                    success:function(data){
                $('#<?php echo $_SESSION['counter']; ?>signalEventPassedBySignalItem'+event_id).remove();
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Event').focus();
            },
            faild: function(data){
                alert('error ');
            }
        });
    }
    }

    function signal_action_passes_by_signal<?php echo $_SESSION['counter']; ?>(action_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/signal_action_passes_by_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+action_id,
                dataType:'json',
                success:function(data){
            if(data.status){
                if( check != 'ok'){
                    removeItem();
                }
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>ActionFilter').append('<li id="<?php echo $_SESSION['counter']; ?>signalActionPassedBySignalItem'+action_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+action_id+'" data-tb="action"><?php echo $Lang->short_action; ?> : '+action_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeSignalActionPassedBySignal<?php echo $_SESSION['counter']; ?>('+action_id+');">x</a>'
                +'</div>'
                +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Action').focus();
            }else{
                alert('<?php echo $Lang->relationship_exists;?>');
            }
        },
        faild: function(data){
            alert('<?php echo $Lang->err;?> ');
        }
    });
    }
    function removeSignalActionPassedBySignal<?php echo $_SESSION['counter']; ?>(action_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_signal_action_passes_by_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+action_id,
                    success:function(data){
                $('#<?php echo $_SESSION['counter']; ?>signalActionPassedBySignalItem'+action_id).remove();
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Action').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    }

    function signal_organization_checked_by_signal<?php echo $_SESSION['counter']; ?>(organization_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/signal_organization_checked_by_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
                dataType:'json',
                success:function(data){
            if(data.status){
                if( check != 'ok'){
                    removeItem();
                }
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>OrganizationFilter').append('<li id="<?php echo $_SESSION['counter']; ?>signalOrganizationCheckedBySignalItem'+organization_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+organization_id+'" data-tb="organization"><?php echo $Lang->short_organ; ?> : '+organization_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeSignalOrganizationCheckedBySignal<?php echo $_SESSION['counter']; ?>('+organization_id+');">x</a>'
                +'</div>'
                +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Organization').focus();
            }else{
                alert('<?php echo $Lang->relationship_exists;?>');
            }
        },
        faild: function(data){
            alert('<?php echo $Lang->err;?> ');
        }
    });
    }
    function removeSignalOrganizationCheckedBySignal<?php echo $_SESSION['counter']; ?>(organization_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_signal_organization_checked_by_signal/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
                    success:function(data){
                $('#<?php echo $_SESSION['counter']; ?>signalOrganizationCheckedBySignalItem'+organization_id).remove();
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Organization').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    }

    function signal_signal_has_man<?php echo $_SESSION['counter']; ?>(man_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/signal_signal_has_man/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
                dataType:'json',
                success:function(data){
            if(data.status){
                if( check != 'ok'){
                    removeItem();
                }
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>ManFilter').append('<li id="<?php echo $_SESSION['counter']; ?>signalSignalHasMan'+man_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+man_id+'" data-tb="man"><?php echo $Lang->short_man; ?> : '+man_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeSignalHasMan<?php echo $_SESSION['counter']; ?>('+man_id+');">x</a>'
                +'</div>'
                +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Man').focus();
            }else{
                alert('<?php echo $Lang->relationship_exists;?>');
            }
        },
        faild: function(data){
            alert('<?php echo $Lang->err;?> ');
        }
    });
    }

    function removeSignalHasMan<?php echo $_SESSION['counter']; ?>(man_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_signal_signal_has_man/'+signal_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
                    success:function(data){
                $('#<?php echo $_SESSION['counter']; ?>signalSignalHasMan'+man_id).remove();
                $('#<?php echo $_SESSION['counter']; ?>signalObjectscheckSignal<?php echo $_SESSION['counter']; ?>Man').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    }

    function signal_criminal_case<?php echo $_SESSION['counter']; ?>(criminal_case_id , check  ){
        $.ajax({
            url: '<?php echo ROOT; ?>add/criminal_case_has_signal/'+criminal_case_id+'/'+signal_id<?php echo $_SESSION['counter']; ?>,
        dataType: 'json',
                success:function(data){
            if(data.status){
                if( check != 'ok'){
                    removeItem();
                }
                $('#<?php echo $_SESSION['counter']; ?>signalAccordingTestResultFilter').append('<li id="<?php echo $_SESSION['counter']; ?>signalCriminalCaseItem'+criminal_case_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+criminal_case_id+'" data-tb="criminal_case"><?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeSignalCriminalCase<?php echo $_SESSION['counter']; ?>('+criminal_case_id+');">x</a>'
                +'</div>'
                +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>signalAccordingTestResult').focus();
            }else{
                alert('<?php echo $Lang->relationship_exists;?>');
            }
        },
        faild: function(data){
            alert('<?php echo $Lang->err;?> ');
        }
    });
    }

    function removeSignalCriminalCase<?php echo $_SESSION['counter']; ?>(criminal_case_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_criminal_case_has_signal/'+criminal_case_id+'/'+signal_id<?php echo $_SESSION['counter']; ?>,
            success:function(data){
                $('#<?php echo $_SESSION['counter']; ?>signalCriminalCaseItem'+criminal_case_id).remove();
                $('#<?php echo $_SESSION['counter']; ?>signalAccordingTestResult').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    }



</script>