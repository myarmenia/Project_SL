@php
    $url = url()->full();
    $url_name = array_reverse(explode('/', $url))[0];
@endphp

<div class="table-buttons-block">
    <a href="{{ route('optimization.page', 'bibliography') }}"
        class="button-table btn border border-dark {{ $url_name == 'bibliography' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.bibliography') }}</a>
    <a href="{{ route('optimization.page', 'man') }}"
        class="button-table btn border border-dark {{ $url_name == 'man' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.man') }}</a>
    <a href="{{ route('optimization.page', 'sign') }}"
        class="button-table btn border border-dark {{ $url_name == 'sign' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.external_signs') }}</a>
    <a href="{{ route('optimization.page', 'phone') }}"
        class="button-table btn border border-dark {{ $url_name == 'phone' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.phone') }}</a>
    <a href="{{ route('optimization.page', 'email') }}"
        class="button-table btn border border-dark {{ $url_name == 'email' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.email') }}</a>
    <a href="{{ route('optimization.page', 'weapon') }}"
        class="button-table btn  border border-dark {{ $url_name == 'weapon' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.weapon') }}</a>
    <a href="{{ route('optimization.page', 'car') }}"
        class="button-table btn  border border-dark {{ $url_name == 'car' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.car') }}</a>
    <a href="{{ route('optimization.page', 'address') }}"
        class="button-table btn  border border-dark {{ $url_name == 'address' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.address') }}</a>
    <a href="{{ route('optimization.page', 'man_bean_country') }}"
        class="button-table btn  border border-dark {{ $url_name == 'man_bean_country' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.man_beann_country') }}</a>
    <a href="{{ route('optimization.page', 'objects_relation') }}"
        class="button-table btn border border-dark {{ $url_name == 'objects_relation' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.objects_relation') }}</a>
    <a href="{{ route('optimization.page', 'action') }}"
        class="button-table btn  border border-dark {{ $url_name == 'action' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.action') }}</a>
    <a href="{{ route('optimization.page', 'event') }}"
        class="button-table btn border border-dark {{ $url_name == 'event' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.event') }}</a>
    <a href="{{ route('optimization.page', 'signal') }}"
        class="button-table btn  border border-dark {{ $url_name == 'signal' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.signal') }}</a>
    <a href="{{ route('optimization.page', 'organization') }}"
        class="button-table btn  border border-dark {{ $url_name == 'organization' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.organization') }}</a>
    <a href="{{ route('optimization.page', 'keep_signal') }}"
        class="button-table btn border border-dark {{ $url_name == 'keep_signal' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.keep_signal') }}</a>
    <a href="{{ route('optimization.page', 'criminal_case') }}"
        class="button-table btn border border-dark {{ $url_name == 'criminal_case' ? 'btn-primary' : 'btn-light' }}">
        {{ __('sidebar.criminal_case') }}</a>
    <a href="{{ route('optimization.page', 'work_activity') }}"
        class="button-table btn border border-dark {{ $url_name == 'work_activity' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.work_activity') }}</a>
    <a href="{{ route('optimization.page', 'controll') }}"
        class="button-table btn border border-dark {{ $url_name == 'controll' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.control') }}</a>
    <a href="{{ route('optimization.page', 'mia_summary') }}"
        class="button-table btn border border-dark {{ $url_name == 'mia_summary' ? 'btn-primary' : 'btn-light' }}">{{ __('sidebar.mia_summary') }}</a>
</div>
