<?php

namespace App\Console\Commands;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Throwable;

class GenerateOpenedReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:opened_report {name} {from} {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate opened report';


    /**
     * @return void
     */
    public function handle(): void
    {
        try {
            $report_file_name = $this->argument('name');
            $from = $this->argument('from');
            $to = $this->argument('to');


            $title = sprintf('Տեղեկատվություն ՀՀ ԱԱԾ ստորաբաժանման կողմից %s - %sթթ գրանցված ահազանգերի մասին', Carbon::createFromFormat('Y-m-d', $from)->format('d-m-Y'), Carbon::createFromFormat('Y-m-d', $to)->format('d-m-Y'));

            $phpWord = new PhpWord();
            $section = $phpWord->addSection(['orientation' => 'landscape']);
            $section->addText($title, [], ['align' => 'center']);

            $table = array('borderColor' => 'black', 'borderSize' => 1, 'cellMargin' => 60, 'valign' => 'center');
            $phpWord->addTableStyle('table', $table);
            $table = $section->addTable('table');
            $table->addRow();

            $style = ['bold' => true, 'size' => 7];
            $paragraph_style = ['alignment' => 'center', 'textAlignment' => 'center'];
            $value_style = ['size' => 8];

            // Headers
            $headers = [
                "№",
                "Ահազանգը գրանցած ստորաբաժանում",
                "Օպերաշխատակցի ազգանունը",
                "Օ/ա պաշտոնը",
                "Գրանցման №",
                "Ահազանգի երանգավորում",
                "Տեղեկատվության աղբյուր",
                "Գրանցման ժամկետ",
            ];

            foreach ($headers as $header) {
                $table->addCell()->addText(htmlspecialchars($header), $style, $paragraph_style);
            }

            $data = Report::getOpened($from, $to);

            if (count($data)) {
                // Values
                foreach ($data as $value) {
                    $table->addRow();
                    $table->addCell()->addText($value->id, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->opened_subunit, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->worker_last_name, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->worker_post_name, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->reg_num, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->qualification_name, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->resource_name, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->subunit_date, $value_style, $paragraph_style);
                }

                $objWriter = IOFactory::createWriter($phpWord);
                $path = Storage::disk('opened_reports')->path($report_file_name);
                $objWriter->save($path);
            }
            unset($phpWord);
        } catch (Throwable $exception) {
            Log::emergency($exception);
        }
    }
}
