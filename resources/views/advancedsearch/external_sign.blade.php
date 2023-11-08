@extends('layouts.include-app')

@section('content-include')

<form id="advancedExternalSign" method="post" action="{{ route('advanced_result_external_sign') }}">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchExternalSign" value="{{ __('content.search') }}" />
    </div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataExternalSign" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="extAdv">{{ __('content.external_signs') }}</li>
        <li id="manAdv">{{ __('content.face') }}</li>

    </ul>
</div>

@section('js-include')

<script>

    var countAjax = 0;
    var realCount = 2;
    $(document).ready(function(e){

        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });


        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                `/${lang}/simplesearch/simple_search_external_signs/1`,
                `/${lang}/simplesearch/simple_search_man/1`
            ]
        });


        $('#submitAdvancedSearchExternalSign').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');
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
                                countExternalSign();
                            }else{
                                $('#extAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.sign_found') }}` );
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countExternalSign();
                }
            }else{
                countExternalSign();
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
                                countExternalSign();
                            }else{
                                $('#manAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.face_found') }}` );
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countExternalSign();
                }
            }else{
                countExternalSign();
            }

//            $('#preloader').hide();
        });

    });

    function countExternalSign(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedExternalSign').submit();
        }
    }

</script>

@endsection
@endsection
