<?php
namespace App\Services;

use App\Models\Controll;
use App\Services\ComponentService;

class ControllService{
    public function store($bibliography_id): int
    {

        return Controll::create(['bibliography_id'=>$bibliography_id])->id;
    }

    public function update(object $controll, array $attributes){

        return  ComponentService::update($controll,$attributes);
    }

}
