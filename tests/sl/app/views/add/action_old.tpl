<a id="<?php echo $_SESSION['counter']; ?>closeAction" class="customClose"></a>
<span class="idNumber"><?php if(isset($action_id)){ echo 'ID : '.$action_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>actionForm">


        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionContentMaterialsActions">1) <?php echo $Lang->content_materials_actions;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionContentMaterialsActionsFilter" style="border: none;" >
                <?php if(isset($material_content)) {
                        if(!empty($material_content)) {
                            foreach($material_content as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>actionContentItem<?php echo $val['id']; ?>">
                                    <div class="item actionContent" >
                                        <span data_id="<?php echo $val['id']; ?>" session_counter="<?php echo $_SESSION['counter']; ?>"><?php echo $val['content']; ?></span>
                                        <a href="javascript:removeActionContent<?php echo $_SESSION['counter']; ?>(<?php echo $val['id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                    } ?>
                &nbsp
            </ul>
            <input type="button" name="content_materials_actions" id="<?php echo $_SESSION['counter']; ?>actionContentMaterialsActions" value="Добавить" class="oneInputSaveEnter"/>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionQualificationFactFilter" style="border: none;" >
                <?php if(isset($action_has_qualification)) {
                        if(!empty($action_has_qualification)) {
                            foreach($action_has_qualification as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>actionQualificationFact<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>actionQualificationFact' , 'delete_action_qualification', '<?php echo $action_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                       }?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm" style="background: #ff0000;">
            <label for="<?php echo $_SESSION['counter']; ?>actionQualificationFact">2) <?php echo $Lang->qualification_fact;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>actionQualificationFact" dataId="<?php echo $_SESSION['counter']; ?>actionQualificationFactId" dataTableName="fancySearch/action_qualification" class="addMoreSearch addMore<?php echo $_SESSION['counter']; ?>Search k-icon k-i-search"   />
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>actionQualificationFact" dataId="<?php echo $_SESSION['counter']; ?>actionQualificationFactId" dataTableName="fancy/action_qualification" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="action_qualification" dataInputId="<?php echo $_SESSION['counter']; ?>actionQualificationFactId" dataTableName="action_qualification"  id="<?php echo $_SESSION['counter']; ?>actionQualificationFact" class="oneInputSaveEnter" />
            <input type="hidden" name="action_qualification_id" id="<?php echo $_SESSION['counter']; ?>actionQualificationFactId" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionStartActionDate">3) <?php echo $Lang->start_action_date;?></label>
            <input type="text" name="start_date" id="<?php echo $_SESSION['counter']; ?>actionStartActionDate" style="width: 505px;" class="oneInputSaveEnter dotsToDash oneInputSaveDateAction<?php echo $_SESSION['counter']; ?>"/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionStartActionTime">4) <?php echo $Lang->start_action_time;?></label>
            <input type="text" name="start_action_time" id="<?php echo $_SESSION['counter']; ?>actionStartActionTime" class="oneInputSaveEnter oneInputSaveTimeAction<?php echo $_SESSION['counter']; ?>" <?php if( (isset($action))&&(isset($action['start_time'])) ){ echo "value='".substr($action['start_time'],0,5)."'"; }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionEndActionDate">5) <?php echo $Lang->end_action_date;?></label>
            <input type="text" name="end_date" id="<?php echo $_SESSION['counter']; ?>actionEndActionDate" style="width: 505px;" class="oneInputSaveEnter dotsToDash oneInputSaveDateAction<?php echo $_SESSION['counter']; ?>"/>
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionEndActionTime">6) <?php echo $Lang->end_action_time;?></label>
            <input type="text" name="end_action_time" id="<?php echo $_SESSION['counter']; ?>actionEndActionTime" class="oneInputSaveEnter oneInputSaveTimeAction<?php echo $_SESSION['counter']; ?>" <?php if( (isset($action))&&(isset($action['end_time'])) ){ echo "value='".substr($action['end_time'],0,5)."'"; }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionDurationDAction">7) <?php echo $Lang->duration_action;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>actionDurationDAction" dataId="<?php echo $_SESSION['counter']; ?>actionDurationDActionId" dataTableName="fancy/duration" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="duration_name" id="<?php echo $_SESSION['counter']; ?>actionDurationDAction" dataInputId="<?php echo $_SESSION['counter']; ?>actionDurationDActionId" dataTableName="duration"  class="oneInputSaveEnter" <?php if(isset($action)){ if(!empty($action['duration'])){ echo "value='".$action['duration']."'"; } } ?>/>
            <input type="hidden" name="duration_id" id="<?php echo $_SESSION['counter']; ?>actionDurationDActionId" <?php if(isset($action)){ if(!empty($action['duration_id'])){ echo "value='".$action['duration_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReason">8) <?php echo $Lang->purpose_motive_reason;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReason" dataId="<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReasonId" dataTableName="fancy/action_goal" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="goal_name" id="<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReason" dataInputId="<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReasonId" dataTableName="action_goal"  class="oneInputSaveEnter" <?php if(isset($action)){ if(!empty($action['goal'])){ echo "value='".$action['goal']."'"; } } ?>/>
            <input type="hidden" name="goal_id" id="<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReasonId" <?php if(isset($action)){ if(!empty($action['goal_id'])){ echo "value='".$action['goal_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionTermsActions">9) <?php echo $Lang->terms_actions;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>actionTermsActions" dataId="<?php echo $_SESSION['counter']; ?>actionTermsActionsId" dataTableName="fancy/terms" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="terms_name" id="<?php echo $_SESSION['counter']; ?>actionTermsActions" dataInputId="<?php echo $_SESSION['counter']; ?>actionTermsActionsId" dataTableName="terms" class="oneInputSaveEnter" <?php if(isset($action)){ if(!empty($action['terms'])){ echo "value='".$action['terms']."'"; } } ?>/>
            <input type="hidden" name="terms_id" id="<?php echo $_SESSION['counter']; ?>actionTermsActionsId" <?php if(isset($action)){ if(!empty($action['terms_id'])){ echo "value='".$action['terms_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionEnsuingEffects">10) <?php echo $Lang->ensuing_effects;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>actionEnsuingEffects" dataId="<?php echo $_SESSION['counter']; ?>actionEnsuingEffectsId" dataTableName="fancy/aftermath" class="addMore addMore<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="aftermath_name" id="<?php echo $_SESSION['counter']; ?>actionEnsuingEffects" dataInputId="<?php echo $_SESSION['counter']; ?>actionEnsuingEffectsId" dataTableName="aftermath" class="oneInputSaveEnter" <?php if(isset($action)){ if(!empty($action['aftermath'])){ echo "value='".$action['aftermath']."'"; } } ?>/>
            <input type="hidden" name="aftermath_id" id="<?php echo $_SESSION['counter']; ?>actionEnsuingEffectsId" <?php if(isset($action)){ if(!empty($action['aftermath_id'])){ echo "value='".$action['aftermath_id']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionActionRelated">11) <?php echo $Lang->action_related_event_action;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionActionRelatedFilter" style="border: none;" >
                <?php if(isset($action_has_action)) {
                        if(!empty($action_has_action)) {
                            foreach($action_has_action as $val) { ?>
                            <li id="<?php echo $_SESSION['counter']; ?>actionHasActionItem<?php echo $val['action_id']; ?>">
                                <div class="item">
                                    <span class="openData" data-id="<?php echo $val['action_id']; ?>" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?>"><?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?></span>
                                    <span class="editAll"></span>
                                    <a href="javascript:removeActionHasAction<?php echo $_SESSION['counter']; ?>(<?php echo $val['action_id']; ?>);">x</a>
                                </div>
                            </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionActionRelated" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="related_action" id="<?php echo $_SESSION['counter']; ?>actionActionRelated" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionEventRelated">12) <?php echo $Lang->action_related_event_event;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionEventRelatedFilter" style="border: none;" >
                <?php if(isset($action_has_event)) {
                        if(!empty($action_has_event)) {
                            foreach($action_has_event as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>actionHasEventItem<?php echo $val['event_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['event_id']; ?>" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : <?php echo $val['event_id']; ?>"><?php echo $Lang->short_event; ?> : <?php echo $val['event_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeActionHasEvent<?php echo $_SESSION['counter']; ?>(<?php echo $val['event_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionEventRelated" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="related_action" id="<?php echo $_SESSION['counter']; ?>actionEventRelated" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionObjectActionMan">13) <?php echo $Lang->object_action_man;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionObjectActionManFilter" style="border: none;" >
                <?php if(isset($action_has_man)) {
                        if(!empty($action_has_man)) {
                            foreach($action_has_man as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>actionHasManItem<?php echo $val['man_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['man_id']; ?>" data-tb="man" data-title="<?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?>"><?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeActionHasMan<?php echo $_SESSION['counter']; ?>(<?php echo $val['man_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionObjectActionMan" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="object_action" id="<?php echo $_SESSION['counter']; ?>actionObjectActionMan" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionObjectActionEvent">14) <?php echo $Lang->object_action_event;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionObjectActionEventFilter" style="border: none;" >
                <?php if(isset($action_event_has_action)) {
                        if(!empty($action_event_has_action)) {
                            foreach($action_event_has_action as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>actionEventHasActionItem<?php echo $val['event_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['event_id']; ?>" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : <?php echo $val['event_id']; ?>"><?php echo $Lang->short_event; ?> : <?php echo $val['event_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeActionEventHasAction<?php echo $_SESSION['counter']; ?>(<?php echo $val['event_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionObjectActionEvent" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="object_action" id="<?php echo $_SESSION['counter']; ?>actionObjectActionEvent" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionObjectActionOrganization">15) <?php echo $Lang->object_action_organization;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionObjectActionOrganizationFilter" style="border: none;" >
                <?php if(isset($action_has_organization)) {
                        if(!empty($action_has_organization)) {
                            foreach($action_has_organization as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>actionHasOrganizationItem<?php echo $val['organization_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['organization_id']; ?>" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : <?php echo $val['organization_id']; ?>"><?php echo $Lang->short_organ; ?> : <?php echo $val['organization_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeActionHasOrganization<?php echo $_SESSION['counter']; ?>(<?php echo $val['organization_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionObjectActionOrganization" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="object_action" id="<?php echo $_SESSION['counter']; ?>actionObjectActionOrganization" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionObjectActionPhone">16) <?php echo $Lang->object_action_phone;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionObjectActionPhoneFilter" style="border: none;" >
                <?php if(isset($action_has_phone)) {
                        if(!empty($action_has_phone)) {
                            foreach($action_has_phone as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>actionHasPhoneItem<?php echo $val['phone_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['phone_id']; ?>" data-tb="phone" data-title="<?php echo $Lang->short_phone; ?> : <?php echo $val['phone_id']; ?>"><?php echo $Lang->short_phone; ?> : <?php echo $val['phone_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeActionHasPhone<?php echo $_SESSION['counter']; ?>(<?php echo $val['phone_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionObjectActionPhone" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="object_action" id="<?php echo $_SESSION['counter']; ?>actionObjectActionPhone" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionObjectActionWeapon">17) <?php echo $Lang->object_action_weapon;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionObjectActionWeaponFilter" style="border: none;" >
                <?php if(isset($action_has_weapon)) {
                        if(!empty($action_has_weapon)) {
                            foreach($action_has_weapon as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>actionHasWeaponItem<?php echo $val['weapon_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['weapon_id']; ?>" data-tb="weapon" data-title="<?php echo $Lang->short_weapon; ?> : <?php echo $val['weapon_id']; ?>"><?php echo $Lang->short_weapon; ?> : <?php echo $val['weapon_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeActionHasWeapon<?php echo $_SESSION['counter']; ?>(<?php echo $val['weapon_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionObjectActionWeapon" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="object_action" id="<?php echo $_SESSION['counter']; ?>actionObjectActionWeapon" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionObjectAction">18) <?php echo $Lang->object_action_car;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionObjectActionCarFilter" style="border: none;" >
                <?php if(isset($action_has_car)) {
                        if(!empty($action_has_car)) {
                            foreach($action_has_car as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>actionHasCarItem<?php echo $val['car_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['car_id']; ?>" data-tb="car" data-title="<?php echo $Lang->short_car; ?> : <?php echo $val['car_id']; ?>"><?php echo $Lang->short_car; ?> : <?php echo $val['car_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeActionHasCar<?php echo $_SESSION['counter']; ?>(<?php echo $val['car_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionObjectActionCar" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="object_action" id="<?php echo $_SESSION['counter']; ?>actionObjectActionCar" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionSourceInformationActions">19) <?php echo $Lang->source_information_actions;?></label>
            <input type="text" name="source" id="<?php echo $_SESSION['counter']; ?>actionSourceInformationActions" class="oneInputSaveEnter oneInputSaveAction<?php echo $_SESSION['counter']; ?>" <?php if(isset($action)){ if(!empty($action['source'])){ echo "value='".$action['source']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionCheckingSignal">20) <?php echo $Lang->checking_signal;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionCheckingSignalFilter" style="border: none;" >
                <?php if(isset($action_has_signal)) {
                        if(!empty($action_has_signal)) {
                            foreach($action_has_signal as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>actionPassesSignalItem<?php echo $val['signal_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['signal_id']; ?>" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?>"><?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?></span>
                                        <span class="editAll"></span>
                                        <a href="javascript:removeActionPassesSignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['signal_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionCheckingSignal" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="checking_signal" id="<?php echo $_SESSION['counter']; ?>actionCheckingSignal" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionOpenedDow">21) <?php echo $Lang->opened_dou;?></label>
            <input type="text" name="opened_dou" id="<?php echo $_SESSION['counter']; ?>actionOpenedDow" class="oneInputSaveEnter oneInputSaveAction<?php echo $_SESSION['counter']; ?>" <?php if(isset($action)){ if(!empty($action['opened_dou'])){ echo "value='".$action['opened_dou']."'"; } } ?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionCriminalCase">22) <?php echo $Lang->criminal_case;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionCriminalCaseFilter" style="border: none;" >
                <?php if(isset($action_has_criminal_case)) {
                        if(!empty($action_has_criminal_case)) {
                            foreach($action_has_criminal_case as $val) { ?>
                            <li id="<?php echo $_SESSION['counter']; ?>actionOpenedCriminalCaseItem<?php echo $val['criminal_case_id']; ?>">
                                <div class="item">
                                    <span class="openData" data-id="<?php echo $val['criminal_case_id']; ?>" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_case_id']; ?>"><?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_case_id']; ?></span>
                                    <span class="editAll"></span>
                                    <a href="javascript:removeActionOpenedCriminalCase<?php echo $_SESSION['counter']; ?>(<?php echo $val['criminal_case_id']; ?>);">x</a>
                                </div>
                            </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionCriminalCase" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="opened_criminal_case" id="<?php echo $_SESSION['counter']; ?>actionCriminalCase" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>actionPlaceAction">23) <?php echo $Lang->place_action;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>actionPlaceActionFilter" style="border: none;" >
                <?php if(isset($action)) {
                        if(!empty($action['address_id'])) { ?>
                            <li id="<?php echo $_SESSION['counter']; ?>actionHasAddressItem<?php echo $event['address_id']; ?>">
                                <div class="item">
                                    <span class="openData" data-id="<?php echo $action['address_id']; ?>" data-tb="address" data-title="<?php echo $Lang->short_address; ?> : <?php echo $action['address_id']; ?>"><?php echo $Lang->short_address; ?> : <?php echo $action['address_id']; ?></span>
                                    <span class="editAll"></span>
                                    <a href="javascript:removeActionHasAddress<?php echo $_SESSION['counter']; ?>(<?php echo $action['address_id']; ?>);">x</a>
                                </div>
                            </li>
                <?php   }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>actionPlaceAction" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="address_name" id="<?php echo $_SESSION['counter']; ?>actionPlaceAction" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label>24) <?php echo $Lang->contents_document;?></label>
            <ul class="uploader">
                <?php if(isset($action_has_file)) {
                        if(!empty($action_has_file)) {
                            foreach($action_has_file as $val) { ?>
                                <li class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> </li>
                <?php       }
                        }
                      } ?>
            </ul>
        </div>

        <div class="forForm">
            <label>25) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($action)) {
                        if(!empty($action['bibliography_id'])) {
                            ?>
                <li>
                    <div class="item">
                        <span class="openData" data-id="<?php echo $action['bibliography_id']; ?>" data-tb="bibliography" ><?php echo $Lang->short_bibl; ?> : <?php echo $action['bibliography_id']; ?></span>
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
    var currentInputNameAction<?php echo $_SESSION['counter']; ?>;
    var currentInputIdAction<?php echo $_SESSION['counter']; ?>;
    <?php if(isset($action)) { ?>
        var checkAction<?php echo $_SESSION['counter']; ?> = false;
    <?php }else{ ?>
        var checkAction<?php echo $_SESSION['counter']; ?> = true;
    <?php } ?>
    var action_id<?php echo $_SESSION['counter']; ?> = '<?php echo $action_id; ?>';
    $(document).ready(function(){

        $('#<?php echo $_SESSION['counter']; ?>actionPlaceAction').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/address/action/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->address;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionCriminalCase').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/criminal_case/action/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->criminal_case;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionCheckingSignal').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/signal/action/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->signal;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionObjectActionCar').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/car/action/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->car;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionObjectActionWeapon').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/weapon/action/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->weapon;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionObjectActionPhone').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/phone/action&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->telephone;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionObjectActionOrganization').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/organization/action/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->organization;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionObjectActionEvent').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/event/event_has_action/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->event;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionObjectActionMan').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/man/action/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->face;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionEventRelated').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/event/action_has_event/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->event;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionActionRelated').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/action/action/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->action;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>actionContentMaterialsActions').click(function(e){
            e.preventDefault();
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/text/action&old_counter=<?php echo $_SESSION['counter']; ?>",
                beforeClose: function () {
                    var textVal = $('iframe');
                    var iframe_id = textVal.attr('name');
                    var iframe = document.getElementById(iframe_id);
                    var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                    var test = innerDoc.getElementById('text');
                    var val = test.value;
                    var confirmF = confirm('<?php echo $Lang->save;?> ?');
                    if(confirmF){
                        closeFancyTextAction<?php echo $_SESSION['counter']; ?>(val);
                    }
                }
            });
        });

        $('.oneInputSaveDateAction<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });
        $('.oneInputSaveDateAction<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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
//                        saveAction<?php echo $_SESSION['counter']; ?>(val,field);
                    }else{
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }else{
//                        saveAction<?php echo $_SESSION['counter']; ?>(val,field);
                    }
                }
            }else{
                if((typeof $(this).attr('type') != 'undefined')&&(val.length == 0) ){
                    saveAction<?php echo $_SESSION['counter']; ?>('null',field);
                }
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>actionQualificationFact').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/action_qualification/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>actionQualificationFactId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>actionDurationDAction').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/duration/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>actionDurationDActionId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>actionDurationDAction').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>actionDurationDAction').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>actionDurationDActionId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>actionDurationDActionId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveAction<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_duration;?>');
                    $('#<?php echo $_SESSION['counter']; ?>actionDurationDAction').val('');
                    $('#<?php echo $_SESSION['counter']; ?>actionDurationDActionId').val('');
                }else{
                    saveAction<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveAction<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReason').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/action_goal/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReasonId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReason').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReason').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReasonId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReasonId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveAction<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_motive;?>');
                    $('#<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReason').val('');
                    $('#<?php echo $_SESSION['counter']; ?>actionPurposeMotiveReasonId').val('');
                }else{
                    saveAction<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveAction<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>actionTermsActions').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/terms/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>actionTermsActionsId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>actionTermsActions').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>actionTermsActions').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>actionTermsActionsId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>actionTermsActionsId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveAction<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_condition;?>');
                    $('#<?php echo $_SESSION['counter']; ?>actionTermsActions').val('');
                    $('#<?php echo $_SESSION['counter']; ?>actionTermsActionsId').val('');
                }else{
                    saveAction<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveAction<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>actionEnsuingEffects').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>actionEnsuingEffectsId').val(dataItem.id);
            }
        });
        $('#<?php echo $_SESSION['counter']; ?>actionEnsuingEffects').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>actionEnsuingEffects').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>actionEnsuingEffectsId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>actionEnsuingEffectsId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveAction<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_outcome;?>');
                    $('#<?php echo $_SESSION['counter']; ?>actionEnsuingEffects').val('');
                    $('#<?php echo $_SESSION['counter']; ?>actionEnsuingEffectsId').val('');
                }else{
                    saveAction<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveAction<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('.oneInputSaveAction<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                saveAction<?php echo $_SESSION['counter']; ?>(value,field);
            }else{
                saveAction<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('.addMore<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameAction<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdAction<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=action&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('.addMore<?php echo $_SESSION['counter']; ?>Search').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameAction<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdAction<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=action&old_counter=<?php echo $_SESSION['counter']; ?>&value="+$('#<?php echo $_SESSION['counter']; ?>'+currentInputNameAction<?php echo $_SESSION['counter']; ?>).val()
            });
        });

        $('.oneInputSaveTimeAction<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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

        $('#<?php echo $_SESSION['counter']; ?>closeAction').click(function(e){
            e.preventDefault();
            var dataId = $('.activeTable').attr('dataId');
            if(checkAction<?php echo $_SESSION['counter']; ?>){
                var confirmAction = confirm('<?php echo $Lang->enter_anything;?>\n <?php echo $Lang->delete_entry;?>');
                if(confirmAction){
                    $.ajax({
                        url: '<?php echo ROOT?>add/action_delete/'+action_id<?php echo $_SESSION['counter']; ?>,
                        success: function(data){
                            removeItem();
                        },
                        faild: function(data){
                            alert('<?php echo $Lang->err;?> ');
                        }
                    });
                }else{
                    if( $('#<?php echo $_SESSION['counter']; ?>actionQualificationFactFilter li').length == 0 ){
                        alert('<?php echo $Lang->enter_field;?>');
                    }else{
                        $('.activeTable').addClass('storedItem');
                        if(typeof  dataId == 'undefined'){
                            $('.activeTable').append(' : id = '+action_id<?php echo $_SESSION['counter']; ?>);
                            $('.activeTable').attr('dataId',action_id<?php echo $_SESSION['counter']; ?>);
                        }
                        $('.activeTable').removeClass('activeTable');
                        removeItem();
                    }
                }
            }else{
                var regDate = date_preg;
                var regTime = /^(2[0-3]|[01][0-9]):[0-5][0-9]$/;
                var date = $('#<?php echo $_SESSION['counter']; ?>actionStartActionDate').val();
                var time = $('#<?php echo $_SESSION['counter']; ?>actionStartActionTime').val();
                var checkDate = true;
                if( (date.length != 0)&&(time.length != 0) ){
                    if( (regDate.test(date))&&(regTime.test(time)) ){
                        var newDate = date.split('-');
                        date = newDate[2]+'-'+newDate[1]+'-'+newDate[0];
                        saveAction<?php echo $_SESSION['counter']; ?>(date+' '+time+':00','start_date');
                    }else{
                        checkDate = false;
                    }
                }else{
                    if(date.length != 0){
                        if(regDate.test(date)){
                            var newDate = date.split('-');
                            date = newDate[2]+'-'+newDate[1]+'-'+newDate[0];
                            saveAction<?php echo $_SESSION['counter']; ?>(date,'start_date');
                        }else{
                            checkDate = false;
                        }
                    }
                }
                date = $('#<?php echo $_SESSION['counter']; ?>actionEndActionDate').val();
                time = $('#<?php echo $_SESSION['counter']; ?>actionEndActionTime').val();
                if( (date.length != 0)&&(time.length != 0) ){
                    if( (regDate.test(date))&&(regTime.test(time)) ){
                        var newDate = date.split('-');
                        date = newDate[2]+'-'+newDate[1]+'-'+newDate[0];
                        saveAction<?php echo $_SESSION['counter']; ?>(date+' '+time+':00','end_date');
                    }else{
                        checkDate = false;
                    }
                }else{
                    if(date.length != 0){
                        if(regDate.test(date)){
                            var newDate = date.split('-');
                            date = newDate[2]+'-'+newDate[1]+'-'+newDate[0];
                            saveAction<?php echo $_SESSION['counter']; ?>(date,'end_date');
                        }else{
                            checkDate = false;
                        }
                    }
                }
                if(checkDate){
                    if($('#<?php echo $_SESSION['counter']; ?>actionQualificationFactFilter li').length == 0 ){
                            alert('<?php echo $Lang->enter_field;?>');
                    }else{
                        $('.activeTable').addClass('storedItem');
                        if(typeof  dataId == 'undefined'){
                            $('.activeTable').append(' : id = '+action_id<?php echo $_SESSION['counter']; ?>);
                            $('.activeTable').attr('dataId',action_id<?php echo $_SESSION['counter']; ?>);
                        }
                        $('.activeTable').removeClass('activeTable');
                        removeItem();
                    }
                }else{
                    alert('<?php echo $Lang->enter_date_time; ?>');
                }
            }

        });

        <?php if(isset($action)) { ?>
            <?php if(!empty($action['start_date'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>actionStartActionDate').val('<?php echo $action['start_date']; ?>');
            <?php } ?>
            <?php if(!empty($action['end_date'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>actionEndActionDate').val('<?php echo $action['end_date']; ?>');
            <?php } ?>
        <?php } ?>

    multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>actionQualificationFact','action_qualification','delete_action_qualification',action_id<?php echo $_SESSION['counter']; ?>);


    });

    function closeFancyAction<?php echo $_SESSION['counter']; ?>(name,id){
        //        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameAction<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdAction<?php echo $_SESSION['counter']; ?>).val(id);
        var field = $('#'+currentInputIdAction<?php echo $_SESSION['counter']; ?>).attr('name');
        saveAction<?php echo $_SESSION['counter']; ?>(id,field);
        $.fancybox.close();
    }

    function saveAction<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value,'field':field };
        $.ajax({
            url: '<?php echo ROOT?>add/action_save/'+action_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            success: function(data){
                checkAction<?php echo $_SESSION['counter']; ?> = false;
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function closeFancyTextAction<?php echo $_SESSION['counter']; ?>(data, id ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_has_material_content/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+id,
            type:'POST',
            data:{ 'data':data },
            dataType:'json',
            success:function(data){
                if(typeof  id != 'undefined'){
                    $('#<?php echo $_SESSION['counter']; ?>actionContentItem'+id).remove();
                }
                $('#<?php echo $_SESSION['counter']; ?>actionContentMaterialsActionsFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionContentItem'+data.id+'">'
                        +'<div class="item actionContent" >'
                        +'<span data_id="'+data.id+'" session_counter="<?php echo $_SESSION['counter']; ?>" >'+data.text+'</span>'
                        +'<a href="javascript:removeActionContent<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
            }
        });
//        $.fancybox.close();
        $('#<?php echo $_SESSION['counter']; ?>actionContentMaterialsActions').focus();
    }
    function removeActionContent<?php echo $_SESSION['counter']; ?>(id){
        var removeManHasWeapon = confirm('<?php echo $Lang->are_you_sure;?>');
        if(removeManHasWeapon){
            $.ajax({
                url:'<?php echo ROOT; ?>add/delete_action_has_material_content/'+id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>actionContentItem'+id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>actionContentMaterialsActions').focus();
                }
            });
        }
    }

    function action_has_address<?php echo $_SESSION['counter']; ?>(address_id , check  , data  ){
        saveAction<?php echo $_SESSION['counter']; ?>(address_id,'address_id');
        if( check != 'ok'){
            removeItem();
        }
        $('#<?php echo $_SESSION['counter']; ?>actionPlaceActionFilter').html('<li id="<?php echo $_SESSION['counter']; ?>actionHasAddressItem'+address_id+'">'
                +'<div class="item">'
                +'<span class="openData" data-id="'+address_id+'" data-tb="address" data-title="<?php echo $Lang->short_address; ?> : '+address_id+'"><?php echo $Lang->short_address; ?> : '+address_id+'</span>'
                +'<span class="editAll"></span><a href="javascript:removeActionHasAddress<?php echo $_SESSION['counter']; ?>('+address_id+');">x</a>'
                +'</div>'
                +'</li>');
        $('#<?php echo $_SESSION['counter']; ?>actionPlaceAction').focus();

    }
    function removeActionHasAddress<?php echo $_SESSION['counter']; ?>(org_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            saveAction<?php echo $_SESSION['counter']; ?>(0,'address_id');
            $('#<?php echo $_SESSION['counter']; ?>actionPlaceActionFilter').html('&nbsp;');
            $('#<?php echo $_SESSION['counter']; ?>actionPlaceAction').focus();
        }
    }

    function action_has_opened_criminal_case<?php echo $_SESSION['counter']; ?>(criminal_case_id , check  , data  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_has_criminal_case/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>actionCriminalCaseFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionOpenedCriminalCaseItem'+criminal_case_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+criminal_case_id+'" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'"><?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'</span>'
                    +'<span class="editAll"></span><a href="javascript:removeActionOpenedCriminalCase<?php echo $_SESSION['counter']; ?>('+criminal_case_id+');">x</a>'
                            +'</div>'
                    +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>actionCriminalCase').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeActionOpenedCriminalCase<?php echo $_SESSION['counter']; ?>(criminal_case_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_has_criminal_case/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>actionOpenedCriminalCaseItem'+criminal_case_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>actionCriminalCase').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }


    function action_passes_signal<?php echo $_SESSION['counter']; ?>(signal_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_passes_signal/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>actionCheckingSignalFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionPassesSignalItem'+signal_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+signal_id+'" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : '+signal_id+'"><?php echo $Lang->short_signal; ?> : '+signal_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeActionPassesSignal<?php echo $_SESSION['counter']; ?>('+signal_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>actionCheckingSignal').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeActionPassesSignal<?php echo $_SESSION['counter']; ?>(signal_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_passes_signal/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>actionPassesSignalItem'+signal_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>actionCheckingSignal').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function action_has_car<?php echo $_SESSION['counter']; ?>(car_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_has_car/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+car_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionCarFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionHasCarItem'+car_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+car_id+'" data-tb="car" data-title="<?php echo $Lang->short_car; ?> : '+car_id+'"><?php echo $Lang->short_car; ?> : '+car_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeActionHasCar<?php echo $_SESSION['counter']; ?>('+car_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionCar').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeActionHasCar<?php echo $_SESSION['counter']; ?>(car_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_has_car/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+car_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>actionHasCarItem'+car_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionCar').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function action_has_weapon<?php echo $_SESSION['counter']; ?>(weapon_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_has_weapon/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+weapon_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionWeaponFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionHasWeaponItem'+weapon_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+weapon_id+'" data-tb="weapon" data-title="<?php echo $Lang->short_weapon; ?> : '+weapon_id+'"><?php echo $Lang->short_weapon; ?> : '+weapon_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeActionHasWeapon<?php echo $_SESSION['counter']; ?>('+weapon_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionWeapon').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeActionHasWeapon<?php echo $_SESSION['counter']; ?>(weapon_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_has_weapon/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+weapon_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>actionHasWeaponItem'+weapon_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionWeapon').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function action_has_phone<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT; ?>add/action_has_phone/'+action_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            data:data,
            dataType: 'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>actionObjectActionPhoneFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionHasPhoneItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'" data-tb="phone" data-title="<?php echo $Lang->short_phone; ?> : '+data.id+'"><?php echo $Lang->short_phone; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeActionHasPhone<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>actionObjectActionPhone').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function removeActionHasPhone<?php echo $_SESSION['counter']; ?>(phone_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_has_phone/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+phone_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>actionHasPhoneItem'+phone_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionPhone').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function action_has_organization<?php echo $_SESSION['counter']; ?>(organization_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_has_organization/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionOrganizationFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionHasOrganizationItem'+organization_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+organization_id+'" data-tb="organization" data-title="<?php echo $Lang->short_organ; ?> : '+organization_id+'"><?php echo $Lang->short_organ; ?> : '+organization_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeActionHasOrganization<?php echo $_SESSION['counter']; ?>('+organization_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionOrganization').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeActionHasOrganization<?php echo $_SESSION['counter']; ?>(organization_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_has_organization/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+organization_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>actionHasOrganizationItem'+organization_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionOrganization').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function action_event_has_action<?php echo $_SESSION['counter']; ?>(event_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_event_has_action/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+event_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionEventFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionEventHasActionItem'+event_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+event_id+'" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : '+event_id+'"><?php echo $Lang->short_event; ?> : '+event_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeActionEventHasAction<?php echo $_SESSION['counter']; ?>('+event_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionEvent').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeActionEventHasAction<?php echo $_SESSION['counter']; ?>(event_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_event_has_action/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+event_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>actionEventHasActionItem'+event_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionEvent').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function action_has_man<?php echo $_SESSION['counter']; ?>(man_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_has_man/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionManFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionHasManItem'+man_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+man_id+'" data-tb="man" data-title="<?php echo $Lang->short_man; ?> : '+man_id+'" ><?php echo $Lang->short_man; ?> : '+man_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeActionHasMan<?php echo $_SESSION['counter']; ?>('+man_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionMan').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeActionHasMan<?php echo $_SESSION['counter']; ?>(man_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_has_man/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+man_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>actionHasManItem'+man_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>actionObjectActionMan').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function action_has_event<?php echo $_SESSION['counter']; ?>(event_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_has_event/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+event_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>actionEventRelatedFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionHasEventItem'+event_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+event_id+'" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : '+event_id+'"><?php echo $Lang->short_event; ?> : '+event_id+'</span>'
                            +'<a href="javascript:removeActionHasEvent<?php echo $_SESSION['counter']; ?>('+event_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>actionEventRelated').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeActionHasEvent<?php echo $_SESSION['counter']; ?>(event_id){
        var removeConfirm = confirm('<?php echo $Lang->break_link;?>');
        if(removeConfirm){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_has_event/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+event_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>actionHasEventItem'+event_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>actionEventRelated').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function action_has_action<?php echo $_SESSION['counter']; ?>(act_id , check  , data  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/action_to_action/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+act_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>actionActionRelatedFilter').append('<li id="<?php echo $_SESSION['counter']; ?>actionHasActionItem'+act_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+act_id+'" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : '+act_id+'"><?php echo $Lang->short_action; ?> : '+act_id+'</span>'
                    +'<span class="editAll"></span><a href="javascript:removeActionHasAction<?php echo $_SESSION['counter']; ?>('+act_id+');">x</a>'
                            +'</div>'
                    +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>actionActionRelated').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeActionHasAction<?php echo $_SESSION['counter']; ?>(act_id){
        var removeManHasAddress = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_action_to_action/'+action_id<?php echo $_SESSION['counter']; ?>+'/'+act_id,
                success:function(data){
                $('#<?php echo $_SESSION['counter']; ?>actionHasActionItem'+act_id).remove();
                $('#<?php echo $_SESSION['counter']; ?>actionActionRelated').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

</script>

