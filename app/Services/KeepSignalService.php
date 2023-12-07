<?php
namespace App\Services;

use App\Models\KeepSignal;
use App\Models\Signal;
use Illuminate\Support\Facades\DB;
class KeepSignalService
{
    public function store($signal_id): int
    {

        return KeepSignal::create(['signal_id'=>$signal_id])->id;
    }

    public function update(object $keepsignal, array $attributes){

        return  ComponentService::update($keepsignal,$attributes);
    }

}

