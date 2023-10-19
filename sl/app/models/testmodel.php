<?php

class TestModel extends Model
{
    public function save($file){
        foreach($file as $val){
            $query = "INSERT INTO region SET name = '$val' ";
            $this->_setSql($query);
            $this->run();
        }
    }

    public function saveAgencyParent(){
        $query = "SELECT * FROM agency_parent";
        $this->_setSql($query);
       return $this->getAll();
    }

    public function lastNameSave($man_id, $last_name_id){
        $query = "INSERT INTO man_has_last_name SET man_id = '$man_id', last_name_id = '$last_name_id'  ";
        $this->_setSql($query);
        $this->run();
    }

    public function lastNameDelete($man_id, $last_name_id){
        $query = "DELETE FROM man_has_last_name WHERE man_id = '$man_id' AND last_name_id ='$last_name_id' ";
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

    public function firstNameSave($man_id, $first_name_id){
        $query = "INSERT INTO man_has_first_name SET man_id = '$man_id', first_name_id = '$first_name_id'  ";
        $this->_setSql($query);
        $this->run();
    }

    public function firstNameDelete($man_id, $first_name_id){
        $query = "DELETE FROM man_has_first_name WHERE man_id = '$man_id' AND first_name_id ='$first_name_id' ";
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

    public function middleNameSave($man_id, $middle_name_id){
        $query = "INSERT INTO man_has_middle_name SET man_id = '$man_id', middle_name_id = '$middle_name_id'  ";
        $this->_setSql($query);
        $this->run();
    }

    public function middleNameDelete($man_id, $middle_name_id){
        $query = "DELETE FROM man_has_middle_name WHERE man_id = '$man_id' AND middle_name_id ='$middle_name_id' ";
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

////////////////////////////////////  man_bean_country ///////////////////
    public function createMbc(){
        $query = "INSERT INTO man_bean_country SET `note` = null ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function mbcSave($id, $value, $field){
        $query = "UPDATE man_bean_country SET $field = '$value' WHERE id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function mbcDelete($id){
        $query = " DELETE FROM man_bean_country WHERE id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }


    public function checkLocality($locality){
        $query = "SELECT locality.id FROM locality WHERE locality.name = '$locality' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

    public function createLocality($locality){
        $query = "INSERT INTO locality SET locality.name = '$locality' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }


    public function checkRegion($region){
        $query = "SELECT region.id FROM region WHERE region.name = '$region' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

    public function createRegion($region){
        $query = "INSERT INTO region SET region.name = '$region' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }




    public function login($data){
        $query = "SELECT users.id FROM users WHERE users.username = '".$data['username']."' AND users.password = '".md5($data['password'])."' ";
        $this->_setSql($query);
        $userId = $this->getRow();
        if(empty($userId)){
            return false;
        }else{
            return $userId['id'];
        }
    }

    public function createReg($data){
        $query = "INSERT INTO users SET users.username = '{$data['username']}', users.first_name = '{$data['first_name']}', users.last_name = '{$data['last_name']}', users.password = '".md5($data['password'])."', users.user_type = '{$data['user_type']}' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function checkUsername($username){
        $query = "SELECT users.id FROM users WHERE users.username = '$username' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['id'];
    }

//
//    public function checkUsername($username){
//        $query = "SELECT * FROM `user` WHERE `user`.username = '$username' ";
//        $this->_setSql($query);
//        $data = $this->getRow();
//        return $data['id'];
//    }
//
//    public function createUsername($username){
//        $query = "INSERT INTO `user` SET `user`.username = '$username' ";
//        $this->_setSql($query);
//        $this->run();
//        return $this->getId();
//    }
//
//    public function checkFirstName($first_name){
//        $query = "SELECT * FROM `user` WHERE `user`.first_name = '$first_name' ";
//        $this->_setSql($query);
//        $data = $this->getRow();
//        return $data['id'];
//    }
//
//    public function createFirstName($first_name){
//        $query = "INSERT INTO `user` SET `user`.first_name = '$first_name' ";
//        $this->_setSql($query);
//        $this->run();
//        return $this->getId();
//    }
//
//    public function regSave($id, $value, $field){
//        $query = "UPDATE `user` SET $field = '$value' WHERE id = '$id' ";
//        $this->_setSql($query);
//        $this->run();
//    }



    public function readBibliography(){
        $query = "SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name
                FROM bibliography
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id	";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readPhone(){
        $query = " ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readCar(){
        $query = "SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM car
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readAddress(){
        $query = "SELECT	address.* , country.name AS country , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
            FROM address
            LEFT JOIN country ON country.id = address.country_id
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN city ON city.id = address.city_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readManBeannCountry(){
        $query = "SELECT man_bean_country.* , country_ate.name AS country_ate, goal.name AS goal, region.name AS region, locality.name AS locality
            FROM man_bean_country
            LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
            LEFT JOIN goal ON goal.id = man_bean_country.goal_id
            LEFT JOIN region ON region.id = man_bean_country.region_id
            LEFT JOIN locality ON locality.id = man_bean_country.locality_id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readAction(){
        $query = "SELECT `action`.* , duration.name AS duration, goal.name AS goal, terms.name AS terms, aftermath.name AS aftermath, action_qualification.name AS action_qualification
            FROM `action`
            LEFT JOIN duration ON duration.id = action.duration_id
            LEFT JOIN goal ON goal.id = action.goal_id
            LEFT JOIN terms ON terms.id = action.terms_id
            LEFT JOIN aftermath ON aftermath.id = action.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = action.action_qualification_id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readEvent(){
        $query = "SELECT event.* , aftermath.name AS aftermath, CONCAT(worker.first_name, ' ', worker.last_name) AS worker, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id GROUP BY(event_id) ) AS event_qualification
            FROM `event`
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN worker ON worker.id = event.gave_to_worker_id
            LEFT JOIN resource ON resource.id = event.resource_id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readOrganization(){
        $query = "SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate
            FROM organization
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readSign(){
        $query = " ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readWeapon(){
        $query = "SELECT * FROM weapon";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readWorkActivity(){
        $query = "SELECT organization_has_man.* , organization.id AS organization, man.id AS man
            FROM organization_has_man
            LEFT JOIN organization ON organization.id = organization_has_man.organization_id
            LEFT JOIN man ON man.id = organization_has_man.man_id
            WHERE organization_has_man.start_date IS NOT NULL OR organization_has_man.end_date IS NOT NULL OR organization_has_man.title IS NOT NULL ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readObjectsRelation(){
        $query = " ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readCriminalCase(){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS unit, subunit.name AS subunit,
			          CONCAT(worker.first_name, ' ', worker.last_name, ' ',worker_post.name) AS worker
            FROM criminal_case
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            LEFT JOIN worker ON worker.id = criminal_case.worker_id
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id	";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readKeepSignal(){
        $query = " SELECT keep_signal.* , agency.name AS agency, unit.name AS unit, sub_unit.name AS sub_unit, passed_sub_unit.name AS passed_sub_unit,
               (SELECT  GROUP_CONCAT( CONCAT(worker.first_name, ' ', worker.last_name, ' ',worker_post.name)  ) FROM  keep_signal_has_worker
               LEFT JOIN worker ON worker.id = keep_signal_has_worker.worker_id
               LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id GROUP BY(keep_signal_id) ) AS worker
           FROM keep_signal
           LEFT JOIN agency ON agency.id = keep_signal.agency_id
           LEFT JOIN agency AS unit ON unit.id = keep_signal.unit_id
           LEFT JOIN agency AS sub_unit ON sub_unit.id = keep_signal.sub_unit_id
           LEFT JOIN agency AS passed_sub_unit ON passed_sub_unit.id = keep_signal.sub_unit_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readMiaSummary(){
        $query = " SELECT mia_summary.* FROM mia_summary ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readControl(){
        $query = "SELECT control.* , unit.name AS unit, act_unit.name AS act_unit, sub_act_unit.name AS sub_act_unit, doc_category.name AS doc_category, control_result.name AS result
            FROM control
            LEFT JOIN agency AS unit ON unit.id = control.unit_id
            LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
            LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
            LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
            LEFT JOIN control_result ON control_result.id = control.result_id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readSignal(){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                        (SELECT  GROUP_CONCAT( CONCAT(worker.first_name, ' ', worker.last_name, ' ',worker_post.name)  ) FROM  signal_check_worker
                        LEFT JOIN worker ON worker.id = signal_check_worker.worker_id
                        LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id GROUP BY(signal_id) ) AS worker,
                        (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                        LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id GROUP BY(signal_id) ) AS taken_measure,
                        (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                        LEFT JOIN resource ON signal_used_resource.resource_id = resource.id GROUP BY(signal_id) ) AS signal_used_resource
                FROM `signal`
                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id	";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readMan(){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id
                                   GROUP BY man_id) AS man_belongs_country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN language ON man_knows_language.language_id = language.id
                                   GROUP BY man_id) AS man_knows_language ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id
                                   GROUP BY man_id) AS operation_category
                  FROM man
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function signal_report($data)
    {
        $query = "SELECT `signal`.*,signal_result.name AS signal_result_name ,worker_post.name AS worker_post_name, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                (SELECT GROUP_CONCAT( CONCAT(worker.first_name, ' ', worker.last_name)  )  FROM  signal_check_worker
                LEFT JOIN worker ON worker.id = signal_check_worker.worker_id
                LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id WHERE signal_check_worker.signal_id = signal.id GROUP BY(signal_id) ) AS worker,
                (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,

                (SELECT GROUP_CONCAT(check_date.date) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date_m


                FROM `signal`

                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                LEFT JOIN worker ON worker.id = signal.opened_worker_id
                LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
            WHERE
            (
                ( DATE(signal.subunit_date) >= '{$data['subunit_date']}' AND DATE(signal.subunit_date) <= '{$data['subunit_date_to']}')
                  OR
                (DATE(signal.end_date) >= '{$data['subunit_date']}' AND DATE(signal.end_date) <= '{$data['subunit_date_to']}')
                  AND
                (signal.check_unit_id = '{$data['opened_agency_id']}')
            )";
        $this->_setSql($query);
        return $this->getAll();
    }

}