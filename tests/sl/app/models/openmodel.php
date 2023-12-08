<?php

class OpenModel extends Model {

    public function readBibliography($data){
        $query = "SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_category , access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name ,
	                                  (SELECT COUNT(DISTINCT file_id) FROM bibliography_has_file WHERE bibliography_id = `bibliography`.id) AS file_count,
	                                  (SELECT GROUP_CONCAT(country.name) FROM bibliography_has_country
                                        LEFT JOIN country ON bibliography_has_country.country_id = country.id WHERE bibliography_has_country.bibliography_id = `bibliography`.id
                                        GROUP BY bibliography_id) AS country
                FROM bibliography
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY bibliography.id desc";
        }
        if(isset($data['filter']['filters'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            $sDate = '';
            $eDate = '';
            foreach($filters as $filter){
                if(!empty($data['filter'])){
                $conditions = '';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'created_at'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $filter['field'] = 'bibliography`.`created_at';
                        $date = new DateTime($filter['value']);
                        $filter['value'] = $date->format('Y-m-d');
                    }elseif($filter['field'] == 'reg_date'){
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'bibliography`.`id';
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
                        $filter['filters'][0]['field'] = 'bibliography`.`created_at';
                    }
                    if($filter['filters'][1]['field'] == 'created_at'){
                        $filter['filters'][1]['field'] = 'bibliography`.`created_at';
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

                if( ($filter['field'] == 'file_count')||($filter['field'] == 'country')||($filter['field'] == 'user_name')||($filter['field'] == 'doc_category')||($filter['field'] == 'access_level')||($filter['field'] == 'source_agency_name')||($filter['field'] == 'from_agency_name') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (bibliography.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
//        echo $query;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countBibliography($data){
        $query = "SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_category ,  access_level.name AS access_level ,
	                                  source_agency.name AS source_agency_name , from_agency.name AS from_agency_name ,
	                                  (SELECT COUNT(DISTINCT file_id) FROM bibliography_has_file WHERE bibliography_id = `bibliography`.id) AS file_count,
	                                  (SELECT GROUP_CONCAT(country.name) FROM bibliography_has_country
                                        LEFT JOIN country ON bibliography_has_country.country_id = country.id WHERE bibliography_has_country.bibliography_id = `bibliography`.id
                                        GROUP BY bibliography_id) AS country
                FROM bibliography
                LEFT JOIN `users` ON `users`.id = bibliography.user_id
                LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter']['filters'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            $sDate = '';
            $eDate = '';
            foreach($filters as $filter){
                if(!empty($data['filter'])){
                    $conditions = '';
                    if(!isset($filter['logic'])){
                        if($filter['field'] == 'created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $filter['field'] = 'bibliography`.`created_at';
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'reg_date'){
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'bibliography`.`id';
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
                            $filter['filters'][0]['field'] = 'bibliography`.`created_at';
                        }
                        if($filter['filters'][1]['field'] == 'created_at'){
                            $filter['filters'][1]['field'] = 'bibliography`.`created_at';
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

                    if( ($filter['field'] == 'file_count')||($filter['field'] == 'country')||($filter['field'] == 'user_name')||($filter['field'] == 'doc_category')||($filter['field'] == 'access_level')||($filter['field'] == 'source_agency_name')||($filter['field'] == 'from_agency_name') ){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (bibliography.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function bibliographyJoins($bibliography_id){
        $query = "(SELECT man_has_bibliography.man_id AS id , 'man' AS tb_name FROM man_has_bibliography WHERE man_has_bibliography.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT action.id AS id, 'action' AS tb_name FROM action WHERE action.bibliography_id = '$bibliography_id' AND action.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT event.id AS id, 'event' AS tb_name FROM event WHERE event.bibliography_id = '$bibliography_id' AND event.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT organization_has_bibliography.organization_id AS id, 'organization' AS tb_name FROM organization_has_bibliography WHERE organization_has_bibliography.bibliography_id = '$bibliography_id' )
                  UNION
                  (SELECT `signal`.id AS id, 'signal' AS tb_name FROM `signal` WHERE `signal`.bibliography_id = '$bibliography_id' AND `signal`.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT criminal_case.id AS id, 'criminal_case' AS tb_name FROM criminal_case WHERE criminal_case.bibliography_id = '$bibliography_id' AND criminal_case.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT mia_summary.id AS id, 'mia_summary' AS tb_name FROM mia_summary WHERE mia_summary.bibliography_id = '$bibliography_id' AND mia_summary.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT control.id AS id, 'control' AS tb_name FROM control WHERE control.bibliography_id = '$bibliography_id' AND control.bibliography_id IS NOT NULL) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readWeapon($data){
        $query = "SELECT weapon.* FROM weapon";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY weapon.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                $sDate = '';
                $eDate = '';
            foreach($filters as $filter){
                $conditions = '';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'created_at'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                       $dateParse = new DateTime($filter['value']); 
                       $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'weapon`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
                        //$conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                        if($filter['field'] != 'count'){
                           $dateParse = new DateTime($filter['value']);                             
                           $filter['value'] = $dateParse->format('Y-m-d');
                        }
                        $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                    }
                }else{
                    $sDate = 'DATE(';
                    $eDate = ')';
                    $op1 = ''; $op2 ='';
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
        $query .= " GROUP BY (weapon.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
//        echo $query;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countWeapon($data){
        $query = "SELECT weapon.* FROM weapon";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                $sDate = '';
                $eDate = '';
                foreach($filters as $filter){
                    $conditions = '';
                    if(!isset($filter['logic'])){
                        if($filter['field'] == 'created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'weapon`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
                            //$conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                            if($filter['field'] != 'count'){
                                $dateParse = new DateTime($filter['value']);
                                $filter['value'] = $dateParse->format('Y-m-d');
                            }
                            $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $op1 = ''; $op2 ='';
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
        $query .= " GROUP BY (weapon.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function weaponJoins($weapon_id){
        $query = "(SELECT man_has_weapon.man_id AS id , 'man' AS tb_name FROM man_has_weapon WHERE man_has_weapon.weapon_id = '$weapon_id' )
                  UNION
                  (SELECT organization_has_weapon.organization_id AS id, 'organization' AS tb_name FROM organization_has_weapon WHERE organization_has_weapon.weapon_id = '$weapon_id')
                  UNION
                  (SELECT action_has_weapon.action_id AS id, 'action' AS tb_name FROM action_has_weapon WHERE action_has_weapon.weapon_id = '$weapon_id' )
                  UNION
                  (SELECT event_has_weapon.event_id AS id, 'event' AS tb_name FROM event_has_weapon WHERE event_has_weapon.weapon_id = '$weapon_id') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readCar($data){
        $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM car
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY car.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate = '';
                $eDate = '';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'created_at'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'car`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
                        //$conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                        if($filter['field'] != 'count'){
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }
                        $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                    }
                }else{
                    $sDate = 'DATE(';
                    $eDate = ')';
                    $op1 = ''; $op2 ='';
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

                if( ($filter['field'] == 'car_category')||($filter['field'] == 'car_mark')||($filter['field'] == 'car_color') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (car.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
//        echo $query;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countCar($data){
        $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                FROM car
                LEFT JOIN car_category ON car_category.id = car.category_id
                LEFT JOIN car_mark ON car_mark.id = car.mark_id
                LEFT JOIN color ON color.id = car.color_id
                ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    $sDate = '';
                    $eDate = '';
                    if(!isset($filter['logic'])){
                        if($filter['field'] == 'created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'car`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
                            //$conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                            if($filter['field'] != 'count'){
                                $dateParse = new DateTime($filter['value']);
                                $filter['value'] = $dateParse->format('Y-m-d');
                            }
                            $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $op1 = ''; $op2 ='';
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

                    if( ($filter['field'] == 'car_category')||($filter['field'] == 'car_mark')||($filter['field'] == 'car_color') ){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (car.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function carJoins($car_id){
        $query = "(SELECT man_has_car.man_id AS id , 'man' AS tb_name FROM man_has_car WHERE man_has_car.car_id = '$car_id' )
                  UNION
                  (SELECT organization_has_car.organization_id AS id, 'organization' AS tb_name FROM organization_has_car WHERE organization_has_car.car_id = '$car_id')
                  UNION
                  (SELECT action_has_car.action_id AS id, 'action' AS tb_name FROM action_has_car WHERE action_has_car.car_id = '$car_id' )
                  UNION
                  (SELECT event_has_car.event_id AS id, 'event' AS tb_name FROM event_has_car WHERE event_has_car.car_id = '$car_id')
                  UNION
                  (SELECT man_use_car.man_id AS id , 'man' AS tb_name FROM man_use_car WHERE man_use_car.car_id = '$car_id' )
                  UNION
                  (SELECT car_has_address.address_id AS id , 'address' AS tb_name FROM car_has_address WHERE car_has_address.car_id = '$car_id' )";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readAddress($data){
        $query = "SELECT	address.* , country.name AS country , region.name AS region , locality.name AS locality, street.name AS street , country_ate.name AS country_ate
            FROM address
            LEFT JOIN country ON country.id = address.country_id
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY address.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate = '';
                $eDate = '';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'created_at'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'address`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                    }
                }else{
                    $sDate = 'DATE(';
                    $eDate = ')';
                    $op1 = ''; $op2 ='';
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

                if( ($filter['field'] == 'country')||($filter['field'] == 'region')||($filter['field'] == 'locality')||($filter['field'] == 'street')||($filter['field'] == 'country_ate') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (address.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countAddress($data){
        $query = "SELECT	address.* , country.name AS country , region.name AS region , locality.name AS locality, street.name AS street , country_ate.name AS country_ate
            FROM address
            LEFT JOIN country ON country.id = address.country_id
            LEFT JOIN region ON region.id = address.region_id
            LEFT JOIN locality ON locality.id = address.locality_id
            LEFT JOIN street ON street.id = address.street_id
            LEFT JOIN country_ate ON country_ate.id = address.country_ate_id ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    $sDate = '';
                    $eDate = '';
                    if(!isset($filter['logic'])){
                        if($filter['field'] == 'created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'address`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
//                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                            $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $op1 = ''; $op2 ='';
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

                    if( ($filter['field'] == 'country')||($filter['field'] == 'region')||($filter['field'] == 'locality')||($filter['field'] == 'street')||($filter['field'] == 'country_ate') ){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (address.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function addressJoins($address_id){
        $query = "(SELECT man_has_address.man_id AS id , 'man' AS tb_name FROM man_has_address WHERE man_has_address.address_id = '$address_id' )
                  UNION
                  (SELECT action.id AS id , 'action' AS tb_name FROM action WHERE action.address_id = '$address_id' )
                  UNION
                  (SELECT event.id AS id , 'event' AS tb_name FROM event WHERE event.address_id = '$address_id' )
                  UNION
                  (SELECT organization_has_address.organization_id AS id, 'organization' AS tb_name FROM organization_has_address WHERE organization_has_address.address_id = '$address_id')
                  UNION
                  (SELECT car_has_address.car_id AS id, 'car' AS tb_name FROM car_has_address WHERE car_has_address.address_id = '$address_id')
                  UNION
                  (SELECT man.id AS id, 'man' AS tb_name FROM man WHERE man.born_address_id = '$address_id')
                  UNION
                  (SELECT organization.id AS id, 'organization' AS tb_name FROM organization WHERE organization.address_id = '$address_id')";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readAction($data){
        $query = "SELECT `action`.* , duration.name AS duration, action_goal.name AS goal, terms.name AS terms, aftermath.name AS aftermath,
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
            LEFT JOIN duration ON duration.id = action.duration_id
            LEFT JOIN action_goal ON action_goal.id = action.goal_id
            LEFT JOIN terms ON terms.id = action.terms_id
            LEFT JOIN aftermath ON aftermath.id = action.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = action.action_qualification_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY action.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate = '';
                $eDate = '';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'start_date' || $filter['field'] == 'end_date'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'action`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
//                        $dateParse = new DateTime($filter['value']);
//                        $filter['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                    }
                }else{
                    $sDate = 'DATE(';
                    $eDate = ')';
                    $op1 = ''; $op2 ='';
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

                if( ($filter['field'] == 'duration')||($filter['field'] == 'goal')||($filter['field'] == 'terms')||($filter['field'] == 'aftermath')
                    ||($filter['field'] == 'action_qualification')||($filter['field'] == 'material_content')||($filter['field'] == 'man_count')){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (action.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
//        echo $query;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countAction($data){
        $query = "SELECT `action`.* , duration.name AS duration, goal.name AS goal, terms.name AS terms, aftermath.name AS aftermath,
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
            LEFT JOIN duration ON duration.id = action.duration_id
            LEFT JOIN goal ON goal.id = action.goal_id
            LEFT JOIN terms ON terms.id = action.terms_id
            LEFT JOIN aftermath ON aftermath.id = action.aftermath_id
            LEFT JOIN action_qualification ON action_qualification.id = action.action_qualification_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    $sDate = '';
                    $eDate = '';
                    if(!isset($filter['logic'])){
                        if($filter['field'] == 'start_date' || $filter['field'] == 'end_date'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'action`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
//                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
//                            $dateParse = new DateTime($filter['value']);
//                            $filter['value'] = $dateParse->format('Y-m-d');
                            $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $op1 = ''; $op2 ='';
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

                    if( ($filter['field'] == 'duration')||($filter['field'] == 'goal')||($filter['field'] == 'terms')||($filter['field'] == 'aftermath')||($filter['field'] == 'action_qualification')||($filter['field'] == 'material_content')||($filter['field'] == 'man_count')){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (action.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function actionJoins($action_id){
        $query = " (SELECT action_has_man.man_id AS id , 'man' AS tb_name FROM action_has_man WHERE action_has_man.action_id = '$action_id' )
                  UNION
                  (SELECT action_has_organization.organization_id AS id, 'organization' AS tb_name FROM action_has_organization WHERE action_has_organization.action_id = '$action_id')
                  UNION
                  (SELECT event_has_action.event_id AS id, 'event' AS tb_name FROM event_has_action WHERE event_has_action.action_id = '$action_id')
                  UNION
                  (SELECT action_has_event.event_id AS id, 'event' AS tb_name FROM action_has_event WHERE action_has_event.action_id = '$action_id')
                  UNION
                  (SELECT action_has_phone.phone_id AS id, 'phone' AS tb_name FROM action_has_phone WHERE action_has_phone.action_id = '$action_id')
                  UNION
                  (SELECT action_has_weapon.weapon_id AS id, 'weapon' AS tb_name FROM action_has_weapon WHERE action_has_weapon.action_id = '$action_id')
                  UNION
                  (SELECT action_has_car.car_id AS id, 'car' AS tb_name FROM action_has_car WHERE action_has_car.action_id = '$action_id')
                  UNION
                  (SELECT action_passes_signal.signal_id AS id, 'signal' AS tb_name FROM action_passes_signal WHERE action_passes_signal.action_id = '$action_id')
                  UNION
                  (SELECT criminal_case_id AS id, 'criminal_case' AS tb_name FROM action_has_criminal_case WHERE action_id = '$action_id')
                  UNION
                  (SELECT action_to_action.action_id1 AS id, 'action' AS tb_name FROM action_to_action WHERE action_id2 = '$action_id')
                  UNION
                  (SELECT action_to_action.action_id2 AS id, 'action' AS tb_name FROM action_to_action WHERE action_id1 = '$action_id')
                  UNION
                  (SELECT action.address_id AS id, 'address' AS tb_name FROM action WHERE action.id = '$action_id' AND action.address_id IS NOT NULL )
                  UNION
                  (SELECT action.bibliography_id AS id, 'bibliography' AS tb_name FROM action WHERE action.id = '$action_id' AND action.bibliography_id IS NOT NULL) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readMan($data){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion ,
                            resource.name AS resource , man_has_bibliography.bibliography_id AS bibliography_id,
                            region.name AS region, country_ate.name AS country_ate, locality.name AS locality,
                            (SELECT COUNT(*) FROM man_external_sign_has_photo WHERE man_external_sign_has_photo.man_id = man.id) AS photo_count,
                            CONVERT(SUBSTR(birthday,1,4),UNSIGNED INTEGER) AS birthday_y,
                            CONVERT(SUBSTR(birthday,6,2),UNSIGNED INTEGER) AS birthday_m,
                            CONVERT(SUBSTR(birthday,9,2),UNSIGNED INTEGER) AS birthday_d,
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
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id
                                  WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(LEFT(more_data_man.text,10)) FROM more_data_man
                                  WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                           CONCAT(man.start_year, ' ', COALESCE(man.end_year, ' ')) AS approximate_year,
                          CONCAT(COALESCE((SELECT GROUP_CONCAT(last_name.last_name  SEPARATOR ' ') FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id
                                  WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id),''),' ',
                                    COALESCE((SELECT GROUP_CONCAT(first_name.first_name  SEPARATOR ' ') FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id
                                  WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id ),'')
                                    ,' ',
                                    COALESCE((SELECT GROUP_CONCAT(middle_name.middle_name  SEPARATOR ' ') FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id
                                  WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id),'')
                                  ) AS man_auto
                  FROM man
                  LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man.id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  LEFT JOIN address ON address.id = man.born_address_id
                  LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  LEFT JOIN region ON region.id = address.region_id
                  LEFT JOIN locality ON locality.id = address.locality_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY man.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='birthday' || $filter['field']=='start_wanted' || $filter['field']=='entry_date' || $filter['field']=='exit_date' || $filter['field']=='fixing_moment'){
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'man`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        if($filter['filters'][0]['field'] != 'birthday_d' && $filter['filters'][0]['field'] != 'birthday_y' && $filter['filters'][0]['field'] != 'birthday_m' && $filter['filters'][0]['field'] != 'photo_count'){
                            $dateParse = new DateTime($filter['filters'][0]['value']);
                            $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                            $dateParse = new DateTime($filter['filters'][1]['value']);
                            $filter['filters'][1]['value'] = $dateParse->format('Y-m-d');
                        }
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        if($filter['filters'][0]['field'] != 'birthday_y' && $filter['filters'][0]['field'] != 'birthday_d' && $filter['filters'][0]['field'] != 'birthday_m' && $filter['filters'][0]['field'] != 'photo_count'){
                            $dateParse = new DateTime($filter['filters'][0]['value']);
                            $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        }
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( ($filter['field'] == 'gender')||($filter['field'] == 'nation')||($filter['field'] == 'religion')||($filter['field'] == 'resource')||($filter['field'] == 'bibliography_id')
                            ||($filter['field'] == 'first_name')||($filter['field'] == 'last_name')||($filter['field'] == 'middle_name')||($filter['field'] == 'passport')
                            ||($filter['field'] == 'man_belongs_country')||($filter['field'] == 'education')||($filter['field'] == 'more_data')||($filter['field'] == 'man_knows_language')
                            ||($filter['field'] == 'party')||($filter['field'] == 'nickname')||($filter['field'] == 'operation_category')||($filter['field'] == 'approximate_year')
                            ||($filter['field'] == 'country_search_man')||($filter['field'] == 'region')||($filter['field'] == 'country_ate')||($filter['field'] == 'locality')
                            ||($filter['field'] == 'birthday_y')||($filter['field'] == 'birthday_d')||($filter['field'] == 'birthday_m')||($filter['field'] == 'photo_count')||($filter['field'] == 'man_auto') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (man.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return  $this->getAll();
    }

    public function countMan($data){
        $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion ,
                          resource.name AS resource , man_has_bibliography.bibliography_id AS bibliography_id,
                          region.name AS region, country_ate.name AS country_ate, locality.name AS locality,
                          (SELECT COUNT(*) FROM man_external_sign_has_photo WHERE man_external_sign_has_photo.man_id = man.id) AS photo_count,
                          CONVERT(SUBSTR(birthday,1,4),UNSIGNED INTEGER) AS birthday_y,
                            CONVERT(SUBSTR(birthday,6,2),UNSIGNED INTEGER) AS birthday_m,
                            CONVERT(SUBSTR(birthday,9,2),UNSIGNED INTEGER) AS birthday_d,
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
                                  (SELECT GROUP_CONCAT(operation_category.name) FROM man_has_operation_category
                                  LEFT JOIN operation_category ON man_has_operation_category.operation_category_id = operation_category.id
                                  WHERE man_has_operation_category.man_id = man.id
                                   GROUP BY man_id) AS operation_category,
                                   (SELECT GROUP_CONCAT(LEFT(more_data_man.text,10)) FROM more_data_man
                                  WHERE more_data_man.man_id = man.id
                                   GROUP BY man_id) AS more_data,
                           CONCAT(man.start_year, '-', man.end_year) AS approximate_year,
                           CONCAT((SELECT GROUP_CONCAT(last_name.last_name  SEPARATOR ' ') FROM man_has_last_name
                                  LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id
                                  WHERE man_has_last_name.man_id = man.id
                                   GROUP BY man_id),' ',
                                    (SELECT GROUP_CONCAT(first_name.first_name  SEPARATOR ' ') FROM man_has_first_name
                                  LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id
                                  WHERE man_has_first_name.man_id = man.id
                                   GROUP BY man_id )
                                    ,' ',(SELECT GROUP_CONCAT(middle_name.middle_name  SEPARATOR ' ') FROM man_has_middle_name
                                  LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id
                                  WHERE man_has_middle_name.man_id = man.id
                                  GROUP BY man_id)) AS man_auto
                  FROM man
                  LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man.id
                  LEFT JOIN gender ON gender.id = man.gender_id
                  LEFT JOIN nation ON nation.id = man.nation_id
                  LEFT JOIN religion ON religion.id = man.religion_id
                  LEFT JOIN resource ON resource.id = man.resource_id
                  LEFT JOIN address ON address.id = man.born_address_id
                  LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                  LEFT JOIN region ON region.id = address.region_id
                  LEFT JOIN locality ON locality.id = address.locality_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    $sDate='';
                    $eDate='';
                    if(!isset($filter['logic'])){
                        if($filter['field']=='birthday' || $filter['field']=='start_wanted' || $filter['field']=='entry_date' || $filter['field']=='exit_date' || $filter['field']=='fixing_moment'){
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'man`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
//                            $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                        }elseif($filter['operator'] == 'neq'){
                            $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                            $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $op1 = ''; $op2 ='';
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
                            if($filter['filters'][0]['field'] != 'birthday_d' && $filter['filters'][0]['field'] != 'birthday_y' && $filter['filters'][0]['field'] != 'birthday_m' && $filter['filters'][0]['field'] != 'photo_count'){
                                $dateParse = new DateTime($filter['filters'][0]['value']);
                                $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                                $dateParse = new DateTime($filter['filters'][1]['value']);
                                $filter['filters'][1]['value'] = $dateParse->format('Y-m-d');
                            }
                            $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                        }else{
                            if($filter['filters'][0]['field'] != 'birthday_d' && $filter['filters'][0]['field'] != 'birthday_y' && $filter['filters'][0]['field'] != 'birthday_m' && $filter['filters'][0]['field'] != 'photo_count'){
                                $dateParse = new DateTime($filter['filters'][0]['value']);
                                $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                            }
                            $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                        }
                        $filter['field'] = $filter['filters'][0]['field'];
                    }

                    if( ($filter['field'] == 'gender')||($filter['field'] == 'nation')||($filter['field'] == 'religion')||($filter['field'] == 'resource')||($filter['field'] == 'bibliography_id')
                        ||($filter['field'] == 'first_name')||($filter['field'] == 'last_name')||($filter['field'] == 'middle_name')||($filter['field'] == 'passport')
                        ||($filter['field'] == 'man_belongs_country')||($filter['field'] == 'education')||($filter['field'] == 'more_data')||($filter['field'] == 'man_knows_language')
                        ||($filter['field'] == 'party')||($filter['field'] == 'nickname')||($filter['field'] == 'operation_category')||($filter['field'] == 'approximate_year')
                        ||($filter['field'] == 'region')||($filter['field'] == 'country_ate')||($filter['field'] == 'locality')||($filter['field'] == 'country_search_man')
                        ||($filter['field'] == 'birthday_y')||($filter['field'] == 'birthday_d')||($filter['field'] == 'birthday_m')||($filter['field'] == 'photo_count')||($filter['field'] == 'man_auto')){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (man.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function manJoins($man_id){
        $query = " (SELECT man_id2 AS id , 'man' AS tb_name FROM man_to_man WHERE man_id1 = '$man_id')
                  UNION
                  (SELECT man_id1 AS id , 'man' AS tb_name FROM man_to_man WHERE man_id2 = '$man_id')
                  UNION
                  (SELECT man_has_address.address_id AS id, 'address' AS tb_name FROM man_has_address WHERE man_has_address.man_id = '$man_id')
                  UNION
                  (SELECT man_has_phone.phone_id AS id, 'phone' AS tb_name FROM man_has_phone WHERE man_has_phone.man_id = '$man_id')
                  UNION
                  (SELECT organization_has_man.id AS id, 'organization_has_man' AS tb_name FROM organization_has_man WHERE organization_has_man.man_id = '$man_id' AND (organization_has_man.title IS NOT NULL OR organization_has_man.start_date IS NOT NULL OR organization_has_man.end_date IS NOT NULL OR organization_has_man.period IS NOT NULL))
                  UNION
                  (SELECT organization_has_man.organization_id AS id, 'organization' AS tb_name FROM organization_has_man WHERE organization_has_man.man_id = '$man_id')
                  UNION
                  (SELECT man_bean_country.id AS id, 'man_bean_country' AS tb_name FROM man_bean_country WHERE man_bean_country.man_id = '$man_id')
                  UNION
                  (SELECT man_external_sign_has_sign.sign_id AS id, 'sign' AS tb_name FROM man_external_sign_has_sign WHERE man_external_sign_has_sign.man_id = '$man_id')
                  UNION
                  (SELECT action_has_man.action_id AS id, 'action' AS tb_name FROM action_has_man WHERE action_has_man.man_id = '$man_id')
                  UNION
                  (SELECT event_has_man.event_id AS id, 'event' AS tb_name FROM event_has_man WHERE event_has_man.man_id = '$man_id')
                  UNION
                  (SELECT signal_has_man.signal_id AS id, 'signal' AS tb_name FROM signal_has_man WHERE signal_has_man.man_id = '$man_id')
                  UNION
                  (SELECT man_passed_by_signal.signal_id AS id, 'signal' AS tb_name FROM man_passed_by_signal WHERE man_passed_by_signal.man_id = '$man_id')
                  UNION
                  (SELECT criminal_case_has_man.criminal_case_id AS id, 'criminal_case' AS tb_name FROM criminal_case_has_man WHERE criminal_case_has_man.man_id = '$man_id')
                  UNION
                  (SELECT man_passes_mia_summary.mia_summary_id AS id, 'mia_summary' AS tb_name FROM man_passes_mia_summary WHERE man_passes_mia_summary.man_id = '$man_id' )
                  UNION
                  (SELECT man_has_car.car_id AS id, 'car' AS tb_name FROM man_has_car WHERE man_has_car.man_id = '$man_id')
                  UNION
                  (SELECT man_use_car.car_id AS id, 'car' AS tb_name FROM man_use_car WHERE man_use_car.man_id = '$man_id')
                  UNION
                  (SELECT man_has_weapon.weapon_id AS id, 'weapon' AS tb_name FROM man_has_weapon WHERE man_has_weapon.man_id = '$man_id')
                  UNION
                  (SELECT man_has_bibliography.bibliography_id AS id, 'bibliography' AS tb_name FROM man_has_bibliography WHERE man_has_bibliography.man_id = '$man_id')
                  UNION
                  (SELECT objects_relation.first_object_id AS id, objects_relation.first_object_type AS tb_name FROM objects_relation WHERE objects_relation.second_obejct_type = 'man' AND objects_relation.second_object_id = '$man_id')
                  UNION
                  (SELECT objects_relation.second_object_id AS id, objects_relation.second_obejct_type AS tb_name FROM objects_relation WHERE objects_relation.first_object_type = 'man' AND objects_relation.first_object_id = '$man_id') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readSignal($data){
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
                LEFT JOIN signal_has_check_date ON signal_has_check_date.signal_id = `signal`.id
                LEFT JOIN check_date ON check_date.id = signal_has_check_date.check_date_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY signal.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate = '';
                $eDate = '';
                if(!isset($filter['logic'])){
                    if($filter['field']=='subunit_date' || $filter['field']=='check_date' || $filter['field']=='end_date' || $filter['field']=='created_at'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'signal`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                        $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                    }
                }else{
                    $sDate = 'DATE(';
                    $eDate = ')';
                    $op1 = ''; $op2 ='';
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

                if( ($filter['field'] == 'signal_qualification')||($filter['field'] == 'check_agency')||($filter['field'] == 'check_unit')||($filter['field'] == 'check_subunit')||($filter['field'] == 'opened_agency')
                    ||($filter['field'] == 'opened_unit')||($filter['field'] == 'opened_subunit')||($filter['field'] == 'resource')||($filter['field'] == 'signal_result')
                    ||($filter['field'] == 'worker')||($filter['field'] == 'worker_post')||($filter['field'] == 'checking_worker')||($filter['field'] == 'checking_worker_post')
                    ||($filter['field'] == 'taken_measure')||($filter['field'] == 'signal_used_resource')||($filter['field'] == 'keep_count')||($filter['field'] == 'count_days')
                    ||($filter['field'] == 'reg_num')||($filter['field'] == 'check_line')||($filter['field'] == 'check_date_id')||($filter['field'] == 'check_date_count')||($filter['field'] == 'man_count')){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (signal.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countSignal($data){
        $query = " SELECT `signal`.*, signal_qualification.name AS signal_qualification, check_agency.name AS check_agency, check_unit.name AS check_unit,
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
                LEFT JOIN signal_has_check_date ON signal_has_check_date.signal_id = `signal`.id
                LEFT JOIN check_date ON check_date.id = signal_has_check_date.check_date_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    $sDate = '';
                    $eDate = '';
                    if(!isset($filter['logic'])){
                        if($filter['field']=='subunit_date' || $filter['field']=='check_date' || $filter['field']=='end_date' || $filter['field']=='created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'signal`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
//                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                            $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $op1 = ''; $op2 ='';
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

                    if( ($filter['field'] == 'signal_qualification')||($filter['field'] == 'check_agency')||($filter['field'] == 'check_unit')||($filter['field'] == 'check_subunit')||($filter['field'] == 'opened_agency')
                        ||($filter['field'] == 'opened_unit')||($filter['field'] == 'opened_subunit')||($filter['field'] == 'resource')||($filter['field'] == 'signal_result')
                        ||($filter['field'] == 'worker')||($filter['field'] == 'worker_post')||($filter['field'] == 'checking_worker')||($filter['field'] == 'checking_worker_post')
                        ||($filter['field'] == 'taken_measure')||($filter['field'] == 'signal_used_resource')||($filter['field'] == 'keep_count')||($filter['field'] == 'count_days')
                        ||($filter['field'] == 'reg_num')||($filter['field'] == 'check_line')||($filter['field'] == 'check_date_id')||($filter['field'] == 'check_date_count')||($filter['field'] == 'man_count')){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (signal.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function signalJoins($signal_id){
        $query = " (SELECT signal_has_man.man_id AS id, 'man' AS tb_name FROM signal_has_man WHERE signal_has_man.signal_id = '$signal_id')
                  UNION
                  (SELECT man_passed_by_signal.man_id AS id, 'man' AS tb_name FROM man_passed_by_signal WHERE man_passed_by_signal.signal_id = '$signal_id')
                  UNION
                  (SELECT organization_checked_by_signal.organization_id AS id, 'organization' AS tb_name FROM organization_checked_by_signal WHERE organization_checked_by_signal.signal_id = '$signal_id')
                  UNION
                  (SELECT organization_passes_by_signal.organization_id AS id, 'organization' AS tb_name FROM organization_passes_by_signal WHERE organization_passes_by_signal.signal_id = '$signal_id')
                  UNION
                  (SELECT criminal_case_id AS id, 'criminal_case' AS tb_name FROM criminal_case_has_signal WHERE signal_id = '$signal_id')
                  UNION
                  (SELECT action_passes_signal.action_id AS id, 'action' AS tb_name FROM action_passes_signal WHERE action_passes_signal.signal_id = '$signal_id')
                  UNION
                  (SELECT event_passes_signal.event_id AS id, 'event' AS tb_name FROM event_passes_signal WHERE event_passes_signal.signal_id = '$signal_id')
                  UNION
                  (SELECT `signal`.bibliography_id AS id, 'bibliography' AS tb_name FROM `signal` WHERE `signal`.id = '$signal_id' AND `signal`.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT keep_signal.id AS id, 'keep_signal' AS tb_name FROM keep_signal WHERE keep_signal.signal_id = '$signal_id' AND keep_signal.signal_id IS NOT NULL) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readKeepSignal($data){
        $query = " SELECT keep_signal.* , agency.name AS agency, unit.name AS unit, sub_unit.name AS sub_unit, passed_sub_unit.name AS pased_sub_units,
               (SELECT GROUP_CONCAT(worker) FROM keep_signal_worker WHERE keep_signal_worker.keep_signal_id = keep_signal.id ) AS worker ,
               (SELECT GROUP_CONCAT(worker_post.name) FROM keep_signal_worker_post
                LEFT JOIN worker_post ON worker_post.id = keep_signal_worker_post.worker_post_id
                WHERE keep_signal_worker_post.keep_signal_id = keep_signal.id ) AS worker_post
           FROM keep_signal
           LEFT JOIN agency ON agency.id = keep_signal.agency_id
           LEFT JOIN agency AS unit ON unit.id = keep_signal.unit_id
           LEFT JOIN agency AS sub_unit ON sub_unit.id = keep_signal.sub_unit_id
           LEFT JOIN agency AS passed_sub_unit ON passed_sub_unit.id = keep_signal.pased_sub_unit ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY keep_signal.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='start_date' || $filter['field']=='end_date' || $filter['field']=='pass_date'){
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'keep_signal`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( ($filter['field'] == 'agency')||($filter['field'] == 'unit')||($filter['field'] == 'sub_unit')||($filter['field'] == 'pased_sub_units')||($filter['field'] == 'worker')||($filter['field'] == 'worker_post') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (keep_signal.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countKeepSignal($data){
        $query = " SELECT keep_signal.* , agency.name AS agency, unit.name AS unit, sub_unit.name AS sub_unit, passed_sub_unit.name AS pased_sub_units,
               (SELECT GROUP_CONCAT(worker) FROM keep_signal_worker WHERE keep_signal_worker.keep_signal_id = keep_signal.id ) AS worker ,
               (SELECT GROUP_CONCAT(worker_post.name) FROM keep_signal_worker_post
                LEFT JOIN worker_post ON worker_post.id = keep_signal_worker_post.worker_post_id
                WHERE keep_signal_worker_post.keep_signal_id = keep_signal.id ) AS worker_post
           FROM keep_signal
           LEFT JOIN agency ON agency.id = keep_signal.agency_id
           LEFT JOIN agency AS unit ON unit.id = keep_signal.unit_id
           LEFT JOIN agency AS sub_unit ON sub_unit.id = keep_signal.sub_unit_id
           LEFT JOIN agency AS passed_sub_unit ON passed_sub_unit.id = keep_signal.pased_sub_unit ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='start_date' || $filter['field']=='end_date' || $filter['field']=='pass_date'){
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'keep_signal`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( ($filter['field'] == 'agency')||($filter['field'] == 'unit')||($filter['field'] == 'sub_unit')||($filter['field'] == 'pased_sub_units')||($filter['field'] == 'worker')||($filter['field'] == 'worker_post') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (keep_signal.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }


    public function keepSignalJoins($keep_signal_id){
        $query = " (SELECT keep_signal.signal_id AS id, 'signal' AS tb_name FROM keep_signal WHERE keep_signal.id = '$keep_signal_id' AND keep_signal.signal_id IS NOT NULL) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readCriminalCase($data){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS unit, subunit.name AS subunit,
			          (SELECT GROUP_CONCAT(worker) FROM criminal_case_worker WHERE criminal_case_worker.criminal_case_id = criminal_case.id ) AS worker ,
			          (SELECT COUNT(*) FROM criminal_case_has_man WHERE criminal_case_has_man.criminal_case_id = criminal_case.id) AS man_count,
			          (SELECT GROUP_CONCAT(worker_post.name) FROM criminal_case_worker_post
			           LEFT JOIN worker_post ON worker_post.id = criminal_case_worker_post.worker_post_id
			           WHERE criminal_case_worker_post.criminal_case_id = criminal_case.id ) AS worker_post
            FROM criminal_case
            LEFT JOIN agency AS opened_agency ON opened_agency.id = criminal_case.opened_agency_id
            LEFT JOIN agency AS opened_unit ON opened_unit.id = criminal_case.opened_unit_id
            LEFT JOIN agency AS subunit ON subunit.id = criminal_case.subunit_id
            ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY `{$data['sort'][0]['field']}` {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY criminal_case.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate = '';
                $eDate = '';
                if(!isset($filter['logic'])){
                    if($filter['field']=='created_at'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                        $filter['field'] = 'criminal_case`.`created_at';
                    }elseif($filter['field']=='opened_date'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'criminal_case`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' '|| $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                        $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                    }
                }else{
                    $sDate = '';
                    $eDate = '';
                    if($filter['field']=='created_at'){
                        $filter['field'] = 'criminal_case`.`created_at';
                    }
                    $op1 = ''; $op2 ='';
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

                if( ($filter['field'] == 'opened_agency')||($filter['field'] == 'unit')||($filter['field'] == 'subunit')||($filter['field'] == 'man_count')
                    ||($filter['field'] == 'worker')||($filter['field'] == 'worker_post') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (criminal_case.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countCriminalCase($data){
        $query = " SELECT criminal_case.* , opened_agency.name AS opened_agency, opened_unit.name AS unit, subunit.name AS subunit,
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
            LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id	";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    $sDate = '';
                    $eDate = '';
                    if(!isset($filter['logic'])){
                        if($filter['field']=='created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                            $filter['field'] = 'criminal_case`.`created_at';
                        }elseif($filter['field']=='opened_date'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'criminal_case`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
//                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                            $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $sDate = 'DATE(';
                        $eDate = ')';
                        if($filter['field']=='created_at'){
                            $filter['field'] = 'criminal_case`.`created_at';
                        }
                        $op1 = ''; $op2 ='';
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

                    if( ($filter['field'] == 'opened_agency')||($filter['field'] == 'unit')||($filter['field'] == 'subunit')||($filter['field'] == 'man_count')
                        ||($filter['field'] == 'worker')||($filter['field'] == 'worker_post') ){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (criminal_case.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function criminalCaseJoins($criminal_case_id){
        $query = " (SELECT criminal_case_has_man.man_id AS id, 'man' AS tb_name FROM criminal_case_has_man WHERE criminal_case_has_man.criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_has_organization.organization_id AS id, 'organization' AS tb_name FROM criminal_case_has_organization WHERE criminal_case_has_organization.criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_has_signal.signal_id AS id, 'signal' AS tb_name FROM criminal_case_has_signal WHERE criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT event_id AS id, 'event' AS tb_name FROM event_has_criminal_case WHERE criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT action_id AS id, 'action' AS tb_name FROM action_has_criminal_case WHERE criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case.bibliography_id AS id, 'bibliography' AS tb_name FROM criminal_case WHERE criminal_case.id = '$criminal_case_id' AND criminal_case.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT criminal_case_extracted_criminal_case.criminal_case_id1 AS id, 'criminal_case' AS tb_name FROM criminal_case_extracted_criminal_case WHERE criminal_case_extracted_criminal_case.criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_extracted_criminal_case.criminal_case_id AS id, 'criminal_case' AS tb_name FROM criminal_case_extracted_criminal_case WHERE criminal_case_extracted_criminal_case.criminal_case_id1 = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_splited_criminal_case.criminal_case_id1 AS id, 'criminal_case' AS tb_name FROM criminal_case_splited_criminal_case WHERE criminal_case_splited_criminal_case.criminal_case_id = '$criminal_case_id')
                  UNION
                  (SELECT criminal_case_splited_criminal_case.criminal_case_id AS id, 'criminal_case' AS tb_name FROM criminal_case_splited_criminal_case WHERE criminal_case_splited_criminal_case.criminal_case_id1 = '$criminal_case_id') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readControl($data){
        $query = "SELECT control.* , unit.name AS unit, act_unit.name AS act_unit, sub_act_unit.name AS sub_act_unit, doc_category.name AS doc_category, control_result.name AS result
            FROM control
            LEFT JOIN agency AS unit ON unit.id = control.unit_id
            LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
            LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
            LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
            LEFT JOIN control_result ON control_result.id = control.result_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY control.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='creation_date' || $filter['field']=='reg_date' || $filter['field']=='resolution_date'){
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'control`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( ($filter['field'] == 'unit')||($filter['field'] == 'act_unit')||($filter['field'] == 'sub_act_unit')||($filter['field'] == 'doc_category') ||($filter['field'] == 'result') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (control.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countControl($data){
        $query = "SELECT control.* , unit.name AS unit, act_unit.name AS act_unit, sub_act_unit.name AS sub_act_unit, doc_category.name AS doc_category, control_result.name AS result
            FROM control
            LEFT JOIN agency AS unit ON unit.id = control.unit_id
            LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
            LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
            LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
            LEFT JOIN control_result ON control_result.id = control.result_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='creation_date' || $filter['field']=='reg_date' || $filter['field']=='resolution_date'){
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'control`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( ($filter['field'] == 'unit')||($filter['field'] == 'act_unit')||($filter['field'] == 'sub_act_unit')||($filter['field'] == 'doc_category') ||($filter['field'] == 'result') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (control.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function controlJoins($control_id){
        $query = " (SELECT control.bibliography_id AS id, 'bibliography' AS tb_name FROM control WHERE control.id = '$control_id' AND control.bibliography_id IS NOT NULL) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readMiaSummary($data){
        $query = " SELECT mia_summary.* ,
                    (SELECT COUNT(*) FROM man_passes_mia_summary WHERE man_passes_mia_summary.mia_summary_id = mia_summary.id) AS man_count
                    FROM mia_summary ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY mia_summary.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){

            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate = '';
                $eDate = '';
                if(!isset($filter['logic'])){
                    if($filter['field']=='date' || $filter['field']=='created_at'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $dateParse = new DateTime($filter['value']);
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'mia_summary`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                        $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                    }
                }else{
                    $sDate = 'DATE(';
                    $eDate = ')';
                    $op1 = ''; $op2 ='';
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

                if( ($filter['field'] == 'man_count') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (mia_summary.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countMiaSummary($data){
        $query = " SELECT mia_summary.*,(SELECT COUNT(*) FROM man_passes_mia_summary WHERE man_passes_mia_summary.mia_summary_id = mia_summary.id) AS man_count FROM mia_summary ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){

                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    $sDate = '';
                    $eDate = '';
                    if(!isset($filter['logic'])){
                        if($filter['field']=='date' || $filter['field']=='created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);                             
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'mia_summary`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
//                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                            $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $op1 = ''; $op2 ='';
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
                    if( ($filter['field'] == 'man_count') ){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (mia_summary.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function miaSummaryJoins($mia_summary_id){
        $query = " (SELECT mia_summary.bibliography_id AS id, 'bibliography' AS tb_name FROM mia_summary WHERE mia_summary.id = '$mia_summary_id' AND mia_summary.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT man_passes_mia_summary.man_id AS id, 'man' AS tb_name FROM man_passes_mia_summary WHERE man_passes_mia_summary.mia_summary_id = '$mia_summary_id' )
                  UNION
                  (SELECT organization_passes_mia_summary.organization_id AS id, 'organization' AS tb_name FROM organization_passes_mia_summary WHERE organization_passes_mia_summary.mia_summary_id = '$mia_summary_id') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readWorkActivity($data){
        $query = "SELECT organization_has_man.* , organization.id AS organization, man.id AS man
            FROM organization_has_man
            LEFT JOIN organization ON organization.id = organization_has_man.organization_id
            LEFT JOIN man ON man.id = organization_has_man.man_id
            WHERE (organization_has_man.start_date IS NOT NULL OR organization_has_man.end_date IS NOT NULL OR organization_has_man.title IS NOT NULL)  ";
        $where = '  ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY organization_has_man.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='start_date' || $filter['field']=='end_date'){
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'organization_has_man`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( $filter['field'] == 'man' ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (organization_has_man.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countWorkActivity($data){
        $query = "SELECT organization_has_man.* , organization.id AS organization, man.id AS man
            FROM organization_has_man
            LEFT JOIN organization ON organization.id = organization_has_man.organization_id
            LEFT JOIN man ON man.id = organization_has_man.man_id
            WHERE organization_has_man.start_date IS NOT NULL OR organization_has_man.end_date IS NOT NULL OR organization_has_man.title IS NOT NULL ";
        $where = ' ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='start_date' || $filter['field']=='end_date'){
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'organization_has_man`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( $filter['field'] == 'man' ){

                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (organization_has_man.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function workActivityJoins($work_activity_id){
        $query = " (SELECT organization_has_man.man_id AS id, 'man' AS tb_name FROM organization_has_man WHERE organization_has_man.id = '$work_activity_id'
                        AND (organization_has_man.title IS NOT NULL OR organization_has_man.start_date IS NOT NULL OR organization_has_man.end_date IS NOT NULL OR organization_has_man.period IS NOT NULL) )
                  UNION
                  (SELECT organization_has_man.organization_id AS id, 'organization' AS tb_name FROM organization_has_man WHERE organization_has_man.id = '$work_activity_id'
                        AND (organization_has_man.title IS NOT NULL OR organization_has_man.start_date IS NOT NULL OR organization_has_man.end_date IS NOT NULL OR organization_has_man.period IS NOT NULL) ) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readManBeannCountry($data){
        $query = "SELECT man_bean_country.* , country_ate.name AS country_ate, goal.name AS goal, region.name AS region, locality.name AS locality
            FROM man_bean_country
            LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
            LEFT JOIN goal ON goal.id = man_bean_country.goal_id
            LEFT JOIN region ON region.id = man_bean_country.region_id
            LEFT JOIN locality ON locality.id = man_bean_country.locality_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY man_bean_country.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){

            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='entry_date' || $filter['field']=='exit_date' ){
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'man_bean_country`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( ($filter['field'] == 'country_ate')||($filter['field'] == 'goal')||($filter['field'] == 'region')||($filter['field'] == 'locality') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (man_bean_country.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countManBeannCountry($data){
        $query = "SELECT man_bean_country.* , country_ate.name AS country_ate, goal.name AS goal, region.name AS region, locality.name AS locality
            FROM man_bean_country
            LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
            LEFT JOIN goal ON goal.id = man_bean_country.goal_id
            LEFT JOIN region ON region.id = man_bean_country.region_id
            LEFT JOIN locality ON locality.id = man_bean_country.locality_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){

            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='entry_date' || $filter['field']=='exit_date' ){
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'man_bean_country`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( ($filter['field'] == 'country_ate')||($filter['field'] == 'goal')||($filter['field'] == 'region')||($filter['field'] == 'locality') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (man_bean_country.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function manBeannCountryJoins($man_bean_country_id){
        $query = " (SELECT man_bean_country.man_id AS id, 'man' AS tb_name FROM man_bean_country WHERE man_bean_country.id = '$man_bean_country_id' AND man_bean_country.man_id IS NOT NULL) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readEvent($data){
        $query = "SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS event_qualification
            FROM `event`
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY event.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){

            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate = '';
                $eDate = '';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'date'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'event`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                    }
                }else{
                    $sDate = 'DATE(';
                    $eDate = ')';
                    $op1 = ''; $op2 ='';
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

                if( ($filter['field'] == 'aftermath')||($filter['field'] == 'agency')||($filter['field'] == 'resource')||($filter['field'] == 'event_qualification') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (event.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countEvent($data){
        $query = "SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
            (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
            LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS event_qualification
            FROM `event`
            LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
            LEFT JOIN agency ON agency.id = event.agency_id
            LEFT JOIN resource ON resource.id = event.resource_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){

                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    $sDate = '';
                    $eDate = '';
                    if(!isset($filter['logic'])){
                        if($filter['field'] == 'date'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);                             
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'event`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
//                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                            $dateParse = new DateTime($filter['value']);                             
                            $filter['value'] = $dateParse->format('Y-m-d');
                            $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $op1 = ''; $op2 ='';
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

                    if( ($filter['field'] == 'aftermath')||($filter['field'] == 'agency')||($filter['field'] == 'resource')||($filter['field'] == 'event_qualification') ){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (event.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function eventJoins($event_id){
        $query = " (SELECT event.address_id AS id, 'address' AS tb_name FROM event WHERE event.id = '$event_id' AND event.address_id IS NOT NULL)
                  UNION
                  (SELECT event_has_organization.organization_id AS id, 'organization' AS tb_name FROM event_has_organization WHERE event_has_organization.event_id = '$event_id')
                  UNION
                  (SELECT event.organization_id AS id, 'organization' AS tb_name FROM event WHERE event.id = '$event_id' AND event.organization_id IS NOT NULL)
                  UNION
                  (SELECT event_has_man.man_id AS id, 'man' AS tb_name FROM event_has_man WHERE event_has_man.event_id = '$event_id')
                  UNION
                  (SELECT event_has_car.car_id AS id, 'car' AS tb_name FROM event_has_car WHERE event_has_car.event_id = '$event_id')
                  UNION
                  (SELECT event_has_weapon.weapon_id AS id, 'weapon' AS tb_name FROM event_has_weapon WHERE event_has_weapon.event_id = '$event_id')
                  UNION
                  (SELECT event_passes_signal.signal_id AS id, 'signal' AS tb_name FROM event_passes_signal WHERE event_passes_signal.event_id = '$event_id')
                  UNION
                  (SELECT event_has_action.action_id AS id, 'action' AS tb_name FROM event_has_action WHERE event_has_action.event_id = '$event_id')
                  UNION
                  (SELECT action_has_event.action_id AS id, 'action' AS tb_name FROM action_has_event WHERE action_has_event.event_id = '$event_id')
                  UNION
                  (SELECT event.bibliography_id AS id, 'bibliography' AS tb_name FROM event WHERE event.id = '$event_id' AND event.bibliography_id IS NOT NULL)
                  UNION
                  (SELECT criminal_case_id AS id, 'criminal_case' AS tb_name FROM event_has_criminal_case WHERE event_id = '$event_id' ) ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readOrganization($data){
        $query = " SELECT organization.*,organization.name as org_name , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, organization_has_bibliography.bibliography_id AS bibliography_id
            FROM organization
            LEFT JOIN organization_has_bibliography ON organization_has_bibliography.organization_id = organization.id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY organization.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate = '';
                $eDate = '';
                if(!isset($filter['logic'])){
                    if($filter['field']=='reg_date' || $filter['field']=='created_at'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'organization`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                        $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                    }
                }else{
                    $sDate = 'DATE(';
                    $eDate = ')';
                    $op1 = ''; $op2 ='';
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

                if( ($filter['field'] == 'country')||($filter['field'] == 'category')||($filter['field'] == 'country_ate')||($filter['field'] == 'org_name')||($filter['field'] == 'bibliography_id') ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (organization.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countOrganization($data){
        $query = " SELECT organization.*,organization.name as org_name , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, organization_has_bibliography.bibliography_id AS bibliography_id
            FROM organization
            LEFT JOIN organization_has_bibliography ON organization_has_bibliography.organization_id = organization.id
            LEFT JOIN country ON country.id = organization.country_id
            LEFT JOIN organization_category ON organization_category.id = organization.category_id
            LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    $sDate = '';
                    $eDate = '';
                    if(!isset($filter['logic'])){
                        if($filter['field']=='reg_date' || $filter['field']=='created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);                             
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'organization`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
//                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                            $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $op1 = ''; $op2 ='';
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

                    if( ($filter['field'] == 'country')||($filter['field'] == 'org_name')||($filter['field'] == 'category')||($filter['field'] == 'country_ate')||($filter['field'] == 'bibliography_id') ){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (organization.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function organizationJoins($organization_id){
        $query = " (SELECT organization_has_address.address_id AS id, 'address' AS tb_name FROM organization_has_address WHERE organization_has_address.organization_id = '$organization_id')
                  UNION
                  (SELECT organization.address_id AS id, 'address' AS tb_name FROM organization WHERE organization.id = '$organization_id' AND organization.address_id IS NOT NULL)
                  UNION
                  (SELECT organization_id1 AS id, 'organization' AS tb_name FROM organization_to_organization WHERE organization_id2 = '$organization_id')
                  UNION
                  (SELECT organization_id2 AS id, 'organization' AS tb_name FROM organization_to_organization WHERE organization_id1 = '$organization_id')
                  UNION
                  (SELECT organization_has_phone.phone_id AS id, 'phone' AS tb_name FROM organization_has_phone WHERE organization_has_phone.organization_id = '$organization_id')
                  UNION
                  (SELECT event_has_organization.event_id AS id, 'event' AS tb_name FROM event_has_organization WHERE event_has_organization.organization_id = '$organization_id')
                  UNION
                  (SELECT event.id AS id, 'event' AS tb_name FROM event WHERE event.organization_id = '$organization_id')
                  UNION
                  (SELECT criminal_case_has_organization.criminal_case_id AS id, 'criminal_case' AS tb_name FROM criminal_case_has_organization WHERE criminal_case_has_organization.organization_id = '$organization_id')
                  UNION
                  (SELECT action_has_organization.action_id AS id, 'action' AS tb_name FROM action_has_organization WHERE action_has_organization.organization_id = '$organization_id')
                  UNION
                  (SELECT organization_has_man.id AS id, 'organization_has_man' AS tb_name FROM organization_has_man WHERE organization_has_man.organization_id = '$organization_id'
                           AND (organization_has_man.title IS NOT NULL OR organization_has_man.start_date IS NOT NULL OR organization_has_man.end_date IS NOT NULL OR organization_has_man.period IS NOT NULL) )
                  UNION
                  (SELECT organization_checked_by_signal.signal_id AS id, 'signal' AS tb_name FROM organization_checked_by_signal WHERE organization_checked_by_signal.organization_id = '$organization_id')
                  UNION
                  (SELECT organization_passes_by_signal.signal_id AS id, 'signal' AS tb_name FROM organization_passes_by_signal WHERE organization_passes_by_signal.organization_id = '$organization_id')
                  UNION
                  (SELECT organization_has_bibliography.bibliography_id AS id, 'bibliography' AS tb_name FROM organization_has_bibliography WHERE organization_has_bibliography.organization_id = '$organization_id')
                  UNION
                  (SELECT organization_has_car.car_id AS id, 'car' AS tb_name FROM organization_has_car WHERE organization_has_car.organization_id = '$organization_id')
                  UNION
                  (SELECT organization_has_weapon.weapon_id AS id, 'weapon' AS tb_name FROM organization_has_weapon WHERE organization_has_weapon.organization_id = '$organization_id')
                  UNION
                  (SELECT organization_passes_mia_summary.mia_summary_id AS id, 'mia_summary' AS tb_name FROM organization_passes_mia_summary WHERE organization_passes_mia_summary.organization_id = '$organization_id')
                  UNION
                  (SELECT objects_relation.first_object_id AS id, objects_relation.first_object_type AS tb_name FROM objects_relation WHERE objects_relation.second_obejct_type = 'organization' AND objects_relation.second_object_id = '$organization_id')
                  UNION
                  (SELECT objects_relation.second_object_id AS id, objects_relation.second_obejct_type AS tb_name FROM objects_relation WHERE objects_relation.first_object_type = 'organization' AND objects_relation.first_object_id = '$organization_id')";

        $this->_setSql($query);
        return $this->getAll();
    }

    public function readObjectsRelation($data){
        $query = "SELECT objects_relation.*, relation_type.name AS relation_type
            FROM objects_relation
            LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY objects_relation.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate = '';
                $eDate = '';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'created_at'){
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'objects_relation`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                    }
                }else{
                    $sDate = 'DATE(';
                    $eDate = ')';
                    $op1 = ''; $op2 ='';
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

                if( $filter['field'] == 'relation_type' ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (objects_relation.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countObjectsRelation($data){
        $query = "SELECT objects_relation.*, relation_type.name AS relation_type
            FROM objects_relation
            LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
                $filters = $data['filter']['filters'];
//            var_dump($filters);die;
                foreach($filters as $filter){
                    $conditions = '';
                    $sDate = '';
                    $eDate = '';
                    if(!isset($filter['logic'])){
                        if($filter['field'] == 'created_at'){
                            $sDate = 'DATE(';
                            $eDate = ')';
                            $dateParse = new DateTime($filter['value']);                             
                            $filter['value'] = $dateParse->format('Y-m-d');
                        }elseif($filter['field'] == 'id'){
                            $filter['field'] = 'objects_relation`.`id';
                        }
                        if($filter['operator'] == 'eq'){
                            if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                                $conditions = " AND `".$filter['field']."` IS NULL ";
                            }else{
                                $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                            }
//                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
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
                            $dateParse = new DateTime($filter['value']);                             
                            $filter['value'] = $dateParse->format('Y-m-d');
                            $conditions = " AND $sDate`".$filter['field']."`$eDate $op1 '".$filter['value']."' ";
                        }
                    }else{
                        $sDate = 'DATE(';
                        $eDate = ')';
                        $op1 = ''; $op2 ='';
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

                    if( $filter['field'] == 'relation_type' ){
                        $having .= $conditions;
                    }else{
                        $where .= $conditions;
                    }
                }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (objects_relation.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function objectsRelationJoins($objects_relation_id){
        $query = " (SELECT objects_relation.first_object_id AS id, objects_relation.first_object_type AS tb_name FROM objects_relation WHERE objects_relation.id = '$objects_relation_id')
                  UNION
                  (SELECT objects_relation.second_object_id AS id, objects_relation.second_obejct_type AS tb_name FROM objects_relation WHERE objects_relation.id = '$objects_relation_id')
                   ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readPhone($data){
        $query = "SELECT phone.* , `character`.name as `character` FROM phone
                  LEFT JOIN organization_has_phone ON organization_has_phone.phone_id = phone.id
                  LEFT JOIN man_has_phone ON man_has_phone.phone_id = phone.id
                  LEFT JOIN `character` ON `character`.id = organization_has_phone.character_id OR `character`.id = man_has_phone.character_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY phone.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'id'){
                        $filter['field'] = 'phone`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }
                if($filter['field'] == 'character'){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (phone.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countPhone($data){
        $query = "SELECT phone.* , `character`.name as `character` FROM phone
                  LEFT JOIN organization_has_phone ON organization_has_phone.phone_id = phone.id
                  LEFT JOIN man_has_phone ON man_has_phone.phone_id = phone.id
                  LEFT JOIN `character` ON `character`.id = organization_has_phone.character_id OR `character`.id = man_has_phone.character_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'id'){
                        $filter['field'] = 'phone`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }
                if($filter['field'] == 'character'){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (phone.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function phoneJoins($phone_id){
        $query = " (SELECT man_has_phone.man_id AS id, 'man' AS tb_name FROM man_has_phone WHERE man_has_phone.phone_id = '$phone_id' )
                  UNION
                  (SELECT organization_has_phone.organization_id AS id, 'organization' AS tb_name FROM organization_has_phone WHERE organization_has_phone.phone_id = '$phone_id')
                  UNION
                  (SELECT action_has_phone.action_id AS id, 'action' AS tb_name FROM action_has_phone WHERE action_has_phone.phone_id = '$phone_id') ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readEmail($data){
        $query = " SELECT email.* FROM email ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY email.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'id'){
                        $filter['field'] = 'email`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }
                $where .= $conditions;
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (email.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countEmail($data){
        $query = " SELECT email.* FROM email ";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field'] == 'id'){
                        $filter['field'] = 'email`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }
                $where .= $conditions;
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (email.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function emailJoins($email_id){
        $query = " (SELECT man_has_email.man_id AS id, 'man' AS tb_name FROM man_has_email WHERE man_has_email.email_id = '$email_id' )
                  UNION
                  (SELECT organization_has_email.organization_id AS id, 'organization' AS tb_name FROM organization_has_email WHERE organization_has_email.email_id = '$email_id')";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readExternalSigns($data){
        $query = " SELECT man_external_sign_has_sign.* , sign.name AS `name` FROM  man_external_sign_has_sign
                   LEFT JOIN sign ON sign.id = sign_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['sort'])){
            $order = "ORDER BY {$data['sort'][0]['field']} {$data['sort'][0]['dir']} ";
        }else{
            $order = "ORDER BY man_external_sign_has_sign.id desc";
        }
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='fixed_date'){
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'man_external_sign_has_sign`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( $filter['field'] == 'name' ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (man_external_sign_has_sign.id) ".$having."  ".$order." LIMIT {$data['take']} OFFSET {$data['skip']}";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function countExternalSigns($data){
        $query = " SELECT man_external_sign_has_sign.* , sign.name AS `name` FROM  man_external_sign_has_sign
                   LEFT JOIN sign ON sign.id = sign_id";
        $where = ' WHERE 1=1 ';
        $having = ' HAVING 1=1 ';
        if(isset($data['filter'])){
            if(!empty($data['filter'])){
            $filters = $data['filter']['filters'];
//            var_dump($filters);die;
            foreach($filters as $filter){
                $conditions = '';
                $sDate='';
                $eDate='';
                if(!isset($filter['logic'])){
                    if($filter['field']=='fixed_date'){
                        $dateParse = new DateTime($filter['value']);                             
                        $filter['value'] = $dateParse->format('Y-m-d');
                    }elseif($filter['field'] == 'id'){
                        $filter['field'] = 'man_external_sign_has_sign`.`id';
                    }
                    if($filter['operator'] == 'eq'){
                        if($filter['value'] == ' ' || $filter['value'] == '1970-01-01'){
                            $conditions = " AND `".$filter['field']."` IS NULL ";
                        }else{
                            $conditions = " AND $sDate`".$filter['field']."`$eDate = '".$filter['value']."' ";
                        }
//                        $conditions = " AND `".$filter['field']."` = '".$filter['value']."' ";
                    }elseif($filter['operator'] == 'neq'){
                        $conditions = " AND `".$filter['field']."` != '".$filter['value']."' ";
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
                        $conditions = " AND `".$filter['field']."` $op1 '".$filter['value']."' ";
                    }
                }else{
                    $op1 = ''; $op2 ='';
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
                        $conditions = " AND (`".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ".strtoupper($filter['logic'])."   `".$filter['filters'][1]['field']."` $op2 '".$filter['filters'][1]['value']."') ";
                    }else{
                        $dateParse = new DateTime($filter['filters'][0]['value']);
                        $filter['filters'][0]['value'] = $dateParse->format('Y-m-d');
                        $conditions = " AND `".$filter['filters'][0]['field']."` $op1 '".$filter['filters'][0]['value']."' ";
                    }
                    $filter['field'] = $filter['filters'][0]['field'];
                }

                if( $filter['field'] == 'name' ){
                    $having .= $conditions;
                }else{
                    $where .= $conditions;
                }
            }
            }
        }
        $query .= $where;
        $query .= " GROUP BY (man_external_sign_has_sign.id) ".$having;
//        echo $query;
        $this->_setSql($query);
        $count = count($this->getAll());
        return $count;
    }

    public function externalSignsJoins($sign_id){
        $query = " (SELECT man_external_sign_has_sign.man_id AS id, 'man' AS tb_name FROM man_external_sign_has_sign WHERE man_external_sign_has_sign.id = '$sign_id' ) ";
        $this->_setSql($query);
        return $this->getAll();
    }

}