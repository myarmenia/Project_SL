<div class="input-group mt-3 py-1 w-50 search-count-div" style="margin-left: 69%;">
    <div class="input-group-text ">
    <label for="revers_word" id="label_revers_word" class="pe-3">{{ __('content.word_count') }}</label>
    <input type="checkbox" name="revers_word"  @if(old('revers_word') == 1)  checked @endif id="revers_word" class="form-check-input mt-0 " type="checkbox" value="1" >
    </div>
    <input {{ $attributes }} type="number" min="0" name="word_count"  class="form-control search-input-num"
        aria-label="Text input with checkbox"
        placeholder="{{ __('content.distance_word') }}" value="{{ old('word_count','') }}">
</div>
