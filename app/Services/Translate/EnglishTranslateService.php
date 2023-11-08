<?php

namespace App\Services\Translate;

class EnglishTranslateService
{

    public static function array_any(array $array, string $el)
    {
        foreach ($array as $value) if ($el == $value) return true;
        return false;
    }

    public static function translate($translate_text = [])
    {
        $alphabet_en = get_en_alphabet();

        $translated_hy = '';
        $translated_ru = '';
        $translated_en = implode("", $translate_text);

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
                $alphabet_en['E']['hy'] = 'Ե';
                $alphabet_en['e']['hy'] = 'ե';

                $alphabet_en['O']['hy'] = 'Ո';
                $alphabet_en['o']['hy'] = 'ո';

                $alphabet_en['R']['hy'] = 'Ր';
                $alphabet_en['r']['hy'] = 'ր';

                $alphabet_en['E']['ru'] = 'Е';
                $alphabet_en['e']['ru'] = 'е';
            } else if ($letter_key == 0) {
                $alphabet_en['E']['hy'] = 'Է';
                $alphabet_en['e']['hy'] = 'է';

                $alphabet_en['O']['hy'] = 'Օ';
                $alphabet_en['o']['hy'] = 'օ';

                $alphabet_en['R']['hy'] = 'Ռ';
                $alphabet_en['r']['hy'] = 'ռ';

                $alphabet_en['E']['ru'] = 'Э';
                $alphabet_en['e']['ru'] = 'э';
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

                        $k1 = $alphabet_en[$letter];
                    }
                } else {

                    $k1 = $alphabet_en[$letter];
                }
            } else {

                $k1 = $alphabet_en[$letter];
            }

            $translated_hy .= $k1['hy'];
            $translated_ru .= $k1['ru'];
        }

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
