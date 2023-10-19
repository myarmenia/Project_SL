<?php

class FusionModel extends Model{
    public $opt;
    public function __construct()
    {
        parent::__construct();
        $this->opt = new AdminModel();
    }



    public function control() {
//        var_dump($_POST);die;
        $query = " SELECT control.* , unit.name AS unit, act_unit.name AS act_unit, sub_act_unit.name AS sub_act_unit, doc_category.name AS doc_category, control_result.name AS result
            FROM control
            LEFT JOIN agency AS unit ON unit.id = control.unit_id
            LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
            LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
            LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
            LEFT JOIN control_result ON control_result.id = control.result_id
		    WHERE control.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		    GROUP BY control.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    //Fusion Control
    public function fusion_control($data) {
        $this->opt->optimization_control_delete($data['id']);
        $this->opt->optimization_control_delete($data['deleted_id']);
        $query = "INSERT INTO `control` SET id='".$data['id']."' , doc_category_id='".$data['doc_category']."' , creation_date='".$data['document_data'].
                            "' , reg_num='".$data['reg_num']."' , reg_date='".$data['reg_date']."' , snb_director='".$data['snb_director']."' , snb_subdirector='".$data['snb_subdirector'].
                            "' , resolution_date='".$data['resolution_date']."' , resolution='".$data['resolution']."' , actor_name='".$data['actor_name']."' , sub_actor_name='".$data['sub_actor_name'].
                            "' , result_id='".$data['result']."' , bibliography_id='".$data['bibliography_id']."' , unit_id='".$data['unit']."' , act_unit_id='".$data['department_performer'].
                            "' , sub_act_unit_id='".$data['department_coauthors']."' ";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

    }


    public function keep_signal() {
        $query = " SELECT keep_signal.* , agency.name AS agency, unit.name AS unit, sub_unit.name AS sub_unit,pased_sub_unit.name as pased_sub_unit_name,
                       (SELECT  GROUP_CONCAT( CONCAT(worker.first_name, ' ', worker.last_name, ' ',worker_post.name)  ) FROM  keep_signal_has_worker
                    LEFT JOIN worker ON worker.id = keep_signal_has_worker.worker_id
                    LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id WHERE keep_signal_has_worker.keep_signal_id = keep_signal.id GROUP BY(keep_signal_id) ) AS worker_id
                    FROM keep_signal
                    LEFT JOIN keep_signal_has_worker ON keep_signal_has_worker.keep_signal_id = keep_signal.id
                    LEFT JOIN worker ON worker.id = keep_signal_has_worker.worker_id
                    LEFT JOIN agency ON agency.id = keep_signal.agency_id
                    LEFT JOIN agency AS unit ON unit.id = keep_signal.unit_id
                    LEFT JOIN agency AS sub_unit ON sub_unit.id = keep_signal.sub_unit_id
                    LEFT JOIN agency AS pased_sub_unit ON pased_sub_unit.id = keep_signal.pased_sub_unit
		            WHERE keep_signal.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY keep_signal.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function keep_signal_worker(){
        $query = "SELECT worker FROM keep_signal_worker WHERE keep_signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function keep_signal_worker_post(){
        $query = "SELECT worker_post.* FROM keep_signal_worker_post
                  LEFT JOIN worker_post ON worker_post.id = keep_signal_worker_post.worker_post_id
                  WHERE keep_signal_worker_post.keep_signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY worker_post.id";
        $this->_setSql($query);
        return $this->getAll();
    }

    //Fusion keep_signal
    public function fusion_keep_signal($data){
        $this->opt->optimization_keep_signal_delete($data['id']);
        $this->opt->optimization_keep_signal_delete($data['deleted_id']);
        $query = " INSERT INTO `keep_signal` SET id='".$data['id']."' , signal_id='".$data['signal_id']."' , start_date='".$data['start_date']."' ,
            end_date='".$data['end_date']."' , pass_date='".$data['pass_date']."' , pased_sub_unit='".$data['pased_sub_unit']."' , agency_id='".$data['agency']."' ,
            unit_id='".$data['unit']."' , sub_unit_id='".$data['sub_unit']."'  ";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();
        if(isset($data['worker']) && !empty($data['worker'])){
            foreach(($data['worker']) as $value ){
                $query = "INSERT INTO `keep_signal_worker` SET keep_signal_id='".$data['id']."' , worker='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }
        if(isset($data['worker_post']) && !empty($data['worker_post'])){
            foreach(($data['worker_post']) as $value ){
                $query = "INSERT INTO `keep_signal_worker_post` SET keep_signal_id='".$data['id']."' , worker_post_id ='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }
    }

//   //    //////////////////////////////////////////////////////////////////////////////////////  MAN BEEN COUNTRY

    public function man_bean_country() {
        $query = " SELECT man_bean_country.* , country_ate.name AS country_ate, goal.name AS goal, region.name AS region, locality.name AS locality
                    FROM man_bean_country
                    LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
                    LEFT JOIN goal ON goal.id = man_bean_country.goal_id
                    LEFT JOIN region ON region.id = man_bean_country.region_id
                    LEFT JOIN locality ON locality.id = man_bean_country.locality_id
		            WHERE man_bean_country.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY man_bean_country.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    //Fusion man bean country
    public function fusion_man_bean_country($data){
        $this->opt->optimization_man_bean_country_delete($data['id']);
        $this->opt->optimization_man_bean_country_delete($data['deleted_id']);

        $query = " INSERT INTO `man_bean_country` SET id='".$data['id']."' , man_id='".$data['man_id']."' , country_ate_id='".$data['country_ate']."' ,
            goal_id='".$data['goal']."' , entry_date='".$data['entry_date']."' , exit_date='".$data['exit_date']."' , region_id='".$data['region']."' ,
            locality_id='".$data['locality']."' ";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();
    }

//   //    //////////////////////////////////////////////////////////////////////////////////////  END MAN BEEN COUNTRY

//   //    //////////////////////////////////////////////////////////////////////////////////////  MAN
    public function man() {
        $query = "SELECT man.* , gender.name AS gender , nation.name AS nation , address_country_ate.name AS address_country_ate_name , address_country_ate.id AS address_country_ate_id,
                        address_region.name AS address_region_name , address_region.id AS address_region_id, address_region.country_id AS address_region_country_id ,
                        address_locality.name AS address_locality_name , address_locality.id AS address_locality_id , address_locality.country_id AS address_locality_country_id ,
                        religion.name AS religion , resource.name AS resource , CONCAT(man.start_year,'-',man.end_year) AS birth_year , bibliography_id
                  FROM man
                  LEFT JOIN gender ON gender.id = gender_id
                  LEFT JOIN nation ON nation.id = nation_id
                  LEFT JOIN religion ON religion.id = religion_id
                  LEFT JOIN resource ON resource.id = resource_id
                  LEFT JOIN address ON address.id = man.born_address_id
                  LEFT JOIN country_ate AS address_country_ate ON address_country_ate.id = address.country_ate_id
                  LEFT JOIN region AS address_region ON address_region.id = address.region_id
                  LEFT JOIN locality AS address_locality ON address_locality.id = address.locality_id
                  LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man.id
                  WHERE man.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY man.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasFirstName(){
        $query = "SELECT first_name.* FROM man_has_first_name AS man
                  LEFT JOIN first_name ON first_name.id = man.first_name_id
                  WHERE man.man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY first_name ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasLastName(){
        $query = "SELECT last_name.* FROM man_has_last_name
                  LEFT JOIN last_name ON last_name.id = last_name_id
                  WHERE man_has_last_name.man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY man_has_last_name.last_name_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasMiddleName(){
        $query = "SELECT middle_name.* FROM man_has_middle_name
                  LEFT JOIN middle_name ON middle_name.id = man_has_middle_name.middle_name_id
                  WHERE man_has_middle_name.man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY man_has_middle_name.middle_name_id ";
        $this->_setSql($query);
        return $this->getAll();
    }


    public function getManHasPassport(){
        $query = "SELECT passport.* FROM man_has_passport
                  LEFT JOIN passport ON passport.id = passport_id
                  WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY passport_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManBelongsCountry(){
        $query = "SELECT country.* FROM man_belongs_country
                  LEFT JOIN country ON country.id = country_id
                  WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY country_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManKnowsLanguage(){
        $query = "SELECT `language`.* FROM man_knows_language
                  LEFT JOIN `language` ON `language`.id = language_id
                  WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY language_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasAddress(){
        $query = "SELECT address_id,start_date,end_date FROM man_has_address WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY address_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasPhone(){
        $query = "SELECT man_has_phone.phone_id,man_has_phone.character_id,character.name,phone.number FROM man_has_phone
                    LEFT JOIN `phone` ON `phone`.id = man_has_phone.phone_id
                    LEFT JOIN `character` ON `character`.id = man_has_phone.character_id
                    WHERE man_has_phone.man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY man_has_phone.phone_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasEmail(){
        $query = "SELECT man_has_email.email_id,email.address FROM man_has_email
                    LEFT JOIN `email` ON `email`.id = man_has_email.email_id
                    WHERE man_has_email.man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY man_has_email.email_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getMoreDataMan(){
        $query = "SELECT id ,text FROM more_data_man WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getMoreDataMan_full($id){
        $query = "SELECT text FROM more_data_man WHERE id ='".$id."'
                  GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasOperationCategory(){
        $query = "SELECT operation_category.* FROM man_has_operation_category
                  LEFT JOIN operation_category ON operation_category.id = operation_category_id
                  WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY operation_category_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCountrySearchMan(){
        $query = "SELECT country.* FROM country_search_man
                  LEFT JOIN country ON country.id = country_id
                  WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY country_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasEducation(){
        $query = "SELECT education.* FROM man_has_education
                  LEFT JOIN education ON education.id = education_id
                  WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY education_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasParty(){
        $query = "SELECT party.* FROM man_has_party
                  LEFT JOIN party ON party.id = party_id
                  WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY party_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasWorkActivity(){
        $query = "SELECT id AS work_activity_id,organization_id,title,start_date,end_date,period FROM organization_has_man
                    WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY organization_has_man.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManBeanCountry(){
        $query = "SELECT id AS man_bean_country_id,country_ate_id,goal_id,entry_date,exit_date,region_id,locality_id FROM man_bean_country WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManExternalSignHasSign(){
        $query = "SELECT
        man_external_sign_has_sign.sign_id,
        sign.name,
        man_external_sign_has_sign.fixed_date
        FROM man_external_sign_has_sign
                    LEFT JOIN `sign` ON sign.id = man_external_sign_has_sign.sign_id
                    WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY man_external_sign_has_sign.sign_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManExternalSignHasPhoto(){
        $query = "SELECT man_photo.photo_id , man_photo.fixed_date, photo.image FROM man_external_sign_has_photo AS man_photo
                    LEFT JOIN photo ON photo.id = man_photo.photo_id
                    WHERE man_photo.man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY man_photo.photo_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasNickname(){
        $query = "SELECT nickname.* FROM man_has_nickname
                  LEFT JOIN nickname ON nickname.id = nickname_id
                  WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY nickname.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasObjectsOrganization(){
        $query = "SELECT id,relation_type_id,first_object_id,second_object_id,first_object_type,second_obejct_type FROM objects_relation WHERE ( first_object_type = 'organization' AND second_obejct_type = 'man' AND second_object_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') )
        OR ( second_obejct_type = 'organization' AND first_object_type = 'man' AND first_object_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') ) GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasObjectsMan(){
        $query = "SELECT id,relation_type_id,first_object_id,second_object_id,first_object_type,second_obejct_type FROM objects_relation WHERE (first_object_type = 'man' AND second_obejct_type = 'man' AND second_object_id IN  ( '".$_POST['id1']."', '".$_POST['id2']."') )
                    OR(second_obejct_type = 'man' AND first_object_type = 'man' AND first_object_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') )  GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasAction(){
        $query = "SELECT action_id FROM action_has_man WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY action_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasEvent(){
        $query = "SELECT event_id FROM event_has_man WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY event_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManPassedBySignal(){
        $query = "SELECT signal_id FROM man_passed_by_signal WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY signal_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManCheckedBySignal(){
        $query = "SELECT signal_id FROM signal_has_man WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY signal_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasCriminalCase(){
        $query = "SELECT criminal_case_id FROM criminal_case_has_man WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY criminal_case_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManPassesMiaSummary(){
        $query = "SELECT mia_summary_id FROM man_passes_mia_summary WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY mia_summary_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasCar(){
        $query = "SELECT car_id FROM man_has_car WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY car_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasWeapon(){
        $query = "SELECT weapon_id FROM man_has_weapon WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY weapon_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManUseCar(){
        $query = "SELECT car_id FROM man_use_car WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY car_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasAnswer(){
        $query = "SELECT id,text FROM answer WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasAnswer_full($id){
        $query = "SELECT text  FROM answer WHERE id ='".$id."'
                  GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManToMan(){
        $query = "(SELECT man_id2 AS man_id FROM man_to_man WHERE man_id1 = '".$_POST['id1']."' AND man_id2 != '".$_POST['id2']."' AND man_id2 != '".$_POST['id1']."')
                  UNION
                  (SELECT man_id1 AS man_id FROM man_to_man WHERE man_id2 = '".$_POST['id1']."' AND man_id1 != '".$_POST['id2']."' AND man_id1 != '".$_POST['id1']."')
                  UNION
                  (SELECT man_id2 AS man_id FROM man_to_man WHERE man_id1 = '".$_POST['id2']."' AND man_id2 != '".$_POST['id1']."' AND man_id2 != '".$_POST['id2']."')
                  UNION
                  (SELECT man_id1 AS man_id FROM man_to_man WHERE man_id2 = '".$_POST['id2']."' AND man_id1 != '".$_POST['id1']."' AND man_id1 != '".$_POST['id2']."')
                  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasFile(){
        $query = "SELECT file.* FROM man_has_file
                  LEFT JOIN file ON file.id = man_has_file.file_id
                  WHERE man_has_file.man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY file.id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getManHasBibliography(){
        $query = "SELECT bibliography_id FROM man_has_bibliography WHERE man_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') GROUP BY bibliography_id ";
        $this->_setSql($query);
        return $this->getAll();
    }


    public function fusion_man($data) {

//        var_dump($data);die;
        $this->opt->optimization_man_delete($data['id']);
        $this->opt->optimization_man_delete($data['deleted_id']);

        $query = " INSERT INTO `man` SET id='".$data['id']."' , gender_id='".$data['gender_id']."' , nation_id='".$data['nation_id']."' ,
            born_address_id='".$data['born_address_id']."' , birthday='".$data['birthday']."' , start_year='".$data['start_year']."' ,
            end_year='".$data['end_year']."' , attention='".$data['attention']."' , religion_id='".$data['religion_id']."' ,
            occupation='".$data['occupation']."' , opened_dou='".$data['opened_dou']."' , start_wanted='".$data['start_wanted']."' ,
            entry_date='".$data['entry_date']."' , exit_date='".$data['exit_date']."' , fixing_moment='".$data['fixing_moment']."' , resource_id='".$data['resource_id']."'";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

        //getManHasFirstName
        if(isset($data['getManHasFirstName']) && !empty($data['getManHasFirstName'])) {
            foreach(($data['getManHasFirstName']) as $value ){
                $query = "INSERT INTO `man_has_first_name` SET man_id='".$data['id']."' , first_name_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManToMan
        if(isset($data['getManToMan']) && !empty($data['getManToMan'])) {
            foreach(($data['getManToMan']) as $value ){
                $query = "INSERT INTO `man_to_man` SET man_id1='".$data['id']."' , man_id2='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasLastName
        if(isset($data['getManHasLastName']) && !empty($data['getManHasLastName'])) {
            foreach(($data['getManHasLastName']) as $value ){
                $query = "INSERT INTO `man_has_last_name` SET man_id='".$data['id']."' , last_name_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasMiddleName
        if(isset($data['getManHasMiddleName']) && !empty($data['getManHasMiddleName'])) {
            foreach(($data['getManHasMiddleName']) as $value ){
                $query = "INSERT INTO `man_has_middle_name` SET man_id='".$data['id']."' , middle_name_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasPassport
        if(isset($data['getManHasPassport']) && !empty($data['getManHasPassport'])) {
            foreach(($data['getManHasPassport']) as $value ){
                $query = "INSERT INTO `man_has_passport` SET man_id='".$data['id']."' , passport_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManBelongsCountry
        if(isset($data['getManBelongsCountry']) && !empty($data['getManBelongsCountry'])) {
            foreach(($data['getManBelongsCountry']) as $value ){
                $query = "INSERT INTO `man_belongs_country` SET man_id='".$data['id']."' , country_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManKnowsLanguage
        if(isset($data['getManKnowsLanguage']) && !empty($data['getManKnowsLanguage'])) {
            foreach(($data['getManKnowsLanguage']) as $value ){
                $query = "INSERT INTO `man_knows_language` SET man_id='".$data['id']."' , language_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasAddress
        if(isset($data['getManHasAddress']) && !empty($data['getManHasAddress'])) {
            foreach(($data['getManHasAddress']) as $value ){
                $query = "INSERT INTO `man_has_address` SET man_id='".$data['id']."' , address_id='".$value[0]."' , start_date='".$value[1]."' , end_date='".$value[2]."'";
                $query = str_replace("''","NULL",$query);
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasPhone
        if(isset($data['getManHasPhone']) && !empty($data['getManHasPhone'])) {
            foreach(($data['getManHasPhone']) as $value ){
                $query = "INSERT INTO `man_has_phone` SET man_id='".$data['id']."' , phone_id='".$value[0]."' , character_id='".$value[1]."'";
                $query = str_replace("''","NULL",$query);
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasEmail
        if(isset($data['getManHasEmail']) && !empty($data['getManHasEmail'])) {
            foreach(($data['getManHasEmail']) as $value ){
                $query = "INSERT INTO `man_has_email` SET man_id='".$data['id']."' , email_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getMoreDataMan
        if(isset($data['getMoreDataMan']) && !empty($data['getMoreDataMan'])) {
            foreach(($data['getMoreDataMan']) as $value ){
                $query = "INSERT INTO `more_data_man` SET man_id='".$data['id']."' , text='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasOperationCategory
        if(isset($data['getManHasOperationCategory']) && !empty($data['getManHasOperationCategory'])) {
            foreach(($data['getManHasOperationCategory']) as $value ){
                $query = "INSERT INTO `man_has_operation_category` SET man_id='".$data['id']."' , operation_category_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getCountrySearchMan
        if(isset($data['getCountrySearchMan']) && !empty($data['getCountrySearchMan'])) {
            foreach(($data['getCountrySearchMan']) as $value ){
                $query = "INSERT INTO `country_search_man` SET man_id='".$data['id']."' , country_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasEducation
        if(isset($data['getManHasEducation']) && !empty($data['getManHasEducation'])) {
            foreach(($data['getManHasEducation']) as $value ){
                $query = "INSERT INTO `man_has_education` SET man_id='".$data['id']."' , education_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasParty
        if(isset($data['getManHasParty']) && !empty($data['getManHasParty'])) {
            foreach(($data['getManHasParty']) as $value ){
                $query = "INSERT INTO `man_has_party` SET man_id='".$data['id']."' , party_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasWorkActivity
        if(isset($data['getManHasWorkActivity']) && !empty($data['getManHasWorkActivity'])) {
            foreach(($data['getManHasWorkActivity']) as $value ){
                $query = "INSERT INTO `organization_has_man` SET man_id='".$data['id']."' , organization_id='".$value[1]."' , title='".$value[2]."' , start_date='".$value[3]."' , end_date='".$value[4]."' , period='".$value[5]."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManBeanCountry
//        var_dump($data['getManBeanCountry']);die;
        if(isset($data['getManBeanCountry']) && !empty($data['getManBeanCountry'])) {
            foreach(($data['getManBeanCountry']) as $value ){
                $query = "INSERT INTO `man_bean_country` SET man_id='".$data['id']."' ,
                country_ate_id='".$value[1]."' ,
                goal_id='".$value[2]."' ,
                entry_date='".$value[3]."' ,
                exit_date='".$value[4]."' ,
                region_id='".$value[5]."' ,
                locality_id='".$value[6]."' ";
                $query = str_replace("''","NULL",$query);
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManExternalSignHasSign
        if(isset($data['getManExternalSignHasSign']) && !empty($data['getManExternalSignHasSign'])) {
            foreach(($data['getManExternalSignHasSign']) as $value ){
                $query = "INSERT INTO `man_external_sign_has_sign` SET man_id='".$data['id']."' , sign_id='".$value[0]."' , fixed_date='".$value[1]."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManExternalSignHasPhoto
        if(isset($data['getManExternalSignHasPhoto']) && !empty($data['getManExternalSignHasPhoto'])) {
            foreach(($data['getManExternalSignHasPhoto']) as $value ){
                $query = "INSERT INTO `man_external_sign_has_photo` SET man_id='".$data['id']."' , photo_id='".$value[0]."' , fixed_date='".$value[1]."' ";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasNickname
        if(isset($data['getManHasNickname']) && !empty($data['getManHasNickname'])) {
            foreach(($data['getManHasNickname']) as $value ){
                $query = "INSERT INTO `man_has_nickname` SET man_id='".$data['id']."' , nickname_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasObjectsOrganization
        if(isset($data['getManHasObjectsOrganization']) && !empty($data['getManHasObjectsOrganization'])) {
            foreach(($data['getManHasObjectsOrganization']) as $value ){
                $query = "INSERT INTO `objects_relation` SET
                first_object_id='".$data['id']."' ,
                relation_type_id='".$value[1]."' ,
                second_object_id='".$value[2]."' ,
                first_object_type='man' ,
                second_obejct_type='organization' ";
                $query = str_replace("''","NULL",$query);
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasObjectsMan
        if(isset($data['getManHasObjectsMan']) && !empty($data['getManHasObjectsMan'])) {
            foreach(($data['getManHasObjectsMan']) as $value ){
                $query = "INSERT INTO `objects_relation` SET
                first_object_id='".$data['id']."' ,
                relation_type_id='".$value[1]."' ,
                second_object_id='".$value[2]."' ,
                first_object_type='man' ,
                second_obejct_type='man' ";
                $query = str_replace("''","NULL",$query);
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasAction
        if(isset($data['getManHasAction']) && !empty($data['getManHasAction'])) {
            foreach(($data['getManHasAction']) as $value ){
                $query = "INSERT INTO `action_has_man` SET man_id='".$data['id']."' , action_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasEvent
        if(isset($data['getManHasEvent']) && !empty($data['getManHasEvent'])) {
            foreach(($data['getManHasEvent']) as $value ){
                $query = "INSERT INTO `event_has_man` SET man_id='".$data['id']."' , event_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManPassedBySignal
        if(isset($data['getManPassedBySignal']) && !empty($data['getManPassedBySignal'])) {
            foreach(($data['getManPassedBySignal']) as $value ){
                $query = "INSERT INTO `man_passed_by_signal` SET man_id='".$data['id']."' , signal_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManCheckedBySignal
        if(isset($data['getManCheckedBySignal']) && !empty($data['getManCheckedBySignal'])) {
            foreach(($data['getManCheckedBySignal']) as $value ){
                $query = "INSERT INTO `signal_has_man` SET man_id='".$data['id']."' , signal_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasCriminalCase
        if(isset($data['getManHasCriminalCase']) && !empty($data['getManHasCriminalCase'])) {
            foreach(($data['getManHasCriminalCase']) as $value ){
                $query = "INSERT INTO `criminal_case_has_man` SET man_id='".$data['id']."' , criminal_case_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManPassesMiaSummary
        if(isset($data['getManPassesMiaSummary']) && !empty($data['getManPassesMiaSummary'])) {
            foreach(($data['getManPassesMiaSummary']) as $value ){
                $query = "INSERT INTO `man_passes_mia_summary` SET man_id='".$data['id']."' , mia_summary_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasCar
        if(isset($data['getManHasCar']) && !empty($data['getManHasCar'])) {
            foreach(($data['getManHasCar']) as $value ){
                $query = "INSERT INTO `man_has_car` SET man_id='".$data['id']."' , car_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasWeapon
        if(isset($data['getManHasWeapon']) && !empty($data['getManHasWeapon'])) {
            foreach(($data['getManHasWeapon']) as $value ){
                $query = "INSERT INTO `man_has_weapon` SET man_id='".$data['id']."' , weapon_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManUseCar
        if(isset($data['getManUseCar']) && !empty($data['getManUseCar'])) {
            foreach(($data['getManUseCar']) as $value ){
                $query = "INSERT INTO `man_use_car` SET man_id='".$data['id']."' , car_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasFile
        if(isset($data['getManHasFile']) && !empty($data['getManHasFile'])) {
            foreach(($data['getManHasFile']) as $value ){
                $query = "INSERT INTO `man_has_file` SET man_id='".$data['id']."' , file_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasBibliography
        if(isset($data['getManHasBibliography']) && !empty($data['getManHasBibliography'])) {
            foreach(($data['getManHasBibliography']) as $value ){
                $query = "INSERT INTO `man_has_bibliography` SET man_id='".$data['id']."' , bibliography_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

    }


//    ----------------------------------------------------    END MAN         --------------------------------------------------------------------------

//------------------------------------------------------------ORGANIZATION ---------------------------------------------------------------------------

    public function organization() {
        $query = "SELECT organization.* , organization_category.name AS organization_category , country.name AS country, country_ate.name AS country_ate, agency.name AS agency
                  FROM organization
                  LEFT JOIN organization_category ON organization_category.id = organization.category_id
                  LEFT JOIN country ON country.id = organization.country_id
                  LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
                  LEFT JOIN agency ON agency.id = organization.agency_id
                  WHERE organization.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY organization.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasAddress(){
        $query = "SELECT address_id,start_date,end_date FROM organization_has_address WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY address_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasPhone(){
        $query = "SELECT organization_has_phone.phone_id,organization_has_phone.character_id,phone.number FROM organization_has_phone
                    LEFT JOIN phone ON phone.id = organization_has_phone.phone_id
                    WHERE organization_has_phone.organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY organization_has_phone.phone_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasEmail(){
        $query = "SELECT organization_has_email.email_id,email.address FROM organization_has_email
                    LEFT JOIN email ON email.id = organization_has_email.email_id
                    WHERE organization_has_email.organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY organization_has_email.email_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasEvent(){
        $query = "SELECT event_id FROM event_has_organization WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY event_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationObjectsRelation(){
        $query = "SELECT objects_relation.*  FROM objects_relation WHERE  ( second_object_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') AND first_object_type = 'organization' AND second_obejct_type = 'organization' )
        OR (first_object_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') AND first_object_type = 'organization' AND second_obejct_type = 'organization') GROUP BY id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasCriminalCase(){
        $query = "SELECT criminal_case_id FROM criminal_case_has_organization WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY criminal_case_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasAction(){
        $query = "SELECT action_id FROM action_has_organization WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY action_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasMan(){
        $query = "SELECT id,man_id,title,start_date,end_date,period FROM organization_has_man WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationCheckedBySignal(){
        $query = "SELECT signal_id FROM organization_checked_by_signal WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY signal_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationPassesBySignal(){
        $query = "SELECT signal_id FROM organization_passes_by_signal WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY signal_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasCar(){
        $query = "SELECT car_id FROM organization_has_car WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY car_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasWeapon(){
        $query = "SELECT weapon_id FROM organization_has_weapon WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY weapon_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationHasMiaSummary(){
        $query = "SELECT mia_summary_id FROM organization_passes_mia_summary WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY mia_summary_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationEvent(){
        $query = "SELECT event.id  FROM `event` WHERE event.organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getOrganizationToOrganization(){
        $query = "(SELECT organization_id2 AS organization_id FROM organization_to_organization WHERE organization_id1 = '".$_POST['id1']."' AND organization_id2 != '".$_POST['id2']."' AND organization_id2 != '".$_POST['id1']."' )
                  UNION
                  (SELECT organization_id1 AS organization_id FROM organization_to_organization WHERE organization_id1 != '".$_POST['id2']."' AND organization_id1 != '".$_POST['id1']."' AND organization_id2 = '".$_POST['id2']."' )
                  UNION
                  (SELECT organization_id2 AS organization_id FROM organization_to_organization WHERE organization_id1 = '".$_POST['id2']."' AND organization_id2 != '".$_POST['id1']."' AND organization_id2 != '".$_POST['id2']."' )
                  UNION
                  (SELECT organization_id1 AS organization_id FROM organization_to_organization WHERE organization_id1 != '".$_POST['id1']."' AND organization_id1 != '".$_POST['id2']."' AND organization_id2 = '".$_POST['id1']."' )
                  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_organization($data) {
//        print_r($data);die;
        $this->opt->optimization_organization_delete($data['id']);
        $this->opt->optimization_organization_delete($data['deleted_id']);

        $query = " INSERT INTO `organization` SET id='".$data['id']."' , country_id='".$data['country_id']."' , name='".$data['name']."' ,
            reg_date='".$data['reg_date']."' , address_id='".$data['address_id']."' , category_id='".$data['category_id']."' ,
            employers_count='".$data['employers_count']."' , attension='".$data['attension']."' , opened_dou='".$data['opened_dou']."' ,
            country_ate_id='".$data['country_ate_id']."' , agency_id='".$data['agency_id']."'";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

        //getOrganizationHasAddress
        if(isset($data['getOrganizationHasAddress']) && !empty($data['getOrganizationHasAddress'])) {
            foreach(($data['getOrganizationHasAddress']) as $value ){
                $query = "INSERT INTO `organization_has_address` SET organization_id='".$data['id']."' , address_id='".$value[0]."' , start_date='".$value[1]."' , end_date='".$value[2]."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationHasAddress
        if(isset($data['getOrganizationToOrganization']) && !empty($data['getOrganizationToOrganization'])) {
            foreach(($data['getOrganizationToOrganization']) as $value ){
                $query = "INSERT INTO `organization_to_organization` SET organization_id1='".$data['id']."' , organization_id2='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationHasPhone
        if(isset($data['getOrganizationHasPhone']) && !empty($data['getOrganizationHasPhone'])) {
            foreach(($data['getOrganizationHasPhone']) as $value ){
                $query = "INSERT INTO `organization_has_phone` SET organization_id='".$data['id']."' , phone_id='".$value[0]."', character_id='".$value[1]."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationHasEmail
        if(isset($data['getOrganizationHasEmail']) && !empty($data['getOrganizationHasEmail'])) {
            foreach(($data['getOrganizationHasEmail']) as $value ){
                $query = "INSERT INTO `organization_has_email` SET organization_id='".$data['id']."' , email_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationHasEvent
        if(isset($data['getOrganizationHasEvent']) && !empty($data['getOrganizationHasEvent'])) {
            foreach(($data['getOrganizationHasEvent']) as $value ){
                $query = "UPDATE  `event_has_organization` SET organization_id='".$data['id']."' WHERE event_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationObjectsRelation
        if(isset($data['getOrganizationObjectsRelation']) && !empty($data['getOrganizationObjectsRelation'])) {
            foreach(($data['getOrganizationObjectsRelation']) as $value ){
                $query = "INSERT INTO `objects_relation` SET first_object_id='".$data['id']."' , relation_type_id='".$value[1]."' , second_object_id='".$value[2]."' , first_object_type='organization' , second_obejct_type='organization' ";
                $query = str_replace("''",'NULL',$query);
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationHasCriminalCase
        if(isset($data['getOrganizationHasCriminalCase']) && !empty($data['getOrganizationHasCriminalCase'])) {
            foreach(($data['getOrganizationHasCriminalCase']) as $value ){
                $query = "INSERT INTO `criminal_case_has_organization` SET organization_id='".$data['id']."' , criminal_case_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationHasAction
        if(isset($data['getOrganizationHasAction']) && !empty($data['getOrganizationHasAction'])) {
            foreach(($data['getOrganizationHasAction']) as $value ){
                $query = "INSERT INTO `action_has_organization` SET organization_id='".$data['id']."' , action_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationHasMan
        if(isset($data['getOrganizationHasMan']) && !empty($data['getOrganizationHasMan'])) {
            foreach(($data['getOrganizationHasMan']) as $value ){
                $query = "INSERT INTO `organization_has_man` SET organization_id='".$data['id']."' , man_id='".$value[1]."' , title='".$value[2]."' , start_date='".$value[3]."' , end_date='".$value[4]."' , period='".$value[5]."'";                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationCheckedBySignal
        if(isset($data['getOrganizationCheckedBySignal']) && !empty($data['getOrganizationCheckedBySignal'])) {
            foreach(($data['getOrganizationCheckedBySignal']) as $value ){
                $query = "INSERT INTO `organization_checked_by_signal` SET organization_id='".$data['id']."' , signal_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationPassesBySignal
        if(isset($data['getOrganizationPassesBySignal']) && !empty($data['getOrganizationPassesBySignal'])) {
            foreach(($data['getOrganizationPassesBySignal']) as $value ){
                $query = "INSERT INTO `organization_passes_by_signal` SET organization_id='".$data['id']."' , signal_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationHasCar
        if(isset($data['getOrganizationHasCar']) && !empty($data['getOrganizationHasCar'])) {
            foreach(($data['getOrganizationHasCar']) as $value ){
                $query = "INSERT INTO `organization_has_car` SET organization_id='".$data['id']."' , car_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationHasWeapon
        if(isset($data['getOrganizationHasWeapon']) && !empty($data['getOrganizationHasWeapon'])) {
            foreach(($data['getOrganizationHasWeapon']) as $value ){
                $query = "INSERT INTO `organization_has_weapon` SET organization_id='".$data['id']."' , weapon_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getOrganizationHasMiaSummary
        if(isset($data['getOrganizationHasMiaSummary']) && !empty($data['getOrganizationHasMiaSummary'])) {
            foreach(($data['getOrganizationHasMiaSummary']) as $value ){
                $query = "INSERT INTO `organization_passes_mia_summary` SET organization_id='".$data['id']."' , mia_summary_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getManHasParty
        if(isset($data['getOrganizationEvent']) && !empty($data['getOrganizationEvent'])) {
            foreach(($data['getOrganizationEvent']) as $value ){
                $query = " UPDATE `event` SET organization_id ='".$data['id']."' WHERE event.id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getBibliography
        if(isset($data['getBibliography']) && !empty($data['getBibliography'])) {
            foreach(($data['getBibliography']) as $value ){
                $query = "INSERT INTO `organization_has_bibliography` SET organization_id ='".$data['id']."' , bibliography_id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }


    }




//------------------------------------------------------------END   ORGANIZATION ---------------------------------------------------------------------------
//------------------------------------------------------------   BIBLIOGRAPHY ---------------------------------------------------------------------------
    public function bibliography() {
        $query = "SELECT bibliography.* , source_agency.name AS source_agency , from_agency.name AS from_agency , doc_category.name AS doc_category,
                        access_level.name AS access_level , country.name AS country , CONCAT(users.first_name,' ',users.last_name ) as user_name
                  FROM bibliography
                  LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                  LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                  LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                  LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                  LEFT JOIN country ON country.id = bibliography.country_id
                  LEFT JOIN users ON users.id = bibliography.user_id
                  WHERE bibliography.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY bibliography.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasMan() {
        $query = "SELECT 'man' AS tb_name , man_id AS id FROM man_has_bibliography
                    WHERE bibliography_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY man_has_bibliography.man_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasOrganization() {
        $query = "SELECT 'organization' AS tb_name , organization_id AS id FROM organization_has_bibliography
                    WHERE bibliography_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY organization_has_bibliography.organization_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyOrganization(){
        $query = "SELECT 'bibliography' AS tb_name , bibliography_id AS id FROM organization_has_bibliography
                    WHERE organization_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY organization_has_bibliography.bibliography_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasEvent() {
        $query = "SELECT 'event' AS tb_name , `event`.id AS id FROM `event`
                    WHERE `event`.bibliography_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY event.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasSignal() {
        $query = "SELECT 'signal' AS tb_name , `signal`.id AS id FROM `signal`
                    WHERE `signal`.bibliography_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY signal.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasCriminalCase() {
        $query = "SELECT 'criminal_case' AS tb_name , criminal_case.id AS id FROM criminal_case
                    WHERE criminal_case.bibliography_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY criminal_case.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasAction() {
        $query = "SELECT 'action' AS tb_name , `action`.id AS id FROM `action`
                    WHERE `action`.bibliography_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY action.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasControl() {
        $query = "SELECT 'control' AS tb_name , control.id AS id FROM control
                    WHERE control.bibliography_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY control.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasMiaSummary() {
        $query = "SELECT 'mia_summary' AS tb_name, mia_summary.id AS id FROM mia_summary
                    WHERE mia_summary.bibliography_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY mia_summary.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasCountry(){
        $query = "SELECT country.* FROM bibliography_has_country
                  LEFT JOIN country ON country.id = bibliography_has_country.country_id
                  WHERE bibliography_has_country.bibliography_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY country_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliographyHasFile(){
        $query = "SELECT file.* FROM bibliography_has_file
                  LEFT JOIN file ON file.id = bibliography_has_file.file_id
                  WHERE bibliography_has_file.bibliography_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY file.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_bibliography($data) {
        $this->opt->optimization_bibliography_delete($data['id']);
        $this->opt->optimization_bibliography_delete($data['deleted_id']);

        $query = " INSERT INTO `bibliography` SET id='".$data['id']."' , user_id='".$data['user_id']."' , category_id='".$data['category_id']."' ,
            access_level_id='".$data['access_level_id']."' , source_agency_id='".$data['source_agency_id']."' , from_agency_id='".$data['from_agency_id']."' , source='".$data['source']."' ,
            short_desc='".$data['short_desc']."' , related_year='".$data['related_year']."' , country_id='".$data['country_id']."' , theme='".$data['theme']."' ,
            source_address='".$data['source_address']."' , worker_name='".$data['worker_name']."' , reg_number='".$data['reg_number']."' , reg_date='".$data['reg_date']."'";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

        //getBibliographyHasCountry
        if(isset($data['getBibliographyHasCountry']) && !empty($data['getBibliographyHasCountry'])) {
            foreach(($data['getBibliographyHasCountry']) as $value ){
                $query = "INSERT INTO `bibliography_has_country` SET bibliography_id='".$data['id']."' , country_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getBibliographyHasMan
        if(isset($data['getBibliographyHasMan']) && !empty($data['getBibliographyHasMan'])) {
            foreach(($data['getBibliographyHasMan']) as $value ){
                $query = "INSERT INTO `man_has_bibliography` SET bibliography_id='".$data['id']."' , man_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getBibliographyHasOrganization
        if(isset($data['getBibliographyHasOrganization']) && !empty($data['getBibliographyHasOrganization'])) {
            foreach(($data['getBibliographyHasOrganization']) as $value ){
                $query = "INSERT INTO `organization_has_bibliography` SET bibliography_id='".$data['id']."' , organization_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getBibliographyHasEvent
        if(isset($data['getBibliographyHasEvent']) && !empty($data['getBibliographyHasEvent'])) {
            foreach(($data['getBibliographyHasEvent']) as $value ){
                $query = " UPDATE `event` SET bibliography_id ='".$data['id']."' WHERE event.id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getBibliographyHasSignal
        if(isset($data['getBibliographyHasSignal']) && !empty($data['getBibliographyHasSignal'])) {
            foreach(($data['getBibliographyHasSignal']) as $value ){
                $query = " UPDATE `signal` SET bibliography_id ='".$data['id']."' WHERE signal.id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getBibliographyHasCriminalCase
        if(isset($data['getBibliographyHasCriminalCase']) && !empty($data['getBibliographyHasCriminalCase'])) {
            foreach(($data['getBibliographyHasCriminalCase']) as $value ){
                $query = " UPDATE `criminal_case` SET bibliography_id ='".$data['id']."' WHERE criminal_case.id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getBibliographyHasAction
        if(isset($data['getBibliographyHasAction']) && !empty($data['getBibliographyHasAction'])) {
            foreach(($data['getBibliographyHasAction']) as $value ){
                $query = " UPDATE `action` SET bibliography_id ='".$data['id']."' WHERE action.id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getBibliographyHasControl
        if(isset($data['getBibliographyHasControl']) && !empty($data['getBibliographyHasControl'])) {
            foreach(($data['getBibliographyHasControl']) as $value ){
                $query = " UPDATE `control` SET bibliography_id ='".$data['id']."' WHERE control.id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getBibliographyHasMiaSummary
        if(isset($data['getBibliographyHasMiaSummary']) && !empty($data['getBibliographyHasMiaSummary'])) {
            foreach(($data['getBibliographyHasMiaSummary']) as $value ){
                $query = " UPDATE `mia_summary` SET bibliography_id ='".$data['id']."' WHERE mia_summary.id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getBibliographyHasMiaSummary
        if(isset($data['getBibliographyHasFile']) && !empty($data['getBibliographyHasFile'])) {
            foreach(($data['getBibliographyHasFile']) as $value ){
                $query = "INSERT INTO `bibliography_has_file` SET bibliography_id='".$data['id']."' , file_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }


    }



//------------------------------------------------------------END   BIBLIOGRAPHY ---------------------------------------------------------------------------


// ----------------------------------------------------------   EVENTS----------------------------------------------------------------------------------

    public function event() {
        $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource
                    FROM `event`
                    LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
                    LEFT JOIN agency ON agency.id = event.agency_id
                    LEFT JOIN resource ON resource.id = event.resource_id
		            WHERE event.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY event.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasQualification(){
        $query = "SELECT event_qualification.*,event_has_qualification.event_id FROM event_has_qualification
                  LEFT JOIN event_qualification ON event_qualification.id = event_has_qualification.qualification_id
                  WHERE event_has_qualification.event_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY event_has_qualification.qualification_id
                  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasAction(){
        $query = "SELECT action_id FROM event_has_action WHERE event_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY action_id
        ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasSignal(){
        $query = "SELECT signal_id FROM event_passes_signal WHERE event_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY signal_id
        ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEvenActionHasEvent(){
        $query = "SELECT action_id FROM action_has_event WHERE event_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY action_id
        ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasCar(){
        $query = "SELECT car_id FROM event_has_car WHERE event_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY car_id
        ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasWeapon(){
        $query = "SELECT weapon_id FROM event_has_weapon WHERE event_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY weapon_id
        ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasOrganization(){
        $query = "SELECT organization_id FROM event_has_organization WHERE event_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY organization_id
        ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasMan(){
        $query = "SELECT man_id FROM event_has_man WHERE event_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY man_id
        ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getEventHasCriminalCase(){
        $query = "SELECT criminal_case_id FROM event_has_criminal_case WHERE event_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') GROUP BY criminal_case_id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_event($data) {
        $this->opt->optimization_event_delete($data['id']);
        $this->opt->optimization_event_delete($data['deleted_id']);
        $query = " INSERT INTO `event` SET id='".$data['id']."' , bibliography_id='".$data['bibliography_id']."' , date='".$data['date']."' ,
            address_id='".$data['address_id']."' , organization_id='".$data['organization_id']."' , aftermath_id='".$data['aftermath']."' ,
            resource_id='".$data['resource']."' , agency_id='".$data['agency']."' , result='".$data['result']."'";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

        //event_has_qualification
        if(isset($data['event_qualification']) && !empty($data['event_qualification'])) {
            foreach(($data['event_qualification']) as $value ){
                $query = "INSERT INTO `event_has_qualification` SET event_id='".$data['id']."' , qualification_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getEventHasCriminalCase
        if(isset($data['getEventHasCriminalCase']) && !empty($data['getEventHasCriminalCase'])) {
            foreach(($data['getEventHasCriminalCase']) as $value ){
                $query = "INSERT INTO `event_has_criminal_case` SET event_id='".$data['id']."' , criminal_case_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event_has_action
        if(isset($data['getEventHasAction']) && !empty($data['getEventHasAction'])) {
            foreach(($data['getEventHasAction']) as $value ){
                $query = "INSERT INTO `event_has_action` SET event_id='".$data['id']."' , action_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event_has_signal
        if(isset($data['getEventHasSignal']) && !empty($data['getEventHasSignal'])) {
            foreach(($data['getEventHasSignal']) as $value ){
                $query = "INSERT INTO `event_passes_signal` SET event_id='".$data['id']."' , signal_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_has_event
        if(isset($data['getEvenActionHasEvent']) && !empty($data['getEvenActionHasEvent'])) {
            foreach(($data['getEvenActionHasEvent']) as $value ){
                $query = "INSERT INTO `action_has_event` SET event_id='".$data['id']."' , action_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event_has_car
        if(isset($data['getEventHasCar']) && !empty($data['getEventHasCar'])) {
            foreach(($data['getEventHasCar']) as $value ){
                $query = "INSERT INTO `event_has_car` SET event_id='".$data['id']."' , car_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event_has_weapon
        if(isset($data['getEventHasWeapon']) && !empty($data['getEventHasWeapon'])) {
            foreach(($data['getEventHasWeapon']) as $value ){
                $query = "INSERT INTO `event_has_weapon` SET event_id='".$data['id']."' , weapon_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event_has_organization
        if(isset($data['getEventHasOrganization']) && !empty($data['getEventHasOrganization'])) {
            foreach(($data['getEventHasOrganization']) as $value ){
                $query = "INSERT INTO `event_has_organization` SET event_id='".$data['id']."' , organization_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event_has_organization
        if(isset($data['getEventHasMan']) && !empty($data['getEventHasMan'])) {
            foreach(($data['getEventHasMan']) as $value ){
                $query = "INSERT INTO `event_has_man` SET event_id='".$data['id']."' , man_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

    }
//    END EVENTS

    ////   action    //////
    public function action() {
        $query = " SELECT `action`.* , action_qualification.name AS action_qualification , duration.name AS duration , action_goal.name AS action_goal,
                            terms.name AS terms , aftermath.name AS aftermath
                  FROM `action`
                  LEFT JOIN action_qualification ON action_qualification.id = `action`.action_qualification_id
                  LEFT JOIN duration ON duration.id = `action`.duration_id
                  LEFT JOIN action_goal ON action_goal.id = `action`.goal_id
                  LEFT JOIN terms ON terms.id = `action`.terms_id
                  LEFT JOIN aftermath ON aftermath.id = `action`.aftermath_id
		            WHERE action.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		            GROUP BY action.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasMaterialContent(){
        $query = "SELECT material_content.* FROM action_has_material_content
                      LEFT JOIN material_content ON material_content.id = action_has_material_content.material_content_id
                      WHERE action_has_material_content.action_id  IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                      GROUP BY action_has_material_content.material_content_id ";
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

    public function getActionPassesSignal(){
        $query = "SELECT signal_id FROM action_passes_signal WHERE action_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY signal_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasCar(){
        $query = "SELECT car_id FROM action_has_car WHERE action_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY car_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasWeapon(){
        $query = "SELECT weapon_id FROM action_has_weapon WHERE action_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY weapon_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasPhone(){
        $query = "SELECT phone_id FROM action_has_phone WHERE action_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY phone_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasOrganization(){
        $query = "SELECT organization_id FROM action_has_organization WHERE action_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY organization_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionEventHasAction(){
        $query = "SELECT event_id FROM event_has_action WHERE action_id  IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY event_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasMan(){
        $query = "SELECT man_id FROM action_has_man WHERE action_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY man_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasEvent(){
        $query = "SELECT event_id FROM action_has_event WHERE action_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY event_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasQualification(){
        $query = "SELECT action_qualification.* FROM action_has_qualification
                  LEFT JOIN action_qualification ON action_has_qualification.qualification_id = action_qualification.id
                  WHERE action_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY qualification_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionHasCriminalCase(){
        $query = "SELECT criminal_case_id FROM action_has_criminal_case WHERE action_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') GROUP BY criminal_case_id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getActionToAction(){
        $query = "(SELECT action_id2 AS action_id FROM action_to_action WHERE action_id1 = '".$_POST['id1']."' AND action_id2 != '".$_POST['id2']."' AND action_id2 != '".$_POST['id1']."')
                  UNION
                  (SELECT action_id1 AS action_id FROM action_to_action WHERE action_id2 = '".$_POST['id1']."' AND action_id1 != '".$_POST['id2']."' AND action_id1 != '".$_POST['id1']."')
                  UNION
                  (SELECT action_id2 AS action_id FROM action_to_action WHERE action_id1 = '".$_POST['id2']."' AND action_id2 != '".$_POST['id1']."' AND action_id2 != '".$_POST['id2']."')
                  UNION
                  (SELECT action_id1 AS action_id FROM action_to_action WHERE action_id2 = '".$_POST['id2']."' AND action_id1 != '".$_POST['id1']."' AND action_id1 != '".$_POST['id2']."')
                  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_action($data) {
        $this->opt->optimization_action_delete($data['id']);
        $this->opt->optimization_action_delete($data['deleted_id']);
        $query = " INSERT INTO `action` SET id='".$data['id']."' , start_date='".$data['start_date']."' , end_date='".$data['end_date']."' ,
            duration_id='".$data['duration']."' , goal_id='".$data['goal']."' , aftermath_id='".$data['aftermath']."' , terms_id='".$data['terms']."' ,
            bibliography_id='".$data['bibliography_id']."' , source='".$data['source']."' ,
            address_id='".$data['address_id']."', opened_criminal_case_id='".$data['opened_criminal_case_id']."' , opened_dou='".$data['opened_dou']."'";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();


        //action_has_material_content
        if(isset($data['material_content']) && !empty($data['material_content'])) {
            foreach(($data['material_content']) as $value ){
                $query = "INSERT INTO `action_has_material_content` SET action_id='".$data['id']."' , material_content_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_has_qualification
        if(isset($data['getActionHasQualification']) && !empty($data['getActionHasQualification'])) {
            foreach(($data['getActionHasQualification']) as $value ){
                $query = "INSERT INTO `action_has_qualification` SET action_id='".$data['id']."' , qualification_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getActionToAction
        if(isset($data['getActionToAction']) && !empty($data['getActionToAction'])) {
            foreach(($data['getActionToAction']) as $value ){
                $query = "INSERT INTO `action_to_action` SET action_id1='".$data['id']."' , action_id2='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getActionHasCriminalCase
        if(isset($data['getActionHasCriminalCase']) && !empty($data['getActionHasCriminalCase'])) {
            foreach(($data['getActionHasCriminalCase']) as $value ){
                $query = "INSERT INTO `action_has_criminal_case` SET action_id='".$data['id']."' , criminal_case_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }


        //action_has_event
        if(isset($data['getActionHasEvent']) && !empty($data['getActionHasEvent'])) {
            foreach(($data['getActionHasEvent']) as $value ){
                $query = "INSERT INTO `action_has_event` SET action_id='".$data['id']."' , event_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event_has_action
        if(isset($data['getActionEventHasAction']) && !empty($data['getActionEventHasAction'])) {
            foreach(($data['getActionEventHasAction']) as $value ){
                $query = "INSERT INTO `event_has_action` SET action_id='".$data['id']."' , event_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_has_man
        if(isset($data['getActionHasMan']) && !empty($data['getActionHasMan'])) {
            foreach(($data['getActionHasMan']) as $value ){
                $query = "INSERT INTO `action_has_man` SET action_id='".$data['id']."' , man_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_has_organization
        if(isset($data['getActionHasOrganization']) && !empty($data['getActionHasOrganization'])) {
            foreach(($data['getActionHasOrganization']) as $value ){
                $query = "INSERT INTO `action_has_organization` SET action_id='".$data['id']."' , organization_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_has_phone
        if(isset($data['getActionHasPhone']) && !empty($data['getActionHasPhone'])) {
            foreach(($data['getActionHasPhone']) as $value ){
                $query = "INSERT INTO `action_has_phone` SET action_id='".$data['id']."' , phone_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_has_weapon
        if(isset($data['getActionHasWeapon']) && !empty($data['getActionHasWeapon'])) {
            foreach(($data['getActionHasWeapon']) as $value ){
                $query = "INSERT INTO `action_has_weapon` SET action_id='".$data['id']."' , weapon_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_has_car
        if(isset($data['getActionHasCar']) && !empty($data['getActionHasCar'])) {
            foreach(($data['getActionHasCar']) as $value ){
                $query = "INSERT INTO `action_has_car` SET action_id='".$data['id']."' , car_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_passes_signal
        if(isset($data['getActionPassesSignal']) && !empty($data['getActionPassesSignal'])) {
            foreach(($data['getActionPassesSignal']) as $value ){
                $query = "INSERT INTO `action_passes_signal` SET action_id='".$data['id']."' , signal_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }
    }
//    ---------------------------------------------------------------------------------   END ACTION      ------------------------------------------------------------


//    ---------------------------------------------------------------------------------  CAR   ------------------------------------------------------------
    public function car() {
        $query = " SELECT `car`.* , car_category.name AS category , car_mark.name AS mark , color.name AS color
                  FROM `car`
                  LEFT JOIN car_category ON car_category.id = `car`.category_id
                  LEFT JOIN car_mark ON car_mark.id = `car`.mark_id
                  LEFT JOIN color ON color.id = `car`.color_id
                  WHERE car.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY car.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHasMan(){
        $query = "SELECT man_id FROM man_has_car WHERE car_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY man_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHasOrganization(){
        $query = "SELECT organization_id FROM organization_has_car WHERE car_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY organization_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarUseMan(){
        $query = "SELECT man_id FROM man_use_car WHERE car_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY man_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHasAddress(){
        $query = "SELECT address_id FROM car_has_address WHERE car_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY address_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHasAction(){
        $query = "SELECT action_id FROM action_has_car WHERE car_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY action_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCarHasEvent(){
        $query = "SELECT event_id FROM event_has_car WHERE car_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY event_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_car($data) {
        $this->opt->optimization_car_delete($data['id']);
        $this->opt->optimization_car_delete($data['deleted_id']);
        $query = " INSERT INTO `car` SET id='".$data['id']."' , number ='".$data['number']."' , note ='".$data['note']."' , category_id ='".$data['category_id']."',
        mark_id ='".$data['mark_id']."' , color_id ='".$data['color_id']."' , count ='".$data['count']."'  ";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

        //man_has_car
        if(isset($data['getCarHasMan']) && !empty($data['getCarHasMan'])) {
            foreach(($data['getCarHasMan']) as $value ){
                $query = "INSERT INTO `man_has_car` SET car_id ='".$data['id']."' , man_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //car_has_organization
        if(isset($data['getCarHasOrganization']) && !empty($data['getCarHasOrganization'])) {
            foreach(($data['getCarHasOrganization']) as $value ){
                $query = "INSERT INTO `organization_has_car` SET car_id ='".$data['id']."' , organization_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //man_use_car
        if(isset($data['getCarUseMan']) && !empty($data['getCarUseMan'])) {
            foreach(($data['getCarUseMan']) as $value ){
                $query = "INSERT INTO `man_use_car` SET car_id ='".$data['id']."' , man_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //car_has_address
        if(isset($data['getCarHasAddress']) && !empty($data['getCarHasAddress'])) {
            foreach(($data['getCarHasAddress']) as $value ){
                $query = "INSERT INTO `car_has_address` SET car_id ='".$data['id']."' , address_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_has_car
        if(isset($data['getCarHasAction']) && !empty($data['getCarHasAction'])) {
            foreach(($data['getCarHasAction']) as $value ){
                $query = "INSERT INTO `action_has_car` SET car_id ='".$data['id']."' , action_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event_has_car
        if(isset($data['getCarHasEvent']) && !empty($data['getCarHasEvent'])) {
            foreach(($data['getCarHasEvent']) as $value ){
                $query = "INSERT INTO `event_has_car` SET car_id ='".$data['id']."' , event_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

    }
//------------------------------------------------------------END CAR  ------------------------------------------------------------

//------------------------------------------------------------  WEAPON    ------------------------------------------------------------
    public function weapon() {
        $query = " SELECT `weapon`.*
                  FROM `weapon`
                  WHERE weapon.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY weapon.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWeaponHasMan(){
        $query = "SELECT man_id FROM man_has_weapon WHERE weapon_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY man_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWeaponHasOrganization(){
        $query = "SELECT organization_id FROM organization_has_weapon WHERE weapon_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY organization_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWeaponHasAction(){
        $query = "SELECT action_id FROM action_has_weapon WHERE weapon_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY action_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getWeaponHasEvent(){
        $query = "SELECT event_id FROM event_has_weapon WHERE weapon_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY event_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_weapon($data) {
        $this->opt->optimization_weapon_delete($data['id']);
        $this->opt->optimization_weapon_delete($data['deleted_id']);
        $query = " INSERT INTO `weapon` SET id='".$data['id']."' , category ='".$data['category']."' , view ='".$data['view']."' , type ='".$data['type']."',
        model ='".$data['model']."' , reg_num ='".$data['reg_num']."' , count ='".$data['count']."'  ";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

        //man_has_weapon
        if(isset($data['getWeaponHasMan']) && !empty($data['getWeaponHasMan'])) {
            foreach(($data['getWeaponHasMan']) as $value ){
                $query = "INSERT INTO `man_has_weapon` SET weapon_id ='".$data['id']."' , man_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //organization_has_weapon
        if(isset($data['getWeaponHasOrganization']) && !empty($data['getWeaponHasOrganization'])) {
            foreach(($data['getWeaponHasOrganization']) as $value ){
                $query = "INSERT INTO `organization_has_weapon` SET weapon_id ='".$data['id']."' , organization_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_has_weapon
        if(isset($data['getWeaponHasAction']) && !empty($data['getWeaponHasAction'])) {
            foreach(($data['getWeaponHasAction']) as $value ){
                $query = "INSERT INTO `action_has_weapon` SET weapon_id ='".$data['id']."' , action_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event_has_weapon
        if(isset($data['getWeaponHasEvent']) && !empty($data['getWeaponHasEvent'])) {
            foreach(($data['getWeaponHasEvent']) as $value ){
                $query = "INSERT INTO `event_has_weapon` SET weapon_id ='".$data['id']."' , event_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

    }
//------------------------------------------------------------ END WEAPON  ------------------------------------------------------------

//------------------------------------------------------------ ADDRESS    ------------------------------------------------------------
    public function address() {
        $query = " SELECT address.* , country_ate.name AS country_ate, region.name AS region , region.country_id AS checkRegion ,
                        locality.name AS locality , locality.country_id AS checkLocality , street.name AS street , street.country_id AS checkStreet
                  FROM address
                  LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  LEFT JOIN region ON region.id = address.region_id
                  LEFT JOIN locality ON locality.id = address.locality_id
                  LEFT JOIN street ON street.id = address.street_id
                  WHERE address.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY address.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHasAction(){
        $query = "SELECT id FROM `action` WHERE address_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHasEvent(){
        $query = "SELECT id FROM `event` WHERE address_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHasMan(){
        $query = "SELECT man_id FROM man_has_address WHERE address_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY man_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHasOrganization(){
        $query = "SELECT organization_id FROM organization_has_address WHERE address_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY organization_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressHasCar(){
        $query = "SELECT car_id FROM car_has_address WHERE address_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY car_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAddressOrganization(){
        $query = "SELECT id FROM organization WHERE address_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_address($data) {
        $this->opt->optimization_address_delete($data['id']);
        $this->opt->optimization_address_delete($data['deleted_id']);
        $query = " INSERT INTO `address` SET id='".$data['id']."' , region_id ='".$data['region_id']."' , locality_id ='".$data['locality_id']."' , street_id ='".$data['street_id']."',
        track ='".$data['track']."' , home_num ='".$data['home_num']."' , housing_num ='".$data['housing_num']."' , apt_num ='".$data['apt_num']."',
        country_ate_id ='".$data['country_ate_id']."' ";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

        //action
        if(isset($data['getAddressHasAction']) && !empty($data['getAddressHasAction'])) {
            foreach(($data['getAddressHasAction']) as $value ){
                $query = " UPDATE `action` SET address_id ='".$data['id']."' WHERE action.id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event
        if(isset($data['getAddressHasEvent']) && !empty($data['getAddressHasEvent'])) {
            foreach(($data['getAddressHasEvent']) as $value ){
                $query = " UPDATE `event` SET address_id ='".$data['id']."' WHERE event.id= '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //man_has_address
        if(isset($data['getAddressHasMan']) && !empty($data['getAddressHasMan'])) {
            foreach(($data['getAddressHasMan']) as $value ){
                $query = "INSERT INTO `man_has_address` SET address_id ='".$data['id']."' , man_id='".$value."'";
                $this->_setSql($query);
                $this->run();

                $query = "UPDATE `man` SET born_address_id ='".$data['id']."' WHERE id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //organization_has_address
        if(isset($data['getAddressHasOrganization']) && !empty($data['getAddressHasOrganization'])) {
            foreach(($data['getAddressHasOrganization']) as $value ){
                $query = "INSERT INTO `organization_has_address` SET address_id ='".$data['id']."' , organization_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //car_has_address
        if(isset($data['getAddressHasCar']) && !empty($data['getAddressHasCar'])) {
            foreach(($data['getAddressHasCar']) as $value ){
                $query = "INSERT INTO `car_has_address` SET address_id ='".$data['id']."' , car_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //organization
        if(isset($data['getAddressOrganization']) && !empty($data['getAddressOrganization'])) {
            foreach(($data['getAddressOrganization']) as $value ){
                $query = " UPDATE `organization` SET address_id ='".$data['id']."' WHERE organization.id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

    }
    //---------------------------------------------------------------- END ADDRESS  ----------------------------------------------------------------

//----------------------------------------------------------------     WORK ACTIVITY   ----------------------------------------------------------------
    public function work_activity() {
        $query = " SELECT organization_has_man.* FROM organization_has_man
		    WHERE organization_has_man.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
		    GROUP BY organization_has_man.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_work_activity($data) {
        $this->opt->optimization_work_activity_delete($data['id']);
        $this->opt->optimization_work_activity_delete($data['deleted_id']);
        $query = " INSERT INTO `organization_has_man` SET id='".$data['id']."' , man_id ='".$data['man_id']."' , organization_id ='".$data['organization_id']."' , title ='".$data['title']."',
        start_date ='".$data['start_date']."' , end_date ='".$data['end_date']."' , period ='".$data['period']."' ";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();
    }
    //----------------------------------------------------------------END WORK ACTIVITY----------------------------------------------------------------

    //---------------------------------------------------------------- MIA SUMMARY   ----------------------------------------------------------------
    public function mia_summary() {
        $query = " SELECT mia_summary.* FROM mia_summary
                  WHERE mia_summary.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY mia_summary.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getMiaSummaryHasMan(){
        $query = "SELECT man_id FROM man_passes_mia_summary WHERE mia_summary_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY man_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getMiaSummaryHasOrganization(){
        $query = "SELECT organization_id FROM organization_passes_mia_summary WHERE mia_summary_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY organization_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_mia_summary($data) {
        $this->opt->optimization_mia_summary_delete($data['id']);
        $this->opt->optimization_mia_summary_delete($data['deleted_id']);
        $query = " INSERT INTO `mia_summary` SET id='".$data['id']."' , date ='".$data['date']."' , content ='".$data['content']."' , bibliography_id ='".$data['bibliography_id']."' ";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

        //man_has_address
        if(isset($data['getMiaSummaryHasMan']) && !empty($data['getMiaSummaryHasMan'])) {
            foreach(($data['getMiaSummaryHasMan']) as $value ){
                $query = "INSERT INTO `man_passes_mia_summary` SET mia_summary_id ='".$data['id']."' , man_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //organization_has_address
        if(isset($data['getMiaSummaryHasOrganization']) && !empty($data['getMiaSummaryHasOrganization'])) {
            foreach(($data['getMiaSummaryHasOrganization']) as $value ){
                $query = "INSERT INTO `organization_passes_mia_summary` SET mia_summary_id ='".$data['id']."' , organization_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

    }
//----------------------------------------------------------------  END MIA SUMMARY ----------------------------------------------------------------

    //---------------------------------------------------------------- CRIMINAL CASE   ----------------------------------------------------------------
    public function criminal_case() {
        $query = "SELECT criminal_case.* , opened_agency.name AS opened_agency,
                        opened_unit.name AS opened_unit , subunit.name AS subunit
                  FROM criminal_case
                  LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
                  LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
                  LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
                  WHERE criminal_case.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY criminal_case.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasMan(){
        $query = "SELECT man_id FROM criminal_case_has_man WHERE criminal_case_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY man_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasOrganization(){
        $query = "SELECT organization_id FROM criminal_case_has_organization WHERE criminal_case_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY organization_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasAction(){
        $query = "SELECT action_id FROM `action_has_criminal_case` WHERE criminal_case_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY action_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasEvent(){
        $query = "SELECT event_id FROM event_has_criminal_case WHERE criminal_case_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY event_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseExtracted(){
        $query = "SELECT criminal_case_id1 FROM `criminal_case_extracted_criminal_case` WHERE criminal_case_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY criminal_case_id1 ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseSplited(){
        $query = "SELECT criminal_case_id1 FROM `criminal_case_splited_criminal_case` WHERE criminal_case_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY criminal_case_id1 ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseWorker(){
        $query = "SELECT worker FROM criminal_case_worker WHERE criminal_case_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseWorkerPost(){
        $query = "SELECT worker_post.* FROM criminal_case_worker_post
                  LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
                  WHERE criminal_case_worker_post.criminal_case_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') GROUP BY worker_post.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getCriminalCaseHasSignal(){
        $query = "SELECT signal_id FROM criminal_case_has_signal WHERE criminal_case_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') GROUP BY signal_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_criminal_case($data) {
        $this->opt->optimization_criminal_case_delete($data['id']);
        $this->opt->optimization_criminal_case_delete($data['deleted_id']);
        $query = " INSERT INTO `criminal_case` SET id='".$data['id']."' , number ='".$data['number']."' , bibliography_id ='".$data['bibliography_id']."' , opened_date ='".$data['opened_date']."',
        artical ='".$data['artical']."', opened_agency_id ='".$data['opened_agency_id']."', opened_unit_id ='".$data['opened_unit_id']."',
        subunit_id ='".$data['subunit_id']."', `character` ='".$data['character']."', opened_dou ='".$data['opened_dou']."' ";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

        //criminal_case_has_man
        if(isset($data['getCriminalCaseHasMan']) && !empty($data['getCriminalCaseHasMan'])) {
            foreach(($data['getCriminalCaseHasMan']) as $value ){
                $query = "INSERT INTO `criminal_case_has_man` SET criminal_case_id ='".$data['id']."' , man_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //getCriminalCaseHasSignal
        if(isset($data['getCriminalCaseHasSignal']) && !empty($data['getCriminalCaseHasSignal'])) {
            foreach(($data['getCriminalCaseHasSignal']) as $value ){
                $query = "INSERT INTO `criminal_case_has_signal` SET criminal_case_id ='".$data['id']."' , signal_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //criminal_case_has_organization
        if(isset($data['getCriminalCaseHasOrganization']) && !empty($data['getCriminalCaseHasOrganization'])) {
            foreach(($data['getCriminalCaseHasOrganization']) as $value ){
                $query = "INSERT INTO `criminal_case_has_organization` SET criminal_case_id ='".$data['id']."' , organization_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //criminal_case action
        if(isset($data['getCriminalCaseHasAction']) && !empty($data['getCriminalCaseHasAction'])) {
            foreach(($data['getCriminalCaseHasAction']) as $value ){
                $query = " INSERT INTO `action_has_criminal_case` SET criminal_case_id ='".$data['id']."' , action_id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //criminal_case event
        if(isset($data['getCriminalCaseHasEvent']) && !empty($data['getCriminalCaseHasEvent'])) {
            foreach(($data['getCriminalCaseHasEvent']) as $value ){
                $query = " INSERT INTO  `event_has_criminal_case` SET criminal_case_id ='".$data['id']."' , event_id = '".$value."' ";
                $this->_setSql($query);
                $this->run();
            }
        }

        //criminal_case_extracted_criminal_case
        if(isset($data['getCriminalCaseExtracted']) && !empty($data['getCriminalCaseExtracted'])) {
            foreach(($data['getCriminalCaseExtracted']) as $value ){
                $query = "INSERT INTO `criminal_case_extracted_criminal_case` SET criminal_case_id ='".$data['id']."' , criminal_case_id1='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //criminal_case_splited_criminal_case
        if(isset($data['getCriminalCaseSplited']) && !empty($data['getCriminalCaseSplited'])) {
            foreach(($data['getCriminalCaseSplited']) as $value ){
                $query = "INSERT INTO `criminal_case_splited_criminal_case` SET criminal_case_id ='".$data['id']."' , criminal_case_id1='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //criminal_case_worker
        if(isset($data['getCriminalCaseWorker']) && !empty($data['getCriminalCaseWorker'])) {
            foreach(($data['getCriminalCaseWorker']) as $value ){
                $query = "INSERT INTO `criminal_case_worker` SET criminal_case_id ='".$data['id']."' , worker='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //criminal_case_worker_post
        if(isset($data['getCriminalCaseWorkerPost']) && !empty($data['getCriminalCaseWorkerPost'])) {
            foreach(($data['getCriminalCaseWorkerPost']) as $value ){
                $query = "INSERT INTO `criminal_case_worker_post` SET criminal_case_id ='".$data['id']."' , worker_post_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

    }
    //---------------------------------------------------------------- END CRIMINAL CASE   ----------------------------------------------------------------

    /////////  signal   ////////////////////////***************/////////////////////////
    public function signal() {
        $query = "SELECT `signal`.* , signal_qualification.name AS signal_qualification , resource.name AS resource , check_agency.name AS check_agency,
                          check_unit.name AS check_unit, check_subunit.name AS check_subunit, signal_result.name AS signal_result , opened_agency.name AS opened_agency,
                          opened_unit.name AS opened_unit, opened_subunit.name AS opened_subunit
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
                  WHERE signal.id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY signal.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalWorker(){
        $query = "SELECT worker FROM signal_worker WHERE signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalWorkerPost(){
        $query = "SELECT worker_post.* FROM signal_worker_post
                  LEFT JOIN worker_post ON signal_worker_post.worker_post_id = worker_post.id
                  WHERE signal_worker_post.signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY worker_post.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalCheckingWorker(){
        $query = "SELECT worker FROM signal_checking_worker WHERE signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalCheckingWorkerPost(){
        $query = "SELECT worker_post.* FROM signal_checking_worker_post
                  LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                  WHERE signal_checking_worker_post.signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
                  GROUP BY worker_post.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalCriminalCase(){
        $query = " SELECT criminal_case_id FROM criminal_case_has_signal WHERE signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY criminal_case_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalHasMan(){
        $query = "SELECT man_id FROM signal_has_man WHERE signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY man_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalPassedByMan(){
        $query = "SELECT man_id FROM `man_passed_by_signal` WHERE signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY man_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalCheckedByOrganization(){
        $query = "SELECT organization_id FROM `organization_checked_by_signal` WHERE signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY organization_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalPassesByOrganization(){
        $query = "SELECT organization_id FROM `organization_passes_by_signal` WHERE signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY organization_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalPassesAction(){
        $query = "SELECT action_id FROM `action_passes_signal` WHERE signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY action_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalPassesEvent(){
        $query = "SELECT event_id FROM `event_passes_signal` WHERE signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY event_id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getSignalKeepSignal(){
        $query = "SELECT id FROM `keep_signal` WHERE signal_id IN ( '".$_POST['id1']."', '".$_POST['id2']."')
        GROUP BY id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fusion_signal($data) {
        $this->opt->optimization_signal_delete($data['id']);
        $this->opt->optimization_signal_delete($data['deleted_id']);
        $query = " INSERT INTO `signal` SET id='".$data['id']."' , reg_num ='".$data['reg_num']."' , content ='".$data['content']."' , check_line ='".$data['check_line']."',
        check_status ='".$data['check_status']."', signal_qualification_id ='".$data['signal_qualification_id']."', check_agency_id ='".$data['check_agency_id']."',
        check_unit_id ='".$data['check_unit_id']."', `check_subunit_id` ='".$data['check_subunit_id']."', subunit_date ='".$data['subunit_date']."', check_date ='".$data['check_date']."',
        end_date ='".$data['end_date']."', opened_dou ='".$data['opened_dou']."', bibliography_id ='".$data['bibliography_id']."', opened_agency_id ='".$data['opened_agency_id']."',
        opened_unit_id ='".$data['opened_unit_id']."', opened_subunit_id ='".$data['opened_subunit_id']."',
        source_resource_id ='".$data['source_resource_id']."', signal_result_id ='".$data['signal_result_id']."' ";
        $query = str_replace("''",'NULL',$query);
        $this->_setSql($query);
        $this->run();

        // signal checking worker
        if(isset($data['checking_worker']) && !empty($data['checking_worker'])) {
            foreach(($data['checking_worker']) as $value ){
                $query = "INSERT INTO `signal_checking_worker` SET signal_id='".$data['id']."' , worker='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        // signal checking worker post
        if(isset($data['checking_worker_post']) && !empty($data['checking_worker_post'])) {
            foreach(($data['checking_worker_post']) as $value ){
                $query = "INSERT INTO `signal_checking_worker_post` SET signal_id='".$data['id']."' , worker_post_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        // signal worker
        if(isset($data['worker']) && !empty($data['worker'])) {
            foreach(($data['worker']) as $value ){
                $query = "INSERT INTO `signal_worker` SET signal_id='".$data['id']."' , worker='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        // signal worker post
        if(isset($data['worker_post']) && !empty($data['worker_post'])) {
            foreach(($data['worker_post']) as $value ){
                $query = "INSERT INTO `signal_worker_post` SET signal_id='".$data['id']."' , worker_post_id='".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //signal criminal_case
        if(isset($data['getSignalCriminalCase']) && !empty($data['getSignalCriminalCase'])) {
            foreach(($data['getSignalCriminalCase']) as $value ){
                $query = " INSERT INTO  `criminal_case_has_signal` SET signal_id ='".$data['id']."' , criminal_case_id = '".$value."' ";
                $this->_setSql($query);
                $this->run();
            }
        }

        //signal_has_man
        if(isset($data['getSignalHasMan']) && !empty($data['getSignalHasMan'])) {
            foreach(($data['getSignalHasMan']) as $value ){
                $query = "INSERT INTO `signal_has_man` SET signal_id ='".$data['id']."' , man_id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //man_passed_by_signal
        if(isset($data['getSignalPassedByMan']) && !empty($data['getSignalPassedByMan'])) {
            foreach(($data['getSignalPassedByMan']) as $value ){
                $query = "INSERT INTO `man_passed_by_signal` SET signal_id ='".$data['id']."' , man_id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //organization_checked_by_signal
        if(isset($data['getSignalCheckedByOrganization']) && !empty($data['getSignalCheckedByOrganization'])) {
            foreach(($data['getSignalCheckedByOrganization']) as $value ){
                $query = "INSERT INTO `organization_checked_by_signal` SET signal_id ='".$data['id']."' , organization_id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //organization_passes_by_signal
        if(isset($data['getSignalPassesByOrganization']) && !empty($data['getSignalPassesByOrganization'])) {
            foreach(($data['getSignalPassesByOrganization']) as $value ){
                $query = "INSERT INTO `organization_passes_by_signal` SET signal_id ='".$data['id']."' , organization_id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //action_passes_signal
        if(isset($data['getSignalPassesAction']) && !empty($data['getSignalPassesAction'])) {
            foreach(($data['getSignalPassesAction']) as $value ){
                $query = "INSERT INTO `action_passes_signal` SET signal_id ='".$data['id']."' , action_id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //event_passes_signal
        if(isset($data['getSignalPassesEvent']) && !empty($data['getSignalPassesEvent'])) {
            foreach(($data['getSignalPassesEvent']) as $value ){
                $query = "INSERT INTO `event_passes_signal` SET signal_id ='".$data['id']."' , event_id = '".$value."'";
                $this->_setSql($query);
                $this->run();
            }
        }

        //signal keep_signal
        if(isset($data['getSignalKeepSignal']) && !empty($data['getSignalKeepSignal'])) {
            foreach(($data['getSignalKeepSignal']) as $value ){
                $query = " UPDATE `keep_signal` SET signal_id ='".$data['id']."' WHERE keep_signal.id = '".$value."' ";
                $this->_setSql($query);
                $this->run();
            }
        }

    }
    /////   end signal  ////////////******************************////////////////////////
}