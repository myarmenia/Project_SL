
<select {{ $attributes }}  aria-label="Default select example">

    <option @if (!empty($attributes->get('search-data')) && $attributes->get('search-data') == 1) selected @endif value="1">100% {{ __('content.match') }}</option>
    <option @if (!empty($attributes->get('search-data')) && $attributes->get('search-data') == 2) selected @endif value="2">{{ __('content.match_word') }}</option>
</select>
