<?php
namespace App\Services;

use App\Models\Bibliography\BibliographyHasFile;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\IOFactory;

class TableContentService {
    private $findDataService;


    public function __construct(FindDataService $findDataService)
    {
        $this->findDataService = $findDataService;
        // dd($this->findDataService);
    }
    // public function get($fullPath,$column_name,$file, $fileName, $path,$lang,$title, $fileId){
    public function get($request){

        // dd($request);
        $bibliographyId = $request['bibliography_id'];
        $lang = $request['lang'];
        $title = $request['title'];

        $column_name =FileReaderComponentService::get_column_name($request['column_name']);
        // dd($column_name);

        $file = $request['file'];

        $folder_path = 'bibliography'. '/' . $bibliographyId;

        $fileName = time() . '_' . $file->getClientOriginalName();
// $p=ConvertUnicode::upload($file);
// dd($p);
        $path = FileUploadService::upload($file, $folder_path);
        // dd($bibliographyId,$lang, $title,$path );
        $file_content = [];
        $file_content['name'] = $fileName;
        $file_content['real_name'] = $file->getClientOriginalName();
        $file_content['path'] = $path;
        $file_content['via_summary'] = 1;
        $file_content['show_folder']=1;
        $fileId = DB::table('file')->insertGetId($file_content);

        $fullPath = storage_path('app/' . $path);
        $phpWord = IOFactory::load($fullPath);




        $content = '';
        $row_content="";


        $sections = $phpWord->getSections();
        // dd($sections);
        $dataToInsert=[];

        $table_title = 0;

        if($title == 'has_title'){
            $table_title = 1;
        }

        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {

                if($element instanceof \PhpOffice\PhpWord\Element\Table) {

                    $rows_array=$element->getRows();
                            if($title == 'has_title'){
                                array_shift($rows_array);
                            }


                    foreach ($rows_array as $data=>$rows) {



                        $cell=$rows->getCells();


                        $translate_text = '';

                        foreach( $cell as $key=>$item ){

                            $key_name = '';


                                if($key==$column_name['number']){
                                    $key_name = 'number';

                                }
                                if($key==$column_name['first_name']){

                                    $key_name = 'first_name';

                                }
                                if($key==$column_name['last_name']){
                                    $key_name = 'last_name';
                                }
                                if($key==$column_name['middle_name']){
                                    $key_name = 'middle_name';
                                }
                                if($key==$column_name['birthday']){
                                    $key_name = 'birthday';
                                }
                                if($key==$column_name['address']){
                                    $key_name = 'address';
                                }

                                // if($key==$column_name['first_name-middle_name-last_name']){


                                //     $text='first_name-middle_name-last_name';
                                //     $ex_name = explode('-',$text);
                                //     // dd($ex_name);

                                //     foreach($ex_name as $exploded_key){
                                //         $key_name = $exploded_key;

                                //     }
                                // }


                                // if($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextRun ){

                                //     $content .='/'.$key_name.'/'.$item->getElements()[0]->getElements()[0]->getText().'/'.$key_name;
                                // }


                            // if($data==5){
                                // dd($item->getElements()[0]->getElements());



                                if($key == $column_name['first_name-middle_name-last_name']){



                                    $arr=$item->getElements()[0]->getElements();

                                    $names_array=array_filter($arr, function($value){
                                        // dd($value->getText());
                                        return
                                      $value->getText() !== ' ';});
                                    //   dd($names_array);
                                       $text='first_name-middle_name-last_name';
                                       $keys_array = explode('-',$text);
                                    //   dd( $keys_array );
                                      $k=[];
                                      $a=0;
                                      foreach($names_array as  $exploded_key){

                                        // dd($keys_array[$a]);
                                          $k[$keys_array[$a]] = $exploded_key->getText();
                                          $a++;

                                      }
                                    //   dd($k);

                                    if($lang!='armenian'){

                                        foreach($k as $i=> $word){
                                            // dd($k[$i]);

                                            $translate_text=$word;

                                            $result = LearningSystemService::get_info($translate_text);
                                            $k[$i]= $result['armenian'];


                                        }
                                    }

                                    if(isset($request['fonetic'])){
                                        // dd($k);

                                        $k['first_name']=ConvertUnicode::convertArm($k['first_name']);
                                        // dd($k['first_name']);
                                        $k['middle_name'] = ConvertUnicode::convertArm($k['middle_name']);
                                        // dd($k['middle_name']);
                                        $k['last_name'] = ConvertUnicode::convertArm($k['last_name']);
                                        // dd($k['last_name']);
                                    }
                                        // dd($k['first_name']);
                                        // dd($k['middle_name']);
                                        // dd($k['last_name']);

                                    $dataToInsert[$data]['name']=$k['first_name'];
                                    $dataToInsert[$data]['patronymic'] = $k['middle_name'];
                                    $dataToInsert[$data]['surname'] = $k['last_name'];

                                        // dd($dataToInsert[$data]);



                                }

                                elseif($key == $column_name['birthday-address']){


                                    $dataToInsert= self::get_birthday($key,$data,$column_name,$item,$dataToInsert);
                                    $dataToInsert= self::get_address($key,$data,$column_name,$item,$dataToInsert);

                                }

                                elseif($key == $column_name['first_name']){
                                    // dd($item->getElements()[0]->getElements()[0]->getText());

                                    if($lang!='armenian'){
                                        $translate_text=$item->getElements()[0]->getElements()[0]->getText();


                                        $result = LearningSystemService::get_info($translate_text);

                                        $translated_name = $result['armenian'];
                                        $dataToInsert[$data]['name'] = $translated_name;





                                    }else{

                                        $cell_arr='';


                                        if(isset($request['fonetic'])){

                                             if(count($item->getElements()[0]->getElements())>=1){

                                                foreach($item->getElements()[0]->getElements() as $unic_item){
                                                    // dd($unic_item);
                                                    $cell_arr.=$unic_item->getText();
                                                }
                                             }
                                             $unicude_result=ConvertUnicode::convertArm($cell_arr);

                                             $cell_arr= $unicude_result;


                                        }
                                        else{
                                            $cell_arr=$item->getElements()[0]->getElements()[0]->getText();
                                        }


                                        $dataToInsert[$data]['name'] = $cell_arr;

                                        // $dataToInsert[$data]['name'] = $item->getElements()[0]->getElements()[0]->getText();


                                    }


                                }
                                elseif($key == $column_name['last_name']){
                                    if($lang!='armenian'){
                                        // dd($item->getElements()[0]);
                                        $full_lastName='';
                                        // dd($item->getElements()[0]->getElements());
                                        foreach($item->getElements()[0]->getElements() as $last_elem){
                                            // dd($last_elem);
                                            if(str_contains($last_elem->getText(),"-")){
                                                $explode_elem=explode('-',$last_elem->getText());

                                                $translate_text =$explode_elem[0];

                                                $result = LearningSystemService::get_info($translate_text);
                                                $translated_name = $result['armenian'];

                                                $full_lastName.=$translated_name.'-';
                                            }else{
                                                $translate_text = $last_elem->getText();

                                                $result = LearningSystemService::get_info($translate_text);
                                                    $translated_name = $result['armenian'];

                                                    $full_lastName.=$translated_name;

                                            }


                                        }

                                        $dataToInsert[$data]['surname'] = $full_lastName;

                                    }else{
                                        $cell_arr='';
                                        if(isset($request['fonetic'])){

                                            if(count($item->getElements()[0]->getElements())>=1){

                                               foreach($item->getElements()[0]->getElements() as $unic_item){
                                                   // dd($unic_item);
                                                   $cell_arr.=$unic_item->getText();
                                               }
                                            }
                                            $unicude_result=ConvertUnicode::convertArm($cell_arr);

                                            $cell_arr= $unicude_result;


                                       }
                                       else{
                                           $cell_arr=$item->getElements()[0]->getElements()[0]->getText();
                                       }

                                    //    $dataToInsert[$data]['surname'] = $item->getElements()[0]->getElements()[0]->getText();
                                        $dataToInsert[$data]['surname'] = $cell_arr;
                                    }
                                }
                                elseif($key == $column_name['middle_name']){
                                    // dd($item->getElements()[0]);

                                    if($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextRun){
                                        // dd($item);
                                        if($lang!='armenian'){
                                            $translate_text=$item->getElements()[0]->getElements()[0]->getText();
                                            $result = LearningSystemService::get_info($translate_text);
                                            $translated_name = $result['armenian'];

                                            $dataToInsert[$data]['patronymic'] =$translated_name;


                                        }else{
                                            $cell_arr='';
                                            if(isset($request['fonetic'])){

                                                if(count($item->getElements()[0]->getElements())>=1){

                                                   foreach($item->getElements()[0]->getElements() as $unic_item){
                                                       // dd($unic_item);
                                                       $cell_arr.=$unic_item->getText();
                                                   }
                                                }
                                                $unicude_result=ConvertUnicode::convertArm($cell_arr);

                                                $cell_arr= $unicude_result;


                                           }
                                           else{
                                               $cell_arr=$item->getElements()[0]->getElements()[0]->getText();
                                           }

                                            $dataToInsert[$data]['patronymic'] =$cell_arr;

                                        }

                                    }else{
                                        $dataToInsert[$data]['patronymic']=null;
                                    }

                                }
                                elseif($key == $column_name['birthday']){

                                    $dataToInsert=self::get_birthday($key,$data,$column_name,$item,$dataToInsert);



                                }



                            // }



                        }
                        // dd($content);
                        $content .='</hr>';

                    }

                }

            }

        }

// dd($dataToInsert);
        $fileDetails = [
            'file_name'=> $fileName,
            'real_file_name'=> $file->getClientOriginalName(),
            'file_path'=> $path,
            'fileId'=> $fileId,
        ];
        // dd($fileDetails);

