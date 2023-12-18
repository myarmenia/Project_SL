@extends('layouts.include-app')

@section('content-include')

<form id="advancedWorkActivity" method="post" action="{{ route('advanced_result_work_activity') }}">
    <x-back-previous-url />
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchWorkActivity" value="{{ __('content.search') }}" />
    </div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataWorkActivity" style="display: none;"></div>
</form>
<div style="clear: both;"></div>


<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="workAdv">{{ __('content.work_activity') }}</li>
        <li id="manAdv">{{ __('content.face') }}</li>
        <li id="organizationAdv">{{ __('content.organization') }}</li>
    </ul>
</div>
<x-fullscreen-modal/>

@section('js-include')

<script>

    var countAjax = 0;
    var realCount = 3;
    $(document).ready(function(e){

        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });


        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                `/${lang}/simplesearch/simple_search_work_activity/1`,
                `/${lang}/simplesearch/simple_search_man/1`,
                `/${lang}/simplesearch/simple_search_organization/1`
            ]
        });


        $('#submitAdvancedSearchWorkActivity').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');
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
                                countWorkActivity()
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
                    countWorkActivity();
                }
            }else{
                countWorkActivity();
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
                                countWorkActivity()
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
                    countWorkActivity();
                }
            }else{
                countWorkActivity();
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
                                countWorkActivity()
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
                    countWorkActivity();
                }
            }else{
                countWorkActivity();
            }

//            $('#preloader').hide();
        });

    });

    function countWorkActivity(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedWorkActivity').submit();
        }
    }

</script>

@endsection
@endsection
