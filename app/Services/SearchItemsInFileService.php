<?php

namespace App\Services;

use App\Models\CheckUserList;
use App\Models\Man\Man;
use Illuminate\Support\Facades\DB;

class SearchItemsInFileService
{

    protected $findDataService;

    public function __construct(FindDataService $findDataService)
    {
        $this->findDataService = $findDataService;
    }


    // ======

    public  function checkDataToInsert($dataToInsert)
    {

        foreach ($dataToInsert as $key => $person) {
            $readyResult = [];

            // $person = $dataToInsert[5];
            // dd($person);

            $result = $this->getDataResult($person);
            // dd($result);
            if ($result['status'] == 'new') {

                // dd($pers);
                $result['person']['status'] = $result['status'];
                $check_user_list = CheckUserList::create($result['person']);

                //add status new and person data  in $readyResult
            } elseif ($result['status'] == 'like') {
                // dd($result);
                //add status like and add people  in $readyResult
                if (count($result['data']) == 0) {
                    $result['person']['status'] = 'new';
                }
                $result['person']['status'] = $result['status'];
                $check_user_list = CheckUserList::create($result['person']);
                if (count($result['data']) > 0) {

                    $check_user_list->man()->attach($result['data'][0]['man']->id);

                    if (isset($result['data'][0]['procent'])) {
                        $arr = [$result['data'][0]['man']->id => ['procent' => $result['data'][0]['procent']]];
                        $check_user_list->man()->sync($arr);
                    }
                }
            } else {
                // dd("Something went wrong");
            }
        }
        // dd($dataToInsert);

        return $dataToInsert;
    }


    public function getDataResult($person)
    {
        $dataForSearch = $this->getFullName($person);
        $name = $dataForSearch['name'];
        $surname = $dataForSearch['surname'];
        $patronymic = $dataForSearch['patronymic'];
        $fullNameArr = [
            'first_name' => $name,
            'last_name' => $surname,
            'middle_name' => $patronymic,
            'full_name' => ''
        ];

        $resultIds  = getSearchMan($fullNameArr);
        $result = getDbManByIds($resultIds);
        if ($result->isEmpty()) {
            return ['status' => 'new', 'person' => $person];
        } else {
            $readyArr = $this->getPersonControl($person, $result);
            return ['status' => 'like', 'person' => $person, 'data' => $readyArr];
        }
    }

    public function getPersonControl($personFile, $people)
    {
        $generalProcent = config("constants.search.PROCENT_GENERAL_MAIN");
        if (isset($personFile['birthday_str'])) {
            $personFile['birthday'] = $personFile['birthday_str'];
        }

        $likePerson = $this->findDataService->getLikeUserProcent($people, $personFile, $generalProcent);

        return $likePerson;
    }

    public function getFullName($data)
    {
        $readyData = [
            'name' => isset($data['name']) ? $data['name'] : '',
            'surname' => isset($data['surname']) ? $data['surname'] : '',
            'patronymic' => isset($data['patronymic']) ? $data['patronymic'] : '',
        ];

        return $readyData;
    }
}
