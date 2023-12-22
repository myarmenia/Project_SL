<?php

namespace App\Services;

use App\Models\Bibliography\BibliographyHasFile;
use App\Models\CheckUserList;
use App\Services\Log\LogService;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\IOFactory;

class TableContentService
{
    private $findDataService;
    private $searchItemsInFileService;


    public function __construct(FindDataService $findDataService, SearchItemsInFileService $searchItemsInFileService)
    {
        $this->findDataService = $findDataService;
        $this->searchItemsInFileService = $searchItemsInFileService;
    }

    public function get($request)
    {
// dd($request);

        $bibliographyId = $request['bibliography_id'];
        $lang = $request['lang'];
        $title = $request['title'];

        $column_name = FileReaderComponentService::get_column_name($request['column_name']);
        // dd($column_name);

        $file = $request['file'];

        $folder_path = 'bibliography' . '/' . $bibliographyId;

        $fileName = time() . '_' . $file->getClientOriginalName();

        $path = FileUploadService::upload($file, $folder_path);
        // dd($bibliographyId,$lang, $title,$path );
        $file_content = [];
        $file_content['name'] = $fileName;
        $file_content['real_name'] = $file->getClientOriginalName();
        $file_content['path'] = $path;
        $file_content['via_summary'] = 1;
        $file_content['show_folder'] = 1;
        $fileId = DB::table('file')->insertGetId($file_content);

        $fullPath = storage_path('app/' . $path);
        // dd($fullPath);
        $phpWord = IOFactory::load($fullPath);



        // dd($phpWord);

        $row_content = "";


        $sections = $phpWord->getSections();
        // dd($sections);
        $dataToInsert = [];

        $table_title = 0;

        if ($title == 'has_title') {
            $table_title = 1;
        }

        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {

                if ($element instanceof \PhpOffice\PhpWord\Element\Table) {

                    $rows_array = $element->getRows();
                    if ($title == 'has_title') {
                        array_shift($rows_array);
                    }


                    foreach ($rows_array as $data => $rows) {

                        $cell = $rows->getCells();


                        $translate_text = '';

                        foreach ($cell as $key => $item) {

                            // if ($data == 0) {
                                // dd($item->getElements()[0]->getElements());



                                if ($key == $column_name['first_name-middle_name-last_name']) {

                                    $text = 'first_name-middle_name-last_name';

                                    $dataToInsert = self::get_full_name($lang, $key, $data, $column_name, $item, $text, $dataToInsert);
                                } elseif ($key == $column_name['last_name-first_name-middle_name']) {

                                    $text = 'last_name-first_name-middle_name';

                                    $dataToInsert = self::get_full_name($lang, $key, $data, $column_name, $item, $text, $dataToInsert);
                                } elseif ($key == $column_name['first_name-last_name-middle_name']) {

                                    $text = 'first_name-last_name-middle_name';

                                    $dataToInsert = self::get_full_name($lang, $key, $data, $column_name, $item, $text, $dataToInsert);
                                } elseif ($key == $column_name['birthday-address']) {

                                    $dataToInsert = self::get_birthday($key, $data, $column_name, $item, $dataToInsert);
                                    $dataToInsert = self::get_address($key, $data, $column_name, $item, $dataToInsert);
                                    // dd($dataToInsert[$data]);
                                }
                                elseif ($key == $column_name['first_name']) {

                                    $fonetic_variable=isset($request['fonetic']) ? true: false;

                                    $check_full_cel = self::check_full_cell($key,$lang, $item,$column_name, $fonetic_variable );
                                    $dataToInsert[$data]['name']=$check_full_cel;

                                }
                                // elseif ($key == $column_name['first_name']) {

                                //     // dd($item->getElements()[0]->getElements()[0]->getText());


                                //     if ($lang != 'armenian') {
                                //             // dd($item->getElements()[0]->getElements());
                                //         $translate_text = $item->getElements()[0]->getElements()[0]->getText();

                                //         $result = LearningSystemService::get_info($translate_text);

                                //         $translated_name = $result['armenian'];
                                //         $dataToInsert[$data]['name'] = $translated_name;
                                //     } else {

                                //         $cell_arr = '';


                                //         if (isset($request['fonetic'])) {

                                //             if (count($item->getElements()[0]->getElements()) >= 1) {

                                //                 foreach ($item->getElements()[0]->getElements() as $unic_item) {

                                //                     $cell_arr .= $unic_item->getText();
                                //                 }
                                //             }
                                //             $unicude_result = ConvertUnicode::convertArm($cell_arr);

                                //             $cell_arr = $unicude_result;
                                //         }else{

                                //             $get_multiple_data = self::check_multiple_string($item);

                                //             $cell_arr = $get_multiple_data;

                                //         }

                                //         $dataToInsert[$data]['name'] = $cell_arr;

                                //     }
                                // }
                                elseif ($key == $column_name['last_name']){

                                    $fonetic_variable = isset($request['fonetic']) ? true: false;

                                    $check_full_cel = self::check_full_cell($key,$lang, $item,$column_name, $fonetic_variable );
                                    $dataToInsert[$data]['surname'] = $check_full_cel;

                                }
                                //  elseif ($key == $column_name['last_name']) {
                                //     if ($lang != 'armenian') {
                                //         // dd($item->getElements()[0]);
                                //         $full_lastName = '';
                                //         // dd($item->getElements()[0]->getElements());
                                //         foreach ($item->getElements()[0]->getElements() as $last_elem) {
                                //             // dd($last_elem);
                                //             if (str_contains($last_elem->getText(), "-")) {
                                //                 $explode_elem = explode("-", $last_elem->getText());

                                //                 $translate_text = $explode_elem[0];

                                //                 $result = LearningSystemService::get_info($translate_text);
                                //                 $translated_name = $result['armenian'];

                                //                 $full_lastName .= $translated_name . '-';
                                //             } else {
                                //                 $translate_text = $last_elem->getText();

                                //                 $result = LearningSystemService::get_info($translate_text);
                                //                 $translated_name = $result['armenian'];

                                //                 $full_lastName .= $translated_name;
                                //             }
                                //         }

                                //         $dataToInsert[$data]['surname'] = $full_lastName;
                                //     } else {
                                //         $cell_arr = '';
                                //         if (isset($request['fonetic'])) {

                                //             if (count($item->getElements()[0]->getElements()) >= 1) {

                                //                 foreach ($item->getElements()[0]->getElements() as $unic_item) {
                                //                     // dd($unic_item);
                                //                     $cell_arr .= $unic_item->getText();
                                //                 }
                                //             }
                                //             $unicude_result = ConvertUnicode::convertArm($cell_arr);

                                //             $cell_arr = $unicude_result;
                                //         } else {

                                //             // $cell_arr = $item->getElements()[0]->getElements()[0]->getText();
                                //             $get_multiple_data=self::check_multiple_string($item);
                                //             $cell_arr = $get_multiple_data;
                                //         }

                                //         //    $dataToInsert[$data]['surname'] = $item->getElements()[0]->getElements()[0]->getText();
                                //         $dataToInsert[$data]['surname'] = $cell_arr;
                                //     }
                                // }
                                elseif ($key == $column_name['middle_name']) {

                                    if ($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextRun) {
                                        $fonetic_variable = isset($request['fonetic']) ? true: false;

                                        $check_full_cel = self::check_full_cell($key,$lang, $item,$column_name, $fonetic_variable );
                                        $dataToInsert[$data]['patronymic'] = $check_full_cel;

                                    }
                                    else {
                                        $dataToInsert[$data]['patronymic'] = null;
                                    }

                                }

                                // elseif ($key == $column_name['middle_name']) {
                                //     // dd($item->getElements()[0]);

                                //     if ($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextRun) {
                                //         // dd($item);
                                //         if ($lang != 'armenian') {
                                //             $translate_text = $item->getElements()[0]->getElements()[0]->getText();
                                //             $result = LearningSystemService::get_info($translate_text);
                                //             $translated_name = $result['armenian'];

                                //             $dataToInsert[$data]['patronymic'] = $translated_name;
                                //         } else {
                                //             $cell_arr = '';
                                //             if (isset($request['fonetic'])) {

                                //                 if (count($item->getElements()[0]->getElements()) >= 1) {

                                //                     foreach ($item->getElements()[0]->getElements() as $unic_item) {

                                //                         $cell_arr .= $unic_item->getText();
                                //                     }
                                //                 }
                                //                 $unicude_result = ConvertUnicode::convertArm($cell_arr);

                                //                 $cell_arr = $unicude_result;
                                //             } else {

                                //                 $get_multiple_data = self::check_multiple_string($item);

                                //                 $cell_arr = $get_multiple_data;


                                //             }

                                //             $dataToInsert[$data]['patronymic'] = $cell_arr;
                                //         }
                                //     } else {
                                //         $dataToInsert[$data]['patronymic'] = null;
                                //     }
                                // }
                                 elseif ($key == $column_name['birthday']) {

                                    $dataToInsert = self::get_birthday($key, $data, $column_name, $item, $dataToInsert);
                                }


                            // }

                        }
                    }
                }
            }
        }

