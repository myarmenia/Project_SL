<a class="customClose" id="<?php echo $_SESSION['counter']; ?>closeMan"></a>
<span class="idNumber"><?php if(isset($man_id)){ echo 'ID : '.$man_id; }?></span>
<div class="inContent">
    <form id="<?php echo $_SESSION['counter']; ?>manForm">
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manLastName">1) <?php echo $Lang->last_name;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manLastNameFilter">
                <?php if(isset($man_has_last_name)) {
                        if(!empty($man_has_last_name)) {
                            foreach($man_has_last_name as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manLastName<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['last_name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manLastName' , 'last_name_delete', '<?php echo $man_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                <input type="text" name="last_name" id="<?php echo $_SESSION['counter']; ?>manLastName" class="getName oneInputSaveEnter"/>
            </ul>
          <!--  <input type="button" dataName="<?php echo $_SESSION['counter']; ?> " dataId="<?php echo $_SESSION['counter']; ?> " style="right: -506px;position: relative;" value=" .. " /> -->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manFirstName">2) <?php echo $Lang->first_name;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manFirstNameFilter">
                <?php if(isset($man_has_first_name)) {
                        if(!empty($man_has_first_name)) {
                            foreach($man_has_first_name as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manFirstName<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['first_name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manFirstName' , 'first_name_delete', '<?php echo $man_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                <input type="text" name="first_name" id="<?php echo $_SESSION['counter']; ?>manFirstName" class="getName oneInputSaveEnter"/>
            </ul>
            <!--  <input type="button" dataName="<?php echo $_SESSION['counter']; ?> " dataId="<?php echo $_SESSION['counter']; ?> " style="right: -506px;position: relative;" value=" .. " /> -->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manMiddleName">3) <?php echo $Lang->middle_name;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manMiddleNameFilter">
                <?php if(isset($man_has_middle_name)) {
                        if(!empty($man_has_middle_name)) {
                            foreach($man_has_middle_name as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manMiddleName<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['middle_name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manMiddleName' , 'middle_name_delete', '<?php echo $man_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                <input type="text" name="middle_name" id="<?php echo $_SESSION['counter']; ?>manMiddleName" class="getName oneInputSaveEnter"/>
            </ul>
            <!--  <input type="button" dataName="<?php echo $_SESSION['counter']; ?> " dataId="<?php echo $_SESSION['counter']; ?> " style="right: -506px;position: relative;" value=" .. " /> -->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manLFMName">4) <?php echo "$Lang->last_name $Lang->first_name $Lang->middle_name";?></label>
            <input type="text" name="lfm_name" readonly id="<?php echo $_SESSION['counter']; ?>manLFMName" class="oneInputSaveEnter" <?php if(isset($man_name_auto)){ if(!empty($man_name_auto)){ echo"value='".$man_name_auto."'"; } }?> />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manAlsoKnownAs">5) <?php echo $Lang->also_known_as;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manAlsoKnownAsFilter" style="border: none;" >
                <?php if(isset($man_to_man)) {
                        if(!empty($man_to_man)) {
                            foreach($man_to_man as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manAlsoKnownManItem<?php echo $val['man_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['man_id']; ?>" data-tb="man" data-title="<?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?>" ><?php echo $Lang->short_man; ?> : <?php echo $val['man_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManAlsoKnownMan<?php echo $_SESSION['counter']; ?>(<?php echo $val['man_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="knowen" id="<?php echo $_SESSION['counter']; ?>manAlsoKnownAs" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="also_known_as" id="<?php echo $_SESSION['counter']; ?>manAlsoKnownAs" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manDateOfBirth">6) <?php echo $Lang->date_of_birth;?></label>
            <input type="text" name="birthday" id="<?php echo $_SESSION['counter']; ?>manDateOfBirth" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>manDateOfBirth',12)" class="oneInputSaveEnter dotsToDash"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manApproximateYear">7) <?php echo $Lang->approximate_year;?></label>
            <input type="text" name="birth_year" id="<?php echo $_SESSION['counter']; ?>manApproximateYear" class="oneInputSaveMan<?php echo $_SESSION['counter']; ?> oneInputSaveEnter" <?php if(isset($man)){ if(!empty($man['birth_year'])){ echo "value='".$man['birth_year']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPassportNumber">8) <?php echo $Lang->passport_number;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manPassportNumberFilter">
                <?php if(isset($man_has_passport)) {
                        if(!empty($man_has_passport)) {
                            foreach($man_has_passport as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manPassportNumber<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['number']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manPassportNumber' , 'passport_delete', '<?php echo $man_id ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                <input type="text" name="passport_number" id="<?php echo $_SESSION['counter']; ?>manPassportNumber" class="oneInputSaveEnter"/>
            </ul>
            <!--  <input type="button" dataName="<?php echo $_SESSION['counter']; ?> " dataId="<?php echo $_SESSION['counter']; ?> " style="right: -506px;position: relative;" value=" .. " /> -->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manGender">9) <?php echo $Lang->gender;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manGender" dataId="<?php echo $_SESSION['counter']; ?>manGenderId" dataTableName="fancy/gender" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="gender_name" id="<?php echo $_SESSION['counter']; ?>manGender" dataTableName="gender" dataInputId="<?php echo $_SESSION['counter']; ?>manGenderId" class="oneInputSaveEnter" <?php if(isset($man)){ if(!empty($man['gender'])){ echo "value='".$man['gender']."'"; } }?>/>
            <input type="hidden" name="gender_id" id="<?php echo $_SESSION['counter']; ?>manGenderId" <?php if(isset($man)){ if(!empty($man['gender_id'])){ echo "value='".$man['gender_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manNationality">10) <?php echo $Lang->nationality;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manNationality" dataId="<?php echo $_SESSION['counter']; ?>manNationalityId" dataTableName="fancy/nation" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="nation_name" id="<?php echo $_SESSION['counter']; ?>manNationality" dataTableName="nation" dataInputId="<?php echo $_SESSION['counter']; ?>manNationalityId" class="oneInputSaveEnter" <?php if(isset($man)){ if(!empty($man['nation'])){ echo "value='".$man['nation']."'"; } }?>/>
            <input type="hidden" name="nation_id" id="<?php echo $_SESSION['counter']; ?>manNationalityId" <?php if(isset($man)){ if(!empty($man['nation_id'])){ echo "value='".$man['nation_id']."'"; } }?>/>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manCitizenshipFilter" style="border: none;" >
                <?php if(isset($man_belongs_country)) {
                        if(!empty($man_belongs_country)) {
                            foreach($man_belongs_country as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manCitizenship<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manCitizenship' , 'delete_man_belongs_country', '<?php echo $man_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manCitizenship">11) <?php echo $Lang->citizenship;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manCitizenship" dataId="<?php echo $_SESSION['counter']; ?>manCitizenshipId" dataTableName="fancy/country" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="country_name" id="<?php echo $_SESSION['counter']; ?>manCitizenship" dataTableName="country" dataInputId="<?php echo $_SESSION['counter']; ?>manCitizenshipId" class="oneInputSaveEnter"/>
            <input type="hidden" name="country_id" id="<?php echo $_SESSION['counter']; ?>manCitizenshipId" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPlaceOfBirth">12) <?php echo $Lang->place_of_birth;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manPlaceOfBirth" dataId="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthId" dataTableName="fancy/country_ate" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="place_of_birth" id="<?php echo $_SESSION['counter']; ?>manPlaceOfBirth"  dataTableName="country_ate" dataInputId="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthId" class="oneInputSaveEnter"<?php if(isset($man)){ if(!empty($man['address_country_ate_name'])){ echo "value='".$man['address_country_ate_name']."'"; } }?>/>
            <input type="hidden" name="country_ate_id" id="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthId" <?php if(isset($man)){ if(!empty($man['address_country_ate_id'])){ echo "value='".$man['address_country_ate_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocal">13) <?php echo $Lang->place_of_birth_area_local;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocal" dataId="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocalId" dataTableName="fancy/region" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="place_of_birth_area_local" id="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocal" dataTableName="region" dataInputId="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocalId" class="oneInputSaveEnter"<?php if(isset($man)){ if( (!empty($man['address_region_name']))&&(!empty($man['address_region_country_id'])) ){ echo "value='".$man['address_region_name']."'"; } }?>/>
            <input type="hidden" name="region_id" id="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocalId" <?php if(isset($man)){ if( (!empty($man['address_region_id']))&&(!empty($man['address_region_country_id'])) ){ echo "value='".$man['address_region_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocal">14) <?php echo $Lang->place_of_birth_settlement_local;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocal" dataId="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocalId" dataTableName="fancy/locality" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="place_of_birth_settlement_local" id="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocal" dataTableName="locality" dataInputId="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocalId" class="oneInputSaveEnter"<?php if(isset($man)){ if( (!empty($man['address_locality_name']))&&(!empty($man['address_locality_country_id'])) ){ echo "value='".$man['address_locality_name']."'"; } }?>/>
            <input type="hidden" name="locality_id" id="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocalId" <?php if(isset($man)){ if( (!empty($man['address_locality_id']))&&(!empty($man['address_locality_country_id'])) ){ echo "value='".$man['address_locality_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthArea">15) <?php echo $Lang->place_of_birth_area;?></label>
            <input type="text" name="region_id" id="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthArea" class="oneInputSaveEnter"<?php if(isset($man)){ if( (!empty($man['address_region_name']))&&(empty($man['address_region_country_id'])) ){ echo "value='".$man['address_region_name']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlement">16) <?php echo $Lang->place_of_birth_settlement;?></label>
            <input type="text" name="locality_id" id="<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlement" class="oneInputSaveEnter"<?php if(isset($man)){ if( (!empty($man['address_locality_name']))&&(empty($man['address_locality_country_id'])) ){ echo "value='".$man['address_locality_name']."'"; } }?>/>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguagesFilter" style="border: none;" >
                <?php if(isset($man_knows_language)) {
                        if(!empty($man_knows_language)) {
                            foreach($man_knows_language as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguages<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguages' , 'delete_man_has_language', '<?php echo $man_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguages">17) <?php echo $Lang->knowledge_of_languages;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguages" dataId="<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguagesId" dataTableName="fancy/language" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="language" id="<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguages" dataTableName="language" dataInputId="<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguagesId" class="oneInputSaveEnter"/>
            <input type="hidden" name="language_id" id="<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguagesId" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPlaceOfResidencePerson">18) <?php echo $Lang->place_of_residence_person;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manPlaceOfResidencePersonFilter" style="border: none;" >
                <?php if(isset($man_has_address)) {
                        if(!empty($man_has_address)) {
                            foreach($man_has_address as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>masHasAddressItem<?php echo $val['address_id']; ?>">
                                    <div class="item">
                                        <span class="openData" other_id="<?php echo $man_id; ?>" other_tb="man_edit" data-id="<?php echo $val['address_id']; ?>" data-tb="address" data-title="<?php echo $Lang->short_address; ?> : <?php echo $val['address_id']; ?>"><?php echo $Lang->short_address; ?> : <?php echo $val['address_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasAddress<?php echo $_SESSION['counter']; ?>(<?php echo $val['address_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="place_of_residence_person" id="<?php echo $_SESSION['counter']; ?>manPlaceOfResidencePerson" value="Добавить" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manTelephoneNumber">19) <?php echo $Lang->telephone_number;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manTelephoneNumberFilter" style="border: none;" >
                <?php if(isset($man_has_phone)) {
                        if(!empty($man_has_phone)) {
                            foreach($man_has_phone as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manHasPhoneItem<?php echo $val['phone_id']; ?>">
                                    <div class="item">
                                        <span class="openData" other_id="<?php echo $man_id; ?>" other_tb="man_edit" data-id="<?php echo $val['phone_id']; ?>" data-tb="phone" data-from="man" data-from_id="<?php echo $man_id; ?>" data-title="<?php echo $Lang->short_phone; ?> : <?php echo $val['phone_id']; ?>" ><?php echo $Lang->short_phone; ?> : <?php echo $val['phone_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasPhone<?php echo $_SESSION['counter']; ?>(<?php echo $val['phone_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>manTelephoneNumber" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="telephone_number" id="<?php echo $_SESSION['counter']; ?>manTelephoneNumber" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manEmail">20) <?php echo $Lang->mail_address;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manEmailFilter" style="border: none;" >
                <?php if(isset($man_has_email)) {
                        if(!empty($man_has_email)) {
                            foreach($man_has_email as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manHasMailItem<?php echo $val['email_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['email_id']; ?>" data-tb="email" ><?php echo $Lang->short_email; ?> : <?php echo $val['email_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasMail<?php echo $_SESSION['counter']; ?>(<?php echo $val['email_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>manEmail" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="telephone_number" id="<?php echo $_SESSION['counter']; ?>manTelephoneNumber" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manAttention">21) <?php echo $Lang->attention;?></label>
            <input type="text" name="attention" id="<?php echo $_SESSION['counter']; ?>manAttention" class="oneInputSaveMan<?php echo $_SESSION['counter']; ?> oneInputSaveEnter"<?php if(isset($man)){ if(!empty($man['attention'])){ echo "value='".$man['attention']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manAdditionalInformationPerson">22) <?php echo $Lang->additional_information_person;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manAdditionalInformationPersonFilter" style="border: none;" >
                <?php if(isset($more_data_man)) {
                        if(!empty($more_data_man)) {
                            foreach($more_data_man as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manAdditionalItem<?php echo $val['id']; ?>">
                                    <div class="item manAdditional">
                                        <span data_id="<?php echo $val['id']; ?>" session_counter="<?php echo $_SESSION['counter']; ?>"><?php echo $val['text']; ?>...</span>
                                        <a href="javascript:removeManMoreData<?php echo $_SESSION['counter']; ?>(<?php echo $val['id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="man_more_data" id="<?php echo $_SESSION['counter']; ?>manAdditionalInformationPerson" value="Добавить" class="oneInputSaveEnter"/>
        </div>

        <!--div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPersonDescribedInTheAbstract"><?php echo $Lang->person_described_in_the_abstract;?></label>
            <input type="text" name="person_described_in_the_abstract" id="<?php echo $_SESSION['counter']; ?>manPersonDescribedInTheAbstract" class="oneInputSaveEnter"/>
        </div-->

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manWorship">23) <?php echo $Lang->worship;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manWorship" dataId="<?php echo $_SESSION['counter']; ?>manWorshipId" dataTableName="fancy/religion" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="religion" id="<?php echo $_SESSION['counter']; ?>manWorship" dataTableName="religion" dataInputId="<?php echo $_SESSION['counter']; ?>manWorshipId" class="oneInputSaveEnter"<?php if(isset($man)){ if(!empty($man['religion'])){ echo "value='".$man['religion']."'"; } }?>/>
            <input type="hidden" name="religion_id" id="<?php echo $_SESSION['counter']; ?>manWorshipId" <?php if(isset($man)){ if(!empty($man['religion_id'])){ echo "value='".$man['religion_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manOccupation">24) <?php echo $Lang->occupation;?></label>
            <input type="text" name="occupation" id="<?php echo $_SESSION['counter']; ?>manOccupation" class="oneInputSaveMan<?php echo $_SESSION['counter']; ?> oneInputSaveEnter"<?php if(isset($man)){ if(!empty($man['occupation'])){ echo "value='".$man['occupation']."'"; } }?>/>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manOperationCategoryFilter" style="border: none;" >
                <?php if(isset($man_has_operation_category)) {
                        if(!empty($man_has_operation_category)) {
                            foreach($man_has_operation_category as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manOperationCategory<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manOperationCategory' , 'delete_man_operation_category', '<?php echo $man_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manOperationCategory">25) <?php echo $Lang->operational_category_person;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manOperationCategory" dataId="<?php echo $_SESSION['counter']; ?>manOperationCategoryId" dataTableName="fancySearch/operation_category" class="addMoreSearch addMoreSearch<?php echo $_SESSION['counter']; ?> k-icon k-i-search"   />
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manOperationCategory" dataId="<?php echo $_SESSION['counter']; ?>manOperationCategoryId" dataTableName="fancy/operation_category" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="operation_category" id="<?php echo $_SESSION['counter']; ?>manOperationCategory" dataTableName="operation_category" dataInputId="<?php echo $_SESSION['counter']; ?>manOperationCategoryId" class="oneInputSaveEnter"/>
            <input type="hidden" name="operation_category_id" id="<?php echo $_SESSION['counter']; ?>manOperationCategoryId" />
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearchFilter" style="border: none;" >
                <?php if(isset($country_search_man)) {
                        if(!empty($country_search_man)) {
                            foreach($country_search_man as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearch<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearch' , 'delete_country_search_man', '<?php echo $man_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearch">26) <?php echo $Lang->country_carrying_out_search;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearch" dataId="<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearchId" dataTableName="fancy/country" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="country" id="<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearch"  dataTableName="country" dataInputId="<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearchId" class="oneInputSaveEnter"/>
            <input type="hidden" name="country_id" id="<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearchId" />
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manDeclaredWantedListWith">27) <?php echo $Lang->declared_wanted_list_with;?></label>
            <input type="text" name="start_wanted" id="<?php echo $_SESSION['counter']; ?>manDeclaredWantedListWith" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>manDeclaredWantedListWith',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateMan<?php echo $_SESSION['counter']; ?>"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manHomeMonitoringStart">28) <?php echo $Lang->home_monitoring_start;?></label>
            <input type="text" name="entry_date" id="<?php echo $_SESSION['counter']; ?>manHomeMonitoringStart" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>manHomeMonitoringStart',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateMan<?php echo $_SESSION['counter']; ?>"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manEndMonitoringStart">29) <?php echo $Lang->end_monitoring_start;?></label>
            <input type="text" name="exit_date" id="<?php echo $_SESSION['counter']; ?>manEndMonitoringStart" style="width: 505px;" onkeydown="validateNumber(event,'<?php echo $_SESSION['counter']; ?>manEndMonitoringStart',12)" class="oneInputSaveEnter dotsToDash oneInputSaveDateMan<?php echo $_SESSION['counter']; ?>"/>
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manEducationFilter" style="border: none;" >
                <?php if(isset($man_has_education)) {
                        if(!empty($man_has_education)) {
                            foreach($man_has_education as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manEducation<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manEducation' , 'delete_man_education', '<?php echo $man_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manEducation">30) <?php echo $Lang->education;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manEducation" dataId="<?php echo $_SESSION['counter']; ?>manEducationId" dataTableName="fancy/education" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="education" id="<?php echo $_SESSION['counter']; ?>manEducation"  dataTableName="education" dataInputId="<?php echo $_SESSION['counter']; ?>manEducationId" class="oneInputSaveEnter"/>
            <input type="hidden" name="education_id" id="<?php echo $_SESSION['counter']; ?>manEducationId" />
        </div>

        <div style="width: 100%;text-align: right;top:14px;position: relative;">
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manPartyFilter" style="border: none;" >
                <?php if(isset($man_has_party)) {
                        if(!empty($man_has_party)) {
                            foreach($man_has_party as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manParty<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manParty' , 'delete_man_party', '<?php echo $man_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
            </ul>
            <input type="hidden" class="oneInputSaveEnter" readonly="readonly" />
        </div>
        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manParty">31) <?php echo $Lang->party;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manParty" dataId="<?php echo $_SESSION['counter']; ?>manPartyId" dataTableName="fancy/party" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="party" id="<?php echo $_SESSION['counter']; ?>manParty"  dataTableName="party" dataInputId="<?php echo $_SESSION['counter']; ?>manPartyId" class="oneInputSaveEnter"/>
            <input type="hidden" name="party_id" id="<?php echo $_SESSION['counter']; ?>manPartyId" />
        </div>


        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manWorkExperiencePerson">32) <?php echo $Lang->work_experience_person;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manWorkExperiencePersonFilter" style="border: none;" >
                <?php if(isset($man_has_work_activity)) {
                        if(!empty($man_has_work_activity)) {
                            foreach($man_has_work_activity as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manHasWorkActivityItem<?php echo $val['work_activity_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['work_activity_id']; ?>" data-tb="work_activity" data-title="<?php echo $Lang->short_work_activity; ?> : <?php echo $val['work_activity_id']; ?>"><?php echo $Lang->short_work_activity; ?> : <?php echo $val['work_activity_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasWorkActivity<?php echo $_SESSION['counter']; ?>(<?php echo $val['work_activity_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>manWorkExperiencePerson" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="work_experience_person" id="<?php echo $_SESSION['counter']; ?>manWorkExperiencePerson" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manStayAbroad">33) <?php echo $Lang->stay_abroad;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manStayAbroadFilter" style="border: none;" >
                <?php if(isset($man_bean_country)) {
                        if(!empty($man_bean_country)) {
                            foreach($man_bean_country as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manBeanCountryItem<?php echo $val['man_bean_country_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['man_bean_country_id']; ?>" data-tb="man_beann_country" data-title="<?php echo $Lang->short_bean_country; ?> : <?php echo $val['man_bean_country_id']; ?>"><?php echo $Lang->short_bean_country; ?> : <?php echo $val['man_bean_country_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManBeanCountry<?php echo $_SESSION['counter']; ?>(<?php echo $val['man_bean_country_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="telephone" id="<?php echo $_SESSION['counter']; ?>manStayAbroad" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="stay_abroad" id="<?php echo $_SESSION['counter']; ?>manStayAbroad" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manExternalSignsSign">34) <?php echo $Lang->external_signs;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manExternalSignsSignFilter" style="border: none;" >
                <?php if(isset($man_external_sign_has_sign)) {
                        if(!empty($man_external_sign_has_sign)) {
                            foreach($man_external_sign_has_sign as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manExternalSignsSignItem<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['id']; ?>/a" data-tb="external_signs" data-title="<?php echo $Lang->short_external_sign; ?> : <?php echo $val['id']; ?>" ><?php echo $Lang->short_external_sign; ?> : <?php echo $val['id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManExternalSignsSign<?php echo $_SESSION['counter']; ?>(<?php echo $val['id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="man_has_action" id="<?php echo $_SESSION['counter']; ?>manExternalSignsSign" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="external_signs" id="<?php echo $_SESSION['counter']; ?>manExternalSignsSign" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manExternalSignsPhoto">35) <?php echo $Lang->external_signs_photo;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manExternalSignsPhotoFilter" style="border: none;" >
                <?php if(isset($man_external_sign_has_photo)) {
                        if(!empty($man_external_sign_has_photo)) {
                            foreach($man_external_sign_has_photo as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manExternalSignsPhotoItem<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['id']; ?>" data-tb="external_photo" data-title="<?php echo $Lang->short_external_sign; ?> : <?php echo $val['id']; ?>"><?php echo $Lang->short_external_sign; ?> : <?php echo $val['id']; ?></span>
                                        <a href="javascript:removeManExternalSignsPhoto<?php echo $_SESSION['counter']; ?>(<?php echo $val['id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="man_has_action" id="<?php echo $_SESSION['counter']; ?>manExternalSignsPhoto" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="external_signs" id="<?php echo $_SESSION['counter']; ?>manExternalSignsPhoto" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manAlias">36) <?php echo $Lang->alias;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manAliasFilter">
                <?php if(isset($man_has_nickname)) {
                        if(!empty($man_has_nickname)) {
                            foreach($man_has_nickname as $val) { ?>
                                <li id="listItem<?php echo $_SESSION['counter']; ?>manAlias<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span><?php echo $val['name']; ?></span>
                                        <a href="javascript:removeMulti('<?php echo $val['id']; ?>' , '<?php echo $_SESSION['counter']; ?>manAlias' , 'nickname_delete', '<?php echo $man_id; ?>');">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                <input type="text" name="alias" id="<?php echo $_SESSION['counter']; ?>manAlias" class="oneInputSaveEnter"/>
            </ul>
            <!--  <input type="button" dataName="<?php echo $_SESSION['counter']; ?> " dataId="<?php echo $_SESSION['counter']; ?> " style="right: -506px;position: relative;" value=" .. " /> -->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manOperTiesMan">37) <?php echo $Lang->oper_ties_man;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manOperTiesManFilter" style="border: none;" >
                <?php if(isset($man_has_objects_man)) {
                        if(!empty($man_has_objects_man)) {
                            foreach($man_has_objects_man as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manObjectsManItem<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span  class="openData" data-id="<?php echo $val['id']; ?>" data-tb="object" ><?php echo $Lang->short_object; ?> : <?php echo $val['id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManObjectsMan<?php echo $_SESSION['counter']; ?>(<?php echo $val['id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="man_has_action" id="<?php echo $_SESSION['counter']; ?>manOperTiesMan" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="oper_ties" id="<?php echo $_SESSION['counter']; ?>manOperTiesMan" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manOperTiesOrganization">38) <?php echo $Lang->oper_ties_organization;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manOperTiesOrganizationFilter" style="border: none;" >
                <?php if(isset($man_has_objects_organization)) {
                        if(!empty($man_has_objects_organization)) {
                            foreach($man_has_objects_organization as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manObjectsOrganizationItem<?php echo $val['id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['id']; ?>" data-tb="object" ><?php echo $Lang->short_object; ?> : <?php echo $val['id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManObjectsOrganization<?php echo $_SESSION['counter']; ?>(<?php echo $val['id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="man_has_action" id="<?php echo $_SESSION['counter']; ?>manOperTiesOrganization" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="oper_ties" id="<?php echo $_SESSION['counter']; ?>manOperTiesOrganization" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manFaceOpened">39) <?php echo $Lang->face_opened;?></label>
            <input type="text" name="opened_dou" id="<?php echo $_SESSION['counter']; ?>manFaceOpened" class="oneInputSaveMan<?php echo $_SESSION['counter']; ?> oneInputSaveEnter"<?php if(isset($man)){ if(!empty($man['opened_dou'])){ echo "value='".$man['opened_dou']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manMemberActions">40) <?php echo $Lang->member_actions;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manMemberActionsFilter" style="border: none;" >
                <?php if(isset($man_has_action)) {
                        if(!empty($man_has_action)) {
                            foreach($man_has_action as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>masHasActionItem<?php echo $val['action_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['action_id']; ?>" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?>"><?php echo $Lang->short_action; ?> : <?php echo $val['action_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasAction<?php echo $_SESSION['counter']; ?>(<?php echo $val['action_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="man_has_action" id="<?php echo $_SESSION['counter']; ?>manMemberActions" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="member_actions" id="<?php echo $_SESSION['counter']; ?>manMemberActions" class="oneInputSaveEnter"/-->
        </div>



        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manToEvent">41) <?php echo $Lang->to_event;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manToEventFilter" style="border: none;" >
                <?php if(isset($man_has_event)) {
                        if(!empty($man_has_event)) {
                            foreach($man_has_event as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>masHasEventItem<?php echo $val['event_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['event_id']; ?>" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : <?php echo $val['event_id']; ?>"><?php echo $Lang->short_event; ?> : <?php echo $val['event_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasEvent<?php echo $_SESSION['counter']; ?>(<?php echo $val['event_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      }?>
                &nbsp
            </ul>
            <input type="button" name="event_has_man" id="<?php echo $_SESSION['counter']; ?>manToEvent" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="to_event" id="<?php echo $_SESSION['counter']; ?>manToEvent" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manSourceInformation">42) <?php echo $Lang->source_information;?></label>
            <input type="button" dataName="<?php echo $_SESSION['counter']; ?>manSourceInformation" dataId="<?php echo $_SESSION['counter']; ?>manSourceInformationId" dataTableName="fancy/resource" class="addMore addMoreMan<?php echo $_SESSION['counter']; ?> k-icon k-i-plus"   />
            <input type="text" name="resource" id="<?php echo $_SESSION['counter']; ?>manSourceInformation" dataTableName="resource" dataInputId="<?php echo $_SESSION['counter']; ?>manSourceInformationId" class="oneInputSaveEnter" <?php if(isset($man)){ if(!empty($man['resource'])){ echo "value='".$man['resource']."'"; } }?>/>
            <input type="hidden" name="resource_id" id="<?php echo $_SESSION['counter']; ?>manSourceInformationId"  <?php if(isset($man)){ if(!empty($man['resource_id'])){ echo "value='".$man['resource_id']."'"; } }?>/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manTestSignal">43) <?php echo $Lang->test_signal;?></label>
            <!--input type="text" name="test_signal" id="<?php echo $_SESSION['counter']; ?>manTestSignal" class="oneInputSaveEnter"/-->
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manTestSignalFilter" style="border: none;" >
                <?php if(isset($man_checked_by_signal)) {
                        if(!empty($man_checked_by_signal)) {
                            foreach($man_checked_by_signal as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>masHasSignalItem<?php echo $val['signal_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['signal_id']; ?>" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?>"><?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasSignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['signal_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="signal_has_man" id="<?php echo $_SESSION['counter']; ?>manTestSignal" value="Добавить" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPassesSignal">44) <?php echo $Lang->passes_signal;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manPassesSignalFilter" style="border: none;" >
                <?php if(isset($man_passed_by_signal)) {
                        if(!empty($man_passed_by_signal)) {
                            foreach($man_passed_by_signal as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>masPassesSignalItem<?php echo $val['signal_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['signal_id']; ?>" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?>" ><?php echo $Lang->short_signal; ?> : <?php echo $val['signal_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManPassedBySignal<?php echo $_SESSION['counter']; ?>(<?php echo $val['signal_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="man_passed_by_signal" id="<?php echo $_SESSION['counter']; ?>manPassesSignal" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="passes_signal" id="<?php echo $_SESSION['counter']; ?>manPassesSignal" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manCriminalCase">45) <?php echo $Lang->criminal_case;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manCriminalCaseFilter" style="border: none;" >
                <?php if(isset($man_has_criminal_case)) {
                        if(!empty($man_has_criminal_case)) {
                            foreach($man_has_criminal_case as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>masHasCriminalCaseItem<?php echo $val['criminal_case_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['criminal_case_id']; ?>" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_case_id']; ?>"><?php echo $Lang->short_criminal; ?> : <?php echo $val['criminal_case_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasCriminalCase<?php echo $_SESSION['counter']; ?>(<?php echo $val['criminal_case_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="criminal_case_has_man" id="<?php echo $_SESSION['counter']; ?>manCriminalCase" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="criminal_case" id="<?php echo $_SESSION['counter']; ?>manCriminalCase" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPassesSummary">46) <?php echo $Lang->passes_summary;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manPassesSummaryFilter" style="border: none;" >
                <?php if(isset($man_passes_mia_summary)) {
                        if(!empty($man_passes_mia_summary)) {
                            foreach($man_passes_mia_summary as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>masHasPassesSummaryItem<?php echo $val['mia_summary_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['mia_summary_id']; ?>" data-tb="mia_summary" data-title="<?php echo $Lang->short_mia; ?> : <?php echo $val['mia_summary_id']; ?>"><?php echo $Lang->short_mia; ?> : <?php echo $val['mia_summary_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasMiaSummary<?php echo $_SESSION['counter']; ?>(<?php echo $val['mia_summary_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="mia_summary_man" id="<?php echo $_SESSION['counter']; ?>manPassesSummary" value="Добавить" class="oneInputSaveEnter"/>
            <!--input type="text" name="passes_summary" id="<?php echo $_SESSION['counter']; ?>manPassesSummary" class="oneInputSaveEnter"/-->
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPresenceMachine">47) <?php echo $Lang->presence_machine;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manPresenceMachineFilter" style="border: none;" >
                <?php if(isset($man_has_car)) {
                        if(!empty($man_has_car)) {
                            foreach($man_has_car as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manHasCarItem<?php echo $val['car_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['car_id']; ?>" data-tb="car" data-title="<?php echo $Lang->short_car; ?> : <?php echo $val['car_id']; ?>"><?php echo $Lang->short_car; ?> : <?php echo $val['car_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasCar<?php echo $_SESSION['counter']; ?>(<?php echo $val['car_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="presence_machine" id="<?php echo $_SESSION['counter']; ?>manPresenceMachine" value="Добавить" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manPresenceWeapons">48) <?php echo $Lang->presence_weapons;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manPresenceWeaponsFilter" style="border: none;" >
                <?php if(isset($man_has_weapon)) {
                        if(!empty($man_has_weapon)) {
                            foreach($man_has_weapon as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manHasWeaponItem<?php echo $val['weapon_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['weapon_id']; ?>" data-tb="weapon" data-title="<?php echo $Lang->short_weapon; ?> : <?php echo $val['weapon_id']; ?>"><?php echo $Lang->short_weapon; ?> : <?php echo $val['weapon_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManHasWeapon<?php echo $_SESSION['counter']; ?>(<?php echo $val['weapon_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="presence_weapons" id="<?php echo $_SESSION['counter']; ?>manPresenceWeapons" value="Добавить" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label for="<?php echo $_SESSION['counter']; ?>manUsesMachine">49) <?php echo $Lang->uses_machine;?></label>
            <ul class="filterlist" id="<?php echo $_SESSION['counter']; ?>manUsesMachineFilter" style="border: none;" >
                <?php if(isset($man_use_car)) {
                        if(!empty($man_use_car)) {
                            foreach($man_use_car as $val) { ?>
                                <li id="<?php echo $_SESSION['counter']; ?>manUseCarItem<?php echo $val['car_id']; ?>">
                                    <div class="item">
                                        <span class="openData" data-id="<?php echo $val['car_id']; ?>" data-tb="car" data-title="<?php echo $Lang->short_car; ?> : <?php echo $val['car_id']; ?>"><?php echo $Lang->short_car; ?> : <?php echo $val['car_id']; ?></span>
                                        <span class="editAll"></span><a href="javascript:removeManUseCar<?php echo $_SESSION['counter']; ?>(<?php echo $val['car_id']; ?>);">x</a>
                                    </div>
                                </li>
                <?php       }
                        }
                      } ?>
                &nbsp
            </ul>
            <input type="button" name="uses_machine" id="<?php echo $_SESSION['counter']; ?>manUsesMachine" value="Добавить" class="oneInputSaveEnter"/>
        </div>

        <div class="forForm">
            <label>50) <?php echo $Lang->answer; ?></label>
            <div id="<?php echo $_SESSION['counter']; ?>file-uploader-man"></div>
            <ul id="<?php echo $_SESSION['counter']; ?>uploadedFiles" class="uploader">
                <?php if(isset($man_own_file)) {
                        if(!empty($man_own_file)) {
                            foreach($man_own_file as $val) { ?>
                <li><span class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> добавлен</span> | <a class="deleteFileMan" data-id="<?php echo $val['id']; ?>">X</a></li>
                <?php       }
                        }
                      }?>
            </ul>
        </div>

        <div class="forForm">
            <label>51) <?php echo $Lang->contents_document;?></label>
            <ul class="uploader">
                <?php if(isset($man_has_file)) {
                        if(!empty($man_has_file)) {
                            foreach($man_has_file as $val) { ?>
                                <li class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> </li>
                <?php       }
                        }
                      } ?>
            </ul>
        </div>

        <div class="forForm">
            <label>52) <?php echo $Lang->ties;?></label>
            <ul class="filterlist"  style="border: none;" >
                <?php if(isset($man_has_bibliography)) {
                        if(!empty($man_has_bibliography)) {
                            foreach($man_has_bibliography as $val) { ?>
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

<script>
    var currentInputNameMan<?php echo $_SESSION['counter']; ?>;
    var currentInputIdMan<?php echo $_SESSION['counter']; ?>;
    var checkMan<?php echo $_SESSION['counter']; ?> = true;
    <?php if(isset($man)) {
            if(!empty($man['born_address_id'])) { ?>
                var man_address_id<?php echo $_SESSION['counter']; ?> = '<?php echo $man['born_address_id'];?>';
        <?php }else { ?>
                var man_address_id<?php echo $_SESSION['counter']; ?> = 0;
        <?php }?>
    <?php }else{ ?>
        var man_address_id<?php echo $_SESSION['counter']; ?> = 0;
    <?php }?>

    var man_id<?php echo $_SESSION['counter']; ?> = '<?php echo $man_id; ?>';
    $(document).ready(function(){

        $('#<?php echo $_SESSION['counter']; ?>manPresenceWeapons').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/weapon/man/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->presence_weapons;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manPlaceOfResidencePerson').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/address/man/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->place_of_residence_person;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manTestSignal').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/signal/man/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->signal;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manMemberActions').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/action/man/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->action;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manToEvent').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/event/man/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->event;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manCriminalCase').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/criminal_case/man/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->criminal_case;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manPassesSummary').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/mia_summary/man/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->passes_summary;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manPassesSignal').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/signal/man_passed/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->signal;?>');
                }
            });
        });


        $('#<?php echo $_SESSION['counter']; ?>manUsesMachine').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/car/man_use/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->uses_machine;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manPresenceMachine').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/car/man/<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->presence_machine;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manAlsoKnownAs').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>open/man/man/'+bId+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->face;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manTelephoneNumber').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/phone/man&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->telephone;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manEmail').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/email/man&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->mail_address;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manWorkExperiencePerson').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/work_activity/man&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->work_activity;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manStayAbroad').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/man_beann_country/'+man_id<?php echo $_SESSION['counter']; ?>+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->man_bean_country;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manOperTiesOrganization').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/object/man_for_organization&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->relationship_objects;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manOperTiesMan').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/object/man_for_man&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->relationship_objects;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manExternalSignsSign').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/external_signs/'+man_id<?php echo $_SESSION['counter']; ?>+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->external_signs;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manExternalSignsPhoto').click(function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo ROOT; ?>add/external_signs_photo/'+man_id<?php echo $_SESSION['counter']; ?>+'&old_counter=<?php echo $_SESSION['counter']; ?>',
                dataType:'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->external_signs_photo;?>');
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manOperationCategory').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/operation_category/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>manOperationCategoryId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manEducation').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/education/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>manEducationId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manParty').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/party/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>manPartyId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearch').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearchId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manGender').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/gender/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>manGenderId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manGender').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>manGender').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>manGenderId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>manGenderId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveMan<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_gender;?>');
                    $('#<?php echo $_SESSION['counter']; ?>manGender').val('');
                    $('#<?php echo $_SESSION['counter']; ?>manGenderId').val('');
                }else{
                    saveMan<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveMan<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manSourceInformation').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>manSourceInformationId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manSourceInformation').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>manSourceInformation').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>manSourceInformationId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>manSourceInformationId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveMan<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_resource;?>');
                    $('#<?php echo $_SESSION['counter']; ?>manSourceInformation').val('');
                    $('#<?php echo $_SESSION['counter']; ?>manSourceInformationId').val('');
                }else{
                    saveMan<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveMan<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manNationality').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/nation/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>manNationalityId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manNationality').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>manNationality').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>manNationalityId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>manNationalityId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveMan<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_nation;?>');
                    $('#<?php echo $_SESSION['counter']; ?>manNationality').val('');
                    $('#<?php echo $_SESSION['counter']; ?>manNationalityId').val('');
                }else{
                    saveMan<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveMan<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });


        $('#<?php echo $_SESSION['counter']; ?>manCitizenship').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>manCitizenshipId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguages').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/language/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguagesId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manWorship').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/religion/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#<?php echo $_SESSION['counter']; ?>manWorshipId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manWorship').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>manWorship').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>manWorshipId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>manWorshipId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    saveMan<?php echo $_SESSION['counter']; ?>('null',field);
                    alert('<?php echo $Lang->enter_religion;?>');
                    $('#<?php echo $_SESSION['counter']; ?>manWorship').val('');
                    $('#<?php echo $_SESSION['counter']; ?>manWorshipId').val('');
                }else{
                    saveMan<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveMan<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });
/////////////////////////   man born address //////////////////////
        $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirth').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirth').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirth').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    var data = { 'field':field , 'value':'null' };
                    saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
                    alert('<?php echo $Lang->enter_country;?>');
                    $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirth').val('');
                    $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthId').val('');
                }else{
                    var data = { 'field':field , 'value':value };
                    saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
                }
            }else{
                var data = { 'field':field , 'value':'null' };
                saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocal').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocalId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocal').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocal').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocalId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocalId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    var data = { 'field':field , 'value':'null' };
                    saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
                    alert('<?php echo $Lang->enter_region;?>');
                    $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocal').val('');
                    $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthAreaLocalId').val('');
                }else{
                    var data = { 'field':field , 'value':value };
                    saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
                }
            }else{
                var data = { 'field':field , 'value':'null' };
                saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocal').kendoAutoComplete({
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
                $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocalId').val(dataItem.id);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocal').focusout(function(e){
            e.preventDefault();
            var text = $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocal').val();
            var value = $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocalId').val();
            var field = $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocalId').attr('name');
            if(text.length != 0){
                if((text.length != 0)&&(value.length == 0)){
                    var data = { 'field':field , 'value':'null' };
                    saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
                    alert('<?php echo $Lang->enter_locality;?>');
                    $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocal').val('');
                    $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlementLocalId').val('');
                }else{
                    var data = { 'field':field , 'value':value };
                    saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
                }
            }else{
                var data = { 'field':field , 'value':'null' };
                saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthArea').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if( value.length != 0 ){
                var data = { 'field':field , 'value':value , 'withSave': 1 };
                saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
            }else{
                var data = { 'field':field , 'value':'null' , 'ch' : 1 };
                saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manPlaceOfBirthSettlement').focusout(function(e){
            e.preventDefault();
            var value = $(this).val();
            var field = $(this).attr('name');
            if( value.length != 0 ){
                var data = { 'field':field , 'value':value , 'withSave': 1 };
                saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
            }else{
                var data = { 'field':field , 'value':'null' , 'ch' : 1};
                saveManBornAddress<?php echo $_SESSION['counter']; ?>(data);
            }
        });

////////////////////////////   end man born address ///////////////////
        $('.addMoreMan<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameMan<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdMan<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=man&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('.addMoreSearch<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNameMan<?php echo $_SESSION['counter']; ?> = $(this).attr('dataName');
            currentInputIdMan<?php echo $_SESSION['counter']; ?> = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url+"&type=man&value="+$('#'+currentInputNameMan<?php echo $_SESSION['counter']; ?>).val()+'&old_counter=<?php echo $_SESSION['counter']; ?>'
            });
        });

        multiSelectMaker('<?php echo $_SESSION['counter']; ?>manLastName','man_last_name','last_name_delete',man_id<?php echo $_SESSION['counter']; ?>);
        multiSelectMaker('<?php echo $_SESSION['counter']; ?>manFirstName','man_first_name','first_name_delete',man_id<?php echo $_SESSION['counter']; ?>);
        multiSelectMaker('<?php echo $_SESSION['counter']; ?>manMiddleName','man_middle_name','middle_name_delete',man_id<?php echo $_SESSION['counter']; ?>);
        multiSelectMaker('<?php echo $_SESSION['counter']; ?>manAlias','man_nickname','nickname_delete',man_id<?php echo $_SESSION['counter']; ?>);
        multiSelectMaker('<?php echo $_SESSION['counter']; ?>manPassportNumber','man_passport','passport_delete',man_id<?php echo $_SESSION['counter']; ?>);

        multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>manCitizenship','man_belongs_country','delete_man_belongs_country',man_id<?php echo $_SESSION['counter']; ?>);
        multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>manKnowledgeOfLanguages','man_has_language','delete_man_has_language',man_id<?php echo $_SESSION['counter']; ?>);
        multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>manEducation','man_education','delete_man_education',man_id<?php echo $_SESSION['counter']; ?>);
        multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>manParty','man_party','delete_man_party',man_id<?php echo $_SESSION['counter']; ?>);
        multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>manOperationCategory','man_operation_category','delete_man_operation_category',man_id<?php echo $_SESSION['counter']; ?>);
        multiSelectAutoCompleteMaker('<?php echo $_SESSION['counter']; ?>manCountryCarryingOutSearch','country_search_man','delete_country_search_man',man_id<?php echo $_SESSION['counter']; ?>);

        $('.oneInputSaveDateMan<?php echo $_SESSION['counter']; ?>').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('.oneInputSaveDateMan<?php echo $_SESSION['counter']; ?>').focusout(function(e){
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
                        saveMan<?php echo $_SESSION['counter']; ?>(val,field);
                    }else{
                        saveMan<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        saveMan<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }else{
                        saveMan<?php echo $_SESSION['counter']; ?>(val,field);
                    }
                }
            }else{
                if( (typeof $(this).attr('type') != 'undefined')&&(val.length == 0) ){
                    saveMan<?php echo $_SESSION['counter']; ?>('null',field);
                }
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manDateOfBirth').kendoDatePicker({
            format: "dd-MM-yyyy",
            change:function(e){
                $('.selectedDiv').removeClass('selectedDiv');
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manDateOfBirth').focusout(function(e){
            var val = $(this).val();
            var field = $(this).attr('name');
            var reg = date_preg;
            if( (typeof $(this).attr('type') != 'undefined')&&(val.length != 0) ){
                if( (val.length == 6)||(val.length == 8) ){
                    var day = val.slice(0,2);
                    var month = val.slice(2,4);
                    var year = val.slice(4,8);
                    if(year.length == 2){
                        year = '19'+year;
                    }
                    val = day+'-'+month+'-'+year;
                    if(reg.test(val)){
                        $(this).val(val);
                        saveMan<?php echo $_SESSION['counter']; ?>(val,field);
                    }else{
                        saveMan<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }
                }else{
                    if(val.length != 10){
                        saveMan<?php echo $_SESSION['counter']; ?>('null',field);
                        $(this).val('');
                        alert('<?php echo $Lang->enter_number;?>');
                    }else{
                        saveMan<?php echo $_SESSION['counter']; ?>(val,field);
                    }
                }
            }
            if( (typeof $(this).attr('type') != 'undefined')&&(val.length == 0) ){
                saveMan<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('.oneInputSaveMan<?php echo $_SESSION['counter']; ?>').focusout(function(e){
            var value = $(this).val();
            var field = $(this).attr('name');
            if(value.length != 0){
                if($(this).attr('id') == 'manApproximateYear'){
                    var newVal = value.split('-');
                    if(typeof newVal[1] != 'undefined'){
                        saveMan<?php echo $_SESSION['counter']; ?>(newVal[0],'start_year');
                        saveMan<?php echo $_SESSION['counter']; ?>(newVal[1],'end_year');
                    }else{
                        saveMan<?php echo $_SESSION['counter']; ?>(value,field);
                    }
                }else{
                    saveMan<?php echo $_SESSION['counter']; ?>(value,field);
                }
            }else{
                saveMan<?php echo $_SESSION['counter']; ?>('null',field);
            }
        });

        $('#<?php echo $_SESSION['counter']; ?>manAdditionalInformationPerson').click(function(e){
            e.preventDefault();
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/text/man&old_counter=<?php echo $_SESSION['counter']; ?>" ,
                 beforeClose: function () {
                    var textVal = $('iframe');
                    var iframe_id = textVal.attr('name');
                    var iframe = document.getElementById(iframe_id);
                    var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                    var test = innerDoc.getElementById('text');
                    var val = test.value;
                    var confirmF = confirm('<?php echo $Lang->save;?> ?');
                    if(confirmF){
                        closeFancyTextMan<?php echo $_SESSION['counter']; ?>(val);
                    }
                }
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>manAnswer').click(function(e){
            e.preventDefault();
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/text/manAnswer&old_counter=<?php echo $_SESSION['counter']; ?>"
            });
        });

        $('#<?php echo $_SESSION['counter']; ?>closeMan').click(function(e){
            e.preventDefault();
            <?php if(isset($other_tb_name)) { ?>
                <?php if($other_tb_name == 'work_activity') { ?>
                    work_activity_man<?php if(isset($old_counter)){ echo $old_counter; }?>(man_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'event') { ?>
                    event_has_man<?php if(isset($old_counter)){ echo $old_counter; }?>(man_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'signal_passes') { ?>
                    signal_man_passed_by_signal<?php if(isset($old_counter)){ echo $old_counter; }?>(man_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'signal_check') { ?>
                    signal_signal_has_man<?php if(isset($old_counter)){ echo $old_counter; }?>(man_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'mia_summary') { ?>
                    mia_summary_has_man<?php if(isset($old_counter)){ echo $old_counter; }?>(man_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'action') { ?>
                    action_has_man<?php if(isset($old_counter)){ echo $old_counter; }?>(man_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'criminal_case') { ?>
                    criminal_case_has_man<?php if(isset($old_counter)){ echo $old_counter; }?>(man_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'man') { ?>
                    man_knowen_man<?php if(isset($old_counter)){ echo $old_counter; }?>(man_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'objects_relation_man') { ?>
                    objects_relation_man_to_man<?php if(isset($old_counter)){ echo $old_counter; }?>(man_id<?php echo $_SESSION['counter']; ?>);
                <?php }elseif($other_tb_name == 'bibliography') { ?>
                    var dataId = $('.activeTable:last').attr('dataId');
                    $('.activeTable').addClass('storedItem');
                    if(typeof  dataId == 'undefined'){
                        $('.activeTable').append(' : id = '+man_id<?php echo $_SESSION['counter']; ?>);
                        $('.activeTable').attr('dataId',man_id<?php echo $_SESSION['counter']; ?>);
                    }
                    $('.activeTable').removeClass('activeTable');
                    removeItem();
                <?php } ?>
            <?php }else{ ?>
                var dataId = $('.activeTable:last').attr('dataId');
                $('.activeTable').addClass('storedItem');
                if(typeof  dataId == 'undefined'){
                    $('.activeTable').append(' : id = '+man_id<?php echo $_SESSION['counter']; ?>);
                    $('.activeTable').attr('dataId',man_id<?php echo $_SESSION['counter']; ?>);
                }
                $('.activeTable').removeClass('activeTable');
                removeItem();
            <?php } ?>
        });




        <?php if(isset($man)) { ?>
            <?php if(!empty($man['birthday'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>manDateOfBirth').val('<?php echo $man['birthday']?>');
            <?php } ?>
            <?php if(!empty($man['start_wanted'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>manDeclaredWantedListWith').val('<?php echo $man['start_wanted']?>');
            <?php } ?>
            <?php if(!empty($man['entry_date'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>manHomeMonitoringStart').val('<?php echo $man['entry_date']?>');
            <?php } ?>
            <?php if(!empty($man['exit_date'])) { ?>
                $('#<?php echo $_SESSION['counter']; ?>manEndMonitoringStart').val('<?php echo $man['exit_date']?>');
            <?php } ?>
        <?php } ?>

        var uploader = new qq.FileUploader({
            element: document.getElementById('<?php echo $_SESSION['counter']; ?>file-uploader-man'),
            'action': '<?php echo ROOT; ?>add/file_upload/'+man_id<?php echo $_SESSION['counter']; ?>,
            'debug': false,
            multiple: false,
            //sizeLimit: 0, // max size
            // minSizeLimit: 0, // min size
            onSubmit: function(id, fileName){
                $('#preloader').show();
            },
            onProgress: function(id, fileName, loaded, total){
    //                    alert(loaded+' OF '+total);
            },
            onComplete: function(id, fileName, responseJSON){
                $('#preloader').hide();
    //                count = count + 1;
                if(responseJSON.success ==true){
                    $('#<?php echo $_SESSION['counter']; ?>uploadedFiles').append('<li><span class="downloadFile" data-id="'+responseJSON.file_id+'">Файл '+responseJSON.name+' добавлен</span> | <a class="deleteFileMan" data-id="'+responseJSON.file_id+'">X</a></li>');
                    $('.qq-upload-list li').remove();
                    if($('#2').length !== 0 && $('#3').length !== 0){
                        $('#file-uploader3').removeClass('hid');
                    }
                }else{
                    alert('<?php echo $Lang->error;?>');
                    $('#load').empty();
                }
            },
            onCancel: function(id, fileName){ $('.qq-upload-button').removeClass('.qq-upload-button-visited');$('#preloader').hide(); },
            messages: {
                // error messages, see qq.FileUploaderBasic for content

            },
            showMessage: function(message){ alert(message); $('#preloader').hide(); }
        });

    });

    function closeFancyManAnswer<?php echo $_SESSION['counter']; ?>(data , id ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_answer/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+id,
            type:'POST',
            data:{ 'data':data },
            dataType:'json',
            success:function(data){
                if(typeof  id != 'undefined'){
                    $('#<?php echo $_SESSION['counter']; ?>manAnswerItem'+id).remove();
                }
                $('#<?php echo $_SESSION['counter']; ?>manAnswerFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manAnswerItem'+data.id+'">'
                        +'<div class="item manAnswer" data_id="'+data.id+'" session_counter="<?php echo $_SESSION['counter']; ?>">'
                        +'<span>'+data.text+'</span>'
                        +'<a href="javascript:removeManAnswer<?php echo $_SESSION['counter']; ?><?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
            }
        });
        $.fancybox.close();
        $('#<?php echo $_SESSION['counter']; ?>manAnswer').focus();
    }

    function removeManAnswer<?php echo $_SESSION['counter']; ?><?php echo $_SESSION['counter']; ?>(id){
        var removeManHasWeapon<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->are_you_sure;?>');
        if(removeManHasWeapon<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url:'<?php echo ROOT; ?>add/delete_answer/'+id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manAnswerItem'+id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manAnswer').focus();
                }
            });
        }
    }

    function closeFancyTextMan<?php echo $_SESSION['counter']; ?>(data, id ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/more_data_man/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+id,
            type:'POST',
            data:{ 'data':data },
            dataType:'json',
            success:function(data){
                if(typeof id != 'undefined'){
                    $('#<?php echo $_SESSION['counter']; ?>manAdditionalItem'+id).remove();
                }
                $('#<?php echo $_SESSION['counter']; ?>manAdditionalInformationPersonFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manAdditionalItem'+data.id+'">'
                        +'<div class="item manAdditional">'
                        +'<span data_id="'+data.id+'" session_counter="<?php echo $_SESSION['counter']; ?>">'+data.text+'</span>'
                        +'<a href="javascript:removeManMoreData<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
            }
        });
//        $.fancybox.close();
        $('#<?php echo $_SESSION['counter']; ?>manAdditionalInformationPerson').focus();
    }
    function removeManMoreData<?php echo $_SESSION['counter']; ?>(id){
        var removeManHasWeapon<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->are_you_sure;?>');
        if(removeManHasWeapon<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url:'<?php echo ROOT; ?>add/delete_more_data_man/'+id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manAdditionalItem'+id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manAdditionalInformationPerson').focus();
                }
            });
        }
    }

    function closeFMan<?php echo $_SESSION['counter']; ?>(name,id){
//        alert('name = '+name+' id = '+id);
        $('#'+currentInputNameMan<?php echo $_SESSION['counter']; ?>).val(name);
        $('#'+currentInputIdMan<?php echo $_SESSION['counter']; ?>).val(id);
        var field = $('#'+currentInputIdMan<?php echo $_SESSION['counter']; ?>).attr('name');
        saveMan<?php echo $_SESSION['counter']; ?>(id,field);
        $.fancybox.close();
        $('#'+currentInputNameMan<?php echo $_SESSION['counter']; ?>).focus();
    }

    function saveMan<?php echo $_SESSION['counter']; ?>(value,field){
        var data = { 'value':value, 'field':field };
        $.ajax({
            url: '<?php echo ROOT?>add/save_man/'+man_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            success: function(data){
                checkMan<?php echo $_SESSION['counter']; ?> = false;
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function saveManBornAddress<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT?>add/man_born_address/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+man_address_id<?php echo $_SESSION['counter']; ?>,
            type: 'POST',
            data:data,
            dataType:'json',
            success: function(data){
                man_address_id<?php echo $_SESSION['counter']; ?> = data.id;
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function man_has_weapon<?php echo $_SESSION['counter']; ?>(weapon_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_has_weapon/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+weapon_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manPresenceWeaponsFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manHasWeaponItem'+weapon_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+weapon_id+'" data-tb="weapon" data-title="<?php echo $Lang->short_weapon; ?> : '+weapon_id+'"><?php echo $Lang->short_weapon; ?> : '+weapon_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeManHasWeapon<?php echo $_SESSION['counter']; ?>('+weapon_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manPresenceWeapons').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManHasWeapon<?php echo $_SESSION['counter']; ?>(weapon_id){
        var removeManHasWeapon<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasWeapon<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_has_weapon/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+weapon_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manHasWeaponItem'+weapon_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manPresenceWeapons').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_has_event<?php echo $_SESSION['counter']; ?>(event_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_has_event/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+event_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manToEventFilter').append('<li id="<?php echo $_SESSION['counter']; ?>masHasEventItem'+event_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+event_id+'" data-tb="event" data-title="<?php echo $Lang->short_event; ?> : '+event_id+'"><?php echo $Lang->short_event; ?> : '+event_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeManHasEvent<?php echo $_SESSION['counter']; ?>('+event_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manToEvent').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManHasEvent<?php echo $_SESSION['counter']; ?>(event_id){
        var removeManHasSignal<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasSignal<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_has_event/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+event_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>masHasEventItem'+event_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manToEvent').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_has_action<?php echo $_SESSION['counter']; ?>(action_id , check  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_has_action/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+action_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manMemberActionsFilter').append('<li id="<?php echo $_SESSION['counter']; ?>masHasActionItem'+action_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+action_id+'" data-tb="action" data-title="<?php echo $Lang->short_action; ?> : '+action_id+'"><?php echo $Lang->short_action; ?> : '+action_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeManHasAction<?php echo $_SESSION['counter']; ?>('+action_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manMemberActions').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManHasAction<?php echo $_SESSION['counter']; ?>(action_id){
        var removeManHasSignal<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasSignal<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_has_action/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+action_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>masHasActionItem'+action_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manMemberActions').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_has_mia_summary<?php echo $_SESSION['counter']; ?>(mia_summary_id , check ){

        $.ajax({
            url:'<?php echo ROOT; ?>add/man_has_mia_summary/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+mia_summary_id,
            type:'POST',
//            data: { 'field': 'man_id<?php echo $_SESSION['counter']; ?>' , 'value': man_id<?php echo $_SESSION['counter']; ?> },
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manPassesSummaryFilter').append('<li id="<?php echo $_SESSION['counter']; ?>masHasPassesSummaryItem'+mia_summary_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+mia_summary_id+'" data-tb="mia_summary" data-title="<?php echo $Lang->short_mia; ?> : '+mia_summary_id+'"><?php echo $Lang->short_mia; ?> : '+mia_summary_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeManHasMiaSummary<?php echo $_SESSION['counter']; ?>('+mia_summary_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manPassesSummary').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManHasMiaSummary<?php echo $_SESSION['counter']; ?>(mia_summary_id){
        var removeManHasSignal<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasSignal<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_has_mia_summary/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+mia_summary_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>masHasPassesSummaryItem'+mia_summary_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manPassesSummary').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_has_criminal_case<?php echo $_SESSION['counter']; ?>(criminal_case_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_has_criminal_case/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manCriminalCaseFilter').append('<li id="<?php echo $_SESSION['counter']; ?>masHasCriminalCaseItem'+criminal_case_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+criminal_case_id+'" data-tb="criminal_case" data-title="<?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'"><?php echo $Lang->short_criminal; ?> : '+criminal_case_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeManHasCriminalCase<?php echo $_SESSION['counter']; ?>('+criminal_case_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manCriminalCase').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManHasCriminalCase<?php echo $_SESSION['counter']; ?>(criminal_case_id){
        var removeManHasSignal<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasSignal<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_has_criminal_case/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+criminal_case_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>masHasCriminalCaseItem'+criminal_case_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manCriminalCase').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_has_signal<?php echo $_SESSION['counter']; ?>(signal_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_has_signal/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manTestSignalFilter').append('<li id="<?php echo $_SESSION['counter']; ?>masHasSignalItem'+signal_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+signal_id+'" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : '+signal_id+'"><?php echo $Lang->short_signal; ?> : '+signal_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeManHasSignal<?php echo $_SESSION['counter']; ?>('+signal_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manTestSignal').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManHasSignal<?php echo $_SESSION['counter']; ?>(signal_id){
        var removeManHasSignal<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasSignal<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_signal_has_man/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>masHasSignalItem'+signal_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manTestSignal').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_passed_by_signal<?php echo $_SESSION['counter']; ?>(signal_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_passed_by_signal/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manPassesSignalFilter').append('<li id="<?php echo $_SESSION['counter']; ?>masPassesSignalItem'+signal_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+signal_id+'" data-tb="signal" data-title="<?php echo $Lang->short_signal; ?> : '+signal_id+'"><?php echo $Lang->short_signal; ?> : '+signal_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeManPassedBySignal<?php echo $_SESSION['counter']; ?>('+signal_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manPassesSignal').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManPassedBySignal<?php echo $_SESSION['counter']; ?>(signal_id){
        var removeManHasSignal<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasSignal<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_passed_by_signal/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+signal_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>masPassesSignalItem'+signal_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manPassesSignal').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_has_address<?php echo $_SESSION['counter']; ?>(address_id , check  , data  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_has_address/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+address_id,
            type: 'POST',
            data: data,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manPlaceOfResidencePersonFilter').append('<li id="<?php echo $_SESSION['counter']; ?>masHasAddressItem'+address_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" other_id="'+man_id<?php echo $_SESSION['counter']; ?>+'" other_tb="man_edit" data-id="'+address_id+'" data-tb="address" data-title="<?php echo $Lang->short_address; ?> : '+address_id+'"><?php echo $Lang->short_address; ?> : '+address_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeManHasAddress<?php echo $_SESSION['counter']; ?>('+address_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manPlaceOfResidencePerson').focus();
                }else{
                    if( check != 'ok'){
                        removeItem();
                    }
//                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManHasAddress<?php echo $_SESSION['counter']; ?>(address_id){
        var removeManHasAddress<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_has_address/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+address_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>masHasAddressItem'+address_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manPlaceOfResidencePerson').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }
    function man_use_car<?php echo $_SESSION['counter']; ?>(car_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_use_car/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+car_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manUsesMachineFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manUseCarItem'+car_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+car_id+'" data-tb="car" data-title="<?php echo $Lang->short_car; ?> : '+car_id+'"><?php echo $Lang->short_car; ?> : '+car_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeManUseCar<?php echo $_SESSION['counter']; ?>('+car_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manUsesMachine').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManUseCar<?php echo $_SESSION['counter']; ?>(car_id){
        var removeManHasCar<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasCar<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_use_car/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+car_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manUseCarItem'+car_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manUsesMachine').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }
    function man_has_car<?php echo $_SESSION['counter']; ?>(car_id , check ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_has_car/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+car_id,
            dataType:'json',
            success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manPresenceMachineFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manHasCarItem'+car_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+car_id+'" data-tb="car" data-title="<?php echo $Lang->short_car; ?> : '+car_id+'"><?php echo $Lang->short_car; ?> : '+car_id+'</span>'
                            +'<span class="editAll"></span><a href="javascript:removeManHasCar<?php echo $_SESSION['counter']; ?>('+car_id+');">x</a>'
                            +'</div>'
                            +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manPresenceMachine').focus();
                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManHasCar<?php echo $_SESSION['counter']; ?>(car_id){
        var removeManHasCar<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasCar<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_has_car/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+car_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manHasCarItem'+car_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manPresenceMachine').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_knowen_man<?php echo $_SESSION['counter']; ?>(knowen_man_id, check  , data  ){
        $.ajax({
            url:'<?php echo ROOT; ?>add/man_knowen_man/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+knowen_man_id,
                dataType:'json',
                success:function(data){
                if(data.status){
                    if( check != 'ok'){
                        removeItem();
                    }
                    $('#<?php echo $_SESSION['counter']; ?>manAlsoKnownAsFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manAlsoKnownManItem'+knowen_man_id+'">'
                            +'<div class="item">'
                            +'<span class="openData" data-id="'+knowen_man_id+'" data-tb="man" data-title="<?php echo $Lang->short_man; ?> : '+knowen_man_id+'" ><?php echo $Lang->short_man; ?> : '+knowen_man_id+'</span>'
                    +'<span class="editAll"></span><a href="javascript:removeManAlsoKnownMan<?php echo $_SESSION['counter']; ?>('+knowen_man_id+');">x</a>'
                            +'</div>'
                    +'</li>');
                    $('#<?php echo $_SESSION['counter']; ?>manAlsoKnownAs').focus();

                }else{
                    alert('<?php echo $Lang->relationship_exists;?>');
                }
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }
    function removeManAlsoKnownMan<?php echo $_SESSION['counter']; ?>(knowen_man_id){
        var removeManHasAddress<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_knowen_man/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+knowen_man_id,
                    success:function(data){
                        $('#<?php echo $_SESSION['counter']; ?>manAlsoKnownManItem'+knowen_man_id).remove();
                        $('#<?php echo $_SESSION['counter']; ?>manAlsoKnownAs').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
            saveMan<?php echo $_SESSION['counter']; ?>(0,'knowen_man_id');

        }
    }

    function man_has_phone<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT; ?>add/man_has_phone/'+man_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            data:data,
            dataType: 'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>manTelephoneNumberFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manHasPhoneItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" other_id="'+man_id<?php echo $_SESSION['counter']; ?>+'" other_tb="man_edit" data-id="'+data.id+'" data-from="man" data-from_id="'+man_id<?php echo $_SESSION['counter']; ?>+'" data-tb="phone" data-title="<?php echo $Lang->short_phone; ?> : '+data.id+'" ><?php echo $Lang->short_phone; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeManHasPhone<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>manTelephoneNumber').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function removeManHasPhone<?php echo $_SESSION['counter']; ?>(phone_id){
        var removeManHasAddress<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_has_phone/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+phone_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manHasPhoneItem'+phone_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manTelephoneNumber').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_has_email<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT; ?>add/man_has_email/'+man_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            data:data,
            dataType: 'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>manEmailFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manHasMailItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'" data-tb="email" ><?php echo $Lang->short_email; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeManHasMail<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>manEmail').focus();
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?> ');
            }
        });
    }

    function removeManHasMail<?php echo $_SESSION['counter']; ?>(email_id){
        var removeManHasAddress<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_has_email/'+man_id<?php echo $_SESSION['counter']; ?>+'/'+email_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manHasMailItem'+email_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manEmail').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_has_work_activity<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT; ?>add/man_has_work_activity/'+man_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>manWorkExperiencePersonFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manHasWorkActivityItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'" data-tb="work_activity" data-title="<?php echo $Lang->short_work_activity; ?> : '+data.id+'" ><?php echo $Lang->short_work_activity; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeManHasWorkActivity<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>manWorkExperiencePerson').focus();
            },
            faild:function(data){
                alert('<?php echo $Lang->err;?>');
            }
        });
    }

    function removeManHasWorkActivity<?php echo $_SESSION['counter']; ?>(work_activity){
        var removeManHasAddress<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_has_work_activity/'+work_activity,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manHasWorkActivityItem'+work_activity).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manWorkExperiencePerson').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_bean_country<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT; ?>add/save_man_bean_country',
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>manStayAbroadFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manBeanCountryItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'" data-tb="man_beann_country" data-title="<?php echo $Lang->short_bean_country; ?> : '+data.id+'" ><?php echo $Lang->short_bean_country; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeManBeanCountry<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>manStayAbroad').focus();
            },
            faild:function(data){
                alert('<?php echo $Lang->err;?>');
            }
        });
    }

    function removeManBeanCountry<?php echo $_SESSION['counter']; ?>(mbc_id){
        var removeManHasAddress<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_bean_country/'+mbc_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manBeanCountryItem'+mbc_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manStayAbroad').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_objects_organization<?php echo $_SESSION['counter']; ?>(org_id , relation_id){
        var data = { 'org_id' : org_id , 'relation_id' : relation_id };
        $.ajax({
            url: '<?php echo ROOT; ?>add/man_objects_organization/'+man_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>manOperTiesOrganizationFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manObjectsOrganizationItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'" data-tb="object" ><?php echo $Lang->short_object; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeManObjectsOrganization<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>manOperTiesOrganization').focus();
            },
            faild:function(data){
                alert('<?php echo $Lang->err;?>');
            }
        });
    }

    function removeManObjectsOrganization<?php echo $_SESSION['counter']; ?>(object_relation_id){
        var removeManHasAddress<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_objects_relation/'+object_relation_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manObjectsOrganizationItem'+object_relation_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manOperTiesOrganization').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_objects_man<?php echo $_SESSION['counter']; ?>(oman_id, relation_id){
        var data = { 'man_id' : oman_id, 'relation_id' : relation_id };
        $.ajax({
            url: '<?php echo ROOT; ?>add/man_objects_man/'+man_id<?php echo $_SESSION['counter']; ?>,
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>manOperTiesManFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manObjectsManItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'" data-tb="object" ><?php echo $Lang->short_object; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeManObjectsMan<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>manOperTiesMan').focus();
            },
            faild:function(data){
                alert('<?php echo $Lang->err;?>');
            }
        });
    }

    function removeManObjectsMan<?php echo $_SESSION['counter']; ?>(object_relation_id){
        var removeManHasAddress<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_objects_relation/'+object_relation_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manObjectsManItem'+object_relation_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manOperTiesMan').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_external_sign_has_sign<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT; ?>add/man_external_sign_has_sign',
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data){
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>manExternalSignsSignFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manExternalSignsSignItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'/a" data-tb="external_signs" data-title="<?php echo $Lang->short_external_sign; ?> : '+data.id+'"><?php echo $Lang->short_external_sign; ?> : '+data.id+'</span>'
                        +'<span class="editAll"></span><a href="javascript:removeManExternalSignsSign<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>manExternalSignsSign').focus();
            },
            faild:function(data){
                alert('<?php echo $Lang->err;?>');
            }
        });
    }

    function removeManExternalSignsSign<?php echo $_SESSION['counter']; ?>(external_sign_id){
        var removeManHasAddress<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_external_sign_has_sign/'+external_sign_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manExternalSignsSignItem'+external_sign_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manExternalSignsSign').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function man_external_sign_has_photo<?php echo $_SESSION['counter']; ?>(data){
        $.ajax({
            url: '<?php echo ROOT; ?>add/man_external_sign_has_photo',
            type:'POST',
            data:data,
            dataType:'json',
            beforeSend:function(){ $('#<?php echo $_SESSION['counter']; ?>preloader').show(); },
            success:function(data){
                $('#<?php echo $_SESSION['counter']; ?>preloader').hide();
                removeItem();
                $('#<?php echo $_SESSION['counter']; ?>manExternalSignsPhotoFilter').append('<li id="<?php echo $_SESSION['counter']; ?>manExternalSignsPhotoItem'+data.id+'">'
                        +'<div class="item">'
                        +'<span class="openData" data-id="'+data.id+'" data-tb="external_photo" data-title="<?php echo $Lang->short_external_sign; ?> : '+data.id+'"><?php echo $Lang->short_external_sign; ?> : '+data.id+'</span>'
                        +'<a href="javascript:removeManExternalSignsPhoto<?php echo $_SESSION['counter']; ?>('+data.id+');">x</a>'
                        +'</div>'
                        +'</li>');
                $('#<?php echo $_SESSION['counter']; ?>manExternalSignsPhoto').focus();
            },
            faild:function(data){
                alert('<?php echo $Lang->err;?>');
            }
        });
    }

    function removeManExternalSignsPhoto<?php echo $_SESSION['counter']; ?>(external_sign_id){
        var removeManHasAddress<?php echo $_SESSION['counter']; ?> = confirm('<?php echo $Lang->break_link;?>');
        if(removeManHasAddress<?php echo $_SESSION['counter']; ?>){
            $.ajax({
                url: '<?php echo ROOT; ?>add/delete_man_external_sign_has_photo/'+external_sign_id,
                success:function(data){
                    $('#<?php echo $_SESSION['counter']; ?>manExternalSignsPhotoItem'+external_sign_id).remove();
                    $('#<?php echo $_SESSION['counter']; ?>manExternalSignsPhoto').focus();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }


</script>