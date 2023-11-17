<a class="closeButton"></a>
<div class="inContent">
    <form id="manBeanCountryForm">
        <div class="forForm">
            <label for="mbcPurposeVisit"><?php echo $Lang->purpose_visit;?></label>
            <input type="button" dataName="mbcPurposeVisit" dataId="mbcPurposeVisitId" dataTableName="fancy/goal" class="addMore" value=" + " />
            <input type="text" class = "oneInputSaveEnter" dataTableName ="goal" dataInputId = "mbcPurposeVisitId" name="goal_name" id="mbcPurposeVisit"/>
            <input type="hidden" name="goal_id" id="mbcPurposeVisitId" />
        </div>

        <div class="forForm">
            <label for="mbcCountryAte"><?php echo $Lang->country_ate;?></label>
            <input type="button" dataName="mbcCountryAte" dataId="mbcCountryAteId" dataTableName="fancy/country_ate" class="addMore" value=" + " />
            <input type="text" class = "oneInputSaveEnter" dataTableName = "country_ate" dataInputId = "mbcCountryAteId" name="country_ate" id="mbcCountryAte"/>
            <input type="hidden" name="country_ate_id" id="mbcCountryAteId" />
        </div>

        <div class="forForm">
            <label for="mbcEntryDate"><?php echo $Lang->entry_date;?></label>
            <input type="text" onkeydown="validateNumber(event ,'mbcEntryDate',10)" class="datePicker oneInputSaveEnter" style="width: 505px" name="entry_date" id="mbcEntryDate"/>
        </div>

        <div class="forForm">
            <label for="mbcExitDate"><?php echo $Lang->exit_date;?></label>
            <input type="text" onkeydown="validateNumber(event ,'mbcExitDate',10)" class = "datePicker oneInputSaveEnter" style="width: 505px" name="exit_date" id="mbcExitDate"/>
        </div>

        <div class="forForm">
            <label for="mbcRegionLocal"><?php echo $Lang->region_local;?></label>
            <input type="button" dataName="mbcRegionLocal" dataId="mbcRegionLocalId" dataTableName="fancy/region" class="addMore" value=" + " />
            <input type="text" class = "oneInputSaveEnter" dataTableName = "region" dataInputId = "mbcRegionLocalId" name="region_local" id="mbcRegionLocal"/>
            <input type="hidden" name="region_id" id="mbcRegionLocalId" />
        </div>

        <div class="forForm">
            <label for="mbcLocalityLocal"><?php echo $Lang->locality_local;?></label>
            <input type="button" dataName="mbcLocalityLocal" dataId="mbcLocalityLocalId" dataTableName="fancy/locality" class="addMore" value=" + " />
            <input type="text" class = "oneInputSaveEnter" dataTableName = "locality" dataInputId = "mbcLocalityLocalId" name="locality_local" id="mbcLocalityLocal"/>
            <input type="hidden" name="locality_id" id="mbcLocalityLocalId" />
        </div>

        <div class="forForm">
            <label for="mbcRegion"><?php echo $Lang->region;?></label>
            <input type="text" class = "oneInputSaveEnter" name="region" id="mbcRegion"/>
        </div>

        <div class="forForm">
            <label for="mbcLocality"><?php echo $Lang->locality;?></label>
            <input type="text" class = "oneInputSaveEnter" name="locality" id="mbcLocality"/>
        </div>

        <div class="forForm">
            <label for="mbcInformationPresence"><?php echo $Lang->information_presence;?></label>
            <input type="button" dataName="mbcInformationPresence" dataId="mbcInformationPresenceId" dataTableName="fancy/3" class="addMore" value=" + " />
            <input type="text" name="information_presence" id="mbcInformationPresence"/>
            <input type="hidden" name="information_presence_id" id="mbcInformationPresenceId" />
        </div>


    </form>
</div>




