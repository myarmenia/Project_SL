<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Bibliography\Bibliography;
use App\Models\Bibliography\BibliographyHasFile;
use App\Models\Man\ManHasBibliography;
use App\Models\Man\ManHasFile;
use App\Models\FirstName;
use App\Models\LastName;
use App\Models\Man\Man;
use App\Models\Man\ManHasFindText;
use App\Models\Man\ManHasFirstName;
use App\Models\Man\ManHasLastName;
use App\Models\Man\ManHasMIddleName;
use App\Models\MiddleName;
use App\Models\File\File;
use PhpOffice\PhpWord\IOFactory;
use App\Models\DataUpload;
use App\Models\Man\ManHasAddress;
use Illuminate\Support\Facades\DB;



class FindDataService
{
    public function createMan($docFormat, $man, $fileId, $bibliographyid, $key)
    {
        // dd($man);
        try {
            DB::beginTransaction();

            $manId = Man::addUser($man);

            ManHasFile::bindManFile($manId, $fileId);
            $firstNameId = FirstName::addFirstName($man['name']);
            ManHasFirstName::bindManFirstName($manId, $firstNameId);
            $lastNameId = LastName::addLastName($man['surname']);
            ManHasLastName::bindManLastName($manId, $lastNameId);
            ManHasBibliography::bindManBiblography($manId, $bibliographyid);
            if (isset($man['patronymic'])) {
                $middleNameId = MiddleName::addMiddleName($man['patronymic']);
                ManHasMIddleName::bindManMiddleName($manId, $middleNameId);
            }
            if(isset($man['address'])){
                $addAddressId =Address::addAddres($man['address']);
                ManHasAddress::bindManAddress($manId,$addAddressId);
            }

            if($docFormat != "hasExcell"){
                $findTextDetail = [
                    'man_id' => $manId,
                    'file_id' => $fileId,
                    'find_text' => $man['find_text'],
                    'paragraph' => $man['paragraph'],
                ];

                ManHasFindText::addInfo($findTextDetail);
            }

            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \Log::info("Man Exception");
            \Log::info($e);
            \DB::rollBack();

        } catch (\Error $e) {
            \Log::info("Man Error");
            \Log::info($e);
            \DB::rollBack();

        }

    }

    public function addFindData($docFormat, $findData, $fileId)
    {

        $authUserId = auth()->user()->id;

        if($authUserId){
            $bibliographyid = Bibliography::addBibliography($authUserId);
            BibliographyHasFile::bindBibliographyFile($bibliographyid, $fileId);

            if($fileId){
                foreach ($findData as $key => $man) {
                    $this->createMan($docFormat, $man, $fileId, $bibliographyid, $key);
                }
            }
        }
    }

}
