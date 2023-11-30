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
use Carbon\Carbon;

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

            $datas = FileText::where(function($query) use ($data) {

                $query->whereFullText(['content','search_string'], preg_replace('!\s+!', ' ', $data), ['mode' => 'boolean'])
                    ->where('status',0);
            })
            ->orWhere('search_string', $data)
            ->orderBy('id','asc')
            ->get();

            $files = [];
            foreach ($datas as $data) {

                $text =  preg_replace($patterns, $replacements, $data->content);
                $slice = Str::between($data->content, $word[0], $word[1]);

                foreach ($this->getText($slice , [$word[0], $word[1]]) as $value) {
                   if (count($this->explodString(trim($value))) == $wordCount) {

                        $files[] = $files[] = array(
                            'bibliography' => $data->file->bibliography ?? '',
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
        FileText::with('file')->orderBy('file_id')
                  ->where('status',0)
                  ->orWhere('search_string', implode(' ', $trans))
                  ->chunk(100, function ($datas) use (&$files, $distance, $trans) {

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
                                    $text =  preg_replace(array_unique($patterns), array_unique($replacements),  Str::lower($data->content));
                                    $files[] = array(
                                        'bibliography' => $data->file->bibliography ?? '',
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

    function findFileIds($content, ?string $data_regex = null): array
    {
        $result = FileText::where(function($query) use ($content) {

            $query->whereFullText(['content','search_string'], $content, ['mode' => 'boolean'])
                ->where('status',0);
        })
        ->orWhere('search_string', $content)
        ->orWhere('search_string', $data_regex)
        ->orderBy('id','asc')
        ->get();

            if (intval($data_regex) > 0)
            {
                if ($result->isNotEmpty())
                {
                    foreach ($result as $doc)
                    {
                            $date_time =  $this->phoneDate($data_regex);
                                $text = $doc->content;
                                            $files[] = array(
                                                'bibliography' => $doc->file->bibliography,
                                                'file_id' => $doc->file->id,
                                                'status' => $doc->status,
                                                'file_info' => $doc->file->real_name,
                                                'file_path' => $doc->file->path,
                                                'find_word' => Arr::whereNotNull(collect($date_time)->map(function ($pat) use($text) {

                                                    $new_text = Str::replace($pat,'-----'."<u>".$pat."</u>", $text);

                                                    if (Str::of($new_text)->contains($pat)) {

                                                        return Str::of($new_text)->explode('-----');
                                                    }


                                                })->toArray()),
                                                'file_text' => $text,
                                                'created_at' => Carbon::parse($doc->created_at)->format('d-m-Y')
                                            );
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

                                        $files[] = array(
                                            'bibliography' => $doc->file->bibliography ?? '',
                                            'file_id' => $doc->file->id,
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
                                            'file_text' => $text,
                                            'trans_text' => $content,
                                            'created_at' => Carbon::parse($doc->created_at)->format('d-m-Y')
                                        );
                }
           }

        return $files ?? [];

    }

    public function solrSearch($content, int $distance = 2, ?int $wordCount = null, ?bool $revers_word = true,?array $params)
    {
        if (isset($wordCount)) {

            if ( is_null($revers_word)) {

                $revers_word = false;
            }
            $data = $this->searchBetweenWords($content, $wordCount, $revers_word);

            return $this->getFileTextIds($data);

        }else{

            if ($params['car_number'] == 1) {

               return $this->car_number_search($content);

            }

            if (strpos($content,'?') !== false)
            {
               return $this->wrong_letter($content);
            }

            if (intval($content) > 0) {

                $content = str_replace('+', '', $content);
                $phoneDate = $this->phoneDate($content);
                $searchPhoneDate = '"'.(implode('" "', $phoneDate)).'"';
                $ids = $this->findFileIds($searchPhoneDate,$content);

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

    }

    function wrong_letter($content)
    {
        $files = [];
        $first = trim($content);
        $first = str_replace('?','_',$first);

        $result = FileText::where(function($query) use ($first){
            $query->where('content','LIKE',"%$first%")
                    ->where('status',0);
        })
        ->orWhere('search_string', $first)->get();

        $patterns = collect(str_replace('_','.',$first))->map(function ($pat) {

            return "/($pat)/iu";

        })->toArray();

        $replacements = collect(explode('_',$first))->map(function ($rep) {

            return "<u>".Str::lower($rep)."</u>";

        })->toArray();

        if ($result->isNotEmpty())
        {
            foreach ($result as $doc)
            {
                preg_match($patterns[0],$doc->content,$matches);

                $replacements = collect($matches[0])->map(function ($rep) {

                    return "<u>".Str::lower($rep)."</u>";

                })->toArray();

                $text =  preg_replace($patterns, $replacements, $doc->content);

                        $files[] = array(
                            'bibliography' => $doc->file->bibliography ?? '',
                            'file_id' => $doc->file->id,
                            'file_info' => $doc->file->real_name,
                            'status' => $doc->status,
                            'file_path' => $doc->file->path,
                            'find_word' => Arr::whereNotNull(collect($matches[0])->map(function ($pat) use($text) {

                                $new_text = Str::replace(
                                    "<u>".Str::lower($pat)."</u>",
                                        '-----'."<u>".Str::lower($pat)."</u>", $text);

                                if (Str::of($new_text)->contains(Str::lower($pat))) {

                                    return Str::of($new_text)->explode('-----');
                                }

                            })->toArray()),
                            'file_text' => $text,
                            'created_at' => Carbon::parse($doc->created_at)->format('d-m-Y')

                        );
            }
        }

        return $this->getFileTextIds($files);

    }

    function car_number_search($content)
    {
        if (trim($content) != '')
        {
            $files = [];
            $value = trim($content);
            $length = mb_strlen($value,'UTF-8');

            if ($length == LengthDataFormat::CAR_NUMBER_LENGTH->value)
            {

                $data = $this->format_car_number($value);

                $searchCar = '"'.(implode('" "', $data)).'"';

                $result = FileText::where(function($query) use ($searchCar) {

                    $query->whereFullText(['content','search_string'], $searchCar, ['mode' => 'boolean'])
                        ->where('status',0);
                })
                ->orWhere('search_string', $value)
                ->orderBy('id','asc')
                ->get();


                    $patterns = collect($data)->map(function ($pat) {

                        return "/($pat)/iu";

                    })->toArray();

                    $replacements = collect($data)->map(function ($rep) {

                        return "<u>".Str::lower($rep)."</u>";

                    })->toArray();

                    if ($result->isNotEmpty())
                    {
                        foreach ($result as $doc)
                        {
                                $text =  preg_replace($patterns, $replacements, $doc->content);

                                                $files[] = array(
                                                    'bibliography' => $doc->file->bibliography ?? '',
                                                    'file_id' => $doc->file->id,
                                                    'file_info' => $doc->file->real_name,
                                                    'status' => $doc->status,
                                                    'file_path' => $doc->file->path,
                                                    'find_word' => Arr::whereNotNull(collect($data)->map(function ($pat) use($text) {

                                                        $new_text = Str::replace(
                                                            "<u>".Str::lower($pat)."</u>",
                                                                '-----'."<u>".Str::lower($pat)."</u>", $text);
                                                        if (Str::of($new_text)->contains(Str::lower($pat))) {

                                                            return Str::of($new_text)->explode('-----');
                                                        }

                                                    })->toArray()),
                                                    'file_text' => $text,
                                                    'created_at' => Carbon::parse($doc->created_at)->format('d-m-Y')

                                                );
                        }
                    }

            }
        }

        return $this->getFileTextIds($files);
    }

    function phoneDate($content): array
    {
        if (trim($content) != '')
        {
            $value = trim($content);
            $length = strlen($value);
            $value = trim($value);
            if (intval($value) > 0)
            {
                $data = match ($length) {

                    LengthDataFormat::MOBILE_PHONE->value =>  $this->format_phone($value),
                    LengthDataFormat::HOME_PHONE->value => $this->format_phone_home($value),
                    LengthDataFormat::INTER_PHONE->value => $this->format_inter_phone($value),
                    LengthDataFormat::DATE_LENGTH->value => $this->format_date_time($value),
                    default => $this->format_phone($value)
                };
            }

        }

        return $data ?? [];

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

    public function encodeParams($search_params)
    {
        $encoded = json_encode($search_params);
        $unescaped = preg_replace_callback('/\\\\u(\w{4})/', function ($matches) {
            return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
        }, $encoded);

        return $unescaped;
    }

    function format_car_number($car_number)
    {
        $numbers = array();

        if(mb_strlen($car_number,'UTF-8') == LengthDataFormat::CAR_NUMBER_LENGTH->value) {

            array_push($numbers, preg_replace("/([0-9]{2}|[0-9]{3})([A-Z]{2}|[a-z]{2}|[ա-ֆ]{2}|[Ա-Ֆ]{2})([0-9]{3}|[0-9]{2})/", "$1$2$3", $car_number));
            array_push($numbers, preg_replace("/([0-9]{2}|[0-9]{3})([A-Z]{2}|[a-z]{2}|[ա-ֆ]{2}|[Ա-Ֆ]{2})([0-9]{3}|[0-9]{2})/u", "$1 $2 $3", $car_number));
            array_push($numbers, preg_replace("/([0-9]{2}|[0-9]{3})([A-Z]{2}|[a-z]{2}|[ա-ֆ]{2}|[Ա-Ֆ]{2})([0-9]{3}|[0-9]{2})/u", "$1 $2$3", $car_number));
            array_push($numbers, preg_replace("/([0-9]{2}|[0-9]{3})([A-Z]{2}|[a-z]{2}|[ա-ֆ]{2}|[Ա-Ֆ]{2})([0-9]{3}|[0-9]{2})/u", "$1$2 $3", $car_number));
        }

        return $numbers;

    }

    function format_date_time($date_time)
    {
        $numbers = array();
        $phone = preg_replace("/[^0-9]/", "", $date_time);

        if(strlen($date_time) == LengthDataFormat::DATE_LENGTH->value) {

            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{4})/", "$1-$2-$3", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/ $2 $4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/-$2-$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1/$2/$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "$1.$2.$4", $date_time));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1.$2.$4", $date_time));
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

        if(strlen($phone) == LengthDataFormat::INTER_PHONE->value) {

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

        if(strlen($phone) == LengthDataFormat::MOBILE_PHONE->value) {

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

        if(strlen($phone) == LengthDataFormat::HOME_PHONE->value) {

            array_push($numbers, preg_replace("/([0-9]{6})/", "$1", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1-$2-$3", $phone));
            array_push($numbers, preg_replace("/([0-9]{2})([0-9]{2})([0-9]{2})/", "$1 $2 $3", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})/", "$1 $2", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{3})/", "$1-$2", $phone));
        }

        return $numbers;
    }
}
