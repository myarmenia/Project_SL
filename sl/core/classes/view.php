<?php
class View
{
    protected $_file;
    protected $_data = array();

    public function __construct($file)
    {
        $this->_file = $file;
    }

    public function set($key, $value)
    {
        $this->_data[$key] = $value;
    }

    public function get($key)
    {
        return $this->_data[$key];
    }

    public function output($layout = 'default')
    {
        if (!file_exists($this->_file))
        {
            throw new Exception("View " . $this->_file . " doesn't exist.");
        }

        if ($layout != 'default'){
            if(!file_exists(APP_PATH . DS . 'views' . DS . 'layout' . DS . $layout . '.tpl')){
                throw new Exception("Layout " . $layout . ".tpl doesn't exist.");
            }
        }

        if(!isset($_SESSION['lang'])){
            $_SESSION['lang'] = 'rus';
        }

        if($_SESSION['lang'] == 'rus'){
            $this->_data['Lang'] = new Russian();
        }elseif($_SESSION['lang'] == 'eng'){
            $this->_data['Lang'] = new English();
        }else{
            $this->_data['Lang'] = new Armenian();
        }

        if(isset($_SESSION['user_type'])){
            $this->_data['user_type'] = $_SESSION['user_type'];
        }else{
            $this->_data['user_type'] = 0;
        }


        extract($this->_data);
        ob_start();
        include($this->_file);
        $output = ob_get_contents();
        ob_end_clean();
        $this->_data['_fd'] = $output;

        extract($this->_data);
        ob_start();
        include(APP_PATH . DS . 'views' . DS . 'layout' . DS . $layout . '.tpl');
        $outputD = ob_get_contents();
        ob_end_clean();
        echo $outputD;
    }
}