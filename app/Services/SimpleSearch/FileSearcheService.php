<?php

namespace App\Services\SimpleSearch;

use App\Contracts\IFileTextInterface;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Traits\FullTextSearch;
use App\Services\SearchService;
use App\Services\LearningSystemService;
use App\Models\ModelInclude\SimplesearchModel;
use Generator;

class FileSearcheService
{
    use FullTextSearch;

    const SIMPLE_SEARCH = 'simplesearch';

    public $simpleSearchModel;

    public function __construct(
        private LearningSystemService $learningSystemService,
        private SearchService $searchService,
        private IFileTextInterface $fileTextRepository) {

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
            if ($text != "" && $text != " ") {
              yield Str::before($text,$words[1]);
            }
        }

    }

    function explodString(string $str): array
    {
        $output = preg_replace('!\s+!', ' ',$str);
        return explode(" ", $output);
    }

    function betweenGenerationData($datas, array $params): Generator
    {
        foreach ($datas as $data) {

            $text =  preg_replace($params['patterns'], $params['replacements'], $data->content);
            $slice = Str::between($data->content, $params['word'][0], $params['word'][1]);

            foreach ($this->getText($slice , [$params['word'][0], $params['word'][1]]) as $value) {
                    if (count($this->explodString(trim($value))) == $params['wordCount'])
                    {

                         yield array(
                             'bibliography' => $data->file->bibliography ?? '',
                             'file_id' => $data->file->id,
                             'status' => $data->status,
                             'file_info' => $data->file->real_name,
                             'file_path' => $data->file->path,
                             'find_word' => Arr::whereNotNull(collect($params['word'])->map(function ($pat) use($text) {

                                 $new_text = str_ireplace("<u>".$pat."</u>", '-----'."<u>".$pat."</u>", $text);
                                 if (Str::of($new_text)->contains($pat)) {

                                     return Str::of($new_text)->explode('-----');
                                 }


                             })->toArray()),
                             'file_text' => $text,
                             'serarch_text' => $params['revers_word'],
                             'created_at' => Carbon::parse($data->created_at)->format('d-m-Y')

                         );

                    }
                    break;
            }



        }
    }

    public function searchBetweenWords(string $data, int $wordCount, bool $revers_word)
    {
        $files = [];
        $word = $this->explodString($data);

        if (count($word) == 2) {

            $patterns = collect($word)->map(function ($pat) {

                return "/(".preg_quote($pat).")/iu";

            })->toArray();

            $replacements = collect($word)->map(function ($rep) {

                return "<u>".$rep."</u>";

            })->toArray();

            $revers_word ? $word : $word = array_reverse($word);
            $rep_data = preg_replace('!\s+!', ' ', $data);
            $datas = $this->fileTextRepository->getFileTextContent($rep_data);

            $files = $this->betweenGenerationData($datas,[

                'word' => $word ,
                'wordCount' => $wordCount,
                'patterns' => $patterns,
                'replacements' => $replacements,
                'revers_word' => $revers_word]);

        }

        if (isset($files))
        {
            return $files ? iterator_to_array($files) : [];
        }else{
            return [];
        }


    }

    function getDataOfContent(string  $string, $new_trans, $distance)
    {
        $arr = Arr::where(explode(' ', $string), function ($word) use ($new_trans, $distance) {

           $word = preg_replace('/[^ a-zа-яёա-ֆև\d]/ui', '', $word);

            if (mb_strlen($word,'UTF-8') > 2 &&  $word != "" &&  $word != " ") {

                if (mb_strlen($word,'UTF-8') < 6) {
                    $distance = 1;
                }
                if (mb_strlen($word,'UTF-8') > 10) {
                    $distance = 3;
                }
                return Arr::where($new_trans,function($tr_value) use($distance, $word){

                        if (levenshtein(Str::lower($tr_value) , Str::lower($word)) <= $distance) {
                            return $word;
                        }
                });
            }
        });

        $arr = collect($arr)->map(function($val){

            return preg_replace('/[^ a-zа-яёա-ֆև\d]/ui', '', $val);
        })->toArray();

        yield from array_unique($arr);
    }

    function getOneSimilaryResult(array $params): Generator
    {
        $datas = $this->fileTextRepository->getFileTextContent(implode(' ',$params['simpleWords']));

        foreach ($datas as $data) {

            $string = preg_replace('/\s+/', ' ', $data->content);

            $text =  preg_replace(array_unique($params['patterns']), array_unique($params['replacements']),  $string);

            yield array(
                'bibliography' => $data->file->bibliography ?? '',
                'file_id' => $data->file->id,
                'status' => $data->status,
                'file_info' => $data->file->real_name,
                'file_path' => $data->file->path,
                'find_word' => Arr::whereNotNull(collect(array_unique($params['simpleWords']))->map(function ($pat) use($text) {

                    $new_text = str_ireplace("<u>".$pat."</u>", '-----'."<u>".$pat."</u>", $text);
                    if (Str::of($new_text)->contains($pat)) {

                        return Str::of($new_text)->explode('-----');
                    }

                })->toArray()),

                'file_text' => $text,
                'serarch_text' => implode(' ', $params['trans']),
                'created_at' => Carbon::parse($data->created_at)->format('d-m-Y')

            );

        }
    }

    function getTwoSimilaryResult($content,array $params): Generator
    {
        $new_datas = $this->fileTextRepository->getFileTextContent($content);

        foreach ($new_datas as $data)
        {

            $string = preg_replace('/\s+/', ' ', $data->content);
            $text =  preg_replace(array_unique($params['patterns']), array_unique($params['replacements']), $string);

            yield array(
                'bibliography' => $data->file->bibliography ?? '',
                'file_id' => $data->file->id,
                'status' => $data->status,
                'file_info' => $data->file->real_name,
                'file_path' => $data->file->path,
                'find_word' => Arr::whereNotNull(collect($params['arr_word'])->map(function ($pat) use($text) {

                    $pat = str_replace('+', '', $pat);

                    $new_text = str_ireplace("<u>".$pat."</u>", '-----'."<u>".$pat."</u>", $text);
                    if (Str::of($new_text)->contains($pat)) {

                        return Str::of($new_text)->explode('-----');
                    }

                })->toArray()),

                'file_text' => $text,
                'serarch_text' => $content,
                'created_at' => Carbon::parse($data->created_at)->format('d-m-Y')

            );

        }
    }

    function searchSimilary(int $distance, array $trans) : array
    {
       $files = [];
       $datas = $this->fileTextRepository->getFileTextSimilary();

        $patterns = [];
        $replacements = [];
        $simpleWords = [];

        $new_trans = collect($trans)->map(function($tr){

            $arr = Arr::where(explode(' ', $tr), function ($value) {

                return $value != "";
            });

            return $arr;

        })->flatten(1)->toArray();

        foreach ($datas as $data) {

            $string = preg_replace('/\s+/', ' ', $data->content);

            foreach ($this->getDataOfContent($string, $new_trans, $distance) as $word)
            {
                if (mb_strlen($word,'UTF-8') < 6) {
                    $distance = 1;
                }
                if (mb_strlen($word,'UTF-8') > 10) {
                    $distance = 3;
                }
                foreach ($new_trans as  $key => $value) {

                   $lev = levenshtein(Str::lower($value), $word);
                   if ($lev <= $distance) {

                        if (!in_array("/($word)/iu", $patterns)) {

                            $patterns[] = "/($word)/iu";
                        }
                        if (!in_array("<u>".$word."</u>", $replacements)) {

                            $replacements[] = "<u>".$word."</u>";
                        }

                        if (count($new_trans) > 3) {

                            $simpleWords[$key][] = '+'.$word;

                        }else{
                            if (!in_array($word, $simpleWords)) {

                                $simpleWords[] = $word;
                            }

                        }
                    }
                }
            }

        }

        if (count($new_trans) > 3 && isset($simpleWords[0]) && isset($simpleWords[1])) {

            $matrix = Arr::crossJoin(array_unique($simpleWords[0]),array_unique($simpleWords[1]));

            foreach (collect($matrix)->chunk(10) as $matrix )
            {
                $arr_word = Arr::flatten($matrix);

                $input_datas = collect($matrix)->map(function ($arr){

                    $str = "(".implode(' ', array_unique($arr)).")";

                    return $str;
                })->toArray();

                $content = implode(' ', $input_datas);
                $files[] = $this->getTwoSimilaryResult($content,[
                    'patterns' => $patterns,
                    'replacements' => $replacements,
                    'arr_word' => $arr_word
                ]);
            }

            }elseif(count($new_trans) == 3){

               $files = $this->getOneSimilaryResult([

                    'new_trans' => $new_trans ,
                    'distance' => $distance,
                    'patterns' => $patterns,
                    'replacements' => $replacements,
                    'simpleWords' => $simpleWords,
                    'trans' => $trans]);

            }

        if (count($new_trans) > 3 && isset($simpleWords[0]) && isset($simpleWords[1])) {
            $files = $this->getBigData($files);
        }

        if (isset($files))
        {
            return collect($files)->unique('file_id')->toArray() ?? '';
        }else{
            return [];
        }
    }

    function getBigData($files)
    {

        foreach ($files as $values) {
            foreach ($values as $value) {

                yield $value;
            }
        }
    }

    function getDatafindIs($result, array $params): Generator
    {
        foreach ($result as $doc)
        {
            $phone_date =  $this->phoneDate($params['data_regex']);

            $text = $doc->content;

            $phone_replace = collect($phone_date)->map(function ($repl) {

                $search  = array('/', '.','(',')');
                $replace = array('\/', '\.','\(','\)');
                return str_replace($search,$replace,$repl);

            })->toArray();

            $patterns = collect($phone_replace)->map(function ($pat) {

                return "/($pat)/iu";

            })->toArray();

            $replacements = collect($phone_date)->map(function ($rep) {

                return "<u>".Str::lower($rep)."</u>";

            })->toArray();


            $text =  preg_replace($patterns, $replacements, $text);

            yield array(
                'bibliography' => $doc->file->bibliography,
                'file_id' => $doc->file->id,
                'status' => $doc->status,
                'file_info' => $doc->file->real_name,
                'file_path' => $doc->file->path,
                'find_word' => Arr::whereNotNull(collect($phone_date)->map(function ($pat) use($text) {

                    $new_text = Str::replace($pat,'-----'."<u>".$pat."</u>", $text);

                    if (Str::of($new_text)->contains($pat)) {

                        return Str::of($new_text)->explode('-----');
                    }

                })->toArray()),
                'file_text' => $text,
                'serarch_text' => $params['data_regex'],
                'created_at' => Carbon::parse($doc->created_at)->format('d-m-Y')
            );
        }

    }

    function getFullTextData($result, array $params): Generator
    {
        foreach ($result as $doc)
        {
            $text =  preg_replace($params['patterns'], $params['replacements'], $doc->content);

            yield array(
                'bibliography' => $doc->file->bibliography ?? '',
                'file_id' => $doc->file->id,
                'file_info' => $doc->file->real_name,
                'status' => $doc->status,
                'file_path' => $doc->file->path,
                'find_word' => Arr::whereNotNull(collect($params['trans'])->map(function ($pat) use($text) {

                    $new_text = str_ireplace("<u>".$pat."</u>", '-----'."<u>".$pat."</u>", $text);
                    if (Str::of($new_text)->contains($pat)) {

                        return Str::of($new_text)->explode('-----');
                    }

                })->toArray()),
                'file_text' => $text,
                'serarch_text' => $params['content'] ?? '',
                'created_at' => Carbon::parse($doc->created_at)->format('d-m-Y')
            );
        }
    }

    function findFileIds($content, ?string $data_regex = null): array
    {
        $files = [];
            if (intval($data_regex) > 0)
            {
                $result = $this->fileTextRepository->getFileTextRegexp($content);

                if (!empty($result)) {
                    if ($result->isNotEmpty())
                    {
                        $files = $this->getDatafindIs($result,['data_regex' => $data_regex]);

                    }
                }

                if (isset($files)) {
                    return  collect($files)->unique('file_id')->toArray();
                }else{

                    return [];
                }

            }

            $result = $this->fileTextRepository->getFileTextContent($content);

            $reservedSymbols = ['*','-', '+','(', ')'];

            $term = str_replace($reservedSymbols, '', $content);

            if (strpos($term,'"') !== false) {
                $trans = str_replace('"', '', $content);
            }else{

                $trans = explode(' ',$term);
            }

            $doc_replace = collect($trans)->map(function ($repl) {

                $search  = array('/', '.','(',')');
                $replace = array('\/', '\.','\(','\)');
                return str_replace($search,$replace,$repl);

            })->toArray();

            $patterns = collect($doc_replace)->map(function ($pat) {

                return "/($pat)/iu";

            })->toArray();

            $replacements = collect($trans)->map(function ($rep) {

                return "<u>".$rep."</u>";

            })->toArray();

            if ($result->isNotEmpty())
            {
                $files = $this->getFullTextData($result,[
                    'patterns' => $patterns,
                    'replacements' => $replacements,
                    'trans' => $trans,
                    'content' => $content
                ]);

           }

       return $files ? iterator_to_array($files) : [];

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

            if ($params['search_synonims'] == 1) {

                return $this->getFileTextIds($this->word_synonims($content));
            }

            if ($params['car_number'] == 1) {

               return $this->getFileTextIds($this->car_number_search($content));
            }

            if (strpos($content,'?') !== false)
            {
               return $this->getFileTextIds($this->wrong_letter($content));
            }
            $reservedSymbols = ['*','-', '+','(', ')','/','\\'];
            $term = str_replace($reservedSymbols, '', $content);

            if (is_numeric($term) > 0) {

                $content = str_replace('+', '',$term);
                $phoneDate = $this->phoneDate($content);
                $ids = $this->findFileIds($phoneDate,$content);

                return $this->getFileTextIds($ids);
            }

            if (Str::contains($content, ['+', '-','*','(',')','"'])) {
                $searchTrans = $content;
            }else{

                $trans = $this->learningSystemService->get_info($content) ?? [];
                $searchTrans = implode(" ", $trans);
            }

            if ($distance == 1) {
                $ids = $this->findFileIds($searchTrans);

                return $this->getFileTextIds($ids);

            }elseif($trans){

                $files = $this->searchSimilary($distance,$trans);

                return $this->getFileTextIds($files);
            }
        }

    }

    function word_synonims($content): ?array
    {
        $files = [];
       $query = $this->fileTextRepository->getDataSynonims($content);

        $collection = collect($query)->map(function ($name) {

            $reservedSymbols = ['*',':','.','-', '+','(', ')'];
            $word = str_replace($reservedSymbols, '',$name->word);

            return $word;

        })->toArray();


        $syn_content = '"'.(implode('" "', $collection)).'"';

        $result = $this->fileTextRepository->getFileTextContent($syn_content);

        $patterns = collect($collection)->map(function ($pat) {

            return "/($pat)/iu";

        })->toArray();

        $replacements = collect($collection)->map(function ($rep) {

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
                    'find_word' => Arr::whereNotNull(collect($collection)->map(function ($pat) use($text) {

                        $new_text = str_ireplace("<u>".$pat."</u>", '-----'."<u>".$pat."</u>", $text);
                        if (Str::of($new_text)->contains($pat)) {

                            return Str::of($new_text)->explode('-----');
                        }

                    })->toArray()),
                    'file_text' => $text,
                    'serarch_text' => $content ?? '',
                    'created_at' => Carbon::parse($doc->created_at)->format('d-m-Y')
                );
            }
       }

       return $files;

    }

    function wrong_letter($content): array
    {
        $files = [];
        $first = trim($content);
        $first = str_replace('?','_',$first);

        $result = $this->fileTextRepository->getFileTextLike($first);

        $patterns = collect(str_replace('_','.',$first))->map(function ($pat) {

            $doc_replace = collect($pat)->map(function ($repl) {

                $search  = array('/','(',')');
                $replace = array('\/','\(','\)');
                return str_replace($search,$replace,$repl);

            })->toArray();

            return "/($doc_replace[0])/iu";

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

                    return "<u>".$rep."</u>";

                })->toArray();

                $text =  preg_replace($patterns, $replacements, $doc->content);

                        $files[] = array(
                            'bibliography' => $doc->file->bibliography ?? '',
                            'file_id' => $doc->file->id,
                            'file_info' => $doc->file->real_name,
                            'status' => $doc->status,
                            'file_path' => $doc->file->path,
                            'find_word' => Arr::whereNotNull(collect($matches[0])->map(function ($pat) use($text) {

                                $new_text = str_ireplace("<u>".$pat."</u>", '-----'."<u>".$pat."</u>", $text);

                                if (Str::of($new_text)->contains($pat)) {

                                    return Str::of($new_text)->explode('-----');
                                }

                            })->toArray()),
                            'file_text' => $text,
                            'serarch_text' => $first ?? '',
                            'created_at' => Carbon::parse($doc->created_at)->format('d-m-Y')

                        );
            }
        }

        return $files;

    }

    function car_number_search($content): array
    {
        if (trim($content) != '')
        {
            $files = [];
            $value = trim($content);
            $length = mb_strlen($value,'UTF-8');

            if ($length == LengthDataFormat::CAR_NUMBER_LENGTH->value)
            {

                $data = $this->format_car_number($value);

               // $searchCar = '('.(implode(')|(', $data)).')';

                $result = $this->fileTextRepository->getFileTextRegexp($data);

                    $patterns = collect($data)->map(function ($pat) {

                        return "/($pat)/iu";

                    })->toArray();

                    $replacements = collect($data)->map(function ($rep) {

                        return "<u>".$rep."</u>";

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

                                    $new_text = str_ireplace("<u>".$pat."</u>",'-----'."<u>".$pat."</u>", $text);

                                    if (Str::of($new_text)->contains($pat)) {

                                        return Str::of($new_text)->explode('-----');
                                    }

                                })->toArray()),
                                'file_text' => $text,
                                'serarch_text' => $value ?? '',
                                'created_at' => Carbon::parse($doc->created_at)->format('d-m-Y')

                            );
                        }
                    }

            }
        }

        return $files;
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

    function getFileTextIds($files)
    {
        if (isset($files) && !empty($files)) {

            session()->forget('not_find_message');

            return $files;
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
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1)$2 $3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1)$2-$3-$4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1)$2 $3 $4-$5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1)$2 $3 $4 $5", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1)$2 $3-$4 $5", $phone));
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
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "/$1/$2-$3-$4", $phone));
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
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1)$2 $3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1)$2-$3 $4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1)$2 $3-$4", $phone));
            array_push($numbers, preg_replace("/([0-9]{3})([0-9]{2})([0-9]{2})([0-9]{2})/", "($1)$2-$3-$4", $phone));
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
