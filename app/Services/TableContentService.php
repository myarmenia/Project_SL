<?php
namespace App\Services;

use App\Models\FirstName;
use App\Models\LastName;
use App\Models\Man\Man;
use App\Models\MiddleName;
use PhpOffice\PhpWord\IOFactory;

class TableContentService {

    public function get($fullPath,$column_name){
        $column_name['number']-=1;
        $column_name['first_name']-=1;
        $column_name['last_name']-=1;
        $column_name['middle_name']-=1;
        $column_name['birthday']-=1;
        $column_name['address']-=1;

        $phpWord = IOFactory::load($fullPath);

        $content = '';
        $row_content="";
        $man=[];

        $sections = $phpWord->getSections();

        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {


                if ($element instanceof \PhpOffice\PhpWord\Element\Table) {

                    foreach ($element->getRows() as $data=>$rows) {

                        $cell=$rows->getCells();

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
                            // $dataToInsert= [
                                // 'name' => $value[2],
                                // 'surname' => $surname,
                                // 'patronymic' => $patronymic,
                                // 'birthday' => $value[5],
                                // 'birth_day' => $birthDay,
                                // 'birth_month' => $birthMonth,
                                // 'birth_year' => $birthYear,
                                // 'address' => $valueAddress,

                            // ];
                            $dataToInsert= [
                                'name' => '',
                                'surname' => '',
                                'patronymic' => '',
                                'birthday' => '',
                                'birth_day' => '',
                                'birth_month' => '',
                                'birth_year' => '',
                                'address' => '',

                            ];

                            if($data!=0){

                            // $dataToInsert[]=[];

                            // if($data==2){
                                // $dataToInsert=[];
                                // dd($data);

                                if($key==$column_name['last_name']){

                                    $last_name =  LastName::addLastName($item->getElements()[0]->getElements()[0]->getText());
                                    $dataToInsert['surname'] = $item->getElements()[0]->getElements()[0]->getText();



                                }
                                if($key==$column_name['first_name']){

                                    $first_name =  FirstName::addFirstName($item->getElements()[0]->getElements()[0]->getText());
                                    $dataToInsert['name'] = $item->getElements()[0]->getElements()[0]->getText();

                                }
                                if($key == $column_name['middle_name']){

                                    if($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextRun){

                                        $middle_name =  MiddleName::addMiddleName($item->getElements()[0]->getElements()[0]->getText());
                                        $dataToInsert['patronymic'] = $item->getElements()[0]->getElements()[0]->getText();


                                    }
                                    // dd($dataToInsert);
                                }
                                if($key == $column_name['birthday']){

                                    if($item->getElements()[0] instanceof \PhpOffice\PhpWord\Element\TextBreak){
                                                $man['birth_year'] = null;
                                                $man['birthday_str'] = null;
                                                $man['birth_day']= null;
                                                $man['birth_month'] = null;

                                                $id = Man::addUser($man);

                                                $dataToInsert['birth_year'] = null;
                                                $dataToInsert['birthday_str'] = null;
                                                $dataToInsert['birth_day'] = null;
                                                $dataToInsert['birth_month'] = null;



                                    }else{
                                            $birthday_data = $item->getElements()[0]->getElements()[0]->getText();
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
                                                        $id = Man::addUser($man);
                                                        $dataToInsert['birth_year'] = null;
                                                        $dataToInsert['birthday_str'] = null;
                                                        $dataToInsert['birth_day'] = null;
                                                        $dataToInsert['birth_month'] = null;

                                                    }else{

                                                        if(count(str_split($explode_data[0]))>3){
                                                            $man['birth_year'] = $item->getElements()[0]->getElements()[0]->getText();
                                                            $man['birthday_str'] = $item->getElements()[0]->getElements()[0]->getText();
                                                            $id = Man::addUser($man);
                                                            $dataToInsert['birth_year'] = $item->getElements()[0]->getElements()[0]->getText();
                                                            $dataToInsert['birthday_str'] = $item->getElements()[0]->getElements()[0]->getText();

                                                        }else{

                                                            $man['birthday_str'] = $item->getElements()[0]->getElements()[0]->getText();
                                                            $man['birth_day'] =$explode_data[0];
                                                            $dataToInsert['birthday_str'] = $item->getElements()[0]->getElements()[0]->getText();
                                                            $dataToInsert['birth_day'] = $item->getElements()[0]->getElements()[0]->getText();

                                                            if(isset($explode_data[1])){
                                                                    $man['birth_month'] = $explode_data[1];
                                                                    $dataToInsert['birth_month'] = $explode_data[1];
                                                            }
                                                            if(isset($explode_data[2])){
                                                                $man['birth_year'] = $explode_data[2];
                                                                $dataToInsert['birth_year'] = $explode_data[2];
                                                            }

                                                            $id = Man::addUser($man);
                                                        }

                                                    }

                                            }


                                        }


                                }
                                // dd($dataToInsert);
                            }


                        }

                        $content .='</hr>';

                    }
                }

            }

        }


        return $content;
    }

}