        // dd($dataToInsert);
        if ($bibliographyId == null) {

            $checked_user_list = CheckUserList::all();

            if (count($checked_user_list) > 0) {

                foreach ($checked_user_list as $item) {

                    $item->man()->detach();
                    $item->delete();
                }
            }
            $dataToInsert = $this->searchItemsInFileService->checkDataToInsert($dataToInsert);
            // dd($dataToInsert);
            return  $dataToInsert;
        } else {

            $fileDetails = [
                'file_name' => $fileName,
                'real_file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'fileId' => $fileId,
            ];
            // dd($fileDetails);

            $this->findDataService->addFindDataToInsert($dataToInsert, $fileDetails);
            $log = LogService::store($fileDetails, $bibliographyId, 'table_avto', 'create');

            BibliographyHasFile::bindBibliographyFile($bibliographyId, $fileId);
            return $fileName;
        }
    }

    public static function get_birthday($key, $data, $column_name, $item, $dataToInsert)
    {


        // dd($item->getElements()[0]->getElements());
        if ($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextBreak || count($item->getElements()[0]->getElements()) == 0) {

            $dataToInsert[$data]['birth_year'] = null;
            $dataToInsert[$data]['birthday_str'] = null;
            $dataToInsert[$data]['birth_day'] = null;
            $dataToInsert[$data]['birth_month'] = null;
        } else {
            // dd($item->getElements()[0]->getElements()[0]->getText());

            $birthday_data = $item->getElements()[0]->getElements()[0]->getText();
            // dd($birthday_data);
            if (preg_match("/[\'^£$%&*()}{@#~?><>,|=_+¬-]/", $birthday_data)) {

                $dataToInsert[$data]['birth_year'] = null;
                $dataToInsert[$data]['birthday_str'] = null;
                $dataToInsert[$data]['birth_day'] = null;
                $dataToInsert[$data]['birth_month'] = null;
            }

            if (strlen($birthday_data) == 4) {

                $dataToInsert[$data]['birth_year'] = $birthday_data;
                $dataToInsert[$data]['birthday_str'] = $birthday_data;
            } else {
                // dd($birthday_data);

                $explode_data = '';

                if (str_contains($birthday_data, ".",)) {

                    $explode_data = explode(".", $birthday_data);
                }
                if (str_contains($birthday_data, ",")) {
                    $explode_data = explode(",", $birthday_data);
                    $birthday_data = str_replace(',', '.', $birthday_data);
                    // dd($birthday_data);

                }

                if (isset($explode_data[0])) {

                    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $explode_data[0])) {


                        $dataToInsert[$data]['birth_year'] = null;
                        $dataToInsert[$data]['birthday_str'] = null;
                        $dataToInsert[$data]['birth_day'] = null;
                        $dataToInsert[$data]['birth_month'] = null;
                    } else {

                        if (count(str_split($explode_data[0])) > 3) {

                            $dataToInsert[$data]['birth_year'] = $birthday_data;
                            $dataToInsert[$data]['birthday_str'] = $birthday_data;
                        } else {

                            $dataToInsert[$data]['birthday_str'] = $birthday_data;

                            $dataToInsert[$data]['birth_day'] = $explode_data[0];

                            if (isset($explode_data[1])) {

                                $dataToInsert[$data]['birth_month'] = $explode_data[1];
                            }

                            if (isset($explode_data[2])) {

                                $dataToInsert[$data]['birth_year'] = $explode_data[2];
                            }
                        }
                    }
                }
            }
        }
        // dd($dataToInsert);
        return $dataToInsert;
    }
    public static function get_address($key, $data, $column_name, $item, $dataToInsert)
    {

        $full_address = '';

        if ($item->getElements()[1] instanceof \PhpOffice\PhpWord\Element\TextBreak) {


            $dataToInsert[$data]['address'] = null;
            // dd($dataToInsert);
        } else {
            // dd($item->getElements()[1]->getElements());

            $full_address = '';
            $arr = $item->getElements()[1]->getElements();

            $names_array = array_filter($arr, function ($value) {

                return $value->getText() !== '-';
            });
            // dd($names_array);
            // dd($dataToInsert);

            if (count($names_array) > 0) {

                foreach ($names_array as $address_val) {
                    // dd($address_val->getText());
                    $full_address .= $address_val->getText();
                }

                // $dataToInsert[$data]['address']['full_address']=$full_address;
                $dataToInsert[$data]['address'] = $full_address;
                // dd($dataToInsert);
            } else {
                $dataToInsert[$data]['address'] = null;
            }
        }
        // dd($dataToInsert);
        return $dataToInsert;
    }
    public static function get_full_name($lang, $key, $data, $column_name, $item, $text, $dataToInsert)
    {

        $arr = $item->getElements()[0]->getElements();


        $names_array = array_filter($arr, function ($value) {

            return
                $value->getText() !== ' ';
        });

        $keys_array = explode('-', $text);

        $k = [];
        $a = 0;

        foreach ($names_array as  $exploded_key) {

            $k[$keys_array[$a]] = $exploded_key->getText();

            $a++;
        }

        if ($lang != 'armenian') {

            foreach ($k as $i => $word) {

                $translate_text = $word;

                $result = LearningSystemService::get_info($translate_text);
                $k[$i] = $result['armenian'];
            }
        }


        if (isset($request['fonetic'])) {


            $k['first_name'] = ConvertUnicode::convertArm($k['first_name']);

            $k['middle_name'] = ConvertUnicode::convertArm($k['middle_name']);

            $k['last_name'] = ConvertUnicode::convertArm($k['last_name']);

        }



        if (isset($k['first_name'])) {
            $dataToInsert[$data]['name'] = $k['first_name'];
        } else {
            $dataToInsert[$data]['name'] = null;
        }
        if (isset($k['middle_name'])) {
            $dataToInsert[$data]['patronymic'] = $k['middle_name'];
        } else {
            $dataToInsert[$data]['patronymic'] =  null;
        }

        if (isset($k['last_name'])) {
            $dataToInsert[$data]['surname'] = $k['last_name'];
        } else {


            foreach ($keys_array as $key => $value) {
                //dd($key);
                if ($key == 2 && $value == 'last_name') {
                    //dd($keys_array[$key-1]);
                    if (isset($k['middle_name'])) {
                        $surname = $k['middle_name'];
                        $exp_last_name = explode(' ', $surname);
                        if (count($exp_last_name) > 1) {
                            $total = count($exp_last_name);
                            $dataToInsert[$data]['surname'] = $exp_last_name[1];
                            $dataToInsert[$data]['patronymic'] =  $exp_last_name[0];
                        }
                    }
                }
            }


        }

        return $dataToInsert;
    }
    public static function check_multiple_string($item){
        $collect_items='';
        // dd($item);
        $check_empty = $item->getElements()[0]->getElements();

        $array = array_filter( $check_empty, function ($value) {

            return $value->getText() !== ' ';
        });

        foreach($array as $key=>$itm){

            if($key!==0){
                $collect_items .=' ';
            }
            $collect_items .= $itm->getText();

        }

        return  $collect_items;

    }
    public  static function check_full_cell($key,$lang,$item, $column_name, $fonetic){

        $translate_text = $item->getElements()[0]->getElements();


        $cell_arr = '';
        // if($key==$column_name['first_name']){
        // if($key == $column_name['last_name']){
        // if($key == $column_name['middle_name']){
            // dd($translate_text);


            foreach($translate_text as $k=>$txt){

                $get_text = $txt->getText();

                if($k == 0 && $get_text == '-' ){
                    return  $cell_arr = null;
                }

                if($lang == 'english' || $lang == 'russian'){

                    if( $lang == 'russian' && $fonetic){

                        $unicude_result = ConvertUnicode::convertRus($get_text);
                        $get_text = $unicude_result;
                    }

                    if($get_text!=="" ){
                        // dd($get_text);
                        // if($get_text!=='-'){
                        //     if(str_contains( $get_text, "-")) {
                        //     // dd($get_text);

                        //         $explode_elem = explode("-", $get_text);
                        //         dd($explode_elem);
                        //         if(count($explode_elem)){
                        //          $get_text = $explode_elem[0];
                        //         }

                        //     }

                        // }
                        // if($k==4){
                            // dd($get_text);


                        $result = LearningSystemService::get_info($get_text);

                        $translated_name = $result['armenian'];
                        // dd($translated_name);


                        // if(str_contains($txt->getText(), "-")) {

                        //     $cell_arr .=$translated_name.'-';
                        // }else{
                            // $cell_arr .= $translated_name;
                        // }
                        $cell_arr .= $translated_name;
                    }else{
                        $cell_arr=null;
                    }



                }else{
                    // dd($get_text);
                    if($get_text!==""){

                        if($fonetic){

                            $unicude_result = ConvertUnicode::convertArm($get_text);
                            $get_text = $unicude_result;
                        }

                            $cell_arr .=$get_text;

                    }else{
                        $cell_arr=null;
                    }

                }

            }
        // }

        return $cell_arr;

    }

}
