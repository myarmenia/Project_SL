<?php

namespace App\Services\ConsistentSearch;


use App\Models\ConsistentSearch;
use Carbon\Carbon;

class ConsistentSearchService
{

    /**
     * @return array
     */
    public static function getForOrganizations()
    {
        $dataNotLibraries = ConsistentSearch::query()->with('consistentFollowers')
           ->whereDoesntHave('consistentLibraries')->whereNull('deadline')
           ->orWhere(function ($q){
                    $q->whereNotNull('deadline')->where('deadline', '>=', Carbon::now());
           });

        $dataWithLibraries = ConsistentSearch::query()->with('consistentFollowers')
            ->whereHas('consistentLibraries', function ($q){
                $q->whereHas('library', function ($q) {
                    $q->where('field', 'organization');
                });
            })
            ->whereNull('deadline')
            ->orWhere(function ($q){
                $q->whereNotNull('deadline')->where('deadline', '>=', Carbon::now());
            })->union($dataNotLibraries)->get()->toArray();

      return $dataWithLibraries;
    }
}