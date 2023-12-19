<div class="date-search-block">
    <select name="{{ $name }}" class="date-search-select">
        <option value="=">{{ __('content.equal') }}</option>
        <option value=">">{{ __('content.more') }}</option>
        <option value=">=">{{ __('content.more_equal') }}</option>
        <option value="<">{{ __('content.less') }}</option>
        <option value="<=">{{ __('content.less_equal') }}</option>
        <option value="!=">{{ __('content.not_equal') }}</option>
        <option value="<=>">{{ __('content.interval') }}</option>
    </select>
    {{-- <input name="{{ $inpName }}" type="date" class="date-search-input" style="display: none"> --}}
    <input type="text" name="{{ $inpName }}" id="searchManDateOfBirth" style="display: none; width: 505px;"
        onkeydown="validateNumber(event,'searchManDateOfBirth',12)" class="oneInputSaveDateMan oneInputSaveEnter date-search-input" />
</div>
