<form id="advancedWorkActivity" method="post" action="<?php echo ROOT; ?>advancedsearch/result_work_activity">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
        <input type="submit" class="k-button" id="submitAdvancedSearchWorkActivity" value="<?php echo $Lang->search;?>" />
    </div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataWorkActivity" style="display: none;"></div>
</form>
<div style="clear: both;"></div>


<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="workAdv"><?php echo $Lang->work_activity; ?></li>
        <li id="manAdv"><?php echo $Lang->face; ?></li>
        <li id="organizationAdv"><?php echo $Lang->organization; ?></li>
    </ul>
</div>




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
                '<?php echo ROOT; ?>simplesearch/simple_search_work_activity/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_man/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_organization/1'              
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
                        'url' : '<?php echo ROOT; ?>simplesearch/result_work_activity/1',
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
                                alert('<?php echo $Lang->work_activity_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
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
                        'url' : '<?php echo ROOT; ?>simplesearch/result_organization/1',
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
                                alert('<?php echo $Lang->organization_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
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
                        'url' : '<?php echo ROOT; ?>simplesearch/result_man/1',
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
                                alert('<?php echo $Lang->face_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
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