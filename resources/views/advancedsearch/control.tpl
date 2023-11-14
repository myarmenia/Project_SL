
<form id="advancedControl" method="post" action="<?php echo ROOT; ?>advancedsearch/result_control">
    <div class="buttons">
        <a href="" id="resetButton" class="k-button"><?php echo $Lang->reset; ?></a>
        <input type="submit" class="k-button" id="submitAdvancedSearchControl" value="<?php echo $Lang->search;?>" />
    </div>
    <div id="dataBibliography" style="display: none;"></div>
    <div id="dataControl" style="display: none;"></div>
</form>
<div style="clear: both;"></div>

<div id="tabstrip" >
    <ul>
        <li class="k-state-active" id="controlAdv"><?php echo $Lang->control; ?></li>
        <li id="biblAdv"><?php echo $Lang->bibliography; ?></li>
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
                '<?php echo ROOT; ?>simplesearch/simple_search_control/1',
                '<?php echo ROOT; ?>simplesearch/simple_search_bibliography/1'
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
                        'url' : '<?php echo ROOT; ?>simplesearch/result_control/1',
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
                                alert('<?php echo $Lang->control_found;?>');
                            }
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
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
                                countControl()
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