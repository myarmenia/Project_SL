<?php

namespace App\Services;

use App\Models\FirstName;
use App\Models\LastName;
use App\Models\Man;
use App\Models\ManHasFirstName;
use App\Models\ManHasLastName;
use App\Models\ManHasMIddleName;
use App\Models\MiddleName;
use PhpOffice\PhpWord\IOFactory;
use App\Models\DataUpload;


class FindDataService
{
    public function createUser($man)
    {
      
        $manId = Man::addUser($man);
        $firstNameId = FirstName::addFirstName($man['name']);
        ManHasFirstName::bindManFirstName($manId, $firstNameId);
        $lastNameId = LastName::addLastName($man['surname']);
        ManHasLastName::bindManLastName($manId, $lastNameId);
        $middleNameId = MiddleName::addMiddleName($man['patronymic']);
        ManHasMIddleName::bindManMiddleName($manId, $middleNameId);

       
    }

    public function addFindData($findData)
    {
        foreach ($findData as $key => $man) {
            $manId = $this->createUser($man);
        }
        dd($findData);
    }

}
