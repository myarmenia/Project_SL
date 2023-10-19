@extends('layouts.auth-app')
@section('style')
    {{-- <link href="{{ asset('assets/css/roles/style.css') }}" rel="stylesheet" /> --}}
@endsection
@section('content')
<div class="ap">

    <div id="example" class="k-content" >



    <ul class="ap1" style="clear: both; text-align: center;position: relative;margin: 20px auto;">

        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/bibliography " style="text-decoration: none;">{{ __('content.bibliography')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/man">{{ __('content.face')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/external_sign">{{ __('content.external_signs')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/phone">{{ __('content.telephone')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/email">{{ __('content.email')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/weapon">{{ __('content.weapon')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/car">{{ __('content.car')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/address">{{ __('content.address')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/work_activity">{{ __('content.work_activity')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/man_bean_country">{{ __('content.man_bean_country')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/objects_relation">{{ __('content.relationship_objects')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/action">{{ __('content.action')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/event">{{ __('content.event')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/signal">{{ __('content.signal')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/organization">{{ __('content.organization')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/keep_signal">{{ __('content.keep_signal')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/criminal_case">{{ __('content.criminal')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/control">{{ __('content.control')}}</a>
        </li>
        <li>
            <a href="/{{app()->getLocale()}}/advancedsearch/mia_summary">{{ __('content.mia_summary')}}</a>
        </li>
    </ul>


    </div>

</div>
@section('js-scripts')
    {{-- <script src="{{ asset('assets/js/roles/script.js') }}"></script> --}}

@endsection
@endsection
