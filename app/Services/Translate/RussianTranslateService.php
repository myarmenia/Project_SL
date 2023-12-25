<?php

namespace App\Services\Translate;

class RussianTranslateService
{

    public static function array_any(array $array, string $el)
    {
        foreach ($array as $value) if ($el == $value) return true;
        return false;
    }

    public static function translate($translate_text = [])
    {

        $alphabet_ru = get_ru_alphabet();

        $translated_hy = '';
        $translated_en = '';
        $translated_ru = implode("", $translate_text);

        $arr = [
            'З', 'В', 'Ж', 'з', 'в', 'ж'
        ];

        foreach ($translate_text as $letter_key => $letter) {

            if ($letter == ' ') {
                $translated_hy .= ' ';
                $translated_en .= ' ';
                continue;
            } else if ($letter == '-') {
                $translated_hy .= '-';
                $translated_en .= '-';
                continue;
            }

            if ($letter_key > 0) {
                $alphabet_ru['О']['hy'] = 'Ո';
                $alphabet_ru['о']['hy'] = 'ո';

                $alphabet_ru['Р']['hy'] = 'Ր';
                $alphabet_ru['р']['hy'] = 'ր';
            } else if ($letter_key == 0) {

                $alphabet_ru['О']['hy'] = 'Օ';
                $alphabet_ru['о']['hy'] = 'օ';

                $alphabet_ru['Р']['hy'] = 'Ռ';
                $alphabet_ru['р']['hy'] = 'ռ';
            }

            if (
                self::array_any($arr, $letter)
            ) {

                if (isset($translate_text[$letter_key - 1])) {

                    $l1 = $translate_text[$letter_key - 1] . $translate_text[$letter_key];

                    if (isset($alphabet_ru[$l1])) {

                        $k1 = $alphabet_ru[$l1];
                        $translated_hy = mb_substr($translated_hy, 0, -1, 'UTF-8');
                        $translated_en = mb_substr($translated_en, 0, -1, 'UTF-8');
                    } else {

                        $k1 = $alphabet_ru[$letter];
                    }
                } else {

                    $k1 = $alphabet_ru[$letter];
                }
            } else {

                try {
                    $k1 = $alphabet_ru[$letter];
                } catch (\Throwable $th) {
                   
                }

            }

            $translated_en .= $k1['en'];
            $translated_hy .= $k1['hy'];
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
            // 'lang' => 'ru'
        ];

        return $return_array;
    }

}
