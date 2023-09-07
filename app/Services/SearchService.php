<?php
namespace App\Services;

use PhpOffice\PhpWord\IOFactory;
use App\Models\DataUpload;


class SearchService
{
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
        $fullPath = storage_path('app/' . 'uploads/'.$filename);
        $text = $this->getDocContent($fullPath);
        $parts =  explode("\t", $text);
        $implodeArray = implode("\n",$parts);
        $detailsForReplace = DataUpload::where('fileName', $filename)->get()->pluck('findText');
        foreach ($detailsForReplace as $key => $details) {
            $implodeArray = mb_ereg_replace($details, "<p style='color: #0c05fb; margin: 0;'>$details</p>", $implodeArray);
        }

        return $implodeArray;
    }

    public function showAllDetails()
    {
        $allData = [];
            $data =  DataUpload::search("Տիգրան")->get();
            return $data;
            dd($data);

        // $data = \DB::table('data_uploads')
        //         ->whereFullText(['name'], 'John')
        //         ->get();
                
                // dd($data);
     
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

}