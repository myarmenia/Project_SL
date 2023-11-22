<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportGenerateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('template-search.signal-report');
    }


    /**
     * @param ReportGenerateRequest $request
     * @return RedirectResponse|StreamedResponse|void
     */
    public function generateReport(ReportGenerateRequest $request)
    {
        try {

            $request_data = $request->all(['reportType', 'reportRange', 'year', 'startDate', 'endDate']);
            $from = $to = null;
            switch ($request_data['reportRange']) {
                case 'half_year_1':
                    $from = Carbon::create($request_data['year'])->startOfYear()->toDateString();
                    $to = Carbon::create($request_data['year'])->addMonths(5)->endOfMonth()->toDateString();
                    break;
                case 'half_year_2':
                    $from = Carbon::create($request_data['year'])->addMonths(6)->startOfMonth()->toDateString();
                    $to = Carbon::create($request_data['year'])->endOfYear()->endOfMonth()->toDateString();
                    break;
                case 'quarter_1':
                    $from = Carbon::create($request_data['year'])->startOfYear()->toDateString();
                    $to = Carbon::create($request_data['year'])->addMonths(2)->endOfMonth()->toDateString();
                    break;
                case 'quarter_2':
                    $from = Carbon::create($request_data['year'])->addMonths(3)->startOfMonth()->toDateString();
                    $to = Carbon::create($request_data['year'])->addMonths(5)->endOfMonth()->toDateString();
                    break;
                case 'quarter_3':
                    $from = Carbon::create($request_data['year'])->addMonths(6)->startOfMonth()->toDateString();
                    $to = Carbon::create($request_data['year'])->addMonths(8)->endOfMonth()->toDateString();
                    break;
                case 'quarter_4':
                    $from = Carbon::create($request_data['year'])->addMonths(9)->startOfMonth()->toDateString();
                    $to = Carbon::create($request_data['year'])->endOfYear()->endOfMonth()->toDateString();
                    break;
                case 'year':
                    $from = Carbon::create($request_data['year'])->startOfYear()->toDateString();
                    $to = Carbon::create($request_data['year'])->endOfYear()->endOfMonth()->toDateString();
                    break;
                case 'other':
                    $from = Carbon::createFromFormat('Y-m-d', $request_data['startDate'])->toDateString();
                    $to = Carbon::createFromFormat('Y-m-d', $request_data['endDate'])->toDateString();
                    break;

            }

            if ($from && $to) {
                $now = \Carbon\Carbon::now()->format('Y_m_d_H_i_s');
                switch ($request_data['reportType']) {
                    case 'by_qualification':
                        $name = sprintf('%s_%s.xlsx', $request_data['reportType'], $now);
                        Artisan::call('generate:qualification_report', ['name' => $name, 'from' => $from, 'to' => $to]);
                        return $this->downloadReport($name, 'qualification_reports');
                    case 'by_signal':
                        $name = sprintf('%s_%s.xlsx', $request_data['reportType'], $now);
                        Artisan::call('generate:signal_report', ['name' => $name, 'from' => $from, 'to' => $to]);
                        return $this->downloadReport($name, 'signal_reports');
                    case 'opened':
                        $name = sprintf('%s_%s.docx', $request_data['reportType'], $now);
                        Artisan::call('generate:opened_report', ['name' => $name, 'from' => $from, 'to' => $to]);
                        return $this->downloadReport($name, 'opened_reports');
                    case 'suspended':
                        $name = sprintf('%s_%s.docx', $request_data['reportType'], $now);
                        Artisan::call('generate:suspended_report', ['name' => $name, 'from' => $from, 'to' => $to]);
                        return $this->downloadReport($name, 'suspended_reports');
                    case 'active':
                        $name = sprintf('%s_%s.docx', $request_data['reportType'], $now);
                        Artisan::call('generate:active_report', ['name' => $name, 'from' => $from, 'to' => $to]);
                        return $this->downloadReport($name, 'active_reports');
                }
            }
            return redirect()->back()->with('message', 'Report generation failed!');
        } catch (\Throwable $exception) {
            Log::emergency($exception);
            return redirect()->back()->with('message', 'Report generation failed!');
        }
    }

    private function downloadReport(string $name, string $disk): StreamedResponse|RedirectResponse
    {
        if (Storage::disk($disk)->exists($name)) {
            return Storage::disk($disk)->download($name);
        }
        return redirect()->back()->with('error', 'Report generation failed!');
    }
}
