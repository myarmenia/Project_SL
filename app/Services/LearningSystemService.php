<?php

namespace App\Services;

use App\Models\LearningSystem;
use App\Services\Translate\EnglishTranslateService;
use App\Services\Translate\RussianTranslateService;

class LearningSystemService
{

    public static function get_info($search_text)
    {

        $alphabet_en = get_en_alphabet();
        $alphabet_ru = get_ru_alphabet();
        $lang = 'english';
        $lang_key = 'en';
        $search_result = [];

        $each_leatter = preg_split('//u', $search_text, null, PREG_SPLIT_NO_EMPTY);

        if (isset($alphabet_en[$each_leatter[0]])) {
            $lang = 'english';
            $lang_key = 'en';
        }

        if (isset($alphabet_ru[$each_leatter[0]])) {
            $lang = 'russian';
            $lang_key = 'ru';
        }

        // $translate_result = LearningSystem::where('type', $key)->where($lang, $item)->first();

        if($lang_key == 'en') {
            $search_result = EnglishTranslateService::translate($each_leatter);
        }else if($lang_key == 'ru') {
            $search_result = RussianTranslateService::translate($each_leatter);
        }

        return $search_result;

    }
}
