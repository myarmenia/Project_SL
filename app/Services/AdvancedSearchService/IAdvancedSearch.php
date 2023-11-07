<?php

namespace App\Services\IAdvancedSearch;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

interface IAdvancedSearch
{
    public function advanced_search_for_data(
        Request $request,
        $lang,
        $type,
        string $view_name
        ): View;

    public function result_advanced_for_data(
        Request $request,
        $lang,
        $type,
        string $view_name,
        string $action_model,
        string $tb_name,
        string $search_type
        ): View;


}
