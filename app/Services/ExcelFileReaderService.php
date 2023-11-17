<?php

namespace App\Services;

// use App\Imports\ManImport;
use App\Models\Bibliography\BibliographyHasFile;
use App\Models\File\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class ExcelFileReaderService
{

    public  static function get($request)

    {

        $bibliographyId = $request['bibliography_id'];
        $lang = $request['lang'];
        $title = $request['title'];

        $column_name =FileReaderComponentService::get_column_name($request['column_name']);

        $file = $request['file'];

        $folder_path = 'bibliography'. '/' . $bibliographyId;

        $fileName = time() . '_' . $file->getClientOriginalName();

        $path = FileUploadService::upload($file, $folder_path);
        // // dd($path);
        $file_content = [];
        $file_content['name'] = $fileName;
        $file_content['real_name'] = $file->getClientOriginalName();
        $file_content['path'] = $path;
        $file_content['via_summary'] = 1;

        $file_content['show_folder']=1;

        $fileId = DB::table('file')->insertGetId($file_content);


        $fullPath = storage_path('app/' . $path);

        $excelsheetInfo = Excel::toCollection(collect([]), $fullPath);
        $excel_array = $excelsheetInfo[0]->toArray();

        if($title == 'has_title'){

            array_shift($excel_array);

        }

        $dataToInsert=[];

        foreach ($excel_array as $data => $row) {
            // dd($row);
            // if($data==3){

                foreach($row as $key=>$item){
                    // dd($row);
                    // =====
                    $translate_text = [];
                    if($key == $column_name['first_name-middle_name-last_name']){

                        $names_array=explode(' ',$item);
                        $text='first_name-middle_name-last_name';
                        $keys_array = explode('-',$text);
                            //   dd( $keys_array );
                        $k=[];
                        $a=0;
                        foreach($names_array as  $exploded_key){

                            // dd($keys_array[$a]);
                            $k[$keys_array[$a]] = $exploded_key;
                            $a++;

                        }
                            // dd($k);
                        if($lang!='armenian'){

                            foreach($k as $i=> $word){
                                // dd($word);
                                $translate_text=$word;

                                $result = LearningSystemService::get_info($translate_text);
                                $k[$i]= $result['armenian'];


                            }
                        }

                        $dataToInsert[$data]['name']=$k['first_name'];
                        $dataToInsert[$data]['patronymic'] = $k['middle_name'];
                        $dataToInsert[$data]['surname'] = $k['last_name'];
                        //    dd($dataToInsert);




                    }

                    elseif($key == $column_name['first_name']){

                        if($lang!='armenian'){

                            $translate_text =$item;
                            $result = LearningSystemService::get_info($translate_text);

                            $translated_name = $result['armenian'];

                            $dataToInsert[$data]['name'] =$translated_name;
                            // dd($dataToInsert);



                        }else{
                            // dd($item);
                            $cell_arr='';
                            if(isset($request['fonetic'])){
                                foreach($item->getElements()[0]->getElements() as $unic_item){
                                    // dd($unic_item);
                                    $cell_arr.=$unic_item->getText();
                                }
                             }
                             $unicude_result=ConvertUnicode::convertArm($cell_arr);


                            $dataToInsert[$data]['name'] = $item;

                        }

                    }
                    elseif($key == $column_name['last_name']){
                        if($lang!='armenian'){

                            $translate_text = $item;
                            $result = LearningSystemService::get_info($translate_text);
                            $translated_name = $result['armenian'];



                            $dataToInsert[$data]['surname'] = $translated_name;

                        }else{
                            $dataToInsert[$data]['surname'] = $item;

                        }

                    }
                    elseif($key == $column_name['middle_name']){

                        if($item!=null){
                            if($lang!='armenian'){

                                $translate_text = $item;
                                $result = LearningSystemService::get_info($translate_text);
                                $translated_name = $result['armenian'];

                                $dataToInsert[$data]['patronymic'] =$translated_name;


                            }else{
                                $dataToInsert[$data]['patronymic'] = $item;


                            }

                        }
                        else{
                            $dataToInsert[$data]['patronymic'] =null;
                        }

                    }
                    elseif($key == $column_name['birthday']){
                        // dd($key,$data,$column_name,$item,$dataToInsert);
                        $dataToInsert= self::get_birthday($key,$data,$column_name,$item,$dataToInsert);
                        // dd($dataToInsert);



                    }

                }
            // }
        }
        //   dd($dataToInsert);
        $fileDetails = [
            'file_name'=> $fileName,
            'real_file_name'=> $file->getClientOriginalName(),
            'file_path'=> $path,
            'fileId'=> $fileId,
        ];
        $getInfo=New findDataService();
        $getInfo->addFindDataToInsert($dataToInsert, $fileDetails);

        BibliographyHasFile::bindBibliographyFile($bibliographyId, $fileId);

        return $fileName;

    }
    public static function get_birthday($key,$data,$column_name,$item,$dataToInsert){
// dd($item);
        if($item==null){

            $dataToInsert[$data]['birth_year'] = null;
            $dataToInsert[$data]['birthday_str'] = null;
            $dataToInsert[$data]['birth_day'] = null;
            $dataToInsert[$data]['birth_month'] = null;

        }else{
            // dd($item);
            // dd(strlen($item));

            $date_format='';

            if(strlen($item)>=5){
                //  dd($item);
                if(str_contains($item,".")){
                    $exp_item=explode(".",$item);
                    if($exp_item[0]=="00" && $exp_item[1]=="00" && $exp_item[2]!=="00"){
                        $dataToInsert[$data]['birth_year'] = $exp_item[2];
                        $dataToInsert[$data]['birthday_str'] =$exp_item[2];
                    }
                    else{
                        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item);

                        $birthday_data=$date->format('Y-m-d');
                        $dataToInsert[$data]['birth_year'] = $date->format('Y');
                        $dataToInsert[$data]['birthday_str'] =$date->format('Y-m-d');
                        $dataToInsert[$data]['birth_day'] = $date->format('d');
                        $dataToInsert[$data]['birth_month'] = $date->format('m');

                    }
                }

                // $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item);

                // $birthday_data=$date->format('Y-m-d');
                // $dataToInsert[$data]['birth_year'] = $date->format('Y');
                // $dataToInsert[$data]['birthday_str'] =$date->format('Y-m-d');
                // $dataToInsert[$data]['birth_day'] = $date->format('d');
                // $dataToInsert[$data]['birth_month'] = $date->format('m');

            }
            if(strlen($item)==4){
                // եթե միայն տարին է
                $dataToInsert[$data]['birth_year'] = $item;
                $dataToInsert[$data]['birthday_str'] =$item;

            }



        }
        // dd($dataToInsert);
        return $dataToInsert;

    }
    public static function get_address($key,$data,$column_name,$item,$dataToInsert){

        if($item==null){

            $dataToInsert[$data]['address']['full_address']=null;


        }else{
                // dd($item);
            $dataToInsert[$data]['address']['full_address']=$item;
                // dd($dataToInsert);
            return $dataToInsert;
        }

    }

}


