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
                    $create_data['learning_type'] = 'mard';

                    LearningSystem::UpdateOrCreate($create_data, $create_data);
                }

                break;
            }
        }
    }

    public static function get_info($search_arr = [])
    {
        $alphabet_en = get_en_alphabet();
        $lang = 'english';

        foreach($search_arr as $key => $item) {

            if(isset($alphabet_en[$item[0]])) {
                $lang = 'english';
            }

            $search_result = LearningSystem::where('type', $key)->where($lang, $item)->where('status', 1)->first();

            return $search_result;

        }
    }
}
