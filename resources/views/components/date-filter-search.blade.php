<div class="date-search-block">
    <select name="{{ $name }}" class="date-search-select">
        @if ($name == 'search_count_days')
        <option value="" hidden >Ընտրել</option>
        @endif
        @if ($name != 'search_count_days')
            <option value="=">{{ __('content.equal') }}</option>
        @endif
        <option value=">">{{ __('content.more') }}</option>
        <option value=">=">{{ __('content.more_equal') }}</option>
        <option value="<">{{ __('content.less') }}</option>
        <option value="<=">{{ __('content.less_equal') }}</option>
        @if ($name != 'search_count_days')
            <option value="!=">{{ __('content.not_equal') }}</option>
        @endif
        <option value="<=>">{{ __('content.interval') }}</option>
    </select>
    {{-- <input name="{{ $inpName }}" type="date" class="date-search-input" style="display: none"> --}}
    @if ($name == 'search_count_days')
        <input type="text" name="{{ $inpName }}" id="signalAmountOverdue" onkeydown="validateNumber(event,'signalAmountOverdue',12)" class="oneInputSaveEnter" />
    @else
        <input type="text" name="{{ $inpName }}" id="searchManDateOfBirth" style="display: none; width: 505px;"
        onkeydown="validateNumber(event,'searchManDateOfBirth',12)" class="oneInputSaveDateMan oneInputSaveEnter date-search-input" />
    @endif

</div>
