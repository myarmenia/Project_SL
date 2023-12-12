<?php

namespace App\Console\Commands;

// use App\Models\File\File;
// use App\Models\File\FileText;
// use App\Services\FileUploadService;

use App\Models\ParagraphFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
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
    protected $signature = 'generate:word {file_name} {data} {role_name} {user} {datetime} {day}{man_id}';

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
        try {
            $generated_file_name = $this->argument('file_name');
            $datetime = $this->argument('datetime');
            $user = $this->argument('user');
            $role = $this->argument('role_name');
            $data = $this->argument('data');
            $man_id = $this->argument('man_id');

            // dd($generated_file_name,$datetime,$user,$role,$data);

            // dd($generated_file_name,$role,$user,$searched,$datetime);
            $created_time = "Ստեղծման օր/ժամ: " . $datetime;
            $user_content = "Գործածող: " . $user;
            $user_role = "Դեր: " . $role;
            $day = $this->argument('day');

            // dd($created_time,$user_content,$user_role, $day);
            $phpWord = new PhpWord();
            $section = $phpWord->addSection(['orientation' => 'portrait']);
            // Create a TextRun
            $textRun = $section->addTextRun();
            $textRun->addText($created_time, array('name' => 'Arial', 'bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));
            $textRun = $section->addTextRun();
            $textRun->addText($user_content, array('name' => 'Arial', 'bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));
            $textRun = $section->addTextRun();
            $textRun->addText($user_role, array('name' => 'Arial', 'bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));
            $textRun = $section->addTextRun();
            $textRun = $section->addTextRun();


            // $section->addRow();

            if (count($data)>0) {
                // dd(count($data));
                $content='';
                foreach ($data as $item) {
                    // dd($item);

                    $content.=$item."<br/><br/>";

                    $textRun->addText($item, array('name' => 'Arial', 'bold' => false, 'italic' => false, 'color' => '000000', 'size' => 12));
                    $textRun->setLineSpacing(1.7);
                    $textRun = $section->addTextRun();
                }
                // dd($content);
                $objWriter = IOFactory::createWriter($phpWord);
                // dd($objWriter);
                // save  file in storage
                $path = Storage::disk('man_attached_file')->path($generated_file_name);
                // dd($path);
                $phpWord->save($path);
                // dd($phpWord);
                // save file in des
                 $desktopPath = getenv('USERPROFILE') . "\Desktop/".$day;// For Windows
                // $desktopPath = $_SERVER['HOME'] . "\Desktop/".$day; // For Linux/Mac


                // if(!file_exists($desktopPath)) {
                //     mkdir($desktopPath, 0777, true);
                // }

                // $filename = $desktopPath . "/" . $generated_file_name;

                // $phpWord->save($filename);

                $paragraph_file_path = 'public/man_attached_file/'.$generated_file_name;

                if(Storage::disk('man_attached_file')->exists($generated_file_name)) {


                    $paragraph_file = ParagraphFile::create([
                        'man_id' => $man_id,
                        'file_name' => $generated_file_name,
                        'path' => $paragraph_file_path,
                        'content'=>$content,

                    ]);

                    return true;
                   

                }
            }
        } catch (\Throwable $exception) {
            Log::emergency($exception);
        }
    }
}
