<?php

namespace App\Console\Commands;

use Illuminate\Console\Application;
use Illuminate\Support\Facades\Log;

use Illuminate\Console\Command;
use Illuminate\Contracts\Foundation\Application as ContractsFoundationApplication;
use Illuminate\Foundation\Application as FoundationApplication;
use PhpOffice\PhpWord\Exception\Exception;
use Illuminate\Support\Facades\Storage;
use PharIo\Manifest\ApplicationName;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Symfony\Component\Console\Application as ConsoleApplication;

class GenerateWordDocAfterSearchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:word_doc_after_search  {name} {datetime} {user} {role_name} {data} {reportType} {day}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate word doc after search';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        try{

            $generated_file_name = $this->argument('name');
            $datetime = $this->argument('datetime');
            $user = $this->argument('user');
            $role = $this->argument('role_name');

            $data = $this->argument('data');
            $title_text='';
            $reportType = $this->argument('reportType');
            $day = $this->argument('day');

            if($reportType == "Նոր"){
                $title_text = 'Բոլորովին նոր';
            }elseif($reportType == "Ոմն"){
                $title_text = 'Ոմն';
            }else{
                $title_text='Բազայում առկա';
            }
            $title = sprintf('Տեղեկատվություն  %s մարդկանց վերաբերյալ',  $title_text);

            $phpWord = new PhpWord();
            $section = $phpWord->addSection(['orientation' => 'portrait']);

            $created_time = "Ստեղծման օր/ժամ: ".$datetime;
            $user_content = "Գործածող: ".$user;
            $user_role = "Դեր: ".$role;
            $textRun = $section->addTextRun();
            $textRun->addText($created_time,array('name'=>'Arial','bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));
            $textRun = $section->addTextRun();
            $textRun->addText($user_content,array('name'=>'Arial','bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));
            $textRun = $section->addTextRun();
            $textRun->addText($user_role,array('name'=>'Arial','bold' => true, 'italic' => true, 'color' => '0000FF', 'size' => 12));
            $textRun = $section->addTextRun();

            $section->addText($title, array('align' => 'center','name'=>'Arial','bold' => true, 'italic' => true,'color' => '000000','size' => 13));
            $textRun = $section->addTextRun();
            $table = array('borderColor' => 'black', 'borderSize' => 1, 'cellMargin' => 100, 'valign' => 'center');
            $phpWord->addTableStyle('table', $table);
            $table = $section->addTable('table');
            $table->addRow();

            $style = ['name'=>'Arial','bold' => true,'italic' => false, 'size' => 12];
            $paragraph_style = ['alignment' => 'center', 'textAlignment' => 'center'];
            $value_style = ['name'=>'Arial', 'bold' => true,'size' => 9];

            $table->addCell()->addText(htmlspecialchars("№"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Անուն"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Ազգանուն"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Հայրանուն"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Ծննդյան տվյալներ"), $style, $paragraph_style);

            if(count($data)){

                $row_count=0;
                foreach($data as $key=>$value){
                    $row_count+=1;
                    $table->addRow();
                    $table->addCell()->addText($value['current_number'], $value_style, $paragraph_style);
                    $table->addCell()->addText($value['name'], $value_style, $paragraph_style);
                    $table->addCell()->addText($value['surname'], $value_style, $paragraph_style);
                    $table->addCell()->addText($value['patronymic'] ?? null, $value_style, $paragraph_style);
                    $table->addCell()->addText($value['birthday_str'] ?? null, $value_style, $paragraph_style);

                }

                $objWriter = IOFactory::createWriter($phpWord);

                $path = Storage::disk('generate_file')->path($generated_file_name);


                $phpWord->save($path);

                return true;

            }



        }catch (\Throwable $exception) {
            Log::emergency($exception);
        }

    }
}
