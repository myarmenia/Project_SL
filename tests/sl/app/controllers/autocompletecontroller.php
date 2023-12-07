<?php

class AutocompleteController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function  address(){
        try {
                $data = $this->_model->readAddress();
                echo json_encode($data);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  worker(){
        try {
            $data = $this->_model->readWorker();
            echo json_encode($data);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fancy($tableName){
        try {
            $data = $this->_model->fancy($tableName);
            $this->_view->set('data',$data);
            $this->_view->set('tableName' , $tableName);
            $this->_view->set('type',$_GET['type']);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            $this->_view->output('login');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fancySave($tableName){
        try {
            $check = $this->_model->fancyCheck($tableName,$_POST['name']);
            if($check){
                $data['status'] = false;
                $data['message'] = "Такая запись уже существует";
                echo json_encode($data);die;
            };
            $newRecord = $this->_model->fancySave($tableName,$_POST['name']);
            $data['status'] = true;
            $data['record'] = $newRecord;
            echo json_encode($data);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fancyWorker($type){
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id['id'] = $this->_model->saveWorker($_POST);
                echo json_encode($id);die;
            }
            $data = $this->_model->fancyWorker();
            $this->_view->set('data',$data);
            $this->_view->set('type',$type);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            $this->_view->output('login');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fancyAddress(){
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id['id'] = $this->_model->saveAddress($_POST);
                echo json_encode($id);die;
            }
            $data = $this->_model->readAddress();
            $this->_view->set('data',$data);
            $this->_view->output('login');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fancyStreet(){
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id['id'] = $this->_model->saveStreet($_POST);
                echo json_encode($id);die;
            }
            $data = $this->_model->fancyStreet();
            $this->_view->set('type',$_GET['type']);
            $this->_view->set('data',$data);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            $this->_view->output('login');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function text($type, $id = null){
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST' ){
                $get_ext = explode('.',$_FILES['text']['name']);
                $ext = end($get_ext);
                if($ext == 'txt'){
                    $data = file_get_contents($_FILES['text']['tmp_name']);
                    $this->_view->set('data',$data);
                }else{
                    $this->_view->set('error',true);
                }
            }
            if($id){
                if($type == 'manAnswer'){
                    $text = $this->_model->getAnswer($id);
                    $this->_view->set('data',$text);
                    $this->_view->set('id',$id);
                }elseif($type == 'man'){
                    $text = $this->_model->getMoreDataMan($id);
                    $this->_view->set('data',$text);
                    $this->_view->set('id',$id);
                }
                elseif($type == 'action'){
                    $text = $this->_model->getMaterialContentAction($id);
                    $this->_view->set('data',$text);
                    $this->_view->set('id',$id);
                }
                elseif($type == 'signalContent'){
                    $text = $this->_model->getContent($id);
                    $this->_view->set('data',$text);
                    $this->_view->set('id',$id);
                }
                elseif($type == 'signalStatus'){
                    $text = $this->_model->getStatus($id);
                    $this->_view->set('data',$text);
                    $this->_view->set('id',$id);
                }
                elseif($type == 'miaInf'){
                    $text = $this->_model->getInf($id);
                    $this->_view->set('data',$text);
                    $this->_view->set('id',$id);
                }
            }
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            $this->_view->set('type',$type);
            $this->_view->output('login');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fancySearch($table){
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $value = $_POST['value'];
            }else{
                $value = $_GET['value'];
            }
            $data = $this->_model->fancySearch($table,$value);
            $this->_view->set('type',$_GET['type']);
            $this->_view->set('data',$data);
            $this->_view->set('value',$value);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            $this->_view->output('login');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


}