<?php

class AutocompleteModel extends Model
{
    public function readAddress(){
        $query = "SELECT CONCAT_WS( ' ',country.name, city.name,region.name , street.name, locality.name , address.track , address.home_num , address.housing_num , address.apt_num ) AS name ,
                  address.id AS id FROM address
                  LEFT JOIN country ON country.id = address.country_id
                  LEFT JOIN street ON street.id = address.street_id
                  LEFT JOIN locality ON locality.id = address.street_id
                  LEFT JOIN region ON region.id = address.region_id
                  LEFT JOIN city ON city.id = address.city_id
        ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readWorker(){
        $query = "SELECT CONCAT(worker.first_name , ', ' , worker.last_name , ', ' , worker_post.name) AS name , worker.id AS id FROM worker
                  LEFT JOIN worker_post ON worker.worker_post_id = worker_post.id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fancy($tableName){
        $query = "SELECT ".$tableName.".* FROM ".$tableName." ";
        if($tableName == 'locality' || $tableName == 'region' || $tableName == 'street'){
            $query = "SELECT ".$tableName.".* FROM ".$tableName." WHERE country_id = 719 ";
        }
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fancyCheck($tableName , $name){
        $name = trim($name);
        $query = "SELECT id From $tableName WHERE name = '$name' ";
        if($tableName == 'locality' || $tableName == 'region' || $tableName == 'street'){
            $query = "SELECT id From $tableName WHERE name = '$name' AND country_id = '719' ";
        }
        $this->_setSql($query);
        $data = $this->getRow();
        if(empty($data)){
            return false;
        }else{
            return true;
        }
    }

    public function fancySave($tableName,$name){
        $name = trim($name);
        $query = "INSERT INTO `$tableName` SET name = '$name' ";
        if($tableName == 'locality' || $tableName == 'region' || $tableName == 'street'){
            $query = "INSERT INTO `$tableName` SET name = '$name' , country_id = '719' ";
        }
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function fancyWorker(){
        $query = "SELECT worker.id AS id ,worker.first_name AS first_name ,worker.last_name AS last_name ,worker_post.name AS post FROM worker
                  LEFT JOIN worker_post ON worker_post.id = worker.worker_post_id";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function saveStreet($data){
        $query = "INSERT INTO street SET `name` = '{$data['name']}', old_name = '{$data['old_name']}', country_id = 719 ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function fancyStreet(){
        $query = "SELECT street.* FROM street";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function fancySearch($table,$value){
        $value = str_replace('*','.+',$value);
        $value = str_replace('?','.?',$value);
        $query = "SELECT `$table`.* FROM `$table` WHERE ( LOWER(`$table`.name) REGEXP(LOWER('^$value$')) ) = 1 ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getAnswer($id){
        $query = "SELECT text FROM answer WHERE id = '$id' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['text'];
    }

    public function getMoreDataMan($id){
        $query = "SELECT text FROM more_data_man WHERE id = '$id' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['text'];
    }

    public function getMaterialContentAction($id){
        $query = "SELECT content FROM material_content WHERE id = '$id' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['content'];
    }

    public function getContent($id){
        $query = "SELECT content FROM `signal` WHERE id = '$id' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['content'];
    }

    public function getStatus($id){
        $query = "SELECT check_status FROM `signal` WHERE id = '$id' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['check_status'];
    }

    public function getInf($id){
        $query = "SELECT content FROM mia_summary WHERE id = '$id' ";
        $this->_setSql($query);
        $data = $this->getRow();
        return $data['content'];
    }

}


