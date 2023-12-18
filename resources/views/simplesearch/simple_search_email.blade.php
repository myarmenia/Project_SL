@extends('layouts.include-app')

@section('content-include')


    <a class="closeButton">
        {{-- <i class="bi bi-x-square" style="font-size: 26px;"></i> --}}
    </a>
    <div class="inContent">
        <form id="emailForm" action="/{{ app()->getLocale() }}/simplesearch/result_email" method="post">
            @csrf
            @if(!empty($checkUrl) && $checkUrl !== 'advancedsearch')
                <x-back-previous-url />
            @endif
            <div class="buttons">

                <input type="button" class="k-button" value="{{ __('content.and') }}" id="email_and" />
                <input type="button" class="k-button" value="{{ __('content.or') }}" id="email_or" />
                <input type="button" class="k-button" value="{{ __('content.not_equal') }}" id="not_equal" />
                <?php if(!isset($type)) { ?>

                <a href="/{{ app()->getLocale() }}/simplesearch/simple_search_email?n=t" id="resetButton"
                    class="k-button">{{ __('content.reset') }}</a>
                <input type="submit" class="k-button" name="submit"
                    value="{{ __('content.search') }}" /><?php } ?>
            </div>


            <?php if (isset($search_params) && isset($search_params['address'])) { ?>
            <div style="width: 100%;text-align: right;top:14px;position: relative;">
                <ul class="filterlist" id="searchEmailEmailFilter" style="border: none;">
                    <?php for($i=0 ; $i < sizeof($search_params['address'])-1 ; $i++ ) { ?>
                    <li id="listItemsearchEmailEmail">
                        <div class="item">
                            <span><?php echo $search_params['address'][$i]; ?></span>
                            <a class="deleteMultiSearch">x</a>
                        </div>
                        <input type="hidden" name="address[]" value="<?php echo $search_params['address'][$i]; ?>">
                    </li>
                    <?php } ?>
                </ul>
                <input type="hidden" class="oneInputSaveEnter" readonly="readonly">
                <input type="hidden" name="address_type" id="searchEmailEmailType" value="<?php echo $search_params['address_type']; ?>">
            </div>
            <?php } ?>
            <div class="forForm">
                <label for="searchEmailEmail">{{ __('content.address') }}</label>
                <input type="text" name="address[]" id="searchEmailEmail" class="oneInputSaveEnter" />

                <x-select-distance name="address_distance" class="distance distance_searchEmailEmail"/>

                @if (isset($search_params['address_type']) && $search_params['address_type'] == 'OR')
                    <span style="width: 30px;position: absolute;margin-left: -570px;" id="searchEmailEmailOp">{{ __('content.or') }}</span>
                @elseif (isset($search_params['address_type']) && $search_params['address_type'] == 'AND')
                    <span style="width: 30px;position: absolute;margin-left: -570px;" id="searchEmailEmailOp">{{ __('content.and') }}</span>
                @elseif (isset($search_params['address_type']) && $search_params['address_type'] == 'NOT')
                    <span style="width: 30px;position: absolute;margin-left: -570px;" id="searchEmailEmailOp">{{ __('content.not_equal') }}</span>
                @endif
            </div>

            {{-- <div class="forForm">
                <label for="fileSearch">{{ __('content.file_search') }}</label>
                <input type="text" name="content" id="fileSearch" />
                <x-select-distance name="content_distance" class="distance distance_fileSearch"/>
            </div> --}}

            <div class="buttons">

            </div>

        </form>
    </div>
  {{-- ================= modal =========================== --}}

@section('js-include')

    <script>
        var currentInputNameEmail;
        var currentInputIdEmail;
        var searchInput;

        $(document).ready(function() {
            var lang = `{{ app()->getLocale() }}`
            console.log(lang);
            $('input').map(function() {
                if ($(this).hasClass('oneInputSaveEnter')) {
                    $(this).val('');
                }
            });
            showHideDistance('fileSearch','distance_fileSearch');
            showHideDistance('searchEmailEmail','distance_searchEmailEmail');

            searchMultiSelectMaker('searchEmailEmail', 'address');


            $('.oneInputSaveEnter').focusout(function(e) {
                e.preventDefault();
                var test = $(this).attr('id');
                if (typeof test != 'undefined') {
                    searchInput = test;
                }
            });

            $('#email_and').click(function(e) {
                var ff = $.Event("keypress");
                ff.charCode = 38;
                $("#" + searchInput).trigger(ff);
                $('#' + searchInput).focus();
            });

            $('#email_or').click(function(e) {
                var ee = $.Event("keypress");
                ee.charCode = 124;
                $("#" + searchInput).trigger(ee);
                $('#' + searchInput).focus();
            });


            $('.addMore').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('dataTableName');
                var href = '/' + lang + '/autocomplete/' + url + "&type=email"
                console.log(href);
                currentInputNameEmail = $(this).attr('dataName');
                currentInputIdEmail = $(this).attr('dataId');
                $.fancybox({
                    'type': 'iframe',
                    'autoSize': false,
                    'width': 800,
                    'height': 600,
                    'href': '/am/autocomplete/' + url + "&type=email"
                });
            });



            @if (!empty($search_params))
                let searchEmail =
                    `{{ html_entity_decode($search_params['address'][sizeof($search_params['address']) - 1]) }}`
                let fileSearch = `{{ html_entity_decode($search_params['content']) }}`
                $('#searchEmailEmail').val(`${searchEmail}`);
                $('#fileSearch').val(`${fileSearch}`);
            @endif


        });
    </script>
@endsection
@endsection
