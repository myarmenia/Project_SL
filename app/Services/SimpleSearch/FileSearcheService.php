<?php

namespace App\Services\SimpleSearch;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\File\FileText;
use App\Traits\FullTextSearch;
use App\Services\Log\LogService;
use App\Services\LearningSystemService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\ModelInclude\SimplesearchModel;

class FileSearcheService
{
    use FullTextSearch;

    const SIMPLE_SEARCH = 'simplesearch';

    public $simpleSearchModel;
    private $learningSystemService;

    public function __construct(LearningSystemService $learningSystemService) {

        $this->learningSystemService =$learningSystemService;
        $this->simpleSearchModel = new SimplesearchModel;
    }

    public function escapeSolrValue($string)
    {
        $match = array('\\', '+', '-', '&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '?', ':', '"', ';');
        $replace = array('\\\\', '\\+', '\\-', '\\&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\?', '\\:', '\\"', '\\;');
        $string = str_replace($match, $replace, $string);

        return $string;
    }

    function getText(string $text,array $words )
    {
        $texts = explode($words[0], $text);
        foreach ($texts as $text) {
            if ($text != "") {
              yield Str::before($text,$words[1]);
            }
        }

    }

    function explodString(string $str): array
    {
        $output = preg_replace('!\s+!', ' ',$str);
        return explode(" ", $output);
    }

    public function searchBetweenWords(string $data, int $wordCount, bool $revers_word)
    {
        $word = $this->explodString($data);

        if (count($word) == 2) {

            $patterns = collect($word)->map(function ($pat) {

                return "/($pat)/iu";

            })->toArray();

            $replacements = collect($word)->map(function ($rep) {

                return "<u>".Str::lower($rep)."</u>";

            })->toArray();

            $revers_word ? $word : $word = array_reverse($word);
            $datas = FileText::whereRaw('1=1 '.$this->search(['content,search_string'], preg_replace('!\s+!', ' ', $data), 1))
                       ->get(['file_id','content','search_string','status']);
            $files = [];
            foreach ($datas as $data) {

                $text =  preg_replace($patterns, $replacements, $data->content);
                $slice = Str::between($data->content, $word[0], $word[1]);

                foreach ($this->getText($slice , [$word[0], $word[1]]) as $value) {
                   if (count($this->explodString(trim($value))) == $wordCount) {

                        $files[] = $files[] = array(
                            'bibliography' => $data->file->bibliography,
                            'file_id' => $data->file->id,
                            'status' => $data->status,
                            'file_info' => $data->file->real_name,
                            'file_path' => $data->file->path,
                            'find_word' => Arr::whereNotNull(collect($word)->map(function ($pat) use($text) {

                                $new_text = Str::replace(
                                    "<u>".Str::lower($pat)."</u>",
                                     '-----'."<u>".Str::lower($pat)."</u>", $text);
                                if (Str::of($new_text)->contains(Str::lower($pat))) {

                                    return Str::of($new_text)->explode('-----');
                                }


                            })->toArray()),
                            'file_text' => $text,

                        );

                   }
                }

            }

        }
        if (isset($files))
        {
            return collect($files)->unique('file_id')->toArray() ?? '';
        }else{
            return [];
        }


    }

    function getDataOfContent(string  $string)
    {
        yield from explode(' ', $string);
    }

    function searchSimilary(int $distance, array $trans)
    {

        $files = [];
        FileText::with('file')->orderBy('file_id')->chunk(100, function ($datas) use (&$files, $distance, $trans) {
            $patterns = [];
            $replacements = [];
            $simpleWords = [];

            foreach ($datas as $data) {

                $string = preg_replace('/\s+/', ' ', $data->content);
                foreach ($this->getDataOfContent($string) as $word) {
                    foreach ($trans as  $value) {
                        $lev = levenshtein($value, $word);
                        if ($lev <= $distance) {
                                if ($data->file->bibliography->isNotEmpty())
                                {
                                    $patterns[] = Str::lower("/($word)/iu");
                                    $replacements[] = "<u>".Str::lower($word)."</u>";
                                    $simpleWords[] = $word;
                                }
                        }
                    }
                }

            }
            /*-------------*/
            foreach ($datas as $data) {

                $string = preg_replace('/\s+/', ' ', $data->content);
                foreach ($this->getDataOfContent($string) as $word) {
                    foreach ($trans as  $value) {
                        $lev = levenshtein($value, $word);
                        if ($lev <= $distance) {
                                if ($data->file->bibliography->isNotEmpty())
                                {
                                    $text =  preg_replace(array_unique($patterns), array_unique($replacements),  Str::lower($data->content));
                                    $files[] = array(
                                        'bibliography' => $data->file->bibliography,
                                        'file_id' => $data->file->id,
                                        'status' => $data->status,
                                        'file_info' => $data->file->real_name,
                                        'file_path' => $data->file->path,
                                        'find_word' => Arr::whereNotNull(collect(array_unique($simpleWords))->map(function ($pat) use($text) {

                                            $new_text = Str::replace(
                                                "<u>".Str::lower($pat)."</u>",
                                                 '-----'."<u>".Str::lower($pat)."</u>", $text);
                                            if (Str::of($new_text)->contains(Str::lower($pat))) {

                                                return Str::of($new_text)->explode('-----');
                                            }


                                        })->toArray()),
                                        'file_text' => $text,

                                    );
                                }
                            break;
                        }
                    }
                }

            }

        });



        if (isset($files))
        {
            return collect($files)->unique('file_id')->toArray() ?? '';
        }else{
            return [];
        }


    }

    function findFileIds($content, ?string $phone = null): array
    {

        $result = FileText::whereRaw("1=1 AND MATCH (content,search_string) AGAINST ('$content' IN BOOLEAN MODE)")
                  ->get(['file_id','content','search_string','status']);

            if (intval($phone) > 0)
            {
                if ($result->isNotEmpty())
                {
                    foreach ($result as $doc)
                    {
                            if ($doc->file->bibliography->isNotEmpty())
                            {
                                $text = $doc->content;
                                            $files[] = array(
                                                'bibliography' => $doc->file->bibliography,
                                                'file_id' => $doc->file->id,
                                                'status' => $doc->status,
                                                'file_info' => $doc->file->real_name,
                                                'file_path' => $doc->file->path,
                                                'find_word' => Arr::whereNotNull(collect($this->phone($phone))->map(function ($pat) use($text) {

                                                    $new_text = Str::replace($pat,'-----'."<u>".$pat."</u>", $text);

                                                    if (Str::of($new_text)->contains($pat)) {

                                                        return Str::of($new_text)->explode('-----');
                                                    }


                                                })->toArray()),
                                                'file_text' => $text,
                                            );
                            }
                    }
                }

                if (isset($files)) {
                    return  collect($files)->unique('file_id')->toArray();
                }else{

                    return [];
                }


            }


            $reservedSymbols = ['*','-', '+','(', ')','"'];

            $term = str_replace($reservedSymbols, '', $content);

            $trans = explode(' ',$term);

            $patterns = collect($trans)->map(function ($pat) {

                return "/($pat)/iu";

            })->toArray();

            $replacements = collect($trans)->map(function ($rep) {

                return "<u>".Str::lower($rep)."</u>";

            })->toArray();


            if ($result->isNotEmpty())
            {
                foreach ($result as $doc)
                {
                        $text =  preg_replace($patterns, $replacements, $doc->content);

                        if ($doc->file->bibliography->isNotEmpty())
                        {
                                        $files[] = array(
                                            'bibliography' => $doc->file->bibliography,
                                            'file_info' => $doc->file->real_name,
                                            'status' => $doc->status,
                                            'file_path' => $doc->file->path,
                                            'find_word' => Arr::whereNotNull(collect($trans)->map(function ($pat) use($text) {

                                                $new_text = Str::replace(
                                                    "<u>".Str::lower($pat)."</u>",
                                                     '-----'."<u>".Str::lower($pat)."</u>", $text);
                                                if (Str::of($new_text)->contains(Str::lower($pat))) {

                                                    return Str::of($new_text)->explode('-----');
                                                }

                                            })->toArray()),
                                            'file_text' => $text

                                        );
                        }
                }
           }

        return $files ?? [];

    }

    function getFileTextIds(array $files): ?array
    {
        if (isset($files) && !empty($files)) {
            session()->forget('not_find_message');
            return  $files;
        }else{
            return session()->flash('not_find_message', 'Փնտրվող տվյալներով համապատասխանություններ առկա չէն կցված ֆայլերում։');
        }
    }

    public function solrSearch($content, int $distance = 2, ?int $wordCount = null, ?bool $revers_word = true)
    {
        if (isset($wordCount)) {

            if ( is_null($revers_word)) {

                $revers_word = false;
            }
            $data = $this->searchBetweenWords($content, $wordCount, $revers_word);

            return $this->getFileTextIds($data);

        }else{

           // dd($this->date_time_search($content));

            if (intval($content) > 0) {

                    $content = str_replace('+', '', $content);
                    $phones = $this->phone($content);
                    $searchPhones = '"'.(implode('" "', $phones)).'"';
                    $ids = $this->findFileIds($searchPhones,$content);

                    return $this->getFileTextIds($ids);
            }

            if (Str::contains($content, ['+', '-','*','(',')','"'])) {

                $searchTrans = $content;
            }else{

                $trans = $this->learningSystemService->get_info($content);
                $searchTrans = implode(" ", $trans);
            }

            if ($distance == 1) {

                $ids = $this->findFileIds($searchTrans);

                return $this->getFileTextIds($ids);

            }else{

                $distance = $distance+1;
                $files = $this->searchSimilary($distance,$trans);

                return $this->getFileTextIds($files);
            }
        }

        // $content = $this->escapeSolrValue($content);
        // $q = "";

        // if (strpos($content, '\+')) {
        //     $q .= '"' . (str_replace('\+', ' ', $content)) . '"';
        // } elseif (strpos($content, " ") > 0) {
        //     $word = (explode(' ', $content));
        //     $keys = array_keys($word);
        //     foreach ($word as $key => $value) {
        //         if (trim($value) != '') {
        //             $value = trim($value);
        //             $length = strlen($value);
        //             $value = trim($value);
        //             if ($length == 9 && intval($value) > 0) {
        //                 $phones = $this->format_phone($value);
        //                 $i = 0;
        //                 foreach ($phones as $phone) {
        //                     $q .= "\"" . $phone . "\"";
        //                     if (sizeof($phones) - 1 != $i) {
        //                         $q .= "OR";
        //                     }
        //                     $i++;
        //                 }
        //             } elseif ($length == 6 && intval($value) > 0) {
        //                 $phones = $this->format_phone_home($value);
        //                 $i = 0;
        //                 foreach ($phones as $phone) {
        //                     $q .= "\"" . $phone . "\"";
        //                     if (sizeof($phones) - 1 != $i) {
        //                         $q .= "OR";
        //                     }
        //                     $i++;
        //                 }
        //             } else {
        //                 $q .= "(" . str_replace('\*', '*', $value) . ")";
        //             }
        //         }
        //         if ($key != end($keys)) {
        //             $q .= "OR";
        //         }
        //     }
        // } else {
        //     $q = $content;
        // }

        // $url = SOLR_URL . "select?indent=on&wt=json&fl=id&rows=10000&q=attr_content:" . urlencode($q);

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        // $result = curl_exec($ch);
        // curl_close($ch);

        // $result_json = json_decode($result, true);

        // $files = null;
        // foreach ($result_json['response']['docs'] as $doc) {
        //     $files[] = $doc['id'];
        // }

        // return $files;
    }

    function date_time_search($content)
    {

        if (trim($content) != '')
        {
            $value = trim($content);
            $length = strlen($value);
            if ($length == 8) {

                $data = $this->format_date_time($value);

            }
        }

        return $data;
    }

    function phone($content)
    {
        if (trim($content) != '')
        {
            $value = trim($content);
            $length = strlen($value);
            $value = trim($value);
            if ($length == 9 && intval($value) > 0)
            {
                $phones = $this->format_phone($value);

            }elseif ($length == 6 && intval($value) > 0) {

                $phones = $this->format_phone_home($value);

            }elseif ($length == 11 && intval($value) > 0){
                $phones = $this->format_inter_phone($value);
            }
        }

        return $phones ?? [];

    }



    public function encodeParams($search_params)
    {
        $encoded = json_encode($search_params);
        $unescaped = preg_replace_callback('/\\\\u(\w{4})/', function ($matches) {
            return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
        }, $encoded);

        return $unescaped;
    }

    function format_date_time($date_time)
    {
        $numbers = array();
        $phone = preg_replace("/[^0-9]/", "", $date_time);

        if(strlen($date_time) == 8) {
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1-$2-$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2 $4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/-$2-$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1/$2/$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1.$2.$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2.$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1.$2-$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1/$2-$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2/$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "/$1/$2/$3/", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1/$2/$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1.$2.$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", ".$1.$2.$3.", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1.$2/$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1/$2.$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "-$1-$2-$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1-$2/$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1/$2-$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1 $2 $3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1.$2 $3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1/$2 $3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1.$2/$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1.$2-$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1-$2.$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1-$2.$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{4})/", "$2.$4-$5", $date_time));
            array_push($numbers, preg_replace("/([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{4})/", "$2.$4/$5", $date_time));
            array_push($numbers, preg_replace("/([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{4})/", "$2/$4/$5", $date_time));
            array_push($numbers, preg_replace("/([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{4})/", "$2/$4/$5", $date_time));
            array_push($numbers, preg_replace("/([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{4})/", "$2.$4.$5", $date_time));
            array_push($numbers, preg_replace("/([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{4})/", "$2/$4.$5", $date_time));
            array_push($numbers, preg_replace("/([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{1,1})([0-9]{4})/", "$2/$4-$5", $date_time));
        }

        return $numbers;
    }

