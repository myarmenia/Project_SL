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
        $getPathLibreComman = "which libreoffice";
        $pathForLibreOffice = trim(shell_exec($getPathLibreComman));
        foreach ($files as $key => $file) {
            $extenshion = substr($file, -3);

            //if extenshin doc 

            if ($extenshion == 'doc') {

                try {
                    DB::beginTransaction();
                    $inputPath = storage_path('app/tmpfiles/' . $file);
                    $outputPath = storage_path('app/public/uploads/');
                    $fileId = null;
                    //conver file doc to docx
                    $convert = convertDocToDocx($inputPath, $outputPath, $pathForLibreOffice);

                    if ($convert) {
                        $fullPath = storage_path('app/public/uploads/' . $file . 'x');
                        if (file_exists($fullPath)) {
                            $txtOuthdir = storage_path('app/tmptxt/');
                            $commandTxt = $pathForLibreOffice . " --headless --convert-to txt:Text --outdir $txtOuthdir $inputPath";
                            $resultTxt = false;

                            try {
                                $resultTxt = shell_exec($commandTxt);

                            } catch (\Throwable $th) {
                                $resultTxt = false;
                            }

                            if ($resultTxt) {
                                // $outputPathTxt = false;
                                $txtFileName = substr($file, 0, -3);
                                $txtFileName = $txtFileName . 'txt';
                                $outputPathTxt = storage_path('app/tmptxt/' . $txtFileName);
                                // if (preg_match('/Overwriting: (.+)/', $resultTxt, $matches)) {
                                //     $outputPathTxt = $matches[1];
                                // }
                                $content = '';
                                if (is_file($outputPathTxt)) {
                                    $content = file_get_contents($outputPathTxt);
                                }

                                if ($content) {
                                    $fileDetails = [
                                        'name' => $file . 'x',
                                        'real_name' => $file . 'x',
                                        'path' => 'uploads/' . $file . 'x',
                                    ];

                                    $addedId = addFileAndFileContentWithoutModel($fileDetails, $content);
                                }

                                if ($outputPathTxt && is_file($outputPathTxt)) {
                                    unlink($outputPathTxt);
                                }

                                if (is_file($inputPath)) {
                                    unlink($inputPath);
                                }

                            }

                        }


                    }

                    \DB::commit();

                } catch (\Exception $e) {
                    \DB::rollBack();
                } catch (\Error $e) {
                    \DB::rollBack();
                }

            }
            // $fullPath = public_path(Storage::url('uploads/' . $file . 'x'));

            //check NEW exist file 
            // if (file_exists($fullPath)) {
            //     $fileName = $file;

            //     //save file text in DB
            //     $fileDetails = [
            //         'name' => $fileName . 'x',
            //         'real_name' => $file . 'x',
            //         'path' => 'uploads/' . $file . 'x',
            //     ];

            //     // $orgName = $file . 'x';
            //     // $path = 'uploads/' . $file . 'x';

            //     // $fileId = File::addFile($fileDetails);
            //      try {
            //         DB::beginTransaction();
            //         $fileId = $searchService->addFile($fileDetails);
            //         \DB::commit();

            //         } catch (\Exception $e) {
            //             \DB::rollBack();
            //         } catch (\Error $e) {
            //             \DB::rollBack();
            //         }

            //     //convert file doc to docx
            //     if ($fileId) {
            //         $removePath = storage_path('app/tmpfiles/' . $file);
            //         if (file_exists($removePath)) {
            //             unlink($removePath);
            //         }
            //     }else {
            //         $removePath = storage_path('app/public/uploads/' . $file. 'x');
            //         if (file_exists($removePath)) {
            //             unlink($removePath);
            //         }
            //     }
            // }



            /*if ($extenshion == 'doc') {
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


    if(substr($file, -4) == 'docx'){
                $inputPath = storage_path('app/tmpfiles/' . $file);
                $outputPath = storage_path('app/public/uploads/');
            $addedId = null;

                $tmpPath = storage_path('app/tmpfiles/');
                $uploadsPath = storage_path('app/public/uploads/');
                $oldPath = $tmpPath . $file;
                $newPath = $uploadsPath . $file;
                $command = "libreoffice --headless --convert-to txt:Text $inputPath";

                // $command = "libreoffice --headless --convert-to docx --outdir $outputPath $inputPath";

                try {
                    $result = shell_exec($command);
                } catch (\Throwable $th) {
                    $result = false;
                }
            dd($result);
                // info('convertDocToDocx', [$result, $inputPath, $outputPath]);
            
                // if ($result) {
                //     return true;
                // } else {
                //     return false;
                // }
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
            } */

        }


        return Command::SUCCESS;
    }
}
