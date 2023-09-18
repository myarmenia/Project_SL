<?php

namespace App\Services;

use App\Models\Man\ManHasFindText;
use PhpOffice\PhpWord\IOFactory;
use App\Models\DataUpload;
use App\Models\File\File;
use Illuminate\Support\Str;


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

    public function showAllDetailsDoc($filename)
    {
        $fullPath = storage_path('app/' . 'uploads/' . $filename);
        $text = $this->getDocContent($fullPath);
        $parts =  explode("\t", $text);
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
        $details = DataUpload::find($id);
        $update = $details->update([
            $request['column'] => $request['newValue']
        ]);

        return $update;
    }

    public function updateDetails($request, $id)
    {
        $details = DataUpload::find($id);
        $details->update($request);

        return $details;
    }

    public function uploadFile($file)
    {
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

                    // $valueAddress = preg_replace('/թ\\․\s+ծ\\.\\,/', "", $address);

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
                        'birthday' => $value[5],
                        'birth_day' => $birthDay,
                        'birth_month' => $birthMonth,
                        'birth_year' => $birthYear,
                        'address' => $valueAddress,
                        'findText' => $value[0],
                        'paragraph' => $text,
                    ];
                }
            }
        }
        $fileDetails = [
            'name' => $fileName,
            'real_name' => $file->getClientOriginalName(),
            'path' => $path
        ];

        $this->findDataService->addFindData($dataToInsert, $fileDetails);
        return true;
    }

}
