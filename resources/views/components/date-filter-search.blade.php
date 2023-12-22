<div class="date-search-block">
    <select name="{{ $name }}" class="date-search-select">
        @if ($name == 'search_count_days')
        <option value="" hidden>Ընտրել</option>
        @endif
        @if ($name != 'search_count_days')
            <option @if (!empty($searchData) && $searchData == "=") selected @endif value="=">{{ __('content.equal') }}</option>
        @endif
        <option  @if (!empty($searchData) && $searchData == ">") selected @endif value=">">{{ __('content.more') }}</option>
        <option @if (!empty($searchData) && $searchData == ">=") selected @endif value=">=">{{ __('content.more_equal') }}</option>
        <option @if (!empty($searchData) && $searchData == "<") selected @endif value="<">{{ __('content.less') }}</option>
        <option @if (!empty($searchData) && $searchData == "<=") selected @endif value="<=">{{ __('content.less_equal') }}</option>
        @if ($name != 'search_count_days')
            <option @if (!empty($searchData) && $searchData == "!=") selected @endif value="!=">{{ __('content.not_equal') }}</option>
        @endif
        <option @if (!empty($searchData) && $searchData == "<=>") selected @endif value="<=>">{{ __('content.interval') }}</option>
    </select>
    {{-- <input name="{{ $inpName }}" type="date" class="date-search-input" style="display: none"> --}}
    @if ($name == 'search_count_days')
        <input type="text" name="{{ $inpName }}" id="signalDateOf" onkeydown="validateNumber(event,'signalDateOf',12)"
        class="oneInputSaveEnter date-search-input" />
    @else
        <input type="text" name="{{ $inpName }}" id="searchDateOf" style="width: 505px;"
        onkeydown="validateNumber(event,'searchDateOf',12)" class="oneInputSaveDateMan oneInputSaveEnter date-search-input" />

    @endif

</div>
