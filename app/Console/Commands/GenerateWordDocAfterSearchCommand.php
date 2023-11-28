<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;

use Illuminate\Console\Command;
use PhpOffice\PhpWord\Exception\Exception;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


class GenerateWordDocAfterSearchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:word_doc_after_search  {name} {data} {reportType}';

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

            $data = $this->argument('data');
            $title_text='';
            $reportType=$this->argument('reportType');
            if($reportType=='all_new'){
                $title_text='Բոլորովին նոր';
            }elseif($reportType==''){
                $title_text='Նման';
            }else{
                $title_text='Առկա է բազայում';
            }
            $title = sprintf('Տեղեկատվություն  %s մարդկանց մասին',  $title_text);

            $phpWord = new PhpWord();
            $section = $phpWord->addSection(['orientation' => 'portrait']);
            $section->addText($title, [], ['align' => 'center']);

            $table = array('borderColor' => 'black', 'borderSize' => 1, 'cellMargin' => 100, 'valign' => 'center');
            $phpWord->addTableStyle('table', $table);
            $table = $section->addTable('table');
            $table->addRow();

            // $style = ['bold' => true, 'size' => 7];
            $style = ['bold' => true,'italic' => false, 'size' => 7];
            $paragraph_style = ['alignment' => 'center', 'textAlignment' => 'center'];
            $value_style = ['size' => 8];

            // Headers
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
                    $table->addCell()->addText($row_count, $value_style, $paragraph_style);
                    $table->addCell()->addText($value['name'], $value_style, $paragraph_style);
                    $table->addCell()->addText($value['surname'], $value_style, $paragraph_style);
                    $table->addCell()->addText($value['patronymic'] ?? null, $value_style, $paragraph_style);
                    $table->addCell()->addText($value['birthday_str'] ?? null, $value_style, $paragraph_style);

                }


                $objWriter = IOFactory::createWriter($phpWord);

                $path = Storage::disk('generate_file')->path($generated_file_name);
                $objWriter->save($path);

            }



        }catch (\Throwable $exception) {
            Log::emergency($exception);
        }

    }
}
