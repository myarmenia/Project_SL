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
            $ids = [];
            $data = DataUpload::all()->groupBy(function ($record) {
                $key = mb_substr($record->name, 0, 1) . mb_substr($record->surname, 0, 1) . mb_substr($record->patronymic, 0, 1);
                return $key;
            });
            
            // foreach ($data as $key => $value) {
            //     if(!is_numeric(array_search($value->id, $ids))){
            //         $dataCorrect = DataUpload::search($value->name . $value->surname . $value->patronymic . $value->birth_year)->get();
            //         foreach ($dataCorrect as $key => $dataItem) {
            //             array_push($allData, $dataItem );
            //             array_push($ids, $dataItem->id);
            //         }
            //     }
            // }
            // dd($ids);
            // $data =  DataUpload::search("Տիզրան")->get();
        //     for ($i=0; $i < count($data); $i++) { 
        //         foreach ($data as $key => $value) {
        //             // dd($data[$i]->patronymic,$data[$i]->patronymic);
        //             similar_text($data[$i]->name,$data[$i]->name, $procentOne);
        //             similar_text($data[$i]->surname,$data[$i]->surname, $procentTwo);
        //             // similar_text($data[$i]->patronymic, $data[$i]->patronymic, $procentThree);
        //             if($procentOne > 60 && $procentTwo > 60 && is_numeric( array_search( $value->id, $ids))){
        //                 $allData[] = $value;
        //                 $ids[] = $value->id;
        //             }
                    


                 
        //             // similar_text($name['name'], $searchData['searchData'], $procent);
                    
        //             // if($procent >= 60) {
        //             //     $user[] = $name['user_id'];
        //             // }
                 
        //         }
        //     }
        //    dd($data);
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