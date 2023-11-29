@extends('layouts.include-app')

@section('content-include')

<form id="advancedKeepSignal" method="post" action="{{ route('advanced_result_signal') }}">
    <x-back-previous-url />
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchKeepSignal" value="{{ __('content.search') }}" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
    <div id="dataEvent" style="display: none;"></div>
    <div id="dataCriminalCase" style="display: none;"></div>
    <div id="dataSignal" style="display: none;"></div>
    <div id="dataKeepSignal" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="signalAdv">{{ __('content.signal') }}</li>
        <li id="manAdv">{{ __('content.face') }}</li>
        <li id="biblAdv">{{ __('content.bibliography') }}</li>
        <li id="organizationAdv">{{ __('content.organization') }}</li>
        <li id="actionAdv">{{ __('content.action') }}</li>
        <li id="eventAdv">{{ __('content.event') }}</li>
        <li id="caseAdv">{{ __('content.criminal_case') }}</li>
        <li id="keepAdv">{{ __('content.keep_signal') }}</li>
    </ul>
</div>

@section('js-include')

<script>

    var countAjax = 0;
    var realCount = 8;
    $(document).ready(function(e){

        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });


        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                `/${lang}/simplesearch/simple_search_signal/1`,
                `/${lang}/simplesearch/simple_search_man/1`,
                `/${lang}/simplesearch/simple_search_bibliography/1`,
                `/${lang}/simplesearch/simple_search_organization/1`,
                `/${lang}/simplesearch/simple_search_action/1`,
                `/${lang}/simplesearch/simple_search_event/1`,
                `/${lang}/simplesearch/simple_search_criminal_case/1`,
                `/${lang}/simplesearch/simple_search_keep_signal/1`,
            ]
        });


        $('#submitAdvancedSearchKeepSignal').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');
            if (typeof $('#bibliographyForm').attr('action') != 'undefined'){
                if(formNotEmpty('bibliographyForm')){
                    var data = $('#bibliographyForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_bibliography/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataBibliography').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataBibliography').append('<input type="hidden" name="bibliography[]" value="'+value.id+'"/>');
                                });
                                countSignal()
                            }else{
                                $('#biblAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentbibliography_found') }} `);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }} `);
                        }
                    });
                }else{
                    countSignal();
                }
            }else{
                countSignal();
            }

            if (typeof $('#manForm').attr('action') != 'undefined'){
                if(formNotEmpty('manForm')){
                    var data = $('#manForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_man/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataMan').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataMan').append('<input type="hidden" name="man[]" value="'+value.id+'"/>');
                                });
                                countSignal()
                            }else{
                                $('#manAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentface_found') }} `);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }} `);
                        }
                    });
                }else{
                    countSignal();
                }
            }else{
                countSignal();
            }

            if (typeof $('#organizationForm').attr('action') != 'undefined'){
                if(formNotEmpty('organizationForm')){
                    var data = $('#organizationForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_organization/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataOrganization').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataOrganization').append('<input type="hidden" name="organization[]" value="'+value.id+'"/>');
                                });
                                countSignal()
                            }else{
                                $('#organizationAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentorganization_found') }} `);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }} `);
                        }
                    });
                }else{
                    countSignal();
                }
            }else{
                countSignal();
            }

            if (typeof $('#actionForm').attr('action') != 'undefined'){
                if(formNotEmpty('actionForm')){
                    var data = $('#actionForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_action/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataAction').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataAction').append('<input type="hidden" name="action[]" value="'+value.id+'"/>');
                                });
                                countSignal()
                            }else{
                                $('#actionAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentaction_found') }} `);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }} `);
                        }
                    });
                }else{
                    countSignal();
                }
            }else{
                countSignal();
            }

            if (typeof $('#eventForm').attr('action') != 'undefined'){
                if(formNotEmpty('eventForm')){
                    var data = $('#eventForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_event/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataEvent').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataEvent').append('<input type="hidden" name="event[]" value="'+value.id+'"/>');
                                });
                                countSignal()
                            }else{
                                $('#eventAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentevent_found') }} `);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }} `);
                        }
                    });
                }else{
                    countSignal();
                }
            }else{
                countSignal();
            }

            if (typeof $('#criminalCaseForm').attr('action') != 'undefined'){
                if(formNotEmpty('criminalCaseForm')){
                    var data = $('#criminalCaseForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_criminal_case/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataCrminalCase').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataCrminalCase').append('<input type="hidden" name="criminal_case[]" value="'+value.id+'"/>');
                                });
                                countSignal()
                            }else{
                                $('#caseAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentcriminal_found') }} `);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }} `);
                        }
                    });
                }else{
                    countSignal();
                }
            }else{
                countSignal();
            }

            if( typeof $('#signalForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('signalForm')){
                    var data = $('#signalForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_signal/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataSignal').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataSignal').append('<input type="hidden" name="signal[]" value="'+value.id+'"/>');
                                });
                                countSignal()
                            }else{
                                $('#signalAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentsignal_found') }} `);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }} `);
                        }
                    });
                }else{
                    countSignal();
                }
            }else{
                countSignal();
            }

            if( typeof $('#keepSignalForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('keepSignalForm')){
                    var data = $('#keepSignalForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_keep_signal/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataKeepSignal').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataKeepSignal').append('<input type="hidden" name="keep_signal[]" value="'+value.id+'"/>');
                                });
                                countSignal()
                            }else{
                                $('#keepAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentkeep_signal_found') }} `);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }} `);
                        }
                    });
                }else{
                    countSignal();
                }
            }else{
                countSignal();
            }
//            $('#preloader').hide();
        });

    });

    function countSignal(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedKeepSignal').submit();
        }
    }

</script>

@endsection
@endsection
