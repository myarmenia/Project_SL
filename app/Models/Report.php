<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    protected $table = null;

    public static function getOpened($startDate, $endDate): Collection
    {
        return DB::table('signal')
            ->selectRaw('
            signal.id,
            agency.name as opened_subunit,
            GROUP_CONCAT(DISTINCT signal_worker.worker  SEPARATOR ", ") as worker_last_name,
            GROUP_CONCAT(DISTINCT worker_post.name  SEPARATOR ", ") as worker_post_name,
            signal.reg_num,
            signal_qualification.name as qualification_name,
            resource.name as resource_name,
            DATE_FORMAT(signal.subunit_date, "%d.%m.%Y") as subunit_date
        ')
            ->leftJoin('signal_qualification', 'signal.signal_qualification_id', '=', 'signal_qualification.id')
            ->leftJoin('agency', 'signal.opened_subunit_id', '=', 'agency.id')
            ->leftJoin('resource', 'signal.source_resource_id', '=', 'resource.id')
            ->leftJoin('signal_worker', 'signal.id', '=', 'signal_worker.signal_id')
            ->leftJoin('signal_worker_post', 'signal.id', '=', 'signal_worker_post.signal_id')
            ->leftJoin('worker_post', 'signal_worker_post.worker_post_id', '=', 'worker_post.id')
            ->whereNull('end_date')
            ->where('subunit_date', '<=', $endDate)
            ->where('subunit_date', '>=', $startDate)
            ->groupBy('signal.id')
            ->get();
    }


    public static function getActive($startDate, $endDate): Collection
    {
        return DB::table('signal')
            ->selectRaw('
            signal.id,
            agency.name as check_subunit,
            GROUP_CONCAT(DISTINCT signal_checking_worker.worker  SEPARATOR ", ") as worker_last_name,
            GROUP_CONCAT(DISTINCT worker_post.name  SEPARATOR ", ") as worker_post_name,
            signal.reg_num,
            signal_qualification.name as qualification_name,
            resource.name as resource_name,
            DATE_FORMAT(signal.subunit_date, "%d.%m.%Y") as subunit_date,
            GROUP_CONCAT(DISTINCT DATE_FORMAT(check_date.date, "%d.%m.%Y") SEPARATOR ", ") as extension_date,
            DATE_FORMAT(signal.check_date, "%d.%m.%Y") as check_date,
            DATE_FORMAT(signal.end_date, "%d.%m.%Y") as end_date,
            DATEDIFF(signal.end_date, signal.check_date) as expired_days,
            signal_result.name as signal_result_name,
            GROUP_CONCAT(DISTINCT taken_measure.name  SEPARATOR ", ") as taken_measure_name
        ')
            ->leftJoin('signal_qualification', 'signal.signal_qualification_id', '=', 'signal_qualification.id')
            ->leftJoin('agency', 'signal.check_subunit_id', '=', 'agency.id')
            ->leftJoin('resource', 'signal.source_resource_id', '=', 'resource.id')
            ->leftJoin('signal_checking_worker', 'signal.id', '=', 'signal_checking_worker.signal_id')
            ->leftJoin('signal_checking_worker_post', 'signal.id', '=', 'signal_checking_worker_post.signal_id')
            ->leftJoin('worker_post', 'signal_checking_worker_post.worker_post_id', '=', 'worker_post.id')
            ->leftJoin('signal_result', 'signal.signal_result_id', '=', 'signal_result.id')
            ->leftJoin('signal_has_check_date', 'signal.id', '=', 'signal_has_check_date.signal_id')
            ->leftJoin('check_date', 'signal_has_check_date.check_date_id', '=', 'check_date.id')
            ->leftJoin('signal_has_taken_measure', 'signal.id', '=', 'signal_has_taken_measure.signal_id')
            ->leftJoin('taken_measure', 'signal_has_taken_measure.taken_measure_id', '=', 'taken_measure.id')
            ->whereNotNull('end_date')
            ->where('end_date', '<=', $endDate)
            ->where('subunit_date', '>=', $startDate)
            ->groupBy('signal.id')
            ->get();
    }


    public static function getSuspended($startDate, $endDate): Collection
    {
        return DB::table('signal')
            ->selectRaw('
            signal.id,
            agency.name as check_subunit,
            GROUP_CONCAT(DISTINCT signal_checking_worker.worker  SEPARATOR ", ") as worker_last_name,
            GROUP_CONCAT(DISTINCT worker_post.name  SEPARATOR ", ") as worker_post_name,
            signal.reg_num,
            signal_qualification.name as qualification_name,
            resource.name as resource_name,
            DATE_FORMAT(signal.subunit_date, "%d.%m.%Y") as subunit_date,
            GROUP_CONCAT(DISTINCT DATE_FORMAT(check_date.date, "%d.%m.%Y") SEPARATOR ", ") as extension_date,
            DATE_FORMAT(signal.check_date, "%d.%m.%Y") as check_date,
            DATE_FORMAT(signal.end_date, "%d.%m.%Y") as end_date,
            DATEDIFF(signal.end_date, signal.check_date) as expired_days,
            signal_result.name as signal_result_name,
            GROUP_CONCAT(DISTINCT taken_measure.name  SEPARATOR ", ") as taken_measure_name
        ')
            ->leftJoin('signal_qualification', 'signal.signal_qualification_id', '=', 'signal_qualification.id')
            ->leftJoin('agency', 'signal.check_subunit_id', '=', 'agency.id')
            ->leftJoin('resource', 'signal.source_resource_id', '=', 'resource.id')
            ->leftJoin('signal_checking_worker', 'signal.id', '=', 'signal_checking_worker.signal_id')
            ->leftJoin('signal_checking_worker_post', 'signal.id', '=', 'signal_checking_worker_post.signal_id')
            ->leftJoin('worker_post', 'signal_checking_worker_post.worker_post_id', '=', 'worker_post.id')
            ->leftJoin('signal_result', 'signal.signal_result_id', '=', 'signal_result.id')
            ->leftJoin('signal_has_check_date', 'signal.id', '=', 'signal_has_check_date.signal_id')
            ->leftJoin('check_date', 'signal_has_check_date.check_date_id', '=', 'check_date.id')
            ->leftJoin('signal_has_taken_measure', 'signal.id', '=', 'signal_has_taken_measure.signal_id')
            ->leftJoin('taken_measure', 'signal_has_taken_measure.taken_measure_id', '=', 'taken_measure.id')
            ->whereNotNull('end_date')
            ->where('end_date', '<=', $endDate)
            ->where('end_date', '>=', $startDate)
            ->groupBy('signal.id')
            ->get();
    }

    public static function getQualified($startDate, $endDate): Collection
    {
        return DB::table('signal')
            ->selectRaw('
                agency.id as agency_id,
                agency.name as opened_subunit,
                signal_qualification.id as qualification_id,
                signal_qualification.name as qualification_name,
                count(*) as total
        ')
            ->leftJoin('signal_qualification', 'signal.signal_qualification_id', '=', 'signal_qualification.id')
            ->leftJoin('agency', 'signal.opened_subunit_id', '=', 'agency.id')
            ->where('subunit_date', '<=', $endDate)
            ->where('subunit_date', '>=', $startDate)
            ->groupBy('agency_id', 'qualification_id')
            ->get();
    }

    public static function getSignalsAlerts($startDate, $endDate)
    {
        return DB::table('agency')
            ->selectRaw("
                agency.name as opened_subunit,
                SUM(if(signal.subunit_date = '$startDate', 1, 0)) as B_col,
                count(*) as C_col,
                SUM(if(resource.id = 8, 1, 0)) as D_col,
                SUM(if(resource.id = 9, 1, 0)) as E_col,
                SUM(if(resource.id = 2, 1, 0)) as F_col,
                SUM(if(signal.opened_subunit_id != signal.check_unit_id, 1, 0)) as G_col,
                SUM(if(signal.end_date IS NOT NULL, 1, 0)) as H_col,
                SUM(if(taken_measure.id = 3, 1, 0)) as I_col,
                SUM(if(taken_measure.id IN (1,8), 1, 0)) as J_col,
                SUM(if(taken_measure.id = 5, 1, 0)) as K_col,
                SUM(if(taken_measure.id = 6, 1, 0)) as L_col,
                SUM(if(taken_measure.id = 36, 1, 0)) as M_col,
                SUM(if(taken_measure.id = 33, 1, 0)) as N_col,
                SUM(if(taken_measure.id = 12, 1, 0)) as O_col,
                SUM(if(taken_measure.id = 4, 1, 0)) as P_col,
                SUM(if(taken_measure.id = 34, 1, 0)) as Q_col,
                SUM(if(taken_measure.id IN (9,7), 1, 0)) as R_col,
                SUM(if(taken_measure.id IN (43,44), 1, 0)) as S_col,
                SUM(if(taken_measure.id = 42, 1, 0)) as T_col,
                SUM(if(taken_measure.id = 41, 1, 0)) as U_col,
                SUM(if(taken_measure.id = 37, 1, 0)) as V_col,
                SUM(if(taken_measure.id = 35, 1, 0)) as W_col,
                SUM(if(taken_measure.id = 20, 1, 0)) as X_col,
                SUM(if(taken_measure.id IN (24,21,23,22,25,38,40), 1, 0)) as Y_col,
                SUM(if(signal_result.id = 3, 1, 0)) as Z_col,
                SUM(if(signal.opened_subunit_id != signal.opened_agency_id, 1, 0)) as AA_col,
                SUM(if(signal.check_date <= '$endDate', 1, 0)) as AB_col,
                SUM(if(DATEDIFF(signal.end_date, signal.check_date) >= 1, 1, 0)) as AC_col,
                SUM(if(signal.subunit_date IS NOT NULL AND signal.check_date <= '$endDate', 1, 0)) as AD_col
            ")

            ->leftJoin('signal', 'agency.id', '=', 'signal.opened_subunit_id')
            ->leftJoin('signal_has_taken_measure', 'signal.id', '=', 'signal_has_taken_measure.signal_id')
            ->leftJoin('taken_measure', 'signal_has_taken_measure.taken_measure_id', '=', 'taken_measure.id')
            ->leftJoin('resource', 'signal.source_resource_id', '=', 'resource.id')
            ->leftJoin('signal_result', 'signal.signal_result_id', '=', 'signal_result.id')
            ->where('signal.end_date', '<=', $endDate)
            ->where('signal.subunit_date', '>=', $startDate)
            ->groupBy('agency.id')
            ->get();
    }

}
