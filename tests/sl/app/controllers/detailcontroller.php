<?php

class DetailController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function man($id)
    {
        try {
            $data = $this->_model->getMan($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function action($id)
    {
        try {
            $data = $this->_model->getAction($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function organization($id)
    {
        try {
            $data = $this->_model->getOrganization($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function event($id)
    {
        try {
            $data = $this->_model->getEvent($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function address($id)
    {
        try {
            $data = $this->_model->getAddress($id);

            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function car($id)
    {
        try {
            $data = $this->_model->getCar($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_beann_country($id)
    {
        try {
            $data = $this->_model->getManBeannCountry($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function phone($id)
    {
        try {
            if(isset($_GET['other'])){
                if($_GET['other'] == 'man'){
                    $data = $this->_model->getPhoneFromMan($id,$_GET['other_id']);
                }elseif($_GET['other'] == 'organization'){
                    $data = $this->_model->getPhoneFromOrganization($id,$_GET['other_id']);
                }
            }else{
                $data = $this->_model->getPhone($id);
            }
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function work_activity($id)
    {
        try {
            $data = $this->_model->getWorkActivity($id);
            $this->_view->set('data',$data);;
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function criminal_case($id)
    {
        try {
            $data = $this->_model->getCriminalCase($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function bibliography($id)
    {
        try {
            $data = $this->_model->getBibliography($id);
            $this->_view->set('data',$data);;
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function keep_signal($id)
    {
        try {
            $data = $this->_model->getKeepSignal($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function mia_summary($id)
    {
        try {
            $data = $this->_model->getMiaSummary($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function control($id)
    {
        try {
            $data = $this->_model->getControl($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal($id)
    {
        try {
            $data = $this->_model->getSignal($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function weapon($id)
    {
        try {
            $data = $this->_model->getWeapon($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function external_signs($id , $other = null )
    {
        try {
            if($other){
                $data['sign'] = $this->_model->getExternalSign($id);
            }else{
                $data = $this->_model->getExternalSigns($id);
            }
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function external_photo($id)
    {
        try {
            $data = $this->_model->getPhoto($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function object($id)
    {
        try {
            $data = $this->_model->getObject($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function email($id)
    {
        try {
            $data = $this->_model->getMail($id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_file($man_id)
    {
        try {
            $data = $this->_model->getManFiles($man_id);
            $this->_view->set('data',$data);
            return $this->_view->output('empty');
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
}