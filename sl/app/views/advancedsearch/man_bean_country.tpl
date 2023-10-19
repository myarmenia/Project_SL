
<form id="advancedManBeanCountry" method="post" action="<?php echo ROOT; ?>advancedsearch/result_man_bean_country">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
        <input type="submit" class="k-button" id="submitAdvancedSearchManBeanCountry" value="<?php echo $Lang->search;?>" />
    </div>
    <div id="dataManBeanCountry" style="display: none;"></div>
    <div id="dataMan" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="mbcAdv"><?php echo $Lang->man_bean_country; ?></li>
        <li id="manAdv"><?php echo $Lang->face; ?></li>
    </ul>
</div>




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
                '<?php echo ROOT; ?>simplesearch/simple_search_man_bean_country/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_man/1'
            ]
        });


        $('#submitAdvancedSearchManBeanCountry').click(function(e){
            e.preventDefault();
            countAjax = 0;
            $('#preloader').show();
            $('.redBack').removeClass('redBack');
            if( typeof $('#manBeanCountryForm').attr('action') != 'undefined' ) {
                if(formNotEmpty('manBeanCountryForm')){
                    var data = $('#manBeanCountryForm').serializeArray();
                    $.ajax({
                        'url' : '<?php echo ROOT; ?>simplesearch/result_man_bean_country/1',
                        'type' : 'POST',
                        'data':data,
                        'dataType' : 'json',
                        'success':function(data){
                            if(data.status){
                                $('#dataManBeanCountry').html('');
                                $.each(data.data,function(key,value){
                                    $('#dataManBeanCountry').append('<input type="hidden" name="man_bean_country[]" value="'+value.id+'"/>');
                                });
                                countManBeanCountry()
                            }else{
                                $('#mbcAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->man_bean_country_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countManBeanCountry();
                }
            }else{
                countManBeanCountry();
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
                                countManBeanCountry()
                            }else{
                                $('#manAdv').addClass('redBack');
                                $('#preloader').hide();
                                alert('<?php echo $Lang->person_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    countManBeanCountry();
                }
            }else{
                countManBeanCountry();
            }          

//            $('#preloader').hide();
        });

    });

    function countManBeanCountry(){
        countAjax++;
        if(countAjax == realCount){
            $('#advancedManBeanCountry').submit();
        }
    }

</script>