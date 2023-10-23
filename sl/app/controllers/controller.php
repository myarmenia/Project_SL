<?php

class Controller
{
    protected $_model;
    protected $_controller;
    protected $_action;
    protected $_view;
    protected $_modelBaseName;
    public $Lang;

    public function __construct($model, $action)
    {
        $this->_controller = ucwords(__CLASS__);
        $this->_action = $action;
        $this->_modelBaseName = $model;

        if(isset($_SESSION['counter'])){
            $_SESSION['counter'] = $_SESSION['counter']+1;
        }else{
            $_SESSION['counter'] = 1;
        }

        $this->_view = new View(APP_PATH . DS . 'views' . DS . strtolower($this->_modelBaseName) . DS . $action . '.tpl');
        if($_SERVER['REQUEST_URI'] != ROOT){
            if(!isset($_SESSION['userId'])){
                header('Location: '.ROOT.'');
                exit;
            }
        }
        if((strtolower($this->_modelBaseName) != 'dictionary') && !(strtolower($this->_modelBaseName) == 'open') && !(strtolower($this->_modelBaseName) == 'templatesearch')
            && !((strtolower($this->_modelBaseName) == 'admin') && !($this->_action == 'user_list')) ){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                foreach($_POST as $key1=>$val1){
                    if(is_array($val1)){
                        foreach($val1 as $key2=>$val2){
                            if(is_array($val2)){
                                foreach($val2 as $key3=>$val3){
                                    $val3 = str_replace(']','&#91;',$val3);
                                    $val3 = str_replace('[','&#93;',$val3);
                                    $val3 = str_replace('<','&lt;',$val3);
                                    $val3 = str_replace('>','&gt;',$val3);
                                    $val3 = str_replace('"','&quot;',$val3);
                                    $val3 = str_replace("'",'&#39;',$val3);
                                    $val3 = str_replace(')','&#41;',$val3);
                                    $val3 = str_replace('(','&#40;',$val3);
                                    $val3 = str_replace('{','&#123;',$val3);
                                    $val3 = str_replace('}','&#125;',$val3);
                                    $_POST[$key1][$key2][$key3] = $val3;
                                }
                            }else{
                                $val2 = str_replace(']','&#91;',$val2);
                                $val2 = str_replace('[','&#93;',$val2);
                                $val2 = str_replace('<','&lt;',$val2);
                                $val2 = str_replace('>','&gt;',$val2);
                                $val2 = str_replace('"','&quot;',$val2);
                                $val2 = str_replace("'",'&#39;',$val2);
                                $val2 = str_replace(')','&#41;',$val2);
                                $val2 = str_replace('(','&#40;',$val2);
                                $val2 = str_replace('{','&#123;',$val2);
                                $val2 = str_replace('}','&#125;',$val2);
                                $_POST[$key1][$key2] = $val2;
                            }
                        }
                    }else{
                        $val1 = str_replace(']','&#91;',$val1);
                        $val1 = str_replace('[','&#93;',$val1);
                        $val1 = str_replace('<','&lt;',$val1);
                        $val1 = str_replace('>','&gt;',$val1);
                        $val1 = str_replace('"','&quot;',$val1);
                        $val1 = str_replace("'",'&#39;',$val1);
                        $val1 = str_replace(')','&#41;',$val1);
                        $val1 = str_replace('(','&#40;',$val1);
                        $val1 = str_replace('{','&#123;',$val1);
                        $val1 = str_replace('}','&#125;',$val1);
                        $_POST[$key1] = $val1;
                    }
                }
            }
        }
        if(!(isset($_SESSION['lang']))){
            $_SESSION['lang'] = 'rus';
        }
        if($_SESSION['lang'] == 'rus'){
            $this->Lang = new Russian();
        }elseif($_SESSION['lang'] == 'eng'){
            $this->Lang = new English();
        }else{
            $this->Lang = new Armenian();
        }
    }

    protected function _setModel($modelName)
    {
        $modelName .= 'Model';
        $this->_model = new $modelName();
    }

    protected function _setView($viewName)
    {
        $this->_view = new View(APP_PATH . DS . 'views' . DS . strtolower($this->_modelBaseName) . DS . $viewName . '.tpl');
    }
}