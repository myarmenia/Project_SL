@extends('layouts.include-app')

@section('content-include')

<form id="advancedCar" method="post" action="{{ route('result_car') }}">
    <x-back-previous-url />
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchCar" value="{{ __('content.search') }}" />
    </div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
    <div id="dataEvent" style="display: none;"></div>
    <div id="dataAddress" style="display: none;"></div>
    <div id="dataCar" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="carAdv">{{ __('content.car') }}</li>
        <li id="manAdv">{{ __('content.face') }}</li>
        <li id="organizationAdv">{{ __('content.organization') }}</li>
        <li id="actionAdv">{{ __('content.action') }}</li>
        <li id="eventAdv">{{ __('content.event') }}</li>
        <li id="addressAdv">{{ __('content.address') }}</li>
    </ul>
</div>
<x-fullscreen-modal/>

@section('js-include')

<script>



    var countAjax = 0;
    var realCount = 6;
    $(document).ready(function(e){


        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });


        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                `/${lang}/simplesearch/simple_search_car/1`,
                `/${lang}/simplesearch/simple_search_man/1`,
                `/${lang}/simplesearch/simple_search_organization/1`,
                `/${lang}/simplesearch/simple_search_action/1`,
                `/${lang}/simplesearch/simple_search_event/1`,
                `/${lang}/simplesearch/simple_search_address/1`
            ]
        });


        $('#submitAdvancedSearchCar').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');

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
                                countCar()
                            }else{
                                $('#carAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.car_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countCar();
                }
            }else{
                countCar();
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
                                countCar()
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
                    countCar();
                }
            }else{
                countCar();
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
                                countCar()
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
                    countCar();
                }
            }else{
                countCar();
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
                                countCar()
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
                    countCar();
                }
            }else{
                countCar();
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
                                countCar()
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
                    countCar();
                }
            }else{
                countCar();
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
                                countCar()
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
                    countCar();
                }
            }else{
                countCar();
            }

//            $('#preloader').hide();
        });

    });

    function countCar(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedCar').submit();
        }
    }

</script>

@endsection
@endsection

