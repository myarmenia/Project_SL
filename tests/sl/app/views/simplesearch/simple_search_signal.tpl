<a class="closeButton"></a>
<div class="inContent">
    <form id="signalForm" action="<?php echo ROOT;?>simplesearch/result_signal" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="<?php echo $Lang->and; ?>" id="signal_and" />
            <input type="button" class="k-button" value="<?php echo $Lang->or; ?>" id="signal_or" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
            <input type="submit" class="k-button" name="submit" value="<?php echo $Lang->search;?>" /> <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['reg_num'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalRegNumberSignalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['reg_num'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalRegNumberSignal">
                    <div class="item">
                        <span><?php echo $search_params['reg_num'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="reg_num[]" value="<?php echo $search_params['reg_num'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="reg_num_type" id="searchSignalRegNumberSignalType" value="<?php echo $search_params['reg_num_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalRegNumberSignal"><?php echo $Lang->reg_number_signal;?></label>
            <input type="text" name="reg_num[]" id="searchSignalRegNumberSignal" class="oneInputSaveEnter" />
            <?php if (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalRegNumberSignalOp">ИЛИ</span>
            <?php } else if (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalRegNumberSignalOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['content'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalContentsInformationSignalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['content'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalContentsInformationSignal">
                    <div class="item">
                        <span><?php echo $search_params['content'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="content[]" value="<?php echo $search_params['content'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="content_type" id="searchSignalContentsInformationSignalType" value="<?php echo $search_params['content_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalContentsInformationSignal"><?php echo $Lang->contents_information_signal;?></label>
            <input type="text" name="content[]" id="searchSignalContentsInformationSignal" class="oneInputSaveEnter" />
            <?php if (isset($search_params['content_type']) && $search_params['content_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalContentsInformationSignalOp">ИЛИ</span>
            <?php } else if (isset($search_params['content_type']) && $search_params['content_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalContentsInformationSignalOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['check_line'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalLineWhichVerifiedFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['check_line'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalLineWhichVerified">
                    <div class="item">
                        <span><?php echo $search_params['check_line'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="check_line[]" value="<?php echo $search_params['check_line'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="check_line_type" id="searchSignalLineWhichVerifiedType" value="<?php echo $search_params['check_line_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalLineWhichVerified"><?php echo $Lang->line_which_verified;?></label>
            <input type="text" name="check_line[]" id="searchSignalLineWhichVerified" onkeydown="validateNumber(event,'searchSignalLineWhichVerified',30)" class="oneInputSaveEnter " />
            <?php if (isset($search_params['check_line_type']) && $search_params['check_line_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalLineWhichVerifiedOp">ИЛИ</span>
            <?php } else if (isset($search_params['check_line_type']) && $search_params['check_line_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalLineWhichVerifiedOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['check_status'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalCheckStatusCharterFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['check_status'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalCheckStatusCharter">
                    <div class="item">
                        <span><?php echo $search_params['check_status'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="check_status[]" value="<?php echo $search_params['check_status'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="check_status_type" id="searchSignalCheckStatusCharterType" value="<?php echo $search_params['check_status_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalCheckStatusCharter"><?php echo $Lang->check_status_charter;?></label>
            <input type="text" name="check_status[]" id="searchSignalCheckStatusCharter" class="oneInputSaveEnter" />
            <?php if (isset($search_params['check_status_type']) && $search_params['check_status_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalCheckStatusCharterOp">ИЛИ</span>
            <?php } else if (isset($search_params['check_status_type']) && $search_params['check_status_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalCheckStatusCharterOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['signal_qualification_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalQualificationsSignalingFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['signal_qualification_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalQualificationsSignaling">
                    <div class="item">
                        <span><?php echo $search_params['signal_qualification_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="signal_qualification_id[]" value="<?php echo $search_params['signal_qualification_id'][$i] ?>">
                    <input type="hidden" name="signal_qualification_idName[]" value="<?php echo $search_params['signal_qualification_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="signal_qualification_id_type" id="searchSignalQualificationsSignalingType" value="<?php echo $search_params['signal_qualification_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm" >
            <label for="searchSignalQualificationsSignaling"><?php echo $Lang->qualifications_signaling;?></label>
            <input type="button" dataName="searchSignalQualificationsSignaling" dataId="searchSignalQualificationsSignalingId" dataTableName="fancy/signal_qualification" class="addMore k-icon k-i-plus"   />
            <input type="text" name="signal_qualification" id="searchSignalQualificationsSignaling" dataTableName="signal_qualification" dataInputId="searchSignalQualificationsSignalingId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['signal_qualification_id_type']) && $search_params['signal_qualification_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalQualificationsSignalingOp">ИЛИ</span>
            <?php } else if (isset($search_params['signal_qualification_id_type']) && $search_params['signal_qualification_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalQualificationsSignalingOp">И</span>
            <?php } ?>
            <input type="hidden" name="signal_qualification_id[]" id="searchSignalQualificationsSignalingId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['source_resource_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalSourceCategoryFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['source_resource_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalSourceCategory">
                    <div class="item">
                        <span><?php echo $search_params['source_resource_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="source_resource_id[]" value="<?php echo $search_params['source_resource_id'][$i] ?>">
                    <input type="hidden" name="source_resource_idName[]" value="<?php echo $search_params['source_resource_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="source_resource_id_type" id="searchSignalSourceCategoryType" value="<?php echo $search_params['source_resource_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm" >
            <label for="searchSignalSourceCategory"><?php echo $Lang->source_category;?></label>
            <input type="button" dataName="searchSignalSourceCategory" dataId="searchSignalSourceCategoryId" dataTableName="fancy/resource" class="addMore k-icon k-i-plus"   />
            <input type="text" name="source_resource" id="searchSignalSourceCategory" dataTableName="resource" dataInputId="searchSignalSourceCategoryId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['source_resource_id_type']) && $search_params['source_resource_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalSourceCategoryOp">ИЛИ</span>
            <?php } else if (isset($search_params['source_resource_id_type']) && $search_params['source_resource_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalSourceCategoryOp">И</span>
            <?php } ?>
            <input type="hidden" name="source_resource_id[]" id="searchSignalSourceCategoryId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['check_unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalChecksSignalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['check_unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalChecksSignal">
                    <div class="item">
                        <span><?php echo $search_params['check_unit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="check_unit_id[]" value="<?php echo $search_params['check_unit_id'][$i] ?>">
                    <input type="hidden" name="check_unit_idName[]" value="<?php echo $search_params['check_unit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="check_unit_id_type" id="searchSignalChecksSignalType" value="<?php echo $search_params['check_unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm" >
            <label for="searchSignalChecksSignal"><?php echo $Lang->checks_signal;?></label>
            <input type="button" dataName="searchSignalChecksSignal" dataId="searchSignalChecksSignalId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="check_unit" id="searchSignalChecksSignal" dataTableName="agency" dataInputId="searchSignalChecksSignalId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['check_unit_id_type']) && $search_params['check_unit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalChecksSignalOp">ИЛИ</span>
            <?php } else if (isset($search_params['check_unit_id_type']) && $search_params['check_unit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalChecksSignalOp">И</span>
            <?php } ?>
            <input type="hidden" name="check_unit_id[]" id="searchSignalChecksSignalId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['check_agency_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalDepartmentCheckingFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['check_agency_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalDepartmentChecking">
                    <div class="item">
                        <span><?php echo $search_params['check_agency_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="check_agency_id[]" value="<?php echo $search_params['check_agency_id'][$i] ?>">
                    <input type="hidden" name="check_agency_idName[]" value="<?php echo $search_params['check_agency_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="check_agency_id_type" id="searchSignalDepartmentCheckingType" value="<?php echo $search_params['check_agency_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm" >
            <label for="searchSignalDepartmentChecking"><?php echo $Lang->department_checking;?></label>
            <input type="button" dataName="searchSignalDepartmentChecking" dataId="searchSignalDepartmentCheckingId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="check_agency" id="searchSignalDepartmentChecking" dataTableName="agency" dataInputId="searchSignalDepartmentCheckingId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['check_agency_id_type']) && $search_params['check_agency_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalDepartmentCheckingOp">ИЛИ</span>
            <?php } else if (isset($search_params['check_agency_id_type']) && $search_params['check_agency_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalDepartmentCheckingOp">И</span>
            <?php } ?>
            <input type="hidden" name="check_agency_id[]" id="searchSignalDepartmentCheckingId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['check_subunit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalUnitTestingFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['check_subunit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalUnitTesting">
                    <div class="item">
                        <span><?php echo $search_params['check_subunit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="check_subunit_id[]" value="<?php echo $search_params['check_subunit_id'][$i] ?>">
                    <input type="hidden" name="check_subunit_idName[]" value="<?php echo $search_params['check_subunit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="check_subunit_id_type" id="searchSignalUnitTestingType" value="<?php echo $search_params['check_subunit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm" >
            <label for="searchSignalUnitTesting"><?php echo $Lang->unit_testing;?></label>
            <input type="button" dataName="searchSignalUnitTesting" dataId="searchSignalUnitTestingId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="check_subunit" id="searchSignalUnitTesting" dataTableName="agency" dataInputId="searchSignalUnitTestingId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['check_subunit_id_type']) && $search_params['check_subunit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalUnitTestingOp">ИЛИ</span>
            <?php } else if (isset($search_params['check_subunit_id_type']) && $search_params['check_subunit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalUnitTestingOp">И</span>
            <?php } ?>
            <input type="hidden" name="check_subunit_id[]" id="searchSignalUnitTestingId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['checking_worker'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalNameCheckingSignalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['checking_worker'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalNameCheckingSignal">
                    <div class="item">
                        <span><?php echo $search_params['checking_worker'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="checking_worker[]" value="<?php echo $search_params['checking_worker'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="checking_worker_type" id="searchSignalNameCheckingSignalType" value="<?php echo $search_params['checking_worker_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm" >
            <label for="searchSignalNameCheckingSignal"><?php echo $Lang->name_checking_signal;?></label>
            <input type="text" name="checking_worker[]" id="searchSignalNameCheckingSignal" class="oneInputSaveEnter" />
            <?php if (isset($search_params['checking_worker_type']) && $search_params['checking_worker_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalNameCheckingSignalOp">ИЛИ</span>
            <?php } else if (isset($search_params['checking_worker_type']) && $search_params['checking_worker_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalNameCheckingSignalOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['checking_worker_post'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="signalWorkerPostFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['checking_worker_post'])-1 ; $i++ ) { ?>
                <li id="listItemsignalWorkerPost">
                    <div class="item">
                        <span><?php echo $search_params['checking_worker_postName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="checking_worker_post[]" value="<?php echo $search_params['checking_worker_post'][$i] ?>">
                    <input type="hidden" name="checking_worker_postName[]" value="<?php echo $search_params['checking_worker_postName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="checking_worker_post_type" id="signalWorkerPostType" value="<?php echo $search_params['checking_worker_post_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="signalWorkerPost"><?php echo $Lang->worker_post;?></label>
            <input type="button" dataName="signalWorkerPost" dataId="signalWorkerPostId" dataTableName="fancy/worker_post" class="addMore addMore k-icon k-i-plus"   />
            <input type="text" name="worker_post" id="signalWorkerPost" dataTableName="worker_post" dataInputId="signalWorkerPostId" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['checking_worker_post_type']) && $search_params['checking_worker_post_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="signalWorkerPostOp">ИЛИ</span>
            <?php } else if (isset($search_params['checking_worker_post_type']) && $search_params['checking_worker_post_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="signalWorkerPostOp">И</span>
            <?php } ?>
            <input type="hidden" name="checking_worker_post[]" id="signalWorkerPostId" />
        </div>

        <div class="forForm">
            <label for="searchSignalDateRegistrationDivision"><?php echo $Lang->date_registration_division;?></label>
            <input type="text" name="subunit_date" id="searchSignalDateRegistrationDivision" style="width: 505px;" onkeydown="validateNumber(event,'searchSignalDateRegistrationDivision',12)" class="oneInputSaveEnter oneInputSaveDateSignal"/>
        </div>

        <div class="forForm">
            <label for="searchSignalCheckDate"><?php echo $Lang->check_date;?></label>
            <input type="text" name="check_date" id="searchSignalCheckDate" style="width: 505px;" onkeydown="validateNumber(event,'searchSignalCheckDate',12)" class="oneInputSaveEnter oneInputSaveDateSignal"/>
        </div>

        <div class="forForm">
            <label for="searchSignalCheckPreviously"><?php echo $Lang->check_previously;?></label>
            <input type="text" name="check_date_id" id="searchSignalCheckPreviously" style="width: 505px;" onkeydown="validateNumber(event,'searchSignalCheckPreviously',12)"  class="oneInputSaveEnter oneInputSaveDateSignal"/>
        </div>


        <div class="forForm">
            <label for="searchSignalDateActual"><?php echo $Lang->date_actual_word;?></label>
            <input type="text" name="end_date" id="searchSignalDateActual" style="width: 505px;" onkeydown="validateNumber(event,'searchSignalDateActual',12)" class="oneInputSaveEnter oneInputSaveDateSignal"/>
        </div>

        <?php if (isset($search_params) && isset($search_params['count_days'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="signalAmountOverdueFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['count_days'])-1 ; $i++ ) { ?>
                <li id="listItemsignalAmountOverdue">
                    <div class="item">
                        <span><?php echo $search_params['count_days'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="count_days[]" value="<?php echo $search_params['count_days'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="count_days_type" id="signalAmountOverdueType" value="<?php echo $search_params['count_days_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="signalAmountOverdue"><?php echo $Lang->amount_overdue;?></label>
            <input type="text" name="count_days[]" id="signalAmountOverdue" onkeydown="validateNumber(event,'signalAmountOverdue',12)" class="oneInputSaveEnter" />
            <?php if (isset($search_params['count_days_type']) && $search_params['count_days_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="signalAmountOverdueOp">ИЛИ</span>
            <?php } else if (isset($search_params['count_days_type']) && $search_params['count_days_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="signalAmountOverdueOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['resource_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalUsefulCapabilitiesFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['resource_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalUsefulCapabilities">
                    <div class="item">
                        <span><?php echo $search_params['resource_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="resource_id[]" value="<?php echo $search_params['resource_id'][$i] ?>">
                    <input type="hidden" name="resource_idName[]" value="<?php echo $search_params['resource_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="resource_id_type" id="searchSignalUsefulCapabilitiesType" value="<?php echo $search_params['resource_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalUsefulCapabilities"><?php echo $Lang->useful_capabilities;?></label>
            <input type="button" dataName="searchSignalUsefulCapabilities" dataId="searchSignalUsefulCapabilitiesId" dataTableName="fancy/resource" class="addMore k-icon k-i-plus"   />
            <input type="text" name="resource" id="searchSignalUsefulCapabilities" dataTableName="resource" dataInputId="searchSignalUsefulCapabilitiesId" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['resource_id_type']) && $search_params['resource_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalUsefulCapabilitiesOp">ИЛИ</span>
            <?php } else if (isset($search_params['resource_id_type']) && $search_params['resource_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalUsefulCapabilitiesOp">И</span>
            <?php } ?>
            <input type="hidden" name="resource_id[]" id="searchSignalUsefulCapabilitiesId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['signal_result_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalSignalResultsFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['signal_result_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalSignalResults">
                    <div class="item">
                        <span><?php echo $search_params['signal_result_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="signal_result_id[]" value="<?php echo $search_params['signal_result_id'][$i] ?>">
                    <input type="hidden" name="signal_result_idName[]" value="<?php echo $search_params['signal_result_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="signal_result_id_type" id="searchSignalSignalResultsType" value="<?php echo $search_params['signal_result_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalSignalResults"><?php echo $Lang->signal_results;?></label>
            <input type="button" dataName="searchSignalSignalResults" dataId="searchSignalSignalResultsId" dataTableName="fancy/signal_result" class="addMore k-icon k-i-plus"   />
            <input type="text" name="signal_result" id="searchSignalSignalResults" dataTableName="signal_result" dataInputId="searchSignalSignalResultsId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['signal_result_id_type']) && $search_params['signal_result_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalSignalResultsOp">ИЛИ</span>
            <?php } else if (isset($search_params['signal_result_id_type']) && $search_params['signal_result_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalSignalResultsOp">И</span>
            <?php } ?>
            <input type="hidden" name="signal_result_id[]" id="searchSignalSignalResultsId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['taken_measure_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalMeasuresTakenFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['taken_measure_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalMeasuresTaken">
                    <div class="item">
                        <span><?php echo $search_params['taken_measure_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="taken_measure_id[]" value="<?php echo $search_params['taken_measure_id'][$i] ?>">
                    <input type="hidden" name="taken_measure_idName[]" value="<?php echo $search_params['taken_measure_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="taken_measure_id_type" id="searchSignalMeasuresTakenType" value="<?php echo $search_params['taken_measure_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalMeasuresTaken"><?php echo $Lang->measures_taken;?></label>
            <input type="button" dataName="searchSignalMeasuresTaken" dataId="searchSignalMeasuresTakenId" dataTableName="fancy/taken_measure" class="addMore k-icon k-i-plus"   />
            <input type="text" name="taken_measure" id="searchSignalMeasuresTaken" dataTableName="taken_measure" dataInputId="searchSignalMeasuresTakenId" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['taken_measure_id_type']) && $search_params['taken_measure_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalMeasuresTakenOp">ИЛИ</span>
            <?php } else if (isset($search_params['taken_measure_id_type']) && $search_params['taken_measure_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalMeasuresTakenOp">И</span>
            <?php } ?>
            <input type="hidden" name="taken_measure_id[]" id="searchSignalMeasuresTakenId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['opened_dou'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalAccordingResultDowFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['opened_dou'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalAccordingResultDow">
                    <div class="item">
                        <span><?php echo $search_params['opened_dou'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="opened_dou[]" value="<?php echo $search_params['opened_dou'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="opened_dou_type" id="searchSignalAccordingResultDowType" value="<?php echo $search_params['opened_dou_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalAccordingResultDow"><?php echo $Lang->according_result_dow;?></label>
            <input type="text" name="opened_dou[]" id="searchSignalAccordingResultDow" class="oneInputSaveEnter " />
            <?php if (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalAccordingResultDowOp">ИЛИ</span>
            <?php } else if (isset($search_params['opened_dou_type']) && $search_params['opened_dou_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalAccordingResultDowOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['opened_agency_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalBroughtSignalFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['opened_agency_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalBroughtSignal">
                    <div class="item">
                        <span><?php echo $search_params['opened_agency_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="opened_agency_id[]" value="<?php echo $search_params['opened_agency_id'][$i] ?>">
                    <input type="hidden" name="opened_agency_idName[]" value="<?php echo $search_params['opened_agency_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="opened_agency_id_type" id="searchSignalBroughtSignalType" value="<?php echo $search_params['opened_agency_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalBroughtSignal"><?php echo $Lang->brought_signal;?></label>
            <input type="button" dataName="searchSignalBroughtSignal" dataId="searchSignalBroughtSignalId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="opened_unit" id="searchSignalBroughtSignal" dataTableName="agency" dataInputId="searchSignalBroughtSignalId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['opened_agency_id_type']) && $search_params['opened_agency_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalBroughtSignalOp">ИЛИ</span>
            <?php } else if (isset($search_params['opened_agency_id_type']) && $search_params['opened_agency_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalBroughtSignalOp">И</span>
            <?php } ?>
            <input type="hidden" name="opened_agency_id[]" id="searchSignalBroughtSignalId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['opened_unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalDepartmentBroughtFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['opened_unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalDepartmentBrought">
                    <div class="item">
                        <span><?php echo $search_params['opened_unit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="opened_unit_id[]" value="<?php echo $search_params['opened_unit_id'][$i] ?>">
                    <input type="hidden" name="opened_unit_idName[]" value="<?php echo $search_params['opened_unit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="opened_unit_id_type" id="searchSignalDepartmentBroughtType" value="<?php echo $search_params['opened_unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalDepartmentBrought"><?php echo $Lang->department_brought;?></label>
            <input type="button" dataName="searchSignalDepartmentBrought" dataId="searchSignalDepartmentBroughtId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="opened_agency" id="searchSignalDepartmentBrought" dataTableName="agency" dataInputId="searchSignalDepartmentBroughtId"  class="oneInputSaveEnter" />
            <?php if (isset($search_params['opened_unit_id_type']) && $search_params['opened_unit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalDepartmentBroughtOp">ИЛИ</span>
            <?php } else if (isset($search_params['opened_unit_id_type']) && $search_params['opened_unit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalDepartmentBroughtOp">И</span>
            <?php } ?>
            <input type="hidden" name="opened_unit_id[]" id="searchSignalDepartmentBroughtId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['opened_subunit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalUnitBroughtFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['opened_subunit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalUnitBrought">
                    <div class="item">
                        <span><?php echo $search_params['opened_subunit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="opened_subunit_id[]" value="<?php echo $search_params['opened_subunit_id'][$i] ?>">
                    <input type="hidden" name="opened_subunit_idName[]" value="<?php echo $search_params['opened_subunit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="opened_subunit_id_type" id="searchSignalUnitBroughtType" value="<?php echo $search_params['opened_subunit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalUnitBrought"><?php echo $Lang->unit_brought;?></label>
            <input type="button" dataName="searchSignalUnitBrought" dataId="searchSignalUnitBroughtId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="opened_subunit" id="searchSignalUnitBrought" dataTableName="agency" dataInputId="searchSignalUnitBroughtId" class="oneInputSaveEnter" />
            <?php if (isset($search_params['opened_subunit_id_type']) && $search_params['opened_subunit_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalUnitBroughtOp">ИЛИ</span>
            <?php } else if (isset($search_params['opened_subunit_id_type']) && $search_params['opened_subunit_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalUnitBroughtOp">И</span>
            <?php } ?>
            <input type="hidden" name="opened_subunit_id[]" id="searchSignalUnitBroughtId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['worker'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchSignalNameOperativesFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['worker'])-1 ; $i++ ) { ?>
                <li id="listItemsearchSignalNameOperatives">
                    <div class="item">
                        <span><?php echo $search_params['worker'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="worker[]" value="<?php echo $search_params['worker'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="worker_type" id="searchSignalNameOperativesType" value="<?php echo $search_params['worker_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchSignalNameOperatives"><?php echo $Lang->name_operatives;?></label>
            <input type="text" name="worker[]" id="searchSignalNameOperatives" class="oneInputSaveEnter" />
            <?php if (isset($search_params['worker_type']) && $search_params['worker_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalNameOperativesOp">ИЛИ</span>
            <?php } else if (isset($search_params['worker_type']) && $search_params['worker_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchSignalNameOperativesOp">И</span>
            <?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['worker_post_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="signalPostFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['worker_post_id'])-1 ; $i++ ) { ?>
                <li id="listItemsignalPost">
                    <div class="item">
                        <span><?php echo $search_params['worker_post_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="worker_post_id[]" value="<?php echo $search_params['worker_post_id'][$i] ?>">
                    <input type="hidden" name="worker_post_idName[]" value="<?php echo $search_params['worker_post_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="worker_post_id_type" id="signalPostType" value="<?php echo $search_params['worker_post_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="signalPost"><?php echo $Lang->worker_post;?></label>
            <input type="button" dataName="signalPost" dataId="signalPostId" dataTableName="fancy/worker_post" class="addMore addMore k-icon k-i-plus"   />
            <input type="text" name="uj" id="signalPost" dataTableName="worker_post" dataInputId="signalPostId" class="oneInputSaveEnter"/>
            <?php if (isset($search_params['worker_post_id_type']) && $search_params['worker_post_id_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="signalPostOp">ИЛИ</span>
            <?php } else if (isset($search_params['worker_post_id_type']) && $search_params['worker_post_id_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="signalPostOp">И</span>
            <?php } ?>
            <input type="hidden" name="worker_post_id[]" id="signalPostId" />
        </div>

        <?php if (isset($search_params) && isset($search_params['keep_count'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="signalKeep_countFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['keep_count'])-1 ; $i++ ) { ?>
                <li id="listItemsignalKeep_count">
                    <div class="item">
                        <span><?php echo $search_params['keep_count'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="keep_count[]" value="<?php echo $search_params['keep_count'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="keep_count_type" id="TsignalKeep_countype" value="<?php echo $search_params['keep_count_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="signalKeep_count"><?php echo $Lang->keep_signal;?></label>
            <input type="text" name="keep_count[]" id="signalKeep_count" onkeydown="validateNumber(event,'signalKeep_count',12)" class="oneInputSaveEnter" />
            <?php if (isset($search_params['keep_count_type']) && $search_params['keep_count_type'] == 'OR') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="signalKeep_countOp">ИЛИ</span>
            <?php } else if (isset($search_params['keep_count_type']) && $search_params['keep_count_type'] == 'AND') { ?>
            <span style="width: 30px;;position: absolute;margin-left: -570px;" id="signalKeep_countOp">И</span>
            <?php } ?>
        </div>

        <div class="forForm">
            <label for="fileSearch"><?php echo $Lang->file_search; ?></label>
            <input type="text" name="file_content" id="fileSearch"/>
        </div>

        <div class="buttons">

        </div>

    </form>
</div>

<script>
    var currentInputNameSignal;
    var currentInputIdSignal;
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        searchMultiSelectMaker( 'searchSignalRegNumberSignal' , 'reg_num' );
        searchMultiSelectMaker( 'searchSignalContentsInformationSignal' , 'content' );
        searchMultiSelectMaker( 'searchSignalLineWhichVerified' , 'check_line' );
        searchMultiSelectMaker( 'searchSignalCheckStatusCharter' , 'check_status' );
        searchMultiSelectMaker( 'searchSignalAccordingResultDow' , 'opened_dou' );
        searchMultiSelectMaker( 'searchSignalNameCheckingSignal' , 'checking_worker' );
        searchMultiSelectMaker( 'searchSignalNameOperatives' , 'worker' );
        searchMultiSelectMaker( 'signalAmountOverdue' , 'count_days' );
        searchMultiSelectMaker( 'signalKeep_count' , 'keep_count' );

        searchMultiSelectMakerAutoComplete( 'searchSignalQualificationsSignaling' , 'signal_qualification_id' );
        searchMultiSelectMakerAutoComplete( 'searchSignalSourceCategory' , 'source_resource_id' );
        searchMultiSelectMakerAutoComplete( 'searchSignalChecksSignal' , 'check_unit_id' );
        searchMultiSelectMakerAutoComplete( 'searchSignalDepartmentChecking' , 'check_agency_id' );
        searchMultiSelectMakerAutoComplete( 'searchSignalUnitTesting' , 'check_subunit_id' );
        searchMultiSelectMakerAutoComplete( 'searchSignalUsefulCapabilities' , 'resource_id' );
        searchMultiSelectMakerAutoComplete( 'searchSignalSignalResults' , 'signal_result_id' );
        searchMultiSelectMakerAutoComplete( 'searchSignalMeasuresTaken' , 'taken_measure_id' );
        searchMultiSelectMakerAutoComplete( 'searchSignalBroughtSignal' , 'opened_agency_id' );
        searchMultiSelectMakerAutoComplete( 'searchSignalDepartmentBrought' , 'opened_unit_id' );
        searchMultiSelectMakerAutoComplete( 'searchSignalUnitBrought' , 'opened_subunit_id' );
        searchMultiSelectMakerAutoComplete( 'signalWorkerPost' , 'checking_worker_post' );
        searchMultiSelectMakerAutoComplete( 'signalPost' , 'worker_post_id' );

        $('.oneInputSaveDateSignal').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

//    $('#searchSignalCheckPreviously').kendoDatePicker({
//        format: "dd-MM-yyyy",
//        change:function(e){
//            $('.selectedDiv').removeClass('selectedDiv');
//        }
//    });


        $('.oneInputSaveDateSignal').focusout(function(e){
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

        $('#signalWorkerPost').kendoAutoComplete({
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
                $('#signalWorkerPostId').val(dataItem.id);
            }
        });

        $('#signalPost').kendoAutoComplete({
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
                $('#signalPostId').val(dataItem.id);
            }
        });



        $('#searchSignalQualificationsSignaling').kendoAutoComplete({
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
                $('#searchSignalQualificationsSignalingId').val(dataItem.id);
            }
        });


        $('#searchSignalSourceCategory').kendoAutoComplete({
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
                $('#searchSignalSourceCategoryId').val(dataItem.id);
            }
        });


        $('#searchSignalChecksSignal').kendoAutoComplete({
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
                $('#searchSignalChecksSignalId').val(dataItem.id);
            }
        });


        $('#searchSignalDepartmentChecking').kendoAutoComplete({
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
                $('#searchSignalDepartmentCheckingId').val(dataItem.id);
            }
        });


        $('#searchSignalUnitTesting').kendoAutoComplete({
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
                $('#searchSignalUnitTestingId').val(dataItem.id);
            }
        });


        $('#searchSignalWorkerPost').kendoAutoComplete({
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
                $('#searchSignalWorkerPostId').val(dataItem.id);
            }
        });


        $('#searchSignalUsefulCapabilities').kendoAutoComplete({
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
                $('#searchSignalUsefulCapabilitiesId').val(dataItem.id);
            }
        });



        $('#searchSignalSignalResults').kendoAutoComplete({
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
                $('#searchSignalSignalResultsId').val(dataItem.id);
            }
        });


        $('#searchSignalMeasuresTaken').kendoAutoComplete({
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
                $('#searchSignalMeasuresTakenId').val(dataItem.id);
            }
        });

        $('#searchSignalBroughtSignal').kendoAutoComplete({
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
                $('#searchSignalBroughtSignalId').val(dataItem.id);
            }
        });



        $('#searchSignalDepartmentBrought').kendoAutoComplete({
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
                $('#searchSignalDepartmentBroughtId').val(dataItem.id);
            }
        });



        $('#searchSignalUnitBrought').kendoAutoComplete({
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
                $('#searchSignalUnitBroughtId').val(dataItem.id);
            }
        });




        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameSignal = $(this).attr('dataName');
            currentInputIdSignal = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=signal"
            });
        });

        $('.signalAddWorker').click(function(e){
            e.preventDefault();
            currentInputNameSignal = $(this).attr('dataName');
            currentInputIdSignal = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/fancyWorker/signal"
            });
        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#signal_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#signal_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchSignalRegNumberSignal').val("<?php echo html_entity_decode($search_params['reg_num'][sizeof($search_params['reg_num'])-1]) ?>");
            $('#searchSignalContentsInformationSignal').val("<?php echo html_entity_decode($search_params['content'][sizeof($search_params['content'])-1]) ?>");
            $('#searchSignalLineWhichVerified').val("<?php echo html_entity_decode($search_params['check_line'][sizeof($search_params['check_line'])-1]) ?>");
            $('#searchSignalCheckStatusCharter').val("<?php echo html_entity_decode($search_params['check_status'][sizeof($search_params['check_status'])-1]) ?>");
            $('#searchSignalQualificationsSignalingId').val("<?php echo $search_params['signal_qualification_id'][sizeof($search_params['signal_qualification_id'])-1] ?>");
            $('#searchSignalQualificationsSignaling').val("<?php echo html_entity_decode($search_params['signal_qualification']) ?>");
            $('#searchSignalSourceCategoryId').val("<?php echo $search_params['source_resource_id'][sizeof($search_params['source_resource_id'])-1] ?>");
            $('#searchSignalSourceCategory').val("<?php echo html_entity_decode($search_params['source_resource']) ?>");
            $('#searchSignalChecksSignalId').val("<?php echo $search_params['check_unit_id'][sizeof($search_params['check_unit_id'])-1] ?>");
            $('#searchSignalChecksSignal').val("<?php echo html_entity_decode($search_params['check_unit']) ?>");
            $('#searchSignalDepartmentCheckingId').val("<?php echo $search_params['check_agency_id'][sizeof($search_params['check_agency_id'])-1] ?>");
            $('#searchSignalDepartmentChecking').val("<?php echo html_entity_decode($search_params['check_agency']) ?>");
            $('#searchSignalUnitTestingId').val("<?php echo $search_params['check_subunit_id'][sizeof($search_params['check_subunit_id'])-1] ?>");
            $('#searchSignalUnitTesting').val("<?php echo html_entity_decode($search_params['check_subunit']) ?>");
            $('#searchSignalNameCheckingSignal').val("<?php echo html_entity_decode($search_params['checking_worker'][sizeof($search_params['checking_worker'])-1]) ?>");
            $('#signalWorkerPostId').val("<?php echo $search_params['checking_worker_post'][sizeof($search_params['checking_worker_post'])-1] ?>");
            $('#signalWorkerPost').val("<?php echo html_entity_decode($search_params['worker_post']) ?>");
            $('#searchSignalDateRegistrationDivision').val("<?php echo $search_params['subunit_date'] ?>");
            $('#searchSignalCheckDate').val("<?php echo $search_params['check_date'] ?>");
            $('#searchSignalCheckPreviously').val("<?php echo $search_params['check_date_id'] ?>");
            $('#searchSignalDateActual').val("<?php echo $search_params['end_date'] ?>");
            $('#signalAmountOverdue').val("<?php echo html_entity_decode($search_params['count_days'][sizeof($search_params['count_days'])-1]) ?>");
            $('#searchSignalUsefulCapabilitiesId').val("<?php echo $search_params['resource_id'][sizeof($search_params['resource_id'])-1] ?>");
            $('#searchSignalUsefulCapabilities').val("<?php echo html_entity_decode($search_params['resource']) ?>");
            $('#searchSignalSignalResultsId').val("<?php echo $search_params['signal_result_id'][sizeof($search_params['signal_result_id'])-1] ?>");
            $('#searchSignalSignalResults').val("<?php echo html_entity_decode($search_params['signal_result']) ?>");
            $('#searchSignalMeasuresTakenId').val("<?php echo $search_params['taken_measure_id'][sizeof($search_params['taken_measure_id'])-1] ?>");
            $('#searchSignalMeasuresTaken').val("<?php echo html_entity_decode($search_params['taken_measure']) ?>");
            $('#searchSignalAccordingResultDow').val("<?php echo html_entity_decode($search_params['opened_dou'][sizeof($search_params['opened_dou'])-1]) ?>");
            $('#searchSignalBroughtSignalId').val("<?php echo $search_params['opened_agency_id'][sizeof($search_params['opened_agency_id'])-1] ?>");
            $('#searchSignalBroughtSignal').val("<?php echo html_entity_decode($search_params['opened_unit']) ?>");
            $('#searchSignalDepartmentBroughtId').val("<?php echo $search_params['opened_unit_id'][sizeof($search_params['opened_unit_id'])-1] ?>");
            $('#searchSignalDepartmentBrought').val("<?php echo html_entity_decode($search_params['opened_agency']) ?>");
            $('#searchSignalUnitBroughtId').val("<?php echo $search_params['opened_subunit_id'][sizeof($search_params['opened_subunit_id'])-1] ?>");
            $('#searchSignalUnitBrought').val("<?php echo html_entity_decode($search_params['opened_subunit']) ?>");
            $('#searchSignalNameOperatives').val("<?php echo html_entity_decode($search_params['worker'][sizeof($search_params['worker'])-1]) ?>");
            $('#signalPostId').val("<?php echo $search_params['worker_post_id'][sizeof($search_params['worker_post_id'])-1] ?>");
            $('#signalPost').val("<?php echo html_entity_decode($search_params['uj']) ?>");
            $('#signalKeep_count').val("<?php echo html_entity_decode($search_params['keep_count'][sizeof($search_params['keep_count'])-1]) ?>");
            $('#fileSearch').val("<?php echo html_entity_decode($search_params['file_content']) ?>");
        <?php } ?>
    });

    function closeSignal(name,id){
        //        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameSignal).val(name);
        $('#'+currentInputIdSignal).val(id);
        var field = $('#'+currentInputIdSignal).attr('name');
        $.fancybox.close();
    }




</script>