<?php

namespace App\Http\Controllers\SearchInclude;

use App\Http\Controllers\Controller;
use App\Models\ModelInclude\SimplesearchModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SimpleSearchController extends Controller
{
    public $simpleSearchModel;

    public function __construct()
    {

        // $this->middleware(function ($request, $next)
        // {

        // // session()->flush();
        // dd(Session::all());
        // });
        if(isset($_SESSION['counter'])){
            $_SESSION['counter'] = $_SESSION['counter']+1;
        }else{
            $_SESSION['counter'] = 1;
        }

        $this->simpleSearchModel = new SimplesearchModel;
    }
    // public function __construct($model, $action)
    // {
    //     dd(55);
    //     parent::__construct($model, $action);
    //     // $this->_setModel($model);
    // }

    // public function simple_search()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->simple_search);
    //         return $this->_view->output();
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function simple_search_action($type = null)
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->action);
    //         if($type){
    //             $this->_view->set('type',$type);
    //             return $this->_view->output('empty');
    //         }else{
    //             $new = explode('?', $_SERVER['REQUEST_URI']);
    //             if (strcmp($new[1], 'n=t') == 0) {
    //                 unset($_SESSION['search_params']);
    //             }else if (isset($_SESSION['search_params'])) {
    //                 $cookie = stripslashes($_SESSION['search_params']);
    //                 $savedCardArray = json_decode($cookie, true);
    //                 $this->_view->set('search_params',  $savedCardArray);
    //             }
    //             return $this->_view->output();
    //         }
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_action($type = null)
    // {
    //     try {
    //         $search_params = array();
    //         if (isset($_POST)) {
    //             foreach($_POST as $key=>$value) {
    //                 $search_params[$key] = $value;
    //             }
    //         }
    //         $files_flag = false;
    //         if (isset($_POST['content']) && trim($_POST['content']) != '') {
    //             $files_flag = true;
    //             $files = $this->solrSearch($_POST['content']);
    //         }
    //         if(isset($files) && !empty($files)){
    //             $res = $this->_model->searchAction($_POST, false, $files);
    //         } elseif ($files_flag){
    //             $res = $this->_model->searchAction($_POST, true);
    //         } else {
    //             $res = $this->_model->searchAction($_POST);
    //         }
    //         $data = json_encode($res);
    //         if($type){
    //             if($res){
    //                 $response['status'] = true;
    //                 $response['data'] = $res;
    //             }else{
    //                 $response['status'] = false;
    //             }
    //             echo json_encode($response);die;
    //         }
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $_SESSION['search_params'] = $this->encodeParams($search_params);
    //         $this->_view->set('navigationItem',$this->Lang->action);
    //         $this->_model->logging('smp_search','action');
    //         return $this->_view->output();
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    public function simple_search_control(Request $request, $lang, $type = null)
    {
        try {
           // $this->_view->set('navigationItem',$this->Lang->control);
            if($type){
              //  $this->_view->set('type',$type);
              //  return $this->_view->output('empty');
              return view('simplesearch.simple_search_control')->with('type', $type);
            }else{
                $new = explode('?', request()->getRequestUri());
                if (strcmp($new[1], 'n=t') == 0) {
                   // unset($_SESSION['search_params']);
                   Session::forget('search_params');
                }else if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                    //$savedCardArray = json_decode($cookie, true);
                    $search_params = json_decode($cookie, true);
                    //$this->_view->set('search_params',  $savedCardArray);
                    return view('simplesearch.simple_search_control',compact('search_params'));
                }
                return view('simplesearch.simple_search_control');
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_control(Request $request, $lang, $type = null)
    {
        try {
            $search_params = array();
            $post = $request->all();

            if (isset($post)) {
                foreach($post as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($request['content']) && trim($request['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($request['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->simpleSearchModel->searchControl($post, false, $files);
            } elseif ($files_flag){
                $res = $this->simpleSearchModel->searchControl($post, true);
            } else {
                $res = $this->simpleSearchModel->searchControl($post);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
          //  $this->_view->set('data',$data);
         //  $_SESSION['search_params'] = $this->encodeParams($search_params);
         Session::put('search_params', $this->encodeParams($search_params));
          //  $this->_view->set('navigationItem',$this->Lang->control);
          //  $this->_model->logging('smp_search','control');
            return view('simplesearch.result_control',compact('data'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_man(Request $request, $lang, $type = null)
    {
        try {

            // $this->_view->set('navigationItem',$this->Lang->face);
            if($type){
                // $this->_view->set('type',$type);
                // return $this->_view->output('empty');
                return view('simplesearch.simple_search_man')->with('type', $type);

            }else{
                // $this->_view->set('type',$type);
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (count($new) > 1 && strcmp($new[1], 'n=t') == 0) {
                    // unset($_SESSION['search_params']);
                    Session::forget('search_params');
                    return view('simplesearch.simple_search_man');

                }
                if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                    $savedCardArray = json_decode($cookie, true);
                    $search_params = $savedCardArray;
                    // $this->_view->set('search_params',  $savedCardArray);
                    return view('simplesearch.simple_search_man', compact('search_params'));

                }
                // return $this->_view->output();
                return view('simplesearch.simple_search_man');

            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_man(Request $request, $lang, $type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }

            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->simpleSearchModel->searchMan($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->simpleSearchModel->searchMan($_POST, true);
            } else {
                $res = $this->simpleSearchModel->searchMan($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            // $this->_view->set('data',$data);
            Session::put('search_params', $this->encodeParams($search_params));
            // $this->_view->set('navigationItem',$this->Lang->face);
            // $this->_model->logging('smp_search','man');
            // return $this->_view->output();
            return view('simplesearch.result_man', compact('data'));

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    // public function simple_search_weapon($type = null)
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->weapon);
    //         if($type){
    //             $this->_view->set('type',$type);
    //             return $this->_view->output('empty');
    //         }else{
    //             $new = explode('?', $_SERVER['REQUEST_URI']);
    //             if (strcmp($new[1], 'n=t') == 0) {
    //                 unset($_SESSION['search_params']);
    //             }else if (isset($_SESSION['search_params'])) {
    //                 $cookie = stripslashes($_SESSION['search_params']);
    //                 $savedCardArray = json_decode($cookie, true);
    //                 $this->_view->set('search_params',  $savedCardArray);
    //             }
    //             return $this->_view->output();
    //         }
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_weapon($type = null)
    // {
    //     try {
    //         $search_params = array();
    //         if (isset($_POST)) {
    //             foreach($_POST as $key=>$value) {
    //                 $search_params[$key] = $value;
    //             }
    //         }
    //         $files_flag = false;
    //         if (isset($_POST['content']) && trim($_POST['content']) != '') {
    //             $files_flag = true;
    //             $files = $this->solrSearch($_POST['content']);
    //         }
    //         if(isset($files) && !empty($files)){
    //             $res = $this->_model->searchWeapon($_POST, false, $files);
    //         } elseif ($files_flag){
    //             $res = $this->_model->searchWeapon($_POST, true);
    //         } else {
    //             $res = $this->_model->searchWeapon($_POST);
    //         }
    //         $data = json_encode($res);
    //         if($type){
    //             if($res){
    //                 $response['status'] = true;
    //                 $response['data'] = $res;
    //             }else{
    //                 $response['status'] = false;
    //             }
    //             echo json_encode($response);die;
    //         }
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $_SESSION['search_params'] = $this->encodeParams($search_params);
    //         $this->_view->set('navigationItem',$this->Lang->weapon);
    //         $this->_model->logging('smp_search','weapon');
    //         return $this->_view->output();
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    public function simple_search_car(Request $request, $lang, $type = null)
    {
        try {
           //  $this->_view->set('navigationItem',$this->Lang->car);
            if($type){
               // $this->_view->set('type',$type);
               // return $this->_view->output('empty');
               return view('simplesearch.simple_search_car')->with('type', $type);
            }else{
                $new = explode('?', request()->getRequestUri());
                if (strcmp($new[1], 'n=t') == 0) {
                    //unset($_SESSION['search_params']);
                    Session::forget('search_params');
                }else if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                    //$savedCardArray = json_decode($cookie, true);
                    $search_params = json_decode($cookie, true);
                   // $this->_view->set('search_params',  $savedCardArray);
                   return view('simplesearch.simple_search_car',compact('search_params'));
                }
                //return $this->_view->output();
                return view('simplesearch.simple_search_car');
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_car(Request $request, $lang, $type = null)
    {
        try {
            $search_params = array();
            $post = $request->all();
            if (isset($post)) {
                foreach($post as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($request['content']) && trim($request['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($request['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->simpleSearchModel->searchCar($post, false, $files);
            } elseif ($files_flag){
                $res = $this->simpleSearchModel->searchCar($post, true);
            } else {
                $res = $this->simpleSearchModel->searchCar($post);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            //$this->_view->set('data',$data);
           // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));
            // $this->_view->set('navigationItem',$this->Lang->car);
            // $this->_model->logging('smp_search','car');
            return view('simplesearch.result_car',compact('data'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_address(Request $request, $lang, $type = null)
    {
        try {
            // $this->_view->set('navigationItem',$this->Lang->address);
            if($type){

                // $this->_view->set('type',$type);
                // return $this->_view->output('empty');
                return view('simplesearch.simple_search_address')->with('type', $type);

            }else{

                $new = explode('?', $_SERVER['REQUEST_URI']);

                if (count($new) > 1 && strcmp($new[1], 'n=t') == 0) {
                    // unset($_SESSION['search_params']);

                    Session::forget('search_params');
                    return view('simplesearch.simple_search_address');

                }
                if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                    $savedCardArray = json_decode($cookie, true);
                    $search_params = $savedCardArray;

                    // $this->_view->set('search_params',  $savedCardArray);
                    return view('simplesearch.simple_search_address', compact('search_params'));

                }

                // return $this->_view->output();
                return view('simplesearch.simple_search_address');

            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_address(Request $request, $lang, $type = null)
    {
        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->simpleSearchModel->searchAddress($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->simpleSearchModel->searchAddress($_POST, true);
            } else {
                $res = $this->simpleSearchModel->searchAddress($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }

                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            // $this->_view->set('data',$data);
            // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));

            // $this->_view->set('navigationItem',$this->Lang->address);
            // $this->_model->logging('smp_search','address');
            // return $this->_view->output();
            return view('simplesearch.result_address', compact('data'));

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    // public function simple_search_work_activity($type = null)
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->work_activity);
    //         if($type){
    //             $this->_view->set('type',$type);
    //             return $this->_view->output('empty');
    //         }else{
    //             $new = explode('?', $_SERVER['REQUEST_URI']);
    //             if (strcmp($new[1], 'n=t') == 0) {
    //                 unset($_SESSION['search_params']);
    //             }else if (isset($_SESSION['search_params'])) {
    //                 $cookie = stripslashes($_SESSION['search_params']);
    //                 $savedCardArray = json_decode($cookie, true);
    //                 $this->_view->set('search_params',  $savedCardArray);
    //             }
    //             return $this->_view->output();
    //         }
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_work_activity($type = null)
    // {
    //     try {
    //         $search_params = array();
    //         if (isset($_POST)) {
    //             foreach($_POST as $key=>$value) {
    //                 $search_params[$key] = $value;
    //             }
    //         }
    //         $files_flag = false;
    //         if (isset($_POST['content']) && trim($_POST['content']) != '') {
    //             $files_flag = true;
    //             $files = $this->solrSearch($_POST['content']);
    //         }
    //         if(isset($files) && !empty($files)){
    //             $res = $this->_model->searchWorkActivity($_POST, false, $files);
    //         } elseif ($files_flag){
    //             $res = $this->_model->searchWorkActivity($_POST, true);
    //         } else {
    //             $res = $this->_model->searchWorkActivity($_POST);
    //         }
    //         $data = json_encode($res);
    //         if($type){
    //             if($res){
    //                 $response['status'] = true;
    //                 $response['data'] = $res;
    //             }else{
    //                 $response['status'] = false;
    //             }
    //             echo json_encode($response);die;
    //         }
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $_SESSION['search_params'] = $this->encodeParams($search_params);
    //         $this->_view->set('navigationItem',$this->Lang->work_activity);
    //         $this->_model->logging('smp_search','organization_has_man');
    //         return $this->_view->output();
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    public function simple_search_mia_summary(Request $request, $lang, $type = null)
    {
        try {
           // $this->_view->set('navigationItem',$this->Lang->mia_summary);
            if($type){
                // $this->_view->set('type',$type);
                // return $this->_view->output('empty');
                return view('simplesearch.simple_search_mia_summary')->with('type', $type);
            }else{
                $new = explode('?', $request->getRequestUri());
                if (strcmp($new[1], 'n=t') == 0) {
                   // unset($_SESSION['search_params']);
                   Session::forget('search_params');
                }else if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                   // $savedCardArray = json_decode($cookie, true);
                    $search_params = json_decode($cookie, true);
                    //$this->_view->set('search_params',  $savedCardArray);
                    return view('simplesearch.simple_search_mia_summary',compact('search_params'));
                }
                //return $this->_view->output();
                return view('simplesearch.simple_search_mia_summary');
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_mia_summary(Request $request, $lang, $type = null)
    {
        try {
            $search_params = array();
            $post = $request->all();
            if (isset($post)) {
                foreach($post as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($request['file_content']) && trim($request['file_content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($request['file_content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->simpleSearchModel->searchMiaSummary($post, false, $files);
            } elseif ($files_flag){
                $res = $this->simpleSearchModel->searchMiaSummary($post, true);
            } else {
                $res = $this->simpleSearchModel->searchMiaSummary($post);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
           // $this->_view->set('data',$data);
           // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));

            // $this->_view->set('navigationItem',$this->Lang->mia_summary);
            // $this->_model->logging('smp_search','mia_summary');

            // return $this->_view->output();
            return view('simplesearch.result_mia_summary', compact('data'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    // public function simple_search_man_bean_country($type = null)
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->man_bean_country);
    //         if($type){
    //             $this->_view->set('type',$type);
    //             return $this->_view->output('empty');
    //         }else{
    //             $new = explode('?', $_SERVER['REQUEST_URI']);
    //             if (strcmp($new[1], 'n=t') == 0) {
    //                 unset($_SESSION['search_params']);
    //             }else if (isset($_SESSION['search_params'])) {
    //                 $cookie = stripslashes($_SESSION['search_params']);
    //                 $savedCardArray = json_decode($cookie, true);
    //                 $this->_view->set('search_params',  $savedCardArray);
    //             }
    //             return $this->_view->output();
    //         }
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_man_bean_country($type = null)
    // {
    //     try {
    //         $search_params = array();
    //         if (isset($_POST)) {
    //             foreach($_POST as $key=>$value) {
    //                 $search_params[$key] = $value;
    //             }
    //         }

    //         $res = $this->_model->searchManBeanCountry($_POST);
    //         $data = json_encode($res);
    //         if($type){
    //             if($res){
    //                 $response['status'] = true;
    //                 $response['data'] = $res;
    //             }else{
    //                 $response['status'] = false;
    //             }
    //             echo json_encode($response);die;
    //         }
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $_SESSION['search_params'] = $this->encodeParams($search_params);
    //         $this->_view->set('navigationItem',$this->Lang->man_bean_country);
    //         $this->_model->logging('smp_search','man_bean_country');
    //         return $this->_view->output();
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function simple_search_criminal_case($type = null)
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->criminal);
    //         if($type){
    //             $this->_view->set('type',$type);
    //             return $this->_view->output('empty');
    //         }else{
    //             $new = explode('?', $_SERVER['REQUEST_URI']);
    //             if (strcmp($new[1], 'n=t') == 0) {
    //                 unset($_SESSION['search_params']);
    //             }else if (isset($_SESSION['search_params'])) {
    //                 $cookie = stripslashes($_SESSION['search_params']);
    //                 $savedCardArray = json_decode($cookie, true);
    //                 $this->_view->set('search_params',  $savedCardArray);
    //             }
    //             return $this->_view->output();
    //         }
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_criminal_case($type = null)
    // {
    //     try {
    //         $search_params = array();
    //         if (isset($_POST)) {
    //             foreach($_POST as $key=>$value) {
    //                 $search_params[$key] = $value;
    //             }
    //         }
    //         $files_flag = false;
    //         if (isset($_POST['content']) && trim($_POST['content']) != '') {
    //             $files_flag = true;
    //             $files = $this->solrSearch($_POST['content']);
    //         }
    //         if(isset($files) && !empty($files)){
    //             $res = $this->_model->searchCriminalCase($_POST, false, $files);
    //         } elseif ($files_flag){
    //             $res = $this->_model->searchCriminalCase($_POST, true);
    //         } else {
    //             $res = $this->_model->searchCriminalCase($_POST);
    //         }
    //         $data = json_encode($res);
    //         if($type){
    //             if($res){
    //                 $response['status'] = true;
    //                 $response['data'] = $res;
    //             }else{
    //                 $response['status'] = false;
    //             }
    //             echo json_encode($response);die;
    //         }
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $_SESSION['search_params'] = $this->encodeParams($search_params);
    //         $this->_view->set('navigationItem',$this->Lang->criminal);
    //         $this->_model->logging('smp_search','criminal_case');
    //         return $this->_view->output();
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    public function simple_search_organization(Request $request, $lang, $type = null)
    {
        try {
           // $this->_view->set('navigationItem',$this->Lang->organization);
            if($type){
               // $this->_view->set('type',$type);
               // return $this->_view->output('empty');
               return view('simplesearch.simple_search_organization')->with('type', $type);
            }else{
                $new = explode('?', request()->getRequestUri());
                if (strcmp($new[1], 'n=t') == 0) {
                   // unset($_SESSION['search_params']);
                   Session::forget('search_params');
                }else if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                   // $savedCardArray = json_decode($cookie, true);
                    $search_params = json_decode($cookie, true);
                    //$this->_view->set('search_params',  $savedCardArray);
                    return view('simplesearch.simple_search_organization',compact('search_params'));
                }
                //return $this->_view->output();
                return view('simplesearch.simple_search_organization');
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_organization(Request $request, $lang, $type = null)
    {
        try {
            $search_params = array();
            $post = $request->all();
            if (isset($post)) {
                foreach($post as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($request['content']) && trim($request['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($request['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->simpleSearchModel->searchOrganization($post, false, $files);
            } elseif ($files_flag){
                $res = $this->simpleSearchModel->searchOrganization($post, true);
            } else {
                $res = $this->simpleSearchModel->searchOrganization($post);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
           //  $this->_view->set('data',$data);
           // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));
           // $this->_view->set('navigationItem',$this->Lang->organization);
           // $this->_model->logging('smp_search','organization');
           return view('simplesearch.result_organization',compact('data'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    // public function simple_search_event($type = null)
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->event);
    //         if($type){
    //             $this->_view->set('type',$type);
    //             return $this->_view->output('empty');
    //         }else{
    //             $new = explode('?', $_SERVER['REQUEST_URI']);
    //             if (strcmp($new[1], 'n=t') == 0) {
    //                 unset($_SESSION['search_params']);
    //             }else if (isset($_SESSION['search_params'])) {
    //                 $cookie = stripslashes($_SESSION['search_params']);
    //                 $savedCardArray = json_decode($cookie, true);
    //                 $this->_view->set('search_params',  $savedCardArray);
    //             }
    //             return $this->_view->output();
    //         }
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_event($type = null)
    // {
    //     try {
    //         $search_params = array();
    //         if (isset($_POST)) {
    //             foreach($_POST as $key=>$value) {
    //                 $search_params[$key] = $value;
    //             }
    //         }
    //         $files_flag = false;
    //         if (isset($_POST['content']) && trim($_POST['content']) != '') {
    //             $files_flag = true;
    //             $files = $this->solrSearch($_POST['content']);
    //         }
    //         if(isset($files) && !empty($files)){
    //             $res = $this->_model->searchEvent($_POST, false, $files);
    //         } elseif ($files_flag){
    //             $res = $this->_model->searchEvent($_POST, true);
    //         } else {
    //             $res = $this->_model->searchEvent($_POST);
    //         }
    //         $data = json_encode($res);
    //         if($type){
    //             if($res){
    //                 $response['status'] = true;
    //                 $response['data'] = $res;
    //             }else{
    //                 $response['status'] = false;
    //             }
    //             echo json_encode($response);die;
    //         }
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $_SESSION['search_params'] = $this->encodeParams($search_params);
    //         $this->_view->set('navigationItem',$this->Lang->event);
    //         $this->_model->logging('smp_search','event');
    //         return $this->_view->output();
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    public function simple_search_phone(Request $request, $lang, $type = null)
    {
        try {
           // $this->_view->set('navigationItem',$this->Lang->telephone);
            if($type){
                // $this->_view->set('type',$type);
                // return $this->_view->output('empty');
                return view('simplesearch.simple_search_phone')->with('type', $type);
            }else{
                $new = explode('?', $request->getRequestUri());
                if (strcmp($new[1], 'n=t') == 0) {
                   Session::forget('search_params');
                }else if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                    // $savedCardArray = json_decode($cookie, true);
                    // $this->_view->set('search_params',  $savedCardArray);
                    $search_params = json_decode($cookie, true);

                    return view('simplesearch.simple_search_phone',compact('search_params'));

                }
                return view('simplesearch.simple_search_phone');
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_phone(Request $request, $lang, $type = null)
    {
        try {
            $search_params = array();
            $post = $request->all();
            if (isset($post)) {
                foreach($post as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($request['content']) && trim($request['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($request['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->simpleSearchModel->searchPhone($post, false, $files);
            } elseif ($files_flag){
                $res = $this->simpleSearchModel->searchPhone($post, true);
            } else {
                $res = $this->simpleSearchModel->searchPhone($post);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            // $this->_view->set('data',$data);
            // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));
            // $this->_view->set('navigationItem',$this->Lang->telephone);
            // $this->_model->logging('smp_search','phone');
            return view('simplesearch.result_phone', compact('data'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_email(Request $request, $lang, $type = null)
    {

        try {

            if($type){

                return view('simplesearch.simple_search_email')->with('type', $type);
                // $this->_view->set('type',$type);
                // return $this->_view->output('empty');
            }else{

                $new = explode('?', $_SERVER['REQUEST_URI']);

                if (count($new) > 1 && strcmp($new[1], 'n=t') == 0) {

                    // unset($_SESSION['search_params']);
                    Session::forget('search_params');
                    return view('simplesearch.simple_search_email');

                }
                if (Session::has('search_params')) {

                    $cookie = stripslashes(Session::get('search_params'));
                    $savedCardArray = json_decode($cookie, true);
                    $search_params = $savedCardArray;

                    // $this->_view->set('search_params',  $savedCardArray);
                    // return view('simplesearch.simple_search_email', compact('search_params'));
                    return view('simplesearch.simple_search_email', compact('search_params'));

                }

                // return $this->_view->output();
                return view('simplesearch.simple_search_email');

            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_email(Request $request, $lang, $type = null)
    {

        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files) && !empty($files)){
                $res = $this->simpleSearchModel->searchEmail($_POST, false, $files);
            } elseif ($files_flag){
                $res = $this->simpleSearchModel->searchEmail($_POST, true);
            } else {
                $res = $this->simpleSearchModel->searchEmail($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }

                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);

            // $this->_view->set('data',$data);
            // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));
            // $this->_view->set('navigationItem',$this->Lang->email);
            // $this->_model->logging('smp_search','email');
            // return $this->_view->output();

            // $data = $data->except('_token');
            return view('simplesearch.result_email', compact('data'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    // public function simple_search_signal($type = null)
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->signal);
    //         if($type){
    //             $this->_view->set('type',$type);
    //             return $this->_view->output('empty');
    //         }else{
    //             $new = explode('?', $_SERVER['REQUEST_URI']);
    //             if (strcmp($new[1], 'n=t') == 0) {
    //                 unset($_SESSION['search_params']);
    //             }else if (isset($_SESSION['search_params'])) {
    //                 $cookie = stripslashes($_SESSION['search_params']);
    //                 $savedCardArray = json_decode($cookie, true);
    //                 $this->_view->set('search_params',  $savedCardArray);
    //             }
    //             return $this->_view->output();
    //         }
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_signal($type = null)
    // {
    //     try {
    //         $search_params = array();
    //         if (isset($_POST)) {
    //             foreach($_POST as $key=>$value) {
    //                 $search_params[$key] = $value;
    //             }
    //         }
    //         $files_flag = false;
    //         if (isset($_POST['file_content']) && trim($_POST['file_content']) != '') {
    //             $files_flag = true;
    //             $files = $this->solrSearch($_POST['file_content']);
    //         }
    //         if(isset($files) && !empty($files)){
    //             $res = $this->_model->searchSignal($_POST, false, $files);
    //         } elseif ($files_flag){
    //             $res = $this->_model->searchSignal($_POST, true);
    //         } else {
    //             $res = $this->_model->searchSignal($_POST);
    //         }
    //         $data = json_encode($res);
    //         if($type){
    //             if($res){
    //                 $response['status'] = true;
    //                 $response['data'] = $res;
    //             }else{
    //                 $response['status'] = false;
    //             }
    //             echo json_encode($response);die;
    //         }
    //         $data = str_replace('"null"' , '""' , $data);
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $_SESSION['search_params'] = $this->encodeParams($search_params);
    //         $this->_view->set('navigationItem',$this->Lang->signal);
    //         $this->_model->logging('smp_search','signal');
    //         return $this->_view->output();
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function simple_search_keep_signal($type = null)
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->keep_signal);
    //         if($type){
    //             $this->_view->set('type',$type);
    //             return $this->_view->output('empty');
    //         }else{
    //             $new = explode('?', $_SERVER['REQUEST_URI']);
    //             if (strcmp($new[1], 'n=t') == 0) {
    //                 unset($_SESSION['search_params']);
    //             }else if (isset($_SESSION['search_params'])) {
    //                 $cookie = stripslashes($_SESSION['search_params']);
    //                 $savedCardArray = json_decode($cookie, true);
    //                 $this->_view->set('search_params',  $savedCardArray);
    //             }
    //             return $this->_view->output();
    //         }
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_keep_signal($type = null)
    // {
    //     try {
    //         $search_params = array();
    //         if (isset($_POST)) {
    //             foreach($_POST as $key=>$value) {
    //                 $search_params[$key] = $value;
    //             }
    //         }

    //         $res = $this->_model->searchKeepSignal($_POST);
    //         $data = json_encode($res);
    //         if($type){
    //             if($res){
    //                 $response['status'] = true;
    //                 $response['data'] = $res;
    //             }else{
    //                 $response['status'] = false;
    //             }
    //             echo json_encode($response);die;
    //         }
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $_SESSION['search_params'] = $this->encodeParams($search_params);
    //         $this->_view->set('navigationItem',$this->Lang->keep_signal);
    //         $this->_model->logging('smp_search','keep_signal');
    //         return $this->_view->output();
    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    public function simple_search_objects_relation(Request $request, $lang, $type = null)
    {
        try {
           // $this->_view->set('navigationItem',$this->Lang->relationship_objects);
            if($type){
                // $this->_view->set('type',$type);
                // return $this->_view->output('empty');
                return view('simplesearch.simple_search_objects_relation')->with('type', $type);
            }else{
                $new = explode('?', $request->getRequestUri());
                if (strcmp($new[1], 'n=t') == 0) {
                   // unset($_SESSION['search_params']);
                    Session::forget('search_params');
                }else if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                   // $savedCardArray = json_decode($cookie, true);
                   // $this->_view->set('search_params',  $savedCardArray);
                   $search_params = json_decode($cookie, true);

                   return view('simplesearch.simple_search_objects_relation',compact('search_params'));
                }
                return view('simplesearch.simple_search_objects_relation');
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_objects_relation(Request $request, $lang, $type = null)
    {
        try {
            $search_params = array();
            $post = $request->all();
            if (isset($post)) {
                foreach($post as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }

            $res = $this->simpleSearchModel->searchObjectsRelation($post);
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            // $this->_view->set('data',$data);
            // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));
            //$this->_view->set('navigationItem',$this->Lang->relationship_objects);
            //$this->simpleSearchModel->logging('smp_search','object_relation');

            // return $this->_view->output();

            return view('simplesearch.result_objects_relation', compact('data'));


        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_bibliography(Request $request, $lang, $type = null)
    {
        try {
            $users = $this->simpleSearchModel->getUsers();
            //$this->_view->set('users',$users);
           // $this->_view->set('navigationItem',$this->Lang->bibliography);

            if($type){
              //  $this->_view->set('type',$type);
              //  return $this->_view->output('empty');
              return view('simplesearch.simple_search_bibliography',compact('type','users'));
            }else{
               //$this->_view->set('type',$type);
                $new = explode('?', $request->getRequestUri());
                if (strcmp($new[1], 'n=t') == 0) {
                   // unset($_SESSION['search_params']);
                   Session::forget('search_params');
                }else if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                   // $savedCardArray = json_decode($cookie, true);
                   $search_params = json_decode($cookie, true);

                   //$this->_view->set('search_params',  $savedCardArray);
                   return view('simplesearch.simple_search_bibliography',compact('search_params','users'));
                }
                //return $this->_view->output();
                return view('simplesearch.simple_search_bibliography',compact('type','users'));
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_bibliography(Request $request, $lang, $type = null)
    {
        try {
            $search_params = array();
            $post = $request->all();
            if (isset($post)) {
                foreach($post as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($request['content']) && trim($request['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files)){
                $res = $this->simpleSearchModel->searchBibliography($post, false, $files);
            } elseif ($files_flag){
                $res = $this->simpleSearchModel->searchBibliography($post, true);
            } else {
                $res = $this->simpleSearchModel->searchBibliography($post);
            }

            if($type) {
                if ($res) {
                    $response['status'] = true;
                    $response['data'] = $res;
                } else {
                    $response['status'] = false;
                }
                echo json_encode($response);
                die;
            }

            $data = json_encode($res);
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            //$this->_view->set('data',$data);
           // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));
            // $this->_view->set('navigationItem',$this->Lang->bibliography);
            // $this->_model->logging('smp_search','bibliography');
            return view('simplesearch.result_bibliography', compact('data'));
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

    // public function backEscapedValues($string) {
    //     $match = array('\\', '+', '-', '&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '?', ':', '"', ';', '*');
    //     $replace = array('\\\\', '\\+', '\\-', '\\&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\?', '\\:', '\\"', '\\;', '\\*');
    //     $string = str_replace($replace, $match, $string);

    //     return $string;
    // }

    public function simple_search_external_signs($type = null)
    {
        dd(1115);
        try {
            $users = $this->_model->getUsers();
            $this->_view->set('users',$users);
            $this->_view->set('navigationItem',$this->Lang->external_signs);
            if($type){
                $this->_view->set('type',$type);
                return $this->_view->output('empty');
            }else{
                $new = explode('?', $_SERVER['REQUEST_URI']);
                if (strcmp($new[1], 'n=t') == 0) {
                    unset($_SESSION['search_params']);
                }else if (isset($_SESSION['search_params'])) {
                    $cookie = stripslashes($_SESSION['search_params']);
                    $savedCardArray = json_decode($cookie, true);
                    $this->_view->set('search_params',  $savedCardArray);
                }
                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_external_signs(Request $request, $type = null)
    {

        try {
            $search_params = array();
            if (isset($_POST)) {
                foreach($_POST as $key=>$value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($_POST['content']) && trim($_POST['content']) != '') {

                $files_flag = true;
                $files = $this->solrSearch($_POST['content']);
            }
            if(isset($files)){

                $res = $this->simpleSearchModel->searchExternalSigns($_POST, false, $files);
            } elseif ($files_flag){

                $res = $this->simpleSearchModel->searchExternalSigns($_POST, true);
            } else {

                $res = $this->simpleSearchModel->searchExternalSigns($_POST);
            }
            $data = json_encode($res);
            if($type){
                if($res){
                    $response['status'] = true;
                    $response['data'] = $res;
                }else{
                    $response['status'] = false;
                }
                echo json_encode($response);die;
            }
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            // $this->_view->set('data',$data);
            $_SESSION['search_params'] = $this->encodeParams($search_params);
            // $this->_view->set('navigationItem',$this->Lang->external_signs);
            // $this->_model->logging('smp_search','external_sign');
            // return $this->_view->output();
            return view('simplesearch.result_external_signs', compact('data'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function solrSearch($content) {
        $content = $this->escapeSolrValue($content);
        $q = "";

        if (strpos($content, '\+')) {
            $q .= '"' . (str_replace('\+', ' ', $content)) . '"';
        }
        elseif (strpos($content, " ") > 0) {
            $word = (explode(' ', $content));
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
            $q = $content;
        }

        $url = SOLR_URL . "select?indent=on&wt=json&fl=id&rows=10000&q=attr_content:" . urlencode($q);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result=curl_exec ($ch);
        curl_close ($ch);

        $result_json = json_decode($result, true);

        $files = null;
        foreach ($result_json['response']['docs'] as $doc ) {
            $files[] = $doc['id'];
        }

        return $files;
    }

    public function encodeParams($search_params) {
        $encoded = json_encode($search_params);
        $unescaped = preg_replace_callback('/\\\\u(\w{4})/', function ($matches) {
            return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
        }, $encoded);

        return $unescaped;
    }

    // function format_phone($phone)
    // {
    //     $numbers = array();
    //     $phone = preg_replace("/[^0-9]/", "", $phone);

    //     if(strlen($phone) == 9) {
    //         array_push($numbers, preg_replace("/([0-9]{5})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{5})([0-9]{2})([0-9]{2})/", "$1-$2-$3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2-$3-$4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2 $3 $4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1 $2/ $3-$4-$5", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1-$2/ $3-$4-$5", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1-$2/ $3 $4 $5", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1 $2/ $3 $4 $5", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "/$1/ $2", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "($1) $2", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "$1 $2", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4 $5", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3-$4-$5", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{9})/", "$1", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2-$3-$4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3-$4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1) $2-$3-$4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1) $2 $3 $4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1 $2) $3-$4-$5", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1-$2) $3-$4-$5", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1 $2) $3 $4 $5", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1-$2) $3 $4 $5", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2 $3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2-$3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1-$2-$3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "($1) $2-$3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "($1) $2 $3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "/$1/ $2-$3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "/$1/ $2 $3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1 $2) $3 $4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1 $2/ $3-$4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1 $2/ $3 $4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1-$2/ $3 $4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1-$2/ $3-$4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1-$2) $3 $4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1 $2) $3-$4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1-$2) $3-$4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "$1 $2 $3 $4", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "$1 $2 $3-$4", $phone));
    //     }

    //     return $numbers;
    // }

    // function format_phone_home($phone)
    // {
    //     $numbers = array();
    //     $phone = preg_replace("/[^0-9]/", "", $phone);

    //     if(strlen($phone) == 6) {
    //         array_push($numbers, preg_replace("/([0-9]{6})/", "$1", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})/", "$1 $2", $phone));
    //         array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})/", "$1-$2", $phone));
    //     }

    //     return $numbers;
    // }


}
