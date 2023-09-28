<?php

namespace App\Services;

use App\Models\Man\Man;
use App\Models\Man\ManHasFindText;
use App\Models\TempTables\TmpManFindText;
use App\Models\TempTables\TmpManFindTextsHasMan;
use PhpOffice\PhpWord\IOFactory;
use App\Models\DataUpload;
use App\Models\File\File;
use Illuminate\Support\Str;
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

    public function differentFirstLetter($man, $item, $key = null)
    {
        $manFirst = mb_substr($man, 0, 1, 'UTF-8');
        $itemFirst = mb_substr($item, 0, 1, 'UTF-8');
        $diff = $manFirst === $itemFirst;

        if (!$diff) {
            return false;
        }

        similar_text($man, $item, $procent);

        if ($procent <= 71) {
            return false;
        }

        return $procent;
    }

    public function showAllDetailsDoc($filename)
    {
        $fullPath = storage_path('app/' . 'uploads/' . $filename);
        $text = $this->getDocContent($fullPath);
        $parts = explode("\t", $text);
        $implodeArray = implode("\n", $parts);
        $fileId = File::getFileIdByName($filename);
        $detailsForReplace = ManHasFindText::getFindTextByFileId($fileId);
        foreach ($detailsForReplace as $key => $details) {
            $implodeArray = mb_ereg_replace($details, "<p style='color: #0c05fb; margin: 0;'>$details</p>", $implodeArray);
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
            $request['column'] => $request['newValue']
        ]);

        if($update){
            TmpManFindTextsHasMan::where('tmp_man_find_texts_id', $id)->delete();

            $fullname = $details['name'] . " " . $details['surname'];
            $getLikeManIds = Man::search($fullname)->get()->pluck('id');
            $getLikeMan = Man::whereIn('id', $getLikeManIds)->with('firstName', 'lastName', 'middleName')->get();
    
            $procentName = 0;
            $procentLastName = 0;
            $procentMiddleName = 0;
    
            $fullname = $details['name'] . " " . $details['surname'];
            $getLikeManIds = Man::search($fullname)->get()->pluck('id');
            $getLikeMan = Man::whereIn('id', $getLikeManIds)->with('firstName', 'lastName', 'middleName')->get();
    
            if ($getLikeMan) {
    
                foreach ($getLikeMan as $key => $man) {
                    $avg = 0;
                    $countAvg = 0;
                    if (!($details['name'] && $man->firstName)) {
                        continue;
                    }
                    $procentName = $this->differentFirstLetter($man->firstName->first_name, $details['name'], $key);
                    $countAvg++;
                    $avg += $procentName;
                    if (!$procentName) {
                        continue;
                    }
    
                    if (!($details['surname'] && $man->lastName)) {
                        continue;
                    }
    
                    $procentLastName = $this->differentFirstLetter($man->lastName->last_name, $details['surname'], $key);
                    $countAvg++;
                    $avg += $procentLastName;
                    if (!$procentLastName) {
                        continue;
                    }
    
                    if ($details['patronymic'] && $man->middleName) {
                        $procentMiddleName = $this->differentFirstLetter($man->middleName->middle_name, $details['patronymic']);
                        if (!$procentMiddleName) {
                            continue;
                        }
                    }
                    $countAvg++;
                    $avg += $procentMiddleName;
    
                    $likeManArray[] = [
                        'man' => $man,
                        'procent' => $avg / $countAvg
                    ];
    
                    TmpManFindTextsHasMan::create([
                        'tmp_man_find_texts_id' => $details->id,
                        'man_id' => $man->id,
                    ]);
    
                if ($procentName == 100 && $procentLastName == 100 && $procentMiddleName == 100) {
                    $details['status'] = "same";
                } elseif (count($likeManArray) == 0) {
                    $details['status'] = "new";
                } elseif (count($likeManArray) > 0) {
                    $details['status'] = "like";
                }
                $details['child'] = $likeManArray;
                }
                $likeManArray = [];
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
        $parts = explode("\t", $text);
        $dataToInsert = [];
        // $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+)\s+\/(\d{2,}.\d{2,}.\d{2,})\s*(.+?)\s*(բն\.[0-9]+. | \s*\/\s* | .\/. | \w+\/. | \w+\/\/s* | \w+\/ | \w+.\/ | տ\.[0-9]+.)/u';
        $pattern = '/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?)\/((\d{2,}.)?(\d{2,}.)?(\d{2,}))\s*(.+?)\//u';

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
            $item['file_path'] = $path;
            $item['birthday'] = $item['birthday_str'];
            $tmpItem = TmpManFindText::create($item);

            $procentName = 0;
            $procentLastName = 0;
            $procentMiddleName = 0;

            $fullname = $item['name'] . " " . $item['surname'];
            $getLikeManIds = Man::search($fullname)->get()->pluck('id');
            $getLikeMan = Man::whereIn('id', $getLikeManIds)->with('firstName', 'lastName', 'middleName')->get();

            if ($getLikeMan) {

                foreach ($getLikeMan as $key => $man) {
                    if (!($item['name'] && $man->firstName)) {
                        continue;
                    }
                    $procentName = $this->differentFirstLetter($man->firstName->first_name, $item['name'], $key);
                   
                    if (!$procentName) {
                        continue;
                    }

                    if (!($item['surname'] && $man->lastName)) {
                        continue;
                    }

                    $procentLastName = $this->differentFirstLetter($man->lastName->last_name, $item['surname'], $key);
                    
                    if (!$procentLastName) {
                        continue;
                    }

                    if ($item['patronymic'] && $man->middleName) {
                        $procentMiddleName = $this->differentFirstLetter($man->middleName->middle_name, $item['patronymic']);
                        if (!$procentMiddleName) {
                            continue;
                        }
                    }

                    TmpManFindTextsHasMan::create([
                        'tmp_man_find_texts_id' => $tmpItem->id,
                        'man_id' => $man->id,
                    ]);

                }

                // if ($procentName == 100 && $procentLastName == 100 && $procentMiddleName == 100) {
                //     $item['status'] = "same";
                // } elseif (count($likeManArray) == 0) {
                //     $item['status'] = "new";
                // } elseif (count($likeManArray) > 0) {
                //     $item['status'] = "like";
                // }
                // $item['child'] = $likeManArray;

            }
            // $readyLikeManArray[] = $item;
            // $likeManArray = [];
        }
        // dd($readyLikeManArray);
        // session(['readyLikeManArray' => $readyLikeManArray]);

        return $fileName;


        // $fileDetails = [
        //     'name' => $fileName,
        //     'real_name' => $file->getClientOriginalName(),
        //     'path' => $path
        // ];

        // $this->findDataService->addFindData('word', $dataToInsert, $fileDetails);
        // return true;
    }


    public function checkedFileData($fileName)
    {
        $likeManArray = [];
        $readyLikeManArray = [];
        $dataToInsert = [];
        $fileData = TmpManFindText::with(['man.firstName', 'man.lastName', 'man.middleName'])->where('file_name', $fileName)->with('man')->get();
        if ($fileData) {
            foreach ($fileData as $idx => $data) {
                $procentName = 0;
                $procentLastName = 0;
                $procentMiddleName = 0;
                $dataMan = $data['man'];
                foreach ($dataMan as $key => $man) {
                    $avg = 0;
                    $countAvg = 0;
                    if (!($data['name'] && $man->firstName->first_name)) {
                        continue;
                    }
                   
                    $procentName = $this->differentFirstLetter($man->firstName->first_name, $data['name'], $idx);
                    $countAvg++;
                    $avg += $procentName;

                    if (!$procentName) {
                        continue;
                    }

                    if (!($data['surname'] && $man->lastName->last_name)) {
                        continue;
                    }

                    $procentLastName = $this->differentFirstLetter($man->lastName->last_name, $data['surname'], $key);
                    $countAvg++;
                    $avg += $procentLastName;
                    if (!$procentLastName) {
                        continue;
                    }

                    if ($data['patronymic'] && $man->middleName) {
                        $procentMiddleName = $this->differentFirstLetter($man->middleName->middle_name, $data['patronymic']);
                        if (!$procentMiddleName) {
                            continue;
                        }
                    }

                    if ($man->middleName) {
                        $countAvg++;
                        $avg += $procentMiddleName;
                    }
               
                    $likeManArray[] = [
                        'man' => $man,
                        'procent' => $avg / $countAvg
                    ];
                }

                if ($procentName == 100 && $procentLastName == 100 && $procentMiddleName == 100) {
                    $data['status'] = "same";
                } elseif (count($likeManArray) == 0) {
                    $data['status'] = "new";
                } elseif (count($likeManArray) > 0) {
                    $data['status'] = "like";
                }
                $data['child'] = $likeManArray;
                $readyLikeManArray[] = $data;
                $likeManArray = [];

            }
        }

        return ['info' => $readyLikeManArray, 'fileName' => $fileName];
    }

    public function likeFileDetailItem($data)
    {
        $authUserId = auth()->user()->id;
        $fileItemId = $data['fileItemId'];
        $manId = $data['manId'];

        // if($authUserId){
        //     $fileId = File::addFile($fileDetail);
        //     $bibliographyid = Bibliography::addBibliography($authUserId);
        //     BibliographyHasFile::bindBibliographyFile($bibliographyid, $fileId);

        //     if($fileId){
        //         foreach ($findData as $key => $man) {
        //             // dd($man);
        //             $this->createMan($docFormat, $man, $fileId, $bibliographyid, $key);
        //         }
        //     }
        // }

        dd($fileItemId, $manId);
    }


}