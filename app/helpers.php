<?php
if(!function_exists('get_en_alphabet')){
    function get_en_alphabet()
    {

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
                'ru' => 'г'
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
                'ru' => 'в'
            ],
        ];

        return $alphabet_en;
    }
}


if(!function_exists('get_ru_alphabet')){

    function get_ru_alphabet()
    {

        $alphabet_ru = [
            'Е' => [
                'hy' => 'Ե',
                'en' => 'YE'
            ],
            'Т' => [
                'hy' => 'Թ',
                'en' => 'TH'
            ],
            'Ж' => [
                'hy' => 'Ժ',
                'en' => 'ZH'
            ],
            'Х' => [
                'hy' => 'Խ',
                'en' => 'KH'
            ],
            'Ц' => [
                'hy' => 'Ծ',
                'en' => 'TS'
            ],
            'ДЗ' => [
                'hy' => 'Ձ',
                'en' => 'DZ'
            ],
            'Х' => [
                'hy' => 'Ղ',
                'en' => 'GH'
            ],
            'Ч' => [
                'hy' => 'Ճ',
                'en' => 'JH'
            ],
            'Ш' => [
                'hy' => 'Շ',
                'en' => 'SH'
            ],
            'Ч' => [
                'hy' => 'Չ',
                'en' => 'CH'
            ],
            'П' => [
                'hy' => 'Փ',
                'en' => 'PH'
            ],

            'ЕВ' => [
                'hy' => 'ԵՎ',
                'en' => 'EV'
            ],

            'Я ' => [
                'hy' => 'ՅԱ',
                'en' => 'YA'
            ],

            'Ю' => [
                'hy' => 'ՅՈՒ',
                'en' => 'YU'
            ],

            'ю' => [
                'hy' => 'յու',
                'en' => 'yu'
            ],

            'Ё' => [
                'hy' => 'ՅՈ',
                'en' => 'YO'
            ],

            'ДЗ' => [
                'hy' => 'Ձ',
                'en' => 'DZ'
            ],

            'Ев' => [
                'hy' => 'ԵՎ',
                'en' => 'EV'
            ],

            'е' => [
                'hy' => 'ե',
                'en' => 'e'
            ],

            'А' => [
                'hy' => 'Ա',
                'en' => 'A'
            ],
            'Б' => [
                'hy' => 'Բ',
                'en' => 'B'
            ],
            'Г' => [
                'hy' => 'Գ',
                'en' => 'G'
            ],
            'Д' => [
                'hy' => 'Դ',
                'en' => 'D'
            ],
            'З' => [
                'hy' => 'Զ',
                'en' => 'Z'
            ],
            'Э' => [
                'hy' => 'Է',
                'en' => 'E'
            ],
            'И' => [
                'hy' => 'Ի',
                'en' => 'I'
            ],
            'Л' => [
                'hy' => 'Լ',
                'en' => 'L'
            ],
            'Х' => [
                'hy' => 'Խ',
                'en' => 'X'
            ],
            'К' => [
                'hy' => 'Կ',
                'en' => 'K'
            ],
            'Г' => [
                'hy' => 'Հ',
                'en' => 'H'
            ],
            'М' => [
                'hy' => 'Մ',
                'en' => 'M'
            ],
            'Й' => [
                'hy' => 'Յ',
                'en' => 'Y'
            ],
            'Н' => [
                'hy' => 'Ն',
                'en' => 'N'
            ],
            'П' => [
                'hy' => 'Պ',
                'en' => 'P'
            ],
            'ДЖ' => [
                'hy' => 'Ջ',
                'en' => 'J'
            ],
            'Р' => [
                'hy' => 'Ռ',
                'en' => 'R'
            ],
            'С' => [
                'hy' => 'Ս',
                'en' => 'S'
            ],
            'В' => [
                'hy' => 'Վ',
                'en' => 'V'
            ],
            'Т' => [
                'hy' => 'Տ',
                'en' => 'Т'
            ],
            'У' => [
                'hy' => 'ՈՒ',
                'en' => 'U'
            ],
            'К' => [
                'hy' => 'Ք',
                'en' => 'Q'
            ],
            'О' => [
                'hy' => 'Օ',
                'en' => 'O'
            ],
            'Ф' => [
                'hy' => 'Ֆ',
                'en' => 'F'
            ],
            'Ц' => [
                'hy' => 'Ց',
                'en' => 'C'
            ],
            'В' => [
                'hy' => 'Վ',
                'en' => 'W'
            ],

            'дж' => [
                'hy' => 'ժ',
                'en' => 'zh'
            ],

            'дз' => [
                'hy' => 'ձ',
                'en' => 'dz'
            ],

            'я' => [
                'hy' => 'յա',
                'en' => 'ya'
            ],

            'ш' => [
                'hy' => 'շ',
                'en' => 'sh'
            ],

            'ж' => [
                'hy' => 'ժ',
                'en' => 'zh'
            ],

            'ё' => [
                'hy' => 'յո',
                'en' => 'yo'
            ],

            'а' => [
                'hy' => 'ա',
                'en' => 'a'
            ],
            'б' => [
                'hy' => 'բ',
                'en' => 'b'
            ],
            'г' => [
                'hy' => 'գ',
                'en' => 'g'
            ],
            'д' => [
                'hy' => 'դ',
                'en' => 'd'
            ],
            'з' => [
                'hy' => 'զ',
                'en' => 'z'
            ],
            'э' => [
                'hy' => 'Է',
                'en' => 'e'
            ],
            'и' => [
                'hy' => 'ի',
                'en' => 'i'
            ],
            'л' => [
                'hy' => 'լ',
                'en' => 'l'
            ],
            'х' => [
                'hy' => 'խ',
                'en' => 'x'
            ],
            'к' => [
                'hy' => 'կ',
                'en' => 'k'
            ],
            'г' => [
                'hy' => 'հ',
                'en' => 'h'
            ],
            'м' => [
                'hy' => 'մ',
                'en' => 'm'
            ],
            'й' => [
                'hy' => 'յ',
                'en' => 'y'
            ],
            'н' => [
                'hy' => 'ն',
                'en' => 'n'
            ],
            'п' => [
                'hy' => 'պ',
                'en' => 'p'
            ],
            'дж' => [
                'hy' => 'ջ',
                'en' => 'j'
            ],
            'р' => [
                'hy' => 'ռ',
                'en' => 'r'
            ],
            'с' => [
                'hy' => 'ս',
                'en' => 's'
            ],
            'в' => [
                'hy' => 'վ',
                'en' => 'v'
            ],
            'т' => [
                'hy' => 'տ',
                'en' => 't'
            ],
            'у' => [
                'hy' => 'ու',
                'en' => 'u'
            ],
            'к' => [
                'hy' => 'ք',
                'en' => 'q'
            ],
            'ев' => [
                'hy' => 'և',
                'en' => 'ev'
            ],
            'о' => [
                'hy' => 'օ',
                'en' => 'o'
            ],
            'ф' => [
                'hy' => 'ֆ',
                'en' => 'f'
            ],
            'ц' => [
                'hy' => 'ց',
                'en' => 'c'
            ],
            'в' => [
                'hy' => 'վ',
                'en' => 'w'
            ],

            'Ь' => [
                'hy' => '',
                'en' => ''
            ],

            'ь' => [
                'hy' => '',
                'en' => ''
            ],
            'ъ' => [
                'hy' => '',
                'en' => ''
            ],
            'Ъ' => [
                'hy' => '',
                'en' => ''
            ],

            'Щ' => [
                'hy' => 'Շ',
                'en' => 'SH'
            ],
            'щ' => [
                'hy' => 'շ',
                'en' => 'sh'
            ]

        ];

        return $alphabet_ru;
    }
}

