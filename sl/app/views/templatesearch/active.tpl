<a class = "closeButton"></a>
<div class="inContent">
    <form id="startedForm" action="<?php echo ROOT;?>templatesearch/result/active" method="post">

        <div class="forForm byDate">
            <label for="signalDateRegistrationDivision"><?php echo $Lang->date_actual;?></label>
            <input type="text" title=">= OR null" name="subunit_date_to" id="signalDateRegistrationDivisionTO" style="width: 505px;" onkeydown="validateNumber(event,'signalDateRegistrationDivisionTO',12)" class="oneInputSaveEnter oneInputSaveDateSignal"/>
        </div>

        <div class="forForm byDate">
            <label for="signalDateRegistrationDivision"><?php echo $Lang->date_registration_division;?></label>
            <input type="text" title="<=" name="subunit_date" id="signalDateRegistrationDivision" style="width: 505px;" onkeydown="validateNumber(event,'signalDateRegistrationDivision',12)" class="oneInputSaveEnter oneInputSaveDateSignal"/>
            <!--select id="op" name="op" style="width: 97px;">
                <option value="equal"><?php echo $Lang->equal;?></option>
                <option value="interval"><?php echo $Lang->interval; ?></option>
                <option value="more"><?php echo $Lang->more_equal;?></option>
                <option value="less"><?php echo $Lang->less_equal;?></option>
            </select-->
        </div>

        <div class="forForm" id="byAgency">
            <label for="signalBroughtSignal"><?php echo $Lang->checks_signal;?></label>
            <input type="button" dataName="signalBroughtSignal" dataId="signalBroughtSignalId" dataTableName="fancy/agency" class="addMore k-icon k-i-plus"   />
            <input type="text" name="opened_agency" id="signalBroughtSignal" dataTableName="agency" dataInputId="signalBroughtSignalId" class="oneInputSaveEnter" />
            <input type="hidden" name="opened_agency_id" id="signalBroughtSignalId" />
        </div>

        <div class="forForm" >
            <label for="searchSignalQualificationsSignaling"><?php echo $Lang->qualifications_signaling;?></label>
            <input type="button" dataName="searchSignalQualificationsSignaling" dataId="searchSignalQualificationsSignalingId" dataTableName="fancy/signal_qualification" class="addMore k-icon k-i-plus"   />
            <input type="text" name="signal_qualification" id="searchSignalQualificationsSignaling" dataTableName="signal_qualification" dataInputId="searchSignalQualificationsSignalingId" class="oneInputSaveEnter" />
            <input type="hidden" name="signal_qualification_id" id="searchSignalQualificationsSignalingId" />
        </div>

        <div class="buttons">
            <input type="submit" class="k-button" name="submit" id="search" value="<?php echo $Lang->search;?>" style="display: none;" />
            <a id="check" class="k-button"><?php echo $Lang->search;?></a>
        </div>

    </form>
</div>

<script>

    var currentInputNameSignal;
    var currentInputIdSignal;
    $(document).ready(function(){

        $('#check').click(function(e){
            e.preventDefault();
            $('#search').trigger('click');
        });

        $('.oneInputSaveDateSignal').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('#op').change(function(e){
            var val = $(this).val();
            if( val == 'interval'){
                $("#signalDateRegistrationDivisionTO").data("kendoDatePicker").enable();
            }else{
                $("#signalDateRegistrationDivisionTO").data("kendoDatePicker").enable(false);
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

        $('#signalBroughtSignal').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/agency/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#signalBroughtSignalId').val(dataItem.id);
            }
        });
        $('#signalBroughtSignal').focusout(function(e){
            e.preventDefault();
            var text = $('#signalBroughtSignal').val();
            var value = $('#signalBroughtSignalId').val();
            var field = $('#signalBroughtSignalId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    alert('<?php echo $Lang->enter_agency;?>');
                    $('#signalBroughtSignal').val('');
                    $('#signalBroughtSignalId').val('');
                }
            }
        });

        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameSignal = $(this).attr('dataName');
            currentInputIdSignal = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=signal"
            });
        });

        $('#searchSignalQualificationsSignaling').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/signal_qualification/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#searchSignalQualificationsSignalingId').val(dataItem.id);
            }
        });

//        $("#signalDateRegistrationDivisionTO").data("kendoDatePicker").enable(false);

    });

    function closeSignal(name,id){
        //        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameSignal).val(name);
        $('#'+currentInputIdSignal).val(id);
        var field = $('#'+currentInputIdSignal).attr('name');
        $.fancybox.close();
    }





</script>

