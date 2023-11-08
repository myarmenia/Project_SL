@extends('layouts.include-app')

@section('include-css')
    <link href="{{ asset('assets/css/main/open-modal.css') }}" rel="stylesheet" />
@endsection

@section('content-include')

<a class="closeButton"></a>
<div class="inContent">
    <form id="bibliographyForm"  action="/{{ app()->getLocale() }}/simplesearch/result_bibliography" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="bibl_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="bibl_or" />
            <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
            <?php if(!isset($type)) { ?>
            <a href="" id="resetButton" class="k-button" >{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /><?php } ?>
        </div>

        <div class="forForm">
            <label for="searchBibleCreated">{{ __('content.date_and_time_date') }}</label>
            <input type="text" id="searchBibleCreated" name="created_at" style="width: 505px;" onkeydown="validateNumber(event ,'searchBibleCreated',12)" class="oneInputSaveEnter oneInputSaveDateBibliography" />
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblFromAgencyNameFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['from_agency_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblFromAgencyName">
                    <div class="item">
                        <span><?php echo $search_params['from_agency_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="from_agency_id[]" value="<?php echo $search_params['from_agency_id'][$i] ?>">
                    <input type="hidden" name="from_agency_idName[]" value="<?php echo $search_params['from_agency_idName'][$i] ?>">
                </li>
                <?php  } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="from_agency_id_type" id="searchBiblFromAgencyNameType" value="<?php echo $search_params['from_agency_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblFromAgencyName">{{ __('content.organ') }}</label>
            <input  type="button"
                    dataName="searchBiblFromAgencyName"
                    dataId="searchBiblFromAgencyNameId"
                    dataTableName="fancy/agency"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="agency"
                    />
            <input  type="text"
                    name="from_agency_name"
                    id="searchBiblFromAgencyName"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    firstItem="1"
                    dataInputId="searchBiblFromAgencyNameId"
                    dataTableName="agency"
                    list="agency"
                    />
            @if (isset($search_params['from_agency_id_type']) && $search_params['from_agency_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblFromAgencyNameOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['from_agency_id_type']) && $search_params['from_agency_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblFromAgencyNameOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['from_agency_id_type']) && $search_params['from_agency_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblFromAgencyNameOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="from_agency_id[]" id="searchBiblFromAgencyNameId" />
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblDocCatTitleFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['category_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblDocCatTitle">
                    <div class="item"><span><?php echo $search_params['category_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="category_id[]" value="<?php echo $search_params['category_id'][$i] ?>">
                    <input type="hidden" name="category_idName[]" value="<?php echo $value = $search_params['category_idName'][$i] ?>">
                </li>
                <?php  } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="category_id_type" id="searchBiblDocCatTitleType" value="<?php echo $search_params['category_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblDocCatTitle">{{ __('content.document_category') }}</label>
            <input  type="button"
                    dataName="searchBiblDocCatTitle"
                    dataId="searchBiblDocCatTitleId"
                    dataTableName="fancy/doc_category"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="doc_category"
                    />
            <input  type="text"
                    name="category_title"
                    id="searchBiblDocCatTitle"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    dataInputId="searchBiblDocCatTitleId"
                    dataTableName="doc_category"
                    list="doc_category"
                    />
            @if (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblDocCatTitleOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblDocCatTitleOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblDocCatTitleOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="category_id[]" id="searchBiblDocCatTitleId" />
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblAccessLevelNameFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['access_level_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblAccessLevelName">
                    <div class="item"><span><?php echo $search_params['access_level_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="access_level_id[]" value="<?php echo $search_params['access_level_id'][$i] ?>">
                    <input type="hidden" name="access_level_idName[]" value="<?php echo $search_params['access_level_idName'][$i] ?>">
                </li>
                <?php  } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="access_level_id_type" id="searchBiblAccessLevelNameType" value="<?php echo $search_params['access_level_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblAccessLevelName">{{ __('content.access_level') }}</label>
            <input  type="button"
                    dataName="searchBiblAccessLevelName"
                    dataId="searchBiblAccessLevelNameId"
                    dataTableName="fancy/access_level"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="access_level"
                    />
            <input  type="text"
                    name="access_level_name"
                    id="searchBiblAccessLevelName"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    dataInputId="searchBiblAccessLevelNameId"
                    dataTableName="access_level"
                    list="access_level"
                    />
           @if (isset($search_params['access_level_id_type']) && $search_params['access_level_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblAccessLevelNameOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['access_level_id_type']) && $search_params['access_level_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblAccessLevelNameOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['access_level_id_type']) && $search_params['access_level_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblAccessLevelNameOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="access_level_id[]" id="searchBiblAccessLevelNameId" />
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchRegNumberFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['reg_number'])-1 ; $i++ ) { ?>
                <li id="listItemsearchRegNumber">
                    <div class="item">
                        <span><?php echo $search_params['reg_number'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="reg_number[]" value="<?php echo $search_params['reg_number'][$i] ?>">
                </li>
                <?php  } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="reg_number_type" id="searchRegNumberType" value="<?php echo $search_params['reg_number_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchRegNumber">{{ __('content.reg_document') }}</label>
            <input type="text" id="searchRegNumber" name="reg_number[]" class="oneInputSave oneInputSaveEnter" />
            <select name="reg_number_distance" style="display: block" class="distance distance_searchRegNumber" aria-label="Default select example">
                <option value="" >Ընտրել չափը</option>
                <option value="1">100% Համընկնում</option>
                <option value="2">80%-100% Համընկնում</option>
                <option value="3">50%-100% Համընկնում</option>
            </select>
            @if (isset($search_params['reg_number_type']) && $search_params['reg_number_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchRegNumberOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['reg_number_type']) && $search_params['reg_number_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchRegNumberOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['reg_number_type']) && $search_params['reg_number_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchRegNumberOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <div class="forForm">
            <label for="searchBiblSourceDate">{{ __('content.date_reg') }}</label>
            <input type="text" id="searchBiblSourceDate" name="reg_date" style="width: 505px;" onkeydown="validateNumber(event ,'searchBiblSource',12)" class="oneInputSaveEnter oneInputSaveDateBibliography" />
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblWorkerNameFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['worker_name'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblWorkerName">
                    <div class="item">
                        <span><?php echo $search_params['worker_name'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div><input type="hidden" name="worker_name[]" value="<?php echo $search_params['worker_name'][$i] ?>">
                </li>
                <?php  } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="worker_name_type" id="searchBiblWorkerNameType" value="?= $search_params['worker_name_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblWorkerName">{{ __('content.worker_take_doc') }}</label>
            <input type="text" name="worker_name[]" id="searchBiblWorkerName" class="oneInputSave oneInputSaveEnter" />
            <select name="worker_name_distance" style="display: block" class="distance distance_searchBiblWorkerName" aria-label="Default select example">
                <option value="" >Ընտրել չափը</option>
                <option value="1">100% Համընկնում</option>
                <option value="2">80%-100% Համընկնում</option>
                <option value="3">50%-100% Համընկնում</option>
            </select>
            @if (isset($search_params['worker_name_type']) && $search_params['worker_name_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblWorkerNameOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['worker_name_type']) && $search_params['worker_name_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblWorkerNameOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['worker_name_type']) && $search_params['worker_name_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblWorkerNameOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblSourceAgencyNameFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['source_agency_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblSourceAgencyName">
                    <div class="item">
                        <span><?php echo $search_params['source_agency_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="source_agency_id[]" value="<?php echo $search_params['source_agency_id'][$i] ?>">
                    <input type="hidden" name="source_agency_idName[]" value="<?php echo $search_params['source_agency_idName'][$i] ?>">
                </li>
                <?php  } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="source_agency_id_type" id="searchBiblSourceAgencyNameType" value="<?php echo $search_params['source_agency_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblSourceAgencyName">{{ __('content.source_agency') }}</label>
            <input  type="button"
                    dataName="searchBiblSourceAgencyName"
                    dataId="searchBiblSourceAgencyNameId"
                    dataTableName="fancy/agency"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="agency"
                    />
            <input  type="text"
                    name="source_agency_name"
                    id="searchBiblSourceAgencyName"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    dataInputId="searchBiblSourceAgencyNameId"
                    dataTableName="agency"
                    list="agency"
                    />
            @if (isset($search_params['source_agency_id_type']) && $search_params['source_agency_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblSourceAgencyOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['source_agency_id_type']) && $search_params['source_agency_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblSourceAgencyOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['source_agency_id_type']) && $search_params['source_agency_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblSourceAgencyOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="source_agency_id[]" id="searchBiblSourceAgencyNameId" />
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblSourceAddressFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['source_address'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblSourceAddress">
                    <div class="item">
                        <span><?php echo $search_params['source_address'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="source_address[]" value="<?php echo $search_params['source_address'][$i] ?>">
                </li>
                <?php  } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="source_address_type" id="searchBiblSourceAddressType" value="<?php echo $search_params['source_address_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblSourceAddress">{{ __('content.source_address') }}</label>
            <input type="text" name="source_address[]" id="searchBiblSourceAddress" class="oneInputSave oneInputSaveEnter" />
            <select name="source_address_distance" style="display: block" class="distance distance_searchBiblSourceAddress" aria-label="Default select example">
                <option value="" >Ընտրել չափը</option>
                <option value="1">100% Համընկնում</option>
                <option value="2">80%-100% Համընկնում</option>
                <option value="3">50%-100% Համընկնում</option>
            </select>
            @if (isset($search_params['source_address_type']) && $search_params['source_address_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblSourceAddressOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['source_address_type']) && $search_params['source_address_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblSourceAddressOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['source_address_type']) && $search_params['source_address_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblSourceAddressOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblShortDescFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['short_desc'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblShortDesc">
                    <div class="item">
                        <span><?php echo $search_params['short_desc'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="short_desc[]" value="<?php echo $search_params['short_desc'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="short_desc_type" id="searchBiblShortDescType" value="<?php echo $search_params['short_desc_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblShortDesc">{{ __('content.short_desc') }}</label>
            <input type="text" id="searchBiblShortDesc" name="short_desc[]" class="oneInputSave oneInputSaveEnter" />
            <select name="short_desc_distance" style="display: block" class="distance distance_searchBiblShortDesc" aria-label="Default select example">
                <option value="" >Ընտրել չափը</option>
                <option value="1">100% Համընկնում</option>
                <option value="2">80%-100% Համընկնում</option>
                <option value="3">50%-100% Համընկնում</option>
            </select>
            @if (isset($search_params['short_desc_type']) && $search_params['short_desc_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblShortDescOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['short_desc_type']) && $search_params['short_desc_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblShortDescOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['short_desc_type']) && $search_params['short_desc_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblShortDescOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblRelatedYearFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['related_year'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblRelatedYear">
                    <div class="item">
                        <span><?php echo $search_params['related_year'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="related_year[]" value="<?php echo $search_params['related_year'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="related_year_type" id="searchBiblRelatedYearType" value="<?php echo $search_params['related_year_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblRelatedYear">{{ __('content.related_year') }}</label>
            <input type="text" id="searchBiblRelatedYear" name="related_year[]" onkeydown="validateNumber(event ,'searchBiblRelatedYear',4)" class="oneInputSave oneInputSaveEnter" />
            <select name="related_year_distance" style="display: block" class="distance distance_searchBiblRelatedYear" aria-label="Default select example">
                <option value="" >Ընտրել չափը</option>
                <option value="1">100% Համընկնում</option>
                <option value="2">80%-100% Համընկնում</option>
                <option value="3">50%-100% Համընկնում</option>
            </select>
            @if (isset($search_params['related_year_type']) && $search_params['related_year_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblRelatedYearOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['related_year_type']) && $search_params['related_year_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblRelatedYearOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['related_year_type']) && $search_params['related_year_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblRelatedYearOp">{{ __('content.not_eqaul') }}</span>
            @endif
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblSourceFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['source'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblSource">
                    <div class="item">
                        <span><?php echo $search_params['source'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="source[]" value="<?php echo $search_params['source'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="source_type" id="searchBiblSourceType" value="<?php echo $search_params['source_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblSource">{{ __('content.source_inf') }}</label>
            <input type="text" id="searchBiblSource" name="source[]" class="oneInputSave oneInputSaveEnter" />
            <select name="source_distance" style="display: block" class="distance distance_searchBiblSource" aria-label="Default select example">
                <option value="" >Ընտրել չափը</option>
                <option value="1">100% Համընկնում</option>
                <option value="2">80%-100% Համընկնում</option>
                <option value="3">50%-100% Համընկնում</option>
            </select>
            @if (isset($search_params['source_type']) && $search_params['source_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblSourceOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['source_type']) && $search_params['source_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblSourceOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['source_type']) && $search_params['source_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblSourceOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblCountryFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['country_id'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblCountry">
                    <div class="item">
                        <span><?php echo $search_params['country_idName'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="country_id[]" value="<?php echo $search_params['country_id'][$i] ?>">
                    <input type="hidden" name="country_idName[]" value="<?php echo $search_params['country_idName'][$i] ?>">
                </li>
                <?php  } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="country_id_type" id="searchBiblCountryType" value="<?php echo $search_params['country_id_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblCountry">{{ __('content.information_country') }}</label>
            <input  type="button"
                    dataName="searchBiblCountry"
                    dataId="searchBiblCountryId"
                    dataTableName="fancy/country"
                    class="addMore k-icon k-i-plus my-plus-class"
                    data-bs-toggle="modal"
                    data-bs-target="#fullscreenModal"
                    data-fieldname="name"
                    data-table-name="country"
                    />
            <input  type="text"
                    name="country"
                    id="searchBiblCountry"
                    class="oneInputSaveEnter fetch_input_title get_datalist"
                    dataInputId="searchBiblCountryId"
                    dataTableName="country"
                    list="country"
                    />
            @if (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblCountryOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblCountryOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['country_id_type']) && $search_params['country_id_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblCountryOp">{{ __('content.not_equal') }}</span>
            @endif
            <input type="hidden" name="country_id[]" id="searchBiblCountryId" />
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblThemeFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['theme'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblTheme">
                    <div class="item">
                        <span><?php echo $search_params['theme'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="theme[]" value="<?php echo $search_params['theme'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="theme_type" id="searchBiblThemeType" value="<?php echo $search_params['theme_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblTheme">{{ __('content.name_subject') }}</label>
            <input type="text" id="searchBiblTheme" name="theme[]" class="oneInputSave oneInputSaveEnter"  />
            <select name="theme_distance" style="display: block" class="distance distance_searchBiblTheme" aria-label="Default select example">
                <option value="" >Ընտրել չափը</option>
                <option value="1">100% Համընկնում</option>
                <option value="2">80%-100% Համընկնում</option>
                <option value="3">50%-100% Համընկնում</option>
            </select>
            @if (isset($search_params['theme_type']) && $search_params['theme_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblThemeOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['theme_type']) && $search_params['theme_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblThemeOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['theme_type']) && $search_params['theme_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblThemeOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params)) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchBiblTitleFilter" style="border: none;">
                <?php for($i=0 ; $i < sizeof($search_params['title'])-1 ; $i++ ) { ?>
                <li id="listItemsearchBiblTitle">
                    <div class="item">
                        <span><?php echo $search_params['title'][$i] ?></span>
                        <a class="deleteMultiSearch">x</a>
                    </div>
                    <input type="hidden" name="title[]" value="<?php echo $search_params['title'][$i] ?>">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="title_type" id="searchBiblTitleType" value="<?php echo $search_params['title_type'] ?>">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="searchBiblTitle">{{ __('content.title_document') }}</label>
            <input type="text" id="searchBiblTitle" name="title[]" class="oneInputSave oneInputSaveEnter" lastItem="1" />
            <select name="title_distance" style="display: block" class="distance distance_searchBiblTitle" aria-label="Default select example">
                <option value="" >Ընտրել չափը</option>
                <option value="1">100% Համընկնում</option>
                <option value="2">80%-100% Համընկնում</option>
                <option value="3">50%-100% Համընկնում</option>
            </select>
            @if (isset($search_params['title_type']) && $search_params['title_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblTitleOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['title_type']) && $search_params['title_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblTitleOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['title_type']) && $search_params['title_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchBiblTitleOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        <?php if (isset($search_params) && isset($search_params['user_id'])) { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul style="border: none;" id="searchBiblUser" class="filterlist">
                <?php for($i=0 ; $i < sizeof($search_params['user_id']) ; $i++ ) { ?>
                <li id="listItemsearchBiblUser4">
                    <div class="item">
                        <span><?php echo $search_params['user_id_name'][$i] ?></span>
                        <a user_id="4" text="<?php echo $search_params['user_id_name'][$i] ?>" class="deleteMultiSearchOption">x</a>
                    </div>
                    <input type="hidden" value="<?php echo $search_params['user_id'][$i] ?>" name="user_id[]">
                    <input type="hidden" value="<?php echo $search_params['user_id_name'][$i] ?>" name="user_id_name[]">
                </li>
                <?php } ?>
            </ul>
            <input type="hidden" readonly="readonly" class="oneInputSaveEnter" value="">
        </div>
        <?php } else { ?>
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul style="border: none;" id="searchBiblUser" class="filterlist">
            </ul>
            <input type="hidden" readonly="readonly" class="oneInputSaveEnter">
        </div>
        <?php } ?>
        <div class="forForm">
            <label for="biblUserName">{{ __('content.created_user') }}</label>
            <select name="user_idold" id="userId">
                <option value="">...</option>
                @foreach($users as $user )
                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="forForm">
            <label for="fileSearch">{{ __('content.file_search') }}</label>
            <input type="text" name="content" id="fileSearch"/>
        </div>

        <div class="buttons">

        </div>
    </form>
</div>

<div id="resetForm">
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
    var currentInputNameBibl;
    var currentInputIdBibl;
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });

        showHideDistance('searchRegNumber','distance_searchRegNumber');
        showHideDistance('searchBiblWorkerName','distance_searchBiblWorkerName');
        showHideDistance('searchBiblSourceAddress','distance_searchBiblSourceAddress');
        showHideDistance('searchBiblShortDesc','distance_searchBiblShortDesc');
        showHideDistance('searchBiblRelatedYear','distance_searchBiblRelatedYear');
        showHideDistance('searchBiblSource','distance_searchBiblSource');
        showHideDistance('searchBiblTheme','distance_searchBiblTheme');
        showHideDistance('searchBiblTitle','distance_searchBiblTitle');

        $('#userId').live('change',function(e){
            var user_id = $(this).val();
            if(user_id){
                var text = $("#userId option[value='"+user_id+"']").text();
                $('#searchBiblUser').append('<li id="listItemsearchBiblUser'+user_id+'">'+
                        '<div class="item">'+
                        '<span>'+text+'</span>'+
                        '<a user_id="'+user_id+'" text="'+text+'" class="deleteMultiSearchOption">x</a>'+
                        '</div>' +
                        '<input type="hidden" value="'+user_id+'" name="user_id[]">'+
                        '<input type="hidden" value="'+text+'" name="user_id_name[]">'+
                        '</li>');
            }
            $("#userId option[value='"+user_id+"']").remove();
        });

        $('.deleteMultiSearchOption').live('click',function(e){
            e.preventDefault();
            var user_id = $(this).attr('user_id');
            var text = $(this).attr('text');
            $('#listItemsearchBiblUser'+user_id).remove();
            $('#userId').append('<option value="'+user_id+'">'+text+'</option>')
        });

        searchMultiSelectMaker( 'searchRegNumber' , 'reg_number' );
        searchMultiSelectMaker( 'searchBiblWorkerName' , 'worker_name' );
        searchMultiSelectMaker( 'searchBiblSourceAddress' , 'source_address' );
        searchMultiSelectMaker( 'searchBiblShortDesc' , 'short_desc' );
        searchMultiSelectMaker( 'searchBiblRelatedYear' , 'related_year' );
        searchMultiSelectMaker( 'searchBiblSource' , 'source' );
        searchMultiSelectMaker( 'searchBiblTheme' , 'theme' );
        searchMultiSelectMaker( 'searchBiblTitle' , 'title' );

        searchMultiSelectMakerAutoComplete( 'searchBiblFromAgencyName' , 'from_agency_id' );
        searchMultiSelectMakerAutoComplete( 'searchBiblDocCatTitle' , 'category_id' );
        searchMultiSelectMakerAutoComplete( 'searchBiblAccessLevelName' , 'access_level_id' );
        searchMultiSelectMakerAutoComplete( 'searchBiblSourceAgencyName' , 'source_agency_id' );
        searchMultiSelectMakerAutoComplete( 'searchBiblCountry' , 'country_id' );

        $('.oneInputSaveDateBibliography').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        // $('#searchBiblFromAgencyName').kendoAutoComplete({
        //     dataTextField: "name",
        //     filter: "contains",
        //     minLength: 3,
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/agency/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchBiblFromAgencyNameId').val(dataItem.id);
        //     }
        // });

        // $('#searchBiblDocCatTitle').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/doc_category/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchBiblDocCatTitleId').val(dataItem.id);
        //     }
        // });

        // $('#searchBiblAccessLevelName').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/access_level/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchBiblAccessLevelNameId').val(dataItem.id);
        //     }
        // });

        // $('#searchBiblSourceAgencyName').kendoAutoComplete({
        //     dataTextField: "name",
        //     filter: "contains",
        //     minLength: 3,
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/agency/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchBiblSourceAgencyNameId').val(dataItem.id);
        //     }
        // });

        // $('#searchBiblCountry').kendoAutoComplete({
        //     dataTextField: "name",
        //     dataSource: {
        //         transport: {
        //             read:{
        //                 dataType: "json",
        //                 url: `/${lang}/dictionary/country/read`
        //             }
        //         }
        //     },
        //     select:function(e){
        //         var dataItem = this.dataItem(e.item.index());
        //         $('#searchBiblCountryId').val(dataItem.id);
        //     }
        // });

        // $('.addMore').click(function(e){
        //     e.preventDefault();
        //     var url = $(this).attr('dataTableName');
        //     currentInputNameBibl = $(this).attr('dataName');
        //     currentInputIdBibl = $(this).attr('dataId');
        //     $.fancybox({
        //         'type'  : 'iframe',
        //         'autoSize': false,
        //         'width'             : 800,
        //         'height'            : 600,
        //         'href'              : `/${lang}/autocomplete/`+url+"&type=bibl"
        //     });
        // });

        $('.oneInputSaveEnter').focusout(function(e){
            e.preventDefault();
            var test = $(this).attr('id');
            if(typeof test != 'undefined'){
                searchInput = test;
            }
        });

        $('#bibl_and').click(function(e){
            var ff = $.Event("keypress");
            ff.charCode = 38;
            $("#"+searchInput).trigger(ff);
            $('#'+searchInput).focus();
        });

        $('#bibl_or').click(function(e){
            var ee = $.Event("keypress");
            ee.charCode = 124;
            $("#"+searchInput).trigger(ee);
            $('#'+searchInput).focus();
        });

        $('.oneInputSaveDateBibliography').focusout(function(e){
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

        <?php if (isset($search_params)) { ?>
            $('#searchBibleCreated').val(`{{ $search_params['created_at'] }}`);
            $('#searchBiblFromAgencyName').val(`{{ html_entity_decode($search_params['from_agency_name']) }}`);
            $('#searchBiblFromAgencyNameId').val(`{{ $search_params['from_agency_id'][sizeof($search_params['from_agency_id'])-1] }}`);
            $('#searchBiblAccessLevelName').val(`{{ html_entity_decode($search_params['access_level_name']) }}`);
            $('#searchBiblAccessLevelNameId').val(`{{ $search_params['access_level_id'][sizeof($search_params['access_level_id'])-1] }}`);
            $('#searchBiblDocCatTitle').val(`{{ html_entity_decode($search_params['category_title']) }}`);
            $('#searchBiblDocCatTitleId').val(`{{ $search_params['category_id'][sizeof($search_params['category_id'])-1] }}`);
            $('#searchRegNumber').val(`{{ html_entity_decode($search_params['reg_number'][sizeof($search_params['reg_number'])-1]) }}`);
            $('#searchBiblWorkerName').val(`{{ html_entity_decode($search_params['worker_name'][sizeof($search_params['worker_name'])-1]) }}`);
            $('#searchBiblSourceAddress').val(`{{ html_entity_decode($search_params['source_address'][sizeof($search_params['source_address'])-1]) }}`);
            $('#searchBiblShortDesc').val(`{{ html_entity_decode($search_params['short_desc'][sizeof($search_params['short_desc'])-1]) }}`);
            $('#searchBiblRelatedYear').val(`{{ html_entity_decode($search_params['related_year'][sizeof($search_params['related_year'])-1]) }}`);
            $('#searchBiblSource').val(`{{ html_entity_decode($search_params['source'][sizeof($search_params['source'])-1]) }}`);
            $('#searchBiblTheme').val(`{{ html_entity_decode($search_params['theme'][sizeof($search_params['theme'])-1]) }}`);
            $('#searchBiblTitle').val(`{{ html_entity_decode($search_params['title'][sizeof($search_params['title'])-1]) }}`);
            $('#searchBiblSourceDate').val(`{{ $search_params['reg_date'] }}`);
            $('#searchBiblSourceAgencyName').val(`{{ html_entity_decode($search_params['source_agency_name']) }}`);
            $('#searchBiblSourceAgencyNameId').val(`{{ $search_params['source_agency_id'][0] }}`);
            $('#searchBiblCountry').val(`{{ html_entity_decode($search_params['country']) }}`);
            $('#fileSearch').val(`{{ html_entity_decode($search_params['content']) }}`);
            $('#searchBiblCountryId').val(`{{ $search_params['country_id'][sizeof($search_params['country_id'])-1] }}`);
        <?php } ?>
    });



    function closeFBibl(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameBibl).val(name);
        $('#'+currentInputIdBibl).val(id);
        var field = $('#'+currentInputIdBibl).attr('name');

        $.fancybox.close();
    }



</script>


@endsection
@endsection
