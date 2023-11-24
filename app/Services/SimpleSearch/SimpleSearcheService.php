<?php

namespace App\Services\SimpleSearch;

use App\Models\File\FileText;
use App\Services\SimpleSearch\ISimpleSearch;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Models\ModelInclude\SimplesearchModel;
use App\Services\Log\LogService;
use App\Traits\FullTextSearch;
use Illuminate\Support\Facades\DB;
use App\Services\LearningSystemService;
use Illuminate\Support\Str;

class SimpleSearcheService implements ISimpleSearch
{
    use FullTextSearch;

    const SIMPLE_SEARCH = 'simplesearch';

    public $simpleSearchModel;
    private $learningSystemService;

    public function __construct(LearningSystemService $learningSystemService) {

        $this->learningSystemService =$learningSystemService;
        $this->simpleSearchModel = new SimplesearchModel;
    }

    public function simple_search_for_data(
        Request $request,
        $lang,
        $type = null,
        string $view_name
        ): View
    {
        try {
            // $this->_view->set('navigationItem',$this->Lang->action);
            if ($type) {
                // $this->_view->set('type',$type);
                // return $this->_view->output('empty');
                return view(self::SIMPLE_SEARCH.'.'.$view_name)->with('type', $type);
            } else {
                $new = explode('?', $request->getRequestUri());
                if (count($new) == 1 || (count($new) > 1 && strcmp($new[1], 'n=t') == 0)) {
                    //unset($_SESSION['search_params']);
                    Session::forget('search_params');
                } else if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                    $savedCardArray = json_decode($cookie, true);
                    $search_params =  count($savedCardArray) > 0 ? $savedCardArray : null;
                    // $this->_view->set('search_params',  $savedCardArray);
                    return view(self::SIMPLE_SEARCH.'.'.$view_name, compact('search_params'));
                }
                return view(self::SIMPLE_SEARCH.'.'.$view_name);
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }

    }

