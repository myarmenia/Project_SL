<?php

class AddModel extends Model{

    public function updateManAnswer($data,$id){
        $query = "UPDATE answer SET text = '$data' WHERE id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function updateMoreDataMan($data,$id){
        $query = "UPDATE more_data_man SET text = '$data' WHERE id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function updateMaterialContentAction($data,$id){
        $query = "UPDATE material_content SET content = '$data' WHERE id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createControl($b_id){
        $query = "INSERT INTO control SET bibliography_id = '$b_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function getControl($control_id){
        $query = "SELECT control.* , doc_category.name AS doc_name , result.name AS result_name , unit.name AS unit_name , act_unit.name AS act_unit_name , sub_act_unit.name AS sub_act_unit_name
                  FROM control
                  LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
                  LEFT JOIN control_result AS result ON result.id = control.result_id
                  LEFT JOIN agency AS unit ON unit.id = control.unit_id
                  LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
                  LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
                  WHERE control.id = '$control_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getControlHasFile($control_id){
        $query = "SELECT file.id , file.name FROM control
                  LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = control.bibliography_id
                  LEFT JOIN file ON file.id = bibliography_has_file.file_id
                  WHERE control.id = '$control_id' AND file.id IS NOT NULL ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function saveControl($control_id, $field, $value){
        if($value == 'null'){
            $query = "UPDATE control SET $field = null WHERE id = '$control_id' ";
        }else{
            $query = "UPDATE control SET $field = '$value' WHERE id = '$control_id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function createWeapon(){
        $query = "INSERT INTO weapon SET view = null ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function weaponSave($id, $value, $field){
        if($value == 'null'){
            $query = "UPDATE weapon SET $field = null WHERE id = '$id' ";
        }else{
            $query = "UPDATE weapon SET $field = '$value' WHERE id = '$id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function createCar(){
        $query = "INSERT INTO car SET `note` = null ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function carSave($id, $value, $field){
        if($value == 'null'){
            $query = "UPDATE car SET $field = null WHERE id = '$id' ";
        }else{
            $query = "UPDATE car SET $field = '$value' WHERE id = '$id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function checkColor($color){
        $query = "SELECT color.id FROM color WHERE color.name = '$color' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

    public function createColor($color){
        $query = "INSERT INTO color SET color.name = '$color' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function createSignal($b_id){
        $query = "INSERT INTO `signal` SET bibliography_id = '$b_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function signalSave($id, $value, $field){
        if($value == 'null'){
            $query = "UPDATE `signal` SET `$field` = null WHERE id = '$id' ";
        }else{
            $query = "UPDATE `signal` SET `$field` = '$value' WHERE id = '$id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function signalHasResource($signal_id,$resource_id){
        $query = "INSERT INTO signal_used_resource SET signal_id = '$signal_id' , resource_id = '$resource_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_signal_has_resource($signal_id,$resource_id){
        $query = "DELETE FROM signal_used_resource WHERE signal_id = '$signal_id' AND resource_id = '$resource_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function signalHasTakenMeasure($signal_id,$taken_measure_id){
        $query = "INSERT INTO signal_has_taken_measure SET signal_id = '$signal_id' , taken_measure_id = '$taken_measure_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_signal_has_taken_measure($signal_id,$taken_measure_id){
        $query = "DELETE FROM signal_has_taken_measure WHERE signal_id = '$signal_id' AND taken_measure_id = '$taken_measure_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function signalCheckWorker($signal_id,$worker_id){
        $query = "INSERT INTO signal_check_worker SET signal_id = '$signal_id' , worker_id = '$worker_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_signal_check_worker($signal_id,$worker_id){
        $query = "DELETE FROM signal_check_worker WHERE signal_id = '$signal_id' AND worker_id = '$worker_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function signal_has_worker($signal_id,$worker_id){
        $query = "INSERT INTO signal_has_worker SET signal_id = '$signal_id' , worker_id = '$worker_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function signal_has_check_date($signal_id,$check_date){
        $data = explode('-',$check_date);
        $year = $data[2];
        $month = $data[1];
        $day = $data[0];
        $check_date = $year.'-'.$month.'-'.$day;
        $query = "SELECT id FROM check_date WHERE `date` = '$check_date' ";
        $this->_setSql($query);
        $dataCheck = $this->getRow();
        if($dataCheck['id']){
            $check_date_id = $dataCheck['id'];
        }else{
            $query = "INSERT INTO check_date SET `date` =  '$check_date' ";
            $this->_setSql($query);
            $this->run();
            $check_date_id = $this->getId();
        }
        $query = "INSERT INTO signal_has_check_date SET signal_id = '$signal_id' , check_date_id = '$check_date_id' ";
        $this->_setSql($query);
        $this->run();
        return $check_date_id;
    }

    public function delete_signal_has_check_date($signal_id,$check_date_id){
        $query = "DELETE FROM signal_has_check_date WHERE signal_id = '$signal_id' AND check_date_id = '$check_date_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkActionPassesSignal($signal_id,$action_id){
        $query = "SELECT action_passes_signal.* FROM action_passes_signal WHERE action_id = '$action_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function actionPassesSignal($signal_id,$action_id){
        $query = "INSERT INTO action_passes_signal SET signal_id = '$signal_id' , action_id = '$action_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_action_passes_signal($signal_id,$action_id){
        $query = "DELETE FROM action_passes_signal WHERE signal_id = '$signal_id' AND '$action_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createSignalCheckingWorker($value,$signal_id ){
        $query = "INSERT INTO signal_checking_worker SET worker = '$value' , signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function signalCheckingWorkerPost($signal_id,$worker_post_id){
        $query = "INSERT INTO signal_checking_worker_post SET signal_id = '$signal_id' , worker_post_id = '$worker_post_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_signal_checking_worker_post($signal_id,$worker_post_id){
        $query = "DELETE FROM signal_checking_worker_post WHERE signal_id = '$signal_id' AND worker_post_id = '$worker_post_id'";
        $this->_setSql($query);
        $this->run();
    }

    public function createSignalWorker( $value,$signal_id ){
        $query = "INSERT INTO signal_worker SET worker = '$value' , signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function signalWorkerPost($signal_id,$worker_post_id){
        $query = "INSERT INTO signal_worker_post SET signal_id = '$signal_id' , worker_post_id = '$worker_post_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_signal_worker_post($signal_id,$worker_post_id){
        $query = "DELETE FROM signal_worker_post WHERE signal_id = '$signal_id' AND worker_post_id = '$worker_post_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getSignal($signal_id){
        $query = "SELECT `signal`.*,LEFT(signal.content,10) AS content  ,LEFT(signal.check_status,10) AS check_status  , signal_qualification.name AS signal_qualification , resource.name AS resource , check_agency.name AS check_agency,
                          check_unit.name AS check_unit, check_subunit.name AS check_subunit, signal_result.name AS signal_result , opened_agency.name AS opened_agency,
                          opened_unit.name AS opened_unit, opened_subunit.name AS opened_subunit,
                          CONCAT(worker.first_name,',',worker.last_name,',',worker_post.name) AS worker
                  FROM `signal`
                  LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                  LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                  LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                  LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                  LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                  LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                  LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                  LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                  LEFT JOIN worker ON worker.id = `signal`.opened_worker_id
                  LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE `signal`.id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getSignalHasFile($signal_id){
        $query = "SELECT file.* FROM `signal`
                  LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = `signal`.bibliography_id
                  RIGHT JOIN file ON file.id = bibliography_has_file.file_id
                  WHERE `signal`.id = '$signal_id'
                  GROUP BY `file`.id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalWorker($signal_id){
        $query = "SELECT signal_worker.* FROM signal_worker WHERE signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalWorkerPost($signal_id){
        $query = "SELECT worker_post.* FROM signal_worker_post
                  LEFT JOIN worker_post ON signal_worker_post.worker_post_id = worker_post.id
                  WHERE signal_worker_post.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalCheckingWorker($signal_id){
        $query = "SELECT signal_checking_worker.* FROM  signal_checking_worker WHERE signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalCheckingWorkerPost($signal_id){
        $query = "SELECT worker_post.* FROM signal_checking_worker_post
                  LEFT JOIN worker_post ON signal_checking_worker_post.worker_post_id = worker_post.id
                  WHERE signal_checking_worker_post.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalCheckWorker($signal_id){
        $query = "SELECT CONCAT(worker.first_name,',',worker.last_name,',',worker_post.name) AS worker , worker.id AS id FROM signal_check_worker
                  LEFT JOIN worker ON signal_check_worker.worker_id = worker.id
                  LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE signal_check_worker.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function signal_content($data,$id){
        $query = "UPDATE `signal` SET content = '$data' WHERE id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_signal_content($signal_id){
        $query = "UPDATE `signal` SET content = null WHERE id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function signal_status($data,$id){
        $query = "UPDATE `signal` SET check_status = '$data' WHERE id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_signal_status($signal_id){
        $query = "UPDATE `signal` SET check_status = null WHERE id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }


    public function getSignalHasCheckDate($signal_id){
        $query = "SELECT check_date.* FROM signal_has_check_date
                  LEFT JOIN check_date ON check_date.id = signal_has_check_date.check_date_id
                  WHERE signal_has_check_date.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasTakenMeasure($signal_id){
        $query = "SELECT taken_measure.* FROM signal_has_taken_measure
                  LEFT JOIN taken_measure ON taken_measure.id = signal_has_taken_measure.taken_measure_id
                  WHERE signal_has_taken_measure.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalUsedResource($signal_id){
        $query = "SELECT resource.* FROM signal_used_resource
                  LEFT JOIN resource ON signal_used_resource.resource_id = resource.id
                  WHERE signal_used_resource.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasCriminalCase($signal_id){
        $query = "SELECT criminal_case_id FROM criminal_case_has_signal WHERE signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalCheckMan($signal_id){
        $query = "SELECT man_id FROM signal_has_man WHERE signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalCheckOrganization($signal_id){
        $query = "SELECT organization_id FROM organization_checked_by_signal WHERE signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasAction($signal_id){
        $query = "SELECT action_id FROM action_passes_signal WHERE signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasEvent($signal_id){
        $query = "SELECT event_id FROM event_passes_signal WHERE signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalPassedMan($signal_id){
        $query = "SELECT man_id FROM man_passed_by_signal WHERE signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalPassedOrganization($signal_id){
        $query = "SELECT organization_id FROM organization_passes_by_signal WHERE signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasKeepSignal($signal_id){
        $query = "SELECT id AS keep_signal_id FROM keep_signal WHERE signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function checkDic($tableName,$id){
        $query = "SELECT * FROM `$tableName` WHERE id = '$id' ";
        $this->_setSql($query);
        $data = $this->getRow();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    public function createMan(){
        $query = "INSERT INTO man SET attention = null ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function createManHasBibl($b_id,$man_id){
        $query = "INSERT INTO man_has_bibliography SET man_id = '$man_id' , bibliography_id = '$b_id' ";
        $this->_setSql($query);
        $this->run();
    }

////////////////////////////////////////////////  man last name ///////////////////////////////////////
    public function lastNameSave($man_id, $last_name_id){
        $query = "INSERT INTO man_has_last_name SET man_id = '$man_id', last_name_id = '$last_name_id'  ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkManLastName($last_name){
        $query = "SELECT last_name.id FROM last_name WHERE last_name.last_name = '$last_name' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

    public function createManLastName($last_name){
        $query = "INSERT INTO last_name SET last_name.last_name = '$last_name' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function deleteManHasLastName($man_id,$last_name_id){
        $query = "DELETE FROM man_has_last_name WHERE man_id = '$man_id' AND last_name_id = '$last_name_id' ";
        $this->_setSql($query);
        $this->run();
    }
/////////////////////////////////////////////////// man first name /////////////////////////////////////////
    public function deleteManHasFirstName($man_id,$first_name_id){
        $query = "DELETE FROM man_has_first_name WHERE man_id = '$man_id' AND first_name_id = '$first_name_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function firstNameSave($man_id, $first_name_id){
        $query = "INSERT INTO man_has_first_name SET man_id = '$man_id', first_name_id = '$first_name_id'  ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkManFirstName($first_name){
        $query = "SELECT first_name.id FROM first_name WHERE first_name.first_name = '$first_name' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

    public function createManFirstName($first_name){
        $query = "INSERT INTO first_name SET first_name.first_name = '$first_name' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }
///////////////////////////////////////////////////////////// man middle name /////////////////////////////////////////
    public function deleteManHasMiddleName($man_id,$middle_name_id){
        $query = "DELETE FROM man_has_middle_name WHERE man_id = '$man_id' AND middle_name_id = '$middle_name_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function middleNameSave($man_id, $middle_name_id){
        $query = "INSERT INTO man_has_middle_name SET man_id = '$man_id', middle_name_id = '$middle_name_id'  ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkManMiddleName($middle_name){
        $query = "SELECT middle_name.id FROM middle_name WHERE middle_name.middle_name = '$middle_name' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

    public function createManMiddleName($middle_name){
        $query = "INSERT INTO middle_name SET middle_name.middle_name = '$middle_name' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }
/////////////////////////////////////////////////////////// man passport //////////////////////////////////////////
    public function deleteManHasPassport($man_id,$passport_id){
        $query = "DELETE FROM man_has_passport WHERE man_id = '$man_id' AND passport_id = '$passport_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function passportSave($man_id, $passport_id){
        $query = "INSERT INTO man_has_passport SET man_id = '$man_id', passport_id = '$passport_id'  ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkManPassport($passport){
        $query = "SELECT passport.id FROM passport WHERE passport.number = '$passport' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

    public function createPassport($passport){
        $query = "INSERT INTO passport SET passport.number = '$passport' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }
/////////////////////////////////////////////////////////// man nickname //////////////////////////////////////////
    public function deleteManHasNickname($man_id,$nickname){
        $query = "DELETE FROM man_has_nickname WHERE man_id = '$man_id' AND nickname_id = '$nickname' ";
        $this->_setSql($query);
        $this->run();
    }

    public function nicknameSave($man_id, $nickname){
        $query = "INSERT INTO man_has_nickname SET man_id = '$man_id', nickname_id = '$nickname'  ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkManNickname($nickname){
        $query = "SELECT nickname.id FROM nickname WHERE nickname.name = '$nickname' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

    public function createNickname($nickname){
        $query = "INSERT INTO nickname SET nickname.name = '$nickname' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }
//////////////////////////////////// update man ////////////////////////////////////////////////
    public function updateMan($man_id, $value, $fieldName){
        if($fieldName == 'birth_year'){
//            $dd = explode('-',$value);
//            if(isset($dd[1])){
//                $query = "UPDATE man SET start_year = ".$dd[0]." , end_year = ".$dd[1]." WHERE id = '$man_id' ";
//            }else{
//                $query = "UPDATE man SET start_year = ".$value."  WHERE id = '$man_id' ";
//            }
            $fieldName = 'start_year';
        }//else
        if( ($fieldName == 'knowen_man_id')&&( $value == 0 ) ){
            $query = "UPDATE man SET knowen_man_id = null WHERE id = '$man_id' ";
        }elseif($value == 'null'){
            if($fieldName == 'start_year' ){
                $query = "UPDATE man SET `$fieldName` = null , `end_year` = null WHERE id = '$man_id' ";
            }else{
                $query = "UPDATE man SET `$fieldName` = null WHERE id = '$man_id' ";
            }
        }else{
            $query = "UPDATE man SET `$fieldName` = '$value' WHERE id = '$man_id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function manBelongsCountry($man_id,$country_id){
        $query = "INSERT INTO man_belongs_country SET man_id =  '$man_id' , country_id = '$country_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_man_belongs_country($man_id,$country_id){
        $query ="DELETE FROM man_belongs_country WHERE man_id  =  '$man_id' AND country_id = '$country_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function manHasLanguage($man_id,$lang_id){
        $query = "INSERT INTO man_knows_language SET man_id =  '$man_id' , language_id = '$lang_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_man_has_language($man_id,$lang_id){
        $query ="DELETE FROM man_knows_language WHERE man_id  =  '$man_id' AND language_id = '$lang_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function manHasEducation($man_id,$education_id){
        $query = "INSERT INTO man_has_education SET man_id =  '$man_id' , education_id = '$education_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_man_has_education($man_id,$education_id){
        $query ="DELETE FROM man_has_education WHERE man_id  =  '$man_id' AND education_id = '$education_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function manHasParty($man_id,$party_id){
        $query = "INSERT INTO man_has_party SET man_id =  '$man_id' , party_id = '$party_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_man_has_party($man_id,$party_id){
        $query ="DELETE FROM man_has_party WHERE man_id  =  '$man_id' AND party_id = '$party_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function countrySearchMan($man_id,$country_id){
        $query = "INSERT INTO country_search_man SET country_id = '$country_id' , man_id = '$man_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_country_search_man($man_id , $country_id){
        $query = "DELETE FROM country_search_man WHERE man_id = '$man_id' AND country_id = '$country_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function manHasOperationCategory($man_id,$id){
        $query = "INSERT INTO man_has_operation_category SET man_id =  '$man_id' , operation_category_id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_man_has_operation_category($man_id,$id){
        $query ="DELETE FROM man_has_operation_category WHERE man_id  =  '$man_id' AND operation_category_id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createManBornAddress($man_id,$field,$value){
        $query = "INSERT INTO address SET $field = '$value' ";
        $this->_setSql($query);
        $this->run();
        $address_id = $this->getId();
        $query = "UPDATE man SET born_address_id = '$address_id' WHERE man.id = '$man_id' ";
        $this->_setSql($query);
        $this->run();
        return $address_id;
    }

    public function updateAddress($address_id,$field,$value){
        if($value == 'null'){
            $query = "UPDATE address SET $field = null WHERE address.id = '$address_id' ";
        }else{
            $query = "UPDATE address SET $field = '$value' WHERE address.id = '$address_id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function checkManBornAddressUpdate($field,$id,$type){
        $rt = false;
        $query = "SELECT * FROM address WHERE id = ".$id;
        $this->_setSql($query);
        $address = $this->getRow();
        if($field == 'region_id'){
            if($address['region_id']){
                $query = "SELECT * FROM region WHERE id = ".$address['region_id'];
                $this->_setSql($query);
                $reg = $this->getRow();
                if($type == '1' && !$reg['country_id']){
                    $rt = true;
                }
                if($type == '0' && $reg['country_id']){
                    $rt = true;
                }
            }
        }
        if($field == 'locality_id'){
            if($address['locality_id']){
                $query = "SELECT * FROM locality WHERE id = ".$address['locality_id'];
                $this->_setSql($query);
                $reg = $this->getRow();
                if($type == '1' && !$reg['country_id']){
                    $rt = true;
                }
                if($type == '0' && $reg['country_id']){
                    $rt = true;
                }
            }
        }
        return $rt;
    }

    public function checkRegion($value){
        $query = "SELECT region.id FROM region WHERE region.name = '$value' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

    public function createRegion($value){
        $query = "INSERT INTO region SET region.name = '$value' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function checkLocality($value){
        $query = "SELECT locality.id FROM locality WHERE locality.name = '$value' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

    public function createLocality($value){
        $query = "INSERT INTO locality SET locality.name = '$value' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function manHasWeapon($man_id,$weapon_id){
        $query = "INSERT INTO man_has_weapon SET man_id = '$man_id' , weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkManHasWeapon($man_id,$weapon_id){
        $query = "SELECT man_id FROM man_has_weapon WHERE man_id = '$man_id' AND weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        $res = $this->getRow();
        return $res['man_id'];
    }
    public function delete_man_has_weapon($man_id,$weapon_id){
        $query = "DELETE FROM man_has_weapon WHERE man_id = '$man_id'AND weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        $this->run();
    }
    public function checkManHasAddress($man_id , $address_id){
        $query = "SELECT man_id FROM man_has_address WHERE man_id = '$man_id' AND address_id = '$address_id' ";
        $this->_setSql($query);
        $res = $this->getRow();
        return $res['man_id'];
    }
    public function manHasAddress($man_id , $address_id,$data){
        $query = "INSERT INTO man_has_address SET man_id = '$man_id' , address_id = '$address_id' , start_date='{$data['start_date']}' , end_date = '{$data['end_date']}' ";
        $this->_setSql($query);
        $this->run();
    }
    public function delete_man_has_address($man_id , $address_id){
        $query = "DELETE FROM man_has_address WHERE man_id = '$man_id' AND address_id = '$address_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createAddress(){
        $query = "INSERT INTO address SET apt_num = null ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function checkManUseCar($man_id,$car_id){
        $query = "SELECT man_id FROM man_use_car WHERE man_id = '$man_id' AND car_id = '$car_id' ";
        $this->_setSql($query);
        $res = $this->getRow();
        return $res['man_id'];
    }
    public function manUseCar($man_id,$car_id){
        $query = "INSERT INTO man_use_car SET man_id = '$man_id' , car_id = '$car_id' ";
        $this->_setSql($query);
        $this->run();
    }
    public function delete_man_use_car($man_id,$car_id){
        $query = "DELETE FROM man_use_car WHERE man_id = '$man_id' AND car_id = '$car_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkManHasCar($man_id,$car_id){
        $query = "SELECT man_id FROM man_has_car WHERE man_id = '$man_id'AND car_id = '$car_id' ";
        $this->_setSql($query);
        $res = $this->getRow();
        return $res['man_id'];
    }
    public function manHasCar($man_id,$car_id){
        $query = "INSERT INTO man_has_car SET man_id = '$man_id', car_id = '$car_id' ";
        $this->_setSql($query);
        $this->run();
    }
    public function delete_man_has_car($man_id , $car_id){
        $query = "DELETE FROM man_has_car WHERE man_id = '$man_id' AND car_id = '$car_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function moreDataMan($text,$man_id){
        $query = "INSERT INTO more_data_man SET text = '$text' , man_id = '$man_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function man_answer($text , $man_id){
        $query = "INSERT INTO answer SET text = '$text' , man_id = '$man_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function checkSignalHasMan($man_id,$signal_id){
        $query = "SELECT signal_has_man.* FROM signal_has_man WHERE man_id = '$man_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function signalHasMan($man_id,$signal_id){
        $query = "INSERT INTO signal_has_man SET man_id = '$man_id' , signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
        $query = "SELECT bibliography_id FROM `signal` WHERE id = '$signal_id' ";
        $this->_setSql($query);
        $b = $this->getRow();
        if($b['bibliography_id']){
            $query = "INSERT IGNORE INTO man_has_bibliography SET man_id = '$man_id' , bibliography_id = '{$b['bibliography_id']}' ";
            $this->_setSql($query);
            $this->run();
        }
    }

    public function delete_signal_has_man($man_id,$signal_id){
        $query = "DELETE FROM signal_has_man WHERE man_id = '$man_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkManPassedBySignal($man_id,$signal_id){
        $query = "SELECT man_passed_by_signal.* FROM man_passed_by_signal WHERE man_id = '$man_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function manPassedBySignal($man_id,$signal_id){
        $query = "INSERT INTO man_passed_by_signal SET man_id = '$man_id' , signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
        $query = "SELECT bibliography_id FROM `signal` WHERE id = '$signal_id' ";
        $this->_setSql($query);
        $b = $this->getRow();
        if($b['bibliography_id']){
            $query = "INSERT IGNORE INTO man_has_bibliography SET man_id = '$man_id' , bibliography_id = '{$b['bibliography_id']}' ";
            $this->_setSql($query);
            $this->run();
        }
    }

    public function delete_man_passed_by_signal($man_id,$signal_id){
        $query = "DELETE FROM man_passed_by_signal WHERE man_id = '$man_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkActionHasMan($man_id,$action_id){
        $query = "SELECT action_has_man.* FROM action_has_man WHERE man_id = '$man_id' AND action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function actionHasMan($man_id , $action_id){
        $query = "INSERT INTO action_has_man SET man_id = '$man_id' , action_id = '$action_id' ";
        $this->_setSql($query);
        $this->run();
        $query = "SELECT bibliography_id FROM `action` WHERE id= '$action_id' ";
        $this->_setSql($query);
        $b= $this->getRow();
        if($b['bibliography_id']){
            $query = "INSERT IGNORE INTO man_has_bibliography SET man_id = '$man_id' , bibliography_id = '{$b['bibliography_id']}' ";
            $this->_setSql($query);
            $this->run();
        }
    }

    public function delete_action_has_man($man_id,$action_id){
        $query = "DELETE FROM action_has_man WHERE man_id = '$man_id' AND action_id = '$action_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkEventHasMan($man_id,$event_id){
        $query = "SELECT event_has_man.* FROM event_has_man WHERE man_id = '$man_id' AND event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function eventHasMan($man_id,$event_id){
        $query = "INSERT INTO event_has_man SET man_id = '$man_id' , event_id = '$event_id' ";
        $this->_setSql($query);
        $this->run();
        $query = "SELECT bibliography_id FROM `event` WHERE id = '$event_id' ";
        $this->_setSql($query);
        $b = $this->getRow();
        if($b['bibliography_id']){
            $query = "INSERT IGNORE INTO man_has_bibliography SET man_id = '$man_id' , bibliography_id = '{$b['bibliography_id']}' ";
            $this->_setSql($query);
            $this->run();
        }
    }

    public function delete_event_has_man($man_id,$event_id){
        $query = "DELETE FROM event_has_man WHERE man_id = '$man_id' AND event_id = '$event_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkCriminalCaseHasMan($man_id,$criminal_case_id){
        $query = "SELECT criminal_case_has_man.* FROM criminal_case_has_man WHERE man_id = '$man_id' AND criminal_case_id = '$criminal_case_id'";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function criminalCaseHasMan($man_id,$criminal_case_id){
        $query = "INSERT INTO criminal_case_has_man SET man_id = '$man_id' , criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        $this->run();
        $query = "SELECT bibliography_id FROM criminal_case WHERE id = '$criminal_case_id' ";
        $this->_setSql($query);
        $b= $this->getRow();
        if($b['bibliography_id']){
            $query = "INSERT IGNORE INTO man_has_bibliography SET man_id = '$man_id' , bibliography_id = '{$b['bibliography_id']}' ";
            $this->_setSql($query);
            $this->run();
        }
    }

    public function delete_man_has_criminal_case($man_id,$criminal_case_id){
        $query = "DELETE FROM criminal_case_has_man WHERE man_id = '$man_id' AND criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkManHasMiaSummary($man_id,$mia_summary_id){
        $query = "SELECT man_passes_mia_summary.* FROM man_passes_mia_summary WHERE man_id = '$man_id' AND mia_summary_id = '$mia_summary_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function manHasMiaSummary($man_id,$mia_summary_id){
        $query = "INSERT INTO man_passes_mia_summary SET man_id = '$man_id' , mia_summary_id = '$mia_summary_id' ";
        $this->_setSql($query);
        $this->run();
        $query = "SELECT bibliography_id FROM `mia_summary` WHERE id = '$mia_summary_id' ";
        $this->_setSql($query);
        $b = $this->getRow();
        if($b['bibliography_id']){
            $query = "INSERT IGNORE INTO man_has_bibliography SET man_id = '$man_id' , bibliography_id = '{$b['bibliography_id']}' ";
            $this->_setSql($query);
            $this->run();
        }
    }

    public function delete_man_has_mia_summary($man_id,$mia_summary_id){
        $query = "DELETE FROM man_passes_mia_summary WHERE man_id = '$man_id' AND mia_summary_id = '$mia_summary_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function manHasPhone($man_id,$phone_id,$character){
        if($character == 0){
            $query = "INSERT INTO man_has_phone SET man_id = '$man_id' , phone_id = '$phone_id' , character_id = NULL ";
        }else{
            $query = "INSERT INTO man_has_phone SET man_id = '$man_id' , phone_id = '$phone_id' , character_id = '$character' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function delete_man_has_phone($man_id,$phone_id){
        $query = "DELETE FROM man_has_phone WHERE man_id = '$man_id' AND phone_id = '$phone_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function manHasEmail($man_id,$email_id){
        $query = "INSERT INTO man_has_email SET man_id = '$man_id' , email_id = '$email_id' , character_id = null ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_man_has_email($man_id,$email_id){
        $query = "DELETE FROM man_has_email WHERE man_id = '$man_id' AND email_id = '$email_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createManExternalSignHasSign($data){
        if(!empty($data['fixed_date'])){
            $dataDate = explode('-',$data['fixed_date']);
            $year = $dataDate[2];
            $month = $dataDate[1];
            $day = $dataDate[0];
            $data['fixed_date'] = $year.'-'.$month.'-'.$day;
        }
        $query = "INSERT INTO man_external_sign_has_sign SET man_id = '{$data['man_id']}' , sign_id = '{$data['sign_id']}' , fixed_date = '{$data['fixed_date']}' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function updateManExternalSignHasSign($data,$ext_id){
        if(!empty($data['fixed_date'])){
            $dataDate = explode('-',$data['fixed_date']);
            $year = $dataDate[2];
            $month = $dataDate[1];
            $day = $dataDate[0];
            $data['fixed_date'] = $year.'-'.$month.'-'.$day;
        }
        $query = "UPDATE man_external_sign_has_sign SET sign_id = '{$data['sign_id']}' , fixed_date = '{$data['fixed_date']}' WHERE man_external_sign_has_sign.id = '$ext_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createManExternalSignHasPhoto($man_id,$data,$thumbNail,$fixed_date){
        if(!empty($fixed_date)){
            $dataDate = explode('-',$fixed_date);
            $year = $dataDate[2];
            $month = $dataDate[1];
            $day = $dataDate[0];
            $fixed_date = $year.'-'.$month.'-'.$day;
        }
        $query = "INSERT INTO photo SET image = '$data' , thumbnail = '$thumbNail' ";
        $this->_setSql($query);
        $this->run();
        $photoId = $this->getId();
        $query = "INSERT INTO man_external_sign_has_photo SET man_id = '$man_id' , photo_id = '$photoId' , fixed_date = '$fixed_date' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function createAction($b_id){
        $query = "INSERT INTO `action` SET bibliography_id = '$b_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function actionSave($action_id,$value,$field){
        if( ($field == 'address_id')&&($value == 0) ){
            $query = "UPDATE `action` SET address_id = null WHERE `action`.id = '$action_id' ";
        }elseif(($field == 'opened_criminal_case_id')&&($value == 0)){
            $query = "UPDATE `action` SET opened_criminal_case_id = null WHERE `action`.id = '$action_id' ";
        }elseif( ($field == 'related_action_id')&&($value == 0) ){
            $query = "UPDATE `action` SET related_action_id = null WHERE `action`.id = '$action_id' ";
        }elseif($value == 'null'){
            $query = "UPDATE `action` SET $field = null WHERE `action`.id = '$action_id' ";
        }else{
            $query = "UPDATE `action` SET $field = '$value' WHERE `action`.id = '$action_id' ";
        }
        $this->_setSql($query);
        $this->run();
    }
    public function actionHasMaterialContent($data,$action_id){
        $query = "INSERT INTO material_content SET content = '$data' ";
        $this->_setSql($query);
        $this->run();
        $content_id = $this->getId();
        $query = "INSERT INTO action_has_material_content SET action_id = '$action_id' , material_content_id = '$content_id' ";
        $this->_setSql($query);
        $this->run();
        return $content_id;
    }
    public function delete_action_has_material_content($content_id){
        $query = "DELETE FROM action_has_material_content WHERE material_content_id = '$content_id' ";
        $this->_setSql($query);
        $this->run();
        $query = "DELETE FROM material_content WHERE id = '$content_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkActionHasCar($action_id,$car_id){
        $query = "SELECT action_has_car.* FROM action_has_car WHERE action_id = '$action_id' AND car_id = '$car_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function actionHasCar($action_id,$car_id){
        $query = "INSERT INTO action_has_car SET action_id = '$action_id' , car_id = '$car_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_action_has_car($action_id,$car_id){
        $query = "DELETE FROM action_has_car WHERE action_id = '$action_id' AND car_id = '$car_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkActionHasWeapon($action_id,$weapon_id){
        $query = "SELECT action_has_weapon.* FROM action_has_weapon WHERE action_id = '$action_id' AND weapon_id = '$weapon_id'";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function actionHasWeapon($action_id,$weapon_id){
        $query = "INSERT INTO action_has_weapon SET action_id = '$action_id' , weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_action_has_weapon($action_id , $weapon_id){
        $query = "DELETE FROM action_has_weapon WHERE action_id = '$action_id' AND weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function actionHasPhone($action_id,$phone_id){
        $query = "INSERT INTO action_has_phone SET action_id = '$action_id' , phone_id = '$phone_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_action_has_phone($action_id,$phone_id){
        $query = "DELETE FROM action_has_phone WHERE action_id = '$action_id' AND phone_id = '$phone_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getAction($action_id){
        $query = "SELECT `action`.* , action_qualification.name AS action_qualification , duration.name AS duration , action_goal.name AS goal,
                            terms.name AS terms , aftermath.name AS aftermath
                  FROM `action`
                  LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  LEFT JOIN duration ON duration.id = `action`.duration_id
                  LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
                  LEFT JOIN terms ON terms.id = `action`.terms_id
                  LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
                  WHERE `action`.id = '$action_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getActionHasMaterialContent($action_id){
        $query = "SELECT material_content.* FROM action_has_material_content
                  LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
                  WHERE action_has_material_content.action_id = '$action_id' ";
        $this->_setSql($query);
        $res = $this->getAll();
        if($res){
            foreach($res as $key=>$val){
                $res[$key]['content'] = substr($val['content'],0,20).'...';
            }
            return $res;
        }else{
            return false;
        }
    }

    public function getActionHasSignal($action_id){
        $query = "SELECT signal_id FROM action_passes_signal WHERE action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasCar($action_id){
        $query = "SELECT car_id FROM action_has_car WHERE action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasWeapon($action_id){
        $query = "SELECT weapon_id FROM action_has_weapon WHERE action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasPhone($action_id){
        $query = "SELECT phone_id FROM action_has_phone WHERE action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasOrganization($action_id){
        $query = "SELECT organization_id FROM action_has_organization WHERE action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionEventHasAction($action_id){
        $query = "SELECT event_id FROM event_has_action WHERE action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasMan($action_id){
        $query = "SELECT man_id FROM action_has_man WHERE action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasEvent($action_id){
        $query = "SELECT event_id FROM action_has_event WHERE action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasFile($action_id){
        $query = "SELECT file.id , file.name FROM `action`
                  LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = `action`.bibliography_id
                  LEFT JOIN file ON bibliography_has_file.file_id = file.id
                  WHERE `action`.id = '$action_id' AND file.id IS NOT NULL ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function checkStreet($val){
        $query = "SELECT id FROM street WHERE `name` = '$val' ";
        $this->_setSql($query);
        $res = $this->getRow();
        return $res['id'];
    }

    public function createStreet($name){
        $query = "INSERT INTO street SET `name` = '$name' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function createCriminalCase($b_id){
        $query = "INSERT INTO criminal_case SET bibliography_id = '$b_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function updateCriminalCase($criminal_id,$field,$value){
        if( ($field == 'signal_id')&&($value == 0) ){
            $query = "UPDATE criminal_case SET signal_id = null WHERE id = '$criminal_id' ";
        }elseif($value == 'null'){
            $query = "UPDATE criminal_case SET `$field` = null WHERE id = '$criminal_id' ";
        }else{
            $query = "UPDATE criminal_case SET `$field` = '$value' WHERE id = '$criminal_id' ";
        }
//        echo $query;
        $this->_setSql($query);
        $this->run();
    }

    public function createCriminalCaseWorker( $value,$criminal_id ){
        $query = "INSERT INTO criminal_case_worker SET worker = '$value' , criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function criminalCaseHasWorkerPost($criminal_id,$worker_post_id){
        $query = "INSERT INTO criminal_case_worker_post SET criminal_case_id = '$criminal_id' , worker_post_id = '$worker_post_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_criminal_worker_post($criminal_id,$worker_post_id){
        $query = "DELETE FROM criminal_case_worker_post WHERE criminal_case_id = '$criminal_id' AND worker_post_id = '$worker_post_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkCriminalCaseExtractedCriminalCase($criminal_case_id,$criminal_id){
        $query = "SELECT criminal_case_extracted_criminal_case.* FROM criminal_case_extracted_criminal_case WHERE criminal_case_id = '$criminal_case_id' AND criminal_case_id1 = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function criminalCaseExtractedCriminalCase($criminal_case_id,$criminal_id){
        $query = "INSERT INTO criminal_case_extracted_criminal_case SET criminal_case_id = '$criminal_case_id' , criminal_case_id1 = '$criminal_id'";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_criminal_case_extracted_criminal_case($criminal_case_id,$criminal_id){
        $query = "DELETE FROM criminal_case_extracted_criminal_case WHERE criminal_case_id = '$criminal_case_id' AND criminal_case_id1 = '$criminal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkCriminalCaseSplitedCriminalCase($criminal_case_id,$criminal_id){
        $query = "SELECT criminal_case_splited_criminal_case.* FROM criminal_case_splited_criminal_case WHERE criminal_case_id = '$criminal_case_id' AND criminal_case_id1 = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function criminalCaseSplitedCriminalCase($criminal_case_id,$criminal_id){
        $query = "INSERT INTO criminal_case_splited_criminal_case SET criminal_case_id = '$criminal_case_id' , criminal_case_id1 = '$criminal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_criminal_case_splited_criminal_case($criminal_case_id,$criminal_id){
        $query = "DELETE FROM criminal_case_splited_criminal_case WHERE criminal_case_id = '$criminal_case_id' AND criminal_case_id1 = '$criminal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getCriminalCase($criminal_id){
        $query = "SELECT criminal_case.* , CONCAT(worker.first_name,' ',worker.last_name,' ',worker_post.name) AS worker , opened_agency.name AS opened_agency,
                    opened_unit.name AS opened_unit , subunit.name AS subunit
                  FROM criminal_case
                  LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
                  LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
                  LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
                  LEFT JOIN worker ON worker.id = criminal_case.worker_id
                  LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id
                  WHERE criminal_case.id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getCriminalCaseWorker($criminal_id){
        $query = "SELECT * FROM criminal_case_worker WHERE criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseWorkerPost($criminal_id){
        $query = "SELECT worker_post.* FROM criminal_case_worker_post
                  LEFT JOIN worker_post ON criminal_case_worker_post.worker_post_id = worker_post.id
                  WHERE criminal_case_worker_post.criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getExtractedCriminalCase($criminal_id){
        $query = "SELECT criminal_case_id1 AS criminal_id FROM criminal_case_extracted_criminal_case WHERE criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSplitedCriminalCase($criminal_id){
        $query = "SELECT criminal_case_id1 AS criminal_id FROM criminal_case_splited_criminal_case WHERE criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasEvent($criminal_id){
        $query = "SELECT event_id FROM event_has_criminal_case WHERE criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasAction($criminal_id){
        $query = "SELECT action_id FROM action_has_criminal_case WHERE criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasOrganization($criminal_id){
        $query = "SELECT organization_id FROM criminal_case_has_organization WHERE criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasMan($criminal_id){
        $query = "SELECT man_id FROM criminal_case_has_man WHERE criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasFile($criminal_id){
        $query = "SELECT file.id , file.name FROM criminal_case
                  LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = criminal_case.bibliography_id
                  LEFT JOIN file ON file.id = bibliography_has_file.file_id
                  WHERE criminal_case.id = '$criminal_id' AND file.id IS NOT NULL ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function createEvent($b_id){
        $query = "INSERT INTO event SET bibliography_id = '$b_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function eventSave($event_id,$value,$field){
        if( ($field == 'organization_id')&&($value == 0) ){
            $query = "UPDATE event SET organization_id = null WHERE id = '$event_id' ";
        }elseif( ($field == 'opened_criminal_case_id')&&($value == 0) ){
            $query = "UPDATE event SET opened_criminal_case_id = null WHERE id = '$event_id' ";
        }elseif( ($field == 'organization_id')&&($value == 0) ){
            $query = "UPDATE event SET organization_id = null WHERE id = '$event_id' ";
        }elseif( ($field == 'address_id')&&($value == 0) ){
            $query = "UPDATE event SET address_id = null WHERE id = '$event_id' ";
        }elseif($value == 'null'){
            $query = "UPDATE event SET `$field` = null WHERE id = '$event_id' ";
        }else{
            $query = "UPDATE event SET `$field` = '$value' WHERE id = '$event_id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function eventHasQualification($event_id,$qualification_id){
        $query = "INSERT INTO event_has_qualification SET event_id = '$event_id' , qualification_id = '$qualification_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_event_has_qualification($event_id,$qualification_id){
        $query = "DELETE FROM event_has_qualification WHERE event_id = '$event_id' AND qualification_id = '$qualification_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkActionHasEvent($event_id,$action_id){
        $query = "SELECT action_has_event.* FROM action_has_event WHERE event_id = '$event_id' AND action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function actionHasEvent($event_id,$action_id){
        $query = "INSERT INTO action_has_event SET event_id = '$event_id' , action_id = '$action_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_event_action_has_event($event_id,$action_id){
        $query = "DELETE FROM action_has_event WHERE event_id = '$event_id' AND action_id = '$action_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkEventPassesSignal($event_id,$signal_id){
        $query = "SELECT event_passes_signal.* FROM event_passes_signal WHERE event_id = '$event_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function eventPassesSignal($event_id,$signal_id){
        $query = "INSERT INTO event_passes_signal SET event_id = '$event_id' , signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_event_passes_signal($event_id,$signal_id){
        $query = "DELETE FROM event_passes_signal WHERE event_id = '$event_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkEventHasAction($event_id,$action_id){
        $query = "SELECT event_has_action.* FROM event_has_action WHERE event_id = '$event_id' AND action_id = '$action_id'";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function eventHasAction($event_id,$action_id){
        $query = "INSERT INTO event_has_action SET event_id = '$event_id' , action_id = '$action_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_event_has_action($event_id,$action_id){
        $query = "DELETE FROM event_has_action WHERE event_id = '$event_id' AND action_id = '$action_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkEventHasWeapon($event_id,$weapon_id){
        $query = "SELECT event_has_weapon.* FROM event_has_weapon WHERE event_id = '$event_id' AND weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function eventHasWeapon($event_id,$weapon_id){
        $query = "INSERT INTO event_has_weapon SET event_id = '$event_id' , weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_event_has_weapon($event_id,$weapon_id){
        $query = "DELETE FROM event_has_weapon WHERE event_id = '$event_id' AND weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkEventHasCar($event_id,$car_id){
        $query = "SELECT event_has_car.* FROM event_has_car WHERE event_id = '$event_id' AND car_id = '$car_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function eventHasCar($event_id,$car_id){
        $query = "INSERT INTO event_has_car SET event_id = '$event_id' , car_id = '$car_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_event_has_car($event_id,$car_id){
        $query = "DELETE FROM event_has_car WHERE event_id = '$event_id' AND car_id = '$car_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkEventHasOrganization($event_id,$organization_id){
        $query = "SELECT event_has_organization.* FROM event_has_organization WHERE event_id = '$event_id' AND organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function eventHasOrganization($event_id,$organization_id){
        $query = "INSERT INTO event_has_organization SET event_id = '$event_id' , organization_id = '$organization_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_event_has_organization($event_id,$organization_id){
        $query = "DELETE FROM event_has_organization WHERE event_id = '$event_id' AND organization_id = '$organization_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getEventHasQualification($event_id){
        $query = "SELECT event_qualification.*,event_has_qualification.event_id FROM event_has_qualification
                  LEFT JOIN event_qualification ON event_qualification.id = event_has_qualification.qualification_id
                  WHERE event_has_qualification.event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEvent($event_id){
        $query = "SELECT `event`.*, aftermath.name AS aftermath , resource.name AS resource, agency.name AS agency FROM `event`
                  LEFT JOIN aftermath ON aftermath.id = `event`.aftermath_id
                  LEFT JOIN resource ON resource.id = `event`.resource_id
                  LEFT JOIN agency ON agency.id = `event`.agency_id
                  WHERE `event`.id = '$event_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getEventHasAction($event_id){
        $query = "SELECT action_id FROM event_has_action WHERE event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasSignal($event_id){
        $query = "SELECT signal_id FROM event_passes_signal WHERE event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEvenActionHasEvent($event_id){
        $query = "SELECT action_id FROM action_has_event WHERE event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasCar($event_id){
        $query = "SELECT car_id FROM event_has_car WHERE event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasWeapon($event_id){
        $query = "SELECT weapon_id FROM event_has_weapon WHERE event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasOrganization($event_id){
        $query = "SELECT organization_id FROM event_has_organization WHERE event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasMan($event_id){
        $query = "SELECT man_id FROM event_has_man WHERE event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasFile($event_id){
        $query = "SELECT file.id , file.name FROM `event`
                  LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = `event`.bibliography_id
                  LEFT JOIN file ON bibliography_has_file.file_id = file.id
                  WHERE `event`.id = '$event_id' AND file.id IS NOT NULL ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function createMiaSummary($b_id){
        $query = "INSERT INTO mia_summary SET bibliography_id = '$b_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function getMiaSummary($mia_id){
        $query = "SELECT mia_summary.*, LEFT(mia_summary.content,10) AS content
            FROM mia_summary WHERE mia_summary.id = '$mia_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getMiaHasFile($mia_id){
        $query = " SELECT file.* FROM mia_summary
                   LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = mia_summary.bibliography_id
                   LEFT JOIN file ON file.id = bibliography_has_file.file_id
                   WHERE mia_summary.id = '$mia_id' AND file.id is not null
                   GROUP BY file.id";
        $this->_setSql($query);
        return $this->getAll();
    }


    //////////////////////////////////////////////////////

    public function mia_inf($data,$id){
        $query = "UPDATE mia_summary SET content = '$data' WHERE id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_mia_inf($mia_id){
        $query = "UPDATE mia_summary SET content = null WHERE id = '$mia_id' ";
        $this->_setSql($query);
        $this->run();
    }

    //////////////////////////////////////////////////////

    public function saveMiaSummary($mia_id,$field,$val){
        if( ($field == 'man_id')&&($val == 0) ){
            $query = "UPDATE mia_summary SET `man_id` = NULL WHERE mia_summary.id = '$mia_id' ";
        }elseif($val == 'null'){
            $query = "UPDATE mia_summary SET `$field` = null WHERE mia_summary.id = '$mia_id' ";
        }else{
            $query = "UPDATE mia_summary SET `$field` = '$val' WHERE mia_summary.id = '$mia_id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function getMiaSummaryHasMan($mia_id){
        $query = "SELECT man_id FROM man_passes_mia_summary WHERE mia_summary_id = '$mia_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getMiaSummaryHasOrganization($mia_id){
        $query = "SELECT organization_id FROM organization_passes_mia_summary WHERE mia_summary_id = '$mia_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function createOrganization(){
        $query = "INSERT INTO organization SET organization.name = null ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function organizationHasBibliography($b_id,$organization_id){
        $query = "INSERT INTO organization_has_bibliography SET organization_id = '$organization_id' , bibliography_id = '$b_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function saveOrganization($organization_id,$field,$value){
        if( ( ($field == 'address_id')|| ($field == 'known_as_organization_id') )&&($value == 0) ){
            $query = "UPDATE organization SET `$field` = null WHERE organization.id = '$organization_id' ";
        }elseif($value == 'null'){
            $query = "UPDATE organization SET `$field` = null WHERE organization.id = '$organization_id' ";
        }else{
            $query = "UPDATE organization SET `$field` = '$value' WHERE organization.id = '$organization_id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function checkOrganizationHasEvent($organization_id,$event_id){
        $query = "SELECT event_has_organization.* FROM event_has_organization WHERE organization_id = '$organization_id' AND event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function organizationHasEvent($organization_id,$event_id){
        $query = "INSERT INTO event_has_organization SET organization_id = '$organization_id' , event_id = '$event_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_has_event($organization_id,$event_id){
        $query = "DELETE FROM event_has_organization WHERE organization_id = '$organization_id' AND event_id = '$event_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkOrganizationHasAction($organization_id,$action_id){
        $query = "SELECT action_has_organization.* FROM action_has_organization WHERE organization_id = '$organization_id' AND action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function organizationHasAction($organization_id,$action_id){
        $query = "INSERT INTO action_has_organization SET organization_id = '$organization_id' , action_id = '$action_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_has_action($organization_id,$action_id){
        $query = "DELETE FROM action_has_organization WHERE organization_id = '$organization_id' AND action_id = '$action_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkOrganizationCheckedBySignal($organization_id,$signal_id){
        $query = "SELECT organization_checked_by_signal.* FROM organization_checked_by_signal WHERE organization_id = '$organization_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function organizationCheckedBySignal($organization_id,$signal_id){
        $query = "INSERT INTO organization_checked_by_signal SET organization_id = '$organization_id' , signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_checked_by_signal($organization_id,$signal_id){
        $query = "DELETE FROM organization_checked_by_signal WHERE organization_id = '$organization_id' AND signal_id = '$signal_id'";
        $this->_setSql($query);
        $this->run();
    }

    public function checkOrganizationPassedBySignal($organization_id,$signal_id){
        $query = "SELECT organization_passes_by_signal.* FROM organization_passes_by_signal WHERE organization_id = '$organization_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function organizationPassedBySignal($organization_id,$signal_id){
        $query = "INSERT INTO organization_passes_by_signal SET organization_id = '$organization_id' , signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_passed_by_signal($organization_id,$signal_id){
        $query = "DELETE FROM organization_passes_by_signal WHERE organization_id = '$organization_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }



    public function checkOrganizationHasCriminalCase($organization_id,$criminal_case_id){
        $query = "SELECT criminal_case_has_organization.* FROM criminal_case_has_organization WHERE organization_id = '$organization_id' AND criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function organizationHasCriminalCase($organization_id,$criminal_case_id){
        $query = "INSERT INTO criminal_case_has_organization SET organization_id = '$organization_id' , criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_has_criminal_case($organization_id,$criminal_case_id){
        $query = "DELETE FROM criminal_case_has_organization WHERE organization_id = '$organization_id' AND criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkOrganizationPassesMiaSummary($organization_id,$mia_summary_id){
        $query = "SELECT organization_passes_mia_summary.* FROM organization_passes_mia_summary WHERE organization_id = '$organization_id' AND mia_summary_id = '$mia_summary_id'";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function organizationPassesMiaSummary($organization_id,$mia_summary_id){
        $query = "INSERT INTO organization_passes_mia_summary SET organization_id = '$organization_id' , mia_summary_id = '$mia_summary_id'";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_passes_mia_summary($organization_id,$mia_summary_id){
        $query = "DELETE FROM organization_passes_mia_summary WHERE organization_id = '$organization_id' AND mia_summary_id = '$mia_summary_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkOrganizationHasWeapon($organization_id,$weapon_id){
        $query = "SELECT organization_has_weapon.* FROM organization_has_weapon WHERE organization_id = '$organization_id' AND weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function organizationHasWeapon($organization_id,$weapon_id){
        $query = "INSERT INTO organization_has_weapon SET organization_id ='$organization_id' , weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_has_weapon($organization_id,$weapon_id){
        $query = "DELETE FROM organization_has_weapon WHERE organization_id = '$organization_id' AND weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkOrganizationHasCar($organization_id,$car_id){
        $query = "SELECT organization_has_car.* FROM organization_has_car WHERE organization_id = '$organization_id' AND car_id = '$car_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function organizationHasCar($organization_id,$car_id){
        $query = "INSERT INTO organization_has_car SET organization_id = '$organization_id' , car_id = '$car_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_has_car($organization_id,$car_id){
        $query = "DELETE FROM organization_has_car WHERE organization_id = '$organization_id' AND car_id = '$car_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkOrganizationHasAddress($organization_id,$address_id){
        $query = "SELECT organization_has_address.* FROM organization_has_address WHERE organization_id = '$organization_id' AND address_id = '$address_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function organizationHasAddress($organization_id,$address_id,$dataDate){
        $query = "INSERT INTO organization_has_address SET organization_id = '$organization_id' , address_id = '$address_id' , start_date = '{$dataDate['start_date']}' , end_date = '{$dataDate['end_date']}' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_has_address($organization_id, $address_id){
        $query = "DELETE FROM organization_has_address WHERE organization_id = '$organization_id' AND address_id = '$address_id' ";
        $this->_setSql($query);
        $this->run();
    }

//    public function checkPhone($phone_number){
//        $query = "SELECT phone.id FROM phone WHERE `number` = '$phone_number' ";
//        $this->_setSql($query);
//        $data = $this->getRow();
//        if($data['id']){
//            return $data['id'];
//        }else{
//            return false;
//        }
//    }

    public function createPhone($phone_number,$more_data = null){
        $query = "INSERT INTO phone SET `number` = '$phone_number' , more_data = '$more_data' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function organizationHasPhone($organization_id,$phone_id,$character){
        $char = "character_id = '$character' ";
        if($character == 0){
            $char = " character_id = null ";
        }
        $query = "INSERT INTO organization_has_phone SET organization_id = '$organization_id' , phone_id = '$phone_id' ,  ".$char;
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_has_phone($organization_id,$phone_id){
        $query = "DELETE FROM organization_has_phone WHERE organization_id = '$organization_id' AND phone_id = '$phone_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createEmail($email_address){
        $query = "INSERT INTO email SET address = '$email_address' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function organizationHasEmail($organization_id,$email_id){
        $query = "INSERT INTO organization_has_email SET organization_id = '$organization_id' , email_id = '$email_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_has_email($organization_id,$email_id){
        $query = "DELETE FROM organization_has_email SET organization_id = '$organization_id' AND email_id = '$email_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function objects_relation_save($first_id , $second_id , $first , $second , $relation_type){
        if(empty($relation_type)){
            $relation_type = 'NULL';
        }
        $query = "INSERT INTO objects_relation SET relation_type_id = $relation_type , first_object_id = '$first_id' , second_object_id = '$second_id' ,
                    first_object_type = '$first' , second_obejct_type = '$second' ";
        $this->_setSql($query);
//        echo $query;
        $this->run();
        return $this->getId();
    }

    public function organization_has_man($organization_id, $man_id,$title,$period, $start_date , $end_date){
        $query = "INSERT INTO organization_has_man SET organization_id = '$organization_id' , man_id = '$man_id' , title = '$title' ,
                    period = '$period' , start_date = '$start_date' , end_date = '$end_date' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function getOrganization($organization_id){
        $query = "SELECT organization.* , organization_category.name AS organization_category , country.name AS country, country_ate.name AS country_ate, agency.name AS agency
                  FROM organization
                  LEFT JOIN organization_category ON organization_category.id = organization.category_id
                  LEFT JOIN country ON country.id = organization.country_id
                  LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
                  LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization.id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getOrganizationHasAddress($organization_id){
        $query = "SELECT address_id FROM organization_has_address WHERE organization_id = '$organization_id'";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasPhone($organization_id){
        $query = "SELECT phone_id FROM organization_has_phone WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasEmail($organization_id){
        $query = "SELECT email_id FROM organization_has_email WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasEvent($organization_id){
        $query = "SELECT event_id FROM event_has_organization WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationObjectsRelation($organization_id){
        $query = "SELECT id FROM objects_relation WHERE second_object_id = '$organization_id' AND first_object_type = 'organization' AND second_obejct_type = 'organization' ";
        $this->_setSql($query);
        $data1 = $this->getAll();
        $query = "SELECT id FROM objects_relation WHERE first_object_id = '$organization_id' AND first_object_type = 'organization' AND second_obejct_type = 'organization' ";
        $this->_setSql($query);
        $data2 = $this->getAll();
        if( ($data1)&&($data2) ){
            return array_merge($data1,$data2);
        }elseif($data1){
            return $data1;
        }elseif($data2){
            return $data2;
        }else{
            return false;
        }
    }

    public function getOrganizationHasCriminalCase($organization_id){
        $query = "SELECT criminal_case_id FROM criminal_case_has_organization WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasAction($organization_id){
        $query = "SELECT action_id FROM action_has_organization WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasMan($organization_id){
        $query = "SELECT id FROM organization_has_man WHERE organization_id = '$organization_id'";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationCheckedBySignal($organization_id){
        $query = "SELECT signal_id FROM organization_checked_by_signal WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationPassesBySignal($organization_id){
        $query = "SELECT signal_id FROM organization_passes_by_signal WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasCar($organization_id){
        $query = "SELECT car_id FROM organization_has_car WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasWeapon($organization_id){
        $query = "SELECT weapon_id FROM organization_has_weapon WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasMiaSummary($organization_id){
        $query = "SELECT mia_summary_id FROM organization_passes_mia_summary WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationEvent($organization_id){
        $query = "SELECT id AS event_id FROM `event` WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getOrganizationHasFile($organization_id){
        $query = "SELECT file.id , file.name FROM organization_has_bibliography
                  LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id =  organization_has_bibliography.bibliography_id
                  LEFT JOIN file ON file.id = bibliography_has_file.file_id
                  WHERE organization_has_bibliography.organization_id = '$organization_id' AND file.id IS NOT NULL ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function createKeepSignal($signal_id){
        $query = "INSERT INTO keep_signal SET signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function updateKeepSignal($keep_signal_id,$field,$value){
        if($value == 'null'){
            $query = "UPDATE keep_signal SET `$field` = null WHERE id = '$keep_signal_id' ";
        }else{
            $query = "UPDATE keep_signal SET `$field` = '$value' WHERE id = '$keep_signal_id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function createKeepSignalWorker( $value ,$keep_signal_id ){
        $query = "INSERT INTO keep_signal_worker SET worker = '$value' , keep_signal_id = '$keep_signal_id' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function keepSignalWorkerPost($keep_signal_id,$worker_post_id){
        $query = "INSERT INTO keep_signal_worker_post SET keep_signal_id = '$keep_signal_id' , worker_post_id = '$worker_post_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_keep_signal_worker_post($keep_signal_id,$worker_post_id){
        $query = "DELETE FROM keep_signal_worker_post WHERE keep_signal_id = '$keep_signal_id' AND worker_post_id = '$worker_post_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getKeepSignalWorker($keep_signal_id){
        $query = "SELECT keep_signal_worker.* FROM keep_signal_worker WHERE keep_signal_id = '$keep_signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getKeepSignalWorkerPost($keep_signal_id){
        $query = "SELECT worker_post.* FROM keep_signal_worker_post
                  LEFT JOIN worker_post ON keep_signal_worker_post.worker_post_id = worker_post.id
                  WHERE keep_signal_worker_post.keep_signal_id = '$keep_signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

//    public function keep_signal_has_worker($keep_signal_id,$worker_id){
//        $query = "INSERT INTO keep_signal_has_worker SET keep_signal_id = '$keep_signal_id' , worker_id = '$worker_id'";
//        $this->_setSql($query);
//        $this->run();
//    }
//
//    public function delete_keep_signal_has_worker($keep_signal_id,$worker_id){
//        $query = "DELETE FROM keep_signal_has_worker WHERE keep_signal_id = '$keep_signal_id' AND worker_id = '$worker_id' ";
//        $this->_setSql($query);
//        $this->run();
//    }

    public function createManBeanCountry($region_id,$locality_id,$data){
        if(!empty($data['entry_date'])){
            $dataDate = explode('-',$data['entry_date']);
            $year = $dataDate[2];
            $month = $dataDate[1];
            $day = $dataDate[0];
            $data['entry_date'] = $year.'-'.$month.'-'.$day;
        }else{
            $data['entry_date'] = 'null';
        }
        if(!empty($data['exit_date'])){
            $dataDate = explode('-',$data['exit_date']);
            $year = $dataDate[2];
            $month = $dataDate[1];
            $day = $dataDate[0];
            $data['exit_date'] = $year.'-'.$month.'-'.$day;
        }else{
            $data['exit_date'] = 'null';
        }

        if(empty($data['country_ate_id'])){
            $data['country_ate_id'] = 'null';
        }
        if(empty($data['goal_id'])){
            $data['goal_id'] = 'null';
        }
        if(!$locality_id){
            $locality_id = 'null';
        }
        if(!$region_id){
            $region_id = 'null';
        }

        $query = "INSERT INTO man_bean_country SET man_id = '{$data['man_id']}' , country_ate_id = ".$data['country_ate_id']." , goal_id = ".$data['goal_id']." ,
                    region_id = ".$region_id." , locality_id = ".$locality_id." , entry_date = '".$data['entry_date']."' , exit_date = '".$data['exit_date']."' ";
//        echo $query;
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function checkManHasBibliography($b_id,$man_id){
        $query = "SELECT * FROM man_has_bibliography WHERE man_id = '$man_id' AND bibliography_id = '$b_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    ////////////////////////////////////////// man editing //////////////////////////////
    public function getMan($man_id){
        $query = "SELECT man.* , gender.name AS gender , nation.name AS nation , address_country_ate.name AS address_country_ate_name , address_country_ate.id AS address_country_ate_id,
                        address_region.name AS address_region_name , address_region.id AS address_region_id, address_region.country_id AS address_region_country_id ,
                        address_locality.name AS address_locality_name , address_locality.id AS address_locality_id , address_locality.country_id AS address_locality_country_id ,
                        religion.name AS religion , resource.name AS resource , CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS birth_year
                  FROM man
                  LEFT JOIN gender ON gender.id = gender_id
                  LEFT JOIN nation ON nation.id = nation_id
                  LEFT JOIN religion ON religion.id = religion_id
                  LEFT JOIN resource ON resource.id = resource_id
                  LEFT JOIN address ON address.id = man.born_address_id
                  LEFT JOIN country_ate AS address_country_ate ON address_country_ate.id = address.country_ate_id
                  LEFT JOIN region AS address_region ON address_region.id = address.region_id
                  LEFT JOIN locality AS address_locality ON address_locality.id = address.locality_id
                  WHERE man.id = '$man_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getManHasFirstName($man_id){
        $query = "SELECT first_name.* FROM man_has_first_name
                  LEFT JOIN first_name ON first_name.id = first_name_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasLastName($man_id){
        $query = "SELECT last_name.* FROM man_has_last_name
                  LEFT JOIN last_name ON last_name.id = last_name_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasMiddleName($man_id){
        $query = "SELECT middle_name.* FROM man_has_middle_name
                  LEFT JOIN middle_name ON middle_name.id = middle_name_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManNameAuto($man_id){
        $query = "SELECT          (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id
                                  WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id
                                  WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id
                                  WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name
                  FROM man WHERE man.id = '$man_id' ";
        $this->_setSql($query);
        $data =  $this->getRow();
        $result = '';
        if($data){
            if(!empty($data['last_name'])){
                $result .= $data['last_name'].";";
            }
            if(!empty($data['first_name'])){
                $result .= $data['first_name'].";";
            }
            if(!empty($data['middle_name'])){
                $result .= $data['middle_name'].";";
            }
        }
        return $result;
    }

    public function getManHasPassport($man_id){
        $query = "SELECT passport.* FROM man_has_passport
                  LEFT JOIN passport ON passport.id = passport_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManBelongsCountry($man_id){
        $query = "SELECT country.* FROM man_belongs_country
                  LEFT JOIN country ON country.id = country_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManKnowsLanguage($man_id){
        $query = "SELECT `language`.* FROM man_knows_language
                  LEFT JOIN `language` ON `language`.id = language_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasAddress($man_id){
        $query = "SELECT address_id FROM man_has_address WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasPhone($man_id){
        $query = "SELECT phone_id FROM man_has_phone WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasEmail($man_id){
        $query = "SELECT email_id FROM man_has_email WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getMoreDataMan($man_id){
        $query = "SELECT id , LEFT(text, 10) AS text FROM more_data_man WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasOperationCategory($man_id){
        $query = "SELECT operation_category.* FROM man_has_operation_category
                  LEFT JOIN operation_category ON operation_category.id = operation_category_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCountrySearchMan($man_id){
        $query = "SELECT country.* FROM country_search_man
                  LEFT JOIN country ON country.id = country_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasEducation($man_id){
        $query = "SELECT education.* FROM man_has_education
                  LEFT JOIN education ON education.id = education_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasParty($man_id){
        $query = "SELECT party.* FROM man_has_party
                  LEFT JOIN party ON party.id = party_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasWorkActivity($man_id){
        $query = "SELECT id AS work_activity_id FROM organization_has_man WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManBeanCountry($man_id){
        $query = "SELECT id AS man_bean_country_id FROM man_bean_country WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManExternalSignHasSign($man_id){
        $query = "SELECT id FROM man_external_sign_has_sign WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManExternalSignHasPhoto($man_id){
        $query = "SELECT id FROM man_external_sign_has_photo WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasNickname($man_id){
        $query = "SELECT nickname.* FROM man_has_nickname
                  LEFT JOIN nickname ON nickname.id = nickname_id
                  WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasObjectsOrganization($man_id){
        $query = "SELECT id FROM objects_relation WHERE first_object_type = 'organization' AND second_obejct_type = 'man' AND second_object_id = '$man_id' ";
        $this->_setSql($query);
        $data1 = $this->getAll();
        $query = "SELECT id FROM objects_relation WHERE second_obejct_type = 'organization' AND first_object_type = 'man' AND first_object_id = '$man_id' ";
        $this->_setSql($query);
        $data2 = $this->getAll();
        if( ($data1)&&($data2) ){
            return array_merge($data1,$data2);
        }elseif($data2){
            return $data2;
        }elseif($data1){
            return $data1;
        }else{
            return false;
        }
    }

    public function getManHasObjectsMan($man_id){
        $query = "SELECT id FROM objects_relation WHERE first_object_type = 'man' AND second_obejct_type = 'man' AND second_object_id = '$man_id' ";
        $this->_setSql($query);
        $data1 = $this->getAll();
        $query = "SELECT id FROM objects_relation WHERE second_obejct_type = 'man' AND first_object_type = 'man' AND first_object_id = '$man_id' ";
        $this->_setSql($query);
        $data2 = $this->getAll();
        if( ($data1)&&($data2) ){
            return array_merge($data1,$data2);
        }elseif($data2){
            return $data2;
        }elseif($data1){
            return $data1;
        }else{
            return false;
        }
    }

    public function getManHasAction($man_id){
        $query = "SELECT action_id FROM action_has_man WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasEvent($man_id){
        $query = "SELECT event_id FROM event_has_man WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManPassedBySignal($man_id){
        $query = "SELECT signal_id FROM man_passed_by_signal WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManCheckedBySignal($man_id){
        $query = "SELECT signal_id FROM signal_has_man WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasCriminalCase($man_id){
        $query = "SELECT criminal_case_id FROM criminal_case_has_man WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManPassesMiaSummary($man_id){
        $query = "SELECT mia_summary_id FROM man_passes_mia_summary WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasCar($man_id){
        $query = "SELECT car_id FROM man_has_car WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasWeapon($man_id){
        $query = "SELECT weapon_id FROM man_has_weapon WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManUseCar($man_id){
        $query = "SELECT car_id FROM man_use_car WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasAnswer($man_id){
        $query = "SELECT id, LEFT(text,10) AS text FROM answer WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasFile($man_id){
        $query = "SELECT file.id , file.name FROM man_has_bibliography
                  LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = man_has_bibliography.bibliography_id
                  LEFT JOIN file ON file.id = bibliography_has_file.file_id
                  WHERE man_id = '$man_id' AND file.id IS NOT NULL
                  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCar($car_id){
        $query = "SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS color
                  FROM car
                  LEFT JOIN car_category ON car_category.id = car.category_id
                  LEFT JOIN car_mark ON car_mark.id = car.mark_id
                  LEFT JOIN color ON color.id = car.color_id
                  WHERE car.id = '$car_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getWeapon($weapon_id){
        $query = "SELECT weapon.* FROM weapon WHERE id = '$weapon_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getKeepSignal($keep_signal_id){
        $query = "SELECT keep_signal.* ,agency.name AS agency , unit.name AS unit , sub_unit.name AS sub_unit , passed_sub_unit.name AS pased_sub_unit_name
                  FROM keep_signal
                  LEFT JOIN agency ON agency.id = keep_signal.agency_id
                  LEFT JOIN agency AS unit ON unit.id = keep_signal.unit_id
                  LEFT JOIN agency AS sub_unit ON sub_unit.id = keep_signal.sub_unit_id
                  LEFT JOIN agency AS passed_sub_unit ON passed_sub_unit.id = keep_signal.pased_sub_unit
                  WHERE keep_signal.id = '$keep_signal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getKeepSignalHasWorker($keep_signal_id){
        $query = "SELECT worker_id , CONCAT(worker.first_name,',',worker.last_name,',',worker_post.name) AS worker
                  FROM keep_signal_has_worker
                  LEFT JOIN worker ON worker.id = keep_signal_has_worker.worker_id
                  LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE keep_signal_id = '$keep_signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddress($address_id){
        $query = "SELECT address.* , country_ate.name AS country_ate, region.name AS region , region.country_id AS checkRegion ,
                        locality.name AS locality , locality.country_id AS checkLocality , street.name AS street , street.country_id AS checkStreet
                  FROM address
                  LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  LEFT JOIN region ON region.id = address.region_id
                  LEFT JOIN locality ON locality.id = address.locality_id
                  LEFT JOIN street ON street.id = address.street_id
                  WHERE address.id = '$address_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getMBC($mbc_id){
        $query = "SELECT man_bean_country.* , goal.name AS goal , country_ate.name AS country_ate , region.name AS region,
                    region.country_id AS checkRegion , locality.name AS locality , locality.country_id AS checkLocality
                  FROM man_bean_country
                  LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
                  LEFT JOIN goal ON goal.id = man_bean_country.goal_id
                  LEFT JOIN region ON region.id = man_bean_country.region_id
                  LEFT JOIN locality ON locality.id = man_bean_country.locality_id
                  WHERE man_bean_country.id = '$mbc_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function updateManBeanCountry($mbc_id,$region_id,$locality_id,$data){
        if(!empty($data['entry_date'])){
            $dataDate = explode('-',$data['entry_date']);
            $year = $dataDate[2];
            $month = $dataDate[1];
            $day = $dataDate[0];
            $data['entry_date'] = $year.'-'.$month.'-'.$day;
        }
        if(!empty($data['exit_date'])){
            $dataDate = explode('-',$data['exit_date']);
            $year = $dataDate[2];
            $month = $dataDate[1];
            $day = $dataDate[0];
            $data['exit_date'] = $year.'-'.$month.'-'.$day;
        }

        if(empty($data['country_ate_id'])){
            $data['country_ate_id'] = 'null';
        }
        if(empty($data['goal_id'])){
            $data['goal_id'] = 'null';
        }
        if(empty($data['entry_date'])){
            $data['entry_date'] = 'null';
        }
        if(!$locality_id){
            $locality_id = 'null';
        }
        if(!$region_id){
            $region_id = 'null';
        }
        if(empty($data['exit_date'])){
            $data['exit_date'] = 'null';
        }

        $query = "UPDATE man_bean_country SET country_ate_id = ".$data['country_ate_id']." , goal_id = ".$data['goal_id']." ,
                    region_id = ".$region_id." , locality_id = ".$locality_id." , entry_date = '".$data['entry_date']."' , exit_date = '".$data['exit_date']."'
                  WHERE man_bean_country.id = '$mbc_id' ";
//        echo $query;
        $this->_setSql($query);
        $this->run();
    }

    public function getManExternalSign($sign_id){
        $query = "SELECT man_external_sign_has_sign.* , sign.name AS sign
                  FROM man_external_sign_has_sign
                  LEFT JOIN sign ON sign.id = sign_id
                  WHERE man_external_sign_has_sign.id = '$sign_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getWorkActivity($id){
        $query = "SELECT organization_has_man.* FROM organization_has_man WHERE id = '$id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function updateOrganizationHasMan($wk_id,$title,$period, $start_date , $end_date){
        $query = "UPDATE organization_has_man SET title = '$title' ,
                    period = '$period' , start_date = '$start_date' , end_date = '$end_date' WHERE id = '$wk_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getEmail($email_id){
        $query = "SELECT email.* FROM email WHERE email.id = '$email_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function updateEmail($email_id,$email){
        $query = "UPDATE email SET address = '$email' WHERE id = '$email_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getObjectRelation($obj_id){
        $query = "SELECT objects_relation.* , relation_type.name AS relation_type
                  FROM objects_relation
                  LEFT JOIN relation_type ON relation_type.id = relation_type_id
                  WHERE objects_relation.id = '$obj_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function updateObject($obj_id,$relation_type_id){
        $query = "UPDATE objects_relation SET relation_type_id = '$relation_type_id' WHERE id = '$obj_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createNewFile($man_id,$name,$imgName){
        $query = "INSERT INTO file SET `name` = '$imgName' , real_name = '$name' ";
        $this->_setSql($query);
        $this->run();
        $file_id = $this->getId();
        $query = "INSERT INTO man_has_file SET man_id = '$man_id' , file_id = '$file_id' ";
        $this->_setSql($query);
        $this->run();
        return $file_id;
    }

    public function getFile($file_id){
        $query = "SELECT file.* FROM file WHERE id = '$file_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function deleteFile($file_id){
        $query = "DELETE FROM man_has_file WHERE file_id = '$file_id' ";
        $this->_setSql($query);
        $this->run();
        $query = "DELETE FROM file WHERE id = '$file_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getManOwnFile($man_id){
        $query = "SELECT file.* FROM man_has_file
                  LEFT JOIN file ON man_has_file.file_id = file.id
                  WHERE man_has_file.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function setBibliographyNull($tb_name,$tb_id){
        $query = "UPDATE `$tb_name` SET bibliography_id = null WHERE id = '$tb_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function deleteManHasBibliography($tb_id,$b_id){
        $query = "DELETE FROM man_has_bibliography WHERE man_id = '$tb_id' AND bibliography_id = '$b_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function deleteOrganizationHasBibliography($tb_id,$b_id){
        $query = "DELETE FROM organization_has_bibliography WHERE organization_id = '$tb_id' AND bibliography_id = '$b_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getManEditAddress($address_id,$man_id){
        $query = "SELECT man_has_address.* FROM man_has_address WHERE man_id = '$man_id' AND address_id = '$address_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function updateManHasAddress($data){
        $query = "UPDATE man_has_address SET start_date = '{$data['start_date']}' , end_date = '{$data['end_date']}' WHERE man_id = '{$data['man_id']}' AND address_id = '{$data['address_id']}' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getOrganizationEditAddress($address_id,$org_id){
        $query = "SELECT organization_has_address.* FROM organization_has_address WHERE address_id = '$address_id' AND organization_id = '$org_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function updateOrganizationHasAddress($data){
        $query = "UPDATE organization_has_address SET start_date = '{$data['start_date']}' , end_date = '{$data['end_date']}' WHERE organization_id = '{$data['organization_id']}' AND address_id = '{$data['address_id']}' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getManEditPhone($phone_id,$man_id){
        $query = "SELECT phone.* , man_has_phone.*,`character`.name as character_name FROM man_has_phone
                  LEFT JOIN phone ON man_has_phone.phone_id = phone.id
                  LEFT JOIN `character` ON `character`.id = man_has_phone.character_id
                  WHERE man_has_phone.man_id = '$man_id' AND man_has_phone.phone_id = '$phone_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function updateManHasPhone($phone_id ,  $man_id , $data){
        $query = "UPDATE phone SET `number`= '{$data['phone_number']}' , more_data = '{$data['more_data']}' WHERE phone.id = '$phone_id' ";
        $this->_setSql($query);
        $this->run();
        $character = $data['character'];
        if($character == '0'){
            $character = 'null';
        }
        $query = "UPDATE man_has_phone SET character_id = $character WHERE man_id = '$man_id' AND phone_id = '$phone_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getOrganizationEditPhone($phone_id,$organization_id){
        $query = "SELECT phone.* , organization_has_phone.*,`character`.name as character_name FROM organization_has_phone
                  LEFT JOIN phone ON organization_has_phone.phone_id = phone.id
                  LEFT JOIN `character` ON `character`.id = organization_has_phone.character_id
                  WHERE organization_has_phone.organization_id = '$organization_id' AND organization_has_phone.phone_id = '$phone_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function updateOrganizationHasPhone($phone_id ,  $organization_id , $data){
        $query = "UPDATE phone SET `number`= '{$data['phone_number']}' , more_data = '{$data['more_data']}' WHERE phone.id = '$phone_id' ";
        $this->_setSql($query);
        $this->run();
        $character = $data['character'];
        if($character == '0'){
            $character = 'null';
        }
        $query = "UPDATE organization_has_phone SET character_id = $character WHERE organization_id = '$organization_id' AND phone_id = '$phone_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getPhone($phone_id){
        $query = "SELECT phone.* FROM phone WHERE phone.id = '$phone_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function updatePhone($phone_id , $data){
        $query = "UPDATE phone SET `number`= '{$data['phone_number']}' , more_data = '{$data['more_data']}' WHERE phone.id = '$phone_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function actionQualification($action_id,$qualification_id){
        $query = "INSERT INTO action_has_qualification SET action_id = '$action_id' , qualification_id = '$qualification_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_action_qualification($action_id,$qualification_id){
        $query = "DELETE FROM action_has_qualification WHERE action_id = '$action_id' AND qualification_id = '$qualification_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getActionHasQualification($action_id){
        $query = "SELECT action_qualification.* FROM action_has_qualification
                  LEFT JOIN action_qualification ON action_has_qualification.qualification_id = action_qualification.id
                  WHERE action_has_qualification.action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function bibliography_has_country($b_id,$country_id){
        $query = "INSERT INTO bibliography_has_country SET bibliography_id = '$b_id' , country_id = '$country_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_bibliography_has_country($b_id,$country_id){
        $query = "DELETE FROM bibliography_has_country WHERE bibliography_id = '$b_id' AND country_id = '$country_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function checkEventHasCriminalCase($event_id,$criminal_case_id){
        $query = "SELECT event_has_criminal_case.* FROM event_has_criminal_case WHERE event_id = '$event_id' AND criminal_case_id = '$criminal_case_id'";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function eventHasCriminalCase($event_id,$criminal_case_id){
        $query = "INSERT INTO event_has_criminal_case SET event_id = '$event_id' , criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_event_has_criminal_case($event_id,$criminal_case_id){
        $query = "DELETE FROM event_has_criminal_case WHERE event_id = '$event_id' AND criminal_case_id = '$criminal_case_id'";
        $this->_setSql($query);
        $this->run();
    }

    public function getEvenHasCriminalCase($event_id){
        $query = "SELECT criminal_case_id FROM event_has_criminal_case WHERE event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function checkManToMan($man_id1,$man_id2){
        $query = "SELECT man_to_man.* FROM man_to_man WHERE (man_id1 = '$man_id1' AND man_id2 = '$man_id2') OR (man_id2 = '$man_id1' AND man_id1 = '$man_id2') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function manToMan($man_id1,$man_id2){
        $query = "INSERT INTO man_to_man SET man_id1 = '$man_id1' , man_id2 = '$man_id2' ";
        $this->_setSql($query);
        $this->run();
        $query = "SELECT bibliography_id FROM man_has_bibliography WHERE man_id = '$man_id1' ";
        $this->_setSql($query);
        $bs = $this->getAll();
        if($bs){
            foreach($bs as $val){
                $query = "INSERT IGNORE INTO man_has_bibliography SET man_id = '$man_id2' , bibliography_id = '{$val['bibliography_id']}' ";
                $this->_setSql($query);
                $this->run();
            }
        }
    }

    public function delete_man_to_man($man_id1,$man_id2){
        $query = "DELETE FROM man_to_man WHERE (man_id1 = '$man_id1' AND man_id2 = '$man_id2') OR (man_id2 = '$man_id1' AND man_id1 = '$man_id2') ";
        $this->_setSql($query);
        $this->run();
    }

    public function getManToMan($man_id){
        $query = " (SELECT man_to_man.man_id1 AS man_id FROM man_to_man WHERE man_id2 = '$man_id')
                    UNION
                   (SELECT man_to_man.man_id2 AS man_id FROM man_to_man WHERE man_id1 = '$man_id')";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function checkOrganizationToOrganization($org_id1,$org_id2){
        $query = "SELECT organization_to_organization.* FROM organization_to_organization
                  WHERE (organization_id1 = '$org_id1' AND organization_id2 = '$org_id2')
                      OR (organization_id1 = '$org_id2' AND organization_id2 = '$org_id1') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function organizationHasOrganization($org_id1,$org_id2){
        $query = "INSERT INTO organization_to_organization SET organization_id1 = '$org_id1' , organization_id2 = '$org_id2' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_organization_has_organization($org_id1,$org_id2){
        $query = "DELETE FROM organization_to_organization
                  WHERE (organization_id1 = '$org_id1' AND organization_id2 = '$org_id2')
                      OR (organization_id1 = '$org_id2' AND organization_id2 = '$org_id1')";
        $this->_setSql($query);
        $this->run();
    }

    public function getOrganizationToOrganization($organization_id){
        $query = "(SELECT organization_to_organization.organization_id1 AS org_id FROM organization_to_organization WHERE organization_id2 = '$organization_id')
                    UNION
                  (SELECT organization_to_organization.organization_id2 AS org_id FROM organization_to_organization WHERE organization_id1 = '$organization_id')";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function checkCriminalCaseHasSignal($criminal_id,$signal_id){
        $query = "SELECT criminal_case_has_signal.* FROM criminal_case_has_signal WHERE criminal_case_id = '$criminal_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function criminalCaseHasSignal($criminal_id,$signal_id){
        $query = "INSERT INTO criminal_case_has_signal SET criminal_case_id = '$criminal_id' , signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_criminal_case_has_signal($criminal_id,$signal_id){
        $query = "DELETE FROM criminal_case_has_signal WHERE criminal_case_id = '$criminal_id' AND signal_id = '$signal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getCriminalCaseHasSignal($criminal_id){
        $query = "SELECT signal_id FROM criminal_case_has_signal WHERE criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function checkActionToAction($action_id1,$action_id2){
        $query = "SELECT action_to_action.* FROM action_to_action WHERE (action_id1 = '$action_id1' AND action_id2 = '$action_id2') OR  (action_id1 = '$action_id2' AND action_id2 = '$action_id1')";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function actionToAction($action_id1,$action_id2){
        $query = "INSERT INTO action_to_action SET action_id1 = '$action_id1' , action_id2 = '$action_id2' ";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_action_to_action($action_id1,$action_id2){
        $query = "DELETE FROM action_to_action WHERE (action_id1 = '$action_id1' AND action_id2 = '$action_id2') OR  (action_id1 = '$action_id2' AND action_id2 = '$action_id1')";
        $this->_setSql($query);
        $this->run();
    }

    public function getActionHasAction($action_id){
        $query = "(SELECT action_to_action.action_id1 AS action_id FROM action_to_action WHERE action_id2 = '$action_id')
                    UNION
                  (SELECT action_to_action.action_id2 AS action_id FROM action_to_action WHERE action_id1 = '$action_id')";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function checkActionHasCriminalCase($action_id,$criminal_id){
        $query = "SELECT action_has_criminal_case.* FROM action_has_criminal_case WHERE action_id = '$action_id' AND criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function actionHasCriminalCase($action_id,$criminal_id){
        $query = "INSERT INTO action_has_criminal_case SET action_id = '$action_id' , criminal_case_id = '$criminal_id'";
        $this->_setSql($query);
        $this->run();
    }

    public function delete_action_has_criminal_case($action_id,$criminal_id){
        $query = "DELETE FROM action_has_criminal_case WHERE action_id = '$action_id' AND criminal_case_id = '$criminal_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getActionHasCriminalCase($action_id){
        $query = "SELECT criminal_case_id FROM action_has_criminal_case WHERE action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasBibliography($man_id){
        $query = "SELECT bibliography_id FROM man_has_bibliography WHERE man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasBibliography($organization_id){
        $query = "SELECT bibliography_id FROM organization_has_bibliography WHERE organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getPhoneHas($phone_id){
        $query = "(SELECT action_id AS id,'short_action' as short ,'action' AS tb FROM action_has_phone WHERE phone_id = '$phone_id')
                  UNION
                  (SELECT man_id AS id,'short_man' as short , 'man' AS tb FROM man_has_phone WHERE phone_id = '$phone_id' )
                  UNION
                  (SELECT organization_id AS id,'short_organ' as short , 'organization' AS tb FROM organization_has_phone WHERE phone_id = '$phone_id' )";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEmailHas($email_id){
        $query = "(SELECT man_id AS id, 'short_man' AS short, 'man' AS tb FROM man_has_email WHERE email_id = '$email_id' )
                    UNION
                  (SELECT organization_id AS id ,'short_organ' AS short,'organization' AS tb FROM organization_has_email WHERE email_id = '$email_id')";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWeaponHas($weapon_id){
        $query = "(SELECT man_id AS id , 'short_man' AS short, 'man' as tb FROM man_has_weapon WHERE weapon_id = '$weapon_id' )
                  UNION
                  (SELECT organization_id AS id , 'short_organ' AS short, 'organization' AS tb FROM organization_has_weapon WHERE weapon_id = '$weapon_id')
                  UNION
                  (SELECT action_id AS id, 'short_action' AS short, 'action' AS tb FROM action_has_weapon WHERE weapon_id = '$weapon_id')
                  UNION
                  (SELECT event_id AS id, 'short_event' AS short, 'event' AS tb FROM event_has_weapon WHERE weapon_id = '$weapon_id')";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHas($car_id){
        $query = "(SELECT man_id AS id , 'short_man' AS short, 'man' as tb FROM man_has_car WHERE car_id = '$car_id' )
                  UNION
                  (SELECT man_id AS id , 'short_man' AS short, 'man' as tb FROM man_use_car WHERE car_id = '$car_id' )
                  UNION
                  (SELECT organization_id AS id , 'short_organ' AS short, 'organization' AS tb FROM organization_has_car WHERE car_id = '$car_id')
                  UNION
                  (SELECT action_id AS id, 'short_action' AS short, 'action' AS tb FROM action_has_car WHERE car_id = '$car_id')
                  UNION
                  (SELECT event_id AS id, 'short_event' AS short, 'event' AS tb FROM event_has_car WHERE car_id = '$car_id')
                  UNION
                  (SELECT address_id AS id, 'short_address' AS short, 'address' AS tb FROM car_has_address WHERE car_id = '$car_id' )";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHas($address_id){
        $query = "(SELECT man_id AS id , 'short_man' AS short, 'man' as tb FROM man_has_address WHERE address_id = '$address_id' )
                  UNION
                  (SELECT id , 'short_man' AS short, 'man' as tb FROM man WHERE born_address_id = '$address_id' )
                  UNION
                  (SELECT organization_id AS id , 'short_organ' AS short, 'organization' AS tb FROM organization_has_address WHERE address_id = '$address_id')
                  UNION
                  (SELECT id , 'short_organ' AS short, 'organization' AS tb FROM organization WHERE address_id = '$address_id')
                  UNION
                  (SELECT id, 'short_action' AS short, 'action' AS tb FROM action WHERE address_id = '$address_id')
                  UNION
                  (SELECT id, 'short_event' AS short, 'event' AS tb FROM `event` WHERE address_id = '$address_id')
                  UNION
                  (SELECT car_id AS id, 'short_car' AS short, 'car' AS tb FROM car_has_address WHERE address_id = '$address_id' )";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function checkOrgBibliography($organization_id,$b_id){
        $query = "SELECT * FROM organization_has_bibliography WHERE organization_id = '$organization_id' AND bibliography_id = '$b_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

}