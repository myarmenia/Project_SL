<?php


namespace App\Services;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Illuminate\Support\Str;

class ConvertUnicode
{


    public static function convertArm($myString)
    {

        // dd($myString);

        $characters = mb_str_split($myString, 1, 'UTF-8');
        $customFontText = '';
        // dd($characters);
        foreach ($characters as $char) {

            // Your switch statement logic here
            switch ($char) {
                case 'ª':
                    $customFontText .= '՝';
                    break;
                case '¿':
                    $customFontText .= 'է';
                    break;
                case 'Ã':
                    $customFontText .= 'թ';
                    break;
                case '÷':
                    $customFontText .= 'փ';
                    break;
                case 'Ó':
                    $customFontText .= 'ձ';
                    break;
                case 'ç':
                    $customFontText .= 'ջ';
                    break;
                case 'ô':
                    $customFontText .= 'Ւ';
                    break;
                case '¨':
                    $customFontText .= 'և';
                    break;
                case 'ñ':
                    $customFontText .= 'ր';
                    break;
                case 'ã':
                    $customFontText .= 'չ';
                    break;
                case '×':
                    $customFontText .= 'ճ';
                    break;


                case 'ù':
                    $customFontText .= 'ք';
                    break;
                case 'á':
                    $customFontText .= 'ո';
                    break;
                case '»':
                    $customFontText .= 'ե';
                    break;
                case 'é':
                    $customFontText .= 'ռ';
                    break;
                case 'ï':
                    $customFontText .= 'տ';
                    break;
                case 'Á':
                    $customFontText .= 'ը';
                    break;
                case 'õ':
                    $customFontText .= 'ւ';
                    break;
                case 'Ç':
                    $customFontText .= 'ի';
                    break;
                case 'û':
                    $customFontText .= 'օ';
                    break;
                case 'å':
                    $customFontText .= 'պ';
                    break;
                case 'Ë':
                    $customFontText .= 'խ';
                    break;
                case 'Í':
                    $customFontText .= 'ծ';
                    break;
                case 'Å':
                    $customFontText .= 'ժ';
                    break;


                case '³':
                    $customFontText .= 'ա';
                    break;
                case 'ë':
                    $customFontText .= 'ս';
                    break;
                case '¹':
                    $customFontText .= 'դ';
                    break;
                case 'ý':
                    $customFontText .= 'ֆ';
                    break;
                case '·':
                    $customFontText .= 'գ';
                    break;
                case 'Ñ':
                    $customFontText .= 'հ';
                    break;
                case 'Û':
                    $customFontText .= 'յ';
                    break;
                case 'Ï':
                    $customFontText .= 'կ';
                    break;
                case 'É':
                    $customFontText .= 'լ';
                    break;
                case '°':
                    $customFontText .= '՛';
                    break;
                case 'ß':
                    $customFontText .= 'շ';
                    break;
                case '•':
                    $customFontText .= 'գ';
                    break;


                case '½':
                    $customFontText .= 'զ';
                    break;
                case 'Õ':
                    $customFontText .= 'ղ';
                    break;
                case 'ó':
                    $customFontText .= 'ց';
                    break;
                case 'í':
                    $customFontText .= 'վ';
                    break;
                case 'µ':
                    $customFontText .= 'բ';
                    break;
                case 'Ý':
                    $customFontText .= 'ն';
                    break;
                case 'Ù':
                    $customFontText .= 'մ';
                    break;

                    ///
                case '¯':
                    $customFontText .= '՜';
                    break;
                case '¾':
                    $customFontText .= 'Է';
                    break;
                case 'Â':
                    $customFontText .= 'Թ';
                    break;
                case 'ö':
                    $customFontText .= 'Փ';
                    break;
                case 'Ò':
                    $customFontText .= 'Ձ';
                    break;
                case 'æ':
                    $customFontText .= 'Ջ';
                    break;
                case 'ô':
                    $customFontText .= 'Ւ';
                    break;
                case '¨':
                    $customFontText .= 'և';
                    break;
                case 'ð':
                    $customFontText .= 'Ր';
                    break;
                case 'â':
                    $customFontText .= 'Չ';
                    break;
                case 'Ö':
                    $customFontText .= 'Ճ';
                    break;
                case 'Ä':
                    $customFontText .= 'Ժ';
                    break;

                case 'ø':
                    $customFontText .= 'Ք';
                    break;
                case 'à':
                    $customFontText .= 'Ո';
                    break;
                case 'º':
                    $customFontText .= 'Ե';
                    break;
                case 'è':
                    $customFontText .= 'Ռ';
                    break;
                case 'î':
                    $customFontText .= 'Տ';
                    break;
                case 'À':
                    $customFontText .= 'Ը';
                    break;
                case 'ô':
                    $customFontText .= 'Ւ';
                    break;
                case 'Æ':
                    $customFontText .= 'Ի';
                    break;
                case 'ú':
                    $customFontText .= 'Օ';
                    break;
                case 'ä':
                    $customFontText .= 'Պ';
                    break;
                case 'Ê':
                    $customFontText .= 'Խ';
                    break;
                case 'Ì':
                    $customFontText .= 'Ծ';
                    break;

                case '²':
                    $customFontText .= 'Ա';
                    break;
                case 'ê':
                    $customFontText .= 'Ս';
                    break;
                case '¸':
                    $customFontText .= 'Դ';
                    break;
                case 'ü':
                    $customFontText .= 'Ֆ';
                    break;
                case '¶':
                    $customFontText .= 'Գ';
                    break;
                case 'Ð':
                    $customFontText .= 'Հ';
                    break;
                case 'Ú':
                    $customFontText .= 'Յ';
                    break;
                case 'Î':
                    $customFontText .= 'Կ';
                    break;
                case 'È':
                    $customFontText .= 'Լ';
                    break;
                case '±':
                    $customFontText .= '՞';
                    break;
                case 'Þ':
                    $customFontText .= 'Շ';
                    break;

                case '¼':
                    $customFontText .= 'Զ';
                    break;
                case 'Ô':
                    $customFontText .= 'Ղ';
                    break;
                case 'ò':
                    $customFontText .= 'Ց';
                    break;
                case 'ì':
                    $customFontText .= 'Վ';
                    break;
                case '´':
                    $customFontText .= 'Բ';
                    break;
                case 'Ü':
                    $customFontText .= 'Ն';
                    break;
                case 'Ø':
                    $customFontText .= 'Մ';
                    break;
                case '¦':
                    $customFontText .= 'ՙ';
                    break;
                case '§':
                    $customFontText .= '՚';
                    break;
                case '?':
                    $customFontText .= '?';
                    break;
                default:
                    $customFontText .= $char;
            }
        }

        return $customFontText;
    }
    public static function convertRus( $myString)
    {

            $characters = mb_str_split($myString, 1, 'UTF-8');
            $customFontText = '';

            foreach ($characters as $char) {

                // Your switch statement logic here
                switch ($char) {
                    case '÷':
                        $customFontText .= 'ч';
                        break;
                    case 'þ':
                        $customFontText .= 'ю';
                        break;
                    case 'ÿ':
                        $customFontText .= 'я';
                        break;
                    case 'â':
                        $customFontText .= 'в';
                        break;
                    case 'å':
                        $customFontText .= 'е';
                        break;
                    case 'ð':
                        $customFontText .= 'р';
                        break;
                    case 'ò':
                        $customFontText .= 'т';
                        break;
                    case 'û':
                        $customFontText .= 'ы';
                        break;
                    case 'ó':
                        $customFontText .= 'у';
                        break;
                    case 'è':
                        $customFontText .= 'и';
                        break;
                    case 'î':
                        $customFontText .= 'о';
                        break;
                    case 'ï':
                        $customFontText .= 'п';
                        break;

                    case 'ø':
                        $customFontText .= 'ш';
                        break;
                    case 'ù':
                        $customFontText .= 'щ';
                        break;
                    case 'ý':
                        $customFontText .= 'э';
                        break;

                    case 'à':
                        $customFontText .= 'а';
                        break;
                    case 'ñ':
                        $customFontText .= 'с';
                        break;
                    case 'ä':
                        $customFontText .= 'д';
                        break;
                    case 'ô':
                        $customFontText .= 'ф';
                        break;
                    case 'ã':
                        $customFontText .= 'г';
                        break;
                    case 'õ':
                        $customFontText .= 'х';
                        break;
                    case 'é':
                        $customFontText .= 'й';
                        break;
                    case 'ê':
                        $customFontText .= 'к';
                        break;
                    case 'ë':
                        $customFontText .= 'л';
                        break;

                    case 'ç':
                        $customFontText .= 'з';
                        break;
                    case 'ü':
                        $customFontText .= 'ь';
                        break;
                    case 'ö':
                        $customFontText .= 'ц';
                        break;
                    case 'æ':
                        $customFontText .= 'ж';
                        break;
                    case 'á':
                        $customFontText .= 'б';
                        break;
                    case 'í':
                        $customFontText .= 'н';
                        break;
                    case 'ì':
                        $customFontText .= 'м';
                        break;


                    ///
                    case '×':
                        $customFontText .= 'Ч';
                        break;
                    case 'ú':
                        $customFontText .= 'ъ';
                        break;
                    case 'Ú':
                        $customFontText .= 'Ъ';
                        break;
                    case '¸':
                        $customFontText .= 'ё';
                        break;
                    case '¨':
                        $customFontText .= 'Ё';
                        break;
                    case 'Þ':
                        $customFontText .= 'Ю';


                        break;
                    case 'ß':
                        $customFontText .= 'Я';
                        break;
                    case 'Â':
                        $customFontText .= 'В';
                        break;
                    case 'Å':
                        $customFontText .= 'Е';
                        break;
                    case 'Ð':
                        $customFontText .= 'Р';
                        break;
                    case 'Ò':
                        $customFontText .= 'Т';
                        break;
                    case 'Û':
                        $customFontText .= 'У';
                        break;
                    case 'È':
                        $customFontText .= 'И';
                        break;
                    case 'Î':
                        $customFontText .= 'О';
                        break;
                    case 'Ï':
                        $customFontText .= 'П';
                        break;
                    case 'Ø':
                        $customFontText .= 'Ш';
                        break;
                    case 'Ù':
                        $customFontText .= 'Щ';
                        break;
                    case 'Ý':
                        $customFontText .= 'Э';
                        break;

                    case 'À':
                        $customFontText .= 'А';
                        break;
                    case 'Ñ':
                        $customFontText .= 'С';
                        break;
                    case 'Ä':
                        $customFontText .= 'Д';
                        break;
                    case 'Ô':
                        $customFontText .= 'Ф';
                        break;
                    case 'Ã':
                        $customFontText .= 'Г';
                        break;
                    case 'Õ':
                        $customFontText .= 'Х';
                        break;
                    case 'É':
                        $customFontText .= 'К';
                        break;
                    case 'Ë':
                        $customFontText .= 'Л';
                        break;

                    case 'Ç':
                        $customFontText .= 'З';
                        break;
                    case 'Ü':
                        $customFontText .= 'Ь';
                        break;
                    case 'Ö':
                        $customFontText .= 'Ц';
                        break;
                    case 'Æ':
                        $customFontText .= 'Ж';
                        break;
                    case 'Á':
                        $customFontText .= 'Б';
                        break;
                    case 'Í':
                        $customFontText .= 'Н';
                        break;
                    case 'Ì':
                        $customFontText .= 'М';
                        break;
                    case 'ú':
                        $customFontText .= '<';
                        break;
                    case 'Ú':
                        $customFontText .= '>';
                        break;
                    case 'Ý':
                        $customFontText .= '?';
                        break;
                    default:
                        $customFontText .= $char;
                }
            }

        return $customFontText;
    }
}
