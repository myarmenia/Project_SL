@extends('layouts.include-app')

@section('content-include')

<a class="closeButton"></a>
<div class="inContent">
    <form id="carForm" action="/{{ app()->getLocale() }}/simplesearch/result_car" method="post">

        <div class="buttons">
            <input type="button" class="k-button" value="{{ __('content.and') }}" id="car_and" />
            <input type="button" class="k-button" value="{{ __('content.or') }}" id="car_or" />
            @if(!isset($type))
                <a href="" id="resetButton"  class="k-button" >{{ __('content.reset') }}</a>
                <input type="submit" class="k-button" name="submit" value="{{ __('content.search') }}" />
            @endif
        </div>

        @if (isset($search_params) && isset($search_params['category_id']))
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchCarCategoryFilter" style="border: none;">
                    @for($i=0 ; $i < sizeof($search_params['category_id'])-1 ; $i++ )
                        <li id="listItemsearchCarCategory">
                            <div class="item">
                                <span>{{ $search_params['category_idName'][$i] }}</span>
                                <a class="deleteMultiSearch">x</a>
                            </div>
                            <input type="hidden" name="category_id[]" value="{{ $search_params['category_id'][$i] }} ">
                            <input type="hidden" name="category_idName[]" value="{{ $search_params['category_idName'][$i] }}">
                        </li>
                    @endfor
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="category_id_type" id="searchCarCategoryType" value=" {{ $search_params['category_id_type'] }}">
        </div>
        @endif
        <div class="forForm">
            <label for="searchCarCategory">{{ __('content.car_cat') }}</label>
            <input type="button" dataName="searchCarCategory" dataId="searchCarCategoryId" dataTableName="fancy/car_category" class="addMore k-icon k-i-plus"   />
            <input type="text" name="category" id="searchCarCategory" dataInputId="searchCarCategoryId" dataTableName="car_category" class="oneInputSaveEnter"/>
            @if (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'OR')
              <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCategoryOp">ИЛИ</span>
            @elseif (isset($search_params['category_id_type']) && $search_params['category_id_type'] == 'AND')
              <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCategoryOp">И</span>
            @endif
            <input type="hidden" name="category_id[]" id="searchCarCategoryId" />
        </div>

        @if (isset($search_params) && isset($search_params['mark_id']))
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchCarViewFilter" style="border: none;">
                    @for($i=0 ; $i < sizeof($search_params['mark_id'])-1 ; $i++ )
                        <li id="listItemsearchCarView">
                            <div class="item">
                                <span>{{ $search_params['mark_idName'][$i] }}</span>
                                <a class="deleteMultiSearch">x</a>
                            </div>
                            <input type="hidden" name="mark_id[]" value="{{ $search_params['mark_idName'][$i] }}">
                            <input type="hidden" name="mark_idName[]" value="{{ $search_params['mark_idName'][$i] }}">
                        </li>
                    @endfor
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="mark_id_type" id="searchCarViewType" value="{{ $search_params['category_idName'] }} ">
            </div>
        @endif
        <div class="forForm">
            <label for="searchCarView">{{ __('content.mark') }}</label>
            <input type="button" dataName="searchCarView" dataId="searchCarViewId" dataTableName="fancy/car_mark" class="addMore k-icon k-i-plus"   />
            <input type="text" name="mark" id="searchCarView" dataInputId="searchCarViewId" dataTableName="car_mark" class="oneInputSaveEnter"/>
            @if (isset($search_params['mark_id_type']) && $search_params['mark_id_type'] == 'OR')
                 <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarViewOp">ИЛИ</span>
            @elseif (isset($search_params['mark_id_type']) && $search_params['mark_id_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarViewOp">И</span>
            @endif
            <input type="hidden" name="mark_id[]" id="searchCarViewId" />
        </div>

        @if (isset($search_params) && isset($search_params['color']))
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCarColorFilter" style="border: none;">
                @for($i=0 ; $i < sizeof($search_params['color'])-1 ; $i++ )
                    <li id="listItemsearchCarColor">
                        <div class="item">
                            <span>{{ $search_params['color'][$i] }}</span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="color[]" value="{{ $search_params['color'][$i] }}">
                    </li>
                @endfor
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="color_type" id="searchCarColorType" value="{{ $search_params['color_type'] }}">
        </div>
        @endif
        <div class="forForm">
            <label for="searchCarColor">{{ __('content.color') }}</label>
            <input  type="text" name="color[]" id="searchCarColor" class="oneInputSaveEnter" />
            @if (isset($search_params['color_type']) && $search_params['color_type'] == 'OR')
              <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarColorOp">ИЛИ</span>
            @elseif (isset($search_params['color_type']) && $search_params['color_type'] == 'AND')
              <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarColorOp">И</span>
            @endif
        </div>

        @if (isset($search_params) && isset($search_params['number']))
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchCarCarNumberFilter" style="border: none;">
                @for($i=0 ; $i < sizeof($search_params['number'])-1 ; $i++ )
                    <li id="listItemsearchCarCarNumber">
                        <div class="item">
                            <span>{{ $search_params['number'][$i] }}</span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="number[]" value="{{ $search_params['number'][$i] }}">
                    </li>
                @endfor
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="number_type" id="searchCarCarNumberType" value="{{ $search_params['number_type'] }}">
            </div>
        @endif
        <div class="forForm">
            <label for="searchCarCarNumber">{{ __('content.car_number') }}</label>
            <input class="oneInputSaveEnter" type="text" name="number[]" id="searchCarCarNumber"/>
            @if (isset($search_params['number_type']) && $search_params['number_type'] == 'OR')
             <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCarNumberOp">ИЛИ</span>
            @elseif (isset($search_params['number_type']) && $search_params['number_type'] == 'AND')
             <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCarNumberOp">И</span>
            @endif
        </div>

        @if (isset($search_params) && isset($search_params['count']))
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchCarCountFilter" style="border: none;">
                @for($i=0 ; $i < sizeof($search_params['count'])-1 ; $i++ )
                    <li id="listItemsearchCarCount">
                        <div class="item">
                            <span>{{ $search_params['count'][$i] }}</span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="count[]" value="{{ $search_params['count'][$i] }}">
                    </li>
                @endfor
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="count_type" id="searchCarCountType" value="{{ $search_params['count_type'] }}">
            </div>
        @endif
        <div class="forForm">
            <label for="searchCarCount">{{ __('content.count') }}</label>
            <input class="oneInputSaveEnter" onkeydown="validateNumber(event,'searchCarCount',20)" type="text" name="count[]" id="searchCarCount"/>
            @if (isset($search_params['count_type']) && $search_params['count_type'] == 'OR')
               <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCountOp">ИЛИ</span>
            @elseif (isset($search_params['count_type']) && $search_params['count_type'] == 'AND')
               <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarCountOp">И</span>
            @endif
        </div>

        @if (isset($search_params) && isset($search_params['note']))
        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="searchCarAdditionalDataFilter" style="border: none;">
                @for($i=0 ; $i < sizeof($search_params['note'])-1 ; $i++ )
                    <li id="listItemsearchCarAdditionalData">
                        <div class="item">
                            <span>{{ $search_params['note'][$i] }}</span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="note[]" value="{{ $search_params['note'][$i] }}">
                    </li>
                @endfor
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
            <input type="hidden" name="note_type" id="searchCarAdditionalDataType" value="{{ $search_params['note_type'] }}">
        </div>
        @endif
        <div class="forForm">
            <label for="searchCarAdditionalData">{{ __('content.additional_data') }}</label>
            <input class="oneInputSaveEnter" type="text" name="note[]" id="searchCarAdditionalData" />
            @if (isset($search_params['note_type']) && $search_params['note_type'] == 'OR')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarAdditionalDataOp">ИЛИ</span>
            @elseif (isset($search_params['note_type']) && $search_params['note_type'] == 'AND')
                <span style="width: 30px;;position: absolute;margin-left: -570px;" id="searchCarAdditionalDataOp">И</span>
            @endif
        </div>

        <div class="forForm">
            <label for="fileSearch">{{ __('content.file_search') }}</label>
            <input type="text" name="content" id="fileSearch"/>
        </div>

        <div class="buttons">

        </div>

    </form>
</div>

@section('js-include')
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
                        url:'/' + lang + '/dictionary/car_category/read'
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
                        url: '/' + lang + '/dictionary/car_mark/read'
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
                'href'              : '/' + lang + '/autocomplete/'+url+'&type=car'
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

        @if (isset($search_params))
            $('#searchCarCategory').val(`{{ html_entity_decode($search_params['category'])}}`);
            $('#searchCarCategoryId').val(`{{ $search_params['category_id'][sizeof($search_params['category_id'])-1] }}`);
            $('#searchCarViewId').val(`{{ $search_params['mark_id'][sizeof($search_params['mark_id'])-1] }}`);
            $('#searchCarView').val(`{{ html_entity_decode($search_params['mark']) }}`);
            $('#searchCarColor').val(`{{ html_entity_decode($search_params['color'][sizeof($search_params['color'])-1]) }}`);
            $('#searchCarCarNumber').val(`{{ html_entity_decode($search_params['number'][sizeof($search_params['number'])-1]) }}`);
            $('#searchCarCount').val(`{{ html_entity_decode($search_params['count'][sizeof($search_params['count'])-1]) }}`);
            $('#searchCarAdditionalData').val(`{{ $search_params['note'][sizeof($search_params['note'])-1] }}`);
            $('#fileSearch').val(`{{ html_entity_decode($search_params['content']) }}`);
        @endif

    });

    function closeFCar(name,id){
        //        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameCar).val(name);
        $('#'+currentInputIdCar).val(id);
        var field = $('#'+currentInputIdCar).attr('name');

        $.fancybox.close();
    }


</script>

@endsection
@endsection


