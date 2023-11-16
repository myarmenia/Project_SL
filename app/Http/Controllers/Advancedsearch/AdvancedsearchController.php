<?php

namespace App\Http\Controllers\Advancedsearch;

use App\Http\Controllers\Controller;
use App\Services\AdvancedSearch\AdvancedSearchService;
use Exception;
use Illuminate\Http\Request;

class AdvancedsearchController extends Controller
{

    private $advancedSearchService;

    public function __construct(AdvancedSearchService $advancedSearchService)
    {
        $this->advancedSearchService = $advancedSearchService;

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
    }

    public function index($lang, $first_page = 1)
    {
        try {
            return view('advancedsearch.index')->with('first_page', $first_page);

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function keep_signal()
    {
        return $this->advancedSearchService->advanced_search_for_data('keep_signal');
    }

    public function result_keep_signal(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_keep_signal',
            'searchKeepSignal',
            'keep_signal',
        );
        // try {
        //     $data = json_encode($this->_model->searchKeepSignal($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->keep_signal);
        //     $this->_model->logging('adv_search','keep_signal');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function bibliography()
    {
        return $this->advancedSearchService->advanced_search_for_data('bibliography');
    }

    public function result_bibliography(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_bibliography',
            'searchBibliography',
            'bibliography',
        );
        // try {
        //     $data = json_encode($this->_model->searchBibliography($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->bibliography);
        //     $this->_model->logging('adv_search','bibliography');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function man()
    {
        return $this->advancedSearchService->advanced_search_for_data('man');
    }

    public function result_man(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_man',
            'searchMan',
            'man',
        );

        // try {
        //     $data = json_encode($this->_model->searchMan($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->face);
        //     $this->_model->logging('adv_search','man');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function external_sign()
    {
        return $this->advancedSearchService->advanced_search_for_data('external_sign');
    }

    public function result_external_sign(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_external_sign',
            'searchExternalSign',
            'external_sign',
        );

        // try {
        //     $data = json_encode($this->_model->searchExternalSign($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->external_signs);
        //     $this->_model->logging('adv_search','external_sign');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function phone()
    {
        return $this->advancedSearchService->advanced_search_for_data('phone');
    }

    public function result_phone(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_phone',
            'searchPhone',
            'phone',
        );

        // try {
        //     $data = json_encode($this->_model->searchPhone($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->telephone);
        //     $this->_model->logging('adv_search','phone');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function email()
    {
        return $this->advancedSearchService->advanced_search_for_data('email');
    }

    public function result_email(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_email',
            'searchEmail',
            'email',
        );

       /* try {
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
        } */
    }

    public function weapon()
    {
        return $this->advancedSearchService->advanced_search_for_data('weapon');
    }

    public function result_weapon(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_weapon',
            'searchWeapon',
            'weapon',
        );

        // try {
        //     $data = json_encode($this->_model->searchWeapon($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->weapon);
        //     $this->_model->logging('adv_search','weapon');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function car()
    {
        return $this->advancedSearchService->advanced_search_for_data('car');
    }

    public function result_car(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_car',
            'searchCar',
            'car',
        );

        // try {
        //     $data = json_encode($this->_model->searchCar($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->car);
        //     $this->_model->logging('adv_search','car');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function address()
    {
        return $this->advancedSearchService->advanced_search_for_data('address');
    }

    public function result_address(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_address',
            'searchAddress',
            'address',
        );

        // try {
        //     $data = json_encode($this->_model->searchAddress($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->address);
        //     $this->_model->logging('adv_search','address');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function work_activity()
    {
        return $this->advancedSearchService->advanced_search_for_data('work_activity');
    }

    public function result_work_activity(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_work_activity',
            'searchWorkActivity',
            'organization_has_man',
        );

        // try {
        //     $data = json_encode($this->_model->searchWorkActivity($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->work_activity);
        //     $this->_model->logging('adv_search','organization_has_man');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function man_bean_country()
    {
        return $this->advancedSearchService->advanced_search_for_data('man_bean_country');
    }

    public function result_man_bean_country(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_man_bean_country',
            'searchManBeanCountry',
            'man_bean_country',
        );

        // try {
        //     $data = json_encode($this->_model->searchManBeanCountry($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->man_bean_country);
        //     $this->_model->logging('adv_search','man_bean_country');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function objects_relation()
    {
        return $this->advancedSearchService->advanced_search_for_data('objects_relation');
    }

    public function result_objects_relation(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_objects_relation',
            'searchObjectsRelation',
            'object_relation',
        );

        // try {
        //     $data = json_encode($this->_model->searchObjectsRelation($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->relationship_objects);
        //     $this->_model->logging('adv_search','object_relation');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        //}
    }

    public function action()
    {
        return $this->advancedSearchService->advanced_search_for_data('action');
    }

    public function result_action(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_action',
            'searchAction',
            'action',
        );

        // try {
        //     $data = json_encode($this->_model->searchAction($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->action);
        //     $this->_model->logging('adv_search','action');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function control()
    {
        return $this->advancedSearchService->advanced_search_for_data('control');
    }

    public function result_control(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_control',
            'searchControl',
            'control',
        );

        // try {
        //     $data = json_encode($this->_model->searchControl($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->control);
        //     $this->_model->logging('adv_search','control');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function event()
    {
        return $this->advancedSearchService->advanced_search_for_data('event');
    }

    public function result_event(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_event',
            'searchEvent',
            'event',
        );

        // try {
        //     $data = json_encode($this->_model->searchEvent($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->event);
        //     $this->_model->logging('adv_search','event');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function signal()
    {
        return $this->advancedSearchService->advanced_search_for_data('signal');
    }

    public function result_signal(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_signal',
            'searchSignal',
            'signal',
        );

        // try {
        //     $data = json_encode($this->_model->searchSignal($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->signal);
        //     $this->_model->logging('adv_search','signal');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function organization()
    {
        return $this->advancedSearchService->advanced_search_for_data('organization');
    }

    public function result_organization(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_organization',
            'searchOrganization',
            'organization',
        );

        // try {
        //     $data = json_encode($this->_model->searchOrganization($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->organization);
        //     $this->_model->logging('adv_search','organization');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function mia_summary()
    {
        return $this->advancedSearchService->advanced_search_for_data('mia_summary');
    }

    public function result_mia_summary(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_mia_summary',
            'searchMiaSummary',
            'mia_summary',
        );

        // try {
        //     $data = json_encode($this->_model->searchMiaSummary($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->mia_summary);
        //     $this->_model->logging('adv_search','mia_summary');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }

    public function criminal_case()
    {
        return $this->advancedSearchService->advanced_search_for_data('criminal_case');
    }

    public function result_criminal_case(Request $request)
    {
        return $this->advancedSearchService->result_advanced_for_data(
            $request,
            'result_criminal_case',
            'searchCriminalCase',
            'criminal_case',
        );

        // try {
        //     $data = json_encode($this->_model->searchCriminalCase($_POST));
        //     $data = str_replace('""' , '" "' , $data);
        //     $data = addslashes($data);
        //     $this->_view->set('data',$data);
        //     $this->_view->set('navigationItem',$this->Lang->criminal_case);
        //     $this->_model->logging('adv_search','criminal_case');
        //     return $this->_view->output();

        // } catch (Exception $e) {
        //     echo "Application error:" . $e->getMessage();
        // }
    }


}
