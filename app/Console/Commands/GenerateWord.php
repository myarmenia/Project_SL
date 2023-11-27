<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\Exception\Exception;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class GenerateWord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:word {name} {data} {reportType} {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'After search combine paragraph with one file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
        $generated_file_name = $this->argument('name');
        $reportType = $this->argument('reportType');
        $data = $this->argument('data');
        $user = $this->argument('user');
        // dd($generated_file_name ,$reportType,  $data,$user);
            $user_content="Գործածող:".$user;

            $phpWord = new PhpWord();
            $section = $phpWord->addSection(['orientation' => 'portrait']);
            $section->addText($user_content);

            $section->addRow();
            foreach($data as $item){
                $section->addText($item);
            }

        //    dd()
        }catch (\Throwable $exception) {
            Log::emergency($exception);
        }

    }
}
