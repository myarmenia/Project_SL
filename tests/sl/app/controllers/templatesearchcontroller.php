<?php

class TemplatesearchController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function index()
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->template_search);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function started()
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->template_search.':'.$this->Lang->started);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function finished()
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->template_search.':'.$this->Lang->finished);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function active()
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->template_search.':'.$this->Lang->active);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result($type)
    {
        try {
            if($type == 'started'){
                $res = $this->_model->searchStarted($_POST);
                $this->_model->logging('search_template','agency',$_POST['opened_agency_id']);
            }elseif($type == 'finished'){
                $res = $this->_model->searchFinished($_POST);
                $this->_model->logging('search_template','agency',$_POST['opened_agency_id']);
            }elseif($type == 'active'){
                $res = $this->_model->searchActive($_POST);
                $this->_model->logging('search_template','agency',$_POST['opened_agency_id']);
            }
            $data = json_encode($res);
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            $this->_view->set('data',$data);
            $this->_view->set('navigationItem',$this->Lang->signal);
            $this->_view->set('type',$type);
            $this->_view->set('fromController',json_encode($_POST));
            return $this->_view->output();
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function file_search()
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->file_search);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_bibliography()
    {
//        try {
//            require_once( APP_PATH.'/classes/SolrPhpClient/Apache/Solr/Service.php' );

        //
        //
        // Try to connect to the named server, port, and url
        //
//            $for_solr = explode(':',SOLR_PORT);
//            $for_solr[1] = trim($for_solr[1],'/');
//            $solr = new Apache_Solr_Service( $for_solr[1] , $for_solr[2],'/solr' );
//
//            if ( ! $solr->ping() ) {
//                echo 'Solr service not responding.';
//                exit;
//            }
//            $offset = 0;
//            $limit = 100;
        $_POST['content'] = $this->escapeSolrValue(trim($_POST['content']));
        $q = "";
//        if (1 === strpos($_POST['content'], '~')) {
//            array_push($search, 'attr_content:' . $solr->phrase(substr($_POST['content'], 2, strlen($_POST['content']))) . '');
//        } else
        if (strpos($_POST['content'], '\+')) {
            $q .= '"' . (str_replace('\+', ' ', $_POST['content'])) . '"';
        }
        elseif (strpos($_POST['content'], " ") > 0) {
            $word = (explode(' ',$_POST['content']));
            $keys = array_keys($word);
            foreach ($word as $key => $value) {
                if (trim($value) != '') {
                    $value = trim($value);
                    $length = strlen($value);
                    $value = trim($value);
                    if ($length == 9 && intval($value) > 0) {
                        $phones = $this->format_phone($value);
                        $i = 0;
                        foreach ($phones as $phone) {
                            $q .= "\"" . $phone . "\"";
                            if (sizeof($phones)-1 != $i) {
                                $q .= "OR";
                            }
                            $i++;
                        }
                    } elseif ($length == 6 && intval($value) > 0) {
                        $phones = $this->format_phone_home($value);
                        $i = 0;
                        foreach ($phones as $phone) {
                            $q .= "\"" . $phone . "\"" ;
                            if (sizeof($phones)-1 != $i) {
                                $q .= "OR";
                            }
                            $i++;
                        }
                    } else {
                        $q .= "(" . str_replace('\*', '*', $value) . ")";
                    }
                }
                if ($key != end($keys)) {
                    $q .= "OR";
                }
            }
        } else {
            $q = $_POST['content'];
        }

        $url =  SOLR_URL . "select?indent=on&wt=json&fl=id&rows=10000&q=attr_content:" . urlencode($q);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result=curl_exec ($ch);
        curl_close ($ch);

        $result_json = json_decode($result, true);

        foreach ($result_json['response']['docs'] as $doc ) {
            $files[] = $doc['id'];
        }

        if (isset($_POST['params']) && $_POST['params'] != null) {
            $params = $_POST['params'] . '>' . $_POST['content'];
        } else {
            $params = $_POST['content'];
        }
        $file_ids = array();
        if (isset($_POST['file_ids']) && $_POST['file_ids'] != null) {
            $finded_files = explode('+', $_POST['file_ids']);
        }
        if(isset($finded_files) && isset($files)){
            $res = $this->_model->searchBibliographyInFinded($files, $finded_files);
            foreach ($res as $result) {
                array_push($file_ids, $result['file_id']);
            }
        } elseif(isset($files)){
            $res = $this->_model->searchBibliography($files);
            foreach ($res as $result) {
                array_push($file_ids, $result['file_id']);
            }
        } else{
            $res = false;
        }
        $this->_model->logging('file_search','bibliography');
        $data = json_encode($res);
        $data = str_replace('""' , '" "' , $data);
        $data = addslashes($data);
        $file_ids = implode('+', $file_ids);
        $this->_view->set('data',$data);
        $this->_view->set('params', $params);
        $this->_view->set('file_ids', $file_ids);
        $this->_view->set('navigationItem',$this->Lang->bibliography);
        return $this->_view->output();

//        } catch (Exception $e) {
//            echo "Application error:" . $e->getMessage();
//        }
    }

    function format_phone($phone)
    {
        $numbers = array();
        $phone = preg_replace("/[^0-9]/", "", $phone);

        if(strlen($phone) == 9) {
            array_push($numbers, preg_replace("/([0-9]{5})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{5})([0-9]{2})([0-9]{2})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1 $2/ $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1-$2/ $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1-$2/ $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1 $2/ $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "/$1/ $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "($1) $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "$1 $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{9})/", "$1", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1) $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1) $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1 $2) $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1-$2) $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1 $2) $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1-$2) $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "($1) $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "($1) $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "/$1/ $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "/$1/ $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1 $2) $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1 $2/ $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1 $2/ $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1-$2/ $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1-$2/ $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1-$2) $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1 $2) $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1-$2) $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "$1 $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "$1 $2 $3-$4", $phone));
        }

        return $numbers;
    }

    function format_phone_home($phone)
    {
        $numbers = array();
        $phone = preg_replace("/[^0-9]/", "", $phone);

        if(strlen($phone) == 6) {
            array_push($numbers, preg_replace("/([0-9]{6})/", "$1", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})/", "$1 $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})/", "$1-$2", $phone));
        }

        return $numbers;
    }

    public function report()
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->report_search.' '.$this->Lang->sgq);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_report()
    {
        try {
            $this->_view->set('navigationItem',$this->Lang->report_search_signal);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }

    }

    public function escapeSolrValue($string)
    {
        $match = array('\\', '+', '-', '&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '?', ':', '"', ';');
        $replace = array('\\\\', '\\+', '\\-', '\\&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\?', '\\:', '\\"', '\\;');
        $string = str_replace($match, $replace, $string);

        return $string;
    }

    public function backEscapedValues($string) {
        $match = array('\\', '+', '-', '&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '?', ':', '"', ';', '*');
        $replace = array('\\\\', '\\+', '\\-', '\\&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\?', '\\:', '\\"', '\\;', '\\*');
        $string = str_replace($replace, $match, $string);

        return $string;
    }

    public function escapePhrase($string) {
        $pattern = '/("|\\\)/';
        $replace = '\\\$1';

        return preg_replace($pattern, $replace, $string);
    }

    public function sort_report($type){
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                var_dump($_POST);die;
            }
            if($type == 'started'){
                $data = array();
                $data['opened_subunit_id']    = $this->Lang->report_1;
                $data['worker']               = $this->Lang->report_2;
                $data['worker_post']          = $this->Lang->report_3;
                $data['reg_num']              = $this->Lang->report_4;
                $data['signal_qualification'] = $this->Lang->report_5;
                $data['source_resource']      = $this->Lang->report_6;
                $data['subunit_date']         = $this->Lang->report_7;
            }elseif($type == 'finished' || $type == 'active_full'){
                $data['check_subunit']        = $this->Lang->report2_1;
                $data['checking_worker']      = $this->Lang->report2_2;
                $data['checking_worker_post'] = $this->Lang->report2_3;
                $data['reg_num']              = $this->Lang->report2_4;
                $data['signal_qualification'] = $this->Lang->report2_5;
                $data['source_resource']      = $this->Lang->report2_6;
                $data['subunit_date']         = $this->Lang->report2_7;
                $data['check_date_id']        = $this->Lang->report2_8;
                $data['check_date']           = $this->Lang->report2_9;
                $data['end_date']             = $this->Lang->report2_10;
                $data['count_days']           = $this->Lang->report2_11;
                $data['result']               = $this->Lang->report2_12;
                $data['taken_measure']        = $this->Lang->report2_13;
            }elseif($type == 'active_short'){
                $data['check_subunit']        = $this->Lang->report2_1;
                $data['checking_worker']      = $this->Lang->report2_2;
                $data['checking_worker_post'] = $this->Lang->report2_3;
                $data['reg_num']              = $this->Lang->report2_4;
                $data['signal_qualification'] = $this->Lang->report2_5;
                $data['source_resource']      = $this->Lang->report2_6;
                $data['subunit_date']         = $this->Lang->report2_7;
                $data['check_date_id']        = $this->Lang->report2_8;
                $data['check_date']           = $this->Lang->report2_9;
            }

            $this->_view->set('data',$data);
            return $this->_view->output('login');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function report_active($lang){
        try {
            $sort = json_decode($_POST['forSort'],true);
            $grid = json_decode($_POST['fromGrid'],true);
            $fromController = json_decode($_POST['fromController'],true);
            $agency = '______________________';
            $dFrom = '____________';
            $dTo = '____________';
            if(strlen(trim($fromController['subunit_date'])) != 0 ){
                $dFrom = $fromController['subunit_date'];
            }
            if(isset($fromController['subunit_date_to'])){
                if(strlen(trim($fromController['subunit_date_to'])) != 0 ){
                    $dTo = $fromController['subunit_date_to'];
                }
            }
            if(strlen(trim($fromController['opened_agency'])) != 0 ){
                $agency = $fromController['opened_agency'];
            }
            $data = $this->_model->getFinishedForReport($grid,$sort);
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=report.doc");
            $cont = '<html>
                        <head>
                        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
                        <meta name=ProgId content=Word.Document>
                        <meta name=Generator content="Microsoft Word 9">
                        <meta name=Originator content="Microsoft Word 9">
                        <title>Report</title>
                        <style>
                        @page Section2 {size:11.69in 8.27in ;mso-page-orientation:landscape;margin:0.2in 0.3in 0.2in 0.3in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
                        div.Section2 {page:Section2;}
                        table {
                            width: 100%; /* Ширина таблицы */
                            border: 4px double black; /* Рамка вокруг таблицы */
                            border-collapse: collapse; /* Отображать только одинарные линии */
                            font-family: arial;
                           }
                           th {
                            text-align: left; /* Выравнивание по левому краю */
                            background: #ccc; /* Цвет фона ячеек */
                            padding: 5px; /* Поля вокруг содержимого ячеек */
                            border: 1px solid black; /* Граница вокруг ячеек */
                           }
                           td {
                            padding: 5px; /* Поля вокруг содержимого ячеек */
                            border: 1px solid black; /* Граница вокруг ячеек */
                            text-align: center;
                           }
                           body{
                            font-family: arial;
                           }
                        </style>
                        </head>
                    <body>
                    <div class=Section2>';
            if($lang == 'rus'){
                $cont .= '<div style="width:100%;font-size: 7pt;text-align: right;">
                                <p style="right: 100px;position: relative;margin:0in 0.5in 0in 0in;">
                                    Экз.№ 1 <br>
                                    Приложение № _
                                </p>
                          </div>';
                $cont .='<div style="width:100%;font-size: 10pt;text-align: center;">
                            <p>
                                                    Сведения по сигналам,<br>
                                находящихся в производстве '.$agency.' за период с '.$dFrom.'г. по '.$dTo.'г.
                            </p>
                         </div>';
                $report2_1  = 'Подразделение, проверяющее СГ';
                $report2_2  = 'Оперработник, проверяющ. СГ';
                $report2_3  = 'долж- ность';
                $report2_4  = 'Рег. №';
                $report2_5  = 'Окраска сигнала';
                $report2_6  = 'Категории источн. инф.';
                $report2_7  = 'Дата заведен.';
                $report2_8  = 'Налич. продл.';
                $report2_9  = 'Срок проверки';
                $report2_10 = 'Дата закрыт.';
                $report2_11 = 'Пр. дни';
                $report2_12 = 'Результаты проверки';
                $report2_13 = 'Принятые меры';

            }else{
                $cont .= '<div style="width:100%;font-size: 7pt;text-align: right;">
                                <p style="right: 100px;position: relative;margin:0in 0.5in 0in 0in;">
                                    Օր. № 1 <br>
                                    Հավելված №__
                                </p>
                          </div>';
                $cont .='<div style="width:100%;font-size: 10pt;text-align: center;">
                            <p>
                                                    Տեղեկատվություն<br>
                                ՀՀ ԱԱԾ '.$agency.' կողմից '.$dFrom.' '.$dTo.' վարույթում գտնվող ահազանգերի մասին
                            </p>
                         </div>';
                $report2_1  = 'Ահազանգը ստուգող ստորաբաժանում';
                $report2_2  = 'Ահազանգը ստուգող օ/ա';
                $report2_3  = 'Օ/ա պաշ­ տոնը';
                $report2_4  = 'Գրան­ցման №';
                $report2_5  = 'Ահազանգի երանգավորում';
                $report2_6  = 'Տեղեկա­ տվության աղբյուր';
                $report2_7  = 'Գրանցման ժամկետ';
                $report2_8  = 'Երկարա­ ցումներ';
                $report2_9  = 'Ստուգման ժամկետ';
                $report2_10 = 'Փակման ժամկետ';
                $report2_11 = 'ժմ.անց';
                $report2_12 = 'Ստուգման արդյունք­ ները';
                $report2_13 = 'Կիրառված միջոցներ';
            }
            $cont .= '<table>
                            <tr style="font-size: 7pt;font-weight: bold;">
                                <td>
                                    №
                                </td>
                                <td>
                                    '.$report2_1.'
                                </td>
                                <td>
                                    '.$report2_2.'
                                </td>
                                <td>
                                    '.$report2_3.'
                                </td>
                                <td>
                                    '.$report2_4.'
                                </td>
                                <td>
                                    '.$report2_5.'
                                </td>
                                <td>
                                    '.$report2_6.'
                                </td>
                                <td>
                                    '.$report2_7.'
                                </td>
                                <td>
                                    '.$report2_8.'
                                </td>
                                <td>
                                    '.$report2_9.'
                                </td>';
            if($_POST['reportType'] == 'full'){
                $cont .='<td>
                            '.$report2_10.'
                        </td>
                        <td>
                            '.$report2_11.'
                        </td>
                        <td>
                            '.$report2_12.'
                        </td>
                        <td>
                            '.$report2_13.'
                        </td>
                    </tr>
                  ';
            }else{
                $cont .= '</tr>';
            }
            foreach($data as $key=>$val){
                $sq = explode('-',$val['signal_qualification'],2);
                $val['signal_qualification'] = $sq[1];
                $cont .= ' <tr style="font-size: 8pt;font-weight: normal;">
                            <td>
                                '.($key+1).'
                            </td>
                            <td>
                                '.$val['check_subunit'].'
                            </td>
                            <td>
                                 '.$val['checking_worker'].'
                            </td>
                            <td>
                                '.$val['checking_worker_post'].'
                            </td>
                            <td>
                                '.$val['reg_num'].'
                            </td>
                            <td>
                                 '.$val['signal_qualification'].'
                            </td>
                            <td>
                                '.$val['source_resource'].'
                            </td>
                            <td>
                                '.$val['subunit_date'].'
                            </td>
                             <td>
                                '.$val['check_date_id'].'
                            </td>
                             <td>
                                '.$val['check_date'].'
                            </td>';
                if($_POST['reportType'] == 'full'){
                    if($val['count_days']<=0){
                        $val['count_days'] = ' ';
                    }
                    $cont .= '<td>
                            '.$val['end_date'].'
                        </td>
                         <td>
                            '.$val['count_days'].'
                        </td>
                         <td>
                            '.$val['result'].'
                        </td>
                         <td>
                            '.$val['taken_measure'].'
                        </td>
                    </tr>';
                }
            }
            $cont .='</table></div>
                    </body>
                    </html>';
            echo $cont;
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function report_finished($lang){
        try {
            $sort = json_decode($_POST['forSort'],true);
            $grid = json_decode($_POST['fromGrid'],true);
            $fromController = json_decode($_POST['fromController'],true);
            $agency = '______________________';
            $dFrom = '____________';
            $dTo = '____________';
            if(strlen(trim($fromController['subunit_date'])) != 0 ){
                $dFrom = $fromController['subunit_date'];
            }
            if(isset($fromController['subunit_date_to'])){
                if(strlen(trim($fromController['subunit_date_to'])) != 0 ){
                    $dTo = $fromController['subunit_date_to'];
                }
            }
            if(strlen(trim($fromController['opened_agency'])) != 0 ){
                $agency = $fromController['opened_agency'];
            }
            $data = $this->_model->getFinishedForReport($grid,$sort);
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=report.doc");
            $cont = '<html>
                        <head>
                        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
                        <meta name=ProgId content=Word.Document>
                        <meta name=Generator content="Microsoft Word 9">
                        <meta name=Originator content="Microsoft Word 9">
                        <title>Report</title>
                        <style>
                        @page Section2 {size:11.69in 8.27in ;mso-page-orientation:landscape;margin:0.2in 0.3in 0.2in 0.3in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
                        div.Section2 {page:Section2;}
                        table {
                            width: 100%; /* Ширина таблицы */
                            border: 4px double black; /* Рамка вокруг таблицы */
                            border-collapse: collapse; /* Отображать только одинарные линии */
                            font-family: arial;
                           }
                           th {
                            text-align: left; /* Выравнивание по левому краю */
                            background: #ccc; /* Цвет фона ячеек */
                            padding: 5px; /* Поля вокруг содержимого ячеек */
                            border: 1px solid black; /* Граница вокруг ячеек */
                           }
                           td {
                            padding: 5px; /* Поля вокруг содержимого ячеек */
                            border: 1px solid black; /* Граница вокруг ячеек */
                            text-align: center;
                           }
                           body{
                            font-family: arial;
                           }
                        </style>
                        </head>
                    <body>
                    <div class=Section2>';
            if($lang == 'rus'){
                $cont .= '<div style="width:100%;font-size: 7pt;text-align: right;">
                                <p style="right: 100px;position: relative;margin:0in 0.5in 0in 0in;">
                                    Экз.№ 1 <br>
                                    Приложение № _
                                </p>
                          </div>';
                $cont .='<div style="width:100%;font-size: 10pt;text-align: center;">
                            <p>
                                                    Сведения по сигналам,<br>
                                прекращенным '.$agency.' за период с '.$dFrom.'г. по '.$dTo.'г.
                            </p>
                         </div>';
                $report2_1  = 'Подразделение, проверяющее СГ';
                $report2_2  = 'Оперработник, проверяющ. СГ';
                $report2_3  = 'долж- ность';
                $report2_4  = 'Рег. №';
                $report2_5  = 'Окраска сигнала';
                $report2_6  = 'Категории источн. инф.';
                $report2_7  = 'Дата заведен.';
                $report2_8  = 'Налич. продл.';
                $report2_9  = 'Срок проверки';
                $report2_10 = 'Дата закрыт.';
                $report2_11 = 'Пр. дни';
                $report2_12 = 'Результаты проверки';
                $report2_13 = 'Принятые меры';

            }else{
                $cont .= '<div style="width:100%;font-size: 7pt;text-align: right;">
                                <p style="right: 100px;position: relative;margin:0in 0.5in 0in 0in;">
                                    Օր. № 1 <br>
                                    Հավելված №__
                                </p>
                          </div>';
                $cont .='<div style="width:100%;font-size: 10pt;text-align: center;">
                            <p>
                                                    Տեղեկատվություն<br>
                                ՀՀ ԱԱԾ '.$agency.' կողմից '.$dFrom.' '.$dTo.' վարույթով դադարեցված ահազանգերի մասին
                            </p>
                         </div>';
                $report2_1  = 'Ահազանգը ստուգող ստորաբաժանում';
                $report2_2  = 'Ահազանգը ստուգող օ/ա';
                $report2_3  = 'Օ/ա պաշ­ տոնը';
                $report2_4  = 'Գրան­ցման №';
                $report2_5  = 'Ահազանգի երանգավորում';
                $report2_6  = 'Տեղեկա­ տվության աղբյուր';
                $report2_7  = 'Գրանցման ժամկետ';
                $report2_8  = 'Երկարա­ ցումներ';
                $report2_9  = 'Ստուգման ժամկետ';
                $report2_10 = 'Փակման ժամկետ';
                $report2_11 = 'ժմ.անց';
                $report2_12 = 'Ստուգման արդյունք­ ները';
                $report2_13 = 'Կիրառված միջոցներ';
            }
            $cont .= '<table>
                            <tr style="font-size: 7pt;font-weight: bold;">
                                <td>
                                    №
                                </td>
                                <td>
                                    '.$report2_1.'
                                </td>
                                <td>
                                    '.$report2_2.'
                                </td>
                                <td>
                                    '.$report2_3.'
                                </td>
                                <td>
                                    '.$report2_4.'
                                </td>
                                <td>
                                    '.$report2_5.'
                                </td>
                                <td>
                                    '.$report2_6.'
                                </td>
                                <td>
                                    '.$report2_7.'
                                </td>
                                <td>
                                    '.$report2_8.'
                                </td>
                                <td>
                                    '.$report2_9.'
                                </td>
                                <td>
                                    '.$report2_10.'
                                </td>
                                <td>
                                    '.$report2_11.'
                                </td>
                                <td>
                                    '.$report2_12.'
                                </td>
                                <td>
                                    '.$report2_13.'
                                </td>
                            </tr>
                          ';
            foreach($data as $key=>$val){
                if($val['count_days']<=0){
                    $val['count_days'] = ' ';
                }
                $sq = explode('-',$val['signal_qualification'],2);
                $val['signal_qualification'] = $sq[1];
                $cont .= ' <tr style="font-size: 8pt;font-weight: normal;">
                            <td>
                                '.($key+1).'
                            </td>
                            <td>
                                '.$val['check_subunit'].'
                            </td>
                            <td>
                                 '.$val['checking_worker'].'
                            </td>
                            <td>
                                '.$val['checking_worker_post'].'
                            </td>
                            <td>
                                '.$val['reg_num'].'
                            </td>
                            <td>
                                 '.$val['signal_qualification'].'
                            </td>
                            <td>
                                '.$val['source_resource'].'
                            </td>
                            <td>
                                '.$val['subunit_date'].'
                            </td>
                             <td>
                                '.$val['check_date_id'].'
                            </td>
                             <td>
                                '.$val['check_date'].'
                            </td>
                             <td>
                                '.$val['end_date'].'
                            </td>
                             <td>
                                '.$val['count_days'].'
                            </td>
                             <td>
                                '.$val['result'].'
                            </td>
                             <td>
                                '.$val['taken_measure'].'
                            </td>
                        </tr>';
            }
            $cont .='</table></div>
                    </body>
                    </html>';
            echo $cont;
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function report_started($lang){
        try {
            $sort = json_decode($_POST['forSort'],true);
            $grid = json_decode($_POST['fromGrid'],true);
            $fromController = json_decode($_POST['fromController'],true);
            $agency = '______________________';
            $dFrom = '____________';
            $dTo = '____________';
            if(strlen(trim($fromController['subunit_date'])) != 0 ){
                $dFrom = $fromController['subunit_date'];
            }
            if(isset($fromController['subunit_date_to'])){
                if(strlen(trim($fromController['subunit_date_to'])) != 0 ){
                    $dTo = $fromController['subunit_date_to'];
                }
            }
            if(strlen(trim($fromController['opened_agency'])) != 0 ){
                $agency = $fromController['opened_agency'];
            }
            $data = $this->_model->getStartedForReport($grid,$sort);
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=report.doc");
            $cont = '<html>
                        <head>
                        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
                        <meta name=ProgId content=Word.Document>
                        <meta name=Generator content="Microsoft Word 9">
                        <meta name=Originator content="Microsoft Word 9">
                        <title>Report</title>
                        <style>
                        @page Section2 {size:11.69in 8.27in ;mso-page-orientation:landscape;margin:0.2in 0.3in 0.2in 0.3in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
                        div.Section2 {page:Section2;}
                        table {
                            width: 100%; /* Ширина таблицы */
                            border: 4px double black; /* Рамка вокруг таблицы */
                            border-collapse: collapse; /* Отображать только одинарные линии */
                            font-family: arial;
                           }
                           th {
                            text-align: left; /* Выравнивание по левому краю */
                            background: #ccc; /* Цвет фона ячеек */
                            padding: 5px; /* Поля вокруг содержимого ячеек */
                            border: 1px solid black; /* Граница вокруг ячеек */
                           }
                           td {
                            padding: 5px; /* Поля вокруг содержимого ячеек */
                            border: 1px solid black; /* Граница вокруг ячеек */
                            text-align: center;
                           }
                           body{
                            font-family: arial;
                           }
                        </style>
                        </head>
                    <body>
                    <div class=Section2>';
            if($lang == 'rus'){
                $cont .= '<div style="width:100%;font-size: 7pt;text-align: right;">
                                <p style="right: 100px;position: relative;margin:0in 0.5in 0in 0in;">
                                    Экз.№ 1 <br>
                                    Приложение № _
                                </p>
                          </div>';
                $cont .='<div style="width:100%;font-size: 10pt;text-align: center;">
                            <p>
                                                    Сведения по сигналам,<br>
                                заведенным '.$agency.' за период с '.$dFrom.'г. по '.$dTo.'г.
                            </p>
                         </div>';
                $report_1 = 'Подразделение, которое завело сигнал';
                $report_2 = 'Фамилия оперработника';
                $report_3 = 'должность оперработника';
                $report_4 = 'Рег. №';
                $report_5 = 'Окраска сигнала';
                $report_6 = 'Категории источн. инф.';
                $report_7 = 'Дата заведен.';

            }else{
                $cont .= '<div style="width:100%;font-size: 7pt;text-align: right;">
                                <p style="right: 100px;position: relative;margin:0in 0.5in 0in 0in;">
                                    Օր. № 1 <br>
                                    Հավելված №__
                                </p>
                          </div>';
                $cont .='<div style="width:100%;font-size: 10pt;text-align: center;">
                            <p>
                                                    Տեղեկատվություն<br>
                                ՀՀ ԱԱԾ '.$agency.' կողմից '.$dFrom.' '.$dTo.' գրանցված ահազանգերի մասին
                            </p>
                         </div>';
                $report_1 = 'Ահազանգը գրանցած ստորաբաժանում';
                $report_2 = 'Օպերաշխատակցի ազգանունը';
                $report_3 = 'Օ/ա պաշտոնը';
                $report_4 = 'Գրանցման №';
                $report_5 = 'Ահազանգի երանգավորում';
                $report_6 = 'Տեղեկատվության աղբյուր';
                $report_7 = 'Գրանցման ժամկետ';
            }
            $cont .= '<table>
                            <tr style="font-size: 7pt;font-weight: bold;">
                                <td>
                                    №
                                </td>
                                <td>
                                    '.$report_1.'
                                </td>
                                <td>
                                    '.$report_2.'
                                </td>
                                <td>
                                    '.$report_3.'
                                </td>
                                <td>
                                    '.$report_4.'
                                </td>
                                <td>
                                    '.$report_5.'
                                </td>
                                <td>
                                    '.$report_6.'
                                </td>
                                <td>
                                    '.$report_7.'
                                </td>
                            </tr>
                          ';
            foreach($data as $key=>$val){
                $sq = explode('-',$val['signal_qualification'],2);
                $val['signal_qualification'] = $sq[1];
                $cont .= ' <tr style="font-size: 8pt;font-weight: normal;">
                            <td>
                                '.($key+1).'
                            </td>
                            <td>
                                '.$val['opened_subunit_id'].'
                            </td>
                            <td>
                                 '.$val['worker'].'
                            </td>
                            <td>
                                '.$val['worker_post'].'
                            </td>
                            <td>
                                '.$val['reg_num'].'
                            </td>
                            <td>
                                 '.$val['signal_qualification'].'
                            </td>
                            <td>
                                '.$val['source_resource'].'
                            </td>
                            <td>
                                '.$val['subunit_date'].'
                            </td>
                        </tr>';
            }
            $cont .='</table></div>
                    </body>
                    </html>';
            echo $cont;
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function quarterly_report()
    {
        try {
            $data = $this->_model->report($_POST);
            ini_set('display_errors',0);
            require APP_PATH . DS . 'classes/PHPExcel.php';
            require APP_PATH . DS . 'classes/PHPExcel/IOFactory.php';
            require APP_PATH . DS . 'classes/PHPExcel/ReferenceHelper.php';

// Read the file
            $fileType = 'Excel5';
            $objReader = PHPExcel_IOFactory::createReader($fileType);
            $objPHPExcel = $objReader->load( APP_PATH.'/webroot/files/ot.xls' );


// Set document properties
            $objPHPExcel->getProperties()->setCreator("SNS")
                ->setLastModifiedBy("SNS")
                ->setTitle("Office 2007 XLS Report")
                ->setSubject("Office 2007 XLS Report")
                ->setDescription("Report")
                ->setKeywords("Report")
                ->setCategory("Report");
            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            if($_POST['type'] == 'y'){
                $text = "";
            }elseif($_POST['type'] == '1_q'){
                $text = " 1 եռամսյակում";
            }elseif($_POST['type'] == '2_q'){
                $text = " 2 եռամսյակում";
            }elseif($_POST['type'] == '3_q'){
                $text = " 3 եռամսյակում";
            }elseif($_POST['type'] == '4_q'){
                $text = " 4 եռամսյակում";
            }elseif($_POST['type'] == '1_h'){
                $text = " I կիսամյակում";
            }elseif($_POST['type'] == '2_h'){
                $text = " II կիսամյակում";
            }
            $objWorksheet->getHeaderFooter()->setOddHeader("&C& Տեղեկատվություն \n {$_POST['year']} թ. $text  ՀՀ ԱԱԾ մարմինների կողմից գրանցված ահազանգների երանգավորումների մասին &R& Հավելված N 6 \n Օր. N  1");
            if($data){
                $width = (125/count($data));
                $first = $data[0];
                unset($data[0]);
                for($i=1;$i<=15;$i++){
                    $sum[$i] = 0;
                }
                $q = explode('-',$first['signal_qualification'],2);
                $objWorksheet->setCellValue('G2', $q[1]);
                $objWorksheet->setCellValue('G4', $q[0]);
                $objWorksheet->setCellValue('G5', $first['agency'][15]);$sum[1]+=$first['agency'][15];
                $objWorksheet->setCellValue('G6', $first['agency'][14]);$sum[2]+=$first['agency'][14];
                $objWorksheet->setCellValue('G7', $first['agency'][13]);$sum[3]+=$first['agency'][13];
                $objWorksheet->setCellValue('G8', $first['agency'][12]);$sum[4]+=$first['agency'][12];
                $objWorksheet->setCellValue('G9', $first['agency'][1]); $sum[5]+=$first['agency'][1];
                $objWorksheet->setCellValue('G10', $first['agency'][2]);$sum[6]+=$first['agency'][2];
                $objWorksheet->setCellValue('G11', $first['agency'][3]);$sum[7]+=$first['agency'][3];
                $objWorksheet->setCellValue('G12', $first['agency'][4]);$sum[8]+=$first['agency'][4];
                $objWorksheet->setCellValue('G13', $first['agency'][5]);$sum[9]+=$first['agency'][5];
                $objWorksheet->setCellValue('G14', $first['agency'][6]);$sum[10]+=$first['agency'][6];
                $objWorksheet->setCellValue('G15', $first['agency'][7]);$sum[11]+=$first['agency'][7];
                $objWorksheet->setCellValue('G16', $first['agency'][8]);$sum[12]+=$first['agency'][8];
                $objWorksheet->setCellValue('G17', $first['agency'][9]);$sum[13]+=$first['agency'][9];
                $objWorksheet->setCellValue('G18', $first['agency'][10]);$sum[14]+=$first['agency'][10];
                $objWorksheet->setCellValue('G19', array_sum($first['agency']));$sum[15]+=array_sum($first['agency']);
                $objWorksheet->getColumnDimension('G')->setWidth($width);
                PHPExcel_ReferenceHelper::getInstance()->insertNewBefore('G1',count($data), 0, $objWorksheet);
                $ts = range('F','Z');
                $ts2 = range('A','Z');
                $c = count($ts);
                foreach($ts2 as $k=>$v){
                    $ts[$c+$k] = 'A'.$v;
                }
                $c = count($ts);
                foreach($ts2 as $k=>$v){
                    $ts[$c+$k] = 'B'.$v;
                }
                if($data){
                    foreach($data as $k=>$v){
                        $objWorksheet->duplicateStyle($objWorksheet->getStyle($ts[(count($data)+1)].'19'), $ts[$k].'19');
                        $objWorksheet->mergeCells($ts[$k].'2:'.$ts[$k].'3');
                        $objWorksheet->getColumnDimension($ts[$k])->setWidth($width);
                        $q = explode('-',$v['signal_qualification'],2);
                        $objWorksheet->setCellValue($ts[$k].'2', $q[1]);
                        $objWorksheet->setCellValue($ts[$k].'4', $q[0]);
                        $objWorksheet->setCellValue($ts[$k].'5', $v['agency'][15]);$sum[1]+=$v['agency'][15];
                        $objWorksheet->setCellValue($ts[$k].'6', $v['agency'][14]);$sum[2]+=$v['agency'][14];
                        $objWorksheet->setCellValue($ts[$k].'7', $v['agency'][13]);$sum[3]+=$v['agency'][13];
                        $objWorksheet->setCellValue($ts[$k].'8', $v['agency'][12]);$sum[4]+=$v['agency'][12];
                        $objWorksheet->setCellValue($ts[$k].'9', $v['agency'][1]); $sum[5]+=$v['agency'][1];
                        $objWorksheet->setCellValue($ts[$k].'10', $v['agency'][2]);$sum[6]+=$v['agency'][2];
                        $objWorksheet->setCellValue($ts[$k].'11', $v['agency'][3]);$sum[7]+=$v['agency'][3];
                        $objWorksheet->setCellValue($ts[$k].'12', $v['agency'][4]);$sum[8]+=$v['agency'][4];
                        $objWorksheet->setCellValue($ts[$k].'13', $v['agency'][5]);$sum[9]+=$v['agency'][5];
                        $objWorksheet->setCellValue($ts[$k].'14', $v['agency'][6]);$sum[10]+=$v['agency'][6];
                        $objWorksheet->setCellValue($ts[$k].'15', $v['agency'][7]);$sum[11]+=$v['agency'][7];
                        $objWorksheet->setCellValue($ts[$k].'16', $v['agency'][8]);$sum[12]+=$v['agency'][8];
                        $objWorksheet->setCellValue($ts[$k].'17', $v['agency'][9]);$sum[13]+=$v['agency'][9];
                        $objWorksheet->setCellValue($ts[$k].'18', $v['agency'][10]);$sum[14]+=$v['agency'][10];
                        $objWorksheet->setCellValue($ts[$k].'19', array_sum($v['agency']));$sum[15]+=array_sum($v['agency']);

                    }
                }

                $objWorksheet->setCellValue($ts[(count($data)+2)].'5', $sum[1]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'6', $sum[2]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'7', $sum[3]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'8', $sum[4]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'9', $sum[5]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'10', $sum[6]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'11', $sum[7]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'12', $sum[8]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'13', $sum[9]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'14', $sum[10]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'15', $sum[11]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'16', $sum[12]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'17', $sum[13]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'18', $sum[14]);
                $objWorksheet->setCellValue($ts[(count($data)+2)].'19', $sum[15]);
            }

// Redirect output to a clientâ€™s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="report.xls"');
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function excel_signal_report(){
        try {
            if($_POST['type'] == 'y'){
                $date1 = $_POST['year'].'-01-01';
                $date2 = $_POST['year'].'-12-31';
                $text = "";
            }elseif($_POST['type'] == '1_q'){
                $date1 = $_POST['year'].'-01-01';
                $date2 = $_POST['year'].'-03-31';
                $text = " 1 եռամսյակում";
            }elseif($_POST['type'] == '2_q'){
                $date1 = $_POST['year'].'-04-01';
                $date2 = $_POST['year'].'-06-30';
                $text = " 2 եռամսյակում";
            }elseif($_POST['type'] == '3_q'){
                $date1 = $_POST['year'].'-07-01';
                $date2 = $_POST['year'].'-09-30';
                $text = " 3 եռամսյակում";
            }elseif($_POST['type'] == '4_q'){
                $date1 = $_POST['year'].'-10-01';
                $date2 = $_POST['year'].'-12-31';
                $text = " 4 եռամսյակում";
            }elseif($_POST['type'] == '1_h'){
                $date1 = $_POST['year'].'-01-01';
                $date2 = $_POST['year'].'-06-30';
                $text = " I կիսամյակում";
            }elseif($_POST['type'] == '2_h'){
                $date1 = $_POST['year'].'-07-01';
                $date2 = $_POST['year'].'-12-31';
                $text = " II կիսամյակում";
            }
            $column[1] = $this->_model->column1($date1);
            $column[2] = $this->_model->column2($date1,$date2);
            $column[3] = $this->_model->column2($date1,$date2,8);
            $column[4] = $this->_model->column2($date1,$date2,9);
            $column[5] = $this->_model->column5($column[2],$column[3],$column[4]);
            $column[6] = $this->_model->column6();
            $column[7] = $this->_model->column7($date1,$date2);
            $column[8] = $this->_model->column7($date1,$date2,3);
            $column[9] = $this->_model->column7($date1,$date2,1);
            $column[10] = $this->_model->column7($date1,$date2,5);
            $column[11] = $this->_model->column7($date1,$date2,6);
            $column[12] = $this->_model->column7($date1,$date2,36);
            $column[13] = $this->_model->column7($date1,$date2,33);
            $column[14] = $this->_model->column7($date1,$date2,12);
            $column[15] = $this->_model->column7($date1,$date2,4);
            $column[16] = $this->_model->column7($date1,$date2,34);
            $column[17] = $this->_model->column7($date1,$date2,8);
            $column[18] = $this->_model->column18($date1,$date2);
            $column[19] = $this->_model->column19($date1,$date2);
            $column[20] = $this->_model->column7($date1,$date2,42);
            $column[21] = $this->_model->column7($date1,$date2,41);
            $column[22] = $this->_model->column7($date1,$date2,37);
            $column[23] = $this->_model->column7($date1,$date2,35);
            $column[24] = $this->_model->column7($date1,$date2,20);
            $column[25] = $this->_model->column25($date1,$date2);
            $column[26] = $this->_model->column26($date1,$date2);
            $column[27] = $this->_model->column6();
            $column[28] = $this->_model->column28($date1,$date2);
            $column[29] = $this->_model->column29($date1,$date2);
            $column[30] = $this->_model->column30($date1,$date2);
            $column[31] = $this->_model->column31($date2);
            ini_set('display_errors',0);
            require APP_PATH . DS . 'classes/PHPExcel.php';
            require APP_PATH . DS . 'classes/PHPExcel/IOFactory.php';
            require APP_PATH . DS . 'classes/PHPExcel/ReferenceHelper.php';

// Read the file
            $fileType = 'Excel5';
            $objReader = PHPExcel_IOFactory::createReader($fileType);
            $objPHPExcel = $objReader->load( APP_PATH.'/webroot/files/sr.xls' );


// Set document properties
            $objPHPExcel->getProperties()->setCreator("SNS")
                ->setLastModifiedBy("SNS")
                ->setTitle("Office 2007 XLS Report")
                ->setSubject("Office 2007 XLS Report")
                ->setDescription("Report")
                ->setKeywords("Report")
                ->setCategory("Report");
            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            $objWorksheet->getHeaderFooter()->setOddHeader("&C& Տ վ յ ա լ ն ե ր \n {$_POST['year']}թ. $text ՀՀ ԱԱԾ օպերատիվ ստորաբաժանումների \n կողմից ահազանգերով տարվող աշխատանքների, դրանց արդյունքների մասին &R& Օր. N  1");

            $ts = range('B','Z');
            $ts2 = range('A','Z');
            $c = count($ts);
            foreach($ts2 as $k=>$v){
                $ts[$c+$k] = 'A'.$v;
            }

            for($k=1;$k<=31;$k++){
                $objWorksheet->setCellValue($ts[$k].'4', $column[$k][15]);
                $objWorksheet->setCellValue($ts[$k].'5', $column[$k][14]);
                $objWorksheet->setCellValue($ts[$k].'6', $column[$k][13]);
                $objWorksheet->setCellValue($ts[$k].'7', $column[$k][12]);
                $objWorksheet->setCellValue($ts[$k].'8', $column[$k][1]);
                $objWorksheet->setCellValue($ts[$k].'9', $column[$k][2]);
                $objWorksheet->setCellValue($ts[$k].'10', $column[$k][3]);
                $objWorksheet->setCellValue($ts[$k].'11', $column[$k][4]);
                $objWorksheet->setCellValue($ts[$k].'12', $column[$k][5]);
                $objWorksheet->setCellValue($ts[$k].'13', $column[$k][6]);
                $objWorksheet->setCellValue($ts[$k].'14', $column[$k][7]);
                $objWorksheet->setCellValue($ts[$k].'15', $column[$k][8]);
                $objWorksheet->setCellValue($ts[$k].'16', $column[$k][9]);
                $objWorksheet->setCellValue($ts[$k].'17', $column[$k][10]);
                $objWorksheet->setCellValue($ts[$k].'18', array_sum($column[$k]));
            }

// Redirect output to a clientâ€™s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="report.xls"');
            header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

}