<script>
    var currentInputNameMbc;
    var currentInputIdMbc;
    var mbc_id = 1;
    $(document).ready(function(){
        $('.datePicker').kendoDatePicker({
            format: "yyyy-MM-dd",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });


        $('#mbcRegion').parent().hide();
        $('#mbcLocality').parent().hide();
        $('#mbcRegionLocal').parent().hide();
        $('#mbcLocalityLocal').parent().hide();


        $('#mbcLocality').focusout(function(e){
            e.preventDefault();
            var text = $('#mbcLocality').val();
            if(text.length != 0){
                $.ajax({
                    url: '<?php echo ROOT?>test/mbc_locality/'+mbc_id,
                    type: 'POST',
                    data:{'locality':text},
                    success: function(data){
                        checkMbc = false;
                    },
                    faild: function(data){
                        alert('error ');
                    }
                });
            }
        });

        $('#mbcRegion').focusout(function(e){
            e.preventDefault();
            var text = $('#mbcRegion').val();
            if(text.length != 0){
                $.ajax({
                    url: '<?php echo ROOT?>test/mbc_region/'+mbc_id,
                    type: 'POST',
                    data:{'region':text},
                    success: function(data){
                        checkMbc = false;
                    },
                    faild: function(data){
                        alert('error ');
                    }
                });
            }
        });

        $('#mbcPurposeVisit').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/goal/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#mbcPurposeVisitId').val(dataItem.id);
            }
        });

        $('#mbcPurposeVisit').focusout(function(e){
            e.preventDefault();
            var text = $('#mbcPurposeVisit').val();
            var val = $('#mbcPurposeVisitId').val();

            if(text.length != 0){
                if(val.length == 0){
                    alert('Введите правильный цель вьезда');
                }else{
                    saveMbc(val,'goal_id');
                }
            }
        });

        $('#mbcCountryAte').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/country_ate/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#mbcCountryAteId').val(dataItem.id);
            }
        });



        $('#mbcEntryDate').focusout(function(e){
            e.preventDefault();
            var text = $(this).val();
            if(text.length != 0){
                saveMbc(text,'entry_date');
            }
        });

        $('#mbcExitDate').focusout(function(e){
            e.preventDefault();
            var text = $(this).val();
            if(text.length != 0){
                saveMbc(text,'exit_date');
            }
        });

        $('#mbcCountryAte').focusout(function(e){
            e.preventDefault();
            var text = $('#mbcCountryAte').val();
            var val = $('#mbcCountryAteId').val();


            if(text.length != 0){
                if(val.length == 0){
                    alert('Введите правильную Страну (АТЕ)' );
                }else{
                    saveMbc(val,'country_ate_id');
                    if(val == 3018){
                        $('#mbcRegion').parent().hide();
                        $('#mbcLocality').parent().hide();
                        $('#mbcRegionLocal').parent().parent().show();
                        $('#mbcLocalityLocal').parent().parent().show();
                    }else{
                        $('#mbcRegion').parent().show();
                        $('#mbcLocality').parent().show();
                        $('#mbcRegionLocal').parent().parent().hide();
                        $('#mbcLocalityLocal').parent().parent().hide();
                    }
                }
            }
        });

        $('#mbcRegionLocal').kendoAutoComplete({
                    dataTextField: "name",
                    dataSource: {
                        transport: {
                            read:{
                                dataType: "json",
                                url: "<?php echo ROOT;?>dictionary/region/read"
                            }
                        }
                    },
                    select:function(e){
                        var dataItem = this.dataItem(e.item.index());
                        $('#mbcRegionLocalId').val(dataItem.id);
                    }
        });

        $('#mbcRegionLocal').focusout(function(e){
            e.preventDefault();
            var text = $('#mbcRegionLocal').val();
            var val = $('#mbcRegionLocalId').val();

            if(text.length != 0){
                if(val.length == 0){
                    alert('Введите правильный регион');
                }else{
                    saveMbc(val,'region_id');
                }
            }
        });

         $('#mbcLocalityLocal').kendoAutoComplete({
                    dataTextField: "name",
                    dataSource: {
                        transport: {
                            read:{
                                dataType: "json",
                                url: "<?php echo ROOT;?>dictionary/locality/read"
                            }
                        }
                    },
                    select:function(e){
                        var dataItem = this.dataItem(e.item.index());
                        $('#mbcLocalityLocalId').val(dataItem.id);
                    }
         });

        $('#mbcLocalityLocal').focusout(function(e){
            e.preventDefault();
            var text = $('#mbcLocalityLocal').val();
            var val = $('#mbcLocalityLocalId').val();

            if(text.length != 0){
                if(val.length == 0){
                    alert('Введите правильный населенный пункт');
                }else{
                    saveMbc(val,'locality_id');
                }
            }
        });

           $('#mbcInformationPresence').kendoAutoComplete({
                              dataTextField: "name",
                              dataSource: {
                                  transport: {
                                      read:{
                                          dataType: "json",
                                          url: "<?php echo ROOT;?>dictionary/3/read"
                                      }
                                  }
                              },
                              select:function(e){
                                  var dataItem = this.dataItem(e.item.index());
                                  $('#mbcInformationPresenceId').val(dataItem.id);
                              }
                          });

        $('.oneInputSaveMbc').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                saveMbc(value,field);
            }
        });



        $('#closeMbc').click(function(e){
            e.preventDefault();
            if(checkMbc){
                var confMbc = confirm('Вы ничего не ввели.\n Удалить запись ?');
                if(confMbc){
                    $.ajax({
                        url: '<?php echo ROOT?>test/mbc_delete/'+mbc_id,
                        success: function(data){
                        },
                        faild: function(data){
                            alert('error ');
                        }
                    });
                }
            }
        });




        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameMbc = $(this).attr('dataName');
            currentInputIdMbc = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url
            });
        });

    });

    function closeF(name,id){
        //        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameMbc).val(name);
        $('#'+currentInputIdMbc).val(id);
        var field = $('#'+currentInputIdMbc).attr('name');
        saveMbc(id,field);
        $.fancybox.close();
    }

    function saveMbc(value,field){
        var data = { 'value':value,'field':field };
        $.ajax({
            url: '<?php echo ROOT?>test/mbc_save/'+mbc_id,
            type: 'POST',
            data:data,
            success: function(data){
                checkMbc = false;
            },
            faild: function(data){
                alert('error ');
            }
        });
    }

</script>


