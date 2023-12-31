<?php

namespace App\Services\ConsistentSearch;


use App\Models\ConsistentSearch;
use App\Models\File\File;
use App\Models\File\FileText;
use App\Models\User;
use App\Notifications\ConsistentNotification;
use App\Services\SearchService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class ConsistentSearchService
{
    /**
     * @param $field
     * @return array
     */
    protected static function getConsistentSearches($field)
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
     * @param $type
     * @param $id
     */
    public static function search($field, $text, $type, $id)
    {
        $info = self::getConsistentSearches($field);
        $documentUrl = '';
        $documentName = '';
        $find = [];
        if(count( $info ) > 0) {
            if($type == ConsistentSearch::NOTIFICATION_TYPES['UPLOADING']) {
                $file = File::query()->find($id);
                $documentUrl = $file->path;
                $documentName = $file->name;
                $fileText = FileText::where('file_id',$id)->first();
                if($fileText) {
                    $text = $fileText->content;
                }
            }
            foreach ($info  as $value) {
                $get = false;
                $haystack = explode(' ', Str::lower($value['search_text']));
                $needles = explode(' ', Str::lower($text));
                foreach ($needles as $needle) {
                    if(Str::length($needle) > 0) {
                        foreach ($haystack as $item) {
                            $success= SearchService::soundExArmenian($needle, $item);
                            if($success) {
                                $get = true;
                            }
                        }
                    }
                }
                if($get === true) {
                    $find[]=$value;
                }
            }
        }
        if(count( $find ) > 0) {
            self::sendNotifications($field, $find, Auth::user(), $type, $id, $documentUrl, $documentName);
        }
    }


    /**
     * @param $field
     * @param $find
     * @param $auth
     * @param $type
     * @param $id
     * @param $documentUrl
     * @param $documentName
     */
    public static function sendNotifications($field, $find, $auth, $type, $id, $documentUrl, $documentName)
    {
        foreach ($find as $item) {
                self::sender($field, $auth, $item['user_id'], $item['search_text'], $type, $id, $documentUrl, $documentName);
            if($item['consistent_followers']){
                foreach ($item['consistent_followers'] as $value) {
                     self::sender($field, $auth, $value['user_id'], $item['search_text'], $type, $id, $documentUrl, $documentName);
                }
            }
        }
    }


    /**
     * @param $field
     * @param $auth
     * @param $userId
     * @param $searchText
     * @param $type
     * @param $id
     * @param $documentUrl
     * @param $documentName
     */
    protected static function sender($field, $auth, $userId, $searchText, $type, $id, $documentUrl, $documentName)
    {
        $data = [
            'name' => $auth->first_name .' '. $auth->last_name ,
            'search_text' => $searchText,
            'document_url' => $documentUrl,
            'document_name' => $documentName,
            'type' => $type,
            'id' => $id,
            'field' => $field
        ];
        $user = User::query()->find($userId);
        Notification::send($user, new ConsistentNotification($data));
    }
}