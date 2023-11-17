<?php

class OpenController extends Controller {

    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function weapon($status = null , $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readWeapon($_POST);
                $this->_model->logging('view','weapon');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countWeapon($_POST);
                echo json_encode($forJson);die;
            }
            if($status){
                $this->_view->set('other_tb_name',$status);
                if($old_counter){
                    $this->_view->set('old_counter',$old_counter);
                }
                return $this->_view->output('empty');
            }else{
                $this->_view->set('navigationItem',$this->Lang->weapon);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function weaponJoins($weapon_id){
        try {
            $data = $this->_model->weaponJoins($weapon_id);
            $this->_model->logging('view','weapon',$weapon_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function car($status = null, $old_counter = null){
        try {
            if($status == 'read'){
                $data = $this->_model->readCar($_POST);
                $this->_model->logging('view','car');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countCar($_POST);
                echo json_encode($forJson);
                die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->car);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function carJoins($car_id){
        try {
            $data = $this->_model->carJoins($car_id);
            $this->_model->logging('view','car',$car_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function address($status = null , $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readAddress($_POST);
                $this->_model->logging('view','address');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countAddress($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->address);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function addressJoins($address_id){
        try {
            $data = $this->_model->addressJoins($address_id);
            $this->_model->logging('view','address',$address_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function action($status = null , $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readAction($_POST);
                $this->_model->logging('view','action');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countAction($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->action);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function actionJoins($action_id){
        try {
            $data = $this->_model->actionJoins($action_id);
            $this->_model->logging('view','action',$action_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man($status = null , $b_id = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readMan($_POST);
                $this->_model->logging('view','man');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countMan($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    if($b_id){
                        $this->_view->set('b_id',$b_id);
                    }
                    if(isset($_GET['old_counter'])){
                        $this->_view->set('old_counter',$_GET['old_counter']);
                    }
                    $this->_view->set('other_tb_name',$status);
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->face);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function manJoins($man_id){
        try {
            $data = $this->_model->manJoins($man_id);
            $this->_model->logging('view','man',$man_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readSignal($_POST);
                $this->_model->logging('view','signal');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countSignal($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->signal);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signalJoins($signal_id){
        try {
            $data = $this->_model->signalJoins($signal_id);
            $this->_model->logging('view','signal',$signal_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function keep_signal($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readKeepSignal($_POST);
                $this->_model->logging('view','keep_signal');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countKeepSignal($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->keep_signal);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function keepSignalJoins($keep_signal_id){
        try {
            $data = $this->_model->keepSignalJoins($keep_signal_id);
            $this->_model->logging('view','keep_signal',$keep_signal_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function criminal_case($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readCriminalCase($_POST);
                $this->_model->logging('view','criminal_case');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countCriminalCase($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->criminal);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function criminalCaseJoins($criminal_case_id){
        try {
            $data = $this->_model->criminalCaseJoins($criminal_case_id);
            $this->_model->logging('view','criminal_case',$criminal_case_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function control($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readControl($_POST);
                $this->_model->logging('view','control');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countControl($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->control);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function controlJoins($control_id){
        try {
            $data = $this->_model->controlJoins($control_id);
            $this->_model->logging('view','control',$control_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function mia_summary($status = null , $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readMiaSummary($_POST);
                $this->_model->logging('view','mia_summary');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countMiaSummary($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->mia_summary);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function miaSummaryJoins($mia_summary_id){
        try {
            $data = $this->_model->miaSummaryJoins($mia_summary_id);
            $this->_model->logging('view','mia_summary',$mia_summary_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function work_activity($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readWorkActivity($_POST);
                $this->_model->logging('view','work_activity');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countWorkActivity($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->work_activity);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function workActivityJoins($work_activity_id){
        try {
            $data = $this->_model->workActivityJoins($work_activity_id);
            $this->_model->logging('view','work_activity',$work_activity_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_beann_country($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readManBeannCountry($_POST);
                $this->_model->logging('view','man_bean_country');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countManBeannCountry($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->man_bean_country);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function manBeannCountryJoins($man_bean_country_id){
        try {
            $data = $this->_model->manBeannCountryJoins($man_bean_country_id);
            $this->_model->logging('view','man_bean_country',$man_bean_country_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function bibliography($status = null , $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readBibliography($_POST);
                $this->_model->logging('view','bibliography');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countBibliography($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->bibliography);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function bibliographyJoins($bibliography_id){
        try {
            $data = $this->_model->bibliographyJoins($bibliography_id);
            $this->_model->logging('view','bibliography',$bibliography_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function event($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readEvent($_POST);
                $this->_model->logging('view','event');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countEvent($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->event);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function eventJoins($event_id){
        try {
            $data = $this->_model->eventJoins($event_id);
            $this->_model->logging('view','event',$event_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function organization($status = null , $b_id = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readOrganization($_POST);
                $this->_model->logging('view','organization');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countOrganization($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    if($b_id){
                        $this->_view->set('b_id',$b_id);
                    }
                    if(isset($_GET['old_counter'])){
                        $this->_view->set('old_counter',$_GET['old_counter']);
                    }
                    $this->_view->set('other_tb_name',$status);
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->organization);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function organizationJoins($organization_id){
        try {
            $data = $this->_model->organizationJoins($organization_id);
            $this->_model->logging('view','organization',$organization_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function objects_relation($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readObjectsRelation($_POST);
                $this->_model->logging('view','objects_relation');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countObjectsRelation($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->relationship_objects);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function objectsRelationJoins($objects_relation_id){
        try {
            $data = $this->_model->objectsRelationJoins($objects_relation_id);
            $this->_model->logging('view','objects_relation',$objects_relation_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function phone($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readPhone($_POST);
                $this->_model->logging('view','phone');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countPhone($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->telephone);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function phoneJoins($phone_id){
        try {
            $data = $this->_model->phoneJoins($phone_id);
            $this->_model->logging('view','phone',$phone_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function email($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readEmail($_POST);
                $this->_model->logging('view','email');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countEmail($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->email);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function emailJoins($email_id){
        try {
            $data = $this->_model->emailJoins($email_id);
            $this->_model->logging('view','email',$email_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function external_signs($status = null, $old_counter = null ){
        try {
            if($status == 'read'){
                $data = $this->_model->readExternalSigns($_POST);
                $this->_model->logging('view','sign');
                $forJson['data'] = $data;
                $forJson['count'] = $this->_model->countExternalSigns($_POST);
                echo json_encode($forJson);die;
            }else{
                if($status){
                    $this->_view->set('other_tb_name',$status);
                    if($old_counter){
                        $this->_view->set('old_counter',$old_counter);
                    }
                    return $this->_view->output('empty');
                }else{
                    $this->_view->set('navigationItem',$this->Lang->external_signs);
                    return $this->_view->output();
                }
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function externalSignsJoins($sign_id){
        try {
            $data = $this->_model->externalSignsJoins($sign_id);
            $this->_model->logging('view','sign',$sign_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
}

