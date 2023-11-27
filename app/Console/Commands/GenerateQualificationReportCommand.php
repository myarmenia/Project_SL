<?php

namespace App\Console\Commands;

use App\Exports\QualificationExport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Excel;
use Throwable;

class GenerateQualificationReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:qualification_report {name} {from} {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate qualification report';


    /**
     * @return void
     */
    public function handle(): void
    {
        try {
            $report_file_name = $this->argument('name');
            $from = $this->argument('from');
            $to = $this->argument('to');
            Excel::store(new QualificationExport($from, $to), $report_file_name, 'qualification_reports', null);
        } catch (Throwable $exception) {
            Log::emergency($exception);
        }
    }
}
