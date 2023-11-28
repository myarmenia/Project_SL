@extends('layouts.include-app')

@section('include-css')
    <link href="{{ asset('assets/css/main/open-modal.css') }}" rel="stylesheet" />
@endsection

@section('content-include')

<a class="closeButton"></a>
<div class="inContent">
    <form id="controlForm" action="/{{ app()->getLocale() }}/simplesearch/result_control" method="post">
        <x-back-previous-url />
        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="control_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="control_or" />
            <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal"/>
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /><?php } ?>
        </div>

        <?php if (isset($search_params) && isset($search_params['unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlUnitFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlUnit">
                    <div class="item">
                        <span><?php echo $search_params['unit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="unit_id[]" value="<?php echo $search_params['unit_id'][$i] ?>">
                    <input type="hidden" name="unit_idName[]" value="<?php echo $search_params['unit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="unit_id_type" id="searchControlUnitType" value="<?php echo $search_params['unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlUnit">{{ __('content.unit') }}</label>
            <input type="button"
                   dataName="searchControlUnit"
                   dataId="searchControlUnitId"
                   dataTableName="fancy/agency"
                   class="addMore k-icon k-i-plus my-plus-class"
                   data-bs-toggle="modal"
                   data-bs-target="#fullscreenModal"
                   data-fieldname="name"
                   data-table-name="agency"
                   />
            <input  type="text"
                    firstItem="1"
                    name="unit_name"
                    id="searchControlUnit"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    dataTableName="agency"
                    dataInputId="searchControlUnitId"
                    list="unit_name"
                    />

            @if (isset($search_params['unit_id_type']) && $search_params['unit_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlUnitOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['unit_id_type']) && $search_params['unit_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlUnitOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['unit_id_type']) && $search_params['unit_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlUnitOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="unit_id[]" id="searchControlUnitId" />
            <datalist id="unit_name" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['doc_category_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlDocCategoryFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['doc_category_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlDocCategory">
                    <div class="item">
                        <span><?php echo $search_params['doc_category_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="doc_category_id[]" value="<?php echo $search_params['doc_category_id'][$i] ?>">
                    <input type="hidden" name="doc_category_idName[]" value="<?php echo $search_params['doc_category_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="doc_category_id_type" id="searchControlDocCategoryType" value="<?php echo $search_params['doc_category_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlDocCategory">{{ __('content.document_category') }}</label>
            <input  type="button"
                    dataName="searchControlDocCategory"
                    dataId="searchControlDocCategoryId"
                    dataTableName="fancy/doc_category"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="doc_category"
                    />

            <input  type="text"
                    name="category_title"
                    id="searchControlDocCategory"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    dataTableName="doc_category"
                    dataInputId="searchControlDocCategoryId"
                    list="category_title"
                    />

            @if (isset($search_params['doc_category_id_type']) && $search_params['doc_category_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlDocCategoryOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['doc_category_id_type']) && $search_params['doc_category_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlDocCategoryOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['doc_category_id_type']) && $search_params['doc_category_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlDocCategoryOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="doc_category_id[]" id="searchControlDocCategoryId" />
            <datalist id="category_title" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <div class="forForm">
            <label for="searchControlCreationDate">{{ __('content.document_date') }}</label>
            <input type="text" name="creation_date" onkeydown="validateNumber(event ,'searchControlCreationDate',12)" id="searchControlCreationDate" style="width: 505px;" class="datePicker oneInputSaveEnter"/>
        </div>

        <?php if (isset($search_params) && isset($search_params['reg_num'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlRegNumFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['reg_num'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlRegNum">
                    <div class="item">
                        <span><?php echo $search_params['reg_num'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="reg_num[]" value="<?php echo $search_params['reg_num'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="reg_num_type" id="searchControlRegNumType" value="<?php echo $search_params['reg_num_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlRegNum">{{ __('content.reg_document') }}</label>
            <input type="text" name="reg_num[]" id="searchControlRegNum" class="oneInputSave oneInputSaveEnter"  />

            <x-select-distance name="reg_document_distance" class="distance distance_searchControlRegNum"/>

            @if (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlRegNumOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlRegNumOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlRegNumOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <div class="forForm">
            <label for="searchControlRegDate">{{ __('content.date_reg') }}</label>
            <input type="text" name="reg_date" id="searchControlRegDate" onkeydown="validateNumber(event ,'searchControlRegDate',12)" style="width: 505px;" class="datePicker oneInputSaveEnter" />
        </div>

        <?php if (isset($search_params) && isset($search_params['snb_director'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlSnbDirectorFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['snb_director'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlSnbDirector">
                    <div class="item">
                        <span><?php echo $search_params['snb_director'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="snb_director[]" value="<?php echo $search_params['snb_director'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="snb_director_type" id="searchControlSnbDirectorType" value="<?php echo $search_params['snb_director_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlSnbDirector">{{ __('content.director') }}</label>
            <input type="text" name="snb_director[]" id="searchControlSnbDirector" class="oneInputSave oneInputSaveEnter" />

            <x-select-distance name="snb_director_distance" class="distance distance_searchControlSnbDirector"/>

            @if (isset($search_params['snb_director_type']) && $search_params['snb_director_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSnbDirectorOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['snb_director_type']) && $search_params['snb_director_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSnbDirectorOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['snb_director_type']) && $search_params['snb_director_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSnbDirectorOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['snb_subdirector'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlSnbSubDirectorFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['snb_subdirector'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlSnbSubDirector">
                    <div class="item">
                        <span><?php echo $search_params['snb_subdirector'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="snb_subdirector[]" value="<?php echo $search_params['snb_subdirector'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="snb_subdirector_type" id="searchControlSnbSubDirectorType" value="<?php echo $search_params['snb_subdirector_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlSnbSubDirector">{{ __('content.deputy_director') }}</label>
            <input type="text" name="snb_subdirector[]" id="searchControlSnbSubDirector" class="oneInputSave oneInputSaveEnter" />

            <x-select-distance name="subdirector_distance" class="distance distance_searchControlSnbSubDirector"/>

            @if (isset($search_params['snb_subdirector_type']) && $search_params['snb_subdirector_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSnbSubDirectorOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['snb_subdirector_type']) && $search_params['snb_subdirector_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSnbSubDirectorOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['snb_subdirector_type']) && $search_params['snb_subdirector_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSnbSubDirectorOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <div class="forForm">
            <label for="searchControlResolutionDate">{{ __('content.date_resolution') }}</label>
            <input type="text" name="resolution_date" id="searchControlResolutionDate" onkeydown="validateNumber(event ,'searchControlResolutionDate',12)" style="width: 505px;" class="datePicker oneInputSaveEnter" />
        </div>

        <?php if (isset($search_params) && isset($search_params['resolution'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlResolutionFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['resolution'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlResolution">
                    <div class="item">
                        <span><?php echo $search_params['resolution'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="resolution[]" value="<?php echo $search_params['resolution'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="resolution_type" id="searchControlResolutionType" value="<?php echo $search_params['resolution_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlResolution">{{ __('content.resolution') }}</label>
            <input type="text" name="resolution[]" id="searchControlResolution" class="oneInputSaveEnter" >

            <x-select-distance name="resolution_distance" class="distance distance_searchControlResolution"/>

            @if (isset($search_params['resolution_type']) && $search_params['resolution_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlResolutionOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['resolution_type']) && $search_params['resolution_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlResolutionOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['resolution_type']) && $search_params['resolution_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlResolutionOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['act_unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlActUnitFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['act_unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlActUnit">
                    <div class="item">
                        <span><?php echo $search_params['act_unit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="act_unit_id[]" value="<?php echo $search_params['act_unit_id'][$i] ?>">
                    <input type="hidden" name="act_unit_idName[]" value="<?php echo $search_params['act_unit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="act_unit_id_type" id="searchControlActUnitType" value="<?php echo $search_params['act_unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlActUnit">{{ __('content.department_performer') }}</label>
            <input  type="button"
                    dataName="searchControlActUnit"
                    dataId="searchControlActUnitId"
                    dataTableName="fancy/agency"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="agency"
                    />
            <input  type="text"
                    name="act_unit_name"
                    id="searchControlActUnit"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    dataTableName="agency"
                    dataInputId="searchControlActUnitId"
                    list="agency"
                    />
            @if (isset($search_params['act_unit_id_type']) && $search_params['act_unit_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlActUnitOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['act_unit_id_type']) && $search_params['act_unit_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlActUnitOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['act_unit_id_type']) && $search_params['act_unit_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlActUnitOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="act_unit_id[]" id="searchControlActUnitId" />
            <datalist id="agency" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['actor_name'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlActorNameFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['actor_name'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlActorName">
                    <div class="item">
                        <span><?php echo $search_params['actor_name'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="actor_name[]" value="<?php echo $search_params['actor_name'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="actor_name_type" id="searchControlActorNameType" value="<?php echo $search_params['actor_name_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlActorName">{{ __('content.actor_name') }}</label>
            <input type="text"  name="actor_name[]" id="searchControlActorName" class="oneInputSave oneInputSaveEnter" />

            <x-select-distance name="actor_name_distance" class="distance distance_searchControlActorName"/>

            @if (isset($search_params['actor_name_type']) && $search_params['actor_name_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlActorNameOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['actor_name_type']) && $search_params['actor_name_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlActorNameOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['actor_name_type']) && $search_params['actor_name_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlActorNameOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['sub_act_unit_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlSubActUnitFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['sub_act_unit_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlSubActUnit">
                    <div class="item">
                        <span><?php echo $search_params['sub_act_unit_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="sub_act_unit_id[]" value="<?php echo $search_params['sub_act_unit_id'][$i] ?>">
                    <input type="hidden" name="sub_act_unit_idName[]" value="<?php echo $search_params['sub_act_unit_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="sub_act_unit_id_type" id="searchControlSubActUnitType" value="<?php echo $search_params['sub_act_unit_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlSubActUnit">{{ __('content.department_coauthors') }}</label>
            <input  type="button"
                    dataName="searchControlSubActUnit"
                    dataId="searchControlSubActUnitId"
                    dataTableName="fancy/agency"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="agency"
                    />
            <input  type="text"
                    name="sub_act_unit_name"
                    id="searchControlSubActUnit"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    dataTableName="agency"
                    dataInputId="searchControlSubActUnitId"
                    list="agency_one"
                    />
            @if (isset($search_params['sub_act_unit_id_type']) && $search_params['sub_act_unit_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSubActUnitOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['sub_act_unit_id_type']) && $search_params['sub_act_unit_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSubActUnitOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['sub_act_unit_id_type']) && $search_params['sub_act_unit_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlSubActUnitOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="sub_act_unit_id[]" id="searchControlSubActUnitId" />
            <datalist id="agency_one" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <?php if (isset($search_params) && isset($search_params['sub_actor_name'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="controlSubActorNameFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['sub_actor_name'])-1 ; $i++ ) { ?>
                <li id="listItemcontrolSubActorName">
                    <div class="item">
                        <span><?php echo $search_params['sub_actor_name'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="sub_actor_name[]" value="<?php echo $search_params['sub_actor_name'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="sub_actor_name_type" id="controlSubActorNameType" value="<?php echo $search_params['sub_actor_name_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="controlSubActorName">{{ __('content.actor_name') }}</label>

            <input type="text"  name="sub_actor_name[]" id="controlSubActorName" class="oneInputSaveEnter" />

            <x-select-distance name="sub_actor_name_distance" class="distance distance_controlSubActorName"/>

            @if (isset($search_params['sub_actor_name_type']) && $search_params['sub_actor_name_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="controlSubActorNameOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['sub_actor_name_type']) && $search_params['sub_actor_name_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="controlSubActorNameOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['sub_actor_name_type']) && $search_params['sub_actor_name_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="controlSubActorNameOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['result_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchControlResultFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['result_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchControlResult">
                    <div class="item">
                        <span><?php echo $search_params['result_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="result_id[]" value="<?php echo $search_params['result_id'][$i] ?>">
                    <input type="hidden" name="result_idName[]" value="<?php echo $search_params['result_idName'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="result_id_type" id="searchControlResultType" value="<?php echo $search_params['result_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchControlResult">{{ __('content.result_execution') }}</label>
            <input  type="button"
                    dataName="searchControlResult"
                    dataId="searchControlResultId"
                    dataTableName="fancy/control_result"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="control_result"
                    />
            <input  type="text"
                    name="result_name"
                    id="searchControlResult"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    dataTableName="control_result"
                    dataInputId="searchControlResultId"
                    lastItem="1"
                    list="control_result"
                    />
            @if (isset($search_params['result_id_type']) && $search_params['result_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlResultOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['result_id_type']) && $search_params['result_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlResultOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['result_id_type']) && $search_params['result_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchControlResultOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="result_id[]" id="searchControlResultId" />
            <datalist id="control_result" class="input_datalists" style="width: 500px;"></datalist>
        </div>

        <div class="forForm">
            <label for="fileSearch">{{ __('content.file_search') }}</label>
            <input type="text" name="content" id="fileSearch"/>
            <x-select-distance name="content_distance" class="distance distance_fileSearch"/>
        </div>

        <div class="buttons">

        </div>
    </form>

</div>
  {{-- ================= modal =========================== --}}
  <x-fullscreen-modal/>

@section('js-include')

<script>
    let open_modal_url = `{{ route('open.modal') }}`
    let get_filter_in_modal = `{{ route('get-model-filter') }}`
</script>
<script src="{{ asset('assets-include/js/script.js') }}"></script>

<script>
    var currentInputNameControl;
    var currentInputIdControl;
    var searchInput;


    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        showHideDistance('fileSearch','distance_fileSearch');
        showHideDistance('searchControlRegNum','distance_searchControlRegNum');
        showHideDistance('searchControlSnbDirector','distance_searchControlSnbDirector');
        showHideDistance('searchControlSnbSubDirector','distance_searchControlSnbSubDirector');
        showHideDistance('searchControlResolution','distance_searchControlResolution');
        showHideDistance('searchControlActorName','distance_searchControlActorName');
        showHideDistance('controlSubActorName','distance_controlSubActorName');

        searchMultiSelectMaker( 'searchControlRegNum' , 'reg_num' );
        searchMultiSelectMaker( 'searchControlSnbDirector' , 'snb_director' );
        searchMultiSelectMaker( 'searchControlSnbSubDirector' , 'snb_subdirector' );
        searchMultiSelectMaker( 'searchControlResolution' , 'resolution' );
        searchMultiSelectMaker( 'searchControlActorName' , 'actor_name' );
        searchMultiSelectMaker( 'controlSubActorName' , 'sub_actor_name' );

        searchMultiSelectMakerAutoComplete( 'searchControlUnit' , 'unit_id' );
        searchMultiSelectMakerAutoComplete( 'searchControlDocCategory' , 'doc_category_id' );
        searchMultiSelectMakerAutoComplete( 'searchControlActUnit' , 'act_unit_id' );
        searchMultiSelectMakerAutoComplete( 'searchControlSubActUnit' , 'sub_act_unit_id' );
        searchMultiSelectMakerAutoComplete( 'searchControlResult' , 'result_id' );

        $('.datePicker').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        // $('#searchControlUnit').kendoAutoComplete({
        //     dataTextField: "name",
        //     filter: "contains",
        //     minLength: 3,
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/agency/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchControlUnitId').val(dataItem.id);
        //     }
        // });

        // $('#searchControlActUnit').kendoAutoComplete({
        //     dataTextField: "name",
        //     filter: "contains",
        //     minLength: 3,
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/agency/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchControlActUnitId').val(dataItem.id);
        //     }
        // });

        // $('#searchControlSubActUnit').kendoAutoComplete({
        //     dataTextField: "name",
        //     filter: "contains",
        //     minLength: 3,
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/agency/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchControlSubActUnitId').val(dataItem.id);
        //     }
        // });


        // $('#searchControlDocCategory').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/doc_category/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchControlDocCategoryId').val(dataItem.id);
        //     }
        // });

        // $('#searchControlResult').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: '/' + lang + '/dictionary/control_result/read'
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchControlResultId').val(dataItem.id);
        //     }
        // });

        // $('.addMore').click(function(e){
        //     e.preventDefault();
        //     var url = $(this).attr('dataTableName');
        //     currentInputNameControl = $(this).attr('dataName');
        //     currentInputIdControl = $(this).attr('dataId');
        //     $.fancybox({
        //         'type'  : 'iframe',
        //         'autoSize': false,
        //         'width'             : 800,
        //         'height'            : 600,
        //         'href'              : '/' + lang + '/autocomplete/'+url+'&type=control'
        //     });
        // });

        $('.eventTrigger').focusin(function(e){
            $('#searchControlResolution').focus();
        });

        $('.datePicker').focusout(function(e){
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
                            alert(`{{ __('content.enter_number') }}`);
                        }
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        if( c!= 'resetButton'){
                            alert(`{{ __('content.enter_number') }}`);
                        }
                    }else{
                    }
                }
            }
        });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#control_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#control_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        <?php if (isset($search_params)) { ?>
            $('#searchControlUnitId').val(`{{  $search_params['unit_id'][sizeof($search_params['unit_id'])-1] }}`);
            $('#searchControlUnit').val(`{{  html_entity_decode($search_params['unit_name']) }}`);
            $('#searchControlDocCategoryId').val(`{{  $search_params['doc_category_id'][sizeof($search_params['doc_category_id'])-1] }}`);
            $('#searchControlDocCategory').val(`{{  html_entity_decode($search_params['category_title']) }}`);
            $('#searchControlCreationDate').val(`{{  $search_params['creation_date'] }}`);
            $('#searchControlRegNum').val(`{{  html_entity_decode($search_params['reg_num'][sizeof($search_params['reg_num'])-1]) }}`);
            $('#searchControlRegDate').val(`{{  $search_params['reg_date'] }}`);
            $('#searchControlSnbDirector').val(`{{  html_entity_decode($search_params['snb_director'][sizeof($search_params['snb_director'])-1]) }}`);
            $('#searchControlSnbSubDirector').val(`{{  $search_params['snb_subdirector'][sizeof($search_params['snb_subdirector'])-1] }}`);
            $('#searchControlResolutionDate').val(`{{  $search_params['resolution_date'] }}`);
            $('#searchControlResolution').val(`{{  html_entity_decode($search_params['resolution'][sizeof($search_params['resolution'])-1]) }}`);
            $('#searchControlActUnitId').val(`{{  $search_params['act_unit_id'][sizeof($search_params['act_unit_id'])-1] }}`);
            $('#searchControlActUnit').val(`{{  html_entity_decode($search_params['act_unit_name']) }}`);
            $('#searchControlActorName').val(`{{  html_entity_decode($search_params['actor_name'][sizeof($search_params['actor_name'])-1]) }}`);
            $('#searchControlSubActUnitId').val(`{{  $search_params['sub_act_unit_id'][sizeof($search_params['sub_act_unit_id'])-1] }}`);
            $('#searchControlSubActUnit').val(`{{  html_entity_decode($search_params['sub_act_unit_name']) }}`);
            $('#controlSubActorName').val(`{{  html_entity_decode($search_params['sub_actor_name'][sizeof($search_params['sub_actor_name'])-1]) }}`);
            $('#searchControlResultId').val(`{{  $search_params['result_id'][sizeof($search_params['result_id'])-1] }}`);
            $('#searchControlResult').val(`{{  html_entity_decode($search_params['result_name']) }}`);
            $('#fileSearch').val(`{{  html_entity_decode($search_params['content']) }}`);
        <?php } ?>

    });

    function closeFControl(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameControl).val(name);
        $('#'+currentInputIdControl).val(id);
        var field = $('#'+currentInputIdControl).attr('name');
        $.fancybox.close();
    }

    function getText(){
        return  $('#'+currentInputIdControl).val();
    }

    function closeFancyText(text){
        $('#'+currentInputIdControl).val(text);
        $.fancybox.close();
    }

</script>

@endsection
@endsection
