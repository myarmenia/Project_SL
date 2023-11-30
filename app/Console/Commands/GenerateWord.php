<?php

namespace App\Console\Commands;

use App\Models\File\File;
use App\Models\File\FileText;
use App\Services\FileUploadService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
    protected $signature = 'generate:word {file_name} {data} {role_name} {user} {world}{datetime}';

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
        $generated_file_name = $this->argument('file_name');
        $datetime = $this->argument('datetime');
        $user = $this->argument('user');
        $role = $this->argument('role_name');
        $data = $this->argument('data');
        $searched = $this->argument('world');

// dd($generated_file_name,$role,$user,$searched,$datetime);
            $created_time = "Ստեղծման օր\ժամ: ".$datetime;
            $user_content = "Գործածող: ".$user;
            $user_role = "Դեր: ".$role;
            $searched_world = "Փնտրվող բառը: ".$searched;


            $phpWord = new PhpWord();
            $section = $phpWord->addSection(['orientation' => 'portrait']);
            // Create a TextRun
            $textRun = $section->addTextRun();
            $textRun->addText($created_time,array('name'=>'Arial','bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));
            $textRun = $section->addTextRun();
            $textRun->addText($user_content,array('name'=>'Arial','bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));
            $textRun = $section->addTextRun();
            $textRun->addText($user_role,array('name'=>'Arial','bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));
            $textRun = $section->addTextRun();
            $textRun->addText($searched_world,array('name'=>'Arial','bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));

            $textRun = $section->addTextRun();


            // $section->addRow();
            if($data){

                $data_content='';
                foreach($data as $item){

                    $data_content.=$item['reg_date'].'<br>';
                    $data_content.=$item['text'].'<br>';
                    $textRun = $section->addTextRun();
                    $textRun->addText($item['reg_date'],array('name'=>'Arial','bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));
                    $textRun->setLineSpacing(1.7);
                    $textRun = $section->addTextRun();
                    $textRun->addText($item['text'],array( 'name'=>'Arial','bold' => false, 'italic' => false,'color' => '000000','size' => 12));
                    $textRun->setLineSpacing(2);


                }
                $objWriter = IOFactory::createWriter($phpWord);
                // save  file in storage
                $path = Storage::disk('answer_file')->path($generated_file_name);
                // dd($path);
                $phpWord->save($path);
                // save file in des
                $desktopPath = getenv('USERPROFILE') . '\Desktop';// For Windows

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

        }catch (\Throwable $exception) {
            Log::emergency($exception);
        }

    }
}
