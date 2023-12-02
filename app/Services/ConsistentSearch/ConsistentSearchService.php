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
     * @param null $fileId
     */
    public static function search($field, $text, $type, $fileId = null)
    {

        $info = self::getConsistentSearches($field);
        $documentUrl = '';
        $documentName = '';
        $find = [];
        if(count( $info ) > 0) {
            if($fileId) {
                $file = File::query()->find($fileId);
                $documentUrl = $file->path;
                $documentName = $file->name;
                $fileText = FileText::where('file_id',$fileId)->first();
                if($fileText) {
                    $text = $fileText->content;
                }
            }
            foreach ($info  as $value) {
                $get = false;
                $haystack = explode(' ', Str::lower($value['search_text']));
                $needles = explode(' ', Str::lower($text));
                foreach ($needles as $needle) {
                    foreach ($haystack as $item) {
                        $success= self::soundExArmenian($needle, $item);
                        if($success) {
                            $get = true;
                        }
                    }
                }
                if($get === true) {
                    $find[]=$value;
                }
            }
        }
        if(count( $find ) > 0) {
            self::sendNotifications($find, Auth::user(), $type, $documentUrl, $documentName);
        }
    }


    /**
     * @param $find
     * @param $auth
     * @param $type
     * @param $documentUrl
     * @param $documentName
     */
    public static function sendNotifications($find, $auth, $type, $documentUrl, $documentName)
    {
        foreach ($find as $item) {
            if($item['user_id'] != $auth->id) {
                self::sender($auth, $item['user_id'], $item['search_text'], $type, $documentUrl, $documentName);
            }
            if($item['consistent_followers']){
                foreach ($item['consistent_followers'] as $value) {
                    if($value['user_id'] != $auth->id) {
                        self::sender($auth, $value['user_id'], $item['search_text'], $type, $documentUrl, $documentName);
                    }
                }
            }
        }
    }


    /**
     * @param $auth
     * @param $userId
     * @param $searchText
     * @param $type
     * @param $documentUrl
     * @param $documentName
     */
    protected static function sender($auth, $userId, $searchText, $type, $documentUrl, $documentName)
    {
        $data = [
            'name' => $auth->first_name .' '. $auth->last_name ,
            'search_text' => $searchText,
            'document_url' => $documentUrl,
            'document_name' => $documentName,
            'type' => $type,
        ];
        $user = User::query()->find($userId);
        Notification::send($user, new ConsistentNotification($data));
    }

    
    /**
     * @param $word1
     * @param $word2
     * @return bool
     */
    public static function soundExArmenian($word1, $word2)
    {
        $word1 = Str::lower($word1);
        $word2 = Str::lower($word2);
        $wordCode1 = self::getCodeSoundEx(strtolower($word1));
        $wordCode2 = self::getCodeSoundEx(strtolower($word2));
        if( $wordCode1 != $wordCode2) {
            return false;
        }
        return true;
    }


    /**
     * @param $word
     * @return array|string
     */
    protected static function getCodeSoundEx($word)
    {
        $substitutions =array(
            "եվ"=>"և",
            "յէ"=>"ե",
            "այ"=>"ա",
            "ոյ"=>"ո",
            "վհ" =>"վ",
            "րհ"=>"ր",
            "նն"=>"ն",
            "բը"=>"բ",
            "գը"=>"գ",
            "դը"=>"դ",
            "զը"=>"զ",
            "թը"=>"թ",
            "ժը"=>"ժ",
            "լը"=>"լ",
            "խը"=>"խ",
            "ծը"=>"ծ",
            "կը"=>"կ",
            "հը"=>"հ",
            "ձը"=>"ձ",
            "ղը"=>"ղ",
            "ճը"=>"ճ",
            "մը"=>"մ",
            "յը"=>"յ",
            "նը"=>"ն",
            "շը"=>"շ",
            "չը"=>"չ",
            "պը"=>"պ",
            "ջը"=>"ջ",
            "ռը"=>"ռ",
            "սը"=>"ս",
            "վը"=>"վ",
            "տը"=>"տ",
            "րը"=>"ր",
            "ցը"=>"ց",
            "փը"=>"փ",
            "քը"=>"ք",
            "ֆը"=>"ֆ",
        );

        foreach ($substitutions as $letter => $substitution) {
            $word = str_replace($letter,$substitution,$word);
        }

        $len=strlen($word);
        $wordNew = preg_split('/(?<!^)(?!$)/u', $word);
        $codingTable=array(
            0=>array("ա"),
            1=>array("ե","է"),
            2=>array("ը"),
            3=>array("ի"),
            4=>array("լ"),
            5=>array("մ"),
            6=>array("յ"),
            7=>array("ն"),
            8=>array("ս"),
            9=>array("ր", "ռ"),
            10=>array("օ", "ո"),
            11=>array("ու"),
            12=>array("և"),
            13=>array("հ"),
            14=>array("բ","պ","փ"),
            15=>array("գ","կ","ք"),
            16=>array("դ","տ","թ"),
            17=>array("ձ","ծ","ց"),
            18=>array("ջ","ճ","չ"),
            19=>array("զ","ս",),
            20=>array("ժ","շ"),
            21=>array("ղ","խ"),
            22=>array("վ","ֆ"),
        );
        for ($i=0;$i<$len;$i++){
            $value[$i]="";

            if ($value[$i]==""){
                foreach ($codingTable as $code=>$letters) {
                    if (isset($wordNew[$i+1]) and in_array($wordNew[$i],$letters)) {
                        $value[$i]=$code;
                    }
                }
            }
        }
        $len=count($value);
        for ($i=1;$i<$len;$i++){
            if ($value[$i]==$value[$i-1]) {
                $value[$i]="";
            }
        }

        for ($i=1;$i>$len;$i++){
            if ($value[$i]==0) {
                $value[$i]="";
            }
        }

        $value=array_filter($value);
        $value=implode("",$value);
        return $value;
    }
}