    public function result_for_data(
        Request $request,
        $lang,
        $type,
        string $view_name,
        string $action_model,
        string $tb_name,
        string $search_type
        ): View
    {
        try {
            $search_params = array();
            $post = $request->all();
            if (isset($post)) {
                foreach ($post as $key => $value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($request['content']) && trim($request['content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($request['content'], $post['content_distance'] ?? 2, $post['word_count'] ?? null, $post['revers_word'] ?? null);
            }
            if (isset($files) && !empty($files)) {
                $res = $this->simpleSearchModel->$action_model($post, false, $files);
            } elseif ($files_flag) {
                $res = $this->simpleSearchModel->$action_model($post, true);
            } else {
                $res = $this->simpleSearchModel->$action_model($post);
            }
            $data = json_encode($res);
            if ($type) {
                if ($res) {
                    $response['status'] = true;
                    $response['data'] = $res;
                } else {
                    $response['status'] = false;
                }
                echo json_encode($response);
                die;
            }
            $data = str_replace('""', '" "', $data);
            $data = addslashes($data);
            // $this->_view->set('data',$data);
            // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));
            LogService::store($search_params, null, $tb_name, $search_type );
            // $this->_view->set('navigationItem',$this->Lang->action);
            // $this->_model->logging('smp_search','action');
            return view(self::SIMPLE_SEARCH.'.'.$view_name, compact('data'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }

    }

    public function result_mia_summary(Request $request, $lang, $type)
    {
        try {
            $search_params = array();
            $post = $request->all();
            if (isset($post)) {
                foreach ($post as $key => $value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($request['file_content']) && trim($request['file_content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($request['file_content'], $post['content_distance'] ?? 2, $post['word_count'] , $post['revers_word'] ?? null);
            }
            if (isset($files) && !empty($files)) {
                $res = $this->simpleSearchModel->searchMiaSummary($post, false, $files);
            } elseif ($files_flag) {
                $res = $this->simpleSearchModel->searchMiaSummary($post, true);
            } else {
                $res = $this->simpleSearchModel->searchMiaSummary($post);
            }
            $data = json_encode($res);
            if ($type) {
                if ($res) {
                    $response['status'] = true;
                    $response['data'] = $res;
                } else {
                    $response['status'] = false;
                }
                echo json_encode($response);
                die;
            }
            $data = str_replace('""', '" "', $data);
            $data = addslashes($data);
            // $this->_view->set('data',$data);
            // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));

            // $this->_view->set('navigationItem',$this->Lang->mia_summary);
            // $this->_model->logging('smp_search','mia_summary');
            LogService::store($search_params, null, 'mia_summary', 'smp_search' );
            // return $this->_view->output();
            return view('simplesearch.result_mia_summary', compact('data'));
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_man_bean_country(Request $request, $lang, $type)
    {
        try {
            $search_params = array();
            $post = $request->all();

            if (isset($post)) {
                foreach ($post as $key => $value) {
                    $search_params[$key] = $value;
                }
            }

            $res = $this->simpleSearchModel->searchManBeanCountry($post);
            $data = json_encode($res);
            if ($type) {
                if ($res) {
                    $response['status'] = true;
                    $response['data'] = $res;
                } else {
                    $response['status'] = false;
                }
                echo json_encode($response);
                die;
            }
            $data = str_replace('""', '" "', $data);
            $data = addslashes($data);
            // $this->_view->set('data',$data);
            //$_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));
            // $this->_view->set('navigationItem',$this->Lang->man_bean_country);
            // $this->_model->logging('smp_search','man_bean_country');
            LogService::store($search_params, null, 'man_bean_country', 'smp_search' );

            return view('simplesearch.result_man_bean_country', compact('data'));

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_signal(Request $request, $lang, $type)
    {
        try {
            $search_params = array();
            $post = $request->all();

            if (isset($post)) {
                foreach ($post as $key => $value) {
                    $search_params[$key] = $value;
                }
            }
            $files_flag = false;
            if (isset($request['file_content']) && trim($request['file_content']) != '') {
                $files_flag = true;
                $files = $this->solrSearch($request['file_content'], $post['content_distance'] ?? 2, $post['word_count'] , $post['revers_word'] ?? null);
            }
            if (isset($files) && !empty($files)) {
                $res = $this->simpleSearchModel->searchSignal($post, false, $files);
            } elseif ($files_flag) {
                $res = $this->simpleSearchModel->searchSignal($post, true);
            } else {
                $res = $this->simpleSearchModel->searchSignal($post);
            }
            $data = json_encode($res);
            if ($type) {
                if ($res) {
                    $response['status'] = true;
                    $response['data'] = $res;
                } else {
                    $response['status'] = false;
                }
                echo json_encode($response);
                die;
            }
            $data = str_replace('"null"', '""', $data);
            $data = str_replace('""', '" "', $data);
            $data = addslashes($data);
            //  $this->_view->set('data',$data);
            //  $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));

            // $this->_view->set('navigationItem',$this->Lang->signal);
            // $this->_model->logging('smp_search','signal');
            LogService::store($search_params, null, 'signal', 'smp_search' );

            return view('simplesearch.result_signal', compact('data'));

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_keep_signal(Request $request, $lang, $type)
    {
        try {
            $search_params = array();
            $post = $request->all();
            if (isset($post)) {
                foreach ($post as $key => $value) {
                    $search_params[$key] = $value;
                }
            }

            $res = $this->simpleSearchModel->searchKeepSignal($post);
            $data = json_encode($res);
            if ($type) {
                if ($res) {
                    $response['status'] = true;
                    $response['data'] = $res;
                } else {
                    $response['status'] = false;
                }
                echo json_encode($response);
                die;
            }
            $data = str_replace('""', '" "', $data);
            $data = addslashes($data);

            // $this->_view->set('data',$data);
            // $_SESSION['search_params'] = $this->encodeParams($search_params);

            Session::put('search_params', $this->encodeParams($search_params));

            // $this->_view->set('navigationItem',$this->Lang->keep_signal);
            // $this->_model->logging('smp_search','keep_signal');

            LogService::store($search_params, null, 'keep_signal', 'smp_search' );

            return view('simplesearch.result_keep_signal', compact('data'));

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function result_objects_relation(Request $request, $lang, $type)
    {
        try {
            $search_params = array();
            $post = $request->all();
            if (isset($post)) {
                foreach ($post as $key => $value) {
                    $search_params[$key] = $value;
                }
            }

            $res = $this->simpleSearchModel->searchObjectsRelation($post);
            $data = json_encode($res);
            if ($type) {
                if ($res) {
                    $response['status'] = true;
                    $response['data'] = $res;
                } else {
                    $response['status'] = false;
                }
                echo json_encode($response);
                die;
            }
            $data = str_replace('""', '" "', $data);
            $data = addslashes($data);
            // $this->_view->set('data',$data);
            // $_SESSION['search_params'] = $this->encodeParams($search_params);
            Session::put('search_params', $this->encodeParams($search_params));
            //$this->_view->set('navigationItem',$this->Lang->relationship_objects);
            //$this->simpleSearchModel->logging('smp_search','object_relation');

            LogService::store($search_params, null, 'object_relation', 'smp_search' );

            // return $this->_view->output();
            return view('simplesearch.result_objects_relation', compact('data'));

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_bibliography(Request $request, $lang, $type = null)
    {
        try {
            $users = $this->simpleSearchModel->getUsers();
            //$this->_view->set('users',$users);
            // $this->_view->set('navigationItem',$this->Lang->bibliography);

            if ($type) {
                //  $this->_view->set('type',$type);
                //  return $this->_view->output('empty');
                return view('simplesearch.simple_search_bibliography', compact('type', 'users'));
            } else {
                //$this->_view->set('type',$type);
                $new = explode('?', $request->getRequestUri());
                if (count($new) == 1 || (count($new) > 1 && strcmp($new[1], 'n=t') == 0)) {
                    // unset($_SESSION['search_params']);
                    Session::forget('search_params');
                } else if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                    // $savedCardArray = json_decode($cookie, true);
                    $search_params = json_decode($cookie, true);

                    //$this->_view->set('search_params',  $savedCardArray);
                    return view('simplesearch.simple_search_bibliography', compact('search_params', 'users'));
                }
                //return $this->_view->output();
                return view('simplesearch.simple_search_bibliography', compact('type', 'users'));
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function simple_search_external_signs(Request $request, $lang, $type = null)
    {

        try {
            // $users = $this->_model->getUsers();
            // $this->_view->set('users',$users);
            // $this->_view->set('navigationItem',$this->Lang->external_signs);
            if ($type) {
                // $this->_view->set('type',$type);
                // return $this->_view->output('empty');
                return view('simplesearch.simple_search_external_signs')->with('type', $type);
            } else {
                $new = explode('?', $request->getRequestUri());
                if (count($new) == 1 || (count($new) > 1 && strcmp($new[1], 'n=t') == 0)) {

                    Session::forget('search_params');
                    return view('simplesearch.simple_search_external_signs');
                } else if (Session::has('search_params')) {
                    $cookie = stripslashes(Session::get('search_params'));
                    $savedCardArray = json_decode($cookie, true);
                    $search_params = $savedCardArray;

                    // $this->_view->set('search_params',  $savedCardArray);
                    return view('simplesearch.simple_search_external_signs', compact('search_params'));
                }
                return view('simplesearch.simple_search_external_signs');
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
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
            $revers_word ? $word : $word = array_reverse($word);
            $getTexts = FileText::whereRaw('1=1 '.$this->search(['content'], preg_replace('!\s+!', ' ', $data), 1))
                       ->get(['file_id','content']);
            $files = [];
            foreach ($getTexts as $getText) {
                $slice = Str::between($getText->content, $word[0], $word[1]);

                foreach ($this->getText($slice , [$word[0], $word[1]]) as $value) {
                   if (count($this->explodString(trim($value))) == $wordCount) {

                        $files[] = $getText->file_id;

                   }
                }

            }
        }

        return array_unique($files);
    }

    function getDataOfContent(string  $string)
    {
        yield from explode(' ', $string);
    }

    function searchSimilary(int $distance, array $trans) : array
    {
        $files = [];
        FileText::orderBy('file_id')->chunk(100, function ($datas) use (&$files, $distance, $trans) {
            foreach ($datas as $data) {
                $string = preg_replace('/\s+/', ' ', $data->content);
                foreach ($this->getDataOfContent($string) as $word) {
                    foreach ($trans as  $value) {
                        $lev = levenshtein($value, $word);
                        if ($lev <= $distance) {
                            $files[] = $data->file_id;
                            break;
                        }
                    }
                }
            }
        });
        return $files ?? [];
    }

    function findFileIds($content): array
    {
        $result = FileText::whereRaw("1=1 AND MATCH (content) AGAINST ('$content' IN BOOLEAN MODE)")
                  ->get(['file_id','content']);

        if ($result->isNotEmpty()) {
            foreach ($result as $doc) {

                $files[] = $doc->file_id;
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
            return $this->searchBetweenWords($content, $wordCount, $revers_word);

        }else{
            $lang = app()->getLocale();
            if (request()->getRequestUri() === "/{$lang}/simplesearch/result_phone" && intval($content) > 0) {

                    $content = str_replace('+', '', $content);
                    $phones = $this->phone($content);
                    $searchPhones = '"'.(implode('" "', $phones)).'"';
                    $ids = $this->findFileIds($searchPhones);

                    return $this->getFileTextIds($ids);
            }

            $trans = $this->learningSystemService->get_info($content);
            $searchTrans = implode(" ", $trans);
            if ($distance == 1) {

                $ids = $this->findFileIds($searchTrans);

                return $this->getFileTextIds($ids);

            }else{

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
