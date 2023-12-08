<?php

class AdminController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
        if($_SESSION['user_type'] != 1){
            header('Location: '.ROOT.'sns/first_page');
            exit;
        }
    }

    public function index()
    {
        try {
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function add($id=null,$data)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $password = md5($_POST['password']);
                $save = array(
                    'username' => $_POST['user_name'],
                    'password' => $password,
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'user_type' => $_POST['user_type']
                );
                if($id == null){
                    $id = $this->_model->add($save);
                    $this->_model->logging('add','user',$id);
                }else{
                    $this->_model->add($save,$id);
                    $this->_model->logging('edit','user',$id);
                }
                header('Location: '.ROOT.'admin/user_list');
            }
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function user_list($check = null)
    {
        try {
            if($check == 'read'){
                $data = $this->_model->readData('user');
                if(isset($data)){
                    for($i=0;$i < count($data);$i++)
                        if($data[$i]['user_type'] == 1){
                            $data[$i]['user_type'] = $this->Lang->type_admin ;
                        }elseif($data[$i]['user_type'] == 2){
                        $data[$i]['user_type'] = $this->Lang->type_editor ;
                        }else{
                        $data[$i]['user_type'] = $this->Lang->type_viewer ;
                        }
                }
                $this->_model->logging('view','user');
                echo json_encode($data);die;
            }
            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'user');
                die;
            }
            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'user');
                $this->_model->logging('delete','user',$data3[0]['id']);
                die;
            }
            $this->_view->set('navigationItem',$this->Lang->user_list);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function edit($id)
    {
        try{
            if(isset($id)){
                $data = $this->_model->UserEdit($id,'user');
                $this->_view->set('data',$data[0]);
                return $this->_view->output('empty');
            }else{
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }

    }

    public function mysql_backup()
    {
        {
            try {
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $this->_model->db_backup();
                    $this->_view->set('download',1);
                    $this->_model->logging('backup');
                }
                $this->_view->set('navigationItem',$this->Lang->mysql_backup);
                return $this->_view->output();
                die;
            } catch (Exception $e) {
                echo "Application error:" . $e->getMessage();
            }
        }
    }

    public function mysql_restore()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $uploaddir = APP_PATH.DS.'temp'.DS;
                $Name = $_FILES['file']['name'][0] ;
                $explode = explode('.', $Name);
                $ext = end($explode);
                if($ext == 'sql'){
                    $Name = 'sql.sql';
                    if(file_exists($uploaddir.$Name)){
                        unlink($uploaddir.$Name);
                    }
                    $uploadfile = $uploaddir . basename($Name);
                    if (move_uploaded_file($_FILES['file']['tmp_name'][0], $uploadfile)) {
                        $sql = file_get_contents($uploaddir.$Name);
                        $decode1 = urldecode($sql);
                        $decode2 = rawurldecode($decode1);
                        $decode3 = base64_decode($decode2);
                        $DUMPFILE_NEW = APP_PATH.DS.'temp'.DS.'sns.sql';
                        $new_file = fopen($DUMPFILE_NEW,'w');
                        fwrite($new_file,$decode3);
                        fclose( $new_file );
                        unlink($uploaddir.$Name);
                        $this->_model->db_restore($DUMPFILE_NEW);
                        $this->_view->set('status','1');
                        $this->_model->logging('restore');
                    } else {
                        echo "file not uploaded";
                    }
                }else{
                    echo 'не правельный файл';
                }
            }
            $this->_view->set('navigationItem',$this->Lang->mysql_import);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function download(){
        $file = (APP_PATH.DS.'temp'.DS.'sns_dev.sql');
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=sns_dev.sql" );
        readfile($file);
        exit;
    }

    //Optimization
    public function optimization()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $data = $this->_model->optimization();
                $this->_view->set('data',$data);
                $this->_view->set('navigationItem',$this->Lang->optimization);
            }
            if(!empty($data)){
                return $this->_view->output('empty');
            }else{
                $this->_view->set('navigationItem',$this->Lang->optimization);
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //Optimization Bibliography
    public function optimization_bibliography()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_bibliography();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','bibliography');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_bibliography_delete($_POST['id']);
                $this->_model->logging('delete','bibliography',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }

    }

    //Optimization Man
    public function optimization_man()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_man();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','man');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_man_delete($_POST['id']);
                $this->_model->logging('delete','man',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //Optimization Organization
    public function optimization_organization()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_organization();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','organization');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_organization_delete($_POST['id']);
                $this->_model->logging('delete','bibliography',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //Optimization Control
    public function optimization_control()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_control();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','control');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_control_delete($_POST['id']);
                $this->_model->logging('delete','control',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //Optimization Mia Summary
    public function optimization_mia_summary()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_mia_summary();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','mia_summary');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_mia_summary_delete($_POST['id']);
                $this->_model->logging('delete','mia_summary',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //Optimization Action
    public function optimization_action()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_action();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','action');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_action_delete($_POST['id']);
                $this->_model->logging('delete','action',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //Optimization Event
    public function optimization_event()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_event();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','event');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_event_delete($_POST['id']);
                $this->_model->logging('delete','event',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //Optimization Criminal Case
    public function optimization_criminal_case()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_criminal_case();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','criminal_case');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_criminal_case_delete($_POST['id']);
                $this->_model->logging('delete','criminal_case',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //Optimization Signal
    public function optimization_signal()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_signal();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','signal');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_signal_delete($_POST['id']);
                $this->_model->logging('delete','signal',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //Optimization Address
    public function optimization_address()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_address();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','address');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_address_delete($_POST['id']);
                $this->_model->logging('delete','address',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    //Optimization Keep Signal
    public function optimization_keep_signal()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_keep_signal();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','keep_signal');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_keep_signal_delete($_POST['id']);
                $this->_model->logging('delete','keep_signal',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function optimization_external_sign()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_external_sign();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','external_sign');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_external_sign_delete($_POST['id']);
                $this->_model->logging('delete','external_sign',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function optimization_man_bean_country()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_man_bean_country();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','man_bean_country');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_man_bean_country_delete($_POST['id']);
                $this->_model->logging('delete','man_bean_country',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function optimization_phone()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_phone();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','phone');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_phone_delete($_POST['id']);
                $this->_model->logging('delete','phone',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //////    optimization for    Email    ////////////////
    public function optimization_email()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_email();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','email');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_email_delete($_POST['id']);
                $this->_model->logging('delete','email',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function optimization_work_activity()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_work_activity();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','organization_has_man');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_work_activity_delete($_POST['id']);
                $this->_model->logging('delete','organization_has_man',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function optimization_objects_relation()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_objects_relation();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','objects_relation');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_objects_relation_delete($_POST['id']);
                $this->_model->logging('delete','objects_relation',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function optimization_car()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_car();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','car');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_car_delete($_POST['id']);
                $this->_model->logging('delete','car',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function optimization_weapon()
    {
        try {
            if(!isset($_POST['id'])){
                $res = $this->_model->optimization_weapon();
                $data = json_encode($res);
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                $this->_view->set('data',$data);
                $this->_model->logging('optimization','weapon');
                return $this->_view->output('empty');
            }else{
                $this->_model->optimization_weapon_delete($_POST['id']);
                $this->_model->logging('delete','weapon',$_POST['id']);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function logging($status = null)
    {
        try {
            if($status == 'read'){
                $data = $this->_model->userLogging($_POST);
                if(isset($data)){
                    for($i=0;$i < count($data);$i++){
                        if($data[$i]['user_type'] == 1){
                            $data[$i]['user_type'] = $this->Lang->type_admin ;
                        }elseif($data[$i]['user_type'] == 2){
                            $data[$i]['user_type'] = $this->Lang->type_editor ;
                        }else{
                            $data[$i]['user_type'] = $this->Lang->type_viewer ;
                        }
                        if(strlen($data[$i]['type']) > 0){
                            switch($data[$i]['type']){
                                case 'add': $data[$i]['type'] = $this->Lang->logging_add;break;
                                case 'login': $data[$i]['type'] = $this->Lang->logging_login;break;
                                case 'logout': $data[$i]['type'] = $this->Lang->logging_logout;break;
                                case 'adv_search': $data[$i]['type'] = $this->Lang->logging_adv_search;break;
                                case 'backup': $data[$i]['type'] = $this->Lang->logging_backup;break;
                                case 'delete': $data[$i]['type'] = $this->Lang->logging_delete;break;
                                case 'edit': $data[$i]['type'] = $this->Lang->logging_edit;break;
                                case 'file_search': $data[$i]['type'] = $this->Lang->logging_file_search;break;
                                case 'fusion': $data[$i]['type'] = $this->Lang->logging_fusion;break;
                                case 'print': $data[$i]['type'] = $this->Lang->logging_print;break;
                                case 'print_joins': $data[$i]['type'] = $this->Lang->logging_print_joins;break;
                                case 'report': $data[$i]['type'] = $this->Lang->logging_report;break;
                                case 'restore': $data[$i]['type'] = $this->Lang->logging_restore;break;
                                case 'search_template': $data[$i]['type'] = $this->Lang->logging_search_template;break;
                                case 'smp_search': $data[$i]['type'] = $this->Lang->logging_smp_search;break;
                                case 'view': $data[$i]['type'] = $this->Lang->logging_view;break;
                                case 'optimization': $data[$i]['type'] = $this->Lang->optimization;break;
                            }
                        }
                        if(strlen($data[$i]['tb_name']) > 0){
                            switch($data[$i]['tb_name']){
                                case 'man': $data[$i]['tb_name'] = $this->Lang->face;break;
                                case 'action': $data[$i]['tb_name'] = $this->Lang->action;break;
                                case 'event': $data[$i]['tb_name'] = $this->Lang->event;break;
                                case 'organization': $data[$i]['tb_name'] = $this->Lang->organization;break;
                                case 'address': $data[$i]['tb_name'] = $this->Lang->address;break;
                                case 'bibliography': $data[$i]['tb_name'] = $this->Lang->bibliography;break;
                                case 'weapon': $data[$i]['tb_name'] = $this->Lang->weapon;break;
                                case 'car': $data[$i]['tb_name'] = $this->Lang->car;break;
                                case 'work_activity': $data[$i]['tb_name'] = $this->Lang->work_activity;break;
                                case 'man_bean_country': $data[$i]['tb_name'] = $this->Lang->man_bean_country;break;
                                case 'signal': $data[$i]['tb_name'] = $this->Lang->signal;break;
                                case 'keep_signal': $data[$i]['tb_name'] = $this->Lang->keep_signal;break;
                                case 'criminal_case': $data[$i]['tb_name'] = $this->Lang->criminal;break;
                                case 'control': $data[$i]['tb_name'] = $this->Lang->control;break;
                                case 'mia_summary': $data[$i]['tb_name'] = $this->Lang->mia_summary;break;
                                case 'user': $data[$i]['tb_name'] = $this->Lang->user;break;
                                case 'objects_relation': $data[$i]['tb_name'] = $this->Lang->relationship_objects;break;
                                case 'sign': $data[$i]['tb_name'] = $this->Lang->external_signs;break;
                                case 'email': $data[$i]['tb_name'] = $this->Lang->email;break;
                                case 'answer': $data[$i]['tb_name'] = $this->Lang->answer;break;
                                case 'phone': $data[$i]['tb_name'] = $this->Lang->telephone;break;
                                case 'agency': $data[$i]['tb_name'] = $this->Lang->bodies_management;break;
                                case 'man_has_weapon': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->weapon;break;
                                case 'man_use_car': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->car;break;
                                case 'signal_has_man': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->signal;break;
                                case 'man_passed_by_signal': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->signal;break;
                                case 'man_has_action': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->action;break;
                                case 'man_has_event': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->event;break;
                                case 'man_has_criminal_case': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->criminal;break;
                                case 'man_has_car': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->car;break;
                                case 'man_has_mia_summary': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->mia_summary;break;
                                case 'man_has_phone': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->telephone;break;
                                case 'man_has_email': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->email;break;
                                case 'organization_has_man': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->organization;break;
                                case 'man_external_sign_has_sign': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->external_signs;break;
                                case 'man_external_sign_has_photo': $data[$i]['tb_name'] = $this->Lang->face.' , '.$this->Lang->external_signs_photo;break;
                                case 'action_has_car': $data[$i]['tb_name'] = $this->Lang->action.' , '.$this->Lang->car;break;
                                case 'action_has_weapon': $data[$i]['tb_name'] = $this->Lang->action.' , '.$this->Lang->weapon;break;
                                case 'action_has_phone': $data[$i]['tb_name'] = $this->Lang->action.' , '.$this->Lang->telephone;break;
                                case 'action_has_organization': $data[$i]['tb_name'] = $this->Lang->action.' , '.$this->Lang->organization;break;
                                case 'event_has_action': $data[$i]['tb_name'] = $this->Lang->event.' , '.$this->Lang->action;break;
                                case 'action_has_man': $data[$i]['tb_name'] = $this->Lang->action.' , '.$this->Lang->face;break;
                                case 'action_has_event': $data[$i]['tb_name'] = $this->Lang->action.' , '.$this->Lang->event;break;
//                                case 'action_has_phone': $data[$i]['tb_name'] = $this->Lang->action.' , '.$this->Lang->telephone;break;
//                                case 'action_has_organization': $data[$i]['tb_name'] = $this->Lang->action.' , '.$this->Lang->organization;break;
                                case 'organization_has_event': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->event;break;
                                case 'organization_has_action': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->action;break;
                                case 'organization_checked_by_signal': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->checking_signal;break;
                                case 'organization_has_criminal_case': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->criminal;break;
                                case 'organization_passes_mia_summary': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->mia_summary;break;
                                case 'organization_has_weapon': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->weapon;break;
                                case 'organization_has_car': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->car;break;
                                case 'organization_has_address': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->address;break;
                                case 'organization_has_phone': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->telephone;break;
                                case 'organization_has_email': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->email;break;
//                                case 'organization_has_man': $data[$i]['tb_name'] = $this->Lang->organization.' , '.$this->Lang->face;break;
                                case 'event_has_weapon': $data[$i]['tb_name'] = $this->Lang->event.' , '.$this->Lang->weapon;break;
                                case 'event_has_car': $data[$i]['tb_name'] = $this->Lang->event.' , '.$this->Lang->car;break;
                                case 'event_has_organization': $data[$i]['tb_name'] = $this->Lang->event.' , '.$this->Lang->organization;break;
                                case 'event_has_man': $data[$i]['tb_name'] = $this->Lang->event.' , '.$this->Lang->face;break;
//                                case 'signal_has_man': $data[$i]['tb_name'] = $this->Lang->signal.' , '.$this->Lang->face;break;
                                case 'criminal_case_has_man': $data[$i]['tb_name'] = $this->Lang->criminal.' , '.$this->Lang->face;break;
                                case 'mia_summary_has_organization': $data[$i]['tb_name'] = $this->Lang->mia_summary.' , '.$this->Lang->organization;break;
//                                case 'man_has_mia_summary': $data[$i]['tb_name'] = $this->Lang->mia_summary.' , '.$this->Lang->face;break;
                            }
                        }
                    }
                }
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countlogging($_POST);
                echo json_encode($forJson);die;
            }elseif($status == 'logging_type'){
                $array = array();
                $array[0] = array('value'=>'login','text'=>$this->Lang->logging_login);
                $array[1] = array('value'=>'logout','text'=>$this->Lang->logging_logout);
                $array[2] = array('value'=>'add','text'=>$this->Lang->logging_add);
                $array[3] = array('value'=>'adv_search','text'=>$this->Lang->logging_adv_search);
                $array[4] = array('value'=>'backup','text'=>$this->Lang->logging_backup);
                $array[5] = array('value'=>'delete','text'=>$this->Lang->logging_delete);
                $array[6] = array('value'=>'edit','text'=>$this->Lang->logging_edit);
                $array[7] = array('value'=>'file_search','text'=>$this->Lang->logging_file_search);
                $array[8] = array('value'=>'fusion','text'=>$this->Lang->logging_fusion);
                $array[9] = array('value'=>'print','text'=>$this->Lang->logging_print);
                $array[10] = array('value'=>'print_joins','text'=>$this->Lang->logging_print_joins);
                $array[11] = array('value'=>'report','text'=>$this->Lang->logging_report);
                $array[12]= array('value'=>'restore','text'=>$this->Lang->logging_restore);
                $array[13] = array('value'=>'search_template','text'=>$this->Lang->logging_search_template);
                $array[14] = array('value'=>'smp_search','text'=>$this->Lang->logging_smp_search);
                $array[15] = array('value'=>'view','text'=>$this->Lang->logging_view);
                $array[16] = array('value'=>'optimization','text'=>$this->Lang->optimization);
                echo json_encode($array);die;
            }elseif($status == 'logging_tb_name'){
                $array = array();
                $array[0] = array('value'=>'man','text'=>$this->Lang->face);
                $array[1] = array('value'=>'action','text'=>$this->Lang->action);
                $array[2] = array('value'=>'event','text'=>$this->Lang->event);
                $array[3] = array('value'=>'organization','text'=>$this->Lang->organization);
                $array[4] = array('value'=>'address','text'=>$this->Lang->address);
                $array[5] = array('value'=>'bibliography','text'=>$this->Lang->bibliography);
                $array[6] = array('value'=>'weapon','text'=>$this->Lang->weapon);
                $array[7] = array('value'=>'car','text'=>$this->Lang->car);
                $array[8] = array('value'=>'work_activity','text'=>$this->Lang->work_activity);
                $array[9] = array('value'=>'man_bean_country','text'=>$this->Lang->man_bean_country);
                $array[10] = array('value'=>'signal','text'=>$this->Lang->signal);
                $array[11] = array('value'=>'keep_signal','text'=>$this->Lang->keep_signal);
                $array[12]= array('value'=>'criminal_case','text'=>$this->Lang->criminal_case);
                $array[13] = array('value'=>'control','text'=>$this->Lang->control);
                $array[14] = array('value'=>'mia_summary','text'=>$this->Lang->mia_summary);
                $array[15] = array('value'=>'user','text'=>$this->Lang->user);
                $array[16] = array('value'=>'objects_relation','text'=>$this->Lang->relationship_objects);
                $array[17] = array('value'=>'sign','text'=>$this->Lang->external_signs);
                $array[18] = array('value'=>'email','text'=>$this->Lang->email);
                $array[19] = array('value'=>'answer','text'=>$this->Lang->answer);
                $array[20] = array('value'=>'phone','text'=>$this->Lang->telephone);
                $array[21] = array('value'=>'agency','text'=>$this->Lang->bodies_management);
                $array[22] = array('value'=>'man_has_weapon','text'=>$this->Lang->face.' , '.$this->Lang->weapon);
                $array[23] = array('value'=>'man_use_car','text'=>$this->Lang->face.' , '.$this->Lang->car.' 1');
                $array[24] = array('value'=>'signal_has_man','text'=>$this->Lang->face.' , '.$this->Lang->signal.' 1');
                $array[25] = array('value'=>'man_passed_by_signal','text'=> $this->Lang->face.' , '.$this->Lang->signal.' 2');
                $array[26] = array('value'=>'man_has_action','text'=> $this->Lang->face.' , '.$this->Lang->action);
                $array[27] = array('value'=>'man_has_event','text'=> $this->Lang->face.' , '.$this->Lang->event);
                $array[28] = array('value'=>'man_has_criminal_case','text'=> $this->Lang->face.' , '.$this->Lang->criminal);
                $array[29] = array('value'=>'man_has_car','text'=> $this->Lang->face.' , '.$this->Lang->car.' 2');
                $array[30] = array('value'=>'man_has_mia_summary','text'=> $this->Lang->face.' , '.$this->Lang->mia_summary);
                $array[31] = array('value'=>'man_has_phone','text'=> $this->Lang->face.' , '.$this->Lang->telephone);
                $array[32] = array('value'=>'man_has_email','text'=> $this->Lang->face.' , '.$this->Lang->email);
                $array[33] = array('value'=>'organization_has_man','text'=> $this->Lang->face.' , '.$this->Lang->organization);
                $array[34] = array('value'=>'man_external_sign_has_sign','text'=> $this->Lang->face.' , '.$this->Lang->external_signs);
                $array[35] = array('value'=>'man_external_sign_has_photo','text'=> $this->Lang->face.' , '.$this->Lang->external_signs_photo);
                $array[36] = array('value'=>'action_has_car','text'=> $this->Lang->action.' , '.$this->Lang->car);
                $array[37] = array('value'=>'action_has_weapon','text'=> $this->Lang->action.' , '.$this->Lang->weapon);
                $array[38] = array('value'=>'action_has_phone','text'=> $this->Lang->action.' , '.$this->Lang->telephone);
                $array[39] = array('value'=>'action_has_organization','text'=> $this->Lang->action.' , '.$this->Lang->organization);
                $array[40] = array('value'=>'event_has_action','text'=> $this->Lang->event.' , '.$this->Lang->action);
                $array[41] = array('value'=>'action_has_man','text'=> $this->Lang->action.' , '.$this->Lang->face);
                $array[42] = array('value'=>'action_has_event','text'=> $this->Lang->action.' , '.$this->Lang->event);
//                $array[43] = array('value'=>'action_has_phone','text'=> $this->Lang->action.' , '.$this->Lang->telephone);
//                $array[44] = array('value'=>'action_has_organization','text'=> $this->Lang->action.' , '.$this->Lang->organization);
                $array[43] = array('value'=>'organization_has_event','text'=> $this->Lang->organization.' , '.$this->Lang->event);
                $array[44] = array('value'=>'organization_has_action','text'=> $this->Lang->organization.' , '.$this->Lang->action);
                $array[45] = array('value'=>'organization_checked_by_signal','text'=> $this->Lang->organization.' , '.$this->Lang->checking_signal);
                $array[46] = array('value'=>'organization_has_criminal_case','text'=> $this->Lang->organization.' , '.$this->Lang->criminal);
                $array[47] = array('value'=>'organization_passes_mia_summary','text'=> $this->Lang->organization.' , '.$this->Lang->mia_summary);
                $array[48] = array('value'=>'organization_has_weapon','text'=> $this->Lang->organization.' , '.$this->Lang->weapon);
                $array[49] = array('value'=>'organization_has_car','text'=> $this->Lang->organization.' , '.$this->Lang->car);
                $array[50] = array('value'=>'organization_has_address','text'=> $this->Lang->organization.' , '.$this->Lang->address);
                $array[51] = array('value'=>'organization_has_phone','text'=> $this->Lang->organization.' , '.$this->Lang->telephone);
                $array[52] = array('value'=>'organization_has_email','text'=> $this->Lang->organization.' , '.$this->Lang->email);
//                $array[55] = array('value'=>'organization_has_man','text'=> $this->Lang->organization.' , '.$this->Lang->face);
                $array[53] = array('value'=>'event_has_weapon','text'=> $this->Lang->event.' , '.$this->Lang->weapon);
                $array[54] = array('value'=>'event_has_car','text'=> $this->Lang->event.' , '.$this->Lang->car);
                $array[55] = array('value'=>'event_has_organization','text'=> $this->Lang->event.' , '.$this->Lang->organization);
                $array[56] = array('value'=>'event_has_man','text'=> $this->Lang->event.' , '.$this->Lang->face);
//                $array[60] = array('value'=>'signal_has_man','text'=> $this->Lang->signal.' , '.$this->Lang->face);
                $array[57] = array('value'=>'criminal_case_has_man','text'=> $this->Lang->criminal.' , '.$this->Lang->face);
                $array[58] = array('value'=>'mia_summary_has_organization','text'=> $this->Lang->mia_summary.' , '.$this->Lang->organization);
//                $array[63] = array('value'=>'man_has_mia_summary','text'=> $this->Lang->mia_summary.' , '.$this->Lang->face);
                $array[59] = array('value'=>'file','text'=> $this->Lang->file);
                echo json_encode($array);die;
            }elseif($status == 'logging_user_type'){
                $array = array();
                $array[0] = array('value'=>'1','text'=>$this->Lang->type_admin);
                $array[1] = array('value'=>'2','text'=>$this->Lang->type_editor);
                $array[2] = array('value'=>'3','text'=>$this->Lang->type_viewer);
                echo json_encode($array);die;
            }else{
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
}