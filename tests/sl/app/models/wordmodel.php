<?php

class WordModel extends Model{
    public function getAction($action_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                   (SELECT GROUP_CONCAT(action_qualification.name) FROM action_has_qualification
            LEFT JOIN action_qualification ON action_has_qualification.qualification_id = action_qualification.id WHERE action_has_qualification.action_id = `action`.id
            GROUP BY action_id) AS action_qualification ,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM `action`
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE `action`.id = '$action_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getAddress($address_id){
        $query = " SELECT	address.* , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
            FROM address
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN city ON city.id = address.city_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  WHERE address.id = '$address_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getCar($car_id){
        $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM car
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id
                  WHERE car.id = '$car_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getControl($control_id){
        $query = " SELECT control.* , unit.name AS unit, act_unit.name AS act_unit, sub_act_unit.name AS sub_act_unit, doc_category.name AS doc_category, control_result.name AS result
            FROM control
            LEFT JOIN agency AS unit ON unit.id = control.unit_id
            LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
            LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
            LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
            LEFT JOIN control_result ON control_result.id = control.result_id
                  WHERE control.id = '$control_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getCriminalCase($criminal_case_id){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
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
                  WHERE criminal_case.id = '$criminal_case_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getEmail($email_id){
        $query = " SELECT email.* FROM email
                  WHERE email.id = '$email_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getEvent($event_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM `event`
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE event.id = '$event_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getKeepSignal($keep_signal_id){
        $query = " SELECT keep_signal.* , agency.name AS agency, unit.name AS unit, sub_unit.name AS sub_unit,passed_sub_unit.name as pased_sub_unit,
               (SELECT GROUP_CONCAT(worker) FROM keep_signal_worker WHERE keep_signal_worker.keep_signal_id = keep_signal.id ) AS worker ,
               (SELECT GROUP_CONCAT(worker_post.name) FROM keep_signal_worker_post
                LEFT JOIN worker_post ON worker_post.id = keep_signal_worker_post.worker_post_id
                WHERE keep_signal_worker_post.keep_signal_id = keep_signal.id ) AS worker_post
            FROM keep_signal
            LEFT JOIN agency ON agency.id = keep_signal.agency_id
            LEFT JOIN agency AS unit ON unit.id = keep_signal.unit_id
            LEFT JOIN agency AS sub_unit ON sub_unit.id = keep_signal.sub_unit_id
            LEFT JOIN agency AS passed_sub_unit ON passed_sub_unit.id = keep_signal.pased_sub_unit
                  WHERE keep_signal.id = '$keep_signal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getMan($man_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                   address_country_ate.name AS country_ate,
                                   address_region.name AS region_id,address_region.country_id AS address_region_country_id ,
                                   address_locality.name AS locality_id ,address_locality.country_id AS address_locality_country_id ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  LEFT JOIN address ON address.id = man.born_address_id
                  LEFT JOIN country_ate AS address_country_ate ON address_country_ate.id = address.country_ate_id
                  LEFT JOIN region AS address_region ON address_region.id = address.region_id
                  LEFT JOIN locality AS address_locality ON address_locality.id = address.locality_id
                  WHERE man.id = '$man_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getManBeanCountry($man_bean_country_id){
        $query = " SELECT man_bean_country.* , country_ate.name AS country_ate, goal.name AS goal, region.name AS region, locality.name AS locality

            FROM man_bean_country
            LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
            LEFT JOIN goal ON goal.id = man_bean_country.goal_id
            LEFT JOIN region ON region.id = man_bean_country.region_id
            LEFT JOIN locality ON locality.id = man_bean_country.locality_id
                  WHERE man_bean_country.id = '$man_bean_country_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getMiaSummary($mia_summary_id){
        $query = " SELECT mia_summary.* FROM mia_summary
                  WHERE mia_summary.id = '$mia_summary_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getObjectsRelation($objects_relation_id){
        $query = " SELECT objects_relation.*, relation_type.name AS relation_type_id
            FROM objects_relation
            LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id
                  WHERE objects_relation.id = '$objects_relation_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getOrganization($organization_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization.id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getPhone($phone_id){
        $query = " SELECT phone.* ,
            (SELECT GROUP_CONCAT(`character`.name) FROM man_has_phone
            LEFT JOIN `character` ON man_has_phone.character_id = `character`.id WHERE man_has_phone.phone_id = phone.id
            GROUP BY phone_id) AS character_man ,
            (SELECT GROUP_CONCAT(`character`.name) FROM organization_has_phone
            LEFT JOIN `character` ON organization_has_phone.character_id = `character`.id WHERE organization_has_phone.phone_id = phone.id
            GROUP BY phone_id) AS character_organization
            FROM phone
                  WHERE phone.id = '$phone_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getSignal($signal_id){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                 (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (TO_DAYS(`signal`.end_date)-TO_DAYS(`signal`.check_date)) AS count_days,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,
                (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,
                (SELECT GROUP_CONCAT(check_date.date) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date_id
                FROM `signal`
                LEFT JOIN worker ON worker.id = `signal`.opened_worker_id
                LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id
                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  WHERE signal.id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getWeapon($weapon_id){
        $query = " SELECT weapon.* FROM weapon
                  WHERE weapon.id = '$weapon_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getWorkActivity($work_activity_id){
        $query = " SELECT organization_has_man.id, organization_has_man.title, organization_has_man.start_date, organization_has_man.end_date, organization_has_man.period
            FROM organization_has_man
                  WHERE organization_has_man.id = '$work_activity_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getBibliography($bibliography_id){
        $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name ,
	                                  (SELECT GROUP_CONCAT(country.name) FROM bibliography_has_country
                                        LEFT JOIN country ON bibliography_has_country.country_id = country.id WHERE bibliography_has_country.bibliography_id = `bibliography`.id
                                        GROUP BY bibliography_id) AS country
                FROM bibliography
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                  WHERE bibliography.id = '$bibliography_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getExternalSigns($sign_id){
        $query = " SELECT  GROUP_CONCAT(sign.name) AS `name` ,  man_external_sign_has_sign.*
            FROM man_external_sign_has_sign
            LEFT JOIN `sign` ON man_external_sign_has_sign.sign_id = sign.id
                  WHERE man_external_sign_has_sign.sign_id = '$sign_id'
           GROUP BY man_id ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getPhoneHasOrganization($phone_id){
        $query =" SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization_has_phone
            LEFT JOIN organization ON organization.id = organization_has_phone.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization_has_phone.phone_id = '$phone_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getPhoneHasAction($phone_id){
        $query= " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content

            FROM action_has_phone
            LEFT JOIN `action` ON `action`.id = action_has_phone.action_id
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id

            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE action_has_phone.phone_id = '$phone_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getPhoneHasMan($phone_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,

                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man_has_phone
		          LEFT JOIN man ON man.id = man_has_phone.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man_has_phone.phone_id = '$phone_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getObjectsRelationHasMan($objects_relation_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,

                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM objects_relation
                  LEFT JOIN man ON (objects_relation.first_object_id = man.id AND objects_relation.first_object_type = 'man')
                              OR (objects_relation.second_object_id = man.id AND objects_relation.second_obejct_type = 'man')
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE objects_relation.id = '$objects_relation_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getObjectsRelationHasOrganization($objects_relation_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM objects_relation
            LEFT JOIN organization ON (objects_relation.first_object_id = organization.id AND objects_relation.first_object_type = 'organization')
                        OR (objects_relation.second_object_id = organization.id AND objects_relation.second_obejct_type = 'organization')
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE objects_relation.id = '$objects_relation_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWeaponHasMan($weapon_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man_has_weapon
                  LEFT JOIN man ON man.id = man_has_weapon.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man_has_weapon.weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWeaponHasOrganization($weapon_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization_has_weapon
            LEFT JOIN organization ON organization.id = organization_has_weapon.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization_has_weapon.weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWeaponHasAction($weapon_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM action_has_weapon
            LEFT JOIN `action` ON `action`.id = action_has_weapon.action_id
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE action_has_weapon.weapon_id = '$weapon_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWeaponHasEvent($weapon_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM event_has_weapon
            LEFT JOIN event ON event.id = event_has_weapon.event_id
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE event_has_weapon.weapon_id = '$weapon_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHasOrganization($car_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization_has_car
            LEFT JOIN organization ON organization.id = organization_has_car.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization_has_car.car_id = '$car_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHasEvent($car_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM event_has_car
            LEFT JOIN event ON event.id = event_has_car.event_id
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE event_has_car.car_id = '$car_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHasAction($car_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM action_has_car
            LEFT JOIN `action` ON `action`.id = action_has_car.action_id
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE action_has_car.car_id = '$car_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHasAddress($car_id){
        $query = " SELECT	address.* , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
            FROM car_has_address
            LEFT JOIN address ON address.id = car_has_address.address_id
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN city ON city.id = address.city_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  WHERE car_has_address.car_id = '$car_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHasMan($car_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man_has_car
                  LEFT JOIN man ON man.id = man_has_car.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man_has_car.car_id = '$car_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarUseMan($car_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man_use_car
                  LEFT JOIN man ON man.id = man_use_car.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man_use_car.car_id = '$car_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHasMan($address_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man_has_address
                  LEFT JOIN man ON man.id = man_has_address.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man_has_address.address_id = '$address_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHasOrganization($address_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization_has_address
            LEFT JOIN organization ON organization.id = organization_has_address.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization_has_address.address_id = '$address_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressOrganization($address_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization
            LEFT JOIN address ON address.id = organization.address_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization.address_id = '$address_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHasAction($address_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content

            FROM `action`
            LEFT JOIN address ON address.id = `action`.address_id
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE `action`.address_id = '$address_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHasEvent($address_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM event
            LEFT JOIN address ON address.id = event.address_id
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE event.address_id = '$address_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHasCar($address_id){
        $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM car_has_address
                LEFT JOIN car ON car.id = car_has_address.car_id
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id
                  WHERE car_has_address.address_id = '$address_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWorkActivityHasMan($work_activity_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM organization_has_man
	              LEFT JOIN man ON man.id = organization_has_man.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE organization_has_man.id = '$work_activity_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWorkActivityHasOrganization($work_activity_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization_has_man
            LEFT JOIN organization ON organization.id = organization_has_man.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization_has_man.id = '$work_activity_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManBeanCountryHasMan($man_bean_country_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man_bean_country
	              LEFT JOIN man ON man.id = man_bean_country.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man_bean_country.id = '$man_bean_country_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getMiaSummaryHasMan($mia_summary_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man_passes_mia_summary
	              LEFT JOIN man ON man.id = man_passes_mia_summary.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man_passes_mia_summary.mia_summary_id = '$mia_summary_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getMiaSummaryHasOrganization($mia_summary_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization_passes_mia_summary
            LEFT JOIN organization ON organization.id = organization_passes_mia_summary.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization_passes_mia_summary.mia_summary_id = '$mia_summary_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getMiaSummaryHasBibliography($mia_summary_id){
        $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name
                FROM mia_summary
                LEFT JOIN bibliography ON bibliography.id = mia_summary.bibliography_id
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                  WHERE mia_summary.id = '$mia_summary_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasMan($bibliography_id){
        $query = "  SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man_has_bibliography
	              LEFT JOIN man ON man.id = man_has_bibliography.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man_has_bibliography.bibliography_id = '$bibliography_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasOrganization($bibliography_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization_has_bibliography
            LEFT JOIN organization ON organization.id = organization_has_bibliography.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization_has_bibliography.bibliography_id = '$bibliography_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasEvent($bibliography_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM `event`
            LEFT JOIN bibliography ON bibliography.id = event.bibliography_id
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE event.bibliography_id = '$bibliography_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasAction($bibliography_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM `action`
            LEFT JOIN bibliography ON bibliography.id = `action`.bibliography_id
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE `action`.bibliography_id = '$bibliography_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasSignal($bibliography_id){
        $query = "  SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                 (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,
                (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,
                (SELECT GROUP_CONCAT(check_date.date) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date
                FROM `signal`
	        	LEFT JOIN bibliography ON bibliography.id = `signal`.bibliography_id
                LEFT JOIN worker ON worker.id = `signal`.opened_worker_id
                LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id
                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  WHERE signal.bibliography_id = '$bibliography_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasCriminalCase($bibliography_id){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
			          (SELECT GROUP_CONCAT(worker) FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = criminal_case.id ) AS worker ,
			          (SELECT GROUP_CONCAT(worker_post.name) FROM criminal_case_worker_post
			           LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
			           WHERE criminal_case_worker_post.criminal_case_id = criminal_case.id ) AS worker_post
            FROM criminal_case
            LEFT JOIN bibliography ON bibliography.id = criminal_case.bibliography_id
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            LEFT JOIN worker ON worker.id = criminal_case.worker_id
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE criminal_case.bibliography_id = '$bibliography_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasControl($bibliography_id){
        $query = " SELECT control.* , unit.name AS unit, act_unit.name AS act_unit, sub_act_unit.name AS sub_act_unit, doc_category.name AS doc_category, control_result.name AS result
            FROM control
            LEFT JOIN bibliography ON bibliography.id = control.bibliography_id
            LEFT JOIN agency AS unit ON unit.id = control.unit_id
            LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
            LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
            LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
            LEFT JOIN control_result ON control_result.id = control.result_id
                  WHERE control.bibliography_id = '$bibliography_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasMiaSummary($bibliography_id){
        $query = " SELECT mia_summary.* FROM mia_summary
	        LEFT JOIN bibliography ON bibliography.id = mia_summary.bibliography_id
            WHERE mia_summary.bibliography_id = '$bibliography_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasEvent($action_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM action_has_event
            LEFT JOIN `event` ON `event`.id = action_has_event.event_id
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE action_has_event.action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasAction($action_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM `action`
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE `action`.related_action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasMan($action_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM action_has_man
                  LEFT JOIN man ON man.id = action_has_man.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE action_has_man.action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionEvent($action_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM event_has_action
            LEFT JOIN `event` ON `event`.id = event_has_action.event_id
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE event_has_action.action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasOrganization($action_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM action_has_organization
            LEFT JOIN organization ON organization.id = action_has_organization.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE action_has_organization.action_id = '$action_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasPhone($action_id){
        $query = " SELECT phone.* ,
            (SELECT GROUP_CONCAT(`character`.name) FROM man_has_phone
            LEFT JOIN `character` ON man_has_phone.character_id = `character`.id WHERE man_has_phone.phone_id = phone.id
            GROUP BY phone_id) AS character_man ,
            (SELECT GROUP_CONCAT(`character`.name) FROM organization_has_phone
            LEFT JOIN `character` ON organization_has_phone.character_id = `character`.id WHERE organization_has_phone.phone_id = phone.id
            GROUP BY phone_id) AS character_organization
            FROM action_has_phone
            LEFT JOIN phone ON phone.id = action_has_phone.phone_id
                  WHERE action_has_phone.action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasWeapon($action_id){
        $query = " SELECT weapon.* FROM action_has_weapon
             LEFT JOIN weapon ON weapon.id = action_has_weapon.weapon_id
                  WHERE action_has_weapon.action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasCar($action_id){
        $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM action_has_car
                LEFT JOIN car ON car.id = action_has_car.car_id
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id
                  WHERE action_has_car.action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasBibliography($action_id){
        $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name
                FROM `action`
                LEFT JOIN bibliography ON bibliography.id = `action`.bibliography_id
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                  WHERE `action`.id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasSignal($action_id){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                 (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,
                (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,
                (SELECT GROUP_CONCAT(check_date.date) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date
                FROM action_passes_signal
                LEFT JOIN `signal` ON `signal`.id = action_passes_signal.signal_id
                LEFT JOIN worker ON worker.id = `signal`.opened_worker_id
                LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id
                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  WHERE action_passes_signal.action_id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasCriminalCase($action_id){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
			          (SELECT GROUP_CONCAT(worker) FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = criminal_case.id ) AS worker ,
			          (SELECT GROUP_CONCAT(worker_post.name) FROM criminal_case_worker_post
			           LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
			           WHERE criminal_case_worker_post.criminal_case_id = criminal_case.id ) AS worker_post
            FROM criminal_case
            LEFT JOIN `action` ON `action`.opened_criminal_case_id = criminal_case.id
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            LEFT JOIN worker ON worker.id = criminal_case.worker_id
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE `action`.id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasAddress($action_id){
        $query = " SELECT	address.* , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
            FROM address
            LEFT JOIN `action` ON `action`.address_id = address.id
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN city ON city.id = address.city_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  WHERE `action`.id = '$action_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasAddress($event_id){
        $query = " SELECT	address.* , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
            FROM `event`
            LEFT JOIN address ON address.id = `event`.address_id
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN city ON city.id = address.city_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  WHERE `event`.id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventOrganization($event_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM `event`
            LEFT JOIN organization ON organization.id = `event`.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE `event`.id = '$event_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasMan($event_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM event_has_man
                  LEFT JOIN man ON man.id = event_has_man.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE event_has_man.event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasOrganization($event_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM event_has_organization
            LEFT JOIN organization ON organization.id = event_has_organization.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE event_has_organization.event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasCar($event_id){
        $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM event_has_car
                LEFT JOIN car ON car.id = event_has_car.car_id
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id
                  WHERE event_has_car.event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasWeapon($event_id){
        $query = " SELECT weapon.* FROM event_has_weapon
                  LEFT JOIN weapon ON weapon.id = event_has_weapon.weapon_id
                  WHERE event_has_weapon.event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasAction($event_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM event_has_action
            LEFT JOIN `action` ON `action`.id = event_has_action.action_id
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE event_has_action.event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasCriminalCase($event_id){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
			          (SELECT GROUP_CONCAT(worker) FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = criminal_case.id ) AS worker ,
			          (SELECT GROUP_CONCAT(worker_post.name) FROM criminal_case_worker_post
			           LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
			           WHERE criminal_case_worker_post.criminal_case_id = criminal_case.id ) AS worker_post
            FROM `event`
            LEFT JOIN criminal_case ON criminal_case.id = event.opened_criminal_case_id
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            LEFT JOIN worker ON worker.id = criminal_case.worker_id
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE `event`.id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasSignal($event_id){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                 (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,
                (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,
                (SELECT GROUP_CONCAT(check_date.date) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date
                FROM event_passes_signal
                LEFT JOIN `signal` ON `signal`.id = event_passes_signal.signal_id
                LEFT JOIN worker ON worker.id = `signal`.opened_worker_id
                LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id
                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  WHERE event_passes_signal.event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasBibliography($event_id){
        $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name
                FROM `event`
                LEFT JOIN bibliography ON bibliography.id = `event`.bibliography_id
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                  WHERE `event`.id = '$event_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }
    public function getEventAction($event_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM action_has_event
            LEFT JOIN `action` ON `action`.id = action_has_event.action_id
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE action_has_event.event_id = '$event_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasMan($signal_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answercheck_date_id
                  FROM signal_has_man
                  LEFT JOIN man ON man.id = signal_has_man.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE signal_has_man.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasCriminalCase($signal_id){
        $query = "  SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
			          (SELECT GROUP_CONCAT(worker) FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = criminal_case.id ) AS worker ,
			          (SELECT GROUP_CONCAT(worker_post.name) FROM criminal_case_worker_post
			           LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
			           WHERE criminal_case_worker_post.criminal_case_id = criminal_case.id ) AS worker_post
            FROM criminal_case
            LEFT JOIN `signal` ON `signal`.id = criminal_case.signal_id
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            LEFT JOIN worker ON worker.id = criminal_case.worker_id
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE criminal_case.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasOrganization($signal_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization_checked_by_signal
            LEFT JOIN organization ON organization.id = organization_checked_by_signal.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization_checked_by_signal.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasAction($signal_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM action_passes_signal
            LEFT JOIN `action` ON `action`.id = action_passes_signal.action_id
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE action_passes_signal.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasEvent($signal_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM event_passes_signal
            LEFT JOIN `event` ON `event`.id = event_passes_signal.event_id
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE event_passes_signal.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalOrganization($signal_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization_passes_by_signal
            LEFT JOIN organization ON organization.id = organization_passes_by_signal.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization_passes_by_signal.signal_id = '$signal_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasBibliography($signal_id){
        $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name
                FROM `signal`
                LEFT JOIN bibliography ON bibliography.id = `signal`.bibliography_id
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                  WHERE `signal`.id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasKeepSignal($signal_id){
        $query = " SELECT keep_signal.* , agency.name AS agency, unit.name AS unit, sub_unit.name AS sub_unit,
               (SELECT GROUP_CONCAT(worker) FROM keep_signal_worker WHERE keep_signal_worker.keep_signal_id = keep_signal.id ) AS worker ,
               (SELECT GROUP_CONCAT(worker_post.name) FROM keep_signal_worker_post
                LEFT JOIN worker_post ON worker_post.id = keep_signal_worker_post.worker_post_id
                WHERE keep_signal_worker_post.keep_signal_id = keep_signal.id ) AS worker_post
            FROM keep_signal
            LEFT JOIN `signal` ON `signal`.id = keep_signal.signal_id
            LEFT JOIN agency ON agency.id = keep_signal.agency_id
            LEFT JOIN agency AS unit ON unit.id = keep_signal.unit_id
            LEFT JOIN agency AS sub_unit ON sub_unit.id = keep_signal.sub_unit_id
                  WHERE keep_signal.signal_id = '$signal_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasMan($criminal_case_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM criminal_case_has_man
                  LEFT JOIN man ON man.id = criminal_case_has_man.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE criminal_case_has_man.criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasOrganization($criminal_case_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM criminal_case_has_organization
            LEFT JOIN organization ON organization.id = criminal_case_has_organization.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE criminal_case_has_organization.criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasAction($criminal_case_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM `action`
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE `action`.opened_criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasEvent($criminal_case_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM `event`
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE event.opened_criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasSignal($criminal_case_id){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,
                (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,
                (SELECT GROUP_CONCAT(check_date.date) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date
                FROM criminal_case
                LEFT JOIN `signal` ON `signal`.id = criminal_case.signal_id
                LEFT JOIN worker ON worker.id = `signal`.opened_worker_id
                LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id
                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  WHERE criminal_case.id = '$criminal_case_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasCriminal($criminal_case_id){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
			          CONCAT(worker.first_name, ' ', worker.last_name, ' ',worker_post.name) AS worker
            FROM criminal_case_extracted_criminal_case
            LEFT JOIN criminal_case ON criminal_case.id = criminal_case_extracted_criminal_case.criminal_case_id1
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            LEFT JOIN worker ON worker.id = criminal_case.worker_id
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE criminal_case_extracted_criminal_case.criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasCase($criminal_case_id){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
			          CONCAT(worker.first_name, ' ', worker.last_name, ' ',worker_post.name) AS worker
            FROM criminal_case_splited_criminal_case
            LEFT JOIN criminal_case ON criminal_case.id = criminal_case_splited_criminal_case.criminal_case_id1
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            LEFT JOIN worker ON worker.id = criminal_case.worker_id
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE criminal_case_splited_criminal_case.criminal_case_id = '$criminal_case_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasBibliography($criminal_case_id){
        $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name
                FROM criminal_case
                LEFT JOIN bibliography ON bibliography.id = criminal_case.bibliography_id
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                  WHERE criminal_case.id = '$criminal_case_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasAddress($organization_id){
        $query = " SELECT	address.* , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
            FROM organization_has_address
            LEFT JOIN address ON address.id = organization_has_address.address_id
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN city ON city.id = address.city_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  WHERE organization_has_address.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasOrganization($organization_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization.known_as_organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasPhone($organization_id){
        $query = " SELECT phone.* ,
            (SELECT GROUP_CONCAT(`character`.name) FROM man_has_phone
            LEFT JOIN `character` ON man_has_phone.character_id = `character`.id WHERE man_has_phone.phone_id = phone.id
            GROUP BY phone_id) AS character_man ,
            (SELECT GROUP_CONCAT(`character`.name) FROM organization_has_phone
            LEFT JOIN `character` ON organization_has_phone.character_id = `character`.id WHERE organization_has_phone.phone_id = phone.id
            GROUP BY phone_id) AS character_organization
            FROM organization_has_phone
            LEFT JOIN phone ON phone.id = organization_has_phone.phone_id
                  WHERE organization_has_phone.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasEmail($organization_id){
        $query = " SELECT email.*
            FROM organization_has_email
            LEFT JOIN email ON email.id = organization_has_email.email_id
                  WHERE organization_has_email.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasEvent($organization_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM event_has_organization
            LEFT JOIN `event` ON `event`.id = event_has_organization.event_id
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE event_has_organization.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasObjectOrganization($organization_id){
        $query = "     SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency   ,
			relation_type.name AS relation_type
            FROM  objects_relation
            LEFT JOIN organization ON (objects_relation.first_object_id = organization.id AND objects_relation.first_object_type = 'organization' AND objects_relation.second_obejct_type = 'organization' AND objects_relation.second_object_id = '$organization_id' )
				OR (objects_relation.second_object_id = organization.id AND objects_relation.second_obejct_type = 'organization' AND objects_relation.first_object_type = 'organization' AND objects_relation.first_object_id = '$organization_id' )
            LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id

            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id

                  WHERE (objects_relation.second_object_id = '$organization_id' AND objects_relation.first_object_type = 'organization' AND objects_relation.second_obejct_type = 'organization')
				OR (objects_relation.first_object_id = '$organization_id' AND objects_relation.second_obejct_type = 'organization' AND objects_relation.first_object_type = 'organization') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasObjectMan($organization_id){
        $query = "  SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource , relation_type.name AS relation_type,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                  (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year

                  FROM  objects_relation
                  LEFT JOIN man ON (objects_relation.first_object_id = man.id AND objects_relation.first_object_type = 'man' AND objects_relation.second_obejct_type = 'organization' AND objects_relation.second_object_id = '$organization_id' )
                          OR (objects_relation.second_object_id = man.id AND objects_relation.second_obejct_type = 'man' AND objects_relation.first_object_type = 'organization' AND objects_relation.first_object_id = '$organization_id' )
                  LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id

                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id

                   WHERE (objects_relation.second_object_id = '$organization_id' AND objects_relation.first_object_type = 'man' AND objects_relation.second_obejct_type = 'organization')
		                  OR (objects_relation.first_object_id = '$organization_id' AND objects_relation.second_obejct_type = 'man' AND objects_relation.first_object_type = 'organization') ";
        $this->_setSql($query);
        return $this->getAll();
    }


    public function getOrganizationAddress($organization_id){
        $query = " SELECT	address.* , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
            FROM organization
            LEFT JOIN address ON address.id = organization.address_id
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN city ON city.id = address.city_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  WHERE organization.id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasCriminalCase($organization_id){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
			          (SELECT GROUP_CONCAT(worker) FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = criminal_case.id ) AS worker ,
			          (SELECT GROUP_CONCAT(worker_post.name) FROM criminal_case_worker_post
			           LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
			           WHERE criminal_case_worker_post.criminal_case_id = criminal_case.id ) AS worker_post
            FROM criminal_case_has_organization
            LEFT JOIN criminal_case ON criminal_case.id = criminal_case_has_organization.criminal_case_id
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            LEFT JOIN worker ON worker.id = criminal_case.worker_id
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE criminal_case_has_organization.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasAction($organization_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM action_has_organization
            LEFT JOIN `action` ON `action`.id = action_has_organization.action_id
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE action_has_organization.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasWorkActivity($organization_id){
        $query = " SELECT organization_has_man.id, organization_has_man.title, organization_has_man.start_date, organization_has_man.end_date, organization_has_man.period
            FROM organization
            LEFT JOIN organization_has_man ON organization_has_man.organization_id = organization.id
                  WHERE organization.id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasWorkActivityMan($organization_id){
        $query = "  SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM organization_has_man
                  LEFT JOIN man ON man.id = organization_has_man.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE organization_has_man.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasSignal($organization_id){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                 (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,
                (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,
                (SELECT GROUP_CONCAT(check_date.date) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date
                FROM organization_checked_by_signal
                LEFT JOIN `signal` ON `signal`.id = organization_checked_by_signal.signal_id
                LEFT JOIN worker ON worker.id = `signal`.opened_worker_id
                LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id
                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  WHERE organization_checked_by_signal.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationSignal($organization_id){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                 (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,
                (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,
                (SELECT GROUP_CONCAT(check_date.date) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date
                FROM organization_passes_by_signal
                LEFT JOIN `signal` ON `signal`.id = organization_passes_by_signal.signal_id
                LEFT JOIN worker ON worker.id = `signal`.opened_worker_id
                LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id
                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  WHERE organization_passes_by_signal.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasBibliography($organization_id){
        $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name
                FROM organization_has_bibliography
                LEFT JOIN bibliography ON bibliography.id = organization_has_bibliography.bibliography_id
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                  WHERE organization_has_bibliography.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasCar($organization_id){
        $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM organization_has_car
                LEFT JOIN car ON car.id = organization_has_car.car_id
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id
                  WHERE organization_has_car.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasWeapon($organization_id){
        $query = " SELECT weapon.*
                FROM organization_has_weapon
                LEFT JOIN weapon ON weapon.id = organization_has_weapon.weapon_id
                  WHERE organization_has_weapon.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasMiaSummary($organization_id){
        $query = " SELECT mia_summary.*
                FROM organization_passes_mia_summary
                LEFT JOIN mia_summary ON mia_summary.id = organization_passes_mia_summary.mia_summary_id
                  WHERE organization_passes_mia_summary.organization_id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationEvent($organization_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM organization
            LEFT JOIN `event` ON `event`.organization_id = organization.id
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE organization.id = '$organization_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasMan($man_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man AS man_this
                  LEFT JOIN man ON man.id = man_this.knowen_man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man_this.id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManMan($man_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man.knowen_man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManAddress($man_id){
        $query = " SELECT	address.* , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
            FROM man
            LEFT JOIN address ON address.id = man.born_address_id
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN city ON city.id = address.city_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  WHERE man.id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasAddress($man_id){
        $query = " SELECT	address.* , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
            FROM man_has_address
            LEFT JOIN address ON address.id = man_has_address.address_id
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN city ON city.id = address.city_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  WHERE man_has_address.man_id = '$man_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasPhone($man_id){
        $query = " SELECT phone.* ,
            (SELECT GROUP_CONCAT(`character`.name) FROM man_has_phone
            LEFT JOIN `character` ON man_has_phone.character_id = `character`.id WHERE man_has_phone.phone_id = phone.id
            GROUP BY phone_id) AS character_man ,
            (SELECT GROUP_CONCAT(`character`.name) FROM organization_has_phone
            LEFT JOIN `character` ON organization_has_phone.character_id = `character`.id WHERE organization_has_phone.phone_id = phone.id
            GROUP BY phone_id) AS character_organization
            FROM man_has_phone
            LEFT JOIN phone ON phone.id = man_has_phone.phone_id
                  WHERE man_has_phone.man_id = '$man_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasWorkActivity($man_id){
        $query = " SELECT organization_has_man.id, organization_has_man.title, organization_has_man.start_date, organization_has_man.end_date, organization_has_man.period
            FROM man
            LEFT JOIN organization_has_man ON organization_has_man.man_id = man.id
                  WHERE man.id = '$man_id'  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasWorkActivityOrganization($man_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
            FROM organization_has_man
                  LEFT JOIN organization ON organization.id = organization_has_man.organization_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization_has_man.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasManBeanCountry($man_id){
        $query = " SELECT man_bean_country.* , country_ate.name AS country_ate, goal.name AS goal, region.name AS region, locality.name AS locality
            FROM man_bean_country
            LEFT JOIN man ON man.id = man_bean_country.man_id
            LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
            LEFT JOIN goal ON goal.id = man_bean_country.goal_id
            LEFT JOIN region ON region.id = man_bean_country.region_id
            LEFT JOIN locality ON locality.id = man_bean_country.locality_id
                  WHERE man_bean_country.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasExternalSign($man_id){
        $query = " SELECT man_external_sign_has_sign.id, man_external_sign_has_sign.sign_id, GROUP_CONCAT(sign.name) AS `name`, man_external_sign_has_sign.fixed_date, man_external_sign_has_sign.created_at
            FROM man_external_sign_has_sign
            LEFT JOIN `sign` ON `sign`.id = man_external_sign_has_sign.sign_id
                  WHERE man_external_sign_has_sign.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasExternalSignPhoto($man_id){
        $query = " SELECT man_external_sign_has_photo.id, man_external_sign_has_photo.photo_id, photo.image AS `image`,
                                    man_external_sign_has_photo.fixed_date, man_external_sign_has_photo.created_at
            FROM man_external_sign_has_photo
            LEFT JOIN photo ON photo.id = man_external_sign_has_photo.photo_id
                  WHERE man_external_sign_has_photo.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasObjectMan($man_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource , relation_type.name AS relation_type,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM  objects_relation
                  LEFT JOIN man ON (objects_relation.first_object_id = man.id AND objects_relation.first_object_type = 'man' AND objects_relation.second_obejct_type = 'man' AND objects_relation.second_object_id = '$man_id' )
                      OR (objects_relation.second_object_id = man.id AND objects_relation.second_obejct_type = 'man' AND objects_relation.first_object_type = 'man' AND objects_relation.first_object_id = '$man_id' )
                  LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE (objects_relation.second_object_id = '$man_id' AND objects_relation.first_object_type = 'man' AND objects_relation.second_obejct_type = 'man')
				      OR (objects_relation.first_object_id = '$man_id' AND objects_relation.second_obejct_type = 'man' AND objects_relation.first_object_type = 'man') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasObjectOrganization($man_id){
        $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency, relation_type.name AS relation_type
            FROM  objects_relation
            LEFT JOIN organization ON (objects_relation.first_object_id = organization.id AND objects_relation.first_object_type = 'organization' AND objects_relation.second_obejct_type = 'man' AND objects_relation.second_object_id = '$man_id' )
                    OR (objects_relation.second_object_id = organization.id AND objects_relation.second_obejct_type = 'organization' AND objects_relation.first_object_type = 'man' AND objects_relation.first_object_id = '$man_id' )

            LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
            LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE (objects_relation.second_object_id = '$man_id' AND objects_relation.first_object_type = 'organization' AND objects_relation.second_obejct_type = 'man')
		                  OR (objects_relation.first_object_id = '$man_id' AND objects_relation.second_obejct_type = 'organization' AND objects_relation.first_object_type = 'man')  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasAction($man_id){
        $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    action_qualification.name AS action_qualification,
            (SELECT GROUP_CONCAT(material_content.content) FROM action_has_material_content
            LEFT JOIN material_content ON action_has_material_content.material_content_id = material_content.id WHERE action_has_material_content.action_id = `action`.id
            GROUP BY action_id) AS material_content
            FROM action_has_man
            LEFT JOIN `action` ON `action`.id = action_has_man.action_id
            LEFT JOIN action_has_material_content ON action_has_material_content.action_id = `action`.id
            LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
            LEFT JOIN duration ON duration.id = `action`.duration_id
            LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
            LEFT JOIN terms ON terms.id = `action`.terms_id
            LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  WHERE action_has_man.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasEvent($man_id){
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
            FROM event_has_man
            LEFT JOIN `event` ON `event`.id = event_has_man.event_id
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id
                  WHERE event_has_man.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasSignal($man_id){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                 (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,
                (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,
                (SELECT GROUP_CONCAT(check_date.date) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date
                FROM signal_has_man
                LEFT JOIN `signal` ON `signal`.id = signal_has_man.signal_id
                LEFT JOIN worker ON worker.id = `signal`.opened_worker_id
                LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id
                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  WHERE signal_has_man.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManSignal($man_id){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                 (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,
                (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,
                (SELECT GROUP_CONCAT(check_date.date) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date
                FROM man_passed_by_signal
                LEFT JOIN `signal` ON `signal`.id = man_passed_by_signal.signal_id
                LEFT JOIN worker ON worker.id = `signal`.opened_worker_id
                LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id
                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  WHERE man_passed_by_signal.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasCriminalCase($man_id){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
			          (SELECT GROUP_CONCAT(worker) FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = criminal_case.id ) AS worker ,
			          (SELECT GROUP_CONCAT(worker_post.name) FROM criminal_case_worker_post
			           LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
			           WHERE criminal_case_worker_post.criminal_case_id = criminal_case.id ) AS worker_post
            FROM criminal_case_has_man
            LEFT JOIN criminal_case ON criminal_case.id = criminal_case_has_man.criminal_case_id
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            LEFT JOIN worker ON worker.id = criminal_case.worker_id
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                  WHERE criminal_case_has_man.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasMiaSummary($man_id){
        $query = " SELECT mia_summary.*
            FROM man_passes_mia_summary
            LEFT JOIN mia_summary ON mia_summary.id = man_passes_mia_summary.mia_summary_id
                  WHERE man_passes_mia_summary.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasCar($man_id){
        $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM man_has_car
                LEFT JOIN car ON car.id = man_has_car.car_id
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id
                  WHERE man_has_car.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManCar($man_id){
        $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM man_use_car
                LEFT JOIN car ON car.id = man_use_car.car_id
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id
                  WHERE man_use_car.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasWeapon($man_id){
        $query = " SELECT weapon.*
                FROM man_has_weapon
                LEFT JOIN weapon ON weapon.id = man_has_weapon.weapon_id
                  WHERE man_has_weapon.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasBibliography($man_id){
        $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name
                FROM man_has_bibliography
                LEFT JOIN bibliography ON bibliography.id = man_has_bibliography.bibliography_id
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                  WHERE man_has_bibliography.man_id = '$man_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }


    public function getExternalSignHasSignMan($sign_id){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ) AS first_name ,
                                  (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id) AS last_name ,
                                  (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS country ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(language.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS `language` ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(more_data_man.text) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(answer.text) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man_external_sign_has_sign
                  LEFT JOIN man ON man.id = man_external_sign_has_sign.man_id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  WHERE man_external_sign_has_sign.id = '$sign_id' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAgencyParent(){
        $query = "SELECT `name` FROM agency_parent";
        $this->_setSql($query);
        $data =  $this->getAll();
        $result = array();
        foreach($data as $val){
            $result[] = array('value'=>$val['name'] ,
                              'textDirection' => 'tbRl',
                              );
        }
        $result[] = array('value'=>'');
        return $result;
    }

    public function getQualifications($data){
        $query = "SELECT signal_qualification_id , signal_qualification.name AS qualification
                  FROM `signal`
                  LEFT JOIN signal_qualification ON signal_qualification.id = signal_qualification_id
                  WHERE
                  (
                    (
                      ( DATE(signal.subunit_date) >= '{$data['start_date']}' AND DATE(signal.subunit_date) <= '{$data['end_date']}')
                      OR
                      (DATE(signal.end_date) >= '{$data['start_date']}' AND DATE(signal.end_date) <= '{$data['end_date']}')
                    )
                      AND
                    (signal_qualification_id IS NOT NULL AND check_subunit_id IS NOT NULL)
                  )
                  GROUP BY signal_qualification_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getParentCount($data,$parent_id,$qualification_id){
        $query = "SELECT COUNT(parent_id) AS cc
                  FROM `signal`
                  LEFT JOIN agency ON agency.id = check_subunit_id
                  WHERE
                  (
                    (
                        ( DATE(signal.subunit_date) >= '{$data['start_date']}' AND DATE(signal.subunit_date) <= '{$data['end_date']}')
                          OR
                        (DATE(signal.end_date) >= '{$data['start_date']}' AND DATE(signal.end_date) <= '{$data['end_date']}')
                    )
                      AND
                    (signal_qualification_id = '{$qualification_id}' AND agency.parent_id = '{$parent_id}')
                  )
                  GROUP BY agency.id";
        $this->_setSql($query);
        $count =  $this->getRow();
        if(empty($count['cc'])){
            return '';
        }else{
            return $count['cc'];
        }
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