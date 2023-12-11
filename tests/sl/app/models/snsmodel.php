<?php

class SnsModel extends Model{

    public function login($data){
       
    $data1['username'] = 'admin';
    $data1['password'] = 'admin123456';

        // $query = "SELECT users.* FROM users WHERE users.username = '".$data['username']."' AND users.password = '".md5($data['password'])."' ";
// var_dump(555);
        $query = "SELECT users.* FROM users WHERE users.username = '".$data1['username']."' AND users.password = '".md5($data1['password'])."' ";

        $this->_setSql($query);
        $userId = $this->getRow();
       
        // return 3;
     
        
        
       
        if(empty($userId)){


            return false;
        }else{

           
            return $userId;
        }
    }
}