if (!function_exists('get_am_alphabet')) {

    function get_am_alphabet()
    {

        $alphabet_am = [
            'Ա' => [
                'en' => 'A',
                'ru' => 'А'
            ],
            'Բ' => [
                'en' => 'B',
                'ru' => 'Б'
            ],
            'Գ' => [
                'en' => 'G',
                'ru' => 'Г'
            ],
            'Դ' => [
                'en' => 'D',
                'ru' => 'Д'
            ],
            'Ե' => [
                'en' => 'E',
                'ru' => 'Е'
            ],
            'Զ' => [
                'en' => 'Z',
                'ru' => 'З'
            ],
            'Է' => [
                'en' => 'E',
                'ru' => 'Э'
            ],
            'Ը' => [
                'en' => 'Y',
                'ru' => 'Ы'
            ],
            'Թ' => [
                'en' => 'Th',
                'ru' => 'Т'
            ],
            'Ժ' => [
                'en' => 'Zh',
                'ru' => 'Ж'
            ],
            'Ի' => [
                'en' => 'I',
                'ru' => 'И'
            ],
            'Լ' => [
                'en' => 'L',
                'ru' => 'Л'
            ],
            'Խ' => [
                'en' => 'Kh',
                'ru' => 'Х'
            ],
            'Ծ' => [
                'en' => 'Ts',
                'ru' => 'Ц'
            ],
            'Կ' => [
                'en' => 'K',
                'ru' => 'К'
            ],
            'Հ' => [
                'en' => 'H',
                'ru' => 'Г'
            ],
            'Ձ' => [
                'en' => 'Dz',
                'ru' => 'Дз'
            ],
            'Ղ' => [
                'en' => 'Gh',
                'ru' => 'Х'
            ],
            'Ճ' => [
                'en' => 'Jh',
                'ru' => 'Ч'
            ],
            'Մ' => [
                'en' => 'M',
                'ru' => 'М'
            ],
            'Յ' => [
                'en' => 'Y',
                'ru' => 'Й'
            ],
            'Ն' => [
                'en' => 'N',
                'ru' => 'Н'
            ],
            'Շ' => [
                'en' => 'Sh',
                'ru' => 'Ш'
            ],
            'Ո' => [
                'en' => 'O',
                'ru' => 'О'
            ],
            'Չ' => [
                'en' => 'Ch',
                'ru' => 'Ч'
            ],
            'Պ' => [
                'en' => 'P',
                'ru' => 'П'
            ],
            'Ջ' => [
                'en' => 'J',
                'ru' => 'Дж'
            ],
            'Ռ' => [
                'en' => 'R',
                'ru' => 'Р'
            ],
            'Ս' => [
                'en' => 'S',
                'ru' => 'С'
            ],
            'Վ' => [
                'en' => 'V',
                'ru' => 'В'
            ],
            'Տ' => [
                'en' => 'T',
                'ru' => 'Т'
            ],
            'Ր' => [
                'en' => 'R',
                'ru' => 'Р'
            ],
            'Ց' => [
                'en' => 'C',
                'ru' => 'Ц'
            ],
            'Ւ' => [
                'en' => 'U',
                'ru' => 'У'
            ],
            'Փ' => [
                'en' => 'Ph',
                'ru' => 'П'
            ],
            'Ք' => [
                'en' => 'Q',
                'ru' => 'К'
            ],
            'Օ' => [
                'en' => 'O',
                'ru' => 'О'
            ],
            'Ֆ' => [
                'en' => 'F',
                'ru' => 'Ф'
            ],
            'ԵՎ' => [
                'en' => 'Ev',
                'ru' => 'Ев'
            ],

            'ա' => [
                'en' => 'a',
                'ru' => 'а'
            ],
            'բ' => [
                'en' => 'b',
                'ru' => 'б'
            ],
            'գ' => [
                'en' => 'g',
                'ru' => 'г'
            ],
            'դ' => [
                'en' => 'd',
                'ru' => 'д'
            ],
            'ե' => [
                'en' => 'e',
                'ru' => 'е'
            ],
            'զ' => [
                'en' => 'z',
                'ru' => 'з'
            ],
            'է' => [
                'en' => 'e',
                'ru' => 'э'
            ],
            'ը' => [
                'en' => 'y',
                'ru' => 'ы'
            ],
            'թ' => [
                'en' => 'th',
                'ru' => 'т'
            ],
            'ժ' => [
                'en' => 'zh',
                'ru' => 'ж'
            ],
            'ի' => [
                'en' => 'i',
                'ru' => 'и'
            ],
            'լ' => [
                'en' => 'l',
                'ru' => 'л'
            ],
            'խ' => [
                'en' => 'kh',
                'ru' => 'х'
            ],
            'ծ' => [
                'en' => 'ts',
                'ru' => 'ц'
            ],
            'կ' => [
                'en' => 'k',
                'ru' => 'к'
            ],
            'հ' => [
                'en' => 'h',
                'ru' => 'г'
            ],
            'ձ' => [
                'en' => 'dz',
                'ru' => 'дз'
            ],
            'ղ' => [
                'en' => 'gh',
                'ru' => 'х'
            ],
            'ճ' => [
                'en' => 'jh',
                'ru' => 'ч'
            ],
            'մ' => [
                'en' => 'm',
                'ru' => 'м'
            ],
            'յ' => [
                'en' => 'y',
                'ru' => 'й'
            ],
            'ն' => [
                'en' => 'n',
                'ru' => 'н'
            ],
            'շ' => [
                'en' => 'sh',
                'ru' => 'ш'
            ],
            'ո' => [
                'en' => 'o',
                'ru' => 'о'
            ],
            'չ' => [
                'en' => 'ch',
                'ru' => 'ч'
            ],
            'պ' => [
                'en' => 'p',
                'ru' => 'п'
            ],
            'ջ' => [
                'en' => 'j',
                'ru' => 'дж'
            ],
            'ռ' => [
                'en' => 'r',
                'ru' => 'р'
            ],
            'ս' => [
                'en' => 's',
                'ru' => 'с'
            ],
            'վ' => [
                'en' => 'v',
                'ru' => 'в'
            ],
            'տ' => [
                'en' => 't',
                'ru' => 'т'
            ],
            'ր' => [
                'en' => 'r',
                'ru' => 'р'
            ],
            'ց' => [
                'en' => 'c',
                'ru' => 'ц'
            ],
            'ւ' => [
                'en' => 'u',
                'ru' => 'у'
            ],
            'փ' => [
                'en' => 'ph',
                'ru' => 'п'
            ],
            'ք' => [
                'en' => 'q',
                'ru' => 'к'
            ],
            'օ' => [
                'en' => 'o',
                'ru' => 'о'
            ],
            'ֆ' => [
                'en' => 'f',
                'ru' => 'ф'
            ],
            'և' => [
                'en' => 'ev',
                'ru' => 'ев'
            ],

            'ՅԱ' => [
                'en' => 'Ya',
                'ru' => 'Я'
            ],
            'Յա' => [
                'en' => 'Ya',
                'ru' => 'Я'
            ],
            'յա' => [
                'en' => 'ya',
                'ru' => 'я'
            ],

            'ՅՈՒ' => [
                'en' => 'Yu',
                'ru' => 'Ю'
            ],
            'Յու' => [
                'en' => 'Yu',
                'ru' => 'Ю'
            ],
            'յու' => [
                'en' => 'yu',
                'ru' => 'ю'
            ],

            'ՅՈ' => [
                'en' => 'Yo',
                'ru' => 'Ё'
            ],
            'Յո' => [
                'en' => 'Yo',
                'ru' => 'Ё'
            ],
            'յո' => [
                'en' => 'yo',
                'ru' => 'ё'
            ],

        ];

        return $alphabet_am;
    }
}

