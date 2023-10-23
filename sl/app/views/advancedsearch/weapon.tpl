
<form id="advancedWeapon" method="post" action="<?php echo ROOT; ?>advancedsearch/result_weapon">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
        <input type="submit" class="k-button" id="submitAdvancedSearchWeapon" value="<?php echo $Lang->search;?>" />
    </div>
    <div id="dataWeapon" style="display: none;"></div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
    <div id="dataEvent" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="weaponAdv"><?php echo $Lang->weapon; ?></li>
        <li id="manAdv"><?php echo $Lang->face; ?></li>
        <li id="organizationAdv"><?php echo $Lang->organization; ?></li>
        <li id="actionAdv"><?php echo $Lang->action; ?></li>
        <li id="eventAdv"><?php echo $Lang->event; ?></li>
    </ul>
</div>




<script>

    var countAjax = 0;
    var realCount = 5;
    $(document).ready(function(e){

        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });


        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                '<?php echo ROOT; ?>simplesearch/simple_search_weapon/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_man/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_organization/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_action/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_event/1'
            ]
        });


        $('#submitAdvancedSearchWeapon').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');
            if( typeof $('#weaponForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('weaponForm')){
                    var data = $('#weaponForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_weapon/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataWeapon').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataWeapon').append('<input type="hidden" name="weapon[]" value="'+value.id+'"/>');
                                });
                                countWeapon()
                            }else{
                                $('#weaponAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->weapon_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countWeapon();
                }
            }else{
                countWeapon();
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
                                countWeapon()
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
                    countWeapon();
                }
            }else{
                countWeapon();
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
                                countWeapon()
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
                    countWeapon();
                }
            }else{
                countWeapon();
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
                                countWeapon()
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
                    countWeapon();
                }
            }else{
                countWeapon();
            }

            if (typeof $('#eventForm').attr('action') != 'undefined'){
                if(formNotEmpty('eventForm')){
                    var data = $('#eventForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_event/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataEvent').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataEvent').append('<input type="hidden" name="event[]" value="'+value.id+'"/>');
                                });
                                countWeapon()
                            }else{
                                $('#eventAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->event_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countWeapon();
                }
            }else{
                countWeapon();
            }


        });

    });

    function countWeapon(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedWeapon').submit();
        }
    }

</script>