@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/fusion/index.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('content.fusion')" />
    <!-- End Page Title -->

<section class="section">
        <div class="card">
            <div class="card-body">
            <div class="ap">

                <div id="example" class="k-content" >

                <ul class="ap1" style="clear: both; text-align: center;position: relative;margin: 20px auto;">

                    {{--<li>
                        <a href="{{ route('fusion.name', 'bibliography') }}" style="text-decoration: none;">{{ __('content.bibliography') }}</a>
                    </li>--}}

                    <li>
                        <a href="{{ route('fusion.name', 'man') }}">{{ __('content.face') }}</a>
                    </li>

                    {{--<li>
                        <a href="{{ route('fusion.name', 'weapon') }}">{{ __('content.weapon') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'car') }}">{{ __('content.car') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'address') }}">{{ __('content.address') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'work_activity') }}">{{ __('content.work_activity') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'man_bean_country') }}">{{ __('content.man_bean_country') }}</a>
                    </li>

                    <li>
                        <a href="{{ route('fusion.name', 'action') }}">{{ __('content.action') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'event') }}">{{ __('content.event') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'signal') }}">{{ __('content.signal') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'organization') }}">{{ __('content.organization') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'keep_signal') }}">{{ __('content.keep_signal') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'criminal') }}">{{ __('content.criminal') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'control') }}">{{ __('content.control') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('fusion.name', 'mia_summary') }}">{{ __('content.mia_summary') }}</a>
                    </li> --}}


                </ul>


                </div>

                </div>
            </div>
        </div>
    </section>


@section('js-include')

@endsection
@endsection
