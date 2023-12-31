<?php

namespace App\Services;

use App\Events\ConsistentSearchEvent;
use App\Models\Bibliography\BibliographyHasFile;
use App\Models\ConsistentSearch;
use App\Models\DataUpload;
use App\Models\File\File;
use App\Models\File\FileText;
use App\Models\FileHasUrlData;
use App\Models\Man\Man;
use App\Models\TempTables\TmpManFindText;
use App\Models\TempTables\TmpManFindTextsHasMan;
use App\Services\Filter\UploadDictionaryFilterService;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;


class SearchService
{
    private $findDataService;
    private $convertUnicode;

    public function __construct(FindDataService $findDataService, ConvertUnicode $convertUnicode)
    {
        $this->findDataService = $findDataService;
        $this->convertUnicode = $convertUnicode;
    }

    public function showAllDetailsDoc($filename)
    {
        $file = File::where('name', $filename)->first();
        $fullPath = public_path(Storage::url($file->path));
        $text = getDocContent($fullPath);
        if($file->file_lang == 'am' && $file->file_phonetic){
            $text = $this->convertUnicode->convertArm($text);
        }
        $parts = explode("\t", $text);
        $implodeArray = implode("\n", $parts);
        $fileId = $file->id;
        $detailsForReplace = TmpManFindText::getFindTextByFileId($fileId);

        foreach ($detailsForReplace as $key => $details) {
            if(strpos($implodeArray, $details)){
                if(Cache::has('uploadReferenceFileName') && Cache::get('uploadReferenceFileName') == $filename){
                    $details = preg_quote($details);
                }
                $implodeArray = mb_ereg_replace($details, "<span class='find-by-class' style='color: #0c05fb; margin: 0;'>$details</span>", $implodeArray);
            }
        }
        return $implodeArray;
    }

    public function showAllDetails()
    {
        return DataUpload::all();
    }

    public function editDetailItem($request, $id)
    {
        $details = $this->findDataService->editDetailItem($request, $id);

        return $details;
    }

    public function updateDetails($request, $id)
    {
        $details = DataUpload::find($id);
        $details->update($request);

        return $details;
    }

    public function checkAndRemoveLastSimbol($text)
    {
        $str = $text;
        $symbols = array(",", ":", ";", ".", "!", "?"); 

        if (in_array(mb_substr($str, -1), $symbols)) {
            $str = mb_substr($str, 0, -1);
        }

        return $str;
    }

    public function addFile($fileDetails): int
    {
        $fileDetails['via_summary'] = 1;

        
        //new changes
//        $fileId =  DB::table('file')->insertGetId([
//             'name' => $fileName,
//             'real_name' => $orginalName,
//             'path' => $path,
//             'via_summary' => 1,
//         ]);
// $filePath = File::find($fileId)->path;
//             $text = getDocContent(public_path(Storage::url($filePath)));

//             if($text){
//                 FileText::create([
//                     'file_id'=> $fileId,
//                     'content'=> $text,
//                 ]);
//             }

$fileId = File::create($fileDetails)->id;

// $fileId = 22;
        // $fileId = File::addFile($fileDetails);

        return $fileId;
    }

