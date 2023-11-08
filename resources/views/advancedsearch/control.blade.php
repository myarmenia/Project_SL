@extends('layouts.include-app')

@section('content-include')

<form id="advancedControl" method="post" action="{{ route('advanced_result_control') }}">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchControl" value="{{ __('content.search') }}" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataControl" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="controlAdv">{{ __('content.control') }}</li>
        <li id="biblAdv">{{ __('content.bibliography') }}</li>
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
                `/${lang}/simplesearch/simple_search_control/1`,
                `/${lang}/simplesearch/simple_search_bibliography/1`
            ]
        });


        $('#submitAdvancedSearchControl').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');
            if (typeof $('#controlForm').attr('action') != 'undefined'){
                if(formNotEmpty('controlForm')){
                    var data = $('#controlForm').serializeArray();
                    $.ajax({
                        'url' : `/${lang}/simplesearch/result_control/1`,
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataControl').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataControl').append('<input type="hidden" name="control[]" value="'+value.id+'"/>');
                                });
                                countControl()
                            }else{
                                $('#controlAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.control_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countControl();
                }
            }else{
                countControl();
            }

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
                                countControl()
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
                    countControl();
                }
            }else{
                countControl();
            }


//            $('#preloader').hide();
        });

    });

    function countControl(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedControl').submit();
        }
    }

</script>

@endsection
@endsection