        $this->findDataService->addFindDataToInsert($dataToInsert, $fileDetails);

        BibliographyHasFile::bindBibliographyFile($bibliographyId, $fileId);
        return $fileName;



    }
    public  static function send_data($key,$data,$column_name,$item,$lang){



    }
    public static function get_birthday($key,$data,$column_name,$item,$dataToInsert){


        if($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextBreak){



            $dataToInsert[$data]['birth_year'] = null;
            $dataToInsert[$data]['birthday_str'] = null;
            $dataToInsert[$data]['birth_day'] = null;
            $dataToInsert[$data]['birth_month'] = null;

        }else{
            // dd($item->getElements()[0]);


            $birthday_data = $item->getElements()[0]->getElements()[0]->getText();
            // dd($birthday_data);
            $explode_data = explode('.',$birthday_data);
            if(str_contains('.',$birthday_data)){

                $explode_data = explode('.',$birthday_data);
            }
            if(str_contains(',',$birthday_data)){
                $explode_data = explode(',',$birthday_data);
            }

            if(isset($explode_data[0])){

                    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $explode_data[0]))
                    {


                        $dataToInsert[$data]['birth_year'] = null;
                        $dataToInsert[$data]['birthday_str'] = null;
                        $dataToInsert[$data]['birth_day'] = null;
                        $dataToInsert[$data]['birth_month'] = null;

                    }else{

                        if(count(str_split($explode_data[0]))>3){



                            $dataToInsert[$data]['birth_year'] = $item->getElements()[0]->getElements()[0]->getText();
                            $dataToInsert[$data]['birthday_str'] = $item->getElements()[0]->getElements()[0]->getText();

                        }else{

                            $dataToInsert[$data]['birthday_str'] = $item->getElements()[0]->getElements()[0]->getText();
                            $dataToInsert[$data]['birth_day'] = $explode_data[0];

                            if(isset($explode_data[1])){

                                $dataToInsert[$data]['birth_month'] = $explode_data[1];
                            }

                            if(isset($explode_data[2])){

                                $dataToInsert[$data]['birth_year'] = $explode_data[2];
                            }

                        }

                    }

            }


        }
        // dd($dataToInsert);
        return $dataToInsert;

    }
    public static function get_address($key,$data,$column_name,$item,$dataToInsert){
        $full_address='';

// dd($item->getElements()[1]);
        if($item->getElements()[1] instanceof \PhpOffice\PhpWord\Element\TextBreak){


            $dataToInsert[$data]['address']['full_address']=null;

        }else{
            $full_address='';
            $arr=$item->getElements()[1]->getElements();
            // dd($arr);
            $names_array=array_filter($arr, function($value){

                return $value->getText()!=='-';
            });
            // dd($names_array);
            // dd($dataToInsert);

                if(count($names_array)>0){

                    foreach($names_array as $address_val){
                        // dd($address_val->getText());
                        $full_address.=$address_val->getText();
                    }

                    $dataToInsert[$data]['address']['full_address']=$full_address;
                    // dd($dataToInsert);
                }



                // dd($dataToInsert);
            return $dataToInsert;
        }

    }

}

