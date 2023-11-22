<?php

namespace App\Console\Commands;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class GenerateActiveReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:active_report {name} {from} {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate active report';

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle()
    {
        try {
            $report_file_name = $this->argument('name');
            $from = $this->argument('from');
            $to = $this->argument('to');

            $title = sprintf('Տեղեկություն %sթ. - %sթ. ստորաբաժանման վարույթում գտնվող ահազանգերի վերաբերյալ', Carbon::createFromFormat('Y-m-d', $from)->format('d.m.Y'), Carbon::createFromFormat('Y-m-d', $to)->format('d.m.Y'));

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
            $table->addCell()->addText(htmlspecialchars("№"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Ահազանգը ստուգող ստորաբաժանում"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Ահազանգը ստուգող օ/ա"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Օ/ա պաշտոնը"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Գրանցման №"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Ահազանգի երանգավորում"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Տեղեկատվության աղբյուր"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Գրանցման ժամկետ"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Երկարացումներ"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Ստուգման ժամկետ"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Փակման ժամկետ"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("ժմ.անց"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Ստուգման արդյունքները"), $style, $paragraph_style);
            $table->addCell()->addText(htmlspecialchars("Կիրառված միջոցներ"), $style, $paragraph_style);

            $data = Report::getActive($from, $to);

            if (count($data)) {
                // Values
                foreach ($data as $value) {
                    $table->addRow();
                    $table->addCell()->addText($value->id, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->check_subunit, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->worker_last_name, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->worker_post_name, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->reg_num, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->qualification_name, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->resource_name, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->subunit_date, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->extension_date, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->check_date, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->end_date, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->expired_days, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->signal_result_name, $value_style, $paragraph_style);
                    $table->addCell()->addText($value->taken_measure_name, $value_style, $paragraph_style);
                }

                $objWriter = IOFactory::createWriter($phpWord);
                $path = Storage::disk('active_reports')->path($report_file_name);
                $objWriter->save($path);
            }
            unset($phpWord);
        } catch (\Throwable $exception) {
            Log::emergency($exception);
        }


    }
}
