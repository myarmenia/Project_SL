<?php

namespace App\Models\ModelInclude;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdvancedsearchModel extends Model
{
    use HasFactory;



    public function searchKeepSignal($data){
        $query = " SELECT keep_signal.* , agency.name AS agency, unit.name AS unit, sub_unit.name AS sub_unit,passed_sub_unit.name AS pased_sub_unit,
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

            WHERE 1=1 ";

        if(isset($data['keep_signal'])){
            if(count($data['keep_signal']) == 1){
                $query .= " AND keep_signal.id = '{$data['keep_signal'][0]}' ";
            }else{
                $query .= " AND keep_signal.id IN (".implode(',',$data['keep_signal'])." )";
            }
        }

        if(isset($data['signal'])){
            if(count($data['signal'])){
                $query .= " AND keep_signal.signal_id = '{$data['signal'][0]}' ";
            }else{
                $query .= " AND keep_signal.signal_id IN (".implode(',',$data['signal'])." )";
            }
        }

        $query .= " GROUP BY (keep_signal.id) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchBibliography($data){
        $query = " SELECT bibliography.* ,  CONCAT(`user`.first_name, ' ',`user`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name ,
	                                  (SELECT COUNT(DISTINCT file_id) FROM bibliography_has_file WHERE bibliography_id = `bibliography`.id) AS file_count,
	                                  (SELECT GROUP_CONCAT(country.name) FROM bibliography_has_country
                                        LEFT JOIN country ON bibliography_has_country.country_id = country.id WHERE bibliography_has_country.bibliography_id = `bibliography`.id
                                        GROUP BY bibliography_id) AS country
                FROM bibliography
                LEFT JOIN `user` ON `user`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                LEFT JOIN man_has_bibliography ON man_has_bibliography.bibliography_id = bibliography.id
                LEFT JOIN organization_has_bibliography ON organization_has_bibliography.bibliography_id = bibliography.id

                LEFT JOIN control ON control.bibliography_id = bibliography.id
                LEFT JOIN mia_summary ON mia_summary.bibliography_id = bibliography.id
                LEFT JOIN `action` ON `action`.bibliography_id = bibliography.id
                LEFT JOIN `event` ON `event`.bibliography_id = bibliography.id
                LEFT JOIN criminal_case ON criminal_case.bibliography_id = bibliography.id
                LEFT JOIN `signal` ON `signal`.bibliography_id = bibliography.id

                WHERE 1=1 ";

        if(isset($data['bibliography'])){
            if(count($data['bibliography']) == 1){
                $query .= " AND bibliography.id = '{$data['bibliography'][0]}' ";
            }else{
                $query .= " AND bibliography.id IN (".implode(',',$data['bibliography'])." )";
            }
        }

        if(isset($data['control'])){
            if(count($data['control']) == 1){
                $query .= " AND control.id = '{$data['control'][0]}' ";
            }else{
                $query .= " AND control.id IN (".implode(',',$data['control'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND man_has_bibliography.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND man_has_bibliography.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND organization_has_bibliography.organization_id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND organization_has_bibliography.organization_id IN (".implode(',',$data['organization'])." )";
            }
        }

        if(isset($data['mia_summary'])){
            if(count($data['mia_summary']) == 1){
                $query .= " AND mia_summary.id = '{$data['mia_summary'][0]}' ";
            }else{
                $query .= " AND mia_summary.id IN (".implode(',',$data['mia_summary'])." )";
            }
        }

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND action.id = '{$data['action'][0]}' ";
            }else{
                $query .= " AND action.id IN (".implode(',',$data['action'])." )";
            }
        }

        if(isset($data['event'])){
            if(count($data['event']) == 1){
                $query .= " AND event.id = '{$data['event'][0]}' ";
            }else{
                $query .= " AND event.id IN (".implode(',',$data['event'])." )";
            }
        }

        if(isset($data['criminal_case'])){
            if(count($data['criminal_case']) == 1){
                $query .= " AND criminal_case.id = '{$data['criminal_case'][0]}' ";
            }else{
                $query .= " AND criminal_case.id IN (".implode(',',$data['criminal_case'])." )";
            }
        }

        if(isset($data['signal'])){
            if(count($data['signal']) == 1){
                $query .= " AND signal.id = '{$data['signal'][0]}' ";
            }else{
                $query .= " AND signal.id IN (".implode(',',$data['signal'])." )";
            }
        }

        $query .= " GROUP BY (bibliography.id) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchMan($data){
        $query = "SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource , man_has_bibliography.bibliography_id AS bibliography_id,
                          locality.name AS locality_id , region.name AS region_id , country_ate.name AS country_ate,
                          (SELECT COUNT(*) FROM man_external_sign_has_photo WHERE man_external_sign_has_photo.man_id = man.id) AS photo_count,
                          SUBSTR(birthday,1,4) AS birthday_y,SUBSTR(birthday,6,2) AS birthday_m,SUBSTR(birthday,9,2) AS birthday_d,
                                  (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
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
                                  GROUP BY man_id) AS middle_name ,
                                  (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                  LEFT JOIN passport ON man_has_passport.passport_id = passport.id
                                  WHERE man_has_passport.man_id = man.id
                                   GROUP BY man_id) AS passport,
                                  (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                  LEFT JOIN country ON man_belongs_country.country_id = country.id
                                  WHERE man_belongs_country.man_id = man.id
                                   GROUP BY man_id) AS man_belongs_country ,
                                    (SELECT GROUP_CONCAT(country.name) FROM country_search_man
                                  LEFT JOIN country ON country_search_man.country_id = country.id
                                  WHERE country_search_man.man_id = man.id
                                   GROUP BY man_id) AS country_search_man ,
                                  (SELECT GROUP_CONCAT(education.name) FROM man_has_education
                                  LEFT JOIN education ON man_has_education.education_id = education.id
                                  WHERE man_has_education.man_id = man.id
                                   GROUP BY man_id) AS education ,
                                  (SELECT GROUP_CONCAT(`language`.name) FROM man_knows_language
                                  LEFT JOIN `language` ON man_knows_language.language_id = `language`.id
                                  WHERE man_knows_language.man_id = man.id
                                   GROUP BY man_id) AS man_knows_language ,
                                  (SELECT GROUP_CONCAT(party.name) FROM man_has_party
                                  LEFT JOIN party ON man_has_party.party_id = party.id
                                  WHERE man_has_party.man_id = man.id
                                   GROUP BY man_id) AS party ,
                                  (SELECT GROUP_CONCAT(nickname.name) FROM man_has_nickname
                                  LEFT JOIN nickname ON man_has_nickname.nickname_id = nickname.id
                                  WHERE man_has_nickname.man_id = man.id
                                   GROUP BY man_id) AS nickname ,
                                   (SELECT GROUP_CONCAT(LEFT(more_data_man.text,10)) FROM more_data_man
                                  WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id
                                  WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year
                  FROM man
                  LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man.id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  LEFT JOIN man_has_address ON man_has_address.man_id = man.id
                  LEFT JOIN man_has_phone ON man_has_phone.man_id = man.id
                  LEFT JOIN organization_has_man ON organization_has_man.man_id = man.id
                  LEFT JOIN man_bean_country ON man_bean_country.man_id = man.id
                  LEFT JOIN man_external_sign_has_sign ON man_external_sign_has_sign.man_id = man.id
                  LEFT JOIN objects_relation ON ( (objects_relation.first_object_id = man.id AND objects_relation.first_object_type = 'man') OR
                                                  (objects_relation.second_object_id = man.id AND objects_relation.second_obejct_type = 'man'))
                  LEFT JOIN action_has_man ON action_has_man.man_id = man.id
                  LEFT JOIN event_has_man ON event_has_man.man_id = man.id
                  LEFT JOIN signal_has_man ON signal_has_man.man_id = man.id
                  LEFT JOIN man_passed_by_signal ON man_passed_by_signal.man_id = man.id
                  LEFT JOIN criminal_case_has_man ON criminal_case_has_man.man_id = man.id
                  LEFT JOIN man_passes_mia_summary ON man_passes_mia_summary.man_id = man.id
                  LEFT JOIN man_has_car ON man_has_car.man_id = man.id
                  LEFT JOIN man_use_car ON man_use_car.man_id = man.id
                  LEFT JOIN man_has_weapon ON man_has_weapon.man_id = man.id
                  LEFT JOIN man_has_email ON man_has_email.man_id = man.id
                  LEFT JOIN address ON address.id = man.born_address_id
                  LEFT JOIN locality ON locality.id = address.locality_id
                  LEFT JOIN region ON region.id = address.region_id
                  LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  LEFT JOIN man_to_man AS man1 ON man1.man_id1 = man.id
                  LEFT JOIN man_to_man AS man2 ON man1.man_id2 = man.id
                  WHERE 1=1 ";

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND man.id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND man.id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['address'])){
            if(count($data['address']) == 1){
                $query .= " AND ( man.born_address_id = '{$data['address'][0]}' OR man_has_address.address_id = '{$data['address'][0]}' )";
            }else{
                $query .= " AND ( man.born_address_id IN (".implode(',',$data['address'])." ) OR man_has_address.address_id IN (".implode(',',$data['address'])." ) ) ";
            }
        }

