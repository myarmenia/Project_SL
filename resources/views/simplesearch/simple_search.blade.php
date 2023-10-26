@extends('layouts.include-app')

@section('content-include')

<div class="ap">

    <div id="example" class="k-content" >



    <ul class="ap1" style="clear: both; text-align: center;position: relative;margin: 20px auto;">

        <li>
            {{-- <a href="simplesearch/simple_search_bibliography?n=t" style="text-decoration: none;">{{ __('content.bibliography') }}</a> --}}
            <a href="{{ route('simple_search_bibliography',['n'=> 't']) }}" style="text-decoration: none;">{{ __('content.bibliography') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_man?n=t">{{ __('content.face') }}</a> --}}
            <a href="{{ route('simple_search_man',['n'=> 't']) }}">{{ __('content.face') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_external_signs?n=t">{{ __('content.external_signs') }}</a> --}}
            <a href="{{ route('simple_search_external_signs',['n'=> 't']) }}">{{ __('content.external_signs') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_phone?n=t">{{ __('content.telephone') }}</a> --}}
            <a href="{{ route('simple_search_phone',['n'=> 't']) }}">{{ __('content.telephone') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_email?n=t">{{ __('content.email') }}</a> --}}
            <a href="{{ route('simple_search_email',['n'=> 't']) }}">{{ __('content.email') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_weapon?n=t">{{ __('content.weapon;') }}</a> --}}
            <a href="{{ route('simple_search_weapon',['n'=> 't']) }}">{{ __('content.weapon') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_car?n=t">{{ __('content.car') }}</a> --}}
            <a href="{{ route('simple_search_car',['n'=> 't']) }}">{{ __('content.car') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_address?n=t">{{ __('content.address') }}</a> --}}
            <a href="{{ route('simple_search_address',['n'=> 't']) }}">{{ __('content.address') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_work_activity?n=t">{{ __('content.work_activity;') }}</a> --}}
            <a href="{{ route('simple_search_work_activity',['n'=> 't']) }}">{{ __('content.work_activity') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_man_bean_country?n=t">{{ __('content.man_bean_country;') }}</a> --}}
            <a href="{{ route('simple_search_man_bean_country',['n'=> 't']) }}">{{ __('content.man_bean_country') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_objects_relation?n=t">{{ __('content.relationship_objects;') }}</a> --}}
            <a href="{{ route('simple_search_objects_relation',['n'=> 't']) }}">{{ __('content.relationship_objects') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_action?n=t">{{ __('content.action;') }}</a> --}}
            <a href="{{ route('simple_search_action',['n'=> 't']) }}">{{ __('content.action') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_event?n=t">{{ __('content.event;') }}</a> --}}
            <a href="{{ route('simple_search_event',['n'=> 't']) }}">{{ __('content.event') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_signal?n=t">{{ __('content.signal;') }}</a> --}}
            <a href="{{ route('simple_search_signal',['n'=> 't']) }}">{{ __('content.signal') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_organization?n=t">{{ __('content.organization;') }}</a> --}}
            <a href="{{ route('simple_search_organization',['n'=> 't']) }}">{{ __('content.organization') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_keep_signal?n=t">{{ __('content.keep_signal;') }}</a> --}}
            <a href="{{ route('simple_search_keep_signal',['n'=> 't']) }}">{{ __('content.keep_signal') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_criminal_case?n=t">{{ __('content.criminal;') }}</a> --}}
            <a href="{{ route('simple_search_criminal_case',['n'=> 't']) }}">{{ __('content.criminal') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_control?n=t">{{ __('content.control;') }}</a> --}}
            <a href="{{ route('simple_search_control',['n'=> 't']) }}">{{ __('content.control') }}</a>
        </li>
        <li>
            {{-- <a href="simplesearch/simple_search_mia_summary?n=t">{{ __('content.mia_summary;') }}</a> --}}
            <a href="{{ route('simple_search_mia_summary',['n'=> 't']) }}">{{ __('content.mia_summary') }}</a>
        </li>
    </ul>


    </div>

</div>
@section('js-include')

@endsection
@endsection
