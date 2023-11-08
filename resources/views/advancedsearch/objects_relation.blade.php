@extends('layouts.include-app')

@section('content-include')

<form id="advancedObjectRelation" method="post" action="{{ route('advanced_result_objects_relation') }}">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button">{{ __('content.reset') }}</a>
        <input type="submit" class="k-button" id="submitAdvancedSearchObjectRelation" value="{{ __('content.search') }}" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataObjectsRelation" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="objectAdv">{{ __('content.relationship_objects') }}</li>
        <li id="manAdv">{{ __('content.face') }}</li>
        <li id="organizationAdv">{{ __('content.organization') }}</li>
    </ul>
</div>

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
                `/${lang}/simplesearch/simple_search_objects_relation/1`,
                `/${lang}/simplesearch/simple_search_man/1`,
                `/${lang}/simplesearch/simple_search_organization/1`
            ]
        });


        $('#submitAdvancedSearchObjectRelation').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');
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
                                countObjectsRelation()
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
                    countObjectsRelation();
                }
            }else{
                countObjectsRelation();
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
                                countObjectsRelation()
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
                    countObjectsRelation();
                }
            }else{
                countObjectsRelation();
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
                                countObjectsRelation()
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
                    countObjectsRelation();
                }
            }else{
                countObjectsRelation();
            }
//            $('#preloader').hide();
        });

    });

    function countObjectsRelation(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedObjectRelation').submit();
        }
    }

</script>

@endsection
@endsection
