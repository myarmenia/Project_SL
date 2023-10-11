<?php

namespace App\Http\Controllers\Advancedsearch;

use App\Http\Controllers\Controller;
use App\Models\Man\Man;
use App\Models\ModelInclude\AdvancedsearchModel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AdvancedsearchController extends Controller
{
    // public function index(){


    //     return view('advancedsearch.index');
    // }

    // public function bibliography(){
    //     return view('advancedsearch.bibliography');

    // }

    // public function simple_search_bibliography(){
    //     return view('simplesearch.result_bibliography');

    // }

    // public function simple_search(){
    //     return view('simplesearch.simple_search');

    // }
    // public function simple_search_man(){
    //     return view('simplesearch.simple_search_man');


    // }

    // public function simple_search_external_signs(){
    //     return view('simplesearch.simple_search_external_signs');

    // }

    // public function simple_search_email(){
    //     return view('simplesearch.simple_search_email');

    // }

    // =====================================
    // ========================================
    public $advancedSearchModel;

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

        $this->advancedSearchModel = new AdvancedsearchModel();
    }

    // public function index()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->complex_search);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function keep_signal()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->keep_signal);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_keep_signal()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchKeepSignal($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->keep_signal);
    //         $this->_model->logging('adv_search','keep_signal');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function bibliography()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->bibliography);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_bibliography()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchBibliography($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->bibliography);
    //         $this->_model->logging('adv_search','bibliography');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function man()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->face);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_man()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchMan($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->face);
    //         $this->_model->logging('adv_search','man');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function external_sign()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->external_signs);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_external_sign()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchExternalSign($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->external_signs);
    //         $this->_model->logging('adv_search','external_sign');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function phone()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->telephone);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_phone()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchPhone($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->telephone);
    //         $this->_model->logging('adv_search','phone');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    public function email()
    {
        try {
            // $this->_view->set('navigationItem',$this->Lang->email);
            // return $this->_view->output();
            return view('advancedsearch.email');


        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_email()
    {

        try {
            $data = json_encode($this->advancedSearchModel->searchEmail($_POST));
            $data = str_replace('""' , '" "' , $data);
            $data = addslashes($data);
            // $this->_view->set('data',$data);
            // $this->_view->set('navigationItem',$this->Lang->email);
            // $this->advancedSearchModel->logging('adv_search','email');
            // return $this->_view->output();
            return view('advancedsearch.result_email', compact('data'));


        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    // public function weapon()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->weapon);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_weapon()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchWeapon($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->weapon);
    //         $this->_model->logging('adv_search','weapon');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function car()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->car);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_car()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchCar($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->car);
    //         $this->_model->logging('adv_search','car');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function address()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->address);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_address()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchAddress($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->address);
    //         $this->_model->logging('adv_search','address');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function work_activity()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->work_activity);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_work_activity()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchWorkActivity($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->work_activity);
    //         $this->_model->logging('adv_search','organization_has_man');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function man_bean_country()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->man_bean_country);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_man_bean_country()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchManBeanCountry($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->man_bean_country);
    //         $this->_model->logging('adv_search','man_bean_country');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function objects_relation()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->relationship_objects);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_objects_relation()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchObjectsRelation($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->relationship_objects);
    //         $this->_model->logging('adv_search','object_relation');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function action()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->action);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_action()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchAction($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->action);
    //         $this->_model->logging('adv_search','action');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function control()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->control);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_control()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchControl($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->control);
    //         $this->_model->logging('adv_search','control');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function event()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->event);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_event()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchEvent($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->event);
    //         $this->_model->logging('adv_search','event');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function signal()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->signal);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_signal()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchSignal($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->signal);
    //         $this->_model->logging('adv_search','signal');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function organization()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->organization);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_organization()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchOrganization($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->organization);
    //         $this->_model->logging('adv_search','organization');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function mia_summary()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->mia_summary);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_mia_summary()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchMiaSummary($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->mia_summary);
    //         $this->_model->logging('adv_search','mia_summary');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function criminal_case()
    // {
    //     try {
    //         $this->_view->set('navigationItem',$this->Lang->criminal_case);
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }

    // public function result_criminal_case()
    // {
    //     try {
    //         $data = json_encode($this->_model->searchCriminalCase($_POST));
    //         $data = str_replace('""' , '" "' , $data);
    //         $data = addslashes($data);
    //         $this->_view->set('data',$data);
    //         $this->_view->set('navigationItem',$this->Lang->criminal_case);
    //         $this->_model->logging('adv_search','criminal_case');
    //         return $this->_view->output();

    //     } catch (Exception $e) {
    //         echo "Application error:" . $e->getMessage();
    //     }
    // }


}