        if(isset($data['phone'])){
            if(count($data['phone']) == 1){
                $query .= " AND man_has_phone.phone_id = '{$data['phone'][0]}' ";
            }else{
                $query .= " AND man_has_phone.phone_id IN (".implode(',',$data['phone'])." )";
            }
        }

        if(isset($data['work_activity'])){
            if(count($data['work_activity']) == 1){
                $query .= " AND organization_has_man.id = '{$data['work_activity'][0]}' ";
            }else{
                $query .= " AND organization_has_man.id IN (".implode(',',$data['work_activity'])." )";
            }
        }

        if(isset($data['man_bean_country'])){
            if(count($data['man_bean_country']) == 1){
                $query .= " AND man_bean_country.id = '{$data['man_bean_country'][0]}' ";
            }else{
                $query .= " AND man_bean_country.id IN (".implode(',',$data['man_bean_country'])." )";
            }
        }

        if(isset($data['external_sign'])){
            if(count($data['external_sign']) == 1){
                $query .= " AND man_external_sign_has_sign.id = '{$data['external_sign'][0]}' ";
            }else{
                $query .= " AND man_external_sign_has_sign.id IN (".implode(',',$data['external_sign'])." )";
            }
        }

        if(isset($data['objects_relation'])){
            if(count($data['objects_relation']) == 1){
                $query .= " AND objects_relation.id = '{$data['objects_relation'][0]}' ";
            }else{
                $query .= " AND objects_relation.id IN (".implode(',',$data['objects_relation'])." )";
            }
        }

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND action_has_man.action_id = '{$data['action'][0]}' ";
            }else{
                $query .= " AND action_has_man.action_id IN (".implode(',',$data['action'])." )";
            }
        }

        if(isset($data['event'])){
            if(count($data['event']) == 1){
                $query .= " AND event_has_man.event_id = '{$data['event'][0]}' ";
            }else{
                $query .= " AND event_has_man.event_id IN (".implode(',',$data['event'])." )";
            }
        }

        if(isset($data['signal'])){
            if(count($data['signal']) == 1){
                $query .= " AND ( man_passed_by_signal.signal_id = '{$data['signal'][0]}' OR signal_has_man.signal_id = '{$data['signal'][0]}' )";
            }else{
                $query .= " AND ( man_passed_by_signal.signal_id IN (".implode(',',$data['signal'])." ) OR signal_has_man.signal_id IN (".implode(',',$data['signal'])." ) ) ";
            }
        }

        if(isset($data['criminal_case'])){
            if(count($data['criminal_case']) == 1){
                $query .= " AND criminal_case_has_man.criminal_case_id = '{$data['criminal_case'][0]}' ";
            }else{
                $query .= " AND criminal_case_has_man.criminal_case_id IN (".implode(',',$data['criminal_case'])." )";
            }
        }

        if(isset($data['mia_summary'])){
            if(count($data['mia_summary']) == 1){
                $query .= " AND man_passes_mia_summary.mia_summary_id = '{$data['mia_summary'][0]}' ";
            }else{
                $query .= " AND man_passes_mia_summary.mia_summary_id IN (".implode(',',$data['mia_summary'])." )";
            }
        }

        if(isset($data['car'])){
            if(count($data['car']) == 1){
                $query .= " AND ( man_has_car.car_id = '{$data['car'][0]}' OR man_use_car.car_id = '{$data['car'][0]}' )";
            }else{
                $query .= " AND ( man_has_car.car_id IN (".implode(',',$data['car'])." ) OR man_use_car.car_id IN (".implode(',',$data['car'])." ) ) ";
            }
        }

        if(isset($data['weapon'])){
            if(count($data['weapon']) == 1){
                $query .= " AND man_has_weapon.weapon_id = '{$data['weapon'][0]}' ";
            }else{
                $query .= " AND man_has_weapon.weapon_id IN (".implode(',',$data['weapon'])." )";
            }
        }

        if(isset($data['bibliography'])){
            if(count($data['bibliography']) == 1){
                $query .= " AND man_has_bibliography.bibliography_id = '{$data['bibliography'][0]}' ";
            }else{
                $query .= " AND man_has_bibliography.bibliography_id IN (".implode(',',$data['bibliography'])." )";
            }
        }

        if(isset($data['email'])){
            if(count($data['email']) == 1){
                $query .= " AND man_has_email.email_id = '{$data['email'][0]}' ";
            }else{
                $query .= " AND man_has_email.email_id IN (".implode(',',$data['email'])." )";
            }
        }

