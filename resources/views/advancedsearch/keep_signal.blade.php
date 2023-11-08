@extends('layouts.include-app')

@section('content-include')

<form id="advancedSearchKeepSignal" method="post" action="{{ route('advanced_result_keep_signal') }}">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset')}}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchKeepSignal" value="{{ __('content.search')}}" />
    </div>
    <div id="dataKeepSignal" style="display: none;"></div>
    <div id="dataSignal" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="keepAdv">{{ __('content.keep_signal')}}</li>
        <li id="signalAdv">{{ __('content.signal')}}</li>
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
                `/${lang}/simplesearch/simple_search_keep_signal/1`,
                `/${lang}/simplesearch/simple_search_signal/1`
            ]
        });


        $('#submitAdvancedSearchKeepSignal').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');
            if (typeof $('#keepSignalForm').attr('action') != 'undefined'){
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
                                countKeepSignal()
                            }else{
                                $('#keepAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert(`{{ __('content.keep_signal_found') }}`);
                            }
                        },
                        faild: function(data){
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }else{
                    countKeepSignal();
                }
            }else{
                countKeepSignal();
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
                                countKeepSignal()
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
                    countKeepSignal();
                }
            }else{
                countKeepSignal();
            }


//            $('#preloader').hide();
        });

    });

    function countKeepSignal(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedSearchKeepSignal').submit();
        }
    }

</script>

@endsection
@endsection
