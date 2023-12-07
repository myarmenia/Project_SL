<a class="closeButton" id="closeBibl" xmlns="http://www.w3.org/1999/html"></a>
<div class="inContent">
    <form id="FusionFindForm" method="POST" action="<?php  if (isset($functionName)){ echo  ROOT.'fusion/'.$functionName; }?>">
        <div class="forForm">
            <label for="biblSource"><?php echo $Lang->first_id; ?></label>
            <input type="number" id="fusionId1" name="id1" onkeydown="validateNumber(event ,'fusionId1',11)"  />
        </div>
        <div class="forForm">
            <label for="biblSource"><?php echo $Lang->second_id; ?></label>
            <input type="number" id="fusionId2" name="id2"  onkeydown="validateNumber(event ,'fusionId2',11)" />
        </div>
        <div class="forForm">
            <input type="button"  class="k-button" id="fusionSubmit" value="<?php echo $Lang->start_fusion ; ?>"  />
        </div>
    </form>
</div>

<script>

    $(document).ready(function(e){
        var table = '<?php echo $functionName;?>';
       $('#fusionSubmit').click(function(e){
           var val1 = $('#fusionId1').val();
           var val2 = $('#fusionId2').val();
           $('#preloader').show();
           $.ajax({
               url: '<?php echo ROOT?>add/checkDicId/'+val1,
               type:'POST',
               data:{ 'table': table },
               dataType:'json',
               success: function(data){
                   if(data.status){
                       $.ajax({
                           url: '<?php echo ROOT?>add/checkDicId/'+val2,
                           type:'POST',
                           data:{ 'table':table },
                           dataType:'json',
                           success: function(data){
                               if(data.status){
                                   $('#FusionFindForm').submit();
                               }else{
                                   alert(val2+' <?php echo $Lang->no_id;?>');
                                   $('#preloader').hide();
                               }
                           },
                           faild: function(data){
                               alert('<?php echo $Lang->err;?> ');
                           }
                       });
                   }else{
                       alert(' '+val1+' <?php echo $Lang->no_id;?>');
                       $('#preloader').hide();
                   }
               },
               faild: function(data){
                   alert('<?php echo $Lang->err;?> ');
               }
           });
       });
    });

</script>