    function format_inter_phone($phone)
    {
        $numbers = array();
        $phone = preg_replace("/[^0-9]/", "", $phone);

        if(strlen($phone) == 11) {
            array_push($numbers, preg_replace("/([0-9]{5})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{5})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2-$3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2 $3 $4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1 $2/ $3-$4-$5-$6", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1-$2/ $3-$4-$5-$6", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1-$2/ $3 $4 $5 $6", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1 $2/ $3 $4 $5 $6", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{8})/", "/$1/ $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{8})/", "($1) $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{8})/", "$1 $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4 $5 $6", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3-$4-$5-$6", $phone));
            array_push($numbers, preg_replace("/([0-9]{11})/", "$1", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2-$3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1) $2-$3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1) $2 $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1 $2) $3-$4-$5-$6", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1-$2) $3-$4-$5-$6", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})(\d{2})/", "($1 $2) $3 $4 $5 $6", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})(\d{2})/", "($1-$2) $3 $4 $5 $6", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "($1) $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "($1) $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "/$1/ $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "/$1/ $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1 $2) $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1 $2/ $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1 $2/ $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1-$2/ $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1-$2/ $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1-$2) $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1 $2) $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1-$2) $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "$1 $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "$1 $2 $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})(\d{2})/", "$1 $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})(\d{2})/", "$1 $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})(\d{2})/", "$1-$2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})(\d{2})/", "($1) $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})(\d{2})/", "($1) $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})(\d{2})/", "/$1/ $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})(\d{2})/", "/$1/ $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})(\d{2})/", "($1 $2) $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})(\d{2})/", "/$1 $2/ $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})(\d{2})/", "/$1 $2/ $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})(\d{2})/", "/$1-$2/ $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})(\d{2})/", "/$1-$2/ $3-$4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})(\d{2})/", "($1-$2) $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})(\d{2})/", "($1 $2) $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})(\d{2})/", "($1-$2) $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})(\d{2})/", "$1 $2 $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})(\d{2})/", "$1 $2 $3-$4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{4})([0-9]{2})/", "$1 $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{4})([0-9]{2})/", "/$1/ $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{4})([0-9]{2})/", "($1) $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{4})([0-9]{2})/", "/$1/-$2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{4})([0-9]{2})/", "($1)-$2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})([0-9]{2})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})([0-9]{2})/", "/$1/ $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})([0-9]{2})/", "($1) $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})([0-9]{2})/", "($1)-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})([0-9]{2})/", "/$1/-$2-$3", $phone));
        }

        return $numbers;
    }


     function format_phone($phone)
    {
        $numbers = array();
        $phone = preg_replace("/[^0-9]/", "", $phone);

        if(strlen($phone) == 9) {
            array_push($numbers, preg_replace("/([0-9]{5})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{5})([0-9]{2})([0-9]{2})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1 $2/ $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1-$2/ $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1-$2/ $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1 $2/ $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "/$1/ $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "($1) $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{6})/", "$1 $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{9})/", "$1", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1) $2-$3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1) $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1 $2) $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1-$2) $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1 $2) $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1-$2) $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1 $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "($1) $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "($1) $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "/$1/ $2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3})/", "/$1/ $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1 $2) $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1 $2/ $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1 $2/ $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1-$2/ $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "/$1-$2/ $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1-$2) $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1 $2) $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "($1-$2) $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "$1 $2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{1})([0-9]{3})([0-9]{3})/", "$1 $2 $3-$4", $phone));
        }

        return $numbers;
    }

    function format_phone_home($phone)
    {
        $numbers = array();
        $phone = preg_replace("/[^0-9]/", "", $phone);

        if(strlen($phone) == 6) {
            array_push($numbers, preg_replace("/([0-9]{6})/", "$1", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})/", "$1 $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})/", "$1-$2", $phone));
        }

        return $numbers;
    }
}
