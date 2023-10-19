<?php

class TemplatesearchModel extends Model{

    public function searchStarted($data){
        $query = "SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                COALESCE(`signal`.reg_num,0) AS reg_num,
                                ( (SELECT COUNT(*) FROM man_passed_by_signal WHERE man_passed_by_signal.signal_id = `signal`.id) +
                                  (SELECT COUNT(*) FROM signal_has_man WHERE signal_has_man.signal_id = `signal`.id)
                                 ) AS man_count,
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
                        LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS signal_used_resource,
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
            WHERE `signal`.subunit_date IS NOT NULL ";

        if( (strlen(trim($data['opened_agency_id'])))&&(strlen(trim($data['opened_agency']))) ){
            $query .= " AND `signal`.opened_agency_id = '{$data['opened_agency_id']}' ";
        }

        if($data['op'] == 'equal'){
            $op = '=';
        }elseif($data['op'] == 'more'){
            $op = '>=';
        }elseif($data['op'] == 'less'){
            $op = '<=';
        }else{
            $op = $data['op'];
        }

        if(strlen(trim($data['subunit_date'])) != 0){
            $dateParse = new DateTime($data['subunit_date']);
            $date1 = $dateParse->format('Y-m-d');
            if($op != 'interval'){
                $query .= " AND DATE(`signal`.subunit_date) $op '$date1' ";
            }else{
                $dateParse = new DateTime($data['subunit_date_to']);
                $date2 = $dateParse->format('Y-m-d');
                $query .= " AND ( DATE(`signal`.subunit_date) >= '$date1' AND DATE(`signal`.subunit_date) <= '$date2' )";
            }
        }

        if(strlen(trim($data['signal_qualification_id'])) != 0 && (strlen(trim($data['signal_qualification']))) ){
            $query .= " AND `signal`.signal_qualification_id = '{$data['signal_qualification_id']}' ";
        }

        $query .= " GROUP BY `signal`.id ";
//        echo $query;die;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchFinished($data){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                COALESCE(`signal`.reg_num,0) AS reg_num,
                                ( (SELECT COUNT(*) FROM man_passed_by_signal WHERE man_passed_by_signal.signal_id = `signal`.id) +
                                  (SELECT COUNT(*) FROM signal_has_man WHERE signal_has_man.signal_id = `signal`.id)
                                 ) AS man_count,
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
                        LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS signal_used_resource,
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
            WHERE `signal`.end_date IS NOT NULL ";


        if( (strlen(trim($data['opened_agency_id'])))&&(strlen(trim($data['opened_agency']))) ){
            $query .= " AND `signal`.check_unit_id = '{$data['opened_agency_id']}' ";
        }

        if($data['op'] == 'equal'){
            $op = '=';
        }elseif($data['op'] == 'more'){
            $op = '>=';
        }elseif($data['op'] == 'less'){
            $op = '<=';
        }else{
            $op = $data['op'];
        }

        if(strlen(trim($data['subunit_date'])) != 0){
            $dateParse = new DateTime($data['subunit_date']);
            $date1 = $dateParse->format('Y-m-d');
            if($op != 'interval'){
                $query .= " AND DATE(`signal`.end_date) $op '$date1' ";
            }else{
                $dateParse = new DateTime($data['subunit_date_to']);
                $date2 = $dateParse->format('Y-m-d');
                $query .= " AND DATE(`signal`.end_date) >= '$date1' AND DATE(`signal`.end_date) <= '$date2' ";
            }
        }

        if(strlen(trim($data['signal_qualification_id'])) != 0 && (strlen(trim($data['signal_qualification']))) ){
            $query .= " AND `signal`.signal_qualification_id = '{$data['signal_qualification_id']}' ";
        }

        $query .= " GROUP BY `signal`.id ";
//        echo $query;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchActive($data){
        $query = "SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
                                COALESCE(`signal`.reg_num,0) AS reg_num,
                                ( (SELECT COUNT(*) FROM man_passed_by_signal WHERE man_passed_by_signal.signal_id = `signal`.id) +
                                  (SELECT COUNT(*) FROM signal_has_man WHERE signal_has_man.signal_id = `signal`.id)
                                 ) AS man_count,
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
                        LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS signal_used_resource,
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
            WHERE 1=1 ";

        if( (strlen(trim($data['opened_agency_id'])))&&(strlen(trim($data['opened_agency']))) ){
            $query .= " AND `signal`.check_unit_id = '{$data['opened_agency_id']}' ";
        }

        if(strlen(trim($data['subunit_date'])) != 0){
            $dateParse = new DateTime($data['subunit_date']);
            $date1 = $dateParse->format('Y-m-d');
            $query .= " AND ( DATE(`signal`.subunit_date) <= '$date1' )";
        }

        if(strlen(trim($data['subunit_date_to'])) != 0){
            $dateParse = new DateTime($data['subunit_date_to']);
            $date2 = $dateParse->format('Y-m-d');
            $query .= " AND ( DATE(`signal`.end_date) >= '$date2' OR `signal`.end_date IS NULL ) ";
        }else{
            $query .= " AND ( `signal`.end_date IS NULL ) ";
        }

        if(strlen(trim($data['signal_qualification_id'])) != 0 && (strlen(trim($data['signal_qualification']))) ){
            $query .= " AND `signal`.signal_qualification_id = '{$data['signal_qualification_id']}' ";
        }

        $query .= " GROUP BY `signal`.id ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchBibliography($data){
        $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name ,
	                                  (SELECT COUNT(DISTINCT file_id) FROM bibliography_has_file WHERE bibliography_id = `bibliography`.id) AS file_count,
                          bibliography_has_file.file_id AS file_id
                FROM bibliography
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = bibliography.id
                WHERE 1=1 ";

        if(count($data) == 1){
            $query .= " AND bibliography_has_file.file_id = {$data[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
        }else{
            $query .= " AND bibliography_has_file.file_id IN (".implode(',',$data)." ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
        }
        $query .= "GROUP BY (bibliography_has_file.file_id)";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function searchBibliographyInFinded($data, $files_id){
        $search_array = '(';
        foreach ($files_id as $id) {
            $search_array .= $id .',';
        }
        $search_array = substr($search_array, 0, -1).")";
        $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_name , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name ,
	                                  (SELECT COUNT(DISTINCT file_id) FROM bibliography_has_file WHERE bibliography_id = `bibliography`.id) AS file_count,
                          bibliography_has_file.file_id AS file_id
                FROM bibliography
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = bibliography.id
                WHERE bibliography_has_file.file_id IN ". $search_array;

        if(count($data) == 1){
            $query .= " AND bibliography_has_file.file_id = {$data[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
        }else{
            $query .= " AND bibliography_has_file.file_id IN (".implode(',',$data)." ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
        }
        $query .= "GROUP BY (bibliography_has_file.file_id)";

        $this->_setSql($query);
        return $this->getAll();
    }

    public function getStartedForReport($grid,$sort){
        $query = "SELECT
                       agency.name AS opened_subunit_id ,
                      (SELECT GROUP_CONCAT(worker) FROM signal_worker WHERE signal_worker.signal_id = signal.id ) AS worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_worker_post.worker_post_id
                          WHERE signal_worker_post.signal_id = signal.id ) AS worker_post,
                       reg_num ,
                       signal_qualification.name AS signal_qualification,
                       resource.name AS source_resource ,
                       DATE_FORMAT(subunit_date,'%d.%m.%Y') AS subunit_date
                  FROM `signal`
                  LEFT JOIN agency ON agency.id = `signal`.opened_subunit_id
                  LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                  LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                  WHERE `signal`.id IN (".implode(',',$grid).")
                  GROUP BY `signal`.id ";
        $order = " ORDER BY ";
        if(!empty($sort)){
            foreach($sort as $k=>$v){
                if($v['name'] == 'end_date' || $v['name'] == 'check_date'
                    || $v['name'] == 'check_date_id' || $v['name'] == 'subunit_date'){
                    $sort[$k]['name'] = ' DATE('.$v['name'].') ';
                }
            }
            $order .= $sort[0]['name'].' '.$sort[0]['sort'];
            unset($sort[0]);
            if(!empty($sort)){
                foreach($sort as $val){
                    $order .= ' , '.$val['name'].' '.$val['sort'];
                }
            }
            $query .= $order;
        }
        $this->_setSql($query);
        return $this->getAll();

    }

