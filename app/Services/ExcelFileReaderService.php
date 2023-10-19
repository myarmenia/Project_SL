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
    // private $findDataService;

    // public function __construct(FindDataService $findDataService)
    // {
    //     // dd(444);
    //     $this->findDataService = $findDataService;
    //     // dd($this->findDataService);
    // }

    public  static function get($request)
    // public  static function get($bibliographyId,$lang,$title,$column_name,$file)
    {
        // dd($bibliographyId,$lang,$title,$column_name,$file);
        // dd($request);
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

        $fileId = DB::table('file')->insertGetId($file_content);

        // if($created_file) {

        //     BibliographyHasFile::bindBibliographyFile($bibliographyId, $created_file);
        // }
        $fullPath = storage_path('app/' . $path);

        $excelsheetInfo = Excel::toCollection(collect([]), $fullPath);
        $excel_array = $excelsheetInfo[0]->toArray();

        if($title == 'has_title'){

            array_shift($excel_array);

        }
        $man=[];
        $dataToInsert=[];

        foreach ($excel_array as $data => $row) {
            // dd($row);
            foreach($row as $key=>$item){
                // =====
                $translate_text = [];
                if($key == $column_name['first_name']){

                    if($lang!='armenian'){

                        // $translate_text['name'] =ucfirst($item);
                        $translate_text['name'] =$item;
                        $result = TranslateService::translate($translate_text);

                        $translated_name = $result['translations']['armenian']['name'];
                        // dd(gettype($translated_name));
                        // $dataToInsert[$data]['name'] = ucfirst($translated_name);
                        $dataToInsert[$data]['name'] =$translated_name;



                    }else{
                        // dd($result);
                        // $dataToInsert[$data]['name'] = ucfirst($item);
                        $dataToInsert[$data]['name'] = $item;

                    }

                }
                elseif($key == $column_name['last_name']){
                    if($lang!='armenian'){
                        // $translate_text['name'] = ucfirst($item);
                        $translate_text['name'] = $item;
                        $result = TranslateService::translate($translate_text);
                        $translated_name = $result['translations']['armenian']['name'];


                        // $dataToInsert[$data]['surname'] = ucfirst($translated_name);
                        $dataToInsert[$data]['surname'] = $translated_name;

                    }else{
                        $dataToInsert[$data]['surname'] = $item;
                        // $dataToInsert[$data]['surname'] = ucfirst($item);

                    }

                }
                elseif($key == $column_name['middle_name']){

                    if($item!=null){
                        if($lang!='armenian'){
                            // $translate_text['name']=ucfirst($item);
                            $translate_text['name'] = $item;
                            $result = TranslateService::translate($translate_text);
                            $translated_name = $result['translations']['armenian']['name'];

                            $dataToInsert[$data]['patronymic'] =$translated_name;


                        }else{
                            $dataToInsert[$data]['patronymic'] = $item;
                            // $dataToInsert[$data]['patronymic'] = ucfirst($item);


                        }

                    }

                }
                elseif($key == $column_name['birthday']){
                    $dataToInsert=self::get_birthday($key,$data,$column_name,$item,$man,$dataToInsert);



                }

            }

        }
        $getInfo=New findDataService();
        $getInfo->addfilesTableInfo("hasExcell", $dataToInsert, $fileId,$bibliographyId);
        // dd($this->findDataService);
        // $this->findDataService->addfilesTableInfo("hasExcell", $dataToInsert, $fileId,$bibliographyId);
        return true;


    }
    public static function get_birthday($key,$data,$column_name,$item,$man,$dataToInsert){

        if($item==null){

            $dataToInsert[$data]['birth_year'] = null;
            $dataToInsert[$data]['birthday_str'] = null;
            $dataToInsert[$data]['birth_day'] = null;
            $dataToInsert[$data]['birth_month'] = null;

        }else{

            $date_format='';
            if(strlen($item)>=5){
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item);
                $birthday_data=$date->format('Y-m-d');
                $dataToInsert[$data]['birth_year'] = $date->format('Y');
                $dataToInsert[$data]['birthday_str'] =$date->format('Y-m-d');
                $dataToInsert[$data]['birth_day'] = $date->format('d');
                $dataToInsert[$data]['birth_month'] = $date->format('m');
            }
            if(strlen($item)==4){
                // եթե միայն տարին է
                $dataToInsert[$data]['birth_year'] = $item;
                $dataToInsert[$data]['birthday_str'] =$item;

            }
            // dd($item);

        }
        // dd($dataToInsert);
        return $dataToInsert;

    }

}


