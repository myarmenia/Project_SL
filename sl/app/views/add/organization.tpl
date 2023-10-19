<a class="customClose" id="<?php echo $_SESSION['counter']; ?>closeOrganization"></a>
<span class="idNumber"><?php if(isset($organization_id)){ echo 'ID : '.$organization_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>organizationForm">


        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organNameOrganization">1) <?php echo $Lang->name_organization;?></label>
<!--            <input type="text" name="name" id="--><?php //echo $_SESSION['counter']; ?><!--organNameOrganization" class="oneInputSaveEnter oneInputSaveOrganization--><?php //echo $_SESSION['counter']; ?><!--" --><?php //if(isset($organization)){ if(!empty($organization['name'])) { echo "value='".$organization['name']."'"; } } ?><!--/>-->
            <input type="hidden" class="oneInputSaveEnter eventTriggerOrg<?php echo $_SESSION['counter']; ?>">
            <textarea type="aaaa" name="name" id="<?php echo $_SESSION['counter']; ?>organNameOrganization" class="oneInputSaveOrganization<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" ><?php if(isset($organization)){ if(!empty($organization['name'])) { echo $organization['name']; } } ?></textarea>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organNation">2) <?php echo $Lang->nation;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>organNation" dataId="<?php echo $_SESSION['counter']; ?>organNationId" dataTableName="fancy/country" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="nation" id="<?php echo $_SESSION['counter']; ?>organNation" dataTableName="country" dataInputId="<?php echo $_SESSION['counter']; ?>organNationId" class="oneInputSaveEnter" <?php if(isset($organization)){ if(!empty($organization['country'])) { echo "value='".$organization['country']."'"; } } ?>/>
            <input type="hidden" name="country_id" id="<?php echo $_SESSION['counter']; ?>organNationId" <?php if(isset($organization)){ if(!empty($organization['country_id'])) { echo "value='".$organization['country_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organDateFormation">3) <?php echo $Lang->date_formation;?></label>
            <input type="text" name="reg_date" id="<?php echo $_SESSION['counter']; ?>organDateFormation" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>organDateFormation',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateOrganization<?php echo $_SESSION['counter']; ?>"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organDislocationOrganization">4) <?php echo $Lang->dislocation_organization;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organDislocationOrganizationFilter" style="border: none;" >
                <?php if(isset($organization_has_address) ) {
                        if(!empty($organization_has_address)) {
                            foreach($organization_has_address as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationHasAddressItem<?php echo $val['address_id']?>">
                                    <div class="item">
                                        <span class="openData" other_id="<?php echo $organization_id; ?>" other_tb="organization_edit" data-id="<?php echo $val['address_id']; ?>" data-tb="address" data-title="<?php echo $Lang->short_address; ?> : <?php echo $val['address_id']; ?>"><?php echo $Lang->short_address; ?> : <?php echo $val['address_id']?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeOrganizationHasAddress<?php echo $_SESSION['counter']; ?>(<?php echo $val['address_id']?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                    } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organDislocationOrganization" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="dislocation_organization" id="<?php echo $_SESSION['counter']; ?>organDislocationOrganization" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organRegionActivity">5) <?php echo $Lang->region_activity;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>organRegionActivity" dataId="<?php echo $_SESSION['counter']; ?>organRegionActivityId" dataTableName="fancy/country_ate" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="region_activity" id="<?php echo $_SESSION['counter']; ?>organRegionActivity" dataTableName="country_ate" dataInputId="<?php echo $_SESSION['counter']; ?>organRegionActivityId" class="oneInputSaveEnter" <?php if(isset($organization)){ if(!empty($organization['country_ate'])) { echo "value='".$organization['country_ate']."'"; } } ?>/>
            <input type="hidden" name="country_ate_id" id="<?php echo $_SESSION['counter']; ?>organRegionActivityId" <?php if(isset($organization)){ if(!empty($organization['country_ate_id'])) { echo "value='".$organization['country_ate_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organAlsoKnownAs">6) <?php echo $Lang->also_known_as;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organAlsoKnownAsFilter" style="border: none;" >
                <?php if(isset($organization_has_organization)) {
                        if(!empty($organization_has_organization)) {
                            foreach($organization_has_organization as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationOrganAlsoKnownAsItem<?php echo $val['org_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['org_id']; ?>" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : <?php echo $val['org_id']; ?>"><?php echo $Lang->short_organ; ?> : <?php echo $val['org_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationOrganization<?php echo $_SESSION['counter']; ?>(<?php echo $val['org_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                    } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organAlsoKnownAs" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="also_known_as" id="<?php echo $_SESSION['counter']; ?>organAlsoKnownAs" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organCategoryOrganization">7) <?php echo $Lang->category_organization;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>organCategoryOrganization" dataId="<?php echo $_SESSION['counter']; ?>organCategoryOrganizationId" dataTableName="fancy/organization_category" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="category_organization" id="<?php echo $_SESSION['counter']; ?>organCategoryOrganization" dataTableName="organization_category" dataInputId="<?php echo $_SESSION['counter']; ?>organCategoryOrganizationId" class="oneInputSaveEnter" <?php if(isset($organization)){ if(!empty($organization['organization_category'])) { echo "value='".$organization['organization_category']."'"; } } ?>/>
            <input type="hidden" name="category_id" id="<?php echo $_SESSION['counter']; ?>organCategoryOrganizationId" <?php if(isset($organization)){ if(!empty($organization['organization_category_id'])) { echo "value='".$organization['organization_category_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organPhoneNumber">8) <?php echo $Lang->phone_number;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organPhoneNumberFilter" style="border: none;" >
                <?php if(isset($organization_has_phone)) {
                        if(!empty($organization_has_phone)) {
                            foreach($organization_has_phone as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationHasPhoneItem<?php echo $val['phone_id']?>">
                                    <div class="item">
                                        <span class="openData" other_id="<?php echo $organization_id;?>" other_tb="organization_edit" data-id="<?php echo $val['phone_id']; ?>" data-tb="phone" data-from="organization" data-from_id="<?php echo $organization_id; ?>" data-title="<?php echo $Lang->short_phone; ?> : <?php echo $val['phone_id']; ?>"><?php echo $Lang->short_phone; ?> : <?php echo $val['phone_id']?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationHasPhone<?php echo $_SESSION['counter']; ?>(<?php echo $val['phone_id']?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organPhoneNumber" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="phone_number" id="<?php echo $_SESSION['counter']; ?>organPhoneNumber" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organMailAddress">9) <?php echo $Lang->mail_address;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organMailAddressFilter" style="border: none;" >
                <?php if(isset($organization_has_email)) {
                        if(!empty($organization_has_email)) {
                            foreach($organization_has_email as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationHasMailItem<?php echo $val['email_id']?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['email_id']; ?>" data-tb="email" ><?php echo $Lang->short_email; ?> : <?php echo $val['email_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationHasMail<?php echo $_SESSION['counter']; ?>(<?php echo $val['email_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organMailAddress" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="mail_address" id="<?php echo $_SESSION['counter']; ?>organMailAddress"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organSecurityOrganization">10) <?php echo $Lang->security_organization;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>organSecurityOrganization" dataId="<?php echo $_SESSION['counter']; ?>organSecurityOrganizationId" dataTableName="fancy/agency" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="security_organization" id="<?php echo $_SESSION['counter']; ?>organSecurityOrganization" dataTableName="agency" dataInputId="<?php echo $_SESSION['counter']; ?>organSecurityOrganizationId" class="oneInputSaveEnter" <?php if(isset($organization)){ if(!empty($organization['agency'])) { echo "value='".$organization['agency']."'"; } } ?>/>
            <input type="hidden" name="agency_id" id="<?php echo $_SESSION['counter']; ?>organSecurityOrganizationId" <?php if(isset($organization)){ if(!empty($organization['agency_id'])) { echo "value='".$organization['agency_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organNumberWorker">11) <?php echo $Lang->number_worker;?></label>
            <input type="text" name="employers_count" id="<?php echo $_SESSION['counter']; ?>organNumberWorker" class="oneInputSaveEnter oneInputSaveOrganization<?php echo $_SESSION['counter']; ?>" <?php if(isset($organization)){ if(!empty($organization['employers_count'])) { echo "value='".$organization['employers_count']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organInvolvedTheEvents">12) <?php echo $Lang->event;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organPlaceEventIsFilter" style="border: none;" >
                <?php if(isset($organization_has_event)) {
                        if(!empty($organization_has_event)) {
                            foreach($organization_has_event as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationHasEventItem<?php echo $val['event_id']?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['event_id']; ?>" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : <?php echo $val['event_id']; ?>"><?php echo $Lang->short_event; ?> : <?php echo $val['event_id']?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationHasEvent<?php echo $_SESSION['counter']; ?>(<?php echo $val['event_id']?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="event_has_organization" id="<?php echo $_SESSION['counter']; ?>organPlaceEventIs" value="Добавить" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organRelationOrganization">13) <?php echo $Lang->relation_organization;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organRelationOrganizationFilter" style="border: none;" >
                <?php if(isset($organization_objects_relation)) {
                        if(!empty($organization_objects_relation)) {
                            foreach($organization_objects_relation as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationObjectsRelationItem<?php echo $val['org_id']?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['id']; ?>" data-tb="object" data-title="<?php echo $Lang->short_object; ?> : <?php echo $val['org_id']; ?>"><?php echo $Lang->short_object; ?> : <?php echo $val['id']?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationHasObjectsRelation<?php echo $_SESSION['counter']; ?>(<?php echo $val['id']?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="objects_relation" id="<?php echo $_SESSION['counter']; ?>organRelationOrganization" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="relation_organization" id="<?php echo $_SESSION['counter']; ?>organRelationOrganization" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organAttention">14) <?php echo $Lang->attention;?></label>
            <input type="text" name="attension" id="<?php echo $_SESSION['counter']; ?>organAttention" class="oneInputSaveEnter oneInputSaveOrganization<?php echo $_SESSION['counter']; ?>" <?php if(isset($organization)){ if(!empty($organization['attension'])) { echo "value='".$organization['attension']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organDummyAddress">15) <?php echo $Lang->dummy_address;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organDummyAddressFilter" style="border: none;" >
                <?php if(isset($organization)) {
                        if(!empty($organization['address_id'])) { ?>
                            <li id="<?php echo $_SESSION['counter']; ?>organizationAddressItem<?php echo $organization['address']; ?>">
                                <div class="item">
                                    <span class="openData" data-id="<?php echo $organization['address_id']; ?>" data-tb="address" data-title="<?php echo $Lang->short_address; ?> : <?php echo $organization['address_id']; ?>"><?php echo $Lang->short_address; ?> : <?php echo $organization['address_id']; ?></span>
                                    <span class="editAll"></span><a href="javascript:removeOrganizationAddress<?php echo $_SESSION['counter']; ?>(<?php echo $organization['address_id']; ?>);">x</a>
                                </div>
                            </li>
                <?php   }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organDummyAddress" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="dummy_address" id="<?php echo $_SESSION['counter']; ?>organDummyAddress" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organOrganizationDow">16) <?php echo $Lang->organization_dow;?></label>
            <input type="text" name="opened_dou" id="<?php echo $_SESSION['counter']; ?>organOrganizationDow" class="oneInputSaveEnter oneInputSaveOrganization<?php echo $_SESSION['counter']; ?>" <?php if(isset($organization)){ if(!empty($organization['opened_dou'])) { echo "value='".$organization['opened_dou']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organPassesCriminalCase">17) <?php echo $Lang->passes_criminal_case;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organPassesCriminalCaseFilter" style="border: none;" >
                <?php if(isset($organization_has_criminal_case)) {
                        if(!empty($organization_has_criminal_case)) {
                            foreach($organization_has_criminal_case as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationHasCriminalCaseItem<?php echo $val['criminal_case_id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['criminal_case_id']; ?>" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_case_id']; ?>"><?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_case_id'];?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationHasCriminalCase<?php echo $_SESSION['counter']; ?>(<?php echo $val['criminal_case_id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organPassesCriminalCase" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="passes_criminal_case" id="<?php echo $_SESSION['counter']; ?>organPassesCriminalCase" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organObjectActions">18) <?php echo $Lang->object_actions;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organObjectActionsFilter" style="border: none;" >
                <?php if(isset($organization_has_action)) {
                        if(!empty($organization_has_action)) {
                            foreach($organization_has_action as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationHasActionItem<?php echo $val['action_id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['action_id']; ?>" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?>"><?php echo $Lang->short_action; ?> : <?php echo $val['action_id'];?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationHasAction<?php echo $_SESSION['counter']; ?>(<?php echo $val['action_id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organObjectActions" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="object_actions" id="<?php echo $_SESSION['counter']; ?>organObjectActions" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organPlaceWorkPersons">19) <?php echo $Lang->place_work_persons;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organPlaceWorkPersonsFilter" style="border: none;" >
                <?php if(isset($organization_has_man)) {
                        if(!empty($organization_has_man)) {
                            foreach($organization_has_man as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationWorkActivity<?php echo $val['id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['id']; ?>" data-tb="work_activity" data-title="<?php echo $Lang->short_work_activity; ?> : <?php echo $val['id']; ?>"><?php echo $Lang->short_work_activity; ?> : <?php echo $val['id'];?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationWorkActivity<?php echo $_SESSION['counter']; ?>(<?php echo $val['id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organPlaceWorkPersons" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="place_work_persons" id="<?php echo $_SESSION['counter']; ?>organPlaceWorkPersons" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organCheckedSignal">20) <?php echo $Lang->checked_signal;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organCheckedSignalFilter" style="border: none;" >
                <?php if(isset($organization_checked_by_signal)) {
                        if(!empty($organization_checked_by_signal)) {
                            foreach($organization_checked_by_signal as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationHasCheckedItem<?php echo $val['signal_id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['signal_id']; ?>" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?>"><?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id'];?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationCheckedBySignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['signal_id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organCheckedSignal" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="checked_signal" id="<?php echo $_SESSION['counter']; ?>organCheckedSignal" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organPassesSignal">21) <?php echo $Lang->passes_signal;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organPassesSignalFilter" style="border: none;" >
                <?php if(isset($organization_passes_by_signal)) {
                        if(!empty($organization_passes_by_signal)) {
                            foreach($organization_passes_by_signal as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationPassedItem<?php echo $val['signal_id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['signal_id']; ?>" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?>"><?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id'];?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationPassedBySignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['signal_id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organPassesSignal" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="passes_signal" id="<?php echo $_SESSION['counter']; ?>organPassesSignal" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organAvailabilityCar">22) <?php echo $Lang->availability_car;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organAvailabilityCarFilter" style="border: none;" >
                <?php if(isset($organization_has_car)) {
                        if(!empty($organization_has_car)) {
                            foreach($organization_has_car as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationHasCarItem<?php echo $val['car_id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['car_id']; ?>" data-tb="car" data-title="<?php echo $Lang->short_car; ?> : <?php echo $val['car_id']; ?>"><?php echo $Lang->short_car; ?> : <?php echo $val['car_id'];?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationHasCar<?php echo $_SESSION['counter']; ?>(<?php echo $val['car_id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organAvailabilityCar" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="availability_car" id="<?php echo $_SESSION['counter']; ?>organAvailabilityCar" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organAvailabilityWeapons">23) <?php echo $Lang->availability_weapons;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organAvailabilityWeaponsFilter" style="border: none;" >
                <?php if(isset($organization_has_weapon)) {
                        if(!empty($organization_has_weapon)) {
                            foreach($organization_has_weapon as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationHasWeaponItem<?php echo $val['weapon_id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['weapon_id']; ?>" data-tb="weapon" data-title="<?php echo $Lang->short_weapon; ?> : <?php echo $val['weapon_id']; ?>"><?php echo $Lang->short_weapon; ?> : <?php echo $val['weapon_id'];?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationHasWeapon<?php echo $_SESSION['counter']; ?>(<?php echo $val['weapon_id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organAvailabilityWeapons" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="availability_weapons" id="<?php echo $_SESSION['counter']; ?>organAvailabilityWeapons" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organPassesSummary">24) <?php echo $Lang->passes_summary;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organPassesSummaryFilter" style="border: none;" >
                <?php if(isset($organization_has_mia_summary)) {
                        if(!empty($organization_has_mia_summary)) {
                            foreach($organization_has_mia_summary as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationPassesMiaSummaryItem<?php echo $val['mia_summary_id'];?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['mia_summary_id']; ?>" data-tb="mia_summary" data-title="<?php echo $Lang->short_mia; ?> : <?php echo $val['mia_summary_id']; ?>"><?php echo $Lang->short_mia; ?> : <?php echo $val['mia_summary_id'];?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationPassesMiaSummary<?php echo $_SESSION['counter']; ?>(<?php echo $val['mia_summary_id'];?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organPassesSummary" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="passes_summary" id="<?php echo $_SESSION['counter']; ?>organPassesSummary" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>organInvolvedTheEvents">25) <?php echo $Lang->place_event_is;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>organInvolvedTheEventsFilter" style="border: none;" >
                <?php if(isset($organization_event)) {
                        if(!empty($organization_event)) {
                            foreach($organization_event as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>organizationEventItem<?php echo $val;?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val; ?>" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : <?php echo $val; ?>"><?php echo $Lang->short_event; ?> : <?php echo $val;?></span>
                                        <span class="editAll"></span><a href="javascript:removeOrganizationEvent<?php echo $_SESSION['counter']; ?>(<?php echo $val;?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>organInvolvedTheEvents" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="involved_the_events" id="<?php echo $_SESSION['counter']; ?>organInvolvedTheEvents" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label>26) <?php echo $Lang->contents_document;?></label>
            <ul class="uploader">
                <?php if(isset($organization_has_file)) {
                        if(!empty($organization_has_file)) {
                            foreach($organization_has_file as $val) { ?>
                <li class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> </li>
                <?php       }
                        }
                      } ?>
            </ul>
        </div>

        <div class="forForm">
            <label>27) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($organization_has_bibliography)) {
                        if(!empty($organization_has_bibliography)) {
                            foreach($organization_has_bibliography as $val) { ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $val['bibliography_id']; ?>" data-tb="bibliography" ><?php echo $Lang->short_bibl; ?> : <?php echo $val['bibliography_id']; ?></span>
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

<script type="text/javascript" >
    var currentInputNameOrgan<?php echo $_SESSION['counter']; ?>;
    var currentInputIdOrgan<?php echo $_SESSION['counter']; ?>;
    var checkOrganization<?php echo $_SESSION['counter']; ?> = true;
    var organization_id<?php echo $_SESSION['counter']; ?> = '<?php echo $organization_id; ?>';
    $(document).ready(function(){

        $('.eventTriggerOrg<?php echo $_SESSION['counter']; ?>').focusin(function(e){
            $('#<?php echo $_SESSION['counter']; ?>organNameOrganization').focus();
        });

        $('#<?php echo $_SESSION['counter']; ?>organPlaceEventIs').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/event/organization/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->event;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organObjectActions').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/action/organization/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->action;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organCheckedSignal').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/signal/organization_checked/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->signal;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organPassesSignal').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/signal/organization_passed/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->signal;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organPassesCriminalCase').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/criminal_case/organization/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->criminal_case;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organPassesSummary').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/mia_summary/organization/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->mia_summary;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organAvailabilityWeapons').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/weapon/organization/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->weapon;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organAvailabilityCar').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/car/organization/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->car;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organDislocationOrganization').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/address/organization/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->address;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organDummyAddress').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/address/organization_address/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->address;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organInvolvedTheEvents').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/event/organization_id/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->event;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organAlsoKnownAs').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/organization/organization/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->organization;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organPhoneNumber').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/phone/organization&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->phone_number;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organMailAddress').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/email/organization&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->mail_address;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organRelationOrganization').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/object/organization&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->relationship_objects;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>organPlaceWorkPersons').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/work_activity/organization&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->work_activity;?>');
                }
            });
        });

        $('.oneInputSaveDateOrganization<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateOrganization<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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
                        saveOrganization<?php echo $_SESSION['counter']; ?>(val,field);
                    }else{
                        saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }else{
                        saveOrganization<?php echo $_SESSION['counter']; ?>(val,field);
                    }
                }
            }else{
                if( (typeof $(this).attr('type') != 'undefined')&&(val.length == 0) ){
                    saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
                }
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>organNation').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>organNationId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>organNation').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>organNation').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>organNationId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>organNationId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_country;?>');
                    $('#<?php echo $_SESSION['counter']; ?>organNation').val('');
                    $('#<?php echo $_SESSION['counter']; ?>organNationId').val('');
                }else{
                    saveOrganization<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>organRegionActivity').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>organRegionActivityId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>organRegionActivity').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>organRegionActivity').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>organRegionActivityId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>organRegionActivityId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_country;?>');
                    $('#<?php echo $_SESSION['counter']; ?>organRegionActivity').val('');
                    $('#<?php echo $_SESSION['counter']; ?>organRegionActivityId').val('');
                }else{
                    saveOrganization<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>organCategoryOrganization').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/organization_category/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>organCategoryOrganizationId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>organCategoryOrganization').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>organCategoryOrganization').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>organCategoryOrganizationId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>organCategoryOrganizationId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_qualification;?>');
                    $('#<?php echo $_SESSION['counter']; ?>organCategoryOrganization').val('');
                    $('#<?php echo $_SESSION['counter']; ?>organCategoryOrganizationId').val('');
                }else{
                    saveOrganization<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>organSecurityOrganization').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>organSecurityOrganizationId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>organSecurityOrganization').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>organSecurityOrganization').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>organSecurityOrganizationId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>organSecurityOrganizationId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_organ;?>');
                    $('#<?php echo $_SESSION['counter']; ?>organSecurityOrganization').val('');
                    $('#<?php echo $_SESSION['counter']; ?>organSecurityOrganizationId').val('');
                }else{
                    saveOrganization<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });



        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameOrgan<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdOrgan<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=organization&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('.oneInputSaveOrganization<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                saveOrganization<?php echo $_SESSION['counter']; ?>(value,field);
            }else{
                saveOrganization<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>closeOrganization').click(function(e){
            e.preventDefault();
            <?php if (isset($other_tb_name)) { ?>
                <?php if($other_tb_name == 'organization') { ?>
                    organization_has_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(organization_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'objects_relation_org') { ?>
                    objects_relation_organization_to_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(organization_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'event_has_organization') { ?>
                    event_has_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(organization_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'event_organization') { ?>
                    event_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(organization_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'signal_passes') { ?>
                    signal_organization_passes_by_signal<?php if(isset($old_counter)){ echo $old_counter; }?>(organization_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'signal_check') { ?>
                    signal_organization_checked_by_signal<?php if(isset($old_counter)){ echo $old_counter; }?>(organization_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'mia_summary') { ?>
                    mia_summary_has_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(organization_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'action') { ?>
                    action_has_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(organization_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'criminal_case') { ?>
                    criminal_case_has_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(organization_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'work_activity') { ?>
                    work_activity_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(organization_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'bibliography') { ?>
                    var dataId = $('.activeTable:last').attr('dataId');
                    $('.activeTable').addClass('storedItem');
                    if(typeof  dataId == 'undefined'){
                        $('.activeTable').append(' : id = '+organization_id<?php echo $_SESSION['counter']; ?>);
                        $('.activeTable').attr('dataId',organization_id<?php echo $_SESSION['counter']; ?>);
                    }
                    $('.activeTable').removeClass('activeTable');
                    removeItem();
                <?php } ?>
            <?php }else{ ?>
                var dataId = $('.activeTable:last').attr('dataId');
                $('.activeTable').addClass('storedItem');
                if(typeof  dataId == 'undefined'){
                    $('.activeTable').append(' : id = '+organization_id<?php echo $_SESSION['counter']; ?>);
                    $('.activeTable').attr('dataId',organization_id<?php echo $_SESSION['counter']; ?>);
                }
                $('.activeTable').removeClass('activeTable');
                removeItem();
            <?php } ?>
        });



        <?php if(isset($organization)) {
            if(!empty($organization['reg_date'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>organDateFormation').val('<?php echo $organization['reg_date'];?>');
            <?php   }
        }?>


    });

    function closeOrganization<?php echo $_SESSION['counter']; ?>(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameOrgan<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdOrgan<?php echo $_SESSION['counter']; ?>).val(id);
        var field = $('#'+currentInputIdOrgan<?php echo $_SESSION['counter']; ?>).attr('name');
        saveOrganization<?php echo $_SESSION['counter']; ?>(id,field);
        $.fancybox.close();
        $('#'+currentInputNameOrgan<?php echo $_SESSION['counter']; ?>).focus();
    }

    function saveOrganization<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value, 'field':field };
        $.ajax({
            url: '<?php echo ROOT?>add/save_organization/'+organization_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            success: function(data){
                checkOrganization<?php echo $_SESSION['counter']; ?> = false;
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function organization_has_event<?php echo $_SESSION['counter']; ?>(event_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/organization_has_event/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+event_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>organPlaceEventIsFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationHasEventItem'+event_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+event_id+'" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : '+event_id+'"><?php echo $Lang->short_event; ?> : '+event_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeOrganizationHasEvent<?php echo $_SESSION['counter']; ?>('+event_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>organPlaceEventIs').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeOrganizationHasEvent<?php echo $_SESSION['counter']; ?>(event_id){
        var removeManHasSignal = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasSignal){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_has_event/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+event_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationHasEventItem'+event_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organPlaceEventIs').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_has_action<?php echo $_SESSION['counter']; ?>(action_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/organization_has_action/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+action_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>organObjectActionsFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationHasActionItem'+action_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+action_id+'" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : '+action_id+'"><?php echo $Lang->short_action; ?> : '+action_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeOrganizationHasAction<?php echo $_SESSION['counter']; ?>('+action_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>organObjectActions').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeOrganizationHasAction<?php echo $_SESSION['counter']; ?>(action_id){
        var removeManHasSignal = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasSignal){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_has_action/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+action_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationHasActionItem'+action_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organObjectActions').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_checked_by_signal<?php echo $_SESSION['counter']; ?>(signal_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/organization_checked_by_signal/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>organCheckedSignalFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationHasCheckedItem'+signal_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+signal_id+'" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : '+signal_id+'"><?php echo $Lang->short_signal; ?> : '+signal_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeOrganizationCheckedBySignal<?php echo $_SESSION['counter']; ?>('+signal_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>organCheckedSignal').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeOrganizationCheckedBySignal<?php echo $_SESSION['counter']; ?>(signal_id){
        var removeManHasSignal = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasSignal){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_checked_by_signal/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationHasCheckedItem'+signal_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organCheckedSignal').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_passed_by_signal<?php echo $_SESSION['counter']; ?>(signal_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/organization_passed_by_signal/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>organPassesSignalFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationPassedItem'+signal_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+signal_id+'" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : '+signal_id+'"><?php echo $Lang->short_signal; ?> : '+signal_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeOrganizationPassedBySignal<?php echo $_SESSION['counter']; ?>('+signal_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>organPassesSignal').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeOrganizationPassedBySignal<?php echo $_SESSION['counter']; ?>(signal_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_passed_by_signal/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationPassedItem'+signal_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organPassesSignal').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_has_criminal_case<?php echo $_SESSION['counter']; ?>(criminal_case_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/organization_has_criminal_case/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>organPassesCriminalCaseFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationHasCriminalCaseItem'+criminal_case_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+criminal_case_id+'" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'"><?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeOrganizationHasCriminalCase<?php echo $_SESSION['counter']; ?>('+criminal_case_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>organPassesCriminalCase').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeOrganizationHasCriminalCase<?php echo $_SESSION['counter']; ?>(criminal_case_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_has_criminal_case/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationHasCriminalCaseItem'+criminal_case_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organPassesCriminalCase').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_passes_mia_summary<?php echo $_SESSION['counter']; ?>(mia_summary_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/organization_passes_mia_summary/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+mia_summary_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>organPassesSummaryFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationPassesMiaSummaryItem'+mia_summary_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+mia_summary_id+'" data-tb="mia_summary" data-title="<?php echo $Lang->short_mia; ?> : '+mia_summary_id+'"><?php echo $Lang->short_mia; ?> : '+mia_summary_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeOrganizationPassesMiaSummary<?php echo $_SESSION['counter']; ?>('+mia_summary_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>organPassesSummary').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeOrganizationPassesMiaSummary<?php echo $_SESSION['counter']; ?>(mia_summary_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_passes_mia_summary/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+mia_summary_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationPassesMiaSummaryItem'+mia_summary_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organPassesSummary').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_has_weapon<?php echo $_SESSION['counter']; ?>(weapon_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/organization_has_weapon/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+weapon_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>organAvailabilityWeaponsFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationHasWeaponItem'+weapon_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+weapon_id+'" data-tb="weapon" data-title="<?php echo $Lang->short_weapon; ?> : '+weapon_id+'"><?php echo $Lang->short_weapon; ?> : '+weapon_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeOrganizationHasWeapon<?php echo $_SESSION['counter']; ?>('+weapon_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>organAvailabilityWeapons').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeOrganizationHasWeapon<?php echo $_SESSION['counter']; ?>(weapon_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_has_weapon/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+weapon_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationHasWeaponItem'+weapon_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organAvailabilityWeapons').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_has_car<?php echo $_SESSION['counter']; ?>(car_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/organization_has_car/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+car_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>organAvailabilityCarFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationHasCarItem'+car_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+car_id+'" data-tb="car" data-title="<?php echo $Lang->short_car; ?> : '+car_id+'"><?php echo $Lang->short_car; ?> : '+car_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeOrganizationHasCar<?php echo $_SESSION['counter']; ?>('+car_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>organAvailabilityCar').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeOrganizationHasCar<?php echo $_SESSION['counter']; ?>(car_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_has_car/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+car_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationHasCarItem'+car_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organAvailabilityCar').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }
    function organization_has_address<?php echo $_SESSION['counter']; ?>(address_id , check  , data  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/organization_has_address/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+address_id,
            type: 'POST',
            data: data,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>organDislocationOrganizationFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationHasAddressItem'+address_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" other_id="'+organization_id<?php echo $_SESSION['counter']; ?>+'" other_tb="organization_edit" data-id="'+address_id+'" data-tb="address" data-title="<?php echo $Lang->short_address; ?> : '+address_id+'"><?php echo $Lang->short_address; ?> : '+address_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeOrganizationHasAddress<?php echo $_SESSION['counter']; ?>('+address_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>organDislocationOrganization').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeOrganizationHasAddress<?php echo $_SESSION['counter']; ?>(address_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_has_address/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+address_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationHasAddressItem'+address_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organDislocationOrganization').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_address<?php echo $_SESSION['counter']; ?>(address_id , check  , data  ){
        saveOrganization<?php echo $_SESSION['counter']; ?>(address_id,'address_id');
        if( check != 'ok'){
            removeItem();
        }
        $('#<?php echo $_SESSION['counter']; ?>organDummyAddressFilter').html('<li id="<?php echo $_SESSION['counter']; ?>organizationAddressItem'+address_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+address_id+'" data-tb="address" data-title="<?php echo $Lang->short_address; ?> : '+address_id+'"><?php echo $Lang->short_address; ?> : '+address_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeOrganizationAddress<?php echo $_SESSION['counter']; ?>('+address_id+');">x</a>'
                +'</div>'
                +'</li>');
        $('#<?php echo $_SESSION['counter']; ?>organDummyAddress').focus();

    }
    function removeOrganizationAddress<?php echo $_SESSION['counter']; ?>(address_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            saveOrganization<?php echo $_SESSION['counter']; ?>(0,'address_id');
            $('#<?php echo $_SESSION['counter']; ?>organDummyAddressFilter').html('&nbsp;');
            $('#<?php echo $_SESSION['counter']; ?>organDummyAddress').focus();
        }
    }

    function organization_event<?php echo $_SESSION['counter']; ?>(event_id , check  , data  ){
        if( check != 'ok'){
            removeItem();
        }
        $.ajax({
            url: '<?php echo ROOT; ?>add/save_event/'+event_id,
            type:'POST',
            data:{ 'field': 'organization_id' , 'value' : organization_id<?php echo $_SESSION['counter']; ?>},
            success:function(data){
                $('#<?php echo $_SESSION['counter']; ?>organInvolvedTheEventsFilter').html('<li id="<?php echo $_SESSION['counter']; ?>organizationEventItem'+event_id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+event_id+'" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : '+event_id+'"><?php echo $Lang->short_event; ?> : '+event_id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeOrganizationEvent<?php echo $_SESSION['counter']; ?>('+event_id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>organInvolvedTheEvents').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });

    }
    function removeOrganizationEvent<?php echo $_SESSION['counter']; ?>(event_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/save_event/'+event_id,
                type:'POST',
                data:{ 'field': 'organization_id' , 'value' : 0},
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organInvolvedTheEventsFilter').html('&nbsp;');
                    $('#<?php echo $_SESSION['counter']; ?>organInvolvedTheEvents').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_has_organization<?php echo $_SESSION['counter']; ?>(org_id , check  , data  ){
        $.ajax({
            url: '<?php echo ROOT; ?>add/organization_has_organization/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+org_id,
            type:'POST',
            data:data,
            dataType: 'json',
            success:function(data){
            if(data.status){
                if( check != 'ok'){
                    removeItem();
                }
                $('#<?php echo $_SESSION['counter']; ?>organAlsoKnownAsFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationOrganAlsoKnownAsItem'+org_id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+org_id+'" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : '+org_id+'"><?php echo $Lang->short_organ; ?> : '+org_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeOrganizationOrganization<?php echo $_SESSION['counter']; ?>('+org_id+');">x</a>'
                        +'</div>'
                +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>organAlsoKnownAs').focus();
            }else{
                alert('<?php echo $Lang->relationship_exists;?>');
            }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeOrganizationOrganization<?php echo $_SESSION['counter']; ?>(org_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_has_organization/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+org_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationOrganAlsoKnownAsItem'+org_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organAlsoKnownAs').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });


        }
    }

    function organization_has_phone<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT; ?>add/organization_has_phone/'+organization_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            data:data,
            dataType: 'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>organPhoneNumberFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationHasPhoneItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" other_id="'+organization_id<?php echo $_SESSION['counter']; ?>+'" other_tb="organization_edit" data-id="'+data.id+'" data-from="organization" data-from_id="'+organization_id<?php echo $_SESSION['counter']; ?>+'" data-tb="phone" data-title="<?php echo $Lang->short_phone; ?> : '+data.id+'"><?php echo $Lang->short_phone; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeOrganizationHasPhone<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>organPhoneNumber').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function removeOrganizationHasPhone<?php echo $_SESSION['counter']; ?>(phone_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_has_phone/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+phone_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationHasPhoneItem'+phone_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organPhoneNumber').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }


    function organization_has_email<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT; ?>add/organization_has_email/'+organization_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            data:data,
            dataType: 'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>organMailAddressFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationHasMailItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'" data-tb="email" ><?php echo $Lang->short_email; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeOrganizationHasMail<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>organMailAddress').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function removeOrganizationHasMail<?php echo $_SESSION['counter']; ?>(email_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_has_phone/'+organization_id<?php echo $_SESSION['counter']; ?>+'/'+email_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationHasMailItem'+email_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organMailAddress').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_objects_relation<?php echo $_SESSION['counter']; ?>(org_id , relation_id){
        var data = { 'org_id' : org_id , 'relation_id' : relation_id };
        $.ajax({
            url: '<?php echo ROOT; ?>add/organization_objects_relation/'+organization_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>organRelationOrganizationFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationObjectsRelationItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'" data-tb="object" ><?php echo $Lang->short_object; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeOrganizationHasObjectsRelation<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>organRelationOrganization').focus();
            },
            faild:function(data){
                alert('<?php echo $Lang->err;?>');
            }
        });
    }

    function removeOrganizationHasObjectsRelation<?php echo $_SESSION['counter']; ?>(object_relation_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_objects_relation/'+object_relation_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationObjectsRelationItem'+object_relation_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organRelationOrganization').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function organization_has_work_activity<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT; ?>add/organization_work_activity/'+organization_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>organPlaceWorkPersonsFilter').append('<li id="<?php echo $_SESSION['counter']; ?>organizationWorkActivity'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'" data-tb="work_activity" data-title="<?php echo $Lang->short_work_activity; ?> : '+data.id+'"><?php echo $Lang->short_work_activity; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeOrganizationWorkActivity<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>organPlaceWorkPersons').focus();
            },
            faild:function(data){
                alert('<?php echo $Lang->err;?>');
            }
        });
    }

    function removeOrganizationWorkActivity<?php echo $_SESSION['counter']; ?>(work_activity){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_organization_has_man/'+work_activity,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>organizationWorkActivity'+work_activity).remove();
                    $('#<?php echo $_SESSION['counter']; ?>organPlaceWorkPersons').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

</script>