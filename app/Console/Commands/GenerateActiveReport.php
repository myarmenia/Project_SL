<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class GenerateActiveReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:active_report';

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
            $title = 'Տեղեկություն 01.07.2023թ. - 30.09.2023թ. ստորաբաժանման վարույթում գտնվող ահազանգերի վերաբերյալ';
            $now = Carbon::now()->format('Y_m_d_H_i_s');
            $name = sprintf('active_%s.docx', $now);
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

            // Values
            for ($i = 0; $i < 10; $i++) {
                $table->addRow();
                $table->addCell()->addText($i, $value_style, $paragraph_style);
                $table->addCell()->addText(sprintf('%d-ին ստորաբաժանում', $i), $value_style, $paragraph_style);
                $table->addCell()->addText("Ազգանուն", $value_style, $paragraph_style);
                $table->addCell()->addText("պաշտոն", $value_style, $paragraph_style);
                $table->addCell()->addText(11665, $value_style, $paragraph_style);
                $table->addCell()->addText("ահաբեկիչ", $value_style, $paragraph_style);
                $table->addCell()->addText("X", $value_style, $paragraph_style);
                $table->addCell()->addText("17.01.2023", $value_style, $paragraph_style);
                $table->addCell()->addText("08.11.2022", $value_style, $paragraph_style);
                $table->addCell()->addText("08.02.2023", $value_style, $paragraph_style);
                $table->addCell()->addText("17.02.2023", $value_style, $paragraph_style);
                $table->addCell()->addText(10, $value_style, $paragraph_style);
                $table->addCell()->addText("Ստուգումն ավարտվել է", $value_style, $paragraph_style);
                $table->addCell()->addText("հարուցվել է քրեական գործ", $value_style, $paragraph_style);
            }

            $objWriter = IOFactory::createWriter($phpWord);
            $path = Storage::disk('active_reports')->path($name);
            $objWriter->save($path);
        } catch (\Throwable $exception) {
            Log::emergency($exception);
        }


    }
}
