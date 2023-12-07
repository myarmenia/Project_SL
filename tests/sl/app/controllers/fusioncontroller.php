<?php
/**
 * Created by JetBrains PhpStorm.
 * User: malaverdyan
 * Date: 8/12/13
 * Time: 3:49 PM
 * To change this template use File | Settings | File Templates.
 */

class FusionController extends Controller
{

    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }


    public function index() {
        try {
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function find($functionName) {
        try {
            $this->_view->set('functionName',$functionName);
            switch($functionName){
                case 'man': $this->_view->set('navigationItem',$this->Lang->face);break;
                case 'action': $this->_view->set('navigationItem',$this->Lang->action);break;
                case 'event': $this->_view->set('navigationItem',$this->Lang->event);break;
                case 'organization': $this->_view->set('navigationItem',$this->Lang->organization);break;
                case 'address': $this->_view->set('navigationItem',$this->Lang->address);break;
                case 'bibliography': $this->_view->set('navigationItem',$this->Lang->bibliography);break;
                case 'weapon': $this->_view->set('navigationItem',$this->Lang->weapon);break;
                case 'car': $this->_view->set('navigationItem',$this->Lang->car);break;
                case 'work_activity': $this->_view->set('navigationItem',$this->Lang->work_activity);break;
                case 'man_bean_country': $this->_view->set('navigationItem',$this->Lang->man_bean_country);break;
                case 'signal': $this->_view->set('navigationItem',$this->Lang->signal);break;
                case 'keep_signal': $this->_view->set('navigationItem',$this->Lang->keep_signal);break;
                case 'criminal_case': $this->_view->set('navigationItem',$this->Lang->criminal);break;
                case 'control': $this->_view->set('navigationItem',$this->Lang->control);break;
                case 'mia_summary': $this->_view->set('navigationItem',$this->Lang->mia_summary);break;
            }
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

//-------------------------------------------------------------MAN ---------------------------------------------------------
    public function man(){
        try {
            $data = $this->_model->man();
            $this->_view->set('data',$data);
            $data_1['getManHasFirstName'] = $this->_model->getManHasFirstName();
            $data_1['getManHasBibliography'] = $this->_model->getManHasBibliography();
            $data_1['getManHasLastName'] = $this->_model->getManHasLastName();
            $data_1['getManHasMiddleName'] = $this->_model->getManHasMiddleName();
            $data_1['getManHasPassport'] = $this->_model->getManHasPassport();
            $data_1['getManBelongsCountry'] = $this->_model->getManBelongsCountry();
            $data_1['getManKnowsLanguage'] = $this->_model->getManKnowsLanguage();
            $data_1['getManHasAddress'] = $this->_model->getManHasAddress();
            $data_1['getManHasPhone'] = $this->_model->getManHasPhone();
            $data_1['getManHasEmail'] = $this->_model->getManHasEmail();
            $data_1['getMoreDataMan'] = $this->_model->getMoreDataMan();
            $data_1['getManHasOperationCategory'] = $this->_model->getManHasOperationCategory();
            $data_1['getCountrySearchMan'] = $this->_model->getCountrySearchMan();
            $data_1['getManHasEducation'] = $this->_model->getManHasEducation();
            $data_1['getManHasParty']= $this->_model->getManHasParty();
            $data_1['getManHasWorkActivity'] = $this->_model->getManHasWorkActivity();
            $data_1['getManBeanCountry'] = $this->_model->getManBeanCountry();
            $data_1['getManExternalSignHasSign'] = $this->_model->getManExternalSignHasSign();
            $data_1['getManExternalSignHasPhoto'] = $this->_model->getManExternalSignHasPhoto();
            $data_1['getManHasNickname'] = $this->_model->getManHasNickname();
            $data_1['getManHasObjectsOrganization'] = $this->_model->getManHasObjectsOrganization();
            $data_1['getManHasObjectsMan'] = $this->_model->getManHasObjectsMan();
            $data_1['getManHasAction'] = $this->_model->getManHasAction();
            $data_1['getManHasEvent'] = $this->_model->getManHasEvent();
            $data_1['getManPassedBySignal'] = $this->_model->getManPassedBySignal();
            $data_1['getManCheckedBySignal'] = $this->_model->getManCheckedBySignal();
            $data_1['getManHasCriminalCase'] = $this->_model->getManHasCriminalCase();
            $data_1['getManPassesMiaSummary'] = $this->_model->getManPassesMiaSummary();
            $data_1['getManHasCar'] = $this->_model->getManHasCar();
            $data_1['getManHasWeapon'] = $this->_model->getManHasWeapon();
            $data_1['getManUseCar'] = $this->_model->getManUseCar();
            $data_1['getManHasAnswer'] = $this->_model->getManHasAnswer();
            $data_1['getManToMan'] = $this->_model->getManToMan();
            $data_1['getManHasFile'] = $this->_model->getManHasFile();
            $this->_view->set('data_chek',$data_1);
            $this->_view->set('navigationItem',$this->Lang->face);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_man() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_man($data);
            $this->_model->logging('fusion','man',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/man');
        }
    }

    public function getMoreDateMan_full($id) {
        try {
            $data = $this->_model->getMoreDataMan_full($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function getManHasAnswer_full($id) {
        try {
            $data = $this->_model->getManHasAnswer_full($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


//-------------------------------------------------------------END MAN---------------------------------------------------------

//------------------------------------------------------------- ORGANIZATION---------------------------------------------------------
    public function organization(){
        try {
            $data = $this->_model->organization();
            $this->_view->set('data',$data);
            $data_1['getOrganizationHasAddress'] = $this->_model->getOrganizationHasAddress();
            $data_1['getOrganizationHasPhone'] = $this->_model->getOrganizationHasPhone();
            $data_1['getOrganizationHasEmail'] = $this->_model->getOrganizationHasEmail();
            $data_1['getOrganizationHasEvent'] = $this->_model->getOrganizationHasEvent();
            $data_1['getOrganizationObjectsRelation'] = $this->_model->getOrganizationObjectsRelation();
            $data_1['getOrganizationHasCriminalCase'] = $this->_model->getOrganizationHasCriminalCase();
            $data_1['getOrganizationHasAction'] = $this->_model->getOrganizationHasAction();
            $data_1['getOrganizationHasMan'] = $this->_model->getOrganizationHasMan();
            $data_1['getOrganizationCheckedBySignal'] = $this->_model->getOrganizationCheckedBySignal();
            $data_1['getOrganizationPassesBySignal'] = $this->_model->getOrganizationPassesBySignal();
            $data_1['getOrganizationHasCar'] = $this->_model->getOrganizationHasCar();
            $data_1['getOrganizationHasWeapon'] = $this->_model->getOrganizationHasWeapon();
            $data_1['getOrganizationHasMiaSummary'] = $this->_model->getOrganizationHasMiaSummary();
            $data_1['getOrganizationEvent'] = $this->_model->getOrganizationEvent();
            $data_1['getOrganizationToOrganization'] = $this->_model->getOrganizationToOrganization();
            $data_1['getBibliography'] = $this->_model->getBibliographyOrganization();
            $this->_view->set('data_chek',$data_1);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function fusion_organization() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_organization($data);
            $this->_model->logging('fusion','organization',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/organization');
        }
    }



//
//-------------------------------------------------------------END ORGANIZATION---------------------------------------------------------

//-------------------------------------------------------------BIBLIOGRAPHY---------------------------------------------------------

    public function bibliography() {
        try {
            $data = $this->_model->bibliography();
            $this->_view->set('data',$data);
            $data_1['getBibliographyHasMan'] = $this->_model->getBibliographyHasMan();
            $data_1['getBibliographyHasOrganization'] = $this->_model->getBibliographyHasOrganization();
            $data_1['getBibliographyHasEvent'] = $this->_model->getBibliographyHasEvent();
            $data_1['getBibliographyHasSignal'] = $this->_model->getBibliographyHasSignal();
            $data_1['getBibliographyHasCriminalCase'] = $this->_model->getBibliographyHasCriminalCase();
            $data_1['getBibliographyHasAction'] = $this->_model->getBibliographyHasAction();
            $data_1['getBibliographyHasControl'] = $this->_model->getBibliographyHasControl();
            $data_1['getBibliographyHasMiaSummary'] = $this->_model->getBibliographyHasMiaSummary();
            $data_1['getBibliographyHasCountry'] = $this->_model->getBibliographyHasCountry();
            $data_1['getBibliographyHasFile'] = $this->_model->getBibliographyHasFile();
            $this->_view->set('data_chek',$data_1);
            $this->_view->set('navigationItem',$this->Lang->bibliography);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //Fusion Control
    public function fusion_bibliography() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_bibliography($data);
            $this->_model->logging('fusion','bibliography',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/bibliography');
        }
    }
//----------------------------------------------------------- END BIBLIOGRAPHY------------------------------------------------------


//-------------------------------------------------------------------------   CONTROL    -----------------------------------------------------------------

    public function control(){
        try {
            $data = $this->_model->control();
            $this->_view->set('data',$data);
            $this->_view->set('navigationItem',$this->Lang->control);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_control() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_control($data);
            $this->_model->logging('fusion','control',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/control');
        }
    }

        //-------------------------------------------------------------------------  END CONTROL    -----------------------------------------------------------------

        //-------------------------------------------------------------------------   KEEP SIGNAL    -----------------------------------------------------------------
    public function keep_signal(){
        try {
            $data = $this->_model->keep_signal();
            $this->_view->set('data',$data);
            $keep_signal_worker = $this->_model->keep_signal_worker();
            $keep_signal_worker_post = $this->_model->keep_signal_worker_post();
            $this->_view->set('keep_signal_worker',$keep_signal_worker);
            $this->_view->set('keep_signal_worker_post',$keep_signal_worker_post);
            $this->_view->set('navigationItem',$this->Lang->keep_signal);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_keep_signal() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_keep_signal($data);
            $this->_model->logging('fusion','keep_signal',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/keep_signal');
        }
    }

        //-------------------------------------------------------------------------  END KEEP SIGNAL    -----------------------------------------------------------------

    //-------------------------------------------------------------------------   MAN BEAN COUNTRY    -----------------------------------------------------------------
    public function man_bean_country(){
        try {
            $data = $this->_model->man_bean_country();
            $this->_view->set('data',$data);
            $this->_view->set('navigationItem',$this->Lang->man_bean_country);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_man_bean_country() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_man_bean_country($data);
            $this->_model->logging('fusion','man_beann_country',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/man_beann_country');
        }
    }
    //-------------------------------------------------------------------------  END MAN BEAN COUNTRY    -----------------------------------------------------------------

//-------------------------------------------------------------------------   CAR    -----------------------------------------------------------------
    public function car(){
        try {
            $data = $this->_model->car();
            $this->_view->set('data',$data);
            $data_1['getCarHasMan'] = $this->_model->getCarHasMan();
            $data_1['getCarHasOrganization'] = $this->_model->getCarHasOrganization();
            $data_1['getCarUseMan'] = $this->_model->getCarUseMan();
            $data_1['getCarHasAddress'] = $this->_model->getCarHasAddress();
            $data_1['getCarHasAction'] = $this->_model->getCarHasAction();
            $data_1['getCarHasEvent'] = $this->_model->getCarHasEvent();
            $this->_view->set('data_chek',$data_1);
            $this->_view->set('navigationItem',$this->Lang->car);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_car() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_car($data);
            $this->_model->logging('fusion','car',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/car');
        }
    }
//-------------------------------------------------------------------------  END CAR    -----------------------------------------------------------------

    //-------------------------------------------------------------------------   WEAPON    -----------------------------------------------------------------
    public function weapon(){
        try {
            $data = $this->_model->weapon();
            $this->_view->set('data',$data);
            $data_1['getWeaponHasMan'] = $this->_model->getWeaponHasMan();
            $data_1['getWeaponHasOrganization'] = $this->_model->getWeaponHasOrganization();
            $data_1['getWeaponHasAction'] = $this->_model->getWeaponHasAction();
            $data_1['getWeaponHasEvent'] = $this->_model->getWeaponHasEvent();
            $this->_view->set('data_chek',$data_1);
            $this->_view->set('navigationItem',$this->Lang->weapon);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_weapon() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_weapon($data);
            $this->_model->logging('fusion','weapon',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/weapon');
        }
    }
    //-------------------------------------------------------------------------  END WEAPON    -----------------------------------------------------------------

    //-------------------------------------------------------------------------   EVENT   -----------------------------------------------------------------
    public function event(){
        try {
            $data = $this->_model->event();
            $this->_view->set('data',$data);
            $data_1['getEventHasQualification'] = $this->_model->getEventHasQualification();
            $data_1['getEventHasAction'] = $this->_model->getEventHasAction();
            $data_1['getEventHasSignal'] = $this->_model->getEventHasSignal();
            $data_1['getEvenActionHasEvent'] = $this->_model->getEvenActionHasEvent();
            $data_1['getEventHasCar'] = $this->_model->getEventHasCar();
            $data_1['getEventHasWeapon'] = $this->_model->getEventHasWeapon();
            $data_1['getEventHasOrganization'] = $this->_model->getEventHasOrganization();
            $data_1['getEventHasMan'] = $this->_model->getEventHasMan();
            $data_1['getEventHasCriminalCase'] = $this->_model->getEventHasCriminalCase();
            $this->_view->set('data_chek',$data_1);
            $this->_view->set('navigationItem',$this->Lang->event);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_event() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_event($data);
            $this->_model->logging('fusion','event',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/event');
        }
    }
    //------------------------------------------------------------------------- END  EVENT   -----------------------------------------------------------------

    //-------------------------------------------------------------------------   ACTION   -----------------------------------------------------------------
    public function action(){
        try {
            $data = $this->_model->action();
            $this->_view->set('data',$data);
            $data_1['getActionHasEvent'] = $this->_model->getActionHasEvent();
            $data_1['getActionEventHasAction'] = $this->_model->getActionEventHasAction();
            $data_1['getActionHasMan'] = $this->_model->getActionHasMan();
            $data_1['getActionHasOrganization'] = $this->_model->getActionHasOrganization();
            $data_1['getActionHasPhone'] = $this->_model->getActionHasPhone();
            $data_1['getActionHasWeapon'] = $this->_model->getActionHasWeapon();
            $data_1['getActionHasCar'] = $this->_model->getActionHasCar();
            $data_1['getActionPassesSignal'] = $this->_model->getActionPassesSignal();
            $data_1['getActionHasMaterialContent'] = $this->_model->getActionHasMaterialContent();
            $data_1['getActionHasQualification'] = $this->_model->getActionHasQualification();
            $data_1['getActionHasCriminalCase'] = $this->_model->getActionHasCriminalCase();
            $data_1['getActionToAction'] = $this->_model->getActionToAction();
            $this->_view->set('data_chek',$data_1);
            $this->_view->set('navigationItem',$this->Lang->action);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_action() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_action($data);
            $this->_model->logging('fusion','action',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/action');
        }
    }
    //------------------------------------------------------------------------- END  ACTION   -----------------------------------------------------------------

        //-------------------------------------------------------------------------   ADDRESS   -----------------------------------------------------------------
    public function address(){
        try {
            $data = $this->_model->address();
            $this->_view->set('data',$data);
            $data_1['getAddressHasAction'] = $this->_model->getAddressHasAction();
            $data_1['getAddressHasEvent'] = $this->_model->getAddressHasEvent();
            $data_1['getAddressHasMan'] = $this->_model->getAddressHasMan();
            $data_1['getAddressHasOrganization'] = $this->_model->getWeaponHasOrganization();
            $data_1['getAddressHasCar'] = $this->_model->getAddressHasCar();
            $data_1['getAddressOrganization'] = $this->_model->getAddressOrganization();
            $this->_view->set('data_chek',$data_1);
            $this->_view->set('navigationItem',$this->Lang->address);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_address() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_address($data);
            $this->_model->logging('fusion','address',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/address');
        }
    }
    //------------------------------------------------------------------------- END  ADDRESS   -----------------------------------------------------------------

    //-------------------------------------------------------------------------  WORK ACTIVITY   -----------------------------------------------------------------
    public function work_activity(){
        try {
            $data = $this->_model->work_activity();
            $this->_view->set('data',$data);
            $this->_view->set('navigationItem',$this->Lang->work_activity);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_work_activity() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_work_activity($data);
            $this->_model->logging('fusion','organization_has_man',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/work_activity');
        }
    }
        //------------------------------------------------------------------------- END WORK ACTIVITY   -----------------------------------------------------------------

        //-------------------------------------------------------------------------  MIA SUMMARY   -----------------------------------------------------------------
    public function mia_summary(){
        try {
            $data = $this->_model->mia_summary();
            $this->_view->set('data',$data);
            $data_1['getMiaSummaryHasMan'] = $this->_model->getMiaSummaryHasMan();
            $data_1['getMiaSummaryHasOrganization'] = $this->_model->getMiaSummaryHasOrganization();
            $this->_view->set('data_chek',$data_1);
            $this->_view->set('navigationItem',$this->Lang->mia_summary);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_mia_summary() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_mia_summary($data);
            $this->_model->logging('fusion','mia_summary',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/mia_summary');
        }
    }
    //------------------------------------------------------------------------- END MIA SUMMARY   -----------------------------------------------------------------


    //-------------------------------------------------------------------------  CRIMINAL CASE  -----------------------------------------------------------------
    public function criminal_case(){
        try {
            $data = $this->_model->criminal_case();
            $this->_view->set('data',$data);
            $data_1['getCriminalCaseHasMan'] = $this->_model->getCriminalCaseHasMan();
            $data_1['getCriminalCaseHasOrganization'] = $this->_model->getCriminalCaseHasOrganization();
            $data_1['getCriminalCaseHasAction'] = $this->_model->getCriminalCaseHasAction();
            $data_1['getCriminalCaseHasEvent'] = $this->_model->getCriminalCaseHasEvent();
            $data_1['getCriminalCaseExtracted'] = $this->_model->getCriminalCaseExtracted();
            $data_1['getCriminalCaseSplited'] = $this->_model->getCriminalCaseSplited();
            $data_1['getCriminalCaseWorker'] = $this->_model->getCriminalCaseWorker();
            $data_1['getCriminalCaseWorkerPost'] = $this->_model->getCriminalCaseWorkerPost();
            $data_1['getCriminalCaseHasSignal'] = $this->_model->getCriminalCaseHasSignal();

            $this->_view->set('data_chek',$data_1);
            $this->_view->set('navigationItem',$this->Lang->criminal);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_criminal_case() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_criminal_case($data);
            $this->_model->logging('fusion','criminal_case',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/criminal_case');
        }
    }
    //------------------------------------------------------------------------- END CRIMINAL CASE  -----------------------------------------------------------------

    //-------------------------------------------------------------------------  SIGNAL  -----------------------------------------------------------------
    public function signal(){
        try {
            $data = $this->_model->signal();
            $this->_view->set('data',$data);
            $data_1['getSignalCriminalCase'] = $this->_model->getSignalCriminalCase();
            $data_1['getSignalHasMan'] = $this->_model->getSignalHasMan();
            $data_1['getSignalPassedByMan'] = $this->_model->getSignalPassedByMan();
            $data_1['getSignalCheckedByOrganization'] = $this->_model->getSignalCheckedByOrganization();
            $data_1['getSignalPassesByOrganization'] = $this->_model->getSignalPassesByOrganization();
            $data_1['getSignalPassesAction'] = $this->_model->getSignalPassesAction();
            $data_1['getSignalPassesEvent'] = $this->_model->getSignalPassesEvent();
            $data_1['getSignalKeepSignal'] = $this->_model->getSignalKeepSignal();
            $data_1['getSignalWorker'] = $this->_model->getSignalWorker();
            $data_1['getSignalWorkerPost'] = $this->_model->getSignalWorkerPost();
            $data_1['getSignalCheckingWorker'] = $this->_model->getSignalCheckingWorker();
            $data_1['getSignalCheckingWorkerPost'] = $this->_model->getSignalCheckingWorkerPost();
            $this->_view->set('data_chek',$data_1);
            $this->_view->set('navigationItem',$this->Lang->signal);
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function fusion_signal() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = $_POST;
            $this->_model->fusion_signal($data);
            $this->_model->logging('fusion','signal',$data['id'],$data['deleted_id']);
            header('Location: '.ROOT.'open/signal');
        }
    }
    //------------------------------------------------------------------------- END SIGNAL  -----------------------------------------------------------------



}