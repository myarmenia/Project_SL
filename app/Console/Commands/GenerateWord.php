<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\Exception\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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

            $user_content="Գործածող:".$user;

            $phpWord = new PhpWord();
            $section = $phpWord->addSection(['orientation' => 'portrait']);
            // Create a TextRun
            $textRun = $section->addTextRun();
            $textRun->addText($user_content,array('name'=>'Arial','bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));




            // $section->addRow();
            if($data){

                foreach($data as $item){

                    $textRun = $section->addTextRun();
                    $textRun->addText($item,array( 'name'=>'Arial','bold' => false, 'italic' => false,'color' => '000000','size' => 12));
                    $textRun->setLineSpacing(1.7);


                }
                $objWriter = IOFactory::createWriter($phpWord);
                $desktopPath = getenv('USERPROFILE') . '\Desktop';// For Windows

                // $desktopPath = $_SERVER['HOME'] . '/Desktop'; // For Linux/Mac

                if (!file_exists($desktopPath)) {
                    mkdir($desktopPath, 0777, true);
                }

                $filename = $desktopPath . "/".$generated_file_name;

                $phpWord->save($filename);

                if(Storage::disk('answer_file')->exists($generated_file_name)){

                    $file_path = '/answer_file/' . $generated_file_name;
                    $fileid=DB::table('file')->insertGetId([
                        'name'=>$generated_file_name,
                        'real_name'=>$generated_file_name,
                        'path'=>$file_path,
                    ]);

                    $file_texts = FileText::create([
                        'file_id' => $fileid,
                        'content' => $data_content,
                        'status' => 1,
                        'search_string' => $searched,
                    ]);
                    return true;
                   



                }


            }
            // dd($phpWord);
        }catch (\Throwable $exception) {
            Log::emergency($exception);
        }

    }
}
