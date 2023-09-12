<?php

namespace App\Services;

class TranslateService
{
    public static function translate($translate_text = '')
    {

        $lang = 'en';

        $alphabet_en = [
            'YE' => [
                'hy' => 'Ե',
                'ru' => 'Е'
            ],
            'TH' => [
                'hy' => 'Թ',
                'ru' => 'Т'
            ],
            'ZH' => [
                'hy' => 'Ժ',
                'ru' => 'Ж'
            ],
            'KH' => [
                'hy' => 'Խ',
                'ru' => 'Х'
            ],
            'TS' => [
                'hy' => 'Ծ',
                'ru' => 'Ц'
            ],
            'DZ' => [
                'hy' => 'Ձ',
                'ru' => 'ДЗ'
            ],
            'GH' => [
                'hy' => 'Ղ',
                'ru' => 'Х'
            ],
            'JH' => [
                'hy' => 'Ճ',
                'ru' => 'Ч'
            ],
            'SH' => [
                'hy' => 'Շ',
                'ru' => 'Ш'
            ],
            'CH' => [
                'hy' => 'Չ',
                'ru' => 'Ч'
            ],
            'PH' => [
                'hy' => 'Փ',
                'ru' => 'П'
            ],
            'EE' => [
                'hy' => 'Ի',
                'ru' => 'И'
            ],

            'OO' => [
                'hy' => 'ՈՒ',
                'ru' => 'У'
            ],

            'EV' => [
                'hy' => 'ԵՎ',
                'ru' => 'ЕВ'
            ],

            'YA' => [
                'hy' => 'ՅԱ',
                'ru' => 'Я'
            ],

            'YU' => [
                'hy' => 'ՅՈՒ',
                'ru' => 'Ю'
            ],

            'YO' => [
                'hy' => 'ՅՈ',
                'ru' => 'Ё'
            ],

            'Ye' => [
                'hy' => 'Ե',
                'ru' => 'Е'
            ],
            'Th' => [
                'hy' => 'Թ',
                'ru' => 'Т'
            ],
            'Zh' => [
                'hy' => 'Ժ',
                'ru' => 'Ж'
            ],
            'Kh' => [
                'hy' => 'Խ',
                'ru' => 'Х'
            ],
            'Ts' => [
                'hy' => 'Ծ',
                'ru' => 'Ц'
            ],
            'Dz' => [
                'hy' => 'Ձ',
                'ru' => 'ДЗ'
            ],
            'Gh' => [
                'hy' => 'Ղ',
                'ru' => 'Х'
            ],
            'Jh' => [
                'hy' => 'Ճ',
                'ru' => 'Ч'
            ],
            'Sh' => [
                'hy' => 'Շ',
                'ru' => 'Ш'
            ],
            'Ch' => [
                'hy' => 'Չ',
                'ru' => 'Ч'
            ],
            'Ph' => [
                'hy' => 'Փ',
                'ru' => 'П'
            ],
            'Ya' => [
                'hy' => 'ՅԱ',
                'ru' => 'Я'
            ],

            'Yu' => [
                'hy' => 'ՅՈՒ',
                'ru' => 'Ю'
            ],

            'Yo' => [
                'hy' => 'ՅՈ',
                'ru' => 'Ё'
            ],
            'Ee' => [
                'hy' => 'Ի',
                'ru' => 'И'
            ],
            'Oo' => [
                'hy' => 'ՈՒ',
                'ru' => 'У'
            ],
            'Ev' => [
                'hy' => 'ԵՎ',
                'ru' => 'ЕВ'
            ],

            'A' => [
                'hy' => 'Ա',
                'ru' => 'А'
            ],
            'B' => [
                'hy' => 'Բ',
                'ru' => 'Б'
            ],
            'G' => [
                'hy' => 'Գ',
                'ru' => 'Г'
            ],
            'D' => [
                'hy' => 'Դ',
                'ru' => 'Д'
            ],
            'Z' => [
                'hy' => 'Զ',
                'ru' => 'З'
            ],
            'E' => [
                'hy' => 'Է',
                'ru' => 'Э'
            ],
            'I' => [
                'hy' => 'Ի',
                'ru' => 'И'
            ],
            'L' => [
                'hy' => 'Լ',
                'ru' => 'Л'
            ],
            'X' => [
                'hy' => 'Խ',
                'ru' => 'Х'
            ],
            'K' => [
                'hy' => 'Կ',
                'ru' => 'К'
            ],
            'H' => [
                'hy' => 'Հ',
                'ru' => 'Г'
            ],
            'M' => [
                'hy' => 'Մ',
                'ru' => 'М'
            ],
            'Y' => [
                'hy' => 'Յ',
                'ru' => 'Й'
            ],
            'N' => [
                'hy' => 'Ն',
                'ru' => 'Н'
            ],
            'P' => [
                'hy' => 'Պ',
                'ru' => 'П'
            ],
            'J' => [
                'hy' => 'Ջ',
                'ru' => 'ДЖ'
            ],
            'R' => [
                'hy' => 'Ռ',
                'ru' => 'Р'
            ],
            'S' => [
                'hy' => 'Ս',
                'ru' => 'С'
            ],
            'V' => [
                'hy' => 'Վ',
                'ru' => 'В'
            ],
            'T' => [
                'hy' => 'Տ',
                'ru' => 'Т'
            ],
            'U' => [
                'hy' => 'ՈՒ',
                'ru' => 'У'
            ],
            'Q' => [
                'hy' => 'Ք',
                'ru' => 'К'
            ],
            'O' => [
                'hy' => 'Օ',
                'ru' => 'О'
            ],
            'F' => [
                'hy' => 'Ֆ',
                'ru' => 'Ф'
            ],
            'C' => [
                'hy' => 'Ց',
                'ru' => 'Ц'
            ],
            'W' => [
                'hy' => 'Վ',
                'ru' => 'В'
            ],

            'ye' => [
                'hy' => 'ե',
                'ru' => 'е'
            ],
            'th' => [
                'hy' => 'թ',
                'ru' => 'т'
            ],
            'zh' => [
                'hy' => 'ժ',
                'ru' => 'дж'
            ],
            'kh' => [
                'hy' => 'խ',
                'ru' => 'х'
            ],
            'ts' => [
                'hy' => 'ծ',
                'ru' => 'ц'
            ],
            'dz' => [
                'hy' => 'ձ',
                'ru' => 'дз'
            ],
            'gh' => [
                'hy' => 'ղ',
                'ru' => 'х'
            ],
            'jh' => [
                'hy' => 'ճ',
                'ru' => 'ч'
            ],
            'sh' => [
                'hy' => 'շ',
                'ru' => 'ш'
            ],
            'ch' => [
                'hy' => 'չ',
                'ru' => 'ч'
            ],
            'ph' => [
                'hy' => 'փ',
                'ru' => 'п'
            ],

            'ya' => [
                'hy' => 'յա',
                'ru' => 'я'
            ],

            'yu' => [
                'hy' => 'յո',
                'ru' => 'ю'
            ],

            'yo' => [
                'hy' => 'յո',
                'ru' => 'ё'
            ],

            'ee' => [
                'hy' => 'ի',
                'ru' => 'и'
            ],
            'oo' => [
                'hy' => 'ու',
                'ru' => 'у'
            ],

            'a' => [
                'hy' => 'ա',
                'ru' => 'а'
            ],
            'b' => [
                'hy' => 'բ',
                'ru' => 'б'
            ],
            'g' => [
                'hy' => 'գ',
                'ru' => 'г'
            ],
            'd' => [
                'hy' => 'դ',
                'ru' => 'д'
            ],
            'z' => [
                'hy' => 'զ',
                'ru' => 'з'
            ],
            'e' => [
                'hy' => 'Է',
                'ru' => 'э'
            ],
            'i' => [
                'hy' => 'ի',
                'ru' => 'и'
            ],
            'l' => [
                'hy' => 'լ',
                'ru' => 'л'
            ],
            'x' => [
                'hy' => 'խ',
                'ru' => 'х'
            ],
            'k' => [
                'hy' => 'կ',
                'ru' => 'к'
            ],
            'h' => [
                'hy' => 'հ',
                'ru' => 'х'
            ],
            'm' => [
                'hy' => 'մ',
                'ru' => 'м'
            ],
            'y' => [
                'hy' => 'յ',
                'ru' => 'й'
            ],
            'n' => [
                'hy' => 'ն',
                'ru' => 'н'
            ],
            'p' => [
                'hy' => 'պ',
                'ru' => 'п'
            ],
            'j' => [
                'hy' => 'ջ',
                'ru' => 'дж'
            ],
            'r' => [
                'hy' => 'ռ',
                'ru' => 'р'
            ],
            's' => [
                'hy' => 'ս',
                'ru' => 'с'
            ],
            'v' => [
                'hy' => 'վ',
                'ru' => 'в'
            ],
            't' => [
                'hy' => 'տ',
                'ru' => 'т'
            ],
            'u' => [
                'hy' => 'ու',
                'ru' => 'у'
            ],
            'q' => [
                'hy' => 'ք',
                'ru' => 'к'
            ],
            'ev' => [
                'hy' => 'և',
                'ru' => 'ев'
            ],
            'o' => [
                'hy' => 'օ',
                'ru' => 'о'
            ],
            'f' => [
                'hy' => 'ֆ',
                'ru' => 'ф'
            ],
            'c' => [
                'hy' => 'ց',
                'ru' => 'ц'
            ],
            'w' => [
                'hy' => 'վ',
                'ry' => 'в'
            ],
        ];

        // $languages_ru = [
        //     'А' => 'Ա',
        //     'Б' => 'Բ',
        //     'Г' => 'Գ',
        //     'Д' => 'Դ',
        //     'Е' => 'Ե',
        //     'З' => 'Զ',
        //     'Э' => 'Է',
        //     'ТЕ' => 'Թ',
        //     'Ж' => 'Ժ',
        //     'И' => 'Ի',
        //     'Л' => 'Լ',
        //     'Х' => 'Խ',
        //     'ЦЕ' => 'Ծ',
        //     'К' => 'Կ',
        //     'Г' => 'Հ',
        //     'ДЗ' => 'Ձ',
        //     'ХЭ' => 'Ղ',
        //     'ЧЪ' => 'Ճ',
        //     'М' => 'Մ',
        //     'Й' => 'Յ',
        //     'Н' => 'Ն',
        //     'Ш' => 'Շ',
        //     'О' => 'Ո',
        //     'Ч' => 'Չ',
        //     'П' => 'Պ',
        //     'ДШ' => 'Ջ',
        //     'РЪ' => 'Ռ',
        //     'С' => 'Ս',
        //     'В' => 'Վ',
        //     'Т' => 'Տ',
        //     'Р' => 'Ր',
        //     'Ц' => 'Ց',
        //     'У' => 'ՈՒ',
        //     'ПЭ' => 'Փ',
        //     'КЭ' => 'Ք',
        //     // 'EV' => '',
        //     'О' => 'Օ',
        //     'Ф' => 'Ֆ',
        //     'Ю' => 'Ց',
        //     'Я' => 'ՅԱ',
        //     'Ь' => '',
        //     'Ъ' => '',
        //     'Ё' => 'ՅՈ',
        // ];

        $arr = [
            'A', 'U', 'H', 'S', 'Z', 'C', 'E', 'O', 'a', 'u', 'h', 's', 'z', 'c', 'e', 'o', 'v'
        ];

        $split_text = preg_split('//u', $translate_text, null, PREG_SPLIT_NO_EMPTY);

        $translated_hy = '';
        $translated_ru = '';
        $translated_en = '';

        function array_any(array $array, string $el)
        {
            foreach ($array as $value) if ($el == $value) return true;
            return false;
        }
        $first_character = 0;

        foreach ($split_text as $key => $item) {

            if (isset($alphabet_en[$item])) {
                $lang = 'en';
                $translated_en = $translate_text;
            }

            if ($item == ' ') {
                $translated_hy .= ' ';
                $translated_ru .= ' ';
                $first_character = 0;
                continue;
            }

            if ($first_character > 0) {
                $alphabet_en['E']['hy'] = 'Ե';
                $alphabet_en['e']['hy'] = 'ե';
                $alphabet_en['O']['hy'] = 'Ո';
                $alphabet_en['o']['hy'] = 'ո';
                $alphabet_en['R']['hy'] = 'Ր';
                $alphabet_en['r']['hy'] = 'ր';
            } else if ($first_character == 0) {
                $alphabet_en['E']['hy'] = 'Է';
                $alphabet_en['e']['hy'] = 'է';
                $alphabet_en['O']['hy'] = 'Օ';
                $alphabet_en['o']['hy'] = 'Օ';
                $alphabet_en['R']['hy'] = 'Ռ';
                $alphabet_en['r']['hy'] = 'ռ';
            }

            if (
                array_any($arr, $item)
            ) {

                if (isset($split_text[$key - 1])) {

                    $l1 = $split_text[$key - 1] . $split_text[$key];

                    if (isset($alphabet_en[$l1])) {
                        if ($lang == 'en') {
                            $k1 = $alphabet_en[$l1];
                            $translated_hy = mb_substr($translated_hy, 0, -1, 'UTF-8');
                            $translated_ru = mb_substr($translated_ru, 0, -1, 'UTF-8');
                        }
                    } else {
                        if ($lang == 'en') {
                            $k1 = $alphabet_en[$item];
                        }
                    }
                } else {
                    if ($lang == 'en') {
                        $k1 = $alphabet_en[$item];
                    }
                }
            } else {
                if ($lang == 'en') {
                    $k1 = $alphabet_en[$item];
                }
            }

            $first_character++;

            if ($lang == 'en') {
                $translated_hy .= $k1['hy'];
                $translated_ru .= $k1['ru'];
            }
        }


        if ($translated_en != '') {
            $translated_en = explode(' ', $translated_en);
        }

        if ($translated_ru != '') {
            $translated_ru = explode(' ', $translated_ru);
        }

        if ($translated_hy != '') {
            $translated_hy = explode(' ', $translated_hy);
        }

        $return_array = [
            'hy' => $translated_hy,
            'ru' => $translated_ru,
            'en' => $translated_en,
            'lang' => $lang
        ];

        return $return_array;
    }
}
