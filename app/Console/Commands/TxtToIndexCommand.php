<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TxtToIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:txtindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $allFiles = storage_path('app/tmptxt/');
        $files = scandir($allFiles);
        $files = array_diff($files, ['.', '..']);
        foreach ($files as $key => $file) {
            $extenshion = substr($file, -3);

            if ($extenshion == 'txt') {
                $inputPath = storage_path('app/tmptxt/' . $file);

                $content = '';
                if (is_file($inputPath)) {
                    $content = file_get_contents($inputPath);
                }

                if ($content) {
                    $txtFileName = substr($file, 0, -3);
                    $txtFileName = $txtFileName . 'docx';
                    $fileDetails = [
                        'name' => $txtFileName,
                        'real_name' => $txtFileName,
                        'path' => 'uploads2/' . $txtFileName,
                    ];

                    $addedId = addFileAndFileContentWithoutModel($fileDetails, $content);
                }

                if ($addedId && is_file($inputPath)) {
                    unlink($inputPath);
                }
            }

        }


        return Command::SUCCESS;
    }
}
