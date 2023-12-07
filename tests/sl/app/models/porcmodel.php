<?php

class PorcModel extends Model
{
    public function agency(){
        $query = "SELECT street.* FROM street LIMIT 10  ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function setValues(){
        $query = "
/*[18:07:09][52 ms]*/ INSERT INTO `sns_dev`.`action` (`id`, `start_date`, `end_date`, `duration_id`, `goal_id`, `terms_id`, `aftermath_id`, `related_action_id`, `bibliography_id`, `source`, `address_id`, `opened_criminal_case_id`, `opened_dou`, `action_qualification_id`, `created_at`) VALUES (NULL, '2012-12-12 12:12:00', '2012-12-12 12:12:00', NULL, NULL, NULL, NULL, NULL, '798', NULL, '11', NULL, NULL, '1', '2013-08-16 15:14:59');
/*[18:07:11][38 ms]*/ INSERT INTO `sns_dev`.`action` (`id`, `start_date`, `end_date`, `duration_id`, `goal_id`, `terms_id`, `aftermath_id`, `related_action_id`, `bibliography_id`, `source`, `address_id`, `opened_criminal_case_id`, `opened_dou`, `action_qualification_id`, `created_at`) VALUES (NULL, '2012-12-12 12:12:00', '2012-12-12 12:12:00', NULL, NULL, NULL, NULL, NULL, '796', NULL, NULL, NULL, NULL, '1', '2013-07-25 11:56:00');
/*[18:07:16][45 ms]*/ INSERT INTO `sns_dev`.`action` (`id`, `start_date`, `end_date`, `duration_id`, `goal_id`, `terms_id`, `aftermath_id`, `related_action_id`, `bibliography_id`, `source`, `address_id`, `opened_criminal_case_id`, `opened_dou`, `action_qualification_id`, `created_at`) VALUES (NULL, '2012-12-12 12:12:00', '2012-12-12 12:12:00', NULL, NULL, NULL, NULL, NULL, '798', NULL, NULL, NULL, NULL, '1', '2013-08-16 15:14:59');
/*[18:07:19][41 ms]*/ INSERT INTO `sns_dev`.`action` (`id`, `start_date`, `end_date`, `duration_id`, `goal_id`, `terms_id`, `aftermath_id`, `related_action_id`, `bibliography_id`, `source`, `address_id`, `opened_criminal_case_id`, `opened_dou`, `action_qualification_id`, `created_at`) VALUES (NULL, '2012-12-12 12:12:00', '2012-12-12 12:12:00', NULL, NULL, NULL, NULL, NULL, '798', NULL, NULL, NULL, NULL, '1', '2013-08-16 15:14:59');
/*[18:07:20][36 ms]*/ INSERT INTO `sns_dev`.`action` (`id`, `start_date`, `end_date`, `duration_id`, `goal_id`, `terms_id`, `aftermath_id`, `related_action_id`, `bibliography_id`, `source`, `address_id`, `opened_criminal_case_id`, `opened_dou`, `action_qualification_id`, `created_at`) VALUES (NULL, '2012-12-12 12:12:00', '2012-12-12 12:12:00', NULL, NULL, NULL, NULL, NULL, '798', NULL, NULL, NULL, NULL, '1', '2013-08-16 15:14:59');
/*[18:07:20][34 ms]*/ INSERT INTO `sns_dev`.`action` (`id`, `start_date`, `end_date`, `duration_id`, `goal_id`, `terms_id`, `aftermath_id`, `related_action_id`, `bibliography_id`, `source`, `address_id`, `opened_criminal_case_id`, `opened_dou`, `action_qualification_id`, `created_at`) VALUES (NULL, '2012-12-12 12:12:00', '2012-12-12 12:12:00', NULL, NULL, NULL, NULL, NULL, '798', NULL, NULL, NULL, NULL, '1', '2013-08-16 15:14:59');
/*[18:07:23][44 ms]*/ INSERT INTO `sns_dev`.`action` (`id`, `start_date`, `end_date`, `duration_id`, `goal_id`, `terms_id`, `aftermath_id`, `related_action_id`, `bibliography_id`, `source`, `address_id`, `opened_criminal_case_id`, `opened_dou`, `action_qualification_id`, `created_at`) VALUES (NULL, '2012-12-12 12:12:00', '2012-12-12 12:12:00', NULL, NULL, NULL, NULL, NULL, '798', NULL, NULL, NULL, NULL, '1', '2013-08-16 15:14:59');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues2(){
        $query = "
/*[18:17:55][85 ms]*/ INSERT INTO `sns_dev`.`address` (`id`, `country_id`, `region_id`, `locality_id`, `street_id`, `city_id`, `track`, `home_num`, `housing_num`, `apt_num`, `country_ate_id`, `created_at`) VALUES (NULL, NULL, '2', '3239', '1386', NULL, 'gfhgf', 'hfgh', 'fghfgh', 'fghfgh', '1', '2013-08-13 11:33:17');
/*[18:17:57][63 ms]*/ INSERT INTO `sns_dev`.`address` (`id`, `country_id`, `region_id`, `locality_id`, `street_id`, `city_id`, `track`, `home_num`, `housing_num`, `apt_num`, `country_ate_id`, `created_at`) VALUES (NULL, NULL, '18', '3260', '1403', NULL, 'fff', 'ff', 'ff', 'ff', '8', '2013-08-16 17:14:51');
/*[18:18:00][62 ms]*/ INSERT INTO `sns_dev`.`address` (`id`, `country_id`, `region_id`, `locality_id`, `street_id`, `city_id`, `track`, `home_num`, `housing_num`, `apt_num`, `country_ate_id`, `created_at`) VALUES (NULL, NULL, '3', '3248', '1383', NULL, 'aaa', 'bbb', 'bbbb', 'bbb', '7', '2013-08-16 17:14:58');
/*[18:18:02][50 ms]*/ INSERT INTO `sns_dev`.`address` (`id`, `country_id`, `region_id`, `locality_id`, `street_id`, `city_id`, `track`, `home_num`, `housing_num`, `apt_num`, `country_ate_id`, `created_at`) VALUES (NULL, NULL, '2', '3239', '1386', NULL, 'gfhgf', 'hfgh', 'fghfgh', 'fghfgh', '1', '2013-08-13 11:33:17');
/*[18:18:05][71 ms]*/ INSERT INTO `sns_dev`.`address` (`id`, `country_id`, `region_id`, `locality_id`, `street_id`, `city_id`, `track`, `home_num`, `housing_num`, `apt_num`, `country_ate_id`, `created_at`) VALUES (NULL, NULL, '18', '3260', '1403', NULL, 'fff', 'ff', 'ff', 'ff', '8', '2013-08-16 17:15:40');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues3(){
        $query = "
/*[18:19:17][41 ms]*/ INSERT INTO `sns_dev`.`bibliography` (`id`, `title`, `user_id`, `category_id`, `access_level_id`, `source_agency_id`, `from_agency_id`, `source`, `short_desc`, `related_year`, `country_id`, `theme`, `source_address`, `created_at`, `worker_name`, `reg_number`, `reg_date`) VALUES (NULL, 'hdf hdf dfh dfgdh d dfgh ', '1', '8', '1', '5', '4', 'gfsdh ghd dfgh dfh gd', 'gf', '1032', '503', 'gd', 'dfgh dfh d hdfh d dfh fd dfh ', '2013-06-24 16:49:50', 'tyertyetytety', '666', '2012-12-12');
/*[18:19:18][72 ms]*/ INSERT INTO `sns_dev`.`bibliography` (`id`, `title`, `user_id`, `category_id`, `access_level_id`, `source_agency_id`, `from_agency_id`, `source`, `short_desc`, `related_year`, `country_id`, `theme`, `source_address`, `created_at`, `worker_name`, `reg_number`, `reg_date`) VALUES (NULL, 'hdf hdf dfh dfgdh d dfgh ', '1', '8', '1', '5', '4', 'gfsdh ghd dfgh dfh gd', 'gf', '1032', '503', 'gd', 'dfgh dfh d hdfh d dfh fd dfh ', '2013-06-24 16:49:50', 'tyertyetytety', '666', '2012-12-12');
/*[18:19:20][252 ms]*/ INSERT INTO `sns_dev`.`bibliography` (`id`, `title`, `user_id`, `category_id`, `access_level_id`, `source_agency_id`, `from_agency_id`, `source`, `short_desc`, `related_year`, `country_id`, `theme`, `source_address`, `created_at`, `worker_name`, `reg_number`, `reg_date`) VALUES (NULL, 'hdf hdf dfh dfgdh d dfgh ', '1', '8', '1', '5', '4', 'gfsdh ghd dfgh dfh gd', 'gf', '1032', '503', 'gd', 'dfgh dfh d hdfh d dfh fd dfh ', '2013-06-24 16:49:50', 'tyertyetytety', '666', '2012-12-12');
/*[18:19:20][101 ms]*/ INSERT INTO `sns_dev`.`bibliography` (`id`, `title`, `user_id`, `category_id`, `access_level_id`, `source_agency_id`, `from_agency_id`, `source`, `short_desc`, `related_year`, `country_id`, `theme`, `source_address`, `created_at`, `worker_name`, `reg_number`, `reg_date`) VALUES (NULL, 'hdf hdf dfh dfgdh d dfgh ', '1', '8', '1', '5', '4', 'gfsdh ghd dfgh dfh gd', 'gf', '1032', '503', 'gd', 'dfgh dfh d hdfh d dfh fd dfh ', '2013-06-24 16:49:50', 'tyertyetytety', '666', '2012-12-12');
/*[18:19:27][54 ms]*/ INSERT INTO `sns_dev`.`bibliography` (`id`, `title`, `user_id`, `category_id`, `access_level_id`, `source_agency_id`, `from_agency_id`, `source`, `short_desc`, `related_year`, `country_id`, `theme`, `source_address`, `created_at`, `worker_name`, `reg_number`, `reg_date`) VALUES (NULL, 'hdf hdf dfh dfgdh d dfgh ', '1', '8', '1', '5', '4', 'gfsdh ghd dfgh dfh gd', 'gf', '1032', '503', 'gd', 'dfgh dfh d hdfh d dfh fd dfh ', '2013-06-24 16:49:50', 'tyertyetytety', '666', '2012-12-12');
/*[18:19:28][54 ms]*/ INSERT INTO `sns_dev`.`bibliography` (`id`, `title`, `user_id`, `category_id`, `access_level_id`, `source_agency_id`, `from_agency_id`, `source`, `short_desc`, `related_year`, `country_id`, `theme`, `source_address`, `created_at`, `worker_name`, `reg_number`, `reg_date`) VALUES (NULL, 'hdf hdf dfh dfgdh d dfgh ', '1', '8', '1', '5', '4', 'gfsdh ghd dfgh dfh gd', 'gf', '1032', '503', 'gd', 'dfgh dfh d hdfh d dfh fd dfh ', '2013-06-24 16:49:50', 'tyertyetytety', '666', '2012-12-12');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues4(){
        $query = "
/*[18:20:29][80 ms]*/ INSERT INTO `sns_dev`.`car` (`id`, `number`, `note`, `category_id`, `mark_id`, `color_id`, `count`, `created_at`) VALUES (NULL, '1', '1;', '1', '10', '14', '1', '2013-08-16 14:41:59');
/*[18:20:30][69 ms]*/ INSERT INTO `sns_dev`.`car` (`id`, `number`, `note`, `category_id`, `mark_id`, `color_id`, `count`, `created_at`) VALUES (NULL, '1', '1;', '1', '10', '14', '1', '2013-08-16 14:41:59');
/*[18:20:31][68 ms]*/ INSERT INTO `sns_dev`.`car` (`id`, `number`, `note`, `category_id`, `mark_id`, `color_id`, `count`, `created_at`) VALUES (NULL, '1', '1;', '1', '10', '14', '1', '2013-08-16 14:41:59');
/*[18:20:32][42 ms]*/ INSERT INTO `sns_dev`.`car` (`id`, `number`, `note`, `category_id`, `mark_id`, `color_id`, `count`, `created_at`) VALUES (NULL, '1', '1;', '1', '10', '14', '1', '2013-08-16 14:41:59');
/*[18:20:33][61 ms]*/ INSERT INTO `sns_dev`.`car` (`id`, `number`, `note`, `category_id`, `mark_id`, `color_id`, `count`, `created_at`) VALUES (NULL, '1', '1;', '1', '10', '14', '1', '2013-08-16 14:41:59');
/*[18:20:34][71 ms]*/ INSERT INTO `sns_dev`.`car` (`id`, `number`, `note`, `category_id`, `mark_id`, `color_id`, `count`, `created_at`) VALUES (NULL, '1', '1;', '1', '10', '14', '1', '2013-08-16 14:41:59');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues5(){
        $query = "
/*[18:21:50][43 ms]*/ INSERT INTO `sns_dev`.`control` (`id`, `doc_category_id`, `creation_date`, `reg_num`, `reg_date`, `snb_director`, `snb_subdirector`, `resolution_date`, `resolution`, `actor_name`, `sub_actor_name`, `result_id`, `bibliography_id`, `unit_id`, `act_unit_id`, `sub_act_unit_id`, `created_at`) VALUES (NULL, '10', '2013-07-25', '77', '2013-07-16', 'yjyj', 'jyjyj', '2013-07-11', NULL, 'jyjy', 'jyjyj', '3', '437', '2', '6', '7', '2013-07-27 15:18:49');
/*[18:22:01][70 ms]*/ INSERT INTO `sns_dev`.`control` (`id`, `doc_category_id`, `creation_date`, `reg_num`, `reg_date`, `snb_director`, `snb_subdirector`, `resolution_date`, `resolution`, `actor_name`, `sub_actor_name`, `result_id`, `bibliography_id`, `unit_id`, `act_unit_id`, `sub_act_unit_id`, `created_at`) VALUES (NULL, '10', '2013-07-25', '77', '2013-07-16', 'yjyj', 'jyjyj', '2013-07-11', NULL, 'jyjy', 'jyjyj', '3', '437', '2', '6', '7', '2013-07-27 15:18:49');
/*[18:22:04][56 ms]*/ INSERT INTO `sns_dev`.`control` (`id`, `doc_category_id`, `creation_date`, `reg_num`, `reg_date`, `snb_director`, `snb_subdirector`, `resolution_date`, `resolution`, `actor_name`, `sub_actor_name`, `result_id`, `bibliography_id`, `unit_id`, `act_unit_id`, `sub_act_unit_id`, `created_at`) VALUES (NULL, '14', '2013-07-25', '77', '2013-07-12', 'jmhjmhm', 'hjmhmhm', '2013-08-10', NULL, 'mhjmhmh', 'mjhmhm', NULL, NULL, '6', '1', '4', '2013-07-19 16:35:31');
/*[18:22:06][49 ms]*/ INSERT INTO `sns_dev`.`control` (`id`, `doc_category_id`, `creation_date`, `reg_num`, `reg_date`, `snb_director`, `snb_subdirector`, `resolution_date`, `resolution`, `actor_name`, `sub_actor_name`, `result_id`, `bibliography_id`, `unit_id`, `act_unit_id`, `sub_act_unit_id`, `created_at`) VALUES (NULL, '8', '2013-06-29', '12', '2013-06-26', 'bn', 'nvnv', '2013-06-27', 'hhhhhh', 'vcbc', 'bcvbcb', '1', '437', '1', '4', '2', '2013-06-27 14:32:56');
/*[18:22:10][55 ms]*/ INSERT INTO `sns_dev`.`control` (`id`, `doc_category_id`, `creation_date`, `reg_num`, `reg_date`, `snb_director`, `snb_subdirector`, `resolution_date`, `resolution`, `actor_name`, `sub_actor_name`, `result_id`, `bibliography_id`, `unit_id`, `act_unit_id`, `sub_act_unit_id`, `created_at`) VALUES (NULL, '8', '2013-06-29', '12', '2013-06-26', 'bn', 'nvnv', '2013-06-27', 'hhhhhh', 'vcbc', 'bcvbcb', '1', '437', '1', '4', '2', '2013-06-27 14:32:56');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues6(){
        $query = "
/*[18:23:23][54 ms]*/ INSERT INTO `sns_dev`.`criminal_case` (`id`, `number`, `bibliography_id`, `opened_date`, `artical`, `opened_agency_id`, `opened_unit_id`, `subunit_id`, `character`, `signal_id`, `opened_dou`, `worker_id`, `created_at`) VALUES (NULL, '2147483647', '437', '0000-00-00', 'sdfdsfdsf', '1', '1', '1', '1', '8', 'sdfsdfsdfsdf', '8', '2013-07-19 12:44:46');
/*[18:23:25][57 ms]*/ INSERT INTO `sns_dev`.`criminal_case` (`id`, `number`, `bibliography_id`, `opened_date`, `artical`, `opened_agency_id`, `opened_unit_id`, `subunit_id`, `character`, `signal_id`, `opened_dou`, `worker_id`, `created_at`) VALUES (NULL, '78', NULL, '2013-07-16', 'tgg', '1', '2', '5', NULL, '8', NULL, '7', '2013-07-02 14:41:22');
/*[18:23:27][64 ms]*/ INSERT INTO `sns_dev`.`criminal_case` (`id`, `number`, `bibliography_id`, `opened_date`, `artical`, `opened_agency_id`, `opened_unit_id`, `subunit_id`, `character`, `signal_id`, `opened_dou`, `worker_id`, `created_at`) VALUES (NULL, '1', '613', '2010-10-10', '1', '1', '1', '1', '11', NULL, '11', '8', '2013-07-18 18:25:27');
/*[18:23:31][61 ms]*/ INSERT INTO `sns_dev`.`criminal_case` (`id`, `number`, `bibliography_id`, `opened_date`, `artical`, `opened_agency_id`, `opened_unit_id`, `subunit_id`, `character`, `signal_id`, `opened_dou`, `worker_id`, `created_at`) VALUES (NULL, '2147483647', '437', '0000-00-00', 'sdfdsfdsf', '1', '1', '1', '1', '8', 'sdfsdfsdfsdf', '8', '2013-07-19 12:44:46');
/*[18:23:33][56 ms]*/ INSERT INTO `sns_dev`.`criminal_case` (`id`, `number`, `bibliography_id`, `opened_date`, `artical`, `opened_agency_id`, `opened_unit_id`, `subunit_id`, `character`, `signal_id`, `opened_dou`, `worker_id`, `created_at`) VALUES (NULL, '78', NULL, '2013-07-16', 'tgg', '1', '2', '5', NULL, '8', NULL, '7', '2013-07-02 14:41:22');
/*[18:23:36][63 ms]*/ INSERT INTO `sns_dev`.`criminal_case` (`id`, `number`, `bibliography_id`, `opened_date`, `artical`, `opened_agency_id`, `opened_unit_id`, `subunit_id`, `character`, `signal_id`, `opened_dou`, `worker_id`, `created_at`) VALUES (NULL, '54545', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-08-12 13:16:15');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues7(){
        $query = "
/*[18:25:23][53 ms]*/ INSERT INTO `sns_dev`.`event` (`id`, `bibliography_id`, `date`, `address_id`, `organization_id`, `aftermath_id`, `opened_criminal_case_id`, `resource_id`, `agency_id`, `result`, `created_at`) VALUES (NULL, NULL, '2013-07-18 15:30:00', '11', '41', '2', '1', '4', '3', 'xsfdsf', '2013-08-16 15:13:15');
/*[18:25:27][56 ms]*/ INSERT INTO `sns_dev`.`event` (`id`, `bibliography_id`, `date`, `address_id`, `organization_id`, `aftermath_id`, `opened_criminal_case_id`, `resource_id`, `agency_id`, `result`, `created_at`) VALUES (NULL, '507', '2010-10-10 00:00:00', NULL, '1', '4', '7', '5', '4', 'ljhgolhjgfljhgljhgljhgljhgljhg gh fuoh fkhf khf', '2013-07-16 16:54:40');
/*[18:25:30][68 ms]*/ INSERT INTO `sns_dev`.`event` (`id`, `bibliography_id`, `date`, `address_id`, `organization_id`, `aftermath_id`, `opened_criminal_case_id`, `resource_id`, `agency_id`, `result`, `created_at`) VALUES (NULL, NULL, '2013-07-18 15:30:00', '11', '41', '2', '1', '4', '3', 'xsfdsf', '2013-08-16 15:13:15');
/*[18:25:36][61 ms]*/ INSERT INTO `sns_dev`.`event` (`id`, `bibliography_id`, `date`, `address_id`, `organization_id`, `aftermath_id`, `opened_criminal_case_id`, `resource_id`, `agency_id`, `result`, `created_at`) VALUES (NULL, '451', '2013-07-18 15:30:00', '11', '41', '2', '1', '4', '3', 'xsfdsf', '2013-08-16 15:13:15');
/*[18:25:38][68 ms]*/ INSERT INTO `sns_dev`.`event` (`id`, `bibliography_id`, `date`, `address_id`, `organization_id`, `aftermath_id`, `opened_criminal_case_id`, `resource_id`, `agency_id`, `result`, `created_at`) VALUES (NULL, '451', '2013-07-18 15:30:00', '11', '41', '2', '1', '4', '3', 'xsfdsf', '2013-08-16 15:13:15');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues8(){
        $query = "
/*[18:27:04][58 ms]*/ INSERT INTO `sns_dev`.`keep_signal` (`id`, `signal_id`, `start_date`, `end_date`, `pass_date`, `pased_sub_unit`, `agency_id`, `unit_id`, `sub_unit_id`, `created_at`) VALUES (NULL, '8', '2013-07-31', '2013-08-26', '2013-08-21', 'Инспекция КГБ Арм.ССР', '1', '1', '1', '2013-08-13 18:12:15');
/*[18:27:06][191 ms]*/ INSERT INTO `sns_dev`.`keep_signal` (`id`, `signal_id`, `start_date`, `end_date`, `pass_date`, `pased_sub_unit`, `agency_id`, `unit_id`, `sub_unit_id`, `created_at`) VALUES (NULL, '8', '2013-07-31', '2013-08-26', '2013-08-21', 'Инспекция КГБ Арм.ССР', '1', '1', '1', '2013-08-13 18:12:15');
/*[18:27:08][65 ms]*/ INSERT INTO `sns_dev`.`keep_signal` (`id`, `signal_id`, `start_date`, `end_date`, `pass_date`, `pased_sub_unit`, `agency_id`, `unit_id`, `sub_unit_id`, `created_at`) VALUES (NULL, '8', '2013-08-02', '2013-08-13', '2013-08-23', 'Инспекция КГБ Арм.ССР', '5', '4', '3', '2013-08-02 19:08:32');
/*[18:27:10][58 ms]*/ INSERT INTO `sns_dev`.`keep_signal` (`id`, `signal_id`, `start_date`, `end_date`, `pass_date`, `pased_sub_unit`, `agency_id`, `unit_id`, `sub_unit_id`, `created_at`) VALUES (NULL, '8', '2013-07-31', '2013-08-26', '2013-08-21', 'Инспекция КГБ Арм.ССР', '1', '1', '1', '2013-08-13 18:12:15');
/*[18:27:12][102 ms]*/ INSERT INTO `sns_dev`.`keep_signal` (`id`, `signal_id`, `start_date`, `end_date`, `pass_date`, `pased_sub_unit`, `agency_id`, `unit_id`, `sub_unit_id`, `created_at`) VALUES (NULL, '8', '2013-07-31', '2013-08-26', '2013-08-21', 'Инспекция КГБ Арм.ССР', '1', '1', '1', '2013-08-13 18:12:15');
/*[18:27:17][172 ms]*/ INSERT INTO `sns_dev`.`keep_signal` (`id`, `signal_id`, `start_date`, `end_date`, `pass_date`, `pased_sub_unit`, `agency_id`, `unit_id`, `sub_unit_id`, `created_at`) VALUES (NULL, '8', '2013-08-02', '2013-08-13', '2013-08-23', 'Инспекция КГБ Арм.ССР', '5', '4', '3', '2013-08-02 19:08:32');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues9(){
        $query = "
/*[18:28:20][62 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, '1', '3', NULL, '26', '2013-07-17', NULL, NULL, 'zorba', '1', NULL, NULL, '2013-07-17', '2013-07-17', '2013-07-17', '2013-07-17', '1', '2013-07-27 18:39:05');
/*[18:28:23][62 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, '1', '1', NULL, '1', '2013-07-31', '0', '0', NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00');
/*[18:28:25][45 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, '1', '3', NULL, '26', '2013-07-17', NULL, NULL, 'zorba', '1', NULL, NULL, '2013-07-17', '2013-07-17', '2013-07-17', '2013-07-17', '1', '2013-07-27 18:39:05');
/*[18:28:30][46 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, NULL, NULL, NULL, NULL, '2012-12-12', NULL, NULL, NULL, NULL, NULL, NULL, '2012-12-12', '2012-12-12', '2012-12-12', NULL, NULL, '0000-00-00 00:00:00');
/*[18:28:32][75 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, NULL, NULL, NULL, NULL, '2012-12-12', NULL, NULL, NULL, NULL, NULL, NULL, '2012-12-12', '2012-12-12', '2012-12-12', NULL, NULL, '0000-00-00 00:00:00');
/*[18:28:33][53 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, NULL, NULL, NULL, NULL, '2012-12-12', NULL, NULL, NULL, NULL, NULL, NULL, '2012-12-12', '2012-12-12', '2012-12-12', NULL, NULL, '0000-00-00 00:00:00');
/*[18:28:34][75 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, NULL, NULL, NULL, NULL, '2012-12-12', NULL, NULL, NULL, NULL, NULL, NULL, '2012-12-12', '2012-12-12', '2012-12-12', NULL, NULL, '0000-00-00 00:00:00');
/*[18:28:45][46 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, NULL, NULL, NULL, NULL, '2012-12-12', NULL, NULL, NULL, NULL, NULL, NULL, '2012-12-12', '2012-12-12', '2012-12-12', NULL, NULL, '0000-00-00 00:00:00');
/*[18:28:48][59 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, NULL, NULL, NULL, NULL, '2012-12-12', NULL, NULL, NULL, NULL, NULL, NULL, '2012-12-12', '2012-12-12', '2012-12-12', NULL, NULL, '0000-00-00 00:00:00');
/*[18:28:52][60 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, '1', '3', NULL, '26', '2013-07-17', NULL, NULL, 'zorba', '1', NULL, NULL, '2013-07-17', '2013-07-17', '2013-07-17', '2013-07-17', '1', '2013-07-27 18:39:05');
/*[18:28:54][47 ms]*/ INSERT INTO `sns_dev`.`man` (`id`, `gender_id`, `nation_id`, `born_address_id`, `knowen_man_id`, `birthday`, `start_year`, `end_year`, `attention`, `religion_id`, `occupation`, `opened_dou`, `start_wanted`, `entry_date`, `exit_date`, `fixing_moment`, `resource_id`, `created_at`) VALUES (NULL, '1', '3', NULL, '26', '2013-07-17', NULL, NULL, 'zorba', '1', NULL, NULL, '2013-07-17', '2013-07-17', '2013-07-17', '2013-07-17', '1', '2013-07-27 18:39:05');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues10(){
        $query = "
/*[18:30:06][106 ms]*/ INSERT INTO `sns_dev`.`mia_summary` (`id`, `date`, `content`, `bibliography_id`, `created_at`) VALUES (NULL, '2013-07-18', 'ljh glhvl jhvkigj vcikgc khgc khgvkghvig cfigcghcuyfgc  utfckhbv khgc khg cjhgc khg cvkhv khv knbcv jvk', '437', '2013-07-12 11:18:13');
/*[18:30:06][106 ms]*/ INSERT INTO `sns_dev`.`mia_summary` (`id`, `date`, `content`, `bibliography_id`, `created_at`) VALUES (NULL, '2013-07-18', 'ljh glhvl jhvkigj vcikgc khgc khgvkghvig cfigcghcuyfgc  utfckhbv khgc khg cjhgc khg cvkhv khv knbcv jvk', '437', '2013-07-12 11:18:13');
/*[18:30:08][42 ms]*/ INSERT INTO `sns_dev`.`mia_summary` (`id`, `date`, `content`, `bibliography_id`, `created_at`) VALUES (NULL, '2013-07-18', 'ljh glhvl jhvkigj vcikgc khgc khgvkghvig cfigcghcuyfgc  utfckhbv khgc khg cjhgc khg cvkhv khv knbcv jvk', '437', '2013-07-12 11:18:13');
/*[18:30:10][54 ms]*/ INSERT INTO `sns_dev`.`mia_summary` (`id`, `date`, `content`, `bibliography_id`, `created_at`) VALUES (NULL, '2012-12-12', '2026556.3', '593', '2013-07-18 12:23:12');
/*[18:30:12][76 ms]*/ INSERT INTO `sns_dev`.`mia_summary` (`id`, `date`, `content`, `bibliography_id`, `created_at`) VALUES (NULL, '2012-12-12', '2026556.3', '593', '2013-07-18 12:23:12');
/*[18:30:15][51 ms]*/ INSERT INTO `sns_dev`.`mia_summary` (`id`, `date`, `content`, `bibliography_id`, `created_at`) VALUES (NULL, '2012-12-12', NULL, '942', '2013-08-12 13:16:52');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues11(){
        $query = "
/*[18:31:41][57 ms]*/ INSERT INTO `sns_dev`.`objects_relation` (`id`, `relation_type_id`, `first_object_id`, `second_object_id`, `first_object_type`, `second_obejct_type`, `created_at`) VALUES (NULL, '1', '1', '1', 'man', 'organization', '2013-07-23 15:50:47');
/*[18:31:42][64 ms]*/ INSERT INTO `sns_dev`.`objects_relation` (`id`, `relation_type_id`, `first_object_id`, `second_object_id`, `first_object_type`, `second_obejct_type`, `created_at`) VALUES (NULL, '1', '1', '1', 'man', 'organization', '2013-07-23 15:50:47');
/*[18:31:45][67 ms]*/ INSERT INTO `sns_dev`.`objects_relation` (`id`, `relation_type_id`, `first_object_id`, `second_object_id`, `first_object_type`, `second_obejct_type`, `created_at`) VALUES (NULL, '8', '34', '88', 'man', 'organization', '2013-08-12 15:02:08');
/*[18:31:47][64 ms]*/ INSERT INTO `sns_dev`.`objects_relation` (`id`, `relation_type_id`, `first_object_id`, `second_object_id`, `first_object_type`, `second_obejct_type`, `created_at`) VALUES (NULL, '1', '39', '38', 'man', 'organization', '2013-07-19 18:34:53');
/*[18:31:49][68 ms]*/ INSERT INTO `sns_dev`.`objects_relation` (`id`, `relation_type_id`, `first_object_id`, `second_object_id`, `first_object_type`, `second_obejct_type`, `created_at`) VALUES (NULL, '1', '1', '1', 'man', 'organization', '2013-07-23 15:50:47');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues12(){
        $query = "
/*[18:32:53][77 ms]*/ INSERT INTO `sns_dev`.`organization` (`id`, `country_id`, `name`, `reg_date`, `address_id`, `known_as_organization_id`, `category_id`, `employers_count`, `attension`, `opened_dou`, `country_ate_id`, `created_at`, `agency_id`) VALUES (NULL, '502', 'sdfdsfsdf', '2013-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-15 14:59:28', NULL);
/*[18:32:54][61 ms]*/ INSERT INTO `sns_dev`.`organization` (`id`, `country_id`, `name`, `reg_date`, `address_id`, `known_as_organization_id`, `category_id`, `employers_count`, `attension`, `opened_dou`, `country_ate_id`, `created_at`, `agency_id`) VALUES (NULL, '502', 'sdfdsfsdf', '2013-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-15 14:59:28', NULL);
/*[18:32:55][80 ms]*/ INSERT INTO `sns_dev`.`organization` (`id`, `country_id`, `name`, `reg_date`, `address_id`, `known_as_organization_id`, `category_id`, `employers_count`, `attension`, `opened_dou`, `country_ate_id`, `created_at`, `agency_id`) VALUES (NULL, '502', 'sdfdsfsdf', '2013-07-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-15 14:59:28', NULL);
/*[18:32:58][44 ms]*/ INSERT INTO `sns_dev`.`organization` (`id`, `country_id`, `name`, `reg_date`, `address_id`, `known_as_organization_id`, `category_id`, `employers_count`, `attension`, `opened_dou`, `country_ate_id`, `created_at`, `agency_id`) VALUES (NULL, '500', 'sadsadsad', '2010-10-10', NULL, '1', '1', '4651651', '46541654165', '56465468', '1', '2013-07-15 15:24:11', '1');
/*[18:32:59][73 ms]*/ INSERT INTO `sns_dev`.`organization` (`id`, `country_id`, `name`, `reg_date`, `address_id`, `known_as_organization_id`, `category_id`, `employers_count`, `attension`, `opened_dou`, `country_ate_id`, `created_at`, `agency_id`) VALUES (NULL, '500', 'sadsadsad', '2010-10-10', NULL, '1', '1', '4651651', '46541654165', '56465468', '1', '2013-07-15 15:24:11', '1');
/*[18:33:00][46 ms]*/ INSERT INTO `sns_dev`.`organization` (`id`, `country_id`, `name`, `reg_date`, `address_id`, `known_as_organization_id`, `category_id`, `employers_count`, `attension`, `opened_dou`, `country_ate_id`, `created_at`, `agency_id`) VALUES (NULL, '500', 'sadsadsad', '2010-10-10', NULL, '1', '1', '4651651', '46541654165', '56465468', '1', '2013-07-15 15:24:11', '1');
/*[18:33:04][66 ms]*/ INSERT INTO `sns_dev`.`organization` (`id`, `country_id`, `name`, `reg_date`, `address_id`, `known_as_organization_id`, `category_id`, `employers_count`, `attension`, `opened_dou`, `country_ate_id`, `created_at`, `agency_id`) VALUES (NULL, '506', NULL, '2013-08-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-07-17 16:27:12', NULL);
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues13(){
        $query = "
/*[18:34:11][77 ms]*/ INSERT INTO `sns_dev`.`signal` (`id`, `reg_num`, `content`, `check_line`, `check_status`, `signal_qualification_id`, `check_agency_id`, `check_unit_id`, `check_subunit_id`, `subunit_date`, `check_date`, `end_date`, `opened_dou`, `bibliography_id`, `opened_agency_id`, `opened_unit_id`, `opened_subunit_id`, `opened_worker_id`, `source_resource_id`, `signal_result_id`, `created_at`) VALUES (NULL, 'tretgsgsfgdfg', NULL, NULL, NULL, '1', '1', '1', '25', '2013-07-24', NULL, NULL, NULL, '586', NULL, NULL, NULL, NULL, '1', NULL, '2013-07-17 19:01:02');
/*[18:34:12][59 ms]*/ INSERT INTO `sns_dev`.`signal` (`id`, `reg_num`, `content`, `check_line`, `check_status`, `signal_qualification_id`, `check_agency_id`, `check_unit_id`, `check_subunit_id`, `subunit_date`, `check_date`, `end_date`, `opened_dou`, `bibliography_id`, `opened_agency_id`, `opened_unit_id`, `opened_subunit_id`, `opened_worker_id`, `source_resource_id`, `signal_result_id`, `created_at`) VALUES (NULL, 'tretgsgsfgdfg', NULL, NULL, NULL, '1', '1', '1', '25', '2013-07-24', NULL, NULL, NULL, '586', NULL, NULL, NULL, NULL, '1', NULL, '2013-07-17 19:01:02');
/*[18:34:13][105 ms]*/ INSERT INTO `sns_dev`.`signal` (`id`, `reg_num`, `content`, `check_line`, `check_status`, `signal_qualification_id`, `check_agency_id`, `check_unit_id`, `check_subunit_id`, `subunit_date`, `check_date`, `end_date`, `opened_dou`, `bibliography_id`, `opened_agency_id`, `opened_unit_id`, `opened_subunit_id`, `opened_worker_id`, `source_resource_id`, `signal_result_id`, `created_at`) VALUES (NULL, 'tretgsgsfgdfg', NULL, NULL, NULL, '1', '1', '1', '25', '2013-07-24', NULL, NULL, NULL, '586', NULL, NULL, NULL, NULL, '1', NULL, '2013-07-17 19:01:02');
/*[18:34:16][76 ms]*/ INSERT INTO `sns_dev`.`signal` (`id`, `reg_num`, `content`, `check_line`, `check_status`, `signal_qualification_id`, `check_agency_id`, `check_unit_id`, `check_subunit_id`, `subunit_date`, `check_date`, `end_date`, `opened_dou`, `bibliography_id`, `opened_agency_id`, `opened_unit_id`, `opened_subunit_id`, `opened_worker_id`, `source_resource_id`, `signal_result_id`, `created_at`) VALUES (NULL, 'fdlkglfksdg', 'dsfkgpdfkg', '123123123', 'pfsdkgpdfk', '4', '3', '1', '26', '2010-10-10', '2010-10-10', '2010-10-10', 'dsdfewrfwefewr', '587', '1', '1', '1', '7', '1', '1', '2013-07-18 10:33:19');
/*[18:34:17][54 ms]*/ INSERT INTO `sns_dev`.`signal` (`id`, `reg_num`, `content`, `check_line`, `check_status`, `signal_qualification_id`, `check_agency_id`, `check_unit_id`, `check_subunit_id`, `subunit_date`, `check_date`, `end_date`, `opened_dou`, `bibliography_id`, `opened_agency_id`, `opened_unit_id`, `opened_subunit_id`, `opened_worker_id`, `source_resource_id`, `signal_result_id`, `created_at`) VALUES (NULL, 'fdlkglfksdg', 'dsfkgpdfkg', '123123123', 'pfsdkgpdfk', '4', '3', '1', '26', '2010-10-10', '2010-10-10', '2010-10-10', 'dsdfewrfwefewr', '587', '1', '1', '1', '7', '1', '1', '2013-07-18 10:33:19');
/*[18:34:17][64 ms]*/ INSERT INTO `sns_dev`.`signal` (`id`, `reg_num`, `content`, `check_line`, `check_status`, `signal_qualification_id`, `check_agency_id`, `check_unit_id`, `check_subunit_id`, `subunit_date`, `check_date`, `end_date`, `opened_dou`, `bibliography_id`, `opened_agency_id`, `opened_unit_id`, `opened_subunit_id`, `opened_worker_id`, `source_resource_id`, `signal_result_id`, `created_at`) VALUES (NULL, 'fdlkglfksdg', 'dsfkgpdfkg', '123123123', 'pfsdkgpdfk', '4', '3', '1', '26', '2010-10-10', '2010-10-10', '2010-10-10', 'dsdfewrfwefewr', '587', '1', '1', '1', '7', '1', '1', '2013-07-18 10:33:19');
/*[18:34:21][48 ms]*/ INSERT INTO `sns_dev`.`signal` (`id`, `reg_num`, `content`, `check_line`, `check_status`, `signal_qualification_id`, `check_agency_id`, `check_unit_id`, `check_subunit_id`, `subunit_date`, `check_date`, `end_date`, `opened_dou`, `bibliography_id`, `opened_agency_id`, `opened_unit_id`, `opened_subunit_id`, `opened_worker_id`, `source_resource_id`, `signal_result_id`, `created_at`) VALUES (NULL, 'fasregsre', NULL, NULL, NULL, '4', '1', '1', '26', '2010-10-10', '2010-10-10', '2010-10-10', NULL, '588', NULL, NULL, NULL, NULL, '1', NULL, '2013-07-18 11:16:24');
/*[18:34:21][75 ms]*/ INSERT INTO `sns_dev`.`signal` (`id`, `reg_num`, `content`, `check_line`, `check_status`, `signal_qualification_id`, `check_agency_id`, `check_unit_id`, `check_subunit_id`, `subunit_date`, `check_date`, `end_date`, `opened_dou`, `bibliography_id`, `opened_agency_id`, `opened_unit_id`, `opened_subunit_id`, `opened_worker_id`, `source_resource_id`, `signal_result_id`, `created_at`) VALUES (NULL, 'fasregsre', NULL, NULL, NULL, '4', '1', '1', '26', '2010-10-10', '2010-10-10', '2010-10-10', NULL, '588', NULL, NULL, NULL, NULL, '1', NULL, '2013-07-18 11:16:24');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

    public function setValues14(){
        $query = "
/*[18:35:14][69 ms]*/ INSERT INTO `sns_dev`.`man_external_sign_has_sign` (`id`, `sign_id`, `man_id`, `fixed_date`, `created_at`) VALUES (NULL, '586', '1', '2013-07-29', '2013-08-13 16:33:06');
/*[18:35:19][70 ms]*/ INSERT INTO `sns_dev`.`man_external_sign_has_sign` (`id`, `sign_id`, `man_id`, `fixed_date`, `created_at`) VALUES (NULL, '588', '88', '2012-12-12', '2013-07-29 15:43:19');
/*[18:35:20][76 ms]*/ INSERT INTO `sns_dev`.`man_external_sign_has_sign` (`id`, `sign_id`, `man_id`, `fixed_date`, `created_at`) VALUES (NULL, '583', '1', NULL, '2013-08-09 19:25:36');
/*[18:35:22][70 ms]*/ INSERT INTO `sns_dev`.`man_external_sign_has_sign` (`id`, `sign_id`, `man_id`, `fixed_date`, `created_at`) VALUES (NULL, '586', '1', '2013-07-29', '2013-08-13 16:33:06');
/*[18:35:25][74 ms]*/ INSERT INTO `sns_dev`.`man_external_sign_has_sign` (`id`, `sign_id`, `man_id`, `fixed_date`, `created_at`) VALUES (NULL, '583', '1', NULL, '2013-08-09 19:25:36');
";
        for($i = 0 ; $i <= 10000 ; $i++ ){
            $this->_setSql($query);
            $this->run();
        }
    }

}