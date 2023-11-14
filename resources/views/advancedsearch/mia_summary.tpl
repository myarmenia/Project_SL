
<form id="advancedMIaSummary" method="post" action="<?php echo ROOT; ?>advancedsearch/result_mia_summary">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
        <input type="submit" class="k-button" id="submitAdvancedSearchMiaSummary" value="<?php echo $Lang->search;?>" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
    <div id="dataMiaSummary" style="display: none;"></div>
    <div id="dataOrganization" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="miaAdv"><?php echo $Lang->mia_summary; ?></li>
        <li id="manAdv"><?php echo $Lang->face; ?></li>
        <li id="biblAdv"><?php echo $Lang->bibliography; ?></li>
        <li id="organizationAdv"><?php echo $Lang->organization; ?></li>
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
                '<?php echo ROOT; ?>simplesearch/simple_search_mia_summary/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_man/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_bibliography/1',                
                '<?php echo ROOT; ?>simplesearch/simple_search_organization/1'               
            ]
        });


        $('#submitAdvancedSearchMiaSummary').click(function(e){
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
                                countMiaSummary()
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
                    countMiaSummary();
                }
            }else{
                countMiaSummary();
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
                                countMiaSummary()
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
                    countMiaSummary();
                }
            }else{
                countMiaSummary();
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
                                countMiaSummary()
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
                    countMiaSummary();
                }
            }else{
                countMiaSummary();
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
                                countMiaSummary()
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
                    countMiaSummary();
                }
            }else{
                countMiaSummary();
            }

//            $('#preloader').hide();
        });

    });

    function countMiaSummary(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedMIaSummary').submit();
        }
    }

</script>