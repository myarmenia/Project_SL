<?php

namespace App\Services\ConsistentSearch;


use App\Models\ConsistentSearch;
use App\Models\User;
use App\Notifications\ConsistentNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ConsistentSearchService
{


    /**
     * @param $field
     * @return array
     */
    public static function getConsistentSearches($field)
    {
        $dataNotLibraries = ConsistentSearch::query()->with('consistentFollowers')
           ->whereDoesntHave('consistentLibraries')->whereNull('deadline')
           ->orWhere(function ($q){
                    $q->whereNotNull('deadline')->where('deadline', '>=', Carbon::now());
           });

        $dataWithLibraries = ConsistentSearch::query()->with('consistentFollowers')
            ->whereHas('consistentLibraries', function ($q) use ($field){
                $q->whereHas('library', function ($q) use ($field) {
                    $q->where('field', $field);
                });
            })
            ->whereNull('deadline')
            ->orWhere(function ($q){
                $q->whereNotNull('deadline')->where('deadline', '>=', Carbon::now());
            })->union($dataNotLibraries)->get()->toArray();

      return $dataWithLibraries;
    }


    /**
     * @param $field
     * @param $text
     */
    public static function search($field, $text)
    {
        $info = ConsistentSearchService::getConsistentSearches($field);
        $find = [];
        if(count( $info ) > 0) {
            foreach ($info  as $value) {
                $get = false;
                $haystack = array_flip(explode(' ', strtolower($value['search_text'])));
                $needles = explode(' ', strtolower($text));
                foreach ($needles as $needle) {
                    if (isset($haystack[$needle])) {
                        $get = true;
                    }
                }
                if($get === true) {
                    $find[]=$value;
                }
            }
        }
        if(count( $find ) > 0) {
            self::sendNotifications($find, Auth::user());
        }
    }


    /**
     * @param $find
     * @param $auth
     */
    public static function sendNotifications($find, $auth)
    {
        foreach ($find as $item) {
            if($item['user_id'] != $auth->id) {
                $data = [
                    'name' => $auth->first_name .' '. $auth->last_name ,
                    'search_text' => $item['search_text'],
                    'document_url' => '',
                    'type' => 'insert'
                ];
                $user = User::query()->find($item['user_id']);
                Notification::send($user, new ConsistentNotification($data));
            }

            if($item['consistent_followers']){
                foreach ($item['consistent_followers'] as $value) {
                    if($value['user_id'] != $auth->id) {
                        $data = [
                            'name' => $auth->first_name .' '. $auth->last_name ,
                            'search_text' => $item['search_text'],
                            'document_url' => '',
                            'type' => 'incoming'
                        ];
                        $user = User::query()->find($value['user_id']);
                        Notification::send($user, new ConsistentNotification($data));
                    }
                }
            }
        }
    }
}