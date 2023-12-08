<?php

namespace App\Console\Commands;

use App\Services\SearchService;
use File;
use Illuminate\Console\Command;
use Storage;

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
        $publicPath = public_path('tmpfiles');
        $files = scandir($publicPath);
        $files = array_diff($files, ['.', '..']);
        foreach ($files as $key => $file) {
            $extenshion = substr($file, -3);

            if ($extenshion == 'doc') {
                $inputPath = public_path('tmpfiles/' . $file);
                $outputPath = storage_path('app/public/uploads/');

                //conver file doc to docx
                $convert = convertDocToDocx($inputPath, $outputPath);
                if ($convert) {
                    $fullPath = public_path(Storage::url('uploads/' . $file . 'x'));

                    //check NEW exist file 
                    if (file_exists($fullPath)) {
                        $fileName = time() . '_' . $file . 'x';

                        //save file text in DB
                        // $fileDetails = [
                        //     'name' => $fileName,
                        //     'real_name' => $file . 'x',
                        //     'path' => 'uploads/' . $file . 'x',
                        //     'via_summary' => 1,
                        // ];

                        $orgName = $file . 'x';
                        $path = 'uploads/' . $file . 'x';

                        // $fileId = File::addFile($fileDetails);
                        $fileId = $searchService->addFile($fileName, $orgName, $path);

                        //convert file doc to docx
                        if ($fileId) {
                            $removePath = public_path('tmpfiles/' . $file);
                            if (file_exists($removePath)) {
                                unlink($removePath);
                            }
                        }
                    }
                }

            }

        }


        return Command::SUCCESS;
    }
}
