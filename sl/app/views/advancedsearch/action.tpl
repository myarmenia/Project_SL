
<form id="advancedAction" method="post" action="<?php echo ROOT; ?>advancedsearch/result_action">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
        <input type="submit" class="k-button" id="submitAdvancedSearchAction" value="<?php echo $Lang->search;?>" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
    <div id="dataEvent" style="display: none;"></div>
    <div id="dataCriminalCase" style="display: none;"></div>
    <div id="dataSignal" style="display: none;"></div>
    <div id="dataAddress" style="display: none;"></div>
    <div id="dataPhone" style="display: none;"></div>
    <div id="dataCar" style="display: none;"></div>
    <div id="dataWeapon" style="display: none;"></div>
    <div id="dataOrganization" style="display: none;"></div>
</form>

<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="actionAdv"><?php echo $Lang->action; ?></li>
        <li id="manAdv"><?php echo $Lang->face; ?></li>
        <li id="organizationAdv"><?php echo $Lang->organization; ?></li>
        <li id="biblAdv"><?php echo $Lang->bibliography; ?></li>
        <li id="eventAdv"><?php echo $Lang->event; ?></li>
        <li id="caseAdv"><?php echo $Lang->criminal_case; ?></li>
        <li id="signalAdv"><?php echo $Lang->signal; ?></li>
        <li id="addressAdv"><?php echo $Lang->address; ?></li>
        <li id="phoneAdv"><?php echo $Lang->telephone; ?></li>
        <li id="carAdv"><?php echo $Lang->car; ?></li>
        <li id="weaponAdv"><?php echo $Lang->weapon; ?></li>

    </ul>
</div>





<script>

    var countAjax = 0;
    var realCount = 11;
    $(document).ready(function(e){

        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });


        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                '<?php echo ROOT; ?>simplesearch/simple_search_action/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_man/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_organization/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_bibliography/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_event/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_criminal_case/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_signal/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_address/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_phone/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_car/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_weapon/1',
                
            ]
        });


        $('#submitAdvancedSearchAction').click(function(e){
            e.preventDefault();
            $('.redBack').removeClass('redBack');
            countAjax = 0;
            $('#preloader').show();
            if (typeof $('#bibliographyForm').attr('action') != 'undefined'){
                if(formNotEmpty('bibliographyForm')){
                    var data = $('#bibliographyForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_bibliography/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataBibliography').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataBibliography').append('<input type="hidden" name="bibliography[]" value="'+value.id+'"/>');
                                });
                                countAction()
                            }else{
                                $('#biblAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->bibliography_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countAction();
                }
            }else{
                countAction();
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
                                countAction()
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
                    countAction();
                }
            }else{
                countAction();
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
                                countAction()
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
                    countAction();
                }
            }else{
                countAction();
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
                                countAction()
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
                    countAction();
                }
            }else{
                countAction();
            }

            if (typeof $('#criminalCaseForm').attr('action') != 'undefined'){
                if(formNotEmpty('criminalCaseForm')){
                    var data = $('#criminalCaseForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_criminal_case/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataCrminalCase').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataCrminalCase').append('<input type="hidden" name="criminal_case[]" value="'+value.id+'"/>');
                                });
                                countAction()
                            }else{
                                $('#caseAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->criminal_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countAction();
                }
            }else{
                countAction();
            }

            if( typeof $('#signalForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('signalForm')){
                    var data = $('#signalForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_signal/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataSignal').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataSignal').append('<input type="hidden" name="signal[]" value="'+value.id+'"/>');
                                });
                                countAction()
                            }else{
                                $('#signalAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->signal_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countAction();
                }
            }else{
                countAction();
            }

            if( typeof $('#addressForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('addressForm')){
                    var data = $('#addressForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_address/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataAddress').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataAddress').append('<input type="hidden" name="address[]" value="'+value.id+'"/>');
                                });
                                countAction()
                            }else{
                                $('#addressAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->address_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countAction();
                }
            }else{
                countAction();
            }

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
                                countAction()
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
                    countAction();
                }
            }else{
                countAction();
            }

            if( typeof $('#carForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('carForm')){
                    var data = $('#carForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_car/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataCar').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataCar').append('<input type="hidden" name="car[]" value="'+value.id+'"/>');
                                });
                                countAction()
                            }else{
                                $('#carAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->car_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countAction();
                }
            }else{
                countAction();
            }

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
                                countAction()
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
                    countAction();
                }
            }else{
                countAction();
            }

            if( typeof $('#organizationForm').attr('action') != 'undefined' ) {
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
                                countAction();
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
                    countAction();
                }
            }else{
                countAction();
            }

//            $('#preloader').hide();
        });

    });

    function countAction(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedAction').submit();
        }
    }

</script>