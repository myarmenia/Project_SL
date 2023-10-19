<?php

class SnsController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function index($check = null)
    {
        try {
            if($check){
                $response = array();
                if(isset($_SESSION['userId'])){
                    $response['status'] = false;
                }else{
                    $response['status'] = true;
                }
                echo json_encode($response);die;
            }
//            echo (md5('aa'));die;
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $userId = $this->_model->login($_POST);
                if($userId){
                    $_SESSION['userId'] = $userId['id'];
                    $_SESSION['user_type'] = $userId['user_type'];
                    $_SESSION['user_name'] = $userId['first_name'].'&nbsp</br>'.$userId['last_name'].'&nbsp';
                    $this->_model->logging('login');
                    header('Location: '.ROOT.'sns/first_page');
                    exit;
                }
            }

            $this->_view->output('login');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function first_page(){
        try {

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function change($lang){
        try {
            if($lang == 'rus'){
                $_SESSION['lang'] = 'rus';
            }elseif($lang == 'eng'){
                $_SESSION['lang'] = 'eng';
            }else{
                $_SESSION['lang'] = 'arm';
            }

            header('Location: '.ROOT.'sns/first_page');
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function check_session(){
        try {
               $response = array();
               if(isset($_SESSION['userId'])){
                   $response['status'] = false;
               }else{
                   $response['status'] = true;
               }
                echo json_encode($response);die;
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function logout(){
        try {
            $this->_model->logging('logout');
            session_destroy();
            header('Location: '.ROOT.'');
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
}