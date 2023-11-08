@extends('layouts.include-app')

@section('content-include')

<form id="advancedEvent" method="post" action="{{ route('advanced_result_event') }}">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchEvent" value="{{ __('content.search') }}" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
    <div id="dataEvent" style="display: none;"></div>
    <div id="dataCriminalCase" style="display: none;"></div>
    <div id="dataSignal" style="display: none;"></div>
    <div id="dataAddress" style="display: none;"></div>
    <div id="dataCar" style="display: none;"></div>
    <div id="dataWeapon" style="display: none;"></div>
</form>
<div style="clear: both;"></div>
<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="eventAdv">{{ __('content.event') }}</li>
        <li id="manAdv">{{ __('content.face') }}</li>
        <li id="biblAdv">{{ __('content.bibliography') }}</li>
        <li id="organizationAdv">{{ __('content.organization') }}</li>
        <li id="actionAdv">{{ __('content.action') }}</li>
        <li id="caseAdv">{{ __('content.criminal_case') }}</li>
        <li id="signalAdv">{{ __('content.signal') }}</li>
        <li id="addressAdv">{{ __('content.address') }}</li>
        <li id="carAdv">{{ __('content.car') }}</li>
        <li id="weaponAdv">{{ __('content.weapon') }}</li>
    </ul>
</div>

@section('js-include')

<script>

    var countAjax = 0;
    var realCount = 10;
    $(document).ready(function(e){

        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });


        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                `/${lang}/simplesearch/simple_search_event/1`,
                `/${lang}/simplesearch/simple_search_man/1`,
                `/${lang}/simplesearch/simple_search_bibliography/1`,
                `/${lang}/simplesearch/simple_search_organization/1`,
                `/${lang}/simplesearch/simple_search_action/1`,
                `/${lang}/simplesearch/simple_search_criminal_case/1`,
                `/${lang}/simplesearch/simple_search_signal/1`,
                `/${lang}/simplesearch/simple_search_address/1`,
                `/${lang}/simplesearch/simple_search_car/1`,
                `/${lang}/simplesearch/simple_search_weapon/1`
            ]
        });


        $('#submitAdvancedSearchEvent').click(function(e){
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
                                countEvent()
                            }else{
                                $('#biblAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentbibliography_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }}`);
                        }
                    });
                }else{
                    countEvent();
                }
            }else{
                countEvent();
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
                                countEvent()
                            }else{
                                $('#manAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentface_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }}`);
                        }
                    });
                }else{
                    countEvent();
                }
            }else{
                countEvent();
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
                                countEvent()
                            }else{
                                $('#organizationAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentorganization_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }}`);
                        }
                    });
                }else{
                    countEvent();
                }
            }else{
                countEvent();
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
                                countEvent()
                            }else{
                                $('#actionAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentaction_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }}`);
                        }
                    });
                }else{
                    countEvent();
                }
            }else{
                countEvent();
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
                                countEvent()
                            }else{
                                $('#eventAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentevent_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }}`);
                        }
                    });
                }else{
                    countEvent();
                }
            }else{
                countEvent();
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
                                countEvent()
                            }else{
                                $('#caseAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentcriminal_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }}`);
                        }
                    });
                }else{
                    countEvent();
                }
            }else{
                countEvent();
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
                                countEvent()
                            }else{
                                $('#signalAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentsignal_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }}`);
                        }
                    });
                }else{
                    countEvent();
                }
            }else{
                countEvent();
            }

            if( typeof $('#addressForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('addressForm')){
                    var data = $('#addressForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_address/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataAddress').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataAddress').append('<input type="hidden" name="address[]" value="'+value.id+'"/>');
                                });
                                countEvent()
                            }else{
                                $('#addressAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentaddress_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }}`);
                        }
                    });
                }else{
                    countEvent();
                }
            }else{
                countEvent();
            }

            if( typeof $('#carForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('carForm')){
                    var data = $('#carForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_car/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataCar').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataCar').append('<input type="hidden" name="car[]" value="'+value.id+'"/>');
                                });
                                countEvent()
                            }else{
                                $('#carAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentcar_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }}`);
                        }
                    });
                }else{
                    countEvent();
                }
            }else{
                countEvent();
            }

            if( typeof $('#weaponForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('weaponForm')){
                    var data = $('#weaponForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_weapon/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataWeapon').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataWeapon').append('<input type="hidden" name="weapon[]" value="'+value.id+'"/>');
                                });
                                countEvent()
                            }else{
                                $('#weaponAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('contentweapon_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('contenterr') }}`);
                        }
                    });
                }else{
                    countEvent();
                }
            }else{
                countEvent();
            }


//            $('#preloader').hide();
        });

    });

    function countEvent(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedEvent').submit();
        }
    }

</script>

@endsection
@endsection
