<?php
namespace App\Services;

use App\Models\FirstName;
use App\Models\LastName;
use App\Models\Man\Man;
use App\Models\MiddleName;
use PhpOffice\PhpWord\IOFactory;

class TableContentService {
    private $findDataService;

    public function __construct(FindDataService $findDataService)
    {
        $this->findDataService = $findDataService;
    }

    public function get($fullPath,$column_name,$file, $fileName, $path){

        $column_name['number']-=1;
        $column_name['first_name']-=1;
        $column_name['last_name']-=1;
        $column_name['middle_name']-=1;
        $column_name['birthday']-=1;
        $column_name['address']-=1;

        $phpWord = IOFactory::load($fullPath);

        // $phpWord = IOFactory::load($fullPath,  'MsDoc');z

        $content = '';
        $row_content="";
        $man=[];

        $sections = $phpWord->getSections();
        $dataToInsert=[];
        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {

                if ($element instanceof \PhpOffice\PhpWord\Element\Table) {
                    $counte = 0;

                    foreach ($element->getRows() as $data=>$rows) {
                        $cell=$rows->getCells();
                        $counte++;

                        $translate_text=[];

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

                            if($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextRun ){
                                $content .='/'.$key_name.'/'.$item->getElements()[0]->getElements()[0]->getText().'/'.$key_name;
                            }


                            if($data!=0){

                            // if($data == 3){

                                if($key == $column_name['first_name']){
                                    $translate_text['name']=$item->getElements()[0]->getElements()[0]->getText();
                                    $result = TranslateService::translate($translate_text);

                                    $translated_name = $result['translations']['armenian']['name'];
                                    $dataToInsert[$data]['name'] = $translated_name;
                                    $man['name']=$translated_name;

                                }
                                elseif($key == $column_name['last_name']){

                                    $translate_text['name'] = $item->getElements()[0]->getElements()[0]->getText();
                                    $result = TranslateService::translate($translate_text);

                                    $translated_name = $result['translations']['armenian']['name'];
                                    $man['surname']=$translated_name;

                                    $dataToInsert[$data]['surname'] = $translated_name;

                                }
                                elseif($key == $column_name['middle_name']){

                                    if($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextRun){

                                        $translate_text['name']=$item->getElements()[0]->getElements()[0]->getText();
                                        $result = TranslateService::translate($translate_text);
                                        $translated_name = $result['translations']['armenian']['name'];

                                        $dataToInsert[$data]['patronymic'] =$translated_name;
                                        $man['patronymic'] = $translated_name;

                                    }

                                }
                                elseif($key == $column_name['birthday']){

                                    if($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextBreak){
                                                $man['birth_year'] = null;
                                                $man['birthday_str'] = null;
                                                $man['birth_day']= null;
                                                $man['birth_month'] = null;

                                                $dataToInsert[$data]['birth_year'] = null;
                                                $dataToInsert[$data]['birthday_str'] = null;
                                                $dataToInsert[$data]['birth_day'] = null;
                                                $dataToInsert[$data]['birth_month'] = null;

                                    }else{

                                            $birthday_data = $item->getElements()[0]->getElements()[0]->getText();
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
                                                        $man['birth_year'] = null;
                                                        $man['birthday_str'] = null;
                                                        $man['birth_day']= null;
                                                        $man['birth_month'] = null;

                                                        $dataToInsert[$data]['birth_year'] = null;
                                                        $dataToInsert[$data]['birthday_str'] = null;
                                                        $dataToInsert[$data]['birth_day'] = null;
                                                        $dataToInsert[$data]['birth_month'] = null;

                                                    }else{

                                                        if(count(str_split($explode_data[0]))>3){

                                                            $man['birth_year'] = $item->getElements()[0]->getElements()[0]->getText();
                                                            $man['birthday_str'] = $item->getElements()[0]->getElements()[0]->getText();

                                                            $dataToInsert[$data]['birth_year'] = $item->getElements()[0]->getElements()[0]->getText();
                                                            $dataToInsert[$data]['birthday_str'] = $item->getElements()[0]->getElements()[0]->getText();

                                                        }else{

                                                            $man['birthday_str'] = $item->getElements()[0]->getElements()[0]->getText();
                                                            $man['birth_day'] =$explode_data[0];
                                                            $dataToInsert[$data]['birthday_str'] = $item->getElements()[0]->getElements()[0]->getText();
                                                            $dataToInsert[$data]['birth_day'] = $explode_data[0];

                                                            if(isset($explode_data[1])){
                                                                $man['birth_month'] = $explode_data[1];
                                                                $dataToInsert[$data]['birth_month'] = $explode_data[1];
                                                            }

                                                            if(isset($explode_data[2])){
                                                                $man['birth_year'] = $explode_data[2];
                                                                $dataToInsert[$data]['birth_year'] = $explode_data[2];
                                                            }

                                                        }

                                                    }

                                            }


                                        }


                                }

                            }


                        }
                        $content .='</hr>';

                    }

                }

            }

        }
        // dd($dataToInsert);
        // return $content;
        $fileDetails = [
            'name' => $fileName,
            'real_name' => $file->getClientOriginalName(),
            'path' => $path
        ];

        $this->findDataService->addFindData("hasExcell", $dataToInsert, $fileDetails);

        return true;

    }

}

