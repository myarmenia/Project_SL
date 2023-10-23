<?php

namespace App\Services;

use App\Models\Bibliography\Bibliography;
use App\Models\Bibliography\BibliographyHasFile;
use App\Models\Man\Man;
use App\Models\Man\ManHasBibliography;
use App\Models\Man\ManHasFile;
use App\Models\Man\ManHasFindText;
use App\Models\TempTables\TmpManFindText;
use App\Models\TempTables\TmpManFindTextsHasMan;
use PhpOffice\PhpWord\IOFactory;
use App\Models\DataUpload;
use App\Models\File\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use TeamTNT\TNTSearch\TNTSearch;


class SearchService
{
    private $findDataService;

    public function __construct(FindDataService $findDataService)
    {
        $this->findDataService = $findDataService;
    }

    // public function getDocContent($fullPath)
    // {
    //     $phpWord = IOFactory::load($fullPath);
    //     $content = '';
    //     $sections = $phpWord->getSections();

    //     foreach ($sections as $section) {
    //         foreach ($section->getElements() as $element) {
    //             if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
    //                 foreach ($element->getElements() as $textElement) {
    //                     if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
    //                         $content .= $textElement->getText() . '';
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     return $content;
    // }

    public function addManRelationsData($man)
    {
        $man->name = $man->firstName ? $man->firstName->first_name : "";
        $man->surname = $man->lastName ? $man->lastName->last_name : "";
        $man->patronymic = $man->middleName ? $man->middleName->middle_name : "";
        $man->birthday = $man->birthday_str;
        return $man;
    }

    public function differentFirstLetter($man, $item, $generalProcent, $key = null)
    {
        $manFirst = mb_substr($man, 0, 1, 'UTF-8');
        $itemFirst = mb_substr($item, 0, 1, 'UTF-8');
        $diff = $manFirst === $itemFirst;

        if (!$diff) {
            return false;
        }

        similar_text($man, $item, $procent);

        if ($procent <= $generalProcent) {
            return false;
        }

        return $procent;
    }

