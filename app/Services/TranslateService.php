<?php

namespace App\Services;

use App\Models\LearningSystem;

class TranslateService
{

    public static function array_any(array $array, string $el)
    {
        foreach ($array as $value) if ($el == $value) return true;
        return false;
    }

    // public static function translate($translate_text = [])
    // {

    //     $lang = 'en';

    //     $alphabet_en = get_en_alphabet();
    //     $alphabet_ru = get_ru_alphabet();

    //     $return_array_hy = [];
    //     $return_array_ru = [];
    //     $return_array_en = [];

    //     $arr = [
    //         'A', 'U', 'H', 'S', 'Z', 'C', 'E', 'O', 'a', 'u', 'h', 's', 'z', 'c', 'e', 'o', 'v', 'З', 'В', 'Ж', 'з', 'в', 'ж'
    //     ];

    //     foreach ($translate_text as $key => $item) {
    //         $translated_hy = '';
    //         $translated_ru = '';
    //         $translated_en = '';

    //         $translated_key = $key;
    //         $each_letter = preg_split('//u', $item, null, PREG_SPLIT_NO_EMPTY);
    //         foreach ($each_letter as $letter_key => $letter) {

    //             if ($lang == 'en') {
    //                 if ($letter == ' ') {
    //                     $translated_hy .= ' ';
    //                     $translated_ru .= ' ';
    //                     $first_character = 0;
    //                     continue;
    //                 } else if ($letter == '-') {
    //                     $translated_hy .= '-';
    //                     $translated_ru .= '-';
    //                     continue;
    //                 }
    //             } else if ($lang == 'ru') {
    //                 if ($letter == ' ') {
    //                     $translated_hy .= ' ';
    //                     $translated_en .= ' ';
    //                     $first_character = 0;
    //                     continue;
    //                 } else if ($letter == '-') {
    //                     $translated_hy .= '-';
    //                     $translated_en .= '-';
    //                     continue;
    //                 }
    //             }


    //             if (isset($alphabet_en[$letter])) {
    //                 $lang = 'en';
    //                 $translated_en = $translate_text;
    //             }

    //             if (isset($alphabet_ru[$letter])) {
    //                 $lang = 'ru';
    //                 $translated_ru = $translate_text;
    //             }

    //             if ($lang == 'en') {
    //                 if ($letter_key > 0) {
    //                     $alphabet_en['E']['hy'] = 'Ե';
    //                     $alphabet_en['e']['hy'] = 'ե';

    //                     $alphabet_en['O']['hy'] = 'Ո';
    //                     $alphabet_en['o']['hy'] = 'ո';

    //                     $alphabet_en['R']['hy'] = 'Ր';
    //                     $alphabet_en['r']['hy'] = 'ր';

    //                     $alphabet_en['E']['ru'] = 'Е';
    //                     $alphabet_en['e']['ru'] = 'е';
    //                 } else if ($letter_key == 0) {
    //                     $alphabet_en['E']['hy'] = 'Է';
    //                     $alphabet_en['e']['hy'] = 'է';

    //                     $alphabet_en['O']['hy'] = 'Օ';
    //                     $alphabet_en['o']['hy'] = 'օ';

    //                     $alphabet_en['R']['hy'] = 'Ռ';
    //                     $alphabet_en['r']['hy'] = 'ռ';

    //                     $alphabet_en['E']['ru'] = 'Э';
    //                     $alphabet_en['e']['ru'] = 'э';
    //                 }
    //             }

    //             if ($lang == 'ru') {
    //                 if ($letter_key > 0) {
    //                     $alphabet_ru['О']['hy'] = 'Ո';
    //                     $alphabet_ru['о']['hy'] = 'ո';

    //                     $alphabet_ru['Р']['hy'] = 'Ր';
    //                     $alphabet_ru['р']['hy'] = 'ր';
    //                 } else if ($letter_key == 0) {

    //                     $alphabet_ru['О']['hy'] = 'Օ';
    //                     $alphabet_ru['о']['hy'] = 'օ';

    //                     $alphabet_ru['Р']['hy'] = 'Ռ';
    //                     $alphabet_ru['р']['hy'] = 'ռ';
    //                 }
    //             }

    //             if (
    //                 self::array_any($arr, $letter)
    //             ) {

    //                 if (isset($each_letter[$letter_key - 1])) {

    //                     $l1 = $each_letter[$letter_key - 1] . $each_letter[$letter_key];

    //                     if (isset($alphabet_en[$l1])) {
    //                         if ($lang == 'en') {
    //                             $k1 = $alphabet_en[$l1];
    //                             $translated_hy = mb_substr($translated_hy, 0, -1, 'UTF-8');
    //                             $translated_ru = mb_substr($translated_ru, 0, -1, 'UTF-8');
    //                         } else if ($lang == 'ru') {
    //                             $k1 = $alphabet_ru[$l1];
    //                             $translated_hy = mb_substr($translated_hy, 0, -1, 'UTF-8');
    //                             $translated_ru = mb_substr($translated_ru, 0, -1, 'UTF-8');
    //                         }
    //                     } else {
    //                         if ($lang == 'en') {
    //                             $k1 = $alphabet_en[$letter];
    //                         } else if ($lang == 'ru') {
    //                             $k1 = $alphabet_ru[$letter];
    //                         }
    //                     }
    //                 } else {
    //                     if ($lang == 'en') {
    //                         $k1 = $alphabet_en[$letter];
    //                     } else if ($lang == 'ru') {
    //                         $k1 = $alphabet_ru[$letter];
    //                     }
    //                 }
    //             } else {
    //                 if ($lang == 'en') {
    //                     $k1 = $alphabet_en[$letter];
    //                 } else if ($lang == 'ru') {
    //                     $k1 = $alphabet_ru[$letter];
    //                 }
    //             }
    //             if ($lang == 'en') {
    //                 $translated_hy .= $k1['hy'];
    //                 $translated_ru .= $k1['ru'];
    //             } else if ($lang == 'ru') {
    //                 $translated_hy .= $k1['hy'];
    //                 $translated_en .= $k1['en'];
    //             }
    //         }

    //         if ($lang == 'en') {
    //             $return_array_hy[$translated_key] = $translated_hy;
    //             $return_array_ru[$translated_key] = $translated_ru;
    //             $return_array_en = $translated_en;
    //         }
    //         if ($lang == 'ru') {
    //             $return_array_hy[$translated_key] = $translated_hy;
    //             $return_array_en[$translated_key] = $translated_en;
    //             $return_array_ru = $translated_ru;
    //         }
    //     }

    //     $return_array = [
    //         'translations' => [
    //             'armenian' => $return_array_hy,
    //             'russian' => $return_array_ru,
    //             'english' => $return_array_en,
    //         ],
    //         'lang' => $lang
    //     ];

    //     return $return_array;
    // }
}
