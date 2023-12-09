<?php

class PorcController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }


    public function index(){
        try {
            $this->_model->setValues();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index2(){
        try {
            $this->_model->setValues2();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index3(){
        try {
            $this->_model->setValues3();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index4(){
        try {
            $this->_model->setValues4();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index5(){
        try {
            $this->_model->setValues5();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index6(){
        try {
            $this->_model->setValues6();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index7(){
        try {
            $this->_model->setValues7();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index8(){
        try {
            $this->_model->setValues8();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index9(){
        try {
            $this->_model->setValues9();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index10(){
        try {
            $this->_model->setValues10();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index11(){
        try {
            $this->_model->setValues11();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index12(){
        try {
            $this->_model->setValues12();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index13(){
        try {
            $this->_model->setValues13();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function index14(){
        try {
            $this->_model->setValues14();
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function aaaa()
    {
        try {

            $data = $this->_model->agency();
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';

            $docx = new CreateDocx();

            $valuesTable = array();
            foreach($data as $val){
                $valuesTable[] = array( $val['id'] , $val['name']);
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
            $docx->addTable($valuesTable, $paramsTable);
            $docx->createDocx(APP_PATH.'/webroot/files/example10');

            $file = (APP_PATH.'/webroot/files/example10.docx');
//header ("Accept-Ranges: bytes");
//header ("Content-Length: ".filesize($file));
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=example10.docx" );
            readfile($file);
            exit;
//            echo 'No error';die;
            return $this->_view->output();
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



}