//        echo $query;
        // $query .= " GROUP BY (man.id) ";
        // $this->_setSql($query);
        // return $this->getAll();
        return DB::select($query);

    }

    public function searchExternalSign($data){
        $query = " SELECT
            GROUP_CONCAT(sign.name) AS `name` ,  man_external_sign_has_sign.*

            FROM man_external_sign_has_sign
            LEFT JOIN `sign` ON man_external_sign_has_sign.sign_id = sign.id
            WHERE 1=1 ";



        if(isset($data['external_sign'])){
            if(count($data['external_sign']) == 1){
                $query .= " AND man_external_sign_has_sign.id = '{$data['external_sign'][0]}' ";
            }else{
                $query .= " AND man_external_sign_has_sign.id IN (".implode(',',$data['external_sign'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND man_external_sign_has_sign.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND man_external_sign_has_sign.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        $query .= " GROUP BY (man_id)  ";

//        echo $query;

        $this->_setSql($query);
        return $this->getAll();

    }

    public function searchPhone($data){
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
                WHERE 1=1 ";

        if(isset($data['phone'])){
            if(count($data['phone']) == 1){
                $query .= " AND phone.id = '{$data['phone'][0]}' ";
            }else{
                $query .= " AND phone.id IN (".implode(',',$data['phone'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND man_has_phone.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND man_has_phone.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND organization_has_phone.organization_id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND organization_has_phone.organization_id IN (".implode(',',$data['organization'])." )";
            }
        }

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND action_has_phone.action_id = '{$data['action'][0]}' ";
            }else{
                $query .= " AND action_has_phone.action_id IN (".implode(',',$data['action'])." )";
            }
        }

//        echo $query;
        $query .= " GROUP BY (phone.id) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchEmail($data){
        $query = "SELECT email.* FROM email
                  LEFT JOIN man_has_email ON man_has_email.email_id = email.id
                  LEFT JOIN organization_has_email ON organization_has_email.email_id = email.id
                  WHERE 1=1 ";

        if(isset($data['email'])){
            if(count($data['email']) == 1){
                $query .= " AND email.id = '{$data['email'][0]}' ";
            }else{
                $query .= " AND email.id IN (".implode(',',$data['email'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND man_has_email.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND man_has_email.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND organization_has_email.organization_id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND organization_has_email.organization_id IN (".implode(',',$data['organization'])." )";
            }
        }
        // $query .= " GROUP BY (email.id) ";
        // $this->_setSql($query);
        // return $this->getAll();
        return DB::select($query);

    }

    public function searchWeapon($data){
        $query = "SELECT weapon.* FROM weapon
                  LEFT JOIN man_has_weapon ON man_has_weapon.weapon_id = weapon.id
                  LEFT JOIN organization_has_weapon ON organization_has_weapon.weapon_id = weapon.id
                  LEFT JOIN action_has_weapon ON action_has_weapon.weapon_id = weapon.id
                  LEFT JOIN event_has_weapon ON event_has_weapon.weapon_id = weapon.id
                  WHERE 1=1 ";

        if(isset($data['weapon'])){
            if(count($data['weapon']) == 1){
                $query .= " AND weapon.id = '{$data['weapon'][0]}' ";
            }else{
                $query .= " AND weapon.id IN (".implode(',',$data['weapon'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND man_has_weapon.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND man_has_weapon.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND organization_has_weapon.organization_id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND organization_has_weapon.organization_id IN (".implode(',',$data['organization'])." )";
            }
        }

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND action_has_weapon.action_id = '{$data['action'][0]}' ";
            }else{
                $query .= " AND action_has_weapon.action_id IN (".implode(',',$data['action'])." )";
            }
        }

        if(isset($data['event'])){
            if(count($data['event']) == 1){
                $query .= " AND event_has_weapon.event_id = '{$data['event'][0]}' ";
            }else{
                $query .= " AND event_has_weapon.event_id IN (".implode(',',$data['event'])." )";
            }
        }

        $query .= " GROUP BY (weapon.id) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchCar($data){
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
                    WHERE 1=1 ";

        if(isset($data['car'])){
            if(count($data['car']) == 1){
                $query .= " AND car.id = '{$data['car'][0]}' ";
            }else{
                $query .= " AND car.id IN (".implode(',',$data['car'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND ( man_has_car.man_id = '{$data['man'][0]}' OR man_use_car.man_id = '{$data['man'][0]}' )";
            }else{
                $query .= " AND ( man_has_car.man_id IN (".implode(',',$data['man'])." ) OR man_use_car.man_id IN (".implode(',',$data['man'])." ) ) ";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND organization_has_car.organization_id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND organization_has_car.organization_id IN (".implode(',',$data['organization'])." )";
            }
        }

        if(isset($data['address'])){
            if(count($data['address']) == 1){
                $query .= " AND car_has_address.address_id = '{$data['address'][0]}' ";
            }else{
                $query .= " AND car_has_address.address_id IN (".implode(',',$data['address'])." )";
            }
        }

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND action_has_car.action_id = '{$data['action'][0]}' ";
            }else{
                $query .= " AND action_has_car.action_id IN (".implode(',',$data['action'])." )";
            }
        }

        if(isset($data['event'])){
            if(count($data['event']) == 1){
                $query .= " AND event_has_car.event_id = '{$data['event'][0]}' ";
            }else{
                $query .= " AND event_has_car.event_id IN (".implode(',',$data['event'])." )";
            }
        }

        $query .= " GROUP BY (car.id) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchAddress($data){
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
                    WHERE 1=1";

        if(isset($data['address'])){
            if(count($data['address']) == 1){
                $query .= " AND address.id = '{$data['address'][0]}' ";
            }else{
                $query .= " AND address.id IN (".implode(',',$data['address'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND ( man_has_address.man_id = '{$data['man'][0]}' OR man.id = '{$data['man'][0]}' )";
            }else{
                $query .= " AND ( man_has_address.man_id IN (".implode(',',$data['man'])." ) OR man.id IN (".implode(',',$data['man'])." ) ) ";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND ( organization_has_address.organization_id = '{$data['organization'][0]}' OR organization.id = '{$data['organization'][0]}' )";
            }else{
                $query .= " AND ( organization_has_address.organization_id IN (".implode(',',$data['organization'])." ) OR organization.id IN (".implode(',',$data['organization'])." ) ) ";
            }
        }

        if(isset($data['car'])){
            if(count($data['car']) == 1){
                $query .= " AND car_has_address.car_id = '{$data['car'][0]}' ";
            }else{
                $query .= " AND car_has_address.car_id IN (".implode(',',$data['car'])." )";
            }
        }

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND `action`.id = '{$data['action'][0]}' ";
            }else{
                $query .= " AND `action`.id IN (".implode(',',$data['action'])." )";
            }
        }

        if(isset($data['event'])){
            if(count($data['event']) == 1){
                $query .= " AND `event`.id = '{$data['event'][0]}' ";
            }else{
                $query .= " AND `event`.id IN (".implode(',',$data['event'])." )";
            }
        }

        $query .= " GROUP BY (address.id) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchWorkActivity($data){
        $query = "SELECT organization_has_man.id,organization_has_man.title, organization_has_man.start_date, organization_has_man.end_date, organization_has_man.period
                    FROM organization_has_man
                    WHERE 1=1";

        if(isset($data['work_activity'])){
            if(count($data['work_activity']) == 1){
                $query .= " AND organization_has_man.id = '{$data['work_activity'][0]}' ";
            }else{
                $query .= " AND organization_has_man.id IN (".implode(',',$data['work_activity'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND organization_has_man.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND organization_has_man.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND organization_has_man.organization_id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND organization_has_man.organization_id IN (".implode(',',$data['organization'])." )";
            }
        }

        $query .= " GROUP BY  (organization_has_man.id)";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchManBeanCountry($data){
        $query = "SELECT man_bean_country.* , country_ate.name AS country_ate, goal.name AS goal, region.name AS region, locality.name AS locality
                    FROM man_bean_country
                    LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
                    LEFT JOIN goal ON goal.id = man_bean_country.goal_id
                    LEFT JOIN region ON region.id = man_bean_country.region_id
                    LEFT JOIN locality ON locality.id = man_bean_country.locality_id
                    WHERE 1=1 ";

        if(isset($data['man_bean_country'])){
            if(count($data['man_bean_country']) == 1){
                $query .= " AND man_bean_country.id = '{$data['man_bean_country'][0]}' ";
            }else{
                $query .= " AND man_bean_country.id IN (".implode(',',$data['man_bean_country'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND man_bean_country.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND man_bean_country.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchObjectsRelation($data){
        $query = "SELECT objects_relation.*, relation_type.name AS relation_type_id
                    FROM objects_relation
                    LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id
                    LEFT JOIN man ON ( (objects_relation.first_object_id = man.id AND objects_relation.first_object_type = 'man') OR
                                                  (objects_relation.second_object_id = man.id AND objects_relation.second_obejct_type = 'man'))
                    LEFT JOIN organization ON ( (objects_relation.first_object_id = organization.id AND objects_relation.first_object_type = 'organization') OR
                                                  (objects_relation.second_object_id = organization.id AND objects_relation.second_obejct_type = 'organization'))
                    WHERE 1=1 ";

        if(isset($data['objects_relation'])){
            if(count($data['objects_relation']) == 1){
                $query .= " AND objects_relation.id = '{$data['objects_relation'][0]}' ";
            }else{
                $query .= " AND objects_relation.id IN (".implode(',',$data['objects_relation'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND man.id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND man.id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND organization.id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND organization.id IN (".implode(',',$data['organization'])." )";
            }
        }

        $query .= "GROUP BY (objects_relation.id) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchAction($data){
        $query = "SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
                    (SELECT COUNT(*) FROM action_has_man WHERE action_has_man.action_id = `action`.id) as man_count,
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
                    LEFT JOIN action_has_criminal_case ON action_has_criminal_case.action_id = `action`.id
                    WHERE 1=1 ";

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND `action`.id = '{$data['action'][0]}' ";
            }else{
                $query .= " AND `action`.id IN (".implode(',',$data['action'])." )";
            }
        }

        if(isset($data['event'])){
            if(count($data['event']) == 1){
                $query .= " AND ( action_has_event.event_id = '{$data['event'][0]}' OR event_has_action.event_id = '{$data['event'][0]}' )";
            }else{
                $query .= " AND ( action_has_event.event_id IN (".implode(',',$data['event'])." ) OR event_has_action.event_id IN (".implode(',',$data['event'])." ) ) ";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND action_has_man.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND action_has_man.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND action_has_organization.organization_id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND action_has_organization.organization_id IN (".implode(',',$data['organization'])." )";
            }
        }

        if(isset($data['phone'])){
            if(count($data['phone']) == 1){
                $query .= " AND action_has_phone.phone_id = '{$data['phone'][0]}' ";
            }else{
                $query .= " AND action_has_phone.phone_id IN (".implode(',',$data['phone'])." )";
            }
        }

        if(isset($data['weapon'])){
            if(count($data['weapon']) == 1){
                $query .= " AND action_has_weapon.weapon_id = '{$data['weapon'][0]}' ";
            }else{
                $query .= " AND action_has_weapon.weapon_id IN (".implode(',',$data['weapon'])." )";
            }
        }

        if(isset($data['car'])){
            if(count($data['car']) == 1){
                $query .= " AND action_has_car.car_id = '{$data['car'][0]}' ";
            }else{
                $query .= " AND action_has_car.car_id IN (".implode(',',$data['car'])." )";
            }
        }

        if(isset($data['signal'])){
            if(count($data['signal']) == 1){
                $query .= " AND action_passes_signal.signal_id = '{$data['signal'][0]}' ";
            }else{
                $query .= " AND action_passes_signal.signal_id IN (".implode(',',$data['signal'])." )";
            }
        }

        if(isset($data['bibliography'])){
            if(count($data['bibliography']) == 1){
                $query .= " AND `action`.bibliography_id = '{$data['bibliography'][0]}' ";
            }else{
                $query .= " AND `action`.bibliography_id IN (".implode(',',$data['bibliography'])." )";
            }
        }

        if(isset($data['criminal_case'])){
            if(count($data['criminal_case']) == 1){
                $query .= " AND `action_has_criminal_case`.criminal_case_id = '{$data['criminal_case'][0]}' ";
            }else{
                $query .= " AND `action_has_criminal_case`.criminal_case_id IN (".implode(',',$data['criminal_case'])." )";
            }
        }

        if(isset($data['address'])){
            if(count($data['address']) == 1){
                $query .= " AND `action`.address_id = '{$data['address'][0]}' ";
            }else{
                $query .= " AND `action`.address_id IN (".implode(',',$data['address'])." )";
            }
        }

        $query .= "GROUP BY (`action`.id)";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchControl($data){
        $query = " SELECT control.* , unit.name AS unit, act_unit.name AS act_unit, sub_act_unit.name AS sub_act_unit, doc_category.name AS doc_category, control_result.name AS result
                    FROM control
                    LEFT JOIN agency AS unit ON unit.id = control.unit_id
                    LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
                    LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
                    LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
                    LEFT JOIN control_result ON control_result.id = control.result_id
                    WHERE 1=1 ";

        if(isset($data['control'])){
            if(count($data['control']) == 1){
                $query .= " AND control.id = '{$data['control'][0]}' ";
            }else{
                $query .= " AND control.id IN (".implode(',',$data['control'])." )";
            }
        }

        if(isset($data['bibliography'])){
            if(count($data['control']) == 1){
                $query .= " AND control.bibliography_id = '{$data['bibliography'][0]}' ";
            }else{
                $query .= " AND control.bibliography_id IN (".implode(',',$data['bibliography'])." )";
            }
        }

        $query .= " GROUP BY (control.id) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchEvent($data){
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
                    WHERE 1=1 ";

        if(isset($data['event'])){
            if(count($data['event']) == 1){
                $query .= " AND event.id = '{$data['event'][0]}' ";
            }else{
                $query .= " AND event.id IN (".implode(',',$data['event'])." )";
            }
        }

        if(isset($data['address'])){
            if(count($data['address']) == 1){
                $query .= " AND event.address_id = '{$data['address'][0]}' ";
            }else{
                $query .= " AND event.address_id IN (".implode(',',$data['address'])." )";
            }
        }

        if(isset($data['criminal_case'])){
            if(count($data['criminal_case']) == 1){
                $query .= " AND event_has_criminal_case.criminal_case_id = '{$data['criminal_case'][0]}' ";
            }else{
                $query .= " AND event_has_criminal_case.criminal_case_id IN (".implode(',',$data['criminal_case'])." )";
            }
        }

        if(isset($data['bibliography'])){
            if(count($data['bibliography']) == 1){
                $query .= " AND event.bibliography_id = '{$data['bibliography'][0]}' ";
            }else{
                $query .= " AND event.bibliography_id IN (".implode(',',$data['bibliography'])." )";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND ( event.organization_id = '{$data['organization'][0]}' OR event_has_organization.organization_id = '{$data['organization'][0]}' )";
            }else{
                $query .= " AND ( event.organization_id IN (".implode(',',$data['organization'])." ) OR event_has_organization.organization_id IN (".implode(',',$data['organization'])." ) ) ";
            }
        }

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND ( action_has_event.action_id = '{$data['action'][0]}' OR event_has_action.action_id = '{$data['action'][0]}' )";
            }else{
                $query .= " AND ( action_has_event.action_id IN (".implode(',',$data['action'])." ) OR event_has_action.action_id IN (".implode(',',$data['action'])." ) ) ";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND event_has_man.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND event_has_man.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['car'])){
            if(count($data['car']) == 1){
                $query .= " AND event_has_car.car_id = '{$data['car'][0]}' ";
            }else{
                $query .= " AND event_has_car.car_id IN (".implode(',',$data['car'])." )";
            }
        }

        if(isset($data['weapon'])){
            if(count($data['weapon']) == 1){
                $query .= " AND event_has_weapon.weapon_id = '{$data['weapon'][0]}' ";
            }else{
                $query .= " AND event_has_weapon.weapon_id IN (".implode(',',$data['weapon'])." )";
            }
        }

        if(isset($data['signal'])){
            if(count($data['signal']) == 1){
                $query .= " AND event_passes_signal.signal_id = '{$data['signal'][0]}' ";
            }else{
                $query .= " AND event_passes_signal.signal_id IN (".implode(',',$data['signal'])." )";
            }
        }


        $query .= " GROUP BY (event.id) ";

//        echo $query;

        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchSignal($data){
        $query = "SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                ( (SELECT COUNT(*) FROM man_passed_by_signal WHERE man_passed_by_signal.signal_id = `signal`.id) +
                                  (SELECT COUNT(*) FROM signal_has_man WHERE signal_has_man.signal_id = `signal`.id)
                                 ) AS man_count,
                                COALESCE(`signal`.reg_num,0) AS reg_num,
                                COALESCE(`signal`.check_line,0) AS check_line,
                                check_subunit.name AS check_subunit,opened_agency.name AS opened_agency, opened_unit.name AS opened_unit,
                                opened_subunit.name AS opened_subunit, resource.name AS resource,signal_result.name AS signal_result,
                                (SELECT COUNT(DISTINCT check_date_id) FROM signal_has_check_date WHERE signal_id = `signal`.id) AS check_date_count,
                                (SELECT COUNT(id) FROM keep_signal WHERE signal_id = `signal`.id) AS keep_count,
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
                LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure,
                (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,

                (SELECT GROUP_CONCAT(DATE_FORMAT(check_date.date,'%d-%m-%Y')) FROM signal_has_check_date
                LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date_id

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
                LEFT JOIN criminal_case_has_signal ON criminal_case_has_signal.signal_id = `signal`.id
                LEFT JOIN man_passed_by_signal ON man_passed_by_signal.signal_id = `signal`.id
                LEFT JOIN signal_has_man ON signal_has_man.signal_id = `signal`.id
                LEFT JOIN organization_passes_by_signal ON organization_passes_by_signal.signal_id = `signal`.id
                LEFT JOIN organization_checked_by_signal ON organization_checked_by_signal.signal_id = `signal`.id
                LEFT JOIN action_passes_signal ON action_passes_signal.signal_id = `signal`.id
                LEFT JOIN keep_signal ON keep_signal.signal_id = `signal`.id
                LEFT JOIN event_passes_signal ON event_passes_signal.signal_id = `signal`.id
                WHERE 1=1";

        if(isset($data['signal'])){
            if(count($data['signal']) == 1){
                $query .= " AND `signal`.id = '{$data['signal'][0]}' ";
            }else{
                $query .= " AND `signal`.id IN (".implode(',',$data['signal'])." )";
            }
        }

        if(isset($data['bibliography'])){
            if(count($data['bibliography']) == 1){
                $query .= " AND `signal`.bibliography_id = '{$data['bibliography'][0]}' ";
            }else{
                $query .= " AND `signal`.bibliography_id IN (".implode(',',$data['bibliography'])." )";
            }
        }

        if(isset($data['criminal_case'])){
            if(count($data['criminal_case']) == 1){
                $query .= " AND criminal_case_has_signal.criminal_case_id = '{$data['criminal_case'][0]}' ";
            }else{
                $query .= " AND criminal_case_has_signal.criminal_case_id IN (".implode(',',$data['criminal_case'])." )";
            }
        }

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND action_passes_signal.action_id = '{$data['action'][0]}' ";
            }else{
                $query .= " AND action_passes_signal.action_id IN (".implode(',',$data['action'])." )";
            }
        }

        if(isset($data['event'])){
            if(count($data['event']) == 1){
                $query .= " AND event_passes_signal.event_id = '{$data['event'][0]}' ";
            }else{
                $query .= " AND event_passes_signal.event_id IN (".implode(',',$data['event'])." )";
            }
        }

        if(isset($data['keep_signal'])){
            if(count($data['keep_signal']) == 1){
                $query .= " AND keep_signal.id = '{$data['keep_signal'][0]}' ";
            }else{
                $query .= " AND keep_signal.id IN (".implode(',',$data['keep_signal'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND ( signal_has_man.man_id = '{$data['man'][0]}' OR man_passed_by_signal.man_id = '{$data['man'][0]}' )";
            }else{
                $query .= " AND ( signal_has_man.man_id IN (".implode(',',$data['man'])." ) OR man_passed_by_signal.man_id IN (".implode(',',$data['man'])." ) ) ";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND ( organization_passes_by_signal.organization_id = '{$data['organization'][0]}' OR organization_checked_by_signal.organization_id = '{$data['organization'][0]}' )";
            }else{
                $query .= " AND ( organization_passes_by_signal.organization_id IN (".implode(',',$data['organization'])." ) OR organization_checked_by_signal.organization_id IN (".implode(',',$data['organization'])." ) ) ";
            }
        }

        $query .= " GROUP BY (`signal`.id) ";
//        echo $query;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchOrganization($data){
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
                    LEFT JOIN event ON event.organization_id = organization.id
                    WHERE 1=1 ";

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND organization.id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND organization.id IN (".implode(',',$data['organization'])." )";
            }
        }

        if(isset($data['signal'])){
            if(count($data['signal']) == 1){
                $query .= " AND ( organization_passes_by_signal.signal_id = '{$data['signal'][0]}' OR organization_checked_by_signal.signal_id = '{$data['signal'][0]}' )";
            }else{
                $query .= " AND ( organization_passes_by_signal.signal_id IN (".implode(',',$data['signal'])." ) OR organization_checked_by_signal.signal_id IN (".implode(',',$data['signal'])." ) ) ";
            }
        }

        if(isset($data['address'])){
            if(count($data['address']) == 1){
                $query .= " AND ( organization.address_id = '{$data['address'][0]}' OR organization_has_address.address_id = '{$data['address'][0]}' )";
            }else{
                $query .= " AND ( organization.address_id IN (".implode(',',$data['address'])." ) OR organization_has_address.address_id IN (".implode(',',$data['address'])." ) ) ";
            }
        }

        if(isset($data['event'])){
            if(count($data['event']) == 1){
                $query .= " AND ( event.id = '{$data['event'][0]}' OR event_has_organization.event_id = '{$data['event'][0]}' )";
            }else{
                $query .= " AND ( event.id IN (".implode(',',$data['event'])." ) OR event_has_organization.event_id IN (".implode(',',$data['event'])." ) ) ";
            }
        }

        if(isset($data['phone'])){
             if(count($data['phone']) == 1){
                 $query .= " AND organization_has_phone.phone_id = '{$data['phone'][0]}' ";
             }else{
                 $query .= " AND organization_has_phone.phone_id IN (".implode(',',$data['phone'])." )";
             }
        }

        if(isset($data['objects_relation'])){
            if(count($data['objects_relation']) == 1){
                $query .= " AND objects_relation.id = '{$data['objects_relation'][0]}' ";
            }else{
                $query .= " AND objects_relation.id IN (".implode(',',$data['objects_relation'])." )";
            }
        }

        if(isset($data['criminal_case'])){
            if(count($data['criminal_case']) == 1){
                $query .= " AND criminal_case_has_organization.criminal_case_id = '{$data['criminal_case'][0]}' ";
            }else{
                $query .= " AND criminal_case_has_organization.criminal_case_id IN (".implode(',',$data['criminal_case'])." )";
            }
        }

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND action_has_organization.action_id = '{$data['action'][0]}' ";
            }else{
                $query .= " AND action_has_organization.action_id IN (".implode(',',$data['action'])." )";
            }
        }

        if(isset($data['work_activity'])){
            if(count($data['work_activity']) == 1){
                $query .= " AND organization_has_man.id = '{$data['work_activity'][0]}' ";
            }else{
                $query .= " AND organization_has_man.id IN (".implode(',',$data['work_activity'])." )";
            }
        }

        if(isset($data['email'])){
            if(count($data['email']) == 1){
                $query .= " AND organization_has_email.email_id = '{$data['email'][0]}' ";
            }else{
                $query .= " AND organization_has_email.email_id IN (".implode(',',$data['email'])." )";
            }
        }

        if(isset($data['bibliography'])){
            if(count($data['bibliography']) == 1){
                $query .= " AND organization_has_bibliography.bibliography_id = '{$data['bibliography'][0]}' ";
            }else{
                $query .= " AND organization_has_bibliography.bibliography_id IN (".implode(',',$data['bibliography'])." )";
            }
        }

        if(isset($data['bibliography'])){
            if(count($data['bibliography']) == 1){
                $query .= " AND organization_has_bibliography.bibliography_id = '{$data['bibliography'][0]}' ";
            }else{
                $query .= " AND organization_has_bibliography.bibliography_id IN (".implode(',',$data['bibliography'])." )";
            }
        }

        if(isset($data['car'])){
            if(count($data['car']) == 1){
                $query .= " AND organization_has_car.car_id = '{$data['car'][0]}' ";
            }else{
                $query .= " AND organization_has_car.car_id IN (".implode(',',$data['car'])." )";
            }
        }

        if(isset($data['weapon'])){
            if(count($data['weapon']) == 1){
                $query .= " AND organization_has_weapon.weapon_id = '{$data['weapon'][0]}' ";
            }else{
                $query .= " AND organization_has_weapon.weapon_id IN (".implode(',',$data['weapon'])." )";
            }
        }

        if(isset($data['mia_summary'])){
            if(count($data['mia_summary']) == 1){
                $query .= " AND organization_passes_mia_summary.mia_summary_id = '{$data['mia_summary'][0]}' ";
            }else{
                $query .= " AND organization_passes_mia_summary.mia_summary_id IN (".implode(',',$data['mia_summary'])." )";
            }
        }

        $query .= "GROUP BY (organization.id) ";

//        echo $query;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchMiaSummary($data){
        $query = "SELECT mia_summary.* ,
                    (SELECT COUNT(*) FROM man_passes_mia_summary WHERE man_passes_mia_summary.mia_summary_id = mia_summary.id) AS man_count
                    FROM mia_summary
                  LEFT JOIN man_passes_mia_summary ON man_passes_mia_summary.mia_summary_id = mia_summary.id
                  LEFT JOIN organization_passes_mia_summary ON organization_passes_mia_summary.mia_summary_id = mia_summary.id
                  WHERE 1=1";

        if(isset($data['mia_summary'])){
            if(count($data['mia_summary']) == 1){
                $query .= " AND mia_summary.id = '{$data['mia_summary'][0]}' ";
            }else{
                $query .= " AND mia_summary.id IN (".implode(',',$data['mia_summary'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND man_passes_mia_summary.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND man_passes_mia_summary.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND organization_passes_mia_summary.organization_id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND organization_passes_mia_summary.organization_id IN (".implode(',',$data['organization'])." )";
            }
        }

        $query .= " GROUP BY (mia_summary.id) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchCriminalCase($data){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS opened_unit, subunit.name AS subunit,
			          (SELECT GROUP_CONCAT(worker) FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = criminal_case.id ) AS worker ,
			          (SELECT COUNT(*) FROM criminal_case_has_man WHERE criminal_case_has_man.criminal_case_id = criminal_case.id) AS man_count,
			          (SELECT GROUP_CONCAT(worker_post.name) FROM criminal_case_worker_post
			           LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
			           WHERE criminal_case_worker_post.criminal_case_id = criminal_case.id ) AS worker_post
                    FROM criminal_case
                    LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
                    LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
                    LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
                    LEFT JOIN worker ON worker.id = criminal_case.worker_id
                    LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id
                    LEFT JOIN criminal_case_has_man ON criminal_case_has_man.criminal_case_id = criminal_case.id
                    LEFT JOIN criminal_case_has_organization ON criminal_case_has_organization.criminal_case_id = criminal_case.id
                    LEFT JOIN action_has_criminal_case ON action_has_criminal_case.criminal_case_id = criminal_case.id
                    LEFT JOIN event_has_criminal_case ON event_has_criminal_case.criminal_case_id = criminal_case.id
                    LEFT JOIN criminal_case_has_signal ON criminal_case_has_signal.criminal_case_id = criminal_case.id
                    WHERE 1=1 ";

        if(isset($data['criminal_case'])){
            if(count($data['criminal_case']) == 1){
                $query .= " AND criminal_case.id = '{$data['criminal_case'][0]}' ";
            }else{
                $query .= " AND criminal_case.id IN (".implode(',',$data['criminal_case'])." )";
            }
        }

        if(isset($data['bibliography'])){
            if(count($data['bibliography']) == 1){
                $query .= " AND criminal_case.bibliography_id = '{$data['bibliography'][0]}' ";
            }else{
                $query .= " AND criminal_case.bibliography_id IN (".implode(',',$data['bibliography'])." )";
            }
        }

        if(isset($data['signal'])){
            if(count($data['signal']) == 1){
                $query .= " AND criminal_case_has_signal.signal_id = '{$data['signal'][0]}' ";
            }else{
                $query .= " AND criminal_case_has_signal.signal_id IN (".implode(',',$data['signal'])." )";
            }
        }

        if(isset($data['action'])){
            if(count($data['action']) == 1){
                $query .= " AND action_has_criminal_case.action_id = '{$data['action'][0]}' ";
            }else{
                $query .= " AND action_has_criminal_case.action_id IN (".implode(',',$data['action'])." )";
            }
        }

        if(isset($data['event'])){
            if(count($data['event']) == 1){
                $query .= " AND event_has_criminal_case.event_id = '{$data['event'][0]}' ";
            }else{
                $query .= " AND event_has_criminal_case.event_id IN (".implode(',',$data['event'])." )";
            }
        }

        if(isset($data['man'])){
            if(count($data['man']) == 1){
                $query .= " AND criminal_case_has_man.man_id = '{$data['man'][0]}' ";
            }else{
                $query .= " AND criminal_case_has_man.man_id IN (".implode(',',$data['man'])." )";
            }
        }

        if(isset($data['organization'])){
            if(count($data['organization']) == 1){
                $query .= " AND criminal_case_has_organization.organization_id = '{$data['organization'][0]}' ";
            }else{
                $query .= " AND criminal_case_has_organization.organization_id IN (".implode(',',$data['organization'])." )";
            }
        }

        $query .= "GROUP BY (criminal_case.id)";
        $this->_setSql($query);
        return $this->getAll();
    }


}
