<?php

class BibliographyModel extends Model{

    public function createBibliography(){
        $query = "INSERT INTO bibliography SET user_id = '" . $_SESSION["userId"] . "' ";
        $this->_setSql($query);
        $this->run();
        $id =  $this->getId();
        $query = "SELECT id , created_at FROM bibliography WHERE id = '$id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function updateBibl($b_id, $value, $fieldName){
        if($value == 'null'){
            $query = "UPDATE bibliography SET `$fieldName` = null WHERE id = '$b_id' ";
        }else{
            $query = "UPDATE bibliography SET `$fieldName` = '$value' WHERE id = '$b_id' ";
        }
        $this->_setSql($query);
        $this->run();
    }

    public function createNewFile($b_id,$name,$imgName){
        $query = "INSERT INTO file SET `name` = '$imgName' , real_name = '$name' ";
        $this->_setSql($query);
        $this->run();
        $file_id = $this->getId();
        $query = "INSERT INTO bibliography_has_file SET bibliography_id = '$b_id' , file_id = '$file_id' ";
        $this->_setSql($query);
        $this->run();
        return $file_id;
    }

    public function getFileId($offset, $limit){
        $query = "SELECT * FROM file ORDER BY id DESC LIMIT $limit OFFSET $offset";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getBibliography($bId){
        $query = "SELECT bibliography.* , source_agency.name AS source_agency , from_agency.name AS from_agency , doc_category.name AS doc_category,
                        access_level.name AS access_level , country.name AS country
                  FROM bibliography
                  LEFT JOIN agency AS source_agency ON source_agency.id = bibliography.source_agency_id
                  LEFT JOIN agency AS from_agency ON from_agency.id = bibliography.from_agency_id
                  LEFT JOIN doc_category ON doc_category.id = bibliography.category_id
                  LEFT JOIN access_level ON access_level.id = bibliography.access_level_id
                  LEFT JOIN country ON country.id = bibliography.country_id
                  WHERE bibliography.id = '$bId' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getBibliographyHas($bId){
        $query = "(SELECT 'man' AS tb_name , man_id AS id FROM man_has_bibliography WHERE bibliography_id = '$bId')
                  UNION
                 (SELECT 'organization' AS tb_name , organization_id AS id FROM organization_has_bibliography WHERE bibliography_id = '$bId')
                 UNION
                 (SELECT 'event' AS tb_name , `event`.id AS id FROM `event` WHERE `event`.bibliography_id = '$bId')
                 UNION
                 (SELECT 'signal' AS tb_name , `signal`.id AS id FROM `signal` WHERE `signal`.bibliography_id = '$bId')
                 UNION
                 (SELECT 'criminal_case' AS tb_name , criminal_case.id AS id FROM criminal_case WHERE criminal_case.bibliography_id = '$bId' )
                 UNION
                 (SELECT 'action' AS tb_name , `action`.id AS id FROM `action` WHERE `action`.bibliography_id = '$bId' )
                 UNION
                 (SELECT 'control' AS tb_name , control.id AS id FROM control WHERE control.bibliography_id = '$bId')
                 UNION
                 (SELECT 'mia_summary' AS tb_name, mia_summary.id AS id FROM mia_summary WHERE mia_summary.bibliography_id = '$bId')";
//        echo $query;
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getUserById($user_id){
        $query = "SELECT `users`.* FROM `users` WHERE id = '$user_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getBibliographyHasFile($bId){
        $query = "SELECT file.* FROM bibliography_has_file
                  LEFT JOIN file ON file.id = file_id
                  WHERE bibliography_id = '$bId' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getFileName($file_id){
        $query = "SELECT file.* FROM file WHERE id = '$file_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function getFile($file_id){
        $query = "SELECT file.* FROM file WHERE id = '$file_id' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function deleteFile($file_id){
        $query = "DELETE FROM bibliography_has_file WHERE file_id = '$file_id'";
        $this->_setSql($query);
        $this->run();
        $query = "DELETE FROM file WHERE id = '$file_id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function getBibliographyHasCountry($bId){
        $query = "SELECT country.* FROM bibliography_has_country
                  LEFT JOIN country ON bibliography_has_country.country_id = country.id
                  WHERE bibliography_has_country.bibliography_id = '$bId' ";
        $this->_setSql($query);
        return $this->getAll();
    }

    public function getMailCount($bId){
        $query = "SELECT COUNT(man_id) as c FROM man_has_bibliography WHERE bibliography_id = '$bId' ";
        $this->_setSql($query);
        $c = $this->getRow();
        return $c['c'];
    }

    public function getManName($man_id){
        $query = "SELECT          (SELECT GROUP_CONCAT(first_name.first_name) FROM man_has_first_name
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
                                  GROUP BY man_id) AS middle_name
                  FROM man WHERE man.id = '$man_id' ";
        $this->_setSql($query);
        $data =  $this->getRow();
        $result = '';
        if($data){
            if(!empty($data['last_name'])){
                $result .= $data['last_name'].";";
            }
            if(!empty($data['first_name'])){
                $result .= $data['first_name'].";";
            }
            if(!empty($data['middle_name'])){
                $result .= $data['middle_name'].";";
            }
        }
        return $result;
    }

}