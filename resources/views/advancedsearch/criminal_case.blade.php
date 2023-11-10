@extends('layouts.include-app')

@section('content-include')

<form id="advancedCriminalCase" method="post" action="{{ route('advanced_result_criminal_case') }}">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchCriminalCase" value="{{ __('content.search') }}" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
    <div id="dataEvent" style="display: none;"></div>
    <div id="dataCriminalCase" style="display: none;"></div>
    <div id="dataSignal" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="caseAdv">{{ __('content.criminal_case') }}</li>
        <li id="manAdv">{{ __('content.face') }}</li>
        <li id="biblAdv">{{ __('content.bibliography') }}</li>
        <li id="organizationAdv">{{ __('content.organization') }}</li>
        <li id="actionAdv">{{ __('content.action') }}</li>
        <li id="eventAdv">{{ __('content.event') }}</li>
        <li id="signalAdv">{{ __('content.signal') }}</li>
    </ul>
</div>

@section('js-include')

<script>

    var countAjax = 0;
    var realCount = 7;
    $(document).ready(function(e){

        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });


        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                 `/${lang}/simplesearch/simple_search_criminal_case/1`,
                 `/${lang}/simplesearch/simple_search_man/1`,
                 `/${lang}/simplesearch/simple_search_bibliography/1`,
                 `/${lang}/simplesearch/simple_search_organization/1`,
                 `/${lang}/simplesearch/simple_search_action/1`,
                 `/${lang}/simplesearch/simple_search_event/1`,
                 `/${lang}/simplesearch/simple_search_signal/1`
            ]
        });


        $('#submitAdvancedSearchCriminalCase').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');
            if (typeof $('#bibliographyForm').attr('action') != 'undefined'){
                if(formNotEmpty('bibliographyForm')){
                    var data = $('#bibliographyForm').serializeArray();
                    $.ajax({
                        'url' :  `/${lang}/simplesearch/result_bibliography/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataBibliography').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataBibliography').append('<input type="hidden" name="bibliography[]" value="'+value.id+'"/>');
                                });
                                countCriminalCase()
                            }else{
                                $('#biblAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.bibliography_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countCriminalCase();
                }
            }else{
                countCriminalCase();
            }

            if (typeof $('#manForm').attr('action') != 'undefined'){
                if(formNotEmpty('manForm')){
                    var data = $('#manForm').serializeArray();
                    $.ajax({
                        'url' :  `/${lang}/simplesearch/result_man/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataMan').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataMan').append('<input type="hidden" name="man[]" value="'+value.id+'"/>');
                                });
                                countCriminalCase()
                            }else{
                                $('#manAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.face_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countCriminalCase();
                }
            }else{
                countCriminalCase();
            }

            if (typeof $('#organizationForm').attr('action') != 'undefined'){
                if(formNotEmpty('organizationForm')){
                    var data = $('#organizationForm').serializeArray();
                    $.ajax({
                        'url' :  `/${lang}/simplesearch/result_organization/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataOrganization').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataOrganization').append('<input type="hidden" name="organization[]" value="'+value.id+'"/>');
                                });
                                countCriminalCase()
                            }else{
                                $('#organizationAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.organization_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countCriminalCase();
                }
            }else{
                countCriminalCase();
            }

            if (typeof $('#actionForm').attr('action') != 'undefined'){
                if(formNotEmpty('actionForm')){
                    var data = $('#actionForm').serializeArray();
                    $.ajax({
                        'url' :  `/${lang}/simplesearch/result_action/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataAction').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataAction').append('<input type="hidden" name="action[]" value="'+value.id+'"/>');
                                });
                                countCriminalCase()
                            }else{
                                $('#actionAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.action_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countCriminalCase();
                }
            }else{
                countCriminalCase();
            }

            if (typeof $('#eventForm').attr('action') != 'undefined'){
                if(formNotEmpty('eventForm')){
                    var data = $('#eventForm').serializeArray();
                    $.ajax({
                        'url' :  `/${lang}/simplesearch/result_event/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataEvent').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataEvent').append('<input type="hidden" name="event[]" value="'+value.id+'"/>');
                                });
                                countCriminalCase()
                            }else{
                                $('#eventAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.event_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countCriminalCase();
                }
            }else{
                countCriminalCase();
            }

            if (typeof $('#criminalCaseForm').attr('action') != 'undefined'){
                if(formNotEmpty('criminalCaseForm')){
                    var data = $('#criminalCaseForm').serializeArray();
                    $.ajax({
                        'url' :  `/${lang}/simplesearch/result_criminal_case/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataCrminalCase').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataCrminalCase').append('<input type="hidden" name="criminal_case[]" value="'+value.id+'"/>');
                                });
                                countCriminalCase()
                            }else{
                                $('#caseAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.criminal_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countCriminalCase();
                }
            }else{
                countCriminalCase();
            }

            if( typeof $('#signalForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('signalForm')){
                    var data = $('#signalForm').serializeArray();
                    $.ajax({
                        'url' :  `/${lang}/simplesearch/result_signal/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataSignal').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataSignal').append('<input type="hidden" name="signal[]" value="'+value.id+'"/>');
                                });
                                countCriminalCase()
                            }else{
                                $('#signalAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.signal_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countCriminalCase();
                }
            }else{
                countCriminalCase();
            }

//            $('#preloader').hide();
        });

    });

    function countCriminalCase(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedCriminalCase').submit();
        }
    }

</script>

@endsection
@endsection
