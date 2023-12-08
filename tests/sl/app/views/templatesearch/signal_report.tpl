<a class = "closeButton"></a>
<div class="inContent" style="width: 800px !important;">
    <?php $now = date("Y");?>
    <form id="reportForm" action="<?php echo ROOT;?>templatesearch/excel_signal_report" method="post">
        <div class="forForm">
            <label><?php echo $Lang->report_search_signal; ?></label>
            <select id="qt" name="type" style="width: 300px;">
                <option value="1_q">1 <?php echo $Lang->quarter; ?></option>
                <option value="2_q">2 <?php echo $Lang->quarter; ?></option>
                <option value="1_h">I <?php echo $Lang->half_year; ?></option>
                <option value="3_q">3 <?php echo $Lang->quarter; ?></option>
                <option value="4_q">4 <?php echo $Lang->quarter; ?></option>
                <option value="2_h">II <?php echo $Lang->half_year; ?></option>
                <option value="y"><?php echo $Lang->year; ?></option>
            </select>
            <select name="year" id="year" style="width: 300px;">
                <?php for($i=$now;$i >= '1990';$i--){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="buttons">
            <input type="button" class="k-button" id="searchReport" value="<?php echo $Lang->report_search;?>" />
        </div>

    </form>
</div>

<script>

    var currentInputNameSignal;
    var currentInputIdSignal;
    $(document).ready(function(){

        $('.oneInputSaveDateSignal').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('.oneInputSaveDateSignal').focusout(function(e){
            var val = $(this).val();
            var field = $(this).attr('name');
            var reg = date_preg;
            if( (typeof $(this).attr('type') != 'undefined')&&(val.length != 0) ){
                if( (val.length == 6)||(val.length == 8) ){
                    var day = val.slice(0,2);
                    var month = val.slice(2,4);
                    var year = val.slice(4,8);
                    if(year.length == 2){
                        year = '20'+year;
                    }
                    val = day+'-'+month+'-'+year;
                    if(reg.test(val)){
                        $(this).val(val);
                    }else{
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }
            }
        });

        $('#searchReport').click(function(e){
            e.preventDefault();
            $('#reportForm').submit();
        });

    });

</script>

