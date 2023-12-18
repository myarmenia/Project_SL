@extends('layouts.include-app')

@section('content-include')


<form id="advancedMan" method="post" action="{{ route('advanced_result_man') }}">
    <x-back-previous-url />
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchMan" value="{{ __('content.search') }}" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataMiaSummary" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
    <div id="dataEvent" style="display: none;"></div>
    <div id="dataCriminalCase" style="display: none;"></div>
    <div id="dataSignal" style="display: none;"></div>
    <div id="dataAddress" style="display: none;"></div>
    <div id="dataPhone" style="display: none;"></div>
    <div id="dataWorkActivity" style="display: none;"></div>
    <div id="dataManBeanCountry" style="display: none;"></div>
    <div id="dataExternalSign" style="display: none;"></div>
    <div id="dataObjectsRelation" style="display: none;"></div>
    <div id="dataCar" style="display: none;"></div>
    <div id="dataWeapon" style="display: none;"></div>
    <div id="dataEmail" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="manAdv">{{ __('content.face') }}</li>
        <li id="biblAdv">{{ __('content.bibliography') }}</li>
        <li id="miaAdv">{{ __('content.mia_summary') }}</li>
        <li id="actionAdv">{{ __('content.action') }}</li>
        <li id="eventAdv">{{ __('content.event') }}</li>
        <li id="caseAdv">{{ __('content.criminal_case') }}</li>
        <li id="signalAdv">{{ __('content.signal') }}</li>
        <li id="addressAdv">{{ __('content.address') }}</li>
        <li id="phoneAdv">{{ __('content.telephone') }}</li>
        <li id="workAdv">{{ __('content.work_activity') }}</li>
        <li id="mbcAdv">{{ __('content.man_bean_country') }}</li>
        <li id="extAdv">{{ __('content.external_signs') }}</li>
        <li id="objectAdv">{{ __('content.relationship_objects') }}</li>
        <li id="carAdv">{{ __('content.car') }}</li>
        <li id="weaponAdv">{{ __('content.weapon') }}</li>
        <li id="emailAdv">{{ __('content.email') }}</li>
    </ul>
</div>

<x-fullscreen-modal/>

@section('js-include')
<script>

    var countAjax = 0;
    var realCount = 16;
    $(document).ready(function(e){

        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });

        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                `/${lang}/simplesearch/simple_search_man/1`,
                `/${lang}/simplesearch/simple_search_bibliography/1`,
                `/${lang}/simplesearch/simple_search_mia_summary/1`,
                `/${lang}/simplesearch/simple_search_action/1`,
                `/${lang}/simplesearch/simple_search_event/1`,
                `/${lang}/simplesearch/simple_search_criminal_case/1`,
                `/${lang}/simplesearch/simple_search_signal/1`,
                `/${lang}/simplesearch/simple_search_address/1`,
                `/${lang}/simplesearch/simple_search_phone/1`,
                `/${lang}/simplesearch/simple_search_work_activity/1`,
                `/${lang}/simplesearch/simple_search_man_bean_country/1`,
                `/${lang}/simplesearch/simple_search_external_signs/1`,
                `/${lang}/simplesearch/simple_search_objects_relation/1`,
                `/${lang}/simplesearch/simple_search_car/1`,
                `/${lang}/simplesearch/simple_search_weapon/1`,
                `/${lang}/simplesearch/simple_search_email/1`
            ]
        });


        $('#submitAdvancedSearchMan').click(function(e){
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
                                countMan()
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
                    countMan();
                }
            }else{
                countMan();
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
                            console.log(data);
                            if(data.status){
                                $('#dataMan').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataMan').append('<input type="hidden" name="man[]" value="'+value.id+'"/>');
                                });
                                countMan()
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
                    countMan();
                }
            }else{
                countMan();
            }

            if (typeof $('#miaSummaryForm').attr('action') != 'undefined'){
                if(formNotEmpty('miaSummaryForm')){
                    var data = $('#miaSummaryForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_mia_summary/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataMiaSummary').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataMiaSummary').append('<input type="hidden" name="mia_summary[]" value="'+value.id+'"/>');
                                });
                                countMan()
                            }else{
                                $('#miaAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.mia_summary_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countMan();
                }
            }else{
                countMan();
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
                                countMan()
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
                    countMan();
                }
            }else{
                countMan();
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
                                countMan()
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
                    countMan();
                }
            }else{
                countMan();
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
                                countMan()
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
                    countMan();
                }
            }else{
                countMan();
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
                                countMan()
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
                    countMan();
                }
            }else{
                countMan();
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
                                countMan()
                            }else{
                                $('#addressAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.address_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countMan();
                }
            }else{
                countMan();
            }

            if( typeof $('#phoneForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('phoneForm')){
                    var data = $('#phoneForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_phone/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataPhone').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataPhone').append('<input type="hidden" name="phone[]" value="'+value.id+'"/>');
                                });
                                countMan()
                            }else{
                                $('#phoneAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.phone_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countMan();
                }
            }else{
                countMan();
            }

            if( typeof $('#workActivityForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('workActivityForm')){
                    var data = $('#workActivityForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_work_activity/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataWorkActivity').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataWorkActivity').append('<input type="hidden" name="work_activity[]" value="'+value.id+'"/>');
                                });
                                countMan()
                            }else{
                                $('#workAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.work_activity_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countMan();
                }
            }else{
                countMan();
            }

            if( typeof $('#manBeanCountryForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('manBeanCountryForm')){
                    var data = $('#manBeanCountryForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_man_bean_country/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataManBeanCountry').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataManBeanCountry').append('<input type="hidden" name="man_bean_country[]" value="'+value.id+'"/>');
                                });
                                countMan()
                            }else{
                                $('#mbcAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.man_bean_country_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countMan();
                }
            }else{
                countMan();
            }

            if( typeof $('#externalSignForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('externalSignForm')){
                    var data = $('#externalSignForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_external_signs/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataExternalSign').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataExternalSign').append('<input type="hidden" name="external_sign[]" value="'+value.id+'"/>');
                                });
                                countMan()
                            }else{
                                $('#extAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.sign_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countMan();
                }
            }else{
                countMan();
            }

            if( typeof $('#objectForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('objectForm')){
                    var data = $('#objectForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_objects_relation/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataObjectsRelation').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataObjectsRelation').append('<input type="hidden" name="objects_relation[]" value="'+value.id+'"/>');
                                });
                                countMan()
                            }else{
                                $('#objectAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.objects_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countMan();
                }
            }else{
                countMan();
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
                                countMan()
                            }else{
                                $('#carAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.signal_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countMan();
                }
            }else{
                countMan();
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
                                countMan()
                            }else{
                                $('#weaponAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.weapon_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countMan();
                }
            }else{
                countMan();
            }

            if( typeof $('#emailForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('emailForm')){
                    var data = $('#emailForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_email/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataEmail').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataEmail').append('<input type="hidden" name="email[]" value="'+value.id+'"/>');
                                });
                                countMan();
                            }else{
                                $('#emailAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.email_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countMan();
                }
            }else{
                countMan();
            }

//            $('#preloader').hide();
        });

    });

    function countMan(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedMan').submit();
        }
    }

</script>

@endsection
@endsection