    public function getFinishedForReport($grid,$sort){
        $query = "SELECT
                        agency.name AS check_subunit,
                        (SELECT GROUP_CONCAT(worker) FROM signal_checking_worker WHERE signal_checking_worker.signal_id = signal.id) AS checking_worker,
                        (SELECT GROUP_CONCAT(worker_post.name) FROM signal_checking_worker_post
                          LEFT JOIN worker_post ON worker_post.id = signal_checking_worker_post.worker_post_id
                          WHERE signal_checking_worker_post.signal_id = signal.id) AS checking_worker_post,
                        reg_num,
                        signal_qualification.name AS signal_qualification,
                        resource.name AS source_resource,
                        DATE_FORMAT(subunit_date,'%d.%m.%Y') AS subunit_date ,
                        (SELECT GROUP_CONCAT(DATE_FORMAT(check_date.date,'%d.%m.%Y')) FROM signal_has_check_date
                        LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date_id,
                        DATE_FORMAT(check_date,'%d.%m.%Y') AS check_date,
                        DATE_FORMAT(end_date,'%d.%m.%Y') AS end_date,
                        (TO_DAYS(`signal`.end_date)-TO_DAYS(`signal`.check_date)) AS count_days,
                        signal_result.name AS result,
                        (SELECT GROUP_CONCAT(taken_measure.name) FROM  signal_has_taken_measure
                        LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id
                        WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure
                  FROM `signal`
                  LEFT JOIN agency ON agency.id = `signal`.check_subunit_id
                  LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                  LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                  LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                  WHERE `signal`.id IN (".implode(',',$grid).")
                  GROUP BY `signal`.id ";
        $order = " ORDER BY ";
        if(!empty($sort)){
            foreach($sort as $k=>$v){
                if($v['name'] == 'end_date' || $v['name'] == 'check_date'
                    || $v['name'] == 'check_date_id' || $v['name'] == 'subunit_date'){
                    $sort[$k]['name'] = ' DATE('.$v['name'].') ';
                }
            }
            $order .= $sort[0]['name'].' '.$sort[0]['sort'];
            unset($sort[0]);
            if(!empty($sort)){
                foreach($sort as $val){
                    $order .= ' , '.$val['name'].' '.$val['sort'];
                }
            }
            $query .= $order;
        }
        $this->_setSql($query);
        return $this->getAll();
    }

    public function report($data){
        $query = "SELECT DISTINCT(signal_qualification_id) , signal_qualification.name as signal_qualification ,
                  CAST(SUBSTRING_INDEX(signal_qualification.name,'-',1)  AS DECIMAL(20,1)) AS sqn
                  FROM `signal`
                  LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                  WHERE ";
        if($data['type'] == 'y'){
            $where = " YEAR(subunit_date) = '{$data['year']}'";
        }elseif($data['type'] == '1_q'){
            $where = " YEAR(subunit_date) = '{$data['year']}' AND MONTH(subunit_date) IN (1,2,3) ";
        }elseif($data['type'] == '2_q'){
            $where = " YEAR(subunit_date) = '{$data['year']}' AND MONTH(subunit_date) IN (4,5,6) ";
        }elseif($data['type'] == '3_q'){
            $where = " YEAR(subunit_date) = '{$data['year']}' AND MONTH(subunit_date) IN (7,8,9) ";
        }elseif($data['type'] == '4_q'){
            $where = " YEAR(subunit_date) = '{$data['year']}' AND MONTH(subunit_date) IN (10,11,12) ";
        }elseif($data['type'] == '1_h'){
            $where = " YEAR(subunit_date) = '{$data['year']}' AND MONTH(subunit_date) IN (1,2,3,4,5,6) ";
        }elseif($data['type'] == '2_h'){
            $where = " YEAR(subunit_date) = '{$data['year']}' AND MONTH(subunit_date) IN (7,8,9,10,11,12) ";
        }
        $query.= $where;
        $query.= " ORDER BY sqn ASC ";
        $this->_setSql($query);
        $qualifications = $this->getAll();
        if($qualifications){
            $last = array_pop($qualifications);
            array_unshift($qualifications,$last);
            foreach($qualifications as $k=>$v){
                for($i=1;$i<=15;$i++){
                    $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                              LEFT JOIN agency ON agency.id = `signal`.opened_agency_id
                              WHERE ".$where." AND agency.parent_id = '$i' AND signal_qualification_id = '{$v['signal_qualification_id']}' ";
                    $this->_setSql($query);
                    $c = $this->getRow();
                    if($c['c'] == 0){
                        $c['c'] = '';
                    }
                    $qualifications[$k]['agency'][$i] = $c['c'];
                }
            }
        }
        return $qualifications;
    }

    public function column1($date1){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                              LEFT JOIN agency ON agency.id = `signal`.check_unit_id
                              WHERE DATE(`signal`.subunit_date) <= '$date1' AND ( DATE(`signal`.end_date) >= '$date1' OR `signal`.end_date IS NULL )
                              AND agency.parent_id = '$i' ";
            $this->_setSql($query);
            $c = $this->getRow();
            $data[$i] = $c['c'];
        }
        return $data;
    }

    public function column2($date1,$date2,$res = null){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                              LEFT JOIN agency ON agency.id = `signal`.opened_agency_id
                              WHERE  DATE(`signal`.subunit_date) >= '$date1' AND DATE(`signal`.subunit_date) <= '$date2'
                              AND agency.parent_id = '$i' ";
            if($res){
                $query .= " AND source_resource_id = '$res' ";
            }
            $this->_setSql($query);
            $c = $this->getRow();
            if($res && $c['c'] == '0'){
                $c['c'] = "";
            }
            $data[$i] = $c['c'];
        }
        return $data;
    }