    public function uploadFile($file, $bibliographyId, $dataForUrl)
    {
        if ($bibliographyId) {
            $likeManArray = [];
            $readyLikeManArray = [];

            $fileName = time() . '_' . $file->getClientOriginalName();

            if($dataForUrl['table_name']){
              FileHasUrlData::create([
                  'file_name' => $fileName,
                  'url_data' => json_encode($dataForUrl)
              ]);
            }

            $path = $file->storeAs('public/uploads', $fileName);
            $fullPath = public_path(Storage::url('uploads/' . $fileName));

            if($file->extension() == "doc"){
                $inputPath = storage_path('app/' . $path);
                $convert = convertDocToDocx($inputPath, storage_path('app/' . 'public/uploads/'));
                if($convert){
                    if (file_exists($inputPath . 'x') && file_exists($inputPath)) {
                        $removePath = 'public\uploads' . $fileName;
                        Storage::delete($removePath);
                        $path = $path.'x';
                        $fileName = $fileName.'x';
                        $fullPath = public_path(Storage::url('uploads/' . $fileName));
                    }
                }
                
            }
            info('getDocContentstart', [(now()->minute * 60) + now()->second]);

            $text = getDocContent($fullPath);
            info('getDocContentend', [(now()->minute * 60) + now()->second]);

            // dd($text);
            info('addFile', [(now()->minute * 60) + now()->second]);
            $fileDetails = [
                'name' => $fileName,
                'real_name' => $file->getClientOriginalName(),
                'path' => $path,
            ];
            $fileId = $this->addFile($fileDetails);
            info('addFile', [(now()->minute * 60) + now()->second]);

            $parts = explode("\t", $text);
            $dataToInsert = [];
            $matchLong = [];
            info('regexpstart', [(now()->minute * 60) + now()->second]);

            //last working patter
            // $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?\/\s*((\d{2,}.)?(\d{2,}.)?(\d{2,}))?\s*(.+?)\/[^Ա-Ֆա-ֆ0-9]/u';

            $pattern = '/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?(?:|\/|\()\s*((\d{2,}.)?(\d{2,}.)?(\d{2,}))/u';

            // $pattern = "/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?(((|\/|\()?)((ծնվ.\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(ծնված.\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))(\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\d{2,}.)?(\d{2,}.)?(\d{2,})))?/u";
            //newwwwww version !!!
            // $pattern = '/(?<name>[Ա-Ֆ][ա-ֆև]+)\s+(?<patronymic>[Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?\/\s*((\d{2,}.)?(\d{2,}.)?(\d{2,}))?\s*(.+?)\/[^Ա-Ֆա-ֆ0-9]/u';

            // if($fileBelong === config("constants.search.STATUS_REFERENCE")){
            //     // $pattern = "/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?.((\d{2,}.)?(\d{2,}.)?(\d{2,}))?|)/u";
            //     // $pattern = "/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?\/\s*((\d{2,}.)?(\d{2,}.)?(\d{2,}))?|([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?\/\s*((\d{2,}.)?(\d{2,}.)?(\d{2,}))?)/u";
            //     // $pattern = "/(([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?.((\w*\.\d{2}\.\d{2}\.\d{4}\.g\.r|\d{2}\.\d{2}\.\d{4}\.g\.r))?)/u";
            //     $pattern = "/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?.((\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\d{2,}.)?(\d{2,}.)?(\d{2,})|(\w*))/u";

            // }

            foreach ($parts as $key => $part) {
                if ($text) {
                    preg_match_all($pattern, $part, $matches, PREG_SET_ORDER);
// dd($text, $matches);
                    foreach ($matches as $key => $value) {
                        $birthDay = (int) $value[8] === 0 ? null : (int) $value[8];
                        $birthMonth = (int) $value[9] === 0 ? null : (int) $value[9];
                        $birthYear = (int) $value[10] === 0 ? null : (int) $value[10];
                        // $address = mb_strlen($value[9], 'UTF-8') < 10 ? $address = '' : $value[9];
                        // $address = mb_strlen($value[11], 'UTF-8') < 10 ? $address = '' : $value[11];

                        // $valueAddress = str_replace("թ.ծ.,", "", $address);
                        // $valueAddress = str_replace("թ.ծ", "", $valueAddress);
                        // $valueAddress = str_replace("թ. ծ.,", "", $valueAddress);
                        // $valueAddress = str_replace("չի աշխ.", "", $valueAddress);
                        // $valueAddress = trim($valueAddress);
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
                        if ($value[4] != "") {
                            $name = trim($value[1]) . " " . trim($value[2]) . " " . trim($value[3]) . " " . trim($value[4]) . " " . trim($value[5]) . " " . trim($value[6]);
                        }
                        $dataToInsert[] = [
                            'name' => trim($name),
                            'surname' => $value[4] != "" ? trim($name) : $surname,
                            'patronymic' => $value[4] != "" ? "" : $patronymic,
                            'birthday_str' => $value[7],
                            "birth_day" => $birthDay,
                            "birth_month" => $birthMonth,
                            "birth_year" => $birthYear,
                            'address' => '',
                            'find_text' => $value[0],
                            'paragraph' => $text,
                        ];
                    }
                }
            }
            info('regexpsend', [(now()->minute * 60) + now()->second]);

            $fileDetails = [
                'file_name'=> $fileName,
                'real_file_name'=> $file->getClientOriginalName(),
                'file_path'=> $path,
                'fileId'=> $fileId,
            ];
            
            info('addFindDataToInsert', [(now()->minute * 60) + now()->second]);

            $this->findDataService->addFindDataToInsert($dataToInsert, $fileDetails);
            info('addFindDataToInsert', [(now()->minute * 60) + now()->second]);

            BibliographyHasFile::bindBibliographyFile($bibliographyId, $fileId);
            event(new ConsistentSearchEvent(ConsistentSearch::SEARCH_TYPES['MAN'], $text, ConsistentSearch::NOTIFICATION_TYPES['UPLOADING'], $fileId));
            return $fileName;
        }

        throw new \Exception('Something went wrong');

    }
    public function checkedFileData($fileName)
    {
        $totalCount = TmpManFindText::where('file_name', $fileName)->with('man')
        ->count();

        $fileData = TmpManFindText::with([
            'man.firstName1',
            'man.lastName1',
            'man.middleName1',
            'getApprovedMan.firstName',
            'getApprovedMan.lastName',
            'getApprovedMan.middleName'
        ])
            ->where('file_name', $fileName)->with('man')->get();
// dd($fileData);
        if ($fileData) {
            $readyLikeManArray = $this->findDataService->calculateCheckedFileDatas($fileData);
        }
        $readyLikeManArray = array_slice($readyLikeManArray, 0, 12);

        return ['info' => $readyLikeManArray, 'fileName' => $fileName, 'count' => $totalCount ?? 0];
    }

