<?php

namespace App\Console\Commands;

use App\Services\SearchService;
use File;
use Illuminate\Console\Command;
use Storage;
use Maatwebsite\Excel\Facades\Excel;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\DB;


class AddFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Files in DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SearchService $searchService)
    {
        $allFiles = storage_path('app/tmpfiles/');
        $files = scandir($allFiles);
        $files = array_diff($files, ['.', '..']);
        foreach ($files as $key => $file) {
            $extenshion = substr($file, -3);

            //if extenshin doc 
            if ($extenshion == 'doc') {
                $inputPath = storage_path('app/tmpfiles/' . $file);
                $outputPath = storage_path('app/public/uploads/');
                $fileId = null;
                //conver file doc to docx
                $convert = convertDocToDocx($inputPath, $outputPath);
                if ($convert) {
                    $fullPath = storage_path('app/public/uploads/' . $file . 'x');
                    // $fullPath = public_path(Storage::url('uploads/' . $file . 'x'));

                    //check NEW exist file 
                    if (file_exists($fullPath)) {
                        $fileName = $file;

                        //save file text in DB
                        $fileDetails = [
                            'name' => $fileName . 'x',
                            'real_name' => $file . 'x',
                            'path' => 'uploads/' . $file . 'x',
                        ];

                        // $orgName = $file . 'x';
                        // $path = 'uploads/' . $file . 'x';

                        // $fileId = File::addFile($fileDetails);
                         try {
                            DB::beginTransaction();
                            $fileId = $searchService->addFile($fileDetails);
                            \DB::commit();
                      
                            } catch (\Exception $e) {
                                \DB::rollBack();
                            } catch (\Error $e) {
                                \DB::rollBack();
                            }

                        //convert file doc to docx
                        if ($fileId) {
                            $removePath = storage_path('app/tmpfiles/' . $file);
                            if (file_exists($removePath)) {
                                unlink($removePath);
                            }
                        }else {
                            $removePath = storage_path('app/public/uploads/' . $file. 'x');
                            if (file_exists($removePath)) {
                                unlink($removePath);
                            }
                        }
                    }
                }

            }

            //if extenshion xls or xlsx
            if (substr($file, -3) == 'xls' || substr($file, -4) == 'xlsx') {
                $tmpPath = storage_path('app/tmpfiles/');
                $uploadsPath = storage_path('app/public/uploads/');
                $oldPath = $tmpPath . $file;
                $newPath = $uploadsPath . $file;
                $addedId = null;

                if (file_exists($oldPath)) {
                    $flatText = '';
                    $excelsheetInfo = Excel::toCollection(collect([]), $oldPath);
                    foreach ($excelsheetInfo as $sheet) {
                        foreach ($sheet as $row) {
                            foreach ($row as $cell) {
                                $flatText .= $cell . ' ';
                            }
                        }
                    }

                    if ($flatText) {

                        $fileDetails = [
                            'name' => $file,
                            'real_name' => $file,
                            'path' => 'uploads/' . $file,
                        ];

                        $addedId = addFileAndFileContentWithoutModel($fileDetails, $flatText);
                    }

                    if ($addedId) {
                        $renameFolder = rename($oldPath, $newPath);
                    }
                }

            }

            //if extenshion pdf
            if(substr($file, -3) == 'pdf'){
                $tmpPath = storage_path('app/tmpfiles/');
                $uploadsPath = storage_path('app/public/uploads/');
                $oldPath = $tmpPath . $file;
                $newPath = $uploadsPath . $file;
                $addedId = null;
                $pdfParser = new Parser();
                $pdf = $pdfParser->parseFile($oldPath);

                // $content= Pdf::getText($fullPath);
                $content = $pdf->getText();

                if($content){
                    $fileDetails = [
                        'name' => $file,
                        'real_name' => $file,
                        'path' => 'uploads/' . $file,
                    ];

                    $addedId = addFileAndFileContentWithoutModel($fileDetails, $content);
                }

                if ($addedId) {
                    $renameFolder = rename($oldPath, $newPath);
                }
            }

            //if extenshion docx
            if(substr($file, -4) == 'docx'){
                $addedId = null;
                $tmpPath = storage_path('app/tmpfiles/');
                $uploadsPath = storage_path('app/public/uploads/');
                $oldPath = $tmpPath . $file;
                $newPath = $uploadsPath . $file;

                $content = getDocContent($oldPath);

                if($content){
                    $fileDetails = [
                        'name' => $file,
                        'real_name' => $file,
                        'path' => 'uploads/' . $file,
                    ];

                    $addedId = addFileAndFileContentWithoutModel($fileDetails, $content);
                }
              
                if ($addedId) {
                    $renameFolder = rename($oldPath, $newPath);
                }
            }

        }


        return Command::SUCCESS;
    }
}
