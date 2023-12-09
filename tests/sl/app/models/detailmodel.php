<?php

class DetailModel extends Model
{
    public function getMan($id){

        $query = "SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource , CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS birth_year,

                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id
                                  WHERE man_has_first_name.man_id = '$id' GROUP BY man_id ) AS first_name ,

                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id
                                  WHERE man_has_last_name.man_id = '$id' GROUP BY man_id) AS last_name ,

                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id
                                  WHERE man_has_middle_name.man_id = '$id' GROUP BY man_id) AS middle_name ,

                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id
                                  WHERE man_has_passport.man_id = '$id' GROUP BY man_id) AS passport,

                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id
                                  WHERE man_belongs_country.man_id = '$id' GROUP BY man_id) AS man_belongs_country ,

                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id
                                  WHERE man_has_education.man_id = '$id' GROUP BY man_id) AS education ,

                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN language ON man_knows_language.language_id = language.id
                                  WHERE man_knows_language.man_id = '$id' GROUP BY man_id) AS man_knows_language ,

                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id
                                  WHERE man_has_party.man_id = '$id' GROUP BY man_id) AS party ,

                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id
                                  WHERE man_has_nickname.man_id = '$id' GROUP BY man_id) AS nickname ,

                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id
                                  WHERE man_has_operation_category.man_id = '$id' GROUP BY man_id) AS operation_category
                  FROM man
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man.id = '$id' ";
        $this->_setSql($query);
        $data['man'] = $this->getRow();

        return $data;
    }

    public function getAction($id){

        $query = " SELECT `action`.* ,  duration.name AS duration, goal.name AS goal, terms.name AS terms, aftermath.name AS aftermath, action_qualification.name AS action_qualification ,
            (SELECT GROUP_CONCAT(material_content.content) FROM  action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id
            WHERE action_has_material_content.action_id = '$id'
            GROUP BY(action_id) ) AS material_content
            FROM `action`
            LEFT JOIN duration ON duration.id = action.duration_id
            LEFT JOIN goal ON goal.id = action.goal_id
            LEFT JOIN terms ON terms.id = action.terms_id
            LEFT JOIN aftermath ON aftermath.id = action.aftermath_id
            LEFT JOIN action_has_qualification ON action_has_qualification.action_id = action.id
            LEFT JOIN action_qualification ON action_qualification.id = action_has_qualification.qualification_id
            WHERE action.id = '$id' GROUP BY action.id";
        $this->_setSql($query);
        $data['action'] = $this->getRow() ;
        return $data;
    }

    public function getOrganization($id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization
            LEFT JOIN agency ON agency.id = organization.agency_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            WHERE organization.id = '$id' ";
        $this->_setSql($query);
        $data['organization']=$this->getRow();
        return $data;
    }

    public function getEvent($id){
        $query = "SELECT event.* , aftermath.name AS aftermath, agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id
            WHERE event_has_qualification.event_id = '$id'
            GROUP BY(event_id) ) AS event_qualification
            FROM `event`
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
            WHERE event.id = '$id' ";
        $this->_setSql($query);
        $data['event'] = $this->getRow();
        return $data;
    }

    public function getAddress($id){
        $query = "SELECT	address.* ,  region.name AS region , locality.name AS locality, street.name AS street ,  country_ate.name AS country_ate
            FROM address
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
            WHERE address.id = '$id' ";
        $this->_setSql($query);
        $data['address'] = $this->getRow();
        return $data;
    }

    public function getCar($id){
        $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM car
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id
                WHERE car.id = '$id' ";
        $this->_setSql($query);
        $data['car'] = $this->getRow();
        return $data;
    }

    public function getManBeannCountry($id){
        $query = " SELECT man_bean_country.* , country_ate.name AS country_ate, goal.name AS goal, region.name AS region, locality.name AS locality
            FROM man_bean_country
            LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
            LEFT JOIN goal ON goal.id = man_bean_country.goal_id
            LEFT JOIN region ON region.id = man_bean_country.region_id
            LEFT JOIN locality ON locality.id = man_bean_country.locality_id
            WHERE man_bean_country.id ='$id' ";
        $this->_setSql($query);
        $data['man_beann_country'] = $this->getRow();
        return $data;
    }

    public function getPhone($id){
        $query = " SELECT phone.* FROM phone WHERE phone.id = '$id' ";
        $this->_setSql($query);
        $data['phone'] = $this->getRow();
        return $data;
    }

    public function getPhoneFromMan($id,$man_id){
        $query = "SELECT phone.* , `character`.name AS `character`
                  FROM phone
                  LEFT JOIN man_has_phone ON man_has_phone.phone_id = phone.id
                  LEFT JOIN `character` ON `character`.id = man_has_phone.character_id AND man_has_phone.man_id = '$man_id'
                  WHERE phone.id = '$id' ";
        $this->_setSql($query);
        $data['phone'] = $this->getRow();
        return $data;
    }

    public function getPhoneFromOrganization($id,$org_id){
        $query = "SELECT phone.* , `character`.name AS `character`
                  FROM phone
                  LEFT JOIN organization_has_phone ON organization_has_phone.phone_id = phone.id AND organization_has_phone.organization_id = '$org_id'
                  LEFT JOIN `character` ON `character`.id = organization_has_phone.character_id
                  WHERE phone.id = '$id' ";
        $this->_setSql($query);
        $data['phone'] = $this->getRow();
        return $data;
    }

    public function getWorkActivity($id){
        $query = "SELECT organization_has_man.* , organization.id AS organization, man.id AS man
            FROM organization_has_man
            LEFT JOIN organization ON organization.id = organization_has_man.organization_id
            LEFT JOIN man ON man.id = organization_has_man.man_id
            WHERE organization_has_man.id = '$id' AND (organization_has_man.start_date IS NOT NULL OR organization_has_man.end_date IS NOT NULL OR organization_has_man.title IS NOT NULL)";
        $this->_setSql($query);
        $data['work_activity'] = $this->getRow();
        return $data;
    }

    public function getCriminalCase($id){
        $query = "SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS unit, subunit.name AS subunit,
			          (SELECT GROUP_CONCAT(worker) FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = criminal_case.id ) AS worker ,
			          (SELECT GROUP_CONCAT(worker_post.name) FROM criminal_case_worker_post
			           LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
			           WHERE criminal_case_worker_post.criminal_case_id = criminal_case.id ) AS worker_post
            FROM criminal_case
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            LEFT JOIN worker ON worker.id = criminal_case.worker_id
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
            WHERE criminal_case.id = '$id' ";
        $this->_setSql($query);
        $data['criminal_case'] = $this->getRow();
        return $data;
    }

    public function getBibliography($id){
        $query = "SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name
                FROM bibliography
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                WHERE bibliography.id = '$id' ";
        $this->_setSql($query);
        $data['bibliography'] = $this->getRow();
        return $data;
    }

    public function getKeepSignal($id){
        $query = "SELECT keep_signal.* , agency.name AS agency, unit.name AS unit, sub_unit.name AS sub_unit, passed_sub_unit.name AS passed_sub_unit,
                   (SELECT GROUP_CONCAT(worker) FROM keep_signal_worker WHERE keep_signal_worker.keep_signal_id = keep_signal.id ) AS worker ,
               (SELECT GROUP_CONCAT(worker_post.name) FROM keep_signal_worker_post
                LEFT JOIN worker_post ON worker_post.id = keep_signal_worker_post.worker_post_id
                WHERE keep_signal_worker_post.keep_signal_id = keep_signal.id ) AS worker_post
               FROM keep_signal
               LEFT JOIN agency ON agency.id = keep_signal.agency_id
               LEFT JOIN agency AS unit ON unit.id = keep_signal.unit_id
               LEFT JOIN agency AS sub_unit ON sub_unit.id = keep_signal.sub_unit_id
               LEFT JOIN agency AS passed_sub_unit ON passed_sub_unit.id = keep_signal.pased_sub_unit
               WHERE keep_signal.id = '$id' ";
        $this->_setSql($query);
        $data['keep_signal'] = $this->getRow();
        return $data;
    }

    public function getMiaSummary($id){
        $query = "SELECT mia_summary.*
               FROM mia_summary
               WHERE mia_summary.id = '$id' ";
        $this->_setSql($query);
        $data['mia_summary'] = $this->getRow();
        return $data;
    }

    public function getControl($id){
        $query = " SELECT control.* , unit.name AS unit, act_unit.name AS act_unit, sub_act_unit.name AS sub_act_unit, doc_category.name AS doc_category, control_result.name AS result
            FROM control
            LEFT JOIN agency AS unit ON unit.id = control.unit_id
            LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
            LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
            LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
            LEFT JOIN control_result ON control_result.id = control.result_id
            WHERE control.id = '$id'";
        $this->_setSql($query);
        $data['control'] = $this->getRow();
        return $data;
    }

    public function getSignal($id){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                (TO_DAYS(`signal`.end_date)-TO_DAYS(`signal`.check_date)) AS count_days,

                        (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,

                        (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                        LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id
                        WHERE signal_has_taken_measure.signal_id = '$id'
                        GROUP BY(signal_id) ) AS taken_measure,

                        (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                        LEFT JOIN resource ON signal_used_resource.resource_id = resource.id
                        WHERE signal_used_resource.signal_id = '$id'
                        GROUP BY(signal_id) ) AS signal_used_resource

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
                WHERE signal.id = '$id' ";
        $this->_setSql($query);
        $data['signal'] = $this->getRow();
        return $data;
    }

    public function getWeapon($id){
        $query = "SELECT weapon.* FROM weapon
               WHERE weapon.id = '$id'";
        $this->_setSql($query);
        $data['weapon'] = $this->getRow();
        return $data;
    }

    public function getExternalSigns($id){
        $query = "SELECT sign.* FROM sign
               WHERE sign.id = '$id'";
        $this->_setSql($query);
        $data['sign'] = $this->getRow();
        return $data;
    }

    public function getExternalSign($id){
        $query = "SELECT sign.*,man_external_sign_has_sign.fixed_date AS fixed_date FROM man_external_sign_has_sign
                  LEFT JOIN sign ON sign.id = man_external_sign_has_sign.sign_id
                  WHERE man_external_sign_has_sign.id = '$id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getPhoto($id){
        $query = "SELECT photo.image ,man_external_sign_has_photo.fixed_date  FROM man_external_sign_has_photo
                  LEFT JOIN photo ON photo.id = man_external_sign_has_photo.photo_id
                  WHERE man_external_sign_has_photo.id = '$id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getObject($id){
        $query = "SELECT objects_relation.* , relation_type.name AS relation_type FROM objects_relation
                  LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id
                  WHERE objects_relation.id = '$id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getMail($id){
        $query = "SELECT email.* FROM email WHERE id = '$id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getManFiles($man_id){
        $query = "SELECT file.id , file.name FROM man_has_bibliography
                  LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = man_has_bibliography.bibliography_id
                  LEFT JOIN file ON file.id = bibliography_has_file.file_id
                  WHERE man_id = '$man_id' AND file.id IS NOT NULL
                  ";
        $this->_setSql($query);
        return $this->getAll();
    }
}