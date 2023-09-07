<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Text_LanguageDetect;

class TranslateController extends Controller
{
    public function translate()
    {

        $languages = [
            'YE' => 'Ե',
            'TH' => 'Թ',
            'ZH' => 'Ժ',
            'KH' => 'Խ',
            'TS' => 'Ծ',
            'DZ' => 'Ձ',
            'GH' => 'Ղ',
            'JH' => 'Ճ',
            'SH' => 'Շ',
            'CH' => 'Չ',
            'PH' => 'Փ',
            'EE' => 'Ի',
            'OO' => 'ՈՒ',

            'Ye' => 'Ե',
            'Th' => 'Թ',
            'Zh' => 'Ժ',
            'Kh' => 'Խ',
            'Ts' => 'Ծ',
            'Dz' => 'Ձ',
            'Gh' => 'Ղ',
            'Jh' => 'Ճ',
            'Sh' => 'Շ',
            'Ch' => 'Չ',
            'Ph' => 'Փ',
            'Ee' => 'Ի',
            'Oo' => 'ՈՒ',

            'A' => 'Ա',
            'B' => 'Բ',
            'G' => 'Գ',
            'D' => 'Դ',
            'Z' => 'Զ',
            'E' => 'Է',
            'I' => 'Ի',
            'L' => 'Լ',
            'K' => 'Կ',
            'H' => 'Հ',
            'M' => 'Մ',
            'Y' => 'Յ',
            'N' => 'Ն',
            'P' => 'Պ',
            'J' => 'Ջ',
            'R' => 'Ռ',
            'S' => 'Ս',
            'V' => 'Վ',
            'T' => 'Տ',
            'U' => 'ՈՒ',
            'Q' => 'Ք',
            'O' => 'Օ',
            'F' => 'Ֆ',
            'C' => 'Ց',
            'W' => 'Վ',

            'ye' => 'ե',
            'th' => 'թ',
            'zh' => 'ժ',
            'kh' => 'խ',
            'ts' => 'ծ',
            'dz' => 'ձ',
            'gh' => 'ղ',
            'jh' => 'ճ',
            'sh' => 'շ',
            'ch' => 'չ',
            'ph' => 'փ',
            'ee' => 'ի',
            'oo' => 'ու',

            'a' => 'ա',
            'b' => 'բ',
            'g' => 'գ',
            'd' => 'դ',
            'z' => 'զ',
            'e' => 'Է',
            'i' => 'ի',
            'l' => 'լ',
            'k' => 'կ',
            'h' => 'հ',
            'm' => 'մ',
            'y' => 'յ',
            'n' => 'ն',
            'p' => 'պ',
            'j' => 'ջ',
            'r' => 'ռ',
            's' => 'ս',
            'v' => 'վ',
            't' => 'տ',
            'u' => 'ու',
            'q' => 'ք',
            'ev' => 'և',
            'o' => 'օ',
            'f' => 'ֆ',
            'c' => 'ց',
            'w' => 'վ',

            // 'А' => 'Ա',
            // 'Б' => 'Բ',
            // 'Г' => 'Գ',
            // 'Д' => 'Դ',
            // 'Е' => 'Ե',
            // 'З' => 'Զ',
            // 'Э' => 'Է',
            // 'ТЕ' => 'Թ',
            // 'Ж' => 'Ժ',
            // 'И' => 'Ի',
            // 'Л' => 'Լ',
            // 'Х' => 'Խ',
            // 'ЦЕ' => 'Ծ',
            // 'К' => 'Կ',
            // 'Г' => 'Հ',
            // 'ДЗ' => 'Ձ',
            // 'ХЭ' => 'Ղ',
            // 'ЧЪ' => 'Ճ',
            // 'М' => 'Մ',
            // 'Й' => 'Յ',
            // 'Н' => 'Ն',
            // 'Ш' => 'Շ',
            // 'О' => 'Ո',
            // 'Ч' => 'Չ',
            // 'П' => 'Պ',
            // 'ДШ' => 'Ջ',
            // 'РЪ' => 'Ռ',
            // 'С' => 'Ս',
            // 'В' => 'Վ',
            // 'Т' => 'Տ',
            // 'Р' => 'Ր',
            // 'Ц' => 'Ց',
            // 'У' => 'ՈՒ',
            // 'ПЭ' => 'Փ',
            // 'КЭ' => 'Ք',
            // // 'EV' => '',
            // 'О' => 'Օ',
            // 'Ф' => 'Ֆ',
            // 'Ю' => 'Ց',
            // 'Я' => 'ՅԱ',
            // 'Ь' => '',
            // 'Ъ' => '',
            // 'Ё' => 'ՅՈ',
        ];


        $arr = [
            'H', 'S', 'Z', 'C', 'E', 'O', 'h', 's', 'z', 'c', 'e', 'o', 'v'
        ];

        $translate_text = 'Ee EE ee';

        $split_text = preg_split('//u', $translate_text, null, PREG_SPLIT_NO_EMPTY);

        $translated_text = '';

        function array_any(array $array, string $el)
        {
            foreach ($array as $value) if ($el == $value) return true;
            return false;
        }

        foreach ($split_text as $key => $item) {

            if ($item == ' ') {
                $translated_text .= ' ';
                continue;
            }

            if ($key > 0) {
                $languages['E'] = 'Ե';
                $languages['e'] = 'ե';
                $languages['O'] = 'Ո';
                $languages['o'] = 'ո';
                $languages['R'] = 'Ր';
                $languages['r'] = 'ր';
            }

            if (
                array_any($arr, $item)
            ) {

                if (isset($split_text[$key - 1])) {
                    $l1 = $split_text[$key - 1] . $split_text[$key];

                    if (isset($languages[$l1])) {
                        $k1 = $languages[$l1];
                        $translated_text = mb_substr($translated_text, 0, -1, 'UTF-8');
                    } else {
                        $k1 = $languages[$item];
                    }
                } else {
                    $k1 = $languages[$item];
                }
            } else {
                $k1 = $languages[$item];
            }

            $translated_text .= $k1;
        }

        dd($translated_text);
    }
}
