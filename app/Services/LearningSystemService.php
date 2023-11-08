<?php

namespace App\Services;

use App\Models\LearningSystem;
use App\Services\Translate\EnglishTranslateService;
use App\Services\Translate\RussianTranslateService;

class LearningSystemService
{
    public static function learning_system($data)
    {

        $create_data = [];

        foreach ($data as $key => $item) {

            $get_all_keys_item = array_keys($item);

            foreach ($item as $i_key => $elem) {

                $get_all_keys_elem = array_keys($elem);

                for ($j = 0; $j < count($get_all_keys_elem); $j++) {
                    for ($i = 0; $i < count($get_all_keys_item); $i++) {
                        $create_data[$get_all_keys_item[$i]] = $item[$get_all_keys_item[$i]][$get_all_keys_elem[$j]];
                    }
                    $create_data['type'] = $get_all_keys_elem[$j];

                    LearningSystem::UpdateOrCreate($create_data, $create_data);
                }

                break;
            }
        }
    }

    // public static function get_info($search_arr = [])
    // {

    //     $alphabet_en = get_en_alphabet();
    //     $alphabet_ru = get_ru_alphabet();
    //     $lang = 'english';
    //     $lang_key = 'en';
    //     $search_result = [];

    //     foreach ($search_arr as $key => $item) {

    //         if (isset($alphabet_en[$item[0]])) {
    //             $lang = 'english';
    //             $lang_key = 'en';
    //         }

    //         if (isset($alphabet_ru[$item[0]])) {
    //             $lang = 'russian';
    //             $lang_key = 'ru';
    //         }

    //         $translate_result = LearningSystem::where('type', $key)->where($lang, $item)->first();

    //         if (isset($translate_result)) {
    //             $pushed_array = [
    //                 $translate_result->type => [
    //                     "armenian" => $translate_result->armenian,
    //                     "russian" => $translate_result->russian,
    //                     "english" => $translate_result->english
    //                 ]
    //             ];
    //             array_push($search_result, $pushed_array);
    //         } else {
    //             $search_result = TranslateService::translate($search_arr);
    //         }

    //     }

    //     return $search_result;
    // }

    public static function get_info($search_text)
    {

        $alphabet_en = get_en_alphabet();
        $alphabet_ru = get_ru_alphabet();
        // $lang = 'english';
        $lang_key = 'en';
        $search_result = [];

        $each_leatter = preg_split('//u', $search_text, null, PREG_SPLIT_NO_EMPTY);

        if (isset($alphabet_en[$each_leatter[0]])) {
            // $lang = 'english';
            $lang_key = 'en';
        }

        if (isset($alphabet_ru[$each_leatter[0]])) {
            // $lang = 'russian';
            $lang_key = 'ru';
        }


        if($lang_key == 'en') {
            $search_result = EnglishTranslateService::translate($each_leatter);
        }else if($lang_key == 'ru') {
            $search_result = RussianTranslateService::translate($each_leatter);
        }

        return $search_result;

    }
}