    public function likeFileDetailItem($data, $status = TmpManFindText::STATUS_AUTOMAT_FOUND)
    {
        $man = $this->findDataService->likeFileDetailItem($data, $status = TmpManFindText::STATUS_AUTOMAT_FOUND);

        return $man;

    }

    public function newFileDataItem($dataOrId)
    {
        $man = $this->findDataService->newFileDataItem($dataOrId);

        return $man;
    }

    public function bringBackLikedData($data)
    {
        $details = $this->findDataService->bringBackLikedData($data);

        return $details;
    }

    public function customAddFileData($data, $fileName)
    {
        $birthday = trim($data['birthday']??'');
        $findText = trim($data['findText']??'');
        $newItem = new TmpManFindText();
        $newItem->name = trim($data['name']);
        $newItem->surname = trim($data['surname']);
        $newItem->patronymic = trim($data['patronymic']??'');
        $newItem->address = trim($data['address']??'');
        $newItem->find_text = $findText;
        if($birthday){
            if (strlen($birthday) == 4) {
                $newItem->birthday = $birthday;
                $newItem->birth_year = $birthday;
            } else {
                $dateString = str_replace('․', '.', $birthday);
                $date = Carbon::createFromFormat('d.m.Y', $dateString);
                $newItem->birthday = $birthday;
                $newItem->birth_year = $date->year;
                $newItem->birth_month = $date->month;
                $newItem->birth_day = $date->day;
            }
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
        // LogService::store($data, null, 'tmp_man_find_texts', 'customAddItem');

        $tmpItem = $newItem;

        $procentName = 0;
        $procentLastName = 0;
        $procentMiddleName = 0;

        $fullname = $tmpItem['name'] . " " . $tmpItem['surname'];

        $getLikeManIds = Man::search($fullname)->get()->pluck('id');
        $getLikeMan = Man::whereIn('id', $getLikeManIds)->with('firstName', 'lastName', 'middleName')->get();

        $generalProcent = config('constants.search.PROCENT_GENERAL_MAIN');
        foreach ($getLikeMan as $key => $man) {
// if (
//                 !($tmpItem['name'] && $man->firstName) ||
//                 !($tmpItem['surname'] && $man->lastName)
//             ) {
//                 continue;
//             }
            $procentName = differentFirstLetterHelper($man->firstName->first_name, $tmpItem['name'], $generalProcent);
            $procentLastName = differentFirstLetterHelper($man->lastName->last_name, $tmpItem['surname'], $generalProcent);
            $procentMiddleName = ($tmpItem['patronymic']) ? differentFirstLetterHelper($man->middleName ? $man->middleName->middle_name : "", $generalProcent, $tmpItem['patronymic']) : null;

            if ($procentName && $procentLastName) {
                TmpManFindTextsHasMan::create([
                    'tmp_man_find_texts_id' => $tmpItem->id,
                    'man_id' => $man->id,
                ]);
            }
        }


    }

    public function uploadReference($file, $bibliographyId, $textLang='am', $phonetic=false)
    {

        if ($bibliographyId) {
            $likeManArray = [];
            $readyLikeManArray = [];


            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads', $fileName);
            // $path = '/' . $path;
            // $fullPath = storage_path('app/' . $path);
            $fullPath = public_path(Storage::url('uploads/' . $fileName));

            if($file->extension() == "doc"){
                $inputPath = storage_path('app/' . $path);
                $convert = convertDocToDocx($inputPath, storage_path('app/' . 'public/uploads/'));
                if($convert){
                    if (file_exists($inputPath . 'x') && file_exists($inputPath)) {
                        $removePath = 'public\uploads' . $fileName;
                        Storage::delete($removePath);
                        $path = $path.'x';
                        $fileName = $fileName.'x';
                        $fullPath = public_path(Storage::url('uploads/' . $fileName));
                    }
                }

            }

            $text = getDocContent($fullPath);

            if($phonetic && $textLang == "am"){
                $text = $this->convertUnicode->convertArm($text);
            }

            $fileDetails = [
                'name' => $fileName,
                'real_name' => $file->getClientOriginalName(),
                'path' => $path,
                'file_lang' => $textLang,
                'file_phonetic' => $phonetic,
            ];
    
            $fileId = $this->addFile($fileDetails);
            $parts = explode("\t", $text);

            $dataToInsert = [];
            $matchLong = [];

            //pattern  for ","
            //$pattern = "/([Ա-Ֆ][ա-ֆև]+.)\s+([Ա-Ֆ][ա-ֆև]+.\s+)([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?.((\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\d{2,}.)?(\d{2,}.)?(\d{2,})|(\w*))/u";
            //pattern default
            // $pattern = "/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?([Ա-Ֆ][ա-ֆև]+\s+)?.((\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\d{2,}.)?(\d{2,}.)?(\d{2,})|(\w*))/u";
            //pattern ready
            // $pattern = "/([Ա-Ֆ][ա-ֆև]+.)\s+([Ա-Ֆ][ա-ֆև]+.\s+)([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?.((ծնվ.\s+(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(ծնված.\s+(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\d{2,}.)?(\d{2,}.)?(\d{2,})|(\w*))/u";
            //pattern new best
            // $pattern = "/([Ա-Ֆ][ա-ֆև]+.)\s+([Ա-Ֆ][ա-ֆև]+.\s+)([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?((|\/|\()?)((ծնվ.\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(ծնված.\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))(\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\d{2,}.)?(\d{2,}.)?(\d{2,}))/u";

            //New Pattern sutructure in associative array
            //$pattern = "/(?<name>[Ա-Ֆ][ա-ֆև]+)\s+(?<patronymic>[Ա-Ֆ][ա-ֆև]+\s+)(?<surname>[Ա-Ֆ][ա-ֆև]+.\s+)?(?<bignameOne>[Ա-Ֆ][ա-ֆև]+.\s+)?(?<bignameTwo>[Ա-Ֆ][ա-ֆև]+.\s+)?(?<bignameThree>[Ա-Ֆ][ա-ֆև]+.\s+)?(((|\/|\()?)((ծնվ.\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(ծնված.\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))(\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\d{2,}.)?(\d{2,}.)?(\d{2,})))?/u";
            //russian pattern working
            //([А-Я][а-я]+)\s+([А-Я][а-я]+\s+)([А-Я][а-я]+.\s+)?([А-Я][а-я]+.\s+)?([А-Я][а-я]+.\s+)?([А-Я][а-я]+.\s+)?((|\/|\()?)((рожд.\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(рожденный\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))(\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(день рождения\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))(\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\d{2,}.)?(\d{2,}.)?(\d{2,}))?
            if($textLang == 'ru'){
                $pattern = "/([А-Я][а-я]+)\s+([А-Я][а-я]+\s+)([А-Я][а-я]+.\s+)?([А-Я][а-я]+.\s+)?([А-Я][а-я]+.\s+)?([А-Я][а-я]+.\s+)?(((|\/|\()?)((рожд.\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(рожденный\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))(\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(день рождения\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))(\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\d{2,}.)?(\d{2,}.)?(\d{2,})))?/u";
            }else {
                $pattern = "/([Ա-Ֆ][ա-ֆև]+)\s+([Ա-Ֆ][ա-ֆև]+\s+)([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?([Ա-Ֆ][ա-ֆև]+.\s+)?(((|\/|\()?)((ծնվ.\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(ծնված.\s*(\d{2,}.)?(\d{2,}.)?(\d{2,}))(\w*.(\d{2,}.)?(\d{2,}.)?(\d{2,}))|(\d{2,}.)?(\d{2,}.)?(\d{2,})))?/u";
            }


            foreach ($parts as $idx => $part) {
                if ($text) {
                    preg_match_all($pattern, $part, $matches, PREG_SET_ORDER);
                    //regexy ashxatum e petqe ruserenic targmanel hayereni u anel searchy ayd dzev
                    //ruserenum petqe lini hertakanutyuny azganun anun hayranun
                    foreach ($matches as $key => $value) {
                        $birthDayVal = null;
                        $birthMonthVal = null;
                        $birthYearVal = null;
                        if(count($value) < 7){
                            if(count($value) == 3){
                                $value[]= "";
                            }
                        }elseif(count($value) > 15){
                            $birthDayVal = $value[23];
                            $birthMonthVal = $value[24];
                            $birthYearVal = $value[25];
                        }else {
                            $birthDayVal = $value[12];
                            $birthMonthVal = $value[13];
                            $birthYearVal = $value[14];
                        }
// dd($value);
                        $birthDay = (int) $birthDayVal === 0 ? null : (int) $birthDayVal;
                        $birthMonth = (int)$birthMonthVal === 0 ? null : (int) $birthMonthVal;
                        $birthYear = (int) $birthYearVal === 0 ? null : (int) $birthYearVal;
// if($key ==1){dd($birthDay);}

                        $name = $value[1];
                        $surname = "";
                        $patronymic = "";
                        if(isset($value[3])){
                            $surname = trim($value[3] == "" ? $value[2] : $value[3]);
                            $patronymic = trim($value[3] == "" ? "" : $value[2]);
                        }

                        $text = trim($part);

                        $replacedText = preg_quote($value[0]);

                        $birthStr = '';

                        // dd($matches);
                        if(isset($value[10])){
                            $birthStr = $value[10];
                            $birthStr =  preg_replace('/[Ա-Ֆ][ա-ֆև]+[^\d]*\b((\d+)|(\d+).(\d+).(\d+).)/u', '$1', $birthStr);
                            $birthStr =  preg_replace('/[ա-ֆև]+[^\d]*\b((\d+)|(\d+).(\d+).(\d+).)/u', '$1', $birthStr);
                        }

                        $text = mb_ereg_replace($replacedText, "<p class='centered-text' style='color: #0c05fb; margin: 0;'>$replacedText</p>", $text);


                        if (Str::endsWith($surname, 'ը') || Str::endsWith($surname, 'ի')) {
                            $surname = Str::substr($surname, 0, -1);
                        }
                        if (mb_substr($surname, -2, 2, 'UTF-8') == 'ից' || mb_substr($surname, -2, 2, 'UTF-8') == 'ին') {
                            $surname = Str::substr($surname, 0, -2);
                        }
                        if (isset($value[4]) && $value[4] != "") {

                            $nameFive = isset($value[5])?" " . $value[5]:"";
                            $nameSix = isset($value[6])?" " . $value[6]:"";
                            $name = trim($value[1]) . " " . trim($value[2]) . " " . trim($value[3]) . " " . trim($value[4]) . $nameFive . $nameSix;
                        }

                        //toxnumem error storaketi,, dnel rusereni depqum stugel es amen inchhy 

                        $name = $this->checkAndRemoveLastSimbol($name);
                        $surname = $this->checkAndRemoveLastSimbol($surname);
                        $patronymic = $this->checkAndRemoveLastSimbol($patronymic);

                        $surname = isset($value[4]) && $value[4] != "" ? trim($name) : $surname;
                        $patronymic = isset($value[4]) && $value[4] != "" ? "" : $patronymic;
                        // try {
                        //     LearningSystemService::get_info($name);
                        //     LearningSystemService::get_info($surname);
                        //     LearningSystemService::get_info($patronymic);
                        // } catch (\Throwable $th) {
                        //    dd($name, $surname, $patronymic);
                        // }

                        $dataToInsert[] = [
                            'name' => $textLang == "am" ? $name : LearningSystemService::get_info($name),
                            'surname' => $textLang == "am" ? $surname : LearningSystemService::get_info($surname),
                            'patronymic' => $textLang == "am" ? $patronymic : LearningSystemService::get_info($patronymic),
                            'birthday_str' => $birthStr,
                            "birth_day" => $birthDay,
                            "birth_month" => $birthMonth,
                            "birth_year" => $birthYear,
                            'find_text' => $value[0],
                            'paragraph' => $text,
                            'orginal_name' => $name,
                            'orginal_surname' => $surname,
                            'orginal_patronymic' => $patronymic,
                        ];

                    }
                }
            }
// dd($dataToInsert);
            $fileDetails = [
                'file_name'=> $fileName,
                'real_file_name'=> $file->getClientOriginalName(),
                'file_path'=> $path,
                'fileId'=> $fileId,
                'file_lang'=>$textLang,
                'file_phonetic'=> $phonetic
            ];

            $this->findDataService->addFindDataToInsert($dataToInsert, $fileDetails);
            Cache::put('uploadReferenceFileName', $fileName, now()->addHours(24));
            BibliographyHasFile::bindBibliographyFile($bibliographyId, $fileId);

            return $fileName;
        }

        throw new \Exception('Something went wrong');


    }

    public function searchFilter($input, $fileName)
    {
        $result = UploadDictionaryFilterService::filter($input, $fileName);
        $getCalculateCompliance = $this->findDataService->getFilteredCalculate($result);
        return $getCalculateCompliance;
    }


    /**
     * @param $word1
     * @param $word2
     * @return bool
     */
    public static function soundExArmenian($word1, $word2)
    {
        $word1 = Str::lower($word1);
        $word2 = Str::lower($word2);
        $wordCode1 = self::getCodeSoundEx(strtolower($word1));
        $wordCode2 = self::getCodeSoundEx(strtolower($word2));

        if( $wordCode1 != $wordCode2) {
            return false;
        }
        return true;
    }


    /**
     * @param $word
     * @return array|string
     */
    protected static function getCodeSoundEx($word)
    {
        $word = str_replace(mb_str_split('~[\/:*?"<>|+-](),`՞՛․«» ', 1, 'UTF-8'), "", $word);
        if (Str::endsWith($word, 'ը') || Str::endsWith($word, 'ի')) {
            $word = Str::substr($word, 0, -1);
        }
        if (mb_substr($word, -2, 2, 'UTF-8') == 'ից' || mb_substr($word, -2, 2, 'UTF-8') == 'ին') {
            $word = Str::substr($word, 0, -2);
        }
        $substitutions =array(
            "եվ"=>"և",
            "յէ"=>"ե",
            "այ"=>"ա",
            "ոյ"=>"ո",
            "յո"=>"ո",
            "վհ"=>"վ",
            "րհ"=>"ր",
            "բբ"=>"բ",
            "գգ"=>"գ",
            "դդ"=>"դ",
            "ձձ"=>"ձ",
            "ջջ"=>"ջ",
            "զզ"=>"զ",
            "ժժ"=>"ժ",
            "ղղ"=>"ղ",
            "վվ"=>"վ",
            "պպ"=>"պ",
            "կկ"=>"կ",
            "տտ"=>"տ",
            "ծծ"=>"ծ",
            "ճճ"=>"ճ",
            "սս"=>"ս",
            "շշ"=>"շ",
            "խխ"=>"խ",
            "ֆֆ"=>"ֆ",
            "հհ"=>"հ",
            "փփ"=>"փ",
            "քք"=>"ք",
            "թթ"=>"թ",
            "ցց"=>"ց",
            "չչ"=>"չ",
            "լլ"=>"լ",
            "ռռ"=>"ռ",
            "րր"=>"ր",
            "նն"=>"ն",
            "մմ"=>"մ",
            "յյ"=>"յ",
        );

        foreach ($substitutions as $letter => $substitution) {
            $word = str_replace($letter,$substitution,$word);
        }

        $len = mb_strlen($word,'UTF-8');
        $wordNew = preg_split('/(?<!^)(?!$)/u', $word);
        $codingTable=array(
            'a'=>array("ա"),
            'b'=>array("ե","է"),
            'c'=>array("ը"),
            'd'=>array("ի"),
            'e'=>array("լ"),
            'f'=>array("մ"),
            'g'=>array("յ"),
            'h'=>array("ն"),
            'i'=>array("ս"),
            'j'=>array("ր", "ռ"),
            'k'=>array("օ", "ո"),
            'l'=>array("ու"),
            'm'=>array("և"),
            'n'=>array("հ"),
            'o'=>array("բ","պ","փ"),
            'p'=>array("գ","կ","ք"),
            'q'=>array("դ","տ","թ"),
            'r'=>array("ձ","ծ","ց"),
            's'=>array("ջ","ճ","չ"),
            't'=>array("զ","ս",),
            'u'=>array("ժ","շ"),
            'v'=>array("ղ","խ"),
            'w'=>array("վ","ֆ"),
        );
        $value = [];
        for ($i=0;$i<$len;$i++){
          foreach ($codingTable as $code=>$letters) {
              if (in_array($wordNew[$i],$letters)) {
                   $value[$i]=$code;
              }
          }
        }
        $value=array_filter($value);
        $value=implode("",$value);
        return $value;
    }
}
