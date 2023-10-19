<?php

class TestController extends Controller
{
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
        ini_set('display_errors',1);
    }

    public function ts(){
        try {
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
                        @page Section2 {size:11in 8.5in ;mso-page-orientation:landscape;margin:0.2in 0.2in 0.2in 0.2in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;}
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
            $cont .= '<div style="width:100%;font-size: 7pt;text-align: right;">
                            <p style="right: 100px;position: relative;margin:0in 0.5in 0in 0in;">
                                Экз.№ 1 <br>
                                Приложение № _
                            </p>
                      </div>';
            $cont .='<div style="width:100%;font-size: 10pt;text-align: center;">
                        <p>
                                                Сведения по сигналам,<br>
                            заведенным QWER СНБ РА за период с 00.00.0000г. по 00.00.0000г.
                        </p>
                     </div>';
            $cont .= '<table>
                        <tr style="font-size: 7pt;">
                            <td>
                                №
                            </td>
                            <td>
                                Подразделение, которое завело сигнал
                            </td>
                            <td>
                                Фамилия оперработника
                            </td>
                            <td>
                                должность оперработника
                            </td>
                            <td>
                                Рег. №
                            </td>
                            <td>
                                Окраска сигнала
                            </td>
                            <td>
                                Категории источн. инф.
                            </td>
                            <td>
                                Дата заведен.
                            </td>
                        </tr>
                        <tr style="font-size: 8pt;">
                            <td>
                                1.
                            </td>
                            <td>
                                1 отделение 2 отдела QWER СНБ РА
                            </td>
                            <td>
                                 Nsdgngdndgnd
                            </td>
                            <td>
                                нач-к отдела
                            </td>
                            <td>
                                7677
                            </td>
                            <td>
                                 Grkgh rhgoih ;oihborihgboi hbofhboifh boiihf boifhboi hfobihohfbfogi bhfgoi bhofgi bohbhhoihdbpi ohbiohfgo bhhfib foi hfhbfobh
                            </td>
                            <td>
                                hdgjf.
                            </td>
                            <td>
                                30.01.2013
                            </td>
                        </tr>
                      </table>';
            $cont .='</div>
                    </body>
                    </html>';
            echo $cont;
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal_report()
    {
        try{
            ini_set('display_errors',0);
            require_once APP_PATH . DS . 'classes/phpdocx/classes/CreateDocx.inc';
            $docx = new CreateDocx();

//            $docx->addText('Quisque ullamcorper, dolor eget eleifend consequat, justo nunc ultricies quam, sed ullamcorper lectus urna ac justo. Phasellus sed libero ut dui hendrerit tempus. Mauris tincidunt laoreet sapien, feugiat viverra justo dictum eu. Cras at eros ac urna accumsan varius. Vestibulum cursus gravida sollicitudin. Donec vestibulum lectus id sem malesuada volutpat. Praesent et ipsum orci. Sed rutrum eros id erat fermentum in auctor velit auctor. Nam bibendum rutrum augue non pellentesque. Donec in mauris dui, non sagittis dui. Phasellus quam leo, ultricies sit amet cursus nec, elementum at est. Proin blandit volutpat odio ac dignissim. In at lacus dui, sed scelerisque ante. Aliquam tempor, metus sed malesuada vehicula, neque massa malesuada dolor, vel semper massa ante eu nibh.');
//
//            $text = array();
//            $text[] = array('text' => 'Fit text and ');
//            $text[] = array('text' => 'WordML fragment', 'b' => 'on');
//
//            $text = $docx->addText($text, array('rawWordML' => true));
//            $textFragment = $docx->createWordMLFragment($text);
//
//            $trProperties = array();
//            $trProperties[0] = array('minHeight' => 1000, 'tableHeader' => true);
            $col_1_1 = array( 'rowspan' => 4,
                'value' => '1_1',
                'background_color' => 'cccccc',
                'border_color' => 'b70000',
                'border' => 'single',
                'border_color' => 'FF0000',
                'border_top_color' => '0000FF',
                'border_sz' => 16,
                'cellMargin' => 200);
            $col_2_2 = array('rowspan' => 2,
                'colspan' => 2,
                'width' => 200,
                'value' => $textFragment,
                'background_color' => 'ffff66',
                'border_color' => 'b70000',
                'border' => 'double',
                'cellMargin' => 0,
                'fitText' => 'on',
                'vAlign' => 'bottom');
            $col_2_4 = array( 'rowspan' => 3,
                'value' => 'Some rotated text',
                'background_color' => 'eeeeee',
                'border_color' => 'b70000',
                'border' => 'single',
                'border_sz' => 16,
                'textDirection' => 'tbRl');
            $options = array('size_col' => array(400,1400,400,400,400),
                'border' => 'single',
                'border_sz' => 4,
                'border_color' => 'cccccc',
                'border_settings' => 'inside',
                'float' => array('align' => 'right', 'textMargin_top' => 300, 'textMargin_right' => 400, 'textMargin_bottom' => 300, 'textMargin_left' => 400)
            );
            $values = array(
                array($col_1_1, '1_2', '1_3', '1_4', '1_5'),
                array($col_2_2, $col_2_4, '2_5'),
                array('3_5'),
                array('4_2', '4_3', '4_5')
            );

            $docx->addTable($values, $options);

//            $docx->addText('In pretium neque vitae sem posuere volutpat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque eget ultricies ipsum. Cras vitae suscipit erat. Nullam fermentum risus sed urna fermentum placerat laoreet arcu lobortis. Integer nisl erat, vehicula eget posuere id, mollis fermentum mi. Phasellus quis nulla orci. Suspendisse malesuada lectus et turpis facilisis id imperdiet tellus luctus. In hac habitasse platea dictumst. Proin a mattis turpis. Aliquam sit amet velit a lacus hendrerit bibendum. Mauris euismod dictum augue eget condimentum.');

            $docx->createDocx(APP_PATH.'/webroot/files/word');

            $file = (APP_PATH.'/webroot/files/word.docx');
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=word.docx" );
            readfile($file);
            exit;
        }catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }

    }

    public function index($test = null)
    {
        try {
              $data = $this->_model->saveAgencyParent();
              var_dump($data);die;
//            /*$file = file('file:///var/www/SNS/slovari/agency_parent.txt');
////            $file = trim($file);
////            $sendData = array();
//            foreach($file as $key=>$val){
//                $val = trim($val);
//                $this->_model->saveAgencyParent();
//            }*/||
//
////                $file[$key] = substr($val,4);
////                $file[$key] = trim($val);
//
//                  $data1=explode("-", $val);
//                  $data2 = explode('–',$val);
//                if(isset($data1[1])){
//                  $file[$key] = trim($data1[1]);
//                }elseif(isset($data2[1])){
//                    $file[$key] = trim($data2[1]);
//                }
////                $data2=explode(";",$data1[1]);
////                $sendData[$key]['name'] = trim($data2[0]);
////                $sendData[$key]['old_name'] = trim($data2[1]);
//
//                if(!(strlen(trim($val))>0)){
//
//                    unset($file[$key]);
//
//                }
////                echo "</br>".trim($val);
//            }
//
//
//     $this->_model->save($file);
//
//          var_dump($file);die;

//            foreach($file as $key=>$val){
//                echo " key = ".$key." val = ".$val."</br>";
//            }
//            die;
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function test()
    {
        try {
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    //////////////////////////////////////  LastName  /////////////////////////////////////////////////////////
    public function last_name(){
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

    public function last_name_save($last_name_id){
        try {
            $this->_model->lastNameSave($last_name_id,$_POST['value'],$_POST['field']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function last_name_delete($man_id){
        try {
            $this->_model->lastNameDelete($man_id,$_POST['last_name_id']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }



    public function man_last_name($man_id){
        try {

//            $last_name = $this->_model->checkManLastName( trim($_POST['name']) );

//           $data = explode(';',$_POST['name']);

//            foreach($data as $val){
//                if(strlen(trim($val)) > 0 ){
                $last_name = $this->_model->checkManLastName( trim($_POST['name']) );
                if($last_name){
                    $this->_model->lastNameSave($man_id,$last_name);
                }else{
                    $last_name = $this->_model->createManLastName( trim($_POST['name']) );
                    $this->_model->lastNameSave($man_id,$last_name);
                }
                $forJson['id'] = $last_name;
                echo json_encode($forJson);die;
//                }
//            }

//
//            if($last_name){
//                $this->_model->lastNameSave($man_id,$last_name);
//            }else{
//                $last_name = $this->_model->createManLastName( trim($_POST['name']) );
//                $this->_model->lastNameSave($man_id,$last_name);
//            }
//            die;







        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

//////////////////////////////////// END  LastName  /////////////////////////////////////////////////////////

    //////////////////////////////////////  FirstName  /////////////////////////////////////////////////////////
    public function first_name(){
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

    public function first_name_save($first_name_id){
        try {
            $this->_model->firstNameSave($first_name_id,$_POST['value'],$_POST['field']);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function first_name_delete($man_id){
        try {
            $this->_model->firstNameDelete($man_id,$_POST['first_name_id']);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_first_name($man_id){
        try {
            $first_name = $this->_model->checkManFirstName( trim($_POST['name']) );
            if($first_name){
                $this->_model->firstNameSave($man_id,$first_name);
            }else{
                $first_name = $this->_model->createManFirstName( trim($_POST['name']) );
                $this->_model->firstNameSave($man_id,$first_name);
            }
            $forJson['id'] = $first_name;
            echo json_encode($forJson);die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

//////////////////////////////////// END  FirstName  /////////////////////////////////////////////////////////

    //////////////////////////////////////  MiddleName  /////////////////////////////////////////////////////////
    public function middle_name(){
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

    public function middle_name_save($middle_name_id){
        try {
            $this->_model->middleNameSave($middle_name_id,$_POST['value'],$_POST['field']);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function middle_name_delete($man_id){
        try {
            $this->_model->middleNameDelete($man_id,$_POST['middle_name_id']);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_middle_name($man_id){
        try {
            $middle_name = $this->_model->checkManMiddleName( trim($_POST['name']) );
            if($middle_name){
                $this->_model->middleNameSave($man_id,$middle_name);
            }else{
                $middle_name = $this->_model->createManMiddleName( trim($_POST['name']) );
                $this->_model->middleNameSave($man_id,$middle_name);
            }
            $forJson['id'] = $middle_name;
            echo json_encode($forJson);die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

//////////////////////////////////// END  MiddleName  /////////////////////////////////////////////////////////


    public function test2()
    {
        try {
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
///////////////////////////////   man-beann_country  /////////////////////////
    public function mbc(){
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                var_dump($_POST);die;
            }
            $mbc_man_id = $this->_model->createMbc();
            $user = $this->_model->getUser();
            $this->_view->set('user' ,$user);
            $this->_view->set('mbc_man_id' ,$mbc_man_id);
            return $this->_view->output('empty');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function mbc_save($mbc_man_id){
        try {
            $field = $_POST['field'];
            $val = $_POST['value'];
            if( ($field == 'creation_date')||($field == 'reg_date')||($field == 'resolution_date') ){
                $data = explode('-',$val);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $val = $year.'-'.$month.'-'.$day;
            }

            $this->_model->mbcSave($mbc_man_id,$_POST['value'],$_POST['field']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function mbc_delete($mbc_man_id){
        try {
            $this->_model->mbcDelete($mbc_man_id);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function mbc_locality($mbc_man_id){
        try {
            $locality_id = $this->_model->checkLocality( trim($_POST['locality']) );
            if($locality_id){
                $this->_model->mbcSave($mbc_man_id,$locality_id,'locality_id');
            }else{
                $locality_id = $this->_model->createLocality( trim($_POST['locality']) );
                $this->_model->mbcSave($mbc_man_id,$locality_id,'locality_id');
            }
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function mbc_region($mbc_man_id){
        try {
            $region_id = $this->_model->checkRegion( trim($_POST['region']) );
            if($region_id){
                $this->_model->mbcSave($mbc_man_id,$region_id,'region_id');
            }else{
                $region_id = $this->_model->createRegion( trim($_POST['region']) );
                $this->_model->mbcSave($mbc_man_id,$region_id,'region_id');
            }
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


///////////////////////////////     end   mbc   //////////////////////////////



    public function test3()
    {
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $userId = $this->_model->login($_POST);
                if($userId){
                    $_SESSION['userId'] = $userId;
                    header('Location: '.ROOT.'sns/first_page');
                    exit;
                }
            }

            $this->_view->output('login');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }





    public function reg($id)
    {
        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $username = $this->_model->checkUsername( $_POST['username'] );
                if($username){
                    $forJson['success'] = false;
                    $forJson['message'] = 'Tvyal user goyutyun uni!!!!!';
                    echo json_encode($forJson);
                    die;
                }
                else{
                    $forJson['success'] = true;
                    $data=$this->_model->createReg( $_POST );
                    echo json_encode($forJson);
                    die;
                }

            }

            $user = $this->_model->getUser();
            $this->_view->set('user' ,$user);
            return $this->_view->output('login');

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
//
//    public function reg_username($reg_id){
//        try {
//            $username = $this->_model->checkUsername( trim($_POST['username']) );
//
//            if($username){
//               $this->_model->regSave($reg_id,$username,'username');
//
//            }else{
//                $username = $this->_model->createUsername( trim($_POST['username']) );
//                $this->_model->regSave($reg_id,$username,'username');
//            }
//            die;
//
//        } catch (Exception $e) {
//            echo "Application error:" . $e->getMessage();
//        }
//    }
//
//    public function reg_first_name($reg_id){
//        try {
//            $first_name = $this->_model->checkFirstName( trim($_POST['first_name']) );
//
//            if($first_name){
//                $this->_model->regSave($reg_id,$first_name,'first_name');
//
//            }else{
//                $first_name = $this->_model->createFirstName( trim($_POST['first_name']) );
//                $this->_model->regSave($reg_id,$first_name,'first_name');
//            }
//            die;
//
//        } catch (Exception $e) {
//            echo "Application error:" . $e->getMessage();
//        }
//    }

    public function bibliography($check = null){
        try {
            if($check){
                $data=$this->_model->readBibliography();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->bibliography);
                return $this->_view->output();
            }




        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function phone($check = null){
        try {
            if($check){
                $data=$this->_model->readPhone();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->telephone);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function car($check = null){
        try {
            if($check){
                $data=$this->_model->readCar();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->car);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function address($check = null){
        try {
            if($check){
                $data=$this->_model->readAddress();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->address);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man_beann_country($check = null){
        try {
            if($check){
                $data=$this->_model->readManBeannCountry();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->man_bean_country);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function action($check = null){
        try {
            if($check){
                $data=$this->_model->readAction();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->action);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function event($check = null){
        try {
            if($check){
                $data=$this->_model->readEvent();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->event);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function organization($check = null){
        try {
            if($check){
                $data=$this->_model->readOrganization();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->organization);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function sign($check = null){
        try {
            if($check){
                $data=$this->_model->readSign();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->external_signs);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function weapon($check = null){
        try {
            if($check){
                $data=$this->_model->readWeapon();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->weapon);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function work_activity($check = null){
        try {
            if($check){
                $data=$this->_model->readWorkActivity();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->work_activity);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function objects_relation($check = null){
        try {
            if($check){
                $data=$this->_model->readObjectsRelation();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->relationship_objects);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function criminal_case($check = null){
        try {
            if($check){
                $data=$this->_model->readCriminalCase();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->criminal);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function keep_signal($check = null){
        try {
            if($check){
                $data=$this->_model->readKeepSignal();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->keep_signal);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function mia_summary($check = null){
        try {
            if($check){
                $data=$this->_model->readMiaSummary();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->mia_summary);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function control($check = null){
        try {
            if($check){
                $data=$this->_model->readControl();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->control);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function signal($check = null){
        try {
            if($check){
                $data=$this->_model->readSignal();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->signal);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function man($check = null){
        try {
            if($check){
                $data=$this->_model->readMan();
                echo json_encode($data);
                die;
            }else{
                $this->_view->set('navigationItem',$this->Lang->face);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


}

