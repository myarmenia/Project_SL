<?php

namespace App\Services;

use App\Models\Bibliography\BibliographyHasFile;
use App\Models\FirstName;
use App\Models\LastName;
use App\Models\Man\Man;
use App\Models\Man\ManHasBibliography;
use App\Models\Man\ManHasFindText;
use App\Models\Man\ManHasFirstName;
use App\Models\Man\ManHasLastName;
use App\Models\Man\ManHasMIddleName;
use App\Models\MiddleName;
use App\Models\TempTables\TmpManFindText;
use App\Models\TempTables\TmpManFindTextsHasMan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class FindDataService
{
    public function createMan(
        $docFormat,
        $man,
        $fileId,
        $bibliographyid,
        $key = null
    ) {
        // dd($man);
        // try {
        //     DB::beginTransaction();

            $manId = Man::addUser($man);
            // LogService::store(['addedManId'=>$manId], null, 'man', 'create');

            // ManHasFile::bindManFile($manId, $fileId);
            $firstNameId = FirstName::addFirstName($man["name"]);
            if($firstNameId){
                ManHasFirstName::bindManFirstName($manId, $firstNameId);
            }
            $lastNameId = LastName::addLastName($man["surname"]);
            ManHasLastName::bindManLastName($manId, $lastNameId);
            ManHasBibliography::bindManBiblography($manId, $bibliographyid);
            if (isset($man["patronymic"])) {
                $middleNameId = MiddleName::addMiddleName($man["patronymic"]);
                ManHasMIddleName::bindManMiddleName($manId, $middleNameId);
            }
            // if (isset($man["address"])) {
            //     $addAddressId = Address::addAddres($man["address"]);
            //     ManHasAddress::bindManAddress($manId, $addAddressId);
            // }

            if ($docFormat != "hasExcell") {
                $findTextDetail = [
                    "man_id" => $manId,
                    "file_id" => $fileId,
                    "find_text" => $man["find_text"],
                    "paragraph" => $man["paragraph"],
                ];

                ManHasFindText::addInfo($findTextDetail);
            }

            // \DB::commit();
            return $manId;
        // } catch (\Exception $e) {
        //     \Log::info("Man Exception", ["Error" => $e->getMessage()]);
        //     \DB::rollBack();
        // } catch (\Error $e) {
        //     \Log::info("Man Error", ["Error" => $e->getMessage()]);
        //     \DB::rollBack();
        // }
    }

    public function addFindData($docFormat, $findData, $fileId)
    {

        $bibliographyid = BibliographyHasFile::where(
            "file_id",
            $fileId
        )->first()->bibliography_id;

        if ($fileId) {
            if (gettype($findData) == "object") {
                $id = $this->createMan(
                    $docFormat,
                    $findData,
                    $fileId,
                    $bibliographyid
                );
                return $id;
            } else {
                foreach ($findData as $key => $man) {
                    $this->createMan(
                        $docFormat,
                        $man,
                        $fileId,
                        $bibliographyid,
                        $key
                    );
                }
            }
        }

    }

    public function addfilesTableInfo(
        $docFormat,
        $dataToInsert,
        $fileId,
        $bibliographyid
    ) {
        BibliographyHasFile::bindBibliographyFile($bibliographyid, $fileId);

        foreach ($dataToInsert as $key => $man) {
            $this->createMan($docFormat, $man, $fileId, $bibliographyid, $key);
        }
    }

    public function addFindDataToInsert($dataToInsert, $fileDetails)
    {

        foreach ($dataToInsert as $idx => $item) {
            // dd($item);
            $item["file_name"] = $fileDetails["file_name"];
            $item["real_file_name"] = $fileDetails["real_file_name"];
            $item["file_path"] = $fileDetails["file_path"];
            $item["file_id"] = $fileDetails["fileId"];
            if(isset($item["birthday_str"])){
                $item["birthday"] = $item["birthday_str"];
        }
            $tmpItem = TmpManFindText::create($item);

            $procentName = 0;
            $procentLastName = 0;
            $procentMiddleName = 0;

            $searchTermName = $item["name"];
            $searchTermSurname = $item["surname"];

            $getLikeMan = $this->getSearchMan($searchTermName, $searchTermSurname);

            $generalProcent = config("constants.search.PROCENT_GENERAL_MAIN");

            foreach ($getLikeMan as $key => $man) {
                $manFirstName = $this->findMostSimilarItem('first_name',$man->firstName1, $item["name"]);

                if($manFirstName){
                    $manFirstName = $manFirstName->first_name;
                }

                $manLastName = $this->findMostSimilarItem('last_name', $man->lastName1, $item["surname"]);

                if($manLastName){
                    $manLastName = $manLastName->last_name;
                }

                if (
                    !($item["name"] && $manFirstName) ||
                    !($item["surname"] && $manLastName)
                ) {
                    continue;
                }

                $procentName = differentFirstLetterHelper(
                    $manFirstName,
                    $item["name"],
                    $generalProcent,
                    $key
                );
                $procentLastName = differentFirstLetterHelper(
                    $manLastName,
                    $item["surname"],
                    $generalProcent,
                    $idx
                );

                if($item['patronymic']){

                $manMiddleName = $this->findMostSimilarItem('middle_name', $man->middleName1, $item['patronymic']);
                if($manMiddleName){
                    $manMiddleName = $manMiddleName->middle_name;
                }
                    $procentMiddleName = $item["patronymic"]
                        ? differentFirstLetterHelper(
                            $manMiddleName,
                            $item["patronymic"],
                            $generalProcent,
                        )
                        : null;
                }
               
                // if($item['patronymic'] == "Անդրանիկի"){
                //     dd($procentName, $procentLastName);
                // }
                if ($procentName && $procentLastName) {
                    TmpManFindTextsHasMan::create([
                        "tmp_man_find_texts_id" => $tmpItem->id,
                        "man_id" => $man->id,
                    ]);
                }
                // dd($man);

                // LogService::store(null, null, 'tmp_man_find_texts', 'uploadSearch');
            }
        }

        return true;
    }

    public function calculateCheckedFileDatas($fileData)
    {
        $likeManArray = [];
        $readyLikeManArray = [];
        $dataToInsert = [];
        $newManJob = [];

        foreach ($fileData as $idx => $data) {
            $procentName = 0;
            $procentLastName = 0;
            $procentMiddleName = 0;
            $procentBirthday = 0;
            $dataMan = $data["man"];
            $generalProcent = config("constants.search.PROCENT_GENERAL_MAIN");
            if ($data->find_man_id) {
                $selectedStatus = $data["selected_status"];
                $generalParentId = $data["id"];
                $data = $data->getApprovedMan;
                $data = addManRelationsData($data);
                $data->editable = false;
                $data->colorLine = false;
                $data->selectedStatus = $selectedStatus;
                $data->generalParentId = $generalParentId;
                $data->status = config("constants.search.STATUS_APPROVED");
                $data->procent = config("constants.search.PROCENT_APPROVED");
                $readyLikeManArray[] = $data;
                continue;
            }
            foreach ($dataMan as $key => $man) {
                $avg = 0;
                $countAvg = 0;
                $manFirstName = $this->findMostSimilarItem('first_name', $man->firstName1, $data["name"])??"";

                if($manFirstName){
                    $manFirstName = $manFirstName->first_name;
                }

                $manLastName = $this->findMostSimilarItem('last_name',$man->lastName1, $data["surname"])??"";
                if($manLastName){
                    $manLastName = $manLastName->last_name;
                }

                if ($data["name"]) {
                    if (
                        !(isset($man->firstName1) && $manFirstName)
                    ) {
                        continue;
                    }
                    // $manFirstName = isset($man->firstName1)
                    //     ? $man->firstName->first_name
                    //     : "";
                    $procentName = differentFirstLetterHelper(
                        $manFirstName,
                        $data["name"],
                        $generalProcent,
                        $idx
                    );
                    $countAvg++;
                    $avg += $procentName;
                    if (!$procentName) {
                        continue;
                    }
                }

                if ($data["surname"]) {
                    if (!(isset($man->lastName1) && $manLastName)) {
                        continue;
                    }
                    // $manLastName = isset($man->lastName)
                    //     ? $man->lastName->last_name
                    //     : "";
                    if (!$manLastName) {
                        $countAvg++;
                        $avg += 0;
                    } else {
                        $procentLastName = differentFirstLetterHelper(
                            $manLastName,
                            $data["surname"],
                            $generalProcent,
                            $key
                        );
                        $countAvg++;
                        $avg += $procentLastName;
                        if (!$procentLastName) {
                            continue;
                        }
                    }
                }

                if ($data["patronymic"]) {
                    $manMiddleName = $this->findMostSimilarItem('middle_name', $man->middleName1, $data["patronymic"])??"";
                    if($manMiddleName){
                        $manMiddleName = $manMiddleName->middle_name;
                    }
                    if (!$manMiddleName) {
                        $countAvg++;
                        $avg += 0;
                    } else {
                        $procentMiddleName = differentFirstLetterHelper(
                            $manMiddleName,
                            $data["patronymic"],
                            $generalProcent,
                            $idx
                        );
                        $countAvg++;
                        $avg += $procentMiddleName;

                        if (!$procentMiddleName) {
                            continue;
                        }
                    }
                }

                if ($data["birthday"]) {
                    //add approximate year
                    $manBirthday = $man->birthday ?? $man->birthday_str;

                    if (!$manBirthday) {
                        $countAvg++;
                        $avg += 0;
                    } else {
                        $procentBirthday = $this->getBirthDayProcent(
                            $man,
                            $data,
                            $generalProcent,
                            $key
                        );

                        if(
                            is_array($procentBirthday) &&
                            $procentBirthday['status'] == 'wrongDate' &&
                            $procentBirthday['belongs'] == 'man'
                        ) {
                            $man->error = true;
                            $man->errorMessage = $procentBirthday['message'];
                            $countAvg++;
                            $avg += 0;
                        } else {
                            $countAvg++;
                            $avg += $procentBirthday;
                            if (!$procentBirthday) {
                                continue;
                            }
                        }
                    }
                }
                $data->editable = true;
                $data->colorLine = true;

                $likeManArray[] = [
                    "man" => $man,
                    "procent" => $avg / $countAvg,
                ];
            }

            if (
                count($likeManArray) == 0 &&
                (
                    $data["name"] == null ||
                    $data["surname"] == null ||
                    $data["patronymic"] == null ||
                    $data["birth_year"] == null ||
                    $data["birth_month"] == null ||
                    $data["birth_day"] == null
                )
            ) {
                $data["editable"] = true;
                $data["colorLine"] = true;

                $data["status"] = config("constants.search.STATUS_NEW");
            } elseif (
                $procentName == 100 &&
                $procentLastName == 100 &&
                $procentMiddleName == 100 &&
                $procentBirthday == 100
            ) {
                $data["editable"] = true;
                $data["colorLine"] = true;
                $data["status"] = config("constants.search.STATUS_LIKE");
            } elseif (
                count($likeManArray) == 0 &&
                (
                    $data["name"] != null &&
                    $data["surname"] != null &&
                    $data["patronymic"] != null &&
                    $data["birth_year"] != null &&
                    $data["birth_month"] != null &&
                    $data["birth_day"] != null
                )
            ) {

                $dataOrId = ["fileItemId" => $data];
                $data = $this->newFileDataItem($dataOrId);
                $man = addManRelationsData($data);
                $man["status"] = config("constants.search.STATUS_NEW");
                $man["editable"] = false;
                $man["colorLine"] = true;
                $readyLikeManArray[] = $man;
                $likeManArray = [];
                continue;
            } elseif (count($likeManArray) > 0) {
                $data["editable"] = true;
                $data["colorLine"] = true;
                $data["status"] = config("constants.search.STATUS_LIKE");
            } else {
                $data["editable"] = true;
                $data["colorLine"] = true;
                $data["status"] = config(
                    "constants.search.STATUS_NOT_IDENTIFIED"
                );
            }

            usort($likeManArray, function ($item1, $item2) {
                return $item2["procent"] <=> $item1["procent"];
            });

            $data["child"] = $likeManArray;
            $readyLikeManArray[] = $data;
            $likeManArray = [];
        }
// dd(array_slice($readyLikeManArray, 0, 5));
        return $readyLikeManArray;
    }

    public function newFileDataItem($dataOrId)
    {
        // try {
        //     DB::beginTransaction();
        if (is_numeric($fileItemId = $dataOrId["fileItemId"])) {
            $fileItemId = $dataOrId["fileItemId"];
            $fileData = TmpManFindText::find($fileItemId);
        } else {
            $fileData = $dataOrId["fileItemId"];
        }
        // LogService::store($fileData->toArray(), null, 'man', 'newItem');

        $id = $this->addFindData("word", $fileData, $fileData->file_id);
        $fileData->update([
            "find_man_id" => $id,
            "selected_status" => TmpManFindText::STATUS_NEW_ITEM,
        ]);
        $man = Man::where("id", $id)
            ->with("firstName", "lastName", "middleName")
            ->first();
        $man->status = config("constants.search.STATUS_APPROVED");
        $man->procent = config("constants.search.PROCENT_APPROVED");
        // DB::commit();
        // $man->selected_parent_id = $fileMan->id;
        return $man;
        // } catch (\Exception $e) {
        //     \Log::info("likeFileDetailItem Exception");
        //     \Log::info($e);
        //     DB::rollBack();

        // } catch (\Error $e) {
        //     \Log::info("likeFileDetailItem Error");
        //     \Log::info($e);
        //     DB::rollBack();
        // }
    }

    public function getBirthDayProcent($man, $data, $procent, $key = null)
    {
        $manBirthday = "";
        $counter = 100;

        if ($man->birthday) {
            $manBirthday = $man->birthday;
        } elseif ($man->birthday_str || $man->start_date) {
            $manBirthday = $man->birthday_str
                ? $man->birthday_str
                : $man->start_date;
        }

        if (!$data["birthday"] || !$manBirthday) {
            return $counter - 1;
        }

        if (strlen($manBirthday) == 4 && strlen($data["birthday"]) == 4) {
            if ($manBirthday == $data["birthday"]) {
                return $counter - 1;
            } else {
                return false;
            }
        }

        if (strlen($manBirthday) == 4) {
            if ($manBirthday != $data->birth_year) {
                return false;
            }
            return $counter -= 66;
        }

        $manBirthday = checkAndCorrectDateFormat($manBirthday);
        $dateString = str_replace("․", ".", $manBirthday);
        // dd(Carbon::createFromFormat("d.m.Y", $dateString));

        $dateString = str_replace("․", ".", $manBirthday);

        try {
            $date = Carbon::createFromFormat("d.m.Y", $dateString);
        } catch (\Exception $e) {
           return [
                'status' => 'wrongDate',
                'message' => __('search.wrong_date_format'),
                'date' => $dateString,
                'belongs' => 'man',
            ];
        }


        // $date = Carbon::createFromFormat("d.m.Y", $dateString);

        if (strlen($data["birthday"]) == 4) {
            if ($data["birthday"] != $date->year) {
                return false;
            }
            return $counter - 1;
        }

        if ($data["birth_year"]) {
            if ($date->year) {
                if ((int) $data["birth_year"] != $date->year) {
                    return false;
                }
            } else {
                $counter -= 33;
            }
        }

        if ($data["birth_month"]) {
            if ($date->month) {
                if ($data["birth_month"] != $date->month) {
                    return false;
                }
            } else {
                $counter -= 33;
            }
        }

        if ($data["birth_day"]) {
            if ($date->day) {
                if ($data["birth_day"] != $date->day) {
                    return false;
                }
            } else {
                $counter -= 33;
            }
        }

        return $counter;
    }

    public function searchLikeMan($details)
    {
        // $fullname = $details["name"] . " " . $details["surname"];
        // $getLikeManIds = Man::search($fullname)
        //     ->get()
        //     ->pluck("id");
        // $getLikeMan = Man::whereIn("id", $getLikeManIds)
        //     ->with("firstName", "lastName", "middleName")
        //     ->get();
       $getLikeMan = $this->getSearchMan($details["name"], $details["surname"]);

        $procentName = 0;
        $procentLastName = 0;
        $procentMiddleName = 0;
        $procentBirthday = 0;
        $generalProcent = config("constants.search.PROCENT_GENERAL_MAIN");
        if ($getLikeMan) {
            foreach ($getLikeMan as $key => $man) {
                $avg = 0;
                $countAvg = 0;

                if (
                    !($details["name"] || $man->firstName) ||
                    !($details["surname"] || $man->lastName)
                ) {
                    continue;
                }

                if ($details->name) {
                    if (
                        !(isset($man->firstName) && $man->firstName->first_name)
                    ) {
                        continue;
                    }
                    $manFirstName = isset($man->firstName)
                        ? $man->firstName->first_name
                        : "";
                    $procentName = differentFirstLetterHelper(
                        $manFirstName,
                        $details["name"],
                        $generalProcent
                    );
                    $countAvg++;
                    $avg += $procentName;
                    if (!$procentName) {
                        continue;
                    }
                }

                if ($details["surname"]) {
                    if (!(isset($man->lastName) && $man->lastName->last_name)) {
                        continue;
                    }
                    $manLastName = isset($man->lastName)
                        ? $man->lastName->last_name
                        : "";
                    if (!$manLastName) {
                        $countAvg++;
                        $avg += 0;
                    } else {
                        $procentLastName = differentFirstLetterHelper(
                            $manLastName,
                            $details["surname"],
                            $generalProcent
                        );
                        $countAvg++;
                        $avg += $procentLastName;
                        if (!$procentLastName) {
                            continue;
                        }
                    }
                }

                if ($details["patronymic"]) {
                    $manMiddleName = isset($man->middleName)
                        ? $man->middleName->middle_name
                        : "";
                    if (!$manMiddleName) {
                        $countAvg++;
                        $avg += 0;
                    } else {
                        $procentMiddleName = differentFirstLetterHelper(
                            $manMiddleName,
                            $details["patronymic"],
                            $generalProcent
                        );
                        $countAvg++;
                        $avg += $procentMiddleName;
                        if (!$procentMiddleName) {
                            continue;
                        }
                    }
                }
                $details->editable = true;
                $details->colorLine = true;


                if ($details["birthday"]) {
                    //add approximate year
                    $manBirthday = $man->birthday ?? $man->birthday_str;

                    if (!$manBirthday) {
                        $countAvg++;
                        $avg += 0;
                    } else {
                        $procentBirthday = $this->getBirthDayProcent(
                            $man,
                            $details,
                            $generalProcent,
                            $key
                        );
                        $countAvg++;
                        $avg += $procentBirthday;
                        if (!$procentBirthday) {
                            continue;
                        }
                    }
                }

                $likeManArray[] = [
                    "man" => $man,
                    "procent" => $avg / $countAvg,
                ];

                // if (
                //     $procentName == 100 &&
                //     $procentLastName == 100 &&
                //     $procentMiddleName == 100
                // ) {
                //     $details["status"] = config(
                //         "constants.search.STATUS_FOUND"
                //     );

                //     $details["editable"] = false;
                //     $likeManArray = [];
                //     $likeManArray[] = [
                //         "man" => $man,
                //         "procent" => $avg / $countAvg,
                //     ];
                // }

                TmpManFindTextsHasMan::create([
                    "tmp_man_find_texts_id" => $details->id,
                    "man_id" => $man->id,
                ]);

                if (
                    count($likeManArray) == 0 &&
                    (
                        $details["surname"] == null ||
                        $details["birth_year"] == null ||
                        $details["birth_month"] == null ||
                        $details["birth_day"] == null
                    )
                ) {
                    $details["editable"] = true;
                    $details["colorLine"] = true;
                    $details["status"] = config("constants.search.STATUS_NEW");
                } elseif (
                    count($likeManArray) == 0 &&
                    (
                        $details["name"] != null &&
                        $details["surname"] != null &&
                        $details["patronymic"] != null &&
                        $details["birth_year"] != null &&
                        $details["birth_month"] != null &&
                        $details["birth_day"] != null
                    )
                ) {
                    $details["editable"] = false;
                    $details["colorLine"] = true;
                    $details["status"] = config("constants.search.STATUS_NEW");
                }elseif (count($likeManArray) > 0) {
                    $details["editable"] = true;
                    $details["colorLine"] = true;
                    $details["status"] = config("constants.search.STATUS_LIKE");
                }

                usort($likeManArray, function ($item1, $item2) {
                    return $item1["procent"] <=> $item2["procent"];
                });

                $details["child"] = $likeManArray;
            }
            return $details;
        }
    }

    public function likeFileDetailItem(
        $data,
        $status = TmpManFindText::STATUS_AUTOMAT_FOUND
    ) {
        // try {
        //     DB::beginTransaction();
        $authUserId = auth()->user()->id;
        $fileItemId = $data["fileItemId"];
        $manId = $data["manId"];
        $fileMan = TmpManFindText::find((int) $fileItemId);
        $fileId = $fileMan->file_id;
        // LogService::store($data, null, 'man', 'likeItem');

        if ($fileMan["find_man_id"] == $manId) {
        } elseif (!$fileMan["find_man_id"]) {
            //add bibliography table, and with bibliography and file
            // $bibliographyid = Bibliography::addBibliography($authUserId);
            // BibliographyHasFile::bindBibliographyFile($bibliographyid, $fileId);
            $bibliographyId = BibliographyHasFile::where(
                "file_id",
                $fileId
            )->first()->bibliography_id;

            if (
                !ManHasBibliography::where("man_id", $manId)
                    ->where("bibliography_id", $bibliographyId)
                    ->first()
            ) {
                ManHasBibliography::bindManBiblography($manId, $bibliographyId);
            }
            $fileMan->update([
                "find_man_id" => $manId,
                "selected_status" => $status,
            ]);
        }

        // DB::commit();

        $man = Man::where("id", $manId)
            ->with("firstName", "lastName", "middleName")
            ->first();
        $man->selectedStatus = $status;
        $man->generalParentId = $fileMan->id;
        $man->status = config("constants.search.STATUS_APPROVED");
        return $man;
        // } catch (\Exception $e) {
        //     \Log::info("likeFileDetailItem Exception");
        //     \Log::info($e);
        //     DB::rollBack();

        // } catch (\Error $e) {
        //     \Log::info("likeFileDetailItem Error");
        //     \Log::info($e);
        //     DB::rollBack();
        // }
    }

    public function bringBackLikedData($data)
    {
        $parentId = $data["parentId"];
        $details = null;

        $item = TmpManFindText::find($parentId);
        // LogService::store(['parentId'=>$parentId, "manId"=>$item->find_man_id], null, 'tmp_man_find_texts', 'bringApproved');

        $manId = $item->find_man_id;
        $fileId = $item->file_id;

        $bibliographyId = BibliographyHasFile::where("file_id", $fileId)
            ->pluck("bibliography_id")
            ->first();
        $removeManHasBibliography = ManHasBibliography::where("man_id", $manId)
            ->where("bibliography_id", $bibliographyId)
            ->delete();

        // $removeManHasFile = ManHasFile::where('man_id', $manId)->where('file_id', $fileId)->delete();

        $details = $item;
        $update = $item->update([
            "find_man_id" => null,
            "selected_status" => null,
        ]);

        if ($update) {
            $details = $this->searchLikeMan($details);
        }

        return $details;
    }

    public function editDetailItem($request, $id)
    {
        $details = TmpManFindText::find($id);
        // LogService::store($details, null, 'tmp_man_find_texts', 'edit');
        $update = $details->update([
            $request["column"] => trim($request["newValue"]),
        ]);

        if ($update) {
            TmpManFindTextsHasMan::where(
                "tmp_man_find_texts_id",
                $id
            )->delete();

            $details = $this->searchLikeMan($details);
        }

        return $details;
    }

    public function getSearchMan($searchTermName, $searchTermSurname)
    {
        $searchDegree = config("constants.search.STATUS_SEARCH_DEGREE");

        $getLikeManIds = DB::table('man')
        ->whereExists(function ($query) use ($searchTermName,  $searchDegree) {
            $query->select(DB::raw(1))
                ->from('first_name')
                ->join('man_has_first_name', 'first_name.id', '=', 'man_has_first_name.first_name_id')
                ->whereColumn('man.id', 'man_has_first_name.man_id')
                ->whereRaw("LEVENSHTEIN(first_name, ?) <= ?", [$searchTermName, $searchDegree]);
        })
        ->whereExists(function ($query) use ($searchTermSurname, $searchDegree) {
            $query->select(DB::raw(1))
                ->from('last_name')
                ->join('man_has_last_name', 'last_name.id', '=', 'man_has_last_name.last_name_id')
                ->whereColumn('man.id', 'man_has_last_name.man_id')
                ->whereRaw("LEVENSHTEIN(last_name, ?) <= ?", [$searchTermSurname, $searchDegree]);
        })
        ->get()->pluck('id');

        $getLikeMan = Man::whereIn("id", $getLikeManIds)
                ->with("firstName1", "lastName1", "middleName1", "firstName", "lastName", "middleName")
                ->get();

        return $getLikeMan;
    }

    public function findMostSimilarItem($columName, $collection, $target) {
        $maxSimilarity = 0;
        $mostSimilarItem = null;
        $collection->each(function ($item) use ($columName, $target, &$maxSimilarity, &$mostSimilarItem) {
            similar_text($target, $item->$columName, $percent);


            if ($percent > $maxSimilarity) {
                $maxSimilarity = $percent;
                $mostSimilarItem = $item;
            }
        });


        return $mostSimilarItem;

    }

    public function getFilteredCalculate($man)
    {
        if ($man) {
            $readyLikeManArray = $this->calculateCheckedFileDatas($man);
        }
        $allManCount = count($man);

        return ['info' => $readyLikeManArray, 'fileName' => $man, 'count' => $allManCount ?? 0];
    }
}
