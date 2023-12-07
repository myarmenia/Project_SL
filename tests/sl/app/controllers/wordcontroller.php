<?php

class WordController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
        ini_set('display_errors',0);
    }

    public function action($action_id)
    {
        try {
            $action = $this->_model->getAction($action_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','action',$action_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $action['id']);
            if(!empty($action['start_date'])){
                $valuesTable[] = array( $this->Lang->start_action_date , $action['start_date']);
            }
            if(!empty($action['end_date'])){
                $valuesTable[] = array( $this->Lang->end_action_date , $action['end_date']);
            }
            if(!empty($action['material_content'])){
                $valuesTable[] = array( $this->Lang->content_materials_actions , $action['material_content']);
            }
            if(!empty($action['action_qualification'])){
                $valuesTable[] = array( $this->Lang->qualification_fact , $action['action_qualification']);
            }
            if(!empty($action['duration'])){
                $valuesTable[] = array( $this->Lang->duration_action , $action['duration']);
            }
            if(!empty($action['action_goal'])){
                $valuesTable[] = array( $this->Lang->purpose_motive_reason , $action['action_goal']);
            }
            if(!empty($action['terms'])){
                $valuesTable[] = array( $this->Lang->terms_actions , $action['terms']);
            }
            if(!empty($action['aftermath'])){
                $valuesTable[] = array( $this->Lang->ensuing_effects , $action['aftermath']);
            }
            if(!empty($action['source'])){
                $valuesTable[] = array( $this->Lang->source_information_actions , $action['source']);
            }
            if(!empty($action['opened_dou'])){
                $valuesTable[] = array( $this->Lang->opened_dou , $action['opened_dou']);
            }


            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function address($address_id)
    {
        try {
            $address = $this->_model->getAddress($address_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','address',$address_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $address['id']);
            if(!empty($address['country_ate'])){
                $valuesTable[] = array( $this->Lang->country_ate , $address['country_ate']);
            }
            if(!empty($address['region'])){
                $valuesTable[] = array( $this->Lang->region , $address['region']);
            }
            if(!empty($address['locality'])){
                $valuesTable[] = array( $this->Lang->locality , $address['locality']);
            }
            if(!empty($address['street'])){
                $valuesTable[] = array( $this->Lang->street , $address['street']);
            }
            if(!empty($address['track'])){
                $valuesTable[] = array( $this->Lang->track , $address['track']);
            }
            if(!empty($address['home_num'])){
                $valuesTable[] = array( $this->Lang->home_num , $address['home_num']);
            }
            if(!empty($address['housing_num'])){
                $valuesTable[] = array( $this->Lang->housing_num , $address['housing_num']);
            }
            if(!empty($address['apt_num'])){
                $valuesTable[] = array( $this->Lang->apt_num , $address['apt_num']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
//                'float' => array(
//                    'textMargin_top' => 400
//                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function car($car_id)
    {
        try {
            $car = $this->_model->getCar($car_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','car',$car_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $car['id']);
            if(!empty($car['car_category'])){
                $valuesTable[] = array( $this->Lang->car_cat , $car['car_category']);
            }
            if(!empty($car['car_mark'])){
                $valuesTable[] = array( $this->Lang->mark , $car['car_mark']);
            }
            if(!empty($car['car_color'])){
                $valuesTable[] = array( $this->Lang->color , $car['car_color']);
            }
            if(!empty($car['number'])){
                $valuesTable[] = array( $this->Lang->car_number , $car['number']);
            }
            if(!empty($car['count'])){
                $valuesTable[] = array( $this->Lang->count , $car['count']);
            }
            if(!empty($car['note'])){
                $valuesTable[] = array( $this->Lang->additional_data , $car['note']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function control($control_id)
    {
        try {
            $control = $this->_model->getControl($control_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','control',$control_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $control['id']);
            if(!empty($control['unit'])){
                $valuesTable[] = array( $this->Lang->unit , $control['unit']);
            }
            if(!empty($control['doc_category'])){
                $valuesTable[] = array( $this->Lang->document_category , $control['doc_category']);
            }
            if(!empty($control['reg_num'])){
                $valuesTable[] = array( $this->Lang->reg_document , $control['reg_num']);
            }
            if(!empty($control['snb_director'])){
                $valuesTable[] = array( $this->Lang->director , $control['snb_director']);
            }
            if(!empty($control['snb_subdirector'])){
                $valuesTable[] = array( $this->Lang->deputy_director , $control['snb_subdirector']);
            }
            if(!empty($control['resolution_date'])){
                $valuesTable[] = array( $this->Lang->date_resolution , $control['resolution_date']);
            }
            if(!empty($control['resolution'])){
                $valuesTable[] = array( $this->Lang->resolution , $control['resolution']);
            }
            if(!empty($control['act_unit'])){
                $valuesTable[] = array( $this->Lang->department_performer , $control['act_unit']);
            }
            if(!empty($control['actor_name'])){
                $valuesTable[] = array( $this->Lang->actor_name , $control['actor_name']);
            }
            if(!empty($control['sub_act_unit'])){
                $valuesTable[] = array( $this->Lang->department_coauthors , $control['sub_act_unit']);
            }
            if(!empty($control['sub_actor_name'])){
                $valuesTable[] = array( $this->Lang->sub_actor_name , $control['sub_actor_name']);
            }
            if(!empty($control['result'])){
                $valuesTable[] = array( $this->Lang->result_execution , $control['result']);
            }
            if(!empty($control['creation_date'])){
                $valuesTable[] = array( $this->Lang->document_date , $control['creation_date']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function control_with_joins($control_id)
    {
        try {
            $control = $this->_model->getControl($control_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','control',$control_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $control['id']);
            if(!empty($control['unit'])){
                $valuesTable[] = array( $this->Lang->unit , $control['unit']);
            }
            if(!empty($control['doc_category'])){
                $valuesTable[] = array( $this->Lang->document_category , $control['doc_category']);
            }
            if(!empty($control['reg_num'])){
                $valuesTable[] = array( $this->Lang->reg_document , $control['reg_num']);
            }
            if(!empty($control['snb_director'])){
                $valuesTable[] = array( $this->Lang->director , $control['snb_director']);
            }
            if(!empty($control['snb_subdirector'])){
                $valuesTable[] = array( $this->Lang->deputy_director , $control['snb_subdirector']);
            }
            if(!empty($control['resolution_date'])){
                $valuesTable[] = array( $this->Lang->date_resolution , $control['resolution_date']);
            }
            if(!empty($control['resolution'])){
                $valuesTable[] = array( $this->Lang->resolution , $control['resolution']);
            }
            if(!empty($control['act_unit'])){
                $valuesTable[] = array( $this->Lang->department_performer , $control['act_unit']);
            }
            if(!empty($control['actor_name'])){
                $valuesTable[] = array( $this->Lang->actor_name , $control['actor_name']);
            }
            if(!empty($control['sub_act_unit'])){
                $valuesTable[] = array( $this->Lang->department_coauthors , $control['sub_act_unit']);
            }
            if(!empty($control['sub_actor_name'])){
                $valuesTable[] = array( $this->Lang->sub_actor_name , $control['sub_actor_name']);
            }
            if(!empty($control['result'])){
                $valuesTable[] = array( $this->Lang->result_execution , $control['result']);
            }
            if(!empty($control['creation_date'])){
                $valuesTable[] = array( $this->Lang->document_date , $control['creation_date']);
            }

            $bibliography = $this->_model->getBibliography($control['bibliography_id']);

            $valuesTable2 = array();
            $valuesTable2[] = array( 'id' , $bibliography['id']);
            if(!empty($bibliography['user_name'])){
                $valuesTable2[] = array( $this->Lang->worker_take_doc , $bibliography['user_name']);
            }
            if(!empty($bibliography['access_level'])){
                $valuesTable2[] = array( $this->Lang->access_level , $bibliography['access_level']);
            }
            if(!empty($bibliography['source_agency_name'])){
                $valuesTable2[] = array( $this->Lang->source_agency , $bibliography['source_agency_name']);
            }
            if(!empty($bibliography['from_agency_name'])){
                $valuesTable2[] = array( $this->Lang->organ , $bibliography['from_agency_name']);
            }
            if(!empty($bibliography['source'])){
                $valuesTable2[] = array( $this->Lang->source_inf , $bibliography['source']);
            }
            if(!empty($bibliography['short_desc'])){
                $valuesTable2[] = array( $this->Lang->short_desc , $bibliography['short_desc']);
            }
            if(!empty($bibliography['related_year'])){
                $valuesTable2[] = array( $this->Lang->related_year , $bibliography['related_year']);
            }
            if(!empty($bibliography['source_address'])){
                $valuesTable2[] = array( $this->Lang->source_address , $bibliography['source_address']);
            }
            if(!empty($bibliography['worker_name'])){
                $valuesTable2[] = array( $this->Lang->worker_name , $bibliography['worker_name']);
            }
            if(!empty($bibliography['reg_number'])){
                $valuesTable2[] = array( $this->Lang->reg_number , $bibliography['reg_number']);
            }
            if(!empty($bibliography['reg_date'])){
                $valuesTable2[] = array( $this->Lang->reg_date , $bibliography['reg_date']);
            }
            if(!empty($bibliography['created_at'])){
                $valuesTable2[] = array( $this->Lang->date_and_time , $bibliography['created_at']);
            }



            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );

            $docx->addText($this->Lang->control);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $docx->addBreak();

            $docx->addText($this->Lang->bibliography);
            $docx->addBreak();
            $docx->addTable($valuesTable2, $paramsTable);

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }



    public function criminal_case($criminal_case_id)
    {
        try {
            $criminal_case = $this->_model->getCriminalCase($criminal_case_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','criminal_case',$criminal_case_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $criminal_case['id']);
            if(!empty($criminal_case['number'])){
                $valuesTable[] = array( $this->Lang->number_case , $criminal_case['number']);
            }
            if(!empty($criminal_case['opened_date'])){
                $valuesTable[] = array( $this->Lang->criminal_proceedings_date , $criminal_case['opened_date']);
            }
            if(!empty($criminal_case['artical'])){
                $valuesTable[] = array( $this->Lang->criminal_code , $criminal_case['artical']);
            }
            if(!empty($criminal_case['opened_dou'])){
                $valuesTable[] = array( $this->Lang->initiated_dow , $criminal_case['opened_dou']);
            }
            if(!empty($criminal_case['character'])){
                $valuesTable[] = array( $this->Lang->nature_materials_paint , $criminal_case['character']);
            }
            if(!empty($criminal_case['worker'])){
                $valuesTable[] = array( $this->Lang->name_operatives , $criminal_case['worker']);
            }
            if(!empty($criminal_case['worker_post'])){
                $valuesTable[] = array( $this->Lang->worker_post , $criminal_case['worker_post']);
            }
            if(!empty($criminal_case['opened_agency'])){
                $valuesTable[] = array( $this->Lang->materials_management , $criminal_case['opened_agency']);
            }
            if(!empty($criminal_case['opened_unit'])){
                $valuesTable[] = array( $this->Lang->head_department , $criminal_case['opened_unit']);
            }
            if(!empty($criminal_case['subunit'])){
                $valuesTable[] = array( $this->Lang->instituted_units , $criminal_case['subunit']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function email($email_id)
    {
        try {
            $email = $this->_model->getEmail($email_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','email',$email_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $email['id']);
            if(!empty($email['address'])){
                $valuesTable[] = array( $this->Lang->address , $email['address']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function event($event_id)
    {
        try {
            $event = $this->_model->getEvent($event_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','event',$event_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $event['id']);
            if(!empty($event['qualification'])){
                $valuesTable[] = array( $this->Lang->qualification_event , $event['qualification']);
            }
            if(!empty($event['date'])){
                $valuesTable[] = array( $this->Lang->date_security_date , $event['date']);
            }
            if(!empty($event['aftermath'])){
                $valuesTable[] = array( $this->Lang->ensuing_effects , $event['aftermath']);
            }
            if(!empty($event['result'])){
                $valuesTable[] = array( $this->Lang->results_event , $event['result']);
            }
            if(!empty($event['agency'])){
                $valuesTable[] = array( $this->Lang->investigation_requested , $event['agency']);
            }
            if(!empty($event['resource'])){
                $valuesTable[] = array( $this->Lang->source_event , $event['resource']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function keep_signal($keep_signal_id)
    {
        try {
            $keep_signal = $this->_model->getKeepSignal($keep_signal_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','keep_signal',$keep_signal_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $keep_signal['id']);
            if(!empty($keep_signal['agency'])){
                $valuesTable[] = array( $this->Lang->management_signal , $keep_signal['agency']);
            }
            if(!empty($keep_signal['unit'])){
                $valuesTable[] = array( $this->Lang->department_checking_signal , $keep_signal['unit']);
            }
            if(!empty($keep_signal['sub_unit'])){
                $valuesTable[] = array( $this->Lang->unit_signal , $keep_signal['sub_unit']);
            }
            if(!empty($keep_signal['pased_sub_unit'])){
                $valuesTable[] = array( $this->Lang->unit_signal_transmitted , $keep_signal['pased_sub_unit']);
            }
            if(!empty($keep_signal['worker'])){
                $valuesTable[] = array( $this->Lang->name_operatives , $keep_signal['worker']);
            }
            if(!empty($keep_signal['worker_post'])){
                $valuesTable[] = array( $this->Lang->worker_post , $keep_signal['worker_post']);
            }
            if(!empty($keep_signal['start_date'])){
                $valuesTable[] = array( $this->Lang->start_checking_signal , $keep_signal['start_date']);
            }
            if(!empty($keep_signal['end_date'])){
                $valuesTable[] = array( $this->Lang->end_checking_signal , $keep_signal['end_date']);
            }
            if(!empty($keep_signal['pass_date'])){
                $valuesTable[] = array( $this->Lang->date_transfer_unit , $keep_signal['pass_date']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function keep_signal_with_joins($keep_signal_id)
    {
        try {

            $keep_signal = $this->_model->getKeepSignal($keep_signal_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','keep_signal',$keep_signal_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $keep_signal['id']);
            if(!empty($keep_signal['agency'])){
                $valuesTable[] = array( $this->Lang->management_signal , $keep_signal['agency']);
            }
            if(!empty($keep_signal['unit'])){
                $valuesTable[] = array( $this->Lang->department_checking_signal , $keep_signal['unit']);
            }
            if(!empty($keep_signal['sub_unit'])){
                $valuesTable[] = array( $this->Lang->unit_signal , $keep_signal['sub_unit']);
            }
            if(!empty($keep_signal['pased_sub_unit'])){
                $valuesTable[] = array( $this->Lang->unit_signal_transmitted , $keep_signal['pased_sub_unit']);
            }
            if(!empty($keep_signal['worker'])){
                $valuesTable[] = array( $this->Lang->name_operatives , $keep_signal['worker']);
            }
            if(!empty($keep_signal['worker_post'])){
                $valuesTable[] = array( $this->Lang->worker_post , $keep_signal['worker_post']);
            }
            if(!empty($keep_signal['start_date'])){
                $valuesTable[] = array( $this->Lang->start_checking_signal , $keep_signal['start_date']);
            }
            if(!empty($keep_signal['end_date'])){
                $valuesTable[] = array( $this->Lang->end_checking_signal , $keep_signal['end_date']);
            }
            if(!empty($keep_signal['pass_date'])){
                $valuesTable[] = array( $this->Lang->date_transfer_unit , $keep_signal['pass_date']);
            }



            $signal = $this->_model->getSignal($keep_signal['signal_id']);

            $valuesTable2 = array();
            $valuesTable2[] = array( 'id' ,  $signal['id']);
            if(!empty($signal['reg_num'])){
                $valuesTable2[] = array( $this->Lang->reg_number_signal , $signal['reg_num']);
            }
            if(!empty($signal['content'])){
                $valuesTable2[] = array( $this->Lang->contents_information_signal , $signal['content']);
            }
            if(!empty($signal['check_line'])){
                $valuesTable2[] = array( $this->Lang->line_which_verified , $signal['check_line']);
            }
            if(!empty($signal['check_status'])){
                $valuesTable2[] = array( $this->Lang->check_status_charter , $signal['check_status']);
            }
            if(!empty($signal['signal_qualification'])){
                $valuesTable2[] = array( $this->Lang->qualifications_signaling , $signal['signal_qualification']);
            }
            if(!empty($signal['check_agency'])){
                $valuesTable2[] = array( $this->Lang->checks_signal , $signal['check_agency']);
            }
            if(!empty($signal['check_unit'])){
                $valuesTable2[] = array( $this->Lang->department_checking , $signal['check_unit']);
            }
            if(!empty($signal['check_subunit'])){
                $valuesTable2[] = array( $this->Lang->unit_testing , $signal['check_subunit']);
            }
            if(!empty($signal['subunit_date'])){
                $valuesTable2[] = array( $this->Lang->date_registration_division , $signal['subunit_date']);
            }
            if(!empty($signal['check_date'])){
                $valuesTable2[] = array( $this->Lang->check_date , $signal['check_date']);
            }
            if(!empty($signal['checking_worker'])){
                $valuesTable2[] = array( $this->Lang->name_checking_signal , $signal['checking_worker']);
            }
            if(!empty($signal['checking_worker_post'])){
                $valuesTable2[] = array( $this->Lang->worker_post , $signal['checking_worker_post']);
            }
            if(!empty($signal['check_date_id'])){
                $valuesTable2[] = array( $this->Lang->check_previously , $signal['check_date_id']);
            }
            if(!empty($signal['end_date'])){
                $valuesTable2[] = array( $this->Lang->date_actual_word , $signal['end_date']);
            }
            if(!empty($signal['opened_dou'])){
                $valuesTable2[] = array( $this->Lang->according_result_dow , $signal['opened_dou']);
            }
            if(!empty($signal['resource'])){
                $valuesTable2[] = array( $this->Lang->useful_capabilities , $signal['resource']);
            }
            if(!empty($signal['opened_agency'])){
                $valuesTable2[] = array( $this->Lang->brought_signal , $signal['opened_agency']);
            }
            if(!empty($signal['opened_unit'])){
                $valuesTable2[] = array( $this->Lang->department_brought , $signal['opened_unit']);
            }
            if(!empty($signal['opened_subunit'])){
                $valuesTable2[] = array( $this->Lang->unit_brought , $signal['opened_subunit']);
            }
            if(!empty($signal['worker'])){
                $valuesTable2[] = array( $this->Lang->name_operatives , $signal['worker']);
            }
            if(!empty($signal['worker_post'])){
                $valuesTable2[] = array( $this->Lang->worker_post , $signal['worker_post']);
            }
            if(!empty($signal['resource'])){
                $valuesTable2[] = array( $this->Lang->source_category , $signal['resource']);
            }
            if(!empty($signal['signal_result'])){
                $valuesTable2[] = array( $this->Lang->signal_results , $signal['signal_result']);
            }
            if(!empty($signal['taken_measure_id'])){
                $valuesTable2[] = array( $this->Lang->measures_taken , $signal['taken_measure_id']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );


            $docx->addText($this->Lang->keep_signal);
            $docx->addBreak();

            $docx->addTable($valuesTable, $paramsTable);


            $docx->addText($this->Lang->signal);
            $docx->addBreak();
            $docx->addTable($valuesTable2, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }


    }


    public function man($man_id)
    {
        try {
            $man = $this->_model->getMan($man_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','man',$man_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $man['id']);
            if(!empty($man['first_name'])){
                $valuesTable[] = array( $this->Lang->first_name , $man['first_name']);
            }
            if(!empty($man['last_name'])){
                $valuesTable[] = array( $this->Lang->last_name , $man['last_name']);
            }
            if(!empty($man['middle_name'])){
                $valuesTable[] = array( $this->Lang->middle_name , $man['middle_name']);
            }
            if( !empty($man['middle_name']) || !empty($man['last_name']) || !empty($man['first_name']) ){
                $valuesTable[] = array( $this->Lang->first_name.' '.$this->Lang->last_name.' '.$this->Lang->middle_name , $man['first_name'].','.$man['last_name'].','.$man['middle_name']);
            }
            if(!empty($man['passport'])){
                $valuesTable[] = array( $this->Lang->passport_number , $man['passport']);
            }
            if(!empty($man['gender'])){
                $valuesTable[] = array( $this->Lang->gender , $man['gender']);
            }
            if(!empty($man['country'])){
                $valuesTable[] = array( $this->Lang->citizenship , $man['country']);
            }
            if(!empty($man['religion'])){
                $valuesTable[] = array( $this->Lang->worship , $man['religion']);
            }
            if(!empty($man['country_ate'])){
                $valuesTable[] = array( $this->Lang->place_of_birth , $man['country_ate']);
            }
            if(!empty($man['locality_id'])){
                $lang = $this->Lang->place_of_birth_settlement;
                if(!empty($man['address_locality_country_id'])){
                    $lang =  $this->Lang->place_of_birth_settlement_local;
                }
                $valuesTable[] = array( $lang , $man['locality_id']);
            }
            if(!empty($man['region_id'])){
                $lang = $this->Lang->place_of_birth_area;
                if(!empty($man['address_region_country_id'])){
                    $lang =  $this->Lang->place_of_birth_area_local;
                }
                $valuesTable[] = array( $lang, $man['region_id']);
            }
            if(!empty($man['education'])){
                $valuesTable[] = array( $this->Lang->education , $man['education']);
            }
            if(!empty($man['language'])){
                $valuesTable[] = array( $this->Lang->knowledge_of_languages , $man['language']);
            }
            if(!empty($man['party'])){
                $valuesTable[] = array( $this->Lang->party , $man['party']);
            }
            if(!empty($man['citizenship'])){
                $valuesTable[] = array( $this->Lang->citizenship , $man['citizenship']);
            }
            if(!empty($man['country'])){
                $valuesTable[] = array( $this->Lang->country_carrying_out_search , $man['country']);
            }
            if(!empty($man['nation'])){
                $valuesTable[] = array( $this->Lang->nationality , $man['nation']);
            }
            if(!empty($man['nickname'])){
                $valuesTable[] = array( $this->Lang->alias , $man['nickname']);
            }
            if(!empty($man['operation_category'])){
                $valuesTable[] = array( $this->Lang->operational_category_person , $man['operation_category']);
            }
            if(!empty($man['birthday'])){
                $valuesTable[] = array( $this->Lang->date_of_birth , $man['birthday']);
            }
            if(!empty($man['answer'])){
                $valuesTable[] = array( $this->Lang->answer , $man['answer']);
            }
            if(!empty($man['resource'])){
                $valuesTable[] = array( $this->Lang->source_information , $man['resource']);
            }
            if(!empty($man['approximate_year'])){
                $valuesTable[] = array( $this->Lang->approximate_year , $man['approximate_year']);
            }
            if(!empty($man['start_wanted'])){
                $valuesTable[] = array( $this->Lang->declared_wanted_list_with , $man['start_wanted']);
            }
            if(!empty($man['entry_date'])){
                $valuesTable[] = array( $this->Lang->home_monitoring_start , $man['entry_date']);
            }
            if(!empty($man['exit_date'])){
                $valuesTable[] = array( $this->Lang->end_monitoring_start , $man['exit_date']);
            }
            if(!empty($man['attention'])){
                $valuesTable[] = array( $this->Lang->attention , $man['attention']);
            }
            if(!empty($man['more_data'])){
                $valuesTable[] = array( $this->Lang->additional_information_person , $man['more_data']);
            }
            if(!empty($man['occupation'])){
                $valuesTable[] = array( $this->Lang->occupation , $man['occupation']);
            }
            if(!empty($man['opened_dou'])){
                $valuesTable[] = array( $this->Lang->face_opened , $man['opened_dou']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }



    public function man_bean_country($man_bean_country_id)
    {
        try {
            $man_bean_country = $this->_model->getManBeanCountry($man_bean_country_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','man_bean_country',$man_bean_country_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $man_bean_country['id']);
            if(!empty($man_bean_country['goal'])){
                $valuesTable[] = array( $this->Lang->purpose_visit , $man_bean_country['goal']);
            }
            if(!empty($man_bean_country['country_ate'])){
                $valuesTable[] = array( $this->Lang->country_ate , $man_bean_country['country_ate']);
            }
            if(!empty($man_bean_country['entry_date'])){
                $valuesTable[] = array( $this->Lang->entry_date , $man_bean_country['entry_date']);
            }
            if(!empty($man_bean_country['exit_date'])){
                $valuesTable[] = array( $this->Lang->exit_date , $man_bean_country['exit_date']);
            }
            if(!empty($man_bean_country['region'])){
                $valuesTable[] = array( $this->Lang->region , $man_bean_country['region']);
            }
            if(!empty($man_bean_country['locality'])){
                $valuesTable[] = array( $this->Lang->locality , $man_bean_country['locality']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function mia_summary($mia_summary_id)
    {
        try {
            $mia_summary = $this->_model->getMiaSummary($mia_summary_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','mia_summary',$mia_summary_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $mia_summary['id']);
            if(!empty($mia_summary['content'])){
                $valuesTable[] = array( $this->Lang->content_inf , $mia_summary['content']);
            }
            if(!empty($mia_summary['date'])){
                $valuesTable[] = array( $this->Lang->date_registration_reports , $mia_summary['date']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function objects_relation($objects_relation_id)
    {
        try {
            $objects_relation = $this->_model->getObjectsRelation($objects_relation_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','objects_relation',$objects_relation_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $objects_relation['id']);
            if(!empty($objects_relation['relation_type_id'])){
                $valuesTable[] = array( $this->Lang->relation_type , $objects_relation['relation_type_id']);
            }
            if(!empty($objects_relation['first_object_id'])){
                $valuesTable[] = array( $this->Lang->first , $objects_relation['first_object_id']);
            }
            if(!empty($objects_relation['second_object_id'])){
                $valuesTable[] = array( $this->Lang->second , $objects_relation['second_object_id']);
            }
            if(!empty($objects_relation['first_object_type'])){
                $valuesTable[] = array( $this->Lang->first_object_type , $objects_relation['first_object_type']);
            }
            if(!empty($objects_relation['second_obejct_type'])){
                $valuesTable[] = array( $this->Lang->second_object_type , $objects_relation['second_obejct_type']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function organization($organization_id)
    {
        try {
            $organization = $this->_model->getOrganization($organization_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','organization',$organization_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $organization['id']);
            if(!empty($organization['name'])){
                $valuesTable[] = array( $this->Lang->name_organization , $organization['name']);
            }
            if(!empty($organization['country'])){
                $valuesTable[] = array( $this->Lang->nation , $organization['country']);
            }
            if(!empty($organization['reg_date'])){
                $valuesTable[] = array( $this->Lang->date_formation , $organization['reg_date']);
            }
            if(!empty($organization['country_ate'])){
                $valuesTable[] = array( $this->Lang->region_activity , $organization['country_ate']);
            }
            if(!empty($organization['category'])){
                $valuesTable[] = array( $this->Lang->category_organization , $organization['category']);
            }
            if(!empty($organization['agency'])){
                $valuesTable[] = array( $this->Lang->security_organization_for_grid , $organization['agency']);
            }
            if(!empty($organization['employers_count'])){
                $valuesTable[] = array( $this->Lang->number_worker , $organization['employers_count']);
            }
            if(!empty($organization['attension'])){
                $valuesTable[] = array( $this->Lang->attention , $organization['attension']);
            }
            if(!empty($organization['opened_dou'])){
                $valuesTable[] = array( $this->Lang->organization_dow , $organization['opened_dou']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function phone($phone_id)
    {
        try {
            $phone = $this->_model->getPhone($phone_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','phone',$phone_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $phone['id']);
            if(!empty($phone['number'])){
                $valuesTable[] = array( $this->Lang->phone_number , $phone['number']);
            }
            if(!empty($phone['more_data'])){
                $valuesTable[] = array( $this->Lang->additional_data , $phone['more_data']);
            }
            if(!empty($phone['character_man'])){
                $valuesTable[] = array( $this->Lang->nature_character_man , $phone['character_man']);
            }
            if(!empty($phone['character_organization'])){
                $valuesTable[] = array( $this->Lang->nature_character_organization , $phone['character_organization']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal($signal_id)
    {
        try {
            $signal = $this->_model->getSignal($signal_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','signal',$signal_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $signal['id']);
            if(!empty($signal['reg_num'])){
                $valuesTable[] = array( $this->Lang->reg_number_signal , $signal['reg_num']);
            }
            if(!empty($signal['content'])){
                $valuesTable[] = array( $this->Lang->contents_information_signal , $signal['content']);
            }
            if(!empty($signal['check_line'])){
                $valuesTable[] = array( $this->Lang->line_which_verified , $signal['check_line']);
            }
            if(!empty($signal['check_status'])){
                $valuesTable[] = array( $this->Lang->check_status_charter , $signal['check_status']);
            }
            if(!empty($signal['signal_qualification'])){
                $valuesTable[] = array( $this->Lang->qualifications_signaling , $signal['signal_qualification']);
            }
            if(!empty($signal['check_agency'])){
                $valuesTable[] = array( $this->Lang->department_checking , $signal['check_agency']);
            }
            if(!empty($signal['check_unit'])){
                $valuesTable[] = array( $this->Lang->checks_signal , $signal['check_unit']);
            }
            if(!empty($signal['check_subunit'])){
                $valuesTable[] = array( $this->Lang->unit_testing , $signal['check_subunit']);
            }
            if(!empty($signal['subunit_date'])){
                $valuesTable[] = array( $this->Lang->date_registration_division , $signal['subunit_date']);
            }
            if(!empty($signal['check_date'])){
                $valuesTable[] = array( $this->Lang->check_date , $signal['check_date']);
            }
            if(!empty($signal['check_date_id'])){
                $valuesTable[] = array( $this->Lang->check_previously , $signal['check_date_id']);
            }
            if(!empty($signal['end_date'])){
                $valuesTable[] = array( $this->Lang->date_actual_word , $signal['end_date']);
            }
            if(!empty($signal['count_days'])){
                $valuesTable[] = array( $this->Lang->amount_overdue , $signal['count_days']);
            }
            if(!empty($signal['opened_dou'])){
                $valuesTable[] = array( $this->Lang->according_result_dow , $signal['opened_dou']);
            }
            if(!empty($signal['resource'])){
                $valuesTable[] = array( $this->Lang->useful_capabilities , $signal['resource']);
            }
            if(!empty($signal['opened_agency'])){
                $valuesTable[] = array( $this->Lang->brought_signal , $signal['opened_agency']);
            }
            if(!empty($signal['opened_unit'])){
                $valuesTable[] = array( $this->Lang->department_brought , $signal['opened_unit']);
            }
            if(!empty($signal['opened_subunit'])){
                $valuesTable[] = array( $this->Lang->unit_brought , $signal['opened_subunit']);
            }
            if(!empty($signal['checking_worker'])){
                $valuesTable[] = array( $this->Lang->name_checking_signal , $signal['checking_worker']);
            }
            if(!empty($signal['checking_worker_post'])){
                $valuesTable[] = array( $this->Lang->worker_post , $signal['checking_worker_post']);
            }
            if(!empty($signal['worker'])){
                $valuesTable[] = array( $this->Lang->name_operatives , $signal['worker']);
            }
            if(!empty($signal['worker_post'])){
                $valuesTable[] = array( $this->Lang->worker_post , $signal['worker_post']);
            }
            if(!empty($signal['resource'])){
                $valuesTable[] = array( $this->Lang->source_category , $signal['resource']);
            }
            if(!empty($signal['signal_result'])){
                $valuesTable[] = array( $this->Lang->signal_results , $signal['signal_result']);
            }
            if(!empty($signal['taken_measure_id'])){
                $valuesTable[] = array( $this->Lang->measures_taken , $signal['taken_measure_id']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function weapon($weapon_id)
    {
        try {
            $weapon = $this->_model->getWeapon($weapon_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','weapon',$weapon_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $weapon['id']);
            if(!empty($weapon['category'])){
                $valuesTable[] = array( $this->Lang->weapon_cat , $weapon['category']);
            }
            if(!empty($weapon['view'])){
                $valuesTable[] = array( $this->Lang->view , $weapon['view']);
            }
            if(!empty($weapon['type'])){
                $valuesTable[] = array( $this->Lang->type , $weapon['type']);
            }
            if(!empty($weapon['reg_num'])){
                $valuesTable[] = array( $this->Lang->account_number , $weapon['reg_num']);
            }
            if(!empty($weapon['model'])){
                $valuesTable[] = array( $this->Lang->mark , $weapon['model']);
            }
            if(!empty($weapon['count'])){
                $valuesTable[] = array( $this->Lang->count , $weapon['count']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function work_activity($work_activity_id)
    {
        try {
            $work_activity = $this->_model->getWorkActivity($work_activity_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','organization_has_man',$work_activity_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $work_activity['id']);
            if(!empty($work_activity['title'])){
                $valuesTable[] = array( $this->Lang->position , $work_activity['title']);
            }
            if(!empty($work_activity['period'])){
                $valuesTable[] = array( $this->Lang->data_refer_period , $work_activity['period']);
            }
            if(!empty($work_activity['start_date'])){
                $valuesTable[] = array( $this->Lang->start_employment , $work_activity['start_date']);
            }
            if(!empty($work_activity['end_date'])){
                $valuesTable[] = array( $this->Lang->end_employment , $work_activity['end_date']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }



    public function bibliography($bibliography_id)
    {
        try {
            $bibliography = $this->_model->getBibliography($bibliography_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','bibliography',$bibliography_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $bibliography['id']);
            if(!empty($bibliography['user_name'])){
                $valuesTable[] = array( $this->Lang->created_user , $bibliography['user_name']);
            }
            if(!empty($bibliography['doc_name'])){
                $valuesTable[] = array( $this->Lang->document_category , $bibliography['doc_name']);
            }
            if(!empty($bibliography['access_level'])){
                $valuesTable[] = array( $this->Lang->access_level , $bibliography['access_level']);
            }
            if(!empty($bibliography['source_agency_name'])){
                $valuesTable[] = array( $this->Lang->source_agency , $bibliography['source_agency_name']);
            }
            if(!empty($bibliography['from_agency_name'])){
                $valuesTable[] = array( $this->Lang->organ , $bibliography['from_agency_name']);
            }
            if(!empty($bibliography['source'])){
                $valuesTable[] = array( $this->Lang->source_inf , $bibliography['source']);
            }
            if(!empty($bibliography['short_desc'])){
                $valuesTable[] = array( $this->Lang->short_desc , $bibliography['short_desc']);
            }
            if(!empty($bibliography['related_year'])){
                $valuesTable[] = array( $this->Lang->related_year , $bibliography['related_year']);
            }
            if(!empty($bibliography['source_address'])){
                $valuesTable[] = array( $this->Lang->source_address , $bibliography['source_address']);
            }
            if(!empty($bibliography['worker_name'])){
                $valuesTable[] = array( $this->Lang->worker_take_doc , $bibliography['worker_name']);
            }
            if(!empty($bibliography['reg_number'])){
                $valuesTable[] = array( $this->Lang->reg_number , $bibliography['reg_number']);
            }
            if(!empty($bibliography['country'])){
                $valuesTable[] = array( $this->Lang->information_country , $bibliography['country']);
            }
            if(!empty($bibliography['theme'])){
                $valuesTable[] = array( $this->Lang->name_subject , $bibliography['theme']);
            }
            if(!empty($bibliography['title'])){
                $valuesTable[] = array( $this->Lang->title_document , $bibliography['title']);
            }
            if(!empty($bibliography['reg_date'])){
                $valuesTable[] = array( $this->Lang->reg_date , $bibliography['reg_date']);
            }
            if(!empty($bibliography['created_at'])){
                $valuesTable[] = array( $this->Lang->date_and_time , $bibliography['created_at']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function external_signs($sign_id)
    {
        try {
            $sign = $this->_model->getExternalSigns($sign_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print','external_sign',$sign_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $sign['id']);
            if(!empty($sign['man_id'])){
                $valuesTable[] = array( $this->Lang->face , $sign['man_id']);
            }
            if(!empty($sign['name'])){
                $valuesTable[] = array( $this->Lang->external_signs , $sign['name']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }





    public function phone_with_joins($phone_id)
    {
        try {
            $phone = $this->_model->getPhone($phone_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','photo',$phone_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $phone['id']);
            if(!empty($phone['number'])){
                $valuesTable[] = array( $this->Lang->phone_number , $phone['number']);
            }
            if(!empty($phone['more_data'])){
                $valuesTable[] = array( $this->Lang->additional_data , $phone['more_data']);
            }
            if(!empty($phone['character_man'])){
                $valuesTable[] = array( $this->Lang->nature_character_man , $phone['character_man']);
            }
            if(!empty($phone['character_organization'])){
                $valuesTable[] = array( $this->Lang->nature_character_organization , $phone['character_organization']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );

            $docx->addText($this->Lang->telephone);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);


            $organization = $this->_model->getPhoneHasOrganization($phone['id']);
            if($organization){
                foreach($organization as $val)
                {
                    $valuesTable2 = array();
                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable2[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable2[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable2[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable2[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable2[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $action = $this->_model->getPhoneHasAction($phone['id']);
            if($action){
                foreach($action as $val)
                {

                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable3[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable3[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable3[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable3[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable3[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable3[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable3[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable3[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable3[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);

                }
            }

            $man = $this->_model->getPhoneHasMan($phone['id']);
            if($man){

                foreach($man as $val)
                {

                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable4[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable4[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable4[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable4[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable4[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable4[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable4[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable4[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable4[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable4[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable4[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable4[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable4[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable4[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable4[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable4[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable4[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable4[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable4[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable4[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }


            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function objects_relation_with_joins($objects_relation_id)
    {
        try {
            $objects_relation = $this->_model->getObjectsRelation($objects_relation_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','objects_relation',$objects_relation_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $objects_relation['id']);
            if(!empty($objects_relation['relation_type_id'])){
                $valuesTable[] = array( $this->Lang->relation_type , $objects_relation['relation_type_id']);
            }
            if(!empty($objects_relation['first_object_id'])){
                $valuesTable[] = array( $this->Lang->first , $objects_relation['first_object_id']);
            }
            if(!empty($objects_relation['second_object_id'])){
                $valuesTable[] = array( $this->Lang->second , $objects_relation['second_object_id']);
            }
            if(!empty($objects_relation['first_object_type'])){
                $valuesTable[] = array( $this->Lang->first_object_type , $objects_relation['first_object_type']);
            }
            if(!empty($objects_relation['second_obejct_type'])){
                $valuesTable[] = array( $this->Lang->second_object_type , $objects_relation['second_obejct_type']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );

            $docx->addText($this->Lang->relationship_objects);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getObjectsRelationHasMan($objects_relation['id']);
            if($man){
                if(!((count($man) == 1)&&(empty($man[0]['id'])))){
                    foreach($man as $val)
                    {

                        $valuesTable2 = array();
                        $valuesTable2[] = array( 'id' , $val['id']);
                        if(!empty($val['first_name'])){
                            $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                        }
                        if(!empty($val['last_name'])){
                            $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                        }
                        if(!empty($val['middle_name'])){
                            $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                        }
                        if(!empty($val['passport'])){
                            $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                        }
                        if(!empty($val['gender'])){
                            $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                        }
                        if(!empty($val['country_ate'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                        }
                        if(!empty($val['locality_id'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                        }
                        if(!empty($val['region_id'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                        }
                        if(!empty($val['education'])){
                            $valuesTable2[] = array( $this->Lang->education , $val['education']);
                        }
                        if(!empty($val['language'])){
                            $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                        }
                        if(!empty($val['party'])){
                            $valuesTable2[] = array( $this->Lang->party , $val['party']);
                        }
                        if(!empty($val['citizenship'])){
                            $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                        }
                        if(!empty($val['nation'])){
                            $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                        }
                        if(!empty($val['nickname'])){
                            $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                        }
                        if(!empty($val['operation_category'])){
                            $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                        }
                        if(!empty($val['birthday'])){
                            $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                        }
                        if(!empty($val['answer'])){
                            $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                        }
                        if(!empty($val['resource'])){
                            $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                        }
                        if(!empty($val['approximate_year'])){
                            $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                        }
                        if(!empty($val['start_wanted'])){
                            $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                        }
                        if(!empty($val['entry_date'])){
                            $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                        }
                        if(!empty($val['exit_date'])){
                            $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                        }
                        if(!empty($val['attention'])){
                            $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                        }
                        if(!empty($val['more_data'])){
                            $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                        }
                        if(!empty($val['occupation'])){
                            $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                        }
                        if(!empty($val['opened_dou'])){
                            $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                        }

                        $docx->addBreak();

                        $docx->addText($this->Lang->face);
                        $docx->addBreak();
                        $docx->addTable($valuesTable2, $paramsTable);
                    }
                }
            }

            $organization = $this->_model->getObjectsRelationHasOrganization($objects_relation['id']);
            if($organization){
               if(!( (count($organization) == 1)&&(empty($organization[0]['id'])) )){
                    foreach($organization as $val)
                    {
                        $valuesTable3 = array();
                        $valuesTable3[] = array( 'id' , $val['id']);
                        if(!empty($val['name'])){
                            $valuesTable3[] = array( $this->Lang->name_organization , $val['name']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable3[] = array( $this->Lang->nation , $val['country']);
                        }
                        if(!empty($val['reg_date'])){
                            $valuesTable3[] = array( $this->Lang->date_formation , $val['reg_date']);
                        }
                        if(!empty($val['country_ate'])){
                            $valuesTable3[] = array( $this->Lang->region_activity , $val['country_ate']);
                        }
                        if(!empty($val['category'])){
                            $valuesTable3[] = array( $this->Lang->category_organization , $val['category']);
                        }
                        if(!empty($val['agency'])){
                            $valuesTable3[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                        }
                        if(!empty($val['employers_count'])){
                            $valuesTable3[] = array( $this->Lang->number_worker , $val['employers_count']);
                        }
                        if(!empty($val['attension'])){
                            $valuesTable3[] = array( $this->Lang->attention , $val['attension']);
                        }
                        if(!empty($val['opened_dou'])){
                            $valuesTable3[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                        }
                        $docx->addBreak();
                        $docx->addText($this->Lang->organization);
                        $docx->addBreak();
                        $docx->addTable($valuesTable3, $paramsTable);
                    }
               }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');
//
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function weapon_with_joins($weapon_id)
    {
        try {
            $weapon = $this->_model->getWeapon($weapon_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','weapon',$weapon_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $weapon['id']);
            if(!empty($weapon['category'])){
                $valuesTable[] = array( $this->Lang->weapon_cat , $weapon['category']);
            }
            if(!empty($weapon['view'])){
                $valuesTable[] = array( $this->Lang->view , $weapon['view']);
            }
            if(!empty($weapon['type'])){
                $valuesTable[] = array( $this->Lang->type , $weapon['type']);
            }
            if(!empty($weapon['reg_num'])){
                $valuesTable[] = array( $this->Lang->account_number , $weapon['reg_num']);
            }
            if(!empty($weapon['model'])){
                $valuesTable[] = array( $this->Lang->mark , $weapon['model']);
            }
            if(!empty($weapon['count'])){
                $valuesTable[] = array( $this->Lang->count , $weapon['count']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->weapon);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getWeaponHasMan($weapon['id']);
            if($man){
                    foreach($man as $val)
                    {

                        $valuesTable2 = array();
                        $valuesTable2[] = array( 'id' , $val['id']);
                        if(!empty($val['first_name'])){
                            $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                        }
                        if(!empty($val['last_name'])){
                            $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                        }
                        if(!empty($val['middle_name'])){
                            $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                        }
                        if(!empty($val['passport'])){
                            $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                        }
                        if(!empty($val['gender'])){
                            $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                        }
                        if(!empty($val['country_ate'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                        }
                        if(!empty($val['locality_id'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                        }
                        if(!empty($val['region_id'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                        }
                        if(!empty($val['education'])){
                            $valuesTable2[] = array( $this->Lang->education , $val['education']);
                        }
                        if(!empty($val['language'])){
                            $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                        }
                        if(!empty($val['party'])){
                            $valuesTable2[] = array( $this->Lang->party , $val['party']);
                        }
                        if(!empty($val['citizenship'])){
                            $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                        }
                        if(!empty($val['nation'])){
                            $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                        }
                        if(!empty($val['nickname'])){
                            $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                        }
                        if(!empty($val['operation_category'])){
                            $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                        }
                        if(!empty($val['birthday'])){
                            $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                        }
                        if(!empty($val['answer'])){
                            $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                        }
                        if(!empty($val['resource'])){
                            $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                        }
                        if(!empty($val['approximate_year'])){
                            $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                        }
                        if(!empty($val['start_wanted'])){
                            $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                        }
                        if(!empty($val['entry_date'])){
                            $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                        }
                        if(!empty($val['exit_date'])){
                            $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                        }
                        if(!empty($val['attention'])){
                            $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                        }
                        if(!empty($val['more_data'])){
                            $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                        }
                        if(!empty($val['occupation'])){
                            $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                        }
                        if(!empty($val['opened_dou'])){
                            $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                        }

                        $docx->addBreak();

                        $docx->addText($this->Lang->face);
                        $docx->addBreak();
                        $docx->addTable($valuesTable2, $paramsTable);
                    }
            }

            $organization = $this->_model->getWeaponHasOrganization($weapon['id']);
            if($organization){
                    foreach($organization as $val)
                    {
                        $valuesTable3 = array();
                        $valuesTable3[] = array( 'id' , $val['id']);
                        if(!empty($val['name'])){
                            $valuesTable3[] = array( $this->Lang->name_organization , $val['name']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable3[] = array( $this->Lang->nation , $val['country']);
                        }
                        if(!empty($val['reg_date'])){
                            $valuesTable3[] = array( $this->Lang->date_formation , $val['reg_date']);
                        }
                        if(!empty($val['country_ate'])){
                            $valuesTable3[] = array( $this->Lang->region_activity , $val['country_ate']);
                        }
                        if(!empty($val['category'])){
                            $valuesTable3[] = array( $this->Lang->category_organization , $val['category']);
                        }
                        if(!empty($val['agency'])){
                            $valuesTable3[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                        }
                        if(!empty($val['employers_count'])){
                            $valuesTable3[] = array( $this->Lang->number_worker , $val['employers_count']);
                        }
                        if(!empty($val['attension'])){
                            $valuesTable3[] = array( $this->Lang->attention , $val['attension']);
                        }
                        if(!empty($val['opened_dou'])){
                            $valuesTable3[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                        }
                        $docx->addBreak();
                        $docx->addText($this->Lang->organization);
                        $docx->addBreak();
                        $docx->addTable($valuesTable3, $paramsTable);
                    }
            }

            $action = $this->_model->getWeaponHasAction($weapon['id']);
            if($action){
                foreach($action as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable4[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable4[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable4[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable4[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable4[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable4[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable4[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable4[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable4[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);

                }
            }

            $event = $this->_model->getWeaponHasEvent($weapon['id']);
            if($event){
                foreach($event as $val){
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable5[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable5[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable5[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable5[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable5[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->event);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function car_with_joins($car_id)
    {
        try {
            $car = $this->_model->getCar($car_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','car',$car_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $car['id']);
            if(!empty($car['car_category'])){
                $valuesTable[] = array( $this->Lang->car_cat , $car['car_category']);
            }
            if(!empty($car['car_mark'])){
                $valuesTable[] = array( $this->Lang->mark , $car['car_mark']);
            }
            if(!empty($car['car_color'])){
                $valuesTable[] = array( $this->Lang->color , $car['car_color']);
            }
            if(!empty($car['number'])){
                $valuesTable[] = array( $this->Lang->car_number , $car['number']);
            }
            if(!empty($car['count'])){
                $valuesTable[] = array( $this->Lang->count , $car['count']);
            }
            if(!empty($car['note'])){
                $valuesTable[] = array( $this->Lang->additional_data , $car['note']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->car);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man_has = $this->_model->getCarHasMan($car['id']);
            if($man_has){
                foreach($man_has as $val)
                {

                    $valuesTable2 = array();
                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable2[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable2[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->face_has);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $man_use = $this->_model->getCarUseMan($car['id']);
            if($man_use){
                foreach($man_use as $val)
                {

                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable3[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable3[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable3[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable3[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable3[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable3[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable3[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable3[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable3[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable3[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable3[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable3[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable3[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable3[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable3[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable3[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable3[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable3[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable3[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable3[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable3[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable3[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable3[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable3[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable3[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable3[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable3[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->face_use);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);
                }
            }

            $action = $this->_model->getCarHasAction($car['id']);
            if($action){
                foreach($action as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable4[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable4[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable4[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable4[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable4[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable4[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable4[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable4[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable4[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);

                }
            }

            $event = $this->_model->getCarHasEvent($car['id']);
            if($event){
                foreach($event as $val){
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable5[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable5[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable5[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable5[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable5[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();

                    $docx->addText($this->Lang->event);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }

            $organization = $this->_model->getCarHasOrganization($car['id']);
            if($organization){
                foreach($organization as $val)
                {
                    $valuesTable6 = array();
                    $valuesTable6[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable6[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable6[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable6[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable6[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable6[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable6[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable6[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable6[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable6[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable6, $paramsTable);
                }
            }

            $address = $this->_model->getCarHasAddress($car['id']);
            if($address){
                foreach($address as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['country_ate'])){
                        $valuesTable7[] = array( $this->Lang->country_ate , $val['country_ate']);
                    }
                    if(!empty($val['region'])){
                        $valuesTable7[] = array( $this->Lang->region , $val['region']);
                    }
                    if(!empty($val['locality'])){
                        $valuesTable7[] = array( $this->Lang->locality , $val['locality']);
                    }
                    if(!empty($val['street'])){
                        $valuesTable7[] = array( $this->Lang->street , $val['street']);
                    }
                    if(!empty($val['track'])){
                        $valuesTable7[] = array( $this->Lang->track , $val['track']);
                    }
                    if(!empty($val['home_num'])){
                        $valuesTable7[] = array( $this->Lang->home_num , $val['home_num']);
                    }
                    if(!empty($val['housing_num'])){
                        $valuesTable7[] = array( $this->Lang->housing_num , $val['housing_num']);
                    }
                    if(!empty($val['apt_num'])){
                        $valuesTable7[] = array( $this->Lang->apt_num , $val['apt_num']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->address);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function address_with_joins($address_id)
    {
        try {
            $address = $this->_model->getAddress($address_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','address',$address_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $address['id']);
            if(!empty($address['country_ate'])){
                $valuesTable[] = array( $this->Lang->country_ate , $address['country_ate']);
            }
            if(!empty($address['region'])){
                $valuesTable[] = array( $this->Lang->region , $address['region']);
            }
            if(!empty($address['locality'])){
                $valuesTable[] = array( $this->Lang->locality , $address['locality']);
            }
            if(!empty($address['street'])){
                $valuesTable[] = array( $this->Lang->street , $address['street']);
            }
            if(!empty($address['track'])){
                $valuesTable[] = array( $this->Lang->track , $address['track']);
            }
            if(!empty($address['home_num'])){
                $valuesTable[] = array( $this->Lang->home_num , $address['home_num']);
            }
            if(!empty($address['housing_num'])){
                $valuesTable[] = array( $this->Lang->housing_num , $address['housing_num']);
            }
            if(!empty($address['apt_num'])){
                $valuesTable[] = array( $this->Lang->apt_num , $address['apt_num']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
//                'float' => array(
//                    'textMargin_top' => 400
//                )
            );
            $docx->addText($this->Lang->address);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getAddressHasMan($address['id']);
            if($man){
                foreach($man as $val)
                {

                    $valuesTable2 = array();
                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable2[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable2[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $organization = $this->_model->getAddressOrganization($address['id']);
            if($organization){
                foreach($organization as $val)
                {
                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable3[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable3[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable3[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable3[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable3[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable3[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable3[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable3[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);
                }
            }

            $organization = $this->_model->getAddressHasOrganization($address['id']);
            if($organization){
                foreach($organization as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable4[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable4[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable4[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable4[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable4[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable4[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable4[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->dummy_address_organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $event = $this->_model->getAddressHasEvent($address['id']);
            if($event){
                foreach($event as $val){
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable5[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable5[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable5[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable5[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable5[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();

                    $docx->addText($this->Lang->event);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }

            $action = $this->_model->getAddressHasAction($address['id']);
            if($action){
                foreach($action as $val)
                {
                    $valuesTable6 = array();
                    $valuesTable6[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable6[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable6[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable6[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable6[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable6[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable6[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable6[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable6[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable6[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable6[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable6, $paramsTable);
                }
            }

            $car = $this->_model->getAddressHasCar($address['id']);
            if($car){
                foreach($car as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['car_category'])){
                        $valuesTable7[] = array( $this->Lang->car_cat , $val['car_category']);
                    }
                    if(!empty($val['car_mark'])){
                        $valuesTable7[] = array( $this->Lang->mark , $val['car_mark']);
                    }
                    if(!empty($val['car_color'])){
                        $valuesTable7[] = array( $this->Lang->color , $val['car_color']);
                    }
                    if(!empty($val['number'])){
                        $valuesTable7[] = array( $this->Lang->car_number , $val['number']);
                    }
                    if(!empty($val['count'])){
                        $valuesTable7[] = array( $this->Lang->count , $val['count']);
                    }
                    if(!empty($val['note'])){
                        $valuesTable7[] = array( $this->Lang->additional_data , $val['note']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->car);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function work_activity_with_joins($work_activity_id)
    {
        try {
            $work_activity = $this->_model->getWorkActivity($work_activity_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','organization_has_man',$work_activity_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $work_activity['id']);
            if(!empty($work_activity['title'])){
                $valuesTable[] = array( $this->Lang->position , $work_activity['title']);
            }
            if(!empty($work_activity['period'])){
                $valuesTable[] = array( $this->Lang->data_refer_period , $work_activity['period']);
            }
            if(!empty($work_activity['start_date'])){
                $valuesTable[] = array( $this->Lang->start_employment , $work_activity['start_date']);
            }
            if(!empty($work_activity['end_date'])){
                $valuesTable[] = array( $this->Lang->end_employment , $work_activity['end_date']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->work_activity_2);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getWorkActivityHasMan($work_activity['id']);
            if($man){
                foreach($man as $val)
                {

                    $valuesTable2 = array();
                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable2[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable2[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $organization = $this->_model->getWorkActivityHasOrganization($work_activity['id']);
            if($organization){
                foreach($organization as $val)
                {
                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable3[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable3[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable3[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable3[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable3[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable3[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable3[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable3[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);
                }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_bean_country_with_joins($man_bean_country_id)
    {
        try {
            $man_bean_country = $this->_model->getManBeanCountry($man_bean_country_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','man_bean_country',$man_bean_country_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $man_bean_country['id']);
            if(!empty($man_bean_country['goal'])){
                $valuesTable[] = array( $this->Lang->purpose_visit , $man_bean_country['goal']);
            }
            if(!empty($man_bean_country['country_ate'])){
                $valuesTable[] = array( $this->Lang->country_ate , $man_bean_country['country_ate']);
            }
            if(!empty($man_bean_country['entry_date'])){
                $valuesTable[] = array( $this->Lang->entry_date , $man_bean_country['entry_date']);
            }
            if(!empty($man_bean_country['exit_date'])){
                $valuesTable[] = array( $this->Lang->exit_date , $man_bean_country['exit_date']);
            }
            if(!empty($man_bean_country['region'])){
                $valuesTable[] = array( $this->Lang->region , $man_bean_country['region']);
            }
            if(!empty($man_bean_country['locality'])){
                $valuesTable[] = array( $this->Lang->locality , $man_bean_country['locality']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->man_bean_country);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getManBeanCountryHasMan($man_bean_country['id']);
            if($man){
                foreach($man as $val)
                {

                    $valuesTable2 = array();
                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable2[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable2[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function mia_summary_with_joins($mia_summary_id)
    {
        try {
            $mia_summary = $this->_model->getMiaSummary($mia_summary_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','mia_summary',$mia_summary_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $mia_summary['id']);
            if(!empty($mia_summary['content'])){
                $valuesTable[] = array( $this->Lang->content_inf , $mia_summary['content']);
            }
            if(!empty($mia_summary['date'])){
                $valuesTable[] = array( $this->Lang->date_registration_reports , $mia_summary['date']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->mia_summary);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getMiaSummaryHasMan($mia_summary['id']);
            if($man){
                foreach($man as $val)
                {

                    $valuesTable2 = array();
                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable2[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable2[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $organization = $this->_model->getMiaSummaryHasOrganization($mia_summary['id']);
            if($organization){
                foreach($organization as $val)
                {
                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable3[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable3[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable3[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable3[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable3[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable3[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable3[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable3[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);
                }
            }
            $bibliography = $this->_model->getMiaSummaryHasBibliography($mia_summary['id']);
            if($bibliography){
                foreach($bibliography as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['user_name'])){
                        $valuesTable4[] = array( $this->Lang->worker_take_doc , $val['user_name']);
                    }
                    if(!empty($val['access_level'])){
                        $valuesTable4[] = array( $this->Lang->access_level , $val['access_level']);
                    }
                    if(!empty($val['source_agency_name'])){
                        $valuesTable4[] = array( $this->Lang->source_agency , $val['source_agency_name']);
                    }
                    if(!empty($val['from_agency_name'])){
                        $valuesTable4[] = array( $this->Lang->organ , $val['from_agency_name']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable4[] = array( $this->Lang->source_inf , $val['source']);
                    }
                    if(!empty($val['short_desc'])){
                        $valuesTable4[] = array( $this->Lang->short_desc , $val['short_desc']);
                    }
                    if(!empty($val['related_year'])){
                        $valuesTable4[] = array( $this->Lang->related_year , $val['related_year']);
                    }
                    if(!empty($val['source_address'])){
                        $valuesTable4[] = array( $this->Lang->source_address , $val['source_address']);
                    }
                    if(!empty($val['worker_name'])){
                        $valuesTable4[] = array( $this->Lang->worker_name , $val['worker_name']);
                    }
                    if(!empty($val['reg_number'])){
                        $valuesTable4[] = array( $this->Lang->reg_number , $val['reg_number']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable4[] = array( $this->Lang->reg_date , $val['reg_date']);
                    }
                    if(!empty($val['created_at'])){
                        $valuesTable4[] = array( $this->Lang->date_and_time , $val['created_at']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->bibliography);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);

                }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function bibliography_with_joins($bibliography_id)
    {
        try {
            $bibliography = $this->_model->getBibliography($bibliography_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','bibliography',$bibliography_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $bibliography['id']);
            if(!empty($bibliography['user_name'])){
                $valuesTable[] = array( $this->Lang->worker_take_doc , $bibliography['user_name']);
            }
            if(!empty($bibliography['access_level'])){
                $valuesTable[] = array( $this->Lang->access_level , $bibliography['access_level']);
            }
            if(!empty($bibliography['source_agency_name'])){
                $valuesTable[] = array( $this->Lang->source_agency , $bibliography['source_agency_name']);
            }
            if(!empty($bibliography['from_agency_name'])){
                $valuesTable[] = array( $this->Lang->organ , $bibliography['from_agency_name']);
            }
            if(!empty($bibliography['source'])){
                $valuesTable[] = array( $this->Lang->source_inf , $bibliography['source']);
            }
            if(!empty($bibliography['short_desc'])){
                $valuesTable[] = array( $this->Lang->short_desc , $bibliography['short_desc']);
            }
            if(!empty($bibliography['related_year'])){
                $valuesTable[] = array( $this->Lang->related_year , $bibliography['related_year']);
            }
            if(!empty($bibliography['source_address'])){
                $valuesTable[] = array( $this->Lang->source_address , $bibliography['source_address']);
            }
            if(!empty($bibliography['worker_name'])){
                $valuesTable[] = array( $this->Lang->worker_name , $bibliography['worker_name']);
            }
            if(!empty($bibliography['reg_number'])){
                $valuesTable[] = array( $this->Lang->reg_number , $bibliography['reg_number']);
            }
            if(!empty($bibliography['reg_date'])){
                $valuesTable[] = array( $this->Lang->reg_date , $bibliography['reg_date']);
            }
            if(!empty($bibliography['created_at'])){
                $valuesTable[] = array( $this->Lang->date_and_time , $bibliography['created_at']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->bibliography);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getBibliographyHasMan($bibliography['id']);
            if($man){
                foreach($man as $val)
                {

                    $valuesTable2 = array();
                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable2[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable2[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $organization = $this->_model->getBibliographyHasOrganization($bibliography['id']);
            if($organization){
                foreach($organization as $val)
                {
                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable3[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable3[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable3[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable3[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable3[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable3[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable3[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable3[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);
                }
            }
            $event = $this->_model->getBibliographyHasEvent($bibliography['id']);
            if($event){
                foreach($event as $val){
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable5[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable5[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable5[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable5[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable5[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();

                    $docx->addText($this->Lang->event);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }
            $action = $this->_model->getBibliographyHasAction($bibliography['id']);
            if($action){
                foreach($action as $val)
                {
                    $valuesTable6 = array();
                    $valuesTable6[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable6[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable6[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable6[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable6[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable6[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable6[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable6[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable6[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable6[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable6[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable6, $paramsTable);
                }
            }

            $signal = $this->_model->getBibliographyHasSignal($bibliography['id']);
            if($signal){
                foreach($signal as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['reg_num'])){
                        $valuesTable4[] = array( $this->Lang->reg_number_signal , $val['reg_num']);
                    }
                    if(!empty($val['content'])){
                        $valuesTable4[] = array( $this->Lang->contents_information_signal , $val['content']);
                    }
                    if(!empty($val['check_line'])){
                        $valuesTable4[] = array( $this->Lang->line_which_verified , $val['check_line']);
                    }
                    if(!empty($val['check_status'])){
                        $valuesTable4[] = array( $this->Lang->check_status_charter , $val['check_status']);
                    }
                    if(!empty($val['signal_qualification'])){
                        $valuesTable4[] = array( $this->Lang->qualifications_signaling , $val['signal_qualification']);
                    }
                    if(!empty($val['check_agency'])){
                        $valuesTable4[] = array( $this->Lang->checks_signal , $val['check_agency']);
                    }
                    if(!empty($val['check_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_checking , $val['check_unit']);
                    }
                    if(!empty($val['check_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_testing , $val['check_subunit']);
                    }
                    if(!empty($val['subunit_date'])){
                        $valuesTable4[] = array( $this->Lang->date_registration_division , $val['subunit_date']);
                    }
                    if(!empty($val['check_date'])){
                        $valuesTable4[] = array( $this->Lang->check_date , $val['check_date']);
                    }
                    if(!empty($val['check_date_id'])){
                        $valuesTable4[] = array( $this->Lang->check_previously , $val['check_date_id']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable4[] = array( $this->Lang->date_actual_word , $val['end_date']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->according_result_dow , $val['opened_dou']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->useful_capabilities , $val['resource']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable4[] = array( $this->Lang->brought_signal , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_brought , $val['opened_unit']);
                    }
                    if(!empty($val['opened_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_brought , $val['opened_subunit']);
                    }
                    if(!empty($val['checking_worker'])){
                        $valuesTable4[] = array( $this->Lang->name_checking_signal , $val['checking_worker']);
                    }
                    if(!empty($val['checking_worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['checking_worker_post']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable4[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_category , $val['resource']);
                    }
                    if(!empty($val['signal_result'])){
                        $valuesTable4[] = array( $this->Lang->signal_results , $val['signal_result']);
                    }
                    if(!empty($val['taken_measure_id'])){
                        $valuesTable4[] = array( $this->Lang->measures_taken , $val['taken_measure_id']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->signal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $criminal_case = $this->_model->getBibliographyHasCriminalCase($bibliography['id']);
            if($criminal_case){
                foreach($criminal_case as $val){
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable7[] = array( $this->Lang->number_case , $val['number']);
                    }
                    if(!empty($val['opened_date'])){
                        $valuesTable7[] = array( $this->Lang->criminal_proceedings_date , $val['opened_date']);
                    }
                    if(!empty($val['artical'])){
                        $valuesTable7[] = array( $this->Lang->criminal_code , $val['artical']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable7[] = array( $this->Lang->initiated_dow , $val['opened_dou']);
                    }
                    if(!empty($val['character'])){
                        $valuesTable7[] = array( $this->Lang->nature_materials_paint , $val['character']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable7[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable7[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable7[] = array( $this->Lang->materials_management , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable7[] = array( $this->Lang->head_department , $val['opened_unit']);
                    }
                    if(!empty($val['subunit'])){
                        $valuesTable7[] = array( $this->Lang->instituted_units , $val['subunit']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->criminal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }
            $control = $this->_model->getBibliographyHasControl($bibliography['id']);
            if($control){
                foreach($control as $val){
                    $valuesTable8 = array();
                    $valuesTable8[] = array( 'id' , $val['id']);
                    if(!empty($val['unit'])){
                        $valuesTable8[] = array( $this->Lang->unit , $val['unit']);
                    }
                    if(!empty($val['doc_category'])){
                        $valuesTable8[] = array( $this->Lang->document_category , $val['doc_category']);
                    }
                    if(!empty($val['reg_num'])){
                        $valuesTable8[] = array( $this->Lang->reg_document , $val['reg_num']);
                    }
                    if(!empty($val['snb_director'])){
                        $valuesTable8[] = array( $this->Lang->director , $val['snb_director']);
                    }
                    if(!empty($val['snb_subdirector'])){
                        $valuesTable8[] = array( $this->Lang->deputy_director , $val['snb_subdirector']);
                    }
                    if(!empty($val['resolution_date'])){
                        $valuesTable8[] = array( $this->Lang->date_resolution , $val['resolution_date']);
                    }
                    if(!empty($val['resolution'])){
                        $valuesTable8[] = array( $this->Lang->resolution , $val['resolution']);
                    }
                    if(!empty($val['act_unit'])){
                        $valuesTable8[] = array( $this->Lang->department_performer , $val['act_unit']);
                    }
                    if(!empty($val['actor_name'])){
                        $valuesTable8[] = array( $this->Lang->actor_name , $val['actor_name']);
                    }
                    if(!empty($val['sub_act_unit'])){
                        $valuesTable8[] = array( $this->Lang->department_coauthors , $val['sub_act_unit']);
                    }
                    if(!empty($val['sub_actor_name'])){
                        $valuesTable8[] = array( $this->Lang->sub_actor_name , $val['sub_actor_name']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable8[] = array( $this->Lang->result_execution , $val['result']);
                    }
                    if(!empty($val['creation_date'])){
                        $valuesTable8[] = array( $this->Lang->document_date , $val['creation_date']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->control);
                    $docx->addBreak();
                    $docx->addTable($valuesTable8, $paramsTable);
                }
            }

            $mia_summary = $this->_model->getBibliographyHasMiaSummary($bibliography['id']);
            if($mia_summary){
                foreach($mia_summary as $val){
                    $valuesTable9 = array();
                    $valuesTable9[] = array( 'id' , $val['id']);
                    if(!empty($val['content'])){
                        $valuesTable9[] = array( $this->Lang->content_inf , $val['content']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable9[] = array( $this->Lang->date_registration_reports , $val['date']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->mia_summary);
                    $docx->addBreak();
                    $docx->addTable($valuesTable9, $paramsTable);
                }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function action_with_joins($action_id)
    {
        try {
            $action = $this->_model->getAction($action_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','action',$action_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $action['id']);
            if(!empty($action['start_date'])){
                $valuesTable[] = array( $this->Lang->start_action_date , $action['start_date']);
            }
            if(!empty($action['end_date'])){
                $valuesTable[] = array( $this->Lang->end_action_date , $action['end_date']);
            }
            if(!empty($action['material_content'])){
                $valuesTable[] = array( $this->Lang->content_materials_actions , $action['material_content']);
            }
            if(!empty($action['action_qualification'])){
                $valuesTable[] = array( $this->Lang->qualification_fact , $action['action_qualification']);
            }
            if(!empty($action['duration'])){
                $valuesTable[] = array( $this->Lang->duration_action , $action['duration']);
            }
            if(!empty($action['action_goal'])){
                $valuesTable[] = array( $this->Lang->purpose_motive_reason , $action['action_goal']);
            }
            if(!empty($action['terms'])){
                $valuesTable[] = array( $this->Lang->terms_actions , $action['terms']);
            }
            if(!empty($action['aftermath'])){
                $valuesTable[] = array( $this->Lang->ensuing_effects , $action['aftermath']);
            }
            if(!empty($action['source'])){
                $valuesTable[] = array( $this->Lang->source_information_actions , $action['source']);
            }
            if(!empty($action['opened_dou'])){
                $valuesTable[] = array( $this->Lang->opened_dou , $action['opened_dou']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->action);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);



            $criminal_case = $this->_model->getActionHasCriminalCase($action['id']);
            if($criminal_case){
                foreach($criminal_case as $val)
                {
                    $valuesTable12 = array();
                    $valuesTable12[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable12[] = array( $this->Lang->number_case , $val['number']);
                    }
                    if(!empty($val['opened_date'])){
                        $valuesTable12[] = array( $this->Lang->criminal_proceedings_date , $val['opened_date']);
                    }
                    if(!empty($val['artical'])){
                        $valuesTable12[] = array( $this->Lang->criminal_code , $val['artical']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable12[] = array( $this->Lang->initiated_dow , $val['opened_dou']);
                    }
                    if(!empty($val['character'])){
                        $valuesTable12[] = array( $this->Lang->nature_materials_paint , $val['character']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable12[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable12[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable12[] = array( $this->Lang->materials_management , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable12[] = array( $this->Lang->head_department , $val['opened_unit']);
                    }
                    if(!empty($val['subunit'])){
                        $valuesTable12[] = array( $this->Lang->instituted_units , $val['subunit']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->criminal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable12, $paramsTable);
                }
            }

            $bibliography = $this->_model->getActionHasBibliography($action['id']);
            if($bibliography){
                foreach($bibliography as $val)
                {
                    $valuesTable11 = array();
                    $valuesTable11[] = array( 'id' , $val['id']);
                    if(!empty($val['user_name'])){
                        $valuesTable11[] = array( $this->Lang->worker_take_doc , $val['user_name']);
                    }
                    if(!empty($val['access_level'])){
                        $valuesTable11[] = array( $this->Lang->access_level , $val['access_level']);
                    }
                    if(!empty($val['source_agency_name'])){
                        $valuesTable11[] = array( $this->Lang->source_agency , $val['source_agency_name']);
                    }
                    if(!empty($val['from_agency_name'])){
                        $valuesTable11[] = array( $this->Lang->organ , $val['from_agency_name']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable11[] = array( $this->Lang->source_inf , $val['source']);
                    }
                    if(!empty($val['short_desc'])){
                        $valuesTable11[] = array( $this->Lang->short_desc , $val['short_desc']);
                    }
                    if(!empty($val['related_year'])){
                        $valuesTable11[] = array( $this->Lang->related_year , $val['related_year']);
                    }
                    if(!empty($val['source_address'])){
                        $valuesTable11[] = array( $this->Lang->source_address , $val['source_address']);
                    }
                    if(!empty($val['worker_name'])){
                        $valuesTable11[] = array( $this->Lang->worker_name , $val['worker_name']);
                    }
                    if(!empty($val['reg_number'])){
                        $valuesTable11[] = array( $this->Lang->reg_number , $val['reg_number']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable11[] = array( $this->Lang->reg_date , $val['reg_date']);
                    }
                    if(!empty($val['created_at'])){
                        $valuesTable11[] = array( $this->Lang->date_and_time , $val['created_at']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->bibliography);
                    $docx->addBreak();
                    $docx->addTable($valuesTable11, $paramsTable);
                }
            }

            $car = $this->_model->getActionHasCar($action['id']);
            if($car){
                foreach($car as $val)
                {
                    $valuesTable10 = array();
                    $valuesTable10[] = array( 'id' , $val['id']);
                    if(!empty($val['car_category'])){
                        $valuesTable10[] = array( $this->Lang->car_cat , $val['car_category']);
                    }
                    if(!empty($val['car_mark'])){
                        $valuesTable10[] = array( $this->Lang->mark , $val['car_mark']);
                    }
                    if(!empty($val['car_color'])){
                        $valuesTable10[] = array( $this->Lang->color , $val['car_color']);
                    }
                    if(!empty($val['number'])){
                        $valuesTable10[] = array( $this->Lang->car_number , $val['number']);
                    }
                    if(!empty($val['count'])){
                        $valuesTable10[] = array( $this->Lang->count , $val['count']);
                    }
                    if(!empty($val['note'])){
                        $valuesTable10[] = array( $this->Lang->additional_data , $val['note']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->car);
                    $docx->addBreak();
                    $docx->addTable($valuesTable10, $paramsTable);
                }
            }

            $weapon = $this->_model->getActionHasWeapon($action['id']);
            if($weapon){
                foreach($weapon as $val)
                {
                    $valuesTable9 = array();
                    $valuesTable9[] = array( 'id' , $val['id']);
                    if(!empty($val['category'])){
                        $valuesTable9[] = array( $this->Lang->category , $val['category']);
                    }
                    if(!empty($val['view'])){
                        $valuesTable9[] = array( $this->Lang->view , $val['view']);
                    }
                    if(!empty($val['type'])){
                        $valuesTable9[] = array( $this->Lang->type , $val['type']);
                    }
                    if(!empty($val['reg_num'])){
                        $valuesTable9[] = array( $this->Lang->account_number , $val['reg_num']);
                    }
                    if(!empty($val['model'])){
                        $valuesTable9[] = array( $this->Lang->mark , $val['model']);
                    }
                    if(!empty($val['count'])){
                        $valuesTable9[] = array( $this->Lang->count , $val['count']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->weapon);
                    $docx->addBreak();
                    $docx->addTable($valuesTable9, $paramsTable);
                }
            }

            $phone = $this->_model->getActionHasPhone($action['id']);
            if($phone){
                foreach($phone as $val)
                {
                    $valuesTable8 = array();
                    $valuesTable8[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable8[] = array( $this->Lang->phone_number , $val['number']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable8[] = array( $this->Lang->additional_data , $val['more_data']);
                    }
                    if(!empty($val['character_man'])){
                        $valuesTable8[] = array( $this->Lang->nature_character_man , $val['character_man']);
                    }
                    if(!empty($val['character_organization'])){
                        $valuesTable8[] = array( $this->Lang->nature_character_organization , $val['character_organization']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->telephone);
                    $docx->addBreak();
                    $docx->addTable($valuesTable8, $paramsTable);
                }
            }

            $event_object = $this->_model->getActionEvent($action['id']);
            if($event_object){
                foreach($event_object as $val){
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable7[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable7[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable7[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable7[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable7[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable7[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->object_action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $man = $this->_model->getActionHasMan($action['id']);
            if($man){
                foreach($man as $val)
                {
                    $valuesTable2 = array();
                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable2[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable2[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $organization = $this->_model->getActionHasOrganization($action['id']);
            if($organization){
                foreach($organization as $val)
                {
                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable3[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable3[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable3[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable3[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable3[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable3[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable3[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable3[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);
                }
            }

            $signal = $this->_model->getActionHasSignal($action['id']);
            if($signal){
                foreach($signal as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['reg_num'])){
                        $valuesTable4[] = array( $this->Lang->reg_number_signal , $val['reg_num']);
                    }
                    if(!empty($val['content'])){
                        $valuesTable4[] = array( $this->Lang->contents_information_signal , $val['content']);
                    }
                    if(!empty($val['check_line'])){
                        $valuesTable4[] = array( $this->Lang->line_which_verified , $val['check_line']);
                    }
                    if(!empty($val['check_status'])){
                        $valuesTable4[] = array( $this->Lang->check_status_charter , $val['check_status']);
                    }
                    if(!empty($val['signal_qualification'])){
                        $valuesTable4[] = array( $this->Lang->qualifications_signaling , $val['signal_qualification']);
                    }
                    if(!empty($val['check_agency'])){
                        $valuesTable4[] = array( $this->Lang->checks_signal , $val['check_agency']);
                    }
                    if(!empty($val['check_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_checking , $val['check_unit']);
                    }
                    if(!empty($val['check_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_testing , $val['check_subunit']);
                    }
                    if(!empty($val['subunit_date'])){
                        $valuesTable4[] = array( $this->Lang->date_registration_division , $val['subunit_date']);
                    }
                    if(!empty($val['check_date'])){
                        $valuesTable4[] = array( $this->Lang->check_date , $val['check_date']);
                    }
                    if(!empty($val['check_date_id'])){
                        $valuesTable4[] = array( $this->Lang->check_previously , $val['check_date_id']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable4[] = array( $this->Lang->date_actual_word , $val['end_date']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->according_result_dow , $val['opened_dou']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->useful_capabilities , $val['resource']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable4[] = array( $this->Lang->brought_signal , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_brought , $val['opened_unit']);
                    }
                    if(!empty($val['opened_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_brought , $val['opened_subunit']);
                    }
                    if(!empty($val['checking_worker'])){
                        $valuesTable4[] = array( $this->Lang->name_checking_signal , $val['checking_worker']);
                    }
                    if(!empty($val['checking_worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['checking_worker_post']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable4[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_category , $val['resource']);
                    }
                    if(!empty($val['signal_result'])){
                        $valuesTable4[] = array( $this->Lang->signal_results , $val['signal_result']);
                    }
                    if(!empty($val['taken_measure_id'])){
                        $valuesTable4[] = array( $this->Lang->measures_taken , $val['taken_measure_id']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->signal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $event_related = $this->_model->getActionHasEvent($action['id']);
            if($event_related){
                foreach($event_related as $val){
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable5[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable5[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable5[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable5[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable5[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();

                    $docx->addText($this->Lang->action_related_event_event);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }
            $action_action = $this->_model->getActionHasAction($action['id']);
            if($action_action){
                foreach($action_action as $val)
                {
                    $valuesTable6 = array();
                    $valuesTable6[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable6[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable6[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable6[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable6[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable6[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable6[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable6[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable6[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable6[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable6[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->action_related_event_action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable6, $paramsTable);
                }
            }

            $address = $this->_model->getActionHasAddress($action['id']);
            if($address){
                foreach($address as $val)
                {
                    $valuesTable13 = array();
                    $valuesTable13[] = array( 'id' , $val['id']);
                    if(!empty($val['country_ate'])){
                        $valuesTable13[] = array( $this->Lang->country_ate , $val['country_ate']);
                    }
                    if(!empty($val['region'])){
                        $valuesTable13[] = array( $this->Lang->region , $val['region']);
                    }
                    if(!empty($val['locality'])){
                        $valuesTable13[] = array( $this->Lang->locality , $val['locality']);
                    }
                    if(!empty($val['street'])){
                        $valuesTable13[] = array( $this->Lang->street , $val['street']);
                    }
                    if(!empty($val['track'])){
                        $valuesTable13[] = array( $this->Lang->track , $val['track']);
                    }
                    if(!empty($val['home_num'])){
                        $valuesTable13[] = array( $this->Lang->home_num , $val['home_num']);
                    }
                    if(!empty($val['housing_num'])){
                        $valuesTable13[] = array( $this->Lang->housing_num , $val['housing_num']);
                    }
                    if(!empty($val['apt_num'])){
                        $valuesTable13[] = array( $this->Lang->apt_num , $val['apt_num']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->address);
                    $docx->addBreak();
                    $docx->addTable($valuesTable13, $paramsTable);
                }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');
            $file = (APP_PATH.'/webroot/files/word.docx');
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;


        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function event_with_joins($event_id)
    {
        try {
            $event = $this->_model->getEvent($event_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','event',$event_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $event['id']);
            if(!empty($event['qualification'])){
                $valuesTable[] = array( $this->Lang->qualification_event , $event['qualification']);
            }
            if(!empty($event['date'])){
                $valuesTable[] = array( $this->Lang->date_security_date , $event['date']);
            }
            if(!empty($event['aftermath'])){
                $valuesTable[] = array( $this->Lang->ensuing_effects , $event['aftermath']);
            }
            if(!empty($event['result'])){
                $valuesTable[] = array( $this->Lang->results_event , $event['result']);
            }
            if(!empty($event['agency'])){
                $valuesTable[] = array( $this->Lang->investigation_requested , $event['agency']);
            }
            if(!empty($event['resource'])){
                $valuesTable[] = array( $this->Lang->source_event , $event['resource']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->event);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getEventHasMan($event['id']);
            if($man){
                foreach($man as $val)
                {
                    $valuesTable2 = array();
                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable2[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable2[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $organization_has = $this->_model->getEventOrganization($event['id']);
            if($organization_has){
                foreach($organization_has as $val)
                {
                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable3[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable3[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable3[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable3[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable3[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable3[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable3[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable3[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->place_event_organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);
                }
            }

            $signal = $this->_model->getEventHasSignal($event['id']);
            if($signal){
                foreach($signal as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['reg_num'])){
                        $valuesTable4[] = array( $this->Lang->reg_number_signal , $val['reg_num']);
                    }
                    if(!empty($val['content'])){
                        $valuesTable4[] = array( $this->Lang->contents_information_signal , $val['content']);
                    }
                    if(!empty($val['check_line'])){
                        $valuesTable4[] = array( $this->Lang->line_which_verified , $val['check_line']);
                    }
                    if(!empty($val['check_status'])){
                        $valuesTable4[] = array( $this->Lang->check_status_charter , $val['check_status']);
                    }
                    if(!empty($val['signal_qualification'])){
                        $valuesTable4[] = array( $this->Lang->qualifications_signaling , $val['signal_qualification']);
                    }
                    if(!empty($val['check_agency'])){
                        $valuesTable4[] = array( $this->Lang->checks_signal , $val['check_agency']);
                    }
                    if(!empty($val['check_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_checking , $val['check_unit']);
                    }
                    if(!empty($val['check_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_testing , $val['check_subunit']);
                    }
                    if(!empty($val['subunit_date'])){
                        $valuesTable4[] = array( $this->Lang->date_registration_division , $val['subunit_date']);
                    }
                    if(!empty($val['check_date'])){
                        $valuesTable4[] = array( $this->Lang->check_date , $val['check_date']);
                    }
                    if(!empty($val['check_date_id'])){
                        $valuesTable4[] = array( $this->Lang->check_previously , $val['check_date_id']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable4[] = array( $this->Lang->date_actual_word , $val['end_date']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->according_result_dow , $val['opened_dou']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->useful_capabilities , $val['resource']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable4[] = array( $this->Lang->brought_signal , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_brought , $val['opened_unit']);
                    }
                    if(!empty($val['opened_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_brought , $val['opened_subunit']);
                    }
                    if(!empty($val['checking_worker'])){
                        $valuesTable4[] = array( $this->Lang->name_checking_signal , $val['checking_worker']);
                    }
                    if(!empty($val['checking_worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['checking_worker_post']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable4[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_category , $val['resource']);
                    }
                    if(!empty($val['signal_result'])){
                        $valuesTable4[] = array( $this->Lang->signal_results , $val['signal_result']);
                    }
                    if(!empty($val['taken_measure_id'])){
                        $valuesTable4[] = array( $this->Lang->measures_taken , $val['taken_measure_id']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->signal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $organization = $this->_model->getEventHasOrganization($event['id']);
            if($organization){
                foreach($organization as $val)
                {
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable5[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable5[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable5[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable5[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable5[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable5[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable5[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable5[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->involved_events_organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }
            $address = $this->_model->getEventHasAddress($event['id']);
            if($address){
                foreach($address as $val)
                {
                    $valuesTable6 = array();
                    $valuesTable6[] = array( 'id' , $val['id']);
                    if(!empty($val['country_ate'])){
                        $valuesTable6[] = array( $this->Lang->country_ate , $val['country_ate']);
                    }
                    if(!empty($val['region'])){
                        $valuesTable6[] = array( $this->Lang->region , $val['region']);
                    }
                    if(!empty($val['locality'])){
                        $valuesTable6[] = array( $this->Lang->locality , $val['locality']);
                    }
                    if(!empty($val['street'])){
                        $valuesTable6[] = array( $this->Lang->street , $val['street']);
                    }
                    if(!empty($val['track'])){
                        $valuesTable6[] = array( $this->Lang->track , $val['track']);
                    }
                    if(!empty($val['home_num'])){
                        $valuesTable6[] = array( $this->Lang->home_num , $val['home_num']);
                    }
                    if(!empty($val['housing_num'])){
                        $valuesTable6[] = array( $this->Lang->housing_num , $val['housing_num']);
                    }
                    if(!empty($val['apt_num'])){
                        $valuesTable6[] = array( $this->Lang->apt_num , $val['apt_num']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->address);
                    $docx->addBreak();
                    $docx->addTable($valuesTable6, $paramsTable);
                }
            }

            $car = $this->_model->getEventHasCar($event['id']);
            if($car){
                foreach($car as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['car_category'])){
                        $valuesTable7[] = array( $this->Lang->car_cat , $val['car_category']);
                    }
                    if(!empty($val['car_mark'])){
                        $valuesTable7[] = array( $this->Lang->mark , $val['car_mark']);
                    }
                    if(!empty($val['car_color'])){
                        $valuesTable7[] = array( $this->Lang->color , $val['car_color']);
                    }
                    if(!empty($val['number'])){
                        $valuesTable7[] = array( $this->Lang->car_number , $val['number']);
                    }
                    if(!empty($val['count'])){
                        $valuesTable7[] = array( $this->Lang->count , $val['count']);
                    }
                    if(!empty($val['note'])){
                        $valuesTable7[] = array( $this->Lang->additional_data , $val['note']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->car);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $weapon = $this->_model->getEventHasWeapon($event['id']);
            if($weapon){
                foreach($weapon as $val)
                {
                    $valuesTable8 = array();
                    $valuesTable8[] = array( 'id' , $val['id']);
                    if(!empty($val['category'])){
                        $valuesTable8[] = array( $this->Lang->category , $val['category']);
                    }
                    if(!empty($val['view'])){
                        $valuesTable8[] = array( $this->Lang->view , $val['view']);
                    }
                    if(!empty($val['type'])){
                        $valuesTable8[] = array( $this->Lang->type , $val['type']);
                    }
                    if(!empty($val['reg_num'])){
                        $valuesTable8[] = array( $this->Lang->account_number , $val['reg_num']);
                    }
                    if(!empty($val['model'])){
                        $valuesTable8[] = array( $this->Lang->mark , $val['model']);
                    }
                    if(!empty($val['count'])){
                        $valuesTable8[] = array( $this->Lang->count , $val['count']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->weapon);
                    $docx->addBreak();
                    $docx->addTable($valuesTable8, $paramsTable);
                }
            }

            $action = $this->_model->getEventHasAction($event['id']);
            if($action){
                foreach($action as $val)
                {
                    $valuesTable9 = array();
                    $valuesTable9[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable9[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable9[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable9[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable9[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable9[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable9[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable9[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable9[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable9[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable9[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->involved_events_action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable9, $paramsTable);
                }
            }

            $action_event = $this->_model->getEventAction($event['id']);
            if($action_event){
                foreach($action_event as $val)
                {
                    $valuesTable10 = array();
                    $valuesTable10[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable10[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable10[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable10[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable10[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable10[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable10[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable10[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable10[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable10[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable10[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->event_associated_action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable10, $paramsTable);
                }
            }

            $criminal_case = $this->_model->getEventHasCriminalCase($event['id']);
            if($criminal_case){
                foreach($criminal_case as $val)
                {
                    $valuesTable11 = array();
                    $valuesTable11[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable11[] = array( $this->Lang->number_case , $val['number']);
                    }
                    if(!empty($val['opened_date'])){
                        $valuesTable11[] = array( $this->Lang->criminal_proceedings_date , $val['opened_date']);
                    }
                    if(!empty($val['artical'])){
                        $valuesTable12[] = array( $this->Lang->criminal_code , $val['artical']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable11[] = array( $this->Lang->initiated_dow , $val['opened_dou']);
                    }
                    if(!empty($val['character'])){
                        $valuesTable11[] = array( $this->Lang->nature_materials_paint , $val['character']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable11[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable11[] = array( $this->Lang->name_operatives , $val['worker_post']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable11[] = array( $this->Lang->materials_management , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable11[] = array( $this->Lang->head_department , $val['opened_unit']);
                    }
                    if(!empty($val['subunit'])){
                        $valuesTable11[] = array( $this->Lang->instituted_units , $val['subunit']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->criminal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable11, $paramsTable);
                }
            }

            $bibliography = $this->_model->getEventHasBibliography($event['id']);
            if($bibliography){
                foreach($bibliography as $val)
                {
                    $valuesTable12 = array();
                    $valuesTable12[] = array( 'id' , $val['id']);
                    if(!empty($val['user_name'])){
                        $valuesTable12[] = array( $this->Lang->worker_take_doc , $val['user_name']);
                    }
                    if(!empty($val['access_level'])){
                        $valuesTable12[] = array( $this->Lang->access_level , $val['access_level']);
                    }
                    if(!empty($val['source_agency_name'])){
                        $valuesTable12[] = array( $this->Lang->source_agency , $val['source_agency_name']);
                    }
                    if(!empty($val['from_agency_name'])){
                        $valuesTable12[] = array( $this->Lang->organ , $val['from_agency_name']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable12[] = array( $this->Lang->source_inf , $val['source']);
                    }
                    if(!empty($val['short_desc'])){
                        $valuesTable12[] = array( $this->Lang->short_desc , $val['short_desc']);
                    }
                    if(!empty($val['related_year'])){
                        $valuesTable12[] = array( $this->Lang->related_year , $val['related_year']);
                    }
                    if(!empty($val['source_address'])){
                        $valuesTable12[] = array( $this->Lang->source_address , $val['source_address']);
                    }
                    if(!empty($val['worker_name'])){
                        $valuesTable12[] = array( $this->Lang->worker_name , $val['worker_name']);
                    }
                    if(!empty($val['reg_number'])){
                        $valuesTable12[] = array( $this->Lang->reg_number , $val['reg_number']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable12[] = array( $this->Lang->reg_date , $val['reg_date']);
                    }
                    if(!empty($val['created_at'])){
                        $valuesTable12[] = array( $this->Lang->date_and_time , $val['created_at']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->bibliography);
                    $docx->addBreak();
                    $docx->addTable($valuesTable12, $paramsTable);
                }
            }
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_with_joins($signal_id)
    {
        try {
            $signal = $this->_model->getSignal($signal_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','signal',$signal_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $signal['id']);
            if(!empty($signal['reg_num'])){
                $valuesTable[] = array( $this->Lang->reg_number_signal , $signal['reg_num']);
            }
            if(!empty($signal['content'])){
                $valuesTable[] = array( $this->Lang->contents_information_signal , $signal['content']);
            }
            if(!empty($signal['check_line'])){
                $valuesTable[] = array( $this->Lang->line_which_verified , $signal['check_line']);
            }
            if(!empty($signal['check_status'])){
                $valuesTable[] = array( $this->Lang->check_status_charter , $signal['check_status']);
            }
            if(!empty($signal['signal_qualification'])){
                $valuesTable[] = array( $this->Lang->qualifications_signaling , $signal['signal_qualification']);
            }
            if(!empty($signal['check_agency'])){
                $valuesTable[] = array( $this->Lang->checks_signal , $signal['check_agency']);
            }
            if(!empty($signal['check_unit'])){
                $valuesTable[] = array( $this->Lang->department_checking , $signal['check_unit']);
            }
            if(!empty($signal['check_subunit'])){
                $valuesTable[] = array( $this->Lang->unit_testing , $signal['check_subunit']);
            }
            if(!empty($signal['subunit_date'])){
                $valuesTable[] = array( $this->Lang->date_registration_division , $signal['subunit_date']);
            }
            if(!empty($signal['check_date'])){
                $valuesTable[] = array( $this->Lang->check_date , $signal['check_date']);
            }
            if(!empty($signal['check_date_id'])){
                $valuesTable[] = array( $this->Lang->check_previously , $signal['check_date_id']);
            }
            if(!empty($signal['end_date'])){
                $valuesTable[] = array( $this->Lang->date_actual_word , $signal['end_date']);
            }
            if(!empty($signal['opened_dou'])){
                $valuesTable[] = array( $this->Lang->according_result_dow , $signal['opened_dou']);
            }
            if(!empty($signal['resource'])){
                $valuesTable[] = array( $this->Lang->useful_capabilities , $signal['resource']);
            }
            if(!empty($signal['opened_agency'])){
                $valuesTable[] = array( $this->Lang->brought_signal , $signal['opened_agency']);
            }
            if(!empty($signal['opened_unit'])){
                $valuesTable[] = array( $this->Lang->department_brought , $signal['opened_unit']);
            }
            if(!empty($signal['opened_subunit'])){
                $valuesTable[] = array( $this->Lang->unit_brought , $signal['opened_subunit']);
            }
            if(!empty($signal['checking_worker'])){
                $valuesTable[] = array( $this->Lang->name_checking_signal , $signal['checking_worker']);
            }
            if(!empty($signal['checking_worker_post'])){
                $valuesTable[] = array( $this->Lang->worker_post , $signal['checking_worker_post']);
            }
            if(!empty($signal['worker'])){
                $valuesTable[] = array( $this->Lang->name_operatives , $signal['worker']);
            }
            if(!empty($signal['worker_post'])){
                $valuesTable[] = array( $this->Lang->worker_post , $signal['worker_post']);
            }
            if(!empty($signal['resource'])){
                $valuesTable[] = array( $this->Lang->source_category , $signal['resource']);
            }
            if(!empty($signal['signal_result'])){
                $valuesTable[] = array( $this->Lang->signal_results , $signal['signal_result']);
            }
            if(!empty($signal['taken_measure_id'])){
                $valuesTable[] = array( $this->Lang->measures_taken , $signal['taken_measure_id']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->signal);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getSignalHasMan($signal['id']);
            if($man){
                if(!((count($man) == 1)&&(empty($man[0]['id'])))){
                    foreach($man as $val)
                    {
                        $valuesTable2 = array();
                        $valuesTable2[] = array( 'id' , $val['id']);
                        if(!empty($val['first_name'])){
                            $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                        }
                        if(!empty($val['last_name'])){
                            $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                        }
                        if(!empty($val['middle_name'])){
                            $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                        }
                        if(!empty($val['passport'])){
                            $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                        }
                        if(!empty($val['gender'])){
                            $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                        }
                        if(!empty($val['country_ate'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                        }
                        if(!empty($val['locality_id'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                        }
                        if(!empty($val['region_id'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                        }
                        if(!empty($val['education'])){
                            $valuesTable2[] = array( $this->Lang->education , $val['education']);
                        }
                        if(!empty($val['language'])){
                            $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                        }
                        if(!empty($val['party'])){
                            $valuesTable2[] = array( $this->Lang->party , $val['party']);
                        }
                        if(!empty($val['citizenship'])){
                            $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                        }
                        if(!empty($val['nation'])){
                            $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                        }
                        if(!empty($val['nickname'])){
                            $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                        }
                        if(!empty($val['operation_category'])){
                            $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                        }
                        if(!empty($val['birthday'])){
                            $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                        }
                        if(!empty($val['answer'])){
                            $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                        }
                        if(!empty($val['resource'])){
                            $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                        }
                        if(!empty($val['approximate_year'])){
                            $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                        }
                        if(!empty($val['start_wanted'])){
                            $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                        }
                        if(!empty($val['entry_date'])){
                            $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                        }
                        if(!empty($val['exit_date'])){
                            $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                        }
                        if(!empty($val['attention'])){
                            $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                        }
                        if(!empty($val['more_data'])){
                            $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                        }
                        if(!empty($val['occupation'])){
                            $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                        }
                        if(!empty($val['opened_dou'])){
                            $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                        }

                        $docx->addBreak();
                        $docx->addText($this->Lang->face);
                        $docx->addBreak();
                        $docx->addTable($valuesTable2, $paramsTable);
                    }
                }
            }

            $criminal_case = $this->_model->getSignalHasCriminalCase($signal['id']);
            if($criminal_case){
                foreach($criminal_case as $val){
                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable3[] = array( $this->Lang->number_case , $val['number']);
                    }
                    if(!empty($val['opened_date'])){
                        $valuesTable3[] = array( $this->Lang->criminal_proceedings_date , $val['opened_date']);
                    }
                    if(!empty($val['artical'])){
                        $valuesTable3[] = array( $this->Lang->criminal_code , $val['artical']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->initiated_dow , $val['opened_dou']);
                    }
                    if(!empty($val['character'])){
                        $valuesTable3[] = array( $this->Lang->nature_materials_paint , $val['character']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable3[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable3[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable3[] = array( $this->Lang->materials_management , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable3[] = array( $this->Lang->head_department , $val['opened_unit']);
                    }
                    if(!empty($val['subunit'])){
                        $valuesTable3[] = array( $this->Lang->instituted_units , $val['subunit']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->criminal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);
                }
            }

            $organization_checked = $this->_model->getSignalHasOrganization($signal['id']);
            if($organization_checked){
                foreach($organization_checked as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable4[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable4[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable4[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable4[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable4[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable4[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable4[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->objects_check_signal_organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $organization_passes = $this->_model->getSignalOrganization($signal['id']);
            if($organization_passes){
                foreach($organization_passes as $val)
                {
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable5[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable5[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable5[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable5[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable5[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable5[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable5[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable5[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->passes_signal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }

            $action = $this->_model->getSignalHasAction($signal['id']);
            if($action){
                foreach($action as $val)
                {
                    $valuesTable6 = array();
                    $valuesTable6[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable6[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable6[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable6[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable6[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable6[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable6[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable6[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable6[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable6[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable6[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable6, $paramsTable);
                }
            }

            $event = $this->_model->getSignalHasEvent($signal['id']);
            if($event){
                foreach($event as $val){
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable7[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable7[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable7[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable7[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable7[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable7[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->event);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $bibliography = $this->_model->getSignalHasBibliography($signal['id']);
            if($bibliography){
                foreach($bibliography as $val)
                {
                    $valuesTable8 = array();
                    $valuesTable8[] = array( 'id' , $val['id']);
                    if(!empty($val['user_name'])){
                        $valuesTable8[] = array( $this->Lang->worker_take_doc , $val['user_name']);
                    }
                    if(!empty($val['access_level'])){
                        $valuesTable8[] = array( $this->Lang->access_level , $val['access_level']);
                    }
                    if(!empty($val['source_agency_name'])){
                        $valuesTable8[] = array( $this->Lang->source_agency , $val['source_agency_name']);
                    }
                    if(!empty($val['from_agency_name'])){
                        $valuesTable8[] = array( $this->Lang->organ , $val['from_agency_name']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable8[] = array( $this->Lang->source_inf , $val['source']);
                    }
                    if(!empty($val['short_desc'])){
                        $valuesTable8[] = array( $this->Lang->short_desc , $val['short_desc']);
                    }
                    if(!empty($val['related_year'])){
                        $valuesTable8[] = array( $this->Lang->related_year , $val['related_year']);
                    }
                    if(!empty($val['source_address'])){
                        $valuesTable8[] = array( $this->Lang->source_address , $val['source_address']);
                    }
                    if(!empty($val['worker_name'])){
                        $valuesTable8[] = array( $this->Lang->worker_name , $val['worker_name']);
                    }
                    if(!empty($val['reg_number'])){
                        $valuesTable8[] = array( $this->Lang->reg_number , $val['reg_number']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable8[] = array( $this->Lang->reg_date , $val['reg_date']);
                    }
                    if(!empty($val['created_at'])){
                        $valuesTable8[] = array( $this->Lang->date_and_time , $val['created_at']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->bibliography);
                    $docx->addBreak();
                    $docx->addTable($valuesTable8, $paramsTable);
                }
            }
            $keep_signal = $this->_model->getSignalHasKeepSignal($signal['id']);
            if($keep_signal){
                foreach($keep_signal as $val)
                {
                    $valuesTable9 = array();
                    $valuesTable9[] = array( 'id' , $val['id']);
                    if(!empty($val['agency'])){
                        $valuesTable9[] = array( $this->Lang->management_signal , $val['agency']);
                    }
                    if(!empty($val['unit'])){
                        $valuesTable9[] = array( $this->Lang->department_checking_signal , $val['unit']);
                    }
                    if(!empty($val['sub_unit'])){
                        $valuesTable9[] = array( $this->Lang->unit_signal , $val['sub_unit']);
                    }
                    if(!empty($val['pased_sub_unit'])){
                        $valuesTable9[] = array( $this->Lang->unit_signal_transmitted , $val['pased_sub_unit']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable9[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable9[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['start_date'])){
                        $valuesTable9[] = array( $this->Lang->start_checking_signal , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable9[] = array( $this->Lang->end_checking_signal , $val['end_date']);
                    }
                    if(!empty($val['pass_date'])){
                        $valuesTable9[] = array( $this->Lang->date_transfer_unit , $val['pass_date']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->keep_signal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable9, $paramsTable);
                }
            }
            $docx->createDocx(APP_PATH.'/webroot/files/word');
            $file = (APP_PATH.'/webroot/files/word.docx');
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function criminal_case_with_joins($criminal_case_id)
    {
        try {
            $criminal_case = $this->_model->getCriminalCase($criminal_case_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','criminal_case',$criminal_case_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $criminal_case['id']);
            if(!empty($criminal_case['number'])){
                $valuesTable[] = array( $this->Lang->number_case , $criminal_case['number']);
            }
            if(!empty($criminal_case['opened_date'])){
                $valuesTable[] = array( $this->Lang->criminal_proceedings_date , $criminal_case['opened_date']);
            }
            if(!empty($criminal_case['artical'])){
                $valuesTable[] = array( $this->Lang->criminal_code , $criminal_case['artical']);
            }
            if(!empty($criminal_case['opened_dou'])){
                $valuesTable[] = array( $this->Lang->initiated_dow , $criminal_case['opened_dou']);
            }
            if(!empty($criminal_case['character'])){
                $valuesTable[] = array( $this->Lang->nature_materials_paint , $criminal_case['character']);
            }
            if(!empty($criminal_case['worker'])){
                $valuesTable[] = array( $this->Lang->name_operatives , $criminal_case['worker']);
            }
            if(!empty($criminal_case['worker_post'])){
                $valuesTable[] = array( $this->Lang->worker_post , $criminal_case['worker_post']);
            }
            if(!empty($criminal_case['opened_agency'])){
                $valuesTable[] = array( $this->Lang->materials_management , $criminal_case['opened_agency']);
            }
            if(!empty($criminal_case['opened_unit'])){
                $valuesTable[] = array( $this->Lang->head_department , $criminal_case['opened_unit']);
            }
            if(!empty($criminal_case['subunit'])){
                $valuesTable[] = array( $this->Lang->instituted_units , $criminal_case['subunit']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->criminal);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getCriminalCaseHasMan($criminal_case['id']);
            if($man){
                if(!((count($man) == 1)&&(empty($man[0]['id'])))){
                    foreach($man as $val)
                    {
                        $valuesTable2 = array();
                        $valuesTable2[] = array( 'id' , $val['id']);
                        if(!empty($val['first_name'])){
                            $valuesTable2[] = array( $this->Lang->first_name , $val['first_name']);
                        }
                        if(!empty($val['last_name'])){
                            $valuesTable2[] = array( $this->Lang->last_name , $val['last_name']);
                        }
                        if(!empty($val['middle_name'])){
                            $valuesTable2[] = array( $this->Lang->middle_name , $val['middle_name']);
                        }
                        if(!empty($val['passport'])){
                            $valuesTable2[] = array( $this->Lang->passport_number , $val['passport']);
                        }
                        if(!empty($val['gender'])){
                            $valuesTable2[] = array( $this->Lang->gender , $val['gender']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable2[] = array( $this->Lang->citizenship , $val['country']);
                        }
                        if(!empty($val['country_ate'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                        }
                        if(!empty($val['locality_id'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                        }
                        if(!empty($val['region_id'])){
                            $valuesTable2[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                        }
                        if(!empty($val['education'])){
                            $valuesTable2[] = array( $this->Lang->education , $val['education']);
                        }
                        if(!empty($val['language'])){
                            $valuesTable2[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                        }
                        if(!empty($val['party'])){
                            $valuesTable2[] = array( $this->Lang->party , $val['party']);
                        }
                        if(!empty($val['citizenship'])){
                            $valuesTable2[] = array( $this->Lang->citizenship , $val['citizenship']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable2[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                        }
                        if(!empty($val['nation'])){
                            $valuesTable2[] = array( $this->Lang->nationality , $val['nation']);
                        }
                        if(!empty($val['nickname'])){
                            $valuesTable2[] = array( $this->Lang->alias , $val['nickname']);
                        }
                        if(!empty($val['operation_category'])){
                            $valuesTable2[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                        }
                        if(!empty($val['birthday'])){
                            $valuesTable2[] = array( $this->Lang->date_of_birth , $val['birthday']);
                        }
                        if(!empty($val['answer'])){
                            $valuesTable2[] = array( $this->Lang->answer , $val['answer']);
                        }
                        if(!empty($val['resource'])){
                            $valuesTable2[] = array( $this->Lang->source_information , $val['resource']);
                        }
                        if(!empty($val['approximate_year'])){
                            $valuesTable2[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                        }
                        if(!empty($val['start_wanted'])){
                            $valuesTable2[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                        }
                        if(!empty($val['entry_date'])){
                            $valuesTable2[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                        }
                        if(!empty($val['exit_date'])){
                            $valuesTable2[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                        }
                        if(!empty($val['attention'])){
                            $valuesTable2[] = array( $this->Lang->attention , $val['attention']);
                        }
                        if(!empty($val['more_data'])){
                            $valuesTable2[] = array( $this->Lang->additional_information_person , $val['more_data']);
                        }
                        if(!empty($val['occupation'])){
                            $valuesTable2[] = array( $this->Lang->occupation , $val['occupation']);
                        }
                        if(!empty($val['opened_dou'])){
                            $valuesTable2[] = array( $this->Lang->face_opened , $val['opened_dou']);
                        }
                        $docx->addBreak();
                        $docx->addText($this->Lang->face);
                        $docx->addBreak();
                        $docx->addTable($valuesTable2, $paramsTable);
                    }
                }
            }

            $organization = $this->_model->getCriminalCaseHasOrganization($criminal_case['id']);
            if($organization){
                if(!( (count($organization) == 1)&&(empty($organization[0]['id'])) )){
                    foreach($organization as $val)
                    {
                        $valuesTable3 = array();
                        $valuesTable3[] = array( 'id' , $val['id']);
                        if(!empty($val['name'])){
                            $valuesTable3[] = array( $this->Lang->name_organization , $val['name']);
                        }
                        if(!empty($val['country'])){
                            $valuesTable3[] = array( $this->Lang->nation , $val['country']);
                        }
                        if(!empty($val['reg_date'])){
                            $valuesTable3[] = array( $this->Lang->date_formation , $val['reg_date']);
                        }
                        if(!empty($val['country_ate'])){
                            $valuesTable3[] = array( $this->Lang->region_activity , $val['country_ate']);
                        }
                        if(!empty($val['category'])){
                            $valuesTable3[] = array( $this->Lang->category_organization , $val['category']);
                        }
                        if(!empty($val['agency'])){
                            $valuesTable3[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                        }
                        if(!empty($val['employers_count'])){
                            $valuesTable3[] = array( $this->Lang->number_worker , $val['employers_count']);
                        }
                        if(!empty($val['attension'])){
                            $valuesTable3[] = array( $this->Lang->attention , $val['attension']);
                        }
                        if(!empty($val['opened_dou'])){
                            $valuesTable3[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                        }
                        $docx->addBreak();
                        $docx->addText($this->Lang->organization);
                        $docx->addBreak();
                        $docx->addTable($valuesTable3, $paramsTable);
                    }
                }
            }

            $action = $this->_model->getCriminalCaseHasAction($criminal_case['id']);
            if($action){
                foreach($action as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable4[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable4[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable4[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable4[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable4[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable4[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable4[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable4[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable4[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $event = $this->_model->getCriminalCaseHasEvent($criminal_case['id']);
            if($event){
                foreach($event as $val){
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable5[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable5[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable5[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable5[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable5[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->event);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }

            $signal = $this->_model->getCriminalCaseHasSignal($criminal_case['id']);
            if($signal){
                foreach($signal as $val)
                {
                    $valuesTable6 = array();
                    $valuesTable6[] = array( 'id' , $val['id']);
                    if(!empty($val['reg_num'])){
                        $valuesTable6[] = array( $this->Lang->reg_number_signal , $val['reg_num']);
                    }
                    if(!empty($val['content'])){
                        $valuesTable6[] = array( $this->Lang->contents_information_signal , $val['content']);
                    }
                    if(!empty($val['check_line'])){
                        $valuesTable6[] = array( $this->Lang->line_which_verified , $val['check_line']);
                    }
                    if(!empty($val['check_status'])){
                        $valuesTable6[] = array( $this->Lang->check_status_charter , $val['check_status']);
                    }
                    if(!empty($val['signal_qualification'])){
                        $valuesTable6[] = array( $this->Lang->qualifications_signaling , $val['signal_qualification']);
                    }
                    if(!empty($val['check_agency'])){
                        $valuesTable6[] = array( $this->Lang->checks_signal , $val['check_agency']);
                    }
                    if(!empty($val['check_unit'])){
                        $valuesTable6[] = array( $this->Lang->department_checking , $val['check_unit']);
                    }
                    if(!empty($val['check_subunit'])){
                        $valuesTable6[] = array( $this->Lang->unit_testing , $val['check_subunit']);
                    }
                    if(!empty($val['subunit_date'])){
                        $valuesTable6[] = array( $this->Lang->date_registration_division , $val['subunit_date']);
                    }
                    if(!empty($val['check_date'])){
                        $valuesTable6[] = array( $this->Lang->check_date , $val['check_date']);
                    }
                    if(!empty($val['check_date_id'])){
                        $valuesTable6[] = array( $this->Lang->check_previously , $val['check_date_id']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable6[] = array( $this->Lang->date_actual_word , $val['end_date']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable6[] = array( $this->Lang->according_result_dow , $val['opened_dou']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable6[] = array( $this->Lang->useful_capabilities , $val['resource']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable6[] = array( $this->Lang->brought_signal , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable6[] = array( $this->Lang->department_brought , $val['opened_unit']);
                    }
                    if(!empty($val['opened_subunit'])){
                        $valuesTable6[] = array( $this->Lang->unit_brought , $val['opened_subunit']);
                    }
                    if(!empty($val['checking_worker'])){
                        $valuesTable6[] = array( $this->Lang->name_checking_signal , $val['checking_worker']);
                    }
                    if(!empty($val['checking_worker_post'])){
                        $valuesTable6[] = array( $this->Lang->worker_post , $val['checking_worker_post']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable6[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable6[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable6[] = array( $this->Lang->source_category , $val['resource']);
                    }
                    if(!empty($val['signal_result'])){
                        $valuesTable6[] = array( $this->Lang->signal_results , $val['signal_result']);
                    }
                    if(!empty($val['taken_measure_id'])){
                        $valuesTable6[] = array( $this->Lang->measures_taken , $val['taken_measure_id']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->signal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable6, $paramsTable);
                }
            }

            $criminal_case_extracted = $this->_model->getCriminalCaseHasCriminal($criminal_case['id']);
            if($criminal_case_extracted){
                foreach($criminal_case_extracted as $val){
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable7[] = array( $this->Lang->number_case , $val['number']);
                    }
                    if(!empty($val['opened_date'])){
                        $valuesTable7[] = array( $this->Lang->criminal_proceedings_date , $val['opened_date']);
                    }
                    if(!empty($val['artical'])){
                        $valuesTable7[] = array( $this->Lang->criminal_code , $val['artical']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable7[] = array( $this->Lang->initiated_dow , $val['opened_dou']);
                    }
                    if(!empty($val['character'])){
                        $valuesTable7[] = array( $this->Lang->nature_materials_paint , $val['character']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable7[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable7[] = array( $this->Lang->materials_management , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable7[] = array( $this->Lang->head_department , $val['opened_unit']);
                    }
                    if(!empty($val['subunit'])){
                        $valuesTable7[] = array( $this->Lang->instituted_units , $val['subunit']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->connected_criminal_cases);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $criminal_case_splited = $this->_model->getCriminalCaseHasCase($criminal_case['id']);
            if($criminal_case_splited){
                foreach($criminal_case_splited as $val){
                    $valuesTable8 = array();
                    $valuesTable8[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable8[] = array( $this->Lang->number_case , $val['number']);
                    }
                    if(!empty($val['opened_date'])){
                        $valuesTable8[] = array( $this->Lang->criminal_proceedings_date , $val['opened_date']);
                    }
                    if(!empty($val['artical'])){
                        $valuesTable8[] = array( $this->Lang->criminal_code , $val['artical']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable8[] = array( $this->Lang->initiated_dow , $val['opened_dou']);
                    }
                    if(!empty($val['character'])){
                        $valuesTable8[] = array( $this->Lang->nature_materials_paint , $val['character']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable8[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable8[] = array( $this->Lang->materials_management , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable8[] = array( $this->Lang->head_department , $val['opened_unit']);
                    }
                    if(!empty($val['subunit'])){
                        $valuesTable8[] = array( $this->Lang->instituted_units , $val['subunit']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->separated_criminal_cases);
                    $docx->addBreak();
                    $docx->addTable($valuesTable8, $paramsTable);
                }
            }

            $bibliography = $this->_model->getCriminalCaseHasBibliography($criminal_case['id']);
            if($bibliography){
                foreach($bibliography as $val)
                {
                    $valuesTable9 = array();
                    $valuesTable9[] = array( 'id' , $val['id']);
                    if(!empty($val['user_name'])){
                        $valuesTable9[] = array( $this->Lang->worker_take_doc , $val['user_name']);
                    }
                    if(!empty($val['access_level'])){
                        $valuesTable9[] = array( $this->Lang->access_level , $val['access_level']);
                    }
                    if(!empty($val['source_agency_name'])){
                        $valuesTable9[] = array( $this->Lang->source_agency , $val['source_agency_name']);
                    }
                    if(!empty($val['from_agency_name'])){
                        $valuesTable9[] = array( $this->Lang->organ , $val['from_agency_name']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable9[] = array( $this->Lang->source_inf , $val['source']);
                    }
                    if(!empty($val['short_desc'])){
                        $valuesTable9[] = array( $this->Lang->short_desc , $val['short_desc']);
                    }
                    if(!empty($val['related_year'])){
                        $valuesTable9[] = array( $this->Lang->related_year , $val['related_year']);
                    }
                    if(!empty($val['source_address'])){
                        $valuesTable9[] = array( $this->Lang->source_address , $val['source_address']);
                    }
                    if(!empty($val['worker_name'])){
                        $valuesTable9[] = array( $this->Lang->worker_name , $val['worker_name']);
                    }
                    if(!empty($val['reg_number'])){
                        $valuesTable9[] = array( $this->Lang->reg_number , $val['reg_number']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable9[] = array( $this->Lang->reg_date , $val['reg_date']);
                    }
                    if(!empty($val['created_at'])){
                        $valuesTable9[] = array( $this->Lang->date_and_time , $val['created_at']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->bibliography);
                    $docx->addBreak();
                    $docx->addTable($valuesTable9, $paramsTable);
                }
            }
            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function organization_with_joins($organization_id)
    {
        try {
            $organization = $this->_model->getOrganization($organization_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','organization',$organization_id);


            $valuesTable = array();
            $valuesTable[] = array( 'id' , $organization['id']);
            if(!empty($organization['name'])){
                $valuesTable[] = array( $this->Lang->name_organization , $organization['name']);
            }
            if(!empty($organization['country'])){
                $valuesTable[] = array( $this->Lang->nation , $organization['country']);
            }
            if(!empty($organization['reg_date'])){
                $valuesTable[] = array( $this->Lang->date_formation , $organization['reg_date']);
            }
            if(!empty($organization['country_ate'])){
                $valuesTable[] = array( $this->Lang->region_activity , $organization['country_ate']);
            }
            if(!empty($organization['category'])){
                $valuesTable[] = array( $this->Lang->category_organization , $organization['category']);
            }
            if(!empty($organization['agency'])){
                $valuesTable[] = array( $this->Lang->security_organization_for_grid , $organization['agency']);
            }
            if(!empty($organization['employers_count'])){
                $valuesTable[] = array( $this->Lang->number_worker , $organization['employers_count']);
            }
            if(!empty($organization['attension'])){
                $valuesTable[] = array( $this->Lang->attention , $organization['attension']);
            }
            if(!empty($organization['opened_dou'])){
                $valuesTable[] = array( $this->Lang->organization_dow , $organization['opened_dou']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'pct',
                    'value' => '100'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->organization);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);


            $man = $this->_model->getOrganizationHasWorkActivityMan($organization['id']);
            if($man){
                foreach($man as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable4[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable4[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable4[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable4[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable4[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable4[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable4[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable4[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable4[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable4[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable4[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable4[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable4[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable4[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable4[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable4[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable4[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable4[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable4[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable4[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }


            $address_has = $this->_model->getOrganizationHasAddress($organization['id']);
            if($address_has){
                foreach($address_has as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['country_ate'])){
                        $valuesTable7[] = array( $this->Lang->country_ate , $val['country_ate']);
                    }
                    if(!empty($val['region'])){
                        $valuesTable7[] = array( $this->Lang->region , $val['region']);
                    }
                    if(!empty($val['locality'])){
                        $valuesTable7[] = array( $this->Lang->locality , $val['locality']);
                    }
                    if(!empty($val['street'])){
                        $valuesTable7[] = array( $this->Lang->street , $val['street']);
                    }
                    if(!empty($val['track'])){
                        $valuesTable7[] = array( $this->Lang->track , $val['track']);
                    }
                    if(!empty($val['home_num'])){
                        $valuesTable7[] = array( $this->Lang->home_num , $val['home_num']);
                    }
                    if(!empty($val['housing_num'])){
                        $valuesTable7[] = array( $this->Lang->housing_num , $val['housing_num']);
                    }
                    if(!empty($val['apt_num'])){
                        $valuesTable7[] = array( $this->Lang->apt_num , $val['apt_num']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->dislocation_organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $address = $this->_model->getOrganizationAddress($organization['id']);
            if($address){
                foreach($address as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['country_ate'])){
                        $valuesTable7[] = array( $this->Lang->country_ate , $val['country_ate']);
                    }
                    if(!empty($val['region'])){
                        $valuesTable7[] = array( $this->Lang->region , $val['region']);
                    }
                    if(!empty($val['locality'])){
                        $valuesTable7[] = array( $this->Lang->locality , $val['locality']);
                    }
                    if(!empty($val['street'])){
                        $valuesTable7[] = array( $this->Lang->street , $val['street']);
                    }
                    if(!empty($val['track'])){
                        $valuesTable7[] = array( $this->Lang->track , $val['track']);
                    }
                    if(!empty($val['home_num'])){
                        $valuesTable7[] = array( $this->Lang->home_num , $val['home_num']);
                    }
                    if(!empty($val['housing_num'])){
                        $valuesTable7[] = array( $this->Lang->housing_num , $val['housing_num']);
                    }
                    if(!empty($val['apt_num'])){
                        $valuesTable7[] = array( $this->Lang->apt_num , $val['apt_num']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->dummy_address);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $organization_organization = $this->_model->getOrganizationHasOrganization($organization['id']);
            if($organization_organization){
                foreach($organization_organization as $val)
                {
                    $valuesTable2 = array();
                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable2[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable2[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable2[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable2[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable2[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $phone = $this->_model->getOrganizationHasPhone($organization['id']);
            if($phone){
                foreach($phone as $val)
                {
                    $valuesTable8 = array();
                    $valuesTable8[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable8[] = array( $this->Lang->phone_number , $val['number']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable8[] = array( $this->Lang->additional_data , $val['more_data']);
                    }
                    if(!empty($val['character_man'])){
                        $valuesTable8[] = array( $this->Lang->nature_character_man , $val['character_man']);
                    }
                    if(!empty($val['character_organization'])){
                        $valuesTable8[] = array( $this->Lang->nature_character_organization , $val['character_organization']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->telephone);
                    $docx->addBreak();
                    $docx->addTable($valuesTable8, $paramsTable);
                }
            }

            $email = $this->_model->getOrganizationHasEmail($organization['id']);
            if($email){
                foreach($email as $val)
                {
                    $valuesTable = array();
                    $valuesTable[] = array( 'id' , $val['id']);
                    if(!empty($val['address'])){
                        $valuesTable[] = array( $this->Lang->address , $val['address']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->email);
                    $docx->addBreak();
                    $docx->addTable($valuesTable8, $paramsTable);
                }
            }

            $event_has = $this->_model->getOrganizationHasEvent($organization['id']);
            if($event_has){
                foreach($event_has as $val){
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable5[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable5[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable5[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable5[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable5[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->object_actions);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }

            $event = $this->_model->getOrganizationEvent($organization['id']);
            if($event){
                foreach($event as $val){
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable5[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable5[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable5[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable5[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable5[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->place_event_is);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }


            $work_activity = $this->_model->getOrganizationHasWorkActivity($organization['id']);
            if($work_activity){
                foreach($work_activity as $val)
                {

                    $valuesTable = array();
                    $valuesTable[] = array( 'id' , $val['id']);
                    if(!empty($val['title'])){
                        $valuesTable[] = array( $this->Lang->position , $val['title']);
                    }
                    if(!empty($val['period'])){
                        $valuesTable[] = array( $this->Lang->data_refer_period , $val['period']);
                    }
                    if(!empty($val['start_date'])){
                        $valuesTable[] = array( $this->Lang->start_employment , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable[] = array( $this->Lang->end_employment , $val['end_date']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->work_activity_2);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }

            $criminal_case = $this->_model->getOrganizationHasCriminalCase($organization['id']);
            if($criminal_case){
                foreach($criminal_case as $val){
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable7[] = array( $this->Lang->number_case , $val['number']);
                    }
                    if(!empty($val['opened_date'])){
                        $valuesTable7[] = array( $this->Lang->criminal_proceedings_date , $val['opened_date']);
                    }
                    if(!empty($val['artical'])){
                        $valuesTable7[] = array( $this->Lang->criminal_code , $val['artical']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable7[] = array( $this->Lang->initiated_dow , $val['opened_dou']);
                    }
                    if(!empty($val['character'])){
                        $valuesTable7[] = array( $this->Lang->nature_materials_paint , $val['character']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable7[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable7[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable7[] = array( $this->Lang->materials_management , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable7[] = array( $this->Lang->head_department , $val['opened_unit']);
                    }
                    if(!empty($val['subunit'])){
                        $valuesTable7[] = array( $this->Lang->instituted_units , $val['subunit']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->criminal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }


            $action = $this->_model->getOrganizationHasAction($organization['id']);
            if($action){
                foreach($action as $val)
                {

                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable3[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable3[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable3[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable3[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable3[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable3[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable3[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable3[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable3[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);

                }
            }

            $signal_has = $this->_model->getOrganizationHasSignal($organization['id']);
            if($signal_has){
                foreach($signal_has as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['reg_num'])){
                        $valuesTable4[] = array( $this->Lang->reg_number_signal , $val['reg_num']);
                    }
                    if(!empty($val['content'])){
                        $valuesTable4[] = array( $this->Lang->contents_information_signal , $val['content']);
                    }
                    if(!empty($val['check_line'])){
                        $valuesTable4[] = array( $this->Lang->line_which_verified , $val['check_line']);
                    }
                    if(!empty($val['check_status'])){
                        $valuesTable4[] = array( $this->Lang->check_status_charter , $val['check_status']);
                    }
                    if(!empty($val['signal_qualification'])){
                        $valuesTable4[] = array( $this->Lang->qualifications_signaling , $val['signal_qualification']);
                    }
                    if(!empty($val['check_agency'])){
                        $valuesTable4[] = array( $this->Lang->checks_signal , $val['check_agency']);
                    }
                    if(!empty($val['check_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_checking , $val['check_unit']);
                    }
                    if(!empty($val['check_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_testing , $val['check_subunit']);
                    }
                    if(!empty($val['subunit_date'])){
                        $valuesTable4[] = array( $this->Lang->date_registration_division , $val['subunit_date']);
                    }
                    if(!empty($val['check_date'])){
                        $valuesTable4[] = array( $this->Lang->check_date , $val['check_date']);
                    }
                    if(!empty($val['check_date_id'])){
                        $valuesTable4[] = array( $this->Lang->check_previously , $val['check_date_id']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable4[] = array( $this->Lang->date_actual_word , $val['end_date']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->according_result_dow , $val['opened_dou']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->useful_capabilities , $val['resource']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable4[] = array( $this->Lang->brought_signal , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_brought , $val['opened_unit']);
                    }
                    if(!empty($val['opened_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_brought , $val['opened_subunit']);
                    }
                    if(!empty($val['checking_worker'])){
                        $valuesTable4[] = array( $this->Lang->name_checking_signal , $val['checking_worker']);
                    }
                    if(!empty($val['checking_worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['checking_worker_post']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable4[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_category , $val['resource']);
                    }
                    if(!empty($val['signal_result'])){
                        $valuesTable4[] = array( $this->Lang->signal_results , $val['signal_result']);
                    }
                    if(!empty($val['taken_measure_id'])){
                        $valuesTable4[] = array( $this->Lang->measures_taken , $val['taken_measure_id']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->checked_signal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $signal = $this->_model->getOrganizationSignal($organization['id']);
            if($signal){
                foreach($signal as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['reg_num'])){
                        $valuesTable4[] = array( $this->Lang->reg_number_signal , $val['reg_num']);
                    }
                    if(!empty($val['content'])){
                        $valuesTable4[] = array( $this->Lang->contents_information_signal , $val['content']);
                    }
                    if(!empty($val['check_line'])){
                        $valuesTable4[] = array( $this->Lang->line_which_verified , $val['check_line']);
                    }
                    if(!empty($val['check_status'])){
                        $valuesTable4[] = array( $this->Lang->check_status_charter , $val['check_status']);
                    }
                    if(!empty($val['signal_qualification'])){
                        $valuesTable4[] = array( $this->Lang->qualifications_signaling , $val['signal_qualification']);
                    }
                    if(!empty($val['check_agency'])){
                        $valuesTable4[] = array( $this->Lang->checks_signal , $val['check_agency']);
                    }
                    if(!empty($val['check_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_checking , $val['check_unit']);
                    }
                    if(!empty($val['check_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_testing , $val['check_subunit']);
                    }
                    if(!empty($val['subunit_date'])){
                        $valuesTable4[] = array( $this->Lang->date_registration_division , $val['subunit_date']);
                    }
                    if(!empty($val['check_date'])){
                        $valuesTable4[] = array( $this->Lang->check_date , $val['check_date']);
                    }
                    if(!empty($val['check_date_id'])){
                        $valuesTable4[] = array( $this->Lang->check_previously , $val['check_date_id']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable4[] = array( $this->Lang->date_actual_word , $val['end_date']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->according_result_dow , $val['opened_dou']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->useful_capabilities , $val['resource']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable4[] = array( $this->Lang->brought_signal , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_brought , $val['opened_unit']);
                    }
                    if(!empty($val['opened_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_brought , $val['opened_subunit']);
                    }
                    if(!empty($val['checking_worker'])){
                        $valuesTable4[] = array( $this->Lang->name_checking_signal , $val['checking_worker']);
                    }
                    if(!empty($val['checking_worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['checking_worker_post']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable4[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_category , $val['resource']);
                    }
                    if(!empty($val['signal_result'])){
                        $valuesTable4[] = array( $this->Lang->signal_results , $val['signal_result']);
                    }
                    if(!empty($val['taken_measure_id'])){
                        $valuesTable4[] = array( $this->Lang->measures_taken , $val['taken_measure_id']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->passes_signal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $bibliography = $this->_model->getOrganizationHasBibliography($organization['id']);
            if($bibliography){
                foreach($bibliography as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['user_name'])){
                        $valuesTable4[] = array( $this->Lang->worker_take_doc , $val['user_name']);
                    }
                    if(!empty($val['access_level'])){
                        $valuesTable4[] = array( $this->Lang->access_level , $val['access_level']);
                    }
                    if(!empty($val['source_agency_name'])){
                        $valuesTable4[] = array( $this->Lang->source_agency , $val['source_agency_name']);
                    }
                    if(!empty($val['from_agency_name'])){
                        $valuesTable4[] = array( $this->Lang->organ , $val['from_agency_name']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable4[] = array( $this->Lang->source_inf , $val['source']);
                    }
                    if(!empty($val['short_desc'])){
                        $valuesTable4[] = array( $this->Lang->short_desc , $val['short_desc']);
                    }
                    if(!empty($val['related_year'])){
                        $valuesTable4[] = array( $this->Lang->related_year , $val['related_year']);
                    }
                    if(!empty($val['source_address'])){
                        $valuesTable4[] = array( $this->Lang->source_address , $val['source_address']);
                    }
                    if(!empty($val['worker_name'])){
                        $valuesTable4[] = array( $this->Lang->worker_name , $val['worker_name']);
                    }
                    if(!empty($val['reg_number'])){
                        $valuesTable4[] = array( $this->Lang->reg_number , $val['reg_number']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable4[] = array( $this->Lang->reg_date , $val['reg_date']);
                    }
                    if(!empty($val['created_at'])){
                        $valuesTable4[] = array( $this->Lang->date_and_time , $val['created_at']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->bibliography);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);

                }
            }

            $car = $this->_model->getOrganizationHasCar($organization['id']);
            if($car){
                foreach($car as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['car_category'])){
                        $valuesTable7[] = array( $this->Lang->car_cat , $val['car_category']);
                    }
                    if(!empty($val['car_mark'])){
                        $valuesTable7[] = array( $this->Lang->mark , $val['car_mark']);
                    }
                    if(!empty($val['car_color'])){
                        $valuesTable7[] = array( $this->Lang->color , $val['car_color']);
                    }
                    if(!empty($val['number'])){
                        $valuesTable7[] = array( $this->Lang->car_number , $val['number']);
                    }
                    if(!empty($val['count'])){
                        $valuesTable7[] = array( $this->Lang->count , $val['count']);
                    }
                    if(!empty($val['note'])){
                        $valuesTable7[] = array( $this->Lang->additional_data , $val['note']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->car);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $weapon = $this->_model->getOrganizationHasWeapon($organization['id']);
            if($weapon){
                foreach($weapon as $val)
                {
                    $valuesTable9 = array();
                    $valuesTable9[] = array( 'id' , $val['id']);
                    if(!empty($val['category'])){
                        $valuesTable9[] = array( $this->Lang->category , $val['category']);
                    }
                    if(!empty($val['view'])){
                        $valuesTable9[] = array( $this->Lang->view , $val['view']);
                    }
                    if(!empty($val['type'])){
                        $valuesTable9[] = array( $this->Lang->type , $val['type']);
                    }
                    if(!empty($val['reg_num'])){
                        $valuesTable9[] = array( $this->Lang->account_number , $val['reg_num']);
                    }
                    if(!empty($val['model'])){
                        $valuesTable9[] = array( $this->Lang->mark , $val['model']);
                    }
                    if(!empty($val['count'])){
                        $valuesTable9[] = array( $this->Lang->count , $val['count']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->weapon);
                    $docx->addBreak();
                    $docx->addTable($valuesTable9, $paramsTable);
                }
            }

            $mia_summary = $this->_model->getOrganizationHasMiaSummary($organization['id']);
            if($mia_summary){
                foreach($mia_summary as $val){
                    $valuesTable9 = array();
                    $valuesTable9[] = array( 'id' , $val['id']);
                    if(!empty($val['content'])){
                        $valuesTable9[] = array( $this->Lang->content_inf , $val['content']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable9[] = array( $this->Lang->date_registration_reports , $val['date']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->mia_summary);
                    $docx->addBreak();
                    $docx->addTable($valuesTable9, $paramsTable);
                }
            }


            $organization_obj = $this->_model->getOrganizationHasObjectOrganization($organization['id']);
            if($organization_obj){
                foreach($organization_obj as $val)
                {
                    $valuesTable2 = array();

                    if(!empty($val['relation_type'])){
                        $valuesTable2[] = array( $this->Lang->relation_type , $val['relation_type']);
                    }

                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable2[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable2[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable2[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable2[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable2[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->relationship_objects_organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $man_obj = $this->_model->getOrganizationHasObjectMan($organization['id']);
            if($man_obj){
                foreach($man_obj as $val)
                {

                    $valuesTable4 = array();

                    if(!empty($val['relation_type'])){
                        $valuesTable4[] = array( $this->Lang->relation_type , $val['relation_type']);
                    }

                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable4[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable4[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable4[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable4[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable4[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable4[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable4[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable4[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable4[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable4[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable4[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable4[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable4[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable4[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable4[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable4[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable4[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable4[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable4[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable4[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->relationship_objects_man);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');
            $file = (APP_PATH.'/webroot/files/word.docx');
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function man_with_joins($man_id)
    {
        try {
            $man = $this->_model->getMan($man_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','man',$man_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $man['id']);
            if(!empty($man['first_name'])){
                $valuesTable[] = array( $this->Lang->first_name , $man['first_name']);
            }
            if(!empty($man['last_name'])){
                $valuesTable[] = array( $this->Lang->last_name , $man['last_name']);
            }
            if(!empty($man['middle_name'])){
                $valuesTable[] = array( $this->Lang->middle_name , $man['middle_name']);
            }
            if(!empty($man['passport'])){
                $valuesTable[] = array( $this->Lang->passport_number , $man['passport']);
            }
            if(!empty($man['gender'])){
                $valuesTable[] = array( $this->Lang->gender , $man['gender']);
            }
            if(!empty($man['country'])){
                $valuesTable[] = array( $this->Lang->citizenship , $man['country']);
            }
            if(!empty($man['country_ate'])){
                $valuesTable[] = array( $this->Lang->place_of_birth , $man['country_ate']);
            }
            if(!empty($man['locality_id'])){
                $valuesTable[] = array( $this->Lang->place_of_birth_settlement_local , $man['locality_id']);
            }
            if(!empty($man['region_id'])){
                $valuesTable[] = array( $this->Lang->place_of_birth_area_local , $man['region_id']);
            }
            if(!empty($man['education'])){
                $valuesTable[] = array( $this->Lang->education , $man['education']);
            }
            if(!empty($man['language'])){
                $valuesTable[] = array( $this->Lang->knowledge_of_languages , $man['language']);
            }
            if(!empty($man['party'])){
                $valuesTable[] = array( $this->Lang->party , $man['party']);
            }
            if(!empty($man['citizenship'])){
                $valuesTable[] = array( $this->Lang->citizenship , $man['citizenship']);
            }
            if(!empty($man['country'])){
                $valuesTable[] = array( $this->Lang->country_carrying_out_search , $man['country']);
            }
            if(!empty($man['nation'])){
                $valuesTable[] = array( $this->Lang->nationality , $man['nation']);
            }
            if(!empty($man['nickname'])){
                $valuesTable[] = array( $this->Lang->alias , $man['nickname']);
            }
            if(!empty($man['operation_category'])){
                $valuesTable[] = array( $this->Lang->operational_category_person , $man['operation_category']);
            }
            if(!empty($man['birthday'])){
                $valuesTable[] = array( $this->Lang->date_of_birth , $man['birthday']);
            }
            if(!empty($man['answer'])){
                $valuesTable[] = array( $this->Lang->answer , $man['answer']);
            }
            if(!empty($man['resource'])){
                $valuesTable[] = array( $this->Lang->source_information , $man['resource']);
            }
            if(!empty($man['approximate_year'])){
                $valuesTable[] = array( $this->Lang->approximate_year , $man['approximate_year']);
            }
            if(!empty($man['start_wanted'])){
                $valuesTable[] = array( $this->Lang->declared_wanted_list_with , $man['start_wanted']);
            }
            if(!empty($man['entry_date'])){
                $valuesTable[] = array( $this->Lang->home_monitoring_start , $man['entry_date']);
            }
            if(!empty($man['exit_date'])){
                $valuesTable[] = array( $this->Lang->end_monitoring_start , $man['exit_date']);
            }
            if(!empty($man['attention'])){
                $valuesTable[] = array( $this->Lang->attention , $man['attention']);
            }
            if(!empty($man['more_data'])){
                $valuesTable[] = array( $this->Lang->additional_information_person , $man['more_data']);
            }
            if(!empty($man['occupation'])){
                $valuesTable[] = array( $this->Lang->occupation , $man['occupation']);
            }
            if(!empty($man['opened_dou'])){
                $valuesTable[] = array( $this->Lang->face_opened , $man['opened_dou']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'dxa',
                    'value' => '7'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->face);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man_has = $this->_model->getManHasMan($man['id']);
            if($man_has){

                foreach($man_has as $val)
                {

                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable4[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable4[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable4[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable4[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable4[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable4[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable4[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable4[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable4[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable4[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable4[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable4[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable4[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable4[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable4[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable4[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable4[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable4[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable4[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable4[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }

                    $docx->addBreak();

                    $docx->addText($this->Lang->also_known_as);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $man_man = $this->_model->getManMan($man['id']);
            if($man_man){

                foreach($man_man as $val)
                {

                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable4[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable4[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable4[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable4[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable4[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable4[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable4[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable4[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable4[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable4[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable4[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable4[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable4[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable4[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable4[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable4[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable4[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable4[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable4[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable4[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->face_face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $address = $this->_model->getManAddress($man['id']);
            if($address){
                foreach($address as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['country_ate'])){
                        $valuesTable7[] = array( $this->Lang->country_ate , $val['country_ate']);
                    }
                    if(!empty($val['region'])){
                        $valuesTable7[] = array( $this->Lang->region , $val['region']);
                    }
                    if(!empty($val['locality'])){
                        $valuesTable7[] = array( $this->Lang->locality , $val['locality']);
                    }
                    if(!empty($val['street'])){
                        $valuesTable7[] = array( $this->Lang->street , $val['street']);
                    }
                    if(!empty($val['track'])){
                        $valuesTable7[] = array( $this->Lang->track , $val['track']);
                    }
                    if(!empty($val['home_num'])){
                        $valuesTable7[] = array( $this->Lang->home_num , $val['home_num']);
                    }
                    if(!empty($val['housing_num'])){
                        $valuesTable7[] = array( $this->Lang->housing_num , $val['housing_num']);
                    }
                    if(!empty($val['apt_num'])){
                        $valuesTable7[] = array( $this->Lang->apt_num , $val['apt_num']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->place_man);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $address_has = $this->_model->getManHasAddress($man['id']);
            if($address_has){
                foreach($address_has as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['country_ate'])){
                        $valuesTable7[] = array( $this->Lang->country_ate , $val['country_ate']);
                    }
                    if(!empty($val['region'])){
                        $valuesTable7[] = array( $this->Lang->region , $val['region']);
                    }
                    if(!empty($val['locality'])){
                        $valuesTable7[] = array( $this->Lang->locality , $val['locality']);
                    }
                    if(!empty($val['street'])){
                        $valuesTable7[] = array( $this->Lang->street , $val['street']);
                    }
                    if(!empty($val['track'])){
                        $valuesTable7[] = array( $this->Lang->track , $val['track']);
                    }
                    if(!empty($val['home_num'])){
                        $valuesTable7[] = array( $this->Lang->home_num , $val['home_num']);
                    }
                    if(!empty($val['housing_num'])){
                        $valuesTable7[] = array( $this->Lang->housing_num , $val['housing_num']);
                    }
                    if(!empty($val['apt_num'])){
                        $valuesTable7[] = array( $this->Lang->apt_num , $val['apt_num']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->address);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $phone = $this->_model->getManHasPhone($man['id']);
            if($phone){
                foreach($phone as $val)
                {
                    $valuesTable8 = array();
                    $valuesTable8[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable8[] = array( $this->Lang->phone_number , $val['number']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable8[] = array( $this->Lang->additional_data , $val['more_data']);
                    }
                    if(!empty($val['character_man'])){
                        $valuesTable8[] = array( $this->Lang->nature_character_man , $val['character_man']);
                    }
                    if(!empty($val['character_organization'])){
                        $valuesTable8[] = array( $this->Lang->nature_character_organization , $val['character_organization']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->telephone);
                    $docx->addBreak();
                    $docx->addTable($valuesTable8, $paramsTable);
                }
            }

            $work_activity_man = $this->_model->getManHasWorkActivity($man['id']);
            if($work_activity_man){
                foreach($work_activity_man as $val)
                {

                    $valuesTable = array();
                    $valuesTable[] = array( 'id' , $val['id']);
                    if(!empty($val['title'])){
                        $valuesTable[] = array( $this->Lang->position , $val['title']);
                    }
                    if(!empty($val['period'])){
                        $valuesTable[] = array( $this->Lang->data_refer_period , $val['period']);
                    }
                    if(!empty($val['start_date'])){
                        $valuesTable[] = array( $this->Lang->start_employment , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable[] = array( $this->Lang->end_employment , $val['end_date']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->work_activity_man);
                    $docx->addBreak();
                    $docx->addTable($valuesTable, $paramsTable);
                }
            }

            $work_activity_organization = $this->_model->getManHasWorkActivityOrganization($man['id']);
            if($work_activity_organization){
                foreach($work_activity_organization as $val)
                {

                    $valuesTable = array();
                    $valuesTable[] = array( 'id' , $val['id']);
                    if(!empty($val['title'])){
                        $valuesTable[] = array( $this->Lang->position , $val['title']);
                    }
                    if(!empty($val['period'])){
                        $valuesTable[] = array( $this->Lang->data_refer_period , $val['period']);
                    }
                    if(!empty($val['start_date'])){
                        $valuesTable[] = array( $this->Lang->start_employment , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable[] = array( $this->Lang->end_employment , $val['end_date']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->work_activity_organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable, $paramsTable);
                }
            }

            $man_bean_country = $this->_model->getManHasManBeanCountry($man['id']);
            if($man_bean_country){
                foreach($man_bean_country as $val)
                {
                    $valuesTable = array();
                    $valuesTable[] = array( 'id' , $val['id']);
                    if(!empty($val['goal'])){
                        $valuesTable[] = array( $this->Lang->purpose_visit , $val['goal']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable[] = array( $this->Lang->country_ate , $val['country_ate']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable[] = array( $this->Lang->entry_date , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable[] = array( $this->Lang->exit_date , $val['exit_date']);
                    }
                    if(!empty($val['region'])){
                        $valuesTable[] = array( $this->Lang->region , $val['region']);
                    }
                    if(!empty($val['locality'])){
                        $valuesTable[] = array( $this->Lang->locality , $val['locality']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->man_bean_country);
                    $docx->addBreak();
                    $docx->addTable($valuesTable, $paramsTable);
                }
            }

            $external_signs_sign = $this->_model->getManHasExternalSign($man['id']);
            if($external_signs_sign){
                foreach($external_signs_sign as $val)
                {
                    $valuesTable = array();
                    $valuesTable[] = array( 'id' , $val['id']);
                    if(!empty($val['man_id'])){
                        $valuesTable[] = array( $this->Lang->face , $val['man_id']);
                    }
                    if(!empty($val['name'])){
                        $valuesTable[] = array( $this->Lang->external_signs , $val['name']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->external_signs);
                    $docx->addBreak();
                    $docx->addTable($valuesTable, $paramsTable);
                }
            }
            $external_signs_photo = $this->_model->getManHasExternalSignPhoto($man['id']);
            if($external_signs_photo){
                $photos = array();
                foreach($external_signs_photo as $val)
                {
                    $valuesTable = array();
                    $valuesTable[] = array( 'id' , $val['id']);

                    if(!empty($val['man_id'])){
                        $valuesTable[] = array( $this->Lang->face , $val['man_id']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->external_signs_photo);
                    $docx->addBreak();
                    $val['image'] = base64_decode($val['image']);
                    $tmpName = md5(microtime());
                    file_put_contents(APP_PATH.'/temp/'.$tmpName.'.png',$val['image']);
                    $photos[] = APP_PATH.'/temp/'.$tmpName.'.png' ;

                    $opt = array(
                        'name'=> APP_PATH.'/temp/'.$tmpName.'.png'
                    );
                    $docx->addImage($opt);
                    $docx->addTable($valuesTable, $paramsTable);


                }
            }

            $organization_obj = $this->_model->getManHasObjectOrganization($man['id']);
            if($organization_obj){
                foreach($organization_obj as $val)
                {
                    $valuesTable2 = array();

                    if(!empty($val['relation_type'])){
                        $valuesTable2[] = array( $this->Lang->relation_type , $val['relation_type']);
                    }

                    $valuesTable2[] = array( 'id' , $val['id']);
                    if(!empty($val['name'])){
                        $valuesTable2[] = array( $this->Lang->name_organization , $val['name']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable2[] = array( $this->Lang->nation , $val['country']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable2[] = array( $this->Lang->date_formation , $val['reg_date']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable2[] = array( $this->Lang->region_activity , $val['country_ate']);
                    }
                    if(!empty($val['category'])){
                        $valuesTable2[] = array( $this->Lang->category_organization , $val['category']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable2[] = array( $this->Lang->security_organization_for_grid , $val['agency']);
                    }
                    if(!empty($val['employers_count'])){
                        $valuesTable2[] = array( $this->Lang->number_worker , $val['employers_count']);
                    }
                    if(!empty($val['attension'])){
                        $valuesTable2[] = array( $this->Lang->attention , $val['attension']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable2[] = array( $this->Lang->organization_dow , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->relationship_objects_organization);
                    $docx->addBreak();
                    $docx->addTable($valuesTable2, $paramsTable);
                }
            }

            $man_obj = $this->_model->getManHasObjectMan($man['id']);
            if($man_obj){
                foreach($man_obj as $val)
                {
                    $valuesTable4 = array();

                    if(!empty($val['relation_type'])){
                        $valuesTable4[] = array( $this->Lang->relation_type , $val['relation_type']);
                    }

                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable4[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable4[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable4[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable4[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable4[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable4[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable4[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable4[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable4[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable4[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable4[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable4[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable4[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable4[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable4[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable4[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable4[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable4[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable4[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable4[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->relationship_objects_man);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $action = $this->_model->getManHasAction($man['id']);
            if($action){
                foreach($action as $val)
                {
                    $valuesTable3 = array();
                    $valuesTable3[] = array( 'id' , $val['id']);
                    if(!empty($val['start_date'])){
                        $valuesTable3[] = array( $this->Lang->start_action_date , $val['start_date']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable3[] = array( $this->Lang->end_action_date , $val['end_date']);
                    }
                    if(!empty($val['material_content'])){
                        $valuesTable3[] = array( $this->Lang->content_materials_actions , $val['material_content']);
                    }
                    if(!empty($val['action_qualification'])){
                        $valuesTable3[] = array( $this->Lang->qualification_fact , $val['action_qualification']);
                    }
                    if(!empty($val['duration'])){
                        $valuesTable3[] = array( $this->Lang->duration_action , $val['duration']);
                    }
                    if(!empty($val['action_goal'])){
                        $valuesTable3[] = array( $this->Lang->purpose_motive_reason , $val['action_goal']);
                    }
                    if(!empty($val['terms'])){
                        $valuesTable3[] = array( $this->Lang->terms_actions , $val['terms']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable3[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable3[] = array( $this->Lang->source_information_actions , $val['source']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable3[] = array( $this->Lang->opened_dou , $val['opened_dou']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->action);
                    $docx->addBreak();
                    $docx->addTable($valuesTable3, $paramsTable);

                }
            }

            $event = $this->_model->getManHasEvent($man['id']);
            if($event){
                foreach($event as $val)
                {
                    $valuesTable5 = array();
                    $valuesTable5[] = array( 'id' , $val['id']);
                    if(!empty($val['qualification'])){
                        $valuesTable5[] = array( $this->Lang->qualification_event , $val['qualification']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable5[] = array( $this->Lang->date_security_date , $val['date']);
                    }
                    if(!empty($val['aftermath'])){
                        $valuesTable5[] = array( $this->Lang->ensuing_effects , $val['aftermath']);
                    }
                    if(!empty($val['result'])){
                        $valuesTable5[] = array( $this->Lang->results_event , $val['result']);
                    }
                    if(!empty($val['agency'])){
                        $valuesTable5[] = array( $this->Lang->investigation_requested , $val['agency']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable5[] = array( $this->Lang->source_event , $val['resource']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->event);
                    $docx->addBreak();
                    $docx->addTable($valuesTable5, $paramsTable);
                }
            }

              $signal_has = $this->_model->getManHasSignal($man['id']);
            if($signal_has){
                foreach($signal_has as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['reg_num'])){
                        $valuesTable4[] = array( $this->Lang->reg_number_signal , $val['reg_num']);
                    }
                    if(!empty($val['content'])){
                        $valuesTable4[] = array( $this->Lang->contents_information_signal , $val['content']);
                    }
                    if(!empty($val['check_line'])){
                        $valuesTable4[] = array( $this->Lang->line_which_verified , $val['check_line']);
                    }
                    if(!empty($val['check_status'])){
                        $valuesTable4[] = array( $this->Lang->check_status_charter , $val['check_status']);
                    }
                    if(!empty($val['signal_qualification'])){
                        $valuesTable4[] = array( $this->Lang->qualifications_signaling , $val['signal_qualification']);
                    }
                    if(!empty($val['check_agency'])){
                        $valuesTable4[] = array( $this->Lang->checks_signal , $val['check_agency']);
                    }
                    if(!empty($val['check_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_checking , $val['check_unit']);
                    }
                    if(!empty($val['check_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_testing , $val['check_subunit']);
                    }
                    if(!empty($val['subunit_date'])){
                        $valuesTable4[] = array( $this->Lang->date_registration_division , $val['subunit_date']);
                    }
                    if(!empty($val['check_date'])){
                        $valuesTable4[] = array( $this->Lang->check_date , $val['check_date']);
                    }
                    if(!empty($val['check_date_id'])){
                        $valuesTable4[] = array( $this->Lang->check_previously , $val['check_date_id']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable4[] = array( $this->Lang->date_actual_word , $val['end_date']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->according_result_dow , $val['opened_dou']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->useful_capabilities , $val['resource']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable4[] = array( $this->Lang->brought_signal , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_brought , $val['opened_unit']);
                    }
                    if(!empty($val['opened_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_brought , $val['opened_subunit']);
                    }
                    if(!empty($val['checking_worker'])){
                        $valuesTable4[] = array( $this->Lang->name_checking_signal , $val['checking_worker']);
                    }
                    if(!empty($val['checking_worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['checking_worker_post']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable4[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_category , $val['resource']);
                    }
                    if(!empty($val['signal_result'])){
                        $valuesTable4[] = array( $this->Lang->signal_results , $val['signal_result']);
                    }
                    if(!empty($val['taken_measure_id'])){
                        $valuesTable4[] = array( $this->Lang->measures_taken , $val['taken_measure_id']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->signal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $signal = $this->_model->getManSignal($man['id']);
            if($signal){
                foreach($signal as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['reg_num'])){
                        $valuesTable4[] = array( $this->Lang->reg_number_signal , $val['reg_num']);
                    }
                    if(!empty($val['content'])){
                        $valuesTable4[] = array( $this->Lang->contents_information_signal , $val['content']);
                    }
                    if(!empty($val['check_line'])){
                        $valuesTable4[] = array( $this->Lang->line_which_verified , $val['check_line']);
                    }
                    if(!empty($val['check_status'])){
                        $valuesTable4[] = array( $this->Lang->check_status_charter , $val['check_status']);
                    }
                    if(!empty($val['signal_qualification'])){
                        $valuesTable4[] = array( $this->Lang->qualifications_signaling , $val['signal_qualification']);
                    }
                    if(!empty($val['check_agency'])){
                        $valuesTable4[] = array( $this->Lang->checks_signal , $val['check_agency']);
                    }
                    if(!empty($val['check_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_checking , $val['check_unit']);
                    }
                    if(!empty($val['check_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_testing , $val['check_subunit']);
                    }
                    if(!empty($val['subunit_date'])){
                        $valuesTable4[] = array( $this->Lang->date_registration_division , $val['subunit_date']);
                    }
                    if(!empty($val['check_date'])){
                        $valuesTable4[] = array( $this->Lang->check_date , $val['check_date']);
                    }
                    if(!empty($val['check_date_id'])){
                        $valuesTable4[] = array( $this->Lang->check_previously , $val['check_date_id']);
                    }
                    if(!empty($val['end_date'])){
                        $valuesTable4[] = array( $this->Lang->date_actual_word , $val['end_date']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->according_result_dow , $val['opened_dou']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->useful_capabilities , $val['resource']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable4[] = array( $this->Lang->brought_signal , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable4[] = array( $this->Lang->department_brought , $val['opened_unit']);
                    }
                    if(!empty($val['opened_subunit'])){
                        $valuesTable4[] = array( $this->Lang->unit_brought , $val['opened_subunit']);
                    }
                    if(!empty($val['checking_worker'])){
                        $valuesTable4[] = array( $this->Lang->name_checking_signal , $val['checking_worker']);
                    }
                    if(!empty($val['checking_worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['checking_worker_post']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable4[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable4[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_category , $val['resource']);
                    }
                    if(!empty($val['signal_result'])){
                        $valuesTable4[] = array( $this->Lang->signal_results , $val['signal_result']);
                    }
                    if(!empty($val['taken_measure_id'])){
                        $valuesTable4[] = array( $this->Lang->measures_taken , $val['taken_measure_id']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->passes_signal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }

            $criminal_case = $this->_model->getManHasCriminalCase($man['id']);
            if($criminal_case){
                foreach($criminal_case as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['number'])){
                        $valuesTable7[] = array( $this->Lang->number_case , $val['number']);
                    }
                    if(!empty($val['opened_date'])){
                        $valuesTable7[] = array( $this->Lang->criminal_proceedings_date , $val['opened_date']);
                    }
                    if(!empty($val['artical'])){
                        $valuesTable7[] = array( $this->Lang->criminal_code , $val['artical']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable7[] = array( $this->Lang->initiated_dow , $val['opened_dou']);
                    }
                    if(!empty($val['character'])){
                        $valuesTable7[] = array( $this->Lang->nature_materials_paint , $val['character']);
                    }
                    if(!empty($val['worker'])){
                        $valuesTable7[] = array( $this->Lang->name_operatives , $val['worker']);
                    }
                    if(!empty($val['worker_post'])){
                        $valuesTable7[] = array( $this->Lang->worker_post , $val['worker_post']);
                    }
                    if(!empty($val['opened_agency'])){
                        $valuesTable7[] = array( $this->Lang->materials_management , $val['opened_agency']);
                    }
                    if(!empty($val['opened_unit'])){
                        $valuesTable7[] = array( $this->Lang->head_department , $val['opened_unit']);
                    }
                    if(!empty($val['subunit'])){
                        $valuesTable7[] = array( $this->Lang->instituted_units , $val['subunit']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->criminal);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }


            $mia_summary = $this->_model->getManHasMiaSummary($man['id']);
            if($mia_summary){
                foreach($mia_summary as $val)
                {
                    $valuesTable9 = array();
                    $valuesTable9[] = array( 'id' , $val['id']);
                    if(!empty($val['content'])){
                        $valuesTable9[] = array( $this->Lang->content_inf , $val['content']);
                    }
                    if(!empty($val['date'])){
                        $valuesTable9[] = array( $this->Lang->date_registration_reports , $val['date']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->mia_summary);
                    $docx->addBreak();
                    $docx->addTable($valuesTable9, $paramsTable);
                }
            }


            $car_has = $this->_model->getManHasCar($man['id']);
            if($car_has){
                foreach($car_has as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['car_category'])){
                        $valuesTable7[] = array( $this->Lang->car_cat , $val['car_category']);
                    }
                    if(!empty($val['car_mark'])){
                        $valuesTable7[] = array( $this->Lang->mark , $val['car_mark']);
                    }
                    if(!empty($val['car_color'])){
                        $valuesTable7[] = array( $this->Lang->color , $val['car_color']);
                    }
                    if(!empty($val['number'])){
                        $valuesTable7[] = array( $this->Lang->car_number , $val['number']);
                    }
                    if(!empty($val['count'])){
                        $valuesTable7[] = array( $this->Lang->count , $val['count']);
                    }
                    if(!empty($val['note'])){
                        $valuesTable7[] = array( $this->Lang->additional_data , $val['note']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->presence_machine);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

                    $car = $this->_model->getManCar($man['id']);
            if($car){
                foreach($car as $val)
                {
                    $valuesTable7 = array();
                    $valuesTable7[] = array( 'id' , $val['id']);
                    if(!empty($val['car_category'])){
                        $valuesTable7[] = array( $this->Lang->car_cat , $val['car_category']);
                    }
                    if(!empty($val['car_mark'])){
                        $valuesTable7[] = array( $this->Lang->mark , $val['car_mark']);
                    }
                    if(!empty($val['car_color'])){
                        $valuesTable7[] = array( $this->Lang->color , $val['car_color']);
                    }
                    if(!empty($val['number'])){
                        $valuesTable7[] = array( $this->Lang->car_number , $val['number']);
                    }
                    if(!empty($val['count'])){
                        $valuesTable7[] = array( $this->Lang->count , $val['count']);
                    }
                    if(!empty($val['note'])){
                        $valuesTable7[] = array( $this->Lang->additional_data , $val['note']);
                    }

                    $docx->addBreak();
                    $docx->addText($this->Lang->uses_machine);
                    $docx->addBreak();
                    $docx->addTable($valuesTable7, $paramsTable);
                }
            }

            $weapon = $this->_model->getManHasWeapon($man['id']);
            if($weapon){
                foreach($weapon as $val)
                {
                    $valuesTable9 = array();
                    $valuesTable9[] = array( 'id' , $val['id']);
                    if(!empty($val['category'])){
                        $valuesTable9[] = array( $this->Lang->category , $val['category']);
                    }
                    if(!empty($val['view'])){
                        $valuesTable9[] = array( $this->Lang->view , $val['view']);
                    }
                    if(!empty($val['type'])){
                        $valuesTable9[] = array( $this->Lang->type , $val['type']);
                    }
                    if(!empty($val['reg_num'])){
                        $valuesTable9[] = array( $this->Lang->account_number , $val['reg_num']);
                    }
                    if(!empty($val['model'])){
                        $valuesTable9[] = array( $this->Lang->mark , $val['model']);
                    }
                    if(!empty($val['count'])){
                        $valuesTable9[] = array( $this->Lang->count , $val['count']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->weapon);
                    $docx->addBreak();
                    $docx->addTable($valuesTable9, $paramsTable);
                }
            }

            $bibliography = $this->_model->getManHasBibliography($man['id']);
            if($bibliography){
                foreach($bibliography as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['user_name'])){
                        $valuesTable4[] = array( $this->Lang->worker_take_doc , $val['user_name']);
                    }
                    if(!empty($val['access_level'])){
                        $valuesTable4[] = array( $this->Lang->access_level , $val['access_level']);
                    }
                    if(!empty($val['source_agency_name'])){
                        $valuesTable4[] = array( $this->Lang->source_agency , $val['source_agency_name']);
                    }
                    if(!empty($val['from_agency_name'])){
                        $valuesTable4[] = array( $this->Lang->organ , $val['from_agency_name']);
                    }
                    if(!empty($val['source'])){
                        $valuesTable4[] = array( $this->Lang->source_inf , $val['source']);
                    }
                    if(!empty($val['short_desc'])){
                        $valuesTable4[] = array( $this->Lang->short_desc , $val['short_desc']);
                    }
                    if(!empty($val['related_year'])){
                        $valuesTable4[] = array( $this->Lang->related_year , $val['related_year']);
                    }
                    if(!empty($val['source_address'])){
                        $valuesTable4[] = array( $this->Lang->source_address , $val['source_address']);
                    }
                    if(!empty($val['worker_name'])){
                        $valuesTable4[] = array( $this->Lang->worker_name , $val['worker_name']);
                    }
                    if(!empty($val['reg_number'])){
                        $valuesTable4[] = array( $this->Lang->reg_number , $val['reg_number']);
                    }
                    if(!empty($val['reg_date'])){
                        $valuesTable4[] = array( $this->Lang->reg_date , $val['reg_date']);
                    }
                    if(!empty($val['created_at'])){
                        $valuesTable4[] = array( $this->Lang->date_and_time , $val['created_at']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->bibliography);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);

                }
            }

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);

            if(isset($photos)){
                foreach($photos as $val){
                    unlink($val);
                }
            }

            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }



    public function external_signs_with_joins($sign_id)
    {
        try {
            $sign = $this->_model->getExternalSigns($sign_id);
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();
            $this->_model->logging('print_joins','external_sign',$sign_id);

            $valuesTable = array();
            $valuesTable[] = array( 'id' , $sign['id']);
            if(!empty($sign['man_id'])){
                $valuesTable[] = array( $this->Lang->face , $sign['man_id']);
            }
            if(!empty($sign['name'])){
                $valuesTable[] = array( $this->Lang->external_signs , $sign['name']);
            }

            $paramsTable = array(
                'border' => 'single',
                'jc' => 'left',
                'tableWidth' => array(
                    'type' => 'dxa',
                    'value' => '7'
                ),
                'border_sz' => 10,
                'float' => array(
                    'textMargin_top' => 400
                )
            );
            $docx->addText($this->Lang->external_signs);
            $docx->addBreak();
            $docx->addTable($valuesTable, $paramsTable);

            $man = $this->_model->getExternalSignHasSignMan($sign['id']);
            if($man){

                foreach($man as $val)
                {
                    $valuesTable4 = array();
                    $valuesTable4[] = array( 'id' , $val['id']);
                    if(!empty($val['first_name'])){
                        $valuesTable4[] = array( $this->Lang->first_name , $val['first_name']);
                    }
                    if(!empty($val['last_name'])){
                        $valuesTable4[] = array( $this->Lang->last_name , $val['last_name']);
                    }
                    if(!empty($val['middle_name'])){
                        $valuesTable4[] = array( $this->Lang->middle_name , $val['middle_name']);
                    }
                    if(!empty($val['passport'])){
                        $valuesTable4[] = array( $this->Lang->passport_number , $val['passport']);
                    }
                    if(!empty($val['gender'])){
                        $valuesTable4[] = array( $this->Lang->gender , $val['gender']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['country']);
                    }
                    if(!empty($val['country_ate'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth , $val['country_ate']);
                    }
                    if(!empty($val['locality_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_settlement_local , $val['locality_id']);
                    }
                    if(!empty($val['region_id'])){
                        $valuesTable4[] = array( $this->Lang->place_of_birth_area_local , $val['region_id']);
                    }
                    if(!empty($val['education'])){
                        $valuesTable4[] = array( $this->Lang->education , $val['education']);
                    }
                    if(!empty($val['language'])){
                        $valuesTable4[] = array( $this->Lang->knowledge_of_languages , $val['language']);
                    }
                    if(!empty($val['party'])){
                        $valuesTable4[] = array( $this->Lang->party , $val['party']);
                    }
                    if(!empty($val['citizenship'])){
                        $valuesTable4[] = array( $this->Lang->citizenship , $val['citizenship']);
                    }
                    if(!empty($val['country'])){
                        $valuesTable4[] = array( $this->Lang->country_carrying_out_search , $val['country']);
                    }
                    if(!empty($val['nation'])){
                        $valuesTable4[] = array( $this->Lang->nationality , $val['nation']);
                    }
                    if(!empty($val['nickname'])){
                        $valuesTable4[] = array( $this->Lang->alias , $val['nickname']);
                    }
                    if(!empty($val['operation_category'])){
                        $valuesTable4[] = array( $this->Lang->operational_category_person , $val['operation_category']);
                    }
                    if(!empty($val['birthday'])){
                        $valuesTable4[] = array( $this->Lang->date_of_birth , $val['birthday']);
                    }
                    if(!empty($val['answer'])){
                        $valuesTable4[] = array( $this->Lang->answer , $val['answer']);
                    }
                    if(!empty($val['resource'])){
                        $valuesTable4[] = array( $this->Lang->source_information , $val['resource']);
                    }
                    if(!empty($val['approximate_year'])){
                        $valuesTable4[] = array( $this->Lang->approximate_year , $val['approximate_year']);
                    }
                    if(!empty($val['start_wanted'])){
                        $valuesTable4[] = array( $this->Lang->declared_wanted_list_with , $val['start_wanted']);
                    }
                    if(!empty($val['entry_date'])){
                        $valuesTable4[] = array( $this->Lang->home_monitoring_start , $val['entry_date']);
                    }
                    if(!empty($val['exit_date'])){
                        $valuesTable4[] = array( $this->Lang->end_monitoring_start , $val['exit_date']);
                    }
                    if(!empty($val['attention'])){
                        $valuesTable4[] = array( $this->Lang->attention , $val['attention']);
                    }
                    if(!empty($val['more_data'])){
                        $valuesTable4[] = array( $this->Lang->additional_information_person , $val['more_data']);
                    }
                    if(!empty($val['occupation'])){
                        $valuesTable4[] = array( $this->Lang->occupation , $val['occupation']);
                    }
                    if(!empty($val['opened_dou'])){
                        $valuesTable4[] = array( $this->Lang->face_opened , $val['opened_dou']);
                    }
                    $docx->addBreak();
                    $docx->addText($this->Lang->face);
                    $docx->addBreak();
                    $docx->addTable($valuesTable4, $paramsTable);
                }
            }


            $docx->createDocx(APP_PATH.'/webroot/files/word');
            $file = (APP_PATH.'/webroot/files/word.docx');
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function quarterly_report(){
        try{

            $data = explode('-',$_POST['start_date']);
            $year = $data[2];
            $month = $data[1];
            $day = $data[0];
            $_POST['start_date'] = $year.'-'.$month.'-'.$day;

            $data = explode('-',$_POST['end_date']);
            $year = $data[2];
            $month = $data[1];
            $day = $data[0];
            $_POST['end_date'] = $year.'-'.$month.'-'.$day;

            require_once 'Spreadsheet/Excel/Writer.php';
            $workbook = new Spreadsheet_Excel_Writer();
            $this->_model->logging('report','signal');

            $valuesTable[] = $this->_model->getAgencyParent();
            $qualifications = $this->_model->getQualifications($_POST);
            foreach($qualifications AS $val){
                $newValue = array();
                $newValue[] = $this->_model->getParentCount($_POST,'1',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'2',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'3',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'4',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'5',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'6',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'7',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'8',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'9',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'10',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'12',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'13',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'14',$val['signal_qualification_id']);
                $newValue[] = $this->_model->getParentCount($_POST,'15',$val['signal_qualification_id']);
                $newValue[] = $val['qualification'];
                $valuesTable[] = $newValue;
            }
            $workbook->send('excelTest.xls');
            $worksheet1 =& $workbook->addWorksheet('worksheet');
            $format_top1 =& $workbook->addFormat(array('size' => 5));
            $format_top1 -> setTextWrap();
            $format_top =& $workbook->addFormat(array('size' => 8, 'fontFamily' => 'Calibri', 'numformat' => '@', 'bold' => 1, 'left' => 1, 'top' => 1, 'bottom' => 1, 'right' => 1, 'vAlign' => 'vcenter', 'align' => 'center', 'fgcolor' => 1));
            $format_top->setColor('black');
            $format_top->setHAlign('center');
            $format_top->setBold(1);
            $format_top -> setTextWrap();


            $header =& $workbook->addFormat();
            $worksheet1->setInputEncoding('UTF-8');
            $workbook->setVersion(8);
            $worksheet1->setColumn(0,0,6);
            $worksheet1->setColumn(1,1,6);
            $worksheet1->setColumn(2,2,6);
            $worksheet1->setColumn(3,3,6);
            $worksheet1->setColumn(4,4,6);
            $worksheet1->setColumn(5,5,6);
            $worksheet1->setColumn(6,6,6);
            $worksheet1->setColumn(7,7,6);
            $worksheet1->setColumn(8,8,6);
            $worksheet1->setColumn(9,9,6);
            $worksheet1->setColumn(10,10,6);
            $worksheet1->setColumn(11,11,6);
            $worksheet1->setColumn(12,12,6);
            $worksheet1->setColumn(13,13,6);
            $worksheet1->setColumn(14,14,15);
            $worksheet1->setRow(0,30);

            $worksheet1->write(0, 0, $valuesTable[0][0]['value'],$format_top);
            $worksheet1->write(0, 1, $valuesTable[0][1]['value'], $format_top);
            $worksheet1->write(0, 2, $valuesTable[0][2]['value'], $format_top);
            $worksheet1->write(0, 3, $valuesTable[0][3]['value'], $format_top);
            $worksheet1->write(0, 4, $valuesTable[0][4]['value'], $format_top);
            $worksheet1->write(0, 5, $valuesTable[0][5]['value'], $format_top);
            $worksheet1->write(0, 6, $valuesTable[0][6]['value'], $format_top);
            $worksheet1->write(0, 7, $valuesTable[0][7]['value'], $format_top);
            $worksheet1->write(0, 8, $valuesTable[0][8]['value'], $format_top);
            $worksheet1->write(0, 9, $valuesTable[0][9]['value'], $format_top);
            $worksheet1->write(0, 10,$valuesTable[0][10]['value'], $format_top);
            $worksheet1->write(0, 11,$valuesTable[0][11]['value'], $format_top);
            $worksheet1->write(0, 12,$valuesTable[0][12]['value'], $format_top);
            $worksheet1->write(0, 13,$valuesTable[0][13]['value'], $format_top);
            $worksheet1->write(0, 14,$valuesTable[0][14]['value'], $format_top);
            unset($valuesTable[0]);
            foreach ($valuesTable as $key=>$value) {
                $i=0;
                $worksheet1->write($key, $i++,$value[0] , $header);
                $worksheet1->write($key, $i++,$value[1] , $header);
                $worksheet1->write($key, $i++,$value[2] , $header);
                $worksheet1->write($key, $i++,$value[3] , $header);
                $worksheet1->write($key, $i++,$value[4] , $header);
                $worksheet1->write($key, $i++,$value[5] , $header);
                $worksheet1->write($key, $i++,$value[6] , $header);
                $worksheet1->write($key, $i++,$value[7] , $header);
                $worksheet1->write($key, $i++,$value[8] , $header);
                $worksheet1->write($key, $i++,$value[9] , $header);
                $worksheet1->write($key, $i++,$value[10] , $header);
                $worksheet1->write($key, $i++,$value[11] , $header);
                $worksheet1->write($key, $i++,$value[12], $header);
                $worksheet1->write($key, $i++,$value[13] , $header);
                $worksheet1->write($key, $i++,$value[14] , $format_top1);
            }
            $workbook->close();

            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            exit;
        }catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_report()
    {
        try{
            $data = explode('-',$_POST['subunit_date']);
            $year = $data[2];
            $month = $data[1];
            $day = $data[0];
            $_POST['subunit_date'] = $year.'-'.$month.'-'.$day;

            $data = explode('-',$_POST['subunit_date_to']);
            $year = $data[2];
            $month = $data[1];
            $day = $data[0];
            $_POST['subunit_date_to'] = $year.'-'.$month.'-'.$day;
            $array =  $this->_model->signal_report($_POST);

            require_once 'Spreadsheet/Excel/Writer.php';
            $workbook = new Spreadsheet_Excel_Writer();
            $this->_model->logging('report','signal');

            /* Sending HTTP headers, this will popup a file save/open
            dialog in the browser when this file is run
            */
            $workbook->send('excel.xls');

            // Create 2 worksheets
            $worksheet1 =& $workbook->addWorksheet('worksheet');

            // Set header formating for Sheet 1
            $format_top1 =& $workbook->addFormat(array('size' => 9,'border'=>0,'bordercolor' => 'white',));
            $header =& $workbook->addFormat(array('right' => 5, 'top' => 5,'size' => 6,'bordercolor' => 'black','border'=>1 ));
            $header->setBold();	 // Make it bold
            $header->setColor('black');	// Make foreground color black
//            $header->setFgColor();	// Set background color to green
            $header->setHAlign('center');
            $header -> setTextWrap(0);

            $worksheet1->setColumn(0,0,3);
            $worksheet1->setColumn(1,1,10);
            $worksheet1->setColumn(2,2,9);
            $worksheet1->setColumn(3,3,4);
            $worksheet1->setColumn(4,4,5);
            $worksheet1->setColumn(5,5,10);
            $worksheet1->setColumn(6,6,7);
            $worksheet1->setColumn(7,7,10);
            $worksheet1->setColumn(8,8,10);
            $worksheet1->setColumn(9,9,8);
            $worksheet1->setColumn(10,10,7);
            $worksheet1->setColumn(11,11,4);
            $worksheet1->setColumn(12,12,7);
            $worksheet1->setColumn(13,13,13);
            $workbook->setVersion(8);
            $worksheet1->setInputEncoding('utf-8');
//            $worksheet1->setRow(3,22);
            $worksheet1->hideScreenGridlines();




            $title1 = "Сведения по  Сигналам,";
            $title2 = " находящихся в производстве ".$_POST['opened_agency']." ".$_POST['subunit_date']." по ".$_POST['subunit_date_to'];
            $worksheet1->write(0, 6, $title1, $format_top1);
            $worksheet1->write(1, 4, $title2, $format_top1);
            $worksheet1->write(3, 0, $this->Lang->signal_0, $header);
            $worksheet1->write(3, 1, $this->Lang->signal_1, $header);
            $worksheet1->write(3, 2, $this->Lang->signal_2, $header);
            $worksheet1->write(3, 3, $this->Lang->signal_3, $header);
            $worksheet1->write(3, 4, $this->Lang->signal_4, $header);
            $worksheet1->write(3, 5, $this->Lang->signal_5, $header);
            $worksheet1->write(3, 6, $this->Lang->signal_6, $header);
            $worksheet1->write(3, 7, $this->Lang->signal_7, $header);
            $worksheet1->write(3, 8, $this->Lang->signal_8, $header);
            $worksheet1->write(3, 9, $this->Lang->signal_9, $header);
            $worksheet1->write(3, 10, $this->Lang->signal_10, $header);
            $worksheet1->write(3, 11, $this->Lang->signal_11, $header);
            $worksheet1->write(3, 12, $this->Lang->signal_12, $header);
            $worksheet1->write(3, 13, $this->Lang->signal_13, $header);

            foreach ($array as $key=>$value) {
                $i=0;
//                $worksheet1->setRow($key+4,22);
                $date1 = $value['end_date'];
                $date2 = $value['subunit_date'];
                $date_to_unixtime1 = strtotime($date1) - strtotime($date2);
                $date_to_unixtime1 =$date_to_unixtime1/86400;

                $worksheet1->write($key+4, $i++,$key+1 , $header);
                $worksheet1->write($key+4, $i++,$value['check_subunit'] , $header);
                $worksheet1->write($key+4, $i++,$value['worker'] , $header);
                $worksheet1->write($key+4, $i++,$value['worker_post_name'] , $header);
                $worksheet1->write($key+4, $i++,$value['reg_num'] , $header);
                $worksheet1->write($key+4, $i++,$value['signal_qualification'] , $header);
                $worksheet1->write($key+4, $i++,$value['resource'] , $header);
                $worksheet1->write($key+4, $i++,$value['subunit_date'] , $header);
                $worksheet1->write($key+4, $i++,$value['check_date_m'] , $header);
                $worksheet1->write($key+4, $i++,$value['check_date'] , $header);
                $worksheet1->write($key+4, $i++,$value['end_date'] , $header);
                $worksheet1->write($key+4, $i++,$date_to_unixtime1 , $header);
                $worksheet1->write($key+4, $i++,$value['signal_result_name'] , $header);
                $worksheet1->write($key+4, $i++,$value['taken_measure_id'] , $header);
            }
            // Send the file to the browser
            $workbook->close();
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=signal_retport.xls" );
            exit;
        }catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }

    }


}