<a id="<?php echo $_SESSION['counter']; ?>closeEvent" class="customClose"></a>
<span class="idNumber"><?php if(isset($event_id)){ echo 'ID : '.$event_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>eventForm">


        <!--div class="forForm">
            <label for="eventContentEvent"><?php/// echo $Lang->content_event;?></label>
            <input type="text" name="content_event" id="<?php echo $_SESSION['counter']; ?>eventContentEvent" class="oneInputSaveEnter" />
        </div-->

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventQualificationEventFilter" style="border: none;" >
                <?php if(isset($event_has_qualification)) {
                        if(!empty($event_has_qualification)) {
                            foreach($event_has_qualification as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>eventQualificationEvent<?php echo $val['id']?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>eventQualificationEvent' , 'delete_event_has_qualification', '<?php echo $val['event_id']; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                    } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm" style="background: #ff0000;">
            <label for="eventQualificationEvent">1) <?php echo $Lang->qualification_event;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>eventQualificationEvent" dataId="<?php echo $_SESSION['counter']; ?>eventQualificationEventId" dataTableName="fancySearch/event_qualification" class="addMoreSearch addMoreSearch<?php echo $_SESSION['counter']; ?> k-icon k-i-search"   />
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>eventQualificationEvent" dataId="<?php echo $_SESSION['counter']; ?>eventQualificationEventId" dataTableName="fancy/event_qualification" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="qualification_name" id="<?php echo $_SESSION['counter']; ?>eventQualificationEvent" dataInputId="<?php echo $_SESSION['counter']; ?>eventQualificationEventId" dataTableName="event_qualification" class="oneInputSaveEnter" />
            <input type="hidden" name="qualification_id" id="<?php echo $_SESSION['counter']; ?>eventQualificationEventId" />
        </div>

        <div class="forForm">
            <label for="eventDateSecurityDate">2) <?php echo $Lang->date_security_date;?></label>
            <input type="text" name="date" id="<?php echo $_SESSION['counter']; ?>eventDateSecurityDate" style="width: 505px;" class="oneInputSaveEnter dotsToDash oneInputSaveDateEvent<?php echo $_SESSION['counter']; ?>" />
        </div>

        <div class="forForm">
            <label for="eventDateSecurityTime">3) <?php echo $Lang->date_security_time;?></label>
            <input type="text" name="time" id="<?php echo $_SESSION['counter']; ?>eventDateSecurityTime" class="oneInputSaveEnter oneInputSaveTimeEvent<?php echo $_SESSION['counter']; ?>" <?php if( (isset($event))&&(isset($event['time'])) ){ echo "value='".substr($event['time'],0,5)."'"; }?>/>
        </div>

        <div class="forForm">
            <label for="eventPlaceEventAddress">4) <?php echo $Lang->place_event_address;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventPlaceEventAddressFilter" style="border: none;" >
                <?php if(isset($event)) {
                        if(!empty($event['address_id'])) { ?>
                            <li id="<?php echo $_SESSION['counter']; ?>eventAddressItem<?php echo $event['address_id']; ?>">
                                <div class="item">
                                    <span class="openData" data-id="<?php echo $event['address_id']; ?>" data-tb="address" data-title="<?php echo $Lang->short_address; ?> : <?php echo $event['address_id']; ?>"><?php echo $Lang->short_address; ?> : <?php echo $event['address_id']; ?></span>
                                    <span class="editAll"></span>
                                    <a href="javascript:removeEventAddress<?php echo $_SESSION['counter']; ?>(<?php echo $event['address_id']; ?>);">x</a>
                                </div>
                            </li>
                <?php   }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>eventPlaceEventAddress" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="address_name" id="<?php echo $_SESSION['counter']; ?>eventPlaceEventAddress" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="eventPlaceEventOrganization">5) <?php echo $Lang->place_event_organization;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventPlaceEventOrganizationFilter" style="border: none;" >
                <?php if(isset($event)) {
                        if(!empty($event['organization_id'])) { ?>
                            <li id="<?php echo $_SESSION['counter']; ?>eventOrganizationItem<?php echo $event['organization_id']; ?>">
                                <div class="item">
                                    <span class="openData" data-id="<?php echo $event['organization_id']; ?>" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : <?php echo $event['organization_id']; ?>"><?php echo $Lang->short_organ; ?> : <?php echo $event['organization_id']; ?></span>
                                    <span class="editAll"></span>
                                    <a href="javascript:removeEventOrganization<?php echo $_SESSION['counter']; ?>(<?php echo $event['organization_id']; ?>);">x</a>
                                </div>
                            </li>
                <?php   }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>eventPlaceEventOrganization" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="address_organization" id="<?php echo $_SESSION['counter']; ?>eventPlaceEventOrganization" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="eventEnsuingEffects">6) <?php echo $Lang->ensuing_effects;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>eventEnsuingEffects" dataId="<?php echo $_SESSION['counter']; ?>eventEnsuingEffectsId" dataTableName="fancySearch/aftermath" class="addMoreSearch addMoreSearch<?php echo $_SESSION['counter']; ?> k-icon k-i-search"   />
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>eventEnsuingEffects" dataId="<?php echo $_SESSION['counter']; ?>eventEnsuingEffectsId" dataTableName="fancy/aftermath" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="aftermath_name" id="<?php echo $_SESSION['counter']; ?>eventEnsuingEffects" dataInputId="<?php echo $_SESSION['counter']; ?>eventEnsuingEffectsId" dataTableName="aftermath" class="oneInputSaveEnter" <?php if(isset($event)){ if(!empty($event['aftermath'])){ echo "value='".$event['aftermath']."'"; } } ?> />
            <input type="hidden" name="aftermath_id" id="<?php echo $_SESSION['counter']; ?>eventEnsuingEffectsId" <?php if(isset($event)){ if(!empty($event['aftermath_id'])){ echo "value='".$event['aftermath_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="eventInvestigationRequested">7) <?php echo $Lang->investigation_requested;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>eventInvestigationRequested" dataId="<?php echo $_SESSION['counter']; ?>eventInvestigationRequestedId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="agency" id="<?php echo $_SESSION['counter']; ?>eventInvestigationRequested" dataInputId="<?php echo $_SESSION['counter']; ?>eventInvestigationRequestedId" dataTableName="agency" class="oneInputSaveEnter"<?php if(isset($event)){ if(!empty($event['agency'])){ echo "value='".$event['agency']."'"; } } ?>/>
            <input type="hidden" name="agency_id" id="<?php echo $_SESSION['counter']; ?>eventInvestigationRequestedId" <?php if(isset($event)){ if(!empty($event['agency_id'])){ echo "value='".$event['agency_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="eventResultsEvent">8) <?php echo $Lang->results_event;?></label>
            <input type="text" name="result" id="<?php echo $_SESSION['counter']; ?>eventResultsEvent" class="oneInputSaveEnter oneInputSaveEvent<?php echo $_SESSION['counter']; ?>" <?php if(isset($event)){ if(!empty($event['result'])){ echo "value='".$event['result']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="eventInvolvedEventsMan">9) <?php echo $Lang->involved_events_man;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsManFilter" style="border: none;" >
                <?php if(isset($event_has_man)) {
                        if(!empty($event_has_man)) {
                            foreach($event_has_man as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>eventEventHasManItem<?php echo $val['man_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['man_id']; ?>" data-tb="man" data-title="<?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?>"><?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeEventEventHasMan<?php echo $_SESSION['counter']; ?>(<?php echo $val['man_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsMan" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="involved_events" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsMan" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="eventInvolvedEventsOrganization">10) <?php echo $Lang->involved_events_organization;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsOrganizationFilter" style="border: none;" >
                <?php if(isset($event_has_organization)) {
                        if(!empty($event_has_organization)) {
                            foreach($event_has_organization as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>eventEventHasOrganizationItem<?php echo $val['organization_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['organization_id']; ?>" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : <?php echo $val['organization_id']; ?>"><?php echo $Lang->short_organ; ?> : <?php echo $val['organization_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeEventEventHasOrganization<?php echo $_SESSION['counter']; ?>(<?php echo $val['organization_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsOrganization" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="involved_events" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsOrganization" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="eventInvolvedEventsCar">11) <?php echo $Lang->involved_events_car;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsCarFilter" style="border: none;" >
                <?php if(isset($event_has_car)) {
                        if(!empty($event_has_car)) {
                            foreach($event_has_car as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>eventEventHasCarItem<?php echo $val['car_id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['car_id']; ?>" data-tb="car" data-title="<?php echo $Lang->short_car; ?> : <?php echo $val['car_id']; ?>"><?php echo $Lang->short_car; ?> : <?php echo $val['car_id'];?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeEventEventHasCar<?php echo $_SESSION['counter']; ?>(<?php echo $val['car_id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsCar" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="involved_events" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsCar" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="eventInvolvedEventsWeapon">12) <?php echo $Lang->involved_events_weapon;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsWeaponFilter" style="border: none;" >
                <?php if(isset($event_has_weapon)) {
                        if(!empty($event_has_weapon)) {
                            foreach($event_has_weapon as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>eventEventHasWeaponItem<?php echo $val['weapon_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['weapon_id']; ?>" data-tb="weapon" data-title="<?php echo $Lang->short_weapon; ?> : <?php echo $val['weapon_id']; ?>"><?php echo $Lang->short_weapon; ?> : <?php echo $val['weapon_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeEventEventHasWeapon<?php echo $_SESSION['counter']; ?>(<?php echo $val['weapon_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsWeapon" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="involved_events" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsWeapon" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="eventInvolvedEventsAction">13) <?php echo $Lang->involved_events_action;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsActionFilter" style="border: none;" >
                <?php if(isset($event_has_action)) {
                        if(!empty($event_has_action)) {
                            foreach($event_has_action as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>eventEventHasActionItem<?php echo $val['action_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['action_id']; ?>" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?>"><?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeEventEventHasAction<?php echo $_SESSION['counter']; ?>(<?php echo $val['action_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsAction" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="involved_events" id="<?php echo $_SESSION['counter']; ?>eventInvolvedEventsAction" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="eventCriminalCase">14) <?php echo $Lang->criminal_case;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventCriminalCaseFilter" style="border: none;" >
                <?php if(isset($event_has_criminal_case)) {
                        if(!empty($event_has_criminal_case)) {
                            foreach($event_has_criminal_case as $val) { ?>
                            <li id="<?php echo $_SESSION['counter']; ?>eventHasCriminalCaseItem<?php echo $val['criminal_case_id'];?>">
                                <div class="item">
                                    <span class="openData" data-id="<?php echo $val['criminal_case_id']; ?>" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_case_id']; ?>"><?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_case_id'];?></span>
                                    <span class="editAll"></span>
                                    <a href="javascript:removeEventCriminalCase<?php echo $_SESSION['counter']; ?>(<?php echo $val['criminal_case_id'];?>);">x</a>
                                </div>
                            </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>eventCriminalCase" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="criminal_case" id="<?php echo $_SESSION['counter']; ?>eventCriminalCase" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="eventCheckingSignal">15) <?php echo $Lang->checking_signal;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventCheckingSignalFilter" style="border: none;" >
                <?php if(isset($event_has_signal)) {
                        if(!empty($event_has_signal)) {
                            foreach($event_has_signal as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>eventPassesSignalItem<?php echo $val['signal_id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['signal_id']; ?>" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?>"><?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id'];?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeEventPassesSignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['signal_id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>eventCheckingSignal" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="signal_name" id="<?php echo $_SESSION['counter']; ?>eventCheckingSignal" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="eventSourceEvent">16) <?php echo $Lang->source_event;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>eventSourceEvent" dataId="<?php echo $_SESSION['counter']; ?>eventSourceEventId" dataTableName="fancy/resource" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="resource_name" id="<?php echo $_SESSION['counter']; ?>eventSourceEvent" dataInputId="<?php echo $_SESSION['counter']; ?>eventSourceEventId" dataTableName="resource" class="oneInputSaveEnter"<?php if(isset($event)){ if(!empty($event['resource'])){ echo "value='".$event['resource']."'"; } } ?>/>
            <input type="hidden" name="resource_id" id="<?php echo $_SESSION['counter']; ?>eventSourceEventId" <?php if(isset($event)){ if(!empty($event['resource_id'])){ echo "value='".$event['resource_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="eventEventAssociatedAction">17) <?php echo $Lang->event_associated_action;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>eventEventAssociatedActionFilter" style="border: none;" >
                <?php if(isset($event_action_has_event)) {
                        if(!empty($event_action_has_event)) {
                            foreach($event_action_has_event as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>eventActionHasEventItem<?php echo $val['action_id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['action_id']; ?>" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?>"><?php echo $Lang->short_action; ?> : <?php echo $val['action_id'];?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeEventActionHasEvent<?php echo $_SESSION['counter']; ?>(<?php echo $val['action_id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>eventEventAssociatedAction" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="event_associated_action" id="<?php echo $_SESSION['counter']; ?>eventEventAssociatedAction" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label>18) <?php echo $Lang->contents_document;?></label>
            <ul class="uploader">
                <?php if(isset($event_has_file)) {
                        if(!empty($event_has_file)) {
                            foreach($event_has_file as $val) { ?>
                <li class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> </li>
                <?php       }
                        }
                      } ?>
            </ul>
        </div>

        <div class="forForm">
            <label>19) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($event)) {
                        if(!empty($event['bibliography_id'])) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $event['bibliography_id']; ?>" data-tb="bibliography" ><?php echo $Lang->short_bibl; ?> : <?php echo $event['bibliography_id']; ?></span>
                        <span class="editAll"></span><a> </a>
                    </div>
                </li>
                <?php
                        }
                      } ?>
                &nbsp
            </ul>
        </div>

        <div class="buttons"></div>

    </form>
</div>


<script>
    var currentInputNameEvent<?php echo $_SESSION['counter']; ?>;
    var currentInputIdEvent<?php echo $_SESSION['counter']; ?>;
    var event_id<?php echo $_SESSION['counter']; ?> = '<?php echo $event_id; ?>';
    <?php if(isset($event)) { ?>
        var checkEvent<?php echo $_SESSION['counter']; ?> = false;
    <?php }else{ ?>
        var checkEvent<?php echo $_SESSION['counter']; ?> = true;
    <?php } ?>
    $(document).ready(function(){

        $('#<?php echo $_SESSION['counter']; ?>eventEventAssociatedAction').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/action/event/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->action;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>eventCheckingSignal').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/signal/event/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->signal;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>eventCriminalCase').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/criminal_case/event/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->criminal_case;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsAction').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/action/event_has_action/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->action;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsWeapon').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/weapon/event/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->weapon;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsCar').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/car/event/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->weapon;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsOrganization').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/organization/event_has_organization/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->organization;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>eventPlaceEventOrganization').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/organization/event_organization/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->organization;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>eventPlaceEventAddress').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/address/event_address/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->address;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsMan').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/man/event/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->event;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>eventQualificationEvent').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/event_qualification/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>eventQualificationEventId').val(dataItem.id);
            }
        });
//        $('#<?php echo $_SESSION['counter']; ?>eventQualificationEvent').focusout(function(e){
//            e.preventDefault();
//            var text = $('#<?php echo $_SESSION['counter']; ?>eventQualificationEvent').val();
//            var value = $('#<?php echo $_SESSION['counter']; ?>eventQualificationEventId').val();
//            var field = $('#<?php echo $_SESSION['counter']; ?>eventQualificationEventId').attr('name');
//            if(text.length != 0){
//                if((text.length != 0)&&(value.length == 0)){
//                    alert('Введите правильную квалификацию');
//                }else{
//                    saveEvent<?php echo $_SESSION['counter']; ?>(value,field);
//                }
//            }
//        });
        multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>eventQualificationEvent','event_has_qualification','delete_event_has_qualification',event_id<?php echo $_SESSION['counter']; ?>);

        $('#<?php echo $_SESSION['counter']; ?>eventEnsuingEffects').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/aftermath/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>eventEnsuingEffectsId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>eventEnsuingEffects').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>eventEnsuingEffects').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>eventEnsuingEffectsId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>eventEnsuingEffectsId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveEvent<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_outcome;?>');
                    $('#<?php echo $_SESSION['counter']; ?>eventEnsuingEffects').val('');
                    $('#<?php echo $_SESSION['counter']; ?>eventEnsuingEffectsId').val('');
                }else{
                    saveEvent<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveEvent<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>eventInvestigationRequested').kendoAutoComplete({
            dataTextField: "name",
            filter: "contains",
            minLength: 3,
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
                $('#<?php echo $_SESSION['counter']; ?>eventInvestigationRequestedId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>eventInvestigationRequested').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>eventInvestigationRequested').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>eventInvestigationRequestedId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>eventInvestigationRequestedId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveEvent<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_agency;?>');
                    $('#<?php echo $_SESSION['counter']; ?>eventInvestigationRequested').val('');
                    $('#<?php echo $_SESSION['counter']; ?>eventInvestigationRequestedId').val('');
                }else{
                    saveEvent<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveEvent<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>eventSourceEvent').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/resource/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>eventSourceEventId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>eventSourceEvent').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>eventSourceEvent').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>eventSourceEventId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>eventSourceEventId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveEvent<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_source;?>');
                    $('#<?php echo $_SESSION['counter']; ?>eventSourceEvent').val('');
                    $('#<?php echo $_SESSION['counter']; ?>eventSourceEventId').val('');
                }else{
                    saveEvent<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveEvent<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('.oneInputSaveEvent<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                saveEvent<?php echo $_SESSION['counter']; ?>(value,field);
            }else{
                saveEvent<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameEvent<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdEvent<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=event&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('.addMoreSearch<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameEvent<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdEvent<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=event&value="+$('#'+currentInputNameEvent<?php echo $_SESSION['counter']; ?>).val()+'&old_counter=<?php echo $_SESSION['counter']; ?>'
            });
        });

        $('.oneInputSaveDateEvent<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateEvent<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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
//                        saveEvent<?php echo $_SESSION['counter']; ?>(val,field);
                    }else{
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }else{
//                        saveEvent<?php echo $_SESSION['counter']; ?>(val,field);
                    }
                }
            }else{
                if( (typeof $(this).attr('type') != 'undefined')&&(val.length == 0) ){
                    saveEvent<?php echo $_SESSION['counter']; ?>('null',field);
                }
            }
        });

        $('.oneInputSaveTimeEvent<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            var val = $(this).val();
            var reg = /^(2[0-3]|[01][0-9]):[0-5][0-9]$/;
            if( (val.length != 0) ){
                if (val.length == 4) {
                    var hour = val.slice(0,2);
                    var min = val.slice(2,4);
//                    var sec = val.slice(4,6);
                    val = hour+':'+min;
//                    $(this).val(val)
                    if(reg.test(val)){
                        $(this).val(val);
                    }else{
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if( (val.length != 5)||(reg.test(val)) ){
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>closeEvent').click(function(e){
            e.preventDefault();
            var dataId = $('.activeTable:last').attr('dataId');
            var check = $('#<?php echo $_SESSION['counter']; ?>eventQualificationEventFilter').find('li');
            if(typeof check.attr('id') != 'undefined'){
                checkEvent<?php echo $_SESSION['counter']; ?> = false;
            }
            if(checkEvent<?php echo $_SESSION['counter']; ?>){
                var confirmEvent = confirm('<?php echo $Lang->enter_anything;?>\n <?php echo $Lang->delete_entry;?>');
                if(confirmEvent){
                    $.ajax({
                        url: '<?php echo ROOT?>add/delete_event/'+event_id<?php echo $_SESSION['counter']; ?>,
                        success: function(data){
                            removeItem();
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
//                console.log(check);
                    if(typeof check.attr('id') == 'undefined'){
                        alert('<?php echo $Lang->enter_field;?>');
                    }else{
                        $('.activeTable').addClass('storedItem');
                        if(typeof  dataId == 'undefined'){
                            $('.activeTable').append(' : id = '+event_id<?php echo $_SESSION['counter']; ?>);
                            $('.activeTable').attr('dataId',event_id<?php echo $_SESSION['counter']; ?>);
                        }
                        $('.activeTable').removeClass('activeTable');
                        removeItem();
                    }
                }
            }else{
                var regDate = /^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/;
                var regTime = /^(2[0-3]|[01][0-9]):[0-5][0-9]$/;
                var date = $('#<?php echo $_SESSION['counter']; ?>eventDateSecurityDate').val();
                var time = $('#<?php echo $_SESSION['counter']; ?>eventDateSecurityTime').val();
                var checkDate = true;
                if( (date.length != 0)&&(time.length != 0) ){
                    if( (regDate.test(date))&&(regTime.test(time)) ){
                        var newDate = date.split('-');
                        date = newDate[2]+'-'+newDate[1]+'-'+newDate[0];
                        saveEvent<?php echo $_SESSION['counter']; ?>(date+' '+time+':00','date');
                    }else{
                        checkDate = false;
                    }
                }else{
                    if(date.length != 0){
                        if(regDate.test(date)){
                            var newDate = date.split('-');
                            date = newDate[2]+'-'+newDate[1]+'-'+newDate[0];
                            saveEvent<?php echo $_SESSION['counter']; ?>(date,'date');
                        }else{
                            checkDate = false;
                        }
                    }
                }
                if(checkDate){
                    var check = $('#<?php echo $_SESSION['counter']; ?>eventQualificationEventFilter').find('li');
//                console.log(check);
                    if(typeof check.attr('id') == 'undefined'){
                        alert('<?php echo $Lang->enter_field;?>');
                    }else{
                        $('.activeTable').addClass('storedItem');
                        if(typeof  dataId == 'undefined'){
                            $('.activeTable').append(' : id = '+event_id<?php echo $_SESSION['counter']; ?>);
                            $('.activeTable').attr('dataId',event_id<?php echo $_SESSION['counter']; ?>);
                        }
                        $('.activeTable').removeClass('activeTable');
                        removeItem();
                    }
                }else{
                    alert('<?php echo $Lang->enter_date_time;?>');
                }

            }
        });

        <?php if(isset($event)) {
                if(!empty($event['date'])) { ?>
                    $('#<?php echo $_SESSION['counter']; ?>eventDateSecurityDate').val('<?php echo $event['date']?>');
        <?php   }
              } ?>

    });

    function saveEvent<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value, 'field':field };
        $.ajax({
            url: '<?php echo ROOT?>add/save_event/'+event_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            success: function(data){
                checkEvent<?php echo $_SESSION['counter']; ?> = false;
            },
            faild: function(data){
                alert('error ');
            }
        });
    }

    function closeEvent<?php echo $_SESSION['counter']; ?>(name,id){
        $('#'+currentInputNameEvent<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdEvent<?php echo $_SESSION['counter']; ?>).val(id);
        var field = $('#'+currentInputIdEvent<?php echo $_SESSION['counter']; ?>).attr('name');
        if( field == 'qualification_id'){
            $('#<?php echo $_SESSION['counter']; ?>eventQualificationEvent').trigger('focusout');
        }
        saveEvent<?php echo $_SESSION['counter']; ?>(id,field);
        $.fancybox.close();
    }

    function event_action_has_event<?php echo $_SESSION['counter']; ?>(action_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/event_action_has_event/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+action_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>eventEventAssociatedActionFilter').append('<li id="<?php echo $_SESSION['counter']; ?>eventActionHasEventItem'+action_id+'">'
                            +'<div class="item">'
                            +'<span><?php echo $Lang->short_action; ?> : '+action_id+'</span>'
                            +'<a href="javascript:removeEventActionHasEvent<?php echo $_SESSION['counter']; ?>('+action_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>eventEventAssociatedAction').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeEventActionHasEvent<?php echo $_SESSION['counter']; ?>(action_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_event_action_has_event/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+action_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>eventActionHasEventItem'+action_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>eventEventAssociatedAction').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function event_passes_signal<?php echo $_SESSION['counter']; ?>(signal_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/event_passes_signal/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>eventCheckingSignalFilter').append('<li id="<?php echo $_SESSION['counter']; ?>eventPassesSignalItem'+signal_id+'">'
                            +'<div class="item">'
                            +'<span><?php echo $Lang->short_signal; ?> : '+signal_id+'</span>'
                            +'<a href="javascript:removeEventPassesSignal<?php echo $_SESSION['counter']; ?>('+signal_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>eventCheckingSignal').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeEventPassesSignal<?php echo $_SESSION['counter']; ?>(signal_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_event_passes_signal/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>eventPassesSignalItem'+signal_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>eventCheckingSignal').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function event_has_criminal_case<?php echo $_SESSION['counter']; ?>(criminal_case_id , check  , data  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/event_has_criminal_case/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
                dataType:'json',
                success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>eventCriminalCaseFilter').append('<li id="<?php echo $_SESSION['counter']; ?>eventHasCriminalCaseItem'+criminal_case_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+criminal_case_id+'" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'"><?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'</span>'
                    +'<span class="editAll"></span><a href="javascript:removeEventCriminalCase<?php echo $_SESSION['counter']; ?>('+criminal_case_id+');">x</a>'
                            +'</div>'
                    +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>eventCriminalCase').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });

    }
    function removeEventCriminalCase<?php echo $_SESSION['counter']; ?>(criminal_case_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_event_has_criminal_case/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>eventHasCriminalCaseItem'+criminal_case_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>eventCriminalCase').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function event_organization<?php echo $_SESSION['counter']; ?>(organization_id , check  , data  ){
        saveEvent<?php echo $_SESSION['counter']; ?>(organization_id,'organization_id');
        if( check != 'ok'){
            removeItem();
        }
        $('#<?php echo $_SESSION['counter']; ?>eventPlaceEventOrganizationFilter').html('<li id="<?php echo $_SESSION['counter']; ?>eventOrganizationItem'+organization_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+organization_id+'" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : '+organization_id+'"><?php echo $Lang->short_organ; ?> : '+organization_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeEventOrganization<?php echo $_SESSION['counter']; ?>('+organization_id+');">x</a>'
                +'</div>'
                +'</li>');
        $('#<?php echo $_SESSION['counter']; ?>eventPlaceEventOrganization').focus();

    }
    function removeEventOrganization<?php echo $_SESSION['counter']; ?>(organization_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            saveEvent<?php echo $_SESSION['counter']; ?>(0,'organization_id');
            $('#<?php echo $_SESSION['counter']; ?>eventPlaceEventOrganizationFilter').html('&nbsp;');
            $('#<?php echo $_SESSION['counter']; ?>eventPlaceEventOrganization').focus();
        }
    }

    function event_address<?php echo $_SESSION['counter']; ?>(address_id , check  , data  ){
        saveEvent<?php echo $_SESSION['counter']; ?>(address_id,'address_id');
        if( check != 'ok'){
            removeItem();
        }
        $('#<?php echo $_SESSION['counter']; ?>eventPlaceEventAddressFilter').html('<li id="<?php echo $_SESSION['counter']; ?>eventAddressItem'+address_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+address_id+'" data-tb="address" data-title="<?php echo $Lang->short_address; ?> : '+address_id+'"><?php echo $Lang->short_address; ?> : '+address_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeEventAddress<?php echo $_SESSION['counter']; ?>('+address_id+');">x</a>'
                +'</div>'
                +'</li>');
        $('#<?php echo $_SESSION['counter']; ?>eventPlaceEventAddress').focus();

    }
    function removeEventAddress<?php echo $_SESSION['counter']; ?>(address_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            saveEvent<?php echo $_SESSION['counter']; ?>(0,'address_id');
            $('#<?php echo $_SESSION['counter']; ?>eventPlaceEventAddressFilter').html('&nbsp;');
            $('#<?php echo $_SESSION['counter']; ?>eventPlaceEventAddress').focus();
        }
    }

    function event_event_has_action<?php echo $_SESSION['counter']; ?>(action_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/event_has_action/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+action_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsActionFilter').append('<li id="<?php echo $_SESSION['counter']; ?>eventEventHasActionItem'+action_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+action_id+'" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : '+action_id+'"><?php echo $Lang->short_action; ?> : '+action_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeEventEventHasAction<?php echo $_SESSION['counter']; ?>('+action_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsAction').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeEventEventHasAction<?php echo $_SESSION['counter']; ?>(action_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_event_has_action/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+action_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>eventEventHasActionItem'+action_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsAction').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function event_has_weapon<?php echo $_SESSION['counter']; ?>(weapon_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/event_has_weapon/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+weapon_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsWeaponFilter').append('<li id="<?php echo $_SESSION['counter']; ?>eventEventHasWeaponItem'+weapon_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+weapon_id+'" data-tb="weapon" data-title="<?php echo $Lang->short_weapon; ?> : '+weapon_id+'"><?php echo $Lang->short_weapon; ?> : '+weapon_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeEventEventHasWeapon<?php echo $_SESSION['counter']; ?>('+weapon_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsWeapon').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeEventEventHasWeapon<?php echo $_SESSION['counter']; ?>(weapon_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_event_has_weapon/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+weapon_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>eventEventHasWeaponItem'+weapon_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsWeapon').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function event_has_car<?php echo $_SESSION['counter']; ?>(car_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/event_has_car/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+car_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsCarFilter').append('<li id="<?php echo $_SESSION['counter']; ?>eventEventHasCarItem'+car_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+car_id+'" data-tb="car" data-title="<?php echo $Lang->short_car; ?> : '+car_id+'"><?php echo $Lang->short_car; ?> : '+car_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeEventEventHasCar<?php echo $_SESSION['counter']; ?>('+car_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsCar').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeEventEventHasCar<?php echo $_SESSION['counter']; ?>(car_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_event_has_car/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+car_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>eventEventHasCarItem'+car_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsCar').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function event_has_organization<?php echo $_SESSION['counter']; ?>(organization_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/event_has_organization/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsOrganizationFilter').append('<li id="<?php echo $_SESSION['counter']; ?>eventEventHasOrganizationItem'+organization_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+organization_id+'" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : '+organization_id+'"><?php echo $Lang->short_organ; ?> : '+organization_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeEventEventHasOrganization<?php echo $_SESSION['counter']; ?>('+organization_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsOrganization').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeEventEventHasOrganization<?php echo $_SESSION['counter']; ?>(organization_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_event_has_organization/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>eventEventHasOrganizationItem'+organization_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsOrganization').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function event_has_man<?php echo $_SESSION['counter']; ?>(man_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/event_has_man/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsManFilter').append('<li id="<?php echo $_SESSION['counter']; ?>eventEventHasManItem'+man_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+man_id+'" data-tb="man" data-title="<?php echo $Lang->short_man; ?> : '+man_id+'"><?php echo $Lang->short_man; ?> : '+man_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeEventEventHasMan<?php echo $_SESSION['counter']; ?>('+man_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsMan').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeEventEventHasMan<?php echo $_SESSION['counter']; ?>(man_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_event_has_man/'+event_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>eventEventHasManItem'+man_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>eventInvolvedEventsMan').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }



</script>


