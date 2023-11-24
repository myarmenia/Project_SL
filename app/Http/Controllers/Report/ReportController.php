<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportGenerateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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


    public function generateReport(ReportGenerateRequest $request): StreamedResponse|JsonResponse
    {
        try {
            $r_data = $request->all(['reportType', 'reportRange', 'year', 'startDate', 'endDate']);
            extract($r_data);

            $range = getDateRange($reportRange, $year, $startDate, $endDate);
            extract($range);

            if ($from && $to) {
                $now = \Carbon\Carbon::now()->format('Y_m_d_H_i_s');
                switch ($reportType) {
                    case 'by_qualification':
                        $name = sprintf('%s_%s.xlsx', $reportType, $now);
                        Artisan::call('generate:qualification_report', ['name' => $name, 'from' => $from, 'to' => $to]);
                        return $this->downloadReport($name, 'qualification_reports');
                    case 'by_signal':
                        $name = sprintf('%s_%s.xlsx', $reportType, $now);
                        Artisan::call('generate:signal_report', ['name' => $name, 'from' => $from, 'to' => $to]);
                        return $this->downloadReport($name, 'signal_reports');
                    case 'opened':
                        $name = sprintf('%s_%s.docx', $reportType, $now);
                        Artisan::call('generate:opened_report', ['name' => $name, 'from' => $from, 'to' => $to]);
                        return $this->downloadReport($name, 'opened_reports');
                    case 'suspended':
                        $name = sprintf('%s_%s.docx', $reportType, $now);
                        Artisan::call('generate:suspended_report', ['name' => $name, 'from' => $from, 'to' => $to]);
                        return $this->downloadReport($name, 'suspended_reports');
                    case 'active':
                        $name = sprintf('%s_%s.docx', $reportType, $now);
                        Artisan::call('generate:active_report', ['name' => $name, 'from' => $from, 'to' => $to]);
                        return $this->downloadReport($name, 'active_reports');
                }
            }
            return response()->json('Report generation failed!', 400);
        } catch (\Throwable $exception) {
            Log::emergency($exception);
            return response()->json('Report generation failed!', 400);
        }
    }

    private function downloadReport(string $name, string $disk): JsonResponse|StreamedResponse
    {
        if (Storage::disk($disk)->exists($name)) {
            return Storage::disk($disk)->download($name, $name, ['file_name' => $name]);
        }
        return response()->json('Report generation failed!', 400);
    }
}
