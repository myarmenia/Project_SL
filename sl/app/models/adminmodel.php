<?php

class AdminModel extends Model{

    public function add($data,$id) {
        if($id==null){
            $query = "INSERT INTO users SET username = '{$data['username']}', password = '{$data['password']}', first_name = '{$data['first_name']}', last_name = '{$data['last_name']}', user_type = '{$data['user_type']}' ";

        }else{
            $query = "UPDATE users SET username = '{$data['username']}', password = '{$data['password']}', first_name = '{$data['first_name']}', last_name = '{$data['last_name']}', user_type = '{$data['user_type']}' WHERE id=".$id;
        }
        $this->_setSql($query);
        $this->run();
        if($id == null){
            return $this->getId();
        }
    }

    public function readData($tableName){
        $query = "SELECT * FROM ".$tableName;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function updateData($data,$tableName){
        $query = "UPDATE $tableName SET username='".$data['username']."',first_name='".$data['first_name']."',last_name='".$data['last_name']."',user_type='".$data['user_type']."'  WHERE id='".$data['id']."' ";
        $this->_setSql($query);
        $this->run();
    }

    public function destroyData($data,$tableName){
        $query = "DELETE FROM ".$tableName." WHERE id='".$data['id']."' ";
        $this->_setSql($query);
        $this->run();
    }

    public function UserEdit($id,$tableName) {
        $query = "SELECT * FROM ".$tableName." WHERE id=".$id;
        $this->_setSql($query);
        return $this->getAll();
    }
    public function db_backup(){

        $DUMPFILE = APP_PATH.DS.'temp'.DS.'sns_dev_1.sql';
        try {
            exec('mysqldump -h'.DB_HOST.' -u '.DB_USER.' -p'.DB_PASS.' '.DB_NAME.' > '.$DUMPFILE);
            $str = file_get_contents($DUMPFILE);
            $encode1 = base64_encode($str);
            $encode2 = rawurlencode($encode1);
            $encode3 = urlencode($encode2);
            $DUMPFILE_NEW = APP_PATH.DS.'temp'.DS.'sns_dev.sql';
            $new_file = fopen($DUMPFILE_NEW,'w');
            fwrite($new_file,$encode3);
            fclose( $new_file );
            unlink($DUMPFILE);

        } catch (Exception $e) {
            echo 'Damn it! ' . $e->getMessage() . PHP_EOL;
        }
    }

    public function db_restore($file){
        exec('mysql -h'.DB_HOST.' -u '.DB_USER.' -p'.DB_PASS.' '.DB_NAME.' < '.$file);
    }

    public function optimization_bibliography($bibliography_id=null){
        if($bibliography_id == null){
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

                    LEFT JOIN man_has_bibliography ON man_has_bibliography.bibliography_id = bibliography.id
                    LEFT JOIN organization_has_bibliography ON organization_has_bibliography.bibliography_id = bibliography.id
                    LEFT JOIN `event` ON event.bibliography_id = bibliography.id
                    LEFT JOIN `action` ON action.bibliography_id = bibliography.id
                    LEFT JOIN `signal` ON signal.bibliography_id = bibliography.id
                    LEFT JOIN `criminal_case` ON criminal_case.bibliography_id = bibliography.id
                    LEFT JOIN `control` ON control.bibliography_id = bibliography.id
                    LEFT JOIN `mia_summary` ON mia_summary.bibliography_id = bibliography.id
                    LEFT JOIN `bibliography_has_file` ON bibliography_has_file.bibliography_id = bibliography.id
                    LEFT JOIN bibliography_has_country ON bibliography_has_country.bibliography_id = bibliography.id
                WHERE
            (
                (bibliography.title IS NULL) AND
                (bibliography.category_id IS NULL) AND
                (bibliography.access_level_id IS NULL) AND
                (bibliography.source_agency_id IS NULL) AND
                (bibliography.from_agency_id IS NULL) AND
                (bibliography.source IS NULL) AND
                (bibliography.short_desc IS NULL) AND
                (bibliography.related_year IS NULL) AND
                (bibliography_has_country.bibliography_id IS NULL) AND
                (bibliography.theme IS NULL) AND
                (bibliography.source_address IS NULL) AND
                (bibliography.worker_name IS NULL) AND
                (bibliography.reg_number IS NULL) AND
                (bibliography.reg_number IS NULL) AND
                (bibliography_has_file.bibliography_id IS NULL)
            )

            GROUP BY bibliography.id ";
        }else{
            $query = " (SELECT man_has_bibliography.man_id AS id , 'man_has_bibliography' AS tb_name , '1' AS j FROM man_has_bibliography WHERE man_has_bibliography.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT action.bibliography_id AS id, 'action' AS tb_name , '0' AS j FROM action  WHERE action.bibliography_id = '$bibliography_id' AND action.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT event.bibliography_id AS id, 'event' AS tb_name , '0' AS j FROM event WHERE event.bibliography_id = '$bibliography_id' AND event.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT organization_has_bibliography.organization_id AS id, 'organization_has_bibliography' AS tb_name , '1' AS j FROM organization_has_bibliography WHERE organization_has_bibliography.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT `signal`.bibliography_id AS id, 'signal' AS tb_name , '0' AS j FROM `signal` WHERE `signal`.bibliography_id = '$bibliography_id' AND `signal`.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT criminal_case.bibliography_id AS id, 'criminal_case' AS tb_name , '0' AS j FROM criminal_case WHERE criminal_case.bibliography_id = '$bibliography_id' AND criminal_case.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT mia_summary.bibliography_id AS id, 'mia_summary' AS tb_name , '0' AS j FROM mia_summary WHERE mia_summary.bibliography_id = '$bibliography_id' AND mia_summary.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT control.bibliography_id AS id, 'control' AS tb_name , '0' AS j FROM control WHERE control.bibliography_id = '$bibliography_id' AND control.bibliography_id IS NOT NULL)
            ";
        }

        $this->_setSql($query);
        return $this->getAll();
    }

    // Optimization Bibliography Delete
    public function optimization_bibliography_delete($bibliography_id){
        $query = " (SELECT man_has_bibliography.man_id AS id , 'man_has_bibliography' AS tb_name , '1' AS j FROM man_has_bibliography WHERE man_has_bibliography.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT bibliography_has_country.country_id AS id , 'bibliography_has_country' AS tb_name , '1' AS j FROM bibliography_has_country WHERE bibliography_has_country.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT action.bibliography_id AS id, 'action' AS tb_name , '0' AS j FROM action  WHERE action.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT event.bibliography_id AS id, 'event' AS tb_name , '0' AS j FROM event WHERE event.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT organization_has_bibliography.organization_id AS id, 'organization_has_bibliography' AS tb_name , '1' AS j FROM organization_has_bibliography WHERE organization_has_bibliography.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT `signal`.bibliography_id AS id, 'signal' AS tb_name , '0' AS j FROM `signal` WHERE `signal`.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT criminal_case.bibliography_id AS id, 'criminal_case' AS tb_name , '0' AS j FROM criminal_case WHERE criminal_case.bibliography_id = '$bibliography_id')
                  UNION
                  (SELECT mia_summary.bibliography_id AS id, 'mia_summary' AS tb_name , '0' AS j FROM mia_summary WHERE mia_summary.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT control.bibliography_id AS id, 'control' AS tb_name , '0' AS j FROM control WHERE control.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT bibliography_has_file.bibliography_id AS id, 'bibliography_has_file' AS tb_name , '1' AS j FROM bibliography_has_file WHERE bibliography_has_file.bibliography_id = '$bibliography_id' )
            ";
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                $query = "UPDATE `".$value['tb_name']."` SET bibliography_id = NULL WHERE bibliography_id=".$bibliography_id.";";
            }else{
                $query = "DELETE FROM `".$value['tb_name']."` WHERE  bibliography_id=".$bibliography_id;
            }
            $this->_setSql($query);
            $this->run();
        }
        $delete_table = " DELETE FROM `bibliography` WHERE  id=".$bibliography_id.";";
        $this->_setSql($delete_table);
        $this->run();
    }

    //Optimization Man
    public function optimization_man(){
        $query = "SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,

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
                                   (SELECT GROUP_CONCAT(LEFT(more_data_man.text,20)) FROM
                                        more_data_man WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                   (SELECT GROUP_CONCAT(LEFT(answer.text,20)) FROM
                                        answer WHERE answer.man_id = man.id
                                   GROUP BY man_id) AS answer,

                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man

                  LEFT JOIN man_has_first_name ON man_has_first_name.man_id = man.id
                  LEFT JOIN first_name ON first_name.id = man_has_first_name.first_name_id

                  LEFT JOIN man_has_last_name ON man_has_last_name.man_id = man.id
                  LEFT JOIN last_name ON last_name.id = man_has_last_name.last_name_id

                  LEFT JOIN man_has_middle_name ON man_has_middle_name.man_id = man.id
                  LEFT JOIN middle_name ON middle_name.id = man_has_middle_name.middle_name_id

                  LEFT JOIN man_has_passport ON man_has_passport.man_id = man.id
                  LEFT JOIN passport ON passport.id = man_has_passport.passport_id

                  LEFT JOIN man_belongs_country ON man_belongs_country.man_id = man.id
                  LEFT JOIN country ON country.id = man_belongs_country.country_id

                  LEFT JOIN man_knows_language ON man_knows_language.man_id = man.id
                  LEFT JOIN `language` ON `language`.id = man_knows_language.language_id

                  LEFT JOIN man_has_education ON man_has_education.man_id = man.id
                  LEFT JOIN education ON education.id = man_has_education.education_id

                  LEFT JOIN man_has_party ON man_has_party.man_id = man.id
                  LEFT JOIN party ON party.id = man_has_party.party_id

                  LEFT JOIN man_has_nickname ON man_has_nickname.man_id = man.id
                  LEFT JOIN nickname ON nickname.id = man_has_nickname.nickname_id

                  LEFT JOIN man_has_operation_category ON man_has_operation_category.man_id = man.id
                  LEFT JOIN operation_category ON operation_category.id = man_has_operation_category.operation_category_id

                  LEFT JOIN more_data_man ON more_data_man.man_id = man.id
                  LEFT JOIN answer ON answer.man_id = man.id

                  LEFT JOIN address AS born_address ON born_address.id = man.born_address_id

                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id

                  LEFT JOIN man_has_address ON man_has_address.man_id = man.id
                  LEFT JOIN man_has_email ON man_has_email.man_id = man.id
                  LEFT JOIN man_has_phone ON man_has_phone.man_id = man.id
                  LEFT JOIN man_bean_country ON man_bean_country.man_id = man.id
                  LEFT JOIN action_has_man ON action_has_man.man_id = man.id
                  LEFT JOIN event_has_man ON event_has_man.man_id = man.id
                  LEFT JOIN man_passed_by_signal ON man_passed_by_signal.man_id = man.id
                  LEFT JOIN criminal_case_has_man ON criminal_case_has_man.man_id = man.id
                  LEFT JOIN signal_has_man ON signal_has_man.man_id = man.id
                  LEFT JOIN man_passes_mia_summary ON man_passes_mia_summary.man_id = man.id
                  LEFT JOIN man_has_car ON man_has_car.man_id = man.id
                  LEFT JOIN man_use_car ON man_use_car.man_id = man.id
                  LEFT JOIN man_has_weapon ON man_has_weapon.man_id = man.id
                  LEFT JOIN man_external_sign_has_photo ON man_external_sign_has_photo.man_id = man.id
                  LEFT JOIN man_external_sign_has_sign ON man_external_sign_has_sign.man_id = man.id
                  LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man.id
                  LEFT JOIN organization_has_man ON organization_has_man.man_id = man.id
                  LEFT JOIN objects_relation ON ( (objects_relation.first_object_id = man.id AND objects_relation.first_object_type = 'man')OR
						(objects_relation.second_object_id = man.id AND objects_relation.second_obejct_type = 'man') )
                  LEFT JOIN man_to_man ON man_to_man.man_id1 = man.id OR man_to_man.man_id2 = man.id

		 WHERE (
			(man.gender_id IS NULL) AND
			(man.nation_id IS NULL) AND
			(man.born_address_id IS NULL) AND
			(man.birthday IS NULL) AND
			(man.start_year IS NULL) AND
			(man.end_year IS NULL) AND
			(man.attention IS NULL) AND
			(man.religion_id IS NULL) AND
			(man.occupation IS NULL) AND
			(man.opened_dou IS NULL) AND
			(man.start_wanted IS NULL) AND
			(man.entry_date IS NULL) AND
			(man.exit_date IS NULL) AND
			(man.fixing_moment IS NULL) AND
			(man.resource_id IS NULL) AND
			(man_has_first_name.first_name_id IS NULL) AND
			(man_has_last_name.last_name_id IS NULL) AND
			(man_has_middle_name.middle_name_id IS NULL) AND
			(man_has_passport.passport_id IS NULL) AND
			(man_has_education.education_id IS NULL) AND
			(man_knows_language.language_id IS NULL) AND
			(man_belongs_country.country_id IS NULL) AND
			(man_has_nickname.nickname_id IS NULL) AND
			(man_has_operation_category.operation_category_id IS NULL) AND
			(more_data_man.id IS NULL) AND
			(answer.id IS NULL)
		 )OR(
			(man_to_man.man_id1 IS NULL) AND
			(man_has_email.email_id IS NULL) AND
			(man_bean_country.man_id IS NULL) AND
			(objects_relation.id IS NULL) AND
			(action_has_man.man_id IS NULL) AND
			(event_has_man.man_id IS NULL) AND
			(man_passes_mia_summary.mia_summary_id IS NULL) AND
			(man_has_car.car_id IS NULL) AND
			(man_use_car.car_id IS NULL) AND
			(man_has_weapon.weapon_id IS NULL) AND
			(man_has_bibliography.bibliography_id IS NULL) AND
			(man_has_address.address_id IS NULL) AND
			(man_has_phone.phone_id IS NULL) AND
			(signal_has_man.signal_id IS NULL) AND
			(man_passed_by_signal.signal_id IS NULL) AND
			(criminal_case_has_man.criminal_case_id IS NULL) AND
			(man_external_sign_has_photo.id IS NULL) AND
			(man_external_sign_has_sign.id IS NULL) AND
			(organization_has_man.organization_id IS NULL)
		 )
		 GROUP BY man.id";
        $this->_setSql($query);
        return $this->getAll();
    }


    //Optimization Man Delete
    public function optimization_man_delete($man_id){
        $query = "  (SELECT man.knowen_man_id AS id , 'man' AS tb_name  , '0' AS j FROM man WHERE man.knowen_man_id = '$man_id' )
                        UNION
                        (SELECT man_has_address.address_id AS id, 'man_has_address' AS tb_name  , '1' AS j FROM man_has_address WHERE man_has_address.man_id = '$man_id')
                        UNION
                        (SELECT man_has_phone.phone_id AS id, 'man_has_phone' AS tb_name ,  '1' AS j FROM man_has_phone WHERE man_has_phone.man_id = '$man_id')
                        UNION
                        (SELECT organization_has_man.id AS id, 'organization_has_man' AS tb_name ,  '1' AS j FROM organization_has_man WHERE organization_has_man.man_id = '$man_id')
                        UNION
                        (SELECT man_bean_country.man_id AS id, 'man_bean_country' AS tb_name  , '1' AS j FROM man_bean_country WHERE man_bean_country.man_id = '$man_id')
                        UNION
                        (SELECT man_belongs_country.man_id AS id, 'man_belongs_country' AS tb_name  , '1' AS j FROM man_belongs_country WHERE man_belongs_country.man_id = '$man_id')
                        UNION
                        (SELECT man_external_sign_has_sign.sign_id AS id, 'man_external_sign_has_sign' AS tb_name , '1' AS j FROM man_external_sign_has_sign WHERE man_external_sign_has_sign.man_id = '$man_id')
                        UNION
                        (SELECT action_has_man.action_id AS id, 'action_has_man' AS tb_name , '1' AS j FROM action_has_man WHERE action_has_man.man_id = '$man_id')
                        UNION
                        (SELECT event_has_man.event_id AS id, 'event_has_man' AS tb_name , '1' AS j FROM event_has_man WHERE event_has_man.man_id = '$man_id')
                        UNION
                        (SELECT signal_has_man.signal_id AS id, 'signal_has_man' AS tb_name , '1' AS j FROM signal_has_man WHERE signal_has_man.man_id = '$man_id')
                        UNION
                        (SELECT man_passed_by_signal.signal_id AS id, 'man_passed_by_signal' AS tb_name , '1' AS j FROM man_passed_by_signal WHERE man_passed_by_signal.man_id = '$man_id')
                        UNION
                        (SELECT criminal_case_has_man.criminal_case_id AS id, 'criminal_case_has_man' AS tb_name , '1' AS j FROM criminal_case_has_man WHERE criminal_case_has_man.man_id = '$man_id')
                        UNION
                        (SELECT man_passes_mia_summary.mia_summary_id AS id, 'man_passes_mia_summary' AS tb_name , '1' AS j FROM man_passes_mia_summary WHERE man_passes_mia_summary.man_id = '$man_id' )
                        UNION
                        (SELECT man_has_car.car_id AS id, 'man_has_car' AS tb_name , '1' AS j FROM man_has_car WHERE man_has_car.man_id = '$man_id')
                        UNION
                        (SELECT man_use_car.car_id AS id, 'man_use_car' AS tb_name , '1' AS j FROM man_use_car WHERE man_use_car.man_id = '$man_id')
                        UNION
                        (SELECT man_has_weapon.weapon_id AS id, 'man_has_weapon' AS tb_name , '1' AS j FROM man_has_weapon WHERE man_has_weapon.man_id = '$man_id')
                        UNION
                        (SELECT man_has_bibliography.bibliography_id AS id, 'man_has_bibliography' AS tb_name , '1' AS j FROM man_has_bibliography WHERE man_has_bibliography.man_id = '$man_id')
                        UNION
                       (SELECT answer.id AS id, 'answer' AS tb_name , '1' AS j FROM answer WHERE answer.man_id = '$man_id')
                        UNION
                        (SELECT man_has_first_name.first_name_id AS id, 'man_has_first_name' AS tb_name , '1' AS j FROM man_has_first_name WHERE man_has_first_name.man_id = '$man_id')
                        UNION
                        (SELECT man_has_last_name.last_name_id AS id, 'man_has_last_name' AS tb_name , '1' AS j FROM man_has_last_name WHERE man_has_last_name.man_id = '$man_id')
                        UNION
                        (SELECT man_has_middle_name.middle_name_id AS id, 'man_has_middle_name' AS tb_name , '1' AS j FROM man_has_middle_name WHERE man_has_middle_name.man_id = '$man_id')
                        UNION
                        (SELECT man_has_passport.passport_id AS id, 'man_has_passport' AS tb_name , '1' AS j FROM man_has_passport WHERE man_has_passport.man_id = '$man_id')
                        UNION
                        (SELECT man_has_passport.passport_id AS id, 'man_has_passport' AS tb_name , '1' AS j FROM man_has_passport WHERE man_has_passport.man_id = '$man_id')
                        UNION
                        (SELECT man_external_sign_has_photo.id AS id, 'man_external_sign_has_photo' AS tb_name , '1' AS j FROM man_external_sign_has_photo WHERE man_external_sign_has_photo.man_id = '$man_id')
                        UNION
                        (SELECT man_knows_language.language_id AS id, 'man_knows_language' AS tb_name  , '1' AS j FROM man_knows_language WHERE man_knows_language.man_id = '$man_id')
                        UNION
                        (SELECT more_data_man.id AS id, 'more_data_man' AS tb_name  , '1' AS j FROM more_data_man WHERE more_data_man.man_id = '$man_id')
                        UNION
                        (SELECT man_has_operation_category.man_id AS id, 'man_has_operation_category' AS tb_name  , '1' AS j FROM man_has_operation_category WHERE man_has_operation_category.man_id = '$man_id')
                        UNION
                        (SELECT country_search_man.man_id AS id, 'country_search_man' AS tb_name  , '1' AS j FROM country_search_man WHERE country_search_man.man_id = '$man_id')
                        UNION
                        (SELECT man_has_education.man_id AS id, 'man_has_education' AS tb_name  , '1' AS j FROM man_has_education WHERE man_has_education.man_id = '$man_id')
                        UNION
                        (SELECT man_has_party.man_id AS id, 'man_has_party' AS tb_name  , '1' AS j FROM man_has_party WHERE man_has_party.man_id = '$man_id')
                        UNION
                        (SELECT man_has_email.man_id AS id, 'man_has_email' AS tb_name  , '1' AS j FROM man_has_email WHERE man_has_email.man_id = '$man_id')
                        UNION
                        (SELECT man_has_nickname.man_id AS id, 'man_has_nickname' AS tb_name  , '1' AS j FROM man_has_nickname WHERE man_has_nickname.man_id = '$man_id')
                        UNION
                        (SELECT man_has_file.man_id AS id, 'man_has_file' AS tb_name  , '1' AS j FROM man_has_file WHERE man_has_file.man_id = '$man_id')
                        UNION
                        (SELECT man_to_man.man_id1 AS id, 'man_to_man' AS tb_name  , '1' AS j FROM man_to_man WHERE man_to_man.man_id2 = '$man_id' OR man_to_man.man_id1 = '$man_id')
                        UNION
                        (SELECT objects_relation.id AS id, 'objects_relation' AS tb_name  , '1' AS j FROM objects_relation  WHERE ( objects_relation.first_object_id = '$man_id' AND objects_relation.first_object_type = 'man') OR (objects_relation.second_object_id = '$man_id' AND objects_relation.second_obejct_type = 'man') )

                        ";

        $this->_setSql($query);
        $data =  $this->getAll();
        if($data){
            foreach($data as $value){
                if($value['j'] == 0){
                    if($value['tb_name'] == 'man'){
                        $query = "UPDATE `".$value['tb_name']."` SET knowen_man_id = NULL WHERE knowen_man_id=".$man_id;
                    }else{
                        $query = "UPDATE `".$value['tb_name']."` SET man_id = NULL WHERE man_id=".$man_id;
                    }
                }else{
                    if($value['tb_name'] == 'objects_relation'){
                        $query = " DELETE FROM `objects_relation` WHERE id='".$value['id']."'";
                    }elseif($value['tb_name'] == 'man_to_man'){
                        $query = "DELETE FROM man_to_man WHERE man_id1 = '$man_id' OR man_id2 = '$man_id' ";
                    }else{
                        $query = "DELETE FROM `".$value['tb_name']."` WHERE  man_id=".$man_id;
                    }
                }
                $this->_setSql($query);
                $this->run();
            }
        }
        $delete_table = " DELETE FROM `man` WHERE  id=".$man_id.";";
        $this->_setSql($delete_table);
        $this->run();
    }

    //Optimization Organization
    public function optimization_organization(){
        $query = "SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
                    FROM organization
                    LEFT JOIN country ON country.id = organization.country_id
                    LEFT JOIN organization_category ON organization_category.id = organization.category_id
                    LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
                    LEFT JOIN agency ON agency.id = organization.agency_id
                    LEFT JOIN organization_has_address ON organization_has_address.organization_id = organization.id
                    LEFT JOIN organization_has_phone ON organization_has_phone.organization_id = organization.id
                    LEFT JOIN organization_has_man ON organization_has_man.organization_id = organization.id
                    LEFT JOIN organization_has_email ON organization_has_email.organization_id = organization.id
                    LEFT JOIN organization_has_bibliography ON organization_has_bibliography.organization_id = organization.id
                    LEFT JOIN organization_has_car ON organization_has_car.organization_id = organization.id
                    LEFT JOIN organization_has_weapon ON organization_has_weapon.organization_id = organization.id
                    LEFT JOIN organization_passes_mia_summary ON organization_passes_mia_summary.organization_id = organization.id
                    LEFT JOIN organization_passes_by_signal ON organization_passes_by_signal.organization_id = organization.id
                    LEFT JOIN organization_checked_by_signal ON organization_checked_by_signal.organization_id = organization.id
                    LEFT JOIN objects_relation ON ( (objects_relation.first_object_id = organization.id AND objects_relation.first_object_type = 'organization') OR
                                                  (objects_relation.second_object_id = organization.id AND objects_relation.second_obejct_type = 'organization'))
                    LEFT JOIN event_has_organization ON event_has_organization.organization_id = organization.id
                    LEFT JOIN criminal_case_has_organization ON criminal_case_has_organization.organization_id = organization.id
                    LEFT JOIN action_has_organization ON action_has_organization.organization_id = organization.id
                    LEFT JOIN `event` ON event.organization_id = organization.id
                    LEFT JOIN organization_to_organization ON organization_to_organization.organization_id1 = organization.id OR
                                                              organization_to_organization.organization_id2 = organization.id
                    WHERE
                    (
                        (organization.country_id IS NULL) AND
                        (organization.name IS NULL) AND
                        (organization.reg_date IS NULL) AND
                        (organization.category_id IS NULL) AND
                        (organization.employers_count IS NULL) AND
                        (organization.attension IS NULL) AND
                        (organization.opened_dou IS NULL) AND
                        (organization.country_ate_id IS NULL) AND
                        (organization.agency_id IS NULL)
                    )
                    OR
                    (
                        (organization_has_address.organization_id IS NULL) AND
                        (organization_to_organization.organization_id1 IS NULL) AND
                        (organization.address_id IS NULL) AND
                        (organization_has_phone.organization_id IS NULL) AND
                        (organization_has_man.organization_id IS NULL) AND
                        (event.organization_id IS NULL) AND
                        (event_has_organization.organization_id IS NULL) AND
                        (objects_relation.id IS NULL) AND
                        (criminal_case_has_organization.organization_id IS NULL) AND
                        (action_has_organization.organization_id IS NULL) AND
                        (organization_checked_by_signal.organization_id IS NULL) AND
                        (organization_passes_by_signal.organization_id IS NULL) AND
                        (organization_has_bibliography.organization_id IS NULL) AND
                        (organization_has_car.organization_id IS NULL) AND
                        (organization_has_weapon.organization_id IS NULL) AND
                        (organization_passes_mia_summary.organization_id IS NULL)
		            )
		            GROUP BY organization.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    // Optimization Bibliography Delete
    public function optimization_organization_delete($organization_id){
        $query = " (SELECT organization_has_address.address_id AS id, 'organization_has_address' AS tb_name , '1' AS j FROM organization_has_address WHERE organization_has_address.organization_id = '$organization_id')
                        UNION
                        (SELECT organization.known_as_organization_id AS id, 'organization' AS tb_name , '0' AS j FROM organization WHERE  organization.known_as_organization_id ='$organization_id')
                        UNION
                        (SELECT organization_has_phone.phone_id AS id, 'organization_has_phone' AS tb_name , '1' AS j FROM organization_has_phone WHERE organization_has_phone.organization_id = '$organization_id')
                        UNION
                        (SELECT event_has_organization.event_id AS id, 'event_has_organization' AS tb_name , '1' AS j FROM event_has_organization WHERE event_has_organization.organization_id = '$organization_id')
                        UNION
                        (SELECT event.id AS id, 'event' AS tb_name , '0' AS j FROM `event` WHERE event.organization_id = '$organization_id')
                        UNION
                        (SELECT criminal_case_has_organization.criminal_case_id AS id, 'criminal_case_has_organization' AS tb_name , '1' AS j FROM criminal_case_has_organization WHERE criminal_case_has_organization.organization_id = '$organization_id')
                        UNION
                        (SELECT action_has_organization.action_id AS id, 'action_has_organization' AS tb_name , '1' AS j FROM action_has_organization WHERE action_has_organization.organization_id = '$organization_id')
                        UNION
                        (SELECT organization_has_man.id AS id, 'organization_has_man' AS tb_name , '1' AS j FROM organization_has_man WHERE organization_has_man.organization_id = '$organization_id' )
                        UNION
                        (SELECT organization_checked_by_signal.signal_id AS id, 'organization_checked_by_signal' AS tb_name , '1' AS j FROM organization_checked_by_signal WHERE organization_checked_by_signal.organization_id = '$organization_id')
                        UNION
                        (SELECT organization_passes_by_signal.signal_id AS id, 'organization_passes_by_signal' AS tb_name , '1' AS j FROM organization_passes_by_signal WHERE organization_passes_by_signal.organization_id = '$organization_id')
                        UNION
                        (SELECT organization_has_bibliography.bibliography_id AS id, 'organization_has_bibliography' AS tb_name , '1' AS j FROM organization_has_bibliography WHERE organization_has_bibliography.organization_id = '$organization_id')
                        UNION
                        (SELECT organization_has_car.car_id AS id, 'organization_has_car' AS tb_name , '1' AS j FROM organization_has_car WHERE organization_has_car.organization_id = '$organization_id')
                        UNION
                        (SELECT organization_has_weapon.weapon_id AS id, 'organization_has_weapon' AS tb_name , '1' AS j FROM organization_has_weapon WHERE organization_has_weapon.organization_id = '$organization_id')
                        UNION
                        (SELECT organization_passes_mia_summary.mia_summary_id AS id, 'organization_passes_mia_summary' AS tb_name , '1' AS j FROM organization_passes_mia_summary WHERE organization_passes_mia_summary.organization_id = '$organization_id')
                         UNION
                        (SELECT organization_has_email.email_id AS id, 'organization_has_email' AS tb_name , '1' AS j FROM `organization_has_email` WHERE organization_has_email.organization_id = '$organization_id')
                        UNION
                        (SELECT organization_to_organization.organization_id1 AS id, 'organization_to_organization' AS tb_name , '1' AS j FROM `organization_to_organization` WHERE organization_to_organization.organization_id2 = '$organization_id' OR organization_to_organization.organization_id1 = '$organization_id')
                        UNION
                        (SELECT objects_relation.id AS id, 'objects_relation' AS tb_name  , '1' AS j FROM objects_relation  WHERE ( objects_relation.first_object_id = '$organization_id' AND objects_relation.first_object_type = 'organization') OR (objects_relation.second_object_id = '$organization_id' AND objects_relation.second_obejct_type = 'organization') )
            ";
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                if($value['tb_name'] == 'organization'){
                    $query = "UPDATE `".$value['tb_name']."` SET known_as_organization_id = NULL WHERE known_as_organization_id=".$organization_id;
                }else{
                    $query = "UPDATE `".$value['tb_name']."` SET organization_id = NULL WHERE organization_id=".$organization_id;
                }
            }else{
                if($value['tb_name'] == 'objects_relation'){
                    $query = "DELETE FROM `".$value['tb_name']."` WHERE  id=".$value['id'];
                }elseif($value['tb_name'] == 'organization_to_organization'){
                    $query = "DELETE FROM organization_to_organization WHERE organization_id2 = '$organization_id' OR organization_id1 = '$organization_id' ";
                }else{
                    $query = "DELETE FROM `".$value['tb_name']."` WHERE  organization_id=".$organization_id;
                }
            }
            $this->_setSql($query);
            $this->run();
        }
        $delete_table = " DELETE FROM `organization` WHERE  id=".$organization_id;
        $this->_setSql($delete_table);
        $this->run();
    }

    //Optimization Control
    public function optimization_control(){

        $query = " SELECT control.* , unit.name AS unit, act_unit.name AS act_unit, sub_act_unit.name AS sub_act_unit, doc_category.name AS doc_category, control_result.name AS result
            FROM control
            LEFT JOIN agency AS unit ON unit.id = control.unit_id
            LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
            LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
            LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
            LEFT JOIN control_result ON control_result.id = control.result_id
            WHERE (
			  (control.doc_category_id IS NULL) AND
			  (control.reg_num IS NULL) AND
			  (control.snb_director IS NULL) AND
			  (control.snb_subdirector IS NULL) AND
			  (control.resolution_date IS NULL) AND
			  (control.resolution IS NULL) AND
			  (control.actor_name IS NULL) AND
			  (control.sub_actor_name IS NULL) AND
			  (control.result_id IS NULL) AND
			  (control.unit_id IS NULL) AND
			  (control.act_unit_id IS NULL) AND
			  (control.sub_act_unit_id IS NULL)
		  ) OR (
			   control.bibliography_id IS NULL
		  )
		    GROUP BY control.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    //Optimization Control Delete
    public function optimization_control_delete($control_id) {
        $query = "DELETE FROM `control` WHERE  control.id=".$control_id;
        $this->_setSql($query);
        $this->run();
    }

    //Optimization Mia Summary
    public function optimization_mia_summary(){
        $query = "SELECT mia_summary.* FROM mia_summary
                  LEFT JOIN man_passes_mia_summary ON man_passes_mia_summary.mia_summary_id = mia_summary.id
                  LEFT JOIN organization_passes_mia_summary ON organization_passes_mia_summary.mia_summary_id = mia_summary.id
                  WHERE
                  (
			        (mia_summary.date IS NULL) AND (mia_summary.content IS NULL)
                  )
                  OR
                  (
                    (mia_summary.bibliography_id IS NULL) AND
                    (man_passes_mia_summary.mia_summary_id IS NULL) AND
                    (organization_passes_mia_summary.mia_summary_id IS NULL)
                  )
                  GROUP BY mia_summary.id ";

        $this->_setSql($query);
        return $this->getAll();
    }

    //Optimization Mia Summary Delete
    public function optimization_mia_summary_delete($mia_summary_id){
        $query = " (SELECT man_passes_mia_summary.man_id AS id, 'man_passes_mia_summary' AS tb_name , '1' AS j FROM man_passes_mia_summary WHERE man_passes_mia_summary.mia_summary_id = '$mia_summary_id' )
                   UNION
                   (SELECT organization_passes_mia_summary.organization_id AS id, 'organization_passes_mia_summary' AS tb_name , '1' AS j FROM organization_passes_mia_summary WHERE organization_passes_mia_summary.mia_summary_id = '$mia_summary_id')";
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                $query = "UPDATE `".$value['tb_name']."` SET mia_summary_id = NULL WHERE mia_summary_id=".$mia_summary_id;
            }else{
                $query = "DELETE FROM `".$value['tb_name']."` WHERE  mia_summary_id=".$mia_summary_id;
            }
            $this->_setSql($query);
            $this->run();
        }
        $delete_table = " DELETE FROM `mia_summary` WHERE  id=".$mia_summary_id;
        $this->_setSql($delete_table);
        $this->run();
    }

    //Optimization Action
    public function optimization_action() {
        $query = "SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
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
                    LEFT JOIN action_has_event ON action_has_event.action_id = `action`.id
                    LEFT JOIN event_has_action ON event_has_action.action_id = `action`.id
                    LEFT JOIN action_has_man ON action_has_man.action_id = `action`.id
                    LEFT JOIN action_has_organization ON action_has_organization.action_id = `action`.id
                    LEFT JOIN action_has_phone ON action_has_phone.action_id = `action`.id
                    LEFT JOIN action_has_weapon ON action_has_weapon.action_id = `action`.id
                    LEFT JOIN action_has_car ON action_has_car.action_id = `action`.id
                    LEFT JOIN action_passes_signal ON action_passes_signal.action_id = `action`.id
                    LEFT JOIN action_has_qualification ON action_has_qualification.action_id = `action`.id
                    LEFT JOIN action_has_criminal_case ON action_has_criminal_case.action_id = `action`.id
                    LEFT JOIN action_to_action ON action_to_action.action_id1 = `action`.id OR action_to_action.action_id2 = `action`.id
                    WHERE
                    (
                        (action.start_date IS NULL ) AND
                        (action.end_date IS NULL ) AND
                        (action.duration_id IS NULL ) AND
                        (action.goal_id IS NULL ) AND
                        (action.terms_id IS NULL ) AND
                        (action.aftermath_id IS NULL ) AND
                        (action.source IS NULL ) AND
                        (action.opened_dou IS NULL ) AND
                        (action_has_qualification.action_id IS NULL)
                    )
                    OR
                    (
                        (action_to_action.action_id1 IS NULL) AND
                        (action.bibliography_id IS NULL) AND
                        (action_has_criminal_case.criminal_case_id IS NULL) AND
                        (action.address_id IS NULL) AND
                        (action_has_event.action_id IS NULL) AND
                        (event_has_action.action_id IS NULL) AND
                        (action_has_man.action_id IS NULL) AND
                        (action_has_organization.action_id IS NULL) AND
                        (action_has_phone.action_id IS NULL) AND
                        (action_has_weapon.action_id IS NULL) AND
                        (action_has_car.action_id IS NULL) AND
                        (action_passes_signal.action_id IS NULL)
                    )
                    GROUP BY action.id ";

        $this->_setSql($query);
        return $this->getAll();
    }
    //Optimization Action Delete
    public function optimization_action_delete($action_id){
        $query = "  (SELECT action_has_man.action_id AS id , 'action_has_man' AS tb_name , '1' AS j FROM action_has_man WHERE action_has_man.action_id = '$action_id' )
                      UNION
                      (SELECT action_has_organization.organization_id AS id, 'action_has_organization' AS tb_name , '1' AS j FROM action_has_organization WHERE action_has_organization.action_id = '$action_id')
                      UNION
                      (SELECT event_has_action.event_id AS id, 'event_has_action' AS tb_name , '1' AS j FROM event_has_action WHERE event_has_action.action_id = '$action_id')
                      UNION
                      (SELECT action_has_event.event_id AS id, 'action_has_event' AS tb_name , '1' AS j FROM action_has_event WHERE action_has_event.action_id = '$action_id')
                      UNION
                      (SELECT action_has_phone.phone_id AS id, 'action_has_phone' AS tb_name , '1' AS j FROM action_has_phone WHERE action_has_phone.action_id = '$action_id')
                      UNION
                      (SELECT action_has_weapon.weapon_id AS id, 'action_has_weapon' AS tb_name , '1' AS j FROM action_has_weapon WHERE action_has_weapon.action_id = '$action_id')
                      UNION
                      (SELECT action_has_car.car_id AS id, 'action_has_car' AS tb_name , '1' AS j FROM action_has_car WHERE action_has_car.action_id = '$action_id')
                      UNION
                      (SELECT action_has_criminal_case.criminal_case_id AS id, 'action_has_criminal_case' AS tb_name , '1' AS j FROM action_has_criminal_case WHERE action_has_criminal_case.action_id = '$action_id')
                      UNION
                      (SELECT action_has_qualification.qualification_id AS id, 'action_has_qualification' AS tb_name , '1' AS j FROM action_has_qualification WHERE action_has_qualification.action_id = '$action_id')
                      UNION
                      (SELECT action_passes_signal.signal_id AS id, 'action_passes_signal' AS tb_name , '1' AS j FROM action_passes_signal WHERE action_passes_signal.action_id = '$action_id')
                      UNION
                      (SELECT action.related_action_id AS id, 'action' AS tb_name , '0' AS j FROM `action` WHERE action.related_action_id  = '$action_id' )
                      UNION
                      (SELECT action_to_action.action_id1 AS id, 'action_to_action' AS tb_name , '1' AS j FROM `action_to_action` WHERE action_to_action.action_id2  = '$action_id' OR action_to_action.action_id1  = '$action_id' )
                      UNION
                      (SELECT action_has_material_content.material_content_id AS id, 'action_has_material_content' AS tb_name , '1' AS j FROM action_has_material_content WHERE action_has_material_content.action_id = '$action_id')
                      ";
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                if($value['tb_name'] == 'action'){
                    $query = "UPDATE `".$value['tb_name']."` SET related_action_id = NULL WHERE related_action_id=".$action_id;
                }else{
                    $query = "UPDATE `".$value['tb_name']."` SET action_id = NULL WHERE action_id=".$action_id;
                }
            }else{
                if($value['tb_name'] == 'action_to_action'){
                    $query = "DELETE FROM action_to_action WHERE action_id1 = '$action_id' OR action_id2 = '$action_id' ";
                }else{
                    $query = "DELETE FROM `".$value['tb_name']."` WHERE  action_id=".$action_id;
                }
            }
            $this->_setSql($query);
            $this->run();
        }
        $delete_table = " DELETE FROM `action` WHERE  id=".$action_id;
        $this->_setSql($delete_table);
        $this->run();
    }
    //Optimization Event
    public function optimization_event() {
        $query = "SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
                    (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
                    LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
                    FROM `event`

                    LEFT JOIN event_has_qualification ON event_has_qualification.event_id = event.id
                    LEFT JOIN event_qualification ON event_qualification.id = event_has_qualification.qualification_id
                    LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
                    LEFT JOIN agency ON agency.id = event.agency_id
                    LEFT JOIN resource ON resource.id = event.resource_id
                    LEFT JOIN event_has_organization ON event_has_organization.event_id = event.id
                    LEFT JOIN event_has_man ON event_has_man.event_id = event.id
                    LEFT JOIN event_has_car ON event_has_car.event_id = event.id
                    LEFT JOIN event_has_weapon ON event_has_weapon.event_id = event.id
                    LEFT JOIN event_has_action ON event_has_action.event_id = event.id
                    LEFT JOIN action_has_event ON action_has_event.event_id = event.id
                    LEFT JOIN event_passes_signal ON event_passes_signal.event_id = event.id
                    LEFT JOIN event_has_criminal_case ON event_has_criminal_case.event_id = event.id
                    WHERE
                    (
			(event.date IS NULL) AND
			(event.aftermath_id IS NULL) AND
			(event.resource_id IS NULL) AND
			(event.agency_id IS NULL) AND
			(event.result IS NULL)

                    )
                    OR
                    (
			(event.bibliography_id IS NULL) AND
			(event.address_id IS NULL) AND
			(event.organization_id IS NULL) AND
			(event_has_criminal_case.criminal_case_id IS NULL) AND
			(event_has_organization.event_id IS NULL) AND
			(event_has_man.event_id IS NULL) AND
			(event_has_car.event_id IS NULL) AND
			(event_has_weapon.event_id IS NULL) AND
			(event_has_action.event_id IS NULL) AND
			(action_has_event.event_id IS NULL) AND
			(event_passes_signal.event_id IS NULL)
                    )
                    GROUP BY event.id ";

        $this->_setSql($query);
        return $this->getAll();
    }
    //Optimization Event Delete
    public function optimization_event_delete($event_id){
        $query = "(SELECT event_has_organization.organization_id AS id, 'event_has_organization' AS tb_name , '1' AS j FROM event_has_organization WHERE event_has_organization.event_id = '$event_id')
                  UNION
                  (SELECT event_has_man.man_id AS id, 'event_has_man' AS tb_name , '1' AS j FROM event_has_man WHERE event_has_man.event_id = '$event_id')
                  UNION
                  (SELECT event_has_car.car_id AS id, 'event_has_car' AS tb_name , '1' AS j FROM event_has_car WHERE event_has_car.event_id = '$event_id')
                  UNION
                  (SELECT event_has_weapon.weapon_id AS id, 'event_has_weapon' AS tb_name , '1' AS j FROM event_has_weapon WHERE event_has_weapon.event_id = '$event_id')
                  UNION
                  (SELECT event_passes_signal.signal_id AS id, 'event_passes_signal' AS tb_name , '1' AS j FROM event_passes_signal WHERE event_passes_signal.event_id = '$event_id')
                  UNION
                  (SELECT event_has_action.action_id AS id, 'event_has_action' AS tb_name , '1' AS j FROM event_has_action WHERE event_has_action.event_id = '$event_id')
                  UNION
                  (SELECT action_has_event.action_id AS id, 'action_has_event' AS tb_name , '1' AS j FROM action_has_event WHERE action_has_event.event_id = '$event_id')
                  UNION
                  (SELECT event_has_criminal_case.criminal_case_id AS id, 'event_has_criminal_case' AS tb_name , '1' AS j FROM event_has_criminal_case WHERE event_has_criminal_case.event_id = '$event_id')
                  UNION
                  (SELECT event_has_qualification.event_id AS id, 'event_has_qualification' AS tb_name , '1' AS j FROM event_has_qualification WHERE event_has_qualification.event_id = '$event_id')
                  ";
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                $query = "UPDATE `".$value['tb_name']."` SET event_id = NULL WHERE action_id=".$event_id;
            }else{
                $query = "DELETE FROM `".$value['tb_name']."` WHERE  event_id=".$event_id;
            }
            $this->_setSql($query);
            $this->run();
        }
        $delete_table = " DELETE FROM `event` WHERE  id=".$event_id;
        $this->_setSql($delete_table);
        $this->run();
    }

    //Optimization Criminal Case
    public function optimization_criminal_case() {
        $query = "SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
			          (SELECT GROUP_CONCAT(worker) FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = criminal_case.id ) AS worker ,
			          (SELECT GROUP_CONCAT(worker_post.name) FROM criminal_case_worker_post
			           LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
			           WHERE criminal_case_worker_post.criminal_case_id = criminal_case.id ) AS worker_post
                    FROM criminal_case
                    LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
                    LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
                    LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
                    LEFT JOIN criminal_case_has_man ON criminal_case_has_man.criminal_case_id = criminal_case.id
                    LEFT JOIN criminal_case_has_organization ON criminal_case_has_organization.criminal_case_id = criminal_case.id
                    LEFT JOIN `event` ON `event`.opened_criminal_case_id = criminal_case.id
                    LEFT JOIN `action` ON `action`.opened_criminal_case_id = criminal_case.id
                    LEFT JOIN `criminal_case_extracted_criminal_case` ON `criminal_case_extracted_criminal_case`.criminal_case_id = criminal_case.id
                    LEFT JOIN `criminal_case_splited_criminal_case` ON `criminal_case_splited_criminal_case`.criminal_case_id = criminal_case.id
                    LEFT JOIN criminal_case_worker ON criminal_case_worker.criminal_case_id = criminal_case.id
                    LEFT JOIN criminal_case_worker_post ON criminal_case_worker_post.criminal_case_id = criminal_case.id
                    LEFT JOIN event_has_criminal_case ON event_has_criminal_case.criminal_case_id = criminal_case.id
                    LEFT JOIN action_has_criminal_case ON action_has_criminal_case.criminal_case_id = criminal_case.id
                    LEFT JOIN criminal_case_has_signal ON criminal_case_has_signal.criminal_case_id = criminal_case.id
                    WHERE
                    (
			    (criminal_case.number IS NULL) AND
			    (criminal_case.opened_date IS NULL) AND
			    (criminal_case.artical IS NULL) AND
			    (criminal_case.opened_agency_id IS NULL) AND
			    (criminal_case.opened_unit_id IS NULL) AND
			    (criminal_case.subunit_id IS NULL) AND
			    (criminal_case.`character` IS NULL) AND
			    (criminal_case.opened_dou IS NULL) AND
			    (criminal_case_worker_post.worker_post_id IS NULL) AND
			    (criminal_case_worker.id IS NULL)
                    )
                    OR
                    (
			    (criminal_case.bibliography_id IS NULL) AND
			    (criminal_case_has_signal.criminal_case_id IS NULL) AND
			    (criminal_case_has_man.criminal_case_id IS NULL) AND
			    (criminal_case_has_organization.criminal_case_id IS NULL) AND
			    (criminal_case_extracted_criminal_case.criminal_case_id IS NULL) AND
			    (criminal_case_splited_criminal_case.criminal_case_id IS NULL) AND
			    (event_has_criminal_case.criminal_case_id IS NULL) AND
			    (action_has_criminal_case.criminal_case_id IS NULL)
                    )
                    GROUP BY criminal_case.id ";

        $this->_setSql($query);
        return $this->getAll();
    }

    //Optimization Criminal Case Delete
    public function optimization_criminal_case_delete($criminal_case_id){
        $query = "(SELECT criminal_case_has_man.man_id AS id, 'criminal_case_has_man' AS tb_name , '1' AS j FROM criminal_case_has_man WHERE criminal_case_has_man.criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_has_organization.organization_id AS id, 'criminal_case_has_organization' AS tb_name , '1' AS j FROM criminal_case_has_organization WHERE criminal_case_has_organization.criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT event_has_criminal_case.criminal_case_id AS id, 'event_has_criminal_case' AS tb_name , '1' AS j FROM event_has_criminal_case WHERE event_has_criminal_case.criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT action_has_criminal_case.criminal_case_id AS id, 'action_has_criminal_case' AS tb_name , '1' AS j FROM action_has_criminal_case WHERE action_has_criminal_case.criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_extracted_criminal_case.criminal_case_id1 AS id, 'criminal_case_extracted_criminal_case' AS tb_name , '1' AS j FROM criminal_case_extracted_criminal_case WHERE criminal_case_extracted_criminal_case.criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_extracted_criminal_case.criminal_case_id AS id, 'criminal_case_extracted_criminal_case' AS tb_name , '1' AS j FROM criminal_case_extracted_criminal_case WHERE criminal_case_extracted_criminal_case.criminal_case_id1 = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_splited_criminal_case.criminal_case_id1 AS id, 'criminal_case_splited_criminal_case' AS tb_name , '1' AS j FROM criminal_case_splited_criminal_case WHERE criminal_case_splited_criminal_case.criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_splited_criminal_case.criminal_case_id AS id, 'criminal_case_splited_criminal_case' AS tb_name , '1' AS j FROM criminal_case_splited_criminal_case WHERE criminal_case_splited_criminal_case.criminal_case_id1 = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_worker.criminal_case_id AS id , 'criminal_case_worker' AS tb_name , '1' AS j FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = '$criminal_case_id' )
                  UNION
                  (SELECT criminal_case_worker_post.criminal_case_id AS id , 'criminal_case_worker_post' AS tb_name , '1' AS j FROM criminal_case_worker_post WHERE criminal_case_worker_post.criminal_case_id = '$criminal_case_id' )
                  UNION
                  (SELECT criminal_case_has_signal.criminal_case_id AS id, 'criminal_case_has_signal' AS tb_name , '1' AS j FROM criminal_case_has_signal WHERE criminal_case_has_signal.criminal_case_id = '$criminal_case_id')";
//        echo $query;
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                $query = "UPDATE `".$value['tb_name']."` SET opened_criminal_case_id = NULL WHERE opened_criminal_case_id=".$criminal_case_id;
            }else{
                if( $value['tb_name'] != 'criminal_case_extracted_criminal_case' || $value['tb_name'] != 'criminal_case_splited_criminal_case' ){
                    $query = "DELETE FROM `".$value['tb_name']."` WHERE  criminal_case_id=".$criminal_case_id;
                }else{
                    $query = "DELETE FROM `".$value['tb_name']."` WHERE  criminal_case_id=".$criminal_case_id." OR criminal_case_id1 = ".$criminal_case_id;
                }
            }
            $this->_setSql($query);
            $this->run();
        }
        $delete_table = " DELETE FROM `criminal_case` WHERE  id=".$criminal_case_id;
        $this->_setSql($delete_table);
        $this->run();
    }

    //Optimization Signal
    public function optimization_signal()  {
        $query = "SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                  COALESCE(`signal`.reg_num,0) AS reg_num,
                                  COALESCE(`signal`.check_line,0) AS check_line,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                (SELECT COUNT(id) FROM keep_signal WHERE signal_id = `signal`.id) AS keep_count,
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
                (SELECT GROUP_CONCAT(DATE_FORMAT(check_date.date,'%d-%m-%Y')) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date

                FROM `signal`

                LEFT JOIN signal_check_worker ON signal_check_worker.signal_id = `signal`.id
                LEFT JOIN worker ON worker.id = signal_check_worker.worker_id

                LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                LEFT JOIN criminal_case_has_signal ON criminal_case_has_signal.signal_id = `signal`.id
                LEFT JOIN man_passed_by_signal ON man_passed_by_signal.signal_id = `signal`.id
                LEFT JOIN signal_has_man ON signal_has_man.signal_id = `signal`.id
                LEFT JOIN organization_passes_by_signal ON organization_passes_by_signal.signal_id = `signal`.id
                LEFT JOIN organization_checked_by_signal ON organization_checked_by_signal.signal_id = `signal`.id
                LEFT JOIN action_passes_signal ON action_passes_signal.signal_id = `signal`.id
                LEFT JOIN keep_signal ON keep_signal.signal_id = `signal`.id
                LEFT JOIN event_passes_signal ON event_passes_signal.signal_id = `signal`.id
                LEFT JOIN signal_checking_worker ON signal_checking_worker.signal_id = `signal`.id
                LEFT JOIN signal_checking_worker_post ON signal_checking_worker_post.signal_id = `signal`.id
                LEFT JOIN signal_worker ON signal_worker.signal_id = `signal`.id
                LEFT JOIN signal_worker_post ON signal_worker_post.signal_id = `signal`.id
                WHERE
                (
                    (signal.reg_num IS NULL) AND
                    (signal.content IS NULL) AND
                    (signal.check_line IS NULL) AND
                    (signal.check_status IS NULL) AND
                    (signal.signal_qualification_id IS NULL) AND
                    (signal.check_agency_id IS NULL) AND
                    (signal.check_unit_id IS NULL) AND
                    (signal.check_subunit_id IS NULL) AND
                    (signal.subunit_date IS NULL) AND
                    (signal.check_date IS NULL) AND
                    (signal.end_date IS NULL) AND
                    (signal.opened_dou IS NULL) AND
                    (signal.opened_agency_id IS NULL) AND
                    (signal.opened_unit_id IS NULL) AND
                    (signal.opened_subunit_id IS NULL) AND
                    (signal.opened_worker_id IS NULL) AND
                    (signal.source_resource_id IS NULL) AND
                    (signal.signal_result_id IS NULL) AND
                    (signal_checking_worker_post.worker_post_id IS NULL) AND
                    (signal_checking_worker.id IS NULL) AND
                    (signal_worker.id IS NULL) AND
                    (signal_worker_post.worker_post_id IS NULL)
                )
                OR
                (
                    (signal.bibliography_id IS NULL) AND
                    (criminal_case_has_signal.signal_id IS NULL) AND
                    (man_passed_by_signal.signal_id IS NULL) AND
                    (organization_checked_by_signal.signal_id IS NULL) AND
                    (action_passes_signal.signal_id IS NULL) AND
                    (signal_has_man.signal_id IS NULL) AND
                    (organization_checked_by_signal.signal_id IS NULL) AND
                    (keep_signal.signal_id IS NULL) AND
                    (event_passes_signal.signal_id IS NULL)
                )
                GROUP BY signal.id ";

        $this->_setSql($query);
        return $this->getAll();
    }

    //Optimization Signal Delete
    public function optimization_signal_delete($signal_id){
        $query = "(SELECT signal_has_man.man_id AS id, 'signal_has_man' AS tb_name , '1' AS j FROM signal_has_man WHERE signal_has_man.signal_id = '$signal_id')
                      UNION
                      (SELECT man_passed_by_signal.man_id AS id, 'man_passed_by_signal' AS tb_name , '1' AS j FROM man_passed_by_signal WHERE man_passed_by_signal.signal_id = '$signal_id')
                      UNION
                      (SELECT organization_checked_by_signal.organization_id AS id, 'organization_checked_by_signal' AS tb_name , '1' AS j FROM organization_checked_by_signal WHERE organization_checked_by_signal.signal_id = '$signal_id')
                      UNION
                      (SELECT organization_passes_by_signal.organization_id AS id, 'organization_passes_by_signal' AS tb_name , '1' AS j FROM organization_passes_by_signal WHERE organization_passes_by_signal.signal_id = '$signal_id')
                      UNION
                      (SELECT criminal_case_has_signal.signal_id AS id, 'criminal_case_has_signal' AS tb_name , '1' AS j FROM criminal_case_has_signal WHERE criminal_case_has_signal.signal_id = '$signal_id')
                      UNION
                      (SELECT action_passes_signal.action_id AS id, 'action_passes_signal' AS tb_name , '1' AS j FROM action_passes_signal WHERE action_passes_signal.signal_id = '$signal_id')
                      UNION
                      (SELECT event_passes_signal.event_id AS id, 'event_passes_signal' AS tb_name , '1' AS j FROM event_passes_signal WHERE event_passes_signal.signal_id = '$signal_id')
                      UNION
                      (SELECT keep_signal.signal_id AS id, 'keep_signal' AS tb_name , '0' AS j FROM keep_signal WHERE keep_signal.signal_id = '$signal_id')
                      UNION
                      (SELECT signal_used_resource.signal_id AS id, 'signal_used_resource' AS tb_name , '1' AS j FROM signal_used_resource WHERE signal_used_resource.signal_id = '$signal_id')
                      UNION
                      (SELECT signal_has_worker.signal_id AS id, 'signal_has_worker' AS tb_name , '1' AS j FROM signal_has_worker WHERE signal_has_worker.signal_id = '$signal_id')
                      UNION
                      (SELECT signal_check_worker.signal_id AS id, 'signal_check_worker' AS tb_name , '1' AS j FROM signal_check_worker WHERE signal_check_worker.signal_id = '$signal_id')
                      UNION
                      (SELECT signal_has_check_date.signal_id AS id, 'signal_has_check_date' AS tb_name , '1' AS j FROM signal_has_check_date WHERE signal_has_check_date.signal_id = '$signal_id')
                      UNION
                      (SELECT signal_has_taken_measure.signal_id AS id, 'signal_has_taken_measure' AS tb_name , '1' AS j FROM signal_has_taken_measure WHERE signal_has_taken_measure.signal_id = '$signal_id')
                      UNION
                      (SELECT signal_id AS id , 'signal_worker' AS tb_name , '1' FROM signal_worker WHERE signal_id = '$signal_id' )
                      UNION
                      (SELECT signal_id AS id , 'signal_worker_post' AS tb_name , '1' FROM signal_worker_post WHERE signal_id = '$signal_id' )
                      UNION
                      (SELECT signal_id AS id , 'signal_checking_worker' AS tb_name , '1' FROM signal_checking_worker WHERE signal_id = '$signal_id' )
                      UNION
                      (SELECT signal_id AS id , 'signal_checking_worker_post' AS tb_name , '1' FROM signal_checking_worker_post WHERE signal_id = '$signal_id' )
        ";
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                $query = " UPDATE `".$value['tb_name']."` SET signal_id = NULL WHERE signal_id='".$signal_id."' ";
            }else{
                $query = "DELETE FROM `".$value['tb_name']."` WHERE  signal_id='".$signal_id."'";
            }
            $this->_setSql($query);
//            var_dump($query);die;
            $this->run();
        }
        $delete_table = " DELETE FROM `signal` WHERE  id='".$signal_id."'";
        $this->_setSql($delete_table);
        $this->run();
    }

    public function optimization_address()  {
        $query = " SELECT	address.* , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
                    FROM address
                    LEFT JOIN region ON region.id = address.region_id
                    LEFT JOIN locality ON locality.id = address.locality_id
                    LEFT JOIN street ON street.id = address.street_id
                    LEFT JOIN city ON city.id = address.city_id
                    LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                    LEFT JOIN man ON man.born_address_id = address.id
                    LEFT JOIN man_has_address ON man_has_address.address_id = address.id
                    LEFT JOIN organization ON organization.address_id = address.id
                    LEFT JOIN organization_has_address ON organization_has_address.address_id = address.id
                    LEFT JOIN car_has_address ON car_has_address.address_id = address.id
                    LEFT JOIN `action` ON `action`.address_id = address.id
                    LEFT JOIN `event` ON `event`.address_id = address.id
                    WHERE
                    (
                        (address.country_id IS NULL) AND
                        (address.region_id IS NULL) AND
                        (address.locality_id IS NULL) AND
                        (address.street_id IS NULL) AND
                        (address.track IS NULL) AND
                        (address.home_num IS NULL) AND
                        (address.housing_num IS NULL) AND
                        (address.apt_num IS NULL) AND
                        (address.country_ate_id IS NULL)
                    )
                    OR
                    (
                        (man.id IS NULL) AND
                        (man_has_address.address_id IS NULL) AND
                        (organization.address_id IS NULL) AND
                        (organization_has_address.address_id IS NULL) AND
                        (car_has_address.address_id IS NULL) AND
                        (action.address_id IS NULL) AND
                        (`event`.address_id IS NULL)
                    )
                    GROUP BY address.id ";

        $this->_setSql($query);
        return $this->getAll();
    }

    //Optimization address Delete
    public function optimization_address_delete($address_id){
        $query = " (SELECT man_has_address.man_id AS id , 'man_has_address' AS tb_name , '1' AS j FROM man_has_address WHERE man_has_address.address_id = '$address_id' )
                   UNION
                   (SELECT action.id AS id , 'action' AS tb_name , '0' AS j FROM `action` WHERE action.address_id = '$address_id' )
                   UNION
                   (SELECT event.id AS id , 'event' AS tb_name , '0' AS j FROM `event` WHERE event.address_id = '$address_id' )
                   UNION
                   (SELECT organization_has_address.organization_id AS id, 'organization_has_address' AS tb_name , '1' AS j FROM organization_has_address WHERE organization_has_address.address_id = '$address_id')
                   UNION
                   (SELECT car_has_address.car_id AS id, 'car_has_address' AS tb_name , '1' AS j FROM car_has_address WHERE car_has_address.address_id = '$address_id')
                   UNION
                   (SELECT man.id AS id, 'man' AS tb_name , '0' AS j FROM man WHERE man.born_address_id = '$address_id')
                   UNION
                   (SELECT organization.id AS id, 'organization' AS tb_name , '0' AS j FROM organization WHERE organization.address_id = '$address_id')";
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                if($value['tb_name'] == 'man'){
                    $query = "UPDATE `".$value['tb_name']."` SET born_address_id = NULL WHERE born_address_id=".$address_id;
                }else{
                    $query = "UPDATE `".$value['tb_name']."` SET address_id = NULL WHERE address_id=".$address_id;
                }
            }else{
                $query = "DELETE FROM `".$value['tb_name']."` WHERE  address_id=".$address_id;
            }
            $this->_setSql($query);
            $this->run();
        }
        $delete_table = " DELETE FROM `address` WHERE  id=".$address_id;
        $this->_setSql($delete_table);
        $this->run();
    }

    //Optimization Keep Signal
    public function optimization_keep_signal() {
        $query = "SELECT keep_signal.* , agency.name AS agency, unit.name AS unit, sub_unit.name AS sub_unit,passed_sub_unit.name as pased_sub_unit ,
                       (SELECT GROUP_CONCAT(worker) FROM keep_signal_worker WHERE keep_signal_worker.keep_signal_id = keep_signal.id ) AS worker ,
               (SELECT GROUP_CONCAT(worker_post.name) FROM keep_signal_worker_post
                LEFT JOIN worker_post ON worker_post.id = keep_signal_worker_post.worker_post_id
                WHERE keep_signal_worker_post.keep_signal_id = keep_signal.id ) AS worker_post

                    FROM keep_signal
                    LEFT JOIN keep_signal_has_worker ON keep_signal_has_worker.keep_signal_id = keep_signal.id
                    LEFT JOIN worker ON worker.id = keep_signal_has_worker.worker_id
                    LEFT JOIN agency ON agency.id = keep_signal.agency_id
                    LEFT JOIN agency AS unit ON unit.id = keep_signal.unit_id
                    LEFT JOIN agency AS sub_unit ON sub_unit.id = keep_signal.sub_unit_id
                    LEFT JOIN agency AS passed_sub_unit ON passed_sub_unit.id = keep_signal.pased_sub_unit
                    LEFT JOIN keep_signal_worker ON keep_signal_worker.keep_signal_id = keep_signal.id
                    LEFT JOIN keep_signal_worker_post ON keep_signal_worker_post.keep_signal_id = keep_signal.id
                    WHERE
                     (
                    (keep_signal.start_date IS NULL) AND
                    (keep_signal.end_date IS NULL) AND
                    (keep_signal.pass_date IS NULL) AND
                    (keep_signal.pased_sub_unit IS NULL) AND
                    (keep_signal.agency_id IS NULL) AND
                    (keep_signal.unit_id IS NULL) AND
                    (keep_signal.sub_unit_id IS NULL) AND
                    (keep_signal_worker_post.worker_post_id IS NULL) AND
                    (keep_signal_worker.id IS NULL)
                )
                OR
                (
                    (keep_signal.signal_id IS NULL)
                )
                    GROUP BY keep_signal.id ";

        $this->_setSql($query);
        return $this->getAll();
    }

    //Optimization Keep Signal Delete
    public function optimization_keep_signal_delete($keep_signal_id){
        $query = "DELETE FROM `keep_signal_worker` WHERE keep_signal_id=".$keep_signal_id;
        $this->_setSql($query);
        $this->run();
        $query = "DELETE FROM `keep_signal_worker_post` WHERE keep_signal_id=".$keep_signal_id;
        $this->_setSql($query);
        $this->run();
        $delete_table = " DELETE FROM `keep_signal` WHERE  id=".$keep_signal_id;
        $this->_setSql($delete_table);
        $this->run();
    }

    public function optimization_external_sign() {
        $query = "SELECT GROUP_CONCAT(sign.name) AS `name` ,  man_external_sign_has_sign.*
                    FROM man_external_sign_has_sign
                    LEFT JOIN `sign` ON man_external_sign_has_sign.sign_id = sign.id
                    WHERE
                    (
                        (man_external_sign_has_sign.fixed_date IS NULL) AND
                        (man_external_sign_has_sign.sign_id IS NULL) AND
                        (sign.name IS NULL)
                    )
                    OR
                    (
                        (man_external_sign_has_sign.man_id IS NULL)
                    )
                    GROUP BY man_external_sign_has_sign.id ";

        $this->_setSql($query);
        return $this->getAll();
    }

    public function optimization_external_sign_delete($external_sign_id){

        $delete_table = " DELETE FROM `man_external_sign_has_sign` WHERE  id=".$external_sign_id.";";
        $this->_setSql($delete_table);
        $this->run();
    }

    public function optimization_man_bean_country() {
        $query = "SELECT man_bean_country.* , country_ate.name AS country_ate, goal.name AS goal, region.name AS region, locality.name AS locality
                    FROM man_bean_country
                    LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
                    LEFT JOIN goal ON goal.id = man_bean_country.goal_id
                    LEFT JOIN region ON region.id = man_bean_country.region_id
                    LEFT JOIN locality ON locality.id = man_bean_country.locality_id
                    WHERE
                    (
                        (man_bean_country.country_ate_id IS NULL) AND
                        (man_bean_country.goal_id IS NULL) AND
                        (man_bean_country.entry_date IS NULL) AND
                        (man_bean_country.exit_date IS NULL) AND
                        (man_bean_country.region_id IS NULL) AND
                        (man_bean_country.locality_id IS NULL)
                    )
                    OR
                    (
                        (man_bean_country.man_id IS NULL)
                    )
                    GROUP BY man_bean_country.id ";

        $this->_setSql($query);
        return $this->getAll();
    }

    public function optimization_man_bean_country_delete($man_bean_country_id){
        $delete_table = " DELETE FROM `man_bean_country` WHERE id = ".$man_bean_country_id.";";
        $this->_setSql($delete_table);
        $this->run();
    }

    public function optimization_phone() {
        $query = "SELECT phone.* ,
                    (SELECT GROUP_CONCAT(`character`.name) FROM man_has_phone
                    LEFT JOIN `character` ON man_has_phone.character_id = `character`.id WHERE man_has_phone.phone_id = phone.id
                    GROUP BY phone_id) AS character_man ,
                    (SELECT GROUP_CONCAT(`character`.name) FROM organization_has_phone
                    LEFT JOIN `character` ON organization_has_phone.character_id = `character`.id WHERE organization_has_phone.phone_id = phone.id
                    GROUP BY phone_id) AS character_organization
                    FROM phone
                    LEFT JOIN man_has_phone ON man_has_phone.phone_id = phone.id
                    LEFT JOIN organization_has_phone ON organization_has_phone.phone_id = phone.id
                    LEFT JOIN action_has_phone ON action_has_phone.phone_id = phone.id
                    WHERE
                    (
                        (phone.number IS NULL) AND
                        (phone.more_data IS NULL)
                    )
                    OR
                    (
                        (man_has_phone.phone_id IS NULL) AND
                        (organization_has_phone.phone_id IS NULL) AND
                        (action_has_phone.phone_id IS NULL)
                    )
                    GROUP BY phone.id ";

        $this->_setSql($query);
        return $this->getAll();
    }

    public function optimization_phone_delete($phone_id){
        $query = " (SELECT man_has_phone.man_id AS id, 'man_has_phone' AS tb_name, '1' AS j FROM man_has_phone WHERE man_has_phone.phone_id = '$phone_id' )
                   UNION
                   (SELECT organization_has_phone.organization_id AS id, 'organization_has_phone' AS tb_name, '1' AS j FROM organization_has_phone WHERE organization_has_phone.phone_id = '$phone_id')
                   UNION
                   (SELECT action_has_phone.action_id AS id, 'action_has_phone' AS tb_name, '1' AS j FROM action_has_phone WHERE action_has_phone.phone_id = '$phone_id') ";
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                $query = "UPDATE `".$value['tb_name']."` SET phone_id = NULL WHERE phone_id=".$phone_id;
            }else{
                $query = "DELETE FROM `".$value['tb_name']."` WHERE  phone_id=".$phone_id;
            }
            $this->_setSql($query);
            $this->run();
        }
        $delete_table = " DELETE FROM `phone` WHERE  id=".$phone_id;
        $this->_setSql($delete_table);
        $this->run();
    }

    /////////////   Optimization for Email   /////////////////
    public function optimization_email() {
        $query = "SELECT email.* FROM email
                    LEFT JOIN man_has_email ON man_has_email.email_id = email.id
                    LEFT JOIN organization_has_email ON organization_has_email.email_id = email.id
                    WHERE
                    (
                        (email.address IS NULL)
                    )
                    OR
                    (
                        (man_has_email.email_id IS NULL) AND
                        (organization_has_email.email_id IS NULL)
                    )
                    GROUP BY email.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function optimization_email_delete($email_id){
        $query = " (SELECT man_has_email.man_id AS id, 'man' AS tb_name, '1' AS j FROM man_has_email WHERE man_has_email.email_id = '$email_id' )
                  UNION
                  (SELECT organization_has_email.organization_id AS id, 'organization' AS tb_name, '1' AS j FROM organization_has_email WHERE organization_has_email.email_id = '$email_id') ";
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                $query = "UPDATE `".$value['tb_name']."` SET email_id = NULL WHERE email_id=".$email_id;
            }else{
                $query = "DELETE FROM `".$value['tb_name']."` WHERE  email_id=".$email_id;
            }
            $this->_setSql($query);
            $this->run();
        }
        $delete_table = " DELETE FROM `email` WHERE  id=".$email_id;
        $this->_setSql($delete_table);
        $this->run();
    }



    public function optimization_work_activity() {
        $query = "SELECT organization_has_man.id,organization_has_man.title, organization_has_man.start_date, organization_has_man.end_date, organization_has_man.period
                    FROM organization_has_man
                    WHERE
                    (
                        (organization_has_man.title IS NULL) AND
                        (organization_has_man.start_date IS NULL) AND
                        (organization_has_man.end_date IS NULL) AND
                        (organization_has_man.period IS NULL)
                    )
                    OR
                    (
                        (organization_has_man.man_id IS NULL) AND
                        (organization_has_man.organization_id IS NULL)
                    )
                    GROUP BY organization_has_man.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function optimization_work_activity_delete($work_activity_id){
        $delete_table = " DELETE FROM `organization_has_man` WHERE id = ".$work_activity_id.";";
        $this->_setSql($delete_table);
        $this->run();
    }

    public function optimization_objects_relation() {
        $query = "SELECT objects_relation.*, relation_type.name AS relation_type_id
                    FROM objects_relation
                    LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id
                    LEFT JOIN man ON ( (objects_relation.first_object_id = man.id AND objects_relation.first_object_type = 'man') OR
				       (objects_relation.second_object_id = man.id AND objects_relation.second_obejct_type = 'man'))
                    LEFT JOIN organization ON ( (objects_relation.first_object_id = organization.id AND objects_relation.first_object_type = 'organization') OR
                                                (objects_relation.second_object_id = organization.id AND objects_relation.second_obejct_type = 'organization'))
                    WHERE
                    (
                        (man.id IS NULL) AND
                        (organization.id IS NULL)
                    )
                    GROUP BY objects_relation.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function optimization_objects_relation_delete($objects_relation_id){
        $delete_table = " DELETE FROM `objects_relation` WHERE id = ".$objects_relation_id.";";
        $this->_setSql($delete_table);
        $this->run();
    }

    public function optimization_car() {
        $query = "SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                    FROM car
                    LEFT JOIN car_category ON car_category.id = car.category_id
                    LEFT JOIN car_mark ON car_mark.id = car.mark_id
                    LEFT JOIN color ON color.id = car.color_id
                    LEFT JOIN man_has_car ON man_has_car.car_id = car.id
                    LEFT JOIN man_use_car ON man_use_car.car_id = car.id
                    LEFT JOIN organization_has_car ON organization_has_car.car_id = car.id
                    LEFT JOIN car_has_address ON car_has_address.car_id = car.id
                    LEFT JOIN action_has_car ON action_has_car.car_id = car.id
                    LEFT JOIN event_has_car ON event_has_car.car_id = car.id
                    WHERE
                    (
                        (car.number IS NULL) AND
                        (car.note IS NULL) AND
                        (car.category_id IS NULL) AND
                        (car.mark_id IS NULL) AND
                        (car.color_id IS NULL) AND
                        (car.count IS NULL)
                    )
                    OR
                    (
                        (man_has_car.car_id IS NULL) AND
                        (man_use_car.car_id IS NULL) AND
                        (organization_has_car.car_id IS NULL) AND
                        (car_has_address.car_id IS NULL) AND
                        (action_has_car.car_id IS NULL) AND
                        (event_has_car.car_id IS NULL)
                    )
                    GROUP BY car.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function optimization_car_delete($car_id){
        $query = " (SELECT man_has_car.man_id AS id, 'man_has_car' AS tb_name, '1' AS j FROM man_has_car WHERE man_has_car.car_id = '$car_id' )
                  UNION
                  (SELECT man_use_car.man_id AS id, 'man_use_car' AS tb_name, '1' AS j FROM man_use_car WHERE man_use_car.car_id = '$car_id')
                  UNION
                  (SELECT organization_has_car.car_id AS id, 'organization_has_car' AS tb_name, '1' AS j FROM organization_has_car WHERE organization_has_car.car_id = '$car_id')
                  UNION
                  (SELECT action_has_car.car_id AS id, 'action_has_car' AS tb_name, '1' AS j FROM action_has_car WHERE action_has_car.car_id = '$car_id')
                  UNION
                  (SELECT event_has_car.car_id AS id, 'event_has_car' AS tb_name, '1' AS j FROM event_has_car WHERE event_has_car.car_id = '$car_id')
                  UNION
                  (SELECT car_has_address.car_id AS id, 'car_has_address' AS tb_name, '1' AS j FROM car_has_address WHERE car_has_address.car_id = '$car_id')
                  ";
        $this->_setSql($query);
        $data = $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                $query = "UPDATE `".$value['tb_name']."` SET car_id = NULL WHERE car_id=".$car_id;
            }else{
                $query = "DELETE FROM `".$value['tb_name']."` WHERE  car_id=".$car_id;
            }
            $this->_setSql($query);
            $this->run();
        }
        $delete_table = " DELETE FROM `car` WHERE id = ".$car_id.";";
        $this->_setSql($delete_table);
        $this->run();
    }

    public function optimization_weapon() {
        $query = " SELECT weapon.* FROM weapon
                  LEFT JOIN man_has_weapon ON man_has_weapon.weapon_id = weapon.id
                  LEFT JOIN organization_has_weapon ON organization_has_weapon.weapon_id = weapon.id
                  LEFT JOIN action_has_weapon ON action_has_weapon.weapon_id = weapon.id
                  LEFT JOIN event_has_weapon ON event_has_weapon.weapon_id = weapon.id
                  WHERE
                  (
                      (weapon.category IS NULL) AND
                      (weapon.view IS NULL) AND
                      (weapon.type IS NULL) AND
                      (weapon.model IS NULL) AND
                      (weapon.reg_num IS NULL) AND
                      (weapon.count IS NULL)
                  )
                  OR
                  (
                      (man_has_weapon.weapon_id IS NULL) AND
                      (organization_has_weapon.weapon_id IS NULL) AND
                      (action_has_weapon.weapon_id IS NULL) AND
                      (event_has_weapon.weapon_id IS NULL)
                  )
                  GROUP BY weapon.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function optimization_weapon_delete($weapon_id){
        $query = " (SELECT man_has_weapon.weapon_id AS id, 'man_has_weapon' AS tb_name, '1' AS j FROM man_has_weapon WHERE man_has_weapon.weapon_id = '$weapon_id' )
                  UNION
                  (SELECT organization_has_weapon.weapon_id AS id, 'organization_has_weapon' AS tb_name, '1' AS j FROM organization_has_weapon WHERE organization_has_weapon.weapon_id = '$weapon_id')
                  UNION
                  (SELECT action_has_weapon.weapon_id AS id, 'action_has_weapon' AS tb_name, '1' AS j FROM action_has_weapon WHERE action_has_weapon.weapon_id = '$weapon_id')
                  UNION
                  (SELECT event_has_weapon.weapon_id AS id, 'event_has_weapon' AS tb_name, '1' AS j FROM event_has_weapon WHERE event_has_weapon.weapon_id = '$weapon_id')
                  ";
        $this->_setSql($query);
        $data = $this->getAll();
        foreach($data as $value){
            if($value['j'] == 0){
                $query = "UPDATE `".$value['tb_name']."` SET weapon_id = NULL WHERE weapon_id=".$weapon_id;
            }else{
                $query = "DELETE FROM `".$value['tb_name']."` WHERE  weapon_id=".$weapon_id;
            }
            $this->_setSql($query);
            $this->run();
        }

        $delete_table = " DELETE FROM `weapon` WHERE id = ".$weapon_id.";";
        $this->_setSql($delete_table);
        $this->run();
    }

    public function userLogging($data) {
        $query = " SELECT log.*,user.* ,log.created_at as created_at  FROM `users`
                            LEFT JOIN `log` ON users.id = log.user_id
                           ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1';
        $sDate = '';
        $eDate = '';
        if(isset($data['sort'])){
            if($data['sort'][0]['field'] == 'created_at'){
                $data['sort'][0]['field'] = '`log`.`created_at`';
            }
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY log.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
    //            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    if(!isset($filter['logic'])){
                        if($filter['field'] == 'created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $filter['field'] = 'log`.`created_at';
                            $date = new DateTime($filter['value']);
                            $filter['value'] = $date->format('Y-m-d');
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
                        }elseif($filter['operator'] == 'neq'){
                            $conditions = " AND $sDate`".$filter['field']."`$eDate != '".$filter['value']."' ";
                        }elseif($filter['operator'] == 'contains'){
                            $conditions = " AND `".$filter['field']."` LIKE '%".$filter['value']."%' ";
                        }elseif($filter['operator'] == 'startswith'){
                            $conditions = " AND `".$filter['field']."` LIKE '".$filter['value']."%' ";
                        }else{
                            $op1 = '';
                            switch($filter['operator']){
                                case 'eq': $op1 = '=';break;
                                case 'neq': $op1 = '!=';break;
                                case 'gt': $op1 = '>';break;
                                case 'gte': $op1 = '>=';break;
                                case 'lt': $op1 = '<';break;
                                case 'lte': $op1 = '<=';break;
                            }
                            if( ($filter['value'] == ' ' || $filter['value'] == '1970-01-01') && $filter['operator'] == 'eq'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                            }
                        }
                    }else{
                        $op1 = ''; $op2 ='';
                        if($filter['filters'][0]['field'] == 'created_at'){
                            $filter['filters'][0]['field'] = 'log`.`created_at';
                        }
                        if($filter['filters'][1]['field'] == 'created_at'){
                            $filter['filters'][1]['field'] = 'log`.`created_at';
                        }
                        $sDate = 'DATE(';
                        $eDate = ')';
                        switch($filter['filters'][0]['operator']){
                            case 'eq': $op1 = '=';break;
                            case 'neq': $op1 = '!=';break;
                            case 'gt': $op1 = '>';break;
                            case 'gte': $op1 = '>=';break;
                            case 'lt': $op1 = '<';break;
                            case 'lte': $op1 = '<=';break;
                        }
                        switch($filter['filters'][1]['operator']){
                            case 'eq': $op2 = '=';break;
                            case 'neq': $op2 = '!=';break;
                            case 'gt': $op2 = '>';break;
                            case 'gte': $op2 = '>=';break;
                            case 'lt': $op2 = '<';break;
                            case 'lte': $op2 = '<=';break;
                        }
                        if(strlen($filter['filters'][1]['value'])>0){
                            $dateParse = new DateTime($filter['filters'][0]['value']);
                            $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                            $dateParse = new DateTime($filter['filters'][1]['value']);
                            $filter['filters'][1]['value'] = $dateParse->format('Y-m-d');
                            $conditions = " AND ($sDate`".$filter['filters'][0]['field']."`$eDate $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   $sDate`".$filter['filters'][1]['field']."`$eDate $op2 '".$filter['filters'][1]['value']."') ";
                        }else{
                            $dateParse = new DateTime($filter['filters'][0]['value']);
                            $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                            $conditions = " AND $sDate`".$filter['filters'][0]['field']."`$eDate $op1 '".$filter['filters'][0]['value']."' ";
                        }
                        $filter['field'] = $filter['filters'][0]['field'];
                    }
                    $where .= $conditions;

                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (log.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countlogging($data){
        $query = " SELECT log.*,users.* ,log.created_at as created_at  FROM `users`
                            LEFT JOIN `log` ON users.id = log.user_id
                           ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1';
        $sDate = '';
        $eDate = '';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
                //            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    if(!isset($filter['logic'])){
                        if($filter['field'] == 'created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $filter['field'] = 'log`.`created_at';
                            $date = new DateTime($filter['value']);
                            $filter['value'] = $date->format('Y-m-d');
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
                        }elseif($filter['operator'] == 'neq'){
                            $conditions = " AND $sDate`".$filter['field']."`$eDate != '".$filter['value']."' ";
                        }elseif($filter['operator'] == 'contains'){
                            $conditions = " AND `".$filter['field']."` LIKE '%".$filter['value']."%' ";
                        }elseif($filter['operator'] == 'startswith'){
                            $conditions = " AND `".$filter['field']."` LIKE '".$filter['value']."%' ";
                        }else{
                            $op1 = '';
                            switch($filter['operator']){
                                case 'eq': $op1 = '=';break;
                                case 'neq': $op1 = '!=';break;
                                case 'gt': $op1 = '>';break;
                                case 'gte': $op1 = '>=';break;
                                case 'lt': $op1 = '<';break;
                                case 'lte': $op1 = '<=';break;
                            }
                            if( ($filter['value'] == ' ' || $filter['value'] == '1970-01-01') && $filter['operator'] == 'eq'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                            }
                        }
                    }else{
                        $op1 = ''; $op2 ='';
                        if($filter['filters'][0]['field'] == 'created_at'){
                            $filter['filters'][0]['field'] = 'log`.`created_at';
                        }
                        if($filter['filters'][1]['field'] == 'created_at'){
                            $filter['filters'][1]['field'] = 'log`.`created_at';
                        }
                        $sDate = 'DATE(';
                        $eDate = ')';
                        switch($filter['filters'][0]['operator']){
                            case 'eq': $op1 = '=';break;
                            case 'neq': $op1 = '!=';break;
                            case 'gt': $op1 = '>';break;
                            case 'gte': $op1 = '>=';break;
                            case 'lt': $op1 = '<';break;
                            case 'lte': $op1 = '<=';break;
                        }
                        switch($filter['filters'][1]['operator']){
                            case 'eq': $op2 = '=';break;
                            case 'neq': $op2 = '!=';break;
                            case 'gt': $op2 = '>';break;
                            case 'gte': $op2 = '>=';break;
                            case 'lt': $op2 = '<';break;
                            case 'lte': $op2 = '<=';break;
                        }
                        if(strlen($filter['filters'][1]['value'])>0){
                            $dateParse = new DateTime($filter['filters'][0]['value']);
                            $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                            $dateParse = new DateTime($filter['filters'][1]['value']);
                            $filter['filters'][1]['value'] = $dateParse->format('Y-m-d');
                            $conditions = " AND ($sDate`".$filter['filters'][0]['field']."`$eDate $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   $sDate`".$filter['filters'][1]['field']."`$eDate $op2 '".$filter['filters'][1]['value']."') ";
                        }else{
                            $dateParse = new DateTime($filter['filters'][0]['value']);
                            $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                            $conditions = " AND $sDate`".$filter['filters'][0]['field']."`$eDate $op1 '".$filter['filters'][0]['value']."' ";
                        }
                        $filter['field'] = $filter['filters'][0]['field'];
                    }
                    $where .= $conditions;

                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (log.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }
}