    public function column5($column_2,$column_3,$column_4){
        $data = array();
        for($i=1;$i<=15;$i++){
            $data[$i] = $column_2[$i] - ($column_3[$i]+$column_4[$i]);
            if($data[$i] == 0){
                $data[$i] = "";
            }
        }
        return $data;
    }

    public function column6(){
        $data = array();
        for($i=1;$i<=15;$i++){
            $data[$i] = "";
        }
        return $data;
    }

    public function column7($date1,$date2,$taken_measures_id = null){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                       LEFT JOIN agency ON agency.id = `signal`.check_unit_id
                       LEFT JOIN signal_has_taken_measure AS tk ON tk.signal_id = `signal`.id
                       WHERE  DATE(`signal`.end_date) >= '$date1' AND DATE(`signal`.end_date) <= '$date2'
                       AND agency.parent_id = '$i' ";
            if($taken_measures_id){
                $query .= " AND taken_measure_id = '$taken_measures_id' ";
            }
            $query .= " GROUP BY (agency.parent_id) ";
            $this->_setSql($query);
            $c = $this->getRow();
            if($taken_measures_id && $c['c'] == 0 ){
                $c['c'] = "";
            }elseif(!$c){
                $c['c'] = "0";
            }
            $data[$i] = $c['c'];
        }
        return $data;
    }

    public function column25($date1,$date2){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                       LEFT JOIN agency ON agency.id = `signal`.check_unit_id
                       LEFT JOIN signal_has_taken_measure AS tk ON tk.signal_id = `signal`.id
                       WHERE  DATE(`signal`.end_date) >= '$date1' AND DATE(`signal`.end_date) <= '$date2'
                       AND agency.parent_id = '$i' ";
            $query .= " AND taken_measure_id  IN ( 21,22,23,24,25,38,40 ) ";
            $query .= " GROUP BY (agency.parent_id) ";
            $this->_setSql($query);
            $c = $this->getRow();
            if($c['c'] == 0 ){
                $c['c'] = "";
            }
            $data[$i] = $c['c'];
        }
        return $data;
    }

    public function column18($date1,$date2){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                       LEFT JOIN agency ON agency.id = `signal`.check_unit_id
                       LEFT JOIN signal_has_taken_measure AS tk ON tk.signal_id = `signal`.id
                       WHERE  DATE(`signal`.end_date) >= '$date1' AND DATE(`signal`.end_date) <= '$date2'
                       AND agency.parent_id = '$i' ";
            $query .= " AND taken_measure_id  IN ( 7,9 ) ";
            $query .= " GROUP BY (agency.parent_id) ";
            $this->_setSql($query);
            $c = $this->getRow();
            if($c['c'] == 0 ){
                $c['c'] = "";
            }
            $data[$i] = $c['c'];
        }
        return $data;
    }

    public function column19($date1,$date2){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                       LEFT JOIN agency ON agency.id = `signal`.check_unit_id
                       LEFT JOIN signal_has_taken_measure AS tk ON tk.signal_id = `signal`.id
                       WHERE  DATE(`signal`.end_date) >= '$date1' AND DATE(`signal`.end_date) <= '$date2'
                       AND agency.parent_id = '$i' ";
            $query .= " AND taken_measure_id IN ( 43,44 ) ";
            $query .= " GROUP BY (agency.parent_id) ";
            $this->_setSql($query);
            $c = $this->getRow();
            if($c['c'] == 0 ){
                $c['c'] = "";
            }
            $data[$i] = $c['c'];
        }
        return $data;
    }



    public function column26($date1,$date2){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                       LEFT JOIN agency ON agency.id = `signal`.check_unit_id
                       WHERE  DATE(`signal`.end_date) >= '$date1' AND DATE(`signal`.end_date) <= '$date2'
                       AND agency.parent_id = '$i' AND signal_result_id = '3' ";
            $this->_setSql($query);
            $c = $this->getRow();
            if($c['c'] == 0 ){
                $c['c'] = "";
            }
            $data[$i] = $c['c'];
        }
        return $data;
    }

    public function column28($date1,$date2){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                       LEFT JOIN agency ON agency.id = `signal`.check_unit_id
                       WHERE  ( DATE(`signal`.subunit_date) <= '$date2' ) AND ( DATE(`signal`.end_date) >= '$date1' OR `signal`.end_date IS NULL )
                       AND agency.parent_id = '$i'
                       AND (SELECT COUNT(signal_has_check_date.check_date_id) FROM signal_has_check_date WHERE signal_id = `signal`.id) > 0
                       GROUP BY (agency.parent_id)

                       ";
            $this->_setSql($query);
            $c = $this->getRow();
            if($c['c'] == 0 ){
                $c['c'] = "";
            }
            $data[$i] = $c['c'];
        }
        return $data;
    }

    public function column29($date1,$date2){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                       LEFT JOIN agency ON agency.id = `signal`.check_unit_id
                       WHERE  ( DATE(`signal`.subunit_date) <= '$date2' ) AND ( DATE(`signal`.end_date) >= '$date1' OR `signal`.end_date IS NULL )
                       AND agency.parent_id = '$i'
                       AND (SELECT COUNT(signal_has_check_date.check_date_id) FROM signal_has_check_date WHERE signal_id = `signal`.id) > 1
                       GROUP BY (agency.parent_id)
                       ";
            $this->_setSql($query);
            $c = $this->getRow();
            if($c['c'] == 0 ){
                $c['c'] = "";
            }
            $data[$i] = $c['c'];
        }
        return $data;
    }

    public function column30($date1,$date2){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                       LEFT JOIN agency ON agency.id = `signal`.check_unit_id
                       WHERE DATE(`signal`.end_date) >= '$date1' AND DATE(`signal`.end_date) <= '$date2'
                       AND agency.parent_id = '$i'
                       AND (TO_DAYS(`signal`.end_date)-TO_DAYS(`signal`.check_date)) >= 1
                       GROUP BY (agency.parent_id)
                       ";
            $this->_setSql($query);
            $c = $this->getRow();
            if($c['c'] == 0 ){
                $c['c'] = "";
            }
            $data[$i] = $c['c'];
        }
        return $data;
    }

    public function column31($date2){
        $data = array();
        for($i=1;$i<=15;$i++){
            $query = "SELECT COUNT(agency.parent_id) AS c FROM `signal`
                              LEFT JOIN agency ON agency.id = `signal`.check_unit_id
                              WHERE DATE(`signal`.subunit_date) <= '$date2' AND ( DATE(`signal`.end_date) >= '$date2' OR `signal`.end_date IS NULL )
                              AND agency.parent_id = '$i' ";
            $this->_setSql($query);
            $c = $this->getRow();
            $data[$i] = $c['c'];
        }
        return $data;
    }

}