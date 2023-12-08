<?php

class BibliographyController extends Controller
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

    public function add($bId = null){
        try {
            if($bId){
                $check = true;
            }else{
                $check = false;
            }
            if($bId){
                $bibliography = $this->_model->getBibliography($bId);
                if(!empty($bibliography['reg_date'])){
                    $date2 = explode('-',$bibliography['reg_date']);
                    $bibliography['reg_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
                }
                $dateTime = $bibliography['created_at'];
                $user = $this->_model->getUserById($bibliography['user_id']);
                $bibliography_has = $this->_model->getBibliographyHas($bId);
                $bibliography_has_file = $this->_model->getBibliographyHasFile($bId);
                $bibliography_has_country = $this->_model->getBibliographyHasCountry($bId);
                $man_count = $this->_model->getMailCount($bId);
                $this->_view->set('bibliography',$bibliography);
                $this->_view->set('bibliography_has',$bibliography_has);
                $this->_view->set('bibliography_has_file',$bibliography_has_file);
                $this->_view->set('bibliography_has_country',$bibliography_has_country);
                $this->_view->set('man_count',$man_count);
                $this->_model->logging('edit','bibliography',$bId);
            }else{
                $bIdc = $this->_model->createBibliography();
                $bId = $bIdc['id'];
                $dateTime = $bIdc['created_at'];
                $user = $this->_model->getUser();
                $this->_model->logging('add','bibliography',$bId);
                $this->_view->set('man_count',0);
            }
            $this->_view->set('user' ,$user);
            $this->_view->set('bId' ,$bId);
            $this->_view->set('dateTime',$dateTime);

            if($check){
                return $this->_view->output('empty');
            }else{
                $this->_view->set('navigationItem',$this->Lang->bibliography.' id:'.$bId);
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function save($bId){
        try {
            if($_POST['field'] == 'reg_date'){
                $data = explode('-',$_POST['id']);
                $year = $data[2];
                $month = $data[1];
                $day = $data[0];
                $_POST['id'] = $year.'-'.$month.'-'.$day;
            }
            $this->_model->updateBibl($bId , $_POST['id'] , $_POST['field']);
            die;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function delete($b_id){
        try {
            $this->_model->deleteById('bibliography',$b_id);
            $this->_model->logging('delete','bibliography',$b_id);
            die;
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function uploader($b_id){
        try {
            $FileUploader = new FileUploader();
            if (isset($_GET['qqfile'])) {
                $imgName = $_GET['qqfile'];
            } elseif (isset($_FILES['qqfile'])) {
                $imgName = $_FILES['qqfile']['name'];
            }
            $explode = explode('.', $imgName);
            $ext = end($explode);
            $ext = strtolower($ext);
            $name = md5(microtime()) . '.' . $ext;
            if($ext == 'doc' || $ext == 'docx' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'pdf' ){
                // if (!is_dir(WWW_ROOT . 'system' . DS . 'bulletinPic' . DS.$this->u_id)){
                // mkdir(WWW_ROOT . 'system' . DS . 'bulletinPic' . DS.$this->u_id,true);}
                $test = $FileUploader->upload(APP_PATH . DS . 'webroot'. DS . 'files' . DS );
                $response['fileName'] = $name;
                $response['success'] = true;
                @rename(APP_PATH . DS . 'webroot'. DS . 'files' . DS .$test['filename'] , APP_PATH . DS . 'webroot'. DS . 'files'.DS.$name);

                $id = $this->_model->createNewFile($b_id,$name,$imgName);

                $response['file_id'] = $id;

                $file_name_with_full_path = realpath('./files/' . $name);

                $post = array(
                    'myfile' =>  '@' . $file_name_with_full_path
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, SOLR_URL . "update/extract?literal.id=$id&uprefix=attr_&fmap.content=attr_content&commit=true&wt=json&captureAttr=true&defaultField=text&fmap.div=foo_txt&capture=div");
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $result=curl_exec ($ch);
                curl_close ($ch);
//
//                $url = SOLR_PORT."/solr/update/extract?literal.id=$id&uprefix=attr_&fmap.content=attr_content&commit=true";
//                    //"/solr/update/extract?commit=true&literal.id=$id&captureAttr=true&defaultField=text&fmap.div=foo_txt&capture=div";
////                curl 'http://localhost:8983' -F "myfile=@tutorial.html"
//
//                $post_string = file_get_contents(APP_PATH . DS . 'webroot'. DS . 'files' . DS. $name , $infile);
//
//                $header = array("Content-type:text/xml; charset=utf-8");
//
//                $ch = curl_init();
////delete by id url http://localhost:8983/solr/update?stream.body=%3Cdelete%3E%3Cquery%3Eid:[1%20TO%20*]%3C/query%3E%3C/delete%3E&commit=true
//                curl_setopt($ch, CURLOPT_URL, $url);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                curl_setopt($ch, CURLOPT_POST, 1);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
//                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//                curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
//
//                $data = curl_exec($ch);
//                $response['width'] = $width;
//                $response['height'] = $height;
                $this->_model->logging('add','file',$id);
                die;
            }

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function deleteFile($file_id){
        try {
            $data = $this->_model->getFile($file_id);
            $this->_model->logging('delete','file',$file_id);
            unlink(APP_PATH . DS . 'webroot'. DS . 'files' . DS .$data['real_name'] );
            $this->_model->deleteFile($file_id);

            $url = SOLR_URL . "update?stream.body=%3Cdelete%3E%3Cquery%3Eid:".$file_id."%3C/query%3E%3C/delete%3E&commit=true";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLINFO_HEADER_OUT, 1);

            $data = curl_exec($ch);

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

    public function downloadFile($file_id){
        try {
            $fileName = $this->_model->getFileName($file_id);
            $this->_model->logging('view','file',$file_id);
            $file = (APP_PATH.'/webroot/files/'.$fileName['real_name']);
//header ("Accept-Ranges: bytes");
//header ("Content-Length: ".filesize($file));
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=".$fileName['name'] );
            readfile($file);
            exit;

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function getManName($man_id){
        try {
            $data['name'] = $this->_model->getManName($man_id);
            echo json_encode($data);

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function indexFiles($offset, $limit)
    {
        $files = $this->_model->getFileId($offset, $limit);

        foreach ($files as $file) {

            $file_name_with_full_path = realpath('./files/' . $file['real_name']);
            var_dump($file_name_with_full_path);

            $post = array(
                'myfile' => '@' . $file_name_with_full_path
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, SOLR_URL . "update/extract?literal.id=" . $file['id'] . "&uprefix=attr_&fmap.content=attr_content&commit=true&captureAttr=true&defaultField=text&fmap.div=foo_txt&capture=div");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $result = curl_exec($ch);
            curl_close($ch);
            var_dump($file['real_name']);
            var_dump($result);
            var_dump('<br />');
        }


    }

}