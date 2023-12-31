<?php

class SimplesearchController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function simple_search()
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->simple_search);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_action($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->action);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_action($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchAction($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchAction($_POST, true);
            } else {
                $res = $this->_model->searchAction($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->action);
            $this->_model->logging('smp_search','action');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_control($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->control);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_control($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchControl($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchControl($_POST, true);
            } else {
                $res = $this->_model->searchControl($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->control);
            $this->_model->logging('smp_search','control');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_man($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->face);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $this->_view->set('type',$type);
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_man($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }

            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchMan($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchMan($_POST, true);
            } else {
                $res = $this->_model->searchMan($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->face);
            $this->_model->logging('smp_search','man');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_weapon($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->weapon);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_weapon($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchWeapon($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchWeapon($_POST, true);
            } else {
                $res = $this->_model->searchWeapon($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->weapon);
            $this->_model->logging('smp_search','weapon');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_car($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->car);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_car($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchCar($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchCar($_POST, true);
            } else {
                $res = $this->_model->searchCar($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->car);
            $this->_model->logging('smp_search','car');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_address($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->address);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_address($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchAddress($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchAddress($_POST, true);
            } else {
                $res = $this->_model->searchAddress($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->address);
            $this->_model->logging('smp_search','address');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_work_activity($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->work_activity);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_work_activity($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchWorkActivity($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchWorkActivity($_POST, true);
            } else {
                $res = $this->_model->searchWorkActivity($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->work_activity);
            $this->_model->logging('smp_search','organization_has_man');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_mia_summary($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->mia_summary);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_mia_summary($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['file_content']) && trim($_POST['file_content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['file_content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchMiaSummary($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchMiaSummary($_POST, true);
            } else {
                $res = $this->_model->searchMiaSummary($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->mia_summary);
            $this->_model->logging('smp_search','mia_summary');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_man_bean_country($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->man_bean_country);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_man_bean_country($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }

            $res = $this->_model->searchManBeanCountry($_POST);
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->man_bean_country);
            $this->_model->logging('smp_search','man_bean_country');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_criminal_case($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->criminal);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_criminal_case($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchCriminalCase($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchCriminalCase($_POST, true);
            } else {
                $res = $this->_model->searchCriminalCase($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->criminal);
            $this->_model->logging('smp_search','criminal_case');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_organization($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->organization);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_organization($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchOrganization($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchOrganization($_POST, true);
            } else {
                $res = $this->_model->searchOrganization($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->organization);
            $this->_model->logging('smp_search','organization');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_event($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->event);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_event($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchEvent($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchEvent($_POST, true);
            } else {
                $res = $this->_model->searchEvent($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->event);
            $this->_model->logging('smp_search','event');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_phone($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->telephone);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_phone($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchPhone($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchPhone($_POST, true);
            } else {
                $res = $this->_model->searchPhone($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->telephone);
            $this->_model->logging('smp_search','phone');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_email($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->email);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_email($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchEmail($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchEmail($_POST, true);
            } else {
                $res = $this->_model->searchEmail($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->email);
            $this->_model->logging('smp_search','email');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_signal($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->signal);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_signal($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['file_content']) && trim($_POST['file_content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['file_content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->_model->searchSignal($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchSignal($_POST, true);
            } else {
                $res = $this->_model->searchSignal($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('"null"' , '""' , $data);
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->signal);
            $this->_model->logging('smp_search','signal');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_keep_signal($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->keep_signal);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_keep_signal($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }

            $res = $this->_model->searchKeepSignal($_POST);
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->keep_signal);
            $this->_model->logging('smp_search','keep_signal');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_objects_relation($type = null)
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->relationship_objects);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_objects_relation($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }

            $res = $this->_model->searchObjectsRelation($_POST);
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->relationship_objects);
            $this->_model->logging('smp_search','object_relation');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_bibliography($type = null)
    {
        try {
            $users = $this->_model->getUsers();
            $this->_view->set('users',$users);
            $this->_view->set('navigationItem',$this->Lang->bibliography);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $this->_view->set('type',$type);
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_bibliography($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files)){
                $res = $this->_model->searchBibliography($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchBibliography($_POST, true);
            } else {
                $res = $this->_model->searchBibliography($_POST);
            }

            if($type) {
                if ($res) {
                    $response['status'] = true;
                    $response['data'] = $res;
                } else {
                    $response['status'] = false;
                }
                echo json_encode($response);
                die;
            }

            $data = json_encode($res);
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->bibliography);
            $this->_model->logging('smp_search','bibliography');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }

    }

    public function escapeSolrValue($string)
    {
        $match = array('\\', '+', '-', '&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '?', ':', '"', ';');
        $replace = array('\\\\', '\\+', '\\-', '\\&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\?', '\\:', '\\"', '\\;');
        $string = str_replace($match, $replace, $string);

        return $string;
    }

    public function backEscapedValues($string) {
        $match = array('\\', '+', '-', '&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '?', ':', '"', ';', '*');
        $replace = array('\\\\', '\\+', '\\-', '\\&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\?', '\\:', '\\"', '\\;', '\\*');
        $string = str_replace($replace, $match, $string);

        return $string;
    }

    public function simple_search_external_signs($type = null)
    {
        try {
            $users = $this->_model->getUsers();
            $this->_view->set('users',$users);
            $this->_view->set('navigationItem',$this->Lang->external_signs);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_external_signs($type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files)){
                $res = $this->_model->searchExternalSigns($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->_model->searchExternalSigns($_POST, true);
            } else {
                $res = $this->_model->searchExternalSigns($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            $this->_view->set('navigationItem',$this->Lang->external_signs);
            $this->_model->logging('smp_search','external_sign');
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function solrSearch($content) {
        $content = $this->escapeSolrValue($content);
        $q = "";

        if (strpos($content, '\+')) {
            $q .= '"' . (str_replace('\+', ' ', $content)) . '"';
        }
        elseif (strpos($content, " ") > 0) {
            $word = (explode(' ', $content));
            $keys = array_keys($word);
            foreach ($word as $key => $value) {
                if (trim($value) != '') {
                    $value = trim($value);
                    $length = strlen($value);
                    $value = trim($value);
                    if ($length == 9 && intval($value) > 0) {
                        $phones = $this->format_phone($value);
                        $i = 0;
                        foreach ($phones as $phone) {
                            $q .= "\"" . $phone . "\"";
                            if (sizeof($phones)-1 != $i) {
                                $q .= "OR";
                            }
                            $i++;
                        }
                    } elseif ($length == 6 && intval($value) > 0) {
                        $phones = $this->format_phone_home($value);
                        $i = 0;
                        foreach ($phones as $phone) {
                            $q .= "\"" . $phone . "\"" ;
                            if (sizeof($phones)-1 != $i) {
                                $q .= "OR";
                            }
                            $i++;
                        }
                    } else {
                        $q .= "(" . str_replace('\*', '*', $value) . ")";
                    }
                }
                if ($key != end($keys)) {
                    $q .= "OR";
                }
            }
        } else {
            $q = $content;
        }

        $url = SOLR_URL . "select?indent=on&wt=json&fl=id&rows=10000&q=attr_content:" . urlencode($q);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result=curl_exec ($ch);
        curl_close ($ch);

        $result_json = json_decode($result, true);

        $files = null;
        foreach ($result_json['response']['docs'] as $doc ) {
            $files[] = $doc['id'];
        }

        return $files;
    }

    public function encodeParams($search_params) {
        $encoded = json_encode($search_params);
        $unescaped = preg_replace_callback('/\\\\u(\w{4})/', function ($matches) {
            return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
        }, $encoded);

        return $unescaped;
    }

    function format_phone($phone)
    {
        $numbers = array();
        $phone = preg_replace("/[^0-9]/", "", $phone);

        if(strlen($phone) == 9) {
            array_push($numbers, preg_replace("/([0-9]{5})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{5})([0-9]{2})([0-9]{2})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1 $2/ $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1-$2/ $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1-$2/ $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1 $2/ $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "/$1/ $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "($1) $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "$1 $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{9})/", "$1", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1) $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1) $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1 $2) $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1-$2) $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1 $2) $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1-$2) $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "($1) $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "($1) $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "/$1/ $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "/$1/ $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1 $2) $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1 $2/ $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1 $2/ $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1-$2/ $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1-$2/ $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1-$2) $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1 $2) $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1-$2) $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "$1 $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "$1 $2 $3-$4", $phone));
        }

        return $numbers;
    }

    function format_phone_home($phone)
    {
        $numbers = array();
        $phone = preg_replace("/[^0-9]/", "", $phone);

        if(strlen($phone) == 6) {
            array_push($numbers, preg_replace("/([0-9]{6})/", "$1", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})/", "$1 $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})/", "$1-$2", $phone));
        }

        return $numbers;
    }

}