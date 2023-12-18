<div class="date-search-block">
    <select  name="date_search"  class="date-search-select">
        <option value=">">{{ __('content.more') }}</option>
        <option value=">=">{{ __('content.more_equal') }}</option>
        <option value="<">{{ __('content.less') }}</option>
        <option value="<=">{{ __('content.less_equal') }}</option>
        <option value="=">{{ __('content.equal') }}</option>
        <option value="!=">{{ __('content.not_equal') }}</option>
        <option value="<=>">{{ __('content.interval') }}</option>
    </select>
    <input type="date" class="date-search-input" style="display: none">
</div>
