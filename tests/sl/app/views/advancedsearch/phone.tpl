
<form id="advancedPhone" method="post" action="<?php echo ROOT; ?>advancedsearch/result_phone">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
        <input type="submit" class="k-button" id="submitAdvancedSearchPhone" value="<?php echo $Lang->search;?>" />
    </div>
    <div id="dataPhone" style="display: none;"></div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="phoneAdv"><?php echo $Lang->telephone; ?></li>
        <li id="manAdv"><?php echo $Lang->face; ?></li>
        <li id="organizationAdv"><?php echo $Lang->organization; ?></li>
        <li id="actionAdv"><?php echo $Lang->action; ?></li>
    </ul>
</div>




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
                '<?php echo ROOT; ?>simplesearch/simple_search_phone/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_man/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_organization/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_action/1'               
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
                        'url' : '<?php echo ROOT; ?>simplesearch/result_phone/1',
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
                                alert('<?php echo $Lang->phone_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
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
                                countPhone()
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
                    countPhone();
                }
            }else{
                countPhone();
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
                                countPhone()
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
                    countPhone();
                }
            }else{
                countPhone();
            }
           

            if (typeof $('#actionForm').attr('action') != 'undefined'){
                if(formNotEmpty('actionForm')){
                    var data = $('#actionForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_action/1',
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
                                alert('<?php echo $Lang->action_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
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