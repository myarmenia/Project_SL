<a class="closeButton" id="<?php echo $_SESSION['counter']; ?>addressCloseButton"></a>
<span class="idNumber"><?php if(isset($address_id)){ echo 'ID : '.$address_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>addressForm">

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressCountry">1) <?php echo $Lang->country;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>addressCountry" dataId="<?php echo $_SESSION['counter']; ?>addressCountryId" dataTableName="fancy/country_ate" class="addMore  addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" address_counter="<?php echo $_SESSION['counter']; ?>" name="country_ate" id="<?php echo $_SESSION['counter']; ?>addressCountry" dataInputId="<?php echo $_SESSION['counter']; ?>addressCountryId" dataTableName="country_ate" class="oneInputSaveEnter" <?php if(isset($address)){ if(!empty($address['country_ate'])){ echo "value='".$address['country_ate']."'"; } }?>/>
            <input type="hidden" name="country_ate_id" id="<?php echo $_SESSION['counter']; ?>addressCountryId" <?php if(isset($address)){ if(!empty($address['country_ate_id'])){ echo "value='".$address['country_ate_id']."'"; } }?>/>
        </div>
        <div>
            <input type="hidden" readonly="readonly" class="oneInputSaveEnter">
            <input style="float: left;" id="<?php echo $_SESSION['counter']; ?>disable_radio_1" class="<?php echo $_SESSION['counter']; ?>disable_radio" type="radio" name="group1" value="0" /><br>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressRegionLocal">2) <?php echo $Lang->region_local;?></label>
            <input id="<?php echo $_SESSION['counter']; ?>addressRegionLocalButton" type="button" dataName="<?php echo $_SESSION['counter']; ?>addressRegionLocal" dataId="<?php echo $_SESSION['counter']; ?>addressRegionLocalId" dataTableName="fancy/region" class="addMore  addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="region_local" id="<?php echo $_SESSION['counter']; ?>addressRegionLocal" dataInputId="<?php echo $_SESSION['counter']; ?>addressRegionLocalId" dataTableName="region" class="oneInputSaveEnter" <?php if(isset($address)){ if( (!empty($address['region']))&&(!empty($address['checkRegion'])) ){ echo "value='".$address['region']."'"; } }?>/>
            <input type="hidden" name="region_id" id="<?php echo $_SESSION['counter']; ?>addressRegionLocalId" <?php if(isset($address)){ if( (!empty($address['region_id']))&&(!empty($address['checkRegion'])) ){ echo "value='".$address['region_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressLocalityLocal">3) <?php echo $Lang->locality_local;?></label>
            <input id="<?php echo $_SESSION['counter']; ?>addressLocalityLocalButton" type="button" dataName="<?php echo $_SESSION['counter']; ?>addressLocalityLocal" dataId="<?php echo $_SESSION['counter']; ?>addressLocalityLocalId" dataTableName="fancy/locality" class="addMore  addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="locality_local" id="<?php echo $_SESSION['counter']; ?>addressLocalityLocal" dataInputId="<?php echo $_SESSION['counter']; ?>addressLocalityLocalId" dataTableName="locality" class="oneInputSaveEnter" <?php if(isset($address)){ if( (!empty($address['locality']))&&(!empty($address['checkLocality'])) ){ echo "value='".$address['locality']."'"; } }?>/>
            <input type="hidden" name="locality_id" id="<?php echo $_SESSION['counter']; ?>addressLocalityLocalId" <?php if(isset($address)){ if( (!empty($address['locality_id']))&&(!empty($address['checkLocality'])) ){ echo "value='".$address['locality_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressStreetLocal">4) <?php echo $Lang->street_local;?></label>
            <input id="<?php echo $_SESSION['counter']; ?>addressStreetLocalButton" type="button" dataName="<?php echo $_SESSION['counter']; ?>addressStreetLocal" dataId="<?php echo $_SESSION['counter']; ?>addressStreetLocalId" dataTableName="fancyStreet" class="addMore  addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" address_counter="<?php echo $_SESSION['counter']; ?>" name="street_local" id="<?php echo $_SESSION['counter']; ?>addressStreetLocal" dataInputId="<?php echo $_SESSION['counter']; ?>addressStreetLocalId" dataTableName="street" class="oneInputSaveEnter" <?php if(isset($address)){ if( (!empty($address['street']))&&(!empty($address['checkStreet'])) ){ echo "value='".$address['street']."'"; } }?>/>
            <input type="hidden" name="street_id" id="<?php echo $_SESSION['counter']; ?>addressStreetLocalId" <?php if(isset($address)){ if( (!empty($address['street_id']))&&(!empty($address['checkStreet'])) ){ echo "value='".$address['street_id']."'"; } }?>/>
        </div>
        <div>
            <input type="hidden" readonly="readonly" class="oneInputSaveEnter">
            <input style="float: left;" id="<?php echo $_SESSION['counter']; ?>disable_radio_2" class="<?php echo $_SESSION['counter']; ?>disable_radio" type="radio" name="group1" value="1" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressRegion">5) <?php echo $Lang->region;?></label>
            <input  type="text" name="region" address_counter="<?php echo $_SESSION['counter']; ?>" id="<?php echo $_SESSION['counter']; ?>addressRegion" class="oneInputSaveEnter oneInputSaveAddress<?php echo $_SESSION['counter']; ?>" <?php if(isset($address)){ if( (!empty($address['region']))&&(empty($address['checkRegion'])) ){ echo "value='".$address['region']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressLocality">6) <?php echo $Lang->locality;?></label>
            <input type="text" name="locality" id="<?php echo $_SESSION['counter']; ?>addressLocality" class="oneInputSaveEnter oneInputSaveAddress<?php echo $_SESSION['counter']; ?>" <?php if(isset($address)){ if( (!empty($address['locality']))&&(empty($address['checkLocality'])) ){ echo "value='".$address['locality']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressStreet">7) <?php echo $Lang->street;?></label>
            <input type="text" name="street" id="<?php echo $_SESSION['counter']; ?>addressStreet" class="oneInputSaveEnter oneInputSaveAddress<?php echo $_SESSION['counter']; ?>" <?php if(isset($address)){ if( (!empty($address['street']))&&(empty($address['checkStreet'])) ){ echo "value='".$address['street']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressTrack">8) <?php echo $Lang->track;?></label>
            <input type="text" address_counter="<?php echo $_SESSION['counter']; ?>" name="track" id="<?php echo $_SESSION['counter']; ?>addressTrack" class="oneInputSaveEnter oneInputSaveAddress<?php echo $_SESSION['counter']; ?>" <?php if(isset($address)){ if(!empty($address['track'])){ echo "value='".$address['track']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressHomeNum">9) <?php echo $Lang->home_num;?></label>
            <input type="text" name="home_num" id="<?php echo $_SESSION['counter']; ?>addressHomeNum" class="oneInputSaveEnter oneInputSaveAddress<?php echo $_SESSION['counter']; ?>" <?php if(isset($address)){ if(!empty($address['home_num'])){ echo "value='".$address['home_num']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressHousingNum">10) <?php echo $Lang->housing_num;?></label>
            <input type="text" name="housing_num" id="<?php echo $_SESSION['counter']; ?>addressHousingNum" class="oneInputSaveEnter oneInputSaveAddress<?php echo $_SESSION['counter']; ?>" <?php if(isset($address)){ if(!empty($address['housing_num'])){ echo "value='".$address['housing_num']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressAptNum">11) <?php echo $Lang->apt_num;?></label>
            <input type="text" name="apt_num" id="<?php echo $_SESSION['counter']; ?>addressAptNum" class="oneInputSaveEnter oneInputSaveAddress<?php echo $_SESSION['counter']; ?>" <?php if(isset($address)){ if(!empty($address['apt_num'])){ echo "value='".$address['apt_num']."'"; } }?>/>
        </div>

        <?php if($other_tb_name != 'edit' && $other_tb_name != 'event' && $other_tb_name != 'action' && $other_tb_name != 'organization_address' ) { ?>
            <div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>addressStartLiving">12) <?php echo $Lang->start_living;?></label>
                <input type="text" name="start_living" id="<?php echo $_SESSION['counter']; ?>addressStartLiving" style="width: 505px;" class="oneInputSaveEnter dotsToDash oneInputSaveDateAddress<?php echo $_SESSION['counter']; ?>"/>
            </div>

            <div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>addressEndLiving">13) <?php echo $Lang->end_living;?></label>
                <input type="text" name="end_living" id="<?php echo $_SESSION['counter']; ?>addressEndLiving" style="width: 505px;" class="oneInputSaveEnter dotsToDash oneInputSaveDateAddress<?php echo $_SESSION['counter']; ?>"/>
            </div>

            <!--div class="forForm">
                <label for="<?php echo $_SESSION['counter']; ?>addressDataPeriod"><?php echo $Lang->data_period;?></label>
                <input type="text" name="data_period" id="<?php echo $_SESSION['counter']; ?>addressDataPeriod" class="oneInputSaveEnter oneInputSaveAddress<?php echo $_SESSION['counter']; ?>"/>
            </div-->
        <?php } ?>
        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressPlaceHeld"><?php echo $Lang->place_held;?></label>
            <input type="text" name="place_held" id="<?php echo $_SESSION['counter']; ?>addressPlaceHeld" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressPlacePerson"><?php echo $Lang->place_person;?></label>
            <input type="text" name="place_person" id="<?php echo $_SESSION['counter']; ?>addressPlacePerson" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressAddressOrganization"><?php echo $Lang->address_organization;?></label>
            <input type="text" name="address_organization" id="<?php echo $_SESSION['counter']; ?>addressAddressOrganization" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressSeatCar"><?php echo $Lang->seat_car;?></label>
            <input type="text" name="seat_car" id="<?php echo $_SESSION['counter']; ?>addressSeatCar" class="oneInputSaveEnter" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>addressDummyAddressOrganization"><?php echo $Lang->dummy_address_organization;?></label>
            <input type="text" name="dummy_address_organization" id="<?php echo $_SESSION['counter']; ?>addressDummyAddressOrganization" class="oneInputSaveEnter" />
        </div-->

        <div class="forForm">
            <label>14) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($address_has)) {
                        if(!empty($address_has)) {
                            foreach($address_has as $val) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['id']; ?>" data-tb="<?php echo $val['tb']; ?>" ><?php echo $Lang->$val['short']; ?> : <?php echo $val['id']; ?></span>
                        <span class="editAll"></span><a> </a>
                    </div>
                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
        </div>

        <div class="buttons"></div>

    </form>
</div>


<script>
    var currentInputNameAddress<?php echo $_SESSION['counter']; ?>;
    var currentInputIdAddress<?php echo $_SESSION['counter']; ?>;
    <?php if (isset($address)) { ?>
        var checkAddress<?php echo $_SESSION['counter']; ?> = false;
    <?php }else{ ?>
        var checkAddress<?php echo $_SESSION['counter']; ?> = true;
    <?php } ?>
    var address_id<?php echo $_SESSION['counter']; ?> = '<?php echo $address_id; ?>';

    $(document).ready(function(){
            var a = $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').val();
            var b = $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').val();
            var c = $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').val();
        if(($('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').val().length != 0 ) || ($('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').val().length != 0 ) || ($('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').val().length != 0) ){

            $("#<?php echo $_SESSION['counter']; ?>disable_radio_1").click();

            $('#<?php echo $_SESSION['counter']; ?>addressRegion').attr("disabled",true);
            $('#<?php echo $_SESSION['counter']; ?>addressLocality').attr("disabled",true);
            $('#<?php echo $_SESSION['counter']; ?>addressStreet').attr("disabled",true);
        }else if(($('#<?php echo $_SESSION['counter']; ?>addressRegion').val().length != 0 ) || ($('#<?php echo $_SESSION['counter']; ?>addressLocality').val().length != 0) || ($('#<?php echo $_SESSION['counter']; ?>addressStreet').val().length != 0 ) ){

            $("#<?php echo $_SESSION['counter']; ?>disable_radio_2").click();

            $('#<?php echo $_SESSION['counter']; ?>addressRegionLocalButton').attr("disabled",true);
            $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').attr("disabled",true);
            $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').css('background-color','#d3d3d3');

            $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocalButton').attr("disabled",true);
            $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').attr("disabled",true);
            $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').css('background-color','#d3d3d3');

            $('#<?php echo $_SESSION['counter']; ?>addressStreetLocalButton').attr("disabled",true);
            $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').attr("disabled",true);
            $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').css('background-color','#d3d3d3');
        }else{
            $("#<?php echo $_SESSION['counter']; ?>disable_radio_1").click();

            $('#<?php echo $_SESSION['counter']; ?>addressRegion').attr("disabled",true);
            $('#<?php echo $_SESSION['counter']; ?>addressLocality').attr("disabled",true);
            $('#<?php echo $_SESSION['counter']; ?>addressStreet').attr("disabled",true);
        }

        $('.<?php echo $_SESSION['counter']; ?>disable_radio').on('change',function(){
            var radio = $(this).val();
            if(radio == 1){
                $('#<?php echo $_SESSION['counter']; ?>addressRegionLocalButton').attr("disabled",true);
                $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').attr("disabled",true);
                $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').val('');
                $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').trigger('focusout');
                $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').css('background-color','#d3d3d3');

                $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocalButton').attr("disabled",true);
                $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').attr("disabled",true);
                $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').val('');
                $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').trigger('focusout');
                $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').css('background-color','#d3d3d3');

                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocalButton').attr("disabled",true);
                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').attr("disabled",true);
                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').val('');
                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').trigger('focusout');
                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').css('background-color','#d3d3d3');


                $('#<?php echo $_SESSION['counter']; ?>addressRegion').attr("disabled",false);
                $('#<?php echo $_SESSION['counter']; ?>addressLocality').attr("disabled",false);
                $('#<?php echo $_SESSION['counter']; ?>addressStreet').attr("disabled",false);

            }else{
                $('#<?php echo $_SESSION['counter']; ?>addressRegion').attr("disabled",true);
                $('#<?php echo $_SESSION['counter']; ?>addressLocality').attr("disabled",true);
                $('#<?php echo $_SESSION['counter']; ?>addressStreet').attr("disabled",true);

                $('#<?php echo $_SESSION['counter']; ?>addressRegion').val('');
                $('#<?php echo $_SESSION['counter']; ?>addressRegion').trigger('focusout');

                $('#<?php echo $_SESSION['counter']; ?>addressLocality').val('');
                $('#<?php echo $_SESSION['counter']; ?>addressLocality').trigger('focusout');

                $('#<?php echo $_SESSION['counter']; ?>addressStreet').val('');
                $('#<?php echo $_SESSION['counter']; ?>addressStreet').trigger('focusout');


                $('#<?php echo $_SESSION['counter']; ?>addressRegionLocalButton').attr("disabled",false);
                $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').css('background-color', '#FFF');
                $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').attr("disabled",false);

                $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocalButton').attr("disabled",false);
                $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').css('background-color', '#FFF');
                $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').attr("disabled",false);

                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocalButton').attr("disabled",false);
                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').css('background-color', '#FFF');
                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').attr("disabled",false);
            }
        });




        $('.oneInputSaveDateAddress<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('.oneInputSaveDateAddress<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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

        $('.oneInputSaveAddress<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                    saveAddress<?php echo $_SESSION['counter']; ?>(value,field);
            }else{
                saveAddress<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>addressCountry').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>addressCountryId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>addressCountry').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>addressCountry').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>addressCountryId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>addressCountryId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveAddress<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_country;?>');
                    $('#<?php echo $_SESSION['counter']; ?>addressCountry').val('');
                    $('#<?php echo $_SESSION['counter']; ?>addressCountryId').val('');
                }else{
                    saveAddress<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveAddress<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        var regA<?php echo $_SESSION['counter']; ?> = $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>addressRegionLocalId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>addressRegionLocalId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>addressRegionLocalId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveAddress<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_region;?>');
                    $('#<?php echo $_SESSION['counter']; ?>addressRegionLocal').val('');
                    $('#<?php echo $_SESSION['counter']; ?>addressRegionLocalId').val('');
                }else{
                    saveAddress<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveAddress<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').kendoAutoComplete({
            dataTextField: "name",
            filter: "contains",
            minLength: 3,
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
                $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocalId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocalId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocalId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveAddress<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_locality;?>');
                    $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocal').val('');
                    $('#<?php echo $_SESSION['counter']; ?>addressLocalityLocalId').val('');
                }else{
                    saveAddress<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveAddress<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').kendoAutoComplete({
            dataTextField: "name",
            filter: "contains",
            minLength: 3,
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
                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocalId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>addressStreetLocalId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>addressStreetLocalId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveAddress<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_street;?>');
                    $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').val('');
                    $('#<?php echo $_SESSION['counter']; ?>addressStreetLocalId').val('');
                }else{
                    saveAddress<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveAddress<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

//        var streetAutocomplete = $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').kendoAutoComplete({
//            dataTextField: "name",
//            filter:'contains',
//            dataSource: {
//                transport: {
//                    read:{
//                        dataType: "json",
//                        url: "<?php echo ROOT;?>dictionary/street/read"
//                    }
//                }
//            },
//            select:function(e){
//                var dataItem = this.dataItem(e.item.index());
//                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocalId').val(dataItem.id);
//                closeWorker(dataItem.name,dataItem.id);
//            },
//            close:function(e){
//                $('#<?php echo $_SESSION['counter']; ?>addressStreetLocal').val('');
//            }
//        });


        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameAddress<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdAddress<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=address&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>addressCloseButton').click(function(e){
            e.preventDefault();
            if(checkAddress<?php echo $_SESSION['counter']; ?>){
                var checkAdd = confirm('<?php echo $Lang->enter_anything;?>\n <?php echo $Lang->delete_entry;?>');
                if(checkAdd){
                    $.ajax({
                        url: '<?php echo ROOT?>admin/optimization_address/',
                        type: 'post',
                        data: { 'id' : address_id<?php echo $_SESSION['counter']; ?> } ,
                        success: function(data){
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }
            }else{
                <?php if($other_tb_name == 'man') { ?>
                    var data = {
                        'start_date' : $('#<?php echo $_SESSION['counter']; ?>addressStartLiving').val() ,
                        'end_date' : $('#<?php echo $_SESSION['counter']; ?>addressEndLiving').val()
                    }
                    man_has_address<?php if(isset($old_counter)){ echo $old_counter; }?>(address_id<?php echo $_SESSION['counter']; ?>,'ok',data);
                <?php }elseif($other_tb_name == 'organization') { ?>
                    var data = {
                        'start_date' : $('#<?php echo $_SESSION['counter']; ?>addressStartLiving').val() ,
                        'end_date' : $('#<?php echo $_SESSION['counter']; ?>addressEndLiving').val()
                    }
                    organization_has_address<?php if(isset($old_counter)){ echo $old_counter; }?>(address_id<?php echo $_SESSION['counter']; ?>,'ok',data);
                <?php }elseif($other_tb_name == 'organization_address') { ?>
                    organization_address<?php if(isset($old_counter)){ echo $old_counter; }?>(address_id<?php echo $_SESSION['counter']; ?> , 'ok');
                <?php }elseif($other_tb_name == 'event_organization') { ?>
                    event_address<?php if(isset($old_counter)){ echo $old_counter; }?>(address_id<?php echo $_SESSION['counter']; ?>, 'ok');
                <?php }elseif($other_tb_name == 'action') { ?>
                    action_has_address<?php if(isset($old_counter)){ echo $old_counter; }?>(address_id<?php echo $_SESSION['counter']; ?>, 'ok');
                <?php }elseif($other_tb_name == 'man_edit') { ?>
                     var data = {
                            'start_date' : $('#<?php echo $_SESSION['counter']; ?>addressStartLiving').val() ,
                            'end_date' : $('#<?php echo $_SESSION['counter']; ?>addressEndLiving').val() ,
                            'man_id' : '<?php echo $edit['man_id']; ?>' ,
                            'address_id' : address_id<?php echo $_SESSION['counter']; ?>
                     }
                        $.ajax({
                           url : '<?php echo ROOT; ?>add/editManHasAddress',
                           type: 'POST',
                           data : data ,
                            success: function(data){
                            },
                            faild: function(data){
                                alert('<?php echo $Lang->err;?> ');
                            }
                        });
                <?php }elseif($other_tb_name == 'organization_edit') { ?>
                        var data = {
                            'start_date' : $('#<?php echo $_SESSION['counter']; ?>addressStartLiving').val() ,
                            'end_date' : $('#<?php echo $_SESSION['counter']; ?>addressEndLiving').val() ,
                            'organization_id' : '<?php echo $edit['organization_id']; ?>' ,
                            'address_id' : address_id<?php echo $_SESSION['counter']; ?>
                        }
                        $.ajax({
                            url : '<?php echo ROOT; ?>add/editOrganizationHasAddress',
                            type: 'POST',
                            data : data ,
                            success: function(data){
                            },
                            faild: function(data){
                                alert('<?php echo $Lang->err;?> ');
                            }
                        });
                <?php } ?>
            }
        });

    <?php if(isset($edit)){ ?>
        <?php if(!empty($edit['start_date'])) { ?>
            $('#<?php echo $_SESSION['counter']; ?>addressStartLiving').val('<?php echo $edit['start_date']; ?>')
        <?php } ?>
        <?php if(!empty($edit['end_date'])) { ?>
            $('#<?php echo $_SESSION['counter']; ?>addressEndLiving').val('<?php echo $edit['end_date']; ?>')
        <?php } ?>
    <?php }?>

    });
    function closeFancyAddress<?php echo $_SESSION['counter']; ?>(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameAddress<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdAddress<?php echo $_SESSION['counter']; ?>).val(id);
        var field = $('#'+currentInputIdAddress<?php echo $_SESSION['counter']; ?>).attr('name');
        saveAddress<?php echo $_SESSION['counter']; ?>(id,field);
        $.fancybox.close();
        $('#'+currentInputNameAddress<?php echo $_SESSION['counter']; ?>).focus();
    }

    function saveAddress<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value, 'field':field };
        $.ajax({
            url: '<?php echo ROOT?>add/save_address/'+address_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            success: function(data){
                checkAddress<?php echo $_SESSION['counter']; ?>= false;
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

</script>

