<?php

class DictionaryModel extends Model
{
    public function readData($tableName){
        $query = "SELECT ".$tableName.".* , id AS old_id FROM ".$tableName;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function updateData($data,$tableName){
        $data['name'] = trim($data['name']);
        $query = "UPDATE ".$tableName." SET   name='".$data['name']."' WHERE id='".$data['id']."' ";
        $this->_setSql($query);
         $this->run();
    }

    public function destroyData($data,$tableName){
        $query = "DELETE FROM ".$tableName." WHERE id='".$data['id']."' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createData($data,$tableName){
        $data['name'] = trim($data['name']);
        $query = "INSERT INTO ".$tableName." SET name='".$data['name']."' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function check($table,$data){
        $query = "SELECT name FROM $table WHERE name = '{$data['name']}' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function readAgencyParent(){
        $query = "SELECT agency_parent.* FROM agency_parent";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function readAgency(){
        $query = "SELECT agency.*
                  FROM agency
                  ";
        $this->_setSql($query);
        $data =  $this->getAll();
        foreach($data as $key=>$val){
            $query = "SELECT `name`, id FROM agency_parent WHERE id = '{$val['parent_id']}' ";
            $this->_setSql($query);
            $parentName = $this->getRow();
            if($parentName){
                $data[$key]['parentName'] = $parentName;
            }else{
                $data[$key]['parentName'] = array('id'=>null,'name'=>'');
            }
        }
        return $data;
    }

    public function updateAgency($data){
        if(!$data['parentName']['id']){
            $data['parentName']['id'] = 'null';
        }
        $data['name'] = trim($data['name']);
        $query = "UPDATE agency SET `name` = '{$data['name']}' , parent_id = ".$data['parentName']['id']." WHERE id = '{$data['id']}' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createAgency($data){
        $data['name'] = trim($data['name']);
        if(empty($data['parentName']['id'])){
            $query = "INSERT INTO  agency SET `name` = '{$data['name']}' ";
        }else{
            $query = "INSERT INTO  agency SET `name` = '{$data['name']}' , parent_id = ".$data['parentName']['id']." ";
        }
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function updateSignalResult($data){
        $data['name'] = trim($data['name']);
        $query = "UPDATE signal_result SET name='".$data['name']."' WHERE id='".$data['id']."' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createSignalResult($data){
        $data['name'] = trim($data['name']);
        $query = "INSERT INTO signal_result SET name='".$data['name']."' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function updateControlResult($data){
        $data['name'] = trim($data['name']);
        $query = "UPDATE control_result SET name='".$data['name']."' WHERE id='".$data['id']."' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createControlResult($data){
        $data['name'] = trim($data['name']);
        $query = "INSERT INTO control_result SET name='".$data['name']."' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }


    public function readStreet(){
        $query = "SELECT * FROM street WHERE country_id = '719' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function updateStreet($data){
        $data['name'] = trim($data['name']);
        $data['old_name'] = trim($data['old_name']);
        $query = "UPDATE street SET name='".$data['name']."', old_name='".$data['old_name']."' WHERE id='".$data['id']."' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createStreet($street){
        $street['name'] = trim($street['name']);
        $street['old_name'] = trim($street['old_name']);
        $query = "INSERT INTO street SET name='{$street['name']}', old_name='{$street['old_name']}', country_id='719' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function updateWorker($data){
        $query = "UPDATE worker SET first_name='".$data['first_name']."', last_name='".$data['last_name']."', title='".$data['title']."' WHERE id='".$data['id']."' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createWorker($data){
        $query = "INSERT INTO worker SET first_name='".$data['first_name']."', last_name='".$data['last_name']."', title='".$data['title']."' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function readRegion(){
        $query = "SELECT * FROM region WHERE country_id = '719' " ;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function createRegion($region){
        $region['name'] = trim($region['name']);
        $query = "INSERT INTO region SET name ='{$region['name']}', country_id ='719'  ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function readLocality(){
        $query = "SELECT * FROM locality WHERE country_id = '719' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function createLocality($locality){
        $query = "INSERT INTO locality SET name='{$locality['name']}', country_id = '719' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function updateDataSignal($data,$tableName){
        $query = "UPDATE ".$tableName." SET  id='".$data['id']."', name='".$data['name']."' WHERE id='".$data['old_id']."' ";
        $this->_setSql($query);
        $this->run();
    }

    public function createDataSignal($data,$tableName){
        $query = "INSERT INTO ".$tableName." SET id = '".$data['id']."' , name='".$data['name']."' ";
        $this->_setSql($query);
        $this->run();
        return $this->getId();
    }

    public function check_signal($id){
        $query = "SELECT * FROM signal_qualification WHERE id = '$id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

}


