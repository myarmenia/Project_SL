<?php

namespace App\Services;

use App\Models\Bibliography\Bibliography;
use App\Models\Bibliography\BibliographyHasFile;
use App\Models\Man\Man;
use App\Models\Man\ManHasBibliography;
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

    public function getDocContent($fullPath)
    {
        $phpWord = IOFactory::load($fullPath);
        $content = '';
        $sections = $phpWord->getSections();


        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    foreach ($element->getElements() as $textElement) {
                        if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                            $content .= $textElement->getText() . ' ';
                        }
                    }
                }
            }
        }
        return $content;
    }

    public function addManRelationsData($man)
    {
        $man->name = $man->firstName?$man->firstName->first_name:"";
        $man->surname = $man->lastName?$man->lastName->last_name:"";
        $man->patronymic = $man->middleName?$man->middleName->middle_name: "";
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

        if($man->birthday){
            $manBirthday = $man->birthday;
        }elseif($man->birthday_str || $man->start_date){
            $manBirthday = $man->birthday_str?$man->birthday_str:$man->start_date;
        }

        if(!$data['birthday'] || !$manBirthday){
            return $counter;
        }

        if(strlen($manBirthday) == 4 && strlen($data['birthday']) == 4){
           if($manBirthday == $data['birthday']){
            return $counter;
           }else{
            return false;
           }
        }

        if(strlen($manBirthday) == 4){
           if($manBirthday != $data->birth_year){
                return false;
           }
           return $counter -= 66;
        }

        $date = Carbon::parse($manBirthday);

        if(strlen($data['birthday']) == 4){
            if($data['birthday'] != $date->year){
                return false;
            }
            return $counter;
        }

        if($data['birth_year']){
            if($date->year){
                if((int) $data['birth_year'] != $date->year){
                    return false;
                }    
            }else {
                $counter -= 33;
            }
        }
        if($data['birth_month']){
            if($date->month){
                if($data['birth_month'] != $date->month){
                    return false;
                }    
            }else {
                $counter -= 33;
            }
        }

        if($data['birth_day']){
            if($date->day){
                if($data['birth_day'] != $date->day){
                    return false;
                }    
            }else {
                $counter -= 33;
            }
        }

//         if($data['birth_month']){

//         }

//         if($data['birth_day']){

//         }
// dd($man);
//         return false;
//         if(strlen($manBirthday) == 4){
//             if($manBirthday != $data->birth_year){
//                 return false;
//             }
//             return $counter;
//         }else{
//             $date = Carbon::parse($manBirthday);
//             if($data->birth_year){
//                 if($data->birth_year != $date->year){
//                     return false;
//                 }
//                 if(!$date->year){
//                     $counter -= 33;
//                 }
//             }

//             if($data->birth_month){
//                 if($date->month != $data->birth_month) {
//                     return false;
//                 }
//                 if(!$date->month){
//                     $counter -= 33;
//                 }
//             }

//             if ($data->birth_day){
//                 if($date->day != $data->birth_day) {
//                     return false;
//                 }
//                 if(!$date->day){
//                     $counter -= 33;
//                 }
//             } 
//         }

  




            // if ($data->birth_year){ 
            //     if(!$dateYear){ 
            //         $counter -= 33;
            //     }
            //     if( $dateYear != $data->birth_year) {
            //         return false;
            //     }
                 
            // }else {

            //         if(!$date->year){
            //             $counter -= 33;
            //         }
            //         if( $date->year != $data->birth_year) {
            //             return false;
            //         }
            // }
            // }
            
        
            
            // if(!$dateYear){
                // if ($data->birth_month) {
                //     if(!$date->month){
                //         $counter -= 33;
                //     }
                //     if($date->month != $data->birth_month) {
                //         return false;
                //     }
                // } 
    
                // if ($data->birth_day){
                //     if(!$date->day){
                //         $counter -= 33;
                //     }
                //     if($date->day != $data->birth_day) {
                //         return false;
                //     }
                // } 
            // }
            // else {
            //     $counter -= 66;
            // }

        return $counter;
    }

    public function showAllDetailsDoc($filename)
    {
        $fullPath = storage_path('app/' . 'uploads/' . $filename);
        $text = $this->getDocContent($fullPath);
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

    public function editDetailItem($request, $id)
    {
        $details = TmpManFindText::find($id);
        $update = $details->update([
            $request['column'] => trim($request['newValue'])
        ]);

        if ($update) {
            TmpManFindTextsHasMan::where('tmp_man_find_texts_id', $id)->delete();

            $fullname = $details['name'] . " " . $details['surname'];
            $getLikeManIds = Man::search($fullname)->get()->pluck('id');
            $getLikeMan = Man::whereIn('id', $getLikeManIds)->with('firstName', 'lastName', 'middleName')->get();
            $procentName = 0;
            $procentLastName = 0;
            $procentMiddleName = 0;
            $generalProcent = TmpManFindText::PROCENT_GENERAL_MAIN;
            if ($getLikeMan) {
                foreach ($getLikeMan as $key => $man) {
                    $avg = 0;
                    $countAvg = 0;
                    // if(!$details['patronymic'] || !$details['birthday']){
                    //     $generalProcent = TmpManFindText::PROCENT_GENERAL_NO_MAJOR;
                    // }

                    if (
                        !($details['name'] || $man->firstName) ||
                        !($details['surname'] || $man->lastName)
                    ) {
                        continue;
                    }

                    if($details->name){
                        if (!(isset($man->firstName) && $man->firstName->first_name)) {
                            continue;
                        }
                        $manFirstName = isset($man->firstName)?$man->firstName->first_name:"";
                        $procentName = $this->differentFirstLetter($manFirstName, $details['name'], $generalProcent);
                        $countAvg++;
                        $avg += $procentName;
                        if (!$procentName) {
                            continue;
                        }
                    }

                    if($details['surname']){
                        if (!(isset($man->lastName) && $man->lastName->last_name)) {
                            continue;
                        }
                        $manLastName = isset($man->lastName)?$man->lastName->last_name:"";
                        if(!$manLastName){
                            $countAvg++;
                            $avg += 0;
                        }else{
                            $procentLastName = $this->differentFirstLetter($manLastName, $details['surname'], $generalProcent);
                            $countAvg++;
                            $avg += $procentLastName;
                            if (!$procentLastName) {
                                continue;
                            }
                        }
                    }

                    if($details['patronymic']){
                        $manMiddleName = isset($man->middleName)?$man->middleName->middle_name:"";
                        if(!$manMiddleName){
                            $countAvg++;
                            $avg += 0;
                        }else{
                            $procentMiddleName = $this->differentFirstLetter($manMiddleName, $details['patronymic'], $generalProcent);
                            $countAvg++;
                            $avg += $procentMiddleName;
                            if (!$procentMiddleName) {
                                continue;
                            }
                        }
                    }
                    $details->editable = true;

                    if($details['birthday']){
                        //add approximate year
                        $manBirthday = $man->birthday ?? $man->birthday_str;

                         if(!$manBirthday){
                            $countAvg++;
                            $avg += 0;
                        }else {
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

                        $details['status'] = TmpManFindText::STATUS_FOUND;

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

                    // if ($procentName == 100 && $procentLastName == 100 && $procentMiddleName == 100) {
                    //     $details['editable'] = false;
                    //     $details['status'] = TmpManFindText::STATUS_FOUND;
                    // }
                    if (
                        (count($likeManArray) == 0)  && ($details['surname'] == null || $details['birth_year'] == null || 
                            $details['birth_month'] == null || $details['birth_day'] == null
                        )  ) {
                            $details['editable'] = true;
                            $details['status'] = TmpManFindText::STATUS_ALMOST_NEW;
                    }
                    elseif (
                        (count($likeManArray) == 0)  && ($details['surname'] != null && $details['birth_year'] != null && 
                            $details['birth_month'] != null && $details['birth_day'] != null
                             )  ) {
                                $details['editable'] = false;
                                $details['status'] = TmpManFindText::STATUS_NEW;
                    }
                    elseif (count($likeManArray) > 0) {
                        $details['editable'] = true;
                        $details['status'] = TmpManFindText::STATUS_LIKE;
                    }

                    usort($likeManArray, function ($item1, $item2) {
                        return  $item1['procent'] <=> $item2['procent'];
                    });

                    $details['child'] = $likeManArray;

                }
            }
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

    public function uploadFile($file)
    {
        // TmpManFindText::query()->delete();
        // TmpManFindTextsHasMan::query()->delete();
        // dd(33);

        $likeManArray = [];
        $readyLikeManArray = [];

        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $fileName);
        $fullPath = storage_path('app/' . $path);
        $text = $this->getDocContent($fullPath);
        $fileId = $this->addFile($fileName, $file->getClientOriginalName(), $path);
        $parts = explode("\t", $text);
        $dataToInsert = [];
        // $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.\d{2,}.\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
        //last working patters
        $pattern = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/\s*((\d{2,}.)?(\d{2,}.)?(\d{2,}))\s*(.+?)\//u';
        //testt
        // $pattern = '/(([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/\s*((\d{2,}.)?(\d{2,}.)?(\d{2,}))\s*(.+?)\//u';

        foreach ($parts as $key => $part) {
            if ($text) {
                preg_match_all($pattern, $part, $matches, PREG_SET_ORDER);
                foreach ($matches as $key => $value) {
                    $birthDay = (int) $value[6] === 0 ? null : (int) $value[6];
                    $birthMonth = (int) $value[7] === 0 ? null : (int) $value[7];
                    $birthYear = (int) $value[8] === 0 ? null : (int) $value[8];

                    $address = mb_strlen($value[9], 'UTF-8') < 10 ? $address = '' : $value[9];

                    $valueAddress = str_replace("թ.ծ.,", "", $address);
                    $valueAddress = str_replace("թ.ծ", "", $valueAddress);
                    $valueAddress = str_replace("թ. ծ.,", "", $valueAddress);
                    $valueAddress = str_replace("չի աշխ.", "", $valueAddress);

                    $surname = trim($value[4] == "" ? $value[3] : $value[4]);
                    $patronymic = trim($value[4] == "" ? "" : $value[3]);

                    $text = trim($part);

                    $text = mb_ereg_replace($value[0], "<p style='color: #0c05fb; margin: 0;'>$value[0]</p>", $text);

                    if (Str::endsWith($surname, 'ը') || Str::endsWith($surname, 'ի')) {
                        $surname = Str::substr($surname, 0, -1);
                    }
                    if (mb_substr($surname, -2, 2, 'UTF-8') == 'ից' || mb_substr($surname, -2, 2, 'UTF-8') == 'ին') {
                        $surname = Str::substr($surname, 0, -2);
                    }
                    $dataToInsert[] = [
                        'name' => $value[2],
                        'surname' => $surname,
                        'patronymic' => $patronymic,
                        'birthday_str' => $value[5],
                        'birth_day' => $birthDay,
                        'birth_month' => $birthMonth,
                        'birth_year' => $birthYear,
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

            $generalProcent = TmpManFindText::PROCENT_GENERAL_MAIN;
            foreach ($getLikeMan as $key => $man) {
                if (
                    !($item['name'] && $man->firstName) ||
                    !($item['surname'] && $man->lastName)
                ) {
                    continue;
                }
            
                $procentName = $this->differentFirstLetter($man->firstName->first_name, $item['name'], $generalProcent, $key);
                $procentLastName = $this->differentFirstLetter($man->lastName->last_name, $item['surname'], $generalProcent,$key);
                $procentMiddleName = ($item['patronymic']) ? $this->differentFirstLetter($man->middleName?$man->middleName->middle_name:"", $generalProcent, $item['patronymic']) : null;
            
                if ($procentName && $procentLastName ) {
                    TmpManFindTextsHasMan::create([
                        'tmp_man_find_texts_id' => $tmpItem->id,
                        'man_id' => $man->id,
                    ]);
                }
            }

        }

        return $fileName;

        // $this->findDataService->addFindData('word', $dataToInsert, $fileId);
        // return true;
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
                $dataMan = $data['man'];
                $generalProcent = TmpManFindText::PROCENT_GENERAL_MAIN;
                if($data->find_man_id){
                   $selectedStatus = $data['selected_status'];
                   $generalParentId = $data['find_man_id'];
                   $data = $data->getApprovedMan;
                   $data = $this->addManRelationsData($data);
                   $data->editable = false;
                   $data->selectedStatus = $selectedStatus;
                   $data->generalParentId = $generalParentId;
                   $data->status = TmpManFindText::STATUS_APPROVED;
                   $data->procent = TmpManFindText::PROCENT_APPROVED;
                   $readyLikeManArray[] = $data;
                   continue;
                }
             

                foreach ($dataMan as $key => $man) {
                    $avg = 0;
                    $countAvg = 0;

                    if($data['name']){
                        if (!(isset($man->firstName) && $man->firstName->first_name)) {
                            continue;
                        }
                        $manFirstName = isset($man->firstName)?$man->firstName->first_name:"";
                        $procentName = $this->differentFirstLetter($manFirstName, $data['name'], $generalProcent, $idx);
                        $countAvg++;
                        $avg += $procentName;
                        if (!$procentName) {
                            continue;
                        }
                    }

                    if($data['surname']){
                        if (!(isset($man->lastName) && $man->lastName->last_name)) {
                            continue;
                        }
                        $manLastName = isset($man->lastName)?$man->lastName->last_name:"";
                        if(!$manLastName){
                            $countAvg++;
                            $avg += 0;
                        }else{
                            $procentLastName = $this->differentFirstLetter($manLastName, $data['surname'], $generalProcent, $key);
                            $countAvg++;
                            $avg += $procentLastName;
                            if (!$procentLastName) {
                                continue;
                            }
                        }
                    }

                    if($data['patronymic']){
                        $manMiddleName = isset($man->middleName)?$man->middleName->middle_name:"";
                        if(!$manMiddleName){
                            $countAvg++;
                            $avg += 0;
                        }else{
                            $procentMiddleName = $this->differentFirstLetter($manMiddleName, $data['patronymic'], $generalProcent, $idx);
                            $countAvg++;
                            $avg += $procentMiddleName;
                           
                            if (!$procentMiddleName) {
                                continue;
                            }
                        }
                    }

                    if($data['birthday']){
                        //add approximate year
                        $manBirthday = $man->birthday ?? $man->birthday_str;

                        if(!$manBirthday){
                            $countAvg++;
                            $avg += 0;
                        }else {
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
                    if ($procentName == 100 && $procentLastName == 100 && $procentMiddleName == 100) {
                        $dataIds = [
                            'fileItemId' => $data->id,
                            'manId' => $man->id,
                        ];
                        $man = $this->likeFileDetailItem($dataIds);
                        if($man){
                            TmpManFindText::where('id', $data->id)->update([
                                'find_man_id' => $man->id
                            ]);
                            $man = $this->addManRelationsData($man);
                            $man['status'] = TmpManFindText::STATUS_APPROVED;
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
                    (count($dataMan) == 0)  && ($data['surname'] == null || $data['birth_year'] == null || 
                        $data['birth_month'] == null || $data['birth_day'] == null
                    )  ) {
                    $data['editable'] = true;
                    $data['status'] = TmpManFindText::STATUS_ALMOST_NEW;
                }
                elseif (
                    (count($dataMan) == 0)  && ($data['surname'] != null && $data['birth_year'] != null && 
                        $data['birth_month'] != null && $data['birth_day'] != null
                         )  ) {
                        $data['editable'] = false;
                        $data['status'] = TmpManFindText::STATUS_NEW;
                }
                elseif (count($readyLikeManArray) > 0) {
                    $data['editable'] = true;
                    $data['status'] = TmpManFindText::STATUS_LIKE;
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

    public function likeFileDetailItem($data, $status=TmpManFindText::STATUS_AUTOMAT_FOUND)
    {
        try {
            DB::beginTransaction();
            $authUserId = auth()->user()->id;
            $fileItemId = $data['fileItemId'];
            $manId = $data['manId'];
            $fileMan = TmpManFindText::find((int) $fileItemId);
            $fileId = $fileMan->file_id;
            if ($authUserId) {
                $bibliographyid = Bibliography::addBibliography($authUserId);
                BibliographyHasFile::bindBibliographyFile($bibliographyid, $fileId);
                ManHasBibliography::bindManBiblography($manId, $bibliographyid);
                $fileMan->update(['find_man_id' =>  $manId, 'selected_status' => $status]);
            }
            DB::commit();

            $man = Man::where('id', $manId)->with('firstName', 'lastName', 'middleName')->first();
            $man->selected_status = $status;
            $man->selected_parent_id = $fileMan->id;  
            $man->status = TmpManFindText::STATUS_APPROVED;
            return $man;
        } catch (\Exception $e) {
            \Log::info("likeFileDetailItem Exception");
            \Log::info($e);
            DB::rollBack();

        } catch (\Error $e) {
            \Log::info("likeFileDetailItem Error");
            \Log::info($e);
            DB::rollBack();
        }

    }

    public function newFileDataItem($data)
    {
        try {
            DB::beginTransaction();
            $fileItemId = $data['fileItemId'];
            $fileData = TmpManFindText::find($fileItemId);
            $id = $this->findDataService->addFindData('word', $fileData, $fileData->file_id);
            $fileData->update(['find_man_id' => $id]);
            $man = Man::where('id', $id)->with('firstName', 'lastName', 'middleName')->first(); 
            $man->status = TmpManFindText::STATUS_APPROVED;
            $man->procent = TmpManFindText::PROCENT_APPROVED;
            DB::commit();
            return $man;
        } catch (\Exception $e) {
            \Log::info("likeFileDetailItem Exception");
            \Log::info($e);
            DB::rollBack();

        } catch (\Error $e) {
            \Log::info("likeFileDetailItem Error");
            \Log::info($e);
            DB::rollBack();
        }

    }

    


}