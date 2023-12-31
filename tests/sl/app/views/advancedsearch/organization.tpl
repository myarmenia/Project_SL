
<form id="advancedOrganization" method="post" action="<?php echo ROOT; ?>advancedsearch/result_organization">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
        <input type="submit" class="k-button" id="submitAdvancedSearchOrganization" value="<?php echo $Lang->search;?>" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataOrganization" style="display: none;"></div>
    <div id="dataMiaSummary" style="display: none;"></div>
    <div id="dataAction" style="display: none;"></div>
    <div id="dataEvent" style="display: none;"></div>
    <div id="dataCriminalCase" style="display: none;"></div>
    <div id="dataSignal" style="display: none;"></div>
    <div id="dataAddress" style="display: none;"></div>
    <div id="dataPhone" style="display: none;"></div>
    <div id="dataWorkActivity" style="display: none;"></div>
    <div id="dataObjectsRelation" style="display: none;"></div>
    <div id="dataCar" style="display: none;"></div>
    <div id="dataWeapon" style="display: none;"></div>
    <div id="dataEmail" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="organizationAdv"><?php echo $Lang->organization; ?></li>
        <li id="biblAdv"><?php echo $Lang->bibliography; ?></li>
        <li id="miaAdv"><?php echo $Lang->mia_summary; ?></li>
        <li id="actionAdv"><?php echo $Lang->action; ?></li>
        <li id="eventAdv"><?php echo $Lang->event; ?></li>
        <li id="caseAdv"><?php echo $Lang->criminal_case; ?></li>
        <li id="signalAdv"><?php echo $Lang->signal; ?></li>
        <li id="addressAdv"><?php echo $Lang->address; ?></li>
        <li id="phoneAdv"><?php echo $Lang->telephone; ?></li>
        <li id="workAdv"><?php echo $Lang->work_activity; ?></li>
        <li id="objectAdv"><?php echo $Lang->relationship_objects; ?></li>
        <li id="carAdv"><?php echo $Lang->car; ?></li>
        <li id="weaponAdv"><?php echo $Lang->weapon; ?></li>
        <li id="emailAdv"><?php echo $Lang->email; ?></li>
    </ul>
</div>




<script>

    var countAjax = 0;
    var realCount = 14;
    $(document).ready(function(e){

        $('#tabstrip ul li').live('click',function(){
            $('#'+$(this).attr('id')).addClass('active_tab');
        });


        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                '<?php echo ROOT; ?>simplesearch/simple_search_organization/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_bibliography/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_mia_summary/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_action/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_event/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_criminal_case/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_signal/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_address/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_phone/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_work_activity/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_objects_relation/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_car/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_weapon/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_email/1'
            ]
        });


        $('#submitAdvancedSearchOrganization').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');
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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
            }

            if (typeof $('#miaSummaryForm').attr('action') != 'undefined'){
                if(formNotEmpty('miaSummaryForm')){
                    var data = $('#miaSummaryForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_mia_summary/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataMiaSummary').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataMiaSummary').append('<input type="hidden" name="mia_summary[]" value="'+value.id+'"/>');
                                });
                                countOrganization()
                            }else{
                                $('#miaAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->mia_summary_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countOrganization();
                }
            }else{
                countOrganization();
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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
            }

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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
            }           

            if( typeof $('#objectForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('objectForm')){
                    var data = $('#objectForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_objects_relation/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataObjectsRelation').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataObjectsRelation').append('<input type="hidden" name="objects_relation[]" value="'+value.id+'"/>');
                                });
                                countOrganization()
                            }else{
                                $('#objectAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->objects_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countOrganization();
                }
            }else{
                countOrganization();
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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
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
                                countOrganization()
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
                    countOrganization();
                }
            }else{
                countOrganization();
            }

            if( typeof $('#emailForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('emailForm')){
                    var data = $('#emailForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_email/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataEmail').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataEmail').append('<input type="hidden" name="email[]" value="'+value.id+'"/>');
                                });
                                countOrganization();
                            }else{
                                $('#emailAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->email_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countOrganization();
                }
            }else{
                countOrganization();
            }

//            $('#preloader').hide();
        });

    });

    function countOrganization(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedOrganization').submit();
        }
    }

</script>