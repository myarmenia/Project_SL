@extends('layouts.include-app')

@section('content-include')

<a class="closeButton"></a>
<div class="inContent">
    <form id="weaponForm" action="/{{ app()->getLocale() }}/simplesearch/result_weapon" method="post">
        @if(!empty($checkUrl) && $checkUrl !== 'advancedsearch')
            <x-back-previous-url />
        @endif
        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="weapon_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="weapon_or" />
            <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
            <?php if(!isset($type)) { ?>
            <a href="{{ route('simple_search_weapon',['n'=> 't']) }}" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
            <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" /><?php } ?>
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
            <label for="searchWeaponCategory">{{ __('content.weapon_cat') }}</label>
            <input type="text" name="category[]" id="searchWeaponCategory" class="oneInputSaveEnter" />

            <x-select-distance name="category_distance" class="distance distance_searchWeaponCategory"/>

            @if (isset($search_params['category_type']) && $search_params['category_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponCategoryOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['category_type']) && $search_params['category_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponCategoryOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['category_type']) && $search_params['category_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponCategoryOp">{{ __('content.not_equal') }}</span>
            @endif
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
            <label for="searchWeaponView">{{ __('content.view') }}</label>
            <input type="text" name="view[]" id="searchWeaponView" class="oneInputSaveEnter" />

            <x-select-distance name="view_distance" class="distance distance_searchWeaponView"/>

            @if (isset($search_params['view_type']) && $search_params['view_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponViewOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['view_type']) && $search_params['view_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponViewOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['view_type']) && $search_params['view_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponViewOp">{{ __('content.not_equal') }}</span>
            @endif
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
            <label for="searchWeaponType">{{ __('content.type') }}</label>
            <input type="text" name="type[]" id="searchWeaponType" class="oneInputSaveEnter" />

            <x-select-distance name="type_distance" class="distance distance_searchWeaponType"/>

            @if (isset($search_params['type_type']) && $search_params['type_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponTypeOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['type_type']) && $search_params['type_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponTypeOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['type_type']) && $search_params['type_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponTypeOp">{{ __('content.not_equal') }}</span>
            @endif
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
            <label for="searchWeaponMark">{{ __('content.mark') }}</label>
            <input type="text" name="model[]"  id="searchWeaponMark" class="oneInputSaveEnter" />

            <x-select-distance name="model_distance" class="distance distance_searchWeaponMark"/>

            @if (isset($search_params['model_type']) && $search_params['model_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponMarkOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['model_type']) && $search_params['model_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponMarkOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['model_type']) && $search_params['model_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponMarkOp">{{ __('content.not_equal') }}</span>
            @endif
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
            <label for="searchWeaponAccountNumber">{{ __('content.account_number') }}</label>
            <input type="text" name="reg_num[]" id="searchWeaponAccountNumber" class="oneInputSaveEnter" />

            <x-select-distance name="reg_num_distance" class="distance distance_searchWeaponAccountNumber"/>

            @if (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponAccountNumberOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponAccountNumberOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['reg_num_type']) && $search_params['reg_num_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponAccountNumberOp">{{ __('content.not_equal') }}</span>
            @endif
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
            <label for="searchWeaponCount">{{ __('content.count') }}</label>
            <input type="text" name="count[]" id="searchWeaponCount" onkeydown="validateNumber(event,'searchWeaponCount',12)" class="oneInputSaveEnter"/>
            @if (isset($search_params['count_type']) && $search_params['count_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponCountOp">{{ __('content.or') }}</span>
            @elseif (isset($search_params['count_type']) && $search_params['count_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponCountOp">{{ __('content.and') }}</span>
            @elseif (isset($search_params['count_type']) && $search_params['count_type'] == 'NOT')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchWeaponCountOp">{{ __('content.not_equal') }}</span>
            @endif
        </div>

        {{-- <div class="forForm">
            <label for="fileSearch">{{ __('content.file_search') }}</label>
            <input type="text" name="content" id="fileSearch"/>
            <x-select-distance name="content_distance" class="distance distance_fileSearch"/>
        </div> --}}

        <div class="buttons">

        </div>

    </form>
</div>

@section('js-include')

<script>
    var searchInput;

    $(document).ready(function(){

        $('input').map(function(){
            if($(this).hasClass('oneInputSaveEnter')){
                $(this).val('');
            }
        });
        showHideDistance('fileSearch','distance_fileSearch');

        showHideDistance('searchWeaponCategory','distance_searchWeaponCategory');
        showHideDistance('searchWeaponView','distance_searchWeaponView');
        showHideDistance('searchWeaponType','distance_searchWeaponType');
        showHideDistance('searchWeaponMark','distance_searchWeaponMark');
        showHideDistance('searchWeaponAccountNumber','distance_searchWeaponAccountNumber');

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
            $('#searchWeaponCategory').val(`{{ html_entity_decode($search_params['category'][sizeof($search_params['category'])-1]) }}`);
            $('#searchWeaponView').val(`{{ html_entity_decode($search_params['view'][sizeof($search_params['view'])-1]) }}`);
            $('#searchWeaponType').val(`{{ html_entity_decode($search_params['type'][sizeof($search_params['type'])-1]) }}`);
            $('#searchWeaponMark').val(`{{ html_entity_decode($search_params['model'][sizeof($search_params['model'])-1]) }}`);
            $('#searchWeaponAccountNumber').val(`{{ html_entity_decode($search_params['reg_num'][sizeof($search_params['reg_num'])-1]) }}`);
            $('#searchWeaponCount').val(`{{ html_entity_decode($search_params['count'][sizeof($search_params['count'])-1]) }}`);
        <?php } ?>
    });

</script>

@endsection
@endsection
