<div style="width: 100%;text-align: center;position: fixed;top: 0px;background: #F9F9F9;">
    <div class="forForm" style="width: 80%" id="filter">
        <label for="autoComplete" ><?php echo $Lang->filtr;?></label>
        <input type="text" id="autoComplete"/>
        <input type="button" id="open" value="&darr; <?php echo $Lang->createNew;?> &darr;" style="margin-top: 10px"/>
    </div>
    <div id="newRecord" class="forForm" style="width: 99%;display: none;height: 100%">
        <form id="newRecordForm">
            <div class="forForm">
                <label for="newRecordCountry" ><?php echo $Lang->country;?></label>
                <input type="text" name="country_name" id="newRecordCountry" />
                <input type="hidden" name="country_id" id="newRecordCountryId" />
            </div>
            <div class="forForm">
                <label for="newRecordRegion" ><?php echo $Lang->region;?></label>
                <input type="text" name="region_name" id="newRecordRegion" />
                <input type="hidden" name="region_id" id="newRecordRegionId" />
            </div>
            <div class="forForm">
                <label for="newRecordCity" ><?php echo $Lang->city;?></label>
                <input type="text" name="city_name" id="newRecordCity" />
                <input type="hidden" name="city_id" id="newRecordCityId" />
            </div>
            <div class="forForm">
                <label for="newRecordLocality" ><?php echo $Lang->locality;?></label>
                <input type="text" name="locality_name" id="newRecordLocality" />
                <input type="hidden" name="locality_id" id="newRecordLocalityId" />
            </div>
            <div class="forForm">
                <label for="newRecordStreet" ><?php echo $Lang->street;?></label>
                <input type="text" name="locality_name" id="newRecordStreet" />
                <input type="hidden" name="locality_id" id="newRecordStreetId" />
            </div>
            <div class="forForm">
                <label for="newRecordTrack" ><?php echo $Lang->track;?> </label>track
                <input type="text" name="locality_name" id="newRecordTrack" />
                <input type="hidden" name="locality_id" id="newRecordTrackId" />
            </div>
            <div class="forForm">
                <label for="newRecordHomeNum" ><?php echo $Lang->home_num;?> </label>
                <input type="text" name="home_num" id="newRecordHomeNum" />
            </div>
            <div class="forForm">
                <label for="newRecordHousingNum" ><?php echo $Lang->housing_num;?> </label>
                <input type="text" name="housing_num" id="newRecordHousingNum" />
            </div>
            <div class="forForm">
                <label for="newRecordAptNum" ><?php echo $Lang->apt_num;?> </label>
                <input type="text" name="apt_num" id="newRecordAptNum" />
            </div>
            <div class="buttons">
                <input type="button" value="<?php echo $Lang->save;?>" id="save"/>
                <input type="button" value="<?php echo $Lang->cancel;?>" id="cancel"/>
            </div>
        </form>
    </div>

</div>
<div style="width:100%;margin-top: 80px;">
    <table class="fancyTable">
        <tr>
            <td> Id </td>
            <td> <?php echo $Lang->address;?> </td>
            <td> </td>
        </tr>
        <?php foreach($data as $val) { ?>
            <tr class="allTr" id="tr<?php echo $val['id']; ?>">
                <td> <?php echo $val['id']; ?> </td>
                <td> <?php echo $val['name']; ?> </td>
                <td> <input class="add" type="button" dataId="<?php echo $val['id'];?>" name="<?php echo $val['name'];?>" value="<?php echo $Lang->add;?>" /> </td>
            </tr>
        <?php }?>
    </table>
</div>

<script>
    $(document).ready(function(){
        $(this).keyup(function(e){
            e.preventDefault();
            if(e.keyCode == 27){
                parent.closeAllFancy();
            }
        });

        $("#autoComplete").kendoAutoComplete({
            minLength: 1,
            dataTextField: "name",
            filter: 'contains',
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>autocomplete/address"
                    }
                }
            },
            dataBound : function(e){
                $('.k-animation-container').hide();
                var data = e.sender.dataSource._view;
                if( data.length != 0){
//                    $('.fancyTable').html('<tr><td> Id </td><td> Название </td><td> </td></tr>');
                    $('.allTr').hide();
                    $.each(data,function(key,val){
                        $('#tr'+val.id).show();
                    });
                }
            },
            width: 500,
            height: 370
        });

        $('#newRecordCountry').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/country/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#newRecordCountryId').val(dataItem.id);
            }
        });

        $('#newRecordRegion').kendoAutoComplete({
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
                $('#newRecordRegionId').val(dataItem.id);
            }
        });

        $('#newRecordLocality').kendoAutoComplete({
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
                $('#newRecordLocalityId').val(dataItem.id);
            }
        });

        $('#newRecordStreet').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/street/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#newRecordStreetId').val(dataItem.id);
            }
        });

        $('#newRecordCity').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/city/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#newRecordCityId').val(dataItem.id);
            }
        });


        $('.add').live('click',function(e){
            e.preventDefault();
            var name = $(this).attr('name');
            var id = $(this).attr('dataId');
            parent.closeF(name,id);
        });

        $('#open').click(function(e){
            e.preventDefault();
            $('#newRecord').show();
            $('#filter').hide();
        });

        $('#cancel').click(function(e){
            e.preventDefault();
            $('#newRecord').hide();
            $('#filter').show();
        });

        $('#save').click(function(e){
            var first_name = $('#newRecordName').val();
            var last_name = $('#newRecordLastName').val();
            var post_id = $('#newRecordPostId').val();
            var post_name = $('#newRecordPost').val();
            var name = first_name+' '+last_name+' '+post_name;
            if(first_name.length == 0){
                alert('<?php echo $Lang->enter_the_name?> ');
                return false;
            }
            if(last_name.length == 0){
                alert('<?php echo $Lang->enter_the_last_name?>');
                return false;
            }
            if(post_id.length == 0){
                alert('<?php echo $Lang->enter_post?>');
                return false;
            }
            var data = $('#newRecordForm').serializeArray();
            $.ajax({
                url: '<?php echo ROOT?>autocomplete/fancyWorker/',
                type: 'POST',
                data:data,
                dataType:'json',
                success: function(data){
//                    alert(data.id);
                    parent.closeF(name,data.id);
                },
                faild: function(data){
                    alert('error ');
                }
            });
        });

    });
</script>