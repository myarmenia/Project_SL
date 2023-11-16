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
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        return view('report.index');
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
            case 'by_erang':
                $name = sprintf('erangavorumnerov_%s.xlsx', $now);
                Excel::store(new ErangExport(), $name, 'erang_reports', null);
                break;
            case 'by_alerts':
                $name = sprintf('ahazangerov_%s.xlsx', $now);
                Excel::store(new AlertsExport(), $name, 'alert_reports', null);
                break;
            case 'bacvac':
                Artisan::call('generate:opened_report');
                break;
            case 'dadarecvac':
                Artisan::call('generate:suspended_report');
                break;
            case 'gorcox':
                Artisan::call('generate:active_report');
                break;
        }
        return redirect()->back()->with('message', 'Generated!');
    }
}
