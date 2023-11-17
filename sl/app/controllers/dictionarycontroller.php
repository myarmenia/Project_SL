<?php

class DictionaryController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function index()
    {
        try {
            echo 'No error';die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function auto_complete_agency()
    {
        try {

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  agency($check = null){
        try {

            if($check == 'read'){
                $data = $this->_model->readAgency();
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateAgency($data2[0]);
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'agency');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('agency',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createAgency($data4[0]);
                }
                die;
            }

            $agencyParent = $this->_model->readAgencyParent();
            $this->_view->set('agencyParent',$agencyParent);
            $this->_view->set('navigationItem',$this->Lang->bodies_management);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  doc_category($check = null , $checkDump = null ){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('doc_category');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'doc_category');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'doc_category');
                die;
            }

            if($check == 'create'){
//                if($checkDump){
//                    die;
//                }
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('doc_category',$data4[0]);
                if($check){
                   var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'doc_category');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->document_category);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  access_level($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('access_level');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'access_level');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'access_level');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('access_level',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'access_level');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->access_level);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  gender($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('gender');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'gender');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'gender');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('gender',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'gender');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->gender);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  nation($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('nation');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'nation');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'nation');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('nation',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'nation');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->nationality);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  country($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('country');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'country');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'country');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('country',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'country');
                }
                die;
            }

            $this->_view->set('navigationItem',$this->Lang->state_affiliation);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  country_ate($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('country_ate');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'country_ate');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'country_ate');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('country_ate',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'country_ate');
                }
                die;
            }
            $this->_view->set('navigationItem',$this->Lang->country_ate);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  language($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('language');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'language');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'language');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('language',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'language');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->languages);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  religion($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('religion');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'religion');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'religion');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('religion',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'religion');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->worship);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  region($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readRegion();
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'region');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'region');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('region',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createRegion($data4[0]);
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->region_local);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }



    public function  locality($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readLocality();
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'locality');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'locality');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('locality',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createLocality($data4[0]);
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->locality_local);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  operation_category($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('operation_category');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'operation_category');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'operation_category');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('operation_category',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'operation_category');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->operational_category);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  party($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('party');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'party');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'party');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('party',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'party');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->party);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  relation_type($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('relation_type');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'relation_type');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'relation_type');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('relation_type',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'relation_type');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->character_link);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  sign($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('sign');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'sign');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'sign');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('sign',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'sign');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->signs);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function  character($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData("`character`");
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],"`character`");
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],"`character`");
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('`character`',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'`character`');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->nature_character);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  car_category($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('car_category');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'car_category');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'car_category');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('car_category',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'car_category');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->car_category);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  car_mark($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('car_mark');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'car_mark');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'car_mark');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('car_mark',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'car_mark');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->car_mark);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  goal($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('goal');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'goal');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'goal');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('goal',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'goal');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->purpose_of_visit);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  action_goal($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('action_goal');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'action_goal');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'action_goal');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('action_goal',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'action_goal');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->purpose_action);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }



    public function  action_qualification($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('action_qualification');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'action_qualification');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'action_qualification');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('action_qualification',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'action_qualification');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->qualifications_fact);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  duration($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('duration');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'duration');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'duration');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('duration',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'duration');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->duration_action);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  terms($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('terms');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'terms');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'terms');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('terms',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'terms');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->terms_actions);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  aftermath($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('aftermath');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'aftermath');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'aftermath');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('aftermath',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'aftermath');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->aftermath);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  event_qualification($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('event_qualification');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'event_qualification');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'event_qualification');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('event_qualification',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'event_qualification');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->qualification_event);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  organization_category($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('organization_category');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'organization_category');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'organization_category');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('organization_category',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'organization_category');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->category_organization);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  signal_qualification($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('signal_qualification');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'signal_qualification');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'signal_qualification');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('signal_qualification',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'signal_qualification');
                }
                die;
            }
//            if($check == 'read'){
//                $data = $this->_model->readData('signal_qualification');
//                echo json_encode($data);die;
//            }
//
//            if($check == 'update'){
//                $data2 = json_decode($_POST['models'],true);
//                $ch = $this->_model->check_signal($data2[0]['old_id']);
//                if($ch){
//                    $this->_model->updateDataSignal($data2[0],'signal_qualification');
//                }else{
//                    $this->_model->createDataSignal($data2[0],'signal_qualification');
//                }
//                die;
//            }
//
//            if($check == 'destroy'){
//                $data3 = json_decode($_POST['models'],true);
//                $this->_model->destroyData($data3[0],'signal_qualification');
//                die;
//            }
//
//            if($check == 'create'){
//                $data4 = json_decode($_POST['models'],true);
//                $check = $this->_model->check('signal_qualification',$data4[0]);
//                if($check){
//                    var_dump($_POST);die;
//                }else{
//                    $this->_model->createDataSignal($data4[0],'signal_qualification');
//                }
//                die;
//            }


            $this->_view->set('navigationItem',$this->Lang->qualifications_signaling);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function  resource($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('resource');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'resource');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'resource');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('resource',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'resource');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->useful_capabilities);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  taken_measure($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('taken_measure');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'taken_measure');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'taken_measure');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('taken_measure',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'taken_measure');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->measures_taken);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  signal_result($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('signal_result');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateSignalResult($data2[0]);
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'signal_result');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('signal_result',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createSignalResult($data4[0]);
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->test_results_signal);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  control_result($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('control_result');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateControlResult($data2[0]);
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'control_result');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('control_result',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createControlResult($data4[0]);
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->results_performance_control);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  education($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('education');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'education');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'education');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('education',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'education');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->educat);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function  street($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readStreet();
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateStreet($data2[0]);
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'street');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('street',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createStreet($data4[0]);
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->street_local);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }





    public function  worker($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('worker');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateWorker($data2[0]);
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'worker');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $this->_model->createWorker($data4[0]);
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->investigation_charged_worker);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function  worker_post($check = null){
        try {
            if($check == 'read'){
                $data = $this->_model->readData('worker_post');
                echo json_encode($data);die;
            }

            if($check == 'update'){
                $data2 = json_decode($_POST['models'],true);
                $this->_model->updateData($data2[0],'worker_post');
                die;
            }

            if($check == 'destroy'){
                $data3 = json_decode($_POST['models'],true);
                $this->_model->destroyData($data3[0],'worker_post');
                die;
            }

            if($check == 'create'){
                $data4 = json_decode($_POST['models'],true);
                $check = $this->_model->check('worker_post',$data4[0]);
                if($check){
                    var_dump($_POST);die;
                }else{
                    $this->_model->createData($data4[0],'worker_post');
                }
                die;
            }


            $this->_view->set('navigationItem',$this->Lang->worker_post);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }










}