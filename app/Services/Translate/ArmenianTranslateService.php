<?php

namespace App\Services\Translate;

class ArmenianTranslateService
{

    public static function array_any(array $array, string $el)
    {
        foreach ($array as $value) if ($el == $value) return true;
        return false;
    }

    public static function translate($translate_text = [])
    {
        $alphabet_am = get_am_alphabet();

        $translated_hy = implode("", $translate_text);
        $translated_ru = '';
        $translated_en = '';

        $arr = [
            'Ա', 'ա', 'Ո', 'ո', 'Ւ', 'ւ'
        ];

        foreach ($translate_text as $letter_key => $letter) {

            if ($letter == ' ') {
                $translated_en .= ' ';
                $translated_ru .= ' ';
                continue;
            } else if ($letter == '-') {
                $translated_en .= '-';
                $translated_ru .= '-';
                continue;
            }

            // if ($letter_key > 0) {
            //     $alphabet_en['E']['hy'] = 'Ե';
            //     $alphabet_en['e']['hy'] = 'ե';

            //     $alphabet_en['O']['hy'] = 'Ո';
            //     $alphabet_en['o']['hy'] = 'ո';

            //     $alphabet_en['R']['hy'] = 'Ր';
            //     $alphabet_en['r']['hy'] = 'ր';

            //     $alphabet_en['E']['ru'] = 'Е';
            //     $alphabet_en['e']['ru'] = 'е';
            // } else if ($letter_key == 0) {
            //     $alphabet_en['E']['hy'] = 'Է';
            //     $alphabet_en['e']['hy'] = 'է';

            //     $alphabet_en['O']['hy'] = 'Օ';
            //     $alphabet_en['o']['hy'] = 'օ';

            //     $alphabet_en['R']['hy'] = 'Ռ';
            //     $alphabet_en['r']['hy'] = 'ռ';

            //     $alphabet_en['E']['ru'] = 'Э';
            //     $alphabet_en['e']['ru'] = 'э';
            // }

            if (
                self::array_any($arr, $letter)
            ) {

                if (isset($translate_text[$letter_key - 1])) {

                    $l1 = $translate_text[$letter_key - 1] . $translate_text[$letter_key];

                    // if (isset($translate_text[$letter_key - 2])) {
                    //     if ($letter == 'ւ' || $letter == 'Ւ') {
                    //         $l1 = $translate_text[$letter_key - 2] . $translate_text[$letter_key - 1] . $translate_text[$letter_key];
                    //     }
                    // }

                    if (isset($alphabet_am[$l1])) {
                        $k1 = $alphabet_am[$l1];
                        $translated_en = mb_substr($translated_en, 0, -1, 'UTF-8');
                        $translated_ru = mb_substr($translated_ru, 0, -1, 'UTF-8');
                    } else {
                        $k1 = $alphabet_am[$letter];
                    }
                } else {

                    $k1 = $alphabet_am[$letter];
                }
            } else {

                $k1 = $alphabet_am[$letter];
            }


            // if ($letter == 'ւ' || $letter == 'Ւ') {
            //     $k1 = $alphabet_am[$letter];

            //     $translated_en = mb_substr($translated_en, 0, -1, 'UTF-8');
            //     $translated_ru = mb_substr($translated_ru, 0, -1, 'UTF-8');

            //     // dd($translated_en, $translated_ru);

            // } else {

            //     $k1 = $alphabet_am[$letter];
            // }

            $translated_en .= $k1['en'];
            $translated_ru .= $k1['ru'];
        }

        $translated_hy = mb_convert_case($translated_hy, MB_CASE_TITLE, "UTF-8");
        $translated_ru = mb_convert_case($translated_ru, MB_CASE_TITLE, "UTF-8");
        $translated_en = mb_convert_case($translated_en, MB_CASE_TITLE, "UTF-8");
        
        $return_array = [
            // 'translations' => [
            'armenian' => $translated_hy,
            'russian' => $translated_ru,
            'english' => $translated_en,
            // ],
            // 'lang' => 'en'
        ];

        return $return_array;
    }
}
