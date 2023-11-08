<?php

namespace App\Services\AdvancedSearch;

use Exception;
use Illuminate\Http\Request;
use App\Services\Log\LogService;
use Illuminate\Contracts\View\View;
use App\Models\ModelInclude\AdvancedsearchModel;
use App\Services\AdvancedSearch\IAdvancedSearch;

class AdvancedSearchService implements IAdvancedSearch
{
    const ADVANSED_SEARCH = 'advancedsearch';

    public $advancedSearchModel;

    public function __construct(AdvancedsearchModel $advancedSearchModel) {

        $this->advancedSearchModel = $advancedSearchModel;
    }

    public function advanced_search_for_data(string $view_name ): View
    {
        try {
            // $this->_view->set('navigationItem',$this->Lang->keep_signal);
            // return $this->_view->output();

            return view( self::ADVANSED_SEARCH.'.'.$view_name);

         } catch (Exception $e) {
             echo "Application error:" . $e->getMessage();
         }

    }

    public function result_advanced_for_data(
        Request $request,
        string $view_name,
        string $action_model,
        string $tb_name,
        ): View
        {
            try {
                $data = json_encode($this->advancedSearchModel->$action_model($request->post()));
                $data = str_replace('""' , '" "' , $data);
                $data = addslashes($data);
                // $this->_view->set('data',$data);
                // $this->_view->set('navigationItem',$this->Lang->keep_signal);
                LogService::store($request->post(), null, $tb_name, 'adv_search' );
                // $this->_model->logging('adv_search','keep_signal');
                // $this->_view->output();

                return view(self::ADVANSED_SEARCH.'.'.$view_name, compact('data'));

            } catch (Exception $e) {
                echo "Application error:" . $e->getMessage();
            }
        }

}

