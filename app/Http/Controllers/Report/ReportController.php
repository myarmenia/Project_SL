<?php

namespace App\Http\Controllers\Report;

use App\Exports\AlertsExport;
use App\Exports\ErangExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportGenerateRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Artisan;
use PhpOffice\PhpWord\Exception\Exception;

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
     * @return RedirectResponse
     * @throws Exception
     */
    public function generateReport(ReportGenerateRequest $request): RedirectResponse
    {
        $request_data = $request->all(['reportType', 'reportRange']);
        $now = Carbon::now()->format('Y_m_d_H_i_s');
        switch ($request_data['reportType']) {
            case 'by_qualification':
                $name = sprintf('by_qualification_%s.xlsx', $now);
                Excel::store(new ErangExport(), $name, 'erang_reports', null);
                break;
            case 'by_signal':
                $name = sprintf('by_signal_%s.xlsx', $now);
                Excel::store(new AlertsExport(), $name, 'alert_reports', null);
                break;
            case 'opened':
                Artisan::call('generate:opened_report');
                break;
            case 'suspended':
                Artisan::call('generate:suspended_report');
                break;
            case 'active':
                Artisan::call('generate:active_report');
                break;
        }
        return redirect()->back()->with('message', 'Generated!');
    }
}