    public function getBirthDayProcent($man, $data, $procent, $key = null)
    {
        $manBirthday = "";
        $counter = 100;

        if ($man->birthday) {
            $manBirthday = $man->birthday;
        } elseif ($man->birthday_str || $man->start_date) {
            $manBirthday = $man->birthday_str ? $man->birthday_str : $man->start_date;
        }

        if (!$data['birthday'] || !$manBirthday) {
            return $counter - 1;
        }

        if (strlen($manBirthday) == 4 && strlen($data['birthday']) == 4) {
            if ($manBirthday == $data['birthday']) {
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

        $dateString = str_replace('․', '.', $manBirthday);
        $date = Carbon::createFromFormat('d.m.Y', $dateString);

        if (strlen($data['birthday']) == 4) {
            if ($data['birthday'] != $date->year) {
                return false;
            }
            return $counter - 1;
        }

        if ($data['birth_year']) {
            if ($date->year) {
                if ((int) $data['birth_year'] != $date->year) {
                    return false;
                }
            } else {
                $counter -= 33;
            }
        }

        if ($data['birth_month']) {
            if ($date->month) {
                if ($data['birth_month'] != $date->month) {
                    return false;
                }
            } else {
                $counter -= 33;
            }
        }

        if ($data['birth_day']) {
            if ($date->day) {
                if ($data['birth_day'] != $date->day) {
                    return false;
                }
            } else {
                $counter -= 33;
            }
        }

        return $counter;
    }

    public function showAllDetailsDoc($filename)
    {
        $fullPath = storage_path('app/' . 'uploads/' . $filename);
        $text = getDocContent($fullPath);
        $parts = explode("\t", $text);
        $implodeArray = implode("\n", $parts);
        $fileId = File::getFileIdByName($filename);
        $detailsForReplace = TmpManFindText::getFindTextByFileId($fileId);

        foreach ($detailsForReplace as $key => $details) {
            $implodeArray = mb_ereg_replace($details, "<span class='find-by-class' style='color: #0c05fb; margin: 0;'>$details</span>", $implodeArray);
        }
        return $implodeArray;
    }

    public function showAllDetails()
    {
        return DataUpload::all();
    }

    public function searchLikeMan($details)
    {
        $fullname = $details['name'] . " " . $details['surname'];
        $getLikeManIds = Man::search($fullname)->get()->pluck('id');
        $getLikeMan = Man::whereIn('id', $getLikeManIds)->with('firstName', 'lastName', 'middleName')->get();
        $procentName = 0;
        $procentLastName = 0;
        $procentMiddleName = 0;
        $procentBirthday  = 0;
        $generalProcent = config('constants.search.PROCENT_GENERAL_MAIN');
        if ($getLikeMan) {
            foreach ($getLikeMan as $key => $man) {
                $avg = 0;
                $countAvg = 0;

                if (
                    !($details['name'] || $man->firstName) ||
                    !($details['surname'] || $man->lastName)
                ) {
                    continue;
                }

                if ($details->name) {
                    if (!(isset($man->firstName) && $man->firstName->first_name)) {
                        continue;
                    }
                    $manFirstName = isset($man->firstName) ? $man->firstName->first_name : "";
                    $procentName = $this->differentFirstLetter($manFirstName, $details['name'], $generalProcent);
                    $countAvg++;
                    $avg += $procentName;
                    if (!$procentName) {
                        continue;
                    }
                }

                if ($details['surname']) {
                    if (!(isset($man->lastName) && $man->lastName->last_name)) {
                        continue;
                    }
                    $manLastName = isset($man->lastName) ? $man->lastName->last_name : "";
                    if (!$manLastName) {
                        $countAvg++;
                        $avg += 0;
                    } else {
                        $procentLastName = $this->differentFirstLetter($manLastName, $details['surname'], $generalProcent);
                        $countAvg++;
                        $avg += $procentLastName;
                        if (!$procentLastName) {
                            continue;
                        }
                    }
                }

                if ($details['patronymic']) {
                    $manMiddleName = isset($man->middleName) ? $man->middleName->middle_name : "";
                    if (!$manMiddleName) {
                        $countAvg++;
                        $avg += 0;
                    } else {
                        $procentMiddleName = $this->differentFirstLetter($manMiddleName, $details['patronymic'], $generalProcent);
                        $countAvg++;
                        $avg += $procentMiddleName;
                        if (!$procentMiddleName) {
                            continue;
                        }
                    }
                }
                $details->editable = true;

                if ($details['birthday']) {
                    //add approximate year
                    $manBirthday = $man->birthday ?? $man->birthday_str;

                    if (!$manBirthday) {
                        $countAvg++;
                        $avg += 0;
                    } else {
                        $procentBirthday = $this->getBirthDayProcent($man, $details, $generalProcent, $key);
                        $countAvg++;
                        $avg += $procentBirthday;
                        if (!$procentBirthday) {
                            continue;
                        }
                    }
                }

                $likeManArray[] = [
                    'man' => $man,
                    'procent' => $avg / $countAvg
                ];

                if ($procentName == 100 && $procentLastName == 100 && $procentMiddleName == 100) {

                    $details['status'] = config('constants.search.STATUS_FOUND');

                    $details['editable'] = false;
                    $likeManArray = [];
                    $likeManArray[] = [
                        'man' => $man,
                        'procent' => $avg / $countAvg
                    ];

                }

                TmpManFindTextsHasMan::create([
                    'tmp_man_find_texts_id' => $details->id,
                    'man_id' => $man->id,
                ]);

                if (
                    (count($likeManArray) == 0) && ($details['surname'] == null || $details['birth_year'] == null ||
                        $details['birth_month'] == null || $details['birth_day'] == null
                    )
                ) {
                    $details['editable'] = true;
                    $details['status'] = config('constants.search.STATUS_ALMOST_NEW');
                } elseif (
                    (count($likeManArray) == 0) && ($details['surname'] != null && $details['birth_year'] != null &&
                        $details['birth_month'] != null && $details['birth_day'] != null
                    )
                ) {
                    $details['editable'] = false;
                    $details['status'] = config('constants.search.STATUS_NEW');
                } elseif (count($likeManArray) > 0) {
                    $details['editable'] = true;
                    $details['status'] = config('constants.search.STATUS_LIKE');
                }

                usort($likeManArray, function ($item1, $item2) {
                    return $item1['procent'] <=> $item2['procent'];
                });

                $details['child'] = $likeManArray;

            }
            return $details;
        }
    }

    public function editDetailItem($request, $id)
    {
        $details = TmpManFindText::find($id);
        $update = $details->update([
            $request['column'] => trim($request['newValue'])
        ]);

        if ($update) {
            TmpManFindTextsHasMan::where('tmp_man_find_texts_id', $id)->delete();

            $details = $this->searchLikeMan($details);
        }

        return $details;
    }

    public function updateDetails($request, $id)
    {
        $details = DataUpload::find($id);
        $details->update($request);

        return $details;
    }

    public function addFile($fileName, $orginalName, $path): int
    {
        $fileDetails = [
            'name' => $fileName,
            'real_name' => $orginalName,
            'path' => $path
        ];

        $fileId = File::addFile($fileDetails);

        return $fileId;
    }

    public function uploadFile($file, $bibliographyId)
    {

        if($bibliographyId){
            // TmpManFindText::query()->delete();
            // TmpManFindTextsHasMan::query()->delete();
            // dd(33);

            $likeManArray = [];
            $readyLikeManArray = [];

            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads', $fileName);
            $fullPath = storage_path('app/' . $path);
            $text = getDocContent($fullPath);
            $fileId = $this->addFile($fileName, $file->getClientOriginalName(), $path);
            $parts = explode("\t", $text);
            $dataToInsert = [];
            $matchLong = [];

            //last working patters
            // $pattern = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/\s*((\d{2,}.)?(\d{2,}.)?(\d{2,}))\s*(.+?)\//u';
            //test three
            // $patternLong = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?\/\s*((\d{2,}.)?(\d{2,}.)?(\d{2,}))\s*(.+?)\//u';
            //new version two in one
            $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?\/\s*((\d{2,}.)?(\d{2,}.)?(\d{2,}))\s*(.+?)\/[^Ա-Ֆա-ֆ0-9]/u';
            foreach ($parts as $key => $part) {
                if ($text) {
                    preg_match_all($pattern, $part, $matches, PREG_SET_ORDER);

                    foreach ($matches as $key => $value) {
                        $birthDay = (int) $value[8] === 0 ? null : (int) $value[8];
                        $birthMonth = (int) $value[9] === 0 ? null : (int) $value[9];
                        $birthYear = (int) $value[10] === 0 ? null : (int) $value[10];
                        // $address = mb_strlen($value[9], 'UTF-8') < 10 ? $address = '' : $value[9];
                        $address = mb_strlen($value[11], 'UTF-8') < 10 ? $address = '' : $value[11];

                        $valueAddress = str_replace("թ.ծ.,", "", $address);
                        $valueAddress = str_replace("թ.ծ", "", $valueAddress);
                        $valueAddress = str_replace("թ. ծ.,", "", $valueAddress);
                        $valueAddress = str_replace("չի աշխ.", "", $valueAddress);
                        // $valueAddress = if()
                        $valueAddress = trim($valueAddress);
                        // dd(mb_substr($valueAddress, -1, null, 'UTF-8'));

                        $name = $value[1];
                        $surname = trim($value[3] == "" ? $value[2] : $value[3]);
                        $patronymic = trim($value[3] == "" ? "" : $value[2]);

                        $text = trim($part);

    
                        $text = mb_ereg_replace($value[0], "<p class='centered-text' style='color: #0c05fb; margin: 0;'>$value[0]</p>", $text);
    

                        if (Str::endsWith($surname, 'ը') || Str::endsWith($surname, 'ի')) {
                            $surname = Str::substr($surname, 0, -1);
                        }
                        if (mb_substr($surname, -2, 2, 'UTF-8') == 'ից' || mb_substr($surname, -2, 2, 'UTF-8') == 'ին') {
                            $surname = Str::substr($surname, 0, -2);
                        }
                        if($value[4] != "") {
                            $name = trim($value[1])." ".trim($value[2])." ".trim($value[3])." ".trim($value[4])." ".trim($value[5])." ". trim($value[6]);
                        }
                        $dataToInsert[] = [
                            'name' => trim($name),
                            'surname' => $value[4] != ""? trim($name):$surname,
                            'patronymic' => $value[4] != ""? "":$patronymic,
                            'birthday_str' => $value[7],
                            "birth_day" => $birthDay,
                            "birth_month" => $birthMonth,
                            "birth_year" => $birthYear,
                            'address' => $valueAddress,
                            'find_text' => $value[0],
                            'paragraph' => $text,
                        ];
                    }
                }
            }

            foreach ($dataToInsert as $idx => $item) {
                $item['file_name'] = $fileName;
                $item['real_file_name'] = $file->getClientOriginalName();
                $item['file_path'] = $path;
                $item['file_id'] = $fileId;
                $item['birthday'] = $item['birthday_str'];

                $tmpItem = TmpManFindText::create($item);

                $procentName = 0;
                $procentLastName = 0;
                $procentMiddleName = 0;

                $fullname = $item['name'] . " " . $item['surname'];
                $getLikeManIds = Man::search($fullname)->get()->pluck('id');
                $getLikeMan = Man::whereIn('id', $getLikeManIds)->with('firstName', 'lastName', 'middleName')->get();

                $generalProcent = config('constants.search.PROCENT_GENERAL_MAIN');
                foreach ($getLikeMan as $key => $man) {
                    if (
                        !($item['name'] && $man->firstName) ||
                        !($item['surname'] && $man->lastName)
                    ) {
                        continue;
                    }
                    $procentName = $this->differentFirstLetter($man->firstName->first_name, $item['name'], $generalProcent, $key);
                    $procentLastName = $this->differentFirstLetter($man->lastName->last_name, $item['surname'], $generalProcent, $key);
                    $procentMiddleName = ($item['patronymic']) ? $this->differentFirstLetter($man->middleName ? $man->middleName->middle_name : "", $generalProcent, $item['patronymic']) : null;

                    if ($procentName && $procentLastName) {
                        TmpManFindTextsHasMan::create([
                            'tmp_man_find_texts_id' => $tmpItem->id,
                            'man_id' => $man->id,
                        ]);
                    }
                }
                

            // $this->findDataService->addFindData('word', $dataToInsert, $fileId);
            // return true;
            }
            BibliographyHasFile::bindBibliographyFile($bibliographyId, $fileId);

            return $fileName;
        }

        throw new \Exception('Something went wrong');

    }
    public function checkedFileData($fileName)
    {
        $likeManArray = [];
        $readyLikeManArray = [];
        $dataToInsert = [];
        $shouldBreakOuterLoop = false;
        $fileData = TmpManFindText::with([
            'man.firstName',
            'man.lastName',
            'man.middleName',
            'getApprovedMan.firstName',
            'getApprovedMan.lastName',
            'getApprovedMan.middleName'
        ])
            ->where('file_name', $fileName)->with('man')->get();
        if ($fileData) {
            foreach ($fileData as $idx => $data) {
                $procentName = 0;
                $procentLastName = 0;
                $procentMiddleName = 0;
                $procentBirthday = 0;
                $dataMan = $data['man'];
                $generalProcent = config('constants.search.PROCENT_GENERAL_MAIN');
                if ($data->find_man_id) {
                    $selectedStatus = $data['selected_status'];
                    $generalParentId = $data['id'];
                    $data = $data->getApprovedMan;
                    $data = $this->addManRelationsData($data);
                    $data->editable = false;
                    $data->selectedStatus = $selectedStatus;
                    $data->generalParentId = $generalParentId;
                    $data->status = config('constants.search.STATUS_APPROVED');
                    $data->procent = config('constants.search.PROCENT_APPROVED');
                    $readyLikeManArray[] = $data;
                    continue;
                }

                foreach ($dataMan as $key => $man) {
                    $avg = 0;
                    $countAvg = 0;

                    if ($data['name']) {
                        if (!(isset($man->firstName) && $man->firstName->first_name)) {
                            continue;
                        }
                        $manFirstName = isset($man->firstName) ? $man->firstName->first_name : "";
                        $procentName = $this->differentFirstLetter($manFirstName, $data['name'], $generalProcent, $idx);
                        $countAvg++;
                        $avg += $procentName;
                        if (!$procentName) {
                            continue;
                        }
                    }

                    if ($data['surname']) {
                        if (!(isset($man->lastName) && $man->lastName->last_name)) {
                            continue;
                        }
                        $manLastName = isset($man->lastName) ? $man->lastName->last_name : "";
                        if (!$manLastName) {
                            $countAvg++;
                            $avg += 0;
                        } else {
                            $procentLastName = $this->differentFirstLetter($manLastName, $data['surname'], $generalProcent, $key);
                            $countAvg++;
                            $avg += $procentLastName;
                            if (!$procentLastName) {
                                continue;
                            }
                        }
                    }

                    if ($data['patronymic']) {
                        $manMiddleName = isset($man->middleName) ? $man->middleName->middle_name : "";
                        if (!$manMiddleName) {
                            $countAvg++;
                            $avg += 0;
                        } else {
                            $procentMiddleName = $this->differentFirstLetter($manMiddleName, $data['patronymic'], $generalProcent, $idx);
                            $countAvg++;
                            $avg += $procentMiddleName;

                            if (!$procentMiddleName) {
                                continue;
                            }
                        }
                    }

                    if ($data['birthday']) {
                        //add approximate year
                        $manBirthday = $man->birthday ?? $man->birthday_str;

                        if (!$manBirthday) {
                            $countAvg++;
                            $avg += 0;
                        } else {
                            $procentBirthday = $this->getBirthDayProcent($man, $data, $generalProcent, $key);
                            $countAvg++;
                            $avg += $procentBirthday;
                            if (!$procentBirthday) {
                                continue;
                            }
                        }
                    }

                    $data->editable = true;

                    $likeManArray[] = [
                        'man' => $man,
                        'procent' => $avg / $countAvg
                    ];

                    if (
                        $procentName == 100 && $procentLastName == 100 &&
                        $procentMiddleName == 100 && $procentBirthday == 100
                       ) {
                        $dataIds = [
                            'fileItemId' => $data->id,
                            'manId' => $man->id,
                        ];
                        $man = $this->likeFileDetailItem($dataIds);
                        if ($man) {
                            TmpManFindText::where('id', $data->id)->update([
                                'find_man_id' => $man->id
                            ]);
                            $man = $this->addManRelationsData($man);
                            $man['status'] = config('constants.search.STATUS_APPROVED');
                            $man['editable'] = false;
                            $readyLikeManArray[] = $man;
                            $likeManArray = [];
                            $shouldBreakOuterLoop = true;
                            break;
                        }

                    }

                }

                if ($shouldBreakOuterLoop) {
                    $shouldBreakOuterLoop = false;
                    continue;
                }

                if (
                    (count($likeManArray) == 0) && ($data['surname'] == null || $data['birth_year'] == null ||
                        $data['birth_month'] == null || $data['birth_day'] == null
                    )
                ) {
                    $data['editable'] = true;
                    $data['status'] = config('constants.search.STATUS_ALMOST_NEW');
                } elseif (
                    (count($likeManArray) == 0) && ($data['surname'] != null && $data['birth_year'] != null &&
                        $data['birth_month'] != null && $data['birth_day'] != null
                    )
                ) {
                    $dataOrId = ['fileItem' => $data];
                    $data = $this->newFileDataItem($dataOrId);
                    $man = $this->addManRelationsData($data);
                    $man['status'] = config('constants.search.STATUS_NEW');
                    $man['editable'] = false;
                    $readyLikeManArray[] = $man;
                    $likeManArray = [];
                continue;
                    // $data['editable'] = false;
                    // $data['status'] = config('constants.search.STATUS_NEW');
                    //avelacnel ete nora qci inqy baza u bazayic vercni  hanel verevi stugumneri mej
                } elseif (count($likeManArray) > 0) {
                    $data['editable'] = true;
                    $data['status'] = config('constants.search.STATUS_LIKE');
                } else{
                    $data['editable'] = true;
                    $data['status'] = config('constants.search.STATUS_NOT_IDENTIFIED');
                }

                usort($likeManArray, function ($item1, $item2) {
                    return $item2['procent'] <=> $item1['procent'];
                });

                $data['child'] = $likeManArray;
                $readyLikeManArray[] = $data;
                $likeManArray = [];

            }
        }
        $allManCount = count($fileData);

        return ['info' => $readyLikeManArray, 'fileName' => $fileName, 'count' => $allManCount ?? 0];
    }

    public function likeFileDetailItem($data, $status = TmpManFindText::STATUS_AUTOMAT_FOUND)
    {
        // try {
        //     DB::beginTransaction();
        $authUserId = auth()->user()->id;
        $fileItemId = $data['fileItemId'];
        $manId = $data['manId'];
        $fileMan = TmpManFindText::find((int) $fileItemId);
        $fileId = $fileMan->file_id;

        if($fileMan['find_man_id'] == $manId){

        } elseif (!$fileMan['find_man_id']){
            //add bibliography table, and with bibliography and file
            // $bibliographyid = Bibliography::addBibliography($authUserId);
            // BibliographyHasFile::bindBibliographyFile($bibliographyid, $fileId);
            $bibliographyId = BibliographyHasFile::where('file_id', $fileId)->first()->bibliography_id;

            if(!ManHasBibliography::where('man_id', $manId)->where('bibliography_id', $bibliographyId)->first()){
                ManHasBibliography::bindManBiblography($manId, $bibliographyId);
            }
            $fileMan->update(['find_man_id' => $manId, 'selected_status' => $status]);
        }



        // DB::commit();

        $man = Man::where('id', $manId)->with('firstName', 'lastName', 'middleName')->first();
        $man->selectedStatus = $status;
        $man->generalParentId = $fileMan->id;
        $man->status = config('constants.search.STATUS_APPROVED');
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

    public function newFileDataItem($dataOrId)
    {
        // try {
        //     DB::beginTransaction();
            if(is_numeric( $fileItemId = $dataOrId['fileItemId'])){
                $fileItemId = $dataOrId['fileItemId'];
                $fileData = TmpManFindText::find($fileItemId);
            }else{
                $fileData = $dataOrId['fileItem'];
            }
            //avelacnel stugum is_number i depqum nor get anel ete che obj a 
            
            $id = $this->findDataService->addFindData('word', $fileData, $fileData->file_id);
            $fileData->update(['find_man_id' => $id, 'selected_status' => TmpManFindText::STATUS_NEW_ITEM]);
            $man = Man::where('id', $id)->with('firstName', 'lastName', 'middleName')->first();
            $man->status = config('constants.search.STATUS_APPROVED');
            $man->procent = config('constants.search.PROCENT_APPROVED');
            DB::commit();
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

    public function bringBackLikedData($data)
    {
        $parentId = $data['parentId'];
        $details = null;

        $item = TmpManFindText::find($parentId);

        $manId = $item->find_man_id;
        $fileId = $item->file_id;

        $bibliographyId = BibliographyHasFile::where('file_id', $fileId)->pluck('bibliography_id')->first();
        $removeManHasBibliography = ManHasBibliography::where('man_id', $manId)->where('bibliography_id', $bibliographyId)->delete();

        $removeManHasFile = ManHasFile::where('man_id', $manId)->where('file_id', $fileId)->delete();

        $details = $item;
        $update = $item->update([
            'find_man_id' => null,
            'selected_status' => null,
        ]);

        if ($update) {
            $details = $this->searchLikeMan($details);
        }

       return $details;
    }

    public function customAddFileData($data, $fileName)
    {
        $birthday =  trim($data['birthday']);
        $findText = trim($data['findText']);
        $newItem = new TmpManFindText();
        $newItem->name = trim($data['name']);
        $newItem->surname =  trim($data['surname']);
        $newItem->patronymic = trim($data['patronymic']);
        $newItem->address = trim($data['address']);
        $newItem->find_text = $findText;
        if(strlen($birthday) == 4){
            $newItem->birthday = $birthday;
            $newItem->birth_year = $birthday;
        }
        else {
            $dateString = str_replace('․', '.', $birthday);
            $date = Carbon::createFromFormat('d.m.Y', $dateString);
            $newItem->birthday = $birthday;
            $newItem->birth_year = $date->year;
            $newItem->birth_month = $date->month;
            $newItem->birth_day = $date->day;
        }
        $newItem->paragraph = trim(mb_ereg_replace($findText, "<p class='centered-text' style='color: #0c05fb; margin: 0;'>$findText</p>", $data['paragraph']));
        $file = File::where('name', $fileName)->first();
        $newItem->file_name = $file->name;
        $newItem->real_file_name = $file->real_name;
        $newItem->file_path = $file->path;
        $newItem->file_id = $file->id;
        $newItem->selected_status = null;
        $newItem->full_name = null;
        $newItem->find_man_id = null;
        $newItem->save();

        return true;

    }




}
