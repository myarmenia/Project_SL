
@extends('layouts.include-app')

@section('content-include')
    <x-back-previous-url />
<form id="advancedPhone" method="post" action="{{ route('advanced_result_phone') }}">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchPhone" value="{{ __('content.search') }}" />
    </div>
    <div id="dataPhone" style="display: none;"></div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="phoneAdv">{{ __('content.telephone') }}</li>
        <li id="manAdv">{{ __('content.face') }}</li>
        <li id="organizationAdv">{{ __('content.organization') }}</li>
        <li id="actionAdv">{{ __('content.action') }}</li>
    </ul>
</div>
<x-fullscreen-modal/>
@section('js-include')
<script>

    var countAjax = 0;
    var realCount = 4;
    $(document).ready(function(e){

        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });


        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                `/${lang}/simplesearch/simple_search_phone/1`,
                `/${lang}/simplesearch/simple_search_man/1`,
                `/${lang}/simplesearch/simple_search_organization/1`,
                `/${lang}/simplesearch/simple_search_action/1`
            ]
        });


        $('#submitAdvancedSearchPhone').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');

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
                                countPhone();
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
                    countPhone();
                }
            }else{
                countPhone();
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
                                countPhone()
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
                    countPhone();
                }
            }else{
                countPhone();
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
                                countPhone()
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
                    countPhone();
                }
            }else{
                countPhone();
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
                                countPhone()
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
                    countPhone();
                }
            }else{
                countPhone();
            }

        });

    });

    function countPhone(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedPhone').submit();
        }
    }

</script>

@endsection
@endsection
