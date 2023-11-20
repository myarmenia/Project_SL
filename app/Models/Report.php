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

}
