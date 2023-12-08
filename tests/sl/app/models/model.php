<?php

class Model
{
    protected $_db;
    protected $_sql;

    public function __construct()
    {
        $this->_db = Db::init();
    }

    protected function _setSql($sql)
    {
        $this->_sql = $sql;
    }

    public function getAll($data = null)
    {
        if (!$this->_sql)
        {
            throw new Exception("No SQL query!");
        }

        $sth = $this->_db->prepare($this->_sql);
        $sth->execute($data);
        $d =  $sth->fetchAll();
        if($d){
            foreach($d as $key2=>$val2){
                if(is_array($val2)){
                    foreach($val2 as $key3=>$val3){
                        $val3 = str_replace('&#91;',']',$val3);
                        $val3 = str_replace('&#93;','[',$val3);
                        $val3 = str_replace('&lt;','<',$val3);
                        $val3 = str_replace('&gt;','>',$val3);
                        $val3 = str_replace('&quot;','"',$val3);
                        $val3 = str_replace('&#39;',"'",$val3);
                        $val3 = str_replace('&#41;',')',$val3);
                        $val3 = str_replace('&#40;','(',$val3);
                        $val3 = str_replace('&#123;','{',$val3);
                        $val3 = str_replace('&#125;','}',$val3);
                        $d[$key2][$key3] = $val3;
                    }
                }else{
                    $val2 = str_replace('&#91;',']',$val2);
                    $val2 = str_replace('&#93;','[',$val2);
                    $val2 = str_replace('&lt;','<',$val2);
                    $val2 = str_replace('&gt;','>',$val2);
                    $val2 = str_replace('&quot;','"',$val2);
                    $val2 = str_replace('&#39;',"'",$val2);
                    $val2 = str_replace('&#41;',')',$val2);
                    $val2 = str_replace('&#40;','(',$val2);
                    $val2 = str_replace('&#123;','{',$val2);
                    $val2 = str_replace('&#125;','}',$val2);
                    $d[$key2] = $val2;
                }
            }
        }
        return $d;
    }

    public function getRow($data = null)
    {
        if (!$this->_sql)
        {
            throw new Exception("No SQL query!");
        }

        $sth = $this->_db->prepare($this->_sql);
        $sth->execute($data);
        $d =  $sth->fetch();
        if($d){
            foreach($d as $key2=>$val2){
                    $val2 = str_replace('&#91;',']',$val2);
                    $val2 = str_replace('&#93;','[',$val2);
                    $val2 = str_replace('&lt;','<',$val2);
                    $val2 = str_replace('&gt;','>',$val2);
                    $val2 = str_replace('&quot;','"',$val2);
                    $val2 = str_replace('&#39;',"'",$val2);
                    $val2 = str_replace('&#41;',')',$val2);
                    $val2 = str_replace('&#40;','(',$val2);
                    $val2 = str_replace('&#123;','{',$val2);
                    $val2 = str_replace('&#125;','}',$val2);
                    $d[$key2] = $val2;
            }
        }
        return $d;
    }

    public function run($data = null){
        if (!$this->_sql)
        {
            throw new Exception("No SQL query!");
        }

        $sth = $this->_db->prepare($this->_sql);
        $sth->execute($data);
    }

    public function getId(){
        return $this->_db->lastInsertId();
    }

    public function getUser(){
        $query = "SELECT users.* FROM users WHERE users.id = '" . $_SESSION['userId'] . "' ";
        $this->_setSql($query);
        return $this->getRow();
    }

    public function deleteById($table,$id){
        $query = "DELETE FROM `$table` WHERE id = '$id' ";
        $this->_setSql($query);
        $this->run();
    }

    public function logging($type , $tb_name = null , $tb_id = null , $second_tb_id = null ){
        if($second_tb_id){
            $query = "INSERT INTO log SET user_id = '{$_SESSION['userId']}' , `type` = '$type' , tb_name = '$tb_name' , tb_id = '$tb_id' , second_tb_id = '$second_tb_id' ";
        }elseif($tb_id){
            $query = "INSERT INTO log SET user_id = '{$_SESSION['userId']}' , `type` = '$type' , tb_name = '$tb_name' , tb_id = '$tb_id'  ";
        }elseif($tb_name){
            $query = "INSERT INTO log SET user_id = '{$_SESSION['userId']}' , `type` = '$type' , tb_name = '$tb_name' ";
        }else{
            $query = "INSERT INTO log SET user_id = '{$_SESSION['userId']}' , `type` = '$type' ";
        }
        $this->_setSql($query);
        $this->run();
    }

}