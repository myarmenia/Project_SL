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
            'A', 'U', 'H', 'S', 'Z', 'C', 'E', 'O', 'a', 'u', 'h', 's', 'z', 'c', 'e', 'o', 'v'
        ];

        foreach ($translate_text as $letter_key => $letter) {

            if ($letter == ' ') {
                $translated_hy .= ' ';
                $translated_ru .= ' ';
                continue;
            } else if ($letter == '-') {
                $translated_hy .= '-';
                $translated_ru .= '-';
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

                if (isset($each_letter[$letter_key - 1])) {

                    $l1 = $each_letter[$letter_key - 1] . $each_letter[$letter_key];

                    if (isset($alphabet_en[$l1])) {

                        $k1 = $alphabet_en[$l1];
                        $translated_hy = mb_substr($translated_hy, 0, -1, 'UTF-8');
                        $translated_ru = mb_substr($translated_ru, 0, -1, 'UTF-8');
                    } else {

                        $k1 = $alphabet_ru[$letter];
                    }
                } else {

                    $k1 = $alphabet_ru[$letter];
                }
            } else {

                $k1 = $alphabet_ru[$letter];
            }

            $translated_en .= $k1['en'];
            $translated_hy .= $k1['hy'];
        }

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
