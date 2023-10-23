<?php

namespace App\Services\SimpleSearch;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

interface ISimpleSearch
{
    public function simple_search_for_data(
        Request $request,
        $lang,
        $type,
        string $view_name
        ): View;

    public function result_for_data(
        Request $request,
        $lang,
        $type,
        string $view_name,
        string $action_model,
        string $tb_name,
        string $search_type
        ): View;


}
