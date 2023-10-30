<?php

namespace App\Models\ModelInclude;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\FullTextSearch;

class SimplesearchModel extends Model
{
    private const DISTANCE = 3;

    use HasFactory,FullTextSearch;


    function searchLocation($field, ?string $id_type, ?string $type, string $table_col): string
    {
        $query ='';
        $first = $field[0];
                if (strlen(trim($first)) != 0) {

                    if($id_type == 'NOT' || $type == 'NOT'){

                        $qq = " AND ( ($table_col != '{$first}' ) ";
                    }else{

                        $qq = " AND ( ($table_col = '{$first}' ) ";
                        if (!empty($id_type)) {
                            $op = $id_type;
                        } elseif (!empty($type)) {
                            $op = $type;
                        } else {
                            $op = 'OR';
                        }
                    }
                    unset($field[0]);
                    if (!empty($field)) {

                        if($id_type == 'NOT' || $type == 'NOT'){

                            foreach ($field as $val) {
                                $qq .= " AND ( $table_col != '$val' ) ";
                            }
                        }else{

                            foreach ($field as $val) {
                                $qq .= " $op ( $table_col = '$val' ) ";
                            }
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }

                return $query;
    }

    function searchFieldDataId($field,?string $type,string $table_col): string
    {
        $query = '';
        $first = $field[0];
        if (strlen(trim($first)) != 0) {

            if ($type != 'NOT') {

                $qq = " AND ( ($table_col = '{$first}' ) ";
                $op = $type;
            }else{
                $qq = " AND ( ($table_col != '{$first}' ) ";
                $op = 'AND';
            }
            unset($field[0]);
            if (!empty($field)) {
                if ($type != 'NOT') {

                    foreach ($field as $val) {
                        $qq .= " $op ( $table_col = '$val' ) ";
                    }
                }else{
                    foreach ($field as $val) {
                        $qq .= " $op ( $table_col != '$val' ) ";
                    }
                }

            }
            $qq .= " ) ";
            $query .= $qq;
        }

        return $query;
    }

    function fieldId($field,?string $type,string $table_col,string $other_cols): string
    {
        $query = '';
        if(isset($field)){
            $field = array_filter($field);
            if(!empty($field) && $type =='NOT' )
            {
                $query .= " AND $table_col NOT IN (".implode(',',$field).")";
            }

            if(!empty($field) && $type !='NOT'){
                $qq = " AND $table_col IN (".implode(',',$field).") ";
                $query .= $qq;
                if(isset($type)){
                    if($type == 'AND' && count($field)>1){
                        $query .= " AND $other_cols = 0 ";
                    }
                }
            }
        }

        return $query;
    }

    function searchFieldString($field,?string $type,string $table_col,array $other_cols = []): string
    {
        $query = '';
        $field = array_filter($field);

                if(!empty($field) ){
                        $first = $field[0];
                        $first = trim($first);
                        $first = str_replace('*','%',$first);
                        $first = str_replace('?','_',$first);
                        if ($type !='NOT') {

                            $qq = " AND ( ( $table_col LIKE '{$first}') ";

                        }else{

                            $qq = " AND ( ( $table_col NOT LIKE '{$first}') ";
                        }

                        unset($field[0]);
                    if(!empty($field)){
                        $op = $type;
                        if ($op != 'NOT') {
                            foreach($field as $val){
                                $val = trim($val);
                                $val = str_replace('*','%',$val);
                                $val = str_replace('?','_',$val);
                                $qq .= " $op ( $table_col LIKE '{$val}') ";
                            }
                        }else{

                            foreach($field as $val){
                                $val = trim($val);
                                $val = str_replace('*','%',$val);
                                $val = str_replace('?','_',$val);
                                $qq .= " AND ( $table_col NOT LIKE '{$val}') ";
                            }
                        }

                    }

                    $qq .= " ) ";
                    $query .= $qq;

                }

                return $query;
    }

        public function searchControl($data, $files_flag = false, $files = null){

            $query = " SELECT control.* , unit.name AS unit, act_unit.name AS act_unit, sub_act_unit.name AS sub_act_unit, doc_category.name AS doc_category, control_result.name AS result
                FROM control
                LEFT JOIN agency AS unit ON unit.id = control.unit_id
                LEFT JOIN agency AS act_unit ON act_unit.id = control.act_unit_id
                LEFT JOIN agency AS sub_act_unit ON sub_act_unit.id = control.sub_act_unit_id
                LEFT JOIN doc_category ON doc_category.id = control.doc_category_id
                LEFT JOIN control_result ON control_result.id = control.result_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = control.bibliography_id
                WHERE 1=1 ";

            if(isset($data['unit_id'])){

                $q = $this->fieldId(
                    $data['unit_id'],
                    $data['unit_id_type'],
                    '`unit_id`',
                    '`control`.id'
                );
                $query .= $q;

                // $data['unit_id'] = array_filter($data['unit_id']);

                // if(!empty($data['unit_id']) && $data['unit_id_type'] =='NOT' )
                // {
                //    $query .= " AND unit_id NOT IN (".implode(',',$data['unit_id']).")";
                // }

                // if(!empty($data['unit_id']) && $data['unit_id_type'] !='NOT'){
                //     $qq = " AND unit_id IN (".implode(',',$data['unit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['unit_id_type'])){
                //         if($data['unit_id_type'] == 'AND' && count($data['unit_id'])>1){
                //             $query .= " AND control.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['doc_category_id'])){

                $q = $this->fieldId(
                    $data['doc_category_id'],
                    $data['doc_category_id_type'],
                    '`doc_category_id`',
                    '`control`.id'
                );
                $query .= $q;

                // $data['doc_category_id'] = array_filter($data['doc_category_id']);

                // if(!empty($data['doc_category_id']) && $data['doc_category_id_type'] =='NOT' )
                // {
                //    $query .= " AND doc_category_id NOT IN (".implode(',',$data['doc_category_id']).")";
                // }

                // if(!empty($data['doc_category_id']) && $data['doc_category_id_type'] !='NOT'){
                //     $qq = " AND doc_category_id IN (".implode(',',$data['doc_category_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['doc_category_id_type'])){
                //         if($data['doc_category_id_type'] == 'AND' && count($data['doc_category_id'])>1){
                //             $query .= " AND control.id = 0 ";
                //         }
                //     }
                // }
            }

            if(strlen(trim($data['creation_date'])) != 0){
                $data['creation_date'] = trim($data['creation_date']);
                $aa = explode('-',$data['creation_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['creation_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(creation_date) = '{$data['creation_date']}' ";
            }

            if(isset($data['reg_num'])){

                $q = $this->searchFieldString($data['reg_num'], $data['reg_num_type'], '`reg_num`');
                $query .= $q;

                // $data['reg_num'] = array_filter($data['reg_num']);
                // if(!empty($data['reg_num'])){
                //     $first = $data['reg_num'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( reg_num LIKE '$first' ) ";
                //     unset($data['reg_num'][0]);
                //     if(!empty($data['reg_num'])){
                //         $op = $data['reg_num_type'];
                //         foreach($data['reg_num'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( reg_num LIKE '{$val}' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }

            if(strlen(trim($data['reg_date'])) != 0){
                $data['reg_date'] = trim($data['reg_date']);
                $aa = explode('-',$data['reg_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['reg_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(reg_date) = '{$data['reg_date']}' ";
            }

            if(isset($data['snb_director'])){

                $q = $this->searchFieldString($data['snb_director'], $data['snb_director_type'], '`snb_director`');
                $query .= $q;

                // $data['snb_director'] = array_filter($data['snb_director']);
                // if(!empty($data['snb_director'])){
                //     $first = $data['snb_director'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( snb_director LIKE '{$first}' ) ";
                //     unset($data['snb_director'][0]);
                //     if(!empty($data['snb_director'])){
                //         $op = $data['snb_director_type'];
                //         foreach($data['snb_director'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( snb_director LIKE '{$val}' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['snb_subdirector'])){

                $q = $this->searchFieldString($data['snb_subdirector'], $data['snb_subdirector_type'], '`snb_subdirector`');
                $query .= $q;

                // $data['snb_subdirector'] = array_filter($data['snb_subdirector']);
                // if(!empty($data['snb_subdirector'])){
                //     $first = $data['snb_subdirector'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( snb_subdirector LIKE '{$first}' ) ";
                //     unset($data['snb_subdirector'][0]);
                //     if(!empty($data['snb_subdirector'])){
                //         $op = $data['snb_subdirector_type'];
                //         foreach($data['snb_subdirector'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( snb_subdirector LIKE '{$val}' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['resolution'])){

                $q = $this->searchFieldString($data['resolution'], $data['resolution_type'], '`resolution`');
                $query .= $q;

                // $data['resolution'] = array_filter($data['resolution']);
                // if(!empty($data['resolution'])){
                //     $first = $data['resolution'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( resolution LIKE '{$first}' ) ";
                //     unset($data['resolution'][0]);
                //     if(!empty($data['resolution'])){
                //         $op = $data['resolution_type'];
                //         foreach($data['resolution'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( resolution LIKE '{$val}' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(strlen(trim($data['resolution_date'])) != 0){
                $data['resolution_date'] = trim($data['resolution_date']);
                $aa = explode('-',$data['resolution_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['resolution_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(resolution_date) = '{$data['resolution_date']}' ";
            }

            if(isset($data['act_unit_id'])){

                $q = $this->fieldId(
                    $data['act_unit_id'],
                    $data['act_unit_id_type'],
                    '`act_unit_id`',
                    '`control`.id'
                );
                $query .= $q;

                // $data['act_unit_id'] = array_filter($data['act_unit_id']);
                // if(!empty($data['act_unit_id'])){
                //     $qq = " AND act_unit_id IN (".implode(',',$data['act_unit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['act_unit_id_type'])){
                //         if($data['act_unit_id_type'] == 'AND' && count($data['act_unit_id'])>1){
                //             $query .= " AND control.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['actor_name'])){

                $q = $this->searchFieldString($data['actor_name'], $data['actor_name_type'], '`actor_name`');
                $query .= $q;

                // $data['actor_name'] = array_filter($data['actor_name']);
                // if(!empty($data['actor_name'])){
                //     $first = $data['actor_name'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( actor_name LIKE '{$first}' ) ";
                //     unset($data['actor_name'][0]);
                //     if(!empty($data['actor_name'])){
                //         $op = $data['actor_name_type'];
                //         foreach($data['actor_name'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( actor_name LIKE '{$val}' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['sub_act_unit_id'])){

                $q = $this->fieldId(
                    $data['sub_act_unit_id'],
                    $data['sub_act_unit_id_type'],
                    '`sub_act_unit_id`',
                    '`control`.id'
                );
                $query .= $q;

                // $data['sub_act_unit_id'] = array_filter($data['sub_act_unit_id']);

                // if(!empty($data['sub_act_unit_id']) && $data['sub_act_unit_id_type'] =='NOT' )
                // {
                //    $query .= " AND sub_act_unit_id NOT IN (".implode(',',$data['sub_act_unit_id']).")";
                // }

                // if(!empty($data['sub_act_unit_id']) && $data['sub_act_unit_id_type'] !='NOT'){
                //     $qq = " AND sub_act_unit_id IN (".implode(',',$data['sub_act_unit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['sub_act_unit_id_type'])){
                //         if($data['sub_act_unit_id_type'] == 'AND' && count($data['sub_act_unit_id'])>1){
                //             $query .= " AND control.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['sub_actor_name'])){

                $q = $this->searchFieldString($data['sub_actor_name'], $data['sub_actor_name_type'], '`sub_actor_name`');
                $query .= $q;

                // $data['sub_actor_name'] = array_filter($data['sub_actor_name']);
                // if(!empty($data['sub_actor_name'])){
                //     $first = $data['sub_actor_name'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( sub_actor_name LIKE '{$first}' ) ";
                //     unset($data['sub_actor_name'][0]);
                //     if(!empty($data['sub_actor_name'])){
                //         $op = $data['sub_actor_name_type'];
                //         foreach($data['sub_actor_name'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( sub_actor_name LIKE '{$val}' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['result_id'])){

                $q = $this->fieldId(
                    $data['result_id'],
                    $data['result_id_type'],
                    '`result_id`',
                    '`control`.id'
                );
                $query .= $q;

                // $data['result_id'] = array_filter($data['result_id']);

                // if(!empty($data['result_id']) && $data['result_id_type'] =='NOT' )
                // {
                //    $query .= " AND result_id NOT IN (".implode(',',$data['result_id']).")";
                // }

                // if(!empty($data['result_id']) && $data['result_id_type'] !='NOT'){
                //     $qq = " AND result_id IN (".implode(',',$data['result_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['result_id_type'])){
                //         if($data['result_id_type'] == 'AND' && count($data['result_id'])>1){
                //             $query .= " AND control.id = 0 ";
                //         }
                //     }
                // }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(control.id)';
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchAction($data, $files_flag = false, $files = null){

            $query = " SELECT `action`.* , duration.name AS duration, action_goal.name AS action_goal, terms.name AS terms, aftermath.name AS aftermath,
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
                LEFT JOIN action_has_qualification ON action_has_qualification.action_id = `action`.id
                LEFT JOIN action_qualification ON action_has_qualification.qualification_id = action_qualification.id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = `action`.bibliography_id
                WHERE 1=1 ";

            $queryHaving = " HAVING 1=1 ";

            if(isset($data['material_content'])){

                $q = $this->searchFieldString($data['material_content'], $data['material_content_type'], '`material_content`.content');
                $query .= $q;

                // $data['material_content'] = array_filter($data['material_content']);

                // if(!empty($data['material_content'])){
                //     $first = $data['material_content'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( material_content.content LIKE '{$first}' ) ";
                //     unset($data['material_content'][0]);
                //     if(!empty($data['material_content'])){
                //         $op = $data['material_content_type'];
                //         foreach($data['material_content'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( material_content.content LIKE '{$val}' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['action_qualification_id'])){

                $data['action_qualification_id'] = array_filter($data['action_qualification_id']);

                if(!empty($data['action_qualification_id']) && $data['action_qualification_id_type'] =='NOT' )
                {
                   $query .= " AND action_qualification_id NOT IN (".implode(',',$data['action_qualification_id']).")";
                }

                if(!empty($data['action_qualification_id']) && $data['action_qualification_id_type'] !='NOT'){
                    $qq = " AND action_has_qualification.qualification_id IN (".implode(',',$data['action_qualification_id']).") ";
                    $query .= $qq;
                    if(isset($data['action_qualification_id_type'])){
                        if($data['action_qualification_id_type'] == 'AND' && count($data['action_qualification_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT action_has_qualification.qualification_id) >= '".count($data['action_qualification_id'])."' ";
                        }
                    }
                }

            }

            if(strlen(trim($data['start_date'])) != 0){
                $data['start_date'] = trim($data['start_date']);
                $aa = explode('-',$data['start_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['start_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(start_date) = '{$data['start_date']}' ";
            }

            if(strlen(trim($data['end_date'])) != 0){
                $data['end_date'] = trim($data['end_date']);
                $aa = explode('-',$data['end_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['end_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(end_date) = '{$data['end_date']}' ";
            }

            if(isset($data['duration_id'])){

                $q = $this->fieldId(
                    $data['duration_id'],
                    $data['duration_id_type'],
                    '`duration_id`',
                    '`action`.id'
                );
                $query .= $q;

                // $data['duration_id'] = array_filter($data['duration_id']);

                // if(!empty($data['duration_id']) && $data['duration_id_type'] =='NOT' )
                // {
                //    $query .= " AND duration_id NOT IN (".implode(',',$data['duration_id']).")";
                // }

                // if(!empty($data['duration_id']) && $data['duration_id_type'] !='NOT'){
                //     $qq = " AND duration_id IN (".implode(',',$data['duration_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['duration_id_type'])){
                //         if($data['duration_id_type'] == 'AND' && count($data['duration_id'])>1){
                //             $query .= " AND `action`.id = 0 ";
                //         }
                //     }
                // }

            }

            if(isset($data['goal_id'])){

                $q = $this->fieldId(
                    $data['goal_id'],
                    $data['goal_id_type'],
                    '`goal_id`',
                    '`action`.id'
                );
                $query .= $q;


                // $data['goal_id'] = array_filter($data['goal_id']);

                // if(!empty($data['goal_id']) && $data['goal_id_type'] =='NOT' )
                // {
                //    $query .= " AND goal_id NOT IN (".implode(',',$data['goal_id']).")";
                // }

                // if(!empty($data['goal_id']) && $data['goal_id_type'] =='NOT'){
                //     $qq = " AND goal_id IN (".implode(',',$data['goal_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['goal_id_type'])){
                //         if($data['goal_id_type'] == 'AND' && count($data['goal_id'])>1){
                //             $query .= " AND `action`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['terms_id'])){

                $q = $this->fieldId(
                    $data['terms_id'],
                    $data['terms_id_type'],
                    '`terms_id`',
                    '`action`.id'
                );
                $query .= $q;

                // $data['terms_id'] = array_filter($data['terms_id']);

                // if(!empty($data['terms_id']) && $data['terms_id_type'] =='NOT' )
                // {
                //    $query .= " AND terms_id NOT IN (".implode(',',$data['terms_id']).")";
                // }

                // if(!empty($data['terms_id']) && $data['terms_id_type'] !='NOT'){
                //     $qq = " AND terms_id IN (".implode(',',$data['terms_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['terms_id_type'])){
                //         if($data['terms_id_type'] == 'AND' && count($data['terms_id'])>1){
                //             $query .= " AND `action`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['aftermath_id'])){

                $q = $this->fieldId(
                    $data['aftermath_id'],
                    $data['aftermath_id_type'],
                    '`aftermath_id`',
                    '`action`.id'
                );
                $query .= $q;

                // $data['aftermath_id'] = array_filter($data['aftermath_id']);

                // if(!empty($data['aftermath_id']) && $data['aftermath_id_type'] =='NOT' )
                // {
                //    $query .= " AND aftermath_id NOT IN (".implode(',',$data['aftermath_id']).")";
                // }

                // if(!empty($data['aftermath_id']) && $data['aftermath_id_type'] !='NOT'){
                //     $qq = " AND aftermath_id IN (".implode(',',$data['aftermath_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['aftermath_id_type'])){
                //         if($data['aftermath_id_type'] == 'AND' && count($data['aftermath_id'])>1){
                //             $query .= " AND `action`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['source'])){

                $q = $this->searchFieldString($data['source'], $data['source_type'], '`source`');
                $query .= $q;

                // $data['source'] = array_filter($data['source']);

                // if(!empty($data['source'])){
                //     $first = $data['source'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( source LIKE '{$first}' ) ";
                //     unset($data['source'][0]);
                //     if(!empty($data['source'])){
                //         $op = $data['source_type'];
                //         foreach($data['source'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( source LIKE '{$val}' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['opened_dou'])){

                $q = $this->searchFieldString($data['opened_dou'], $data['opened_dou_type'], '`opened_dou`');
                $query .= $q;
                // $data['opened_dou'] = array_filter($data['opened_dou']);

                // if(!empty($data['opened_dou'])){
                //     $first = $data['opened_dou'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( opened_dou LIKE '{$first}' ) ";
                //     unset($data['opened_dou'][0]);
                //     if(!empty($data['opened_dou'])){
                //         $op = $data['opened_dou_type'];
                //         foreach($data['opened_dou'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( opened_dou LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }
            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }
            $query .= '  GROUP BY(action.id) ';
            $query .= $queryHaving;
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchMan($data, $files_flag = false, $files = null){

            $query = " SELECT man.*, gender.name AS gender , nation.name AS nation , religion.name AS religion , resource.name AS resource ,
                                      locality.name AS locality , region.name AS region , country_ate.name AS country_ate,
                                      SUBSTR(birthday,1,4) AS birthday_y,SUBSTR(birthday,6,2) AS birthday_m,SUBSTR(birthday,9,2) AS birthday_d,
                                      (SELECT COUNT(*) FROM man_external_sign_has_photo WHERE man_external_sign_has_photo.man_id = man.id) AS photo_count,
                                      (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
                                      LEFT JOIN first_name ON man_has_first_name.first_name_id = first_name.id WHERE man_has_first_name.man_id = man.id
                                       GROUP BY man_id ) AS first_name ,
                                      (SELECT GROUP_CONCAT(last_name.last_name) FROM man_has_last_name
                                      LEFT JOIN last_name ON man_has_last_name.last_name_id = last_name.id WHERE man_has_last_name.man_id = man.id
                                       GROUP BY man_id) AS last_name ,
                                      (SELECT GROUP_CONCAT(middle_name.middle_name) FROM man_has_middle_name
                                      LEFT JOIN middle_name ON man_has_middle_name.middle_name_id = middle_name.id WHERE man_has_middle_name.man_id = man.id
                                      GROUP BY man_id) AS middle_name ,
                                      CONCAT(last_name,first_name,middle_name) AS auto_name,
                                      (SELECT GROUP_CONCAT(passport.number) FROM man_has_passport
                                      LEFT JOIN passport ON man_has_passport.passport_id = passport.id WHERE man_has_passport.man_id = man.id
                                       GROUP BY man_id) AS passport,
                                      (SELECT GROUP_CONCAT(country.name) FROM man_belongs_country
                                      LEFT JOIN country ON man_belongs_country.country_id = country.id WHERE man_belongs_country.man_id = man.id
                                       GROUP BY man_id) AS country ,
                                       (SELECT GROUP_CONCAT(country.name) FROM country_search_man
                                      LEFT JOIN country ON country_search_man.country_id = country.id WHERE country_search_man.man_id = man.id
                                       GROUP BY man_id) AS country_search ,
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
                                       (SELECT GROUP_CONCAT(LEFT(more_data_man.text,10)) FROM
                                            more_data_man WHERE more_data_man.man_id = man.id
                                       GROUP BY man_id) AS more_data,
                                       (SELECT GROUP_CONCAT(LEFT(answer.text,10)) FROM
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
                      LEFT JOIN country_search_man ON country_search_man.man_id = man.id

                      LEFT JOIN man_has_nickname ON man_has_nickname.man_id = man.id
                      LEFT JOIN nickname ON nickname.id = man_has_nickname.nickname_id

                      LEFT JOIN man_has_operation_category ON man_has_operation_category.man_id = man.id
                      LEFT JOIN operation_category ON operation_category.id = man_has_operation_category.operation_category_id

                      LEFT JOIN more_data_man ON more_data_man.man_id = man.id
                      LEFT JOIN answer ON answer.man_id = man.id

                      LEFT JOIN address AS born_address ON born_address.id = man.born_address_id
                      LEFT JOIN region ON born_address.region_id = region.id
                      LEFT JOIN country_ate ON born_address.country_ate_id = country_ate.id
                      LEFT JOIN locality ON born_address.locality_id = locality.id

                      LEFT JOIN gender ON gender.id = man.gender_id
                      LEFT JOIN nation ON nation.id = man.nation_id
                      LEFT JOIN religion ON religion.id = man.religion_id
                      LEFT JOIN resource ON resource.id = man.resource_id
                      LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man.id
                      LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = man_has_bibliography.bibliography_id
                      WHERE 1=1 ";

            $queryHaving = " HAVING 1=1 ";

            if(isset($data['first_name'])){

               if (isset($data['first_name_type']) || strpos($data['first_name'][0], '*') !== false || strpos($data['first_name'][0], '?') !== false) {

                    $data['first_name'] = array_filter($data['first_name']);
                    if(!empty($data['first_name'])){
                        $first = $data['first_name'][0];
                        $first = trim($first);
                        $first = str_replace('*','%',$first);
                        $first = str_replace('?','_',$first);

                        ($data['first_name_type'] == 'NOT' ) ? $q = 'NOT' : $q = ''; //add variable $q

                        $qq = " AND $q ( ( first_name.first_name LIKE '{$first}' ) ";

                        unset($data['first_name'][0]);
                        if(!empty($data['first_name'])){
                            $op = $data['first_name_type'];
                            foreach($data['first_name'] as $val){
                                $val = trim($val);
                                $val = str_replace('*','%',$val);
                                $val = str_replace('?','_',$val);
                                $qq .= " OR ( first_name.first_name LIKE '{$val}') ";
                            }
                            if($op == 'AND'){
                                $queryHaving .= ' AND COUNT(DISTINCT man_has_first_name.first_name_id) >= '.(count($data['first_name'])+1).'';
                            }
                        }
                        $qq .= " ) ";
                        $query .= $qq;
                    }

                }elseif(!is_null($data['first_name'][0])){
                    $q = $this->search(['first_name.first_name'],$data['first_name'][0]);
                    $query .= $q;
                }

            }

            if(isset($data['last_name'])){
                if (isset($data['last_name_type']) || strpos($data['last_name'][0], '*') !== false || strpos($data['last_name'][0], '?') !== false) {

                    $data['last_name'] = array_filter($data['last_name']);
                    if(!empty($data['last_name'])){
                        $first = $data['last_name'][0];
                        $first = trim($first);
                        $first = str_replace('*','%',$first);
                        $first = str_replace('?','_',$first);

                        ($data['last_name_type'] == 'NOT' ) ? $q = 'NOT' : $q = ''; //add variable $q

                        $qq = " AND $q (
                                ( last_name.last_name LIKE '{$first}'
                                OR last_name.last_name LIKE 'ter_{$first}'
                                OR last_name.last_name LIKE 'տեր_{$first}'
                                OR last_name.last_name LIKE 'тер_{$first}'
                                ) ";
                        unset($data['last_name'][0]);
                        if(!empty($data['last_name'])){
                            $op = $data['last_name_type'];
                            foreach($data['last_name'] as $val){
                                $val = trim($val);
                                $val = str_replace('*','%',$val);
                                $val = str_replace('?','_',$val);
                                $qq .= " OR ( last_name.last_name LIKE '{$val}'
                                OR last_name.last_name LIKE 'ter_{$first}'
                                OR last_name.last_name LIKE 'տեր_{$first}'
                                OR last_name.last_name LIKE 'тер_{$first}' ) ";
                            }
                            if($op == 'AND'){
                                $queryHaving .= 'AND COUNT(DISTINCT man_has_last_name.last_name_id) >= '.(count($data['last_name'])+1);
                            }
                        }
                        $qq .= " ) ";
                        $query .= $qq;
                    }
                }elseif(!is_null($data['last_name'][0])){
                    $q = $this->search(['last_name.last_name'],$data['last_name'][0]);
                    $query .= $q;
                }
            }

            if(isset($data['middle_name'])){

                if (isset($data['middle_name_type']) || strpos($data['middle_name'][0], '*') !== false || strpos($data['middle_name'][0], '?') !== false) {


                    $data['middle_name'] = array_filter($data['middle_name']);
                    if(!empty($data['middle_name'])){
                        $first = $data['middle_name'][0];
                        $first = trim($first);
                        $first = str_replace('*','%',$first);
                        $first = str_replace('?','_',$first);

                        ($data['middle_name_type'] == 'NOT' ) ? $q = 'NOT' : $q = ''; //add variable $q

                        $qq = " AND $q ( ( middle_name.middle_name LIKE '{$first}' ) ";
                        unset($data['middle_name'][0]);
                        if(!empty($data['middle_name'])){
                            $op = $data['middle_name_type'];
                            foreach($data['middle_name'] as $val){
                                $val = trim($val);
                                $val = str_replace('*','%',$val);
                                $val = str_replace('?','_',$val);
                                $qq .= " OR ( middle_name.middle_name LIKE '{$val}') ";
                            }
                            if($op == 'AND'){
                                $queryHaving .= " AND COUNT(DISTINCT man_has_middle_name.middle_name_id) >=".(count($data['middle_name'])+1);
                            }
                        }
                        $qq .= " ) ";
                        $query .= $qq;
                    }

                }elseif(!is_null($data['middle_name'][0])){

                    $q = $this->search(['middle_name.middle_name'],$data['middle_name'][0]);
                    $query .= $q;
                }

            }

            if(isset($data['passport'])){

                if (isset($data['passport_type']) || strpos($data['passport'][0], '*') !== false || strpos($data['passport'][0], '?') !== false) {

                    $data['passport'] = array_filter($data['passport']);
                    if(!empty($data['passport'])){
                        $first = $data['passport'][0];
                        $first = trim($first);
                        $first = str_replace('*','%',$first);
                        $first = str_replace('?','_',$first);

                        ($data['passport_type'] == 'NOT' ) ? $q = 'NOT' : $q = ''; //add variable $q

                        $qq = " AND $q ( (passport.number LIKE '{$first}') ";
                        unset($data['passport'][0]);
                        if(!empty($data['passport'])){
                            $op = $data['passport_type'];
                            foreach($data['passport'] as $val){
                                $val = trim($val);
                                $val = str_replace('*','%',$val);
                                $val = str_replace('?','_',$val);
                                $qq .= " OR ( passport.number LIKE '{$val}') ";
                            }
                            if($op == 'AND'){
                                $queryHaving .= " AND COUNT(DISTINCT man_has_passport.passport_id) >= ".(count($data['passport'])+1);
                            }
                        }
                        $qq .= " ) ";
                        $query .= $qq;
                    }
              }elseif(!is_null($data['passport'][0])){
                $q = $this->search(['passport.number'],$data['passport'][0]);
                $query .= $q;
              }

            }

            if(isset($data['country_id'])){
                $data['country_id'] = array_filter($data['country_id']);

                if(!empty($data['country_id']) && $data['country_id_type'] =='NOT' )
                {
                   $query .= " AND country_search_man.country_id NOT IN (".implode(',',$data['country_id']).")";
                }

                if(!empty($data['country_id']) && $data['country_id_type'] !='NOT'){
                    $qq = " AND country_search_man.country_id IN (".implode(',',$data['country_id']).") ";
                    $query .= $qq;
                    if(isset($data['country_id_type'])){
                        if($data['country_id_type'] == 'AND' && count($data['country_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT country_search_man.country_id) >= '".count($data['country_id'])."' ";
                        }
                    }
                }
            }

            if(isset($data['education_id'])){
                $data['education_id'] = array_filter($data['education_id']);

                if(!empty($data['education_id']) && $data['country_id_type'] =='NOT' )
                {
                   $query .= " AND man_has_education.education_id NOT IN (".implode(',',$data['education_id']).")";
                }

                if(!empty($data['education_id']) && $data['country_id_type'] !='NOT'){
                    $qq = " AND man_has_education.education_id IN (".implode(',',$data['education_id']).") ";
                    $query .= $qq;
                    if(isset($data['education_id_type'])){
                        if($data['education_id_type'] == 'AND' && count($data['education_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT man_has_education.education_id) >= '".count($data['education_id'])."' ";
                        }
                    }
                }
            }

            if(isset($data['language_id'])){
                $data['language_id'] = array_filter($data['language_id']);

                if(!empty($data['language_id']) && $data['language_id_type'] =='NOT' )
                {
                   $query .= " AND man_knows_language.language_id NOT IN (".implode(',',$data['language_id']).")";
                }

                if(!empty($data['language_id']) && $data['language_id_type'] !='NOT'){
                    $qq = " AND man_knows_language.language_id IN (".implode(',',$data['language_id']).") ";
                    $query .= $qq;
                    if(isset($data['language_id_type'])){
                        if($data['language_id_type'] == 'AND' && count($data['language_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT man_knows_language.language_id) >= '".count($data['language_id'])."' ";
                        }
                    }
                }
            }

            if(isset($data['party_id'])){
                $data['party_id'] = array_filter($data['party_id']);

                if(!empty($data['party_id']) && $data['party_id_type'] =='NOT' )
                {
                   $query .= " AND man_has_party.party_id NOT IN (".implode(',',$data['party_id']).")";
                }

                if(!empty($data['party_id']) && $data['party_id_type'] !='NOT'){
                    $qq = " AND man_has_party.party_id IN (".implode(',',$data['party_id']).") ";
                    $query .= $qq;
                    if(isset($data['party_id_type'])){
                        if($data['party_id_type'] == 'AND' && count($data['party_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT man_has_party.party_id) >= '".count($data['party_id'])."' ";
                        }
                    }
                }
            }

            if(isset($data['operation_category_id'])){
                $data['operation_category_id'] = array_filter($data['operation_category_id']);

                if(!empty($data['operation_category_id']) && $data['operation_category_id_type'] =='NOT' )
                {
                   $query .= " AND man_has_operation_category.operation_category_id NOT IN (".implode(',',$data['operation_category_id']).")";
                }

                if(!empty($data['operation_category_id']) && $data['operation_category_id_type'] !='NOT'){
                    $qq = " AND man_has_operation_category.operation_category_id IN (".implode(',',$data['operation_category_id']).") ";
                    $query .= $qq;
                    if(isset($data['operation_category_id_type'])){
                        if($data['operation_category_id_type'] == 'AND' && count($data['operation_category_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT man_has_operation_category.operation_category_id) >= '".count($data['operation_category_id'])."' ";
                        }
                    }
                }
            }

            if(isset($data['nickname'])){
                $data['nickname'] = array_filter($data['nickname']);
                if(!empty($data['nickname'])){
                    $first = $data['nickname'][0];
                    $first = trim($first);
                    $first = str_replace('*','%',$first);
                    $first = str_replace('?','_',$first);

                    ($data['nickname_type'] == 'NOT' ) ? $q = 'NOT' : $q = ''; //add variable $q

                    $qq = " AND $q ( ( nickname.name LIKE '{$first}') ";
                    unset($data['nickname'][0]);
                    if(!empty($data['nickname'])){
                        $op = $data['nickname_type'];
                        foreach($data['nickname'] as $val){
                            $val = trim($val);
                            $val = str_replace('*','%',$val);
                            $val = str_replace('?','_',$val);
                            $qq .= " OR ( nickname.name LIKE '{$val}') ";
                        }
                        if($op == 'AND'){
                            $queryHaving .= " AND COUNT(DISTINCT man_has_nickname.nickname_id) >=".(count($data['nickname'])+1);
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }
            }

            if(isset($data['birthday']) && strlen(trim($data['birthday'])) != 0){
                $data['birthday'] = trim($data['birthday']);
                $aa = explode('-',$data['birthday']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['birthday'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(birthday) = '{$data['birthday']}' ";
            }

            if(isset($data['approximate_year'])){

                $q = $this->searchFieldString($data['approximate_year'], $data['approximate_year_type'], "CONCAT(start_year,'-',end_year)");
                $query .= $q;

                // $data['approximate_year'] = array_filter($data['approximate_year']);
                // if(!empty($data['approximate_year'])){
                //     $first = $data['approximate_year'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( CONCAT(start_year,'-',end_year) LIKE '{$first}' ) ";
                //     unset($data['approximate_year'][0]);
                //     if(!empty($data['approximate_year'])){
                //         $op = $data['approximate_year_type'];
                //         foreach($data['approximate_year'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( CONCAT(start_year,'-',end_year) LIKE '{$val}' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }

            if(isset($data['start_wanted']) && strlen(trim($data['start_wanted'])) != 0){
                $data['start_wanted'] = trim($data['start_wanted']);
                $aa = explode('-',$data['start_wanted']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['start_wanted'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(start_wanted) = '{$data['start_wanted']}' ";
            }

            if(isset($data['entry_date']) && strlen(trim($data['entry_date'])) != 0){
                $data['entry_date'] = trim($data['entry_date']);
                $aa = explode('-',$data['entry_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['entry_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(entry_date) = '{$data['entry_date']}' ";
            }

            if(isset($data['exit_date']) && strlen(trim($data['exit_date'])) != 0){
                $data['exit_date'] = trim($data['exit_date']);
                $aa = explode('-',$data['exit_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['exit_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(exit_date) = '{$data['exit_date']}' ";
            }

            if(isset($data['attention'])){

               $q = $this->searchFieldDataId($data['attention'],$data['attention_type'],'`attention`');
               $query .= $q;

                // $data['attention'] = array_filter($data['attention']);
                // if(!empty($data['attention'])){
                //     $first = $data['attention'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( attention LIKE '{$first}') ";
                //     unset($data['attention'][0]);
                //     if(!empty($data['attention'])){
                //         $op = $data['attention_type'];
                //         foreach($data['attention'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( attention LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['more_data'])){

               $q = $this->searchFieldDataId($data['more_data'],$data['more_data_type'],'`more_data_man`.text');
               $query .= $q;

                // $data['more_data'] = array_filter($data['more_data']);
                // if(!empty($data['more_data'])){
                //     $first = $data['more_data'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( more_data_man.text LIKE '{$first}') ";
                //     unset($data['more_data'][0]);
                //     if(!empty($data['more_data'])){
                //         $op = $data['more_data_type'];
                //         foreach($data['more_data'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( more_data_man.text LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['occupation'])){

                $q = $this->searchFieldDataId($data['occupation'],$data['occupation_type'],'`occupation`');
                $query .= $q;

                // $data['occupation'] = array_filter($data['occupation']);
                // if(!empty($data['occupation'])){
                //     $first = $data['occupation'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( occupation LIKE '{$first}') ";
                //     unset($data['occupation'][0]);
                //     if(!empty($data['occupation'])){
                //         $op = $data['occupation_type'];
                //         foreach($data['occupation'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( occupation LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['opened_dou'])){

                $q = $this->searchFieldDataId($data['opened_dou'],$data['opened_dou_type'],'`opened_dou`');
                $query .= $q;

                // $data['opened_dou'] = array_filter($data['opened_dou']);
                // if(!empty($data['opened_dou'])){
                //     $first = $data['opened_dou'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( (opened_dou LIKE '{$first}') ";
                //     unset($data['opened_dou'][0]);
                //     if(!empty($data['opened_dou'])){
                //         foreach($data['opened_dou'] as $val){
                //             $op = $data['opened_dou_type'];
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( opened_dou LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['gender_id'])){

                $q = $this->fieldId(
                    $data['gender_id'],
                    $data['gender_id_type'],
                    '`gender_id`',
                    '`man`.id'
                );
                $query .= $q;

                // $data['gender_id'] = array_filter($data['gender_id']);

                // if(!empty($data['gender_id']) && $data['gender_id_type'] =='NOT' )
                // {
                //    $query .= " AND gender_id NOT IN (".implode(',',$data['gender_id']).")";
                // }

                // if(!empty($data['gender_id']) && $data['gender_id_type'] !='NOT'){
                //     $qq = " AND gender_id IN (".implode(',',$data['gender_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['gender_id_type'])){
                //         if($data['gender_id_type'] == 'AND' && count($data['gender_id'])>1){
                //             $query .= " AND `man`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['nation_id'])){

                $q = $this->fieldId(
                    $data['nation_id'],
                    $data['nation_id_type'],
                    '`nation_id`',
                    '`man`.id'
                );
                $query .= $q;

                // $data['nation_id'] = array_filter($data['nation_id']);

                // if(!empty($data['nation_id']) && $data['nation_id_type'] =='NOT' )
                // {
                //    $query .= " AND nation_id NOT IN (".implode(',',$data['nation_id']).")";
                // }

                // if(!empty($data['nation_id']) && $data['nation_id_type'] !='NOT'){
                //     $qq = " AND nation_id IN (".implode(',',$data['nation_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['nation_id_type'])){
                //         if($data['nation_id_type'] == 'AND' && count($data['nation_id'])>1){
                //             $query .= " AND `man`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['region']) && !empty($data['region'])){
                $data['region_id_type'] = $data['region_type'];

                ($data['region_id_type'] == 'NOT') ? $q = 'NOT' : $q ='';

                foreach($data['region'] as $val){
                    $val = trim($val);
                    $val = str_replace('*','.*',$val);
                    $val = str_replace('?','.?.',$val);
                    $getRegion = $val;
                    $queryRegion = "SELECT id FROM region WHERE ( LOWER(`name`) $q REGEXP(LOWER('^{$getRegion}$')) ) = 1 ";
                    // $this->_setSql($queryRegion);
                    // $regId = $this->getAll();
                    $regId = DB::select($queryRegion);

                    if($regId){
                        if (strlen(trim($data['region_id'][0])) == 0) {
                            unset($data['region_id']);
                        }
                        foreach($regId as $val){
                            //$data['region_id'][] = $val['id'];
                            $data['region_id'][] = $val->id;
                        }
                    }
                }
            }

            if(isset($data['region_id'])){

                $q = $this->searchLocation($data['region_id'], $data['region_id_type'], $data['region_type'], '`born_address`.region_id');
                $query .= $q;

                // $first = $data['region_id'][0];
                // if (strlen(trim($first)) != 0) {
                //     $qq = " AND ( (born_address.region_id  = '{$first}' ) ";
                //     if (!empty($data['region_id_type'])) {
                //         $op = $data['region_id_type'];
                //     } elseif (!empty($data['region_type'])) {
                //         $op = $data['region_type'];
                //     } else {
                //         $op = 'OR';
                //     }

                //     unset($data['region_id'][0]);
                //     if (!empty($data['region_id'])) {
                //         foreach ($data['region_id'] as $val) {
                //             $qq .= " $op ( born_address.region_id = '$val' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }

            if(isset($data['locality']) && !empty($data['locality'])){
                $data['locality_id_type'] = $data['locality_type'];

                ($data['locality_id_type'] == 'NOT') ? $q = 'NOT' : $q ='';

                foreach($data['locality'] as $val){
                    $val = trim($val);
                    $val = str_replace('*','.*',$val);
                    $val = str_replace('?','.?.',$val);
                    $getLocality = $val;
                    $queryLocality = "SELECT id FROM locality WHERE ( LOWER(`name`) $q REGEXP(LOWER('^{$getLocality}$')) ) = 1 ";
                    // $this->_setSql($queryLocality);
                    // $regId = $this->getAll();
                    $regId = DB::select($queryLocality);

                    if($regId){
                        if (strlen(trim($data['locality_id'][0])) == 0) {
                            unset($data['locality_id']);
                        }
                        foreach($regId as $val){
                            $data['locality_id'][] = $val['id'];
                        }
                    }
                }
            }

            if(isset($data['locality_id'])){

                $q = $this->searchLocation($data['locality_id'], $data['locality_id_type'], $data['locality_type'], '`born_address`.locality_id');
                $query .= $q;

                // $first = $data['locality_id'][0];
                // if (strlen(trim($first)) != 0) {
                //     $qq = " AND ( (born_address.locality_id  = '{$first}' ) ";
                //     if (!empty($data['locality_id_type'])) {
                //         $op = $data['locality_id_type'];
                //     } elseif (!empty($data['locality_type'])) {
                //         $op = $data['locality_type'];
                //     } else {
                //         $op = 'OR';
                //     }
                //     unset($data['locality_id'][0]);
                //     if (!empty($data['locality_id'])) {
                //         foreach ($data['locality_id'] as $val) {
                //             $qq .= " $op ( born_address.locality_id = '$val' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }

            if(isset($data['country_ate_id'])){

                $q = $this->fieldId(
                    $data['country_ate_id'],
                    $data['country_ate_id_type'],
                    '`born_address`.country_ate_id',
                    '`man`.id'
                );
                $query .= $q;

                // $data['country_ate_id'] = array_filter($data['country_ate_id']);

                // if(!empty($data['country_ate_id']) && $data['country_ate_id_type'] =='NOT' )
                // {
                //    $query .= " AND born_address.country_ate_id NOT IN (".implode(',',$data['country_ate_id']).")";
                // }

                // if(!empty($data['country_ate_id']) && $data['country_ate_id_type'] !='NOT'){
                //     $qq = " AND born_address.country_ate_id IN (".implode(',',$data['country_ate_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['country_ate_id_type'])){
                //         if($data['country_ate_id_type'] == 'AND' && count($data['country_ate_id'])>1){
                //             $query .= " AND `man`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['religion_id'])){

                $q = $this->fieldId(
                    $data['religion_id'],
                    $data['religion_id_type'],
                    '`religion_id`',
                    '`man`.id'
                );
                $query .= $q;

                // $data['religion_id'] = array_filter($data['religion_id']);

                // if(!empty($data['religion_id']) && $data['religion_id_type'] =='NOT' )
                // {
                //    $query .= " AND religion_id NOT IN (".implode(',',$data['religion_id']).")";
                // }

                // if(!empty($data['religion_id']) && $data['religion_id_type'] !='NOT'){
                //     $qq = " AND religion_id IN (".implode(',',$data['religion_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['religion_id_type'])){
                //         if($data['religion_id_type'] == 'AND' && count($data['religion_id'])>1){
                //             $query .= " AND `man`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['citizenship_id'])){
                $data['citizenship_id'] = array_filter($data['citizenship_id']);

                if(!empty($data['citizenship_id']) && $data['citizenship_id_type'] =='NOT' )
                {
                   $query .= " AND man_belongs_country.country_id NOT IN (".implode(',',$data['citizenship_id']).")";
                }

                if(!empty($data['citizenship_id']) && $data['citizenship_id_type'] !='NOT'){
                    $qq = " AND man_belongs_country.country_id IN (".implode(',',$data['citizenship_id']).") ";
                    $query .= $qq;
                    if(isset($data['citizenship_id_type'])){
                        if($data['citizenship_id_type'] == 'AND' && count($data['citizenship_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT man_belongs_country.country_id) >= '".count($data['citizenship_id'])."' ";
                        }
                    }
                }
            }

            if(isset($data['resource_id'])){

                $q = $this->fieldId(
                    $data['resource_id'],
                    $data['resource_id_type'],
                    '`resource_id`',
                    '`man`.id'
                );
                $query .= $q;

                // $data['resource_id'] = array_filter($data['resource_id']);

                // if(!empty($data['resource_id']) && $data['resource_id_type'] =='NOT' )
                // {
                //    $query .= " AND resource_id NOT IN (".implode(',',$data['resource_id']).")";
                // }

                // if(!empty($data['resource_id']) && $data['resource_id_type'] !='NOT'){
                //     $qq = " AND resource_id IN (".implode(',',$data['resource_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['resource_id_type'])){
                //         if($data['resource_id_type'] == 'AND' && count($data['resource_id'])>1){
                //             $query .= " AND `man`.id = 0 ";
                //         }
                //     }
                // }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(man.id) ';


            if(isset($data['auto_name'])){

                $data['auto_name'] = array_filter($data['auto_name']);
                if(!empty($data['auto_name'])){
                    $first = $data['auto_name'][0];
                    $first = trim($first);
                    $first = str_replace('*','%',$first);
                    $first = str_replace('?','_',$first);

                    ($data['auto_name_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND $q ( ( first_name LIKE '{$first}' OR last_name LIKE '{$first}' OR middle_name LIKE '{$first}') ";
                    unset($data['auto_name'][0]);
                    if(!empty($data['auto_name'])){
                        $op = $data['auto_name_type'];
                        foreach($data['auto_name'] as $val){
                            $val = trim($val);
                            $val = str_replace('*','%',$val);
                            $val = str_replace('?','_',$val);
                            $qq .= " $op $q ( first_name LIKE '{$val}' OR last_name LIKE '{$val}' OR middle_name LIKE '{$val}' ) ";
                        }
                    }
                    $qq .= " ) ";
                    $queryHaving .= $qq;


                }


            }

            // $query .= $queryHaving;
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchWeapon($data, $files_flag = false, $files = null){
            $query = " SELECT weapon.* FROM weapon
                LEFT JOIN man_has_weapon ON man_has_weapon.weapon_id = weapon.id
                LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man_has_weapon.man_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = man_has_bibliography.bibliography_id
                WHERE 1=1 ";

            if(isset($data['category'])){

                $q = $this->searchFieldDataId($data['category'],$data['category_type'],'`category`');
                $query .= $q;

                // $data['category'] = array_filter($data['category']);
                // if(!empty($data['category'])){
                //     $first = $data['category'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( category LIKE '{$first}') ";
                //     unset($data['category'][0]);
                //     if(!empty($data['category'])){
                //         $op = $data['category_type'];
                //         foreach($data['category'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( category LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['view'])){

                $q = $this->searchFieldDataId($data['view'], $data['view_type'],'`view`');
                $query .= $q;

                // $data['view'] = array_filter($data['view']);
                // if(!empty($data['view'])){
                //     $first = $data['view'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( view LIKE '{$first}') ";
                //     unset($data['view'][0]);
                //     if(!empty($data['view'])){
                //         $op = $data['view_type'];
                //         foreach($data['view'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( view LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }

            if(isset($data['type'])){

                $q = $this->searchFieldDataId($data['type'], $data['type_type'],'`type`');
                $query .= $q;

                // $data['type'] = array_filter($data['type']);
                // if(!empty($data['type'])){
                //     $first = $data['type'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( type LIKE '{$first}') ";
                //     unset($data['type'][0]);
                //     if(!empty($data['type'])){
                //         $op = $data['type_type'];
                //         foreach($data['type'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( type LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['model'])){

                $q = $this->searchFieldDataId($data['model'], $data['model_type'],'`model`');
                $query .= $q;

                // $data['model'] = array_filter($data['model']);
                // if(!empty($data['model'])){
                //     $first = $data['model'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( model LIKE '{$first}') ";
                //     unset($data['model'][0]);
                //     if(!empty($data['model'])){
                //         $op = $data['model_type'];
                //         foreach($data['model'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( model LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['reg_num'])){

                $q = $this->searchFieldDataId($data['reg_num'], $data['reg_num_type'],'`reg_num`');
                $query .= $q;

                // $data['reg_num'] = array_filter($data['reg_num']);
                // if(!empty($data['reg_num'])){
                //     $first = $data['reg_num'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( reg_num LIKE '{$first}') ";
                //     unset($data['reg_num'][0]);
                //     if(!empty($data['reg_num'])){
                //         $op = $data['reg_num_type'];
                //         foreach($data['reg_num'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( reg_num LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['count'])){

                $q = $this->searchFieldDataId($data['count'], $data['count_type'],'`count`');
                $query .= $q;

                // $data['count'] = array_filter($data['count']);
                // if(!empty($data['count'])){
                //     $first = $data['count'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( count LIKE '{$first}') ";
                //     unset($data['count'][0]);
                //     if(!empty($data['count'])){
                //         $op = $data['count_type'];
                //         foreach($data['count'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( count LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(weapon.id)';
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchCar($data, $files_flag = false, $files = null){

            $query = " SELECT car.* , car_category.name AS car_category , car_mark.name AS car_mark , color.name AS car_color
                    FROM car
                    LEFT JOIN car_category ON car_category.id = car.category_id
                    LEFT JOIN car_mark ON car_mark.id = car.mark_id
                    LEFT JOIN color ON color.id = car.color_id
                    LEFT JOIN man_use_car ON man_use_car.car_id = car.id
                    LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man_use_car.man_id
                    LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = man_has_bibliography.bibliography_id
                    WHERE 1=1";

            if(isset($data['category_id'])){

                $q = $this->fieldId($data['category_id'],$data['category_id_type'],'`category_id`','`car`.id');
                $query .= $q;

                // $data['category_id'] = array_filter($data['category_id']);

                // if(!empty($data['category_id']) && $data['category_id_type'] =='NOT' )
                // {
                //    $query .= " AND category_id NOT IN (".implode(',',$data['category_id']).")";
                // }

                // if(!empty($data['category_id']) && $data['category_id_type'] !='NOT'){
                //     $qq = " AND category_id IN (".implode(',',$data['category_id']).") ";
                //     $query .= $qq;

                //     if(isset($data['category_id_type'])){
                //         if($data['category_id_type'] == 'AND' && count($data['category_id'])>1){
                //             $query .= " AND `car`.id = 0 ";
                //         }
                //     }
                // }

            }

            if(isset($data['mark_id'])){

                $q = $this->fieldId($data['mark_id'],$data['mark_id_type'],'`mark_id`','`car`.id');
                $query .= $q;

                // $data['mark_id'] = array_filter($data['mark_id']);

                // if(!empty($data['mark_id']) && $data['mark_id_type'] =='NOT' )
                // {
                //    $query .= " AND mark_id NOT IN (".implode(',',$data['mark_id']).")";
                // }

                // if(!empty($data['mark_id']) && $data['mark_id_type'] !='NOT'){
                //     $qq = " AND mark_id IN (".implode(',',$data['mark_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['mark_id_type'])){
                //         if($data['mark_id_type'] == 'AND' && count($data['mark_id'])>1){
                //             $query .= " AND `car`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['color']))
            {
                $q = $this->searchFieldString($data['color'], $data['color_type'], '`color`.name');
                $query .= $q;

                // $data['color'] = array_filter($data['color']);
                // if(!empty($data['color']) && $data['color_type'] =='NOT' )
                // {
                //    $query .= " AND color.name NOT IN ('" . implode( "', '" , $data['color'] ) . "')";
                // }

                // if(!empty($data['color']) && $data['color_type'] !='NOT' ){
                //         $first = $data['color'][0];
                //         $first = trim($first);
                //         $first = str_replace('*','%',$first);
                //         $first = str_replace('?','_',$first);
                //         $qq = " AND ( ( color.name LIKE '{$first}') ";
                //         unset($data['color'][0]);
                //     if(!empty($data['color'])){
                //         $op = $data['color_type'];
                //         foreach($data['color'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( color.name LIKE '{$val}') ";
                //         }
                //     }

                //     $qq .= " ) ";
                //     $query .= $qq;
                //

                // }

            }

            if(isset($data['number'])){

                $q = $this->searchFieldString($data['number'], $data['number_type'], '`number`');
                $query .= $q;

                // $data['number'] = array_filter($data['number']);

                // if(!empty($data['number'])){
                //     $first = $data['number'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( number LIKE '{$first}') ";
                //     unset($data['number'][0]);
                //     if(!empty($data['number'])){
                //         $op = $data['number_type'];
                //         foreach($data['number'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( number LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['count'])){

                $q = $this->searchFieldString($data['count'], $data['count_type'], '`count`');
                $query .= $q;

                // $data['count'] = array_filter($data['count']);

                // if(!empty($data['count'])){
                //     $first = $data['count'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( count LIKE '{$first}') ";
                //     unset($data['count'][0]);
                //     if(!empty($data['count'])){
                //         $op = $data['count_type'];
                //         foreach($data['count'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( count LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['note'])){

                $q = $this->searchFieldString($data['note'], $data['note_type'], '`note`');
                $query .= $q;

                // $data['note'] = array_filter($data['note']);

                // if(!empty($data['note'])){
                //     $first = $data['note'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( note LIKE '{$first}') ";
                //     unset($data['note'][0]);
                //     if(!empty($data['note'])){
                //         $op = $data['note_type'];
                //         foreach($data['note'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( note LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(car.id)';
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);
        }

        public function searchAddress($data, $files_flag = false, $files = null){
            $query = " SELECT	address.* , region.name AS region , locality.name AS locality, street.name AS street , city.name AS city , country_ate.name AS country_ate
                FROM address
                LEFT JOIN region ON region.id = address.region_id
                LEFT JOIN locality ON locality.id = address.locality_id
                LEFT JOIN street ON street.id = address.street_id
                LEFT JOIN city ON city.id = address.city_id
                LEFT JOIN country_ate ON country_ate.id = address.country_ate_id
                LEFT JOIN man_has_address ON man_has_address.address_id = address.id
                LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man_has_address.man_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = man_has_bibliography.bibliography_id
                WHERE 1=1 ";

            if(isset($data['country_ate_id'])){
                $first = $data['country_ate_id'][0];

                if(!empty($data['country_ate_id']) && $data['country_ate_id_type'] =='NOT' )
                {
                   $query .= " AND 'addres.country_ate_id' NOT IN (".implode(',',$data['country_ate_id']).")";
                }

                if (strlen(trim($first)) != 0 && $data['country_ate_id_type'] !='NOT') {
                    $qq = " AND ( (country_ate_id = '{$first}' ) ";
                    $op = $data['country_ate_id_type'];
                    unset($data['country_ate_id'][0]);
                    if (!empty($data['country_ate_id'])) {
                        foreach ($data['country_ate_id'] as $val) {
                            $qq .= " $op ( country_ate_id = '$val' ) ";
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }

            }

            if(isset($data['region']) && !empty($data['region'])){
                $data['region_id_type'] = $data['region_type'];

                ($data['region_id_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                foreach($data['region'] as $val){
                    $val = trim($val);
                    $val = str_replace('*','.*',$val);
                    $val = str_replace('?','.?.',$val);
                    $getRegion = $val;
                    $queryRegion = "SELECT id FROM region WHERE ( LOWER(`name`) $q REGEXP(LOWER('^{$getRegion}$')) ) = 1 ";


                    $regId = DB::select($queryRegion);
                    if($regId){
                        foreach($regId as $val){
                            $data['region_id'][] = $val['id'];
                        }
                    }
                }
            }

            if(isset($data['locality']) && !empty($data['locality'])){
                $data['locality_id_type'] = $data['locality_type'];

                ($data['locality_id_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                foreach($data['locality'] as $val){
                    $val = trim($val);
                    $val = str_replace('*','.*',$val);
                    $val = str_replace('?','.?.',$val);
                    $getLocality = $val;
                    $queryLocality = "SELECT id FROM locality WHERE ( LOWER(`name`) $q REGEXP(LOWER('^{$getLocality}$')) ) = 1 ";

                    $regId = DB::select($queryLocality);
                    if($regId){
                        foreach($regId as $val){
                            $data['locality_id'][] = $val['id'];
                        }
                    }
                }
            }

            if(isset($data['street']) && !empty($data['street'])){
                $data['street_id_type'] = $data['street_type'];

                ($data['street_id_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                foreach($data['street'] as $val){
                    $val = trim($val);
                    $val = str_replace('*','.*',$val);
                    $val = str_replace('?','.?.',$val);
                    $getStreet = $val;
                    $queryStreet = "SELECT id FROM street WHERE ( LOWER(`name`) $q REGEXP(LOWER('^{$getStreet}$')) ) = 1 ";

                    $regId = DB::select($queryLocality);
                    if($regId){
                        foreach($regId as $val){
                            $data['street_id'][] = $val['id'];
                        }
                    }
                }
            }
            if(isset($data['region_id'])){

                $q = $this->searchLocation($data['region_id'], $data['region_id_type'], $data['region_type'], '`region_id`');
                $query .= $q;

                // $first = $data['region_id'][0];
                // if (strlen(trim($first)) != 0) {
                //     $qq = " AND ( (region_id = '{$first}' ) ";
                //     if (!empty($data['region_id_type'])) {
                //         $op = $data['region_id_type'];
                //     } elseif (!empty($data['region_type'])) {
                //         $op = $data['region_type'];
                //     } else {
                //         $op = 'OR';
                //     }
                //     unset($data['region_id'][0]);
                //     if (!empty($data['region_id'])) {
                //         foreach ($data['region_id'] as $val) {
                //             $qq .= " $op ( region_id = '$val' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }
            if(isset($data['locality_id'])){

                $q = $this->searchLocation($data['locality_id'], $data['locality_id_type'], $data['locality_type'], '`locality_id`');
                $query .= $q;

                // $first = $data['locality_id'][0];
                // if (strlen(trim($first)) != 0) {
                //     $qq = " AND ( (locality_id = '{$first}' ) ";
                //     if (!empty($data['locality_id_type'])) {
                //         $op = $data['locality_id_type'];
                //     } elseif (!empty($data['locality_type'])) {
                //         $op = $data['locality_type'];
                //     } else {
                //         $op = 'OR';
                //     }
                //     unset($data['locality_id'][0]);
                //     if (!empty($data['locality_id'])) {
                //         foreach ($data['locality_id'] as $val) {
                //             $qq .= " $op ( locality_id = '$val' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }
            if(isset($data['street_id'])){

                $q = $this->searchLocation($data['street_id'], $data['street_id_type'], $data['street_type'], '`street_id`');
                $query .= $q;

                // $first = $data['street_id'][0];
                // if (strlen(trim($first)) != 0) {
                //     $qq = " AND ( (street_id = '{$first}' ) ";
                //     if (!empty($data['street_id_type'])) {
                //         $op = $data['street_id_type'];
                //     } elseif (!empty($data['street_type'])) {
                //         $op = $data['street_type'];
                //     } else {
                //         $op = 'OR';
                //     }
                //     unset($data['street_id'][0]);
                //     if (!empty($data['street_id'])) {
                //         foreach ($data['street_id'] as $val) {
                //             $qq .= " $op ( street_id = '$val' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }
            if(isset($data['track']) && !empty($data['track'])){
                $first = $data['track'][0];
                if (strlen(trim($first)) != 0) {
                    $first = trim($first);
                    $first = str_replace('*', '.*', $first);
                    $first = str_replace('?', '.?.', $first);

                    ($data['track_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND  ( ( LOWER(track) $q REGEXP(LOWER('^{$first}$')) ) ";
                    $op = $data['track_type'];
                    unset($data['track'][0]);
                    if (!empty($data['track'])) {
                        foreach ($data['track'] as $val) {
                            $val = trim($val);
                            $val = str_replace('*', '.*', $val);
                            $val = str_replace('?', '.?.', $val);
                            $qq .= " $op ( LOWER(track) $q REGEXP(LOWER('^{$val}$')) ) ";
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }
            }
            if(isset($data['home_num']) && !empty($data['home_num'])){
                $first = $data['home_num'][0];
                if (strlen(trim($first)) != 0) {
                    $first = trim($first);
                    $first = str_replace('*', '.*', $first);
                    $first = str_replace('?', '.?.', $first);

                    ($data['home_num_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND ( ( LOWER(home_num) $q REGEXP(LOWER('^{$first}$')) ) ";
                    $op = $data['home_num_type'];
                    unset($data['home_num'][0]);
                    if (!empty($data['home_num'])) {
                        foreach ($data['home_num'] as $val) {
                            $val = trim($val);
                            $val = str_replace('*', '.*', $val);
                            $val = str_replace('?', '.?.', $val);
                            $qq .= " $op ( LOWER(home_num) $q REGEXP(LOWER('^{$val}$')) ) ";
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }
            }
            if(isset($data['housing_num']) && !empty($data['housing_num'])){
                $first = $data['housing_num'][0];
                if (strlen(trim($first)) != 0) {
                    $first = trim($first);
                    $first = str_replace('*', '.*', $first);
                    $first = str_replace('?', '.?.', $first);

                    ($data['housing_num_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND ( ( LOWER(housing_num) $q REGEXP(LOWER('^{$first}$')) ) ";
                    $op = $data['housing_num_type'];
                    unset($data['housing_num'][0]);
                    if (!empty($data['housing_num'])) {
                        foreach ($data['housing_num'] as $val) {
                            $val = trim($val);
                            $val = str_replace('*', '.*', $val);
                            $val = str_replace('?', '.?.', $val);
                            $qq .= " $op ( LOWER(housing_num) $q REGEXP(LOWER('^{$val}$')) ) ";
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }
            }
            if(isset($data['apt_num']) && !empty($data['apt_num'])){
                $first = $data['apt_num'][0];
                if (strlen(trim($first)) != 0) {
                    $first = trim($first);
                    $first = str_replace('*', '.*', $first);
                    $first = str_replace('?', '.?.', $first);

                    ($data['apt_num_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND ( ( LOWER(apt_num) $q REGEXP(LOWER('^{$first}$')) ) ";
                    $op = $data['apt_num_type'];
                    unset($data['apt_num'][0]);
                    if (!empty($data['apt_num'])) {
                        foreach ($data['apt_num'] as $val) {
                            $val = trim($val);
                            $val = str_replace('*', '.*', $val);
                            $val = str_replace('?', '.?.', $val);
                            $qq .= " $op ( LOWER(apt_num) $q REGEXP(LOWER('^{$val}$')) ) ";
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(address.id)';
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchWorkActivity($data, $files_flag = false, $files = null){
            $query = " SELECT organization_has_man.id,organization_has_man.title, organization_has_man.start_date, organization_has_man.end_date, organization_has_man.period
                FROM organization_has_man
                LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = organization_has_man.man_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = man_has_bibliography.bibliography_id
                WHERE 1=1 ";

            if(isset($data['title'])){

                $q = $this->searchFieldString($data['title'], $data['title_type'], '`title`');
                $query .= $q;

                // $data['title'] = array_filter($data['title']);
                // if(!empty($data['title'])){
                //     $first = $data['title'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( title LIKE '{$first}') ";
                //     unset($data['title'][0]);
                //     if(!empty($data['title'])){
                //         $op = $data['title_type'];
                //         foreach($data['title'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( title LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(strlen(trim($data['start_date'])) != 0){
                $data['start_date'] = trim($data['start_date']);
                $aa = explode('-',$data['start_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['start_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(start_date) = '{$data['start_date']}' ";
            }

            if(strlen(trim($data['end_date'])) != 0){
                $data['end_date'] = trim($data['end_date']);
                $aa = explode('-',$data['end_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['end_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(end_date) = '{$data['end_date']}' ";
            }

            if(isset($data['period'])){

                $q = $this->searchFieldString($data['period'], $data['period_type'], '`period`');
                $query .= $q;

                // $data['period'] = array_filter($data['period']);
                // if(!empty($data['period'])){
                //     $first = $data['period'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( period LIKE '{$first}') ";
                //     unset($data['period'][0]);
                //     if(!empty($data['period'])){
                //         $op = $data['period_type'];
                //         foreach($data['period'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( period LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(organization_has_man.id)';
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);
        }

        public function searchMiaSummary($data, $files_flag = false, $files = null){
            $query = " SELECT mia_summary.*,
                        (SELECT COUNT(*) FROM man_passes_mia_summary WHERE man_passes_mia_summary.mia_summary_id = mia_summary.id) AS man_count
                        FROM mia_summary
                LEFT JOIN bibliography ON bibliography.id = mia_summary.bibliography_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = bibliography.id
                WHERE 1=1 ";

            if(strlen(trim($data['date'])) != 0){
                $data['date'] = trim($data['date']);
                $aa = explode('-',$data['date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(date) = '{$data['date']}' ";
            }

            if(isset($data['content'])){

                $q = $this->searchFieldString($data['content'], $data['content_type'], '`mia_summary`.content');
                $query .= $q;

                // $data['content'] = array_filter($data['content']);
                // if(!empty($data['content'])){
                //     $first = $data['content'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( mia_summary.content LIKE '{$first}') ";
                //     unset($data['content'][0]);
                //     if(!empty($data['content'])){
                //         $op = $data['content_type'];
                //         foreach($data['content'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( mia_summary.content LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(mia_summary.id)';
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);
        }

        public function searchManBeanCountry($data){

            $query = " SELECT man_bean_country.* , country_ate.name AS country_ate, goal.name AS goal, region.name AS region, locality.name AS locality

                FROM man_bean_country
                LEFT JOIN country_ate ON country_ate.id = man_bean_country.country_ate_id
                LEFT JOIN goal ON goal.id = man_bean_country.goal_id
                LEFT JOIN region ON region.id = man_bean_country.region_id
                LEFT JOIN locality ON locality.id = man_bean_country.locality_id
                WHERE 1=1 ";

            if(isset($data['country_ate_id'])){

               $q = $this->searchFieldDataId($data['country_ate_id'],$data['country_ate_id_type'],'`country_ate_id`');
               $query .= $q;

               // $first = $data['country_ate_id'][0];
                // if (strlen(trim($first)) != 0) {
                //     $qq = " AND ( (country_ate_id = '{$first}' ) ";
                //     $op = $data['country_ate_id_type'];
                //     unset($data['country_ate_id'][0]);
                //     if (!empty($data['country_ate_id'])) {
                //             foreach ($data['country_ate_id'] as $val) {
                //                 $qq .= " $op ( country_ate_id = '$val' ) ";
                //             }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }

            if(isset($data['goal_id'])){

                $q = $this->searchFieldDataId($data['goal_id'],$data['goal_id_type'],'`goal_id`');
                $query .= $q;

                // $first = $data['goal_id'][0];
                // if (strlen(trim($first)) != 0) {
                //     $qq = " AND ( (goal_id = '{$first}' ) ";
                //     $op = $data['goal_id_type'];
                //     unset($data['goal_id'][0]);
                //     if (!empty($data['goal_id'])) {
                //         foreach ($data['goal_id'] as $val) {
                //             $qq .= " $op ( goal_id = '$val' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }

            if(strlen(trim($data['entry_date'])) != 0){
                $data['entry_date'] = trim($data['entry_date']);
                $aa = explode('-',$data['entry_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['entry_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(entry_date) = '{$data['entry_date']}' ";
            }

            if(strlen(trim($data['exit_date'])) != 0){
                $data['exit_date'] = trim($data['exit_date']);
                $aa = explode('-',$data['exit_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['exit_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(exit_date) = '{$data['exit_date']}' ";
            }

            if(isset($data['region'])){

                $data['region_id_type'] = $data['region_type'];

                ($data['region_id_type'] == 'NOT') ? $q = 'NOT' : $q ='';

                foreach($data['region'] as $val){
                    $val = trim($val);
                    $val = str_replace('*','.*',$val);
                    $val = str_replace('?','.?.',$val);
                    $getRegion = $val;
                    $queryRegion = "SELECT id FROM region WHERE ( LOWER(`name`) $q REGEXP(LOWER('^{$getRegion}$')) ) = 1 ";
                    // $this->_setSql($queryRegion);
                    $regId = DB::select($queryRegion);

                    if($regId){
                        foreach($regId as $val ){

                            //$data['region_id'][] = $val['id'];
                            $data['region_id'][] = $val->id;
                        }
                    }
                }


            }

            if(isset($data['locality'])){
                $data['locality_id_type'] = $data['locality_type'];

                ($data['locality_id_type'] == 'NOT') ? $q = 'NOT' : $q ='';

                foreach($data['locality'] as $val){
                    $val = trim($val);
                    $val = str_replace('*','.*',$val);
                    $val = str_replace('?','.?.',$val);
                    $getLocality = $val;
                    $queryLocality = "SELECT id FROM locality WHERE ( LOWER(`name`) $q REGEXP(LOWER('^{$getLocality}$')) ) = 1 ";
                    // $this->_setSql($queryLocality);
                    $regId = DB::select($queryLocality);

                    // $regId = $this->getAll();
                    if($regId){
                        foreach($regId as $val ){
                           // $data['locality_id'][] = $val['id'];
                           $data['locality_id'][] = $val->id;
                        }
                    }
                }
            }

            if(isset($data['region_id'])){

              $q = $this->searchLocation($data['region_id'], $data['region_id_type'], $data['region_type'], '`region_id`');
              $query .= $q;
                // $first = $data['region_id'][0];
                // if (strlen(trim($first)) != 0) {
                //     $qq = " AND ( (region_id = '{$first}' ) ";
                //     if (!empty($data['region_id_type'])) {
                //         $op = $data['region_id_type'];
                //     } elseif (!empty($data['region_type'])) {
                //         $op = $data['region_type'];
                //     } else {
                //         $op = 'OR';
                //     }
                //     unset($data['region_id'][0]);
                //     if (!empty($data['region_id'])) {
                //         foreach ($data['region_id'] as $val) {
                //             $qq .= " $op ( region_id = '$val' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }

            if(isset($data['locality_id'])){

                $q = $this->searchLocation($data['locality_id'], $data['locality_id_type'], $data['locality_type'], '`locality_id`');
                $query .= $q;

                // $first = $data['locality_id'][0];
                // if (strlen(trim($first)) != 0) {
                //     $qq = " AND ( (locality_id = '{$first}' ) ";
                //     if (!empty($data['locality_id_type'])) {
                //         $op = $data['locality_id_type'];
                //     } elseif (!empty($data['locality_type'])) {
                //         $op = $data['locality_type'];
                //     } else {
                //         $op = 'OR';
                //     }
                //     unset($data['locality_id'][0]);
                //     if (!empty($data['locality_id'])) {
                //         foreach ($data['locality_id'] as $val) {
                //             $qq .= " $op ( locality_id = '$val' ) ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }

            }

            $query .= '  GROUP BY(man_bean_country.id)';

            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);
        }

        public function searchCriminalCase($data, $files_flag = false, $files = null){

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
                LEFT JOIN criminal_case_worker_post ON criminal_case_worker_post.criminal_case_id = criminal_case.id
                LEFT JOIN criminal_case_worker ON criminal_case_worker.criminal_case_id = criminal_case.id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = criminal_case.bibliography_id
                WHERE 1=1 ";
            $queryHaving = "HAVING 1=1";

            if(isset($data['number'])){

                $q = $this->searchFieldString($data['number'], $data['number_type'], '`number`');
                $query .= $q;

                // $data['number'] = array_filter($data['number']);
                // if(!empty($data['number'])){
                //     $first = $data['number'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( number LIKE '{$first}') ";
                //     unset($data['number'][0]);
                //     if(!empty($data['number'])){
                //         $op = $data['number_type'];
                //         foreach($data['number'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( number LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['worker'])){
                $data['worker'] = array_filter($data['worker']);
                if(!empty($data['worker'])){
                    $first = $data['worker'][0];
                    $first = trim($first);
                    $first = str_replace('*','%',$first);
                    $first = str_replace('?','_',$first);

                    ($data['worker_type'] == 'NOT' ) ? $q = 'NOT' : $q = ''; //add variable $q

                    $qq = " AND $q ( ( worker LIKE '{$first}') ";
                    unset($data['worker'][0]);
                    if(!empty($data['worker'])){
                        $op = $data['worker_type'];
                        foreach($data['worker'] as $val){
                            $val = trim($val);
                            $val = str_replace('*','%',$val);
                            $val = str_replace('?','_',$val);
                            $qq .= " OR ( worker LIKE '{$val}') ";
                        }
                        if($op == 'AND'){
                            $queryHaving .= " AND COUNT(DISTINCT criminal_case_worker.worker) >=".(count($data['worker'])+1);
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }
            }

            if(strlen(trim($data['opened_date'])) != 0){
                $data['opened_date'] = trim($data['opened_date']);
                $aa = explode('-',$data['opened_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['opened_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(opened_date) = '{$data['opened_date']}' ";
            }

            if(isset($data['artical'])){

                $q = $this->searchFieldString($data['artical'], $data['artical_type'], '`artical`');
                $query .= $q;

                // $data['artical'] = array_filter($data['artical']);
                // if(!empty($data['artical'])){
                //     $first = $data['artical'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( artical LIKE '{$first}') ";
                //     unset($data['artical'][0]);
                //     if(!empty($data['artical'])){
                //         $op = $data['artical_type'];
                //         foreach($data['artical'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( artical LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['opened_unit_id'])){

                $q = $this->fieldId(
                    $data['opened_unit_id'],
                    $data['opened_unit_id_type'],
                    '`opened_unit_id`',
                    '`criminal_case`.id'
                );
                $query .= $q;

                // $data['opened_unit_id'] = array_filter($data['opened_unit_id']);

                // if(!empty($data['opened_unit_id']) && $data['opened_unit_id_type'] =='NOT' )
                // {
                //    $query .= " AND opened_unit_id NOT IN (".implode(',',$data['opened_unit_id']).")";
                // }

                // if(!empty($data['opened_unit_id']) && $data['opened_unit_id_type'] !='NOT'){
                //     $qq = " AND opened_unit_id IN (".implode(',',$data['opened_unit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['opened_unit_id_type'])){
                //         if($data['opened_unit_id_type'] == 'AND' && count($data['opened_unit_id'])>1){
                //             $query .= " AND `criminal_case`.id = 0 ";
                //         }
                //     }
                // }

            }

            if(isset($data['opened_agency_id'])){

                $q = $this->fieldId(
                    $data['opened_agency_id'],
                    $data['opened_agency_id_type'],
                    '`opened_agency_id`',
                    '`criminal_case`.id'
                );
                $query .= $q;

                // $data['opened_agency_id'] = array_filter($data['opened_agency_id']);

                // if(!empty($data['opened_agency_id']) && $data['opened_agency_id_type'] =='NOT' )
                // {
                //    $query .= " AND opened_agency_id NOT IN (".implode(',',$data['opened_agency_id']).")";
                // }

                // if(!empty($data['opened_agency_id']) && $data['opened_agency_id_type'] !='NOT'){
                //     $qq = " AND opened_agency_id IN (".implode(',',$data['opened_agency_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['opened_agency_id_type'])){
                //         if($data['opened_agency_id_type'] == 'AND' && count($data['opened_agency_id'])>1){
                //             $query .= " AND `criminal_case`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['subunit_id'])){

                $q = $this->fieldId(
                    $data['subunit_id'],
                    $data['subunit_id_type'],
                    '`subunit_id`',
                    '`criminal_case`.id'
                );
                $query .= $q;

                // $data['subunit_id'] = array_filter($data['subunit_id']);

                // if(!empty($data['subunit_id']) && $data['subunit_id_type'] =='NOT' )
                // {
                //    $query .= " AND subunit_id NOT IN (".implode(',',$data['subunit_id']).")";
                // }

                // if(!empty($data['subunit_id']) && $data['subunit_id_type'] !='NOT'){
                //     $qq = " AND subunit_id IN (".implode(',',$data['subunit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['subunit_id_type'])){
                //         if($data['subunit_id_type'] == 'AND' && count($data['subunit_id'])>1){
                //             $query .= " AND `criminal_case`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['worker_post_id'])){
                $data['worker_post_id'] = array_filter($data['worker_post_id']);

                if(!empty($data['worker_post_id']) && $data['worker_post_id_type'] =='NOT' )
                {
                   $query .= " AND criminal_case_worker_post.worker_post_id NOT IN (".implode(',',$data['worker_post_id']).")";
                }

                if(!empty($data['worker_post_id']) && $data['worker_post_id_type'] !='NOT'){
                    $qq = " AND criminal_case_worker_post.worker_post_id IN (".implode(',',$data['worker_post_id']).") ";
                    $query .= $qq;
                    if(isset($data['worker_post_id_type'])){
                        if($data['worker_post_id_type'] == 'AND' && count($data['worker_post_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT criminal_case_worker_post.worker_post_id) >=".count($data['worker_post_id']);
                        }
                    }
                }
            }

            if(isset($data['character'])){

                $q = $this->searchFieldString($data['character'], $data['character_type'], '`criminal_case`.character');
                $query .= $q;

                // $data['character'] = array_filter($data['character']);
                // if(!empty($data['character'])){
                //     $first = $data['character'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( criminal_case.character LIKE '{$first}') ";
                //     unset($data['character'][0]);
                //     if(!empty($data['character'])){
                //         $op = $data['character_type'];
                //         foreach($data['character'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( criminal_case.character LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['opened_dou'])){

                $q = $this->searchFieldString($data['opened_dou'], $data['opened_dou_type'], '`criminal_case`.opened_dou');
                $query .= $q;

                // $data['opened_dou'] = array_filter($data['opened_dou']);
                // if(!empty($data['opened_dou'])){
                //     $first = $data['opened_dou'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( criminal_case.opened_dou LIKE '{$first}') ";
                //     unset($data['opened_dou'][0]);
                //     if(!empty($data['opened_dou'])){
                //         $op = $data['opened_dou_type'];
                //         foreach($data['opened_dou'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( criminal_case.opened_dou LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(criminal_case.id)';
            $query .= $queryHaving;
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchOrganization($data, $files_flag = false, $files = null){
            $query = " SELECT organization.* , country.name AS country, organization_category.name AS category, country_ate.name AS country_ate, agency.name AS agency
                FROM organization
                LEFT JOIN country ON country.id = organization.country_id
                LEFT JOIN organization_category ON organization_category.id = organization.category_id
                LEFT JOIN country_ate ON country_ate.id = organization.country_ate_id
                LEFT JOIN agency ON agency.id = organization.agency_id
                LEFT JOIN organization_has_bibliography ON organization_has_bibliography.organization_id = organization.id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = organization_has_bibliography.bibliography_id
                WHERE 1=1 ";

            if(isset($data['name_organization'])){

                $q = $this->searchFieldString($data['name_organization'], $data['name_organization_type'], '`organization`.name');
                $query .= $q;

                // $data['name_organization'] = array_filter($data['name_organization']);
                // if(!empty($data['name_organization'])){
                //     $first = $data['name_organization'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( organization.name LIKE '{$first}') ";
                //     unset($data['name_organization'][0]);
                //     if(!empty($data['name_organization'])){
                //         $op = $data['name_organization_type'];
                //         foreach($data['name_organization'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( organization.name LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['country_id'])){

                $q = $this->fieldId(
                    $data['country_id'],
                    $data['country_id_type'],
                    '`organization.country_id`',
                    '`organization`.id'
                );
                $query .= $q;

                // $data['country_id'] = array_filter($data['country_id']);

                // if(!empty($data['country_id']) && $data['country_id_type'] =='NOT' )
                // {
                //    $query .= " AND organization.country_id NOT IN (".implode(',',$data['country_id']).")";
                // }

                // if(!empty($data['country_id']) && $data['country_id_type'] !='NOT'){
                //     $qq = " AND organization.country_id IN (".implode(',',$data['country_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['country_id_type'])){
                //         if($data['country_id_type'] == 'AND' && count($data['country_id'])>1){
                //             $query .= " AND `organization`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(strlen(trim($data['reg_date'])) != 0){
                $data['reg_date'] = trim($data['reg_date']);
                $aa = explode('-',$data['reg_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['reg_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND reg_date = '{$data['reg_date']}' ";
            }

            if(isset($data['country_ate_id'])){

                $q = $this->fieldId(
                    $data['country_ate_id'],
                    $data['country_ate_id_type'],
                    '`organization.country_ate_id`',
                    '`organization`.id'
                );
                $query .= $q;

                // $data['country_ate_id'] = array_filter($data['country_ate_id']);

                // if(!empty($data['country_ate_id']) && $data['country_ate_id_type'] =='NOT' )
                // {
                //    $query .= " AND organization.country_ate_id NOT IN (".implode(',',$data['country_ate_id']).")";
                // }

                // if(!empty($data['country_ate_id']) && $data['country_ate_id_type'] !='NOT'){
                //     $qq = " AND organization.country_ate_id IN (".implode(',',$data['country_ate_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['country_ate_id_type'])){
                //         if($data['country_ate_id_type'] == 'AND' && count($data['country_ate_id'])>1){
                //             $query .= " AND `organization`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['category_id'])){

                $q = $this->fieldId(
                    $data['category_id'],
                    $data['category_id_type'],
                    '`organization.category_id`',
                    '`organization`.id'
                );
                $query .= $q;
                // $data['category_id'] = array_filter($data['category_id']);


                // if(!empty($data['category_id']) && $data['category_id_type'] =='NOT' )
                // {
                //    $query .= " AND organization.category_id NOT IN (".implode(',',$data['category_id']).")";
                // }

                // if(!empty($data['category_id']) && $data['category_id_type'] !='NOT'){
                //     $qq = " AND organization.category_id IN (".implode(',',$data['category_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['category_id_type'])){
                //         if($data['category_id_type'] == 'AND' && count($data['category_id'])>1){
                //             $query .= " AND `organization`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['agency_id'])){

                $q = $this->fieldId(
                    $data['agency_id'],
                    $data['agency_id_type'],
                    '`organization.agency_id`',
                    '`organization`.id'
                );
                $query .= $q;

                // $data['agency_id'] = array_filter($data['agency_id']);

                // if(!empty($data['agency_id']) && $data['agency_id_type'] =='NOT' )
                // {
                //    $query .= " AND organization.agency_id NOT IN (".implode(',',$data['agency_id']).")";
                // }

                // if(!empty($data['agency_id']) && $data['agency_id_type'] !='NOT'){
                //     $qq = " AND organization.agency_id IN (".implode(',',$data['agency_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['agency_id_type'])){
                //         if($data['agency_id_type'] == 'AND' && count($data['agency_id'])>1){
                //             $query .= " AND `organization`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['employers_count'])){

                $q = $this->searchFieldString($data['employers_count'], $data['employers_count_type'], '`organization`.employers_count');
                $query .= $q;

                // $data['employers_count'] = array_filter($data['employers_count']);
                // if(!empty($data['employers_count'])){
                //     $first = $data['employers_count'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( organization.employers_count LIKE '{$first}') ";
                //     unset($data['employers_count'][0]);
                //     if(!empty($data['employers_count'])){
                //         $op = $data['employers_count_type'];
                //         foreach($data['employers_count'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( organization.employers_count LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['attension'])){

                $q = $this->searchFieldString($data['attension'], $data['attension_type'], '`organization`.attension');
                $query .= $q;

                // $data['attension'] = array_filter($data['attension']);
                // if(!empty($data['attension'])){
                //     $first = $data['attension'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( organization.attension LIKE '{$first}') ";
                //     unset($data['attension'][0]);
                //     if(!empty($data['attension'])){
                //         $op = $data['attension_type'];
                //         foreach($data['attension'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( organization.attension LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['opened_dou'])){

                $q = $this->searchFieldString($data['opened_dou'], $data['opened_dou_type'], '`organization`.opened_dou');
                $query .= $q;

                // $data['opened_dou'] = array_filter($data['opened_dou']);
                // if(!empty($data['opened_dou'])){
                //     $first = $data['opened_dou'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( organization.opened_dou LIKE '{$first}') ";
                //     unset($data['opened_dou'][0]);
                //     if(!empty($data['opened_dou'])){
                //         $op = $data['opened_dou_type'];
                //         foreach($data['opened_dou'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( organization.opened_dou LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }
            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(organization.id)';
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);
        }

        public function searchEvent($data, $files_flag = false, $files = null){
            $query = " SELECT event.* , aftermath.name AS aftermath,agency.name AS agency, resource.name AS resource ,
                (SELECT GROUP_CONCAT(event_qualification.name) FROM  event_has_qualification
                LEFT JOIN event_qualification ON event_has_qualification.qualification_id = event_qualification.id WHERE event_id = `event`.id GROUP BY(event_id) ) AS qualification
                FROM `event`

                LEFT JOIN event_has_qualification ON event_has_qualification.event_id = event.id
                LEFT JOIN event_qualification ON event_qualification.id = event_has_qualification.qualification_id

                LEFT JOIN aftermath ON aftermath.id = event.aftermath_id
                LEFT JOIN agency ON agency.id = event.agency_id
                LEFT JOIN resource ON resource.id = event.resource_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = event.bibliography_id
                WHERE 1=1 ";
            $queryHaving = " HAVING 1=1 ";

            if(isset($data['qualification_id'])){
                $data['qualification_id'] = array_filter($data['qualification_id']);

                if(!empty($data['qualification_id']) && $data['qualification_id_type'] =='NOT' )
                {
                   $query .= " AND event_has_qualification.qualification_id NOT IN (".implode(',',$data['qualification_id']).")";
                }

                if(!empty($data['qualification_id']) && $data['qualification_id_type'] !='NOT'){
                    $qq = " AND event_has_qualification.qualification_id IN (".implode(',',$data['qualification_id']).") ";
                    $query .= $qq;
                    if(isset($data['qualification_id_type'])){
                        if($data['qualification_id_type'] == 'AND' && count($data['qualification_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT event_has_qualification.qualification_id) >=".count($data['qualification_id']);
                        }
                    }
                }
            }

            if(strlen(trim($data['date'])) != 0){
                $data['date'] = trim($data['date']);
                $aa = explode('-',$data['date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(date) = '{$data['date']}' ";
            }

            if(isset($data['aftermath_id'])){

                $q = $this->fieldId(
                    $data['aftermath_id'],
                    $data['aftermath_id_type'],
                    '`aftermath_id`',
                    '`event`.id'
                );
                $query .= $q;
                // $data['aftermath_id'] = array_filter($data['aftermath_id']);

                // if(!empty($data['aftermath_id']) && $data['aftermath_id_type'] =='NOT' )
                // {
                //    $query .= " AND aftermath_id NOT IN (".implode(',',$data['aftermath_id']).")";
                // }

                // if(!empty($data['aftermath_id']) && $data['aftermath_id_type'] !='NOT'){
                //     $qq = " AND aftermath_id IN (".implode(',',$data['aftermath_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['aftermath_id_type'])){
                //         if($data['aftermath_id_type'] == 'AND' && count($data['aftermath_id'])>1){
                //             $query .= " AND `event`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['agency_id'])){

                $q = $this->fieldId(
                    $data['agency_id'],
                    $data['agency_id_type'],
                    '`agency_id`',
                    '`event`.id'
                );
                $query .= $q;

                // $data['agency_id'] = array_filter($data['agency_id']);

                // if(!empty($data['agency_id']) && $data['agency_id_type'] =='NOT' )
                // {
                //    $query .= " AND agency_id NOT IN (".implode(',',$data['agency_id']).")";
                // }

                // if(!empty($data['agency_id']) && $data['agency_id_type'] !='NOT'){
                //     $qq = " AND agency_id IN (".implode(',',$data['agency_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['agency_id_type'])){
                //         if($data['agency_id_type'] == 'AND' && count($data['agency_id'])>1){
                //             $query .= " AND `event`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['resource_id'])){

                $q = $this->fieldId(
                    $data['resource_id'],
                    $data['resource_id_type'],
                    '`resource_id`',
                    '`event`.id'
                );
                $query .= $q;

                // $data['resource_id'] = array_filter($data['resource_id']);

                // if(!empty($data['resource_id']) && $data['resource_id_type'] =='NOT' )
                // {
                //    $query .= " AND resource_id NOT IN (".implode(',',$data['resource_id']).")";
                // }

                // if(!empty($data['resource_id']) && $data['resource_id_type'] !='NOT'){
                //     $qq = " AND resource_id IN (".implode(',',$data['resource_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['resource_id_type'])){
                //         if($data['resource_id_type'] == 'AND' && count($data['resource_id'])>1){
                //             $query .= " AND `event`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['result'])){

                $q = $this->searchFieldString($data['result'], $data['result_type'], '`result`');
                $query .= $q;

                // $data['result'] = array_filter($data['result']);
                // if(!empty($data['result'])){
                //     $first = $data['result'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( result LIKE '{$first}') ";
                //     unset($data['result'][0]);
                //     if(!empty($data['result'])){
                //         $op = $data['result_type'];
                //         foreach($data['result'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( result LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(event.id)';
            $query .= $queryHaving;
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchPhone($data, $files_flag = false, $files = null){
            $query = " SELECT phone.* ,

                (SELECT GROUP_CONCAT(`character`.name) FROM man_has_phone
                LEFT JOIN `character` ON man_has_phone.character_id = `character`.id WHERE man_has_phone.phone_id = phone.id
                GROUP BY phone_id) AS character_man ,

                (SELECT GROUP_CONCAT(`character`.name) FROM organization_has_phone
                LEFT JOIN `character` ON organization_has_phone.character_id = `character`.id WHERE organization_has_phone.phone_id = phone.id
                GROUP BY phone_id) AS character_organization

                FROM phone
                LEFT JOIN man_has_phone ON man_has_phone.phone_id = phone.id
                LEFT JOIN organization_has_phone ON organization_has_phone.phone_id = phone.id
                LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man_has_phone.man_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = man_has_bibliography.bibliography_id
                WHERE 1=1 ";

            if(isset($data['character_man_id'])){

                $q = $this->fieldId(
                    $data['character_man_id'],
                    $data['character_man_id_type'],
                    '`man_has_phone.character_id`',
                    '`phone`.id'
                );
                $query .= $q;

                // $data['character_man_id'] = array_filter($data['character_man_id']);

                // if(!empty($data['character_man_id']) && $data['character_man_id_type'] =='NOT' )
                // {
                //    $query .= " AND man_has_phone.character_id NOT IN (".implode(',',$data['character_man_id']).")";
                // }

                // if(!empty($data['character_man_id']) && $data['character_man_id_type'] !='NOT'){
                //     $qq = " AND man_has_phone.character_id IN (".implode(',',$data['character_man_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['character_man_id_type'])){
                //         if($data['character_man_id_type'] == 'AND' && count($data['character_man_id'])>1){
                //             $query .= " AND `phone`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['character_organization_id'])){

                $q = $this->fieldId(
                    $data['character_organization_id'],
                    $data['character_organization_id_type'],
                    '`organization_has_phone.character_id `',
                    '`phone`.id'
                );
                $query .= $q;

                // $data['character_organization_id'] = array_filter($data['character_organization_id']);

                // if(!empty($data['character_organization_id']) && $data['character_organization_id_type'] =='NOT' )
                // {
                //    $query .= " AND organization_has_phone.character_id NOT IN (".implode(',',$data['character_organization_id']).")";
                // }

                // if(!empty($data['character_organization_id']) && $data['character_organization_id_type'] !='NOT'){
                //     $qq = " AND organization_has_phone.character_id IN (".implode(',',$data['character_organization_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['character_organization_id_type'])){
                //         if($data['character_organization_id_type'] == 'AND' && count($data['character_organization_id'])>1){
                //             $query .= " AND `phone`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['number'])){

                $q = $this->searchFieldString($data['number'], $data['number_type'], '`phone`.number');
                $query .= $q;

                // $data['number'] = array_filter($data['number']);
                // if(!empty($data['number'])){
                //     $first = $data['number'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( phone.number LIKE '{$first}') ";
                //     unset($data['number'][0]);
                //     if(!empty($data['number'])){
                //         $op = $data['number_type'];
                //         foreach($data['number'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( phone.number LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['more_data'])){

                $q = $this->searchFieldString($data['more_data'], $data['more_data_type'], '`phone`.more_data');
                $query .= $q;

                // $data['more_data'] = array_filter($data['more_data']);
                // if(!empty($data['more_data'])){
                //     $first = $data['more_data'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( phone.more_data LIKE '{$first}') ";
                //     unset($data['more_data'][0]);
                //     if(!empty($data['more_data'])){
                //         $op = $data['more_data_type'];
                //         foreach($data['more_data'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( phone.more_data LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(phone.id)';
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);
        }

        public function searchEmail($data, $files_flag = false, $files = null){
            $query = " SELECT email.* FROM email
                LEFT JOIN man_has_email ON man_has_email.email_id = email.id
                LEFT JOIN organization_has_email ON organization_has_email.email_id = email.id
                LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man_has_email.man_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = man_has_bibliography.bibliography_id
                WHERE 1=1 ";

            if(isset($data['address'])){

                $q = $this->searchFieldString($data['address'], $data['address_type'], '`email`.address');
                $query .= $q;

                // $data['address'] = array_filter($data['address']);
                // if(!empty($data['address'])){
                //     $first = $data['address'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( email.address LIKE '{$first}') ";
                //     unset($data['address'][0]);
                //     if(!empty($data['address'])){
                //         $op = $data['address_type'];
                //         foreach($data['address'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( email.address LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(email.id)';
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchSignal($data, $files_flag = false, $files = null){
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
                                    (SELECT COUNT(DISTINCT check_date_id) FROM signal_has_check_date WHERE signal_id = `signal`.id) AS check_date_count,
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
                    LEFT JOIN taken_measure ON signal_has_taken_measure.taken_measure_id = taken_measure.id WHERE signal_has_taken_measure.signal_id = signal.id GROUP BY(signal_id) ) AS taken_measure_id,
                    (SELECT GROUP_CONCAT(resource.name) FROM  signal_used_resource
                    LEFT JOIN resource ON signal_used_resource.resource_id = resource.id WHERE signal_used_resource.signal_id = signal.id GROUP BY(signal_id) ) AS resource_id,

                    (SELECT GROUP_CONCAT(DATE_FORMAT(check_date.date,'%d-%m-%Y')) FROM signal_has_check_date
                    LEFT JOIN check_date ON signal_has_check_date.check_date_id = check_date.id WHERE signal_has_check_date.signal_id = signal.id GROUP BY(signal_id) ) AS check_date_id

                    FROM `signal`

                    LEFT JOIN signal_used_resource ON signal_used_resource.signal_id = `signal`.id
                    LEFT JOIN resource AS used_resource ON used_resource.id = signal_used_resource.resource_id

                    LEFT JOIN signal_has_check_date ON signal_has_check_date.signal_id = `signal`.id
                    LEFT JOIN check_date AS `date` ON `date`.id = signal_has_check_date.check_date_id

                    LEFT JOIN signal_has_taken_measure ON signal_has_taken_measure.signal_id = `signal`.id
                    LEFT JOIN taken_measure AS measure ON measure.id = signal_has_taken_measure.taken_measure_id

                    LEFT JOIN signal_qualification ON signal_qualification.id = `signal`.signal_qualification_id
                    LEFT JOIN agency AS check_agency ON check_agency.id = `signal`.check_agency_id
                    LEFT JOIN agency AS check_unit ON check_unit.id = `signal`.check_unit_id
                    LEFT JOIN agency AS check_subunit ON check_subunit.id = `signal`.check_subunit_id
                    LEFT JOIN agency AS opened_agency ON opened_agency.id = `signal`.opened_agency_id
                    LEFT JOIN agency AS opened_unit ON opened_unit.id = `signal`.opened_unit_id
                    LEFT JOIN agency AS opened_subunit ON opened_subunit.id = `signal`.opened_subunit_id
                    LEFT JOIN resource ON resource.id = `signal`.source_resource_id
                    LEFT JOIN signal_result ON signal_result.id = `signal`.signal_result_id
                    LEFT JOIN signal_checking_worker_post ON signal_checking_worker_post.signal_id = `signal`.id
                    LEFT JOIN signal_checking_worker ON signal_checking_worker.signal_id = `signal`.id
                    LEFT JOIN signal_worker_post ON signal_worker_post.signal_id = `signal`.id
                    LEFT JOIN signal_worker ON signal_worker.signal_id = `signal`.id
                    LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = `signal`.bibliography_id
                WHERE 1=1 ";

            $queryHaving = 'HAVING 1=1';

            if(isset($data['reg_num'])){

                $q = $this->searchFieldString($data['reg_num'], $data['reg_num_type'], '`reg_num`');
                $query .= $q;

                // $data['reg_num'] = array_filter($data['reg_num']);
                // if(!empty($data['reg_num'])){
                //     $first = $data['reg_num'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( reg_num LIKE '{$first}') ";
                //     unset($data['reg_num'][0]);
                //     if(!empty($data['reg_num'])){
                //         $op = $data['reg_num_type'];
                //         foreach($data['reg_num'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( reg_num LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['content'])){

                $q = $this->searchFieldString($data['content'], $data['content_type'], '`signal`.content');
                $query .= $q;

                // $data['content'] = array_filter($data['content']);
                // if(!empty($data['content'])){
                //     $first = $data['content'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( signal.content LIKE '{$first}') ";
                //     unset($data['content'][0]);
                //     if(!empty($data['content'])){
                //         $op = $data['content_type'];
                //         foreach($data['content'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( signal.content LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['check_line'])){

                $q = $this->searchFieldString($data['check_line'], $data['check_line_type'], '`check_line`');
                $query .= $q;

                // $data['check_line'] = array_filter($data['check_line']);
                // if(!empty($data['check_line'])){
                //     $first = $data['check_line'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( check_line LIKE '{$first}') ";
                //     unset($data['check_line'][0]);
                //     if(!empty($data['check_line'])){
                //         $op = $data['check_line_type'];
                //         foreach($data['check_line'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( check_line LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['check_status'])){

                $q = $this->searchFieldString($data['check_status'], $data['check_status_type'], '`check_status`');
                $query .= $q;

                // $data['check_status'] = array_filter($data['check_status']);
                // if(!empty($data['check_status'])){
                //     $first = $data['check_status'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( check_status LIKE '{$first}') ";
                //     unset($data['check_status'][0]);
                //     if(!empty($data['check_status'])){
                //         $op = $data['check_status_type'];
                //         foreach($data['check_status'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( check_status LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['signal_qualification_id'])){

                $q = $this->fieldId(
                    $data['signal_qualification_id'],
                    $data['signal_qualification_id_type'],
                    '`signal.signal_qualification_id`',
                    '`signal`.id'
                );
                $query .= $q;

                // $data['signal_qualification_id'] = array_filter($data['signal_qualification_id']);
                // if(!empty($data['signal_qualification_id'])){
                //     $qq = " AND signal.signal_qualification_id IN (".implode(',',$data['signal_qualification_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['signal_qualification_id_type'])){
                //         if($data['signal_qualification_id_type'] == 'AND' && count($data['signal_qualification_id'])>1){
                //             $query .= " AND `signal`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['source_resource_id'])){

                $q = $this->fieldId(
                    $data['source_resource_id'],
                    $data['source_resource_id_type'],
                    '`signal.source_resource_id`',
                    '`signal`.id'
                );
                $query .= $q;

                // $data['source_resource_id'] = array_filter($data['source_resource_id']);
                // if(!empty($data['source_resource_id'])){
                //     $qq = " AND signal.source_resource_id IN (".implode(',',$data['source_resource_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['source_resource_id_type'])){
                //         if($data['source_resource_id_type'] == 'AND' && count($data['source_resource_id'])>1){
                //             $query .= " AND `signal`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['check_unit_id'])){

                $q = $this->fieldId(
                    $data['check_unit_id'],
                    $data['check_unit_id_type'],
                    '`check_unit_id`',
                    '`signal`.id'
                );
                $query .= $q;

                // $data['check_unit_id'] = array_filter($data['check_unit_id']);
                // if(!empty($data['check_unit_id'])){
                //     $qq = " AND check_unit_id IN (".implode(',',$data['check_unit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['check_unit_id_type'])){
                //         if($data['check_unit_id_type'] == 'AND' && count($data['check_unit_id'])>1){
                //             $query .= " AND `signal`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['check_agency_id'])){

                $q = $this->fieldId(
                    $data['check_agency_id'],
                    $data['check_agency_id_type'],
                    '`check_agency_id`',
                    '`signal`.id'
                );
                $query .= $q;

                // $data['check_agency_id'] = array_filter($data['check_agency_id']);
                // if(!empty($data['check_agency_id'])){
                //     $qq = " AND check_agency_id IN (".implode(',',$data['check_agency_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['check_agency_id_type'])){
                //         if($data['check_agency_id_type'] == 'AND' && count($data['check_agency_id'])>1){
                //             $query .= " AND `signal`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['check_subunit_id'])){

                $q = $this->fieldId(
                    $data['check_subunit_id'],
                    $data['check_subunit_id_type'],
                    '`check_subunit_id`',
                    '`signal`.id'
                );
                $query .= $q;

                // $data['check_subunit_id'] = array_filter($data['check_subunit_id']);
                // if(!empty($data['check_subunit_id'])){
                //     $qq = " AND check_subunit_id IN (".implode(',',$data['check_subunit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['check_subunit_id_type'])){
                //         if($data['check_subunit_id_type'] == 'AND' && count($data['check_subunit_id'])>1){
                //             $query .= " AND `signal`.id = 0 ";
                //         }
                //     }
                // }
            }

            if(isset($data['worker_post_id'])){

                $data['worker_post_id'] = array_filter($data['worker_post_id']);
                if(!empty($data['worker_post_id'])){

                    ($data['worker_post_id_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND signal_worker_post.worker_post_id $q IN (".implode(',',$data['worker_post_id']).") ";
                    $query .= $qq;
                    if(isset($data['worker_post_id_type']) && $data['worker_post_id_type'] != 'NOT'){
                        if($data['worker_post_id_type'] == 'AND' && count($data['worker_post_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT signal_worker_post.worker_post_id) >= ".count($data['worker_post_id']);
                        }
                    }
                }
            }

            if(strlen(trim($data['subunit_date'])) != 0){
                $data['subunit_date'] = trim($data['subunit_date']);
                $aa = explode('-',$data['subunit_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['subunit_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND subunit_date = '{$data['subunit_date']}' ";
            }

            if(isset($data['checking_worker_post'])){
                $data['checking_worker_post'] = array_filter($data['checking_worker_post']);
                if(!empty($data['checking_worker_post'])){

                    ($data['checking_worker_post_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND signal_checking_worker_post.worker_post_id $q IN (".implode(',',$data['checking_worker_post']).") ";
                    $query .= $qq;
                    if(isset($data['checking_worker_post_type']) && $data['checking_worker_post_type'] != 'NOT'){
                        if($data['checking_worker_post_type'] == 'AND' && count($data['checking_worker_post'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT signal_checking_worker_post.worker_post_id) >= ".count($data['checking_worker_post']);
                        }
                    }
                }

            }

            if(strlen(trim($data['check_date'])) != 0){
                $data['check_date'] = trim($data['check_date']);
                $aa = explode('-',$data['check_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['check_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND check_date = '{$data['check_date']}' ";
            }

            if(strlen(trim($data['check_date_id'])) != 0){
                $data['check_date_id'] = trim($data['check_date_id']);
                $aa = explode('-',$data['check_date_id']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['check_date_id'] = $year.'-'.$month.'-'.$day;
                $query .=" AND `date`.`date` = '{$data['check_date_id']}' ";
            }

            if(strlen(trim($data['end_date'])) != 0){
                $data['end_date'] = trim($data['end_date']);
                $aa = explode('-',$data['end_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['end_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND end_date = '{$data['end_date']}' ";
            }

            if(isset($data['opened_dou'])){

                $q = $this->searchFieldString($data['opened_dou'], $data['opened_dou_type'], '`opened_dou`');
                $query .= $q;

                // $data['opened_dou'] = array_filter($data['opened_dou']);
                // if(!empty($data['opened_dou'])){
                //     $first = $data['opened_dou'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( opened_dou LIKE '{$first}') ";
                //     unset($data['opened_dou'][0]);
                //     if(!empty($data['opened_dou'])){
                //         $op = $data['opened_dou_type'];
                //         foreach($data['opened_dou'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( opened_dou LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['checking_worker'])){
                $data['checking_worker'] = array_filter($data['checking_worker']);
                if(!empty($data['checking_worker'])){
                    $first = $data['checking_worker'][0];
                    $first = trim($first);
                    $first = str_replace('*','%',$first);
                    $first = str_replace('?','_',$first);

                    ($data['checking_worker_type'] == 'NOT' ) ? $q = 'NOT' : $q = '';

                    $qq = " AND $q ( ( signal_checking_worker.worker LIKE '{$first}') ";
                    unset($data['checking_worker'][0]);
                    if(!empty($data['checking_worker'])){
                        $op = $data['checking_worker_type'];
                        foreach($data['checking_worker'] as $val){
                            $val = trim($val);
                            $val = str_replace('*','%',$val);
                            $val = str_replace('?','_',$val);
                            $qq .= " OR ( signal_checking_worker.worker LIKE '{$val}') ";
                        }
                        if($op == 'AND'){
                            $queryHaving .= " AND COUNT(DISTINCT signal_checking_worker.worker) >=".(count($data['checking_worker'])+1);
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }
            }


            if(isset($data['worker'])){
                $data['worker'] = array_filter($data['worker']);
                if(!empty($data['worker'])){
                    $first = $data['worker'][0];
                    $first = trim($first);
                    $first = str_replace('*','%',$first);
                    $first = str_replace('?','_',$first);

                    ($data['worker_type'] == 'NOT' ) ? $q = 'NOT' : $q = '';

                    $qq = " AND $q ( ( signal_worker.worker LIKE '{$first}') ";
                    unset($data['worker'][0]);
                    if(!empty($data['worker'])){
                        $op = $data['worker_type'];
                        foreach($data['worker'] as $val){
                            $val = trim($val);
                            $val = str_replace('*','%',$val);
                            $val = str_replace('?','_',$val);
                            $qq .= " OR ( signal_worker.worker LIKE '{$val}') ";
                        }
                        if($op == 'AND'){
                            $queryHaving .= " AND COUNT(DISTINCT signal_worker.worker) >=".(count($data['worker'])+1);
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }
            }

            if(isset($data['resource_id'])){
                $data['resource_id'] = array_filter($data['resource_id']);
                if(!empty($data['resource_id'])){

                    ($data['resource_id_type'] == 'NOT' ) ? $q = 'NOT' : $q = '';

                    $qq = " AND signal_used_resource.resource_id $q IN (".implode(',',$data['resource_id']).") ";
                    $query .= $qq;
                    if(isset($data['resource_id_type']) && $data['resource_id_type'] != 'NOT'){
                        if($data['resource_id_type'] == 'AND' && count($data['resource_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT signal_used_resource.resource_id) >= ".count($data['resource_id']);
                        }
                    }
                }
            }

            if(isset($data['signal_result_id'])){

                $q = $this->fieldId(
                    $data['signal_result_id'],
                    $data['signal_result_id_type'],
                    '`signal_result_id`',
                    '`signal`.id'
                );
                $query .= $q;

                // $data['signal_result_id'] = array_filter($data['signal_result_id']);
                // if(!empty($data['signal_result_id'])){
                //     $qq = " AND signal_result_id IN (".implode(',',$data['signal_result_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['signal_result_id_type'])){
                //         if($data['signal_result_id_type'] == 'AND' && count($data['signal_result_id'])>1){
                //             $query .= " AND `signal`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['taken_measure_id'])){
                $data['taken_measure_id'] = array_filter($data['taken_measure_id']);
                if(!empty($data['taken_measure_id'])){

                    (isset($data['taken_measure_id_type']) && $data['taken_measure_id_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND signal_has_taken_measure.taken_measure_id $q IN (".implode(',',$data['taken_measure_id']).") ";
                    $query .= $qq;
                    if(isset($data['taken_measure_id_type']) && $data['taken_measure_id_type'] = 'NOT'){
                        if($data['taken_measure_id_type'] == 'AND' && count($data['taken_measure_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT signal_has_taken_measure.taken_measure_id) >= ".count($data['taken_measure_id']);
                        }
                    }
                }
            }

            if(isset($data['opened_agency_id'])){

                $q = $this->fieldId(
                    $data['opened_agency_id'],
                    $data['opened_agency_id_type'],
                    '`opened_agency_id`',
                    '`signal`.id'
                );
                $query .= $q;

                // $data['opened_agency_id'] = array_filter($data['opened_agency_id']);
                // if(!empty($data['opened_agency_id'])){
                //     $qq = " AND opened_agency_id IN (".implode(',',$data['opened_agency_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['opened_agency_id_type'])){
                //         if($data['opened_agency_id_type'] == 'AND' && count($data['opened_agency_id'])>1){
                //             $query .= " AND `signal`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['opened_unit_id'])){

                $q = $this->fieldId(
                    $data['opened_unit_id'],
                    $data['opened_unit_id_type'],
                    '`opened_unit_id`',
                    '`signal`.id'
                );
                $query .= $q;

                // $data['opened_unit_id'] = array_filter($data['opened_unit_id']);
                // if(!empty($data['opened_unit_id'])){
                //     $qq = " AND opened_unit_id IN (".implode(',',$data['opened_unit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['opened_unit_id_type'])){
                //         if($data['opened_unit_id_type'] == 'AND' && count($data['opened_unit_id'])>1){
                //             $query .= " AND `signal`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['opened_subunit_id'])){

                $q = $this->fieldId(
                    $data['opened_subunit_id'],
                    $data['opened_subunit_id_type'],
                    '`opened_subunit_id`',
                    '`signal`.id'
                );
                $query .= $q;

                // $data['opened_subunit_id'] = array_filter($data['opened_subunit_id']);
                // if(!empty($data['opened_subunit_id'])){
                //     $qq = " AND opened_subunit_id IN (".implode(',',$data['opened_subunit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['opened_subunit_id_type'])){
                //         if($data['opened_subunit_id_type'] == 'AND' && count($data['opened_subunit_id'])>1){
                //             $query .= " AND `signal`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['count_days'])){
                $check = false;
                foreach($data['count_days'] as $val){
                    if($val == '0'){
                        $check = true;
                    }
                }
                $data['count_days'] = array_filter($data['count_days']);
                if($check){
                    $data['count_days'][] = 0;
                }
                if(!empty($data['count_days'])){

                    (isset($data['count_days_type']) && $data['count_days_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND count_days $q IN (".implode(',',$data['count_days']).") ";
                    $queryHaving .= $qq;
                    if(isset($data['count_days_type']) && $data['count_days_type'] != 'NOT'){
                        if($data['count_days_type'] == 'AND' && count($data['count_days'])>1){
                            $query .= " AND `signal`.id = 0";
                        }
                    }
                }
            }

            if(isset($data['keep_count'])){
                $check = false;
                foreach($data['keep_count'] as $val){
                    if($val == '0'){
                        $check = true;
                    }
                }
                $data['keep_count'] = array_filter($data['keep_count']);
                if($check){
                    $data['keep_count'][] = 0;
                }
                if(!empty($data['keep_count'])){

                    (isset($data['keep_count_type']) && $data['keep_count_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND keep_count $q IN (".implode(',',$data['keep_count']).") ";
                    $queryHaving .= $qq;
                    if(isset($data['keep_count_type']) && $data['keep_count_type'] != 'NOT'){
                        if($data['keep_count_type'] == 'AND' && count($data['keep_count'])>1){
                            $query .= " AND `signal`.id = 0";
                        }
                    }
                }
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(signal.id)';
            $query .= $queryHaving;
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchKeepSignal($data){
            $query = "  SELECT keep_signal.* , agency.name AS agency, unit.name AS unit, sub_unit.name AS sub_unit,passed_sub_unit.name AS pased_sub_unit,
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
                WHERE 1=1 ";

            $queryHaving = "HAVING 1=1 ";

            if(isset($data['agency_id'])){

                $q = $this->fieldId(
                    $data['agency_id'],
                    $data['agency_id_type'],
                    '`agency_id`',
                    '`keep_signal`.id'
                );
                $query .= $q;

                // $data['agency_id'] = array_filter($data['agency_id']);
                // if(!empty($data['agency_id'])){
                //     $qq = " AND agency_id IN (".implode(',',$data['agency_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['agency_id_type'])){
                //         if($data['agency_id_type'] == 'AND' && count($data['agency_id'])>1){
                //             $query .= " AND `keep_signal`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['unit_id'])){

                $q = $this->fieldId(
                    $data['unit_id'],
                    $data['unit_id_type'],
                    '`unit_id`',
                    '`keep_signal`.id'
                );
                $query .= $q;

                // $data['unit_id'] = array_filter($data['unit_id']);
                // if(!empty($data['unit_id'])){
                //     $qq = " AND unit_id IN (".implode(',',$data['unit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['unit_id_type'])){
                //         if($data['unit_id_type'] == 'AND' && count($data['unit_id'])>1){
                //             $query .= " AND `keep_signal`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['sub_unit_id'])){

                $q = $this->fieldId(
                    $data['sub_unit_id'],
                    $data['sub_unit_id_type'],
                    '`sub_unit_id`',
                    '`keep_signal`.id'
                );
                $query .= $q;

                // $data['sub_unit_id'] = array_filter($data['sub_unit_id']);

                // if(!empty($data['sub_unit_id']) && $data['sub_unit_id_type'] =='NOT' )
                // {
                //    $query .= " AND sub_unit_id NOT IN (".implode(',',$data['sub_unit_id']).")";
                // }

                // if(!empty($data['sub_unit_id']) && $data['sub_unit_id_type'] !='NOT'){
                //     $qq = " AND sub_unit_id IN (".implode(',',$data['sub_unit_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['sub_unit_id_type'])){
                //         if($data['sub_unit_id_type'] == 'AND' && count($data['sub_unit_id'])>1){
                //             $query .= " AND `keep_signal`.id = 0";
                //         }
                //     }
                // }
            }

            if(strlen(trim($data['start_date'])) != 0){
                $data['start_date'] = trim($data['start_date']);
                $aa = explode('-',$data['start_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['start_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND start_date = '{$data['start_date']}' ";
            }

            if(strlen(trim($data['end_date'])) != 0){
                $data['end_date'] = trim($data['end_date']);
                $aa = explode('-',$data['end_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['end_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND end_date = '{$data['end_date']}' ";
            }

            if(strlen(trim($data['pass_date'])) != 0){
                $data['pass_date'] = trim($data['pass_date']);
                $aa = explode('-',$data['pass_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['pass_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND pass_date = '{$data['pass_date']}' ";
            }

            if(isset($data['pased_sub_unit'])){

                $q = $this->fieldId(
                    $data['pased_sub_unit'],
                    $data['pased_sub_unit_type'],
                    '`pased_sub_unit`',
                    '`keep_signal`.id'
                );
                $query .= $q;

                // $data['pased_sub_unit'] = array_filter($data['pased_sub_unit']);

                // if(!empty($data['pased_sub_unit']) && $data['pased_sub_unit_type'] =='NOT' )
                // {
                //    $query .= " AND pased_sub_unit NOT IN (".implode(',',$data['pased_sub_unit']).")";
                // }

                // if(!empty($data['pased_sub_unit']) && $data['pased_sub_unit_type'] !='NOT'){
                //     $qq = " AND pased_sub_unit IN (".implode(',',$data['pased_sub_unit']).") ";
                //     $query .= $qq;
                //     if(isset($data['pased_sub_unit_type'])){
                //         if($data['pased_sub_unit_type'] == 'AND' && count($data['pased_sub_unit'])>1){
                //             $query .= " AND `keep_signal`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['worker'])){
                $data['worker'] = array_filter($data['worker']);
                if(!empty($data['worker'])){
                    $first = $data['worker'][0];
                    $first = trim($first);
                    $first = str_replace('*','%',$first);
                    $first = str_replace('?','_',$first);

                    ($data['worker_type'] == 'NOT') ? $q = 'NOT' : $q = '';

                    $qq = " AND $q ( ( keep_signal_worker.worker LIKE '{$first}') ";
                    unset($data['worker'][0]);
                    if(!empty($data['worker'])){
                        $op = $data['worker_type'];
                        foreach($data['worker'] as $val){
                            $val = trim($val);
                            $val = str_replace('*','%',$val);
                            $val = str_replace('?','_',$val);
                            $qq .= " OR ( signal_worker.worker LIKE '{$val}') ";
                        }
                        if($op == 'AND'){
                            $queryHaving .= " AND COUNT(DISTINCT keep_signal_worker.worker) >=".(count($data['worker'])+1);
                        }
                    }
                    $qq .= " ) ";
                    $query .= $qq;
                }
            }

            if(isset($data['worker_post_id'])){
                $data['worker_post_id'] = array_filter($data['worker_post_id']);

                if(!empty($data['worker_post_id']) && $data['worker_post_id_type'] =='NOT' )
                {
                   $query .= " AND keep_signal_worker_post.worker_post_id NOT IN (".implode(',',$data['worker_post_id']).")";
                }

                if(!empty($data['worker_post_id']) && $data['worker_post_id_type'] !='NOT'){
                    $qq = " AND keep_signal_worker_post.worker_post_id IN (".implode(',',$data['worker_post_id']).") ";
                    $query .= $qq;
                    if(isset($data['worker_post_id_type'])){
                        if($data['worker_post_id_type'] == 'AND' && count($data['worker_post_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT keep_signal_worker_post.worker_post_id) >= ".count($data['worker_post_id']);
                        }
                    }
                }
            }

            $query .= '  GROUP BY(keep_signal.id)';
            $query .= $queryHaving;
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchObjectsRelation($data){
            $query = " SELECT objects_relation.*, relation_type.name AS relation_type_id
                FROM objects_relation
                LEFT JOIN relation_type ON relation_type.id = objects_relation.relation_type_id
                WHERE 1=1  ";

            if(isset($data['relation_type_id'])){
                $data['relation_type_id'] = array_filter($data['relation_type_id']);

                if(!empty($data['relation_type_id']) && $data['relation_type_id_type'] =='NOT' )
                {
                   $query .= " AND relation_type_id NOT IN (".implode(',',$data['relation_type_id']).")";
                }

                if(!empty($data['relation_type_id']) && $data['relation_type_id_type'] !='NOT'){
                    $qq = " AND relation_type_id IN (".implode(',',$data['relation_type_id']).") ";
                    $query .= $qq;
                    if(isset($data['relation_type_id_type'])){
                        if($data['relation_type_id_type'] == 'AND' && count($data['relation_type_id'])>1){
                            $query .= " AND `objects_relation`.id = 0";
                        }
                    }
                }
            }

            $query .= '  GROUP BY(objects_relation.id)';
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);
        }

        public function getUsers(){
            $query = "SELECT users.* FROM users";
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchBibliography($data, $files_flag = false, $files = null){
            $query = " SELECT bibliography.* ,  CONCAT(`users`.first_name, ' ',`users`.last_name) AS user_name , doc_category.name AS doc_category , access_level.name AS access_level ,
                                          source_agency.name AS source_agency_name , from_agency.name AS from_agency_name ,
                                          (SELECT COUNT(DISTINCT file_id) FROM bibliography_has_file WHERE bibliography_id = `bibliography`.id) AS file_count,
                                          (SELECT GROUP_CONCAT(country.name) FROM bibliography_has_country
                                            LEFT JOIN country ON bibliography_has_country.country_id = country.id WHERE bibliography_has_country.bibliography_id = `bibliography`.id
                                            GROUP BY bibliography_id) AS country, bibliography_has_file.file_id AS file_id
                    FROM bibliography
                    LEFT JOIN `users` ON `users`.id = bibliography.user_id

                    LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                    LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                    LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                    LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                    LEFT JOIN bibliography_has_country ON bibliography_has_country.bibliography_id = bibliography.id
                    LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = bibliography.id
                WHERE 1=1 ";

            $queryHaving = " HAVING 1=1 ";

            if(isset($data['user_id'])){
                $imp = '('.implode(',',$data['user_id']).')';
                $query .= " AND user_id IN ".$imp;
            }

            if(isset($data['from_agency_id'])){

                $q = $this->fieldId(
                    $data['from_agency_id'],
                    $data['from_agency_id_type'],
                    '`from_agency_id`',
                    '`bibliography`.id'
                );
                $query .= $q;

                // $data['from_agency_id'] = array_filter($data['from_agency_id']);

                // if(!empty($data['from_agency_id']) && $data['from_agency_id_type'] =='NOT' )
                // {
                //    $query .= " AND from_agency_id NOT IN (".implode(',',$data['from_agency_id']).")";
                // }

                // if(!empty($data['from_agency_id']) && $data['from_agency_id_type'] !='NOT'){
                //     $qq = " AND from_agency_id IN (".implode(',',$data['from_agency_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['from_agency_id_type'])){
                //         if($data['from_agency_id_type'] == 'AND' && count($data['from_agency_id'])>1){
                //             $query .= " AND `bibliography`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['category_id'])){

                $q = $this->fieldId(
                    $data['category_id'],
                    $data['category_id_type'],
                    '`category_id`',
                    '`bibliography`.id'
                );
                $query .= $q;

                // $data['category_id'] = array_filter($data['category_id']);

                // if(!empty($data['category_id']) && $data['category_id_type'] =='NOT' )
                // {
                //    $query .= " AND category_id NOT IN (".implode(',',$data['category_id']).")";
                // }

                // if(!empty($data['category_id']) && $data['category_id_type'] !='NOT'){
                //     $qq = " AND category_id IN (".implode(',',$data['category_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['category_id_type'])){
                //         if($data['category_id_type'] == 'AND' && count($data['category_id'])>1){
                //             $query .= " AND `bibliography`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['access_level_id'])){

                $q = $this->fieldId(
                    $data['access_level_id'],
                    $data['access_level_id_type'],
                    '`access_level_id`',
                    '`bibliography`.id'
                );
                $query .= $q;

                // $data['access_level_id'] = array_filter($data['access_level_id']);

                // if(!empty($data['access_level_id']) && $data['access_level_id_type'] =='NOT' )
                // {
                //    $query .= " AND access_level_id NOT IN (".implode(',',$data['access_level_id']).")";
                // }

                // if(!empty($data['access_level_id']) && $data['access_level_id_type'] !='NOT'){
                //     $qq = " AND access_level_id IN (".implode(',',$data['access_level_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['access_level_id_type'])){
                //         if($data['access_level_id_type'] == 'AND' && count($data['access_level_id'])>1){
                //             $query .= " AND `bibliography`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['source_agency_id'])){

                $q = $this->fieldId(
                    $data['source_agency_id'],
                    $data['source_agency_id_type'],
                    '`source_agency_id`',
                    '`bibliography`.id'
                );
                $query .= $q;

                // $data['source_agency_id'] = array_filter($data['source_agency_id']);

                // if(!empty($data['source_agency_id']) && $data['source_agency_id_type'] =='NOT' )
                // {
                //    $query .= " AND source_agency_id NOT IN (".implode(',',$data['source_agency_id']).")";
                // }

                // if(!empty($data['source_agency_id']) && $data['source_agency_id_type'] !='NOT'){
                //     $qq = " AND source_agency_id IN (".implode(',',$data['source_agency_id']).") ";
                //     $query .= $qq;
                //     if(isset($data['source_agency_id_type'])){
                //         if($data['source_agency_id_type'] == 'AND' && count($data['source_agency_id'])>1){
                //             $query .= " AND `bibliography`.id = 0";
                //         }
                //     }
                // }
            }

            if(isset($data['country_id'])){
                $data['country_id'] = array_filter($data['country_id']);

                if(!empty($data['country_id']) && $data['country_id_type'] =='NOT' )
                {
                   $query .= " AND bibliography_has_country.country_id NOT IN (".implode(',',$data['country_id']).")";
                }

                if(!empty($data['country_id']) && $data['country_id_type'] !='NOT'){
                    $qq = " AND bibliography_has_country.country_id IN (".implode(',',$data['country_id']).") ";
                    $query .= $qq;
                    if(isset($data['country_id_type'])){
                        if($data['country_id_type'] == 'AND' && count($data['country_id'])>1){
                            $queryHaving .= " AND COUNT(DISTINCT bibliography_has_country.country_id) >=".count($data['country_id']);
                        }
                    }
                }
            }

            if(isset($data['worker_name'])){

                $q = $this->searchFieldString($data['worker_name'], $data['worker_name_type'], '`worker_name`');
                $query .= $q;

                // $data['worker_name'] = array_filter($data['worker_name']);
                // if(!empty($data['worker_name'])){
                //     $first = $data['worker_name'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( worker_name LIKE '{$first}') ";
                //     unset($data['worker_name'][0]);
                //     if(!empty($data['worker_name'])){
                //         $op = $data['worker_name_type'];
                //         foreach($data['worker_name'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( worker_name LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['reg_number'])){

                $q = $this->searchFieldString($data['reg_number'], $data['reg_number_type'], '`reg_number`');
                $query .= $q;

                // $data['reg_number'] = array_filter($data['reg_number']);
                // if(!empty($data['reg_number'])){
                //     $first = $data['reg_number'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( reg_number LIKE '{$first}') ";
                //     unset($data['reg_number'][0]);
                //     if(!empty($data['reg_number'])){
                //         $op = $data['reg_number_type'];
                //         foreach($data['reg_number'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( reg_number LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['source_address'])){

                $q = $this->searchFieldString($data['source_address'], $data['source_address_type'], '`source_address`');
                $query .= $q;

                // $data['source_address'] = array_filter($data['source_address']);
                // if(!empty($data['source_address'])){
                //     $first = $data['source_address'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( source_address LIKE '{$first}') ";
                //     unset($data['source_address'][0]);
                //     if(!empty($data['source_address'])){
                //         $op = $data['source_address_type'];
                //         foreach($data['source_address'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( source_address LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['short_desc'])){

                $q = $this->searchFieldString($data['short_desc'], $data['short_desc_type'], '`short_desc`');
                $query .= $q;

                // $data['short_desc'] = array_filter($data['short_desc']);
                // if(!empty($data['short_desc'])){
                //     $first = $data['short_desc'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( short_desc LIKE '{$first}') ";
                //     unset($data['short_desc'][0]);
                //     if(!empty($data['short_desc'])){
                //         $op = $data['short_desc_type'];
                //         foreach($data['short_desc'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( short_desc LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['related_year'])){

                $q = $this->searchFieldString($data['related_year'], $data['related_year_type'], '`related_year`');
                $query .= $q;

                // $data['related_year'] = array_filter($data['related_year']);
                // if(!empty($data['related_year'])){
                //     $first = $data['related_year'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( related_year LIKE '{$first}') ";
                //     unset($data['related_year'][0]);
                //     if(!empty($data['related_year'])){
                //         $op = $data['related_year_type'];
                //         foreach($data['related_year'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( related_year LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['source'])){

                $q = $this->searchFieldString($data['source'], $data['source_type'], '`source`');
                $query .= $q;

                // $data['source'] = array_filter($data['source']);
                // if(!empty($data['source'])){
                //     $first = $data['source'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( source LIKE '{$first}') ";
                //     unset($data['source'][0]);
                //     if(!empty($data['source'])){
                //         $op = $data['source_type'];
                //         foreach($data['source'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( source LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['theme'])){

                $q = $this->searchFieldString($data['theme'], $data['theme_type'], '`theme`');
                $query .= $q;

                // $data['theme'] = array_filter($data['theme']);
                // if(!empty($data['theme'])){
                //     $first = $data['theme'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( theme LIKE '{$first}') ";
                //     unset($data['theme'][0]);
                //     if(!empty($data['theme'])){
                //         $op = $data['theme_type'];
                //         foreach($data['theme'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( theme LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(isset($data['title'])){

                $q = $this->searchFieldString($data['title'], $data['title_type'], '`title`');
                $query .= $q;

                // $data['title'] = array_filter($data['title']);
                // if(!empty($data['title'])){
                //     $first = $data['title'][0];
                //     $first = trim($first);
                //     $first = str_replace('*','%',$first);
                //     $first = str_replace('?','_',$first);
                //     $qq = " AND ( ( title LIKE '{$first}') ";
                //     unset($data['title'][0]);
                //     if(!empty($data['title'])){
                //         $op = $data['title_type'];
                //         foreach($data['title'] as $val){
                //             $val = trim($val);
                //             $val = str_replace('*','%',$val);
                //             $val = str_replace('?','_',$val);
                //             $qq .= " $op ( title LIKE '{$val}') ";
                //         }
                //     }
                //     $qq .= " ) ";
                //     $query .= $qq;
                // }
            }

            if(strlen(trim($data['reg_date'])) != 0){
                $data['reg_date'] = trim($data['reg_date']);
                $aa = explode('-',$data['reg_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['reg_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(reg_date) = '{$data['reg_date']}' ";
            }

            if(strlen(trim($data['created_at'])) != 0){
                $data['created_at'] = trim($data['created_at']);
                $aa = explode('-',$data['created_at']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['created_at'] = $year.'-'.$month.'-'.$day;
                $query .=" AND DATE(bibliography.created_at) = '{$data['created_at']}' ";
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }


            $query .= '  GROUP BY(bibliography.id) ';
            $query .= $queryHaving;
            // $this->_setSql($query);
            // return $this->getAll();
            return DB::select($query);

        }

        public function searchExternalSigns($data, $files_flag = false, $files = null){

            $query = " SELECT
                sign.name AS `name` ,  man_external_sign_has_sign.*
                FROM man_external_sign_has_sign
                LEFT JOIN `sign` ON man_external_sign_has_sign.sign_id = sign.id
                LEFT JOIN man_has_bibliography ON man_has_bibliography.man_id = man_external_sign_has_sign.man_id
                LEFT JOIN bibliography_has_file ON bibliography_has_file.bibliography_id = man_has_bibliography.bibliography_id
                WHERE 1=1
                ";
            if(isset($data['sign_id'])){
                $data['sign_id'] = array_filter($data['sign_id']);

                if(!empty($data['sign_id']) && $data['sign_id_type'] =='NOT' )
                {
                   $query .= " AND man_external_sign_has_sign.sign_id NOT IN (".implode(',',$data['sign_id']).")";
                }

                if(!empty($data['sign_id']) && $data['sign_id_type'] !='NOT'){
                    $qq = " AND man_external_sign_has_sign.sign_id IN (".implode(',',$data['sign_id']).") ";
                    $query .= $qq;
                    if(isset($data['sign_id_type'])){
                        if($data['sign_id_type'] == 'AND' && count($data['sign_id'])>1){
                            $query .= " AND `man_external_sign_has_sign`.id = 0";
                        }
                    }
                }
            }

            if(strlen(trim($data['fixed_date'])) != 0){
                $data['fixed_date'] = trim($data['fixed_date']);
                $aa = explode('-',$data['fixed_date']);
                $year = $aa[2];
                $month = $aa[1];
                $day = $aa[0];
                $data['fixed_date'] = $year.'-'.$month.'-'.$day;
                $query .=" AND fixed_date = '{$data['fixed_date']}' ";
            }

            if (isset($files) && !empty($files)) {
                if (count($files) == 1) {
                    $query .= " AND bibliography_has_file.file_id = {$files[0]} AND bibliography_has_file.bibliography_id IS NOT NULL ";
                } else {
                    $query .= " AND bibliography_has_file.file_id IN (" . implode(',', $files) . " ) AND bibliography_has_file.bibliography_id IS NOT NULL ";
                }
            } elseif ($files_flag) {
                $query .= " AND bibliography_has_file.file_id IN (-1) AND bibliography_has_file.bibliography_id IS NOT NULL ";
            }

            $query .= '  GROUP BY(man_external_sign_has_sign.id)';
            return DB::select($query);
            // $this->_setSql($query);
            // return $this->getAll();
        }


}
