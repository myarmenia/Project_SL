<?php

namespace App\Services;

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


class FindDataService
{
    public function createMan($man, $fileId, $bibliographyid, $key)
    {
        try {
            \DB::beginTransaction();
   
            $manId = Man::addUser($man);
            ManHasFile::bindManFile($manId, $fileId);
            $firstNameId = FirstName::addFirstName($man['name']);
            ManHasFirstName::bindManFirstName($manId, $firstNameId);
            $lastNameId = LastName::addLastName($man['surname']);
            ManHasLastName::bindManLastName($manId, $lastNameId);
            ManHasBibliography::bindManBiblography($manId, $bibliographyid);
            if ($man['patronymic']) {
                $middleNameId = MiddleName::addMiddleName($man['patronymic']);
                ManHasMIddleName::bindManMiddleName($manId, $middleNameId);
            }

            $findTextDetail = [
                'man_id' => $manId,
                'file_id' => $fileId,
                'find_text' => $man['findText'],
                'paragraph' => $man['paragraph'],
            ];

            ManHasFindText::addInfo($findTextDetail);

            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \DB::rollBack();

        } catch (\Error $e) {
            \DB::rollBack();

        }

    }

    public function addFindData($findData, $fileDetail)
    {
        $authUserId = auth()->user()->id;

        if($authUserId){
            $fileId = File::addFile($fileDetail);
            $bibliographyid = Bibliography::addBibliography($authUserId);
            BibliographyHasFile::bindBibliographyFile($bibliographyid, $fileId);
            
            if($fileId){
                foreach ($findData as $key => $man) {
                    $manId = $this->createMan($man, $fileId, $bibliographyid, $key);
                }
            }
        }
    }

}