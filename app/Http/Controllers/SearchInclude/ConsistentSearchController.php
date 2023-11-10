<?php

namespace App\Http\Controllers\SearchInclude;

use App\Http\Controllers\Controller;
use App\Models\ModelInclude\SimplesearchModel;
use App\Services\Log\LogService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\SimpleSearch\SimpleSearcheService;

class ConsistentSearchController extends Controller
{
    public $simpleSearchModel;

    public $simpleSearcheService;

    public function __construct(SimpleSearcheService $simpleSearcheService)
    {
        if (isset($_SESSION['counter'])) {
            $_SESSION['counter'] = $_SESSION['counter'] + 1;
        } else {
            $_SESSION['counter'] = 1;
        }

        $this->simpleSearchModel = new SimplesearchModel;

        $this->simpleSearcheService = $simpleSearcheService;
    }


    /***
     * @param $lang
     * @param int $first_page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function consistentSearch($lang, $first_page = 1)
    {
        try {

            return view('consistent-search.index')->with('first_page', $first_page);
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function simple_search_action(Request $request, $lang, $type = null)
    {
       return $this->simpleSearcheService
                   ->simple_search_for_data($request, $lang, $type,'simple_search_action');

    }

    public function result_action(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->result_for_data(
                        $request,
                        $lang,
                        $type,
                        'result_action',
                        'searchAction',
                        'action',
                        'smp_search');
    }

    public function simple_search_control(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->simple_search_for_data($request, $lang, $type,'simple_search_control');

    }

    public function result_control(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->result_for_data(
                        $request,
                        $lang,
                        $type,
                        'result_control',
                        'searchControl',
                        'control',
                        'smp_search');

    }

    public function simple_search_man(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->simple_search_for_data($request, $lang, $type,'simple_search_man');

    }

    public function result_man(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->result_for_data(
                        $request,
                        $lang,
                        $type,
                        'result_man',
                        'searchMan',
                        'man',
                        'smp_search');

    }

    public function simple_search_weapon(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->simple_search_for_data($request, $lang, $type,'simple_search_weapon');

    }

    public function result_weapon(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->result_for_data(
                        $request,
                        $lang,
                        $type,
                        'result_weapon',
                        'searchWeapon',
                        'weapon',
                        'smp_search');

    }

    public function simple_search_car(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->simple_search_for_data($request, $lang, $type,'simple_search_car');

    }

    public function result_car(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->result_for_data(
                        $request,
                        $lang,
                        $type,
                        'result_car',
                        'searchCar',
                        'car',
                        'smp_search');

    }

    public function simple_search_address(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->simple_search_for_data($request, $lang, $type,'simple_search_address');

    }

    public function result_address(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->result_for_data(
                        $request,
                        $lang,
                        $type,
                        'result_address',
                        'searchAddress',
                        'address',
                        'smp_search');

    }

    public function simple_search_work_activity(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->simple_search_for_data($request, $lang, $type,'simple_search_work_activity');

    }

    public function result_work_activity(Request $request, $lang, $type = null)
    {
        return $this->simpleSearcheService
                    ->result_for_data(
                        $request,
                        $lang,
                        $type,
                        'result_work_activity',
                        'searchWorkActivity',
                        'organization_has_man',
                        'smp_search');

    }

}
