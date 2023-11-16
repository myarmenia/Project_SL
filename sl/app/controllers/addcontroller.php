<?php

class AddController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function index()
    {
        try {

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

///////////////////////////////// bibliography has country //////////////////////////////////////
    public function bibliography_has_country($b_id){
        try {
            $this->_model->bibliography_has_country($b_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_bibliography_has_country($b_id,$country_id){
        try {
            $this->_model->delete_bibliography_has_country($b_id,$country_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_beann_country($man_id , $mbc_id = null ){
        try {
            if($mbc_id){
                $mbc = $this->_model->getMBC($mbc_id);
                if(!empty($mbc['entry_date'])){
                    $date2 = explode('-',$mbc['entry_date']);
                    $mbc['entry_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                if(!empty($mbc['exit_date'])){
                    $date2 = explode('-',$mbc['exit_date']);
                    $mbc['exit_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                $this->_view->set('mbc',$mbc);
                $this->_model->logging('edit','man_bean_country',$mbc_id);
            }
            $this->_view->set('man_id',$man_id);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function save_man_bean_country(){
        try {
            if( ($_POST['region_id'])||($_POST['locality_id']) ){
                $region_id = $_POST['region_id'];
                $locality_id = $_POST['locality_id'];
            }else{
                if(strlen(trim($_POST['region']))>0){
                    $region_id = $this->_model->checkRegion($_POST['region']);
                    if(!$region_id){
                        $region_id = $this->_model->createRegion($_POST['region']);
                    }
                }else{
                    $region_id = 'null';
                }
                if(strlen(trim($_POST['locality']))>0){
                    $locality_id = $this->_model->checkLocality($_POST['locality']);
                    if(!$locality_id){
                        $locality_id = $this->_model->createLocality($_POST['locality']);
                    }
                }else{
                    $locality_id = 'null';
                }

            }
//            var_dump($_POST);
            $id = $this->_model->createManBeanCountry($region_id,$locality_id,$_POST);
            $this->_model->logging('add','man_bean_country',$id);
            $forJson['id'] = $id;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_bean_country($mbc_id){
        try {
            $this->_model->deleteById('man_bean_country',$mbc_id);
            $this->_model->logging('delete','man_bean_country',$mbc_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


//////////////////////////////////////// adding man /////////////////////////////
    public function man($b_id , $man_id = null){
        try {
            if($man_id){
                $man = $this->_model->getMan($man_id);
                if(!empty($man['birthday'])){
                    $date2 = explode('-',$man['birthday']);
                    $man['birthday'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                if(!empty($man['start_wanted'])){
                    $date2 = explode('-',$man['start_wanted']);
                    $man['start_wanted'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                if(!empty($man['entry_date'])){
                    $date2 = explode('-',$man['entry_date']);
                    $man['entry_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                if(!empty($man['exit_date'])){
                    $date2 = explode('-',$man['exit_date']);
                    $man['exit_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }

                $check = $this->_model->checkManHasBibliography($b_id,$man_id);
                if(!$check){
                    if($b_id && $b_id != 'null' && $b_id != 'undefined'){
                        $this->_model->createManHasBibl($b_id,$man_id);
                    }
                }

                $man_has_first_name = $this->_model->getManHasFirstName($man_id);
                $man_has_last_name = $this->_model->getManHasLastName($man_id);
                $man_has_middle_name = $this->_model->getManHasMiddleName($man_id);
                $man_name_auto = $this->_model->getManNameAuto($man_id);
                $man_has_passport = $this->_model->getManHasPassport($man_id);
                $man_belongs_country = $this->_model->getManBelongsCountry($man_id);
                $man_knows_language = $this->_model->getManKnowsLanguage($man_id);
                $man_has_address = $this->_model->getManHasAddress($man_id);
                $man_has_phone = $this->_model->getManHasPhone($man_id);
                $man_has_email = $this->_model->getManHasEmail($man_id);
                $more_data_man = $this->_model->getMoreDataMan($man_id);
                $man_has_operation_category = $this->_model->getManHasOperationCategory($man_id);
                $country_search_man = $this->_model->getCountrySearchMan($man_id);
                $man_has_education = $this->_model->getManHasEducation($man_id);
                $man_has_party = $this->_model->getManHasParty($man_id);
                $man_has_work_activity = $this->_model->getManHasWorkActivity($man_id);
                $man_bean_country = $this->_model->getManBeanCountry($man_id);
                $man_external_sign_has_sign = $this->_model->getManExternalSignHasSign($man_id);
                $man_external_sign_has_photo = $this->_model->getManExternalSignHasPhoto($man_id);
                $man_has_nickname = $this->_model->getManHasNickname($man_id);
                $man_has_objects_organization = $this->_model->getManHasObjectsOrganization($man_id);
                $man_has_objects_man = $this->_model->getManHasObjectsMan($man_id);
                $man_has_action = $this->_model->getManHasAction($man_id);
                $man_has_event = $this->_model->getManHasEvent($man_id);
                $man_passed_by_signal = $this->_model->getManPassedBySignal($man_id);
                $man_checked_by_signal = $this->_model->getManCheckedBySignal($man_id);
                $man_has_criminal_case = $this->_model->getManHasCriminalCase($man_id);
                $man_passes_mia_summary = $this->_model->getManPassesMiaSummary($man_id);
                $man_has_car = $this->_model->getManHasCar($man_id);
                $man_has_weapon = $this->_model->getManHasWeapon($man_id);
                $man_use_car = $this->_model->getManUseCar($man_id);
                $man_has_answer = $this->_model->getManHasAnswer($man_id);
                $man_has_file = $this->_model->getManHasFile($man_id);
                $man_own_file = $this->_model->getManOwnFile($man_id);
                $man_to_man = $this->_model->getManToMan($man_id);
                $man_has_bibliography = $this->_model->getManHasBibliography($man_id);
                $this->_view->set('man',$man);
                $this->_view->set('man_has_first_name',$man_has_first_name);
                $this->_view->set('man_has_last_name',$man_has_last_name);
                $this->_view->set('man_has_middle_name',$man_has_middle_name);
                $this->_view->set('man_name_auto',$man_name_auto);
                $this->_view->set('man_has_passport',$man_has_passport);
                $this->_view->set('man_belongs_country',$man_belongs_country);
                $this->_view->set('man_knows_language',$man_knows_language);
                $this->_view->set('man_has_address',$man_has_address);
                $this->_view->set('man_has_phone',$man_has_phone);
                $this->_view->set('man_has_email',$man_has_email);
                $this->_view->set('more_data_man',$more_data_man);
                $this->_view->set('man_has_operation_category',$man_has_operation_category);
                $this->_view->set('country_search_man',$country_search_man);
                $this->_view->set('man_has_education',$man_has_education);
                $this->_view->set('man_has_party',$man_has_party);
                $this->_view->set('man_has_work_activity',$man_has_work_activity);
                $this->_view->set('man_bean_country',$man_bean_country);
                $this->_view->set('man_external_sign_has_sign',$man_external_sign_has_sign);
                $this->_view->set('man_external_sign_has_photo',$man_external_sign_has_photo);
                $this->_view->set('man_has_nickname',$man_has_nickname);
                $this->_view->set('man_has_objects_organization',$man_has_objects_organization);
                $this->_view->set('man_has_objects_man',$man_has_objects_man);
                $this->_view->set('man_has_action',$man_has_action);
                $this->_view->set('man_has_event',$man_has_event);
                $this->_view->set('man_passed_by_signal',$man_passed_by_signal);
                $this->_view->set('man_checked_by_signal',$man_checked_by_signal);
                $this->_view->set('man_has_criminal_case',$man_has_criminal_case);
                $this->_view->set('man_passes_mia_summary',$man_passes_mia_summary);
                $this->_view->set('man_has_car',$man_has_car);
                $this->_view->set('man_has_weapon',$man_has_weapon);
                $this->_view->set('man_use_car',$man_use_car);
                $this->_view->set('man_has_answer',$man_has_answer);
                $this->_view->set('man_has_file',$man_has_file);
                $this->_view->set('man_own_file',$man_own_file);
                $this->_view->set('man_to_man',$man_to_man);
                $this->_view->set('man_has_bibliography',$man_has_bibliography);
                $this->_model->logging('edit','man',$man_id);
            }else{
                $man_id = $this->_model->createMan();
                if($b_id && $b_id != 'null' && $b_id != 'undefined'){
                    $this->_model->createManHasBibl($b_id,$man_id);
                }
                $this->_model->logging('add','man',$man_id);
            }
            $this->_view->set('man_id',$man_id);
            $user = $this->_model->getUser();
            $this->_view->set('user' ,$user);
            if(isset($_GET['other_tb'])){
                $this->_view->set('other_tb_name',$_GET['other_tb']);
            }
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function save_man($man_id){
        try {
            if($_POST['value'] != 'null'){
                if( ($_POST['field'] == 'birthday')||($_POST['field'] == 'start_wanted')
                        ||($_POST['field'] == 'entry_date')||($_POST['field'] == 'exit_date') ){
                    $data = explode('-',$_POST['value']);
                    $year = $data[2];
                    $month = $data[1];
                    $day = $data[0];
                    $_POST['value'] = $year.'-'.$month.'-'.$day;
                }
            }
            $this->_model->updateMan($man_id , $_POST['value'] , $_POST['field']);
            $this->_model->logging('edit','man',$man_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
//////////////////////////////////////  LastName  /////////////////////////////////////////////////////////

    public function last_name_delete($man_id , $last_name_id){
        try {
            $this->_model->deleteManHasLastName($man_id , $last_name_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_last_name($man_id){
        try {

            $last_name = $this->_model->checkManLastName( trim($_POST['value']) );
            if($last_name){
                $this->_model->lastNameSave($man_id,$last_name);
            }else{
                $last_name = $this->_model->createManLastName( trim($_POST['value']) );
                $this->_model->lastNameSave($man_id,$last_name);
            }
            $forJson['id'] = $last_name;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

//////////////////////////////////// adding  firstName  /////////////////////////////////////////////////////////

    public function first_name_delete($man_id , $last_name_id){
        try {
            $this->_model->deleteManHasFirstName($man_id , $last_name_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_first_name($man_id){
        try {

            $first_name = $this->_model->checkManFirstName( trim($_POST['value']) );
            if($first_name){
                $this->_model->firstNameSave($man_id,$first_name);
            }else{
                $first_name = $this->_model->createManFirstName( trim($_POST['value']) );
                $this->_model->firstNameSave($man_id,$first_name);
            }
            $forJson['id'] = $first_name;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////// adding middle name ////////////////////////////////////////////////
    public function middle_name_delete($man_id , $middle_name_id){
        try {
            $this->_model->deleteManHasMiddleName($man_id , $middle_name_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_middle_name($man_id){
        try {

            $middle_name = $this->_model->checkManMiddleName( trim($_POST['value']) );
            if($middle_name){
                $this->_model->middleNameSave($man_id,$middle_name);
            }else{
                $middle_name = $this->_model->createManMiddleName( trim($_POST['value']) );
                $this->_model->middleNameSave($man_id,$middle_name);
            }
            $forJson['id'] = $middle_name;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////// adding passport ////////////////////////////////////////////////
    public function passport_delete($man_id , $passport){
        try {
            $this->_model->deleteManHasPassport($man_id , $passport);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_passport($man_id){
        try {

            $passport_id = $this->_model->checkManPassport( trim($_POST['value']) );
            if($passport_id){
                $this->_model->passportSave($man_id,$passport_id);
            }else{
                $passport_id = $this->_model->createPassport( trim($_POST['value']) );
                $this->_model->passportSave($man_id,$passport_id);
            }
            $forJson['id'] = $passport_id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////// adding nickname ////////////////////////////////////////////////
    public function nickname_delete($man_id , $nickname){
        try {
            $this->_model->deleteManHasNickname($man_id , $nickname);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_nickname($man_id){
        try {

            $nickname = $this->_model->checkManNickname( trim($_POST['value']) );
            if($nickname){
                $this->_model->nicknameSave($man_id,$nickname);
            }else{
                $nickname = $this->_model->createNickname( trim($_POST['value']) );
                $this->_model->nicknameSave($man_id,$nickname);
            }
            $forJson['id'] = $nickname;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////// adding man belongs country //////////////////////////////////////////////////
    public function man_belongs_country($man_id){
        try {
            $this->_model->manBelongsCountry($man_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_belongs_country($man_id,$country_id){
        try {
            $this->_model->delete_man_belongs_country($man_id,$country_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
//////////////////////////////////// adding mans language ////////////////////////////////////////////////////////////
    public function man_has_language($man_id){
        try {
            $this->_model->manHasLanguage($man_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_has_language($man_id,$lang_id){
        try {
            $this->_model->delete_man_has_language($man_id,$lang_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////// adding man education ////////////////////////////////////////
    public function man_education($man_id){
        try {
            $this->_model->manHasEducation($man_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_education($man_id,$education_id){
        try {
            $this->_model->delete_man_has_education($man_id,$education_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////////// adding man party ////////////////////////////////////////////
    public function man_party($man_id){
        try {
            $this->_model->manHasParty($man_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_party($man_id,$party_id){
        try {
            $this->_model->delete_man_has_party($man_id,$party_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////////// adding man search country ////////////////////////////////////////////
    public function country_search_man($man_id){
        try {
            $this->_model->countrySearchMan($man_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_country_search_man($man_id,$party_id){
        try {
            $this->_model->delete_country_search_man($man_id,$party_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////////// adding man operation category ////////////////////////////////////////////
    public function man_operation_category($man_id){
        try {
            $this->_model->manHasOperationCategory($man_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_operation_category($man_id,$id){
        try {
            $this->_model->delete_man_has_operation_category($man_id,$id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
//////////////////////////////////////////// adding man born address ///////////////////////////////////////man_born_address
    public function man_born_address($man_id, $man_address_id){
        try {
            if(isset($_POST['withSave'])){
                if($_POST['field'] == 'region_id'){
                    $region_id = $this->_model->checkRegion($_POST['value']);
                    if($region_id){
                        $_POST['value'] = $region_id;
                    }else{
                        $_POST['value'] = $this->_model->createRegion($_POST['value']);
                    }
                }elseif($_POST['field'] == 'locality_id'){
                    $locality_id = $this->_model->checkLocality($_POST['value']);
                    if($locality_id){
                        $_POST['value'] = $locality_id;
                    }else{
                        $_POST['value'] = $this->_model->createLocality($_POST['value']);
                    }
                }
            }
            if($man_address_id == 0){
                if($_POST['value'] != 'null'){
                    $man_address_id = $this->_model->createManBornAddress($man_id, $_POST['field'], $_POST['value']);
                }else{
                    $man_address_id = 0;
                }
            }else{
                $check_up = true;
                if($_POST['value'] == 'null'){
                    if($_POST['field'] == 'region_id' || $_POST['field'] == 'locality_id'){
                        $check_up = $this->_model->checkManBornAddressUpdate($_POST['field'],$man_address_id , (isset($_POST['ch']) ? '1' : '0') );
                    }
                }
                if($check_up){
                    $this->_model->updateAddress($man_address_id ,$_POST['field'], $_POST['value']);
                }
            }
            $forJson['id'] = $man_address_id;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////////// adding man weapon //////////////////////////////////////////////////
    public function man_has_weapon($man_id,$weapon_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkManHasWeapon($man_id,$weapon_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->manHasWeapon($man_id,$weapon_id);
            $this->_model->logging('add','man_has_weapon',$man_id,$weapon_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_has_weapon($man_id,$weapon_id){
        try {
            $this->_model->delete_man_has_weapon($man_id,$weapon_id);
            $this->_model->logging('delete_joins','man_has_weapon',$man_id,$weapon_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_knowen_man($man_id1,$man_id2){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkManToMan($man_id1,$man_id2);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->manToMan($man_id1,$man_id2);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_knowen_man($man_id1,$man_id2){
        try {
            $this->_model->delete_man_to_man($man_id1,$man_id2);
            $this->_model->logging('delete_joins','man_to_man',$man_id1,$man_id2);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

///////////////////////////////////////////////////////  adding man has address /////////////////////////////////////////////////
    public function man_has_address($man_id,$address_id){
        try {
            $forJson['status'] = true;
            $dataDate['start_date'] = null;
            $dataDate['end_date'] = null;
            if(!empty($_POST['start_date'])){
                $data = explode('-',$_POST['start_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $dataDate['start_date'] = $year.'-'.$month.'-'.$day;
            }
            if(!empty($_POST['end_date'])){
                $data = explode('-',$_POST['end_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $dataDate['end_date'] = $year.'-'.$month.'-'.$day;
            }
            $check = $this->_model->checkManHasAddress($man_id,$address_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->manHasAddress($man_id,$address_id,$dataDate);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_has_address($man_id,$address_id){
        try {
            $this->_model->delete_man_has_address($man_id,$address_id);
            $this->_model->logging('delete_joins','man_has_address',$man_id,$address_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding man use car /////////////////////////////////////////////////////
    public function man_use_car($man_id,$car_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkManUseCar($man_id,$car_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->manUseCar($man_id,$car_id);
            $this->_model->logging('add','man_use_car',$man_id,$car_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_use_car($man_id,$car_id){
        try {
            $this->_model->delete_man_use_car($man_id,$car_id);
            $this->_model->logging('delete_joins','man_use_car',$man_id,$car_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////////// adding man has signal /////////////////////////////////////////////////////
    public function man_has_signal($man_id,$signal_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkSignalHasMan($man_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->signalHasMan($man_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_signal_has_man($man_id,$signal_id){
        try {
            $this->_model->delete_signal_has_man($man_id,$signal_id);
            $this->_model->logging('delete_joins','signal_has_man',$man_id,$signal_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////////// adding man has signal /////////////////////////////////////////////////////
    public function man_passed_by_signal($man_id,$signal_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkManPassedBySignal($man_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->manPassedBySignal($man_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_passed_by_signal($man_id,$signal_id){
        try {
            $this->_model->delete_man_passed_by_signal($man_id,$signal_id);
            $this->_model->logging('delete_joins','man_passed_by_signal',$man_id,$signal_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////////// adding man has action /////////////////////////////////////////////////////
    public function man_has_action($man_id,$action_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkActionHasMan($man_id,$action_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->actionHasMan($man_id,$action_id);
            $this->_model->logging('add','man_has_action',$man_id,$action_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_has_action($man_id,$action_id){
        try {
            $this->_model->delete_action_has_man($man_id,$action_id);
            $this->_model->logging('delete_joins','man_has_action',$man_id,$action_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////////// adding man has event /////////////////////////////////////////////////////
    public function man_has_event($man_id,$event_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkEventHasMan($man_id,$event_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->eventHasMan($man_id,$event_id);
            $this->_model->logging('add','man_has_event',$man_id,$event_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_has_event($man_id,$event_id){
        try {
            $this->_model->delete_event_has_man($man_id,$event_id);
            $this->_model->logging('delete_joins','man_has_event',$man_id,$event_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////////// adding man has criminal case  /////////////////////////////////////////////////////
    public function man_has_criminal_case($man_id,$criminal_case_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkCriminalCaseHasMan($man_id,$criminal_case_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->criminalCaseHasMan($man_id,$criminal_case_id);
            $this->_model->logging('add','man_has_criminal_case',$man_id,$criminal_case_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_has_criminal_case($man_id,$criminal_case_id){
        try {
            $this->_model->delete_man_has_criminal_case($man_id,$criminal_case_id);
            $this->_model->logging('delete_joins','man_has_criminal_case',$man_id,$criminal_case_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

///////////////////////////////////////////////////////////// adding man has car /////////////////////////////////////////////////////
     public function man_has_car($man_id,$car_id){
         try {
             $forJson['status'] = true;
             $check = $this->_model->checkManHasCar($man_id,$car_id);
             if($check){
                 $forJson['status'] = false;
                 echo json_encode($forJson);die;
             }
             $this->_model->manHasCar($man_id,$car_id);
             $this->_model->logging('add','man_has_car',$man_id,$car_id);
             echo json_encode($forJson);die;

         } catch (Exception $e) {
             echo "Application error:" . $e->getMessage();
         }
     }

    public function delete_man_has_car($man_id,$car_id){
        try {
            $this->_model->delete_man_has_car($man_id,$car_id);
            $this->_model->logging('delete_joins','man_has_car',$man_id,$car_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////////////  adding more data man /////////////////////////////////////////////////
    public function more_data_man($man_id, $id = null){
        try {
            if($id == 'undefined'){
                $forJson['id'] = $this->_model->moreDataMan($_POST['data'],$man_id);
            }else{
                $this->_model->updateMoreDataMan($_POST['data'],$id);
                $forJson['id'] = $id;
            }
            $forJson['text'] = substr($_POST['data'],0,20).'...';
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_more_data_man($id){
        try {
            $this->_model->deleteById('more_data_man',$id);
            $this->_model->logging('delete','more_data_man',$id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

///////////////////////////////////////////////////////////// adding man answer //////////////////////////////////////////////////////
     public function man_answer($man_id , $id = null ){
         try {
             if($id == 'undefined'){
                 $forJson['id'] = $this->_model->man_answer($_POST['data'],$man_id);
             }else{
                 $this->_model->updateManAnswer($_POST['data'],$id);
                 $forJson['id'] = $id;
             }
             $forJson['text'] = substr($_POST['data'],0,20).'...';
             echo json_encode($forJson);die;

         } catch (Exception $e) {
             echo "Application error:" . $e->getMessage();
         }
     }
     public function delete_answer($id){
         try {
             $this->_model->deleteById('answer',$id);
             $this->_model->logging('delete','answer',$id);
             die;

         } catch (Exception $e) {
             echo "Application error:" . $e->getMessage();
         }
     }
///////////////////////////////////////////////////////////// adding man has car /////////////////////////////////////////////////////
    public function man_has_mia_summary($man_id,$mia_summary_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkManHasMiaSummary($man_id,$mia_summary_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->manHasMiaSummary($man_id,$mia_summary_id);
            $this->_model->logging('add','man_has_mia_summary',$man_id,$mia_summary_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_has_mia_summary($man_id,$mia_summary_id){
        try {
            $this->_model->delete_man_has_mia_summary($man_id,$mia_summary_id);
            $this->_model->logging('delete_joins','man_has_mia_summary',$man_id,$mia_summary_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////////// adding man has phone /////////////////////////////////////////////////////
    public function man_has_phone($man_id){
        try {
            $forJson['status'] = true;
            $phone_id = $this->_model->createPhone($_POST['phone_number'],$_POST['more_data']);
            $this->_model->manHasPhone($man_id,$phone_id,$_POST['character']);
            $this->_model->logging('add','phone',$phone_id);
            $this->_model->logging('add','man_has_phone',$man_id,$phone_id);
            $forJson['id'] = $phone_id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_has_phone($man_id,$phone_id){
        try {
            $this->_model->delete_man_has_phone($man_id,$phone_id);
            $this->_model->logging('delete_joins','man_has_phone',$man_id,$phone_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////////// adding man has email /////////////////////////////////////////////////////
    public function man_has_email($man_id){
        try {
            $forJson['status'] = true;
            $email_id = $this->_model->createEmail($_POST['email_address']);
            $this->_model->manHasEmail($man_id,$email_id);
            $this->_model->logging('add','email',$email_id);
            $this->_model->logging('edit','man_has_email',$man_id,$email_id);
            $forJson['id'] = $email_id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_has_email($man_id,$email_id){
        try {
            $this->_model->delete_man_has_email($man_id,$email_id);
            $this->_model->logging('delete_joins','man_has_email',$man_id,$email_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

////////////////////////////////////////// adding man_work_activity ///////////////////////////////////////////////
    public function man_has_work_activity($man_id){
        try {
            $forJson['status'] = true;
            $dataDate['start_date'] = null;
            $dataDate['end_date'] = null;
            if(!empty($_POST['start_date'])){
                $data = explode('-',$_POST['start_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $dataDate['start_date'] = $year.'-'.$month.'-'.$day;
            }
            if(!empty($_POST['end_date'])){
                $data = explode('-',$_POST['end_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $dataDate['end_date'] = $year.'-'.$month.'-'.$day;
            }
            $id = $this->_model->organization_has_man($_POST['organization_id'],$man_id,$_POST['title'],$_POST['period'], $dataDate['start_date'] , $dataDate['end_date']);
            $this->_model->logging('add','organization_has_man',$_POST['organization_id'],$man_id);
            $this->_model->logging('add','work_activity',$id);
            $forJson['id'] = $id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_has_work_activity($organization_has_man_id){
        try {
            $this->_model->deleteById('organization_has_man',$organization_has_man_id);
            $this->_model->logging('delete','organization_has_man',$organization_has_man_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////// adding organization objects relation for man /////////////////////////////

    public function man_objects_organization($man_id){
        try {
//            var_dump($_POST);die;
            $forJson['status'] = true;
            $id = $this->_model->objects_relation_save($man_id,$_POST['org_id'],'man','organization',$_POST['relation_id']);
            $this->_model->logging('add','objects_relation',$id);
            $forJson['id'] = $id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////// adding man objects relation for man /////////////////////////////

    public function man_objects_man($man_id){
        try {
//            var_dump($_POST);die;
            $forJson['status'] = true;
            $id = $this->_model->objects_relation_save($man_id,$_POST['man_id'],'man','man',$_POST['relation_id']);
            $this->_model->logging('add','objects_relation',$id);
            $forJson['id'] = $id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
//////////////////////////// end man //////////////////////////////////////
    public function phone($tb_name , $phone_id = null){
        try {
            if($phone_id){
                if($tb_name == 'man_edit'){
                    $edit = $this->_model->getManEditPhone($phone_id,$_GET['other_id']);
                    $this->_view->set('edit',$edit);
                }elseif($tb_name == 'organization_edit'){
                    $edit = $this->_model->getOrganizationEditPhone($phone_id,$_GET['other_id']);
                    $this->_view->set('edit',$edit);
                }elseif($tb_name == 'edit'){
                    $edit = $this->_model->getPhone($phone_id);
                    $this->_view->set('edit',$edit);
                }
                $phone_has = $this->_model->getPhoneHas($phone_id);
                $this->_model->logging('edit','phone',$phone_id);
                $this->_view->set('phone_has',$phone_has);
            }
            $this->_view->set('other_tb_name',$tb_name);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function updateManHasPhone($phone_id ,  $man_id){
        try {
            $this->_model->updateManHasPhone($phone_id ,  $man_id , $_POST);
            $this->_model->logging('edit','man_has_phone',$man_id,$phone_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function updatePhone($phone_id ){
        try {
            $this->_model->updatePhone($phone_id , $_POST);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function updateOrganizationHasPhone($phone_id ,  $org_id){
        try {
            $this->_model->updateOrganizationHasPhone($phone_id ,  $org_id , $_POST);
            $this->_model->logging('edit','organization_has_phone',$org_id,$phone_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function email($tb_name , $email_id = null ){
        try {
            if($email_id){
                $email = $this->_model->getEmail($email_id);
                $email_has = $this->_model->getEmailHas($email_id);
                $this->_view->set('email',$email);
                $this->_view->set('email_has',$email_has);
            }
            $this->_view->set('other_tb_name',$tb_name);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function edit_email( $email_id  ){
        try {
             $this->_model->updateEmail($email_id,$_POST['email_address']);
            $this->_model->logging('edit','email',$email_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////   WEAPON   /////////////////////////////////////////////////////
    public function weapon($other_tb = null , $weapon_id = null){
        try {
            if($weapon_id){
                $weapon = $this->_model->getWeapon($weapon_id);
                $weapon_has = $this->_model->getWeaponHas($weapon_id);
                $this->_view->set('weapon' ,$weapon);
                $this->_view->set('weapon_has' ,$weapon_has);
                $this->_model->logging('edit','weapon',$weapon_id);
            }else{
                $weapon_id = $this->_model->createWeapon();
                $this->_model->logging('add','weapon',$weapon_id);
            }
            $this->_view->set('weapon_id' ,$weapon_id);
            if($other_tb){
                $this->_view->set('other_tb_name',$other_tb);
            }
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function weapon_save($weapon_id){
        try {
            $this->_model->weaponSave($weapon_id,$_POST['value'],$_POST['field']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function weapon_delete($weapon_id){
        try {
            $this->_model->deleteById('weapon',$weapon_id);
            $this->_model->logging('delete','weapon',$weapon_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
//////////////////////////////////////////  end weapon /////////////////////////////////////////

    public function external_signs($man_id , $sign_id = null ){
        try {
            if($sign_id){
                $sign = $this->_model->getManExternalSign($sign_id);
                if(!empty($sign['fixed_date'])){
                    $date2 = explode('-',$sign['fixed_date']);
                    $sign['fixed_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                $this->_view->set('sign',$sign);
            }
            $this->_view->set('man_id',$man_id);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_external_sign_has_sign(){
        try {
            $id = $this->_model->createManExternalSignHasSign($_POST);
            $forJson['id'] = $id;
            $this->_model->logging('add','man_external_sign_has_sign',$_POST['man_id'],$_POST['sign_id']);
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function edit_external_sign($ext_id){
        try {
            $this->_model->updateManExternalSignHasSign($_POST,$ext_id);
            $this->_model->logging('edit','man_external_sign_has_sign',$ext_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_external_sign_has_sign($external_sign_id){
        try {
            $this->_model->deleteById('man_external_sign_has_sign',$external_sign_id);
            $this->_model->logging('delete','man_external_sign_has_sign',$external_sign_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function external_signs_photo($man_id){
        try {
            $this->_view->set('man_id',$man_id);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_external_sign_has_photo(){
        try {
//            var_dump($_POST);die;
            $img = APP_PATH . DS . 'webroot'. DS . 'tmp' . DS .$_POST['real_name'];
            $data =  file_get_contents($img);
            list($width, $height) = getimagesize($img);
            if($width > $height){
                $resolution = $height/$width;
                $newwidth = 300;
                $newheight = round($width*$resolution);
            }else{
                $resolution = $width/$height;
                $newheight = 300;
                $newwidth = round($height*$resolution);
            }
//            $newwidth = 50;
//            $newheight = 50;

            $thumb = imagecreatetruecolor($newwidth, $newheight);
            $source = imagecreatefromstring($data);

            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

            ob_start();
            imagepng($thumb);
            $buffer = ob_get_clean();
            ob_end_clean();
            $thumbNail = base64_encode($buffer);
            $data = base64_encode($data);

//            var_dump($thumbNail);

            $id = $this->_model->createManExternalSignHasPhoto($_POST['man_id'],$data,$thumbNail,$_POST['fixed_date']);
            $this->_model->logging('add','man_external_sign_has_photo',$_POST['man_id'],$id);
            $forJson['id'] = $id;
            unlink($img);
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_man_external_sign_has_photo($external_sign_id){
        try {
            $this->_model->deleteById('man_external_sign_has_photo',$external_sign_id);
            $this->_model->logging('delete','man_external_sign_has_photo',$external_sign_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

//////////////////////////////////////////// adding action  //////////////////////////////////
    public function action($b_id , $action_id = null){
        try {
            if($action_id){
                $action = $this->_model->getAction($action_id);
                if(!empty($action['start_date'])){
                    $newDate = explode(' ',$action['start_date']);
                    $date2 = explode('-',$newDate[0]);
                    $action['start_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                    if($newDate[1] != '00:00:00'){
                        $action['start_time'] = $newDate[1];
                    }
                }
                if(!empty($action['end_date'])){
                    $newDate = explode(' ',$action['end_date']);
                    $date2 = explode('-',$newDate[0]);
                    $action['end_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                    if($newDate[1] != '00:00:00'){
                        $action['end_time'] = $newDate[1];
                    }
                }
                $material_content = $this->_model->getActionHasMaterialContent($action_id);
//                $action_has_address = $this->_model->getActionHasAddress($action_id);
                $action_has_criminal_case = $this->_model->getActionHasCriminalCase($action_id);
                $action_has_signal = $this->_model->getActionHasSignal($action_id);
                $action_has_car = $this->_model->getActionHasCar($action_id);
                $action_has_weapon = $this->_model->getActionHasWeapon($action_id);
                $action_has_phone = $this->_model->getActionHasPhone($action_id);
                $action_has_organization = $this->_model->getActionHasOrganization($action_id);
                $action_event_has_action = $this->_model->getActionEventHasAction($action_id);
                $action_has_man = $this->_model->getActionHasMan($action_id);
                $action_has_event = $this->_model->getActionHasEvent($action_id);
                $action_has_file = $this->_model->getActionHasFile($action_id);
                $action_has_qualification = $this->_model->getActionHasQualification($action_id);
                $action_has_action = $this->_model->getActionHasAction($action_id);
                $this->_view->set('action',$action);
                $this->_view->set('material_content',$material_content);
//                $this->_view->set('action_has_address',$action_has_address);
                $this->_view->set('action_has_criminal_case',$action_has_criminal_case);
                $this->_view->set('action_has_signal',$action_has_signal);
                $this->_view->set('action_has_car',$action_has_car);
                $this->_view->set('action_has_weapon',$action_has_weapon);
                $this->_view->set('action_has_phone',$action_has_phone);
                $this->_view->set('action_has_organization',$action_has_organization);
                $this->_view->set('action_event_has_action',$action_event_has_action);
                $this->_view->set('action_has_man',$action_has_man);
                $this->_view->set('action_has_event',$action_has_event);
                $this->_view->set('action_has_file',$action_has_file);
                $this->_view->set('action_has_qualification',$action_has_qualification);
                $this->_view->set('action_has_action',$action_has_action);
                $this->_model->logging('edit','action',$action_id);
            }else{
                $action_id = $this->_model->createAction($b_id);
                $this->_model->logging('add','action',$action_id);
            }
            $user = $this->_model->getUser();
            $this->_view->set('action_id',$action_id);
            $this->_view->set('user' ,$user);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function action_save($action_id){
        try {
            $this->_model->actionSave($action_id,$_POST['value'],$_POST['field']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function action_delete($action_id){
        try {
            $this->_model->deleteById('action',$action_id);
            $this->_model->logging('delete','action',$action_id);
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////////// adding action has material content //////////////////////////////////////
    public function action_has_material_content($action_id, $id = null){
        try {
            if($id == 'undefined') {
                $forJson['id'] = $this->_model->actionHasMaterialContent($_POST['data'],$action_id);
            }else{
                $this->_model->updateMaterialContentAction($_POST['data'],$id);
                $forJson['id'] = $id;
            }


            $forJson['text'] = substr($_POST['data'],0,20).'...';

            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_action_has_material_content($content_id){
        try {
            $this->_model->delete_action_has_material_content($content_id);
            $this->_model->logging('delete','action_has_material_content',$content_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    /////////////////////////////////////////// adding action has qualification ////////////////////////////////////////////
    public function action_qualification($action_id){
        try {
            $this->_model->actionQualification($action_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_action_qualification($action_id,$q_id){
        try {
            $this->_model->delete_action_qualification($action_id,$q_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// action passed by signal/////////////////////////////////////////////////
    public function action_passes_signal($action_id,$signal_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkActionPassesSignal($signal_id,$action_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->actionPassesSignal($signal_id,$action_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_action_passes_signal($action_id,$signal_id){
        try {
            $this->_model->delete_action_passes_signal($signal_id,$action_id);
            $this->_model->logging('delete_joins','action_passes_signal',$action_id,$signal_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////////////////// action to action //////////////////////////////////////////////
    public function action_to_action($action_id1,$action_id2){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkActionToAction($action_id1,$action_id2);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->actionToAction($action_id1,$action_id2);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_action_to_action($action_id1,$action_id2){
        try {
            $this->_model->delete_action_to_action($action_id1,$action_id2);
            $this->_model->logging('delete_joins','action_to_action',$action_id1,$action_id2);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// action has car /////////////////////////////////////////////////
    public function action_has_car($action_id,$car_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkActionHasCar($action_id,$car_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->actionHasCar($action_id,$car_id);
            $this->_model->logging('add','action_has_car',$action_id,$car_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_action_has_car($action_id,$car_id){
        try {
            $this->_model->delete_action_has_car($action_id,$car_id);
            $this->_model->logging('delete_joins','action_has_car',$action_id,$car_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

///////////////////////////////////////////// action has weapon /////////////////////////////////////////////////
    public function action_has_weapon($action_id,$weapon_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkActionHasWeapon($action_id,$weapon_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->actionHasWeapon($action_id,$weapon_id);
            $this->_model->logging('add','action_has_weapon',$action_id,$weapon_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_action_has_weapon($action_id,$weapon_id){
        try {
            $this->_model->delete_action_has_weapon($action_id,$weapon_id);
            $this->_model->logging('delete_joins','action_has_weapon',$action_id,$weapon_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////////////////////////////// adding action has phone /////////////////////////////////////////////////////
    public function action_has_phone($action_id){
        try {
            $forJson['status'] = true;
            $phone_id = $this->_model->createPhone($_POST['phone_number'],$_POST['more_data']);
            $this->_model->actionHasPhone($action_id,$phone_id);
            $this->_model->logging('add','phone',$phone_id);
            $this->_model->logging('add','action_has_phone',$action_id,$phone_id);
            $forJson['id'] = $phone_id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_action_has_phone($action_id,$phone_id){
        try {
            $this->_model->delete_action_has_phone($action_id,$phone_id);
            $this->_model->logging('delete_joins','action_has_phone',$action_id,$phone_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding action has organization    /////////////////////////////////////////////////////
    public function action_has_organization($action_id,$organization_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationHasAction($organization_id,$action_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationHasAction($organization_id,$action_id);
            $this->_model->logging('add','action_has_organization',$action_id,$organization_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_action_has_organization($action_id,$organization_id){
        try {
            $this->_model->delete_organization_has_action($organization_id,$action_id);
            $this->_model->logging('delete_joins','action_has_organization',$action_id,$organization_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// action event has action /////////////////////////////////////////////////
    public function action_event_has_action($action_id,$event_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkEventHasAction($event_id,$action_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->eventHasAction($event_id,$action_id);
            $this->_model->logging('add','action_has_event',$action_id,$event_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_action_event_has_action($action_id,$event_id){
        try {
            $this->_model->delete_event_has_action($event_id,$action_id);
            $this->_model->logging('delete_joins','action_has_event',$action_id,$event_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding action has man /////////////////////////////////////////////////////
    public function action_has_man($action_id,$man_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkActionHasMan($man_id,$action_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->actionHasMan($man_id,$action_id);
            $this->_model->logging('add','action_has_man',$action_id,$man_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_action_has_man($action_id,$man_id){
        try {
            $this->_model->delete_action_has_man($man_id,$action_id);
            $this->_model->logging('delete_joins','action_has_man',$action_id,$man_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// action has event /////////////////////////////////////////////////
    public function action_has_event($action_id,$event_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkActionHasEvent($event_id,$action_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->actionHasEvent($event_id,$action_id);
            $this->_model->logging('add','action_has_event',$action_id,$event_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_action_has_event($action_id,$event_id){
        try {
            $this->_model->delete_event_action_has_event($event_id,$action_id);
            $this->_model->logging('delete_joins','action_has_event',$action_id,$event_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////////  end action ///////////////////////////////////////
///////////////////////////////////////////   car   /////////////////////////////////////////////////////
    public function car($other_tb_name = null , $car_id = null ){
        try {
            if($other_tb_name){
                $this->_view->set('other_tb_name',$other_tb_name);
            }
            if($car_id){
                $car = $this->_model->getCar($car_id);
                $car_has = $this->_model->getCarHas($car_id);
                $this->_model->logging('edit','car',$car_id);
                $this->_view->set('car',$car);
                $this->_view->set('car_has',$car_has);
            }else{
                $car_id = $this->_model->createCar();
                $this->_model->logging('add','car',$car_id);
            }
            $this->_view->set('car_id' ,$car_id);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function car_save($car_id){
        try {
            $this->_model->carSave($car_id,$_POST['value'],$_POST['field']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function car_delete($car_id){
        try {
            $this->_model->deleteById('car',$car_id);
            $this->_model->logging('delete','car',$car_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function car_color($car_id){
        try {
            $color_id = $this->_model->checkColor( trim($_POST['color']) );
            if($color_id){
                $this->_model->carSave($car_id,$color_id,'color_id');
            }else{
                $color_id = $this->_model->createColor( trim($_POST['color']) );
                $this->_model->carSave($car_id,$color_id,'color_id');
            }
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

//////////////////////////////////////////  end car /////////////////////////////////////////
    public function object($tb_name , $obj_id = null ){
        try {
            if($obj_id){
                $object = $this->_model->getObjectRelation($obj_id);
                $this->_model->logging('edit','objects_relation',$obj_id);
                $this->_view->set('object',$object);
            }
            $this->_view->set('other_tb_name',$tb_name);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function edit_object($obj_id){
        try {
            $this->_model->updateObject($obj_id,$_POST['relation_type_id']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////// adding address //////////////////////////////////////
    public function address($other_tb_name = null , $address_id = null ){
        try {
            if($other_tb_name){
                $this->_view->set('other_tb_name',$other_tb_name);
            }
            if($address_id){
                $address = $this->_model->getAddress($address_id);
                $address_has = $this->_model->getAddressHas($address_id);
                if($other_tb_name == 'man_edit'){
                    $man_edit = $this->_model->getManEditAddress($address_id,$_GET['other_id']);
                    if(!empty($man_edit['end_date'])){
                        $data = explode('-',$man_edit['end_date']);
                        $day= $data[2];
                        $month = $data[1];
                        $year = $data[0];
                        $man_edit['end_date'] = $day.'-'.$month.'-'.$year;
                    }
                    if(!empty($man_edit['start_date'])){
                        $data = explode('-',$man_edit['start_date']);
                        $day= $data[2];
                        $month = $data[1];
                        $year = $data[0];
                        $man_edit['start_date'] = $day.'-'.$month.'-'.$year;
                    }
                    $this->_view->set('edit',$man_edit);
                }elseif($other_tb_name == 'organization_edit'){
                    $organization_edit = $this->_model->getOrganizationEditAddress($address_id,$_GET['other_id']);
                    if(!empty($organization_edit['end_date'])){
                        $data = explode('-',$organization_edit['end_date']);
                        $day= $data[2];
                        $month = $data[1];
                        $year = $data[0];
                        $organization_edit['end_date'] = $day.'-'.$month.'-'.$year;
                    }
                    if(!empty($organization_edit['start_date'])){
                        $data = explode('-',$organization_edit['start_date']);
                        $day= $data[2];
                        $month = $data[1];
                        $year = $data[0];
                        $organization_edit['start_date'] = $day.'-'.$month.'-'.$year;
                    }
                    $this->_view->set('edit',$organization_edit);
                }
                $this->_view->set('address_has',$address_has);
                $this->_view->set('address',$address);
            }else{
                $address_id = $this->_model->createAddress();
                $this->_model->logging('add','address',$address_id);
            }
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            $this->_view->set('address_id',$address_id);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function editManHasAddress(){
        try {
            if(!empty($_POST['start_date'])){
                $data = explode('-',$_POST['start_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $_POST['start_date'] = $year.'-'.$month.'-'.$day;
            }
            if(!empty($_POST['end_date'])){
                $data = explode('-',$_POST['end_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $_POST['end_date'] = $year.'-'.$month.'-'.$day;
            }
            $this->_model->updateManHasAddress($_POST);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function editOrganizationHasAddress(){
        try {
            if(!empty($_POST['start_date'])){
                $data = explode('-',$_POST['start_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $_POST['start_date'] = $year.'-'.$month.'-'.$day;
            }
            if(!empty($_POST['end_date'])){
                $data = explode('-',$_POST['end_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $_POST['end_date'] = $year.'-'.$month.'-'.$day;
            }
            $this->_model->updateOrganizationHasAddress($_POST);
            $this->_model->logging('edit','organization_has_address',$_POST['organization_id'],$_POST['address_id']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function save_address($address_id){
        try {
            if($_POST['field'] == 'region'){
                if($_POST['value'] != 'null'){
                    $region_id = $this->_model->checkRegion($_POST['value']);
                    if($region_id){
                        $_POST['value'] = $region_id;
                    }else{
                        $_POST['value'] = $this->_model->createRegion($_POST['value']);
                    }
                }
                $_POST['field'] = 'region_id';
            }elseif($_POST['field'] == 'locality'){
                if($_POST['value'] != 'null'){
                    $locality_id = $this->_model->checkLocality($_POST['value']);
                    if($locality_id){
                        $_POST['value'] = $locality_id;
                    }else{
                        $_POST['value'] = $this->_model->createLocality($_POST['value']);
                    }
                }
                $_POST['field'] = 'locality_id';
            }elseif($_POST['field'] == 'street'){
                if($_POST['value'] != 'null'){
                    $street_id = $this->_model->checkStreet($_POST['value']);
                    if($street_id){
                        $_POST['value'] = $street_id;
                    }else{
                        $_POST['value'] = $this->_model->createStreet($_POST['value']);
                    }
                }
                $_POST['field'] = 'street_id';
            }
            $this->_model->updateAddress($address_id,$_POST['field'],$_POST['value']);
            $this->_model->logging('edit','address',$address_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function work_activity($tb_name , $id = null){
        try {
            if($id){
                $work_activity = $this->_model->getWorkActivity($id);
                if(!empty($work_activity['start_date'])){
                    $date2 = explode('-',$work_activity['start_date']);
                    $work_activity['start_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                if(!empty($work_activity['end_date'])){
                    $date2 = explode('-',$work_activity['end_date']);
                    $work_activity['end_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                $this->_model->logging('edit','work_activity',$id);
                $this->_view->set('work_activity',$work_activity);
            }
            $this->_view->set('other_tb_name',$tb_name);
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
//////////////////////////////////////////// adding organization //////////////////////////////
    public function organization($b_id , $organization_id = null ){
        try {
            if($organization_id){
                $organization = $this->_model->getOrganization($organization_id);
                if(!empty($organization['reg_date'])){
                    $date2 = explode('-',$organization['reg_date']);
                    $organization['reg_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                $organization_has_address = $this->_model->getOrganizationHasAddress($organization_id);
                $organization_has_phone = $this->_model->getOrganizationHasPhone($organization_id);
                $organization_has_email = $this->_model->getOrganizationHasEmail($organization_id);
                $organization_has_event = $this->_model->getOrganizationHasEvent($organization_id);
                $organization_objects_relation = $this->_model->getOrganizationObjectsRelation($organization_id);
                $organization_has_criminal_case = $this->_model->getOrganizationHasCriminalCase($organization_id);
                $organization_has_action = $this->_model->getOrganizationHasAction($organization_id);
                $organization_has_man = $this->_model->getOrganizationHasMan($organization_id);
                $organization_checked_by_signal = $this->_model->getOrganizationCheckedBySignal($organization_id);
                $organization_passes_by_signal = $this->_model->getOrganizationPassesBySignal($organization_id);
                $organization_has_car = $this->_model->getOrganizationHasCar($organization_id);
                $organization_has_weapon = $this->_model->getOrganizationHasWeapon($organization_id);
                $organization_has_mia_summary = $this->_model->getOrganizationHasMiaSummary($organization_id);
                $organization_event = $this->_model->getOrganizationEvent($organization_id);
                $organization_has_file = $this->_model->getOrganizationHasFile($organization_id);
                $organization_has_organization = $this->_model->getOrganizationToOrganization($organization_id);
                $organization_has_bibliography = $this->_model->getOrganizationHasBibliography($organization_id);
                $this->_view->set('organization',$organization);
                $this->_view->set('organization_has_address',$organization_has_address);
                $this->_view->set('organization_has_phone',$organization_has_phone);
                $this->_view->set('organization_has_email',$organization_has_email);
                $this->_view->set('organization_has_event',$organization_has_event);
                $this->_view->set('organization_objects_relation',$organization_objects_relation);
                $this->_view->set('organization_has_criminal_case',$organization_has_criminal_case);
                $this->_view->set('organization_has_action',$organization_has_action);
                $this->_view->set('organization_has_man',$organization_has_man);
                $this->_view->set('organization_checked_by_signal',$organization_checked_by_signal);
                $this->_view->set('organization_passes_by_signal',$organization_passes_by_signal);
                $this->_view->set('organization_has_car',$organization_has_car);
                $this->_view->set('organization_has_weapon',$organization_has_weapon);
                $this->_view->set('organization_has_mia_summary',$organization_has_mia_summary);
                $this->_view->set('organization_event',$organization_event);
                $this->_view->set('organization_has_file',$organization_has_file);
                $this->_view->set('organization_has_organization',$organization_has_organization);
                $this->_view->set('organization_has_bibliography',$organization_has_bibliography);
                $this->_model->logging('edit','organization',$organization_id);
                if($b_id && $b_id != 'null' && $b_id != 'undefined'){
                    $checkBibOrg = $this->_model->checkOrgBibliography($organization_id,$b_id);
                    if(!$checkBibOrg){
                        $this->_model->organizationHasBibliography($b_id,$organization_id);
                    }
                }
            }else{
                $organization_id = $this->_model->createOrganization();
                if($b_id && $b_id != 'null' && $b_id != 'undefined'){
                    $this->_model->organizationHasBibliography($b_id,$organization_id);
                }
                $this->_model->logging('add','organization',$organization_id);
            }
            $this->_view->set('organization_id',$organization_id);
            $user = $this->_model->getUser();
            $this->_view->set('user' ,$user);
            if(isset($_GET['other_tb'])){
                $this->_view->set('other_tb_name',$_GET['other_tb']);
            }
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public  function save_organization($organization_id){
        try {
            if($_POST['field'] == 'reg_date' && $_POST['value'] !='null'){
                $data = explode('-',$_POST['value']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $_POST['value'] = $year.'-'.$month.'-'.$day;
            }
            $this->_model->saveOrganization($organization_id,$_POST['field'],$_POST['value']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization has event  /////////////////////////////////////////////////////
    public function organization_has_event($organization_id,$event_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationHasEvent($organization_id,$event_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationHasEvent($organization_id,$event_id);
            $this->_model->logging('add','organization_has_event',$organization_id,$event_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_has_event($organization_id,$event_id){
        try {
            $this->_model->delete_organization_has_event($organization_id,$event_id);
            $this->_model->logging('delete_joins','organization_has_event',$organization_id,$event_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function organization_has_organization($org_id1,$org_id2){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationToOrganization($org_id1,$org_id2);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationHasOrganization($org_id1,$org_id2);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_has_organization($org_id1,$org_id2){
        try {
            $this->_model->delete_organization_has_organization($org_id1,$org_id2);
            $this->_model->logging('delete_joins','organization_to_organization',$org_id1,$org_id2);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization has action  /////////////////////////////////////////////////////
    public function organization_has_action($organization_id,$action_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationHasAction($organization_id,$action_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationHasAction($organization_id,$action_id);
            $this->_model->logging('add','organization_has_action',$organization_id,$action_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_has_action($organization_id,$action_id){
        try {
            $this->_model->delete_organization_has_action($organization_id,$action_id);
            $this->_model->logging('delete_joins','organization_has_action',$organization_id,$action_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization checked by signal  /////////////////////////////////////////////////////
    public function organization_checked_by_signal($organization_id,$signal_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationCheckedBySignal($organization_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationCheckedBySignal($organization_id,$signal_id);
            $this->_model->logging('add','organization_checked_by_signal',$organization_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_checked_by_signal($organization_id,$signal_id){
        try {
            $this->_model->delete_organization_checked_by_signal($organization_id,$signal_id);
            $this->_model->logging('delete_joins','organization_checked_by_signal',$organization_id,$signal_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization passed by signal  /////////////////////////////////////////////////////
    public function organization_passed_by_signal($organization_id,$signal_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationPassedBySignal($organization_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationPassedBySignal($organization_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_passed_by_signal($organization_id,$signal_id){
        try {
            $this->_model->delete_organization_passed_by_signal($organization_id,$signal_id);
            $this->_model->logging('delete_joins','organization_passed_by_signal',$organization_id,$signal_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization has criminal case  /////////////////////////////////////////////////////
    public function organization_has_criminal_case($organization_id,$criminal_case_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationHasCriminalCase($organization_id,$criminal_case_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationHasCriminalCase($organization_id,$criminal_case_id);
            $this->_model->logging('add','organization_has_criminal_case',$organization_id,$criminal_case_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_has_criminal_case($organization_id,$criminal_case_id){
        try {
            $this->_model->delete_organization_has_criminal_case($organization_id,$criminal_case_id);
            $this->_model->logging('delete_joins','organization_has_criminal_case',$organization_id,$criminal_case_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization passes mia summary  /////////////////////////////////////////////////////
    public function organization_passes_mia_summary($organization_id,$mia_summary_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationPassesMiaSummary($organization_id,$mia_summary_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationPassesMiaSummary($organization_id,$mia_summary_id);
            $this->_model->logging('add','organization_passes_mia_summary',$organization_id,$mia_summary_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_passes_mia_summary($organization_id,$mia_summary_id){
        try {
            $this->_model->delete_organization_passes_mia_summary($organization_id,$mia_summary_id);
            $this->_model->logging('delete_joins','organization_passes_mia_summary',$organization_id,$mia_summary_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization has weapon /////////////////////////////////////////////////////
    public function organization_has_weapon($organization_id,$weapon_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationHasWeapon($organization_id,$weapon_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationHasWeapon($organization_id,$weapon_id);
            $this->_model->logging('add','organization_has_weapon',$organization_id,$weapon_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_has_weapon($organization_id,$weapon_id){
        try {
            $this->_model->delete_organization_has_weapon($organization_id,$weapon_id);
            $this->_model->logging('delete_joins','organization_has_weapon',$organization_id,$weapon_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization has car /////////////////////////////////////////////////////
    public function organization_has_car($organization_id,$car_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationHasCar($organization_id,$car_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationHasCar($organization_id,$car_id);
            $this->_model->logging('add','organization_has_car',$organization_id,$car_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_has_car($organization_id,$car_id){
        try {
            $this->_model->delete_organization_has_car($organization_id,$car_id);
            $this->_model->logging('delete_joins','organization_has_car',$organization_id,$car_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function organization_has_address($organization_id,$address_id){
        try {
            $forJson['status'] = true;
            $dataDate['start_date'] = null;
            $dataDate['end_date'] = null;
            if(!empty($_POST['start_date'])){
                $data = explode('-',$_POST['start_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $dataDate['start_date'] = $year.'-'.$month.'-'.$day;
            }
            if(!empty($_POST['end_date'])){
                $data = explode('-',$_POST['end_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $dataDate['end_date'] = $year.'-'.$month.'-'.$day;
            }
            $check = $this->_model->checkOrganizationHasAddress($organization_id,$address_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationHasAddress($organization_id,$address_id,$dataDate);
            $this->_model->logging('add','organization_has_address',$organization_id,$address_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_has_address($organization_id,$address_id){
        try {
            $this->_model->delete_organization_has_address($organization_id,$address_id);
            $this->_model->logging('delete_joins','organization_has_address',$organization_id,$address_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization has phone /////////////////////////////////////////////////////
    public function organization_has_phone($organization_id){
        try {
            $forJson['status'] = true;
            $phone_id = $this->_model->createPhone($_POST['phone_number'],$_POST['more_data']);
            $this->_model->organizationHasPhone($organization_id,$phone_id,$_POST['character']);
            $this->_model->logging('add','phone',$phone_id);
            $this->_model->logging('add','organization_has_phone',$organization_id,$phone_id);
            $forJson['id'] = $phone_id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_organization_has_phone($organization_id,$phone_id){
        try {
            $this->_model->delete_organization_has_phone($organization_id,$phone_id);
            $this->_model->logging('delete_joins','organization_has_phone',$organization_id,$phone_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization has email /////////////////////////////////////////////////////
    public function organization_has_email($organization_id){
        try {
            $forJson['status'] = true;
            $email_id = $this->_model->createEmail($_POST['email_address']);
            $this->_model->organizationHasEmail($organization_id,$email_id);
            $this->_model->logging('add','email',$email_id);
            $this->_model->logging('edit','organization_has_email',$organization_id,$email_id);
            $forJson['id'] = $email_id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_has_email($organization_id,$email_id){
        try {
            $this->_model->delete_organization_has_email($organization_id,$email_id);
            $this->_model->logging('delete_joins','organization_has_email',$organization_id,$email_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////// adding organization objects relation /////////////////////////////

    public function organization_objects_relation($organization_id){
        try {
//            var_dump($_POST);die;
            $forJson['status'] = true;
            $id = $this->_model->objects_relation_save($organization_id,$_POST['org_id'],'organization','organization',$_POST['relation_id']);
            $this->_model->logging('add','objects_relation',$id);
            $forJson['id'] = $id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_objects_relation($objects_relation_id){
        try {
            $this->_model->deleteById('objects_relation',$objects_relation_id);
            $this->_model->logging('delete','objects_relation',$objects_relation_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////// adding organization_work_activity ///////////////////////////////////////////////
    public function organization_work_activity($organization_id){
        try {
            $forJson['status'] = true;
            $dataDate['start_date'] = null;
            $dataDate['end_date'] = null;
            if(!empty($_POST['start_date'])){
                $data = explode('-',$_POST['start_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $dataDate['start_date'] = $year.'-'.$month.'-'.$day;
            }
            if(!empty($_POST['end_date'])){
                $data = explode('-',$_POST['end_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $dataDate['end_date'] = $year.'-'.$month.'-'.$day;
            }
            $id = $this->_model->organization_has_man($organization_id,$_POST['man_id'],$_POST['title'],$_POST['period'], $dataDate['start_date'] , $dataDate['end_date']);
            $forJson['id'] = $id;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_organization_has_man($organization_has_man_id){
        try {
            $this->_model->deleteById('organization_has_man',$organization_has_man_id);
            $this->_model->logging('delete','organization_has_man',$organization_has_man_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
//////////////////////////////////////////////////////// end organization //////////////////////////////
/////////////////////////////////////////////////  adding event //////////////////////////////////////////
    public function event($b_id , $event_id = null ){
        try {
            if($event_id){
                $event  = $this->_model->getEvent($event_id);
                if(!empty($event['date'])){
                    $newDate = explode(' ',$event['date']);
                    $date2 = explode('-',$newDate[0]);
                    $event['date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                    if($newDate[1] != '00:00:00'){
                        $event['time'] = $newDate[1];
                    }
                }
                $event_has_qualification = $this->_model->getEventHasQualification($event_id);
                $event_has_action = $this->_model->getEventHasAction($event_id);
                $event_has_signal = $this->_model->getEventHasSignal($event_id);
                $event_action_has_event = $this->_model->getEvenActionHasEvent($event_id);
                $event_has_car = $this->_model->getEventHasCar($event_id);
                $event_has_weapon = $this->_model->getEventHasWeapon($event_id);
                $event_has_organization = $this->_model->getEventHasOrganization($event_id);
                $event_has_man = $this->_model->getEventHasMan($event_id);
                $event_has_file = $this->_model->getEventHasFile($event_id);
                $event_has_criminal_case = $this->_model->getEvenHasCriminalCase($event_id);
                $this->_view->set('event',$event);
                $this->_view->set('event_has_action',$event_has_action);
                $this->_view->set('event_has_signal',$event_has_signal);
                $this->_view->set('event_action_has_event',$event_action_has_event);
                $this->_view->set('event_has_car',$event_has_car);
                $this->_view->set('event_has_weapon',$event_has_weapon);
                $this->_view->set('event_has_organization',$event_has_organization);
                $this->_view->set('event_has_man',$event_has_man);
                $this->_view->set('event_has_qualification',$event_has_qualification);
                $this->_view->set('event_has_file',$event_has_file);
                $this->_view->set('event_has_criminal_case',$event_has_criminal_case);
                $this->_model->logging('edit','event',$event_id);
            }else{
                $event_id = $this->_model->createEvent($b_id);
                $this->_model->logging('add','event',$event_id);
            }
            $user = $this->_model->getUser();
            $this->_view->set('user' ,$user);
            $this->_view->set('event_id',$event_id);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function save_event($event_id){
        try {
//            if($_POST['field'] == 'date'){
//                $data = explode('-',$_POST['value']);
//                $year = $data[2];
//                $month = $data[1];
//                $day = $data[0];
//                $_POST['value'] = $year.'-'.$month.'-'.$day;
//            }
            $this->_model->eventSave($event_id,$_POST['value'],$_POST['field']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_event($event_id){
        try {
            $this->_model->deleteById('event',$event_id);
            $this->_model->logging('delete','event',$event_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function event_has_qualification($event_id){
        try {
            $this->_model->eventHasQualification($event_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_event_has_qualification($event_id,$qualification_id){
        try {
            $this->_model->delete_event_has_qualification($event_id,$qualification_id);
            $this->_model->logging('delete_joins','event_has_qualification',$event_id,$qualification_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// event action has event /////////////////////////////////////////////////
    public function event_action_has_event($event_id,$action_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkActionHasEvent($event_id,$action_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->actionHasEvent($event_id,$action_id);
            $this->_model->logging('add','action_has_event',$event_id,$action_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_event_action_has_event($event_id,$action_id){
        try {
            $this->_model->delete_event_action_has_event($event_id,$action_id);
            $this->_model->logging('delete_joins','action_has_event',$event_id,$action_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function event_has_criminal_case($event_id,$criminal_case_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkEventHasCriminalCase($event_id,$criminal_case_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->eventHasCriminalCase($event_id,$criminal_case_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_event_has_criminal_case($event_id,$criminal_case_id){
        try {
            $this->_model->delete_event_has_criminal_case($event_id,$criminal_case_id);
            $this->_model->logging('delete_joins','event_has_criminal_case',$event_id,$criminal_case_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// event passes signal /////////////////////////////////////////////////
    public function event_passes_signal($event_id,$signal_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkEventPassesSignal($event_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->eventPassesSignal($event_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_event_passes_signal($event_id,$signal_id){
        try {
            $this->_model->delete_event_passes_signal($event_id,$signal_id);
            $this->_model->logging('delete_joins','event_passes_signal',$event_id,$signal_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// event has action /////////////////////////////////////////////////
    public function event_has_action($event_id,$action_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkEventHasAction($event_id,$action_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->eventHasAction($event_id,$action_id);
            $this->_model->logging('add','event_has_action',$event_id,$action_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_event_has_action($event_id,$action_id){
        try {
            $this->_model->delete_event_has_action($event_id,$action_id);
            $this->_model->logging('delete_joins','event_has_action',$event_id,$action_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// event has weapon /////////////////////////////////////////////////
    public function event_has_weapon($event_id,$weapon_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkEventHasWeapon($event_id,$weapon_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->eventHasWeapon($event_id,$weapon_id);
            $this->_model->logging('add','event_has_weapon',$event_id,$weapon_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_event_has_weapon($event_id,$weapon_id){
        try {
            $this->_model->delete_event_has_weapon($event_id,$weapon_id);
            $this->_model->logging('delete_joins','event_has_weapon',$event_id,$weapon_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// event has weapon /////////////////////////////////////////////////
    public function event_has_car($event_id,$car_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkEventHasCar($event_id,$car_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->eventHasCar($event_id,$car_id);
            $this->_model->logging('add','event_has_car',$event_id,$car_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_event_has_car($event_id,$car_id){
        try {
            $this->_model->delete_event_has_car($event_id,$car_id);
            $this->_model->logging('delete_joins','event_has_car',$event_id,$car_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// event has organization /////////////////////////////////////////////////
    public function event_has_organization($event_id,$organization_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkEventHasOrganization($event_id,$organization_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->eventHasOrganization($event_id,$organization_id);
            $this->_model->logging('add','event_has_organization',$event_id,$organization_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_event_has_organization($event_id,$organization_id){
        try {
            $this->_model->delete_event_has_organization($event_id,$organization_id);
            $this->_model->logging('delete_joins','event_has_organization',$event_id,$organization_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// event has man /////////////////////////////////////////////////
    public function event_has_man($event_id,$man_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkEventHasMan($man_id,$event_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->eventHasMan($man_id,$event_id);
            $this->_model->logging('add','event_has_man',$event_id,$man_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_event_has_man($event_id,$man_id){
        try {
            $this->_model->delete_event_has_man($man_id,$event_id);
            $this->_model->logging('delete_joins','event_has_man',$event_id,$man_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////  end event ////////////////////////////////////////////////
///////////////////////////////////////////// adding signal  /////////////////////////////////////////////
    public function signal($b_id,$signal_id = null){
        try {
            if($signal_id){
                $signal = $this->_model->getSignal($signal_id);
                $checkLate = true;
                if(!empty($signal['end_date'])){
                    $newDate['end_date'] = strtotime($signal['end_date']);
                    $date2 = explode('-',$signal['end_date']);
                    $signal['end_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }else{
                    $checkLate = false;
                }
                if(!empty($signal['check_date'])){
                    $newDate['check_date'] = strtotime($signal['check_date']);
                    $date2 = explode('-',$signal['check_date']);
                    $signal['check_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }else{
                    $checkLate = false;
                }
                if(!empty($signal['subunit_date'])){
                    $date2 = explode('-',$signal['subunit_date']);
                    $signal['subunit_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
//                $signal_check_worker = $this->_model->getSignalCheckWorker($signal_id);
                $signal_has_check_date = $this->_model->getSignalHasCheckDate($signal_id);
                if(!empty($signal_has_check_date)){
                    foreach($signal_has_check_date as $key=>$val){
                        $date2 = explode('-',$val['date']);
                        $signal_has_check_date[$key]['date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                    }
                }
                if($checkLate){
                    $days = round( ($newDate['end_date']-$newDate['check_date'])/86400);
                    $this->_view->set('late_days',$days);
                }
                $signal_used_resource = $this->_model->getSignalUsedResource($signal_id);
                $signal_has_taken_measure = $this->_model->getSignalHasTakenMeasure($signal_id);
                $signal_has_criminal_case = $this->_model->getSignalHasCriminalCase($signal_id);
                $signal_check_man = $this->_model->getSignalCheckMan($signal_id);
                $signal_check_organization = $this->_model->getSignalCheckOrganization($signal_id);
                $signal_has_action = $this->_model->getSignalHasAction($signal_id);
                $signal_has_event = $this->_model->getSignalHasEvent($signal_id);
                $signal_passed_man = $this->_model->getSignalPassedMan($signal_id);
                $signal_passed_organization = $this->_model->getSignalPassedOrganization($signal_id);
                $signal_has_keep_signal = $this->_model->getSignalHasKeepSignal($signal_id);
                $signal_checking_worker = $this->_model->getSignalCheckingWorker($signal_id);
                $signal_checking_worker_post = $this->_model->getSignalCheckingWorkerPost($signal_id);
                $signal_worker = $this->_model->getSignalWorker($signal_id);
                $signal_worker_post = $this->_model->getSignalWorkerPost($signal_id);
                $signal_has_file = $this->_model->getSignalHasFile($signal_id);
                $this->_view->set('signal',$signal);
//                $this->_view->set('signal_check_worker',$signal_check_worker);
                $this->_view->set('signal_has_check_date',$signal_has_check_date);
                $this->_view->set('signal_used_resource',$signal_used_resource);
                $this->_view->set('signal_has_taken_measure',$signal_has_taken_measure);
                $this->_view->set('signal_has_criminal_case',$signal_has_criminal_case);
                $this->_view->set('signal_check_man',$signal_check_man);
                $this->_view->set('signal_check_organization',$signal_check_organization);
                $this->_view->set('signal_has_action',$signal_has_action);
                $this->_view->set('signal_has_event',$signal_has_event);
                $this->_view->set('signal_passed_man',$signal_passed_man);
                $this->_view->set('signal_passed_organization',$signal_passed_organization);
                $this->_view->set('signal_has_keep_signal',$signal_has_keep_signal);
                $this->_view->set('signal_checking_worker',$signal_checking_worker);
                $this->_view->set('signal_checking_worker_post',$signal_checking_worker_post);
                $this->_view->set('signal_worker',$signal_worker);
                $this->_view->set('signal_worker_post',$signal_worker_post);
                $this->_view->set('signal_has_file',$signal_has_file);
                $this->_model->logging('edit','signal',$signal_id);
            }else{
                $signal_id = $this->_model->createSignal($b_id);
                $this->_model->logging('add','signal',$signal_id);
            }
//            $user = $this->_model->getUser();
//            $this->_view->set('user' ,$user);
            $this->_view->set('signal_id' ,$signal_id);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_save($signal_id){
        try {
            if( $_POST['value'] != 'null'){
                if( ($_POST['field'] == 'subunit_date')||($_POST['field'] == 'check_date')||($_POST['field']) == 'end_date' ){
                    $data = explode('-',$_POST['value']);
                    $year = $data[2];
                    $month = $data[1];
                    $day = $data[0];
                    $_POST['value'] = $year.'-'.$month.'-'.$day;
                }
            }
            $this->_model->signalSave($signal_id,$_POST['value'],$_POST['field']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_delete($signal_id){
        try {
            $this->_model->deleteById('signal',$signal_id);
            $this->_model->logging('delete','signal',$signal_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_mia_summary($id){
        try {
            $this->_model->deleteById('mia_summary',$id);
            $this->_model->logging('delete','mia_summary',$id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_has_resource($signal_id){
        try {
            $this->_model->signalHasResource($signal_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_signal_has_resource($signal_id,$resource_id){
        try {
            $this->_model->delete_signal_has_resource($signal_id,$resource_id);
            $this->_model->logging('delete_joins','signal_has_resource',$signal_id,$resource_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_has_taken_measure($signal_id){
        try {
            $this->_model->signalHasTakenMeasure($signal_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_signal_has_taken_measure($signal_id,$taken_measure_id){
        try {
            $this->_model->delete_signal_has_taken_measure($signal_id,$taken_measure_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_check_worker($signal_id){
        try {
            $this->_model->signalCheckWorker($signal_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_signal_check_worker($signal_id,$worker_id){
        try {
            $this->_model->delete_signal_check_worker($signal_id,$worker_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_has_worker($signal_id,$worker_id){
        try {
            $this->_model->signal_has_worker($signal_id,$worker_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_has_check_date($signal_id){
        try {
            $id = $this->_model->signal_has_check_date($signal_id,$_POST['value']);
            $forJson['id'] = $id;
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_signal_has_check_date($signal_id,$check_date_id){
        try {
            $this->_model->delete_signal_has_check_date($signal_id,$check_date_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    //////////////////////////////////////////////////  signal worker  /////////////////////////////////////////////////////////////////////
    public function signal_checking_worker_delete($criminal_case_id , $id){
        try {
            $this->_model->deleteById('signal_checking_worker' , $id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_checking_worker($signal_id){
        try {

            $keep_signal_worker = $this->_model->createSignalCheckingWorker( trim($_POST['value']),$signal_id );
            $forJson['id'] = $keep_signal_worker;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_worker_delete($signal_id , $id){
        try {
            $this->_model->deleteById('signal_worker' , $id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_worker($signal_id){
        try {

            $signal_worker = $this->_model->createSignalWorker( trim($_POST['value']),$signal_id );
            $forJson['id'] = $signal_worker;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_checking_worker_post($signal_id){
        try {
            $this->_model->signalCheckingWorkerPost($signal_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_signal_checking_worker_post($signal_id,$worker_post_id){
        try {
            $this->_model->delete_signal_checking_worker_post($signal_id,$worker_post_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_worker_post($signal_id){
        try {
            $this->_model->signalWorkerPost($signal_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_signal_worker_post($signal_id,$worker_post_id){
        try {
            $this->_model->delete_signal_worker_post($signal_id,$worker_post_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }




    ///////////////////////////////////////////////////////////// signal content ////////////////////////     popup    ////////////////////////
    public function signal_content($signal_id ){
        try {

            $this->_model->signal_content($_POST['data'],$signal_id);
            $forJson['id'] = 'Content';
            $forJson['text'] = substr($_POST['data'],0,20).'...';
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_content($signal_id){
        try {
            $this->_model->delete_signal_content($signal_id);
//            $this->_model->logging('delete','answer',$id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    ///////////////////////////////////////////////////////////// signal status /////////////////////////    popup     ////////////////////////
    public function signal_status($signal_id ){
        try {

            $this->_model->signal_status($_POST['data'],$signal_id);
            $forJson['id'] = 'Status';
            $forJson['text'] = substr($_POST['data'],0,20).'...';
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_status($signal_id){
        try {
            $this->_model->delete_signal_status($signal_id);
//            $this->_model->logging('delete','answer',$id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }



///////////////////////////////////////////// signal organization passes by signal /////////////////////////////////////////////////
    public function signal_organization_passes_by_signal($signal_id,$organization_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationPassedBySignal($organization_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationPassedBySignal($organization_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_signal_organization_passes_by_signal($signal_id,$organization_id){
        try {
            $this->_model->delete_organization_passed_by_signal($organization_id,$signal_id);die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// signal man passed by signal/////////////////////////////////////////////////
    public function signal_man_passed_by_signal($signal_id,$man_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkManPassedBySignal($man_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->manPassedBySignal($man_id,$signal_id);
            $this->_model->logging('add','man_passed_by_signal',$man_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_signal_man_passed_by_signal($signal_id,$man_id){
        try {
            $this->_model->delete_man_passed_by_signal($man_id,$signal_id);die;
            $this->_model->logging('delete','man_passed_by_signal',$man_id,$signal_id);
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// signal event passed by signal/////////////////////////////////////////////////
    public function signal_event_passes_by_signal($signal_id,$event_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkEventPassesSignal($event_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->eventPassesSignal($event_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_signal_event_passes_by_signal($signal_id,$event_id){
        try {
            $this->_model->delete_event_passes_signal($event_id,$signal_id);die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// signal action passed by signal/////////////////////////////////////////////////
    public function signal_action_passes_by_signal($signal_id,$action_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkActionPassesSignal($signal_id,$action_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->actionPassesSignal($signal_id,$action_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_signal_action_passes_by_signal($signal_id,$action_id){
        try {
            $this->_model->delete_action_passes_signal($signal_id,$action_id);die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// signal organization checked by signal/////////////////////////////////////////////////
    public function signal_organization_checked_by_signal($signal_id,$organization_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationCheckedBySignal($organization_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationCheckedBySignal($organization_id,$signal_id);
            $this->_model->logging('add','organization_checked_by_signal',$organization_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_signal_organization_checked_by_signal($signal_id,$organization_id){
        try {
            $this->_model->delete_organization_checked_by_signal($organization_id,$signal_id);
            $this->_model->logging('delete_joins','organization_checked_by_signal',$organization_id,$signal_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// signal has man /////////////////////////////////////////////////
    public function signal_signal_has_man($signal_id,$man_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkSignalHasMan($man_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->signalHasMan($man_id,$signal_id);
            $this->_model->logging('add','signal_has_man',$man_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_signal_signal_has_man($signal_id,$man_id){
        try {
            $this->_model->delete_signal_has_man($man_id,$signal_id);
            $this->_model->logging('delete_joins','signal_has_man',$signal_id,$man_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

/////////////////////////////////////////////  end signal  /////////////////////////////////////////
    public function keep_signal($signal_id , $keep_signal_id = null){
        try {
            if($keep_signal_id){
                $keep_signal = $this->_model->getKeepSignal($keep_signal_id);
                if(!empty($keep_signal['end_date'])){
                    $date2 = explode('-',$keep_signal['end_date']);
                    $keep_signal['end_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                if(!empty($keep_signal['start_date'])){
                    $date2 = explode('-',$keep_signal['start_date']);
                    $keep_signal['start_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                if(!empty($keep_signal['pass_date'])){
                    $date2 = explode('-',$keep_signal['pass_date']);
                    $keep_signal['pass_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                $keep_signal_worker = $this->_model->getKeepSignalWorker($keep_signal_id);
                $keep_signal_worker_post = $this->_model->getKeepSignalWorkerPost($keep_signal_id);
                $this->_view->set('keep_signal' ,$keep_signal);
                $this->_view->set('keep_signal_worker' ,$keep_signal_worker);
                $this->_view->set('keep_signal_worker_post' ,$keep_signal_worker_post);
                $this->_model->logging('edit','keep_signal',$keep_signal_id);
            }else{
                $keep_signal_id = $this->_model->createKeepSignal($signal_id);
                $this->_model->logging('add','keep_signal',$keep_signal_id);
            }
            if(isset($_GET['old_counter'])){
                $this->_view->set('old_counter',$_GET['old_counter']);
            }
            $this->_view->set('keep_signal_id',$keep_signal_id);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function keep_signal_save($keep_signal_id){
        try {
            if($_POST['value'] != 'null'){
                if( ($_POST['field'] == 'start_date')||($_POST['field'] == 'end_date')||($_POST['field'] == 'pass_date') ){
                    $data = explode('-',$_POST['value']);
                    $year = $data[2];
                    $month = $data[1];
                    $day = $data[0];
                    $_POST['value'] = $year.'-'.$month.'-'.$day;
                }
            }
            $this->_model->updateKeepSignal($keep_signal_id,$_POST['field'],$_POST['value']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_keep_signal($keep_signal_id){
        try {
            $this->_model->deleteById('keep_signal',$keep_signal_id);
            $this->_model->logging('delete','keep_signal',$keep_signal_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_keep_signal_has_worker($keep_signal_id,$worker_id){
        try {
            $this->_model->delete_keep_signal_has_worker($keep_signal_id,$worker_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function keep_signal_has_worker($keep_signal_id){
        try {
            $this->_model->keep_signal_has_worker($keep_signal_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function essay(){
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                var_dump($_POST);die;
            }
            $user = $this->_model->getUser();
            $this->_view->set('user' ,$user);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////////// CRIMINAL CASE ////////////////////////////////////////////
    public function criminal_case($b_id , $criminal_id = null){
        try {
            if($criminal_id){
                $criminal_case = $this->_model->getCriminalCase($criminal_id);
                if(!empty($criminal_case['opened_date'])){
                    $date2 = explode('-',$criminal_case['opened_date']);
                    $criminal_case['opened_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                $extracted_criminal_case = $this->_model->getExtractedCriminalCase($criminal_id);
                $splited_criminal_case = $this->_model->getSplitedCriminalCase($criminal_id);
                $criminal_case_has_event = $this->_model->getCriminalCaseHasEvent($criminal_id);
                $criminal_case_has_action = $this->_model->getCriminalCaseHasAction($criminal_id);
                $criminal_case_has_organization = $this->_model->getCriminalCaseHasOrganization($criminal_id);
                $criminal_case_has_man = $this->_model->getCriminalCaseHasMan($criminal_id);
                $criminal_case_has_file = $this->_model->getCriminalCaseHasFile($criminal_id);
                $criminal_case_worker = $this->_model->getCriminalCaseWorker($criminal_id);
                $criminal_case_worker_post = $this->_model->getCriminalCaseWorkerPost($criminal_id);
                $criminal_case_has_signal = $this->_model->getCriminalCaseHasSignal($criminal_id);
                $this->_view->set('criminal_case',$criminal_case);
                $this->_view->set('extracted_criminal_case',$extracted_criminal_case);
                $this->_view->set('splited_criminal_case',$splited_criminal_case);
                $this->_view->set('criminal_case_has_event',$criminal_case_has_event);
                $this->_view->set('criminal_case_has_action',$criminal_case_has_action);
                $this->_view->set('criminal_case_has_organization',$criminal_case_has_organization);
                $this->_view->set('criminal_case_has_man',$criminal_case_has_man);
                $this->_view->set('criminal_case_has_file',$criminal_case_has_file);
                $this->_view->set('criminal_case_worker',$criminal_case_worker);
                $this->_view->set('criminal_case_worker_post',$criminal_case_worker_post);
                $this->_view->set('criminal_case_has_signal',$criminal_case_has_signal);
                $this->_model->logging('edit','criminal_case',$criminal_id);

            }else{
                $criminal_id = $this->_model->createCriminalCase($b_id);
                $this->_model->logging('add','criminal_case',$criminal_id);
            }
            $user = $this->_model->getUser();
            $this->_view->set('user' ,$user);
            $this->_view->set('criminal_id',$criminal_id);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function criminal_case_save($criminal_id){
        try {
            if($_POST['field'] == 'opened_date' && $_POST['value'] !='null'){
                $data = explode('-',$_POST['value']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $_POST['value'] = $year.'-'.$month.'-'.$day;
            }
             $this->_model->updateCriminalCase($criminal_id,$_POST['field'],$_POST['value']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_criminal_case($criminal_id){
        try {
            $this->_model->deleteById('criminal_case',$criminal_id);
            $this->_model->logging('delete','criminal_case',$criminal_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////////////// keep signal worker  /////////////////////////////////////////////////////////////////////
    public function keep_signal_worker_delete($criminal_case_id , $id){
        try {
            $this->_model->deleteById('keep_signal_worker' , $id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function keep_signal_worker($keep_signal_id){
        try {

            $keep_signal_worker = $this->_model->createKeepSignalWorker( trim($_POST['value']),$keep_signal_id );
            $forJson['id'] = $keep_signal_worker;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function keep_signal_worker_post($keep_signal_id){
        try {
            $this->_model->keepSignalWorkerPost($keep_signal_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_keep_signal_worker_post($keep_signal_id,$worker_post_id){
        try {
            $this->_model->delete_keep_signal_worker_post($keep_signal_id,$worker_post_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

///////////////////////////////////////////////// criminal_case_worker /////////////////////////////////////////////////////////////////////
    public function criminal_case_worker_delete($criminal_case_id , $id){
        try {
            $this->_model->deleteById('criminal_case_worker' , $id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function criminal_case_worker($criminal_id){
        try {

            $criminal_case_worker = $this->_model->createCriminalCaseWorker( trim($_POST['value']),$criminal_id );
            $forJson['id'] = $criminal_case_worker;
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function criminal_worker_post($criminal_id){
        try {
            $this->_model->criminalCaseHasWorkerPost($criminal_id,$_POST['value']);
            $forJson['success'] = true;
            echo json_encode($forJson);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_criminal_worker_post($criminal_id,$worker_post_id){
        try {
            $this->_model->delete_criminal_worker_post($criminal_id,$worker_post_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// adding criminal case extracted criminal case /////////////////////////////////////////////////
    public function criminal_case_extracted_criminal_case($criminal_case_id,$criminal_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkCriminalCaseExtractedCriminalCase($criminal_case_id,$criminal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->criminalCaseExtractedCriminalCase($criminal_case_id,$criminal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_criminal_case_extracted_criminal_case($criminal_case_id,$criminal_id){
        try {
            $this->_model->delete_criminal_case_extracted_criminal_case($criminal_case_id,$criminal_id);die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
////////////////////////////////////////////////////////////// action_has_criminal_case ///////////////////////////////////////////////////
    public function action_has_criminal_case($action_id,$criminal_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkActionHasCriminalCase($action_id,$criminal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->actionHasCriminalCase($action_id,$criminal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_action_has_criminal_case($action_id,$criminal_id){
        try {
            $this->_model->delete_action_has_criminal_case($action_id,$criminal_id);die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////// criminal case has signal ////////////////////////////////////////////////////////////////
    public function criminal_case_has_signal($criminal_id,$signal_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkCriminalCaseHasSignal($criminal_id,$signal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->criminalCaseHasSignal($criminal_id,$signal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_criminal_case_has_signal($criminal_id,$signal_id){
        try {
            $this->_model->delete_criminal_case_has_signal($criminal_id,$signal_id);die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////////////////// adding criminal case splited criminal case /////////////////////////////////////////////////
    public function criminal_case_splited_criminal_case($criminal_case_id,$criminal_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkCriminalCaseSplitedCriminalCase($criminal_case_id,$criminal_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->criminalCaseSplitedCriminalCase($criminal_case_id,$criminal_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_criminal_case_splited_criminal_case($criminal_case_id,$criminal_id){
        try {
            $this->_model->delete_criminal_case_splited_criminal_case($criminal_case_id,$criminal_id);die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding organization has criminal case  /////////////////////////////////////////////////////
    public function criminal_case_has_organization($criminal_case_id,$organization_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationHasCriminalCase($organization_id,$criminal_case_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationHasCriminalCase($organization_id,$criminal_case_id);
            $this->_model->logging('add','organization_has_criminal_case',$criminal_case_id,$organization_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_criminal_case_has_organization($criminal_case_id,$organization_id){
        try {
            $this->_model->delete_organization_has_criminal_case($organization_id,$criminal_case_id);
            $this->_model->logging('delete_joins','organization_has_criminal_case',$criminal_case_id,$organization_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////////////// adding man has criminal case  /////////////////////////////////////////////////////
    public function criminal_case_has_man($criminal_case_id,$man_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkCriminalCaseHasMan($man_id,$criminal_case_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->criminalCaseHasMan($man_id,$criminal_case_id);
            $this->_model->logging('add','criminal_case_has_man',$criminal_case_id,$man_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_criminal_case_has_man($criminal_case_id,$man_id){
        try {
            $this->_model->delete_man_has_criminal_case($man_id,$criminal_case_id);
            $this->_model->logging('delete_joins','criminal_case_has_man',$criminal_case_id,$man_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
/////////////////////////////////////////////////  end criminal case //////////////////////////////////
////////////////////////////////////  CONTROL //////////////////////////////////////////////////

    public function control($b_id,$control_id = null){
        try {
            if($control_id){
                $control = $this->_model->getControl($control_id);
                if(!empty($control['creation_date'])){
                    $date2 = explode('-',$control['creation_date']);
                    $control['creation_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                if(!empty($control['reg_date'])){
                    $date2 = explode('-',$control['reg_date']);
                    $control['reg_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                if(!empty($control['resolution_date'])){
                    $date2 = explode('-',$control['resolution_date']);
                    $control['resolution_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                $control_has_file = $this->_model->getControlHasFile($control_id);
                $this->_view->set('control',$control);
                $this->_view->set('control_has_file',$control_has_file);
                $this->_model->logging('edit','control',$control_id);

            }else{
                $control_id = $this->_model->createControl($b_id);
                $this->_model->logging('add','control',$control_id);
            }
            $this->_view->set('control_id' , $control_id);
            $user = $this->_model->getUser();
            $this->_view->set('b_id' ,$b_id);
            $this->_view->set('user' ,$user);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function save_control($control_id){
        try {
            $field = $_POST['field'];
            $val = $_POST['value'];
            if($val != 'null'){
                if( ($field == 'creation_date')||($field == 'reg_date')||($field == 'resolution_date') ){
                    $data = explode('-',$val);
                    $year = $data[2];
                    $month = $data[1];
                    $day = $data[0];
                    $val = $year.'-'.$month.'-'.$day;
                }
            }
            $this->_model->saveControl($control_id,$field,$val);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_control($control_id){
        try {
            $this->_model->deleteById('control',$control_id);
            $this->_model->logging('delete','control',$control_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

////////////////////////////////////   end control  //////////////////////////////////////////////////
    public function mia_summary($b_id , $mia_id = null ){
        try {
            if($mia_id){
                $mia_summary =$this->_model->getMiaSummary($mia_id);
                if(!empty($mia_summary['date'])){
                    $date2 = explode('-',$mia_summary['date']);
                    $mia_summary['date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                $mia_summary_has_man = $this->_model->getMiaSummaryHasMan($mia_id);
                $mia_summary_has_organization = $this->_model->getMiaSummaryHasOrganization($mia_id);
                $mia_has_file = $this->_model->getMiaHasFile($mia_id);
                $this->_view->set('mia_summary',$mia_summary);
                $this->_view->set('mia_summary_has_man',$mia_summary_has_man);
                $this->_view->set('mia_summary_has_organization',$mia_summary_has_organization);
                $this->_view->set('mia_has_file',$mia_has_file);
                $this->_model->logging('edit','mia_summary',$mia_id);
            }else{
                $mia_id = $this->_model->createMiaSummary($b_id);
                $this->_model->logging('add','mia_summary',$mia_id);
            }
            $user = $this->_model->getUser();
            $this->_view->set('user' ,$user);
            $this->_view->set('mia_id',$mia_id);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function save_mia_summary($mia_id){
        try {
            $field = $_POST['field'];
            $val = $_POST['value'];
            if($field == 'date' || $val != 'null'){
                $data = explode('-',$val);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $val = $year.'-'.$month.'-'.$day;
            }
            $this->_model->saveMiaSummary($mia_id,$field,$val);
            if($_POST['field'] == 'man_id'){
                $forJson['status'] = true;
                echo json_encode($forJson);
            }
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }




    ///////////////////////////////////////////////////////////// mia_summary inf /////////////////////////    popup     ////////////////////////
    public function mia_inf($mia_id ){
        try {

            $this->_model->mia_inf($_POST['data'],$mia_id);
            $forJson['id'] = 'Status';
            $forJson['text'] = substr($_POST['data'],0,20).'...';
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_inf($mia_id){
        try {
            $this->_model->delete_mia_inf($mia_id);
//            $this->_model->logging('delete','answer',$id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }



    /////////////////////////////////////////////////////////// mia summary has organization /////////////////////////////////////////////////////
    public function mia_summary_has_organization($mia_summary_id,$organization_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkOrganizationPassesMiaSummary($organization_id,$mia_summary_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->organizationPassesMiaSummary($organization_id,$mia_summary_id);
            $this->_model->logging('add','mia_summary_has_organization',$mia_summary_id,$organization_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    public function delete_mia_summary_has_organization($mia_summary_id,$organization_id){
        try {
            $this->_model->delete_organization_passes_mia_summary($organization_id,$mia_summary_id);
            $this->_model->logging('delete_joins','mia_summary_has_organization',$mia_summary_id,$organization_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    ///////////////////////////////////////////////////////////// adding mia summary has man /////////////////////////////////////////////////////
    public function mia_summary_has_man($mia_summary_id,$man_id){
        try {
            $forJson['status'] = true;
            $check = $this->_model->checkManHasMiaSummary($man_id,$mia_summary_id);
            if($check){
                $forJson['status'] = false;
                echo json_encode($forJson);die;
            }
            $this->_model->manHasMiaSummary($man_id,$mia_summary_id);
            $this->_model->logging('add','man_has_mia_summary',$mia_summary_id,$man_id);
            echo json_encode($forJson);die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete_mia_summary_has_man($mia_summary_id,$man_id){
        try {
            $this->_model->delete_man_has_mia_summary($man_id,$mia_summary_id);
            $this->_model->logging('delete_joins','man_has_mia_summary',$mia_summary_id,$man_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function checkDicId($id){
        try {
            if($_POST['table'] == 'work_activity'){
                $_POST['table'] = 'organization_has_man';
            }
            $data = $this->_model->checkDic($_POST['table'],$id);
            if($data){
                $forJson['status'] = true;
                $forJson['data'] = $data;
            }else{
                $forJson['status'] = false;
            }
            echo json_encode($forJson); die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function uploader(){
//        var_dump('ttt');die;
        try {
            $FileUploader = new FileUploader();
            if (isset($_GET['qqfile'])) {
                $imgName = $_GET['qqfile'];
            } elseif (isset($_FILES['qqfile'])) {
                $imgName = $_FILES['qqfile']['name'];
            }
//            var_dump($_REQUEST);die;
            $explode = explode('.', $imgName);
            $ext = end($explode);
            $name = md5(microtime()) . '.' . $ext;
            if($ext){
                // if (!is_dir(WWW_ROOT . 'system' . DS . 'bulletinPic' . DS.$this->u_id)){
                // mkdir(WWW_ROOT . 'system' . DS . 'bulletinPic' . DS.$this->u_id,true);}
                $test = $FileUploader->upload(APP_PATH . DS . 'webroot'. DS . 'tmp' . DS );
//                var_dump($test);die;
                $response['fileName'] = $name;
//                var_dump($response);die;
                $response['success'] = true;
                @rename(APP_PATH . DS . 'webroot'. DS . 'tmp' . DS .$imgName , APP_PATH . DS . 'webroot'. DS . 'tmp'.DS.$name);
                $img = array();
                $img[$name] = $name;
                list($width, $height) = getimagesize(APP_PATH . DS . 'webroot'. DS . 'tmp'.DS.$name);
                if($width > $height){
                    $resolution = $height/$width;
                    $width = 300;
                    $height = round($width*$resolution);
                }else{
                    $resolution = $width/$height;
                    $height = 300;
                    $width = round($height*$resolution);
                }
                $response['name'] = $imgName;
                $response['width'] = $width;
                $response['height'] = $height;
                $echo = json_encode($response);
                echo $echo;
                die;
            }else{
                $response['success'] = false;
                $echo = json_encode($response);
                echo $echo;
                die;
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function removePhoto($imageName){
        try {
            unlink(APP_PATH . DS . 'webroot'. DS . 'tmp' . DS .$imageName );

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function edit_man_bean_country($mbc_id){
        try {
            if( ($_POST['region_id'])||($_POST['locality_id']) ){
                $region_id = $_POST['region_id'];
                $locality_id = $_POST['locality_id'];
            }else{
                if(strlen(trim($_POST['region']))>0){
                    $region_id = $this->_model->checkRegion($_POST['region']);
                    if(!$region_id){
                        $region_id = $this->_model->createRegion($_POST['region']);
                    }
                }else{
                    $region_id = 'null';
                }
                if(strlen(trim($_POST['locality']))>0){
                    $locality_id = $this->_model->checkLocality($_POST['locality']);
                    if(!$locality_id){
                        $locality_id = $this->_model->createLocality($_POST['locality']);
                    }
                }else{
                    $locality_id = 'null';
                }

            }
//            var_dump($_POST);
            $this->_model->updateManBeanCountry($mbc_id,$region_id,$locality_id,$_POST);
            $this->_model->logging('edit','man_bean_country',$mbc_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function edit_work_activity($wk_id){
        try {
            $forJson['status'] = true;
            $dataDate['start_date'] = null;
            $dataDate['end_date'] = null;
            if(!empty($_POST['start_date'])){
                $data = explode('-',$_POST['start_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $dataDate['start_date'] = $year.'-'.$month.'-'.$day;
            }
            if(!empty($_POST['end_date'])){
                $data = explode('-',$_POST['end_date']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $dataDate['end_date'] = $year.'-'.$month.'-'.$day;
            }
            $this->_model->updateOrganizationHasMan($wk_id,$_POST['title'],$_POST['period'], $dataDate['start_date'] , $dataDate['end_date']);
            $this->_model->logging('edit','organization_has_man',$wk_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function file_upload($man_id){
        try {
            $FileUploader = new FileUploader();
            if (isset($_GET['qqfile'])) {
                $imgName = $_GET['qqfile'];
            } elseif (isset($_FILES['qqfile'])) {
                $imgName = $_FILES['qqfile']['name'];
            }
//            var_dump($_REQUEST);die;
            $explode = explode('.', $imgName);
            $ext = end($explode);
            $ext = strtolower($ext);
            $name = md5(microtime()) . '.' . $ext;
            if($ext == 'doc' || $ext == 'docx' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'pdf' ){
                $test = $FileUploader->upload(APP_PATH . DS . 'webroot'. DS . 'files' . DS );
                $response['fileName'] = $name;
                $response['success'] = true;
                @rename(APP_PATH . DS . 'webroot'. DS . 'files' . DS .$test['filename'] , APP_PATH . DS . 'webroot'. DS . 'files'.DS.$name);
                $id = $this->_model->createNewFile($man_id,$name,$imgName);
                $response['file_id'] = $id;
                $response['name'] = $imgName;
                $echo = json_encode($response);
                $this->_model->logging('add','answer',$id);
                echo $echo;
                die;
            }else{
                $response['success'] = false;
                $echo = json_encode($response);
                echo $echo;
                die;
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function deleteFileMan($file_id){
        try {
            $data = $this->_model->getFile($file_id);
            unlink(APP_PATH . DS . 'webroot'. DS . 'files' . DS .$data['real_name'] );
            $this->_model->deleteFile($file_id);
            $this->_model->logging('delete','answer',$file_id);

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function deleteJoins(){
        try {
            $data = explode('/',$_POST['tb']);
            $tb_name = $data[0];
            $b_id = $data[1];
            $tb_id = $_POST['other_id'];
            if($tb_name == 'organization'){
                $this->_model->deleteOrganizationHasBibliography($tb_id,$b_id);
            }elseif($tb_name == 'man' ){
                $this->_model->deleteManHasBibliography($tb_id,$b_id);
            }else{
                $this->_model->setBibliographyNull($tb_name,$tb_id);
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

}