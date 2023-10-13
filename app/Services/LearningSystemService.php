<?php

namespace App\Services;

use App\Models\LearningSystem;

class LearningSystemService
{
    public static function learning_system($data)
    {

        $create_data = [];

        foreach ($data as $key => $item) {

            $get_all_keys_item = array_keys($item);

            // $i = 0;
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

    public static function get_info($search_arr = [])
    {

        $alphabet_en = get_en_alphabet();
        $alphabet_ru = get_ru_alphabet();
        $lang = 'english';
        $lang_key = 'en';
        $search_result = [];

        foreach ($search_arr as $key => $item) {

            if (isset($alphabet_en[$item[0]])) {
                $lang = 'english';
                $lang_key = 'en';
            }

            if (isset($alphabet_ru[$item[0]])) {
                $lang = 'russian';
                $lang_key = 'ru';
            }

            $translate_result = LearningSystem::where('type', $key)->where($lang, $item)->first();

            if (isset($translate_result)) {
                $pushed_array = [
                    $translate_result->type => [
                        "armenian" => $translate_result->armenian,
                        "russian" => $translate_result->russian,
                        "english" => $translate_result->english
                    ]
                ];
                array_push($search_result, $pushed_array);
            } else {
                $search_result = TranslateService::translate($search_arr);
            }

        }

        return $search_result;
    }
}
