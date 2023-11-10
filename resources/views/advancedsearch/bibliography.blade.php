
@extends('layouts.auth-app')
@section('style')
    {{-- <link href="{{ asset('assets/css/roles/style.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('assets-include/css/jquery.fancybox.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets-include/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-include/js/jquery.fancybox.js') }}"></script>
    <link href="{{ asset('assets-include/css/kendo.common.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-include/css/kendo.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-include/css/styles.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets-include/js/kendo.all.min.js') }}"></script>
    <script src="{{ asset('assets-include/js/fileuploader.js') }}"></script>
    <script src="{{ asset('assets-include/js/ru.js') }}"></script>
@endsection
@section('content')
<form id="advancedBibliography" method="post" action="{{ route('advanced_result_bibliography') }}">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchBibliography" value="{{ __('content.search') }}" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataControl" style="display: none;"></div>
    <div id="dataMiaSummary" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
    <div id="dataEvent" style="display: none;"></div>
    <div id="dataCriminalCase" style="display: none;"></div>
    <div id="dataSignal" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="biblAdv">{{ __('content.bibliography') }}</li>
        <li id="manAdv">{{ __('content.face') }}</li>
        <li id="orgAdv">{{ __('content.organization') }}</li>
        <li id="conAdv">{{ __('content.control') }}</li>
        <li id="miaAdv">{{ __('content.mia_summary') }}</li>
        <li id="actAdv">{{ __('content.action') }}</li>
        <li id="evtAdv">{{ __('content.event') }}</li>
        <li id="caseAdv">{{ __('content.criminal_case') }}</li>
        <li id="sigAdv">{{ __('content.signal') }}</li>
    </ul>
</div>


@section('js-scripts')
    {{-- <script src="{{ asset('assets/js/roles/script.js') }}"></script> --}}

    <script>

        var countAjax = 0;
        var realCount = 9;
        $(document).ready(function(e){

            $('#tabstrip ul li').live('click',function(){
                $('#'+$(this).attr('id')).addClass('active_tab');
            });


            $("#tabstrip").kendoTabStrip({
                animation: { open: { effects: "fadeIn"} },
                contentUrls: [
                    'simplesearch/simple_search_bibliography/1',
                    // '/{{app()->getLocale()}}/simplesearch/simple_search_man/1',
                    // '/{{app()->getLocale()}}/simplesearch/simple_search_organization/1',
                    // '/{{app()->getLocale()}}/simplesearch/simple_search_control/1',
                    // '/{{app()->getLocale()}}/simplesearch/simple_search_mia_summary/1',
                    // '/{{app()->getLocale()}}/simplesearch/simple_search_action/1',
                    // '/{{app()->getLocale()}}/simplesearch/simple_search_event/1',
                    // '/{{app()->getLocale()}}/simplesearch/simple_search_criminal_case/1',
                    // '/{{app()->getLocale()}}/simplesearch/simple_search_signal/1'
                ]
            });


            $('#submitAdvancedSearchBibliography').click(function(e){
                e.preventDefault();
                countAjax = 0;
                $('.redBack').removeClass('redBack');
                $('#preloader').show();
                if (typeof $('#bibliographyForm').attr('action') != 'undefined'){
                    if(formNotEmpty('bibliographyForm')){
                        var data = $('#bibliographyForm').serializeArray();
                        $.ajax({
                            'url' : '/{{app()->getLocale()}}/simplesearch/result_bibliography/1',
                            'type' : 'POST',
                            'data':data,
                            'dataType' : 'json',
                            'success':function(data){
                                if(data.status){
                                    $('#dataBibliography').html('');
                                    $.each(data.data,function(key,value){
                                        $('#dataBibliography').append('<input type="hidden" name="bibliography[]" value="'+value.id+'"/>');
                                    });
                                    countBibliography()
                                }else{
                                    $('#biblAdv').addClass('redBack');
                                    $('#preloader').hide();

                                    alert( `{{ __('content.bibliography_found') }}` );
                                }
                            },
                            faild: function(data){
                                alert(`{{ __('content.err')}}`);
                            }
                        });
                    }else{
                        countBibliography();
                    }
                }else{
                    countBibliography();
                }

                if (typeof $('#manForm').attr('action') != 'undefined'){
                    if(formNotEmpty('manForm')){
                        var data = $('#manForm').serializeArray();
                        $.ajax({
                            'url' : '/{{app()->getLocale()}}/simplesearch/result_man/1',
                            'type' : 'POST',
                            'data':data,
                            'dataType' : 'json',
                            'success':function(data){
                                if(data.status){
                                    $('#dataMan').html('');
                                    $.each(data.data,function(key,value){
                                        $('#dataMan').append('<input type="hidden" name="man[]" value="'+value.id+'"/>');
                                    });
                                    countBibliography()
                                }else{
                                    $('#manAdv').addClass('redBack');
                                    $('#preloader').hide();
                                    alert(`{{ __('content.face_found')}}`);
                                }
                            },
                            faild: function(data){
                                alert(`{{ __('content.err')}}`);
                            }
                        });
                    }else{
                        countBibliography();
                    }
                }else{
                    countBibliography();
                }

                if (typeof $('#organizationForm').attr('action') != 'undefined'){
                    if(formNotEmpty('organizationForm')){
                        var data = $('#organizationForm').serializeArray();
                        $.ajax({
                            'url' : '/{{app()->getLocale()}}/simplesearch/result_organization/1',
                            'type' : 'POST',
                            'data':data,
                            'dataType' : 'json',
                            'success':function(data){
                                if(data.status){
                                    $('#dataOrganization').html('');
                                    $.each(data.data,function(key,value){
                                        $('#dataOrganization').append('<input type="hidden" name="organization[]" value="'+value.id+'"/>');
                                    });
                                    countBibliography()
                                }else{
                                    $('#orgAdv').addClass('redBack');
                                    $('#preloader').hide();
                                    alert(`{{ __('content.organization_found') }}`);
                                }
                            },
                            faild: function(data){
                                $('#orgAdv').addClass('redBack');
                                alert(`{{ __('content.err') }}`);
                            }
                        });
                    }else{
                        countBibliography();
                    }
                }else{
                    countBibliography();
                }

                if (typeof $('#controlForm').attr('action') != 'undefined'){
                    if(formNotEmpty('controlForm')){
                        var data = $('#controlForm').serializeArray();
                        $.ajax({
                            'url' : '/{{app()->getLocale()}}/simplesearch/result_control/1',
                            'type' : 'POST',
                            'data':data,
                            'dataType' : 'json',
                            'success':function(data){
                                if(data.status){
                                    $('#dataControl').html('');
                                    $.each(data.data,function(key,value){
                                        $('#dataControl').append('<input type="hidden" name="control[]" value="'+value.id+'"/>');
                                    });
                                    countBibliography()
                                }else{
                                    $('#preloader').hide();
                                    $('#conAdv').addClass('redBack');
                                    alert(`{{ __('content.control_found') }}`);
                                }
                            },
                            faild: function(data){
                                alert(`{{ __('content.err') }}`);
                            }
                        });
                    }else{
                        countBibliography();
                    }
                }else{
                    countBibliography();
                }

                if (typeof $('#miaSummaryForm').attr('action') != 'undefined'){
                    if(formNotEmpty('miaSummaryForm')){
                        var data = $('#miaSummaryForm').serializeArray();
                        $.ajax({
                            'url' : '/{{app()->getLocale()}}/simplesearch/result_mia_summary/1',
                            'type' : 'POST',
                            'data':data,
                            'dataType' : 'json',
                            'success':function(data){
                                if(data.status){
                                    $('#dataMiaSummary').html('');
                                    $.each(data.data,function(key,value){
                                        $('#dataMiaSummary').append('<input type="hidden" name="mia_summary[]" value="'+value.id+'"/>');
                                    });
                                    countBibliography()
                                }else{
                                    $('#miaAdv').addClass('redBack');
                                    $('#preloader').hide();
                                    alert(`{{ __('content.mia_summary_found') }}` );
                                }
                            },
                            faild: function(data){
                                alert(`{{ __('content.err') }}` );
                            }
                        });
                    }else{
                        countBibliography();
                    }
                }else{
                    countBibliography();
                }

                if (typeof $('#actionForm').attr('action') != 'undefined'){
                    if(formNotEmpty('actionForm')){
                        var data = $('#actionForm').serializeArray();
                        $.ajax({
                            'url' : '/{{app()->getLocale()}}/simplesearch/result_action/1',
                            'type' : 'POST',
                            'data':data,
                            'dataType' : 'json',
                            'success':function(data){
                                if(data.status){
                                    $('#dataAction').html('');
                                    $.each(data.data,function(key,value){
                                        $('#dataAction').append('<input type="hidden" name="action[]" value="'+value.id+'"/>');
                                    });
                                    countBibliography()
                                }else{
                                    $('#actAdv').addClass('redBack');
                                    $('#preloader').hide();
                                    alert(`{{ __('content.action_found')}}` );
                                }
                            },
                            faild: function(data){
                                alert(`{{ __('content.err')}}` );
                            }
                        });
                    }else{
                        countBibliography();
                    }
                }else{
                    countBibliography();
                }

                if (typeof $('#eventForm').attr('action') != 'undefined'){
                    if(formNotEmpty('eventForm')){
                        var data = $('#eventForm').serializeArray();
                        $.ajax({
                            'url' : '/{{app()->getLocale()}}/simplesearch/result_event/1',
                            'type' : 'POST',
                            'data':data,
                            'dataType' : 'json',
                            'success':function(data){
                                if(data.status){
                                    $('#dataEvent').html('');
                                    $.each(data.data,function(key,value){
                                        $('#dataEvent').append('<input type="hidden" name="event[]" value="'+value.id+'"/>');
                                    });
                                    countBibliography()
                                }else{
                                    $('#evtAdv').addClass('redBack');
                                    $('#preloader').hide();
                                    alert(`{{ __('content.event_found') }}` );
                                }
                            },
                            faild: function(data){
                                alert(`{{ __('content.err') }}` );
                            }
                        });
                    }else{
                        countBibliography();
                    }
                }else{
                    countBibliography();
                }

                if (typeof $('#criminalCaseForm').attr('action') != 'undefined'){
                    if(formNotEmpty('criminalCaseForm')){
                        var data = $('#criminalCaseForm').serializeArray();
                        $.ajax({
                            'url' : '/{{app()->getLocale()}}/simplesearch/result_criminal_case/1',
                            'type' : 'POST',
                            'data':data,
                            'dataType' : 'json',
                            'success':function(data){
                                if(data.status){
                                    $('#dataCrminalCase').html('');
                                    $.each(data.data,function(key,value){
                                        $('#dataCrminalCase').append('<input type="hidden" name="criminal_case[]" value="'+value.id+'"/>');
                                    });
                                    countBibliography()
                                }else{
                                    $('#caseAdv').addClass('redBack');
                                    $('#preloader').hide();
                                    alert(`{{ __('content.criminal_found') }}`);
                                }
                            },
                            faild: function(data){
                                alert(`{{ __('content.err')}}` );
                            }
                        });
                    }else{
                        countBibliography();
                    }
                }else{
                    countBibliography();
                }

                if( typeof $('#signalForm').attr('action') != 'undefined' ) {
                    if(formNotEmpty('signalForm')){
                        var data = $('#signalForm').serializeArray();
                        $.ajax({
                            'url' : '/{{app()->getLocale()}}/simplesearch/result_signal/1',
                            'type' : 'POST',
                            'data':data,
                            'dataType' : 'json',
                            'success':function(data){
                                if(data.status){
                                    $('#dataSignal').html('');
                                    $.each(data.data,function(key,value){
                                        $('#dataSignal').append('<input type="hidden" name="signal[]" value="'+value.id+'"/>');
                                    });
                                    countBibliography()
                                }else{
                                    $('#sigAdv').addClass('redBack');
                                    $('#preloader').hide();
                                    alert(`{{ __('content.signal_found')}}` );
                                }
                            },
                            faild: function(data){
                                alert(`{{ __('content.err')}}` );
                            }
                        });
                    }else{
                        countBibliography();
                    }
                }else{
                    countBibliography();
                }

    //            $('#preloader').hide();
            });

        });

        function countBibliography(){
            countAjax++;
            if(countAjax == realCount){
                $('#advancedBibliography').submit();
            }
        }

    </script>

@endsection
@endsection
