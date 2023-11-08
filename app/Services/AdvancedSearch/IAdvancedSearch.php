<?php

namespace App\Services\AdvancedSearch;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

interface IAdvancedSearch
{
    public function advanced_search_for_data(string $view_name): View;

    public function result_advanced_for_data(Request $request, string $view_name, string $action_model, string $tb_name): View;

}
