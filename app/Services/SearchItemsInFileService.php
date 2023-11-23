<?php

namespace App\Services;

use App\Models\Man\Man;
use Illuminate\Support\Facades\DB;

class SearchItemsInFileService {

    protected $findDataService;

    public function __construct(FindDataService $findDataService)
    {
        $this->findDataService = $findDataService;
    }

    public  function checkDataToInsert($dataToInsert)
    {

        foreach ($dataToInsert as $key => $person) {
            $readyResult = [];
            $result = $this->getDataResult($person);
            if($result['status'] == 'new'){
                //add status new and person data  in $readyResult
            }elseif($result['status'] == 'like'){
                //add status like and add people  in $readyResult
            }else{
                dd("Something went wrong");
            }

        }

        return $dataToInsert;
    }

    public function getDataResult($person)
    {
        $dataForSearch = $this->getFullName($person);
        $name = $dataForSearch['name'];
        $surname = $dataForSearch['surname'];
        $patronymic = $dataForSearch['patronymic'];
        $result = getSearchMan($name, $surname, $patronymic);

        if($result->isEmpty()){
            return ['status' => 'new', 'person' => $person];
        } else {
            $readyArr = $this->getPersonControl($person, $result);
            return ['status' => 'like', 'person' => $person, 'data' => $readyArr];
        }
     
    }

    public function getPersonControl($personFile, $people)
    {
        $generalProcent = config("constants.search.PROCENT_GENERAL_MAIN");
        if(isset($personFile['birthday_str'])){
            $personFile['birthday'] = $personFile['birthday_str'];
        }

        $likePerson = $this->findDataService->getLikeUserProcent($people, $personFile, $generalProcent);

        return $likePerson;

    }

    public function getFullName($data)
    {
        $readyData = [
            'name' => isset($data['name'])?$data['name']:'',
            'surname' => isset($data['surname'])?$data['surname']:'',
            'patronymic' => isset($data['patronymic'])?$data['patronymic']:'',
        ];
        
        return $readyData;
    }


   
}
